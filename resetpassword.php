<?php
session_start();
// user that is not logged in should not have to this page
if(!$_SESSION['user_id']){
    $_SESSION['errors'] = "User is not allowed to view this page";
    header('location: login.php');
}

$errors="";
if(isset($_POST['submit'])){

    // validation for password
    if(empty($_POST['password'])){
        $errors .= "<br>your password is empty";
    }else{
        $password = $_POST['password'];
    }
    
    // validation for email
        $email = $_POST['email'];

    if($errors){
        $_SESSION['errors'] = $errors;
    }else{
        if(isset($_SESSION['user_id'])){
                         // count users in the database
            $usersDB = scandir("database/user");
            $allUsers = count($usersDB);

            // check if user is in the database
            for($i = 1; $i < $allUsers; $i++){
                $User = $usersDB[$i];

                if($User == $email . ".json"){
                    // check user password
                    $userString = file_get_contents("database/user/".$User);

                    $userDetailsObject = json_decode($userString);

                    $userDetailsObject->password = $password;

                    unlink("database/user/" . $User);//file delete,user data delete
                    
                    file_put_contents("database/user/". $email . ".json", json_encode($userDetailsObject));
                    $_SESSION['message'] = "Password Reset is now successful";
                    header("location: login.php");
                    die();
                }
                
            }
            $_SESSION["errors"] ="Reset Password failed";
    
            header("location:login.php");

        }
    }




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
    <div class="container">
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
    <h1>Reset Password</h1>
        <form action="" method="POST">
            <label>Email</label><br>
            <input 
            
                <?php
            if(isset($_SESSION['email'])){
                echo "value=" . $_SESSION['email'];
            }

            ?>
            type="text" name="email"><br>
            <label for="">Enter New Password</label><br>
            <input type="password" name="password" placeholder="enter your password"><br>
            <button type="submit" name="submit">Update password </button>
        </form>
    </div>
</body>
</html>