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

//$cont is the json source
$cont = file_get_contents("fake.json");
//$arr = json_decode($cont);
//number is the word number in the array, $json is the json source, $part is the part of the card to be returned, $mab says whether or not to hide the error
function get_word($num, $json, $part, $mab) {
  //$array is an array generated from the decoding of the json source ($cont)
  $array = json_decode($json);
  //$length is the number of cards in the set
  global $length;
  $length = count($array);
  if($mab === 0){
    //this hides the error that I don't care about
    echo "<p hidden>";
  }
  $p2 = get_object_vars($array[$num]);
  if($mab === 0){
    //this hides the error that I don't care about
    echo "</p>";
  }
  return $p2[$part];
  //END of GET_WORD()
}


$words = array(); //an array that contains all of the terms int the set
$definitions = array();//an array that contains all of the definitions int the set

//creates all the arrays of words and coressponding definitions
for($j = 0; $j <= $length; $j++){
	array_push($words, get_word($j, $cont, "term", 0));
	array_push($definitions, get_word($j, $cont, "definition", 0));
}

$count = count($words);// $count = the number of words in the set
$order = range(1, $count);
shuffle($order);//the suffling factor (an array)
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
  $word = array();//the array where all the letters will be put in
  $str = get_word($number,$cont,"term", 0);
  //echo $str;
  //puts all the letters of the word into array $word
  for($j = 0; $j <= strlen($str); $j++){
    //puts every seperate letter in the array
  	array_push($word, substr($str, $j, 1));
  }
  $scrambled = array();//the array where the scrambled letters will go
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
  
  //makes the scrambled words effectivly the real words.
  $words[$number] = implode($scrambled);
  //echo $words[$number];
  return implode($scrambled);

  //end function
}


$array = json_decode($cont);//again
$max = 10;
if(count($array)<10){
	$max = count($array)-1;
}

$len = count($array);//number of terms to be used

$start = rand(0,$len-$max);//the starting place in the array
//make the page
for($i = $start; $i <= $start+$max; $i++){
	//$words[$i] = scramble_word($i);
	//echo scramble_word($i)." - ".$definitions[$i];
	echo scramble_word($i)." - ".$definitions[$i];
	echo "<br>";
	echo "<input name='".$i."'></input>";
	echo "<br>";
}


for($i = 2; $i <= 10; $i++){
  
  echo '<div  id="tenquestions">

<div id="q'.$i.'">
<P> Definition =  '."".' </p>
<p> Scrambled Answer  =  "'.$words[$i].'"  </p>
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