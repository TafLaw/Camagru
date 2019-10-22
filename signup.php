<?php 
    /* session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($_POST["submit"] == "SignUp")
        echo '<sript>window.location="signup.php"</script>';
    
    else if (isset($username) && isset($password))
    {
        if (!empty($username) && strlen($username) >= 4 && strlen($password) <= 8){
            if (empty($password) or strlen($password) < 5){
                echo "Password must contain 5 or more characters";
            }
            else{
                echo 'SUCCESSFUL!';
            }
        }
        else
            echo "Username must contain 4 to 12 characters";
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
            <form action="signup.php" method="post">
                <input class="input" type="text" placeholder="Name" name="name" required><br/>
                <input class="input" type="text" placeholder="Surname" name="surname" required><br/>
                <input class="input" type="text" placeholder="E-mail" name="email" required><br/>
                <input class="input" type="password" placeholder="Password" name="password" required><br/>
                <input class="input" type="password" placeholder="Confirm Password" name="conf_pass" required><br/>
                <input class="submit" type="submit" name="submit" value="SignUp">
            </form>
        </div>
    </body>
</html>