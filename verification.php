<?php
    include 'user.php';
    include 'ConnDB.php';
    $servername = SERVERNAME;
    $nme = USERNAME;
    $pass = PASSWORD;
    $dbName = DBNAME;
    $obj = new userClass();
    $error = NULL;
    $uerror = NULL;
    
    if (isset($_POST['register']))
    {
        $username = $_POST["name"];
        $rawPassword = $_POST["password"]; 
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $email = $_POST["email"];
        $code = substr(password_hash($email, PASSWORD_DEFAULT), 0, 8);
        $dat = date("d F Y");

        //connect to database
        if (strlen($username) >= 5 && $obj->valid($rawPassword))
        {

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbName", $nme, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sqlcol = "SELECT * FROM `profiles`";
                
                $ind = 0;
                foreach($conn->query($sqlcol) as $row)
                {
                    if ($row['name'] == $username or $row['email'] == $email)
                    {
                        echo '<script>alert("username/Email already in use")</script>';
                        echo '<script>window.location="signup.php"</script>';
                        $ind++;
                    }
                }
                
                if ($ind === 0)
                {
                    $conn->exec("INSERT INTO `profiles` (`id`, `name`, `email`, `image`, `password`, `code`, `varified`, `date`) VALUES ('0', '$username', '$email', '', '$password', '$code', '0', '$dat');");
                
    
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
                        echo '<h3 style="color:red;">failed to send email</h3>';
                }
            }
            catch (PDOException $e) {
                echo "Connection Failed".$e->getMessage();
                die();
            } 
        }
        else
        {
            if (strlen($username) < 5 && $obj->valid($rawPassword))
            {
                $uerror = "username must contain at least 5 characters\n";
                include('signup.php');
            }
            else if (!$obj->valid($rawPassword) && strlen($username) >= 5)
            {
                $error = "password must contain at least 1 uppercase, lowercase, digit, special character\n";
                include('signup.php');
            }
            else if (!$obj->valid($rawPassword) && strlen($username) < 5)
            {
                $error = "password must contain at least 1 uppercase, lowercase, digit, special character\n";
                $uerror = "username must contain at least 5 characters\n";
                include('signup.php');
            }
        }
    }
?>
