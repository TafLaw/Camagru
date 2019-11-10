<?php 
    include_once '../../../config/ConnDB.php';
    session_start();
    $conn = connDB();

   if (isset($_POST['submit']))
    {
        if (isset($_SESSION['id']))
        {
            $sqlcol = "SELECT * FROM `profiles`";
            $ind = 0;
            $newEmail = $_POST['email'];
            $id = $_SESSION['id'];
            
            foreach($conn->query($sqlcol) as $row)
            {
                if ($row['email'] == $newEmail)
                {
                    echo '<script>alert("email already in use")</script>';
                    echo '<script>window.location="editUsername.php"</script>';
                    $ind++;
                }
            }
            if ($ind == 0)
            {
                $code = substr(password_hash($newEmail, PASSWORD_DEFAULT), 0, 8);
                $stmt = $conn->prepare("UPDATE profiles SET email = '$newEmail', varified = 0, code = '$code' WHERE id = '$id' LIMIT 1");
                $stmt->bindParam('newEmail', $newEmail,PDO::PARAM_STR);
                $stmt->execute();

                $uid = $_SESSION['id'];
                $message = "Your varification code is $code\n";
                $to = $newEmail;
                $subject = "This is your verification code for Camagru\n";
                $from = 'muzerenganit@gmail.com';
                $body='Your verification Code is '.$code.' Please Click On This link <a href="http://localhost:8080/Camagru/authenticate/login_signup/verify.php?id='.$id.'&code='.$code.'">http://localhost:8080/Camagru/authenticate/login_signup/verify.php?id='.$uid.'&code='.$code.'</a> to activate your account.';
                $headers = "From:".$from."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                if(mail($to,$subject,$body,$headers))
                    header("location: ../../../thankYou.html");
                else
                    echo '<h3 style="color:red;">failed to send email</h3>';
            }
        }
        else
            echo "session not set";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>edit username</title>
        <link rel="stylesheet" href="../../../styles.css">
    </head>
    <body>
        <nav>
            <div class="navBar">
                <button onclick="window.location.href='../../../authenticate/login_signup/logout.php'">log out</button>            
            </div>
        </nav>
        <form action="editEmail.php" method="post">
            <input id = "newUn" type="email" placeholder="Enter new email" name="email" required>
            <input type="submit" name="submit" value="proceed">
        </form>
    </body>
    <footer>
            <hr>
            &copy; <i>tmuzeren 2019</i>
    </footer>
</html>