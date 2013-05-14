<?php 
include('variables/standard-variables.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8" />
        <title>ScapesBook Login</title>
        <link rel="stylesheet" href="css/login.css"/>
        <?php echo $scripts;?>
        
        <script>
          'article aside footer header nav section time'.replace(/\w+/g,function(n){document.createElement(n)})
        </script>
    </head>
    <body>
        <header>
            
        </header>
        <div class="container">
            <div class="form" id="login-form-container">
                <form id="loginForm" name="loginForm" method="post" >
                    
                    <h3>Login</h3>
                    <p id="loginmessage"></p>
                    <p>
                        <input type="text" name="username" placeholder="username"/>
                    </p>
                    <p>
                        <input type="password" name="pass" placeholder="password"/>
                    </p>
                    <button type="submit" id="login">Login</button>
                </form><!--end loginForm-->
            </div><!--end login form container-->

            <div class="form" id="register-form-container">
                <form id="signup" action="php_actions/user_actions/create_user.php" method="post">
                    
                    <h3>SignUp</h3>
                    <p id="signupmessage"></p>
                    <?php echo $_SESSION['createmessage'];?>
                    <p>
                        <input type="text" required name="fname" placeholder="First"/>
                    </p>
                    <p>
                        <input type="text" required name="lname" placeholder="Last"/>
                    </p>
                    <p>
                        <input type="text" required name="username" placeholder="username"/>
                    </p>
                    <p>
                        <input type="password" required name="pass" placeholder="password"/>
                    </p>
                    <button type="submit" id="create_user">Submit</button>
                </form>
            </div><!--end register form container-->
        </div><!--end container-->
        <?php unset($_SESSION['createmessage']);?>
        <script type="text/javascript" src="js/loginScript.js"></script>
    </body>
</html>
