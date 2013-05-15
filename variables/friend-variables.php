<?php

//override default page title
$custom_page_title = $user_info['fname'].'\'s Friend Requests';

//returns friend requests
if(!$requests = get_friend_requests()) $requests = '<h2 class="title">No Friend Requests</h2>';

?>