<?php
require 'function.php';
require 'cek.php';
require 'sidebar.php';
$ambildata = mysqli_query($conn,"select * from user where userid='$userid'");
                                $data = mysqli_fetch_assoc($ambildata);
                                    $userid = $_COOKIE['userid'];
                                    $username = $data['username'];
                                    $access = $_COOKIE['access'];
                                    $status = $data['status'];
if($access === '330'){
}else{
    header("location:index.php");
}
// $statstat = if($status === '1'){
//     echo'online';
// }else{
//     echo'offline';
// }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin | Invoice Data</title>
        <?=$head;?>
        <style>
            .zoomable{
                width: 100px;
            }
            .zoomable:hover{
                transform: scale(2.5);
                transition: 0.3s ease;
            }
            .online{
                background: yellow;
                padding: 5;
                text-align: center;
                border-radius: 5px;
            }
            .offline{
                background: red;
                padding: 5;
                text-align: center;
                border-radius: 5px;
            }
            span{
                font-weight: bold;
            }
            .tnb{
                padding: 5px 50px 5px 50px;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
    <?= $adumin; ?>
    <li>
    <a class="nav-link dropdown-toggle" id="notDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notDropdown">
                <?php
                $takumi = mysqli_query($conn,"select * from request");
                while($datu = mysqli_fetch_array($takumi)){
                $request = $datu['request'];
                ?>
                <a class="dropdown-item"><?=$request;?></a>
                <?php
                };
                ?>
            </div>
    </li>
    </ul>
</nav>
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
                        <h1 class="mt-4">User</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to open modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add New Admin
                                </button>

                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Access</th>
                                                <th>Actions</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                $takealladmindata = mysqli_query($conn,"select * from user inner join access on user.access = access.access inner join status on user.status = status.status");
                                                $i = 1;
                                                while($data=mysqli_fetch_array($takealladmindata)){
                                                    $idu = $data['userid'];
                                                    $pass = $data['password'];
                                                    $username = $data['username'];
                                                    $access = $data['access'];
                                                    $accessname = $data['accessname'];
                                                    $statusid = $data['status'];
                                                    $status = $data['statusdsp'];
                                            ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$username;?></td>
                                                <td><?=$accessname;?>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idu;?>" style="float: right;">
                                                        Change Access
                                                    </button>
                                            </td>
                                                <td>
                                                    

                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#newpsw<?=$idu;?>">
                                                        Change Password
                                                    </button>

                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idu;?>">
                                                        Delete
                                                    </button>
                                                </td>
                                                <td>
                                                    <form method="post">
                                                    <input type="hidden" name="status" value="<?php if($statusid === '1'){echo'2';}else{echo'1';}?>">
                                                    <input type="hidden" name="idu" value="<?=$idu;?>">    
                                                    <button class="btn-<?php if($statusid == '1'){echo'primary';}else{echo'danger';}?> btn tnb" type="submit" id="stats<?=$idu;?>" name="updatestatus">
                                                        <?=$status;?>
                                                    </button></form>
                                                </td>
                                            </tr>
                                                <!-- Edit pass -->
                                                <div class="modal fade" id="newpsw<?=$idu;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Change <span><?=$username;?></span>'s Password</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal Body -->
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="password" name="passbaru" class="form-control" placeholder="Input Password" required>
                                                                <br>
                                                                <input type="password" name="passbarucon" class="form-control" placeholder="Confirm Password" required>
                                                                <br>
                                                                <input type="hidden" name="idu" value="<?=$idu;?>">
                                                                <button type="submit" class="btn btn-primary" name="updatepass">Edit</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Edit pass -->
                                                <div class="modal fade" id="edit<?=$idu;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="card-body">
                                                                <div>
                                                                    <input type="radio" id="admin" name="access" value="330">
                                                                    <label for="admin">Admin</label>
                                                                </div>
                                                                <div>
                                                                    <input type="radio" id="member" name="access" value="303">
                                                                    <label for="member">Mamber</label>
                                                                </div>
                                                                <div>
                                                                    <input type="radio" id="visitor" name="access" value="3">
                                                                    <label for="visitor">Visitor</label>
                                                                </div>
                                                                <input type="hidden" name="idu" value="<?=$idu;?>">
                                                                <br>
                                                                <button type="submit" class="btn btn-primary" name="updateaccess">Edit</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idu;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Admin</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal Body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Are You Sure Want To Delete <span><?=$username;?></span> Account ?
                                                                <input type="hidden" name="idu" value="<?=$idu;?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="deleteadmin">Delete</button>
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
                    <h4 class="modal-title">Add Admin</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="text" name="username" placeholder="Input Username" class="form-control" required>
                        <br>
                        <input type="hidden" name="status" value="1" required>
                        <!-- <br> -->
                        <input type="password" name="password" placeholder="Input Password" class="form-control" required>
                        <br>
                        <select name="access" class="form-control">
                            <?php
                                $takealldata = mysqli_query($conn, "select * from access");
                                while($fetcharray = mysqli_fetch_array($takealldata)){
                                    $access = $fetcharray['access'];
                                    $accessname = $fetcharray['accessname'];
                            ?>

                            <option value="<?=$access;?>"><?=$accessname;?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary" name="addnewadmin">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
</html>