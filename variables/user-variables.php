<?php
/**
 * user variables
 */

 //if id variable is set...
if($_GET['id'])
{
    //get user page attributes
    $user_page_info = get_user_info($_GET['id'],'uid');
    //return top block including username and profile link 
    $top_area = '<div class="user-info">
                    <div class="username">
                        '.$user_page_info['fname'].' '.$user_page_info['lname'].'
                     </div>
                     <div class="profileLink">
                        <a href="profile.php?id='.$user_page_info['id'].'">Profile</a>
                     </div><!--end profileLink-->
                 </div><!--end user-info-->';

    //if page is friend the get send post otherwise just create regular post option. if not friend, do nothing.
    if(is_friend()){
        $create_post = (($user_info['id']!=$_GET['id'])?get_create_new_post($_GET['id']):get_create_new_post());
    }

    //override page title to users first and last name
    $custom_page_title = $user_info['fname'].' '.$user_info['lname'];

    //get user posts
    $posts =  get_user_page_posts();

    //get add friend button if not already friends
    $add_friend_status = get_friend_status();
}
//if id is not set then print error
else $top_area = 'User Not Found';
?>
