<?php
include "../../functions/func.php";

$reciever = $_POST['id'];
$sender = $_SESSION['id'];


$get_messages_query = 'call get_messages("'.$reciever.'","'.$sender.'")'; 
$return = array('msg'=>'','receiver'=>$reciever,'sender'=>$sender );

if($result = $mysqli->query($get_messages_query)){
    $return['msg'].='<ul class="message-list no-list">';

    if($result->num_rows)
    {
        while($row = $result->fetch_assoc())
        {
        $strtime = strtotime($row['time_sent']);
        //$time = date('M d, Y g:i',$strtime);
        $time = date('M d, Y',$strtime);
        $return['msg'] .= '<li class="message">
                            <p class="time">'.$time.'</p>
                          <div class="message-details">
                              <p class="user">
                                <a href="user.php?id='.$row['sender_id'].'">'. $row['username'] .'</a>
                              </p>
                          
                              <div class="clearfix wrap">
                                <p class="user-message">'.stripslashes($row['msg']).'</p> 
                              </div>
                          </div><!--end message-details-->
                          </li>';
        }
    }

    $return['msg'].='</ul><!--end message-list no-list-->';
    echo json_encode($return);
}
else echo $mysqli->error;
?>
