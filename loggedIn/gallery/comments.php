<?php
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    include_once '../../config/ConnDB.php';
    session_start();

    if (!isset($_SESSION['id']))
        header("location: userGallery.php");
    else
    {
        $conn = connDB();
        $id = $_SESSION['id'];
        $user = $_GET['user'];
        $img = $_GET['img'];
        $comment = $_POST['comment'];
        $dat = date("H:i  d/m/Y");
       
        $stmt = $conn->prepare("INSERT INTO `comments`(`user`, `image`, `comment`, `date/time`) VALUES ('$user', '$img', '$comment', '$dat')");
        $stmt->execute();
        header("location: userGallery.php");
    }
?>