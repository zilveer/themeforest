<?php 
function multipurpose_ga() {
	$ga_script = get_theme_mod('ga_code') ? get_theme_mod('ga_code') : false;
	echo $ga_script;
}
add_action('wp_footer', 'multipurpose_ga');