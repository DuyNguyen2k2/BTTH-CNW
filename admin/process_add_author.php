<?php
    //session_start();
    include('../include/database-connection.php');
    $sl = "SELECT MAX(ma_tgia) AS max_id FROM tacgia";
    $result = $pdo->query($sl);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $max_id = $row['max_id'];

    if(isset($_POST['btnAuthor'])){
        if (empty($_POST["txtAuName"]))
        {
        header("Location:author.php");
        }
        else
            {  
                $sql = "INSERT INTO tacgia( ma_tgia, ten_tgia) VALUES(:matgia, :ten ) ";  
                $statement = $pdo->prepare($sql);  
                $statement->execute( 
                     array(  
                          ':ten'     =>     $_POST["txtAuName"],
                          ':matgia'  =>     $max_id + 1            
                     )  
                ); 
                
                header("Location:author.php");
        }
    }


?>