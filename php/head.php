<!doctype html>
<html lang="de">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="author" content="B-FR_Webprogrammierung">
    <title>Schachfibel</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="./images/logo.ico">
    <link rel=canonical href="https://www.Schachfibel.de">
    <link href="shariff/shariff.complete.css" rel="stylesheet">
</head>

<body>
    <?php require "php/extern.php"; ?>
    <?php
        ini_set("session.use_cookies", 1); // 1 using cookies
        ini_set("session.use_only_cookies", 0);
        ini_set("session.use_trans_sid", 1); // 1 using GET and when cookies are disabled
        session_start();
    ?>
    <div class="gridMain">
