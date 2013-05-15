<?php
include "../../functions/func.php";    

//get users conversation is between
$friend = $_POST['friend'];
$user_id = $_SESSION['id'];

//assign variable to all unread messages
$return = get_one_user_unread_msgs($friend);

//set messages to read after getting unread
$mysqli->query("update messages set unread_flag = 0 WHERE (sender_id = $friend  AND receiver_id = $user_id);");

//return unread messages
echo $return;
?>