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
  $conn = new PDO("mysql:host=$servername",$username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $data = "CREATE DATABASE IF NOT EXISTS $dbName";
  $conn->exec($data);
  $conn = connDB();

  echo "database camagru created successfully <br/>";
  $sql1 = "CREATE TABLE IF NOT EXISTS `profiles` (
    `id` INT(11) AUTO_INCREMENT NOT NULL,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,  
    `image` varchar(255) NOT NULL,  
    `password` varchar(255) NOT NULL,
    `code`  varchar(8) NOT NULL,
    `varified` INT (1) NOT NULL,
    `notifications` INT (1) NOT NULL,
    `date`  varchar(25) NOT NULL,  
    PRIMARY KEY (`id`)
   ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
   $conn->exec($sql1);
   echo "table profiles created successfully <br/>";
   
   $sql2 = "CREATE TABLE IF NOT EXISTS `images` (
    `id` INT(11) AUTO_INCREMENT NOT NULL,
    `user` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL,  
    `upload date` varchar(25) NOT NULL,
    PRIMARY KEY (`id`)
   ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
  $conn->exec($sql2);
  echo "table images created successfully <br/>";
  
  $sql3 = "CREATE TABLE IF NOT EXISTS `comments` (
    `id` INT(11) AUTO_INCREMENT NOT NULL,
    `user` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL,
    `comment` varchar(255) NOT NULL,
    `date/time` varchar(25) NOT NULL,
    PRIMARY KEY (`id`)
   ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
  $conn->exec($sql3);
  echo "table comments created successfully <br/>";
  
  $sql4 = "CREATE TABLE IF NOT EXISTS `likes` (
    `id` INT(11) AUTO_INCREMENT NOT NULL,
    `user` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL,
    `lik` INT (1) NOT NULL,
    `date/time` varchar(25) NOT NULL,
    PRIMARY KEY (`id`)
   ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
  $conn->exec($sql4);
  echo "table likes created successfully <br/>";
}
catch(PDOException $e) {
  echo $data. "<br>" .$e->getMessage();
} 
?>
