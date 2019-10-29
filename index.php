<?php
    include 'ConnDB.php';
    
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $servername = SERVERNAME;
    $nme = USERNAME;
    $pass = PASSWORD;
    $dbName = DBNAME;

    include("install.php");
    
    if (isset($_POST['login']))
    {
        if ($_POST['login'] == "Login")
        {
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbName", $nme, $password);
            }
            catch (PDOException $e) {
                echo "connection failed\n".$e->getMessage();
                exit();
            }
        }
    }

    $row = $conn->exec("SELECT FROM profiles WHERE name = '$username'");
    if ($row)
    {
        if ($row['password'] == $password)
        {
            $_SESSION["loggedIn"] = $username;
            header("location: home.php");
        }
        else{
           echo "incorrect password";
        }

    }
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
            <form action="home.php" method="post">
                <input class="input" type="text" placeholder="Username" name="username"><br/>
                <input class="input" type="password" placeholder="Password" name="password"><br/>
                <input class="submit" type="submit" name="login" value="Login">
                <h4>Or</h4><br/>
                <input class="submit" type="submit" formaction="signup.php" value="SignUp">
            </form>
        </div>
    </body>
</html>
