<?php include_once('includes/header.php'); ?>
    <?php echo ($_SESSION['message'])?$_SESSION['message']:'';?>
    <?php unset($_SESSION['message']);?>

    <?php echo $profile_content; ?>

<?php include_once('includes/footer.php'); ?>    