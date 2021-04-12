<?php
    session_start();
    include("registerprocess.php");
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
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
            echo $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="firstName" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="lastName" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password" placeholder="">
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
        <a href="forgot.php">Forgot password</a>
    </div>
</body>
</html>