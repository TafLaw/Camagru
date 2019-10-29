<?php 
    include 'ConnDB.php';

    $email = $_GET['email'];
    $conn = connDB();
    $stmt = exec("SELECT * FROM profiles WHERE email = '$email' AND varified = 1 LIMIT 1");
    $mailFound = 0;

    foreach($stml as $rows)
    {
        $uid = $rows['id'];
        if ($email === $rows['email'])
            $mailFound++;
    }
    if ($mailFound)
    {
        $to = $email;
        $subject = "Password Reset\n";
        $from = 'muzerenganit@gmail.com';
        $body='Please Click On This link <a href="http://localhost:8080/Camagru/reset_pass.php?id='.$uid.'&email='.$email.'">http://localhost:8080/Camagru/reset_pass.php?id='.$uid.'&code='.$code.'</a> to reset your password.';
        $headers = "From:".$from."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        if(mail($to,$subject,$body,$headers))
            include("thankYou.html");
        else
            echo '<h3 style="color:red;">failed to send email</h3>';
    }
?>