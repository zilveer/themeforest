<?php

#-----------------------------------------------------------------
# Include Custom JavaScript in Theme Header
#-----------------------------------------------------------------


// Add scripts to header
//-----------------------------------------------------------------
function theme_options_custom_js() {
	// Custom Scripts from Theme Options
	echo '<script type="text/javascript">';
	theme_custom_scripts();
	echo '</script> ';
}
// Add hook for front-end <head></head>
add_action('wp_head', 'theme_options_custom_js', 102); // low priority to get it near the end


// Get custom JavaScript from theme options
//-----------------------------------------------------------------
if ( ! function_exists( 'theme_custom_scripts' ) ) :
function theme_custom_scripts() {

	$customJS   = stripslashes(htmlspecialchars_decode(get_options_data('options-page', 'custom-js'),ENT_QUOTES));
	$scrollDock = get_options_data('options-page', 'dock-on-scroll');
			
	// Custom JavaScript
	if (!empty($customJS)) {
		echo $customJS;
	}

	// Top banner dock
	if ($scrollDock == "true") {
		echo ';var dock_topBanner=true;';
	} else {
		echo ';var dock_topBanner=false;';
	}

}
endif; ?>