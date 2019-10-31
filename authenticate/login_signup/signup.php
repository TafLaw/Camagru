
<!DOCTYPE html>
<html>
    <head>
        <title>Camagru Login/SignUp</title>
        <link rel="stylesheet" href="../../styles.css">
    </head>
    <body>
        <nav>
            <div class="navBar">

            </div>
        </nav>
        <div class="login">
            <img id="logo" src="../../icons/logo.png" alt="logo">
            <h1 class="title">Camagru</h1>
            <form action="verification.php" method="post">
                <input class="input" type="text" minlength="5" title="username must contain at least 5 characters" placeholder="Name" name="name" required><br/>
                <?php echo '<h4 style="color: red; margin-top: -20px;">'.$uerror.'</h4>';?>
                <input class="input" type="text" placeholder="E-mail" name="email" required><br/>
                <input class="input" type="password" minlength="6" pattern="(?=\S*\d)(?=\S*[a-z])(?=\S*[A-Z])\S*" title="password must contain at least 1 uppercase, lowercase, digit, special character" placeholder="Password" name="password" required><br/>
                <input class="input" type="password" minlength="6" pattern="(?=\S*\d)(?=\S*[a-z])(?=\S*[A-Z])\S*" title="password must contain at least 1 uppercase, lowercase, digit, special character" placeholder="Confirm Password" name="conf_pass" required><br/>
                <?php echo '<h4 style="color: red; margin-top: -20px;">'.$error.'</h4>';?>
                <?php echo '<h4 style="color: red; margin-top: -20px;">'.$perror.'</h4>';?>
                <input class="submit" type="submit" name="register" value="SignUp">
            </form>
        </div>
    </body>
</html>