#ScapesBook
Contributors: Matt Scaperoth 
Tags: social network, networking, friends, responsive

Social networking site used to share profiles, add friends, leave posts, update statuses, and send messages with friends.

> Note:: This repository is a proof of concept that a simple social network could be built with a small code base and no real framework. This is not to be used in any sort of production environment. It uses some bad practices (at times, extremely bad). 

###Description

Program implements responsive design to provide a simple social network where 
people can interact through friendships, posts and messages. 

###How It Works

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

`$variable = '<div class="wrapper">'.some_function().'</div>';`

...

in 'page'.php...

`<div class="container-of-some-kind">
    <?php echo $variable;?>
</div>`


###Posts

Home posts show not only the current logged in user's posts, but also the posts of their friends,
the posts to and from their wall between the user and a friend as well as posts between two friends.

Ex. If I'm friends with John and I post on his wall, that interaction will show up on both of our home posts as well
as any individual post we may create. 
If I'm friends with Jack and Jill and Jack posts on Jill's wall, I will see that post as well on my home page.

User page posts, user.php, are simply any post relating to that user. If i post on someone's wall, they post on mine,
or i update my status (post on my own wall) then that will show on my user screen.

###Profiles

Profiles are plain text and can only be viewed by friends. Profiles can be edited by the logged in user who 
'owns' that profile.

###Post Refresh

posts are refreshed every 10 seconds using ajax calls to the database. Refer to js/refresh_homs.js or js/refresh_my_wall.js
to see the code

###Messaging Functionality

Messaging is accomplished using an initial ajax call to load all messages and then a timer is set to check for 
new messages every 3 seconds. Chat can happen in real time. If a new message is found, it is appended to the end of the chat box. Refer to js/script.js
to see the code.

If new messages are found on page load, then a message will appear saying that you have '# new messages'.

###Friends

Friend requests happen in two stages. A friend sends a request and it goes into the "friend_requests" table,
and then a user must accept that request from their "friend" page. 

An alert appears if there are any outstanding friend requests.

Friend request can be "ignored" which will delete the request from the request table.

###Resources 

1. **JQUERY**

 * jquery from jquery.com

2. **Autocomplete js**

 * autocomplete js from http://bassistance.de/jquery-plugins/jquery-plugin-autocomplete 
used for user search box. uses ajax list to alter input to act like dropdown and return
search results

3. **Custom Scrollbar js**

 * Custom scrollbar from http://manos.malihu.gr/jquery-custom-content-scroller/
adds custom scrollbar to any overflow element. refer to script.js for example
 