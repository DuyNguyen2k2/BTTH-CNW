<style>
    /* .input-file{
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
} */
input[type=file]{
    width: 350px;

}
input[type=file]::file-selector-button {
  margin-right: 20px;
  border: none;
  background: #084cdf;
  padding: 10px 20px;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
    background-color: rgb(0, 200, 255);
}

.drop-container {
  position: relative;
  display: flex;
  gap: 10px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 200px;
  width: 100%;
  padding: 20px;
  border-radius: 10px;
  border: 2px dashed #555;
  color: #444;
  cursor: pointer;
  transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover {
  background: #eee;
  border-color: #111;
}

.drop-container:hover .drop-title {
  color: #222;
}

.drop-title {
  color: #444;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  transition: color .2s ease-in-out;
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
    include('./process_add_article.php');
    $selectGenre = "SELECT ten_tloai FROM theloai";
    $resultGenre = $pdo->query($selectGenre);
    $selectAuthor = "SELECT ten_tgia FROM tacgia";
    $resultAuthor = $pdo->query($selectAuthor);

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('Y-m-d H:i:s');
    
    $addArticle = "INSERT INTO `baiviet` (`ma_bviet`, `tieude`, `ten_bhat`, `ma_tloai`, `tomtat`, `noidung`, `ma_tgia`, `ngayviet`, `hinhanh`) 
    VALUES (Null, '$title', '$songName', (SELECT ma_tloai FROM theloai WHERE ten_tloai = '$genre'), 
    '$recap', '$content', (SELECT ma_tgia FROM tacgia WHERE ten_tgia = '$author'), '$date', '$path');";
     
    if(isset($title, $songName, $genre, $recap, $content, $author, $path) and 
    !empty($title) and !empty($songName) and !empty($genre) and !empty($recap) and !empty($author)){
        $statment = $pdo->prepare($addArticle);
        $statment->execute();
        echo "<script> window.location.href='article.php'</script>";
    }
    else{
        $mess = 'Bạn chưa đền đầy đủ dữ liệu';
    }

?>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới bài viết</h3>
                <form action="add_article.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tiêu đề</span>
                        <input type="text" class="form-control" name="txtTitle" >
                        
                    </div>
                    <p style="color: red"><?= $messageTitle ?></p>
                    
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên bài hát</span>
                        <input type="text" class="form-control" name="txtSongName" >
                    </div>
                    <p style="color: red"> <?= $messageSongName ?></p>
                   
                    

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tóm tắt</span>
                        <input type="text" class="form-control" name="txtRecap" >
                    </div>
                    <p  style="color: red"><?= $messageRecap ?></p>
                    
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
                                <option value="<?=$row['ten_tloai']?>"><?= $row['ten_tloai'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <p  style="color: red"><?= $messageGenre?>  </p>
                             
                    <div style = "margin: 15px 0;">
                        <label for="author" style="margin-right: 19px;">Tên tác giả</label>
                        <select name="author" id="author" >
                                <option value=""></option>
                            <?php while($row = $resultAuthor->fetch()){?>
                                <option value="<?=$row['ten_tgia']?>"><?= $row['ten_tgia'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <p  style="color: red"><?= $messageAuthor ?>        </p>
                      
                    <div style="margin: 15px 0">
                        <label for="image" class="drop-container">
                            <span class="drop-title" style="width: 200px">Drop files here</span>
                                        or
                            <input type="file" name="image" id="image" class="input-file" accept="image/*">
                        </label>
                        
                    </div>  
                    <p style="color: red"><?php $mess ?></p>     
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