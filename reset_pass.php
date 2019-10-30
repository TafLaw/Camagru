<?php 
    /* include 'ConnDB.php'; */
    include 'user.php';

    $email = $_GET['email'];
    $id = $_GET['id'];
    $error = NULL;
    $obj = new userClass();

    
    if ($_POST['reset'] == 'Reset')
    { 
        $conn = ConnDB();
        $stmt = $conn->prepare("SELECT id, email FROM profiles WHERE id = '$id' AND email = '$email' LIMIT 1");
        $stmt->execute();
        $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $newPass = $_POST['newpass'];
        $confirm = $_POST['confirm'];
        if ($res && $obj->match($newPass, $confirm))
        {
            $newPass = password_hash($newPass,PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE profiles SET password = '$newPass' WHERE email = '$email' LIMIT 1");
            $update->bindParam('newPass', $newPass,PDO::PARAM_STR);
            $update->bindParam('confirm', $confirm,PDO::PARAM_STR);
            $update->execute();
            header("location: index.php");
        }
        else
        {
            $error = "Passwords do not match";
            include('newpass.php');
        }
    }

?>
<!-- <!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
        <style>
            #block {
                margin: 20%;
            }
            .input {
                width: 60%;
                height: 3vh;
                box-shadow: inset 0.01px 0.01px 6px #7c35f3;
            }
            .reset {
                background-color: #7750bb;
                margin-top: 8px;
                color: #ccc;
            }
            h5 {
                margin-top: -40px;
                text-align: center;
                color: red;
            }
        </style>
    </head>
    <body>
        <div id="block">
            <h3>Reset Password</h3>
            <form method = "post" action="reset_pass.php?email=<?php echo $_GET['email'];?>&id=<?php echo $_GET['id'];?>">
                <input class="input" type="password" minlength="6" pattern="(?=\S*\d)(?=\S*[a-z])(?=\S*[A-Z])\S*" title="password must contain at least 1 uppercase, lowercase, digit, special character" name="newpass" placeholder="Enter new password" required><br/>
                <input class="input" type="password" minlength="6" pattern="(?=\S*\d)(?=\S*[a-z])(?=\S*[A-Z])\S*" title="password must contain at least 1 uppercase, lowercase, digit, special character" name="confirm" placeholder="Confirm password" required><br/>
                <input class="reset" type="submit" name="reset" value="Reset">
                <?php echo "<h5>$error</h5>";?>
            </form>
        </div>
    </body>
</html> -->