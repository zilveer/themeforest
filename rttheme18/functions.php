<?php
#-----------------------------------------
#	RT-Theme functions.php
#	version: 1.0
#-----------------------------------------

# Check WP Version
function rt_check_WP_version(){
global $wp_version, $load_msg;
	if (version_compare($wp_version,"4.2","<"))
	{
		$load_msg = '<div id="notice" class="error"><p><strong><h3>WORDPRESS VERSION ERROR!</h3>This theme requires WordPress Version 3.8 or higher to run. Please upgrade your WordPress version!</strong> <br /><br />>> <a href="http://codex.wordpress.org/Upgrading_WordPress">How can I upgrade my WordPress version?</a><br /><br /></div>';
	}else{
		$load_msg = ""; 
	}
	
	return $load_msg;
}
 

# Check PHP Version
if (version_compare(PHP_VERSION, '5.2.4', '<')) {
global $load_msg;

	$PHP_version_error = '<div id="notice" class="error"><p><strong><h3>THEME ERROR!</h3>This theme requires PHP Version 5.2.4 or higher to run. Please upgrade your php version!</strong> <br />You can contact your hosting provider to upgrade PHP version of your website.</p> </div>';
	if(is_admin()){	
		add_action('admin_notices','errorfunction');
	}else{
		echo $PHP_version_error;
		die;
	}
	
	function errorfunction(){
		global $PHP_version_error;
		echo $PHP_version_error;
	}
	
	return $load_msg;
}

# Define Content Width
if ( ! isset( $content_width ) ){
	$content_width = 1060;	
}

# Define RevSlider As Theme
define( 'REV_SLIDER_AS_THEME', true);

#
#  Load the theme
# 
if ( ! function_exists("load_rttheme") ){
	function load_rttheme(){
		if(rt_check_WP_version()){
			if(is_admin()){
				add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $load_msg, '"' ) . '";' ) );
			}
			else{
				exit($load_msg);
			} 
		}else{
			require_once ( get_template_directory() . '/rt-framework/classes/loading.php' );
			$rttheme = new RTTheme();

			/*
			* 	 DO NOT CHANGE slug => "" !!! 
			*/
			$rttheme->start(array('theme' => 'RT-THEME 18','slug' => 'rttheme18','version' => '1.0'));
		}	
	}
}
load_rttheme();
?>