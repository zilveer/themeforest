<?php

if ( !function_exists( 'optionsframework_init' ) ) :

/*-----------------------------------------------------------------------------------*/
/* Options Framework Theme
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

if ( get_stylesheet_directory() == get_template_directory() ) {
	define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
} else {
	define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
}

require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

endif;

/**
 * Add custom scripts to options panel
 */
if ( !function_exists( 'optionsframework_custom_scripts' ) ) :
	function optionsframework_custom_scripts() { ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery('#example_showhidden').click(function() {
	  		jQuery('.section.hidden').fadeToggle(400);
		});

		if (jQuery('#example_showhidden:checked').val() !== undefined) {
			jQuery('.section.hidden').show();
		}

	});
	</script> <?php
	}
	add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
endif;

/*-----------------------------------------------------------------------------------*/
/* Add Theme Shortcodes
/*-----------------------------------------------------------------------------------*/
include("functions/shortcodes.php");

/*-----------------------------------------------------------------------------------*/
/* Disable Admin Bar
/*-----------------------------------------------------------------------------------*/
add_filter('show_admin_bar', '__return_false');

/*-----------------------------------------------------------------------------------*/
/* Add Multiple Thumbnail Support
/*-----------------------------------------------------------------------------------*/
include("multi-post-thumbnails.php");

/*-----------------------------------------------------------------------------------*/
/* Register Widget Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name'          => 'Blog Sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pagebg contentwrap widgetinner">',
		'after_widget'  => '</div><div class="divider full"></div></div><div class="clear"></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => 'Page Sidebar',
		'id'            => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pagebg contentwrap widgetinner">',
		'after_widget'  => '</div><div class="divider full"></div></div><div class="clear"></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => 'Contact Sidebar',
		'id'            => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pagebg contentwrap widgetinner">',
		'after_widget'  => '</div><div class="divider full"></div></div><div class="clear"></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}


/*-----------------------------------------------------------------------------------*/
/*	 Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric
/*   index class for each widget (widget-1, widget-2, etc.)
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'widget_first_last_classes' ) ) :
	function widget_first_last_classes($params) {

		global $my_widget_num; // Global a counter array
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets

		if(!$my_widget_num) {// If the counter array doesn't exist, create it
			$my_widget_num = array();
		}

		if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
			return $params; // No widgets in this sidebar... bail early.
		}

		if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}

		$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

		if($my_widget_num[$this_id] == 1) { // If this is the first widget
			$class .= 'widget-first ';
		} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
			$class .= 'widget-last ';
		}

		$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

		return $params;
	}
	add_filter('dynamic_sidebar_params','widget_first_last_classes');
endif;

/*-----------------------------------------------------------------------------------*/
/*	Add Widget Shortcode Support
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

// Add the Project Thumbnail Custom Widget
include("functions/widget-project.php");
// Add the Project Thumbnail Custom Widget
include("functions/widget-recent-projects.php");
// Add the News Custom Widget
include("functions/widget-news.php");
// Add the Contact Custom Widget
include("functions/widget-contact.php");
// Add the Custom Fields for Video Posts
include("functions/customfields.php");

/*-----------------------------------------------------------------------------------*/
/*	Register and load common JS
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'ag_register_js' ) ) :
	function ag_register_js() {
		if ( ! is_admin() ) {

			$theme = wp_get_theme();

			wp_register_script( 'modernizer', get_template_directory_uri() . '/js/jquery.modernizer.min.js', 'jquery', '2.5.3', false );
			wp_register_script( 'infinite', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', 'jquery', '2.0b2.120519', false );
			wp_register_script( 'scrollto', get_template_directory_uri() . '/js/jquery.scrollTo-min.js', 'jquery', '1.4.2', false );
			wp_register_script( 'validation', 'http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js', 'jquery', '1.8.0', false );
			wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.4.8', false );
			wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery', '3.1.6', false );
			wp_register_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.js', 'jquery', '1.3', false );
			wp_register_script( 'swfobject', 'http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js', 'jquery', '2.1', false );
			wp_register_script( 'tabs', get_template_directory_uri() . '/js/tabs.js', 'jquery', '1.1', false );
			wp_register_script( 'fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '1.1', false );
			wp_register_script( 'tipsy', get_template_directory_uri() . '/js/jquery.tipsy.js', 'jquery', '1.0.0a', false );
			wp_register_script( 'wmu', get_template_directory_uri() . '/js/jquery.wmuSlider.min.js', 'jquery', '2.1', false );
			wp_register_script( 'supersized-custom', get_template_directory_uri() . '/js/supersized-custom.js', 'jquery', '3.2.7', false );
			wp_register_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery', '1.5.25', false );
			wp_register_script( 'blockui', get_template_directory_uri() . '/js/jquery.blockUI.js', 'jquery', '2.39', false );
			wp_register_script( 'custom', get_template_directory_uri() . '/js/custom.js', 'jquery',  $theme->get( 'Version' ), true );

			// Localize the ajax script and template directory
			$variables_array = array(
				'ajaxurl'                    => admin_url( 'admin-ajax.php' ),
				'get_template_directory_uri' => get_template_directory_uri()
			);
			wp_localize_script( 'custom', 'agAjax', $variables_array );

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'validation' );
			wp_enqueue_script( 'modernizer' );
			wp_enqueue_script( 'infinite' );
			wp_enqueue_script( 'scrollto' );
			wp_enqueue_script( 'superfish' );
			wp_enqueue_script( 'easing' );
			wp_enqueue_script( 'supersized-custom' );
			wp_enqueue_script( 'prettyPhoto' );
			wp_enqueue_script( 'wmu' );
			wp_enqueue_script( 'tabs' );
			wp_enqueue_script( 'fitvid' );
			wp_enqueue_script( 'isotope' );
			wp_enqueue_script( 'swfobject' );
			wp_enqueue_script( 'tipsy' );
			wp_enqueue_script( 'blockui' );
			wp_enqueue_script( 'custom' );

		}
	}

	add_action( 'init', 'ag_register_js' );
endif;

/*-----------------------------------------------------------------------------------*/
/*	Stylesheets
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'ag_register_theme_styles' ) ) :
	function ag_register_theme_styles() {
		if (!is_admin()) {

			global $wp_styles;

			wp_enqueue_style( 'style', get_stylesheet_uri() );
			wp_enqueue_style( 'ie7',  get_template_directory_uri() . '/css/ie7.css', false, 'ie7', 'all');
			wp_enqueue_style( 'ie8',  get_template_directory_uri() . '/css/ie8.css', false, 'ie8', 'all');
			$wp_styles->add_data( 'ie7', 'conditional', 'IE 7' );
			$wp_styles->add_data( 'ie8', 'conditional', 'IE 8' );

			$custom_css = themewich_custom_styles();

			// Add theme options
			wp_add_inline_style( 'style', $custom_css );

			if ( $customcss = of_get_option('of_custom_css') ) {
				wp_add_inline_style( 'style', '/* Custom CSS */ ' . $customcss); // add custom css
			}

		}
	}
	add_action('wp_enqueue_scripts', 'ag_register_theme_styles');
endif;

