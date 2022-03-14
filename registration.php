<?php include "php/head.php"; ?>
<?php include "php/header.php"; ?>

<div class="section">
	<header>Registration</header>
	<?php
    
        if ($_SESSION["loggedUserId"] !== null) {
        	$id = $SchachfibelDAO->getLoggedUser();
        }
    
        if ($id > 0) { ?>
	<div class="loggedUser">
		<?php   $userId = $_SESSION["loggedUserId"];
				$user = $SchachfibelDAO->getUser($userId);
				if ($user == null) { ?>
		<p>Fehler: Nutzer*in konnte nicht geladen werden</p>
		<?php } else {
							if ($user["name"] == null || $user["image"] == null || $user["name"] == "" || $user["image"] == "") { ?>
		<p>Fehler: Daten der Nutzer*in konnten nicht geladen werden</p>
		<?php } else {  ?>
		<figure class="nutzerBild">
			<div class="img-center">
                <?php $loggedUserImage = htmlspecialchars($user["image"]); 
                if($loggedUserImage != null){ ?>
				<img class="home-user-picture" src="<?php echo $loggedUserImage ?>" alt="profilbild" />
            <?php } else { ?>
                System Fehler: Es gibt weder Standardprofilbild noch das vom Nutzer hochgeladene Profilbild!   
            <?php    } ?>    
			</div>
			<p>Hallo <?php echo htmlspecialchars($user["name"]) ?>!</p>
		</figure>
	</div>
	<?php   } 
        } 
        } else {?>
	<form class="anmeldung-container" method="post" enctype="multipart/form-data">
		<?php
			if (array_key_exists("loggedUser", $_POST)) {
				$username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $passwordRepeat = $_POST["passwordRepeat"];
				$agb = isset($_POST["AGB"]);
				$key = sha1(uniqid());
				$registrationSuccessful = false;
				$file_name = pathinfo($_FILES["files"]["name"], PATHINFO_FILENAME);
                $file_extension = strtolower(pathinfo($_FILES["files"]["name"], PATHINFO_EXTENSION));
                $upload_folder = "php/images/";
				$update_path = $upload_folder . $file_name . "." .$file_extension;
				$registrationSuccessful = true;
				if (!isset($file_name) || !isset($file_extension) || $file_name == "" || $file_extension == "") {
					$update_path = $upload_folder . "standardImage.jpg";
				} else {
					move_uploaded_file($_FILES["files"]["tmp_name"], $update_path);
				}
				if ($registrationSuccessful && !is_dir($upload_folder)) { ?>
		<?php $registrationSuccessful = false; ?>
		Das Bild kann nicht hochgeladen werden
		<?php }
				if ($registrationSuccessful && isset($_FILES["files"]) && $_FILES["files"]["size"] > Utils::MB * 20) { ?>
		<?php $registrationSuccessful = false; ?>
		Das Bild darf nicht größer als 20 MB sein
		<?php }
				if (!$registrationSuccessful) { ?>
		Die Registrierung war nicht erfolgreich
		<?php } else {
					$registrationSuccessful =
						$SchachfibelDAO->registerUser($username, $email, $password, $passwordRepeat, $update_path, $agb, $key);
					if ($registrationSuccessful) { 
        $url = "./test.php" . "?key=" . $key; ?>
        <script>location.href='<?php echo $url?>'</script>
		<a href="./test.php?key=<?php echo $key ?>">Die Registrierung war erfolgreich.
			Um sich anmelden zu können, musst du auf den Link klicken und das Konto bestätigen</a>;
		<?php } else { ?>
		Die Registrierung war nicht erfolgreich
		<?php }
				}
			}
		?>
		<label for="nutzername">Nutzername</label>
		<?php $name = (isset($_POST["username"]) && is_string($_POST["username"])) ? $_POST["username"] : "";?>
		<input id="nutzername" type="text" name="username" onkeyup="showHint(this.value)" placeholder="Nutzername" value="<?php echo $name; ?>" required />
		<div id="ajax"></div>
		<label for="email">E-Mail</label>
		<?php $email = (isset($_POST["email"]) && is_string($_POST["email"])) ? $_POST["email"] : "";?>
		<input id="email" class="input" type="text" name="email" placeholder="E-Mail" value="<?php echo $email;?>" required />
		<label for="password">Password</label>
		<?php $password = (isset($_POST["password"]) && is_string($_POST["password"])) ? $_POST["password"] : "";?>
		<input id="password" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required />
		<div id="password-info">
			<p id="password-lowercase">
				Das Password benötigt mindestens 1 Kleinbuchstaben
			</p>
			<p id="password-uppercase">
				Das Password benötigt mindestens 1 Großbuchstaben
			</p>
			<p id="password-numericvalue">
				Das Password benötigt mindestens 1 Ziffer
			</p>
			<p id="password-length">
				Das Password benötigt mindestens 8 Zeichen
			</p>
            <p id="password-specialSymbol">
				Das Password darf keine Sonderzeichen besitzen
			</p>
		</div>
		<label for="passwordRepeat">Password wiederholen</label>
		<?php $passwordRepeat = (isset($_POST["passwordRepeat"]) && is_string($_POST["passwordRepeat"])) ? $_POST["passwordRepeat"] : ""; ?>
		<input id="passwordRepeat" type="password" name="passwordRepeat" placeholder="Password wiederholen" value="<?php echo $passwordRepeat; ?>" required />
		<div id="password-info-repeat">
			<p id="password-repeat">
				Die Passwörter stimmen nicht überein
			</p>
		</div>
   

        <label class="button2 margin-button" id="gruppenordner-inputlabel" for="file">
            <div class="button-pic font-button">
                Profilbild auswählen
            </div>
        </label>
        <input id="file" type="file" name="files" accept="image/gif,image/jpeg,image/png">

        <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>" />

		<fieldset>
			<legend>Nutzungsbedingungen</legend>
			<?php $agb = (isset($_POST["AGB"]) && is_string($_POST["AGB"])) ? $_POST["AGB"] : "";?>
			<input id="agb" type="checkbox" name="AGB" value="ja"  required />
			<label id="label-agb" for="agb">Mit dem Setzen des Hacken bestätige ich,
				dass ich die <a href="./rechtliches.php#nutzungsbedingungen">Nutzungsbedingungen</a>
				gelesen habe und mit ihnen einverstanden bin.
			</label>
		</fieldset>
		<input class="button2" type="submit" name="loggedUser" value="Registrieren">
		<a href="./anmelden.php">Bei Schachfibel anmelden</a>
	</form>
	<?php } ?>
</div>
<script src="script/registration.js"></script>
<script>
	var my = document.getElementById("nutzername");
	var lowerCaseLetters = /[a-z]/g;
	var upperCaseLetters = /[A-Z]/g;

	function showHint(str) {
		if (typeof str === "undefined" || typeof str !== "string") {
			return;
		}
		if (str.match(lowerCaseLetters) || str.match(upperCaseLetters) ||
			str.value.length >= 4 && str.value.length < 11) {
			var xhttp;
			if (str.length == 0) {
				document.getElementById("ajax").innerHTML = "";
				return;
			}
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("ajax").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "./ajax.php?q=" + encodeURIComponent(str), true);
			xhttp.send();
		}
	}

</script>
<?php include "php/footer.php"; ?>
