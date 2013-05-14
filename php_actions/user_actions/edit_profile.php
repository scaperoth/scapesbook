<?php
session_start();
include('../../functions/func.php');

$profile= addslashes($_POST['profile']);

$profile_query = 'UPDATE users SET profile = "'.$profile.'" WHERE username = "'.$_SESSION['username'].'";';

if(!$result = $mysqli->query($profile_query))
    die($mysqli->error);
    echo 'Successfully Edited Profile';
?>

