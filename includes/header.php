<?php
include('variables/standard-variables.php');

include('variables/'.$page_info['type'].'-variables.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo (($custom_page_title)?$custom_page_title:$default_page_title);?></title>
        <!--[if lt IE 9]>
        <script>
          'article aside footer header nav section time'.replace(/\w+/g,function(n){document.createElement(n)})
        </script>
        <![endif]-->
        <?php echo $styles;?>
        <link rel="stylesheet" type="text/css" href="js/autocomplete/jquery.autocomplete.css" />
        <link href="js/scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
        
      
    </head>
    
    <body>
        
    <div class="container">
        
        <?php echo $header;?>
        <div class="inside">
                        
                    
                
            </div><!--end inside-->
            <div class="limiter">
                         <?php 
                            
                            echo ($num_messages&&$page_info['type']!='messages'?'You have '.$num_messages.' <a href="messages.php">new message(s)</a>':'');
                         ?>
                        
                    
                        <?php 
                            
                            echo ($requests_message&&$page_info['type']!='friend'?$requests_message:'');
                         ?>