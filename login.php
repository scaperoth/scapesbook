<?php
include('variables/standard-variables.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <title>ScapesBook Login</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/login.css"/>
        <?php echo $scripts; ?>

        <script>
            'article aside footer header nav section time'.replace(/\w+/g, function (n) {
                document.createElement(n)
            })
        </script>
    </head>
    <body>
        <div class="limiter">
            <header>
                <div id="site-title">
                    <a href="index.php">
                        <div>ScapesBook Networking</div>
                    </a>
                </div><!--end site-title-->
                <div class="description">
                    <blockquote>Welcome to Scapesbook! Login or sign up below.</blockquote>
                </div>
            </header>
            <div class="container">
                <div class="form" id="login-form-container">

                    <form id="loginForm" name="loginForm" method="post" >

                        <h3>Login</h3>
                        <p id="loginmessage" class="error"></p>

                        <label for="username">Username</label>
                        <p>
                            <input type="text" name="username" placeholder="username"/>
                        </p>

                        <label for="password">Password</label>
                        <p>
                            <input type="password" name="pass" placeholder="password"/>
                        </p>
                        <div class="right">
                            <button type="submit" id="login">Login</button>
                        </div>
                        <div class="clearfix"></div>
                    </form><!--end loginForm-->
                </div><!--end login form container-->

                <div class="form" id="register-form-container">
                    <form id="signup" action="php_actions/user_actions/create_user.php" method="post">

                        <h3>SignUp</h3>
                        <p id="signupmessage" class="error"></p>
                        <?php echo (isset($_SESSION['createmessage']) ? $_SESSION['createmessage'] : ""); ?>

                        <label for="fname">First Name</label>
                        <p>
                            <input type="text" required name="fname" placeholder="First"/>
                        </p>

                        <label for="lname">Last Name</label>
                        <p>
                            <input type="text" required name="lname" placeholder="Last"/>
                        </p>

                        <label for="username">Username</label>
                        <p>
                            <input type="text" required name="username" placeholder="username"/>
                        </p>

                        <label for="pass">Password</label>
                        <p>
                            <input type="password" required name="pass" placeholder="password"/>
                        </p>
                        <div class="right">
                            <button type="submit" id="create_user">Submit</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div><!--end register form container-->

            </div><!--end container-->
        </div><!--end limiter-->
        <?php unset($_SESSION['createmessage']); ?>
        <script type="text/javascript" src="js/loginScript.js"></script>
    </body>
</html>
