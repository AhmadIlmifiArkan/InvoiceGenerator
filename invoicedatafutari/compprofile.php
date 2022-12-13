<?php
require 'function.php';
require 'cek.php';
require 'sidebar.php';

//dapetin id barnaga yg di passing 
$clientid = $_GET['id']; //get id bareng
//get informasi barnag 
$get = mysqli_query($conn, "select * from client where clientid='$clientid'");
$fetch = mysqli_fetch_assoc($get);
//set variabel 
$compnames = $fetch['compnames'];
$compaddress = $fetch['compaddress'];
$compcontnum = $fetch['compcontnum'];
$customernem = $fetch['customernem'];
$manageria = $fetch['manageria'];
$gambar = $fetch['comlog'];
// cek ada image atau tidak
if ($gambar == null) {
    $img = 'No Photo';
} else {
    $img = '<img src="img/' . $gambar . '" class="zoomable">';
}
$ambildata = mysqli_query($conn, "select * from user where userid='$userid'");
($data = mysqli_fetch_assoc($ambildata));
$userid = $_COOKIE['userid'];
$username = $data['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Client Profile | Invoice Data</title>
    <?= $head; ?>
    <style>
        .zoomable {
            height: 200px;
        }

        .prl {
            padding-right: 200px;
            padding-left: 200px;
        }

        .mtm {
            margin-top: 100px;
        }

        .exbut {
            float: right;
            width: 200px;
            height: 100px;
            color: white;
            padding: 30px 10px;
            font-size: 20px;
        }
    </style>
</head>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Item Counter</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="client.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Client
                    </a>
                    <a class="nav-link" href="payment.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Payment
                    </a>
                    <a class="nav-link" href="produk.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Product
                    </a>
                    <a class="nav-link" href="admin.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Admin
                    </a>
                    <a class="nav-link" href="logout.php">
                        Log Out
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= $username; ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Company Profile</h1>

                <div class="card mb-4 mt-4">
                    <div class="card-header">
                        <h2><?= $compnames; ?></h2>
                        <?= $img; ?>

                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3">Company Address</div>
                            <div class="col-md-9">: <?= $compaddress; ?></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">Company Contact</div>
                            <div class="col-md-9">: <?= $compcontnum; ?></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">Customer Name</div>
                            <div class="col-md-9">: <?= $customernem; ?></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">Manager Name</div>
                            <div class="col-md-9">: <?= $manageria; ?></div>
                        </div>
                        <br><br>
                        <hr>
                        <h3>Order List</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $takealldata = mysqli_query($conn, "select * from maindata inner join produk on maindata.proid = produk.proid");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($takealldata)) {
                                        $cdi = $data['clientid'];
                                        $qty = $data['quantity'];
                                        $unit = $data['unit'];
                                        $price = $data['price'];
                                        $idi = $data['invoiceid'];
                                        $invoicenum = $data['invoicenum'];
                                        $date = $data['date'];
                                        $termofpayment = $data['termofpayment'];
                                        $description = $data['proname'];
                                    ?>

                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $description; ?></td>
                                            <td><?= $qty; ?></td>
                                            <td><?= $unit; ?></td>
                                            <td><?= $price; ?></td>
                                        </tr>

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
        <?= $footer; ?>

</html>