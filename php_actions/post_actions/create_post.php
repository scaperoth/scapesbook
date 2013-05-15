<?php
include_once('../../functions/func.php');

//escape characters in new post
$new_post = addslashes($_POST['new_post']);

//get users post is between
$user_id = $_SESSION['id'];
$receiver = $_POST['receiver'];

//call new_post with proper arguments, int, int/NULL, TEXT. 
//if receiver is null then post is not between two users
$post_query = 'call new_post("'.$user_id.'", "'.($receiver?$receiver:NULL).'", "'.$new_post.'");';

//if new_post exists then execute query
if($new_post){
    if(!$mysqli->query($post_query))
        die($mysqli->error);
}

//return to referring location
header('location: '.$_SERVER['HTTP_REFERER']);
?>