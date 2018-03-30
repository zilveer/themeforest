<?php
/**
 * The template for displaying the footer.
 */
if(theme_get_option('footer','footer') || theme_get_option('footer','sub_footer')):
	wp_reset_query();
	$the_post_id = theme_get_queried_object_id();
	if(is_front_page()){
		global $home_page_id;
		$the_post_id = $home_page_id;
	}
	$footer_color = get_post_meta($the_post_id, '_footer_background_color', true);

	if(!empty($footer_color)){
		$background = theme_get_option('background');
		$remove_bg='';
		if(!empty($background['footer_image'])){
		 $remove_bg='background-image:none;';
		}
		$footer_color = ' style="'.$remove_bg. 'background-color:'.$footer_color.'"';
	}else{
		$footer_color = '';
	}
	if ($the_post_id > 0) {
		$subfooter_enabled = theme_get_inherit_option($the_post_id, '_subfooter', 'footer', 'sub_footer');
	} else {
		$subfooter_enabled = theme_get_option('footer','sub_footer');
	}
?>
<footer id="footer"<?php echo $footer_color;?>>
<?php if($subfooter_enabled):?>
	<div id="footer_bottom">
		<div class="inner">
			<div id="copyright"><?php echo wpml_t(THEME_NAME, 'Copyright Footer Text',stripslashes(theme_get_option('footer','copyright')))?></div>
			<div class="clearboth"></div>
		</div>
	</div>
<?php endif;?>
</footer>
<?php
endif;
	wp_footer();
?>
</div>
<?php
	theme_add_cufon_code_footer();
	if(theme_get_option('general','analytics_position')=='bottom'){
		echo theme_google_analytics_code();
	}
	if(theme_get_option('general','custom_js')){
		echo stripslashes(theme_get_option('general','custom_js'));
	}
?>
</body>
</html>