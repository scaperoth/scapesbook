<?php
require_once "../../functions/func.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
 
$sql = "select DISTINCT lname, fname, username from users where fname LIKE '%$q%' or lname LIKE '%$q%' or username LIKE '%$q%';"; 
$rsd = $mysqli->query($sql);
while($rs =$rsd->fetch_assoc()) {
    $cname = $rs['fname'] .' '. $rs['lname'].' ('.$rs['username'].')';
    echo "$cname\n";
}
?>