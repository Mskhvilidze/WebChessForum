<?php require "php/DBSchachfibelDAOImpl.php"; ?>
<!doctype html>

<body>
	<form method="post">
		<?php 
if (!isset($SchachfibelDAO)) {
    $SchachfibelDAO = new DBSchachfibelDAOImpl();
}
?>

		<?php
$key = "";    
    
if (array_key_exists("key", $_GET)) {
    if(isset($_GET["key"])){
        $key = $_GET["key"];
        if (!array_key_exists("btn", $_POST)) {?>
		<p id="p">
			Bitte ignoriere die Email, wenn du es nicht warst,
			der sich versucht hat zu registrieren.
			Ansonsten klicke auf folgenden Link, um die Registrierung abzuschließen:
			<input type="submit" value="Bei Schachfibel registrieren" name="btn" />
		</p>

		<?php }
    }
} ?>


		<?php    
if (array_key_exists("btn", $_POST)) {
    if(isset($_POST['btn'])){
        if($SchachfibelDAO->isConfirm($key)){?>
		<p id="p">
			Du hast dich erfolgreich registriert. Klicke
			<a href="./anmelden.php">hier</a>
			um zur Anmeldung zu gelangen
		</p>
		<?php
        } else {?>
		<p id="p">
			isConfirm falsch
		</p>
		<?php
        } 
    }  else {?>
		<p id="p">
			post nicht isset
		</p>
		<?php
    }
}?>

	</form>
</body>