if ( !function_exists( 'ag_prettyphoto_styles' ) ) :
	function ag_prettyphoto_styles() {
			 $prettyUrl =  get_template_directory_uri() . '/css/prettyPhoto.css';

			 /* Register Styles */
			 wp_register_style('prettyphoto', $prettyUrl);

			 /*Enqueue Styles */
			 wp_enqueue_style( 'prettyphoto');
	}
	add_action('wp_print_styles', 'ag_prettyphoto_styles');
endif;

function themewich_custom_styles() {

	$styles = ''; // initialize output

	/*-----------------------------------------------------------------------------------*/
	/*  *Sitewide Background Image (Non-Mobile)
	/*-----------------------------------------------------------------------------------*/
	$styles .= 'body {';
	    if ( of_get_option('of_background_image') ) {
	        $styles .= 'background-image:url(' . of_get_option('of_background_image') . ');';
	    } else {
	        if (of_get_option('of_texture_bg') ) {
	            if(of_get_option('of_texture_bg') != 'none') {
	                $styles .= 'background-image:url(' . of_get_option('of_texture_bg') . ');';
	            }
	        }
	    }
	$styles .= '} ';

	/*-----------------------------------------------------------------------------------*/
	/*  *Grid Overlay
	/*-----------------------------------------------------------------------------------*/
	$image_overlay = of_get_option('of_image_overlay');

	if ( $image_overlay == 'Off' ) :
		$styles .= '.lines, .linesmobile { background:none; }';
	endif;

	/*-----------------------------------------------------------------------------------*/
	/*  *Logo Margin
	/*-----------------------------------------------------------------------------------*/
	$styles .= '.logo {';
		if ( of_get_option('of_logo_padding') ) {
			$styles .= 'margin-top:'.of_get_option('of_logo_padding').'px !important;';
		}
	$styles .= '} ';

	/*-----------------------------------------------------------------------------------*/
	/*  *Homepage Slideshow Controls
	/*-----------------------------------------------------------------------------------*/
	if ( $slidecontrols = of_get_option('of_slide_controls') ) {
		if ($slidecontrols != 'block') {
			$styles .= '.home #controls-wrapper, .home #slide-list { display: none !important; }';
		}
	}

	/*-----------------------------------------------------------------------------------*/
	/*  *Button Color Options
	/*-----------------------------------------------------------------------------------*/
	$styles .= '.button:hover,
		a.button:hover,
		a.more-link:hover,
		#footer .button:hover,
		#footer a.button:hover,
		#footer a.more-link:hover,
		.cancel-reply p a:hover,
		#submit:hover {';

		// Get Button Color
		if ( $buttonhover = of_get_option('of_button_hover_color') ) {
			$styles .= 'background:'.$buttonhover.'!important;';
		}

	$styles .= 'color:#fff;}';

	$styles .= '.button,
		a.button,
		a.more-link,
		#footer .button,
		#footer a.button,
		#footer a.more-link,
		.cancel-reply p a,
		.filter li a:hover,
		.filter li a.active,
		.categories a:hover,
		#submit  {';

	if ( $buttoncolor = of_get_option('of_button_color') ) {
		$styles .= 'background:'.$buttoncolor.';';
	}

	$styles .= 'color:#fff;}';

	/*-----------------------------------------------------------------------------------*/
	/*  *Link Color Options
	/*-----------------------------------------------------------------------------------*/

	/* #Links
	======================================================*/
	$styles .= 'p a, a {';

	if ( $linkcolor = of_get_option('of_link_color') ) {
		$styles .= 'color:'.$linkcolor.';';
	}

	$styles .= '}';

	/* #Headings
	======================================================*/
	$styles .= 'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, p a:hover,
		#footer h1 a:hover, #footer h2 a:hover, #footer h3 a:hover, #footer h3 a:hover,
		#footer h4 a:hover, #footer h5 a:hover, a:hover, #footer a:hover, .blogpost h2 a:hover,
		.blogpost .smalldetails a:hover {';

	if ( $linkhover = of_get_option('of_link_hover_color') ) {
		$styles .= 'color:'.$linkhover.';';
	}

	$styles .= '}';

	/* #Recent Projects Hover
	======================================================*/
	$styles .= '.recent-project:hover {';
	if ( $linkcolor = of_get_option('of_link_color') ) {
		$styles .= 'border-color:'.$linkcolor.';';
	}
	$styles .= '}';

	/*-----------------------------------------------------------------------------------*/
	/*  *Selection Colors to Match Link Hover Color
	/*-----------------------------------------------------------------------------------*/

	if ( $linkhover = of_get_option('of_link_hover_color') ) {
		$styles .= "
			::-moz-selection {
				background:$linkhover; color:#fff;
			}
			::selection {
				background:$linkhover; color:#fff;
			}
		";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Slideshow Fonts Selections
	/*-----------------------------------------------------------------------------------*/
	$styles .= '#slidecaption h2, #homevideocaption h2 {';
	if ( $slide_header = of_get_option('of_slide_header') ) {
		$styles .= 'font:' . $slide_header['style'] . ' 62px "' . $slide_header['face']. '", arial, sans-serif;';
		$styles .= 'font-family:"' . $slide_header['face']. '", arial, sans-serif;';
		$styles .= 'text-transform:'. $slide_header['style2']. ';';
		$styles .= 'font-size: 62px;';
		$styles .= 'line-height: 90%;';
	} else {
		$styles .= 'font: bold 62px "PT Sans Narrow", arial, sans-serif;';
		$styles .= 'font-family: "PT Sans Narrow", arial, sans-serif;';
		$styles .= 'text-transform: uppercase;';
		$styles .= 'line-height: 90%;';
	};
	$styles .= '}';

	/* #Hompage Caption Subititle Font
	======================================================*/
	$styles .= '#slidecaption span, #homevideocaption span {';
	if ( $slide_subtitle = of_get_option('of_slide_subtitle') ) {

		if ($slide_subtitle['style'] == 'bold italic') {
			$styles .= 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
		} else if ($slide_subtitle['style'] == 'bold'){
			$styles .= 'font-weight: bold;';
		} else {
			$styles .= 'font-style:'. $slide_subtitle['style']. ';';
		}

		$styles .= 'font-family:"' . $slide_subtitle['face']. '", arial, sans-serif;';
		if ($slide_subtitle['style2'] == 'uppercase') {
			$styles .= 'letter-spacing: 1px;';
		}
		$styles .= 'text-transform:'. $slide_subtitle['style2']. ';';
		$styles .= 'font-size: 16px;';
    	$styles .= 'line-height: 16px;';

	} else {
	   $styles .= 'font-family: "Droid Serif", georgia, sans-serif;';
	   $styles .= 'font-size: 16px;';
       $styles .= 'line-height: 16px;';
	};
	$styles .= '}';

	/*-----------------------------------------------------------------------------------*/
	/*  Menu Font
	/*-----------------------------------------------------------------------------------*/
	$styles .= '.sf-menu a {';
	if ( $typography = of_get_option('of_sf_font') ) { // Get Options

		if ($typography['style'] == 'bold italic') {
			$styles .= 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
		} else if ($typography['style'] == 'bold'){
			$styles .= 'font-weight: bold;';
		} else {
			$styles .= 'font-style:'. $typography['style']. ';';
		}

	  	$styles .= 'font-family:"' . $typography['face']. '", arial, sans-serif;';
		if ($typography['style2'] == 'uppercase') {
			$styles .= 'letter-spacing: 1px;';
		}
	  	$styles .= 'text-transform:'. $typography['style2']. ';';
	  	$styles .= 'font-size: 13px;';
	  	$styles .= 'line-height: 18px;';
	} else {
	   $styles .= 'font: normal 13px "PT Sans Narrow", arial, sans-serif;';
	   $styles .= 'font-family: "PT Sans Narrow", arial, sans-serif;';
	   $styles .= 'text-transform: uppercase;';
	   $styles .= 'letter-spacing: 1px;';
	}
	$styles .= '}';

	/*-----------------------------------------------------------------------------------*/
	/*  Site Wide Heading Font
	/*-----------------------------------------------------------------------------------*/

	/* #Primary Heading Option
	======================================================*/
	$styles .= 'h1, h1 a, h2, h2 a {';
	if ( $headingfont = of_get_option('of_heading_font') ) { // Get Options
		if ($headingfont['style'] == 'bold italic') {
			$styles .= 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
		} else if ($headingfont['style'] == 'bold'){
			$styles .= 'font-weight: bold;';
		} else {
			$styles .= 'font-style:'. $headingfont['style']. ';';
		}
		$styles .= 'text-transform:'. $headingfont['style2']. ';';
		if ($headingfont['style2'] == 'uppercase') {
			$styles .= 'letter-spacing: 1px;';
		}
		$styles .= 'font-family:"' . $headingfont['face']. '", arial, sans-serif;';
		$styles .= 'line-height: 100%;';
	} else {
		$styles .= 'font-family: "PT Sans Narrow", arial, sans-serif;';
		$styles .= 'text-transform: uppercase;';
	}
	$styles .= '}';

	/* #Secondary Heading Option
	======================================================*/
	$styles .= 'h3, h3 a,
		h4, h4 a,
		h5, h5 a {';
	if ( $headingfont2 = of_get_option('of_heading_font2') ) {

		if ($headingfont2['style'] == 'bold italic') {
			$styles .= 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
		} else if ($headingfont2['style'] == 'bold'){
			$styles .= 'font-weight: bold;';
		} else {
			$styles .= 'font-style:'. $headingfont2['style']. ';';
		}

		$styles .= 'text-transform:'. $headingfont2['style2']. ';';
		if ($headingfont2['style2'] == 'uppercase') {
			$styles .= 'letter-spacing: 1px;';
		}
		$styles .= 'font-family:"' . $headingfont2['face']. '", arial, sans-serif;';
	    $styles .= 'line-height: 100%;';
	} else {
		$styles .= 'font-family: "PT Sans Narrow", arial, sans-serif;';
		$styles .= 'text-transform: uppercase;';
	}
	$styles .= '}';

	/* #Tiny Details Font
	======================================================*/
	$styles .= 'h5, h5 a, .widget h3, .widget h2, .widget h4  {';
	if ( $tinyfont = of_get_option('of_tiny_font') ) {
		$styles .= 'font-family:"'.$tinyfont['face'].'", arial, sans-serif;';
	}
	$styles .= '}';

	/* #Body Font Option
	======================================================*/
	$styles .= 'body, input, p, ul, ol, .button, .ui-tabs-vertical .ui-tabs-nav li a span.text,
	.footer p, .footer ul, .footer ol, .footer.button, .credits p,
	.credits ul, .credits ol, .credits.button, textarea, .footer input, .testimonial p,
	.contactsubmit label, .contactsubmit input[type=text], .contactsubmit textarea {';

	if ( $pfont = of_get_option('of_p_font') ) {
		if ($pfont['style'] == 'bold italic') {
			$styles .= 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
		} else if ($pfont['style'] == 'bold'){
			$styles .= 'font-weight: bold;';
		} else {
			$styles .= 'font-style:'. $pfont['style']. ';';
		}

		$styles .= 'font-size:12px;';
		$styles .= 'font-family:"'. $pfont['face']. '", arial, sans-serif !important;';
		$styles .= 'text-transform:'. $pfont['style2']. ';';
		$styles .= 'line-height: 150%;';
	}

	$styles .= '}';

	/* #Slide Controls Option
	======================================================*/
	$styles .= '.page-template-template-home-php #controls-wrapper,
	.page-template-template-home-php ul#slide-list {';

	if ($slidecontrols = of_get_option('of_slide_controls') ) {
		$styles .= 'display:'.$slidecontrols;
	} else {
		$styles .= 'display:block;';
	}
	$styles .= '}';

	/* #Slide Progress Bar Option
	======================================================*/
	if ( $progressbar = of_get_option('of_progress_bar') ) :
		if ($progressbar == 0) :
        	$styles .= '.home #progress-back {
            	display:none !important;
            }';
  		endif;
    endif;

	if ( $portprogressbar = of_get_option('of_portfolio_progress_bar') ) :
		if ($portprogressbar == 0) :
        	$styles .= '.single-portfolio #progress-back {
            	display:none !important;
            }';
		endif;
	endif;

	// Return CSS
	return $styles;
}

/*-----------------------------------------------------------------------------------*/
/* Register Navigation
/*-----------------------------------------------------------------------------------*/

add_theme_support('menus');

if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
          'top_nav_menu' => 'Main Navigation Menu'
        )
    );

	// remove menu container div
	function my_wp_nav_menu_args( $args = '' ) {
	    $args['container'] = false;
	    return $args;
	} // function
	add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
}

