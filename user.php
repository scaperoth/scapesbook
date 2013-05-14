<?php 
include('includes/header.php');?>
    

    <?php echo ($_SESSION['message'])?$_SESSION['message']:'';?>


    <?php echo $add_friend_status;?>
    

    <?php echo $top_area;?>

    <?php echo $user_page;?>

    <?php echo $create_post;?>
    <div id="user-page-posts">
        <?php echo $posts;?>
    </div>
    <?php unset($_SESSION['message']);?>
    
<?php
include('includes/footer.php');
?>