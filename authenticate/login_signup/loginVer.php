<?php
   /*  include 'ConnDB.php'; --> */
    session_start();
    include 'user.php';
    
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];
    $obj = new userClass();
    $error = NULL;

    if (isset($_POST['login']))
    {
        if ($obj->verified($username))
        {
            if($obj->login($username, $password) && isset($_SESSION['id']))
            {
                header("location: ../../loggedIn/gallery/publicGallery.php");
            }
            else
            {
                $error = "Incorrect Username or Password";
                include('login.php');
            }
        }
        else
        {
            $error = "email not verified or username not found";
            include('login.php');// add a page or button to verify email
        }
    }
?>