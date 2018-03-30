<?php
/* ---------------------------------------------------------------------------
 * Loading Theme Scripts
 * --------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'veda_enqueue_scripts');
function veda_enqueue_scripts() {

	$library_uri = VEDA_THEME_URI.'/functions';

	// ie scripts ----------------------------------------------------------------
	wp_enqueue_script('jq-html5', 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js', array(), '3.7.2', true);
	wp_script_add_data('jq-html5', 'conditional', 'lt IE 9');

	wp_enqueue_script('jq-canvas', 'https://cdn.jsdelivr.net/excanvas/r3/excanvas.js', array(), '2.0', true);	
	wp_script_add_data('jq-canvas', 'conditional', 'lt IE 8');


	// comment reply script ------------------------------------------------------
	if (is_singular() AND comments_open()):
		 wp_enqueue_script( 'comment-reply' );
	endif;

	// scipts variable -----------------------------------------------------------
	$stickynav = ( veda_option("layout","layout-stickynav") ) ? "enable" : "disable";
	$loadingbar = ( veda_option("general","enable-loader") ) ? "enable" : "disable";
	$nicescroll = ( veda_option("general","enable-nicescroll") ) ? "enable" : "disable";
	if(is_rtl()) $rtl = true; else $rtl = false;

	$htype = veda_option('layout','header-type');
	$stickyele = "";
	switch( $htype ){
		case 'fullwidth-header':
		case 'boxed-header':
		case 'split-header fullwidth-header':
		case 'split-header boxed-header':
		case 'two-color-header':
			$stickyele = ".main-header-wrapper";
		break;
			
		case 'fullwidth-header header-align-center fullwidth-menu-header':
		case 'fullwidth-header header-align-left fullwidth-menu-header':
			$stickyele = ".menu-wrapper";
		break;

		case 'left-header':
		case 'left-header-boxed':
		case 'creative-header':
		case 'overlay-header':
			$stickyele = ".menu-wrapper";
			$stickynav = "disable";
		break;
	}

	wp_enqueue_script('jq.easetotop', $library_uri.'/js/jquery.ui.totop.min.js', array(), false, true);
	wp_enqueue_script('jq.plugins', $library_uri.'/js/jquery.plugins.js', array(), false, true);
	wp_enqueue_script('jq.visualnav', $library_uri.'/js/jquery.visualNav.min.js', array(), false, true);

	$picker = veda_option('general', 'enable-stylepicker');
	if( isset($picker) ) {
		wp_enqueue_script('jq.cookie', $library_uri.'/js/jquery.cookie.min.js',array(),false,true);
		wp_enqueue_script('jq.cpanel', $library_uri.'/js/controlpanel.js',array(),false,true);
	}
	
	if( $loadingbar == 'enable' ) {
		wp_enqueue_script('jq.pacemin', $library_uri.'/js/pace.min.js',array(),false,true);
		wp_localize_script('jq.pacemin', 'paceOptions', array(
			'restartOnRequestAfter' => 'false',
			'restartOnPushState' => 'false'
		));
	}

	wp_enqueue_script('jq.custom', $library_uri.'/js/custom.js', array(), false, true);

	wp_localize_script('jq.custom', 'dttheme_urls', array(
		'theme_base_url' => esc_js(VEDA_THEME_URI),
		'framework_base_url' => esc_js(VEDA_THEME_URI).'/framework/',
		'ajaxurl' => admin_url('admin-ajax.php'),
		'url' => get_site_url(),
		'stickynav' => esc_js($stickynav),
		'stickyele' => esc_js($stickyele),
		'isRTL' => esc_js($rtl),
		'loadingbar' => esc_js($loadingbar),
		'nicescroll' => esc_js($nicescroll)
	));	
}

/* ---------------------------------------------------------------------------
 * Meta tag for viewport scale
* --------------------------------------------------------------------------- */
function veda_viewport() {
	if(veda_option('general', 'enable-responsive')){
		echo "<meta name='viewport' content='width=device-width, initial-scale=1'>\r";
	}
}

/* ---------------------------------------------------------------------------
 * Scripts of Custom JS from Theme Back-End
* --------------------------------------------------------------------------- */
function veda_scripts_custom() {
	if( ($custom_js = veda_option('layout', 'customjs-content')) && veda_option('layout','enable-customjs') ){
		wp_add_inline_script('jq.custom', veda_wp_kses(stripslashes($custom_js)) ,'after');
	}
}
add_action('wp_enqueue_scripts', 'veda_scripts_custom', 100);

