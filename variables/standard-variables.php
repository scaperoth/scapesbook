<?php
include('functions/func.php');

/*
 *standard variables
 */
$welcome_message = ($_SESSION['Welcome_message']?'<h2 class="welcome-message">'.$_SESSION['Welcome_message'].'!</h2>':'');

//num_alert
$num_messages = (get_num_all_unread_msg()?'('.get_num_all_unread_msg().') ':'');

//page information
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

$header=get_header();

$num_friend_requests = count_friend_requests();

$requests_message = ($num_friend_requests?'<p>You have '.$num_friend_requests.' <a href="friend.php">friend request(s)</a><p>':'');

//footer
$scripts = 
'<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>'.
        ($page_info['type']=='index'?'<script src="js/refresh_home.js"></script>':'')
        .($page_info['type']=='user'?'<script src="js/refresh_my_wall.js"></script>':'');

?>