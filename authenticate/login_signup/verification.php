<?php
    include 'user.php';
    $servername = SERVERNAME;
    $nme = USERNAME;
    $pass = PASSWORD;
    $dbName = DBNAME;
    $obj = new userClass();
    $error = NULL;
    $uerror = NULL;
    $perror = NULL;
    
    if (isset($_POST['register']))
    {
        $username = $_POST["name"];
        $rawPassword = $_POST["password"];
        $confirm = $_POST['conf_pass'];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $email = $_POST["email"];
        $code = substr(password_hash($email, PASSWORD_DEFAULT), 0, 8);
        $dat = date("d F Y");

        //connect to database
        if (strlen($username) >= 5 && $obj->valid($rawPassword) && $obj->match($rawPassword, $confirm))
        {
            $obj->register($username, $email, $password);            
            
        }
        else
        {
            if (strlen($username) < 5 && $obj->valid($rawPassword))
            {
                $uerror = "username must contain at least 5 characters\n";
                include('signup.php');
            }
            else if (!$obj->valid($rawPassword) && strlen($username) >= 5)
            {
                $error = "password must contain at least 1 uppercase, lowercase, digit, special character\n";
                include('signup.php');
            }
            else if (!$obj->valid($rawPassword) && strlen($username) < 5)
            {
                $error = "password must contain at least 1 uppercase, lowercase, digit, special character\n";
                $uerror = "username must contain at least 5 characters\n";
                include('signup.php');
            }
            if (!$obj->match($rawPassword, $confirm))
            {
                $perror = "Passwords do not match";
                include('signup.php');
            }
        }
    }
?>