/* ---------------------------------------------------------------------------
 * Loading Theme Styles
 * --------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'veda_enqueue_styles', 100 );
function veda_enqueue_styles() {

	$layout_opts = veda_option('layout');
	$general_opts = veda_option('general');
	$colors_opts = veda_option('colors');
	$pageopt_opts = veda_option('pageoptions');

	// site icons ---------------------------------------------------------------
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ):
		$url = ! empty ( $layout_opts ['favicon-url'] ) ? $layout_opts ['favicon-url'] : VEDA_THEME_URI . "/images/favicon.ico";
		echo "<link href='$url' rel='shortcut icon' type='image/x-icon' />\n";
	
		$phone_url = ! empty ( $layout_opts ['apple-favicon'] ) ? $layout_opts ['apple-favicon'] : VEDA_THEME_URI . "/images/apple-touch-icon.png";
		echo "<link href='$phone_url' rel='apple-touch-icon-precomposed'/>\n";
	
		$phone_retina_url = ! empty ( $layout_opts ['apple-retina-favicon'] ) ? $layout_opts ['apple-retina-favicon'] : VEDA_THEME_URI. "/images/apple-touch-icon-114x114.png";
		echo "<link href='$phone_retina_url' sizes='114x114' rel='apple-touch-icon-precomposed'/>\n";
	
		$ipad_url = ! empty ( $layout_opts ['apple-ipad-favicon'] ) ? $layout_opts ['apple-ipad-favicon'] : VEDA_THEME_URI . "/images/apple-touch-icon-72x72.png";
		echo "<link href='$ipad_url' sizes='72x72' rel='apple-touch-icon-precomposed'/>\n";
	
		$ipad_retina_url = ! empty ( $layout_opts ['apple-ipad-retina-favicon'] ) ? $layout_opts ['apple-ipad-retina-favicon'] : VEDA_THEME_URI . "/images/apple-touch-icon-144x144.png";
		echo "<link href='$ipad_retina_url' sizes='144x144' rel='apple-touch-icon-precomposed'/>\n";
	endif;

	// wp_enqueue_style ---------------------------------------------------------------
	wp_enqueue_style( 'veda',				get_stylesheet_uri(), false, THEME_VERSION, 'all' );
	wp_enqueue_style( 'prettyphoto',	VEDA_THEME_URI .'/css/prettyPhoto.css', false, THEME_VERSION, 'all' );
	wp_enqueue_style( 'fancybox',		VEDA_THEME_URI .'/css/jquery.fancybox.css', false, THEME_VERSION, 'all' );
	
	if (function_exists('bp_add_cover_image_inline_css')) {
		$inline_css = bp_add_cover_image_inline_css( true );
		wp_add_inline_style( 'bp-parent-css', strip_tags( $inline_css['css_rules'] ) );
	}
	
	// icon fonts ---------------------------------------------------------------------
	wp_enqueue_style ( 'custom-font-awesome',	VEDA_THEME_URI . '/css/font-awesome.min.css', array (), '4.3.0' );
	wp_enqueue_style ( 'pe-icon-7-stroke',		VEDA_THEME_URI . '/css/pe-icon-7-stroke.css', array () );
	wp_enqueue_style ( 'stroke-gap-icons-style',VEDA_THEME_URI . '/css/stroke-gap-icons-style.css', array () );

	// comingsoon css
	if(isset($pageopt_opts['enable-comingsoon']))
		wp_enqueue_style("comingsoon",  	VEDA_THEME_URI . "/css/comingsoon.css", false, THEME_VERSION, 'all' );

	// notfound css
	if ( is_404() )
		wp_enqueue_style("notfound",	  	VEDA_THEME_URI . "/css/notfound.css", false, THEME_VERSION, 'all' );

	// loader css
	if(isset($general_opts['enable-loader']))
		wp_enqueue_style("loader",	  		VEDA_THEME_URI . "/css/loaders.css", false, THEME_VERSION, 'all' );

	// show mobile slider
    if(empty($general_opts['show-mobileslider'])):
		$out =	'@media only screen and (max-width:320px), (max-width: 479px), (min-width: 480px) and (max-width: 767px), (min-width: 768px) and (max-width: 959px),
		 (max-width:1200px) { #slider { display:none !important; } }';
		wp_add_inline_style('veda', $out);		 
	endif;

	// woocommerce css
	if( function_exists( 'is_woocommerce' ) )
		wp_enqueue_style( 'woo-style', 		VEDA_THEME_URI .'/css/woocommerce.css', 'woocommerce-general-css', THEME_VERSION, 'all' );


	// static css
	if(isset($general_opts['enable-staticcss'])) :
		wp_enqueue_style("static",  		VEDA_THEME_URI . "/style-static.css", false, THEME_VERSION, 'all' );

	// skin css
	else :
		$skin	  = $colors_opts['theme-skin'];
		if($skin != 'custom')	wp_enqueue_style("skin", 	VEDA_THEME_URI ."/css/skins/$skin/style.css");
	endif;

	// tribe-events -------------------------------------------------------------------
	wp_enqueue_style( 'custom-event', 		VEDA_THEME_URI .'/tribe-events/custom.css', false, THEME_VERSION, 'all' );

	// responsive ---------------------------------------------------------------------
	if(veda_option('general', 'enable-responsive'))
		wp_enqueue_style("responsive",  	VEDA_THEME_URI . "/css/responsive.css", false, THEME_VERSION, 'all' );

	// google fonts -----------------------------------------------------------------
	$google_fonts = veda_fonts();
	$google_fonts = $google_fonts['all'];

	$subset 	  = veda_option('fonts','font-subset');
	if( $subset ) $subset = str_replace(' ', '', $subset);

	// style & weight  --------------------------------------------------------------
	if( $weight = veda_option('fonts', 'font-style') )
		$weight = ':'. implode( ',', $weight );

	$fonts = veda_fonts_selected();
	$fonts = array_unique($fonts);
	$fonts_url = ''; $font_families = array();
	foreach( $fonts as $font ){
		if( in_array( $font, $google_fonts ) ){
			// if google fonts
			$font_families[] .= $font . $weight;
		}
	}
	$query_args = array( 'family' => urlencode( implode( '|', $font_families ) ), 'subset' => urlencode( $subset ) );
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	wp_enqueue_style( 'veda-fonts', 		esc_url_raw($fonts_url), false, THEME_VERSION );
	wp_add_inline_style('veda-fonts', veda_styles_custom_font() );

	// custom css ---------------------------------------------------------------------
	wp_enqueue_style( 'dt-custom', 			VEDA_THEME_URI .'/css/custom.css', false, THEME_VERSION, 'all' );

	// jquery scripts --------------------------------------------
	wp_enqueue_script('modernizr-custom', 	VEDA_THEME_URI . '/functions/js/modernizr.custom.js', array('jquery'));
	wp_enqueue_script('jquery');

	// rtl ----------------------------------------------------------------------------
	if(is_rtl()) wp_enqueue_style('rtl', 	VEDA_THEME_URI . '/css/rtl.css', false, THEME_VERSION, 'all' );
}

/* ---------------------------------------------------------------------------
 * Styles Minify
 * --------------------------------------------------------------------------- */
