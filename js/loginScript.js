//relative root
//var root = 'http://scaperoth.com/projects/scapesbook/';
var root = '../';

/**
 * submit login form to php_actions/login_actions/login_validate.php and serialize the login form to process
 * on return either print error or redirect by reloading page.
 */
$('#loginForm').submit(function (e) {
    e.preventDefault();
    $.post(root + 'php_actions/login_actions/login_validate.php', $(this).serialize(), function (data) {
        if (!data) {
            $('#loginmessage').html('<p class="error">Invalid Username or Password</p>');
        }
        else { location.reload(); }
    });
});

/**
 * submit signup form to php_actions/user_actions/create_user.php and serialize the signup form to process
 * on return either print error or redirect by reloading page and clear form fields.
 */
$('#signup').submit(function (e) {
    e.preventDefault();
    $.post(root + 'php_actions/user_actions/create_user.php', $(this).serialize(), function (data) {
        if (data==1) {
            location.reload();
        }
        else $('#signupmessage').html(data);

        $('#signup input').val("");
    });
});