<?php
// rental_confirmation.php - Confirmation page after successful payment processing
// Assuming we have $car object, $rental_details, $customer, $payment, and $booking_id variables from controller

// Start output buffering
ob_start();
?>

<div class="container py-5">
  <!-- Success Alert -->
  <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
    <i class="bi bi-check-circle-fill me-2 fs-4"></i>
    <div>
      <strong>Booking Confirmed!</strong> Your car rental has been successfully processed.
    </div>
  </div>
  
  <!-- Booking Reference -->
  <div class="card shadow-sm border-0 rounded-3 mb-4">
    <div class="card-header bg-primary bg-opacity-10 border-0">
      <h5 class="mb-0 text-primary fw-bold">Booking Reference</h5>
    </div>
    <div class="card-body p-4">
      <div class="row align-items-center">
        <div class="col-md-6">
          <p class="mb-2"><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking_id); ?></p>
          <p class="mb-2"><strong>Booking Date:</strong> <?php echo date('M d, Y h:i A'); ?></p>
          <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success">Confirmed</span></p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
          <a href="javascript:window.print()" class="btn btn-outline-primary me-2">
            <i class="bi bi-printer me-1"></i> Print
          </a>
          <a href="mailto:?subject=Car Rental Confirmation&body=Your booking has been confirmed with ID: <?php echo htmlspecialchars($booking_id); ?>" class="btn btn-outline-primary">
            <i class="bi bi-envelope me-1"></i> Email
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Car and Rental Details -->
    <div class="col-lg-6 mb-4">
      <div class="card shadow-sm border-0 rounded-3 h-100">
        <div class="card-header bg-primary bg-opacity-10 border-0">
          <h5 class="mb-0 text-primary fw-bold">Rental Details</h5>
        </div>
        <div class="card-body p-4">
          <div class="row mb-4">
            <div class="col-4">
              <!-- Car Image -->
              <img src="http://localhost/car_rent/uploads/<?php echo $car->getImage(); ?>" 
                  class="img-fluid rounded" 
                  alt="<?php echo htmlspecialchars($car->getName()); ?>">
            </div>
            <div class="col-8">
              <!-- Car Details -->
              <h5 class="card-title fw-bold mb-2"><?php echo htmlspecialchars($car->getName()); ?></h5>
              <p class="text-muted mb-3">
                <span class="me-3"><i class="bi bi-gear me-1"></i><?php echo ucfirst(htmlspecialchars($car->getTransmission())); ?></span>
                <span class="me-3"><i class="bi bi-people me-1"></i>5 Seats</span>
                <span><i class="bi bi-door-closed me-1"></i>4 Doors</span>
              </p>
              <div class="d-flex mb-0">
                <div class="rating me-2">
                  <?php for ($s = 0; $s < 5; $s++): ?>
                    <span class="icon-star text-warning">★</span>
                  <?php endfor; ?>
                </div>
                <span class="text-muted small">(<?php echo mt_rand(10, 50); ?> reviews)</span>
              </div>
            </div>
          </div>
          
          <!-- Rental Period -->
          <h6 class="fw-bold mb-3">Rental Period</h6>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <div class="bg-light p-3 rounded-3 h-100">
                <div class="mb-1 text-muted small">Pick-up Date & Time</div>
                <div class="fw-medium">
                  <i class="bi bi-calendar me-2"></i>
                  <?php echo isset($rental_details['pickup_date']) ? htmlspecialchars($rental_details['pickup_date']) : date('M d, Y'); ?>
                </div>
                <div class="fw-medium">
                  <i class="bi bi-clock me-2"></i>
                  <?php echo isset($rental_details['pickup_time']) ? htmlspecialchars($rental_details['pickup_time']) : '10:00 AM'; ?>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="bg-light p-3 rounded-3 h-100">
                <div class="mb-1 text-muted small">Return Date & Time</div>
                <div class="fw-medium">
                  <i class="bi bi-calendar me-2"></i>
                  <?php echo isset($rental_details['return_date']) ? htmlspecialchars($rental_details['return_date']) : date('M d, Y', strtotime('+3 days')); ?>
                </div>
                <div class="fw-medium">
                  <i class="bi bi-clock me-2"></i>
                  <?php echo isset($rental_details['return_time']) ? htmlspecialchars($rental_details['return_time']) : '10:00 AM'; ?>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Pick-up Location -->
          <h6 class="fw-bold mb-3">Pick-up & Return Location</h6>
          <div class="bg-light p-3 rounded-3 mb-4">
            <address class="mb-0">
              <i class="bi bi-geo-alt me-2"></i>
              <?php echo isset($rental_details['location']) ? htmlspecialchars($rental_details['location']) : 'Main Office - 123 Car Rental St, City'; ?>
            </address>
          </div>
          
          <!-- Additional Options -->
          <?php 
          $has_additional_options = isset($rental_details['additional_driver']) || 
                                   isset($rental_details['gps']) || 
                                   isset($rental_details['child_seat']);
          if ($has_additional_options):
          ?>
          <h6 class="fw-bold mb-3">Additional Options</h6>
          <ul class="list-group list-group-flush mb-0">
            <?php if (isset($rental_details['additional_driver']) && $rental_details['additional_driver']): ?>
            <li class="list-group-item px-0 py-2 d-flex justify-content-between border-0">
              <span><i class="bi bi-person-plus me-2"></i> Additional Driver</span>
              <span class="fw-medium">$<?php echo number_format(10 * (isset($rental_details['days']) ? $rental_details['days'] : 3), 2); ?></span>
            </li>
            <?php endif; ?>
            
            <?php if (isset($rental_details['gps']) && $rental_details['gps']): ?>
            <li class="list-group-item px-0 py-2 d-flex justify-content-between border-0">
              <span><i class="bi bi-compass me-2"></i> GPS Navigation System</span>
              <span class="fw-medium">$<?php echo number_format(5 * (isset($rental_details['days']) ? $rental_details['days'] : 3), 2); ?></span>
            </li>
            <?php endif; ?>
            
            <?php if (isset($rental_details['child_seat']) && $rental_details['child_seat']): ?>
            <li class="list-group-item px-0 py-2 d-flex justify-content-between border-0">
              <span><i class="bi bi-shield-check me-2"></i> Child Safety Seat</span>
              <span class="fw-medium">$<?php echo number_format(7 * (isset($rental_details['days']) ? $rental_details['days'] : 3), 2); ?></span>
            </li>
            <?php endif; ?>
          </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
    
    <!-- Customer Info and Payment Summary -->
    <div class="col-lg-6">
      <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-header bg-primary bg-opacity-10 border-0">
          <h5 class="mb-0 text-primary fw-bold">Customer Information</h5>
        </div>
        <div class="card-body p-4">
          <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
              <p class="text-muted mb-1">Full Name</p>
              <p class="fw-medium mb-0">
                <?php echo htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']); ?>
              </p>
            </div>
            <div class="col-md-6">
              <p class="text-muted mb-1">Email Address</p>
              <p class="fw-medium mb-0"><?php echo htmlspecialchars($customer['email']); ?></p>
            </div>
          </div>
          
          <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
              <p class="text-muted mb-1">Phone Number</p>
              <p class="fw-medium mb-0"><?php echo htmlspecialchars($customer['phone']); ?></p>
            </div>
            <div class="col-md-6">
              <p class="text-muted mb-1">Driver's License</p>
              <p class="fw-medium mb-0"><?php echo htmlspecialchars($customer['license_number']); ?></p>
            </div>
          </div>
          
          <div class="mb-0">
            <p class="text-muted mb-1">Address</p>
            <p class="fw-medium mb-0">
              <?php echo htmlspecialchars($customer['address']); ?><br>
              <?php echo htmlspecialchars($customer['city'] . ', ' . $customer['state'] . ' ' . $customer['zip']); ?>
            </p>
          </div>
        </div>
      </div>
      
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary bg-opacity-10 border-0">
          <h5 class="mb-0 text-primary fw-bold">Payment Summary</h5>
        </div>
        <div class="card-body p-4">
          <!-- Payment Method -->
          <div class="mb-4">
            <p class="text-muted mb-1">Payment Method</p>
            <p class="fw-medium mb-0">
              <?php if ($payment['payment_method'] === 'credit_card'): ?>
                <i class="bi bi-credit-card me-2"></i> Credit Card (ending in <?php echo substr($payment['card_number'], -4); ?>)
              <?php else: ?>
                <i class="bi bi-paypal me-2"></i> PayPal
              <?php endif; ?>
            </p>
          </div>
          
          <!-- Price Breakdown -->
          <h6 class="fw-bold mb-3">Price Details</h6>
          <div class="mb-2 d-flex justify-content-between">
            <span>Daily Rate:</span>
            <span class="fw-medium">$<?php echo number_format($car->getPricePerDay(), 2); ?></span>
          </div>
          <div class="mb-2 d-flex justify-content-between">
            <span>Rental Period (<?php echo isset($rental_details['days']) ? $rental_details['days'] : '3'; ?> days):</span>
            <span class="fw-medium">$<?php echo number_format($car->getPricePerDay() * (isset($rental_details['days']) ? $rental_details['days'] : 3), 2); ?></span>
          </div>
          <div class="mb-2 d-flex justify-content-between">
            <span>Insurance:</span>
            <span class="fw-medium">$<?php echo number_format((isset($rental_details['days']) ? $rental_details['days'] : 3) * 25, 2); ?></span>
          </div>
          
          <!-- Additional Options in Payment Summary -->
          <?php if (isset($rental_details['additional_driver']) && $rental_details['additional_driver']): ?>
          <div class="mb-2 d-flex justify-content-between">
            <span>Additional Driver:</span>
            <span class="fw-medium">$<?php echo number_format(10 * (isset($rental_details['days']) ? $rental_details['days'] : 3), 2); ?></span>
          </div>
          <?php endif; ?>
          
          <?php if (isset($rental_details['gps']) && $rental_details['gps']): ?>
          <div class="mb-2 d-flex justify-content-between">
            <span>GPS Navigation:</span>
            <span class="fw-medium">$<?php echo number_format(5 * (isset($rental_details['days']) ? $rental_details['days'] : 3), 2); ?></span>
          </div>
          <?php endif; ?>
          
          <?php if (isset($rental_details['child_seat']) && $rental_details['child_seat']): ?>
          <div class="mb-2 d-flex justify-content-between">
            <span>Child Safety Seat:</span>
            <span class="fw-medium">$<?php echo number_format(7 * (isset($rental_details['days']) ? $rental_details['days'] : 3), 2); ?></span>
          </div>
          <?php endif; ?>
          
          <?php
          // Calculate additional costs
          $additional_cost = 0;
          if (isset($rental_details['additional_driver']) && $rental_details['additional_driver']) {
            $additional_cost += 10 * (isset($rental_details['days']) ? $rental_details['days'] : 3);
          }
          if (isset($rental_details['gps']) && $rental_details['gps']) {
            $additional_cost += 5 * (isset($rental_details['days']) ? $rental_details['days'] : 3);
          }
          if (isset($rental_details['child_seat']) && $rental_details['child_seat']) {
            $additional_cost += 7 * (isset($rental_details['days']) ? $rental_details['days'] : 3);
          }
          
          // Recalculate total with additional options
          $base_rental = $car->getPricePerDay() * (isset($rental_details['days']) ? $rental_details['days'] : 3);
          $insurance = (isset($rental_details['days']) ? $rental_details['days'] : 3) * 25;
          $subtotal = $base_rental + $insurance + $additional_cost;
          $tax = $subtotal * 0.1;
          $grand_total = $subtotal + $tax;
          ?>
          
          <div class="mb-2 d-flex justify-content-between">
            <span>Tax (10%):</span>
            <span class="fw-medium">$<?php echo number_format($tax, 2); ?></span>
          </div>
          <hr>
          <div class="d-flex justify-content-between fw-bold">
            <span>Total:</span>
            <span class="text-primary fs-5">$<?php echo number_format($grand_total, 2); ?></span>
          </div>
          <hr>
          <div class="d-flex justify-content-between fw-bold">
            <span>Payment Status:</span>
            <span class="text-success">PAID</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Next Steps and Important Information -->
  <div class="card shadow-sm border-0 rounded-3 mt-4">
    <div class="card-header bg-primary bg-opacity-10 border-0">
      <h5 class="mb-0 text-primary fw-bold">Important Information</h5>
    </div>
    <div class="card-body p-4">
      <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
          <h6 class="fw-bold mb-3">Pick-up Instructions</h6>
          <ul class="list-unstyled">
            <li class="mb-2">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Please arrive at the rental location 30 minutes before your scheduled pick-up time.
            </li>
            <li class="mb-2">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Bring your driver's license, the credit card used for payment, and this booking confirmation.
            </li>
            <li class="mb-2">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Our staff will guide you through a brief vehicle inspection before handover.
            </li>
          </ul>
        </div>
        <div class="col-md-6">
          <h6 class="fw-bold mb-3">Return Information</h6>
          <ul class="list-unstyled">
            <li class="mb-2">
              <i class="bi bi-info-circle-fill text-primary me-2"></i>
              Please return the vehicle with a full tank of fuel to avoid additional charges.
            </li>
            <li class="mb-2">
              <i class="bi bi-info-circle-fill text-primary me-2"></i>
              Late returns may incur additional hourly or daily charges.
            </li>
            <li>
              <i class="bi bi-info-circle-fill text-primary me-2"></i>
              For early or late returns, please contact our customer service.
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Action Buttons -->
  <div class="mt-4 d-flex flex-wrap gap-2 justify-content-center">
    <a href="dashboard" class="btn btn-primary">
      <i class="bi bi-person me-2"></i> Go to Dashboard
    </a>
    <a href="modify_booking?id=<?php echo htmlspecialchars($booking_id); ?>" class="btn btn-outline-primary">
      <i class="bi bi-pencil me-2"></i> Modify Booking
    </a>
    <a href="contact" class="btn btn-outline-secondary">
      <i class="bi bi-headset me-2"></i> Customer Support
    </a>
  </div>
</div>

<?php
// Get the buffered content
$clientContent = ob_get_clean();

// Include the layout
require 'views/_layout/client.php';
?>