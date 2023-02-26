<style>
    .input-file{
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.input-file + .chooseImage{
    width: 100px;
    height: 40px;
    line-height: 40px;
    color: #fff;
    background-color: #0080ff;
    cursor: pointer;
    border-radius: 5px;
    text-align: center;
}

.chooseImage:hover{
    background-color: rgb(0, 200, 255);
}
span{
    width: 100px;
}

select{
    width: 150px;
    height: 30px;
}

</style>
<?php 
    include('./include/header.php');
    include('../include/database-connection.php');
    $selectGenre = "SELECT ten_tloai FROM theloai";
    $resultGenre = $pdo->query($selectGenre);
    $selectAuthor = "SELECT ten_tgia FROM tacgia";
    $resultAuthor = $pdo->query($selectAuthor);

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('Y-m-d H:i:s');

?>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới bài viết</h3>
                <form action="process_add_article.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tiêu đề</span>
                        <input type="text" class="form-control" name="txtTitle" >
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên bài hát</span>
                        <input type="text" class="form-control" name="txtSongName" >
                    </div>

                    

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tóm tắt</span>
                        <input type="text" class="form-control" name="txtRecap" >
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Nội dung</span>
                        <input type="text" class="form-control" name="txtContent" >
                    </div>

                    

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Ngày viết</span>
                        <input type="text" class="form-control" name="txtDatetime" placeholder="<?= $date ?>" disabled>
                    </div>

                    <div style = "margin: 15px 0;">
                        <label for="genre">Chọn thể loại</label>
                        <select name="genre" id="genre">
                            <option value=""></option>
                            <?php while($row = $resultGenre->fetch()){?>
                                <option value="$row[ten_tloai]"><?= $row['ten_tloai'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div style = "margin: 15px 0;">
                        <label for="author" style="margin-right: 19px;">Tên tác giả</label>
                        <select name="author" id="author" >
                                <option value=""></option>
                            <?php while($row = $resultAuthor->fetch()){?>
                                <option value="$row['ten_tgia']"><?= $row['ten_tgia'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div>
                        <input type="file" name="file" id="file" class="input-file">
                        <label for="file" class="chooseImage">Chọn ảnh</label>
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php 
    include('./include/footer.php')
    ?>