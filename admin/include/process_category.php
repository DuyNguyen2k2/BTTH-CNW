<?php
include('../../include/database-connection.php');

$tentheloai = $_POST['txtCatName'] ?? "";

if(isset($_POST['btn']) || isset($_GET['btn'])){
    if(isset($_POST['btn'])) $btn = $_POST['btn'];
    else $btn = $_GET['btn'];

    switch($btn){
        case 'Thêm':
            if(!empty(trim($tentheloai))){
                $statement = $pdo->query("insert into theloai values(null,'$tentheloai',null)");
                header('location:../category.php');
            }
            else{
                $mess = "Không được bỏ trống tên thể loại";
                header("location:../add_category.php?mess=$mess");
            }
            break;
        case 'Lưu':
            $ma_tloai = $_POST["txtCatId"];
            if(!empty(trim($tentheloai))){
                $statement = $pdo->query("UPDATE `theloai` SET `ten_tloai` = '$tentheloai' WHERE `theloai`.`ma_tloai` = '$ma_tloai';");
                header('location:../category.php');
            }
            else{
                $mess = "Không được bỏ trống tên thể loại";
                header("location:../edit_category.php?id=$ma_tloai&mess=$mess");
            }
            break;
        case 'Xóa':
            $ma_tloai_xoa = $_GET['id'];
            $aricles = $pdo->query("select * from baiviet where ma_tloai = $ma_tloai_xoa")->fetchAll();
            if(count($aricles)>0){
                echo "<div>Bạn cần xóa các bài viết có mã: ";
                foreach($aricles as $aricle){
                    echo "<br>id = ".$aricle['ma_bviet'];
                }
                echo '</div> <a href="../article.php" style="text-decoration: none; background: cadetblue"> OK </a>';
            }
            else{
                $pdo->query("delete from theloai where ma_tloai = $ma_tloai_xoa");
                header('location:../category.php');
            }
            break;
    }
}
?>