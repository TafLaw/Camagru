<?php
    $servername = "localhost";
    $nme = "root";
    $pass = "12345";
    $dbName = "Camagru";

    if (isset($_GET['code']))
    {
        //continue registration here
        $code = $_GET['code'];
        //connect to database
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbName", $nme, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT code, varified FROM profiles WHERE varified = 0 AND code='$code' LIMIT 1");
            $stmt->execute();

            //set associative array
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if ($res)
            {
                //do verification
                $update = $conn->prepare("UPDATE profiles SET varified = 1 WHERE code = '$code' LIMIT 1");
                $update->execute();
                if ($update)
                    echo "<h3 style=\"color: #90EE90;\">e-mail verified</h3>";
                else
                    echo "<h3 style='color: red';>Could not varify email\n</h3>";
            }
            else
                echo "account already varified\n";
        } catch (PDOException $e) {
            echo "Connection failed".$e->setMessage();
        }
    }
    else
        die("Could not process verification");
?>