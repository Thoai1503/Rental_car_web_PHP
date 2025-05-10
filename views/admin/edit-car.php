<?php ob_start(); ?>

<main>
    <div class="container-fluid px-4 mb-4">
        <h2 class="mb-4">Edit Car - ID: <?= $car->getId() ?></h2>

        <div class="card shadow p-4">
            <form action="../cars-edit/<?= $car->getId() ?>" method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $car->getName() ?>" placeholder="Tên xe" required>
                                        <label for="name"><i class="fas fa-car me-2"></i>Tên xe</label>
                                    </div>
                                </div>
                    <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="brand" name="brand" required>
                                            <option value="<?=$car->getBrand()?>" selected ><?=$car->getBrandName()?></option>
                                            <?php
                                            if (isset($carBrands) && count($carBrands) > 0) {
                                                foreach ($carBrands as $brand) {
                                            ?>
                                                <option value="<?= $brand->getId() ?>"><?= $brand->getName() ?></option>
                                            <?php
                                                }
                                            }
                                            ?>   
                                           
                                        </select>
                                        <label for="brand"><i class="fas fa-building me-2"></i>Hãng xe</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="type" name="type" required>
                                            <option value="<?=$car->getType()?>" selected><?=$car->getTypeName()?></option>
                                            <?php
                                            if (isset($carTypes) && count($carTypes) > 0) {
                                                foreach ($carTypes as $type) {
                                            ?>
                                                <option value="<?= $type->getId() ?>"><?= $type->getName() ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                       
                                        </select>
                                        <label for="type"><i class="fas fa-tags me-2"></i>Loại xe</label>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="fuel_type" name="fuel_type" required>
                                            <option value="<?= $car->getFuelType() ?>" selected><?= $car->getFuelType() ?></option>
                                            <option value="Xăng">Xăng</option>
                                            <option value="Dầu">Dầu</option>
                                            <option value="Điện">Điện</option>
                                            <option value="Hybrid">Hybrid</option>
                                        </select>
                                        <label for="fuel_type"><i class="fas fa-gas-pump me-2"></i>Loại nhiên liệu</label>
                                    </div>
                                </div>
                    <div class="col-md-6">
                        <label for="seats" class="form-label">Seats</label>
                        <input type="number" class="form-control" id="seats" name="seats" value="<?= $car->getSeats() ?>" required>
                    </div>
                    <!-- <div class="col-md-6">
                        <label for="transmission" class="form-label">Transmission</label>
                        <input type="text" class="form-control" id="transmission" name="transmission" value="<?= $car->getTransmission() ?>" required>
                    </div> -->
                    <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="transmission" name="transmission" required>
                                            <option value="<?= $car->getTransmission() ?>" selected><?= $car->getTransmission()=='manual'?'Số sàn':'Số tự động' ?></option>
                                            <!-- <option value="Số tự động">Số tự động</option>
                                            <option value="Số sàn">Số sàn</option>
                                            <option value="Bán tự động">Bán tự động</option>
                                            <option value="Vô cấp CVT">Vô cấp CVT</option> -->
                                            <option value="manual">Số sàn</option>
                                            <option value="automatic">Số tự động</option>
                                        </select>
                                        <label for="transmission"><i class="fas fa-cogs me-2"></i>Hộp số</label>
                                    </div>
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
