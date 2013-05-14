<?php
include_once('../../functions/func.php');

$new_post = addslashes($_POST['new_post']);
$user_id = $_SESSION['id'];
$receiver = $_POST['receiver'];
$post_query = 'call new_post("'.$user_id.'", "'.($receiver?$receiver:NULL).'", "'.$new_post.'");';

if($new_post){
    if(!$mysqli->query($post_query))
        die($mysqli->error);
}

header('location: '.$_SERVER['HTTP_REFERER']);
?>