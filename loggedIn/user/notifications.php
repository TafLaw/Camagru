<?php 
    session_start();
    include '../../config/ConnDB.php';
    if (!$_SESSION['id'])
        header("location: ../../authenticate/signin_up.php");
    else
    {
        $conn = connDB();
        $uid = $_SESSION['id'];
        $sql = "SELECT * FROM profiles WHERE id = '$uid' LIMIT 1";
        foreach ($conn->query($sql) as $key) {
            $notif = $key['notifications'];
        }
        if ($notif)
        {
            $stmt = $conn->prepare("UPDATE profiles SET notifications = 0 WHERE id = '$uid' LIMIT 1");
            $stmt->execute();
        }
        else if(!$notif)
        {
            $stmt = $conn->prepare("UPDATE profiles SET notifications = 1 WHERE id = '$uid' LIMIT 1");
            $stmt->execute();
        }  
    }
    echo "WELCOME TO NOTIFICATIONS";
?>