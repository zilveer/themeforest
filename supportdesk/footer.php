<!-- #footer-bottom -->
<footer id="footer" class="clearfix">

<?php if ( ( is_active_sidebar( 'st_sidebar_footer' ) ) && ( get_theme_mod( 'st_style_footerwidgets' ) != 'off' )) { ?>

<div id="footer-widgets" class="clearfix">
    <div class="ht-container">
        <div class="row">
        	<?php dynamic_sidebar( 'st_sidebar_footer' ); ?>
        </div>
    </div>
</div>

<?php } ?>

<div id="footer-bottom" class="clearfix">
<div class="ht-container">
  <?php if (get_theme_mod( 'st_copyright' )) { ?>
  <small id="copyright" role="contentinfo"><?php echo get_theme_mod( 'st_copyright' ); ?></small>
  <?php } ?>


  <?php if ( has_nav_menu( 'footer-nav' ) ) { /* if menu location 'footer-nav' exists then use custom menu */ ?>
  <nav id="footer-nav" role="navigation">
    <?php wp_nav_menu( array('theme_location' => 'footer-nav', 'depth' => 1, 'container' => false, 'menu_class' => 'nav-footer clearfix' )); ?>
  </nav>
  <?php } ?>
</div>
</div>

</footer> 
<!-- /#footer-bottom -->


<?php wp_footer(); ?>
</body>
</html>