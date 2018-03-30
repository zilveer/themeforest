 <!-- BEGIN #footer -->
<footer id="footer" class="wrapper">

    <!-- BEGIN #nav-footer -->
    <?php if ( has_nav_menu( 'footer-nav' ) ) { /* if menu location 'footer-nav' exists then use custom menu */ ?>
    <nav id="nav-footer">
      <?php wp_nav_menu( array('theme_location' => 'footer-nav', 'depth' => 1, 'container' => false, 'menu_class' => 'nav-footer' )); ?>
    </nav>
    <?php } ?>
    <!-- End #nav-footer -->
    <!-- BEGIN #copyright -->
    <?php if (of_get_option('footer_text')) : ?>
    <div id="copyright"><?php echo of_get_option('footer_text'); ?></div>
    <?php endif; ?>
    <!-- End #copyright -->
    <div class="clear"></div>
     <!-- End .wrapper -->
</footer>
<!-- END #footer-widgets -->
<!-- Footer Hook -->
<?php wp_footer(); ?>
<!--END body-->
</body>
<!--END html-->
</html>