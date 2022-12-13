<?php

if(isset($_COOKIE['userid']) && isset($_COOKIE['key'])){
    $userid = $_COOKIE['userid'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "select username from user where userid = $userid");
    $row = mysqli_fetch_assoc($result);

    if($key === hash('sha256', $row['username'])){
        $_SESSION['log'] = true;
    }

    }else {
    header('location:login.php');
}

?>