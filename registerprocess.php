<?php

$errors = "";

if(isset($_POST['submit'])){

    // Validation for firstName
    if(empty($_POST['firstName'])){
        $errors .= "<br>your username is empty";
    } elseif (strlen($_POST['firstName']) < 2) {
        $errors .= "First Name cannot be less than 2";
    }else{
        $firstName = $_POST['firstName'];
    }

    // validation for  lastName
    if(empty($_POST['lastName'])){
        $errors .= "<br>your lastname is empty";
    } elseif (strlen($_POST['lastName']) < 2) {
        $errors .= "Last Name cannot be less than 2";
    }else{
        $lastName = $_POST['lastName'];
    }

    // validation for email
    if(empty($_POST['email'])){
        $errors .= "<br>your email is empty ";
        
    }elseif(strlen($_POST['email']) < 5){
        $errors .= "<br>Email must not be less than 5";
    } else{
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors .= "Enter a valid email address";   
        }
    }

    // validation for password
    if(empty($_POST['password'])){
        $errors .= "<br>your password is empty";
    } elseif (strlen($_POST['password']) < 4) {
        $errors .= "password cannot be less than 4";
    }else{
        $password = $_POST['password'];
    }


    if($errors){
        $_SESSION['errors'] = $errors;
    }else{

        // users details 
        $UserId = rand(1,100);
        $userDetails = [
            'id'=> $UserId,
            'firstName'=> $firstName,
            'lastName'=> $lastName,
            'email'=> $email,
            'password' => $password
        ];

        // inserting into json file
        file_put_contents("database/user/" . $userDetails['email'] . ".json", json_encode($userDetails));

        $_SESSION["message"] ="Registration succesful you can now login in Here " . $firstName;

        header('location:login.php');



    }

}

?>