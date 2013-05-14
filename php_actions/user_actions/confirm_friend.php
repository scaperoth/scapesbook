<?php
include('../../functions/func.php');

$potential_friend = $_POST['confirm'];
$user_info = get_user_info($_SESSION['username']);

if(strcmp($user_info['id'],$potential_friend)){
    $add_friend_query= 'CALL add_friend("'.$user_info['id'].'","'.$potential_friend.'");';
    $add_friend_query.= 'DELETE FROM friend_requests WHERE receiver_id = "'.$user_info['id'].'" AND sender_id = "'.$potential_friend.'";';
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
