<?php include "php/head.php"; ?>
<?php include "php/header.php"; ?>

<aside></aside>

<div class="picture">
	<div id="home-welcome" class="not-copyable">
		<img src="images/homepicture-l.jpg" id="homepic" alt="Chess Image!">
		<div id="home-welcome-titel">Schachfibel</div>
		<div id="home-welcome-untertitel">Scrolle nach unten um mehr über uns zu erfahren
			<div id="home-welcome-symbol">
				&#9660;
			</div>
		</div>
	</div>
	<!-- https://www.pexels.com/photo/kick-chess-piece-standing-131616/ -->
</div>

<div class="section">
	<header>Willkommen bei der Schachfibel!</header>
	<div class="index-text">
		<p>
			Du möchtest Schach spielen, weißt aber nicht wie es funktioniert?
			Dann bist du hier genau richtig!
			Diese Seite richtig sich vorallem an Schachdebütant*innen und Schachanfänger*innen,
			die Tipps und die Spielregeln lernen möchten.
			Wir bieten ein Tutorial für alle Regeln an,
			wo du dein gelerntes Wissen an unserem Quiz testen kannst.
			Um mit anderen Spieler*innen zu plaudern,
			kannst du dich mit ihnen im Forum austauschen.
			Außerdem kannst du in unserer Lernsammlung und im Gruppenordner weitere Materialien finden,
			die wir oder andere Nutzer*innen der Schachfibel empfehlen.
			Wenn du schon viel Schacherfahrung hast, wirst du vermutlich bei uns nicht fündig.
			Allerdings kannst du die Materialen begutachten und anderen Nutzer*innen im Forum Hilfestellungen geben.
			Wir wünschen viel Spaß!
		</p>
	</div>
	<div class=grid-container>

		<div class="home-info-box" id="tutorial">
			<div class="home-info-header">
				<h2 class="box-title">Tutorial</h2>
			</div>
			<div class="home-info-body">
				<p>
					Du möchtest endlich das berühmte Brettspiel Schach kennenlernen?
					<br>
					<br>
					Dann bist du hier zum Einstieg genau richtig!
					<br>
					<br>
					Auf unserer Tutorialseite findest du interessante Informationen für das Schachspielen.
					Neben den allgemeinen Regeln,
					lernst du ebenfalls in seperaten Tutorials etwas über die Schachfiguren wie beispielsweise dem Bauern.
					<br>
					<br>
					Klicke auf den „Tutorial“-Button um zu starten!
				</p>
				<div class="index-button">
					<a class="tutorial button2" href="./tutorial.php">
						Tutorial
					</a>
				</div>
			</div>
		</div>

		<div class="home-info-box" id="quiz">
			<div class="home-info-header">
				<h2 class="box-title">Quiz</h2>
			</div>
			<div class="home-info-body">
				<p>
					Wenn du dich tapfer durch die Tutorials geschlagen hast oder dein Wissen einer Probe unterziehen möchtest,
					dann prüfe dich auf unserer Quizseite!
					<br>
					<br>
					Klicke auf den „Quiz“-Button um zu der Quiz-Startseite zu gelangen!
				</p>
				<div class="index-button">
					<a class="quiz button2" href="./quiz.php">
						Quiz
					</a>
				</div>
				<p>
					Klicke auf den „Starte zufälliges Quiz“-Button um dich in einen zufällig ausgewählten Quiz zu prüfen!
				</p>
				<div class="index-button">
					<form method="post" action="quiz.php">
                        <button class=" quiz button2" type="submit" name="figur" value="<?php echo htmlspecialchars($SchachfibelDAO->getRandomQuizID()); ?>">
                        Starte zufälliges Quiz
                        </button>
					</form>
				</div>
			</div>
		</div>

		<div class="home-info-box" id="forum">
			<div class="home-info-header">
				<h2 class="box-title">Letzter Forumbeitrag</h2>
			</div>
			<div class="home-info-body">
				<?php
        if (!isset($SchachfibelDAO)) {
        	$SchachfibelDAO = new DBSchachfibelDAOImpl();
        }
        
		$forumpostNamespace = "forumpost-";
        $forumpostNamespaceLike = $forumpostNamespace . "like-";
        $forumPost = $SchachfibelDAO->getForumPosts();        
        if ($forumPost != null) {
        	$post = $forumPost[array_key_first($forumPost)];
        	$user = $SchachfibelDAO->getUser($post->getUserId()) ?>
				<div class="forumpost-header-index">
					<?php
                                $postUser = $SchachfibelDAO->getUser($post->getUserId());
                                if (!isset($postUser)) { ?>
					<div class="forumpost-header-error">
						Fehler: Der Autor des Kommentars konnte nicht geladen werden.
					</div>
					<?php } else { ?>
					<?php
                                    $postUserpicture = $postUser["image"];
                                    if (!isset($postUserpicture) || empty($postUserpicture)) { ?>
					<div class="forumpost-header-error">
						Fehler: Das Bild konnte nicht geladen werden.
					</div>
					<?php } else { ?>
					<img src="<?php echo htmlspecialchars($postUserpicture); ?>" alt="profilbild">
					<?php } ?>
					<div class="forumpost-author">
						<?php
                                    $postUsername = $postUser["name"];
                                    if (!isset($postUsername) || !is_string($postUsername)) { ?>
						Fehler: Der Name konnte nicht geladen werden.
						<?php } else {
                                        echo htmlspecialchars($postUsername);
                                    }
                        ?></div><?php } ?>
				</div>
				<div class="forumpost-body">
					<div class="forumpost-date"><?php
                            $postDate = $post->getDate();
                            if (!isset($postDate)) { ?>
						Fehler: Das Datum konnte nicht geladen werden.
						<?php } else {
                                echo htmlspecialchars($postDate);
                            }
                        ?></div>
					<div class="forumpost-button">
						<form method="post">
							<?php $postLikeValid = is_array($post->getUserLikeIds()); ?>
							<?php if (isset($_SESSION["loggedUserId"]) && $postLikeValid
										 && htmlspecialchars($post->hasUserLikeId($_SESSION["loggedUserId"]))) { ?>
							<img src="images/icons/herz.png" alt="Herz voll">
							<?php } else { ?>
							<img src="images/icons/herz-leer.png" alt="Herz leer">
							<?php } ?>
						</form>
                        <?php if (isset($_SESSION["loggedUserId"]) && htmlspecialchars($post->hasUserLikeId($_SESSION["loggedUserId"]))) {
                                    $path = "\"forumpost-likes-true-index\">";
                                }
                                else {
                                    $path = "\"forumpost-likes-false-index\">";
                                } ?>
						<p class= '"<?php echo $path ?>"'> <?php
									$userLikeCount = $post->countUserLikeId();
									$userLikeCount = htmlspecialchars($userLikeCount);
                                    echo $userLikeCount;
                            ?> </p>
					</div>
					<div class="forumpost-message">
						<?php
                                $postMessage = htmlspecialchars($post->getMessage());
                                if (!isset($postMessage) || !is_string($postMessage) || empty($postMessage)) { ?>
						Fehler: Nachricht konnte nicht geladen werden.
						<?php } else {
                                    echo $postMessage;
                                }
                                $postIsEdited = $post->isEdited();
								$postIsEdited = htmlspecialchars($postIsEdited);
                                if (!isset($postIsEdited) || $postIsEdited != 0 && $postIsEdited != 1) { ?>
						<br>
						<div class="forumpost-date-edit">
							Fehler: Es kann nicht festgestellt werden, ob der Kommentar editiert wurde.
						</div>
						<?php } else { ?>
						<?php if ($postIsEdited == 1) { 
                                    $postEditDate = $post->getEditDate();
									$postEditDate = htmlspecialchars($postEditDate);
                                    if (!isset($postEditDate) || !is_string($postEditDate)) {
                                        $postEditDate = "\"Fehler: Das Datum konnte nicht geladen werden.\"";
                                    }
                                    ?><br>
						<div class="forumpost-date-edit">[Zuletzt editiert <?php echo $postEditDate ?>]</div>
						<?php }
								}
                        ?>
					</div>
				</div>
				<?php   } else { ?>
				<div id="homeError">
					<p>
						Es sind noch keine Kommentare vorhanden.
					</p>
				</div>
				<?php } ?>
				<div id="indexForum">
					<div class="index-button">
						<a class="forum button2" href="./forum.php">
							Forum
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="home-info-box" id="ver1">
			<div class="home-info-header">
				<h2 class="box-title">Lernsammlung</h2>
			</div>
			<div class="home-info-body">
				<p>
					Hast du die Tutorials und alle Quizfragen bearbeitet und dennoch Hunger auf mehr Wissen über Schach?
					<br>
					<br>
					Dann könnte unsere Lernsammlung für dich etwas sein.
					In der Lernsammlung haben wir Links von Büchern und anderen Websites hinterlegt,
					die dir weiteres Wissen vermitteln können.
					Schaue auch dort gerne rein.
					<br>
					<br>
					Klicke auf den „Lernsammlung“-Button!
				</p>
				<div class="index-button">
					<a class="lern button2" href="./lernsammlung.php">
						Lernsammlung
					</a>
				</div>
			</div>
		</div>

		<div class="home-info-box" id="ver2">
			<div class="home-info-header">
				<h2 class="box-title">Gruppenordner</h2>
			</div>
			<div class="home-info-body">
				<p>
					Auch unsere Schachfibel-Community möchte dir beim Lernen helfen!
					<br>
					<br>
					In unseren Gruppenordner findest du Lernmaterialien von Nutzer*innen der Schachfibel-Community.
					Die Inhalte kannst du frei herunterladen und nutzen.
					Falls du selbst gute Materialien teilen oder einem Lernmaterial einen Like geben möchtest,
					muss du dafür angemeldet sein.
					<br>
					<br>
					Klicke auf den „Gruppenordner“-Button!
				</p>
				<div class="index-button">
					<a class="grupp button2" href="./gruppenordner.php">
						Gruppenordner
					</a>
				</div>
			</div>
		</div>

		<div class="home-info-box" id="anmelden">
			<div class="home-info-header">
				<h2 class="box-title">
					<?php
                if ($id == 0) { ?>
					Anmelden/Registrieren
					<?php
                } else { ?>
					Account
					<?php 
                }
                ?>
				</h2>
			</div>
			<div class="home-info-body">
				<?php   
                if ($id == 0){ ?>
				<p>
					Wenn du dich im Forum gerne mit anderen Nutzer*Innen austauschen
					oder eigene Lernmaterialien im Gruppenordner teilen möchtest,
					musst du mit einem Account angemeldet sein.
					<br>
					<br>
					Klicke den „Anmelden/Registrieren“-Button und du gelangst zur Anmeldung und Registrierung!
				</p>
				<div class="img-center">
					<img src="images/Download.png" alt="finger">
				</div>
				<?php   } else {
                $user = $SchachfibelDAO->getUser($id); 
          if ($user == null){?>
				<p>Fehler: Nutzer*in konnte nicht geladen werden</p>
				<?php   } else {
          if ($user["name"] == null || $user["image"] == null || $user["name"] == "" || $user["image"] == "") { ?>
				<p>Fehler: Daten der Nutzer*in konnten nicht geladen werden</p>
				<?php } else { ?>
				<figure class="loggedNutzer">
					<div class="img-center">
                        <?php $image = htmlspecialchars($user["image"]); ?>
						<img class="home-user-picture" src="<?php echo $image ?>" alt="profilbild" />
					</div>
					<p>Hallo <?php echo htmlspecialchars($user["name"]) ?>!</p>
				</figure>
				<?php   } 
        } 
        } ?>
				<div id="indexReg">
					<?php
                if ($id == 0) { ?>
					<div class="index-button">
						<a class="reg button2" href="./anmelden.php">
							Anmelden/Registrieren
						</a>
					</div>
					<?php   } else { ?>
					<div class="img-center">
						<img src="images/Download.png" alt="finger">
					</div>
					<div class="index-button">
						<form method="post">
							<button class="button2" type="submit" name="logout" value="Abmelden">
								Abmelden
							</button>
						</form>
					</div>
					<?php    }  ?>
					<?php
                if ($logoutError == true) { ?>
					<div class="fehler">
                        <ul>
						<li>Abmeldung nicht möglich, möglicherweise bist du bereits abgemeldet</li>
                        </ul>
					</div>
					<?php    }  ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include "php/footer.php"; ?>
