<?php
session_start();
$errors="";
if(isset($_POST['submit'])){

     // validation for email
     if(empty($_POST['email'])){
        $errors .= "<br>your email is empty ";
        
    }else{
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors .= "Enter a valid email address";   
        }
    }

    if($errors){
        $_SESSION['errors'] = $errors;
    }else{
       // count users in the database
       $usersDB = scandir("database/user");
       $allUsers = count($usersDB);

       for($i = 1; $i < $allUsers; $i++){
        $user = $usersDB[$i];

        if($user == $email . ".json"){
            $userString = file_get_contents("database/user/" . $user);
            $userDetailsObject = json_decode("$userString");
            $passwordDB =$userDetailsObject->password;
            $UserIdFromDb = $userDetailsObject->id;
            $emailFromDb = $userDetailsObject->email;

            $_SESSION['user_id'] = $UserIdFromDb;
            $_SESSION['email'] = $emailFromDb;
            header('location:resetpassword.php');

        }


       }

       $_SESSION['errors'] ="Your email has not been registered";

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
    ?>
    <h1>Forgot password</h1>
        <form action="" method="POST">
            <label for="">Email</label>
            <input type="email" name="email" placeholder="enter your email">
            <button type="submit" name="submit"> Reset </button>
        </form>
    </div>
</body>
</html>