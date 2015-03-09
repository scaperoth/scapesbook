/*******************************************\
* refresh user wall on interval of 10 seconds
* using ajax $.GET
* 
* @author Matt Scaperoth
\*******************************************/
//var root = 'http://scaperoth.com/projects/scapesbook/';
var root = './';
$(document).ready(function () {
    var split = location.search.replace('?', '').split('=');
    var variable = split[0];
    var value = split[1];
    refresh_interval = setInterval(function () {
        $.GET(root + "php_actions/post_actions/get_user_posts.php", { variable: value }, function (data) {
            $('#user-page-posts').html(data);
        });
    }, 10000);
});