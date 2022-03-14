<?php include "php/head.php"; ?>
<?php include "php/header.php"; ?>

<?php include "php/aside.php"; ?>

<div class="section">
	<?php
        $showDefaultText = FALSE;
        $choosedQuiz = null;
        if (isset($_SESSION["figur"])) {
			$_POST["figur"] = $_SESSION["figur"];
			unset($_SESSION["figur"]);
		}
        if (isset($_POST["figur"])) {
            if (empty($_POST["figur"])) {
                $_POST["figur"] = "default";
            }
            
            if ($_POST["figur"] !== "default") {
            	$choosedQuiz = $SchachfibelDAO->selectQuiz($_POST["figur"]);
				$quizName = $choosedQuiz->getQuizName();
				
        ?>
	<header><?php echo htmlspecialchars($quizName); ?> - Quiz</header>

	<div class="infobox">
		<div class="infologo">&#9872;</div>
		<div class="infotext">Hier kannst du dein Wissen im Quiz prüfen.</div>
	</div>

	<?php

                /**
                * check $_POST
                * if: count points in QuizElement
                */
                $answerState = "unchoosed";
				$questionListSize = $choosedQuiz->getSizeOfQuestionList();
				$questionListSize = htmlspecialchars($questionListSize);
                $choosedQuiz->resetPoints();
                if (count($_POST) - 1 == $questionListSize) {
                    $choosedQuiz->countPoints($_POST); 
                    $answerState = "complete";
                } else if (count($_POST) - 1 > 0) {
                    $answerState = "uncomplete";
                }
                
                if ($answerState != "complete") {
                ?>
	<div id="button-random-quiz">
		<form method="post">
			<button class="button2" type="submit" name="figur" value="<?php echo htmlspecialchars($SchachfibelDAO->getRandomQuizID()); ?>">
				Starte zufälliges Quiz
			</button>
		</form>
	</div>
	<?php
                }
    ?>
	<form method="post" action="<?php if ($answerState != "complete") {
                                                    echo "#button-box-jump";
                                                } else {
                                                    echo "#nav-jump";
                                                }  ?>">
		<?php
                // Generate the question-boxes
                $countQuestion = 0;

                foreach ($choosedQuiz->getQuestionList() as $question) {
                    if (isset($question)) {
                        $countQuestion++;
                ?>
		<div class="quizquestion">
			<p>
				<?php echo htmlspecialchars($question->getQuestionString()); ?>
			</p>
			<?php
								$questionPath = $question->getPath();
                                if ($questionPath != "") { ?>
			<div class="question-pic">
				<img class="question-image" src="<?php echo "images/quiz/" . htmlspecialchars($questionPath); ?>" alt="Schachbrett mit Figuren">
			</div>
			<?php } ?>
			<div class="optiongrid">
				<?php
                                    $answers = $question->getAnswerList();
                                    for ($i = 0; $i < count($answers); $i++) {
                                    ?>
				<input type="radio" name="<?php echo "answer" . $countQuestion ?>" id="<?php 
                       echo "answer" . $countQuestion . "_" . $i+1;?>" value="<?php echo $i; ?>" <?php
						if ($answerState == "uncomplete" && isset($_POST["answer" . $countQuestion])
							&& $_POST["answer" . $countQuestion] == $i) {
								echo " checked";
                       	}
				?>>
				<label for="<?php echo "answer" . $countQuestion . "_" . $i+1;?>" class="button3 not-copyable <?php if ($answerState == "complete") {
                                                    if ($_POST["answer" . $countQuestion] == $i) {
                                                        if (htmlspecialchars($choosedQuiz->getQuestionSolutionListElement("answer" . $countQuestion)) == 1) {
                                                        echo "rightAnswer";
                                                    } else {
                                                        echo "wrongAnswer";
                                                    } 
                                                    }
                                                    }?>"><?php echo $answers[$i]; ?></label>
				<?php } ?>
			</div>
		</div>

		<?php } }?>
		<div class="button-box-quiz" id="button-box-jump">
			<?php if ($answerState == "complete") { ?>
			<div id="button-random-quiz-correct">
				<button class="button2 button-left" type="submit" name="figur" value="<?php echo htmlspecialchars($SchachfibelDAO->getRandomQuizID()); ?>">
					Starte zufälliges Quiz
				</button>
			</div>
			<?php } ?>
			<div id="button-answer">
				<button class="button2" type="submit" name="figur" value="<?php echo $_POST["figur"]; ?>">
					<?php 
                            if ($answerState == "complete") {
                                echo "&#8635; Wiederholen";
                            } else {
                                echo "&#9745; Antworten";
                            }
                        ?>
				</button>
			</div>
		</div>
	</form>

	<div class="quiz-solution-info <?php if ($answerState == "uncomplete") {
                            echo "wrongAnswer";
                        } else { 
                            echo "unchoosed";
                        }?>">
		<?php 
                        if ($answerState == "complete") { ?>
		
            <p>
                Herzlichen Glückwunsch, du hast <?php echo htmlspecialchars($choosedQuiz->getPoints())?> <?php 
                            if(htmlspecialchars($choosedQuiz->getPoints()) == 1) {
                                echo "Punkt";
                            } else {
                                echo "Punkte";
                            }
                            ?> im <?php echo htmlspecialchars($quizName); ?> - Quiz erreicht!
            </p>
            <!-- facebook and twitter share buttons in terms of data-protection law implementation with shariff -->
            <div class="shariff share-buttons" data-services="[&quot;facebook&quot;,&quot;twitter&quot;]" data-text="hallo" data-title="Hi, ich habe gerade <?php 
                            echo htmlspecialchars($choosedQuiz->getPoints());
                            ?> <?php 
                            if(htmlspecialchars($choosedQuiz->getPoints()) == 1) {
                                echo "Punkt";
                            } else {
                                echo "Punkte";
                            }
                            ?> im <?php echo htmlspecialchars($quizName); ?> - Quiz erreicht, prüfe dich auch unter ">
            </div>

		<?php } else { ?>
		Beantworte bitte alle Fragen!
		<?php } ?>
	</div>

	<?php
        } else { // _POST[figur] == deafult";
            $showDefaultText = TRUE;
            }
        } else { // !(isset($quizName))
            $showDefaultText = TRUE;
        }
        
        if ($showDefaultText == TRUE) {
        ?>

	<header>Noch kein Quiz ausgewählt!</header>

	<div class="infobox">
		<div class="infologo">&#9872;</div>
		<div class="infotext">Bitte wähle in der linken Menüleiste eine Figur oder die allgemeinen Regeln aus, wenn du dein Wissen in einem Quiz prüfen möchtest. <br>Alternativ kannst du ein zufälliges Quiz aufrufen lassen.</div>
	</div>
	<div id="button-random-quiz">
		<form method="post">
			<button class="button2" type="submit" name="figur" value="<?php echo htmlspecialchars($SchachfibelDAO->getRandomQuizID()); ?>">
				Starte zufälliges Quiz
			</button>
		</form>
	</div>
	<?php
        }
    ?>
    
</div>

<script src="shariff/shariff.complete.js"></script>

<?php include "php/footer.php"; ?>
