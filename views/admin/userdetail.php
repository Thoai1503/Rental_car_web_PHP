<?php
ob_start();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">User Detail</h1>
    
    <div class="user-detail">
        <p><strong>ID:</strong> <?= $user->getId() ?></p>
        <p><strong>Name:</strong> <?= $user->getName() ?></p>
        <p><strong>Email:</strong> <?= $user->getEmail() ?></p>
        <p><strong>Phone:</strong> <?= $user->getPhone() ?></p>
        <p><strong>Status:</strong> <?= $user->getStatus() ?></p>
    </div>

    <h2>User Bookings</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Car Name</th>
                <th>Total Price</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= $booking->getId() ?></td>
                    <td><?= $booking->getCarId() ?></td>
                    <td><?= $booking->getTotalPrice() ?></td>
                    <td><?= $booking->getStartDate() ?></td>
                    <td><?= $booking->getEndDate() ?></td>
                    <td><?= $booking->getStatus() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



<?php
$content = ob_get_clean();
require_once 'views/_layout/admin.php';
?>