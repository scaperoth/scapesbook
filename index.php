<?php include_once('includes/header.php'); ?>
           
            <div class="twelve main">
                <div class="first content">
                    <div class="center">
                    
                    <?php echo ($welcome_message?$welcome_message:'');?>

                    <?php echo $top_area;?>
                    </div><!--end center-->
                </div><!--end first-content-->
                
                <div class="homeposts" id="post-section">
                    <div class="center">
                        <div class="list">
                            
                        <?php echo (($middle_area)?$middle_area:"<p>No Posts Available</p>");?>

                        </div><!--end list-->
                    </div><!--end center-->
                </div><!--end homeposts-->
            </div><!--end left nine main-->
            
            <div class="right-area">
                <div id="friend-list">
                    <?php 
                        echo $right_area;
                    ?>
                </div>
            </div>
           
<?php include_once('includes/footer.php'); ?>    

