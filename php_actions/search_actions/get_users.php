<?php
/************************************************************\
*   This page works with jquery.autocomplete.js to populate 
    user search/lookup field by querying the database with
    current string, one character at a time

    Ex. User types "m", then GET[q] will be "m"
    User then types "a", then GET[q] will be "ma"
\***********************************************************/

require_once "../../functions/func.php";

//get argument for user search
$q = strtolower($_GET["q"]);

//if the query exists, continue, otherwise return
if (!$q) return;
 
//query db with all users containing query string
$sql = "select DISTINCT lname, fname, username from users where fname LIKE '%$q%' or lname LIKE '%$q%' or username LIKE '%$q%';"; 

//execute query
$rsd = $mysqli->query($sql);

//loop through results
while($rs =$rsd->fetch_assoc()) {
    //print out results as fname lname (username)
    $cname = $rs['fname'] .' '. $rs['lname'].' ('.$rs['username'].')';

    //return result
    echo "$cname\n";
}
?>