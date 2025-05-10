<?php
// payment_form.php - Payment processing form for car rental
// Assuming we have $car object and $rental_details from controller

// Start output buffering
ob_start();
?>

<div class="container py-5">
  <form id="payment-form" method="post" action="/car_rent/submitpayment">
    <div class="row">
      <!-- Car Summary Card -->
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card shadow-sm border-0 rounded-3 h-100">
          <div class="card-header bg-primary bg-opacity-10 border-0">
            <h5 class="mb-0 text-primary fw-bold">Rental Summary</h5>
          </div>
          
          <!-- Car Image -->
          <img src="http://localhost/car_rent/uploads/<?php echo $car->getImage(); ?>" 
               class="card-img-top p-3" 
               style="height: 200px; object-fit: contain;" 
               alt="<?php echo htmlspecialchars($car->getName()); ?>">
          
          <div class="card-body">
            <!-- Car Details -->
            <h4 class="card-title fw-bold"><?php echo htmlspecialchars($car->getName()); ?></h4>
            
            <div class="d-flex align-items-center mb-3">
              <div class="rating me-2">
                <?php for ($s = 0; $s < 5; $s++): ?>
                  <span class="icon-star text-warning">★</span>
                <?php endfor; ?>
              </div>
              <span class="text-muted small">(<?php echo mt_rand(10, 50); ?> reviews)</span>
            </div>
            
            <!-- Car Specifications -->
            <ul class="list-group list-group-flush mb-4">
              <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                <span class="text-muted">Transmission</span>
                <span class="fw-medium"><?php echo ucfirst(htmlspecialchars($car->getTransmission())); ?></span>
              </li>
              <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                <span class="text-muted">Seats</span>
                <span class="fw-medium">5</span>
              </li>
              <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                <span class="text-muted">Doors</span>
                <span class="fw-medium">4</span>
              </li>
            </ul>
            
            <!-- Rental Details -->
            <h6 class="fw-bold mb-3">Rental Period</h6>
            
  			
  			    			
  			    					<div class="form-group">
  			                <label for="" class="label">Pick-up date</label>
  			                <input type="date" class="form-control" id="book_pick_date" placeholder="Date" name="pickup_date" onchange="inputStartDate(event)"  required>
  			              </div>
  			            
  		            
  		              <div class="form-group">
  		                <label for="" class="label">Drop-off date</label>
  		                <input type="date" class="form-control" id="time_pick" placeholder="Time" name="dropoff_date" onchange="inputEndDate(event)" required>
  		              </div>
                    <div class="bg-light p-3 rounded-3 mb-4">
              <div class="row mb-2">
                <div class="col-5 text-muted">Pick-up:</div>
                <div id="pickup_date" class="col-7 fw-medium">____/__/__</div>
              </div>
              <div class="row mb-2">
                <div class="col-5 text-muted">Return:</div>
                <div id="dropoff_date" class="col-7 fw-medium">____/__/__</div>
              </div>
              <div class="row">
                <div class="col-5 text-muted">Duration:</div>
                <div id="duration" class="col-7 fw-medium">0 days</div>
              </div>
            </div>
            
            <!-- Price Breakdown -->
            <h6 class="fw-bold mb-3">Price Details</h6>
            <div class="mb-2 d-flex justify-content-between">
              <span>Daily Rate:</span>
              <span class="fw-medium"><?php echo number_format($car->getPricePerDay(), 0); ?> VND</span>
            </div>
            <div class="mb-2 d-flex justify-content-between">
              <span id="rental_show" >Rental Period (_ days):</span>
              <span id="total_show" class="fw-medium">0 VND</span>
            </div>
          
            <div class="mb-2 d-flex justify-content-between">
              <span>Tax (10%):</span>
              <span id="tax_show" class="fw-medium">
                <?php 
                  $tax = ($car->getPricePerDay() * 0.1);
                  echo number_format($tax, 0); 
                ?> VND
               </span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold">
              <span>Total:</span>
              <span id="total_price_show" class="text-primary fs-5">
                <?php 
                  $total = ($car->getPricePerDay() + $tax);
                  echo number_format($total, 0); 
                ?> VND
                 
              </span>
              <input id="total_price" type="hidden" name="total_price" value="<?php echo $total; ?>">
            </div>
          </div>
        </div>
      </div>
      
      <!-- Payment Form -->
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-3">
          <div class="card-header bg-primary bg-opacity-10 border-0">
            <h5 class="mb-0 text-primary fw-bold">Payment Information</h5>
          </div>
          <div class="card-body p-4">
            <!-- <form id="payment-form" method="post" action="process_payment"> -->
              <input id="car_id" type="hidden" name="car_id" value="<?php echo $car->getId(); ?>">
              <input id="price_per_day" type="hidden" name="total_amount" value="<?php echo $car->getPricePerDay(); ?>">
              
              <!-- Customer Information -->
              <h6 class="fw-bold mb-3">Customer Information</h6>
              <?php
              if (isset($_SESSION['user'])) {
              
              ?>
                   <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="first_name" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$_SESSION['user']['name']?>" required>
                </div>
                <div class="col-md-6">
                  <label for="last_name" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" value="<?=$_SESSION['user']['name']?>" required>
                </div>
              </div>
              
              <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?=$_SESSION['user']['email']?>" required>
                </div>
                <div class="col-md-6">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" id="phone" name="phone" value="<?=$_SESSION['user']['phone']?>"  required>
                </div>
              </div>
              <?php } else{ ?>
             
              <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="first_name" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="col-md-6">
                  <label for="last_name" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
              </div>
              
              <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
              </div>
              <?php
              }
              ?>
              
              <div class="mb-4">
                <label for="address" class="form-label">Street Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
              </div>
              
              <div class="row mb-4">
                <div class="col-md-5 mb-3 mb-md-0">
                  <label for="city" class="form-label">City</label>
                  <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <label for="state" class="form-label">State/Province</label>
                  <input type="text" class="form-control" id="state" name="state" required>
                </div>
                <div class="col-md-3">
                  <label for="zip" class="form-label">Zip/Postal Code</label>
                  <input type="text" class="form-control" id="zip" name="zip" required>
                </div>
              </div>
              
              <hr class="my-4">
              
              <!-- Driver Information -->
              <h6 class="fw-bold mb-3">Driver Information</h6>
              <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="license_number" class="form-label">Driver's License Number</label>
                  <input type="text" class="form-control" id="license_number" name="license_number" required>
                </div>
                <div class="col-md-6">
                  <label for="license_expiry" class="form-label">License Expiry Date</label>
                  <input type="date" class="form-control" id="license_expiry" name="license_expiry" required>
                </div>
              </div>
              
              <div class="mb-4">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
              </div>
              
              <hr class="my-4">
              
              <!-- Payment Method -->
              <h6 class="fw-bold mb-3">Payment Method</h6>
              <div class="mb-4">
                <div class="d-flex gap-3 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" checked>
                    <label class="form-check-label" for="credit_card">
                      Credit Card
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                    <label class="form-check-label" for="paypal">
                      PayPal
                    </label>
                  </div>
                </div>
                
                <!-- Credit Card Details (shown by default) -->
                <div id="credit-card-details">
                  <div class="mb-3">
                    <label for="card_number" class="form-label">Card Number</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456">
                      <span class="input-group-text">
                        <i class="bi bi-credit-card"></i>
                      </span>
                    </div>
                  </div>
                  
                  <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                      <label for="expiry_date" class="form-label">Expiry Date</label>
                      <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY">
                    </div>
                    <div class="col-md-6">
                      <label for="cvv" class="form-label">CVV</label>
                      <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123">
                    </div>
                  </div>
                  
                  <div class="mb-4">
                    <label for="card_name" class="form-label">Name on Card</label>
                    <input type="text" class="form-control" id="card_name" name="card_name">
                  </div>
                </div>
                
                <!-- PayPal Instructions (hidden by default) -->
                <div id="paypal-details" class="d-none">
                  <div class="alert alert-info">
                    <p class="mb-0">You will be redirected to PayPal to complete your payment after submitting this form.</p>
                  </div>
                </div>
              </div>
              
              <hr class="my-4">
              
              <!-- Additional Options -->
              <h6 class="fw-bold mb-3">Additional Options</h6>
              <div class="mb-4">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="additional_driver" name="additional_driver" value="1">
                  <label class="form-check-label" for="additional_driver">
                    Add additional driver (+$10/day)
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="gps" name="gps" value="1">
                  <label class="form-check-label" for="gps">
                    GPS Navigation System (+$5/day)
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="child_seat" name="child_seat" value="1">
                  <label class="form-check-label" for="child_seat">
                    Child Safety Seat (+$7/day)
                  </label>
                </div>
              </div>
              
              <!-- Terms and Conditions -->
              <div class="mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                  <label class="form-check-label" for="terms">
                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>
                  </label>
                </div>
              </div>
              
              <!-- Submit Button -->
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Complete Payment</button>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>Rental Agreement Terms</h6>
        <p>By renting a vehicle from our company, you agree to the following terms and conditions:</p>
        <ol>
          <li>You must be at least 18 years old and possess a valid driver's license.</li>
          <li>You are responsible for any damage to the vehicle during your rental period.</li>
          <li>Full payment is required at the time of booking.</li>
          <li>Cancellations made 24 hours or more before pickup will receive a full refund minus a processing fee.</li>
          <li>Cancellations made less than 24 hours before pickup will incur a one-day rental charge.</li>
          <li>The vehicle must be returned with the same amount of fuel as when it was picked up.</li>
          <li>Smoking is not permitted in any of our vehicles.</li>
          <li>Pets are only allowed in designated vehicles and with prior approval.</li>
        </ol>
        <h6>Insurance Coverage</h6>
        <p>Basic insurance is included in your rental price. This covers:</p>
        <ul>
          <li>Collision Damage Waiver with a $500 deductible</li>
          <li>Third-party liability up to $50,000</li>
          <li>Personal accident insurance</li>
        </ul>
        <p>Additional premium insurance packages are available for purchase at the time of pickup.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
      </div>
    </div>
  </div>
