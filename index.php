 <!DOCTYPE html>
<html>

<head>

	<title>Athenian Learning</title>
	
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
				<h1 class="text-center">Athenian Learning</h1>
				<h3 class="lead text-center">Study well.</h3>
			</div>
		
		<br>
		
		
		<div class="row well">
			
    <div class='col-md-6'>
				<h4>Play Scrambled Words with:</h4>
				<li><a href="scrambled.php?set=29877765">English 6 - Wordly Wise 3000 - Book 6, Lesson 4</a></li>
        <li><a href="scrambled.php?set=20788660">GCSE Spanish vocab - food</a></li>
        <li><a href="scrambled.php?set=25178701">Up Your Score SAT Vocabulary</a></li>
        <li><a href="scrambled.php?set=37753193">Visual Latin Vocabulary - Lesson 9</a></li>
			</div>
			
			<div class='col-md-6'>
				<h4>Do a Crossword puzzle with:</h4>
				<li><a href="crossword.php?set=29877765">English 6 - Wordly Wise 3000 - Book 6, Lesson 4</a></li>
				<li><a href="crossword.php?set=20788660">GCSE Spanish vocab - food</a></li>
				<li><a href="crossword.php?set=25178701">Up Your Score SAT Vocabulary</a></li>
				<li><a href="crossword.php?set=37753193">Visual Latin Vocabulary - Lesson 9</a></li>
				
			</div>
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