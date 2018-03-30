<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - IE STYLES

	2 - IE SCRIPTS

*/

/*===============================================

	I E   S T Y L E S
	Styles for IE

===============================================*/

	function st_ie() {

		global
			$is_IE;

			if ( $is_IE ) {

				$chrome = 'http://www.google.com/chrome';
				$firefox = 'http://firefox.com';
				$ie = 'http://www.browserforthebetter.com/download.html';
				$safari = 'http://www.apple.com/safari/download/';

				echo '
					<!--[if lt IE 8]><link href="' . get_template_directory_uri() . '/assets/css/ie7.css" rel="stylesheet" type="text/css"><![endif]-->
					<!--[if IE 8]><link href="' . get_template_directory_uri() . '/assets/css/ie8.css" rel="stylesheet" type="text/css"><![endif]-->
					<!--[if IE 8]><div id="ie-version" class="ie-version-8"></div><![endif]-->
					<!--[if IE 9]><div id="ie-version" class="ie-version-9"></div><![endif]-->
	
					<div id="ie7" style="display: none;">
						<h3>' . __( "Sorry, you're not able to browse this website.", 'strictthemes' ) . '</h3>
						<p>' . __('Because you are using an outdated version of MS Internet Explorer. <br/> For a better experience using websites, please upgrade to a modern web browser.', 'strictthemes') . '</p>
						<a href="' . $chrome . '" title="Google Chrome"><img src="' . get_template_directory_uri() . '/assets/images/logo_ch.gif" alt="Google Chrome"/></a>
						<a href="' . $firefox . '" title="Mozilla Firefox"><img src="' . get_template_directory_uri() . '/assets/images/logo_ff.gif" alt="Mozilla Firefox"/></a>
						<a href="' . $ie . '" title="Microsoft Internet Explorer"><img src="' . get_template_directory_uri() . '/assets/images/logo_ie.gif" alt="Microsoft Internet Explorer"/></a>
						<a href="' . $safari . '" title="Apple Safari"><img src="' . get_template_directory_uri() . '/assets/images/logo_sf.gif" alt="Apple Safari"/></a>
					</div>
				';
	
			}

	}

	add_filter( 'wp_footer', 'st_ie' );



/*===============================================

	I E   S C R I P T S
	Scripts for IE

===============================================*/

	if ( !is_admin() ) {

		function st_theme_scripts_ie() {

			global
				$st_Options;

				if ( $st_Options['js']['ie'] ) {
					wp_enqueue_script( 'st-jquery-ie', get_template_directory_uri() . '/framework/assets/js/jquery.ie.js', array('jquery'), null, true ); }

		}
	
		add_action( 'wp_enqueue_scripts', 'st_theme_scripts_ie' );

	}



?>