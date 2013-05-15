<?php
//get profile page or show that user couldn't be found
$profile_content = ((get_profile_page($_GET['id']))?get_profile_page($_GET['id']):"<p>User not found</p>");

?>

