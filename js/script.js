//var root = 'http://scaperoth.com/projects/scapesbook/';
var root = '../';
var message_interval;


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
        clearInterval(message_interval);
        console.log('test');
        var receiver = $(this).attr('data-name');

        $('.message-user').removeClass('active');

        $(this).addClass('active');

        create_reply_box(receiver);

        load_messages(receiver);

        message_interval = setInterval(function () {
            load_messages(receiver);
        }, 10000);

    });
}
function load_messages(receiver){
    $.post(root + "php_actions/message_actions/get_messages.php", { id: receiver }, function (data) {
        var response = $.parseJSON(data);
        $('.message-container').html(response.msg);

        if ($('.message-container').html() == '') {
            //console.log('no-messages');
            //$('.message-container').html(document.getElementById('message-error').innerHTML);
        }
        $(".message-list").mCustomScrollbar({
            scrollInertia:0
        });

        $(".message-list").mCustomScrollbar("scrollTo","last",{
            scrollInertia:0
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

function get_num_unread_messages(){
    $.post(root + "php_actions/message_actions/get_unread.php", function (data) {
        $('#user-list').html(data);
        set_message_action();
    });
}
function load_posts(){
    
}