function veda_styles_minify( $css ){

	// remove comments
	$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );	

	// remove whitespace
	$css = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css );

	return $css;
}

/* ---------------------------------------------------------------------------
 * Styles Dynamic
 * --------------------------------------------------------------------------- */
function veda_styles_dynamic() {

	ob_start();

	if( ! veda_opts_get( 'enable-staticcss' ) ){
		// custom colors.php
		$colors_opts = veda_option('colors');
		$skin	  = $colors_opts['theme-skin'];
		if($skin == 'custom'):
			include_once VEDA_THEME_DIR . '/css/style-custom-color.php';
		endif;
		
		// default colors.php
		include_once VEDA_THEME_DIR . '/css/style-default-color.php';

		// fonts.php
		include_once VEDA_THEME_DIR . '/css/style-fonts.php';			
	}

	// custom optons css.php			
	if( ($custom_css = veda_option('layout','customcss-content')) &&  veda_option('layout','enable-customcss')):
		include_once VEDA_THEME_DIR . '/css/dt-theme-option-custom-css.php';
	endif;

	$css = ob_get_contents();

	ob_get_clean();

	$css = veda_styles_minify( $css );

	wp_register_style( 'veda-combined', '' );
	wp_enqueue_style( 'veda-combined' );

	wp_add_inline_style('veda-combined', $css);	
}
add_action( 'wp_head', 'veda_styles_dynamic' );

/* ---------------------------------------------------------------------------
 * Styles of Custom Font
 * --------------------------------------------------------------------------- */
