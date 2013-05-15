/*******************************************\
* refresh home posts on interval of 10 seconds.
* using ajax $.POST
* 
* @author Matt Scaperoth
\*******************************************/
//var root = 'http://scaperoth.com/projects/scapesbook/';
var root = '../';
$(document).ready(function () {
    refresh_interval = setInterval(function () {
        $.post(root + "php_actions/post_actions/get_home_posts.php", function (data) {
            $('#post-section .list').html(data);
        });
    },10000);
});