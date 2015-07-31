<?php

$info = file_get_contents("fake.json");
 

//echo "<hr>";
$cont = $info;
$array = json_decode($cont);
function get_word($num, $json, $part) {
$array = json_decode($json);
$p1 = $array;
echo "<p hidden>";
$p2 = get_object_vars($array[$num]);
echo "</p>";
return $p2[$part];

}
$words = array();
$defs = array();
//echo count($array);
$len = count($array);
for ($i = 0; $i <= $len; $i++) {
    
    array_push($words, get_word($i, $cont, "term"));//term | definition | image | id | rank
    
}
for ($i = 0; $i <= $len; $i++) {
    
    array_push($defs, get_word($i, $cont, "definition"));//term | definition | image | id | rank
    
}

$len = count($words);
$all = "";
for ($i = 0; $i <= $len; $i++) {
    $all= $all."<br>";
    $all = $all.$words[$i]." ";
    $all = $all."-";
    $all = " ".$all.$defs[$i];
    
}
echo $all;
echo "<hr>";
// put in the <input>s
$arrall = explode(" ", $all);
print_r($arrall);
$len = count($arrall);
echo "<hr>";
for ($i = 0; $i <= $len; $i++) {
    
    if(rand(0,4) == 1){
    
    	echo "<input type='text'></input>"." ";
    
    } else {
    	echo $arrall[$i]." ";
    }/*
    if($i % 2 == 0){
    	echo " - ";
    }*/
}


?>