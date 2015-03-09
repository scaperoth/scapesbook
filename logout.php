<?php

include ('functions/func.php');

if (isset($_SESSION['loggedin']))
{
    $_SESSION['loggedin'] = FALSE;

    var_dump($_SESSION);
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    session_destroy();
}

header('location: login.php');
?>

