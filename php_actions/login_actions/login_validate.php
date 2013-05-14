<?php
include "../../functions/func.php";

$username = $_POST['username'];
$pass = md5($_POST['pass']);

$is_log = log_in($username, $pass);

if($is_log){
    //$error = '<p class = "error">'.$is_log.'</p>';
    echo TRUE;
}

?>
