<?php
ob_start(); 
?>
<?php foreach($cars as $car): ?>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="uploads/<?= $car['image_url'] ?>" class="img-fluid rounded-start" alt="<?= $car['name'] ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $car['name'] ?></h5>
                    <p class="card-text">Giá: <?= $car['price_per_day'] ?> VNĐ</p>
                    <a href="/cars/edit/<?= $car['id'] ?>" class="btn btn-warning">Sửa</a>
                    <a href="/cars/delete/<?= $car['id'] ?>" class="btn btn-danger">Xóa</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<a class="btn btn-primary mb-3" href="/cars/add">Thêm xe</a>


<?php
$content = ob_get_clean();

require 'views/layout/main.php';
?>
