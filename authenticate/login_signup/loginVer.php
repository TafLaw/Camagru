<?php
   /*  include 'ConnDB.php'; --> */
    include 'user.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $obj = new userClass();
    $error = NULL;

    if (isset($_POST['login']))
    {
        if($obj->login($username, $password))
        {
            header("location: ../../loggedIn/user/userProfile.html");
        }
        else
        {
            $error = "Incorrect Username or Password";
            include('login.php');
        }

    }
?>