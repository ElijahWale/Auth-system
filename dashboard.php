<?php
session_start();
if(!isset($_SESSION['loggedIn'])){
    header('location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome Onboard <?=  $_SESSION['firstName']; ?></h1>

    <a href="logout.php">Logout</a>
</body>
</html>