<?php 
    include 'database.php';

    function connDB()
    {
        $servername = SERVERNAME;
        $nme = USERNAME;
        $pass = PASSWORD;
        $dbName = DBNAME;
        //connect database
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbName", $nme, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOEception $e) {
            echo "Connection Failed".$e->newMessage();
        }
    }
?>