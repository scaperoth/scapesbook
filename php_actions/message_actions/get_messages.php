<?php
include "../../functions/func.php";

//get users conversation is between
$reciever = $_POST['id'];
$sender = $_SESSION['id'];

//call procedure to return messages and reset unread messages to read
$get_messages_query = 'call get_messages("'.$reciever.'","'.$sender.'")'; 

//create assoc array to return as object with msg,receiver,sender
$return = array('msg'=>'','receiver'=>$reciever,'sender'=>$sender );

//execute query
if($result = $mysqli->query($get_messages_query)){
    //default message container
    $return['msg'].='<ul class="message-list no-list">';

    //check if there are any messages if not, return default container
    if($result->num_rows)
    {
        //if there are messages, cycle through results
        while($row = $result->fetch_assoc())
        {
        //format time to display
        $strtime = strtotime($row['time_sent']);
        //used to test hours, min
        //$time = date('M d, Y g:i',$strtime);

        //format time as Month(long form) day(int), Year
        $time = date('M d, Y',$strtime);

        //create message block for each message found
        //strip slashes from escaped characters
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
    //close default container
    $return['msg'].='</ul><!--end message-list no-list-->';
    //return json object
    echo json_encode($return);
}
//if there is an error in the query, print error
else echo $mysqli->error;
?>
