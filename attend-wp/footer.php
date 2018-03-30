<!-- Start of footer wrapper -->
<div id="footer_wrapper">

    <!-- Start of footer -->
    <footer>
        
        <!-- Start of bottom widgets -->
        <div class="bottom_widgets">
            
            <!-- Start of footer widgets -->
            <div class="footer_widgets">
                
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1') ) : else : ?>		
                <?php endif; ?>
                
            </div>
            <!-- End of footer widgets -->
            
            <!-- Start of footer widgets -->
            <div class="footer_widgets">
                
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2') ) : else : ?>		
                <?php endif; ?>
                
            </div>
            <!-- End of footer widgets -->
            
            <!-- Start of footer widgets -->
            <div class="footer_widgets">
                
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3') ) : else : ?>		
                <?php endif; ?>
                
            </div>
            <!-- End of footer widgets -->
            
            <!-- Start of footer widgets -->
            <div class="footer_widgets last">
                
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4') ) : else : ?>		
                <?php endif; ?>
                
            </div>
            <!-- End of footer widgets -->
            
        </div>
        <!-- End of bottom widgets -->

    </footer>
    <!-- End of footer -->

    <div class="clearfix"></div>

</div>
<!-- End of footer wrapper -->

<?php if ( get_theme_mod( 'cr3ativ_conference_analytics' ) ) : ?>
<?php $analytics = ( get_theme_mod( 'cr3ativ_conference_analytics' ) ); ?> 
<script><?php echo esc_html($analytics); ?></script>
<?php else : ?>
<?php endif; ?>


<script type="text/javascript">
    jQuery(document).ready(function() {
        
'use strict';
    jQuery('.nav2').navgoco();
    jQuery(".nav2 li").removeClass("open");
    jQuery(".nav2 ul").removeAttr("style") 
    
        
    });
</script>

<?php wp_footer(); ?>

</body>

</html>