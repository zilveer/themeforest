<?php
/**
 * 
 * The footer template
 *
 */
?>

    </section><!-- Content Close -->
    
    <!-- Footer Start -->
    <?php global $stylico_theme_options; ?>
	<footer id="main-footer"> 
        <section id="widget-footer" class="container_12">
             <a href="#" id="footer-go-top"></a> 
            <section class="grid_4 alpha"><?php dynamic_sidebar( 'footer-left' ); ?></section>
            <section id="widget-footer-center" class="grid_4"><?php dynamic_sidebar( 'footer-center' ); ?></section>
            <section class="grid_4 omega"><?php dynamic_sidebar( 'footer-right' ); ?></section>
        </section>
        <section id="footer-line"></section>
        <section id="bottom-footer" class="container_12">
            <span class="grid_4 alpha"><?php echo stripslashes( $stylico_theme_options['general']['footer_text'] ); ?></span>
            <nav id="footer-nav" class="grid_8 omega">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu' => '', 'container' => false, 'fallback_cb' => '', 'menu_class' => 'clearfix', 'depth' => 1) ); ?>     
            </nav>
        </section>
	</footer>

	<?php wp_footer(); ?>
    
    <!-- Include Google Analytics Tracking -->
	<script type="text/javascript">
    
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', '<?php echo $stylico_theme_options['general']['google_tracking_code']; ?>']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>

</body>
</html>