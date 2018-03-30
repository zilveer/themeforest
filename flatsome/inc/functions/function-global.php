<?php

// Get Flatsome Options
function flatsome_option($option) {
	// Get options
	return get_theme_mod( $option, flatsome_defaults($option) );
}

function flatsome_dummy_image(){
  return get_template_directory_uri().'/assets/img/missing.jpg';
}


/* Check if WooCommerce is Active */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}


/* Check WooCommerce Version */
if( ! function_exists('woocommerce_version_check') ){
	function woocommerce_version_check( $version = '2.6' ) {
	  if ( function_exists( 'is_woocommerce_active' ) && is_woocommerce_active() ) {
	    global $woocommerce;
	    if( version_compare( $woocommerce->version, $version, ">=" ) ) {
	      return true;
	    }
	  }
	  return false;
	}
}

/* Check if Extensions Exists */
if ( ! function_exists( 'is_extension_activated' ) ) {
	function is_extension_activated( $extension ) {
		return class_exists( $extension ) ? true : false;
	}
}

/* Get Site URL shortcode */
function flatsome_site_path(){
  return site_url();
}
add_shortcode('site_url', 'flatsome_site_path');
add_shortcode('site_url_secure', 'flatsome_site_path');


/* Get Year */
function ux_show_current_year(){
    return date('Y');
}
add_shortcode('ux_current_year', 'ux_show_current_year');

function flatsome_get_post_type_items($post_type, $args_extended=array()) {
  global $post;
  $old_post = $post;
  $return = false;

  $args = array(
    'post_type'=>$post_type
    , 'post_status'=>'publish'
    , 'showposts'=>-1
    , 'order'=>'ASC'
    , 'orderby'=>'title'
  );

  if ($args && count($args_extended)) {
    $args = array_merge($args, $args_extended);
  }

  query_posts($args);

  if (have_posts()) {
    global $post;
    $return = array();

    while (have_posts()) {
      the_post();
      $return[get_the_ID()] = $post;
    }
  }

  wp_reset_query();
  $post = $old_post;

  return $return;   
}
