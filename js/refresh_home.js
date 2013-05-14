$(document).ready(function () {
    refresh_interval = setInterval(function () {
        $.post(root + "php_actions/post_actions/get_home_posts.php", function (data) {
            $('#post-section .list').html(data);
        });
    },10000);
});