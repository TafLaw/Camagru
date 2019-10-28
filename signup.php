<?php
    /* $username = $_POST["name"];
    $password = hash('whirlpool', $_POST["password"]);
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
            $this->password = hash('whirlpool', $_POST["password"]);

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
                <input class="input" type="text" placeholder="Name" name="name" required><br/>
                <!-- <input class="input" type="text" placeholder="Surname" name="surname" required><br/> -->
                <input class="input" type="text" placeholder="E-mail" name="email" required><br/>
                <input class="input" type="password" placeholder="Password" name="password" required><br/>
                <input class="input" type="password" placeholder="Confirm Password" name="conf_pass" required><br/>
                <input class="submit" type="submit" name="register" value="SignUp">
            </form>
        </div>
    </body>
</html>