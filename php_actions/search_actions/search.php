<?php
include('../../functions/func.php');

$name = $_GET['search'];
preg_match('#\((.*?)\)#', $name, $user);
$username = $user[1];

$user_info = get_user_info($username);

header('location: ../../user.php?id='.$user_info['id']);
?>
