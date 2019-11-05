<?php 
    session_start();
    if (isset($_SESSION['id']))
    {
        session_destroy();
        header("location: signin_up.php");

    }
    else
        header("location: signin_up.php");  
?>