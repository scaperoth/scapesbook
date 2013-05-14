<?php
include('../../functions/func.php');

$sender = $_POST['ignore'];
$receiver = $user_info['id'];
$ignore_query = 'delete from friend_requests where sender_id = '.$sender.' and receiver_id = '.$receiver.';';

if(!($result=$mysqli->query($ignore_query))) die('Delete Failed ');

header('location: '.$_SERVER['HTTP_REFERER']);

?>
