<?php
//include necessary variables that are used on all pages
include('variables/standard-variables.php');

//include page-specific variables, i.e. user.php will have user-variables
include('variables/' . $page_info['type'] . '-variables.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <title><?php echo ((isset($custom_page_title)) ? $custom_page_title : $default_page_title); ?></title>
        <!--to create html5 elements in IE 8 or lower-->
        <!--[if lt IE 9]>
        <script>
          'article aside footer header nav section time'.replace(/\w+/g,function(n){document.createElement(n)})
        </script>
        <![endif]-->
        <?php echo $styles; ?>
        <!---------------------------------------------------------------------------------------|
            autocomplte js from http://bassistance.de/jquery-plugins/jquery-plugin-autocomplete 
            used for user search box. uses ajax list to alter input to act like dropdown and return
            search results
        ------------------------------------------------------------------------------------------>
        <link rel="stylesheet" type="text/css" href="js/autocomplete/jquery.autocomplete.css" />

        <!---------------------------------------------------------------------------------------|
            Custom scrollbar from http://manos.malihu.gr/jquery-custom-content-scroller/
            adds custom scrollbar to any overflow element. refer to script.js for example
        ------------------------------------------------------------------------------------------>
        <link href="js/scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />


    </head>

    <body>
        <div class="container">

            <?php echo $header; ?>
            <div class="inside">



            </div><!--end inside-->
            <div class="limiter">
                <?php
                //if there are messages then print out how many and link to the messages page
                echo ($num_messages && $page_info['type'] != 'messages' ? 'You have ' . $num_messages . ' <a href="messages.php">new message(s)</a>' : '');
                ?>


                <?php
                //if there are friend requests print out request message
                echo ($requests_message && $page_info['type'] != 'friend' ? $requests_message : '');
                ?>