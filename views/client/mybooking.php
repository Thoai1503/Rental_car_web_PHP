<?php ob_start(); ?>
<!-- Enhanced Booking List View for the Client -->
<div class="container py-5">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0"><i class="fas fa-calendar-check me-2"></i>My Bookings</h2>
        </div>
        <div class="card-body">
            <?php if (isset($bookings) && count($bookings) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <caption class="visually-hidden">List of car bookings</caption>
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="fw-semibold">Car ID</th>
                                <th scope="col" class="fw-semibold">Total Price</th>
                                <th scope="col" class="fw-semibold">Start Date</th>
                                <th scope="col" class="fw-semibold">End Date</th>
                                <th scope="col" class="fw-semibold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td><?= htmlspecialchars($booking->getCarId()) ?></td>
                                    <td class="fw-bold">$<?= number_format($booking->getTotalPrice(), 2) ?></td>
                                    <td><?= date('M d, Y', strtotime($booking->getStartDate())) ?></td>
                                    <td><?= date('M d, Y', strtotime($booking->getEndDate())) ?></td>
                                    <td class="text-center">
                                        <?php
                                        $today = new DateTime();
                                        $endDate = new DateTime($booking->getEndDate());
                                        $startDate = new DateTime($booking->getStartDate());
                                        
                                        if ($today > $endDate): ?>
                                            <span class="badge bg-secondary">Completed</span>
                                        <?php elseif ($today >= $startDate && $today <= $endDate): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-primary">Upcoming</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5 my-4">
                    <i class="fas fa-calendar-xmark text-muted mb-3" style="font-size: 3rem;"></i>
                    <p class="lead text-muted">You don't have any bookings yet.</p>
                    <a href="index.php?page=cars" class="btn btn-primary mt-3">
                        <i class="fas fa-car me-2"></i>Browse Available Cars
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add Fontawesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Add SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom CSS for additional styling -->
<style>
    .table th, .table td {
        padding: 1rem 0.75rem;
    }
    
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: 0;
        padding: 1rem 1.25rem;
    }
    
    .badge {
        padding: 0.5rem 0.75rem;
        font-weight: 500;
    }
    
    @media (max-width: 767.98px) {
        .table-responsive {
            margin-left: -1rem;
            margin-right: -1rem;
            width: calc(100% + 2rem);
        }
    }
</style>

<!-- JavaScript for enhancing booking table interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enable row highlighting on hover
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('click', function() {
            const carId = this.cells[0].textContent;
            const startDate = this.cells[2].textContent;
            const endDate = this.cells[3].textContent;
            
            Swal.fire({
                title: 'Booking Details',
                html: `
                    <div class="text-start">
                        <p><strong>Car ID:</strong> ${carId}</p>
                        <p><strong>Rental Period:</strong> ${startDate} - ${endDate}</p>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Close',
                confirmButtonColor: '#0d6efd'
            });
        });
    });
});
</script>

<?php $clientContent = ob_get_clean(); require_once 'views/_layout/client.php'; ?>