<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>xWords Demo</title>

    <!-- Bootstrap -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/loading.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #mainContainer { display:none; }
        .canvasContainer { margin-bottom:15px; }

        .sliderText { font-weight: bold;}
        .sliderText span { font-weight: normal;}
        .sliderValues { font-weight: bold;}
        .sliderContainer { margin-bottom:20px;}

        label {font-weight: normal;}
    </style>
    
  </head>
  <body>

    <div id="topContainer" class="container">
    <header>
      <div class="row">
        <h1>xWords Demo: Create a crossword</h1>
    </div>
    </header>
    <section>
        <div id="mainContainer" class="row">
            <div class="canvasContainer col-sm-6">
                <canvas id="myQuestionCanvas" width="425" height="325" style="border:1px solid black;">
                </canvas>
                <br /><a id="downloadQuestion" href="" download="crossword-question.png">Download Image</a>
            </div>

            <div class="canvasContainer col-sm-6">
                <canvas id="myCanvas" width="425" height="325" style="border:1px solid black;">
                </canvas>
                <br /><a id="downloadAnswer" href="" download="crossword-answer.png">Download Image</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div id="across">
                </div>
            </div>
            <div class="col-sm-3">
                <div id="down">
                </div>
            </div>
            <div class="col-sm-3">
                <div id="unused">
                </div>
            </div>
            <div class="col-sm-3">
                <div id="errors">
                </div>
            </div>
        </div>
    
        <div class="row">
            <h2>Controls:</h2>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div>
                    <div class="sliderText">
                        Words and Clues:</div>
                    <p>Enter a list of words and clues separated by a comma (','). To see an example <a href="javascript: LoadSampleData();">VIEW SAMPLE DATA</a>.</p>
                    <textarea style="width:100%" id="txtWords" rows="10">
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
                    </textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="sliderText">Title (only shows on print)</div>
                <div class="sliderContainer">
                    <input type="text" id="txtCrosswordTitle" value="" style="width:100%;" />
                </div>
                <div class="sliderText">Square size <span id="sliderValue"></span></div>
                <div class="sliderContainer">
                    <div id="slider"></div>
                </div>
                <div class="sliderText">Horizontal Squares <span id="hSliderValue"></span></div>
                <div class="sliderContainer">
                    <div id="hSlider"></div>
                </div>
                <div class="sliderText">Vertical Squares <span id="vSliderValue"></span></div>
                <div class="sliderContainer">
                    <div id="vSlider"></div>
                </div>
                <div class="sliderText">Reveal letters <span id="revealLettersValue"></span></div>
                <div class="sliderContainer">
                    <div id="revealLettersSlider"></div>
                </div>
                <div class="sliderText">Print options</div>
                <div class="sliderContainer">
                    <input id="rdAll" type="radio" name="printOptions" value="all" checked="checked" />
                    <label for="rdAll">Everything</label>
                    &nbsp;&nbsp;&nbsp;
                    <input id="rdQuestion" type="radio" name="printOptions" value="question" />
                    <label for="rdQuestion">Question only</label>
                    &nbsp;&nbsp;&nbsp;
                    <input id="rdAnswers" type="radio" name="printOptions" value="answers" />
                    <label for="rdAnswers">Answers only</label>
                </div>
                <div>
                    <input
                            type="button"
                            id="btnAddWords"
                            onclick="btnAddWords_click()"
                            value="Generate!!!" />
                    <input
                            type="button"
                            id="btnPrint"
                            onclick="btnPrint_click()"
                            value="Open Printable Page" />
                </div>
            </div>
        </div>
    </section>
    <footer class="row">
      <small></small>
    </footer>
    </div><!-- END CONTAINER CLASS -->

    <!-- BUSY ANIMATION -->
    <div class="loading" style="display:none;">
        <img src="img/crosswordTimer.gif" alt="xWords busy indicator" />
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/xWords.js"></script>
    <script src="js/xWordsDisplay.js"></script>
    
    <script>

        var context;
        var canvas;

        var contextQuestion;
        var canvasQuestion;

        window.onload = function(){
            // set up the question canvas and the answer canvas
            canvasQuestion = document.getElementById("myQuestionCanvas");
            contextQuestion = canvasQuestion.getContext("2d");

            canvas = document.getElementById("myCanvas");
            context = canvas.getContext("2d");

            $('.loading').hide();

            $( "#slider" ).slider({
                max:50,
                min:20,
                value:25,
                slide: function( event, ui ) {
                    $('#sliderValue').html(ui.value);
                },
                change: function( event, ui ) {
                    updateBoxSize(ui.value);
                }
            });


            $( "#hSlider" ).slider({
                max:20,
                min:5,
                value:12,
                slide: function( event, ui ) {
                    $('#hSliderValue').html(ui.value);
                },
                change: function( event, ui ) {
                    updateGridSize(ui.value,-1);
                }
            });

            $( "#vSlider" ).slider({
                max:20,
                min:5,
                value:12,
                slide: function( event, ui ) {
                    $('#vSliderValue').html(ui.value);
                },
                change: function( event, ui ) {
                    updateGridSize(-1, ui.value);
                }
            });

            $( "#revealLettersSlider" ).slider({
                max:100,
                min:0,
                value:0,
                slide: function( event, ui ) {
                    $('#revealLettersValue').html(ui.value + "%");
                },
                change: function( event, ui ) {
                    REVEAL_LETTERS = ui.value;
                }
            });

            $('#sliderValue').html(
                $( "#slider" ).slider( "value" )
            );
            $('#vSliderValue').html(
                $( "#vSlider" ).slider( "value" )
            );
            $('#hSliderValue').html(
                $( "#hSlider" ).slider( "value" )
            );
            $('#revealLettersValue').html(
                $( "#revealLettersSlider" ).slider( "value" ) + "%"
            );

        }
    </script>
  </body>
</html>