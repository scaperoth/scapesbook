<?php include_once('includes/header.php'); ?>
<div class="frame three left">
    <div id="user-list">
        <?php echo (($users) ? $users : ''); ?>
    </div><!--end user-list-->
</div><!--end left frame-->
<div class="six messages-box right">
    <div class="message-container">
        <?php echo ((isset($user_messages)) ? $user_messages : ''); ?>

    </div>
    <div id="reply-container">

    </div>
</div><!--end messages-box-->
<?php include_once('includes/footer.php'); ?> 