<?php
ob_start(); 
?>
       
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
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
                                DataTable Example
                            </div>
                            <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Tên Xe</th>
                                        <th>Hãng xe</th>
                                        <th>Loại xe</th>
                                        <th>Age</th>
                                        <th>Số chỗ</th>
                                   
                                     
                                        <th>Hộp số</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th>Image</th>
                                        <th>Tên Xe</th>
                                        <th>Hãng xe</th>
                                        <th>Loại xe</th>
                                        <th>Age</th>
                                        <th>Số chỗ</th>
                                        <th>Hộp số</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        if (isset($cars)&& count($cars)>0){
                                            foreach($cars as $car){
                                                ?>
                                    <tr>
                                        <td><img src="../uploads/<?= $car->getImage() ?>" alt="<?= $car->getName() ?>"
                                                width="150"></td>
                                        <td><?= $car->getName() ?></td>
                                        <td><?= $car->getBrand() ?></td>
                                        <td><?= $car->getType() ?></td>
                                        <td><?= $car->getBrand() ?></td>
                                        <td><?= $car->getSeats() ?></td>
                                        <td><?= $car->getTransmission() ?></td>
                                        <td>
                                            <?php
                                                        if($car->getStatus() == "available"){
                                                            ?>
                                            <input type="checkbox" checked value="" data-id="<?= $car->getId() ?>"
                                                onchange="updateStatus2(event)" />
                                            <?php
                                                        }else{
                                                            ?>
                                            <input type="checkbox" value="" data-id="<?= $car->getId() ?>"
                                                onchange="updateStatus2(event)" />
                                            <?php
                                                        }
                                                        ?>


                                        </td>
                                    </tr>

                                    <?php
                                            }
                                        }
                                        ?>

                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </main>
                <script>
                    function updateStatus2(event) {
    var checkbox = event.target;
    var carId = checkbox.getAttribute("data-id");
    var status = checkbox.checked ? "available" : "unavailable";
    const modal = document.getElementById('exampleModal');
  
  // Initialize Bootstrap modal
  const bootstrapModal = new bootstrap.Modal(modal);
  
    // Use jQuery AJAX for better browser compatibility and cleaner code
    // $.ajax({
    //     url: "admin/updateCarStatus",
    //     type: "POST",
    //     data: {
    //         carId: carId,
    //         status: status
    //     },
    //     dataType: "json",
    //     success: function(response) {
    //         if (response.success) {
    //             alert("Car status updated successfully to: " + status);
    //         } else {
    //             alert("Failed to update car status: " + (response.message || "Unknown error"));
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         alert("Error updating car status: " + error);
    //         // Revert checkbox to original state on error
    //         checkbox.checked = !checkbox.checked;
    //     }
    // });
    fetch('../admin/updateCarStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        carId: carId,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(response => {
                    console.log('Server Response:', response.data.carId); // Xử lý phản hồi từ server nếu cần
                })
                .catch(error => {
                    console.error('Error:', error);
                });
}

                </script>
<?php
$content = ob_get_clean();

require 'views/_layout/admin.php';
?>
