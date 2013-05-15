<?php
include('../../functions/func.php');

//get friends to confirm
$potential_friend = $_POST['confirm'];
$user_id = $_SESSION['id'];

//make sure request isn't for current user to confirm themselves, if not continue
if(strcmp($user_id,$potential_friend)){

    //add friend and remove friend from friend requests
    $add_friend_query= 'CALL add_friend("'.$user_id.'","'.$potential_friend.'");';
    $add_friend_query.= 'DELETE FROM friend_requests WHERE receiver_id = "'.$user_id.'" AND sender_id = "'.$potential_friend.'";';
    //echo $add_friend_query;
    if($mysqli->multi_query($add_friend_query)) {
         do {
            /* store first result set */
            if ($result = $mysqli->store_result()) {
                while ($row = $result->fetch_row()) {
                    //printf("%s\n", $row[0]);
                }
                $result->free();
            }
            /* print divider */
            if ($mysqli->more_results()) {
                //printf("-----------------\n");
            }
        } while ($mysqli->next_result());
    }
    else die($mysqli->error);
}
header('location: '.$_SERVER['HTTP_REFERER']);
?>
