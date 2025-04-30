<?php
ob_start(); // Start output buffering
?>

        <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Primary Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class
                                    ="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Warning Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Success Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Danger Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%"
                                        height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%"
                                        height="40"></canvas></div>
                            </div>
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
                                        <td><img src="uploads/<?= $car->getImage() ?>" alt="<?= $car->getName() ?>"
                                                width="90"></td>
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
          



            <!-- <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>  
            </footer> -->
        
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Lấy tất cả các nút Delete Demo
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                let itemId = this.getAttribute("data-id"); // Lấy ID của item
               // alert(itemId);
            document.getElementsByClassName("modal-body")[0].textContent += itemId; // Hiển thị trong modal
                document.getElementsByClassName("save-btn")[0].href +=  itemId; // Set href cho nút Delete
            });
        });

    });

    function updateStatus(event) {
    var checkbox = event.target;
    var carId = checkbox.getAttribute("data-id");
    var status = checkbox.checked ? "available" : "unavailable";
    
    // Use jQuery AJAX for better browser compatibility and cleaner code
    $.ajax({
        url: "admin/updateCarStatus",
        type: "POST",
        data: {
            carId: carId,
            status: status
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                alert("Car status updated successfully to: " + status);
            } else {
                alert("Failed to update car status: " + (response.message || "Unknown error"));
            }
        },
        error: function(xhr, status, error) {
            alert("Error updating car status: " + error);
            // Revert checkbox to original state on error
            checkbox.checked = !checkbox.checked;
        }
    });
}

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
    fetch('admin/updateCarStatus', {
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
                    document.querySelector('.modal-body').innerHTML ="Car have ID: "+ response.data.carId +" change into " +response.data.status + " successfully"|| 'Request was successful!';
                    bootstrapModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
}

        function loadDoc() {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("demo").innerHTML =
                    this.responseText;
            }
            xhttp.open("GET", "ajax_info.txt");
            xhttp.send();
        }
        function test1() {
            $.ajax({
                url: 'test-ajax.php',
                type: 'POST',
                data: { name: 'John', age: 30 },
                dataType: 'json',
                success: function(response) {
                    alert('Server Response:', response); // Xử lý phản hồi từ server nếu cần
                },
                error: function(xhr, status, error) {
                    console.error('Error test 1:', error); 
                }
            });
        }

        function test2() {
    
        $.ajax({
            method: 'POST',
            url: "admin",                               
            data: {  name: 'John', age: 30  },
            dataType: 'json',
            success: function(response) {
                alert(response.message);
            }
        })
        }

        function test() {
            fetch('admin/updateCarStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: 'John',
                        age: 30
                    })
                })
                .then(response => response.json())
                .then(response => {
                    alert('Server Response:', response.success); // Xử lý phản hồi từ server nếu cần
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        

  
</script>


<?php
$content = ob_get_clean();
// var_dump($content); // Debugging line to check the content
// die();
require 'views/_layout/admin.php';
?>