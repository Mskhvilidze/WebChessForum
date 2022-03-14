<?php require "php/DBSchachfibelDAOImpl.php"; ?>

<?php 
if (!isset($SchachfibelDAO)) {
    $SchachfibelDAO = new DBSchachfibelDAOImpl();
}

$user = $SchachfibelDAO->getAllUser();

if ($user != null) {
    for ($i = 0; $i < count($user); $i++) {
        if ($user[$i] == $_GET["q"]) {
            echo "Der Nutzername ist bereits vergeben";
            return;
        }
    }
} else {
    echo "Fehler: Die Nutzernamen können nicht vorab überprüft werden" . "<br>";
}
?>
