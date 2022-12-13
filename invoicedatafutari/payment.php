<?php
    require 'function.php';
    require 'cek.php';
    require 'sidebar.php';
    $ambildata = mysqli_query($conn,"select * from user where userid='$userid'");
                                ($data = mysqli_fetch_assoc($ambildata));
                                    $userid = $_COOKIE['userid'];
                                    $username = $data['username'];
                                    $access = $_COOKIE['access'];
                                    if($access === '3'){
                                        header("location:produk.php");
                                    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Payment | Futari Mecca Utama</title>
        <?=$head;?>
        <style>
            .imagos{
                width: 100px;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <?=$header;?>
        <div id="layoutSidenav">
        <?=$headerr;?>
        <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=$username;?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Payment</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to open modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add New Payment Method
                                </button>

                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bank Name</th>
                                                <th>Bank Account</th>
                                                <th>Bank Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $takealldata = mysqli_query($conn,"select * from payment");
                                                $i = 1;
                                                while($data=mysqli_fetch_array($takealldata)){
                                                    $bankname = $data['bankname'];
                                                    $bankaccount = $data['bankaccount'];
                                                    $banknumber = $data['banknumber'];
                                                    $pdi = $data['payid'];
                                            ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$bankname;?></td>
                                                <td><?=$bankaccount;?></td>
                                                <td><?=$banknumber;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$pdi;?>">
                                                        Edit
                                                    </button>

                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$pdi;?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>

                                                    <!-- Edit Modal -->
                                                <div class="modal fade" id="edit<?=$pdi;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Item</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal Body -->
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="text" name="bankname" value="<?=$bankname;?>" class="form-control" placeholder="Bank Name" required>
                                                                    <br>
                                                                <input type="text" name="bankaccount" value="<?=$bankaccount;?>" class="form-control" placeholder="Bank Account" required>
                                                                    <br>
                                                                <input type="number" name="banknumber" value="<?=$banknumber;?>" class="form-control" placeholder="Bank Number" required>
                                                                    <br>

                                                                <input type="hidden" name="pdi" value="<?=$pdi;?>">
                                                                <button type="submit" class="btn btn-primary" name="updatepayment">Edit</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$pdi;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal Body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Are You Sure Want To Delete <strong><?=$bankname;?></strong> Invoice Data?
                                                                <input type="hidden" name="pdi" value="<?=$pdi;?>">
                                                                    <br>
                                                                    <br>
                                                                <button type="submit" class="btn btn-danger" name="deletepayment">Delete</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                                };
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?=$footer;?>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Invoice Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="text" name="bankname" placeholder="Bank Name" class="form-control" required>
                            <br>
                        <input type="text" name="bankaccount" placeholder="Bank Account" class="form-control" required>
                            <br>
                        <input type="number" name="banknumber" placeholder="Bank Number" class="form-control" required>
                            <br>
                        <button type="submit" class="btn btn-primary" name="addnewbank">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
</html>