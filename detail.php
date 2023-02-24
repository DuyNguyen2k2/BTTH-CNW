<?php
include('./include/header.php');
include('./include/database-connection.php');
$id_post = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$sql       = "SELECT * FROM baiviet WHERE ma_bviet = :id;";       
$statement = $pdo->prepare($sql);      
$statement->execute([':id' => $id_post]);   
$post    = $statement->fetch(); 

$id_author = $post['ma_tgia'];
$sql       = "SELECT ten_tgia FROM tacgia WHERE ma_tgia = :id;";       
$statement = $pdo->prepare($sql);      
$statement->execute([':id' => $id_author]);   
$author    = $statement->fetch();

$id_category = $post['ma_tloai'];
$sql       = "SELECT * FROM theloai WHERE ma_tloai = :id;";       
$statement = $pdo->prepare($sql);      
$statement->execute([':id' => $id_category]);   
$category    = $statement->fetch();
?>
<link rel="stylesheet" href="css/style.css">
    <main class="container mt-5">
                <div class="row mb-5">
                    <div class="col-sm-4">
                        <img src="<?= htmlspecialchars($post['hinhanh']) ?>" class="img-fluid" alt="...">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title mb-2">
                            <a href="" class="text-decoration-none"><?= htmlspecialchars($post['tieude']) ?></a>
                        </h5>
                        <p class="card-text"><span class=" fw-bold">Bài hát: </span><?= htmlspecialchars($post['ten_bhat']) ?></p>
                        <p class="card-text"><span class=" fw-bold">Thể loại: </span><?= htmlspecialchars($category['ten_tloai']) ?></p>
                        <p class="card-text"><span class=" fw-bold">Tóm tắt: </span><?= htmlspecialchars($post['tomtat']) ?></p>
                        <p class="card-text"><span class=" fw-bold">Nội dung: </span><?= htmlspecialchars($post['noidung']) ?></p>
                        <p class="card-text"><span class=" fw-bold">Tác giả: </span><?= htmlspecialchars($author['ten_tgia']) ?></p>

                    </div>          
        </div>
    </main>
    <?php
    include('./include/footer.php');
    ?>