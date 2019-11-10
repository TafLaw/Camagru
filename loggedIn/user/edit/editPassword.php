<?php 
    session_start();
    include '../../../config/ConnDB.php';
    
    $error = NULL;
    if (!isset($_SESSION['id']))
        header("location: ../../../authenticate/login_signup/signin_up.php");
    else if (isset($_POST['submit']) == 'proceed')
    {
        $conn = connDB();
        $uid = $_SESSION['id'];
        $deta = "SELECT * FROM profiles WHERE id = '$uid'";
        $ind = 0;
        $match = 0;
        $password = $_POST['currentPass'];
        $newPass = $_POST['newPass'];
        $confirm = $_POST['confirmPass'];
        //verify password
        foreach($conn->query($deta) as $row)
        {
            if (password_verify($password, $row['password']))
            {
                $ind++;
                $user = $row['name'];
            }
        }
        if ($confirm == $newPass)
            $match++;
        if ($ind && $match)
        {
            $newPass =  password_hash($newPass,PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE profiles SET password = '$newPass' WHERE name = '$user' AND id = '$uid'");
            $update->bindParam('newPass', $newPass,PDO::PARAM_STR);
            $update->bindParam('confirm', $confirm,PDO::PARAM_STR);
            $update->execute();
            header("location: ../../../authenticate/login_signup/signin_up.php");
        }
        else
        {
            if (!$ind)
                $error = "incorrect password";
            else if (!$match)
                $error = "Passwords do not match";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>edit passsword</title>
        <link rel="stylesheet" href="../../../styles.css">
    </head>
    <body>
        <nav>
            <div class="navBar">
                <button onclick="window.location.href='../../../authenticate/login_signup/logout.php'">log out</button>            
            </div>
        </nav>
        <form action="" method="post">
            <input id = "newUn" type="password" placeholder="Enter currrent password" name="currentPass" required>
            <input id = "newUn" type="password" placeholder="Enter new password" name="newPass" required>
            <input id = "newUn" type="password" placeholder="confirm password" name="confirmPass" required>
            <input type="submit" name="submit" value="proceed">
            <br/>
            <h3 style="color: red"><?php echo $error; ?></h3>
        </form>
    </body>
</html>