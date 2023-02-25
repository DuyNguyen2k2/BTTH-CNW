<?php
    session_start();
    if(isset($_SESSION['check'])){
        unset($_SESSION['check']);
        header("Location:../index.php");
    }
?>