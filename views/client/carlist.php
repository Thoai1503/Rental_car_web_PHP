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
          <label for="min_age" class="form-label fw-medium">Brand</label>
          <select name="brand" id="min_age" class="form-select form-select-sm border-0 bg-light">
            <option value="">All</option>
            <?php
            if (isset($brands) && count($brands)>0){
              foreach ($brands as $brand){
            ?>
              <option value="<?php echo $brand->getId(); ?>"><?php echo $brand->getName(); ?></option>
            <?php
              }
              }
            ?>
            <!-- <option value="18">18+ years</option>
            <option value="21">21+ years</option>
            <option value="25">25+ years</option> -->
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
        
        <script>

function test1(event) {
  var checkbox = event.target;
        $.ajax({
            url: 'searchfilter',
            type: 'POST',
            data: {
                name: 'John',
                age: 30
            },
            dataType: 'json',
            success: function(response) {
                console.log('Server Response:', response.message); // Xử lý phản hồi từ server nếu cần
            },
            error: function(xhr, status, error) {
                console.error('Error test 1:', error);
            }
        });
    }
</script>
        

        <!-- <div class="mb-4">
          <label class="form-label fw-medium">Features</label>
          <div class="d-flex flex-wrap gap-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="gps" onchange="test1(event)" id="gps">
              <label class="form-check-label small" for="gps">GPS</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="bluetooth" onchange="test1(event)" id="bluetooth">
              <label class="form-check-label small" for="bluetooth">Bluetooth</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="sunroof" onchange="test1(event)" id="sunroof">
              <label class="form-check-label small" for="sunroof">Sunroof</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="child_seat" onchange="test1(event)" id="child_seat">
              <label class="form-check-label small" for="child_seat">Child Seat</label>
            </div>
          </div>
        </div>
    -->
        <div class="d-grid gap-2">
          <button type="button" class="btn btn-primary" onclick="searchFilter()">Apply Filters</button>
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
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
      <?php if ($pagination['hasPrevPage']): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?php echo $pagination['currentPage'] - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
      <?php else: ?>
        <li class="page-item disabled">
          <span class="page-link" aria-hidden="true">&laquo;</span>
        </li>
      <?php endif; ?>
      
      <?php
      // Determine range of page numbers to show
      $startPage = max(1, $pagination['currentPage'] - 2);
      $endPage = min($pagination['totalPages'], $pagination['currentPage'] + 2);
      
      // Always show first page
      if ($startPage > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?page=1">1</a>
        </li>
        <?php if ($startPage > 2): ?>
          <li class="page-item disabled">
            <span class="page-link">...</span>
          </li>
        <?php endif; ?>
      <?php endif; ?>
      
      <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
        <li class="page-item <?php echo $i === $pagination['currentPage'] ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>
      
      <?php 
      // Always show last page
      if ($endPage < $pagination['totalPages']): ?>
        <?php if ($endPage < $pagination['totalPages'] - 1): ?>
          <li class="page-item disabled">
            <span class="page-link">...</span>
          </li>
        <?php endif; ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?php echo $pagination['totalPages']; ?>"><?php echo $pagination['totalPages']; ?></a>
        </li>
      <?php endif; ?>
      
      <?php if ($pagination['hasNextPage']): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?php echo $pagination['currentPage'] + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      <?php else: ?>
        <li class="page-item disabled">
          <span class="page-link" aria-hidden="true">&raquo;</span>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</div>

      </div> <!-- end row inside col-lg-9 -->
    </div> <!-- end col-lg-9 -->
  </div> <!-- end main row -->
</div> <!-- end container -->



<script>
function searchFilter() {
  var form = document.querySelector('.filter-sidebar');
  var formData = new FormData(form);
  var params = new URLSearchParams(formData).toString();

  fetch('searchfilter?' + params, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
  .then(response => response.json())
  .then(data => {
    console.log('Success:', data);
    // Handle the response data as needed
  })
  .catch((error) => {
    console.error('Error:', error);
  });
}
</script>



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