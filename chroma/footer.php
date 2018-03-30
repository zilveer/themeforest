<?php
  $footer_size    = get_post_meta(get_queried_object_id(), "footer_size", true);
  if(!isset($footer_size) || empty($footer_size)) {
    $footer_size = "full";
  }
  $footer_columns = get_post_meta(get_queried_object_id(), "footer_columns", true);
  if(!isset($footer_columns) || empty($footer_columns)) {
    $footer_columns = 4;
  }
?>
    <footer class="<?php if(get_theme_mod("t2t_customizer_footer_background_repeat") == "stretch") { echo "backstretch"; } ?>" data-background-image="<?php echo get_theme_mod("t2t_customizer_footer_background"); ?>">

      <?php if(!get_theme_mod("t2t_footer_visible")) { ?>
      <div class="container toggle">
        <a href="javascript:;"><span class="fontawesome-double-angle-down"></span></a>
      </div>
      <?php } ?>

      <div id="footer-sidebar" class="<?php if(get_theme_mod("t2t_footer_visible")) { echo "visible"; } ?>">
        <div class="container">

          <?php for($i = 1; $i <= $footer_columns; $i++) : ?>
          <?php
          // initialize classes value
          $classes = "one_fourth";

          if($i == $footer_columns) {
            $classes .= " column_last";
          }
          ?>
          <div id="footer-sidebar-<?php echo $i; ?>" class="<?php echo $classes; ?>">
            <?php if(is_active_sidebar("footer-widget-" . $i)) : ?>
            <?php dynamic_sidebar("footer-widget-" . $i); ?>
            <?php endif; ?>
          </div>
          <?php endfor; ?>

        </div>
      </div>
      
    </footer>
    
  </div>
  <!-- End Page Wrap -->

  <div class="loading_overlay"></div>
  
  <!-- Start Wordpress Footer Hook -->
  <?php wp_footer(); ?>
  <!-- End Wordpress Footer Hook -->
</body>
</html>