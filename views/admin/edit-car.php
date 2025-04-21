<?php
ob_start(); 
?>
<h2 class="mb-4">Edit car ID: <?=$car["id"]?></h2>


<form action="../cars-edit/<?=$car["id"]?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $car['name'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="brand" class="form-label">Brand</label>
        <input type="text" class="form-control" id="brand" name="brand" value="<?= $car['brand'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <input type="text" class="form-control" id="type" name="type" value="<?= $car['type'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="fuel_type" class="form-label">Fuel Type</label>
        <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="<?= $car['fuel_type'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="seats" class="form-label">Seats</label>
        <input type="number" class="form-control" id="seats" name="seats" value="<?= $car['seats'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="seats" class="form-label">Transmission</label>
        <input type="text" class="form-control" id="seats" name="transmission" value="<?= $car['transmission'] ?>" required>
    </div>

    
    <div class="mb-3">
        <label for="price_per_day" class="form-label">Price per day</label>
        <input type="number" class="form-control" id="price_per_day" name="price_per_day" value="<?= $car['price_per_day'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>

</div>
</form>







<?php
$content = ob_get_clean();

require 'views/_layout/main.php';
?>
    