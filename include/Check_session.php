<?php
    session_start();
    if(!isset($_SESSION['check'])){
        header("Location:../login.php");
    }
?>