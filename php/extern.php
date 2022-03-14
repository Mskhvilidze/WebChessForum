<?php #require "php/FileSchachfibelDAO.php"; ?>
<?php require "php/DBSchachfibelDAOImpl.php"; ?>
<?php require_once "php/Utils.php"; ?>

<?php
    #$SchachfibelDAO = new FileSchachfibelDAO();
    $SchachfibelDAO = new DBSchachfibelDAOImpl();
    

    /* USER TESTING */
/*
    $SchachfibelDAO->registerUser("user1", "user1@user.user", "user", "user", "");
    //$SchachfibelDAO->registerUser("user1", "anon@gmail.com", "password", "password", "");
    //$SchachfibelDAO->registerUser("userfail", "anon@gmail.com", "passwords are", "notequal", "");
    //$SchachfibelDAO->registerUser("userfail", "notaemail", "passwords", "notequal", "");
    //$SchachfibelDAO->registerUser("userfail", "anon@gmail.com", "", "", "");
    $SchachfibelDAO->registerUser("user2", "user2@aol.com", "user", "user", "");
    $SchachfibelDAO->registerUser("user3", "user3@aol.com", "user", "user", "");
    $SchachfibelDAO->registerUser("user4", "user4@aol.com", "user", "user", "");
*/
    /* GRUPPENORDNER TESTING */


    #$SchachfibelDAO->uploadGruppenordnerFile(1, Utils::getCurrentDate(), "images/bild.png", Utils::convertBytesToString(23) , "datei27");
    #$SchachfibelDAO->uploadGruppenordnerFile(1, Utils::getCurrentDate(), "images/bild.png", Utils::convertBytesToString(23) , "datei227");
/*
    $SchachfibelDAO->uploadGruppenordnerFile(0, "01.01.1970", "", "500 MB", "Donaudampfschiffahrtsgesellschaftskapitän.txt");
    $SchachfibelDAO->uploadGruppenordnerFile(1, "06.09.1337", "", "24 kB", "X-Files.png");
    $SchachfibelDAO->uploadGruppenordnerFile(2, "02.02.2020", "", "1 GB", "Zebraschach.zip");
    
    $SchachfibelDAO->likeGruppenordnerFile(2, 0);
    $SchachfibelDAO->likeGruppenordnerFile(0, 1);
    $SchachfibelDAO->likeGruppenordnerFile(0, 1);
    $SchachfibelDAO->likeGruppenordnerFile(0, 0);
    $SchachfibelDAO->likeGruppenordnerFile(2, 3);
    */
?>
