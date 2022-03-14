<div class="nav" id="nav-jump">
	<a href="./index.php" class="logoname"><img class="logo_nav" src="./images/logo-25px.png" alt="Webseitenlogo" />Schachfibel</a>

	<input type="checkbox" id="menu-icon" class="menu-icon" />
	<label for="menu-icon" class="menu-icon-design not-copyable">&#9776;</label>

	<?php
    if (!isset($SchachfibelDAO)) {
        $SchachfibelDAO = new DBSchachfibelDAOImpl();
    }

    
    $username = "";
    $password = "";

    $uniqkey = "";
    $getConfirm = "";
     
    // only for anmeldung, do login
    /*Wird geprüft, ob Post existiert*/
    if (array_key_exists("loggedUser", $_POST)) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $_SESSION["loggedUserId"] = $SchachfibelDAO->loginUser($username, $password);
        $uniqkey =  $SchachfibelDAO->getUniqid($username);
        $getConfirm = $SchachfibelDAO->getConfirm($username);
        $isConfirmUser = $SchachfibelDAO->isConfirmUser($username, $password);
    }
    
    
    // check logged user
    
    $id = $SchachfibelDAO->getLoggedUser();
    
    $logoutError = false;
    if (array_key_exists("logout", $_POST)) {
        if ($id <= 0 || !isset($_SESSION["loggedUserId"])){ // Ungültige id
            $logoutError = true;
        } else {
            $SchachfibelDAO->logoutUser($id);
            $id = $SchachfibelDAO->getLoggedUser();
			$_SESSION["token"] = null;
        }
    }  
    
    if (!isset($_SESSION["loggedUserId"]) || $id == 0) {
        if ($id == 0) {
            $_SESSION["loggedUserId"] = null;
			$_SESSION["token"] = null;
        } else {
            $_SESSION["loggedUserId"] = $id; 
			$_SESSION["token"] = uniqid();
        }  
    }
    ?>
    
    <ul class="menu-block navUL">
        <li><a href="./tutorial.php">Tutorial</a></li>
        <li><a href="./quiz.php">Quiz</a></li>
        <li><a href="./forum.php">Forum</a></li>
        <li><a href="./lernsammlung.php">Lernsammlung</a></li>
        <li><a href="./gruppenordner.php">Gruppenordner</a></li>
        <li><?php
            if (isset($_SESSION["loggedUserId"])) {
        ?><form method="post">
                <input name="logout" id="logout-menu" type="submit" value="Abmelden">
                <label for="logout-menu" id="logout-menu-design"><a>Abmelden</a></label>
            </form>
            <?php    
        } else {
        ?>
            <a href="./anmelden.php">Anmelden/Registrieren</a>
            <?php
        }
        ?>
        </li>
    </ul>
    
</div>
