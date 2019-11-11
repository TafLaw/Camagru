<?php 
    include '../../config/ConnDB.php';
    include '../../config/root.php';

    $email = $_GET['email'];
    $conn = connDB();
    $stmt = "SELECT * FROM profiles WHERE email = '$email' AND varified = 1 LIMIT 1";
    $mailFound = 0;
    $error = NULL;

    if ($_GET['reset'] == 'Reset')
    {
        foreach($conn->query($stmt) as $rows)
        {
            if ($email == $rows['email'])
            {
                $uid = $rows['id'];
                $mailFound++;
            }
        }
        if ($mailFound)
        {
            $root = ROOT;
            $to = $email;
            $subject = "Password Reset\n";
            $from = 'muzerenganit@gmail.com';
            $body='Please Click On This link <a href="http://localhost:8080/'.$root.'/authenticate/login_signup/newpass.php?id='.$uid.'&email='.$email.'" target="_blank">http://localhost:8080/'.$root.'/authenticate/login_signup/newpass.php?id='.$uid.'&email='.$email.'</a> to reset your password.';
            $headers = "From:".$from."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            if(mail($to,$subject,$body,$headers))
                include("../../resetmail.html");
            else
                echo '<h3 style="color:red;">failed to send email</h3>';
        }
        else
        {
            $error = "Email address not found";
            include("forgot_pass.php");
        } 
    }
?>