
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Admin</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Danh sách xe</h2>
                <?php
                if(isset($cars) && count($cars) > 0){
             ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên xe</th>
                            <th>Hãng xe</th>
                            <th>Loại xe</th>
                            <th>Nhiên liệu</th>
                            <th>Số ghế</th>
                            <th>Hộp số</th>
                            <th>Giá/ngày</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?php echo $car['id']; ?></td>
                            <td><?php echo $car['name']; ?></td>
                            <td><?php echo $car['brand']; ?></td>
                            <td><?php echo $car['type']; ?></td>
                            <td><?php echo $car['fuel_type']; ?></td>
                            <td><?php echo $car['seats']; ?></td>
                            <td><?php echo $car['transmission']; ?></td>
                            <td><?php echo $car['price_per_day']; ?></td>
                            <td><img src="<?php echo 'uploads/' . $car['image']; ?>" alt="<?php echo $car['name']; ?>" width="100"></td>
                            <td><a href="/editcar/<?php echo $car['id']; ?>">Sửa</a> | 
                                <a href="/deletecar/<?php echo $car['id']; ?>">Xóa</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php } else { ?>
                     <!-- Thêm xe mới -->
                     <h2>Thêm xe mới</h2>

<!-- Form thêm xe mới -->
<?php require_once 'views/add-car.php'; ?>

                <?php } ?>
                
            </div>
        </div>
    </div>
    
</body>
</html>