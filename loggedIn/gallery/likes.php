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
        $dat = date("H:i  d/m/Y");
        $found = 0;
        $found2 = 0;
        $exist = 0;
        $chk = "SELECT * FROM likes WHERE user = '$user' LIMIT 1";

        foreach ($conn->query($chk) as $rows)
        {
            if ($img == $rows['image'])
                $exist++;
            if ($img == $rows['image'] && $rows['lik'] == 1)
                $found++;
            if ($img == $rows['image'] && $rows['lik'] == 0)
                $found2++;
        }

        if (!$exist)
        {
            $stmt = $conn->prepare("INSERT INTO `likes`(`user`, `image`, `lik`, `date/time`) VALUES ('$user', '$img', '1', '$dat')");
            $stmt->execute();
            header("location: userGallery.php");
        }
        else if ($found)
        {
            $stmt = $conn->prepare("UPDATE `likes` SET lik = 0 LIMIT 1");
            $stmt->execute();
            header("location: userGallery.php");
        }
        else if ($found2)
        {
            $stmt = $conn->prepare("UPDATE `likes` SET lik = 1 LIMIT 1");
            $stmt->execute();
            header("location: userGallery.php");
        }
    }
?>