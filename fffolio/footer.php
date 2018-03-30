<div class="jagged_top_color"></div>
  
  <div class="copyright">
    <p>
        &copy; <?php echo date("Y") . ' '; bloginfo('name'); echo '. '; _e('All rights reserved.', 'fffolio');?><br />
        <?php _e('Developed by ', 'fffolio');?> <a href="http://teothemes.com">TeoThemes</a>
    </p>
  </div>            
          
  
  <!-- fancybox -->
  <script type="text/javascript">
    jQuery(document).ready(function() {

      jQuery(".nav_bg").sticky({topSpacing:80});
      
      jQuery('#carousel').elastislide({
        imageW  : 180
      });

      jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            social_tools: false,
            theme: 'light_square'
          });

      jQuery('.flexslider').flexslider({
            animation: "slide",
            slideshow: true,
            slideshowSpeed: 3500,
            animationSpeed: 1000
          });
  
    });
  </script>


<?php global $scrn;
if(isset($scrn['integration_footer'])) echo $scrn['integration_footer'] . PHP_EOL; ?>

 <?php wp_footer(); ?>

 <!-- End Document
================================================== -->
</body>
</html>
 