/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'ag_excerpt_length' ) ) :
	function ag_excerpt_length($length) {
		return 15;
	}
	add_filter('excerpt_length', 'ag_excerpt_length');
endif;

/*-----------------------------------------------------------------------------------*/
/*	Set Max Content Width (use in conjuction with ".blogpost .featuredimage img" css)
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 635;

/*-----------------------------------------------------------------------------------*/
/*	Automatic Feed Links
/*-----------------------------------------------------------------------------------*/

if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links'); //WP Auto Feed Links
}

/*-----------------------------------------------------------------------------------*/
/* Render Title Tag
/*-----------------------------------------------------------------------------------*/

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

/**
 * Fallback for older versions
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function themewich_render_title() {
?>
<title><?php wp_title( '-', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'themewich_render_title' );
endif;


/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'ag_excerpt_more' ) ) :
	function ag_excerpt_more($excerpt) {
		return str_replace('[...]', '...', $excerpt);
	}
	add_filter('wp_trim_excerpt', 'ag_excerpt_more');
endif;

/*------------------------------------------------------------------------------*/
/*	Remove More Link Anchor
/*------------------------------------------------------------------------------*/

if ( !function_exists( 'remove_more_jump_link' ) ) :
	function remove_more_jump_link($link) {
		$offset = strpos($link, '#more-');
		if ($offset) {
			$end = strpos($link, '"',$offset);
		}
		if ($end) {
			$link = substr_replace($link, '', $offset, $end-$offset);
		}
		return $link;
	}
	add_filter('the_content_more_link', 'remove_more_jump_link');
