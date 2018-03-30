<?php
define('MTHEME_JS', get_template_directory_uri() . '/js' );
function mtheme_JS_scripts() {
	if(!is_admin()){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jqueryUI', MTHEME_JS . '/jquery.tools.min.js', array('jquery') ,null, false );
		wp_enqueue_script( 'hoverIntent', MTHEME_JS . '/menu/hoverIntent.js', array( 'jquery' ),null, false );
		wp_enqueue_script( 'superfish', MTHEME_JS . '/menu/superfish.js', array( 'jquery' ),null, false );
		if ( of_get_option( 'cufon_status') )  {
			wp_enqueue_script( 'cufon', MTHEME_JS . '/cufon-yui.js', array( 'jquery' ),null, false );
			wp_enqueue_script( 'fontconfig', MTHEME_JS . '/fontconfig.js', array( 'cufon' ),null, false );
		}
		wp_enqueue_script( 'prettyPhoto', MTHEME_JS . '/jquery.prettyPhoto.js', array( 'jquery' ),null, false );
		wp_enqueue_script( 'twitter', MTHEME_JS . '/jquery.tweet.js', array( 'jquery' ),null, false );
		wp_enqueue_script( 'qTips', MTHEME_JS . '/jquery.tipsy.js', array( 'jquery' ),null, false );
		wp_enqueue_script( 'tinycarousel', MTHEME_JS . '/jquery.tinycarousel.min.js', array('jquery'),null, false );
		wp_enqueue_script( 'jquerycolor', MTHEME_JS . '/jquery.color.js', array( 'jquery' ),null, false );
		wp_enqueue_script( 'galleria', MTHEME_JS . '/galleria/galleria-1.2.3.min.js', array( 'jquery' ),null, false );
		wp_enqueue_script( 'nivo-js', MTHEME_JS . '/nivo/jquery.nivo.slider.pack.js', array('jquery'),null, false );	
		wp_enqueue_script( 'preloader', MTHEME_JS . '/preloader.js', array('jquery'),null, false );
		wp_enqueue_script( 'custom', MTHEME_JS . '/common.js', array( 'jquery' ),null, false );
	}
}     
add_action('init', 'mtheme_JS_scripts');
?>
<?php
define('MTHEME_ROOT', get_template_directory_uri());
define('MTHEME_CSS', get_template_directory_uri() . '/css' );
function mtheme_CSS_styles() {
	if(!is_admin()){
		wp_enqueue_style( 'MainStyle', MTHEME_ROOT . '/style.css',false, 'screen' );
		wp_enqueue_style( 'css_awshowcase', MTHEME_ROOT . '/css/awshowcase.css', array( 'MainStyle' ), false, 'screen' );
		wp_enqueue_style( 'qTips', MTHEME_CSS . '/tipsy.css', array( 'MainStyle' ), false, 'screen' );
		wp_enqueue_style( 'PrettyPhoto', MTHEME_CSS . '/prettyPhoto.css', array( 'MainStyle' ), false, 'screen' );
		wp_enqueue_style( 'SuperFish', MTHEME_CSS . '/menu/superfish.css', array( 'MainStyle' ), false, 'screen' );
		wp_enqueue_style( 'PageNavi', MTHEME_CSS . '/pagenavi.css', array( 'MainStyle' ), false, 'screen');
		wp_enqueue_style( 'css_nivo', MTHEME_CSS . '/nivo/nivo-text-slider.css', array( 'MainStyle' ), false, 'screen' );
		if ( of_get_option( 'theme_style') == "dark" ) {
			wp_enqueue_style( 'DarkStyle', MTHEME_ROOT . '/style_dark.css', array( 'MainStyle' ), false, 'screen' );
		}
	}
}     
add_action('init', 'mtheme_CSS_styles');
?>