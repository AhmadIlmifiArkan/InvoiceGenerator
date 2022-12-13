<?php
    require 'function.php';
    require 'cek.php';
    require 'sidebar.php';
    $ambildata = mysqli_query($conn,"select * from user where userid='$userid'");
                                ($data = mysqli_fetch_assoc($ambildata));
                                    $userid = $_COOKIE['userid'];
                                    $username = $data['username'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Product | Futari Mecca Utama</title>
        <?=$head;?>
        <style>
            .imagos{
                width: 150px;
                float: left;
                margin: 10px;
            }
            .a{
                text-decoration: none;
                font-size: 30px;
                margin: 5px;
                color: black;
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
                        <h1 class="mt-4">Product</h1>
                        
                        <div class="card mb-4">
                            <?php
                            if($access === '3'){
                            }else{
                            ?>
                            <div class="card-header">
                                <!-- Button to open modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add New Product
                                </button>
                            <?php
                            }
                            ?>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <!-- <th>Photo</th>
                                                <th>Product Name</th>
                                                <th>Product Description</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                
                                                $takealldata = mysqli_query($conn,"select * from produk");
                                                $i = 1;
                                                while($data=mysqli_fetch_array($takealldata)){
                                                    $rdi = $data['proid'];
                                                    $proname = $data['proname'];
                                                    $prodesc = $data['prodesc'];
                                                    $price = $data['price'];
                                                    $proimg = $data['proimg'];
                                                    $isian = '<div class="container-fluid">
                                                    <img src="img/'.$proimg.'" class="imagos" alt="No Photos">
                                                    <h3 class="a">'.$proname.'</h3>
                                                    <p>'.$prodesc.'</p>
                                                    <h6>Rp.'.$price.'</h6>
                                                    </div>';
                                            ?>

                                            <tr>
                                                <td><?=$isian;?></td>
                                                <?php
                                                if($access === '3'){
                                                }else{
                                                ?>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$rdi;?>">
                                                        Edit
                                                    </button>

                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$rdi;?>">
                                                        Delete
                                                    </button>

                                                </td>
                                                <?php
                            }
                            ?>
                                            </tr>

                                                    <!-- Edit Modal -->
                                                <div class="modal fade" id="edit<?=$rdi;?>">
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
                                                                <input type="text" name="proname" value="<?=$proname;?>" class="form-control" placeholder="Product Name" required>
                                                                    <br>
                                                                <input type="text" name="prodesc" value="<?=$prodesc;?>" class="form-control" placeholder="Product Description" required>
                                                                    <br>
                                                                <input type="number" name="price" value="<?=$price;?>" class="form-control" placeholder="Product Price" required>
                                                                    <br>
                                                                <input type="file" name="file" class="form-control">
                                                                    <br>
                                                                <input type="hidden" name="rdi" value="<?=$rdi;?>">
                                                                <button type="submit" class="btn btn-primary" name="updateproduk">Edit</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$rdi;?>">
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
                                                                Are You Sure Want To Delete <strong><?=$proname;?></strong> Invoice Data?
                                                                <input type="hidden" name="rdi" value="<?=$rdi;?>">
                                                                    <br>
                                                                    <br>
                                                                <button type="submit" class="btn btn-danger" name="deleteproduk">Delete</button>
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
                        <input type="text" name="proname" placeholder="Product Name" class="form-control" required>
                            <br>
                        <input type="text" name="prodesc" placeholder="Product Description" class="form-control" required>
                            <br>
                        <input type="number" name="price" placeholder="Product Price" class="form-control" required>
                            <br>
                        <input type="file" name="file" class="form-control"required>
                            <br>
                        <button type="submit" class="btn btn-primary" name="addnewproduk">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
</html>