endif;

/*------------------------------------------------------------------------------*/
/*	Get Attachement ID from URL function
/*------------------------------------------------------------------------------*/

if ( !function_exists( 'get_attachment_id' ) ) :
	function get_attachment_id( $url ) {

	    $dir = wp_upload_dir();
	    $dir = trailingslashit($dir['baseurl']);

	    if( false === strpos( $url, $dir ) )
	        return false;

	    $file = basename($url);

	    $query = array(
	        'post_type' => 'attachment',
	        'fields' => 'ids',
	        'meta_query' => array(
	            array(
	                'value' => $file,
	                'compare' => 'LIKE',
	            )
	        )
	    );

	    $query['meta_query'][0]['key'] = '_wp_attached_file';
	    $ids = get_posts( $query );

	    foreach( $ids as $id )
	        if( $url == array_shift( wp_get_attachment_image_src($id, 'full') ) )
	            return $id;

	    $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
	    $ids = get_posts( $query );

	    foreach( $ids as $id ) {

	        $meta = wp_get_attachment_metadata($id);

	        foreach( $meta['sizes'] as $size => $values )
	            if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src($id, $size) ) ) {
					if(isset($id->attachment_size)){
	                $id->attachment_size = $size;
					}
	                return $id;
	            }
	    }

	    return false;
	}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Add Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'ag_browser_body_class' ) ) :

	/**
	 * Adds browser classes to the body tag
	 */
	function ag_browser_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE) $classes[] = 'ie';
		else $classes[] = 'unknown';

		if($is_iphone) $classes[] = 'iphone';
		return $classes;
	}
	add_filter('body_class','ag_browser_body_class');

endif;

if ( ! function_exists('themewich_options_body_class') ) {
	function themewich_options_body_class($classes) {
		// Image protection
    	$classes[] = of_get_option('of_image_protect') == 'On' ? 'imageprotect' : '';
    	// More info
    	$classes[] = of_get_option('of_more_info') == 'true' ? 'show-more' : 'no-more';
    	// Hide nav bar option
		if ( $hidenavbar = of_get_option('of_hide_nav') ) :
	        if ($hidenavbar == 'yes' && (is_singular('portfolio') || is_page_template('template-home.php') || is_page_template('template-home-video.php') ) ) :
	            $classes[] = 'hidenavbar';
	        endif;
	    endif;

		return $classes;
	}
	add_filter('body_class','themewich_options_body_class');
}


/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 56, 56, true ); // Normal post thumbnails
	add_image_size( 'large', 960, '', true ); // Large thumbnails
	add_image_size( 'medium', 460, '310', true ); // Medium thumbnails
	add_image_size( 'small', 125, '', true ); // Small thumbnails
	add_image_size( 'blog', 529, 270, true ); // Blog thumbnail
	add_image_size( 'portfoliowidget', 56, 56, true ); // Portfolio widget thumbnail
	add_image_size( 'portfoliosmall', 480, 375, true ); // Portfolio Small thumbnail
	add_image_size( 'portfoliosmallnc', 480, '', false); // Portfolio Small Without Crop
	add_image_size( 'blogsmall', 420, 246, true ); // Portfolio Small thumbnail
	add_image_size( 'portfoliolarge', 1500, '', false ); // Portfolio Large thumbnail
}


if (class_exists('MultiPostThumbnails')) {
	if ( $thumbnum = of_get_option('of_thumbnail_number') ) { $thumbnum = ($thumbnum + 1); } else { $thumbnum = 7;}
   	$counter1 = 2;

	while ($counter1 < ($thumbnum)) {
		new MultiPostThumbnails(
			array(
				'label' => 'Slide ' . $counter1,
				'id' => $counter1 . '-slide',
				'post_type' => 'portfolio'
			)); $counter1++;
	}
}

if ( !function_exists( 'get_portfolio_info' ) ) :

	function get_portfolio_info($id, $thumbnum) {

			global $thumb, $full, $alt, $thumbnc, $fitalways, $fitlandscape, $fitportrait;

			$i = 2;

			while ($i < ($thumbnum)) {

			global ${"thumb" . $i};
			global ${"thumbnc" . $i};
			global ${"full" . $i};
			global ${"alt" . $i};

			$i++;

			}
				  $fitalways = 0; $fitlandscape = 0; $fitportrait = 0;

				  $fitting = get_post_meta($id, 'ag_fit', true); //Get the fitting setting for slideshow

					switch ($fitting) {
						case 'Fit Portrait':
							$fitportrait = 1;
						break;

						case 'Fit Landscape':
							$fitlandscape = 1;
						break;

						case 'Fit Always':
							$fitalways = 1;
						break;
					}

				  $counter = 2; //start counter at 2

				  $full = get_post_meta($id,'_thumbnail_id',false); // Get Image ID
				  $alt = get_post_meta($full, '_wp_attachment_image_alt', true); // Alt text of image
				  $full = wp_get_attachment_image_src($full[0], 'portfoliolarge', false);  // URL of Featured Full Image
				  $thumbid = get_post_meta($id,'_thumbnail_id',false);
				  $thumb = wp_get_attachment_image_src($thumbid[0], 'portfoliosmall', false);  // URL of Featured first slide
				  $thumbnc = wp_get_attachment_image_src($thumbid[0], 'portfoliosmallnc', false);  // URL of Featured first slide

				while ($counter < ($thumbnum)) {

					 ${"full" . $counter} = MultiPostThumbnails::get_post_thumbnail_id('portfolio', $counter . '-slide', $id); // Get Image ID
					 ${"alt" . $counter} = get_post_meta(${"full" . $counter} , '_wp_attachment_image_alt', true); // Alt text of image
					 ${"full" . $counter} = wp_get_attachment_image_src(${"full" . $counter}, 'portfoliolarge', false); // URL of Second Slide Full Image
	    			 ${"thumbid" . $counter} = MultiPostThumbnails::get_post_thumbnail_id('portfolio',  $counter . '-slide', $id);
				  	 ${"thumb" . $counter} = wp_get_attachment_image_src(${"thumbid" . $counter}, 'portfoliosmall', false); // URL of next Slide
					 ${"thumbnc" . $counter} = wp_get_attachment_image_src(${"thumbid" . $counter}, 'portfoliosmallnc', false); // URL of next Slide

				 $counter++;
			}
	}

endif;

