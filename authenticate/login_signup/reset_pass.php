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
            header("location: signin_up.php");
        }
        else
        {
            $error = "Passwords do not match";
            include('newpass.php');
        }
    }

?>