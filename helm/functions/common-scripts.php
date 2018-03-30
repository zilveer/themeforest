<?php
define('MTHEME_JS', get_template_directory_uri() . '/js' );
function mtheme_JS_scripts() {
	if(!is_admin()){
		LoadCommonScripts();
	}
	
	// Get selected font
	
	function enqueueFont ( $sectionName ) {		
		$got_font=of_get_option($sectionName);
		
		if ($got_font) {
			$font_pieces = explode(":", $got_font);
			
			$font_name = $font_pieces[0];
			$font_name = str_replace (" ","+", $font_pieces[0] );
			
			$font_variants = $font_pieces[1];
			$font_variants = str_replace ("|",",", $font_pieces[1] );
			
			wp_enqueue_style( $sectionName, 'http://fonts.googleapis.com/css?family='.$font_name . ':' . $font_variants );
		}
		
	}
	enqueueFont ("heading_font");
	enqueueFont ("page_headings");
	enqueueFont ("menu_font");
		
}     
add_action('init', 'mtheme_JS_scripts');
?>
<?php
define('MTHEME_ROOT', get_template_directory_uri());
define('MTHEME_CSS', get_template_directory_uri() . '/css' );
define('MTHEME_STYLESHEET', get_stylesheet_directory_uri());
function mtheme_CSS_styles() {
	if(!is_admin()){
		LoadCommonStyles();
	}
}     
add_action('init', 'mtheme_CSS_styles');
?>