<?php ob_start(); ?>
<div class="container">
  <div class="row">
    <!-- Enhanced Filter Sidebar -->
    <div class="col-lg-3 mb-4">
      <form id="filter-form" class="filter-sidebar p-4 rounded shadow-sm bg-white">
        <h5 class="mb-4 border-bottom pb-2 fw-bold">Find Your Perfect Car</h5>
        
        <div class="mb-4">
          <label for="transmission" class="form-label fw-medium">Transmission</label>
          <select name="transmission" id="transmission" class="form-select form-select-sm border-0 bg-light">
            <option value="">All Transmissions</option>
            <option value="automatic" <?php echo isset($_GET['transmission']) && $_GET['transmission'] === 'automatic' ? 'selected' : ''; ?>>Automatic</option>
            <option value="manual" <?php echo isset($_GET['transmission']) && $_GET['transmission'] === 'manual' ? 'selected' : ''; ?>>Manual</option>
          </select>
        </div>
        
        <div class="mb-4">
          <label for="brand" class="form-label fw-medium">Brand</label>
          <select name="brand" id="brand" class="form-select form-select-sm border-0 bg-light">
            <option value="">All</option>
            <?php
            if (isset($brands) && count($brands) > 0) {
              foreach ($brands as $brand) {
                $selected = isset($_GET['brand']) && $_GET['brand'] == $brand->getId() ? 'selected' : '';
            ?>
              <option value="<?php echo $brand->getId(); ?>" <?php echo $selected; ?>><?php echo $brand->getName(); ?></option>
            <?php
              }
            }
            ?>
          </select>
        </div>
        
        <div class="mb-4">
          <label for="price" class="form-label fw-medium">Max Price per Day</label>
          <div class="input-group">
            <span class="input-group-text bg-light border-0">$</span>
            <input type="number" name="price" id="price" class="form-control form-control-sm border-0 bg-light" 
                   placeholder="e.g. 300" value="<?php echo isset($_GET['price']) ? htmlspecialchars($_GET['price']) : ''; ?>">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-medium">Car Type</label>
          <div class="d-flex flex-wrap gap-2">
            <!-- <?php
              $carTypes = ['sedan', 'suv', 'coupe', 'convertible'];
              $selectedTypes = isset($_GET['car_type']) ? $_GET['car_type'] : [];
              
              foreach ($carTypes as $type) {
                $checked = in_array($type, $selectedTypes) ? 'checked' : '';
            ?>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="<?php echo $type; ?>" 
                       id="<?php echo $type; ?>" name="car_type[]" <?php echo $checked; ?>>
                <label class="form-check-label small" for="<?php echo $type; ?>">
                  <?php echo ucfirst($type); ?>
                </label>
              </div>
            <?php } ?> -->


            <?php
            if (isset($carTs) && count($carTs) > 0) {
              foreach ($carTs as $type) {
                $checked = isset($_GET['car_type']) && in_array($type->getId(), $_GET['car_type']) ? 'checked' : '';
            ?>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="<?php echo $type->getId(); ?>" 
                         id="<?php echo $type->getName(); ?>" name="car_type[]" <?php echo $checked; ?>>
                  <label class="form-check-label small" for="<?php echo $type->getName(); ?>">
                    <?php echo htmlspecialchars($type->getName()); ?>
                  </label>
                  </div>
            <?php
              }
            }
            ?>
          

           

          </div>
        </div>
        
        <div class="d-grid gap-2">
          <button type="button" class="btn btn-primary" id="apply-filters">Apply Filters</button>
          <button type="button" class="btn btn-outline-secondary btn-sm" id="reset-filters">Reset All</button>
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
      <!-- Filter Results Summary -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h4 class="mb-0">Available Cars</h4>
          <p class="text-muted mb-0" id="results-count">
            Showing <?php echo min($pagination['total'], $pagination['perPage']); ?> of <?php echo $pagination['total']; ?> cars
          </p>
        </div>
        <div id="loading-indicator" class="d-none">
          <div class="spinner-border spinner-border-sm text-primary" role="status">
            <!-- <span class="visually-hidden">Loading...</span> -->
          </div>
          <span class="ms-2 small text-muted">Updating results...</span>
        </div>
      </div>
      
      <!-- Car Listings Container -->
      <div class="row" id="car-listings">
        <?php require_once 'views/partial/_car_items.php'; ?>
      </div>
      
      <!-- Pagination container -->
      <div class="row mt-4">
        <div class="col-12" id="pagination-container">
          <?php require_once 'views/partial/_pagination.php'; ?>
        </div>
      </div>
    </div> <!-- end col-lg-9 -->
  </div> <!-- end main row -->
</div> <!-- end container -->

<script>
// Function to show loading indicator
function showLoading() {
  document.getElementById('loading-indicator').classList.remove('d-none');
}

