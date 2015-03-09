<?php

require(dirname(__FILE__) . '\\db.php');

$page_info = get_page_info();

if (isset($_SESSION['username']))
{
    $user_info = get_user_info($_SESSION['username']);
}

/* * **************************\
 * Administrative Functions 
  \*************************** */

/**
 * returns the page attributes
 * @return array[mixed] type, url, and title
 */
function get_page_info()
{
    $currentFile = $_SERVER["PHP_SELF"];
    $parts = Explode('/', $currentFile);
    $filename = $parts[count($parts) - 1];
    $short_name = substr($parts[count($parts) - 1], 0, -4);
    $page_info = array();

    $page_info['type'] = $short_name;
    $page_info['url'] = $filename;
    $page_info['title'] = 'ScapesBook';

    return $page_info;
}

/**
 * logs in user
 * @param $user string username
 * @para $pass string password
 */
function log_in($user, $pass)
{
    global $mysqli;
    $login_query = 'select * from users where username = "' . $user . '";';

    if (!$result = $mysqli->query($login_query))
        die(0);

    while ($row = $result->fetch_assoc())
    {
        $db_pass = $row['pass'];
        $user_id = $row['uid'];
    }

    if (!strcmp($db_pass, $pass) && $pass != '')
    {
        $_SESSION['username'] = $user;
        $_SESSION['id'] = $user_id;
        $_SESSION['loggedin'] = TRUE;
        return 1;
    } else
    {
        return 0;
    }
}

/**
 * check if user is logged in and direct/redirect page accordingly
 * @param $url string current page url
 * @return void
 */
function is_loggedin($url = NULL)
{

    if (isset($_SESSION['loggedin']))
    {
        $loggedin = $_SESSION['loggedin'];
        if ($loggedin)
        {
            return TRUE;
        } else
        {
            return FALSE;
        }
    } else
    {
        return FALSE;
    }
}

/**
 * redirects based on which page the user is on and wheher or not s/he has permissions
 * to view that page at the current time
 */
function auth_check()
{
    $url = basename($_SERVER['PHP_SELF']);
    if (!is_loggedin())
    {
        if ($url != 'login.php')
            header('location: login.php');
    }else
    {
        if ($url == 'login.php')
            header('location: index.php');
    }
}

/**
 * Removes all undesired characters from a string including quotes, html quotes, c-style quotes, etc
 * @return void
 */
function clean_string($string)
{
    $string = preg_replace("/<!--.*?-->/", "", $string);
    $string = preg_replace("/\/\/.*?\n/", "\n", $string);
    $string = preg_replace("/\/*.*?\*\//", "", $string);
    $string = str_replace('"', "", $string);
    $string = str_replace("'", "", $string);
    return $string;
}

/* * ********************\
 * Header Functions 
  \********************* */

/**
 * print out header with searchbar, title and responsive top navigation elements
 * @return string html header
 */
function get_header()
{
    $header = '
        <header>
            <div class="top head fixed">
            <div class="limiter">
                <div class="clearfix search-and-nav">
                    <div id="searchbox">
                        <form id="searchForm" action="php_actions/search_actions/search.php">
                            <input type="text" id="search-input" name="search" placeholder="find friends">
                                <a onclick="submit()" id="searchlink">
                                    <div id="search-img"></div>
                                </a>
                            </input>
                            <button hidden type="submit"></button>
                        </form>
                    </div>
                    <div class="top">
                        <div id="site-title">
                            <a href="index.php">
                                <div>ScapesBook Networking</div>
                            </a>
                        </div><!--end site-title-->
                    </div><!--end top-->';
    if (is_loggedin())
    {
        $header.=get_mobile_nav();
        $header.= get_top_nav();
    }
    $header.='
                </div><!--end clearfix search-and-nav-->

            </div><!--end limiter-->

            </div><!--end top head-->
        </header>
        ';
    return $header;
}

/**
 * print out top navigation
 * @return string html of top navigation
 */
