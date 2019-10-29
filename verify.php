<?php
    $servername = "localhost";
    $nme = "root";
    $pass = "12345";
    $dbName = "Camagru";

    if (isset($_GET['code']))
    {
        //continue registration here
        $code = $_GET['code'];
        $id = $_GET['id'];
        //connect to database
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbName", $nme, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT code, varified FROM profiles WHERE varified = 0 AND code='$code' LIMIT 1");
            $stmt->execute();
            $varch = "SELECT * FROM profiles WHERE id = '$id' AND code = '$code' Limit 1";
            //set associative array
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach($conn->query($varch) as $row)
            {
                $val = $row['varified'];
            }
            if ($res && !$val)
            {
                //do verification
                $update = $conn->prepare("UPDATE profiles SET varified = 1 WHERE code = '$code' LIMIT 1");
                $update->execute();
                if ($update)
                {
                    echo '<body style=" padding: 50px; margin: 30%;"><h3 style="color: #90EE90; text-align: center;">e-mail verified successfully</h3>';
                    echo '<img src="icons/shield.png" style="width: 150px; height: 150px; margin-left: 35%;" alt="verified"></body>'; 
                }
                else
                echo "<h3 style='color: red';>Could not varify email\n</h3>";
            }
            else
            
            {
                echo '<body style=" padding: 50px; margin: 30%;"><h3 style="color: #90EE90; text-align: center;">account already varified</h3>';
                echo '<img src="icons/shield.png" style="width: 150px; height: 150px; margin-left: 35%;" alt="verified"></body>'; 
            }
        } catch (PDOException $e) {
            echo "Connection failed".$e->setMessage();
        }
    }
    else
        die("Could not process verification");
?>