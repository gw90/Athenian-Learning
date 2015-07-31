<!DOCTYPE html>
<html>
<head>
  
  <title>Scrambled Words </title>
</head>

<body>
  
<form name="questions" onsubmit="validate();">
<?php

//echo "URL: http://www.gregorywickham.com/studygames/scramble.php?set=".$_GET["set"];
//echo "<hr>";
//$cont = file_get_contents("https://api.quizlet.com/2.0/sets/".$_GET["set"]."/terms?client_id=Rrx8gXkBXT&whitespace=1");
$cont = file_get_contents("fake.json");
//$arr = json_decode($cont);
function get_word($num, $json, $part, $mab) {
  $array = json_decode($json);
  global $length;
  $length = count($array);
  $p1 = $array;
  if($mab === 0){
  echo "<p hidden>";
  }
  $p2 = get_object_vars($array[$num]);
  if($mab === 0){
    echo "</p>";
  }
  return $p2[$part];
  //END of GET_WORD()
}

$words = array();
$definitions = array();
//creates all the arrays of words and coressponding definitions
for($j = 0; $j <= $length; $j++){
	array_push($words, get_word($j, $cont, "term", 0));
	array_push($definitions, get_word($j, $cont, "definition", 0));
}

$count = count($words);
$order = range(1, $count);
shuffle($order);
//shuffles all the arrays the same way
array_multisort($order, $words, $definitions);

/*print_r($words);
echo "<hr>";
print_r($definitions);*/


$defs = json_decode($json);

//the word scrambling function that scrambles the words
//start function
function scramble_word($number){
  $cont = file_get_contents("fake.json");
  //$cont = file_get_contents("https://api.quizlet.com/2.0/sets/".$_GET["set"]."/terms?client_id=Rrx8gXkBXT&whitespace=1");
  $word = array();
  $str = get_word($number,$cont,"term", 0);
  //echo $str;
  //puts all the letters of the word into array $word
  for($j = 0; $j <= strlen($str); $j++){
  	array_push($word, substr($str, $j, 1));
  }
  $scrambled = array();
  //puts the correct number of values in array $scrambled
  for($j = 0; $j <= strlen($str); $j++){
  	array_push($scrambled, "");
  }
  //scrambles the word
  for($j = 0; $j <= strlen($str); $j++){
  	$letter = rand(0,strlen($str));
  	if($scrambled[$letter] == ""){
  		$scrambled[$letter] = $word[$j];
  	} else {
  		$j--;
  	}
  }
  //print_r($scrambled);
  //echo "<br>";
  //prints the whole scrambled word
  /*for($j = 0; $j <= strlen($str); $j++){
  	echo $scrambled[$j];
  }*/
  
  //makes the scrambled words effectivly the real words.
  $words[$number] = implode($scrambled);
  //echo $words[$number];
  return implode($scrambled);

  //end function
}


$array = json_decode($cont);
$max = 10;
if(count($array)<10){
	$max = count($array)-1;
}

$len = count($array);

$start = rand(0,$len-$max);
//make the page
for($i = $start; $i <= $start+$max; $i++){
	//$words[$i] = scramble_word($i);
	//echo scramble_word($i)." - ".$definitions[$i];
	echo scramble_word($i)." - ".$definitions[$i];
	echo "<br>";
	echo "<input name='".$i."'></input>";
	echo "<br>";
}
$array = json_decode($cont);


for($i = 2; $i <= 10; $i++){
  
  echo '<div  id="tenquestions">

<div id="q'.$i.'">
<P> Definition =  '."".' </p>
<p> Scrambled Answer  =  "'.$get_word.'"  </p>
<p> Unscrambled  Answer =   <input type="text"  name="answer"  value=""></input>
<p> <input  type="hidden" name="canswer"  value="'."".'">
</div>';
  
}


?>
 <input type="submit"></input>

</form>
 
 
 <script>
   
   var answers = Array(<?php
   $allwords = array();
   for($i = 0; $i <= $max; $i++){
	echo "'".get_word($i, $cont, "term", 1)."'";
	if($i == $max){
	}else{
	  echo ",";
	}
	
}
   
   ?>);
   
   function validate(){
     
    for(i = 0; i <= 10; i++)
      
    }
     
   }
   
 </script>
 
 </body>


 </html>