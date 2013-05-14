<?php

$custom_page_title = $user_info['fname'].'\'s Friend Requests';

if(!$requests = get_friend_requests()) $requests = '<h2 class="title">No Friend Requests</h2>';

?>