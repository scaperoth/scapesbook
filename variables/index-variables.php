<?php
/**
 * home variables
 */

//create post area
$top_area = get_create_new_post();

/**
 * area for friend notifications
 */
$user_id = $_SESSION['id'];


/**
 * middle area of page code
 */
$middle_area = get_home_posts();

//get friends list for right side of page
$right_area = get_my_friends();

$right_area= ($right_area?$right_area:'<h3>Friends</h3>
                    <p>You have no friends...</p>')
?>
