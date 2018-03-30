<?php
/**
 * The template for displaying the footer
 *
 * @package Organique
 */
?>

<footer class="js--page-footer">
  <div class="footer-widgets">
    <div class="container">
      <div class="row">
        <?php dynamic_sidebar( 'footer-sidebar-top' ); ?>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-12  col-sm-6">
          <div class="footer__text--link">
            <?php echo get_theme_mod( 'footer_left', '&copy; Copyright 2015' ); ?>
          </div>
        </div>
        <div class="col-xs-12  col-sm-6">
          <div class="footer__text">
            <?php echo get_theme_mod( 'footer_right', 'Organique Theme by <a href="http://www.proteusthemes.com">ProteusThemes</a>' ); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<div class="search-mode__overlay"></div>

<?php echo ot_get_option('footer_scripts', ''); ?>

<?php wp_footer(); ?>
<!-- W3TC-include-js-body-end -->
</body>
</html>