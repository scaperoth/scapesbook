<?php
include "../../functions/func.php";

$receiver = $_POST['receiver'];
$sender = $_POST['sender'];
$message = addslashes($_POST['message']);

$send_message_query = 'call send_message("'.$sender.'","'.$receiver.'", "'.$message.'")'; 

if(!$mysqli->query($send_message_query)) die($mysqli->error);

//header('location: '.$_SERVER['HTTP_REFERER']);
?>


