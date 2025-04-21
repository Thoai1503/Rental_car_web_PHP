<?php
ob_start(); // Start output buffering
?>

<h2>Danh sách xe</h2>
<?php foreach($cars as $car): ?>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img style="width:200px" src="uploads/<?= $car['image'] ?>" class="img-fluid rounded-start" alt="<?= $car['name'] ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $car['name'] ?></h5>
                    <p class="card-text">Giá: <?= $car['price_per_day'] ?> VNĐ</p>
                    <a href="editcar/<?= $car['id'] ?>" class="btn btn-warning">Sửa</a>
                    <a href="deletecar?id=<?= $car['id'] ?>" class="btn btn-danger">Xóa</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<a class="btn btn-primary mb-3" href="/cars/add">Thêm xe</a>


<?php
$content = ob_get_clean();
// var_dump($content); // Debugging line to check the content
// die();
require 'views/layout/main.php';
?>