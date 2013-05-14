<?php
include "../../functions/func.php";

$receiver = $_POST['id'];

$user_info = get_user_info($_SESSION['username']);

$sender = $user_info['id'];
$reply_box = get_message_reply_container($sender);

$return = array('reply'=>$reply_box, 'sender'=>$sender,'receiver'=>$receiver); 

echo json_encode($return);
