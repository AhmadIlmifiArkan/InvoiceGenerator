<?php
require 'function.php';
require 'cek.php';

//dapetin id barnaga yg di passing 
$invoiceid = $_GET['id']; //get id bareng
$clientid = $_GET['i']; //get id bareng
$payid = $_GET['u']; //get id bareng
$proid = $_GET['d']; //get id bareng

//get informasi barnag 
$get = mysqli_query($conn,"select * from maindata where invoiceid='$invoiceid'");
$fetch = mysqli_fetch_assoc($get);
$geting = mysqli_query($conn,"select * from client where clientid='$clientid'");
$fetching = mysqli_fetch_assoc($geting);
$getingeri = mysqli_query($conn,"select * from payment where payid='$payid'");
$fetchingeri = mysqli_fetch_assoc($getingeri);
$getingeriaya = mysqli_query($conn,"select * from produk where proid='$proid'");
$fetchingeriaya = mysqli_fetch_assoc($getingeriaya);

//set variabel 
$compname = $fetching['compnames'];
$qty = $fetch['quantity'];
$unit = $fetch['unit'];
$price = $fetchingeriaya['price'];
$ppn = $fetch['ppn'];
$customername = $fetching['customernem'];
$address = $fetching['compaddress'];
$compnum = $fetching['compcontnum'];
$invoicenum = $fetch['invoicenum'];
$date = $fetch['date'];
$ponum = $fetch['ponum'];
$donum = $fetch['donum'];
$termofpayment = $fetch['termofpayment'];
$currency = $fetch['currency'];
$manager = $fetching['manageria'];
$bankname = $fetchingeri['bankname'];
$bankaccount = $fetchingeri['bankaccount'];
$banknumber = $fetchingeri['banknumber'];
$description = $fetchingeriaya['proname'];

$gambar = $fetching['comlog'];
// cek ada image atau tidak
if($gambar==null){
    $img = '<div class="complogo">no logo</div>';
} else {
    $img = '<img src="img/'.$gambar.'" class="complogo">';
}

