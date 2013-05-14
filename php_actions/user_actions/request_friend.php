<?php
include('../../functions/func.php');

$potential_friend = $_GET['submit'];
$user_info = get_user_info($_SESSION['username']);

if(strcmp($user_info['id'],$potential_friend)){
    $request_friend_query= 'call request_friend("'.$user_info['id'].'","'.$potential_friend.'");';

    //echo $request_friend_query.'<br>';
    if($mysqli->query($request_friend_query)) {
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
    //else die($mysqli->error);
}
header('location: ../../user.php?id='.$potential_friend);
?>
