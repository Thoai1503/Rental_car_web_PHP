<?php
ob_start();
?>
<div class="container mt-5">
    <h1 class="text-center">Thêm xe</h1>
    <form action="./cars-add" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Tên xe</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Hãng xe</label>
            <input type="text" class="form-control" id="brand" name="brand" required>   
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Loại xe</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="mb-3">
            <label for="fuel_type" class="form-label">Loại nhiên liệu</label>
            <input type="text" class="form-control" id="fuel_type" name="fuel_type" required>
        </div>
        <div class="mb-3">
            <label for="seats" class="form-label">Số ghế</label>
            <input type="number" class="form-control" id="seats" name="seats" required>
        </div>
        <div class="mb-3">
            <label for="transmission" class="form-label">Hộp số</label>
            <input type="text" class="form-control" id="transmission" name="transmission" required>
        </div>


        <div class="mb-3">
            <label for="price_per_day" class="form-label">Giá thuê mỗi ngày (VNĐ)</label>
            <input type="number" class="form-control" id="price_per_day" name="price_per_day" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png, .gif" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm xe</button>
    </form>
</div>


<?php
$content = ob_get_clean();

require 'views/layout/main.php';
?>