if ( !function_exists( 'get_homepage_info' ) ) :

	function get_homepage_info($id) {

		global $video_url, $post_url, $sub_title,
			   $title, $more_button, $title_place,
			   $title_color, $title_bg, $thumb,
			   $full, $home_display, $ag_loopcounter, $optional_link;

		$home_display = get_post_meta($id, 'ag_home_page_display', true); //find out if display on homepage

			if ($home_display == 'Yes') { //if can display on homepage

			$video_url = get_post_meta($id, 'ag_video_url', true); //Get the Video Link for the Post
			$post_url = get_permalink($id); //Get Permalink for post

			$sub_title = get_post_meta($id, 'ag_sub_title', true); $sub_title = htmlspecialchars($sub_title, ENT_QUOTES); $sub_title = htmlspecialchars_decode($sub_title, ENT_COMPAT);
			$title = get_post_meta($id, 'ag_title', true); $title = htmlspecialchars($title, ENT_QUOTES); $title = htmlspecialchars_decode($title, ENT_COMPAT);
			$more_button = get_post_meta($id, 'ag_more_text', true);
			$optional_link = get_post_meta($id, 'ag_optional_link', true);
			$title_place = get_post_meta($id, 'ag_title_place', true);
			$title_color = get_post_meta($id, 'ag_title_color', true);
			$title_bg = get_post_meta($id, 'ag_title_bg', true);

			$full = get_post_meta($id,'_thumbnail_id',false);
			$thumb = wp_get_attachment_image_src($full[0], 'portfoliosmall', false);  // URL of Featured Thumbnail Image
			$full = wp_get_attachment_image_src($full[0], 'portfoliolarge', false);  // URL of Featured Full Image

			$ag_loopcounter++;

			}
	}

endif;

if ( !function_exists( 'ag_loophide' ) ) :

	/**
	 * Outputs additional style to hide specific controls for a single image
	 * @param  integer $loopcounter number of images in the page
	 * @return string               css to hide the controls
	 */
	function ag_loophide($loopcounter) {
		if ($loopcounter == 1) {
		echo '<style>
			.playcontrols, #slidecounter, #tray-button, #slide-list, #progress-back {
			display:none !important;
			}
			</style>';
		}
	}
endif;


/*-----------------------------------------------------------------------------------*/
/*	Function to get Thumbnail Caption
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'the_post_thumbnail_caption' ) ) :

	/**
	 * Adds caption to the thumbnail
	 * @return string filtered html of the thumbnail
	 */
	function the_post_thumbnail_caption() {
	  global $post;

	  $thumb_id = get_post_thumbnail_id($post->ID);

	  $args = array(
		'post_type' => 'portfolio',
		'post_status' => null,
		'post_parent' => $post->ID,
		'include'  => $thumb_id
		);

	   $thumbnail_image = get_posts($args);

	   if ($thumbnail_image && isset($thumbnail_image[0])) {
	     //show thumbnail title
	     echo $thumbnail_image[0]->post_title;

	     //Uncomment to show the thumbnail caption
	     //echo $thumbnail_image[0]->post_excerpt;

	     //Uncomment to show the thumbnail description
	     //echo $thumbnail_image[0]->post_content;

	     //Uncomment to show the thumbnail alt field
	     //$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	     //if(count($alt)) echo $alt;
	  }
	}

endif;

/*-----------------------------------------------------------------------------------*/
/*	Remove Dimensions from Post Thumbnails so they can be Responsive
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'remove_thumbnail_dimensions' ) ) :

	/**
	 * Remove thumbnail dimensions for responsivity
	 * @param  string  $html          html of thumbnail
	 * @param  integer $post_id       ID of the post
	 * @param  integer $post_image_id ID of the image
	 * @return string  				  filtered image html
	 */
	function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	    return $html;
	}
	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

endif;


if(function_exists('add_theme_support')) {
    /** Exists! So add the post-thumbnail */
    add_theme_support('post-thumbnails');

    /** Now Set some image sizes */

    /** #1 for our featured content slider */
    add_image_size( $name = 'itg_featured', $width = 500, $height = 300, $crop = true );

    /** #2 for post thumbnail */
    add_image_size( 'itg_post', 250, 250, true );

    /** #3 for widget thumbnail */
    add_image_size( 'itg_widget', 40, 40, true );

    /** Set default post thumbnail size */
    set_post_thumbnail_size($width = 50, $height = 50, $crop = true);
}

add_filter("manage_upload_columns", 'upload_columns');
add_action("manage_media_custom_column", 'media_custom_columns', 0, 2);

if ( !function_exists( 'upload_columns' ) ) :
	function upload_columns($columns) {
		unset($columns['parent']);
		$columns['better_parent'] = "Parent";

		return $columns;
	}
endif;

if ( !function_exists( 'media_custom_columns' ) ) :
	function media_custom_columns($column_name, $id) {

		$post = get_post($id);

		if($column_name != 'better_parent')
			return;

			if ( $post->post_parent > 0 ) {
				if ( get_post($post->post_parent) ) {
					$title =_draft_or_post_title($post->post_parent);
				}
				?>
				<strong><a href="<?php echo get_edit_post_link( $post->post_parent ); ?>"><?php echo $title ?></a></strong>, <?php echo get_the_time(__('Y/m/d', 'framework')); ?>
				<br />
				<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Re-Attach', 'framework'); ?></a>

				<?php
			} else {
				?>
				<?php _e('(Unattached)', 'framework'); ?><br />
				<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Attach', 'framework'); ?></a>
				<?php
			}
	}
endif;

if ( !function_exists( 'mytheme_enqueue_comment_reply' ) ) :

	/**
	 * Enqueues the comment "reply button" javascript
	 */
	function mytheme_enqueue_comment_reply() {
	    // on single blog post pages with comments open and threaded comments
	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	        // enqueue the javascript that performs in-link comment reply fanciness
	        wp_enqueue_script( 'comment-reply' );
	    }
	}
	// Hook into wp_enqueue_scripts
	add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_comment_reply' );

endif;

/*------------------------------------------------------------------------------*/
/*	Comments Template
/*------------------------------------------------------------------------------*/

if ( !function_exists( 'ag_comment' ) ) :

	/**
	 * Function to show and format the comments section
	 * @param  array $comment stores the comment information
	 * @param  array $args    comment info arguments
	 * @param  int 	 $depth   depth of the comment
	 * @return string         html to output to the page.
	 */
	function ag_comment($comment, $args, $depth) {

	    $isByAuthor = false;

	    if($comment->comment_author_email == get_the_author_meta('email')) {
	        $isByAuthor = true;
	    }

	    $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	   <div id="comment-<?php comment_ID(); ?>" class="singlecomment">
	      <p class="commentsmetadata"><cite>
	            <?php comment_date('F j, Y'); ?>
	            </cite></p>
	    <div class="author">
	            <div class="reply"><?php echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'])); ?></div>

	            <div class="name"><?php comment_author_link() ?></div>
	        </div>
	      <?php if ($comment->comment_approved == '0') : ?>
	         <p class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></p>

	      <?php endif; ?>

	        <div class="commenttext">
	            <?php comment_text() ?>
	        </div>
	</div>
	<div class="clear"></div>
	<?php
	}

endif;

// Function to find if page has comments nav
if ( !function_exists( 'page_has_comments_nav' ) ) :
	function page_has_comments_nav() {
	 global $wp_query;
	 return ($wp_query->max_num_comment_pages > 1);
	}
endif;

/*------------------------------------------------------------------------------*/
/*	Show Social Icons Function
/*------------------------------------------------------------------------------*/

