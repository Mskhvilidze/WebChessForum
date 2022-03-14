<?php include "php/head.php"; ?>
<?php include "php/header.php"; ?>

<div class="section">
    <header>Anmeldung</header>

    <?php      
            if($id > 0) {
            $_SESSION["token"] = uniqid();
            header("Location: http://localhost/webprogrammierung/index.php");
            } 
 
    $showConfirmError = false;
    /*Wenn loggedUserId nicht existiert, ist der Nutzer ausgeloggt*/
        if ($id == 0) {?>
    <form class="anmeldung-container" method="post">
        <?php
    			if (array_key_exists("loggedUser", $_POST)) {
					if ($getConfirm != null && $getConfirm["confirm"] != 1 && $isConfirmUser) {
			?>
        <?php $uniqkey = $uniqkey["key"]; 
                if ($uniqkey != null) {
                    $showConfirmError = true; ?>
        <div class="login-error">
            <ul>
                <li>
                    Bitte bestätige deinen Account <a href="./test.php?key=<?php echo $uniqkey?>">bestätigen</a>
                </li>
            </ul>
        </div>
        <?php } else { ?>
        <ul>
            <li>
                System Fehler: Account kann man nicht bestätigen!
            </li>
        </ul>
        <?php    } ?>
        <?php }  
        	$user = $SchachfibelDAO->getUser($_SESSION["loggedUserId"]);
        	if ($user == null || $username != $user["name"]) { ?>
        <ul>
            <li>
                Die Anmeldung war nicht erfolgreich
            </li>
            <?php if ($showConfirmError == false) { ?>
            <li>
                Der Nutzername existiert nicht oder das eingegebene Password ist falsch
            </li>
            <?php } ?>
        </ul>
        <?php } else {
				if ($_SESSION["loggedUserId"] !== null) {
					$id = $SchachfibelDAO->getLoggedUser();
					if ($id <= 0) {?>
        <ul>
            <li>
                Die Anmeldung war nicht erfolgreich
            </li>
            <?php if ($showConfirmError == false) { ?>
            <li>
                Der Nutzername existiert nicht oder das eingegebene Password ist falsch
            </li>
            <?php } ?>
        </ul>

        <?php }
            } 
        }
    }?>

        <label for="nutzerName">Nutzername</label>
        <?php $name = (isset($_POST["username"]) && is_string($_POST["username"])) ? $_POST["username"] : "";?>
        <input id="nutzerName" type="text" name="username" placeholder="Nutzername" value="<?php echo $name; ?>" required />
        <label for="password">Password</label>
        <?php $password = (isset($_POST["password"]) && is_string($_POST["password"])) ? $_POST["password"] : "";?>
        <input id="password" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required />
        <input class="button2" type="submit" name="loggedUser" value="Anmelden">
        <a href="./registration.php">Bei Schachfibel registrieren</a>
    </form>
    <?php   
    
    } else { ?>
    <div class="loggedUser">
        <?php
				$userId = $_SESSION["loggedUserId"];
				$user = $SchachfibelDAO->getUser($userId); 
				if ($user == null) { ?>
        <p>Fehler: Nutzer*in konnte nicht geladen werden</p>
        <?php } else {
					if ($user["name"] == null || $user["image"] == null || $user["name"] == "" || $user["image"] == "") {
				?>
        <p>Fehler: Daten der Nutzer*in konnten nicht geladen werden</p>
        <?php } else {  ?>
        <figure class="nutzerBild">
            <div class="img-center">
                <?php $userImage = htmlspecialchars($user["image"]); 
                if($userImage != null) {?>
                <img class="home-user-picture" src="<?php echo $userImage ?>" alt="profilbild" />
            </div>
            <p>Hallo <?php echo htmlspecialchars($user["name"]) ?>!</p>
            <?php } else{ ?>
            System Fehler: Es gibt weder Standardprofilbild noch das vom Nutzer hochgeladene Profilbild!
            <?php    } ?>
        </figure>
    </div>
    <?php } 
    	} 
	} ?>

</div>
<?php include "php/footer.php"; ?>