function get_top_nav()
{
    global $user_info;
    $user_info = get_user_info($_SESSION['username']);
    return '<div id="main-menu">
                <nav>
                    <ul>
                        <li class="menu-user"><a href="user.php?id=' . $user_info['id'] . '">' . $user_info['fname'] . ' ' . $user_info['lname'] . '</a></li>
                        <li><a href="index.php">Home</a></li>
                        <li>
                            <div class="reveal-section">
                                <div>
                                    <a class="reveal-menu" href="#?javascript: void(0);">
                                        <div id="menu-options-img"></div>
                                    </a>
                                </div>
                                <div class="reveal-object" id="menuaccount">
                                    <nav class="reveal" data-reveal hidden>
                                        <ul id="accountoptions">
                                            
                                            <a href="messages.php"><li>Messages' . (get_num_all_unread_msg() ? ' (' . get_num_all_unread_msg() . ') ' : '') . '</li></a>
                                            <li>
                                                <form action="logout.php" id="logoutForm" method="post">
                                                    <input hidden name="loggingout"/>
                                                    <input type="submit" value="Log Out"/>
                                                </form>
                                            </li>
                                        </ul>
                                    </nav><!--end data reveal-->
                                </div><!--end reveal-object-->
                            </div><!--end reveal-section-->
                        </li>
                    </ul>
                </nav>
             </div><!--end main-menu-->';
}

/**
 * print out top navigation
 * @return string html of mobile responsive navigation
 */
function get_mobile_nav()
{
    $user_info = get_user_info($_SESSION['username']);
    return '<div class="mobile mobile-menu">
                <div id="menu-options">
                    <div id="mobile-select">
                        <a class="reveal-menu" href="#?javascript: void(0);">
                            <div id="menu-img"></div>
                        </a>
                    </div><!--end menu-selector-->
                    <nav class="reveal" data-reveal>
                        <ul>
                            <li class="menu-user"><a href="user.php?id=' . $user_info['id'] . '">' . $user_info['fname'] . ' ' . $user_info['lname'] . '</a></li>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="messages.php">Messages' . (get_num_all_unread_msg() ? ' (' . get_num_all_unread_msg() . ')' : '') . '</a></li>
                            <li>
                                <form action="logout.php" id="logoutForm" method="post">
                                   <input hidden name="loggingout"/>
                                   <input type="submit" value="Log Out"/>
                                </form>
                            </li>
                       </ul>
                    </nav>
                </div><!--end menu-options-->
             </div><!--end mobile top-nav-->';
}

/* * ********************\
 * POST Functions 
  \********************* */
/*
 * script to generate "create post" textarea with option to post to a wall
 * @param $receiver string - if present then the post will be assigned to the receiving user
 * @return string html of post textarea
 */

function get_create_new_post($receiver = NULL)
{

    $user_info = ($receiver) ? get_user_info($receiver, 'uid') : get_user_info($_SESSION['username']);

    return '<form id="newPostForm" action="php_actions/post_actions/create_post.php" method="POST">
                <div id="new-post-div">
                    <div>
                        ' . ($receiver ? '<input name="receiver" value="' . $receiver . '" hidden/>' : '') . '
                        <textarea id="create-new-post" name="new_post" class="text box" rows="1" placeholder="' . ($receiver ? ' Post on ' . $user_info['fname'] . '\'s wall' : ' Enter a New Post') . '"></textarea>
                    </div>
                    <div id="post-submit">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>';
}

/*
 * script to generate posts for home page.
 * Posts that can be viewed are from the user, the users friends, and posts between two friends of the user
 * @return string html for Posts
 */

function get_home_posts()
{
    global $mysqli;
    $user_id = $_SESSION['id'];

    //select my post OR my friends' posts OR 
    $get_posts_query = 'SELECT * FROM posts WHERE (uid = "' . $user_id . '" or receiver_id =  "' . $user_id . '")
            or 
            (
            uid IN
            (select user2_id from friends where user1_id = "' . $user_id . '" ) 
            or uid IN 
            (select user1_id from friends where user2_id = "' . $user_id . '" ) 
            )
            and
            (
            receiver_id IN
            (select user2_id from friends where user1_id = "' . $user_id . '" ) 
            or receiver_id IN 
            (select user1_id from friends where user2_id = "' . $user_id . '" ) 
            or receiver_id is NULL or receiver_id = ""
            )
            
            order by timestamp desc;';
    $return = '';

    $return .='<div class="post-window">';
    $return .='<div class="post-list absolute">';
    $return .= get_post_query($get_posts_query);
    $return .='</div><!--end post-list-->';
    $return .='</div><!--end post window-->';

    return $return;
}

