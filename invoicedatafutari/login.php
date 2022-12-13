<?php
require 'function.php';
//session_start();

// if(isset($_POST['user'])){
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     $cekdatabase = mysqli_query($conn, "SELECT * FROM user where username='$username' and password='$password'");

//     $hitung = mysqli_num_rows($cekdatabase);

//     if($hitung>0){
//         $_SESSION['log'] = 'True';
//         header('location:index.php');
//     } else {
//         header('location:login.php');
//     };
// };

// if(!isset($_SESSION['log'])){

// } else {
//     header('location:index.php');
// }


if(isset($_POST['user'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cekdatabase = mysqli_query($conn, "SELECT * FROM user where username='$username'");

    if(mysqli_num_rows($cekdatabase)===1){
        $row = mysqli_fetch_assoc($cekdatabase);
        if( password_verify($password, $row["password"]) ){
            $_SESSION['log'] = 'True';

            if(isset($_POST['rememberme'])){
                setcookie('userid',$row['userid']);
                setcookie('access',$row['access']);
                setcookie('key', hash('sha256', $row['username']));
            }
            
            header("location:index.php");
        }
    };
    $error = true;
};
if(!isset($_SESSION['log'])){

} else {
    header('location:index.php');
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
        <title>Login | Item Counter</title>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <?php if(isset($error)) : ?>
                                            <p style="color: red; font-style: italic;">Wrong Username / Password</p> 
                                        <?php endif; ?>
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
                                                <input id="rememberme" name="rememberme" type="hidden"/>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" name="user" >Login</button>
                                            </div>
                                        </form>
                                        <br>
                                        <p style="float: left;">Dont have account yet <a href="register.php">create one now</a></p>
                                        <p style="float: right;"><a href="forgor.php">Forgot password</a></p>
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