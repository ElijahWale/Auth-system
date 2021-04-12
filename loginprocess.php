<?php

$errors = "";
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

    // validation for password
    if(empty($_POST['password'])){
        $errors .= "<br>your password is empty";
    }else{
        $password = $_POST['password'];
    }


    if($errors){
        $_SESSION['errors'] = $errors;
    }else{
        // count users in the database
        $usersDB = scandir("database/user");
        $allUsers = count($usersDB);

        // check if user is in the database
        for($i = 1; $i < $allUsers; $i++){
            $user = $usersDB[$i];
            

            if($user == $email . ".json"){
                $userString = file_get_contents("database/user/" . $user);
                $userDetailsObject = json_decode("$userString");
                $passwordDB =$userDetailsObject->password;

                if($passwordDB == $password){
                    $_SESSION['loggedIn'] = $userDetailsObject->id;
                    $_SESSION['email'] = $userDetailsObject->email;
                    $_SESSION['firstName'] = $userDetailsObject->firstName;
                    $_SESSION['lastName'] = $userDetailsObject->lastName;

                    header("location: dashboard.php");
                    die();
                }
            }
        }
        $_SESSION['errors'] = "Incorrect login credentials";



    }
}