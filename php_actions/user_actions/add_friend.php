<?php
/*********************************\
* @DEPRECATED depreciated file, 
    user now has to go through
    confirm process instead
    of just adding a friend
\*********************************/
include('../../functions/func.php');

//get users to be friends
$potential_friend = $_POST['submit'];
$user_id = $_SESSION['id'];

//echo $user_info['id'].'<br>';

//compare whether or not request is for current session user, if not continue
if(strcmp($user_id ,$potential_friend)){
    //add friend for both parties
    $add_friend_query = 'call add_friend("'.$user_id .'","'.$potential_friend.'");';
    $add_friend_query.= 'call add_friend("'.$potential_friend.'","'.$user_id .'");';

    //echo $add_friend_query.'<br>';

    //execute multiple queries
    if($mysqli->multi_query($add_friend_query)) {
         do {
            /* store first result set */
            if ($result = $mysqli->store_result()) {
                while ($row = $result->fetch_row()) {
                    printf("%s\n", $row[0]);
                }
                $result->free();
            }
            /* print divider */
            if ($mysqli->more_results()) {
                printf("-----------------\n");
            }
        } while ($mysqli->next_result());
    }
    else die($mysqli->error);
}

//redirect to page that request came from
header('location: '.$_SERVER['HTTP_REFERER']);
?>
