 <!DOCTYPE html>
<html>

<head>

	<title>Search <?php echo $_GET["q"] ?> - Athenian Learning</title>
	
	<link rel="icon" href="images/logo.ico" type="image/ico" >
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' ></script>
	<script src='bootstrap/js/bootstrap.js' async></script>
	<link href='bootstrap/css/bootstrap.css' rel='stylesheet'>
	
	
</head>

<body>


<div id="hmm"><?php echo file_get_contents("navbar.html");?></div>




		<div class="container">
			
			<div class="">
				<!--center><img src="images/logo.jpg" height="100px" width="100px"/></center -->
				<h1 class="text-center">Search <?php echo $_GET["q"] ?> - Athenian Learning</h1>
				<h3 class="lead text-center">Study well.</h3>
			</div>
		
		<br>
		
		
		<div class="row well">
			
    
    <?php
    
                        $cont = file_get_contents("https://api.quizlet.com/2.0/search/sets?q=".$_GET["q"]."&per_page=30&client_id=Rrx8gXkBXT&whitespace=1");
//$cont = file_get_contents("search.json");
$arr = json_decode($cont);

$p1 = get_object_vars($arr);

$p2 = $p1["sets"];

for($i = 0; $i <= 20; $i++){
  $setinfo = get_object_vars($p2[$i]);
  
  $title = $setinfo["title"];
  $id  = $setinfo["id"];
  $desc  = $setinfo["description"];

  echo '<div class="col-md-12">
				
				<h4>'.$title.'</h4>
				<p><a href="scrambled.php?set='.$id.'">Scramble</a> | <a href="crossword.php?set='.$id.'">Crossword</a> | <a href="http://quizlet.com/'.$id.'" target="_blank">On Quizlet</a></p>
				<h5>'.$desc.'</h5>
				<p>id:'.$id.'</p>
				
			</div>
			<hr/>
			';

  echo "<br/><br><hr/>";
}
    ?>
		</div>
    
		</div>
		
		<!-- Importing Bootstrap
		<script src='bootstrap/js/bootstrap.js'></script>
		<link href='bootstrap/css/bootstrap.css' rel='stylesheet'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>-->
		
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' async></script>
<script src='bootstrap/js/bootstrap.js' async></script>
	
		</div>
		<div id="footermain"><?php echo file_get_contents("footer.html");?></div>

</body>

</html>