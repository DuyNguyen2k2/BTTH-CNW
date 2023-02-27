<?php
include('../include/Check_session.php')
?>
<?php 
    include('./include/header.php');
?>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới thể loại</h3>
                <form action="include/process_category.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                        <input type="text" class="form-control" name="txtCatName" >
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Thêm" name="btn" class="btn btn-success">
                        <a href="category.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                    <div class="form-group" style="color:red">
                        <?=$_GET['mess'] ?? ""?>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php 
    include('./include/footer.php')
?>