/**
 * get user page posts. 
 * posts that are displayed are ones only belonging to user 
 * including posts that other put on the user's wall and posts sent to other users
 * main focus of page is user interaction, not friends.
 * @return string html users posts
 */
function get_user_page_posts()
{
    global $mysqli;
    $profile_id = $_GET['id'];
    $get_posts_query = 'SELECT * FROM posts WHERE uid = "' . $profile_id . '" or receiver_id = "' . $profile_id . '"
             order by timestamp desc;';
    $return = '';
    $return .= get_post_query($get_posts_query);
    return $return;
}

/**
 * reusable function to return result of posts query in assoc array
 * @param $query string query for posts
 * @return array[mixed] attributes of post whether it is for the home page or the user page
 */
function get_post_query($query)
{
    global $mysqli;
    $return = '';
    if (!$result = $mysqli->query($query))
    {
        $_SESSION['loggedin'] = FALSE;
        die($mysqli->error);
    }

    if ($result->num_rows)
    {
        while ($row = $result->fetch_assoc())
        {
            $post_info = array(
                'txt' => $row['postTxt'],
                'userid' => $row['uid'],
                'receiver' => $row['receiver_id'],
                'time' => $row['timestamp']
            );
            $generated_post = generate_post($post_info);
            $return .='<div class="post">';
            $return .= $generated_post;
            $return .='</div><!--end post-->';
        }
    } else
        $return .= '<div style="text-align:center;">No Posts Found</div>';


    return $return;
}

/**
 * reusable function to create post from assoc array with post attributes
 * @param $post_info array[mixed] array of post attributes to create new post
 * @return string html of single post
 */
function generate_post($post_info)
{

    $user_info = get_user_info($post_info['userid'], 'uid');
    $receiver_info = get_user_info($post_info['receiver'], 'uid');

    $phpdate = strtotime($post_info['time']);
    $mysqldate = date('M d, Y', $phpdate);
    $return = '';
    $return .= '<a href="user.php?id=' . $user_info['id'] . '">' . $user_info['fname'] . ' ' . $user_info['lname'] . '</a>';
    $return .= ($post_info['receiver'] ? ' > <a href="user.php?id=' . $receiver_info['id'] . '">' . $receiver_info['fname'] . ' ' . $receiver_info['lname'] . '</a>' : '');
    $return .= '<p>' . $mysqldate . '</p>';
    $return .= '<p>' . $post_info['txt'] . '</p>';
    return $return;
}

/* * ********************\
 * User Functions 
  \********************* */

/**
 * returns all user info in an assoc array
 * @param $value is the value that you want to find in the database
 * @param $selector is the column that you want to search on (this can be dangerous for password column...)
 * @return array[mixed]
 */
function get_user_info($value, $selector = 'username')
{
    global $mysqli;
    $user_info = array();

    $user_query = 'SELECT * FROM users WHERE ' . $selector . ' = "' . $value . '";';
    if (!$result = $mysqli->query($user_query))
        die($mysqli->error);

    while ($row = $result->fetch_assoc())
    {
        $user_info['id'] = $row['uid'];
        $user_info['fname'] = $row['fname'];
        $user_info['lname'] = $row['lname'];
        $user_info['username'] = $row['username'];
        $user_info['profile'] = $row['profile'];
    }
    return $user_info;
}

/**
 * function creates the profile page based on the id
 * session user must be a friend or the same as/of the _GET user to view profile
 * @param $id get variable from user.php?id=  provides the attributes of the user to be viewed
 * @return string html of user profile
 */
