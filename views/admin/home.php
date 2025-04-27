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
                    <button class="btn btn-danger delete-btn" data-id="<?= $car['id'] ?>" data-toggle="modal" data-target="#exampleModal">Xóa</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<a class="btn btn-primary mb-3" href="/cars/add">Thêm xe</a>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn có chắc muốn xoá chiếc xe 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="deletecar?id=" class="btn btn-primary save-btn">Save changes</a>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Lấy tất cả các nút Delete Demo
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                let itemId = this.getAttribute("data-id"); // Lấy ID của item
               // alert(itemId);
            document.getElementsByClassName("modal-body")[0].textContent = "Bạn có chắc muốn xoá chiếc xe " +  itemId; // Hiển thị trong modal
                document.getElementsByClassName("save-btn")[0].href +=  itemId; // Set href cho nút Delete
            });
        });

    });
  
</script>

<?php
$content = ob_get_clean();
// var_dump($content); // Debugging line to check the content
// die();
require 'views/_layout/admin.php';
?>