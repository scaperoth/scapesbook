<?php
include('../../functions/func.php');
session_start();
unset( $_SESSION['createmessage']);
$fname = ucfirst(strtolower($_POST['fname']));
$lname = ucfirst(strtolower($_POST['lname']));
$username = trim(strtolower($_POST['username']));

//clear out all quotes including html quotes, string quotes, css quotes, etc.
$username = clean_string($username);

$password = md5($_POST['pass']);

if(ctype_alpha($fname)&&ctype_alpha($lname)&&!empty($username))
{
    $_SESSION['loggedin']=TRUE;

    $insert_query = 'call create_user("'.$fname.'","'.$lname.'","'.$username.'","'.$password.'");';

    if(!($mysqli->query($insert_query))) {
        echo 'Username already exists';
    
        $_SESSION['loggedin']=FALSE;
    }
    else{
        $_SESSION['Welcome_message']="Welcome, $fname";
        echo log_in($username, $password);
        
    }
}
else{
    if(!ctype_alpha($fname))
        echo "First name '$fname' is invalid. Please only include alphabetic characters.<br>";
    if(!ctype_alpha($lname))
        echo "Last name '$lname' is invalid. Please only include alphabetic characters.<br>";
    if(empty($username))
        echo "Username name '$lname' is invalid.";
}
?>

