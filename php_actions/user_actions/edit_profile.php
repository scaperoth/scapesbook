<?php
session_start();
include('../../functions/func.php');

//escape characters in profile
$profile= addslashes($_POST['profile']);

//update profile using new text
$profile_query = 'UPDATE users SET profile = "'.$profile.'" WHERE username = "'.$_SESSION['username'].'";';

//execute query
if(!$result = $mysqli->query($profile_query))
    die($mysqli->error);

    //alert success message
    echo 'Successfully Edited Profile';
?>

