<?php
require "../../functions/func.php";

//get user and encrypt password
$username = $_POST['username'];
$pass = md5($_POST['pass']);

//call log_in function from func.php to compare user and enc password with users
$is_log = log_in($username, $pass);

//if credentials are valid, return true
if($is_log){
    //$error = '<p class = "error">'.$is_log.'</p>';
    echo TRUE;
}

?>