function get_profile_page($id)
{
    $return = '';
    $user_info = get_user_info($id, 'uid');
    if ($user_info)
    {
        //if profile exists then return the profile otherwise state that no profile is available
        $profile_default = (($user_info['profile']) ? '<p>' . $user_info['profile'] . '</p>' : '<p>No Profile Information Available');

        $return .= '<div class="user-info">';

        $return .= '<div class="user-profile name">';
        $return .= '<p><a href="user.php?id=' . $user_info['id'] . '">' . $user_info['fname'] . ' ' . $user_info['lname'] . '\'s</a> Profile</p>';
        $return .= '</div><!--end profile name-->';


        $return .= '<div class="user-profile profile">';
        if (is_friend())
        {
            //checks if session user is owner then allow edit otherwise return the profile default
            $return.=(($user_info['username'] == $_SESSION['username']) ? edit_profile($user_info['profile']) : '<p>' . $profile_default . '</p>');
        } else
        {
            $return .= '<p>Must be a friend to view this user\'s profile. 
            <a href="php_actions/user_actions/request_friend.php?submit=' . $user_info['id'] . '">Send</a> this person a friend request.</p>';
        }

        $return .= '</div><!--end profile-->';


        $return .='</div><!--end user-info-->';
    } else
        $return = '';
    return $return;
}

/**
 * this function allows user to update profile if session user is the owner
 * @param $profileTxt default value is blank
 * @return string html for editing profile
 */
function edit_profile($profileTxt = '')
{
    return '<form id="editProfileForm" data-action="php_actions/user_actions/edit_profile.php" method="POST">
                <textarea id="profileInfo" name="profile" class="text box" placeholder="Tell a little about yourself">' . $profileTxt . '</textarea>
                <button type="submit">Edit</button>
            </form>';
}

/**
 * returns list of friends in ul, li format
 * @return string html list of friends
 */
function get_my_friends()
{
    global $mysqli, $user_info;
    $friend_query = 'SELECT fname, lname, uid,username FROM users,friends 
                    WHERE (user1_id = ' . $user_info['id'] . ' or user2_id = ' . $user_info['id'] . ') 
                    and (uid=user1_id or uid = user2_id)
                    and uid !=' . $user_info['id'] . ';';

    if (!$result = $mysqli->query($friend_query))
    {
        $_SESSION['loggedin'] = FALSE;
        die($mysqli->error);
    }
    $return = '<div class="friend-list">';
    $return.='<h3>Friends</h3>';
    $return .= '<ul class="no-list">';

    if ($result->num_rows)
    {
        while ($row = $result->fetch_assoc())
        {
            $return .= '<li class="friend"><a href="user.php?id=' . $row['uid'] . '">' . $row['fname'] . ' ' . $row['lname'] . ' (' . $row['username'] . ')</a></li>';
        }
        $return.='</ul>';
        $return.='</div><!--end FriendList-->';
    } else
        $return = '';


    return $return;
}

/* * *******************************\
 * FRIEND REQUEST FUNCTIONS
  \******************************** */

/*
 * check if user is friend based on user.php?id= variable
 * @return boolean is friend (also used if user matches get variable) or not friend
 */

function is_friend()
{
    global $mysqli;
    $potential_friend = $_GET['id'];
    $isauser = get_user_info($potential_friend, 'uid');

    if ($isauser['id'])
    {
        $user_id = $_SESSION['id'];
        if (intval($potential_friend) == intval($user_id))
            $num_rows = 1;
        else if (intval($potential_friend) != intval($user_id) && !is_friend_request())
        {


            $are_they_my_friend_query = 'SELECT * FROM friends WHERE (user1_id = ' . $user_id . ' or user1_id = ' . $potential_friend . ') 
                                            and (user2_id = ' . $user_id . ' or user2_id = ' . $potential_friend . ')';
            if ($result = $mysqli->query($are_they_my_friend_query))
                $num_rows = $result->num_rows;
        } else
            $num_rows = 0;
    } else
        $num_rows = 0;

    return $num_rows;
}

/*
 * gets all current friend requests
 * @return string html of all friend requests with option to add or ignore
 */

