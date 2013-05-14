<?php
/**
 * home variables
 */

$top_area = get_create_new_post();

/**
 * area for friend notifications
 */
$user_id = $_SESSION['id'];


/**
 * middle area of page code
 */
$middle_area = get_home_posts();

$right_area = get_my_friends();

$right_area= ($right_area?$right_area:'<h3>Friends</h3>
                    <p>You have no friends...</p>')
?>
