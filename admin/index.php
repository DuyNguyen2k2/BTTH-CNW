<?php
include('../include/Check_session.php')
?>
<?php
include('../include/database-connection.php'); 
$count_posts = $pdo->query('select count(*) from baiviet')->fetchColumn(); 
$count_author = $pdo->query('select count(*) from theloai')->fetchColumn(); 
$count_category = $pdo->query('select count(*) from tacgia')->fetchColumn(); 
$count_users = $pdo->query('select count(*) from users')->fetchColumn();
?>
<?php include('./include/header.php') ?>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="" class="text-decoration-none">Người dùng</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?= htmlspecialchars($count_users) ?>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="" class="text-decoration-none">Thể loại</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?= htmlspecialchars($count_author) ?>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="" class="text-decoration-none">Tác giả</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?= htmlspecialchars($count_category) ?>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="" class="text-decoration-none">Bài viết</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?= htmlspecialchars($count_posts) ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include('./include/footer.php') ?>    