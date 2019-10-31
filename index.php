<?php
    include 'connect/ConnDB.php';
    $servername = SERVERNAME;
    $nme = USERNAME;
    $pass = PASSWORD;
    $dbName = DBNAME;
    include("connect/config.php");
?>
<?php 
    echo '<h1 style="color: skyblue">This is the home page\n</h1>';
    echo '<button style="background-color: #7750bb; color:white; margin: 60px 0px 0px 45%;" onclick="window.location.href=\'authenticate/login_signup/signin_up.php\';">Back to Login</button></body>'
?>