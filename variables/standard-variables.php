<?php
include('functions/func.php');

/*
 *standard variables used on every page
 */

 //message to display if just created user and logged in message is set in php_actions/user_actions/create_user.php
$welcome_message = ($_SESSION['Welcome_message']?'<h2 class="welcome-message">'.$_SESSION['Welcome_message'].'!</h2>':'');

//num_alert get num of unread messages, if any
$num_messages = (get_num_all_unread_msg()?'('.get_num_all_unread_msg().') ':'');

//page information type, e.g. user, index, profile, etc.
$page_type = $page_info['type'];

//can override default title on customer *-variables.php pages, "ScapesBook"
$default_page_title = $page_info['title'];

//get current page url
$page_url = $page_info['url'];

//make sure user is logged in
is_loggedin($page_url);

//header
$styles = 
"<link rel='stylesheet' href='css/normalize.css'/>
        <link rel='stylesheet' href='css/main.css'/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>";
//get header html
$header=get_header();

//get number of friend requests
$num_friend_requests = count_friend_requests();

//print message for friend requests
$requests_message = ($num_friend_requests?'<p>You have '.$num_friend_requests.' <a href="friend.php">friend request(s)</a><p>':'');

//footer
$scripts = 
'<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>'.
        ($page_info['type']=='index'?'<script src="js/refresh_home.js"></script>':'')
        .($page_info['type']=='user'?'<script src="js/refresh_my_wall.js"></script>':'');

?>