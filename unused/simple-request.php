<?php 

// Your credentials
$myClientId = 'Rrx8gXkBXT';
$mySecret = 'T3D76mVJ7cZ44mvkTgqFeR';
$myUrl = 'http://www.gregorywickham.com/studygames/simple-request.php?set='.$_GET["set"];
 
// URLs
$authorizeUrl = "https://quizlet.com/authorize?client_id={$myClientId}&response_type=code&scope=read";
$tokenUrl = 'https://api.quizlet.com/oauth/token';
 
session_start();
 
// Helper function for errors
function displayError($error, $step) {
    echo '<h2>An error occurred in step '.$step.'</h2><p>Error: '.htmlspecialchars($error['error']).
        '<br />Description: '.(isset($error['error_description']) ? htmlspecialchars($error['error_description']) : 'n/a').'</p>';
};
 
// Step 1: Display dialog box on quizlet to ask the user to authorize my application
// =================================================================================
if (empty($_GET['code']) && empty($_GET['error'])) {
    $_SESSION['state'] = md5(mt_rand().microtime(true)); // CSRF protection
    echo '<a href="'.$authorizeUrl.'&state='.urlencode($_SESSION['state']).'&redirect_uri='.urlencode($myUrl).'">Step 1: Start Authorization</a>';
    exit();
}
 
// Check for issues from step 1:
if (!empty($_GET['error'])) { // An error occurred authorizing
    displayError($_GET, 1);
    exit();
}
if ($_GET['state'] != $_SESSION['state']) {
    exit("We did not receive the expected state. Possible CSRF attack.");
}
 
// Step 2: Get the authorization token (via POST)
// ==============================================
if (!isset($_SESSION['access_token'])) {
    echo "<p>Step 1 completed - the user authorized our application.</p>";
    $payload = [
        'code' => $_GET['code'],
        'redirect_uri' => $myUrl,
        'grant_type' => 'authorization_code'
    ];
    $curl = curl_init($tokenUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERPWD, "{$myClientId}:{$mySecret}");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    $token = json_decode(curl_exec($curl), true);
    $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
 
    if ($responseCode != 200) { // An error occurred getting the token
        displayError($token, 2);
        exit();
    }
 
    $accessToken = $token['access_token'];
    $username = $token['user_id']; // the API sends back the username of the user in the access token
 
    // Store the token for later use (outside of this example, you might use a real database)
    // You must treat the "access token" like a password and store it securely
    $_SESSION['access_token'] = $accessToken;
    $_SESSION['username'] = $username;
 
    echo "<p>Step 2 completed - access token was received.</p>";
}

$curl = curl_init("https://api.quizlet.com/2.0/sets/".$_GET["set"]."/terms?client_id=Rrx8gXkBXT&whitespace=1");
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$_SESSION['access_token']]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$info = curl_exec($curl);
//echo $info;
$data = json_decode(curl_exec($curl));
$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
 
if (floor($responseCode / 100) != 2) { // A non 200-level code is an error (our API typically responds with 200 and 204 on success)
    displayError((array) $data, 3);
    exit();
}
/*
echo $_GET['state'];
echo "<hr>";
echo $_GET['code'];
echo "<hr>";*/
//remember to remain authorized all URLs must end like this
$ending = "&state=".$_GET['state']."&code=".$_GET['code'];
echo "URL: http://www.gregorywickham.com/studygames/simple-request.php?set=".$_GET["set"].$ending;
echo "<hr>";
$cont = $info;
$arr = json_decode($cont);
//print_r($arr);
//var_dump($arr);
//print_r($cont);
function get_word($num, $json, $part) {
//echo $json;
//echo "<hr>Terms:<br><br><br>";
$array = json_decode($json);
//echo $array;
//echo "<hr>";
//echo count($array);
//echo "<br>";
$p1 = $array;
//echo $p1;
//echo "<hr>";
$p2 = get_object_vars($array[$num]);
//print_r($p2);
//echo "<br>";
echo $p2[$part];

}
//echo count($arr);
$len = count($arr);
for ($i = 0; $i <= $len; $i++) {
    get_word($i, $cont, "term");//term | definition | image | id | rank
    echo "<br>";
}


 ?>