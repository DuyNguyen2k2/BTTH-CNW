<?php
include('../include/database-connection.php');

$tentacgia = $_POST['txtAuName'] ?? "";

if(isset($_POST['btn']) || isset($_GET['btn'])){
    if(isset($_POST['btn'])) $btn = $_POST['btn'];
        else $btn = $_GET['btn'];
            $ma_tgia = $_POST["txtAuId"];
            if(!empty(trim($tentacgia))){
                $statement = $pdo->query("UPDATE `tacgia` SET `ten_tgia` = '$tentacgia' WHERE `tacgia`.`ma_tgia` = '$ma_tgia';");
                header('location:author.php');
            }
            else{
                $mess = "Không được bỏ trống tên tác giả";
                header("location:edit_author.php?id=$ma_tgia&mess=$mess");
            }
}
?>