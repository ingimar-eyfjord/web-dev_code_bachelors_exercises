<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$Current_page?></title>
    <link rel="stylesheet" href="index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <p><?= isset($_SESSION['username']) 
        ?"Signed in as {$_SESSION['username']}"
        :"Not signed in"?>
        </p>
        <?= isset($_SESSION['username']) ? '
        <ul>
            <a href="index.php">
                <li>Home Page</li>
            </a>
            <a href="messages.php">
                <li>Messages</li>
            </a>
            <a href="log_out.php">
                <li>Log out</li>
            </a>'
            : "" ?>



        </ul>
    </nav>