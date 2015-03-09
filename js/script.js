/*******************************************\
* script.js contains general binding functions
* and all message functions
*
* @uses jquery.mCustomScrollbar, jquery.autocomplete libs
* 
* @author Matt Scaperoth
\*******************************************/

//var root = 'http://scaperoth.com/projects/scapesbook/';
var root = './';
var check_for_new_msg_interval;

//make create post textarea larger on focus and display submit button
$('#create-new-post').focus(function () {
    document.getElementById('post-submit').style.display = "block";
    document.getElementById('create-new-post').style.height = "50px";
});

//reveal menu on cleick based on data-reveal attribute
$('.reveal-menu').click(function () {
    $('nav[data-reveal]').toggle();
});

//edit profile override to php file in data-action attribute and alert success when complete
$('#editProfileForm').submit(function (e) {
    e.preventDefault();
    $.post($(this).attr('data-action'), $(this).serialize(), function (data) {
        alert(data);
    });
});


$(document).ready(function () {
    //create autocomplete box for search capabilities. Search values based on all users
    $("#search-input").autocomplete(root + "php_actions/search_actions/get_users.php", {
        width: 260,
        matchContains: true,
        selectFirst: false
    });

    //call function get_num_unread_messages() to print out alert to user on refresh or load
    get_num_unread_messages();

});

/*======================================\
*   MESSAGING FUNCTIONS
\======================================*/
/**
 * sets click function of each user in message list
 * @return void
 */
function set_message_action(){
    $('.message-user').click(function () {
        //clear previous interval to check for new messages
        clearInterval(check_for_new_msg_interval);
        
        //console.log('test');
        
        //set "receiver" to user that chat will be initiated with
        var receiver = $(this).attr('data-name');

        //remove all other active classes of user list
        $('.message-user').removeClass('active');

        //add active class to selected user
        $(this).addClass('active');
        
        //call load_messages() function to get all previous messages between users
        load_messages(receiver);

        //create textarea and submit button used to chat
        create_reply_box(receiver);

        //create interval to query db and return any new messages in chat box every 3 seconds
        check_for_new_msg_interval = setInterval(function () {
            check_for_new_msg(receiver);
        }, 3000);

    });
}

/**
 * loads all previous and new messages between users based on "receiver" or selected chat friend
 * @param int receiver  user who conversation is with
 * @return void
 */
function load_messages(receiver){
    //post to get_messages with post variable of id set to the receiver or chat friend
    $.post(root + "php_actions/message_actions/get_messages.php", { id: receiver }, function (data) {
        //create object to hold return data
        var response = $.parseJSON(data);

        //fill message container with list of all messages b/t users
        $('.message-container').html(response.msg);

        //recreate user left user list to reset number of unread messages
        get_num_unread_messages();

        //area to display optional message if no messages are found
        if ($('.message-container').html() == '') {
            //console.log('no-messages');
            //$('.message-container').html(document.getElementById('message-error').innerHTML);
        }
        
        //add custom scrollbar to message list
        $(".message-list").mCustomScrollbar({
            scrollInertia: 0
        });

        //scroll to bottom of messages list
        $(".message-list").mCustomScrollbar("scrollTo", "last", {
            scrollInertia: 0
        });

    });
}

/**
 * creates reply box using ajax $.POST based on who the message "receiver" is 
 * calls php_actions/message_actions/get_reply_box.php
 * @param int receiver id of receiver to chat with
 * @return void
 */
function create_reply_box(receiver){
    $.post(root + "php_actions/message_actions/get_reply_box.php", { id: receiver }, function (data) {
        //create object to hold response
        var response = $.parseJSON(data);
        
        //assign message receiver
        var receiver = response.receiver;

        //assign message sender
        var sender = response.sender;

        //add reply textarea html to reply-container
        $('#reply-container').html(response.reply);

        //add reciever value to submit button
        $('#send-reply').attr('value',receiver);

        //override default click function of submit button
        $('#send-reply').click(function (e) {
            e.preventDefault();
            //send message from sender to receiver
            send_message(sender, receiver);
        });
    });
}

/**
 * send message using ajax $.POST and php_actions/message_actions/send_message.php
 * @param int sender  id of current user sending the message
 * @param int receiver  id of user to receive message
 * @return void
 */
function send_message(sender, receiver){
    //get text from message box
    var message=document.getElementById('message-txt').value;

    //send to php page if message contains text
    if (message != '') {
        $.post(root + "php_actions/message_actions/send_message.php", { sender: sender, receiver: receiver, message: message }, function (data) {
            //reset message textarea
            $('#message-txt').attr('value', '');
            //reload messages
            load_messages(receiver);
        });
    }
}

/**
 * get new/unread message using ajax $.POST and php_actions/message_actions/check_for_new_msg.php
 * @param int receiver  id of user message is from
 * @return void
 */
function check_for_new_msg(receiver){
    $.post(root + "php_actions/message_actions/check_for_new_msg.php", { friend: receiver }, function (data) {
        //console.log(data);
        
        //if there are any unread messages, append them to the chat box and refresh the scrollbar
        if (data) {
            $('.message-list .mCSB_container').append(data);
            $(".message-list").mCustomScrollbar("update");
            $(".message-list").mCustomScrollbar("scrollTo", "last", {
                scrollInertia: 0
            });
        }
        else {
            //do something if no new messages are found
        }
    });
}

/* get number of new/unread message using ajax $.POST and php_actions/message_actions/get_unread.php
 * @return void
 */
function get_num_unread_messages(){
    $.post(root + "php_actions/message_actions/get_unread.php", function (data) {
        //refresh user list with new data
        $('#user-list').html(data);

        //set click function of users list
        set_message_action();
    });
}
