<?php
include "../../functions/func.php";

//get id of user to receive messages
$receiver = $_POST['id'];

//get id of current user
$sender = $_SESSION['id'];

//create reply box calling function get_message_reply_container() from func.php
$reply_box = get_message_reply_container($sender);

//return object with replybox html, sender id, and receiver id
$return = array('reply'=>$reply_box, 'sender'=>$sender,'receiver'=>$receiver); 

//return json object
echo json_encode($return);
?>