<?php
   //begin session on each page since every page includes the functions file and the functions file includes the db.php file
   session_start();
   
   //first one for online server, second one for local machine
   //$mysqli = new mysqli("scapesbook.db.10489393.hostedresource.com", "scapesbook", "Sc@pesB00k", "scapesbook");
   $mysqli = new mysqli("localhost","scapesbook", "Sc@pesB00k", "scapesbook");

    /* check connection */
    if ($mysqli->connect_errno) {
        echo "Connect failed:". $mysqli->connect_error;
        exit();
    }

    //query style is as follows:
    /*
    $query = "SELECT * from friends;";

    if(!$result = $mysqli->query($query)){
     die('There was an error running the query [' . $mysqli->error . ']');
    }
    while($row = $result->fetch_assoc()){
        echo $row['user1_id'] . '<br />';
    }
    */
?>