if ( !function_exists( 'show_social_icons' ) ) :

	/**
	 * Function to show the social icons on the page.
	 * @param  string $permalink Link to add to the share icons
	 * @param  string $title     Title of the post/page to share
	 * @return string            Html output of sharing icons
	 */
	function show_social_icons($permalink,$title){
		$title = htmlspecialchars($title);
		$title = urlencode ($title);
		echo'<div class="socialicons">';
	    echo '<a href="http://twitter.com/share?url='.$permalink.'&text='.$title.'" class="twitterlink tooltip-top" title="'. __("Share on Twitter", "framework").'">'. __("Share on Twitter", "framework").'</a>';
	    echo '<a href="http://www.facebook.com/sharer.php?u='.$permalink.'" class="fblink tooltip-top" title="'.__("Share on Facebook", "framework").'">'.__("Share on Facebook", "framework").'</a>';
	    echo '<a href="mailto:?subject='.$title.'&body='.__("Check out", "framework").' &#39;'.$title .'&#39;:%0D%0A'.$permalink.'" class="maillink tooltip-top" title="'.__("Email This", "framework").'">'. __('Email This', 'framework').'</a>';
	    echo '<div class="clear"></div></div>';
	}

endif;

/*-----------------------------------------------------------------------------------*/
/*	Add Custom Portfolio Post Type
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'create_portfolio_post_types' ) ) :

	/**
	 * Creates the portfolio post type
	 */
	function create_portfolio_post_types() {
		register_post_type( 'portfolio',
			array(
				  'labels' => array(
				  'name' => __( 'Portfolio', 'framework'),
				  'singular_name' => __( 'Portfolio Item', 'framework'),
				  'add_new' => __( 'Add New', 'framework' ),
			   	  'add_new_item' => __( 'Add New Portfolio Item', 'framework'),
				  'edit' => __( 'Edit', 'framework' ),
		  		  'edit_item' => __( 'Edit Portfolio Item', 'framework'),
		          'new_item' => __( 'New Portfolio Item', 'framework'),
				  'view' => __( 'View Portfolio', 'framework'),
				  'view_item' => __( 'View Portfolio Item', 'framework'),
				  'search_items' => __( 'Search Portfolio Items', 'framework'),
		  		  'not_found' => __( 'No Portfolios found', 'framework'),
		  		  'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'framework'),
				  'parent' => __( 'Parent Portfolio', 'framework'),
				),
				'menu_icon' => 'dashicons-portfolio',
				'public' => true,
				'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'comments'),
			)
		);
	}
	add_action( 'init', 'create_portfolio_post_types' );

endif;


if ( !function_exists( 'ag_create_taxonomies' ) ) :

	/**
	 * Adds taxonomies used by the theme
	 */
	function ag_create_taxonomies() {
	  // Add new taxonomy, make it hierarchical (like categories)
	  $labels = array(
	    'name' => _x( 'Sort', 'taxonomy general name', 'framework'),
	    'singular_name' => _x( 'Skill', 'taxonomy singular name', 'framework'),
	    'search_items' =>  __( 'Search Skills', 'framework'),
	    'all_items' => __( 'All Skills', 'framework'),
	    'parent_item' => __( 'Parent Skill', 'framework'),
	    'parent_item_colon' => __( 'Parent Skill:', 'framework'),
	    'edit_item' => __( 'Edit Skill', 'framework'),
	    'update_item' => __( 'Update Skill', 'framework'),
	    'add_new_item' => __( 'Add New Skill', 'framework'),
	    'new_item_name' => __( 'New Skill Name', 'framework'),
	    'menu_name' => __( 'Skills', 'framework'),
	  );

	  register_taxonomy('sort',array('portfolio'), array(
	    'hierarchical' => true,
	    'labels' => $labels,
	    'show_ui' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'sort' ),
	  ));
	}
	add_action( 'init', 'ag_create_taxonomies', 0 );

endif;

/*-----------------------------------------------------------------------------------*/
/*	Load Text Domain
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'theme_init' ) ) :
	/**
	 * Loads translation strings
	 */
	function theme_init(){
	    load_theme_textdomain('framework', get_template_directory() . '/lang');
	}
	add_action ('init', 'theme_init');
endif;

/*-----------------------------------------------------------------------------------*/
/*	New category walker for portfolio filter
/*-----------------------------------------------------------------------------------*/

