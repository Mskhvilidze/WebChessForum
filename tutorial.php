<?php include "php/head.php"; ?>
<?php include "php/header.php"; ?>
<?php include "php/aside.php"; ?>

<div class="section">
	<?php
        if (isset($_POST["figur"]) && !(empty($_POST)) && count($_POST) == 1) {
            $figurs = array("Allgemeine Regeln", "Bauer", "Läufer", "Springer", "Turm", "Dame", "König");
            $quizName = $figurs[$_POST["figur"] - 1];
            
            $figursInEnglish = array("general rules", "pawn", "bishop", "knight", "rook", "queen", "king");
            $picName = $figursInEnglish[$_POST["figur"] - 1];
            
            $whiteFigurAlt = array("Allgemeine Regeln", "weißer Bauer", "weißer Läufer", "weißer Springer", "weißer Turm", "weiße Dame", "weißer König");
            $whitePicAlt = $whiteFigurAlt[$_POST["figur"] - 1];
            
            $blackFigurAlt = array("Allgemeine Regeln", "schwarzer Bauer", "schwarzer Läufer", "schwarzer Springer", "schwarzer Turm", "schwarze Dame", "schwarzer König");
            $blackPicAlt = $blackFigurAlt[$_POST["figur"] - 1];
            
            $whiteFigurTitles = array("Allgemeine Regeln", "Dies ist der weiße Bauer", "Dies ist der weiße Läufer", "Dies ist der weiße Springer", "Dies ist der weiße Turm", "Dies ist die weiße  Dame", "Dies ist der weiße König");
            $whitePicTitle = $whiteFigurTitles[$_POST["figur"] - 1];
            
            $blackFigurTitles = array("Allgemeine Regeln", "Dies ist der schwarze Bauer", "Dies ist der schwarze Läufer", "Dies ist der schwarze Springer", "Dies ist der schwarze Turm", "Dies ist die schwarze  Dame", "Dies ist der schwarze König");
            $blackPicTitle = $blackFigurTitles[$_POST["figur"] - 1];
            
            $whitePicSource = "images/figures/" . $picName . "-white.png";
            $blackPicSource = "images/figures/" . $picName . "-black.png";
            
            $whitePicSourceXl = "images/figures/" . $picName . "-white-" . "xl" . ".png";
            $blackPicSourceXl = "images/figures/" . $picName . "-black-" . "xl" . ".png";
        ?>
	<header><?php echo $quizName ?>-Tutorial</header>
	<div class="infobox">
		<div class="infologo">&#9872;</div>
		<div class="infotext">Hier kannst du interessante Dinge und Regeln rund um die <?php 
            if ($picName !== "general rules") {
                echo "Schachfigur " . $quizName;
            } else {
                echo "allgemeinen Regeln des berühmten Brettspiels Schach";
            }
            ?> lernen.</div>
	</div>
	<?php 
            if ($picName !== "general rules") {
        ?>
	<div id="lightbox">
		<div id="lightbox-content">
			<div id="lightbox-close">&times;</div>
			<div id="lightbox-picture-text"></div>
			<div id="lightbox-picture">
				<a id="lightbox-picture-previous">&#10094;</a>
				<div class="lightbox-picture">
					<img src="<?php echo $whitePicSourceXl; ?>" alt="<?php echo $whitePicAlt; ?>" title="<?php echo $whitePicTitle; ?>">
				</div>
				<div class="lightbox-picture">
					<img src="<?php echo $blackPicSourceXl; ?>" alt="<?php echo $blackPicAlt; ?>" title="<?php echo $blackPicTitle; ?>">
				</div>
				<a id="lightbox-picture-next">&#10095;</a>
			</div>
			<div class="tutorial-pictures">
				<img class="tutorial-picture-1" src="<?php echo $whitePicSource; ?>" alt="<?php echo $whitePicAlt; ?>" title="<?php echo $whitePicTitle; ?>">
				<img class="tutorial-picture-2" src="<?php echo $blackPicSource; ?>" alt="<?php echo $blackPicAlt; ?>" title="<?php echo $blackPicTitle; ?>">
			</div>
		</div>
	</div>
	<div class="tutorial-pictures">
		<img class="tutorial-picture-1" src="<?php echo $whitePicSource; ?>" alt="<?php echo $whitePicAlt; ?>" title="<?php echo $whitePicTitle; ?>">
		<img class="tutorial-picture-2" src="<?php echo $blackPicSource; ?>" alt="<?php echo $blackPicAlt; ?>" title="<?php echo $blackPicTitle; ?>">
	</div>
	<?php
            }
        ?>
	<?php 
            if ($quizName == "Allgemeine Regeln") {
        ?>
	<!-- tutorial text start -->
	<div class="default-text">
		<h4>Dürfen wir vorstellen...</h4>
		<p>
			Es ist eines der berühmtesten und beliebtesten Taktikspielen der Welt. Das Spiel ist bereits seit langem populär, denn es war schon im 13. Jahrhundert in Europa weit verbreitet. Heutzutage hat bestimmt jeder bereits einmal ein Spiel bestritten. Die Rede ist vom Brettspiel Schach.
		</p>
		<br>
		<h4>Vorbereitung</h4>
		<p>
			Damit du das Schachspiel erlernen und spielen kannst, benötigst du ein Schachbrett und die entsprechen Figuren. Zudem solltest du vor deinem ersten richtigen Spiel die Regeln und Figuren zumindest teilweise kennen.
			<br>
			<br>
			Für das Lernen von Schach ohne Vorkenntnisse bist du bei uns richtig.
			Um einen ersten Einblick in alle Regeln zu erhalten,
			schaue dir am besten dieses und danach die weiteren Tutorials der Reihe nach an.
			Zwischendurch oder am Ende eines Tutorials kannst du dein Wissen mit einem passenden Quiz überprüfen.
			Falls du weitere Informationen oder Erklärungen brauchst,
			kannst du gerne in unserer Lernsammlung oder im Gruppenordner vorbeischauen.
			Dort erhälst du von uns oder anderen Nutzer*innen der Schachfibel-Community weitere Materialien.
			Bei Fragen kannst ins Forum gehen und bereits gestellte Fragen und Antworten durchlesen
			oder eigene Fragen stellen, wenn du angemeldet bist.
			Wenn du dich mit den Regeln vertraut gemacht haben,
			dann leg los mit dem Schachspielen!
			Dafür besorgst du dir am besten ein eigenes Schachspiel oder suchst mit deinem Webbrowser eine geeignete Seite im Internet.
			Zum Spielen findest du bei uns leider keine Möglichkeit.
			<br>
			<br>
			Bevor du loslegst zu spielen, brauchst du noch einen Gegner.
			Dieser kann eine weitere Schach-affine Person sein oder eine künstliche Intelligenz am Computer.
		</p>
		<br>
		<h4>Schachbrett</h4>
		<div class="tutorial-board-image">
			<img src="images/figures-field/field.PNG" alt="Leeres Schachbrett">
		</div>
		<p>
			Das Schachbrett besitzt 64 viereckige Felder mit jeweils gleichlangen Seiten. Dabei sind 32 Felder weiß und die anderen 32 schwarz. Angeordnet sind die Felder mit ihren Farben im Karoformat, das heißt, dass weiße und schwarze Felder abwechselnd nebeneinander liegen. Die Ränder des Schachbrettes sind mit Bezeichnungen versehen, die auch für die gegenüberliegende Seite gelten. Horizontal vor dem Spieler werden die Reihen mit den Buchstaben a, b, c, d, e, f, g und h bezeichnet. Vertikal vom Spieler werden die Reihen mit den Nummern 1, 2, 3, 4, 5, 6, 7 und 8 bezeichnet. Die Bezeichnungen erfolgen dabei ausgehend von der linken Ecke der Grundlinie des weißen Spielers, dazu aber gleich mehr.
		</p>
		<br>
		<h4>Schachfiguren</h4>
		<p>
			Gespielt wird mit 32 Schachfiguren, wobei 16 weiß und die anderen 16 schwarz sind.
			Beide Spieler einigen sich, welcher Spieler alle weißen Figuren und welcher alle schwarzen Figuren erhält.
			Für dich bedeutet das, dass du entweder der weiße oder schwarze Spieler bist.
			Die Typen der einzelnen Figuren und deren Vorkommen sind bei beiden Spielern gleich.
			Unter den 16 Figuren befinden sich 8 Bauern, 2 Läufer, 2 Springer, 2 Türme, 1 Dame und 1 König.
			Nähere Informationen zu den Figurentypen erhalten Sie in den dazugehörigen Tutorials.
		</p>
		<br>
		<h4>Aufstellung</h4>
		<p>
			Jeder Spieler besitzt eine Grundlinie, die direkt als erstes vor dem Spieler liegt. Für den weißen Spieler ist das die Reihe 1 und für den schwarzen die Reihe 8. Auf und vor dieser platzieren beide Spieler ihre Figuren auf die festgelegten Startpositionen.
		</p>
		<div class="tutorial-board-image">
			<img src="images/figures-field/position-komplett.PNG" alt="Schachbrett mit Startposition">
		</div>
		<br>
		<h4>Besondere Regeln</h4>
		<p>
			Zur Spielreihenfolge ist zu sagen, dass der weiße Spieler anfängt. Darauf ist der schwarze Spieler dran. Die Reihenfolge der Spieler wechselt sich jeden Zug ab. In einem Zug muss ein Spieler eine seiner Figuren mit einer Bewegungsmöglichkeit so ziehen, wie es die figurenspezifischen Regeln erlauben. Nachdem ein Spieler eine Figur bewegt hat, endet sein Zug.
			<br>
			„Schach“ wird von einem Spieler gesagt, wenn er eine seiner Figuren so platziert hat,
			dass diese den König seines Gegners im nächsten Zug schlagen könnte.
			Der König des Gegners muss in diesen Fall wegziehen.
			Kann er König in einen solchen Fall nicht weggezogen werden und es kann keine andere eigene Figur ihn aus der misslichen Lage befreien,
			so heißt es „Schachmatt“.
			„Schachmatt“ bedeutet, dass ein Spieler mit einer seiner Figuren den gegnerischen König im „Schach“ gestellt hat
			und sich der König nicht mehr innerhalb eines Zuges daraus befreien kann.
		</p>
		<br>
		<h4>Ziel des Spiels</h4>
		<p>
			Das Ziel ist es, dass ein Spieler den anderen Spieler „Schachmatt“ setzt und somit das Spiel gewinnt.
		</p>
	</div>
	<!-- tutorial text end -->

	<div id="button-quiz">
		<div class="infobox">
			<div class="motivation-quiz">
				<p>
					Kennst du dich mit den Regeln der allgemeinen Regeln genau aus?
					<br>
					Wenn ja, dann teste dein Wissen im Allgemeine Regeln-Quiz!
				</p>
			</div>
		</div>
		<form method="post" action="quiz.php">
			<button class="button2" type="submit" name="figur" value="1">
				Starte Allgemeine Regeln-Quiz
			</button>
		</form>
	</div>
	<?php 
            } else if ($quizName == "Bauer") {
        ?>
	<!-- tutorial text start -->
	<div class="default-text">
		<h4>Dürfen wir vorstellen...</h4>
		<p>
			Es ist meist die erste Figur,
			die dem Gegner zum Opfer fällt und eigenen Figuren oft als schützende Mauer dient.
			Die Rede ist vom Bauern.
			Auf dem Schachbrett ist der Bauer zwar der Kleinste und hat in seinen Zug nicht viele Bewegungsmöglichkeiten,
			dennoch ist er nicht zu unterschätzen.
			Denn er ist nicht allein! Gelegentlich kann sogar eine Dame von dem Bauern geschlagen werden.
			<br>
			An dieser Stelle schon mal ein weiterer Tipp: Lasse einen gegnerischen Bauern nicht auf deine Grundlinie ziehen, denn dann erwartet dich vermutlich eine unangenehme Überraschung...
		</p>
		<br>
		<h4>Vorkommen</h4>
		<p>
			Der Bauer ist die am häufigsten vorkommende Figur auf dem Schachbrett. Unter den weißen und schwarzen Figuren befinden sich jeweils 8 Bauern. Somit gibt es insgesamt 16 Bauern.
		</p>
		<br>
		<h4>Startposition</h4>
		<p>
			Die Bauern stehen alle in einer Reihe vor den anderen Figuren. Auf dem Schachbrett befinden sich zum Start die weißen Bauern auf der Reihe 2, also die Felder a2, b2, c2, d2, e2, f2, g2, h2. Die schwarzen Bauern befinden sich auf der Reihe 7, also die Felder a7, b7, c7, d7, e7, f7, g7, h7.
		</p>
		<div class="tutorial-board-image">
			<img class="tutorial-board-image" src="images/figures-field/position-bauer.PNG" alt="Schachbrett mit Bauern">
		</div>
		<br>
		<h4>Bauern bewegen</h4>
		<p>
			Jeder Bauer kann pro Zug nur ein Feld vorwärts ziehen. Zurück dürfen Bauern nicht gezogen werden. Der Bauer darf einmalig zwei Felder vorwärts ziehen, falls er zum ersten Mal gespielt wird. Eine Voraussetzung für das Vorwärtsziehen ist, dass auf dem zu ziehenden Feld keine andere Figur steht. Eine solche Figur kann weder übersprungen noch geschlagen werden.
			<br>
			Schafft es ein Bauer auf die gegnerische Grundlinie, also bei weiß die Reihe 8 und schwarz die Reihe 1, zuziehen, so wird der Bauer verwandelt. Bei der Verwandlung muss der jeweilige Spieler den Bauern durch einen Turm, Läufer, Springer oder einer Dame seiner Farbe ersetzten. Eine solche Verwandlung wird meistens mit dem Erhalt einer neuen oder weiteren Dame durchgeführt, da diese häufig die meisten Spielvorteile liefert. Der Bauer kann nicht in einen König verwandelt werden, da es auf jeder Seite im Spiel nur einen König geben kann, der „Schachmatt“ gesetzt werden kann und das Spiel beendet.
		</p>
		<br>
		<h4>Figuren schlagen</h4>
		<p>
			Ein Bauer kann gegnerische Figuren schlagen und diese somit vom Schachbrett entfernen.
			Diese Möglichkeit besteht für den Bauern nur,
			wenn auf einem diagonal anliegenden vorderen Feld eine gegnerische Figur steht.
			Schlägt der Bauer in einen Zug eine Figur, so wird er auf das Feld der geschlagenen Figur gestellt.
			Alternativ kann ein gegnerischer Bauer geschlagen werden,
			wenn er im vergangen Zug zwei Felder vorwärts gezogen ist und neben dem eigenen Bauern steht.
			Beim Schlagen landet der eigene Bauer dort,
			wo der gegnerische Bauer stehen würde,
			wenn er nur einen Zug vorwärts gemacht hätte.
			Dieser Zug wird dann als „en passant“ bezeichnet.
	</div>
	<!-- tutorial text end -->

	<div id="button-quiz">
		<div class="infobox">
			<div class="motivation-quiz">
				<p>
					Kennst du dich mit den Regeln des Bauern genau aus?
					<br>
					Wenn ja, dann teste dein Wissen im Bauer-Quiz!
				</p>
			</div>
		</div>
		<form method="post" action="quiz.php">
			<button class="button2" type="submit" name="figur" value="2">
				Starte Bauer-Quiz
			</button>
		</form>
	</div>
	<?php
            } elseif ($quizName == "Läufer") {
        ?>
	<!-- tutorial text start -->
	<div class="default-text">
		<h4>Dürfen wir vorstellen...</h4>
		<p>
			Eine der schnellsten Figuren auf dem Feld, der Läufer.
			Ergibt sich eine unmittelbare Lücke,
			dann läuft er los, soweit er kann und will.
			Meist kommt er aus dem Nichts und für gegnerische Figuren bedeutet das oft ihr Ende.
			Seite an Seite startet er einmal neben der Dame und einmal neben dem König ins Spiel.
			Dafür muss er aber hin und wieder ein schützendes Opfer erbringen.
			Der Läufer ähnelt zwar etwas dem Bauern,
			ist aber auf dem Feld deutlich größer und schneller.
			Auf bestimmten Feldern sind Läufer sogar nie zu schnappen...
		</p>
		<br>
		<h4>Vorkommen</h4>
		<p>
			Der Läufer tritt auf beiden Seiten zweimal auf, wodurch es insgesamt 4 Läufer auf dem Schachbrett gibt.
		</p>
		<br>
		<h4>Startposition</h4>
		<p>
			Die Läufer stehen direkt neben der Dame und dem König,
			wobei sich vor ihnen Bauern befinden.
			Auf dem Schachbrett befinden sich zum Start die weißen Läufer auf der Reihe 1 auf den Feldern c1 und f1.
			Die schwarzen Läufer befinden sich auf der Reihe 8 auf den Feldern c8 und f8.
			Die Startfelder der Läufer haben eine besondere Rolle.
			Schaut man sich die Farben der Startfelder an, so ergibt sich,
			dass von beiden Spielern ein Läufer auf einen weißen und der andere auf einem schwarzen Feld stehen.
			Das Besondere bei den Läufern ist,
			dass sie nie auf ein jeweils andersfarbiges Feld ziehen dürfen.
		</p>
		<div class="tutorial-board-image">
			<img src="images/figures-field/position-laeufer.PNG" alt="Schachbrett mit Läufer">
		</div>
		<br>
		<h4>Läufer bewegen</h4>
		<p>
			Jeder Läufer kann wie gesagt nur auf Felder der Farbe ziehen, die die Farbe des Startfeldes haben. Ziehen kann der Läufer diagonal über seine erlaubten Felder und das so lange bis ihn keine andere Figur in die Quere kommt. Das heißt, dass er auf ein beliebig diagonal erreichbares Feld stehen bleiben darf. Es dürfen aber keine anderen Figuren übersprungen werden. Falls alle vier anliegenden diagonalen Felder vom Spielfeldrand oder eigenen Figuren besetzt sind, so kann er sich nicht bewegen, Dieser Fall tritt zum Beispiel bei Spielbeginn ein. Dort ist der Läufer vom Spielfeldrand und zwei Bauern eingeschlossen. Somit kann er im ersten Zug auch nicht gezogen werden. Eine Besonderheit bei den Zügen des Läufers ist, dass er nach vorne und auch zurück in Richtung seiner eigenen Grundlinie ziehen darf.
		</p>
		<br>
		<h4>Figuren schlagen</h4>
		<p>
			Ein Läufer kann sich nur diagonal auf gleichfarbigen Feldern fortbewegen, also kann er auch nur dort gegnerische Figuren schlagen. Diese Möglichkeit besteht für den Läufer, wenn auf seinen diagonal erreichbaren Feldern die nächste Figur eine vom Gegner ist. Ist dies der Fall, kann der Läufer die gegnerische Figur schlagen und somit auf ihr Feld ziehen. Falls eine eigene Figur auf dem Weg steht, so ist das vorherige Feld das maximal erreichbare Feld und dahinterstehende gegnerische Figuren können nicht geschlagen werden. Da die Läufer nur auf Felder ihrer ersten Feldfarbe ziehen und schlagen können, ist es unmöglich, dass der weiße Läufer mit schwarzen Feldern den schwarzen Läufer mit weißen Feldern schlagen kann und andersherum ebenfalls. Dasselbe gilt für den weißen Läufer mit weißen Feldern und den schwarzen Läufer mit schwarzen Feldern.
		</p>
	</div>
	<!-- tutorial text end -->

	<div id="button-quiz">
		<div class="infobox">
			<div class="motivation-quiz">
				<p>
					Kennst du dich mit den Regeln des Läufers genau aus?
					<br>
					Wenn ja, dann teste dein Wissen im Läufer-Quiz!
				</p>
			</div>
		</div>
		<form method="post" action="quiz.php">
			<button class="button2" type="submit" name="figur" value="3">
				Starte Läufer-Quiz
			</button>
		</form>
	</div>
	<?php
                } elseif ($quizName == "Springer") {
                ?>
	<!-- tutorial text start -->
	<div class="default-text">
		<h4>Dürfen wir vorstellen...</h4>
		<p>
			Im Allgemeinen wird er von seiner Wertigkeit dem Läufer gleichgestellt,	
			doch ein besonderes Merkmal bleibt dabei oft vergessen,
			das Springen! Die Rede ist vom Springer.
			Mit einem eleganten Sprung kann er gegnerische Verteidigungen überspringen und auf Felder gelangen,
			die für seine Mitstreiter meist schwierig zu erreichen sind.
			Der Springer hat viele Möglichkeiten seine schönen Sprünge durchzuführen und liebt diese auch.
			Es heißt nicht umsonst, Springer am Rand bringt Schand…
		</p>
		<br>
		<h4>Vorkommen</h4>
		<p>
			Der Springer tritt, wie der Läufer, auf beiden Seiten zweimal auf, wodurch es insgesamt 4 Springer auf dem Schachbrett gibt.
		</p>
		<br>
		<h4>Startposition</h4>
		<p>
			Die Springer stehen direkt zwischen dem Turm und Läufer auf der Grundlinie, wobei sich vor ihnen Bauern befinden. Auf dem Schachbrett befinden sich zum Start die weißen Springer auf der Reihe 1 auf den Feldern b1 und g1. Die schwarzen Springer befinden sich auf der Reihe 8 auf den Feldern b8 und g8.
		</p>
		<div class="tutorial-board-image">
			<img src="images/figures-field/position-springer.PNG" alt="Schachbrett mit Springer">
		</div>
		<br>
		<h4>Springer bewegen</h4>
		<p>
			Nun wird es etwas kompliziert, denn der Springer hat eine einzigartige Bewegung in seinen Zug, die elegant aussieht, die sich aber von denen der anderen Figuren abhebt.
			<br>
			Ausgehend von seinem aktuellen Feld darf der Springer zwei Felder nach vorne, rechts, zurück oder links gehen, nicht diagonal. Anschließend muss er ausgehend von der vorherigen Schrittrichtung ein Feld zu einer beliebigen nicht diagonalen Seite gesetzt werden. Nehmen wir nun ein Beispiel an, dass unser Springer zwei Felder nach vorne soll. Dann muss er, um seine Bewegung zu beenden, noch ein Feld nach links oder rechts ziehen und darf dort abgesetzt werden. Bei dieser Zugvariante nach vorne hat der Springer also zwei mögliche Felder, auf die er ziehen kann. Ähnlich funktionieren die anderen Zugvarianten. Zählt man die erreichbaren Felder des Springers aus allen Zugvarianten zusammen, so kommt man auf maximal 8 mögliche zu ziehende Felder. Falls auf dem Weg zu einem erreichbaren Feld eigene oder gegnerische Figuren stehen, so kann der Springer diese stehen lassen und einfach überspringen. Steht stattdessen bereits eine eigene Figur auf dem gewünschten zu ziehendem Feld, so kann der Springer nicht auf dieses Feld ziehen und braucht ein anderes Feld oder er kann nicht gesetzt werden. Bei gegnerischen Figuren sieht das anders aus, dazu aber gleich mehr. Zu ziehende Felder außerhalb des Schachbrettes sind für den Springer nicht erreichbar. Das heißt, dass ein Springer am Rand automatisch weniger Möglichkeiten zum Ziehen besitzt. Am Rand kann er maximal 4 Felder erreichen. Sprichwörtlich heißt es also nicht umsonst, „Springer am Rand bringt Schand“.
		</p>
		<br>
		<h4>Figuren schlagen</h4>
		<p>
			Wenn du die Bewegung des Springers verstanden hast,
			kannst du leichter verstehen wie der Springer gegnerische Figuren schlagen kann.
			<br>
			Ein Springer kann nicht auf Felder außerhalb des Schachbrettes oder mit einer eigenen Figur ziehen, aber auf ein mit einer gegnerischen Figur! Zieht der Springer auf das Feld einer gegnerischen Figur so wird diese geschlagen und vom Schachbrett entfernt.
		</p>
	</div>
	<!-- tutorial text end -->

	<div id="button-quiz">
		<div class="infobox">
			<div class="motivation-quiz">
				<p>
					Kennst du mit den Regeln des Springers genau aus?
					<br>
					Wenn ja, dann teste dein Wissen im Springer-Quiz!
				</p>
			</div>
		</div>
		<form method="post" action="quiz.php">
			<button class="button2" type="submit" name="figur" value="4">
				Starte Springer-Quiz
			</button>
		</form>
	</div>
	<?php
            } elseif ($quizName == "Turm") {
        ?>
	<!-- tutorial text start -->
	<div class="default-text">
		<h4>Dürfen wir vorstellen...</h4>
		<p>
			Mit festem Stand verweilt er manchmal das ganze Spiel am Rande des Spielfeldes ohne Bewegung.
			Umschlossen von seinen eigenen Mitstreitern muss er zunächst warten bis die Bahn frei ist.
			Tritt dieser Moment aber auf,
			dann walzt er quasi die gegnerischen Figuren um. Die Rede ist vom standfesten Turm.
			Zusammen mit seinem König zeigt der Turm gelegentlich ein schönes Kunstwerk…
		</p>
		<br>
		<h4>Vorkommen</h4>
		<p>
			Der Turm weist, wie der Springer und Läufer, auf beiden Seiten zwei Figuren auf, wodurch es insgesamt 4 Türme auf dem Schachbrett gibt.
		</p>
		<br>
		<h4>Startposition</h4>
		<p>
			In den Ecken sind sie zu finden! Zum Spielbeginn befinden sich die Türme auf ihrer Grundlinie auf den Eckfeldern. Rechts beziehungsweise links neben ihnen ist ein Springer und davor die Bauernreihe. Auf dem Schachbrett befinden sich somit zum Start die weißen Türme auf der Reihe 1 auf den Feldern a1 und h1. Die schwarzen Türme befinden sich auf der Reihe 8 auf den Feldern a8 und h8.
		</p>
		<div class="tutorial-board-image">
			<img src="images/figures-field/position-turm.PNG" alt="Schachbrett mit Bauern">
		</div>
		<br>
		<h4>Türme bewegen</h4>
		<p>
			Diesmal wird es einfacher. Falls der Bauer vor dem Turm oder Springer daneben nicht weggesetzt wurden, dann passiert nichts. Der Turm kann nicht springen und keine schnittigen diagonalen Züge machen, wie der Springer oder der Läufer. Stattdessen kann er nur bei freier Bahn nach vorne, rechts, hinten oder links ziehen. Ist der Weg dabei aber frei, so kann er so weit ziehen wie er will. Spätestens beim Spielfeldrand oder vor anderen Spielfiguren muss er halten.
			<br>
			Eine kunstvolle Bewegung kann der Turm mit seinem König einmalig im Spiel durchführen, aber das nur unter gewissen Voraussetzungen. Wurde der ausgewählte Turm und der eigene König im gesamten Spiel noch nicht bewegt, so können beide Figuren die Bewegung durchführen. Anschließend ist dieser Zug nicht mehr möglich und der jeweils andere Turm kann diesen nicht mehr mit dem König durchführen. Die Rede ist von der unter Schachexperten bekannten Bewegung 0-0 oder auch 0-0-0, oder umgangssprachlich der Rochade. Falls der Turm auf dem a Feld mit seinem König die Bewegung durchführt, so wird bei dem weißen Spieler der Turm auf d1 und der König auf c1 gestellt. Bei dem schwarzen Spieler wird der Turm vom a Feld auf d8 und der König auf c8 gesetzt. Im anderen Fall, falls ein Turm vom h Feld die Rochade antreten soll, so wird der weiße Turm auf f1 und König auf g1 gesetzt. Der schwarze Turm zieht auf f8 und der schwarze König auf g8.
		</p>
		<br>
		<h4>Figuren schlagen</h4>
		<p>
			Das Schlagen ist ebenfalls ganz einfach zu verstehen.
			Falls der Turm auf seinem Weg nicht vor einer eigenen Figur oder dem Rand spätestens stehen bleiben muss,
			kann er die nächsterreichbare gegnerische Figur schlagen und deren Platz einnehmen.
		</p>
	</div>
	<!-- tutorial text end -->

	<div id="button-quiz">
		<div class="infobox">
			<div class="motivation-quiz">
				<p>
					Kennst du dich mit den Regeln des Turms genau aus?
					<br>
					Wenn ja, dann teste dein Wissen im Turm-Quiz!
				</p>
			</div>
		</div>
		<form method="post" action="quiz.php">
			<button class="button2" type="submit" name="figur" value="5">
				Starte Turm-Quiz
			</button>
		</form>
	</div>
	<?php
            } elseif ($quizName == "Dame") {
        ?>
	<!-- tutorial text start -->
	<div class="default-text">
		<h4>Dürfen wir vorstellen...</h4>
		<p>
			Sie ist möglicherweise die schönste Figur auf dem Brett.
			Mit ihrer Größe und Krone ist sie bereits von Weitem zu sehen.
			Doch Vorsicht, sie gilt als die gefährlichste Figur und verursacht meistens viel Schaden.
			Die Rede ist von der Dame!
			Sie kann beinahe alles...
		</p>
		<br>
		<h4>Vorkommen</h4>
		<p>
			Die Dame ist für beide Spieler einzigartig. Das heißt, dass jeder Spieler nur eine Dame zu Beginn des Spiels besitzt!
		</p>
		<br>
		<h4>Startposition</h4>
		<p>
			Umgeben wird die Dame von einem Läufer und der davorstehenden Bauernreihe.
			Neben ihr befindet sich die wichtigste Figur auf dem Feld, der König. Die Dame befindet sich beim weißen und schwarzen Spieler jeweils auf der Grundlinie, wobei die exakten Felder d1 und d8 lauten.
		</p>
		<div class="tutorial-board-image">
			<img src="images/figures-field/position-dame.PNG" alt="Schachbrett mit Dame">
		</div>
		<br>
		<h4>Damen bewegen</h4>
		<p>
			Nachdem du hoffentlich die Regeln des Bauern, Läufers, Springers und Turms bereits kennst,
			können wir dir sagen,
			dass du für das Bewegen der Dame bereits alles weißt!
			<br>
			Die Dame kann alles was ein Turm und Läufer können.
			Das macht sie fast zur Alleskönnerin,
			da ihr nur die Fortbewegungsmöglichkeit eines Springers fehlt.
			Sie kann also keine anderen Figuren überspringen.
			Genau wie beim Turm und Läufer kann die Dame so lange entsprechend ziehen,
			bis ihr eine andere Figur oder der Spielfeldrand entgegenkommen,
			dann muss sie spätestens stehen bleiben. Anders als bei den Läufern,
			ist die Dame bei diagonalen Zügen nicht von der Feldfarbe abhängig.
			Steht sie auf einem weißen Feld kann sie über weiße Felder diagonal ziehen.
			Steht sie auf einem schwarzen Feld kann sie über schwarze Felder diagonal ziehen.
		</p>
		<br>
		<h4>Figuren schlagen</h4>
		<p>
			Das Schlagen ist wie die Bewegung äquivalent zu den Schlagmöglichkeiten des Turms und Läufers.
			Falls du die Schlagtechniken dieser Figuren bereits gut beherrscht,
			dann kennst du nun auch die der Dame.
			Ansonsten schaust du gerne nochmal in die jeweiligen Tutorials hinein.
		</p>
	</div>
	<!-- tutorial text end -->

	<div id="button-quiz">
		<div class="infobox">
			<div class="motivation-quiz">
				<p>
					Kennst du dich mit den Regeln der Dame genau aus?
					<br>
					Wenn ja, dann testen dein Wissen im Dame-Quiz!
				</p>
			</div>
		</div>
		<form method="post" action="quiz.php">
			<button class="button2" type="submit" name="figur" value="6">
				Starte Dame-Quiz
			</button>
		</form>
	</div>
	<?php
            } elseif ($quizName == "König") {
        ?>
	<!-- tutorial text start -->
	<div class="default-text">
		<h4>Dürfen wir vorstellen...</h4>
		<p>
			Ohne ihn bräuchte sich keine andere Figur auf das Brett zum großen Showdown zu begeben.
			Er gibt maßgeblich die Taktik vor,
			in der Fehler meistens durch Opferungen seiner eigenen Leute beglichen werden.
			Selbst die starke und beliebte Dame ist sich im Fall der Fälle kein Opfer zu schade
			und würde es jederzeit durchziehen.
			Falls aber doch gelegentlich bei Fehlern eine Opferung anderer Figuren nicht mehr möglich ist
			und kein Ausweg mehr in Sicht ist,
			dann heißt es für ihn und seinen Spieler „Schachmatt“.
			Die Rede kann nur von der wichtigsten Figur im ganzen Schachuniversum sein, dem KÖNIG.
		</p>
		<br>
		<h4>Vorkommen</h4>
		<p>
			Einzigartiger wie die Dame geht es nicht, weshalb der König ebenfalls für beide Spieler einzigartig ist. Daher besitzt jeder Spieler logischerweise zum Start einen König. Im Laufe des Spiels kann kein weiterer König durch einen Bauern umgewandelt werden. Das heißt, wenn er weg ist er weg, es ist „Schachmatt“ und du hast verloren.
		</p>
		<br>
		<h4>Startposition</h4>
		<p>
			Um ihn herum bildet sich die komplette Ordnung seiner zugehörigen Figuren, nur mit dem Ziel, ihn zu schützen und den Sieg für ihn einzufahren. Treu zu seiner Seite stehen ihm natürlich seine starke Dame auf d1 oder d8 und ein schneller Läufer auf f1 oder f8. Vor ihm und seiner Dame steht die Bauernreihe zentriert in Formation. Der König befindet sich zu Beginn des Spiels beim weißen Spieler auf dem Feld e1 und beim schwarzen Spieler auf dem Feld e8.
		</p>
		<div class="tutorial-board-image">
			<img src="images/figures-field/position-koenig.PNG" alt="Schachbrett mit König">
		</div>
		<br>
		<h4>Könige bewegen</h4>
		<p>
			Der Ruf des Königs und seine wichtige Rolle lassen ihn hoch in den Himmel steigen, doch seine Bewegungen sind eher unspektakulär
			Einige sagen er ist in Sachen Bewegung eine der unattraktivsten Figuren überhaupt. Andere meinen, dass er durch sein elegantes Schreiten seinen 
			Einfluss demonstriert. Wir sagen Ihnen einfach, wie er sich bewegt!
			<br>
			Der König kann von seiner aktuellen Position, wie die Dame,
			in alle Richtungen ziehen, also vorwärts, nach rechts, rückwärts, nach links und diagonal.
			Dabei kann er natürlich auch nur dahinziehen, wo noch keine andere Figur oder der Spielfeldrand ist.
			Anders als die Dame, darf der König in jede Richtung maximal ein Feld ziehen.
			Wichtig bei seinen möglichen Zügen ist,
			dass diese nicht im nächsten Zug des Gegners zu den Angriffsfeldern einer Figur gehören.
			In diesem Fall fällt die Möglichkeit des Ziehens dorthin für den König weg.
		</p>
		<br>
		<h4>Figuren schlagen</h4>
		<p>
			Der König kann eine gegnerische Figur schlagen, wenn diese in seinem Bewegungsradius steht. Ist dies der Fall, dann zieht der König auf das Feld der geschlagenen Figur. Eine gegnerische Figur darf nur geschlagen werden, wenn das Feld der geschlagenen Figur im nächsten Zug des Gegners kein Angriffsfeld einer anderen gegnerischen Figur ist.
			<br>
			Eine Anmerkung zu der Rochade, also dem speziellen Spielzug mit einem Turm, ist, dass diese nur erfolgen kann, wenn der König und der ausgewählte Turm mit ihren aktuellen Feldern so wie die Felder zwischen den beiden Figuren, keine Angriffsfelder gegnerischer Figuren sind.
			<br>
			Für alle anderen zugehörigen Figuren des Königs gilt,
			wenn sie das aktuelle Feld des Königs vor einen bei Wegziehen entstehenden Angriffsfeld schützen,
			so dürfen diese so lange nicht weggesetzt werden,
			bis der König das Feld verlassen hat und außer Gefahr ist.

		</p>
	</div>
	<!-- tutorial text end -->

	<div id="button-quiz">
		<div class="infobox">
			<div class="motivation-quiz">
				<p>
					Kennst du dich mit den Regeln des Königs genau aus?
					<br>
					Wenn ja, dann teste dein Wissen im König-Quiz!
				</p>
			</div>
		</div>
		<form method="post" action="quiz.php">
			<button class="button2" type="submit" name="figur" value="7">
				Starte König-Quiz
			</button>
		</form>
	</div>
	<?php
            } 
        ?>
    <script src="script/tutorial.js" async></script>
	<?php
        } else {
        ?>

	<header>Noch keine Figur ausgewählt!</header>

	<div class="infobox">
		<div class="infologo">&#9872;</div>
		<div class="infotext">Bitte wähle in der linken Menüleiste eine Figur oder die allgemeinen Regeln aus, um etwas zu lernen. Zum Ende eines jeden Tutorials kannst du über einen entsprechenden Quizbutton ein Quiz zur Selbstkontrolle starten.</div>
	</div>
	<?php
        }
        ?>
</div>

<?php include "php/footer.php"; ?>
