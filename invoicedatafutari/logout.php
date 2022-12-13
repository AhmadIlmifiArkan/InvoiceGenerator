<?php
session_start();
session_destroy();

setcookie('userid', '', time()-1);
setcookie('key', '', time()-1);
setcookie('access', '', time()-1);

header('location:login.php');
?>