<?php
include('../../functions/func.php');

//get users relationship is between
$sender = $_POST['ignore'];
$receiver = $user_info['id'];

//remove friend request
$ignore_query = 'delete from friend_requests where sender_id = '.$sender.' and receiver_id = '.$receiver.';';

//execute query
if(!($result=$mysqli->query($ignore_query))) die('Delete Failed ');

//redirect to referrer
header('location: '.$_SERVER['HTTP_REFERER']);

?>