</div>

<script>

function inputStartDate(event) {
  var input = event.target;
  var dateValue = new Date(input.value);
  var year = dateValue.getFullYear();
  var month = String(dateValue.getMonth() + 1).padStart(2, '0');
  var day = String(dateValue.getDate()).padStart(2, '0');
  const startDate = `${year}-${month}-${day}`;

  fetch('updateInputDate', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ start_date: startDate })
  })
  .then(response => response.json())
  .then(data => {
    if (data) {
      console.log('Start date updated successfully:', data.start_date);
      document.getElementById('pickup_date').innerText = data.start_date;
    } else {
      console.error('Error updating start date:', data.error);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  }); 
}

function inputEndDate(event) {
  var input = event.target;
  var dateValue = new Date(input.value);
  var year = dateValue.getFullYear();
  var month = String(dateValue.getMonth() + 1).padStart(2, '0');
  var day = String(dateValue.getDate()).padStart(2, '0');
  const endDate = `${year}-${month}-${day}`;
  var carId = document.getElementById('car_id').value;
  var pricePerDay = document.getElementById('price_per_day').value;

  fetch('updateInputDate', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ end_date: endDate })
  })
  .then(response => response.json())
  .then(data => {
    if (data) {
      console.log('End date updated successfully:', data);
      document.getElementById('dropoff_date').innerText = data.end_date;
      document.getElementById('duration').innerText = data.days + ' days';
 var total=(data.days * pricePerDay);
      var totalPrice = (data.days * pricePerDay) + ((data.days * pricePerDay) * 0.1);
      var tax = (data.days * pricePerDay) * 0.1;
      document.getElementById('tax_show').innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(tax);
      document.getElementById('total_show').innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(total);
      document.getElementById('total_price').value = totalPrice;
      document.getElementById('total_price_show').innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(totalPrice);
      document.getElementById('rental_show').innerText = 'Rental Period (' + data.days + ' days):';

    } else {
      console.error('Error updating end date:', data.error);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  }); 
}


