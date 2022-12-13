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
        <title>Client | Futari Mecca Utama</title>
        <?=$head;?>
        <style>
            .imagos{
                width: 100px;
            }
            a{
                text-decoration: none;
                color: black;
            }
            .span{
                font-weight: bold;
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
                        <h1 class="mt-4">Data Client</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to open modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add New Client
                                </button>

                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Logo</th>
                                                <th>Company Name</th>
                                                <th>Customer Name</th>
                                                <th>Company Address</th>
                                                <th>Company Contact</th>
                                                <th>Manager Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                
                                                $takealldata = mysqli_query($conn,"select * from client");
                                                $i = 1;
                                                while($data=mysqli_fetch_array($takealldata)){
                                                    $compnames = $data['compnames'];
                                                    $customernem = $data['customernem'];
                                                    $compaddress = $data['compaddress'];
                                                    $compcontnum = $data['compcontnum'];
                                                    $manageria = $data['manageria'];
                                                    $comlog = $data['comlog'];
                                                    $cdi = $data['clientid'];

                                                    $cumlogo = '<img src="img/'.$comlog.'" class="imagos" alt="No Photos">';
                                            ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><a href="compprofile.php?id=<?=$cdi;?>"><?=$cumlogo;?></a></td>
                                                <td><a href="compprofile.php?id=<?=$cdi;?>"><?=$compnames;?></a></td>
                                                <td><?=$customernem;?></td>
                                                <td><?=$compaddress;?></td>
                                                <td><?=$compcontnum;?></td>
                                                <td><?=$manageria;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$cdi;?>">
                                                        Edit
                                                    </button>

                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$cdi;?>">
                                                        Delete
                                                    </button>

                                                    

                                                </td>
                                            </tr>

                                                    <!-- Edit Modal -->
                                                <div class="modal fade" id="edit<?=$cdi;?>">
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
                                                                <input type="text" name="compnames" value="<?=$compnames;?>" class="form-control" placeholder="Company Name" required>
                                                                    <br>
                                                                <input type="text" name="customernem" value="<?=$customernem;?>" class="form-control" placeholder="Customer Name" required>
                                                                    <br>
                                                                <input type="text" name="compaddress" value="<?=$compaddress;?>" class="form-control" placeholder="Company Address" required>
                                                                    <br>
                                                                <input type="tel" name="compcontnum" value="<?=$compcontnum;?>" class="form-control" placeholder="Contact Number" required>
                                                                    <br>
                                                                <input type="text" name="manageria" value="<?=$manageria;?>" class="form-control" placeholder="Manager Name" required>
                                                                    <br>
                                                                    
                                                                <input type="file" name="file" class="form-control">
                                                                    <br>
                                                                <input type="hidden" name="cdi" value="<?=$cdi;?>">
                                                                <button type="submit" class="btn btn-primary" name="updateclient">Edit</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$cdi;?>">
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
                                                                <input type="hidden" name="cdi" value="<?=$cdi;?>">
                                                                    <br>
                                                                    <br>
                                                                <button type="submit" class="btn btn-danger" name="deleteclient">Delete</button>
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
                        <input type="text" name="compnames" placeholder="Input Company Name" class="form-control" required>
                            <br>
                        <input type="text" name="customernem" placeholder="Customer Name" class="form-control" required>
                            <br>
                        <input type="text" name="compaddress" placeholder="Company Address" class="form-control" required>
                            <br>
                        <input type="number" name="compcontnum" placeholder="Company Contact Number" class="form-control" required>
                            <br>
                        <input type="text" name="manageria" placeholder="Manager Name" class="form-control" required>
                            <br>
                        <input type="file" name="file" class="form-control"required>
                            <br>
                        <button type="submit" class="btn btn-primary" name="addnewclient">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
</html>