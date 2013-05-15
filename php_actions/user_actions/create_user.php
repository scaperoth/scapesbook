<?php
include('../../functions/func.php');
//begin new session
session_start();

//clear create message
unset( $_SESSION['createmessage']);

//format fname, lname and username and assign to variables
$fname = ucfirst(strtolower($_POST['fname']));
$lname = ucfirst(strtolower($_POST['lname']));
$username = trim(strtolower($_POST['username']));

//clear out all quotes including html quotes, string quotes, css quotes, etc.
$username = clean_string($username);

//encrypt password
$password = md5($_POST['pass']);

//make sure fname and lname are all aplhab. characters, and username is not null or blank
if(ctype_alpha($fname)&&ctype_alpha($lname)&&!empty($username))
{

    //create user using create_user() procedure
    $insert_query = 'call create_user("'.$fname.'","'.$lname.'","'.$username.'","'.$password.'");';

    //return error message if user already exists
    if(!($mysqli->query($insert_query))) {
        echo 'Username already exists';
    
        $_SESSION['loggedin']=FALSE;
    }
    else{
        //login if above is satisfied
        $_SESSION['loggedin']=TRUE;
        $_SESSION['Welcome_message']="Welcome, $fname";
        echo log_in($username, $password);
        
    }
}
else{
    //return error messages based on condition that failed
    if(!ctype_alpha($fname))
        echo "<p class='error'>First name '$fname' is invalid. Please only include alphabetic characters.<p>";
    if(!ctype_alpha($lname))
        echo "<p class='error'>Last name '$lname' is invalid. Please only include alphabetic characters.</p>";
    if(empty($username))
        echo "<p class='error'>Username name '$lname' is invalid.</p>";
}
?>

