<?php
    include_once '../../connect/ConnDB.php';
    session_start();
    echo $_SESSION['id'];
?>