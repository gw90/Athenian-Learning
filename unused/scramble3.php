<?php

$cont = file_get_contents("fake.json");

function get_word($num, $json, $part) {
  
$arr = json_decode($json);
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
    echo $terms[$i];
    
    array_push($scrambles, get_word($i, $cont, "term"));
    
    echo " - ";
    array_push($definitions, get_word($i, $cont, "definition"));//term | definition | image | id | rank
    echo $definitions[$i];
    echo "<br>";
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

echo '<div id="q1">
<P> Definition =  '.$definitions[0].' </p>
<p> Scrambled Answer  =  "'.$scrambles[0].'"  </p>
<p> Unscrambled  Answer =   <input type="text"  name="answer"  value=""></input>
<p> <input  type="hidden" name="canswer"  value="'.$terms[0].'">
</div>
<br> <b><div onclick="javascript:validate()" >Check Your UnScramble </div></b>';

for($i = 1; $i <= 10; $i++){
  
  echo '<div style="visibility:hidden;" id="q'.$i.'">
<P> Definition =  '.$definitions[$i].' </p>
<p> Scrambled Answer  =  "'.$scrambles[$i].'"  </p>
<p> Unscrambled  Answer =   <input type="text"  name="answer"  value=""></input>
<p> <input  type="hidden" name="canswer"  value="'.$terms[$i].'">
</div>';
  
}
 ?>