if ( !class_exists( 'Walker_Portfolio_Filter' ) ) :
	/**
	 * Change HTML of portfolio filter to use isotope.
	 */
	class Walker_Portfolio_Filter extends Walker_Category {
       function start_el(&$output, $category, $depth = 0, $args = array(), $current_object_id = 0) {

	      extract($args);
	      $cat_name = esc_attr( $category->name);
	      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
	      $link = '<a href="#" data-filter=".'.strtolower(preg_replace('/\s+/', '-', $cat_name)).'" ';
	      if ( $use_desc_for_title == 0 || empty($category->description) )
	         $link .= 'title="' . sprintf(__( 'View all projects filed under %s', 'framework'), $cat_name) . '"';
	      else
	         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
	      $link .= '>';
	      // $link .= $cat_name . '</a>';
	      $link .= $cat_name;
	      if(!empty($category->description)) {
	         $link .= ' <span>'.$category->description.'</span>';
	      }
	      $link .= '</a>';
	      if ( (! empty($feed_image)) || (! empty($feed)) ) {
	         $link .= ' ';
	         if ( empty($feed_image) )
	            $link .= '(';
	         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
	         if ( empty($feed) )
	            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'framework'), $cat_name ) . '"';
	         else {
	            $title = ' title="' . $feed . '"';
	            $alt = ' alt="' . $feed . '"';
	            $name = $feed;
	            $link .= $title;
	         }
	         $link .= '>';
	         if ( empty($feed_image) )
	            $link .= $name;
	         else
	            $link .= "<img src='$feed_image'$alt$title" . ' />';
	         $link .= '</a>';
	         if ( empty($feed_image) )
	            $link .= ')';
	      }
	      if ( isset($show_count) && $show_count )
	         $link .= ' (' . intval($category->count) . ')';
	      if ( isset($show_date) && $show_date ) {
	         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
	      }
	      if ( isset($current_category) && $current_category )
	         $_current_category = get_category( $current_category );
	      if ( 'list' == $args['style'] ) {
	          $output .= '<li class="segment-2"';
	          $class = 'cat-item cat-item-'.$category->term_id;
	          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
	             $class .=  ' current-cat';
	          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
	             $class .=  ' current-cat-parent';
	          $output .=  '';
	          $output .= ">$link\n";
	       } else {
	          $output .= "\t$link<br />\n";
	       }
	   }
	}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Add Shortcode Buttons to WYSIWIG
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'add_ag_shortcodes' ) ) :
	function add_ag_shortcodes() {
	   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	   {

	   	 //Add "button" button
	     add_filter('mce_external_plugins', 'add_plugin_button');
	     add_filter('mce_buttons', 'register_button');

	     //Add "divider" button
	     add_filter('mce_external_plugins', 'add_plugin_divider');
	     add_filter('mce_buttons', 'register_divider');

		 //Add "tabs" button
	     add_filter('mce_external_plugins', 'add_plugin_featuredfulltabs');
	     add_filter('mce_buttons', 'register_featuredfulltabs');

		 //Add "lightbox" button
	     add_filter('mce_external_plugins', 'add_plugin_lightbox');
	     add_filter('mce_buttons', 'register_lightbox');

		 //Add "shortcodes" buttons - 3rd row

		 add_filter('mce_external_plugins', 'add_plugin_onehalf');
	     add_filter('mce_buttons_3', 'register_onehalf');

		 add_filter('mce_external_plugins', 'add_plugin_onehalflast');
	     add_filter('mce_buttons_3', 'register_onehalflast');

		 add_filter('mce_external_plugins', 'add_plugin_onethird');
	     add_filter('mce_buttons_3', 'register_onethird');

		 add_filter('mce_external_plugins', 'add_plugin_onethirdlast');
	     add_filter('mce_buttons_3', 'register_onethirdlast');

		 add_filter('mce_external_plugins', 'add_plugin_twothird');
	     add_filter('mce_buttons_3', 'register_twothird');

		 add_filter('mce_external_plugins', 'add_plugin_twothirdlast');
	     add_filter('mce_buttons_3', 'register_twothirdlast');

		 add_filter('mce_external_plugins', 'add_plugin_onefourth');
	     add_filter('mce_buttons_3', 'register_onefourth');

		 add_filter('mce_external_plugins', 'add_plugin_onefourthlast');
	     add_filter('mce_buttons_3', 'register_onefourthlast');

		 add_filter('mce_external_plugins', 'add_plugin_threefourth');
	     add_filter('mce_buttons_3', 'register_threefourth');

		 add_filter('mce_external_plugins', 'add_plugin_threefourthlast');
	     add_filter('mce_buttons_3', 'register_threefourthlast');

		 add_filter('mce_external_plugins', 'add_plugin_onefifth');
	     add_filter('mce_buttons_3', 'register_onefifth');

		 add_filter('mce_external_plugins', 'add_plugin_onefifthlast');
	     add_filter('mce_buttons_3', 'register_onefifthlast');

		 add_filter('mce_external_plugins', 'add_plugin_twofifth');
	     add_filter('mce_buttons_3', 'register_twofifth');

		 add_filter('mce_external_plugins', 'add_plugin_twofifthlast');
	     add_filter('mce_buttons_3', 'register_twofifthlast');

		 add_filter('mce_external_plugins', 'add_plugin_threefifth');
	     add_filter('mce_buttons_3', 'register_threefifth');

		 add_filter('mce_external_plugins', 'add_plugin_threefifthlast');
	     add_filter('mce_buttons_3', 'register_threefifthlast');

		 add_filter('mce_external_plugins', 'add_plugin_fourfifth');
	     add_filter('mce_buttons_3', 'register_fourfifth');

		 add_filter('mce_external_plugins', 'add_plugin_fourfifthlast');
	     add_filter('mce_buttons_3', 'register_fourfifthlast');

		 add_filter('mce_external_plugins', 'add_plugin_onesixth');
	     add_filter('mce_buttons_3', 'register_onesixth');

		 add_filter('mce_external_plugins', 'add_plugin_onesixthlast');
	     add_filter('mce_buttons_3', 'register_onesixthlast');

		 add_filter('mce_external_plugins', 'add_plugin_fivesixth');
	     add_filter('mce_buttons_3', 'register_fivesixth');

		 add_filter('mce_external_plugins', 'add_plugin_fivesixthlast');
	     add_filter('mce_buttons_3', 'register_fivesixthlast');

	   }
	}
	add_action('init', 'add_ag_shortcodes');
endif;

