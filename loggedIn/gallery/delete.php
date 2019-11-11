<?php 
    include_once '../../config/ConnDB.php';
    session_start();
    $conn = connDB();

    if (!$_SESSION['id'])
        header('location: ../../authenticate/login_signup/signin_up.php');
    else {
        $user = $_GET['user'];
        $img = $_GET['img'];
        $del = $conn->prepare("DELETE FROM `images` WHERE user = '$user' AND image = '$img'");
        $del->execute();
        $delLike = $conn->prepare("DELETE FROM `likes` WHERE image = '$img'");
        $delLike->execute();
        $delComment = $conn->prepare("DELETE FROM `comments` WHERE image = '$img'");
        $delComment->execute();
        header("location: userGallery.php");
    }
?>