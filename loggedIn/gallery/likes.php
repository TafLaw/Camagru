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
        $chk = "SELECT * FROM likes WHERE user = '$user' AND image = '$img' LIMIT 1";
        $sendTo = "SELECT * FROM images WHERE image = '$img' LIMIT 1";
        $whoLiked = "SELECT * FROM profiles WHERE id = '$user'";
        
        foreach($conn->query($whoLiked) as $who)
        {
            $likedBy = $who['name'];
        }

        foreach($conn->query($sendTo) as $name)
        {
            $uName = $name['user'];
        }

        $getEmail = "SELECT * FROM profiles WHERE id = '$uName' LIMIT 1";
        foreach($conn->query($getEmail) as $mail)
        {
            $email = $mail['email'];
            $person = $mail['name'];
            $dent = $mail['id'];
            $notify = $mail['notifications'];
        }

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
            //notify user
            if ($notify && $dent != $id)
            {
                $to = $email;
                $subject = "NOTIFICATION\n";
                $from = 'muzerenganit@gmail.com';
                $body = 'Hi '.$person.', '.$likedBy.' recently liked your picture';
                $headers = "From:".$from."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                if(mail($to,$subject,$body,$headers))
                    header("location: publicGallery.php");
                else
                    echo '<h3 style="color:red;">failed to send email</h3>';
            }
            header("location: publicGallery.php");
        }
        else if ($found)
        {
            $stmt = $conn->prepare("UPDATE `likes` SET lik = 0 WHERE image = '$img' AND user = '$user' LIMIT 1");
            $stmt->execute();
            header("location: publicGallery.php");
        }
        else if ($found2)
        {
            $stmt = $conn->prepare("UPDATE `likes` SET lik = 1 WHERE image = '$img' AND user = '$user' LIMIT 1");
            $stmt->execute();
            if ($notify && $dent != $id)
            {
                $to = $email;
                $subject = "NOTIFICATION\n";
                $from = 'muzerenganit@gmail.com';
                $body = 'Hi '.$uName.', '.$user.' recently liked your picture';
                $headers = "From:".$from."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                if(mail($to,$subject,$body,$headers))
                    header("location: publicGallery.php");
                else
                    echo '<h3 style="color:red;">failed to send email</h3>';
            }
            header("location: publicGallery.php");
        }
    }
?>