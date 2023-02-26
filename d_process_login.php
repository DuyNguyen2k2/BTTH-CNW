<?php
    session_start();
    include('./include/database-connection.php');
    if(isset($_POST['btnLogin'])){
        if (empty($_POST['txtUser']) || empty(($_POST['txtPass'])))
        {
        header("Location:login.php");
        }
        else
        {
                $query = "SELECT * FROM users WHERE taikhoan = :user AND matkhau = :pass";  
                $statement = $pdo->prepare($query);  
                $statement->execute(  
                     array(  
                          ':user'     =>     $_POST["txtUser"],  
                          ':pass'     =>     $_POST["txtPass"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["check"] = $_POST["txtUser"];  
                     header("location:admin/index.php");  
                } 
                else
                {
                    header("Location:login.php");
                }
        }
    }


?>