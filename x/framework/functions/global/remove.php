<?php

// =============================================================================
// FUNCTIONS/GLOBAL/REMOVE.PHP
// -----------------------------------------------------------------------------
// Remove various bits of markup and styling from WordPress.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Remove Tag Cloud Inline Style
//   02. Remove Recent Comments Style
//   03. Remove Gallery Style
//   04. Remove Gallery <br> Tags
// =============================================================================

// Remove Tag Cloud Inline Style
// =============================================================================

if ( ! function_exists( 'x_remove_tag_cloud_inline_style' ) ) :
  function x_remove_tag_cloud_inline_style( $tag_string ) {
    return preg_replace( "/style='font-size:.+pt;'/", '', $tag_string );
  }
  add_filter( 'wp_generate_tag_cloud', 'x_remove_tag_cloud_inline_style' );
endif;



// Remove Recent Comments Style
// =============================================================================

if ( ! function_exists( 'x_remove_recent_comments_style' ) ) :
  function x_remove_recent_comments_style() {  
    GLOBAL $wp_widget_factory;  
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
  }  
  add_action( 'widgets_init', 'x_remove_recent_comments_style' );
endif;



// Remove Gallery Style
// =============================================================================

if ( ! function_exists( 'x_remove_gallery_style' ) ) :
  function x_remove_gallery_style() {
    add_filter( 'use_default_gallery_style', '__return_false' );
  }  
  add_action( 'init', 'x_remove_gallery_style' );
endif;



// Remove Gallery <br> Tags
// =============================================================================

if ( ! function_exists( 'x_remove_gallery_br_tags' ) ) :
  function x_remove_gallery_br_tags( $output ) {
    return preg_replace( '/<br style=(.*?)>/mi', '', $output );
  }
  add_filter( 'the_content', 'x_remove_gallery_br_tags', 11, 2 );
endif;