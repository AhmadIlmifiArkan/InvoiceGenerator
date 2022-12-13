<?php
require 'function.php';
//session_start();

if(isset($_POST['forgot'])){
    $passbaru = $_POST['passbaru'];
    $passbarucon = $_POST['passbarucon'];
    $idny = $_COOKIE['userid'];

    if($passbaru !== $passbarucon){
        echo "<script>
                alert('confirmation failed')
        </script>";
        return false;
    }

    $passbaru = password_hash($passbaru, PASSWORD_DEFAULT);

    $queryupdate = mysqli_query($conn,"update user set password='$passbaru' where userid='$idny'");

    if($queryupdate){
        header('location:admin.php');
    } else {
        echo 'Gagal';
        header('location:admin.php');
    }
    setcookie('userid', '', time()-1);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Forgot Password | Item Counter</title>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Forgot Password</h3></div>
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <label>New Password</label>
                                                <input type="password" name="passbaru" class="form-control" placeholder="Input Password" required>
                                                <br>
                                                <label>Confirm Password</label>
                                                <input type="password" name="passbarucon" class="form-control" placeholder="Confirm Password" required>
                                                <br>
                                                <input type="hidden" name="idu" value="<?=$idu;?>">
                                                <button type="submit" class="btn btn-primary" name="forgot">Change Password</button>
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