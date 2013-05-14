<?php
include "../../functions/func.php";    

$friend = $_POST['friend'];
$user_id = $_SESSION['id'];
$return = get_one_user_unread_msgs($friend);

$mysqli->query("update messages set unread_flag = 0 WHERE (sender_id = $friend  AND receiver_id = $user_id);");

echo $return;
?>