<?php
    $nme = "root";
    $pass = "81483465law";
    $dbName = "Camagru";
    $servername = "localhost";

    if (isset($_POST["submit"]))
    {
        if ($_POST["submit"] == "Sign Up")
        {
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbName", $nme, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection Failed".$e->getMessage();
            }    
        }
    }
    class userDetails(
        protected 
    )
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
            <form action="signup.php" method="post">
                <input class="input" type="text" placeholder="Name" name="name" required><br/>
                <!-- <input class="input" type="text" placeholder="Surname" name="surname" required><br/> -->
                <input class="input" type="text" placeholder="E-mail" name="email" required><br/>
                <input class="input" type="password" placeholder="Password" name="password" required><br/>
                <input class="input" type="password" placeholder="Confirm Password" name="conf_pass" required><br/>
                <input class="submit" type="submit" name="submit" value="SignUp">
            </form>
        </div>
    </body>
</html>