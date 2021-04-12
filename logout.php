<?php  
session_start();

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){

session_unset();

session_destroy();
header("location:login.php");

}
?>