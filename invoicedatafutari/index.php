<?php
    require 'function.php';
    require 'cek.php';
    require 'sidebar.php';
    // require 'script.js';
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
        <title>Data Invoice | Futari Mecca Utama</title>
        <?=$head;?>
        <style>
            .zoomable{
                width: 100px;
            }
            .zoomable:hover{
                transform: scale(2.5);
                transition: 0.3s ease;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
    <?= $header; ?>
    <div id="layoutSidenav">
        <?= $headerr;?>
        <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=$username;?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Invoice</h1>
                        
                        <div class="card mb-4">
                            <?php
                            if($access === '3'){

                            }else{
                                ?>
                                <div class="card-header">
                                <!-- Button to open modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add New Invoice
                                </button>
                            </div>
                            <?php
                            }
                            ?>
                            
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Company Name</th>
                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Unit Price</th>
                                                <?php
                            if($access === '3'){

                            }else{
                                ?>
                                                <th>Actions</th>
                                                <?php
                            }
                            ?>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $takealldata = mysqli_query($conn,"select * from maindata inner join client on maindata.clientid = client.clientid inner join produk on maindata.proid = produk.proid");
                                                $i = 1;
                                                while($data=mysqli_fetch_array($takealldata)){
                                                    $cdi = $data['clientid'];
                                                    $pdi = $data['payid'];
                                                    $rdi = $data['proid'];
                                                    $compnames = $data["compnames"];
                                                    $qty = $data['quantity'];
                                                    $unit = $data['unit'];
                                                    $price = $data['price'];
                                                    $idi = $data['invoiceid'];
                                                    $invoicenum = $data['invoicenum'];
                                                    $date = $data['date'];
                                                    $termofpayment = $data['termofpayment'];
                                                    $description = $data['proname'];
                                                    $ppn = $data['ppn'];
                                                    $ponum = $data['ponum'];
                                                    $donum = $data['donum'];
                                                    $currency = $data['currency'];
                                            ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$compnames;?></td>
                                                <td><?=$description;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$unit;?></td>
                                                <td><?=$price;?></td>
                                                <?php
                            if($access === '3'){

                            }else{
                                ?>
                                                <td>
                                                    <a class="button button-warning" data-toggle="modal" data-target="#edit<?=$idi;?>">
                                                        Edit
                            </a>

                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idi;?>">
                                                        Delete
                                                    </button>

                                                    <a href="detail.php?id=<?=$idi;?>&i=<?=$cdi;?>&u=<?=$pdi;?>&d=<?=$rdi;?>"target="_blank" class="btn btn-primary">
                                                        View
                                                    </a>
                                                </td>
                                                <?php
                            }
                            ?>
                                            </tr>

                                                    <!-- Edit Modal -->
                                                <div class="modal fade" id="edit<?=$idi;?>">
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
                                                                <input type="text" name="description" value="<?=$description;?>" class="form-control" placeholder="Description" required>
                                                                    <br>
                                                                <input type="number" name="quantity" value="<?=$qty;?>" class="form-control" placeholder="Quantity" required>
                                                                    <br>
                                                                <input type="text" name="unit" value="<?=$unit;?>" class="form-control" placeholder="Unit" required>
                                                                    <br>
                                                                <input type="number" name="price" value="<?=$price;?>" class="form-control" placeholder="Price" required>
                                                                    <br>
                                                                <input type="number" name="ppn" value="<?=$ppn;?>" class="form-control" placeholder="PPN" required>
                                                                    <br>
                                                                <input type="text" name="invoicenum" value="<?=$invoicenum;?>" class="form-control" placeholder="Invoice Number" required>
                                                                    <br>
                                                                <input type="date" name="date" value="<?=$date;?>" class="form-control" placeholder="Date" required>
                                                                    <br>
                                                                <input type="text" name="ponum" value="<?=$ponum;?>" class="form-control" placeholder="PO Number" required>
                                                                    <br>
                                                                <input type="text" name="donum" value="<?=$donum;?>" class="form-control" placeholder="DO Number" required>
                                                                    <br>
                                                                <input type="number" name="termofpayment" value="<?=$termofpayment;?>" class="form-control" placeholder="Term of Payment" required>
                                                                    <br>
                                                                <input type="text" name="currency" value="<?=$currency;?>" class="form-control" placeholder="Unit" required>
                                                                    <br>
                                                                <input type="hidden" name="idi" value="<?=$idi;?>">
                                                                <button type="submit" class="btn btn-primary" name="updatedata">Edit</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idi;?>">
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
                                                                Are You Sure Want To Delete <strong><?=$compnames;?></strong> Invoice Data?
                                                                <input type="hidden" name="idi" value="<?=$idi;?>">
                                                                    <br>
                                                                    <br>
                                                                <button type="submit" class="btn btn-danger" name="deletedata">Delete</button>
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
                        <div class=" mr-5" style="float: left; margin-right: 8px;">
                    <select name="theitem" class="form-control js-example-basic-single">
                            <?php
                                $takealldata = mysqli_query($conn, "select * from client");
                                while($fetcharray = mysqli_fetch_array($takealldata)){
                                    $compnames = $fetcharray['compnames'];
                                    $compaddress = $fetcharray['compaddress'];
                                    $compcontnum = $fetcharray['compcontnum'];
                                    $customernem = $fetcharray['customernem'];
                                    $manageria = $fetcharray['manageria'];
                                    $comlog = $fetcharray['comlog'];
                                    $clientid = $fetcharray['clientid'];
                                    
                            ?>
                            <option value="<?=$clientid;?>"><?=$compnames;?></option>

                            <?php
                                }
                            ?>
                        </select>
                        <br>

                    <select name="theitems" class="form-control">
                            <?php
                                $takealldata = mysqli_query($conn, "select * from payment");
                                while($fetcharray = mysqli_fetch_array($takealldata)){
                                    $payid = $fetcharray['payid'];
                                    $bankname = $fetcharray['bankname'];
                                    $bankaccount = $fetcharray['bankaccount'];
                                    $banknumber = $fetcharray['banknumber'];
                            ?>
                            <option value="<?=$payid;?>"><?=$bankname;?></option>

                            <?php
                                }
                            ?>
                        </select>
                        <br>

                    <select name="theitemss" class="form-control">
                            <?php
                                $takealldata = mysqli_query($conn, "select * from produk");
                                while($fetcharray = mysqli_fetch_array($takealldata)){
                                    $proid = $fetcharray['proid'];
                                    $proname = $fetcharray['proname'];
                                    $prodesc = $fetcharray['prodesc'];
                                    $price = $fetcharray['price'];
                                    $proimg = $fetcharray['proimg'];
                                    
                            ?>

                            <option value="<?=$proid;?>"><?=$proname;?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="" style="float: right;">
                        <input type="number" name="quantity" placeholder="Quantity" class="form-control" required>
                            <br>
                        <input type="text" name="unit" placeholder="Unit" class="form-control" required>
                            <br>
                        <input type="number" name="ppn" placeholder="PPN" class="form-control" required>
                            <br>
                        <input type="text" name="invoicenum" placeholder="Invoice Number" class="form-control" required>
                            <br>
                        <input type="date" name="date" placeholder="Date" class="form-control" value="<?=$date;?>" required>
                            <br>
                        <input type="text" name="ponum" placeholder="PO Number" class="form-control" required>
                            <br>
                        <input type="text" name="donum" placeholder="DO Number" class="form-control" required>
                            <br>
                        <input type="number" name="termofpayment" placeholder="Term of Payment" class="form-control" required>
                            <br>
                        <input type="text" name="currency" placeholder="Currency" class="form-control" required>
                        <br>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary" name="addnewdata">Submit</button>
                    </div>
                </div>
                </form>
                </div>
            </div>
        </div>
</html>