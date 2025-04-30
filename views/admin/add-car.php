<?php ob_start(); // Start output buffering ?>
<!-- Include CSS for Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<!-- Include jQuery and Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    /* Style for Select2 inside floating labels */
    .form-floating > .select2-container--bootstrap-5 .select2-selection {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }
    
    .form-floating > label {
        z-index: 999;
    }
    
    .form-floating-active > label {
        opacity: 0.65;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }
    
    .select2-container--bootstrap-5 .select2-selection {
        border: 1px solid #ced4da;
    }
    
    .was-validated .form-select:invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
    }
    
    .was-validated .form-select:valid,
    .form-select.is-valid {
        border-color: #198754;
    }
    
    /* Card styling enhancements */
    .card {
        transition: all 0.3s ease;
    }
    
    .btn-success {
        transition: all 0.2s ease;
    }
    
    .btn-success:hover {
        transform: scale(1.05);
    }
    
    #imagePreview img {
        transition: all 0.3s ease;
    }
</style>

<main>
    <div class="container-fluid px-4 py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center font-weight-bold my-2">Thêm xe mới</h3>
                    </div>
                    <div class="card-body">
                        <form action="./cars-add" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Tên xe" required>
                                        <label for="name"><i class="fas fa-car me-2"></i>Tên xe</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="brand" name="brand" required>
                                            <option value="" selected disabled>Chọn hãng xe</option>
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
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="type" name="type" required>
                                            <option value="" selected disabled>Chọn loại xe</option>
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
                                            <option value="" selected disabled>Chọn nhiên liệu</option>
                                            <option value="Xăng">Xăng</option>
                                            <option value="Dầu">Dầu</option>
                                            <option value="Điện">Điện</option>
                                            <option value="Hybrid">Hybrid</option>
                                        </select>
                                        <label for="fuel_type"><i class="fas fa-gas-pump me-2"></i>Loại nhiên liệu</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="seats" name="seats" placeholder="Số ghế" required>
                                        <label for="seats"><i class="fas fa-chair me-2"></i>Số ghế</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="transmission" name="transmission" required>
                                            <option value="" selected disabled>Chọn hộp số</option>
                                            <option value="Số tự động">Số tự động</option>
                                            <option value="Số sàn">Số sàn</option>
                                            <option value="Bán tự động">Bán tự động</option>
                                            <option value="Vô cấp CVT">Vô cấp CVT</option>
                                        </select>
                                        <label for="transmission"><i class="fas fa-cogs me-2"></i>Hộp số</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="price_per_day" name="price_per_day" placeholder="Giá thuê mỗi ngày (VNĐ)" required>
                                <label for="price_per_day"><i class="fas fa-money-bill-wave me-2"></i>Giá thuê mỗi ngày (VNĐ)</label>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label"><i class="fas fa-image me-2"></i>Hình ảnh xe</label>
                                <div class="input-group">
                                    <input type="file" class="form-control custom-file-input" id="image" name="image" accept=".jpg, .jpeg, .png, .gif" required>
                                    <label class="input-group-text" for="image">Browse</label>
                                </div>
                                <div id="imagePreview" class="mt-2 text-center d-none">
                                    <img src="" class="img-thumbnail" style="max-height: 200px;" alt="Image Preview">
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="btn btn-secondary" href="./cars-manage"><i class="fas fa-arrow-left me-1"></i>Quay lại</a>
                                <button type="submit" name="btnAdd" class="btn btn-success btn-lg"><i class="fas fa-plus-circle me-2"></i>Thêm xe</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small text-muted">Vui lòng điền đầy đủ thông tin</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Preview image before upload
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');
    const file = e.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('d-none');
    }
});

// Form validation
(function() {
    'use strict';
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
})();

// Initialize Select2 for enhanced comboboxes
$(document).ready(function() {
    $('#brand, #type, #fuel_type, #transmission').select2({
        theme: 'bootstrap-5',
        width: '100%',
        dropdownParent: $('.card-body')
    });
    
    // Fix for floating labels with Select2
    $('.form-floating select').on('select2:open', function() {
        $(this).parent().addClass('form-floating-active');
    }).on('select2:close', function() {
        if (!$(this).val()) {
            $(this).parent().removeClass('form-floating-active');
        }
    });
});
</script>

<?php 
$content = ob_get_clean();
require 'views/_layout/admin.php';
?>