function register_button($buttons) {
   array_push($buttons, "btn");
   return $buttons;
}
function add_plugin_button($plugin_array) {
   $plugin_array['btn'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}
function register_divider($buttons) {
   array_push($buttons, "divider");
   return $buttons;
}
function add_plugin_divider($plugin_array) {
   $plugin_array['divider'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}
function register_featuredfulltabs($buttons) {
   array_push($buttons, "featuredfulltabs");
   return $buttons;
}
function add_plugin_featuredfulltabs($plugin_array) {
   $plugin_array['featuredfulltabs'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}
function register_lightbox($buttons) {
   array_push($buttons, "lightbox");
   return $buttons;
}
function add_plugin_lightbox($plugin_array) {
   $plugin_array['lightbox'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onehalf($buttons) {
   array_push($buttons, "onehalf");
   return $buttons;
}
function add_plugin_onehalf($plugin_array) {
   $plugin_array['onehalf'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onehalflast($buttons) {
   array_push($buttons, "onehalflast");
   return $buttons;
}
function add_plugin_onehalflast($plugin_array) {
   $plugin_array['onehalflast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onethird($buttons) {
   array_push($buttons, "onethird");
   return $buttons;
}
function add_plugin_onethird($plugin_array) {
   $plugin_array['onethird'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onethirdlast($buttons) {
   array_push($buttons, "onethirdlast");
   return $buttons;
}
function add_plugin_onethirdlast($plugin_array) {
   $plugin_array['onethirdlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_twothird($buttons) {
   array_push($buttons, "twothird");
   return $buttons;
}
function add_plugin_twothird($plugin_array) {
   $plugin_array['twothird'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_twothirdlast($buttons) {
   array_push($buttons, "twothirdlast");
   return $buttons;
}
function add_plugin_twothirdlast($plugin_array) {
   $plugin_array['twothirdlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// one fourth buttons

function register_onefourth($buttons) {
   array_push($buttons, "onefourth");
   return $buttons;
}
function add_plugin_onefourth($plugin_array) {
   $plugin_array['onefourth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onefourthlast($buttons) {
   array_push($buttons, "onefourthlast");
   return $buttons;
}
function add_plugin_onefourthlast($plugin_array) {
   $plugin_array['onefourthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}


// three fourth buttons

function register_threefourth($buttons) {
   array_push($buttons, "threefourth");
   return $buttons;
}
function add_plugin_threefourth($plugin_array) {
   $plugin_array['threefourth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_threefourthlast($buttons) {
   array_push($buttons, "threefourthlast");
   return $buttons;
}
function add_plugin_threefourthlast($plugin_array) {
   $plugin_array['threefourthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// one fifth buttons

function register_onefifth($buttons) {
   array_push($buttons, "onefifth");
   return $buttons;
}
function add_plugin_onefifth($plugin_array) {
   $plugin_array['onefifth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onefifthlast($buttons) {
   array_push($buttons, "onefifthlast");
   return $buttons;
}
function add_plugin_onefifthlast($plugin_array) {
   $plugin_array['onefifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// two fifth buttons

function register_twofifth($buttons) {
   array_push($buttons, "twofifth");
   return $buttons;
}
function add_plugin_twofifth($plugin_array) {
   $plugin_array['twofifth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_twofifthlast($buttons) {
   array_push($buttons, "twofifthlast");
   return $buttons;
}
function add_plugin_twofifthlast($plugin_array) {
   $plugin_array['twofifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// three fifth buttons

function register_threefifth($buttons) {
   array_push($buttons, "threefifth");
   return $buttons;
}
function add_plugin_threefifth($plugin_array) {
   $plugin_array['threefifth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_threefifthlast($buttons) {
   array_push($buttons, "threefifthlast");
   return $buttons;
}
function add_plugin_threefifthlast($plugin_array) {
   $plugin_array['threefifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// four fifth buttons

function register_fourfifth($buttons) {
   array_push($buttons, "fourfifth");
   return $buttons;
}
function add_plugin_fourfifth($plugin_array) {
   $plugin_array['fourfifth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_fourfifthlast($buttons) {
   array_push($buttons, "fourfifthlast");
   return $buttons;
}
function add_plugin_fourfifthlast($plugin_array) {
   $plugin_array['fourfifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// one sixth buttons

function register_onesixth($buttons) {
   array_push($buttons, "onesixth");
   return $buttons;
}
function add_plugin_onesixth($plugin_array) {
   $plugin_array['onesixth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onesixthlast($buttons) {
   array_push($buttons, "onesixthlast");
   return $buttons;
}
function add_plugin_onesixthlast($plugin_array) {
   $plugin_array['onesixthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// five sixth buttons

function register_fivesixth($buttons) {
   array_push($buttons, "fivesixth");
   return $buttons;
}
function add_plugin_fivesixth($plugin_array) {
   $plugin_array['fivesixth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_fivesixthlast($buttons) {
   array_push($buttons, "fivesixthlast");
   return $buttons;
}
function add_plugin_fivesixthlast($plugin_array) {
   $plugin_array['fivesixthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

if ( !function_exists( 'parse_shortcode_content' ) ) :
	function parse_shortcode_content( $content ) {

	    /* Parse nested shortcodes and add formatting. */
	    $content = trim( wpautop( do_shortcode( $content ) ) );

	    /* Remove '</p>' from the start of the string. */
	    if ( substr( $content, 0, 4 ) == '</p>' )
	        $content = substr( $content, 4 );

	    /* Remove '<p>' from the end of the string. */
	    if ( substr( $content, -3, 3 ) == '<p>' )
	        $content = substr( $content, 0, -3 );

	    /* Remove any instances of '<p></p>'. */
	    $content = str_replace( array( '<p></p>' ), '', $content );

	    return $content;
	}
endif;

if ( !function_exists( 'get_attachment_id_from_src' ) ) :
	function get_attachment_id_from_src($image_src) {

			global $wpdb;
			$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
			$id = $wpdb->get_var($query);
			return $id;
	}
endif;

/*
Plugin Name: WP-Ajaxify-Comments
Plugin URI: http://wordpress.org/extend/plugins/wp-ajaxify-comments/
Description: WP-Ajaxify-Comments hooks into your current theme and adds AJAX functionality to the comment form.
Author: Jan Jonas
Author URI: http://janjonas.net
Version: 0.0.2
License: GPLv2
Text Domain:
*/

/*  Copyright 2012, Jan Jonas, (email : mail@janjonas.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.


*/

if ( !function_exists( 'wpac_initialize' ) ) :

	// Option names
	define('WPAC_OPTION_NAME_SELECTOR_COMMENT_FORM', 'wpac_selectorCommentForm');
	define('WPAC_OPTION_NAME_SELECTOR_COMMENTS_CONTAINER', 'wpac_selectorCommentsContainer');

	// Option defaults
	define('WPAC_OPTION_DEFAULTS_SELECTOR_COMMENT_FORM', '#commentsubmit');
	define('WPAC_OPTION_DEFAULTS_SELECTOR_COMMENTS_CONTAINER', '#comments');

	/**
	 * Outputs script to load comments via ajax
	 * @return string Javascript html
	 */
	function wpac_initialize() {
			echo '<script type="text/javascript">
			var wpac_options = {
				debug: '.('false').',
				selectorCommentForm: "'.(WPAC_OPTION_DEFAULTS_SELECTOR_COMMENT_FORM).'",
				selectorCommentsContainer: "'.(WPAC_OPTION_DEFAULTS_SELECTOR_COMMENTS_CONTAINER).'",
				textLoading: "<img src='. get_template_directory_uri() .'/images/loading-dark.gif>",
				textPosted: "<img src='. get_template_directory_uri() .'/images/check-mark.png>",
				popupCornerRadius: 5
			};
		   </script>';
	}

	function wpac_is_login_page() {
	    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
	}

	if (!is_admin() && !wpac_is_login_page()) {
			add_action('wp_head', 'wpac_initialize');
	}

endif;


if ( !function_exists( 'ag_fullscreen_bg' ) ) :

	/**
	 * Function to display the fullpage background image
	 *
	 * @param  string $pageimage Image to display
	 *
	 * @return string            Html to output image
	 */

	function ag_fullscreen_bg($pageimage) {

		echo '<div class="lines"></div><style type="text/css"> #thumb-tray, .playcontrols, #slidecounter, #tray-button, #progress-back { display:none !important;} </style>';

		if($pageimage != '') {
			echo '<script type="text/javascript">
					jQuery(function($){
						$.supersized({
							min_width		        :   0,			// Min width allowed (in pixels)
							min_height		        :   0,			// Min height allowed (in pixels)
							vertical_center         :   1,			// Vertically center background
							horizontal_center       :   1,			// Horizontally center background
							fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
							fit_portrait         	:   0,			// Portrait images will not exceed browser height
							fit_landscape			:   0,			// Landscape images will not exceed browser width
							slides  :  	[ {image : "'.$pageimage.'"} ]
						});
					});

				</script> ';
		}  else {

			echo '
			<script>
				jQuery(document).ready(function($) {
					$("#supersized-loader").css("display", "none");		//Hide loading animation
				});
			</script>';

		}
	}

endif;

//functions tell whether there are previous or next 'pages' from the current page
//returns 0 if no 'page' exists, returns a number > 0 if 'page' does exist
//ob_ functions are used to suppress the previous_posts_link() and next_posts_link() from printing their output to the screen
if ( !function_exists( 'has_previous_posts' ) ) :
	function has_previous_posts() {
		ob_start();
		previous_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}
endif;

if ( !function_exists( 'has_next_posts' ) ) :
	function has_next_posts() {
		ob_start();
		next_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}
endif;

// Add button class to prev/next post links
if ( !function_exists( 'posts_link_attributes' ) ) :
	function posts_link_attributes() {
	    return 'class="button"';
	}
	add_filter('next_posts_link_attributes', 'posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'posts_link_attributes');
endif;

if ( !function_exists( 'ag_is_default' ) ) :
	/**
	 * Function to check for default fonts
	 *
	 * @param  string $font Selected font
	 *
	 * @return string Return a google font so default
	 *                fonts aren't trying to be loaded by google
	 */
	function ag_is_default($font) {
		if ($font == 'Arial' || $font == 'Georgia' || $font == 'Tahoma' || $font == 'Verdana' || $font == 'Helvetica') {
			$font = 'Droid Sans';
		}
		return $font;
	}
endif;

/**
 * Include Updater script
 */
include("functions/theme-updater.php");

/**
 * Get Username and API Key from Theme Options
 */
$username = of_get_option('of_tf_username');
$api = of_get_option('of_tf_api');

if ($username && $username != '') {
    define('THEMEFOREST_USERNAME',$username);
}
if ($api && $api != '') {
    define('THEMEFOREST_APIKEY', $api);
}
?>