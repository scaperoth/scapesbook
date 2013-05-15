<?php
include('../../functions/func.php');

//get users potential relationship is between
$potential_friend = $_GET['submit'];
$user_id = $_SESSION['id'];

//make sure requester is different than session user
if(strcmp($user_id,$potential_friend)){
    //request friend, add to request table using request_friend(int, int) procedure
    $request_friend_query= 'call request_friend("'.$user_id.'","'.$potential_friend.'");';

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
//redirect to user page
header('location: ../../user.php?id='.$potential_friend);
?>
