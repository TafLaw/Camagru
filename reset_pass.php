<?php 
    include 'ConnDB.php';

    if (isset($_GET['email']))
    {
        $email = $_GET['email'];
        $id = $_GET['id'];
        $conn = ConnDB();
        $stmt = $conn->prepare("SELECT id, email FROM profiles WHERE id = '$id' AND email = '$email'");
        $stmt->execute();
        $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($res)
        {
            $update = $conn->prepare("UPDATE profiles SET password ");
        }
    }

    ?>