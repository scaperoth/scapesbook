=== ScapesBook ===
Contributors: Matt Scaperoth 
Tags: social network, networking, friends, responsive

Social networking site used to share profiles, add friends, leave posts, update statuses, and send messages with friends.

== Description ==

Program implements responsive design to provide a simple social network where 
people can interact through friendships, posts and messages. 

= How It Works =

Program is laid out in a template fashion. Each page has a variables page in the variables file, i.e. the user.php
file has a user-variables file. These variables files contain calls to functions to create "node" elements 
for each specific page that can be easily manipulated. 

The main pages can be changed with html to rearrange the nodes as desired.

The functions file, found in functions/func.php, connects to the database and starts the session(). In the functions file
are all of the functions to create the different elements used in the site. 

Example, in order to create the posts for the home page you call the func.php function create_home_posts() from in the
index-variables.php file and wrap it around whatever elements you'd like in the index.php file. 

If you'd like to include something like the home posts on another page you would do the same thing 
in 'page'-variables.php by calling the function and then in 'page'.php you would 
<?php echo... the variable that has the return value from the called function assigned to it.

in 'page'-variables.php...

$variable = '<div class="wrapper">some_function()</div>;

...

in 'page'.php...

<div class="container-of-some-kind">
    <?php echo $variable;?>
</div>

= Resources = 

Autocomplete js
---
autocomplte js from http://bassistance.de/jquery-plugins/jquery-plugin-autocomplete 
used for user search box. uses ajax list to alter input to act like dropdown and return
search results

Custom Scrollbar js
---
Custom scrollbar from http://manos.malihu.gr/jquery-custom-content-scroller/
adds custom scrollbar to any overflow element. refer to script.js for example
 


==Readme Generator== 

This Readme file was generated using <a href = 'http://sudarmuthu.com/wordpress/wp-readme'>wp-readme</a>, which generates readme files for WordPress Plugins.