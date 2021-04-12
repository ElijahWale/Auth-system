<?php
    session_start();
    include_once("loginprocess.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h1>Register Page</h1>
        <?php 
        // error message
        if(isset($_SESSION['errors'])){
            echo $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        // success message
        if(isset($_SESSION["message"])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="">Email:</label>
                <input type="text" name="email" placeholder="enter your email">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password" placeholder="enter your password">
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>
</html>