// Function to hide loading indicator
function hideLoading() {
  document.getElementById('loading-indicator').classList.add('d-none');
}

// Function to serialize form data to JSON
function serializeForm(form) {
  const formData = new FormData(form);
  const jsonData = {};
  
  formData.forEach((value, key) => {
    // Handle checkboxes (car_type[])
    if (key.endsWith('[]')) {
      const cleanKey = key.slice(0, -2);
      if (!jsonData[cleanKey]) {
        jsonData[cleanKey] = [];
      }
      jsonData[cleanKey].push(value);
    } else {
      jsonData[key] = value;
    }
  });
  
  return jsonData;
}

// Function to update URL parameters without page reload
function updateUrlParams(params) {
  // Create a new URL object
  const url = new URL(window.location.href);
  
  // Clear existing query parameters
  url.search = '';
  
  // Add new parameters
  Object.keys(params).forEach(key => {
    if (Array.isArray(params[key])) {
      params[key].forEach(value => {
        url.searchParams.append(`${key}[]`, value);
      });
    } else if (params[key] !== '') {
      url.searchParams.append(key, params[key]);
    }
  });
  
  // Update browser URL without reload
  window.history.pushState({}, '', url);
}

// Function to handle all AJAX requests for both filtering and pagination
function loadCars(page = 1) {
  // Show loading indicator
  showLoading();
  
  // Display loading state in car listings area
  document.getElementById('car-listings').classList.add('opacity-50');
  
  // Get all filter form data
  const form = document.getElementById('filter-form');
  const jsonData = serializeForm(form);
  
  // Add the page parameter
  jsonData.page = page;
  jsonData.ajax = true;
  
  // Make AJAX POST request
  fetch('carlist', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest' // Add this header to identify AJAX requests
    },
    body: JSON.stringify(jsonData)
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    // Update car listings
    document.getElementById('car-listings').innerHTML = data.carHtml;
    
    // Update pagination
    document.getElementById('pagination-container').innerHTML = data.paginationHtml;
    
    // Update results count
    const resultsCountText = `Showing ${Math.min(data.perPage, data.totalResults)} of ${data.totalResults} cars`;
    document.getElementById('results-count').textContent = resultsCountText;
    
    // Update URL for bookmarking (excluding the ajax parameter)
    const urlParams = {...jsonData};
    delete urlParams.ajax;
    updateUrlParams(urlParams);
    
    // Attach event listeners to new pagination links
    attachPaginationHandlers();
    
    // Hide loading indicator
    hideLoading();
    document.getElementById('car-listings').classList.remove('opacity-50');
    
    // Scroll to top of listings if changing pages
    if (page >= 1) {
      document.querySelector('.col-lg-9').scrollIntoView({ behavior: 'smooth' });
    }
  })
  .catch(error => {
    console.error('Error loading cars:', error);
    document.getElementById('car-listings').innerHTML = '<div class="col-12 text-center"><div class="alert alert-danger">Error loading cars. Please try again.</div></div>';
    hideLoading();
    document.getElementById('car-listings').classList.remove('opacity-50');
  });
}

// Attach event handlers to pagination links
function attachPaginationHandlers() {
  const paginationLinks = document.querySelectorAll('.pagination-link');
  paginationLinks.forEach(link => {
    if (!link.parentElement.classList.contains('disabled') && 
        !link.parentElement.classList.contains('active')) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const page = this.getAttribute('data-page');
        if (page) {
          loadCars(parseInt(page));
        }
      });
    }
  });
}
// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
  // Handle filter form submission
  document.getElementById('apply-filters').addEventListener('click', function(e) {
    e.preventDefault();
    loadCars(1); // Reset to first page when filtering
  });
  
  // Handle filter reset
  document.getElementById('reset-filters').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('filter-form').reset();
    loadCars(1);
  });
  
  // Enable "Enter" key on price input to apply filters
  document.getElementById('price').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      loadCars(1);
    }
  });
  
  // Initial pagination setup
  attachPaginationHandlers();
});
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

/* Car item hover effect */
.item-1 {
  transition: all 0.3s ease;
  border-radius: 10px;
  overflow: hidden;
  height: 100%;
}

.item-1:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

/* Pagination styling */
.pagination .page-link {
  color: #0d6efd;
  border-radius: 4px;
  margin: 0 2px;
}

.pagination .page-item.active .page-link {
  background-color: #0d6efd;
  border-color: #0d6efd;
}

/* Loading state */
.opacity-50 {
  opacity: 0.5;
  transition: opacity 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
  .filter-sidebar {
    margin-bottom: 2rem;
  }
}
</style>

<?php $clientContent = ob_get_clean(); require 'views/_layout/client.php'; ?>