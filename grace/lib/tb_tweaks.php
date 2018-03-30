<?php

// number of post revisions
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 5);

// add border to content images
add_filter('get_image_tag_class', 'tb_imageBorder');
function tb_imageBorder($class){
	$class = $class.' imageBorder';
	return $class;
}

/*-----------------------------------------------------------------------------------*/
/* VIMEO OEMBED
/*-----------------------------------------------------------------------------------*/
add_action('init', 'add_vimeo_oembed_correctly');
function add_vimeo_oembed_correctly() {
    wp_oembed_add_provider( '#http://(www\.)?vimeo\.com/.*#i', 'http://vimeo.com/api/oembed.{format}', true );
}

/*-----------------------------------------------------------------------------------*/
/* ENABLE SHORTCODES IN WIDGETS
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/* OVERRIDE DEFAULT FILTER FOR 'TEXTAREA' SANITIZATION
/*-----------------------------------------------------------------------------------*/
add_action('admin_init','optionscheck_change_santiziation', 100);
 
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'st_custom_sanitize_textarea' );
}

function st_custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
    	$custom_allowedtags["script"] = array();
    	$custom_allowedtags["a"] = array('href' => array(),'title' => array());
    	$custom_allowedtags["img"] = array('src' => array(),'title' => array(),'alt' => array());
    	$custom_allowedtags["br"] = array();
    	$custom_allowedtags["em"] = array();
    	$custom_allowedtags["strong"] = array();
      	$custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      	$output = wp_kses( $input, $custom_allowedtags);
    return $output;
        $of_custom_allowedtags = array_merge($of_custom_allowedtags, $allowedtags);
        $output = wp_kses( $input, $of_custom_allowedtags);
    return $output;
}

/*-----------------------------------------------------------------------------------*/
/* WORDPRESS GALLERY - REMOVE INLINE STYLES
/*-----------------------------------------------------------------------------------*/
add_filter( 'use_default_gallery_style', '__return_false' );


/*-----------------------------------------------------------------------------------*/
/* YOUTUBE OEMBED - TRANSPARENT WMODE - Jan Dembowski - http://pastebin.com/jKP4xABd
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_content' , 'mh_youtube_wmode' , 15 );
function mh_youtube_wmode( $content ) {

// Regex to find all <ifram ... > YouTube tags
$mh_youtube_regex = "/\<iframe .*youtube\.com.*><\/iframe>/";

// Populate the results into an array
preg_match_all( $mh_youtube_regex , $content, $mh_matches );

// If we get any hits then put the update the results
if ( $mh_matches ) {;
	for ( $mh_count = 0; $mh_count < count( $mh_matches[0] ); $mh_count++ )
		{
		// Old YouTube iframe
		$mh_old = $mh_matches[0][$mh_count];

		$mh_new = str_replace( "?feature=oembed" , "?wmode=transparent" , $mh_old );
		$mh_new = preg_replace( '/\><\/iframe>$/' , ' wmode="Opaque"></iframe>' , $mh_new );

		// make the substitution
		$content = str_replace( $mh_old, $mh_new , $content );
		}
	}
return $content;
}

/*
function th_default_widgets_init() {	

  if ( isset( $_GET['activated'] ) ) {
  
  		update_option( 'sidebars_widgets', array (
							 'default-sidebar' => array('search')
							 ));
  }
}
add_action('widgets_init', 'th_default_widgets_init');


// CUSTOM ADMIN LOGIN HEADER LOGO
function th_custom_login_logo()
{
	if (get_option(SHORTNAME . "_customcolor") != '')
	{
		$customcolor = get_option(SHORTNAME . "_customcolor");
	}
	else
	{
		$customcolor = "#00a0c6";
	}
	echo '<style type="text/css"> h1 a { background-image:url(' . get_template_directory_uri() . '/images/logo.png) !important;background-size:auto !important } body {background-color:' . $customcolor . ' !important } #nav a, #backtoblog a {background:#fff;}</style>';
	$customcolor = NULL;
}
*/

?>