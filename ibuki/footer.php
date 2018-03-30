<?php 
global $az_options_show_footer;
$options_ibuki = get_option('ibuki'); ?>
</div>
<!-- End Main -->

<?php if( !empty($options_ibuki['enable-back-to-top']) && $options_ibuki['enable-back-to-top'] == 1) { ?>
<!-- Back To Top -->
<a id="back-to-top" href="#">
    <i class="back-top-icon"></i>
</a>
<!-- End Back to Top -->
<?php } ?>

<?php if($az_options_show_footer) { /* Start $show_footer; */ ?>

<!-- Footer -->
<footer>
<?php if ( is_home() || is_search() || is_404() ) {
	// Blog Page and Search Page
	az_footer_widget(get_option('page_for_posts'));
}
else if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
	if(is_shop() || is_product_category() || is_product_tag()) {
		az_footer_widget(woocommerce_get_page_id('shop'));
	} else if ( is_product() ){
		az_footer_widget(get_the_ID());
	}
}
else if ( is_archive() ) {
	az_footer_widget(get_option('page_for_posts'));
}
else {
	// All Other Pages and Posts
	az_footer_widget(get_the_ID());
}
?>

<div class="footer-copyright">
<?php if(!empty($options_ibuki['footer-copyright-text'])) { ?> 	
<p class="copyright"><?php echo $options_ibuki['footer-copyright-text']; ?></p>
<?php } else { ?>
<p class="copyright">&copy; <?php _e('Copyright ', AZ_THEME_NAME); echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> / <?php _e('Powered by', AZ_THEME_NAME) ?> <a href="http://wordpress.org/" target="_blank">WordPress</a></p>
<?php } ?>
</div>

<!-- End Footer -->
</footer>

<?php } /* End $show_footer; */ ?>

</div>
<!-- End Wrap -->

<?php if(!empty($options_ibuki['tracking-code'])) echo $options_ibuki['tracking-code']; ?> 

<?php if( !empty($options_ibuki['enable-custom-js']) && $options_ibuki['enable-custom-js'] == 1 ) { echo '<script type="text/javascript">'.$options_ibuki['custom-js'].'</script>'; } ?> 

<?php wp_footer(); ?>	
</body>
</html>