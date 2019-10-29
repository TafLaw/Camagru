<?php
    /* $username = $_POST["name"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $nme = "root";
    $pass = "12345";
    $dbName = "camagru";
    $servername = "localhost";

    if (isset($_POST["submit"]))
    {
        if ($_POST["submit"] == "SignUp")
        {
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
                    VALUES ('$username', '$email', '', '$password');"; /
                    
                    $conn->exec("INSERT INTO `profiles` (`name`, `email`, `image`, `password`) VALUES ('$username', '$email', '', '$password');");
                } 
            }
            catch (PDOException $e) {
                echo "Connection Failed".$e->getMessage();
                die();
            }    
        }
    } */
    /* foreach($conn->query($sql) as $row)
    {
        if ($row['name'] == $username)
        {
            echo '<script>alert("username already in use")</script>';
            echo '<script>window.location="signup.php"</script>';
            $ind++;
        }
    }
    if ($ind === 1)
    {
        $sql = "INSERT INTO 'profiles' ('name', 'email', 'image', 'password')
        VALUES ('$username', '$email', '', '$password')";
    }*/
    /* class userDetails{
        protected $user;
        protected $email;
        private $password;

        public function store()
        {
            $this->user = $_POST["name"];
            $this->email = $_POST["email"];
            $this->password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $sql = "INSERT INTO profiles(name, email, image, password)
            VALUES ('$this->user', '$this->email', '', '$this->password')";
        }
    }
    $obj = new userData;
    $obj->store(); */
   /*  class profile extends userData {
        
    } */
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Camagru Login/SignUp</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="login">
            <img id="logo" src="icons/logo.png" alt="logo">
            <h1 class="title">Camagru</h1>
            <form action="verification.php" method="post">
                <input class="input" type="text" minlength="6" title="username must contain at least 5 characters" placeholder="Name" name="name" required><br/>
                <?php echo '<h4 style="color: red; margin-top: -20px;">'.$uerror.'</h4>';?>
                <input class="input" type="text" placeholder="E-mail" name="email" required><br/>
                <input class="input" type="password" minlength="6" pattern="(?=\S*\d)(?=\S*[a-z])(?=\S*[A-Z])\S*" title="password must contain at least 1 uppercase, lowercase, digit, special character" placeholder="Password" name="password" required><br/>
                <input class="input" type="password" minlength="6" pattern="(?=\S*\d)(?=\S*[a-z])(?=\S*[A-Z])\S*" title="password must contain at least 1 uppercase, lowercase, digit, special character" placeholder="Confirm Password" name="conf_pass" required><br/>
                <?php echo '<h4 style="color: red; margin-top: -20px;">'.$error.'</h4>';?>
                <input class="submit" type="submit" name="register" value="SignUp">
            </form>
        </div>
    </body>
</html>