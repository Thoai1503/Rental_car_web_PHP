<?php // views/client/_car_items.php // This partial view contains just the car cards/items ?>

<?php if (isset($cars) && count($cars) > 0): ?>
  <?php foreach ($cars as $car): ?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="item-1 shadow-sm">
        <a href="#">
          <img src="http://localhost/car_rent/uploads/<?php echo $car->getImage(); ?>" style="height: 150px; width: 100%; object-fit: cover;" alt="<?php echo htmlspecialchars($car->getName()); ?>" class="img-fluid" />
        </a>
        <div class="item-1-contents p-3">
          <div class="text-center">
            <h3 class="h5"><a href="#" class="text-decoration-none"><?php echo htmlspecialchars($car->getName()); ?></a></h3>
            <div class="rating mb-2">
              <?php for ($s = 0; $s < 5; $s++): ?>
                <span class="icon-star text-warning">★</span>
              <?php endfor; ?>
            </div>
            <div class="rent-price mb-3"><span class="fw-bold text-primary">$<?php echo number_format($car->getPricePerDay(), 2); ?>/</span>day</div>
          </div>
          <ul class="specs list-unstyled mb-3">
            <li class="d-flex justify-content-between border-bottom py-2">
              <span class="text-muted">Doors</span>
              <span class="spec fw-medium">4</span>
            </li>
            <li class="d-flex justify-content-between border-bottom py-2">
              <span class="text-muted">Seats</span>
              <span class="spec fw-medium">5</span>
            </li>
            <li class="d-flex justify-content-between border-bottom py-2">
              <span class="text-muted">Transmission</span>
              <span class="spec fw-medium"><?php echo ucfirst(htmlspecialchars($car->getTransmission())); ?></span>
            </li>
            <li class="d-flex justify-content-between py-2">
              <span class="text-muted">Minimum age</span>
              <span class="spec fw-medium">18 years</span>
            </li>
          </ul>
          <div class="d-flex gap-2">
            <!-- Rent Now button -->
            <a href="rent?car_id=<?php echo $car->getId(); ?>" class="btn btn-primary flex-grow-1">Rent Now</a>
            
            <!-- View Details button -->
            <a href="car_detail?id=<?php echo $car->getId(); ?>" class="btn btn-outline-primary ml-2">
              <i class="bi bi-info-circle"></i> View Details
            </a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <div class="col-12">
    <div class="alert alert-info text-center p-5">
      <i class="bi bi-info-circle me-2"></i>
      <p class="mb-0">No cars match your criteria. Try adjusting your filters.</p>
    </div>
  </div>
<?php endif; ?>