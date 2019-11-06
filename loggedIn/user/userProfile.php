<?php 
    session_start();
    if (!isset($_SESSION['id']))
        header("location: ../../authenticate/login_signup/signin_up.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="../../styles.css">
    </head>
    <body>
        <nav>
            <div class="navBar">
                <button onclick="window.location.href='../../authenticate/login_signup/logout.php'">log out</button>            
                <button onclick="window.location.href='editProfile.php'">Edit profile</button>
            </div>
        </nav>
        <div id="profilepic">

        </div>
        <p>
            <h2 id="pubUsername">USERNAME</h2>
            <div id="pubAbout">
                ABOUT 
                <br>
                bdsbdhsbdbshd<br>udhfwudbfwoudhwouhdvouwho<br>osudhcouhcdouwhofwhdif
            </div>
            <div id="pubBar">
                <ul>
                    <li><a href="#">about</a></li>
                    <li><a href="#">images</a></li>
                    <li><a href="#">more</a></li>
                </ul>
            </div>
        </p>
        <div id="timeline">

        </div>
    </body>
</html>