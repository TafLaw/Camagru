<?php
    $servername = "localhost";
    $nme = "root";
    $pass = "12345";
    $dbName = "Camagru";
    
    if (isset($_POST['register']))
    {
        $username = $_POST["name"];
        $password = hash('whirlpool', $_POST["password"]);
        $email = $_POST["email"];
        $code = substr($password, 0, 8);
        $dat = date("d F Y");

        //connect to database
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbName", $nme, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlcol = "SELECT * FROM `profiles`";

            $ind = 0;
            foreach($conn->query($sqlcol) as $row)
            {
                if ($row['name'] == $username)
                {
                    echo '<script>alert("username already in use")</script>';
                    echo '<script>window.location="signup.php"</script>';
                    $ind++;
                }
            }
            
            if ($ind === 0)
            {
                /* $sql = "INSERT INTO 'profiles' (name, email, image, password)
                VALUES ('$username', '$email', '', '$password');"; */
                
                $conn->exec("INSERT INTO `profiles` (`id`, `name`, `email`, `image`, `password`, `code`, `varified`, `date`) VALUES ('0', '$username', '$email', '', '$password', '$code', '0', '$dat');");
            }

            $uid = $conn->lastInsertId();
            $message = "Your varification code is $code\n";
            $to = $email;
            $subject = "This is your verification code for Camagru\n";
            $from = 'muzerenganit@gmail.com';
            $body='Your verification Code is '.$code.' Please Click On This link <a href="http://localhost:8080/Camagru/verify.php?id='.$uid.'&code='.$code.'">http://localhost:8080/Camagru/verify.php?id='.$uid.'&code='.$code.'</a> to activate your account.';
            /* $body = "<a href='google.com'>register</a>"; */
            $headers = "From:".$from."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            if(mail($to,$subject,$body,$headers))
                include("thankYou.html");
            else
                echo '<h3 style="color:red;">failed to sent email</h3>';
        }
        catch (PDOException $e) {
            echo "Connection Failed".$e->getMessage();
            die();
        } 
    }
?>
