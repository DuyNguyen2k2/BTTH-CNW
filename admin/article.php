
<?php include('./include/header.php');
    include('../include/database-connection.php');
    $sql = "SELECT ma_bviet, tieude,  ten_bhat, ten_tloai, tomtat, noidung, ten_tgia, ngayviet, hinhanh FROM baiviet, tacgia, theloai
    WHERE baiviet.ma_tloai = theloai.ma_tloai AND baiviet.ma_tgia = tacgia.ma_tgia ORDER BY ma_bviet ASC";
    $select = $pdo->query($sql);

?>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <a href="./add_article.php" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Tên bài hát</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Tóm tắt</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col">Ngày viết</th>
                            <th scope="col">Hình ảnh</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $select->fetch()){?> 
                        <tr>
                            <th scope="row"><?= $row['ma_bviet']?></th>
                            <td style="max-width: 100px;"><?= $row['tieude']?></td>
                            <td style="max-width: 100px;"><?= $row['ten_bhat']?></td>
                            <td style="max-width: 100px;"><?= $row['ten_tloai']?></td>
                            <td style="max-width: 200px;"><?= $row['tomtat']?></td>
                            <td style="max-width: 200px;"><?= $row['noidung']?></td>
                            <td style="max-width: 100px;"><?= $row['ten_tgia']?></td>
                            <td style="max-width: 100px;"><?= $row['ngayviet']?></td>
                            <td><img src="../<?= $row['hinhanh']?>" alt="" style="height: 50px; width: 100%; object-fit: contain;"></td>
                            <td>
                                <a href="edit_article.php?id=1"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href=""><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include('./include/footer.php') ?>