            </div><!--end limiter-->
        </div><!--end inside-->
    </div><!--end container-->        
         <?php echo $scripts;?>
        <!---------------------------------------------------------------------------------------|
            autocomplte js from http://bassistance.de/jquery-plugins/jquery-plugin-autocomplete 
            used for user search box. uses ajax list to alter input to act like dropdown and return
            search results
        ------------------------------------------------------------------------------------------>
        <script type='text/javascript' src='js/autocomplete/jquery.autocomplete.js'></script>

        <!---------------------------------------------------------------------------------------|
            Custom scrollbar from http://manos.malihu.gr/jquery-custom-content-scroller/
            adds custom scrollbar to any overflow element. refer to script.js for example
        ------------------------------------------------------------------------------------------>
        <script type='text/javascript' src='js/scrollbar/jquery.mCustomScrollbar.concat.min.js'></script>
        <script src="js/script.js"></script>
        <script>
            <?php unset($_SESSION['Welcome_message']);?>
        </script>
    </body>
</html>
