<?php 
    class userClass{
        //login
        public function login($usernameEmail, $password)
        {
            try {
                $conn = connDB();
                $passwd = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $stmt = $conn->prepare("SELECT id FROM profiles WHERE (name=:usernameEmail or email=:usernameEmail) AND password=:passwd");
                //protect against sql injection (stored as type char / varchar)
                $stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR);
                $stmt->bindParam("passwd", $passwd,PDO::PARAM_STR);
                $stmt->execute();
                //count rows in stmt
                $rows = $stmt->rowCount();
                //fetch next row and return it as an object
                $data = $stmt->fetch(PDO::FETCH_OBJ);
                if ($rows)
                {
                    $_SESSION['id'] = $data->id;
                    return true;
                }
                else
                    return false;
            } catch (PDOException $e) {
                echo "connection failed".$e->getMessage();
            }
        }

        //validate user info
        public function valid($password)
        {
            $upper = preg_match('@[A-Z]@', $password);
            $lower = preg_match('@[a-z]@', $password);
            $num = preg_match('@[0-9]@', $password);
            $special = preg_match('@[^\w]@', $password);

            if (!$upper || !$lower || !$num || !$special)
                return false;
            return true;
        }
        //register user
        public function register($username, $email, $password)
        {
            try {
                $code = substr(password_hash('$email', PASSWORD_DEFAULT), 0, 8);//verification code
                $dat = date("d F Y");
                $conn = connDB();
                $stmt = $conn->prepare("SELECT id FROM profiles WHERE username=:username OR email=:email");
                $stmt = bindParam("ss", $username, $email);
                $stmt->execute();
                $rows = $stmt->rowCount();
                if ($rows < 1)
                {
                    $stmt = $conn->prepare("INSERT INTO `profiles` (`id`, `name`, `email`, `image`, `password`, `code`, `varified`, `date`) VALUES ('0', '$username', '$email', '', '$password', '$code', '0', '$dat');");
                    $stmt = bindParam("sss", $username, $email, $password);
                    $stmt->execute();

                    //email and verification
                    $id = $conn->lastInsertId();
                    $message = "Your varification code is $code\n";
                    $to = $email;
                    $subject = "This is your verification code for Camagru\n";
                    $from = 'muzerenganit@gmail.com';
                    $body='Your verification Code is '.$code.' Please Click On This link <a href="http://localhost:8080/Camagru/verify.php?id='.$id.'&code='.$code.'">http://localhost:8080/Camagru/verify.php?id='.$uid.'&code='.$code.'</a> to activate your account.';
                    /* $body = "<a href='google.com'>register</a>"; */
                    $headers = "From:".$from."\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                    if(mail($to,$subject,$body,$headers))
                        include("thankYou.html");
                    else
                        echo '<h3 style="color:red;">failed to sent email</h3>';
                    //conn to null
                    $_SESSION['id'] = $id;
                    return true;
                }
                else
                {
                    $conn = NULL;
                    return false;
                }
            } catch (PDOException $e) {
                echo "An error has occured".$e->getMesssage();
            }
        }

        //user details
        function details($id)
        {
            try {
                $conn = connDB();
                $stmt = $conn->prepare("SELECT name, email FROM profile WHERE id='$id'");
                $stmt = bindParam('i', $id);
                $stml->execute();
                $data = $stml->fetch(PDO::FETCH_OBJ); //fetch user data
                return $data;
            } catch (PDOException $e) {
                echo "An error has occured\n".$e->getMessage();
            }
        }
    }
?>