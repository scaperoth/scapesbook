//var root = 'http://scaperoth.com/projects/scapesbook/';
var root = '../';
var check_for_new_msg_interval;


$('#create-new-post').focus(function () {
    document.getElementById('post-submit').style.display = "block";
    document.getElementById('create-new-post').style.height = "50px";
});

$('.reveal-menu').click(function () {
    $('nav[data-reveal]').toggle();
});

$('#editProfileForm').submit(function (e) {
    e.preventDefault();
    $.post($(this).attr('data-action'), $(this).serialize(), function (data) {
        alert(data);
    });
});



$(document).ready(function () {
    $("#search-input").autocomplete(root + "php_actions/search_actions/get_users.php", {
        width: 260,
        matchContains: true,
        selectFirst: false
    });
    get_num_unread_messages();

});

function set_message_action(){
    $('.message-user').click(function () {
        clearInterval(check_for_new_msg_interval);
        console.log('test');
        var receiver = $(this).attr('data-name');

        $('.message-user').removeClass('active');

        $(this).addClass('active');
        
        load_messages(receiver);

        create_reply_box(receiver);


        check_for_new_msg_interval = setInterval(function () {
            check_for_new_msg(receiver);
        }, 3000);

    });
}
function load_messages(receiver){
    $.post(root + "php_actions/message_actions/get_messages.php", { id: receiver }, function (data) {
        var response = $.parseJSON(data);
        $('.message-container').html(response.msg);

        get_num_unread_messages();

        if ($('.message-container').html() == '') {
            console.log('no-messages');
            //$('.message-container').html(document.getElementById('message-error').innerHTML);
        }
        $(".message-list").mCustomScrollbar({
            scrollInertia: 0
        });

        $(".message-list").mCustomScrollbar("scrollTo", "last", {
            scrollInertia: 0
        });


    });
}

function create_reply_box(receiver){
    $.post(root + "php_actions/message_actions/get_reply_box.php", { id: receiver }, function (data) {
        var response = $.parseJSON(data);
        var receiver = response.receiver;
        var sender = response.sender;
        $('#reply-container').html(response.reply);

        $('#send-reply').attr('value',receiver);

        $('#send-reply').click(function (e) {
            e.preventDefault();
            send_message(sender, receiver);
        });
    });
}

function send_message(sender, receiver){
    var message=document.getElementById('message-txt').value;
    if (message != '') {
        $.post(root + "php_actions/message_actions/send_message.php", { sender: sender, receiver: receiver, message: message }, function (data) {
            $('#message-txt').attr('value', '');
            load_messages(receiver);
        });
    }
}

function check_for_new_msg(receiver){
    $.post(root + "php_actions/message_actions/check_for_new_msg.php", { friend: receiver }, function (data) {
        //console.log(data);
        if (data) {
            $('.message-list .mCSB_container').append(data);
            $(".message-list").mCustomScrollbar("update");
            $(".message-list").mCustomScrollbar("scrollTo", "last", {
                scrollInertia: 0
            });
        }
        else {
        }

    });
}

function get_num_unread_messages(){
    $.post(root + "php_actions/message_actions/get_unread.php", function (data) {
        $('#user-list').html(data);
        set_message_action();
    });
}
