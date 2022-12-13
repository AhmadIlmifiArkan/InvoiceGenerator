<?php
require 'function.php';
//session_start();

if(isset($_POST['register'])){
    if(registrasi($_POST)>0){
        header('location:login.php');
        } else {
            echo mysqli_error($conn);
        }
    };


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register | Item Counter</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Registrasi</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label for="inputUsername">Username</label>
                                                <input class="form-control" id="inputUsername" name="username" type="text" placeholder="Username" />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword">Password</label>
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmPassword">Confirm Password</label>
                                                <input class="form-control" id="confirmPassword" name="confirmpassword" type="password" placeholder="Confirm Password" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input type="hidden" id="access" name="access" value="3">
                                                <input type="hidden" id="status" name="status" value="1">
                                                <?php $take = ['username'];?>
                                                <input type="hidden" id="request" name="request" value="New User Created!">
                                                <button class="btn btn-primary" name="register" >Register</button>
                                            </div>
                                        </form>
                                        <p>Have Account <a href="login.php">Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>