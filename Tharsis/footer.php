<div class="footer">
        <p>&copy; <?php echo the_time("Y");?> <?php bloginfo('name');?> <?php _e('All Rights Reserved', 'Tharsis');?>, 
            <?php _e('designed by', 'Tharsis');?> <a href="http://teothemes.com">TeoThemes</a>
        </p>
    </div>
<!-- JS
    ================================================== -->
  
  <!-- fancybox -->
  <script type="text/javascript">
    jQuery(document).ready(function() {

    jQuery("header").sticky({topSpacing:0});

    /* This is basic - uses default settings */
  
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            social_tools: false,
            theme: 'light_square'
          });

    jQuery('.proj-img').hover(function() {
        jQuery(this).find('i').stop().animate({
          opacity: 0.8
        }, 'fast');
        jQuery(this).find('a').stop().animate({
          "top": "0"
        });
      }, function() {
        jQuery(this).find('i').stop().animate({
          opacity: 0
        }, 'fast');
        jQuery(this).find('a').stop().animate({
          "top": "-600px"
        });
    });

    });
    
  </script>
    
    
<!-- End Document
================================================== -->

<?php global $tharsis;
if(isset($tharsis['integration_footer'])) echo $tharsis['integration_footer'] . PHP_EOL; ?>

 <?php wp_footer(); ?>
 
</body>
</html>