function get_friend_requests()
{
    global $mysqli;

    $user_id = $_SESSION['id'];

    $did_i_send_request_query = 'SELECT * FROM users where uid in (select sender_id from friend_requests WHERE (receiver_id = ' . $user_id . '));';
    if ($result = $mysqli->query($did_i_send_request_query))
    {
        $return = '';
        if ($result->num_rows)
        {
            $return = '<div class="requests twelve">
                <h2 class="title">My Friend Requests</h2>';
            $return .= '<div id="friend-requests-list">';
            while ($row = $result->fetch_assoc())
            {
                $return .= create_friend_request($row['username'], $row['uid']);
            }
            $return .= '</div><!--end friend-requests-->';
            $return .= '</div><!--end requests-->';
        }
    }
    return $return;
}

/*
 * gets all number of current friend requests
 * @return int number of friend requests
 */

function count_friend_requests()
{
    global $mysqli;

    $user_id = $_SESSION['id'];

    $do_i_have_request = 'SELECT * FROM users where uid in (select sender_id from friend_requests WHERE (receiver_id = ' . $user_id . '));';

    $request_result = $mysqli->query($do_i_have_request);
    return $request_result->num_rows;
}

/**
 * create a friend request with ignore or accept buttons
 * @param $username username of requester
 * @param $id id of requester
 * @return string html of friend request
 */
function create_friend_request($username, $id)
{
    return '<div class="friend-request">
                <p><a href="user.php?id=' . $id . '">' . $username . '</a> sent you a friend request</p>
                <div class="request-actions">
                    <form id = "confirm-request-form-' . $id . '" method="POST" action="php_actions/user_actions/confirm_friend.php">
                        <button type="submit" name="confirm" value="' . $id . '" class="confirm-button">Confirm</button>
                    </form>
                    <form id = "ignore-request-form-' . $id . '" method="POST"  action="php_actions/user_actions/ignore_friend.php">
                        <button type="submit" name="ignore" value="' . $id . '" class="ignore-button">Ignore</button>
                    </form>
                </div><!--end request-actions-->
                <div class="clearfix"></div>
            </div><!--end friend-request-->';
}

/*
 * tells whether or not already friend and creates button to request friendship if not already friend
 * @return string html either that a request is sent, a request button, or blank if already friends or current user
 */

function get_friend_status()
{
    $return = '';
    if (is_friend_request())
    {
        $return = show_request_sent();
    } else if (!is_friend())
    {
        $return = create_request_friend_btn();
    }

    return $return;
}

/**
 * create the button to request friend
 * @return string html for friend request button
 */
function create_request_friend_btn()
{
    return '<form id="addFriendForm" action="php_actions/user_actions/request_friend.php">
                        <button type="submit" name="submit" value="' . $_GET['id'] . '">Request Friend</button>
                    </form>';
}

/**
 * set text to friend request sent
 * @return string friend request is sent
 */
function show_request_sent()
{
    return '<p>Friend Request Sent</p>';
}

/**
 * check if friend request has been sent
 * @return boolean whether or not friend has already been requested
 */
function is_friend_request()
{
    global $mysqli;
    $potential_friend = $_GET['id'];
    $user_info = get_user_info($_SESSION['username']);
    $did_i_send_request_query = 'SELECT * FROM friend_requests WHERE (sender_id = ' . $user_info['id'] . ' and receiver_id = ' . $potential_friend . ')';
    if ($result = $mysqli->query($did_i_send_request_query))
        $num_rows = $result->num_rows;

    if ($num_rows > 0)
        return 1;
    else
        return 0;
}

/* * ********************\
 * MESSAGE Functions 
  \********************* */

/**
 * get all friends for message page
 * @return string html list of friends to message with data attributes to activate chat
 */
function get_message_friends()
{
    global $mysqli;
    $user_id = $_SESSION['id'];
    $friend_query = 'SELECT * FROM users WHERE uid IN (SELECT user2_id FROM friends where user1_id ="' . $user_id . '") 
                        OR uid IN (SELECT user1_id FROM friends where user2_id ="' . $user_id . '")';

    $return = '<div id="message-users-list">';
    $return = '<ul style="list-style:none;">';

    if ($result = $mysqli->query($friend_query))
    {
        while ($row = $result->fetch_assoc())
        {
            $return .= create_message_select($row['uid']);
        }
        if (!$result->num_rows)
            $return .='<li>You don\'t have any friends yet</li>';

        return $return;
        $return.='</ul>';
        $return = '</div><!--end message-users-list-->';
    } else
        return $mysqli->error;
}

