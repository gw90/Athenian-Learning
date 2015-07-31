<!DOCTYPE html>
<html>

<head>

	<title>Scrambled Words | Athenian Learning</title>
	
	<link rel="icon" href="images/logo.ico" type="image/ico" >
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' ></script>
	<script src='../bootstrap/js/bootstrap.js' async></script>
	<link href='../bootstrap/css/bootstrap.css' rel='stylesheet'>
	
				<script>
      var i = 2
      var wrong = 0;
      function ans(){
      alert(document.questions.canswer[0].value);
      wrong++;
      }
     function validate(){


     //alert(definitions[0]);

    //alert(document.questions.answer[0].value);

    //alert(document.questions.canswer[0].value);
    if(i===11){
    	var x =  document.getElementById('q'+i).innerHTML;
      document.getElementById('q1').innerHTML  = x+"You got "+wrong+" wrong.";
      i++;
    }
    if(document.questions.answer[0].value === document.questions.canswer[0].value){
      var x =  document.getElementById('q'+i).innerHTML;
      document.getElementById('q1').innerHTML  = x;
      i++;
    }
    else {
      
      alert("Nope. Try again.")
      wrong++
    }


//alert(document.questions.questionnum.value);

     }

 </script>
	
	
</head>

<body>


<div id="hmm"><?php echo file_get_contents("navbar.html");?></div>




		<div class="container">
			
			<div class="">
				<!--center><img src="images/logo.jpg" height="100px" width="100px"/></center -->
				<h1 class="text-center">Scrambled Words - Athenian Learning</h1>
				<h3 class="lead text-center">Study well.</h3>
			</div>
		
		<br>
		
		
		<?php

if($_GET["set"] == ""){
  
  
} else {
  
		echo '<div class="row well">
		  
		  <p>You will be given the word but it&#39;s letters will be in a random order. You will also be given the words definition. Type in what you think the word is unscrambled, if you are correct it will go on to the next question. If you are wrong it will tell you to try again.</p>
		  
		</div>';
} ?>
		
		
		<div class="row well">
			
    <form name="questions">
<?php

if($_GET["set"] == ""){
  
  echo "<p>Please put the id of the set you want to study in the navigation bar at the top of the page.<br>To get the ID of the set go to the set's page and get the number in the URL after the quizlet.com/ and before the set's title.</p>";
  
} else {
  $cont = file_get_contents("https://api.quizlet.com/2.0/sets/".$_GET["set"]."/?client_id=Rrx8gXkBXT&whitespace=1");

$arr = json_decode($cont);

$p1 = get_object_vars($arr);

$title =  $p1["title"];
                    
$cont = file_get_contents("https://api.quizlet.com/2.0/sets/".$_GET["set"]."/terms?client_id=Rrx8gXkBXT&whitespace=1");
function get_word($num, $json, $part) {
  
$arr = json_decode($json);
//echo $arr[$num];
$p2 = get_object_vars($arr[$num]);
return $p2[$part];

}

/*

$terms = all of the terms
$definitions = all of the definitions
$scrambles = all of the scrambled words

*/


$terms = array();
$definitions = array();
$scrambles = array();

for ($i = 0; $i <= 10; $i++) {
    array_push($terms, get_word($i, $cont, "term"));//term | definition | image | id | rank
    //echo $terms[$i];
    
    array_push($scrambles, get_word($i, $cont, "term"));
    
    //echo " - ";
    array_push($definitions, get_word($i, $cont, "definition"));//term | definition | image | id | rank
    //echo $definitions[$i];
    //echo "<br>";
}
/*print_r($terms);
echo "<hr>";
print_r($definitions);
echo "<hr>";*/
//print_r($scrambles);

function scramble_word($word){
  $len=strlen($word);
  $oletters = array();
  $uoletters = array();
  
  for($i = 0; $i <= $len; $i++){
  	array_push($oletters, substr($word, $i, 1));
  }
  //print_r($oletters);
  
  for($i = 0; $i <= $len; $i++){
  	array_push($uoletters, "");
  }
  //print_r($oletters);
  
  
  for($i = 0; $i <= $len; $i++){
    $lett = rand(0,$len);
    if($uoletters[$lett] == ""){
      
      $uoletters[$lett] = $oletters[$i];
      
    } else {
      
      $i--;
      
    }
  }
  //print_r($uoletters);
  return implode($uoletters);
}

for($i = 0; $i <= 10; $i++){
  	$scrambles[$i] = scramble_word($terms[$i]);
}
//print_r($scrambles);

$count = count($terms);
$order = range(1, $count);
shuffle($order);
array_multisort($order, $terms, $definitions, $scrambles);
/*
echo "<hr>";echo "<hr>";
print_r($terms);
echo "<hr>";
print_r($definitions);
echo "<hr>";
print_r($scrambles);*/

echo '
<h4>'.$title.'</h4>
<div id="q1">
<P> Definition =  '.$definitions[0].' </p>
<p> Scrambled Term  =  "'.$scrambles[0].'"  </p>
<p> Unscrambled  Term =   <input type="text"  name="answer" value="">
<p> <input  type="hidden" name="canswer"  value="'.$terms[0].'">
</div>
<br> <b><a href="javascript:validate();" >Check Your UnScramble </a></b>
<hr>
<br> <b><a href="javascript:ans();" >What is the answer?</a></b>

';

echo '<div  id="tenquestions">';
for($i = 1; $i <= 10; $i++){
  
  echo '<div style="display:none;" id="q'.$i.'">
<P> Definition =  '.$definitions[$i].' </p>
<p> Scrambled Term  =  "'.$scrambles[$i].'"  </p>
<p> Unscrambled  Term =   <input type="text"  name="answer"  value="">
<p> <input  type="hidden" name="canswer"  value="'.$terms[$i].'">
</div>

';
  
}
echo "</div>";
}
 ?>
 <div style="display:none;" id="q11">
<p>You have completed this set. Reload the page to practice again.</p>
</div>
			</form>
		</div>
		
		<!-- Importing Bootstrap
		<script src='bootstrap/js/bootstrap.js'></script>
		<link href='bootstrap/css/bootstrap.css' rel='stylesheet'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>-->
		
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' async></script>
<script src='bootstrap/js/bootstrap.js' async></script>
	
		</div>
		<div id="footermain"><?php echo file_get_contents("../footer.html");?></div>

</body>

</html>