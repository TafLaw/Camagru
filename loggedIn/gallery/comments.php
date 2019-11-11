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
        $comment = htmlspecialchars( $_POST['comment']);
        $dat = date("H:i  d/m/Y");
        $sendTo = "SELECT * FROM images WHERE image = '$img' LIMIT 1";
        $whoComntd = "SELECT * FROM profiles WHERE id = '$user'";

        foreach($conn->query($whoComntd) as $who)
        {
            $commentBy = $who['name'];
        }
        
        foreach($conn->query($sendTo) as $name)
        {
            $uName = $name['user'];
        }
        
        $getEmail = "SELECT * FROM profiles WHERE id = '$uName' LIMIT 1";
        foreach($conn->query($getEmail) as $mail)
        {
            $email = $mail['email'];
            $dent = $mail['id'];
            $person = $mail['name'];
            $notify = $mail['notifications'];
        }
       
        $stmt = $conn->prepare("INSERT INTO `comments`(`user`, `image`, `comment`, `date/time`) VALUES ('$user', '$img', \"$comment\", '$dat')");
        $stmt->execute();
       
        if ($notify && $dent != $id)
        {
            $to = $email;
            $subject = "NOTIFICATION\n";
            $from = 'muzerenganit@gmail.com';
            $body = 'Hi '.$person.', '.$commentBy.' recently commented your picture';
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
?>