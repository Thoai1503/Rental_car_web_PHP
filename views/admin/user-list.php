<?php
ob_start(); 
?>
       
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">User list</li>
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
                                    //create a user list table with the following columns: id, name, email, phone, address, status
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                     
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                     
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                        <?php
                                        if (isset($users)&& count($users)>0){
                                            foreach($users as $user){
                                                ?>
                        <tr>
                            <td><?= $user->getId() ?></td>
                            <td><?= $user->getName() ?></td>
                            <td><?= $user->getEmail() ?></td>
                            <td><?= $user->getPhone() ?></td>
                           
                            <td>
                                <input type="checkbox" data-id="<?= $user->getId() ?>" onchange="updateStatus2(event)" <?= $user->getStatus() == 1 ? 'checked' : '' ?>>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary">Edit</a>
                     
                                <a href="userdetail?id=<?= $user->getId() ?>" class="btn btn-info">Detail</a>
                              
                        </tr>
                             
                        <?php
                                            }
                                        }else{
                                            echo "<tr><td colspan='6'>No data found</td></tr>";
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </main>


                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>


                <!-- <script>
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
                .then(text => {
            console.log("Raw response from server:", text);

            // Cố gắng loại bỏ ký tự không hợp lệ trước JSON (nếu có)
        // let jsonStr = text.trim();
        //     if (!jsonStr.startsWith('{')) {
        //         jsonStr = jsonStr.substring(jsonStr.indexOf('{'));
        //     }

            let responseData;
            try {
                responseData = text
            } catch (e) {
                throw new Error("Server returned invalid JSON: " + text);
            }

            if (responseData.success) {
                document.querySelector('.modal-body').innerHTML =
                    "Car with ID <strong>" + responseData.data.carId + "</strong> was changed to <strong>" + responseData.data.status + "</strong> successfully.";
            } else {
                document.querySelector('.modal-body').innerHTML =
                    "Failed to update car status: " + (responseData.message || "Unknown error");
                checkbox.checked = !checkbox.checked; // Revert
            }

            bootstrapModal.show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Something went wrong: " + error.message);
            checkbox.checked = !checkbox.checked;
        });
}

                </script> -->
<?php
$content = ob_get_clean();

require 'views/_layout/admin.php';
?>
