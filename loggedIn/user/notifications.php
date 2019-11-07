<?php 
    session_start();
    include '../../config/ConnDB.php';
    if (!$_SESSION['id'])
    echo "WELCOME TO NOTIFICATIONS";
?>