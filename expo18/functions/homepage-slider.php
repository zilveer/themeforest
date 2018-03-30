<?php
function om_homepage_slider_init() {
	
	$autoslide=intval(get_option(OM_THEME_PREFIX . 'homepage_slider_autoslide'));
	$speed=intval(get_option(OM_THEME_PREFIX . 'homepage_slider_animation_speed'));
	$effect=get_option(OM_THEME_PREFIX . 'homepage_slider_animation_effect');
	if(!$effect)
		$effect='custom';
	
	echo '
	<script>
		jQuery(function(){
			slider_init('.$autoslide.', '.$speed.', "'.$effect.'");
		});
	</script>
	';
	
	/* main page slider initialization
	 * first parameter: timeout for autoslide in milliseconds, set 0 to disable autoslide
	 * second parameter: speed of transition in milliseconds
	 * third parameter: animation type, "custom" - for custom animation or any of availiable from http://malsup.com/jquery/cycle/browser.html
	 */
}

add_action('wp_head','om_homepage_slider_init');