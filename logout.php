<?php
session_start();
if(isset($_POST['loggingout'])){
    $_SESSION['loggedin']=FALSE;
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    session_destroy();
}
header('location: index.php');
?>
