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
                                            <th>User ID</th>
                                            <th>Car ID</th>
                                            <th>User Phone</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        if(isset($bookings) && count($bookings) > 0){
                                            foreach($bookings as $book){
                                                ?>
                                                <tr>

                                                    <td><?= $book->getUserId()?></td>
                                                    <td><?= $book->getCarId() ?></td>
                                                    <td><?= $book->getUserPhone() ?></td>
                                                    <td><?= $book->getStartDate() ?></td>
                                                    <td><?= $book->getEndDate() ?></td>
                                                    <td><?= $book->getStatus() ?></td>
                                                    <td>
                                                      
                                                        <a href="index.php?controller=booking&action=update&id=<?= $book->getId() ?>" class="btn btn-primary">Update</a>
                                                        <a href="bookingdetail?id=<?= $book->getId() ?>" class="btn btn-info">Detail</a>
                                                    </td>
                                                </tr>

                                            
                                                <?php
                                            }
                                        }else{
                                            echo "<tr><td colspan='6'>No bookings found</td></tr>";
                                        }
                                        ?>
                                        
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>


          
                
                <?php
                $content = ob_get_clean();
                require_once 'views/_layout/admin.php';
                ?>

             