function veda_styles_custom_font() {	
	$fonts 		  = veda_fonts_selected();
	$font_custom  = veda_option('fonts','customfont-name');
	$font_custom2 = veda_option('fonts','customfont2-name');

	$out = '';

	if( $font_custom && in_array( $font_custom, $fonts ) ){
		$out .= '@font-face {';
			$out .= 'font-family: "'. $font_custom .'";';
			$out .= 'src: url("'. veda_option('fonts','customfont-eot') .'");';
			$out .= 'src: url("'. veda_option('fonts','customfont-eot') .'#iefix") format("embedded-opentype"),';
				$out .= 'url("'. veda_option('fonts','customfont-woff') .'") format("woff"),';
				$out .= 'url("'. veda_option('fonts','customfont-ttf') .'") format("truetype"),';
				$out .= 'url("'. veda_option('fonts','customfont-svg') . $font_custom .'") format("svg");';
			$out .= 'font-weight: normal;';
			$out .= 'font-style: normal;';
		$out .= '}';
	}
	
	if( $font_custom2 && in_array( $font_custom2, $fonts ) ){
		$out .= '@font-face {';
			$out .= 'font-family: "'. $font_custom2 .'";';
			$out .= 'src: url("'. veda_option('fonts','customfont2-eot') .'");';
			$out .= 'src: url("'. veda_option('fonts','customfont2-eot') .'#iefix") format("embedded-opentype"),';
				$out .= 'url("'. veda_option('fonts','customfont2-woff') .'") format("woff"),';
				$out .= 'url("'. veda_option('fonts','customfont2-ttf') .'") format("truetype"),';
				$out .= 'url("'. veda_option('fonts','customfont2-svg') . $font_custom2 .'") format("svg");';
			$out .= 'font-weight: normal;';
			$out .= 'font-style: normal;';
		$out .= '}';
	}

	return $out;
}

/* ---------------------------------------------------------------------------
 * Fonts Selected in Theme Options Panel
 * --------------------------------------------------------------------------- */
function veda_fonts_selected(){
	$fonts = array();
	
	$font_opts = veda_option('fonts');
	
	$fonts['content'] 		= !empty ( $font_opts['content-font'] ) 	? 	$font_opts['content-font'] 		: 'Oswald';
	$fonts['menu'] 			= !empty ( $font_opts['menu-font'] ) 		? 	$font_opts['menu-font'] 		: 'Oswald';
	$fonts['title'] 		= !empty ( $font_opts['pagetitle-font'] ) 	? 	$font_opts['pagetitle-font'] 	: 'Oswald';
	$fonts['h1'] 		= !empty ( $font_opts['h1-font'] ) 	? 	$font_opts['h1-font'] 		: 'Oswald';
	$fonts['h2'] 		= !empty ( $font_opts['h2-font'] ) 	? 	$font_opts['h2-font'] 		: 'Oswald';
	$fonts['h3'] 		= !empty ( $font_opts['h3-font'] ) 	? 	$font_opts['h3-font'] 		: 'Oswald';
	$fonts['h4'] 		= !empty ( $font_opts['h4-font'] ) 	? 	$font_opts['h4-font'] 		: 'Oswald';
	$fonts['h5'] 		= !empty ( $font_opts['h5-font'] ) 	? 	$font_opts['h5-font'] 		: 'Oswald';
	$fonts['h6'] 		= !empty ( $font_opts['h6-font'] ) 	? 	$font_opts['h6-font'] 		: 'Oswald';

	return $fonts;
}

/* ---------------------------------------------------------------------------
 * Site SSL Compatibility
 * --------------------------------------------------------------------------- */
function veda_ssl( $echo = false ){
	$ssl = '';
	if( is_ssl() ) $ssl = 's';
	if( $echo ){
		echo $ssl;
	}
	return $ssl;
}

/* ---------------------------------------------------------------------------
 * Layout Selected in Theme Options Panel
 * --------------------------------------------------------------------------- */
