<?php
   /*  include 'ConnDB.php'; --> */
    session_start();
    include 'user.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $obj = new userClass();
    $error = NULL;

    if (isset($_POST['login']))
    {
        if($obj->login($username, $password) && isset($_SESSION['id']))
        {
            header("location: ../../loggedIn/user/userProfile.php");
        }
        else
        {
            $error = "Incorrect Username or Password";
            include('login.php');
        }

    }
?>