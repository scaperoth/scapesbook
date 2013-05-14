var root = '../';

$('#loginForm').submit(function (e) {
    e.preventDefault();
    $.post(root + 'php_actions/login_actions/login_validate.php', $(this).serialize(), function (data) {
        if (!data) {
            $('#loginmessage').html('<p class="error">Invalid Username or Password</p>');
        }
        else { location.reload(); }
    });
});

$('#signup').submit(function (e) {
    e.preventDefault();
    $.post(root + 'php_actions/user_actions/create_user.php', $(this).serialize(), function (data) {
        if (data==1) {
            location.reload();
        }
        $('#signupmessage').html(data);

        $('#signup input').val("");
    });
});