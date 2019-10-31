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
            <form action="loginVer.php" method="post">
                <input class="input" type="text" placeholder="Username" name="username"><br/>
                <input class="input" type="password" placeholder="Password" name="password"><br/>
                <input class="submit" type="submit" name="login" value="Login">
                <p id="forgotPW"><a href="forgot_pass.php">forgot password?</a></p>
                <h4>Or</h4><br/>
                <input class="submit" type="submit" formaction="signup.php" value="SignUp">
            </form>
        </div>
    </body>
</html>