add_action('wp_head', 'veda_appearance_css', 90);
function veda_appearance_css() {
	$output = NULL;

	if (veda_option('layout', 'site-layout') == 'boxed') :

		if (veda_option('layout', 'bg-type') == 'bg-patterns') :
			$pattern 			= 	veda_option('layout', 'boxed-layout-pattern');
			$pattern_repeat 	= 	veda_option('layout', 'boxed-layout-pattern-repeat');
			$pattern_opacity 	= 	veda_option('layout', 'boxed-layout-pattern-opacity');
			$enable_color 		= 	veda_option('layout', 'show-boxed-layout-pattern-color');
			$pattern_color 		= 	veda_option('layout', 'boxed-layout-pattern-color');

			$output .= "body { ";

			if (!empty($pattern)) {
				$output .= "background-image:url('" . VEDA_THEME_URI . "/framework/theme-options/images/patterns/{$pattern}');";
			}

			$output .= "background-repeat:$pattern_repeat;";
			if ($enable_color) {
				if (!empty($pattern_opacity)) {
					$color = veda_hex2rgb($pattern_color);
					$output .= "background-color:rgba($color[0],$color[1],$color[2],$pattern_opacity); ";
				} else {
					$output .= "background-color:$pattern_color;";
				}
			}
			$output .= "}\r\t";

		elseif (veda_option('layout', 'bg-type') == 'bg-custom') :
			$bg 			= 	veda_option('layout', 'boxed-layout-bg');
			$bg_repeat 		= 	veda_option('layout', 'boxed-layout-bg-repeat');
			$bg_opacity 	= 	veda_option('layout', 'boxed-layout-bg-opacity');
			$bg_color 		= 	veda_option('layout', 'boxed-layout-bg-color');
			$enable_color 	= 	veda_option('layout', 'show-boxed-layout-bg-color');
			$bg_position 	= 	veda_option('layout', 'boxed-layout-bg-position');

			$output .= "body { ";

			if (!empty($bg)) {
				$output .= "background-image:url($bg);";
				$output .= "background-repeat:$bg_repeat;";
				$output .= "background-position:$bg_position;";
			}

			if ($enable_color) {
				if (!empty($bg_opacity)) {
					$color = veda_hex2rgb($bg_color);
					$output .= "background-color:rgba($color[0],$color[1],$color[2],$bg_opacity);";
				} else {
					$output .= "background-color:$bg_color;";
				}
			}
			$output .= "}\r\t";
		endif;

	endif;
	
	if (!empty($output)) :
		wp_register_style( 'veda-layout', '' );
		wp_enqueue_style( 'veda-layout' );
		wp_add_inline_style('veda-layout', $output);
	endif;
}

/* ---------------------------------------------------------------------------
 * Body Class Filter for layout changes
 * --------------------------------------------------------------------------- */
function veda_body_classes( $classes ) {

	// layout
	$classes[] 		= 	'layout-'. veda_option('layout','site-layout');

	// header
	$header_type 	= 	veda_option('layout','header-type');
	if( isset($header_type) && ($header_type == 'left-header-boxed') ):
		$classes[]	=	'left-header left-header-boxed';
	elseif( isset($header_type) && ($header_type == 'creative-header') ):
		$classes[]	=	'left-header left-header-creative';
	else:
		$classes[]	=	$header_type;
	endif;

	$htrans 		= 	veda_option('layout', 'header-transparant');
	if(isset($htrans)):
		$classes[]	=	veda_option('layout', 'header-transparant');
	endif;
	
	$stickyhead		=	veda_option('layout','layout-stickynav');
	if(isset($stickyhead)):
		$classes[]	=	'sticky-header';
	endif;

	$standard		=	veda_option('layout','header-position');
	if( isset($standard) && ($standard == 'above slider') ):
		$classes[]	=	'standard-header';
	elseif( isset($standard) && ($standard == 'below slider') ):
		$classes[]	=	'standard-header header-below-slider';
	elseif ( isset($standard) && ($standard == 'on slider') ):
		$classes[]	=	'header-on-slider';
	endif;

	$topbar			=	veda_option('layout','layout-topbar');
	if(isset($topbar)):
		$classes[]	=	'header-with-topbar';
	endif;

	$wootype		=	veda_option('woo','product-style');
	$wootype		= 	!empty($wootype) ? 'woo-'.$wootype : 'woo-type1';
	$classes[]		=	$wootype;

	if( is_page() ) {
		$pageid = veda_ID();
		if(($slider_key = get_post_meta( $pageid, '_tpl_default_settings', true )) && (array_key_exists( 'show_slider', $slider_key )) ) {
			$classes[] = "page-with-slider";
		}
	} elseif( is_home() ) {
		$pageid = get_option('page_for_posts');
		if(($slider_key = get_post_meta( $pageid, '_tpl_default_settings', true )) && (array_key_exists( 'show_slider', $slider_key )) ) {
			$classes[] = "page-with-slider";
		}
	}

	return $classes;
}
add_filter( 'body_class', 'veda_body_classes' );?>