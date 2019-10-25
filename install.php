<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbName = "camagru";

try {
  $conn = new PDO("mysql:host=$servername",$username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $data = "CREATE DATABASE IF NOT EXISTS $dbName";
  $conn->exec($data);
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $nme, $password);

  $sql1 = "CREATE TABLE IF NOT EXISTS `profiles` (
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,  
    `image` varchar(255) NOT NULL,  
    `password` varchar(255) NOT NULL,  
    PRIMARY KEY (`name`)
   ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4";
   $conn->exec($sql1);
   $sql2 = "CREATE TABLE IF NOT EXISTS `images` (  
    `image` varchar(255) NOT NULL,  
    PRIMARY KEY (`image`)
   ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4";
  $conn->exec($sql2);
  
  $sql3 = "CREATE TABLE IF NOT EXISTS `comments` (
    `comment` varchar(255) NOT NULL,  
    PRIMARY KEY (`comment`)
   ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4";
  $conn->exec($sql3);
}
catch(PDOException $e) {
  echo $data. "<br>" .$e->getMessage();
}

 
 ?>
