<?php
include "../functions/func.php";
/**
 * user variables
 */

if($_GET['id'])
{
    $user_page_info = get_user_info($_GET['id'],'uid');
    $top_area = '<div class="user-info">
                    <div class="username">
                        '.$user_page_info['fname'].' '.$user_page_info['lname'].'
                     </div>
                     <div class="profileLink">
                        <a href="profile.php?id='.$user_page_info['id'].'">Profile</a>
                     </div><!--end profileLink-->
                 </div><!--end user-info-->';

    if(is_friend()){
        $create_post = (($user_info['id']!=$_GET['id'])?get_create_new_post($_GET['id']):get_create_new_post());
    }

    $custom_page_title = $user_info['fname'].' '.$user_info['lname'];

    $posts =  get_user_page_posts();

    $add_friend_status = get_friend_status();
}
else $top_area = 'User Not Found';
?>
