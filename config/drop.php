<?php
include 'ConnDB.php';
$servername = SERVERNAME;
$username = USERNAME;
$password = PASSWORD;
$dbName = DBNAME;

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

try {
    
    $conn = connDB();
    
    $sql1 = "DROP TABLE IF EXIST profiles";
    $conn->exec($sql1);
    echo "table profiles dropped successfully <br/>";
    
    $sql2 = "DROP TABLE IF EXISTS `images`";
    $conn->exec($sql2);
    echo "table images dropped successfully <br/>";
    
    $sql3 = "DROP TABLE IF  EXISTS `comments`";
    $conn->exec($sql3);
    echo "table comments dropped successfully <br/>";
    
    $sql4 = "DROP TABLE IF NOT EXISTS `likes`";
    $conn->exec($sql4);
    echo "table likes dropped successfully <br/>";
    $conn = null;
                                      
    $conn = new PDO("mysql:host=$servername",$username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = "DROP DATABASE IF EXISTS $dbName";
    $conn->exec($data);
    $conn = null;
}
catch(PDOException $e) {
    echo $data. "<br>" .$e->getMessage();
} 
?>
