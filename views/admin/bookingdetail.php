<?php
ob_start();
?>
<!--help me booking detail view include booking detail, car detail, user detail php -->


    <div class="container-fluid px-4">
        <h1 class="mt-4">Booking Detail</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/car_rent/admin/index">Dashboard</a></li>
            <li class="breadcrumb-item active">Booking Detail</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                .
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Booking Detail
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Car ID</th>
                            <th>User Phone</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>User ID</th>
                            <th>Car ID</th>
                            <th>User Phone</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php
                        if (isset($booking) ) {
                            
                                ?>
                                <tr>

                                    <td><?= $booking->getUserId() ?></td>
                                    <td><?= $booking->getCarId() ?></td>
                                    <td><?= $booking->getCarId() ?></td>
                                    <td><?= $booking->getStartDate() ?></td>
                                    <td><?= $booking->getEndDate() ?></td>

                                    <?php if ($booking->getStatus() == 'confirmed') { ?>
                                        <td><span class="badge bg-success"><?= $booking->getStatus() ?></span></td>

                                    <?php } else { ?>
                                        <td><span class="badge bg-danger"><?= $booking->getStatus() ?></span></td>

                                    <?php } ?>
                                </tr>
                            <?php 
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" class="text-center">No bookings found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <table class="table">
  <caption>List of user</caption>
  <thead>
    <tr>
      <th scope="col">User ID</th>
      <th scope="col">User Name</th>
      <th scope="col">User Email</th>
      <th scope="col">User Phone</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (isset($user) ) {
        ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getPhone() ?></td>
            <td>
                <a href="index.php?controller=user&action=update&id=<?= $user->getId() ?>" class="btn btn-primary">Detail</a>

            </td>

        </tr>
    <?php } else { ?>
        <tr>
            <td colspan="4" class="text-center">No user found</td>
        </tr>
    <?php } ?>
  
  </tbody>
</table>

     
<table class="table">
  <caption>List of car</caption>
  <thead>
    <tr>
      <th scope="col">Car ID</th>
      <th scope="col">Car Image</th>
      <th scope="col">Car Name</th>
        <th scope="col">Car Price</th>
        <th scope="col">Car Type</th>
        <th scope="col">Car Brand</th>
        <th scope="col">Car Seats</th>
        <th scope="col">Car Transmission</th>
    

    </tr>
  </thead>
  <tbody>
    
    <?php
    if (isset($booking) ) {
        ?>
        <tr>
            <td><?= $booking->getCar()->getId() ?></td>
            <td><img src="../uploads/<?= $booking->getCar()->getImage()?>" alt="<?= $booking->getCar()->getName() ?>" width="90"></td>
            <td><?= $booking->getCar()->getName() ?></td>
            <td><?= $booking->getCar()->getPricePerDay()?></td>
            <td><?= $booking->getCar()->getTypeName()?></td>
            <td><?= $booking->getCar()->getBrandName() ?></td>
            <td><?= $booking->getCar()->getSeats()?></td>
            <td><?= $booking->getCar()->getTransmission() ?></td>

        </tr>
    <?php } else { ?>
        <tr>
            <td colspan="8" class="text-center">No car found</td>
        </tr>
    <?php } ?>
  
  </tbody>
</table>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
$content = ob_get_clean();
require_once 'views/_layout/admin.php';
?>


