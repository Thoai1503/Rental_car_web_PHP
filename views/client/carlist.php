<?php ob_start(); ?>
<div class="container">
  <div class="row">
    <!-- Enhanced Filter Sidebar -->
    <div class="col-lg-3 mb-4">
      <form method="GET" action="searchfilter" class="filter-sidebar p-4 rounded shadow-sm bg-white">
        <h5 class="mb-4 border-bottom pb-2 fw-bold">Find Your Perfect Car</h5>
        
        <div class="mb-4">
          <label for="transmission" class="form-label fw-medium">Transmission</label>
          <select name="transmission" id="transmission" class="form-select form-select-sm border-0 bg-light">
            <option value="">All Transmissions</option>
            <option value="automatic">Automatic</option>
            <option value="manual">Manual</option>
          </select>
        </div>
        
        <div class="mb-4">
          <label for="min_age" class="form-label fw-medium">Minimum Age</label>
          <select name="min_age" id="min_age" class="form-select form-select-sm border-0 bg-light">
            <option value="">Any Age</option>
            <option value="18">18+ years</option>
            <option value="21">21+ years</option>
            <option value="25">25+ years</option>
          </select>
        </div>
        
        <div class="mb-4">
          <label for="price" class="form-label fw-medium">Max Price per Day</label>
          <div class="input-group">
            <span class="input-group-text bg-light border-0">$</span>
            <input type="number" name="price" id="price" class="form-control form-control-sm border-0 bg-light" placeholder="e.g. 300">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-medium">Car Type</label>
          <div class="d-flex flex-wrap gap-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="sedan" id="sedan" name="car_type[]">
              <label class="form-check-label small" for="sedan">Sedan</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="suv" id="suv" name="car_type[]">
              <label class="form-check-label small" for="suv">SUV</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="coupe" id="coupe" name="car_type[]">
              <label class="form-check-label small" for="coupe">Coupe</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="convertible" id="convertible" name="car_type[]">
              <label class="form-check-label small" for="convertible">Convertible</label>
            </div>
          </div>
        </div>
        
        <div class="mb-4">
          <label class="form-label fw-medium">Features</label>
          <div class="d-flex flex-wrap gap-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="gps" id="gps">
              <label class="form-check-label small" for="gps">GPS</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="bluetooth" id="bluetooth">
              <label class="form-check-label small" for="bluetooth">Bluetooth</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="sunroof" id="sunroof">
              <label class="form-check-label small" for="sunroof">Sunroof</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="child_seat" id="child_seat">
              <label class="form-check-label small" for="child_seat">Child Seat</label>
            </div>
          </div>
        </div>
        
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Apply Filters</button>
          <button type="reset" class="btn btn-outline-secondary btn-sm">Reset All</button>
        </div>
      </form>

      <!-- Added Promotion Box -->
      <div class="mt-4 p-4 rounded shadow-sm bg-primary bg-opacity-10 border border-primary border-opacity-25">
        <h6 class="text-primary fw-bold mb-3">Special Offer</h6>
        <p class="small">Use code <span class="fw-bold">DRIVE10</span> and get 10% off on your first rental!</p>
        <a href="#" class="btn btn-sm btn-outline-primary">Learn More</a>
      </div>
    </div>
    
    <!-- Car Listings -->
    <div class="col-lg-9">
      <div class="row">
        <!-- Repeatable Car Item -->
        <!-- <?php for ($i = 1; $i <= 6; $i++): ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="item-1">
              <a href="#">
                <img src="http://localhost/car_rent/public/client/images/img_<?php echo ($i % 3) + 1; ?>.jpg" alt="Image" class="img-fluid" />
              </a>
              <div class="item-1-contents">
                <div class="text-center">
                  <h3><a href="#">Range Rover S64 Coupe</a></h3>
                  <div class="rating">
                    <?php for ($s = 0; $s < 5; $s++): ?>
                      <span class="icon-star text-warning"></span>
                    <?php endfor; ?>
                  </div>
                  <div class="rent-price"><span>$250/</span>day</div>
                </div>
                <ul class="specs">
                  <li><span>Doors</span><span class="spec">4</span></li>
                  <li><span>Seats</span><span class="spec">5</span></li>
                  <li><span>Transmission</span><span class="spec">Automatic</span></li>
                  <li><span>Minimum age</span><span class="spec">18 years</span></li>
                </ul>
                <div class="d-flex action">
                  <a href="contact.html" class="btn btn-primary">Rent Now</a>
                </div>
              </div>
            </div>
          </div>
        <?php endfor; ?> -->

        <?php
        if (isset($cars) && count($cars)>0){
          foreach ($cars as $cars){
        ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="item-1">
              <a href="#">
                <img src="http://localhost/car_rent/uploads/<?php echo $cars->getImage(); ?>" style="height: 150px;" alt="Image" class="img-fluid" />
              </a>
              <div class="item-1-contents">
                <div class="text-center">
                  <h3><a href="#"><?php echo $cars->getName(); ?></a></h3>
                  <div class="rating">
                    <?php for ($s = 0; $s < 5; $s++): ?>
                      <span class="icon-star text-warning"></span>
                    <?php endfor; ?>
                  </div>
                  <div class="rent-price"><span>$<?php echo $cars->getPricePerDay(); ?>/</span>day</div>
                </div>
                <ul class="specs">
                  <li><span>Doors</span><span class="spec">4</span></li>
                  <li><span>Seats</span><span class="spec">5</span></li>
                  <li><span>Transmission</span><span class="spec">Automatic</span></li>
                  <li><span>Minimum age</span><span class="spec">18 years</span></li>
                </ul>
                <div class="d-flex action">
                  <a href="contact.html" class="btn btn-primary">Rent Now</a>
                </div>
              </div>
            </div>
          </div>
        <?php
          }
        }else{
          echo "<h3 class='text-center'>No Cars Available</h3>";
        }
        ?>

        
        <!-- Pagination -->
        <div class="col-12">
          <span class="p-3">1</span>
          <a href="#" class="p-3">2</a>
          <a href="#" class="p-3">3</a>
          <a href="#" class="p-3">4</a>
        </div>
      </div> <!-- end row inside col-lg-9 -->
    </div> <!-- end col-lg-9 -->
  </div> <!-- end main row -->
</div> <!-- end container -->

<style>
/* Custom CSS for Enhanced Filter Sidebar */
.filter-sidebar {
  border-radius: 10px;
  transition: all 0.3s ease;
}

.filter-sidebar:hover {
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

.filter-sidebar .form-select,
.filter-sidebar .form-control {
  border-radius: 8px;
  padding: 10px 15px;
  transition: all 0.2s ease;
}

.filter-sidebar .form-select:focus,
.filter-sidebar .form-control:focus {
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
  background-color: #f8f9fa;
}

.filter-sidebar .btn-primary {
  padding: 10px;
  border-radius: 8px;
  text-transform: uppercase;
  font-size: 0.9rem;
  letter-spacing: 0.5px;
  font-weight: 600;
}

.filter-sidebar .form-check-input:checked {
  background-color: #0d6efd;
  border-color: #0d6efd;
}

.filter-sidebar h5 {
  color: #212529;
  font-weight: 600;
}

.filter-sidebar label {
  color: #495057;
  margin-bottom: 0.5rem;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
  .filter-sidebar {
    margin-bottom: 2rem;
  }
}
</style>

<?php $clientContent = ob_get_clean(); require 'views/_layout/client.php'; ?>