document.addEventListener('DOMContentLoaded', function() {
  // Toggle payment method details
  document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
      if (this.value === 'credit_card') {
        document.getElementById('credit-card-details').classList.remove('d-none');
        document.getElementById('paypal-details').classList.add('d-none');
      } else if (this.value === 'paypal') {
        document.getElementById('credit-card-details').classList.add('d-none');
        document.getElementById('paypal-details').classList.remove('d-none');
      }
    });
  });
  
  // Simple form validation
  document.getElementById('payment-form').addEventListener('submit', function(e) {
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    
    if (paymentMethod === 'credit_card') {
      const cardNumber = document.getElementById('card_number').value;
      const expiryDate = document.getElementById('expiry_date').value;
      const cvv = document.getElementById('cvv').value;
      const cardName = document.getElementById('card_name').value;
      
      if (!cardNumber || !expiryDate || !cvv || !cardName) {
        e.preventDefault();
        alert('Please fill in all credit card details');
      }
    }
    
    // Check if terms checkbox is checked
    if (!document.getElementById('terms').checked) {
      e.preventDefault();
      alert('You must agree to the Terms and Conditions');
    }
  });
  
  // Format credit card number with spaces
  document.getElementById('card_number').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '');
    if (value.length > 0) {
      value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
    }
    e.target.value = value;
  });
  
  // Format expiry date with forward slash
  document.getElementById('expiry_date').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 2) {
      value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    e.target.value = value;
  });
});
</script>


<?php
// Get the buffered content
$clientContent = ob_get_clean();

// Include the layout
require 'views/_layout/client.php';
?>