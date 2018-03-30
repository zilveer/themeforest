<?php

/*--------------------------------------------------------------------------
  Load Required Files
/*------------------------------------------------------------------------*/

# Core Functions. Acorn Class
require_once( 'theme/acorn.php' );

# Fast Template Engine. ATemplate Class.
require_once( 'theme/template.php' );

# Theme Options. AAdmin, extends Acorn.
require_once( 'theme/admin.php' );
require_once( 'theme/admin.options.php' );

# Basic Theme Setup. ASetup, extends Acorn.
require_once( 'theme/setup.php' );

# Custom Posts & Taxonomies. AExtend, extends Acorn.
require_once( 'theme/extend.php' );

# Dynamic & Editor Styles. AStyles, extends Acorn.
require_once( 'theme/styles.php' );

# Metaboxes. AMetabox, extends Acorn.
require_once( 'theme/metabox.php' );

# Theme Metaboxes, extends AShortcode.
require_once( 'theme/metabox.page.php' );
// require_once( 'theme/metabox.post.php' );
require_once( 'theme/metabox.work.php' );

# Shortcode Manager. AShortcodeManager, extends Acorn.
require_once( 'theme/shortcode.manager.php' );

# Shortcodes. AShortcode, extends Acorn.
require_once( 'theme/shortcode.php' );

# Theme Shortcodes, extends AShortcode.
require_once( 'theme/shortcode.contact.php' );
require_once( 'theme/shortcode.theme.php' );

# Core Widget Class. AWidget, extends WP_Widget.
// require_once( 'theme/widget.php' );

# Theme Widgets, extends AWidget.
// require_once( 'theme/widget.contact.php' );
// require_once( 'theme/widget.dribbble.php' );
// require_once( 'theme/widget.flickr.php' );
// require_once( 'theme/widget.video.php' );


/*--------------------------------------------------------------------------
  Custom Theme Files
/*------------------------------------------------------------------------*/

require_once( 'single-item.functions.php' );

/*--------------------------------------------------------------------------
  Register 3rd-party resources
/*------------------------------------------------------------------------*/

function a_register_3rd_resources () {

  wp_register_script( 'fitvids', A_3RD_URL .'/fitvids.js', array('jquery'), null, true );

  // wp_register_script( 'custom', A_3RD_URL .'/lightbox/custom.js' );
  // wp_register_style( 'custom', A_3RD_URL .'/lightbox/custom.css' );
}

add_action( 'init', 'a_register_3rd_resources' );


/*--------------------------------------------------------------------------
  Enqueue 3rd-party resources
/*------------------------------------------------------------------------*/

function a_print_3rd_scripts () {

  wp_enqueue_script( 'fitvids' );

  // if ( isCustom() ) wp_enqueue_script( 'custom' );
}

function a_print_3rd_styles () {
  
  // if ( isCustom() ) wp_enqueue_style( 'custom' );
}

add_action( 'wp_enqueue_scripts', 'a_print_3rd_scripts' );
add_action( 'wp_enqueue_scripts', 'a_print_3rd_styles' );


/*--------------------------------------------------------------------------
  Add Body Classes
/*------------------------------------------------------------------------*/

function a_body_class ($classes) {
  
  // $classes[] = Acorn::get('layout');
  if (is_page_template('template-portfolio.php') || is_tax()) $classes[] = 'folio';

  return $classes;
}

add_filter( 'body_class', 'a_body_class' );


/*--------------------------------------------------------------------------
  Add Tracking Code
/*------------------------------------------------------------------------*/

function a_tracking_code () {
  if ( $code = Acorn::get('tracking') )
    echo "\n<script>\n". stripslashes($code) ."\n</script>\n";
}

add_action( 'wp_footer', 'a_tracking_code' );


/*--------------------------------------------------------------------------
  Default Content
/*------------------------------------------------------------------------*/

function a_default_content( $content, $post ) {

  if ($post->post_type == 'page')
    $content = __("To recreate a special page, please consider: \n\n* Page Attributes &rarr; Template option as a place to look for custom templates \n\n* Shortcode Manager as a tool to insert special page content or other helpful examples", A_DOMAIN);

  if ($post->post_type == 'item')
    $content = __("Use Shortcode Manager (magic wand icon) as a tool to insert sample content for this work.", A_DOMAIN);

  return $content;
}

add_filter( 'default_content', 'a_default_content', 10, 2 );


/*--------------------------------------------------------------------------
  Fitvids-enable Responsive Video Embeds
/*------------------------------------------------------------------------*/

function a_fitvids_embeds($html) {
  $video =
    strpos($html, 'youtube.com') ||
    strpos($html, 'vimeo.com') ||
    strpos($html, 'blip.tv') ||
    strpos($html, 'viddler.com');
  if ($video !== false) {
    return "<div class='media-container fullwrap'>{$html}</div><div class='clear'></div>\n";
  }
  return $html;
}

add_filter( 'oembed_result', 'a_fitvids_embeds' ); // cached, else use 'embed_oembed_html'


/*--------------------------------------------------------------------------
  Custom Read More Button
/*------------------------------------------------------------------------*/

function a_the_content_more_link($html) {
  if (false)
    $html = str_replace('more-link', 'more-link classic button', $html);
  return $html;
}

add_filter( 'the_content_more_link', 'a_the_content_more_link' );


/*--------------------------------------------------------------------------
  Custom Content Width
/*------------------------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 923;

/*--------------------------------------------------------------------------
  Tune Theme Widgets
/*------------------------------------------------------------------------*/

function a_tune_widgets() {
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Search');
}

add_action( 'widgets_init', 'a_tune_widgets' );
