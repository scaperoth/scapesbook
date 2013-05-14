<?php
include('../../functions/func.php');
$potential_friend = $_POST['submit'];
$user_info = get_user_info($_SESSION['username']);

//echo $user_info['id'].'<br>';

if(strcmp($user_info['id'],$potential_friend)){
    $add_friend_query = 'call add_friend("'.$user_info['id'].'","'.$potential_friend.'");';
    $add_friend_query.= 'call add_friend("'.$potential_friend.'","'.$user_info['id'].'");';

  //  echo $add_friend_query.'<br>';
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
header('location: '.$_SERVER['HTTP_REFERER']);
?>
