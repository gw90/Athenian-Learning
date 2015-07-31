<?php

$cont = file_get_contents("https://api.quizlet.com/2.0/sets/".$_GET["set"]."/terms?client_id=Rrx8gXkBXT&whitespace=1");
$arr = json_decode($cont);

function get_word($num, $json, $part) {
$array = json_decode($json);
$p1 = $array;
$p2 = get_object_vars($array[$num]);
echo $p2[$part];

}
//echo count($arr);
$len = count($arr);
for ($i = 0; $i <= 10; $i++) {
    get_word($i, $cont, "term");//term | definition | image | id | rank
    echo ",";
    get_word($i, $cont, "definition");//term | definition | image | id | rank
    echo "
";
}


 ?>