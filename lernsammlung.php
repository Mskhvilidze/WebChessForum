<?php include "php/head.php"; ?>
<?php include "php/header.php"; ?>

<div class="section">
	<header>Lernsammlung</header>

	<div class="infobox">
		<div class="infologo">&#9872;</div>
		<div class="infotext">Hier sind von den Ersteller*innen von Schachfibel empfohlene Bücher, Webseiten und Videos aufgelistet.
			Mithilfe der Materialien kann im Selbststudium der eigene Wissenshorizont über Schach erweitert werden.</div>
	</div>

	<h3 class="lernsammlung-chapter">Bücher</h3>
	<div class="grid-lernsammlung">
		<?php
			$description = "Zum Buch bei Amazon";
		?>
		<div class="flex-container">
			<?php
				$link = "https://www.amazon.de/Schach-f%C3%BCr-Einsteiger-Stufe-Erfolg/dp/3625177730";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/schach_fuer_einsteiger.jpeg" alt="Buchcover von Schach für Einsteiger: Stufe für Stufe zum Erfolg">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-title">Schach für Einsteiger: Stufe für Stufe zum Erfolg</div>
				<div class="lernsammlung-material-author">Lars Günther</div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description; ?>
				</a>
			</div>
		</div>
		<div class="flex-container">
			<?php
				$link = "https://www.amazon.de/Silmans-Endspielkurs-Vom-Anf%C3%A4nger-Meister/dp/9056912763";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/silmans_endspielkurs.jpg" alt="Buchcover von Silmans Endspielkurs: Vom Anfänger zum Meister">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-title">Silmans Endspielkurs: Vom Anfänger zum Meister</div>
				<div class="lernsammlung-material-author">Jeremy Silman</div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description; ?>
				</a>
			</div>
		</div>
		<div class="flex-container">
			<?php
				$link = "https://www.amazon.de/Urteil-Plan-Schach-Max-Euwe/dp/3940417858";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/urteil_und_plan.jpg" alt="Buchcover von Urteil und Plan im Schach">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-title">Urteil und Plan im Schach</div>
				<div class="lernsammlung-material-author">Max Euwe</div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description; ?>
				</a>
			</div>
		</div>
		<div class="flex-container">
			<?php
				$link = "https://www.amazon.de/Einf%C3%A4lle-Reinf%C3%A4lle-Schach-Lesen-Lernen/dp/3111120597";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/einfaelle_reinfaelle.jpg" alt="Buchcover von Einfälle, Reinfälle: Schach zum Lesen und Lernens">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-title">Einfälle, Reinfälle: Schach zum Lesen und Lernens</div>
				<div class="lernsammlung-material-author">Kurt Richter</div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description; ?>
				</a>
			</div>
		</div>
		<div class="flex-container">
			<?php
				$link = "https://www.amazon.de/Schach-lebensl%C3%A4nglich-Erinnerungen-eines-Erfolgstrainers/dp/3940417823";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/schach_lebenslaenglich.jpg" alt="Buchcover von Schach lebenslänglich: Die Erinnerungen eines Erfolgstrainers">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-title">Schach lebenslänglich: Die Erinnerungen eines Erfolgstrainers</div>
				<div class="lernsammlung-material-author">Alexander Koblenz</div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description; ?>
				</a>
			</div>
		</div>
		<div class="flex-container">
			<?php
				$link = "https://www.amazon.com/Psychotricks-Schachprofis-German-Gerhard-Kubik/dp/3743191059";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/die-psychotricks-der-schachprofis.jpg" alt="Buchcover von Die Psychotricks der Schachprofis">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-title">Die Psychotricks der Schachprofis</div>
				<div class="lernsammlung-material-author">Gerhard Kubik</div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description; ?>
				</a>
			</div>
		</div>
	</div>

	<h3 class="lernsammlung-chapter">Webseiten</h3>
	<div class="grid-lernsammlung">
		<?php
			$description = "Kostenlos Schach spielen auf";
			$description2 = "Zur Webseite";
		?>
		<div class="flex-container">
			<?php
				$link = "https://www.chess.com";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/chesscom.png" alt="Logo von Chess.com">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-description"><?php echo $description; ?></div>
				<div class="lernsammlung-material-title"><?php echo $link; ?></div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description2; ?>
				</a>
			</div>
		</div>
		<div class="flex-container">
			<?php
				$link = "https://chess.org/";
			?>
			<div class="flex-item-one">
				<div class="lernsammlung-material-description"><?php echo $description; ?></div>
				<div class="lernsammlung-material-title"><?php echo $link; ?></div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description2; ?>
				</a>
			</div>
		</div>
		<div class="flex-container">
			<?php
				$link = "https://lichess.org/";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/lichess.png" alt="Logo von Lichess">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-description"><?php echo $description; ?></div>
				<div class="lernsammlung-material-title"><?php echo $link; ?></div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description2; ?>
				</a>
			</div>
		</div>
	</div>

	<h3 class="lernsammlung-chapter">Videos</h3>
	<div class="grid-lernsammlung">
		<?php
			$description = "YouTube Video";
			$description2 = "Zum Video auf YouTube";
		?>
		<div class="flex-container">
			<?php
				$link = "https://www.youtube.com/watch?v=y6vQRcp0w40";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/youtube.png" alt="YouTube Logo">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-description"><?php echo $description; ?></div>
				<div class="lernsammlung-material-title">SCHACH LERNEN: Das einzige Video, das du brauchst</div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description2; ?>
				</a>
			</div>
		</div>
		<div class="flex-container">
			<?php
				$link = "https://www.youtube.com/watch?v=2VBO6BrMR8U";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/youtube.png" alt="YouTube Logo">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-description"><?php echo $description; ?></div>
				<div class="lernsammlung-material-title">Vermeide DIESE typischen Anfängerfehler || Einsteiger-Kurs "Schach für Gewinner"</div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description2; ?>
				</a>
			</div>
		</div>
		<div class="flex-container">
			<?php
				$link = "https://www.youtube.com/watch?v=YzSgLjmEV4c";
			?>
			<div class="flex-item-two">
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<img class="img-lernsammlung" src="images/lernsammlung/youtube.png" alt="YouTube Logo">
				</a>
			</div>
			<div class="flex-item-one">
				<div class="lernsammlung-material-description"><?php echo $description; ?></div>
				<div class="lernsammlung-material-title">Die GOLDENEN Eröffnungsregeln || Wie man eine Schachpartie eröffnet</div>
				<a class="lernsammlung-material-link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
					<?php echo $description2; ?>
				</a>
			</div>
		</div>
	</div>
</div>

<?php include "php/footer.php"; ?>
