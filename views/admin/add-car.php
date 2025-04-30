


<?php
ob_start(); // Start output buffering
?>
<main>
<div class="container-fluid px-4">
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
        <button type="submit" name="btnAdd" class="btn btn-primary">Thêm xe</button>
    </form>
</div>

</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../public/admin/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../public/admin/assets/demo/chart-area-demo.js"></script>
        <script src="../public/admin/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../public/admin/js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php
$content = ob_get_clean();
// var_dump($content); // Debugging line to check the content
// die();
require 'views/_layout/admin.php';
?>