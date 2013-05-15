<?php
//execute search functionality

include('../../functions/func.php');

//get value to search for 
$name = $_GET['search'];

//get from search field in () and assign to $user
preg_match('#\((.*?)\)#', $name, $user);

//get username from $user array
$username = $user[1];

//get user_info based on username in search
$user_info = get_user_info($username);

//redirect to user page with id from search
header('location: ../../user.php?id='.$user_info['id']);
?>