/**
 * create a friend list element with data attributes
 * @param $id id of user to create list item for
 * @return string list item with friend info
 */
function create_message_select($id)
{
    global $mysqli;
    $get_user_query = 'SELECT * FROM users WHERE uid = "' . $id . '"';
    if ($result = $mysqli->query($get_user_query))
    {
        if ($result->num_rows && !is_curr_user($id))
        {
            $row = $result->fetch_assoc();
            $unread_messages = get_one_user_num_unread_msg($id);
            return '<li class="message-user" data-name="' . $id . '">
                        ' . $row['fname'] . ' ' . $row['lname'] . ' (' . $row['username'] . ') <span id="num_msg' . $id . '">' . $unread_messages . '<span>
                    </li>';
        }
    } else
        return $mysqli->error;
}

/**
 * get the unread messages from specific friend
 * @param $friend is id of friend to view unread messages from
 * @return string html of unread message block from friend to append to chat box
 */
function get_one_user_unread_msgs($friend)
{
    global $mysqli;
    $return = '';
    $user_id = $_SESSION['id'];
    $query = 'SELECT (select username from users where uid = "' . $friend . '") as username, msg, sender_id, time_sent FROM messages
             WHERE (sender_id = ' . $friend . ' AND receiver_id = ' . $user_id . ') and unread_flag = 1';
    if ($result = $mysqli->query($query))
    {
        while ($row = $result->fetch_assoc())
        {
            $strtime = strtotime($row['time_sent']);
            //$time = date('M d, Y g:i',$strtime);
            $time = date('M d, Y', $strtime);

            $return .= '<li class="message">
                            <p class="time">' . $time . '</p>
                          <div class="message-details">
                              <p class="user">
                                <a href="user.php?id=' . $row['sender_id'] . '">' . $row['username'] . '</a>
                              </p>
                          
                              <div class="clearfix wrap">
                                <p class="user-message">' . stripslashes($row['msg']) . '</p> 
                              </div>
                          </div><!--end message-details-->
                          </li>';
        }
        return $return;
    }
}

/**
 * returns number of unread messages from specific user
 * is used to display number of messages on message page from specific user
 * @param $friend id of friend to get number of unread messages from
 * @return int number of messages or blank if no messages found
 */
function get_one_user_num_unread_msg($friend)
{
    global $mysqli;
    $user_id = $_SESSION['id'];
    $query = 'SELECT COUNT(mid) as num_msg FROM messages WHERE (sender_id = ' . $friend . ' AND receiver_id = ' . $user_id . ') and unread_flag = 1';
    if ($result = $mysqli->query($query))
    {
        $row = $result->fetch_assoc();

        return ($row['num_msg'] ? '(' . $row['num_msg'] . ')' : '');
    }
}

/**
 * returns number of all unread messages
 * is used to display number of messages across site
 * @return int number of messages or blank if no messages found
 */
function get_num_all_unread_msg()
{
    global $mysqli;
    $user_id = $_SESSION['id'];
    $query = 'SELECT COUNT(mid) as num_msg FROM messages WHERE receiver_id = ' . $user_id . ' and unread_flag = 1';
    $result = $mysqli->query($query);
    if ($result)
    {
        $row = $result->fetch_assoc();

        return ($row['num_msg'] ? $row['num_msg'] : '');
    }
}

/**
 * check if user argument is current session user
 * @param $check_id user id to check against
 * @return boolean whether or not check_id is current user
 */
function is_curr_user($check_id)
{
    $user_info = get_user_info($_SESSION['username']);
    if (intval($check_id) != intval($user_info['id']))
    {
        return 0;
    } else
        return 1;
}

/**
 * create container for replying in chat
 * @param $user_id id of user that chat is with
 * @return string html of textarea used to chat
 */
function get_message_reply_container($user_id)
{
    return '<div id="message-form-div">
            <form id="sendMessageForm">
                <textarea id="message-txt" data-from="' . $user_id . '" name="message" placeholder="Send a Message"></textarea>
                <button type="submit" id="send-reply" name="reply">Send</button>
            </form>
            </div><!--end message-form-div-->';
}

?>