$amount = $qty*$price;
$total = $amount+$ppn;
$i = 1;


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Invoice</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
        </script>
        <style>
            .nologo{
                margin: 10px;
                width: 800px;
                height: 800px;
                border: solid;
            }
            .complogo{
                margin: 30px 110px 20px 50px;
                /* width: 20%; */
                height: 30px;
            }
            .uperpart{
                margin-top: 1-0px;
            }
            .zoomable:hover{
                transform: scale(1.5);
                transition: 0.3s ease;
            }
            .cusinfo{
                font-weight: bold;
            }
            .compinfo{
                float: right;
                text-align: right;
                border-style: none;
                width: 300px;
            }
            .printheader{
                font-size: 13px;
            }
            .prl{
                padding-right: 200px;
                padding-left: 200px;
            }
            .mtm{
                margin-top: 100px;
            }
            .infoheader{
                border-width: 2px;
                border-color: black;
                padding: 5px;
                position: absolute;
            }
            .invoiceinfo{
                border-width: 2px;
                border-color: black;
                padding: 5px;
                /* position: absolute; */
                float: right;
                margin-bottom: 20px;
            }
            .compname{
                font-size: 20px;
                font-weight: bold;
            }
            .compaddress{
                font-size: 13px;
                font-weight: normal;
            }
            .inpois{
                list-style-type: none;
            }
            .subtotal{
                font-size: 15px;
                font-weight: bold;
            }
            .e{
                font-style: italic;
                font-weight: thin;
            }
            .downer{
                font-weight: bold;
            }
            .r{
                margin-left: 30px;
            }
            .p{
                font-size: 15px;
            }
            .penyemat{
                margin-top: 100px;
            }
            .sign{
                float: right;
                display: flex;
                align-items: center;
                flex-direction: column;
            }
            @media print {
                
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="uperpart">
                            <?=$img;?>

                        <div class="compinfo card">
                            <h4 class="compname"><?= $compname; ?></h4>
                            <h4 class="compaddress"><?= $address; ?></h4>
                            <h4 class="compaddress">Telp : (+62)<?= $compnum; ?></h4>
                        </div>
                        </div>

                        <div style="width: 300px; padding-bottom: 20px; height: 180px;" class="infoheader card">
                            <h4 class="printheader" style="text-decoration-line: underline; font-style: italic; font-weight: normal;">Customer Name :</h4>
                            <h4 class="printheader cusinfo"><?= $customername; ?></h4>
                            <h4 class="printheader cusinfo"><?= $compname; ?></h4>
                            <h4 class="printheader address"><?= $address; ?></h4>
                        </div>
                        
                        <div class="invoiceinfo card" style="border: none; width: 300px;">
                            <div style="border: solid 2px; border-radius: 5px; height: 30px;"><h3 style="align-items: center; display: flex; font-size: 20px; font-weight: bold; letter-spacing: 6px; font-style: italic; justify-content: center;">INVOICE</h3></div>
                            <div style="height: 130px; display: ">
                                    
                                <h5 class="inpois printheader cusinfo">invoice No : <?= $invoicenum; ?></h5>
                                <h5 class="inpois printheader cusinfo">Date : <?= $date; ?></h5>
                                <h5 class="inpois printheader cusinfo">PO No : <?= $ponum; ?></h5>
                                <h5 class="inpois printheader cusinfo">DO No : <?= $donum; ?></h5> 
                                <h1 class="inpois printheader cusinfo">Term of Payment : <?= $termofpayment; ?> Days</h1>
                                <h1 class="inpois printheader cusinfo">Currency : <?= $currency ?></h1>
                                    
                            </div>
                        </div>

                        <table class="table table-bordered" id="mauexport" width="100%" cellspacing="200px" style="font-size: 12px;">
                                        <thead>
                                            <tr>
                                                <th style="font-align: center;">No</th>
                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?php echo $description;?></td>
                                                <td><?php echo $qty;?></td>
                                                <td><?php echo $unit;?></td>
                                                <td><?php echo $price;?></td>
                                                <td><?php echo $amount;?></td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <div class="totalcount col-md-4" style="float: right; width: 300px;">
                                        <div class="col" style="display: flex; justify-content: space-between;">
                                            <h3 class="subtotal">Sub. Total Price</h3>
                                            <h3 class="subtotal"> : Rp </h3>
                                            <h3 class="subtotal"> <?= $amount; ?> </h3>
                                        </div>
                                        <div class="col" style="display: flex; justify-content: space-between;">
                                            <h3 class="subtotal">Tax PPN</h3>
                                            <h3 class="subtotal"> : Rp </h3>
                                            <h3 class="subtotal"> <?= $ppn; ?> </h3>
                                        </div>
                                        <div class="col" style="display: flex; justify-content: space-between;">
                                            <h3 class="subtotal">Grand Total</h3>
                                            <h3 class="subtotal"> : Rp </h3>
                                            <h3 class="subtotal"> <?= $total; ?> </h3>
                                        </div>
                                    </div>
                                    <div class="penyemat">
                                        <h3 class="e p">Payment : </h3>
                                        <h3 class="downer e p">Cash of Transfer To :</h3>
                                        <div class="r">
                                            <h3 class="downer p"><?= $compname; ?></h3>
                                            <h3 class="downer p"><?= $bankname; ?></h3>
                                            <h3 class="downer p">KCP Bekasi Grand Wisata</h3>
                                            <h3 class="downer p">Acc No. : <?= $banknumber; ?></h3>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="">
                    <div class="sign">
                        <h3 style="font-weight: normal; font-size: 15px; margin-bottom: 120px;">Best Regards,</h3>
                        <div class="knower">
                            <h3 style="font-weight: bold; font-size: 25px;"><?= $compname; ?></h3>
                                <h3 style="font-weight: bold; font-size: 18px; text-align: center;"><?=$manager;?></h3>
                                <h6 style="font-size: 13px; text-align: center;">Manager</h6>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
