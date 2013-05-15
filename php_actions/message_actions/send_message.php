<?php
include "../../functions/func.php";

//get users that conversation is between
$receiver = $_POST['receiver'];
$sender = $_POST['sender'];

//escape characters in message
$message = addslashes($_POST['message']);

//call send_message() procedure with proper arguments: int, int, text
$send_message_query = 'call send_message("'.$sender.'","'.$receiver.'", "'.$message.'")'; 

//execute query and return error if necessary
if(!$mysqli->query($send_message_query)) die($mysqli->error);

?>


