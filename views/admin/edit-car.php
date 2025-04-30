<?php ob_start(); ?>

<main>
    <div class="container-fluid px-4 mb-4">
        <h2 class="mb-4">Edit Car - ID: <?= $car->getId() ?></h2>

        <div class="card shadow p-4">
            <form action="../cars-edit/<?= $car->getId() ?>" method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $car->getName() ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="<?= $car->getBrand() ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" value="<?= $car->getType() ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fuel_type" class="form-label">Fuel Type</label>
                        <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="<?= $car->getFuelType() ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="seats" class="form-label">Seats</label>
                        <input type="number" class="form-control" id="seats" name="seats" value="<?= $car->getSeats() ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="transmission" class="form-label">Transmission</label>
                        <input type="text" class="form-control" id="transmission" name="transmission" value="<?= $car->getTransmission() ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="price_per_day" class="form-label">Price per Day ($)</label>
                        <input type="number" class="form-control" id="price_per_day" name="price_per_day" value="<?= $car->getPricePerDay() ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Upload New Image</label>
                        <input type="file" class="form-control" id="image" multiple name="image">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Current Image</label><br>
                        <?php if ($car->getImage()): ?>
                            <img src="http://localhost/car_rent/uploads/<?= $car->getImage() ?>" alt="Current Car Image" class="img-thumbnail" style="max-width: 300px;">
                        <?php else: ?>
                            <p class="text-muted">No image uploaded.</p>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
require 'views/_layout/admin.php';
?>
