<?php
include('./include/header.php');
include('./include/database-connection.php');
$titel_post = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING);
if (empty($titel_post))
{
    $titel_check = "";
}
else
{
    $titel_check = "WHERE tieude like '%$titel_post%'";
}
$sql       = "SELECT ma_bviet,hinhanh,tieude FROM baiviet $titel_check;";
$statement = $pdo->query($sql);
$posts   = $statement->fetchAll();
$error = "";
if (empty($posts))
{
    $error = "Không tìm thấy kết quả nào cho ".$titel_post;
}
?>
<link rel="stylesheet" href="css/style.css">
<div>
<div id="carouselExampleIndicators " class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/slideshow/slide01.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="images/slideshow/slide02.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="images/slideshow/slide03.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<main class="container-fluid mt-3">
    <h3 class="text-center text-uppercase mb-3 text-primary">TOP bài hát yêu thích</h3>
    <div class="row">
    <h5 class="text-center mb-3 " style='color:#888888'><?= htmlspecialchars($error)?></h5>
    <?php foreach ($posts as $post) { ?>
        <div class="col-sm-3">
            <div class="card mb-2" style="width: 100%;">
                <img src="<?= htmlspecialchars($post['hinhanh']) ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="./detail.php?id=<?= htmlspecialchars($post['ma_bviet']) ?>" class="text-decoration-none"><?= htmlspecialchars($post['tieude']) ?></a>
                    </h5>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</main>
<?php
include('./include/footer.php');
?>