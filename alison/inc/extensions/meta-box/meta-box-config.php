<?php

// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'gorilla_';

global $meta_boxes;

$meta_boxes = array();

/* Registered Sidebar Array List */

global $wp_registered_sidebars;

foreach($wp_registered_sidebars as $sidebar)
{
  if (strpos($sidebar['name'], 'Footer') === false) {
      $sidebars[$sidebar['id']] = $sidebar['name'];
  }
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


/*
*
* Metaboxes for Blog Post Types
*
*/

$meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box. Optional since 4.1.5
  'id' => 'gallery-options',

  // Meta box title - Will appear at the drag and drop handle bar. Required.
  'title' => __( 'Gallery Options', 'alison' ),

  // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
  'pages' => array( 'post' ),

  // Where the meta box appear: normal (default), advanced, side. Optional.
  'context' => 'normal',

  // Order of meta box: high (default), low. Optional.
  'priority' => 'high',

  // Auto save: true, false (default). Optional.
  'autosave' => true,

  // List of meta fields
  'fields' => array(
    array(
      'type' => 'heading',
      'name' => __( 'Gallery Layout', 'alison' ),
      'id'   => 'fake_id', // Not used but needed for plugin
    ),
    array(
      'name' => __( 'Select A Type', 'alison' ),
      'id'   => "{$prefix}gallery_layout",
      'type' => 'radio',
      'options' => array(
        '' => __( 'Slideshow', 'alison' ),
        'gallery-thumbnail' => __( 'Thumbnail Gallery', 'alison' )
      )
    ),
    array(
      'type' => 'heading',
      'name' => __( 'Images for That Gallery', 'alison' ),
      'id'   => 'fake_id', // Not used but needed for plugin
    ),
    array(
      'name' => '',
      'id'   => "{$prefix}post_gallery_images",
      'type' => 'image_advanced',
      'max_file_uploads' => 24,
    ),
    array(
      'name' => __( 'Row Height', 'alison' ),
      'id'   => "{$prefix}post_gallery_row_height",
      'type'  => 'number',
      'class' => 'gallery_thumb_row_height'
    )
  )
);

$meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box. Optional since 4.1.5
  'id' => 'video-options',

  // Meta box title - Will appear at the drag and drop handle bar. Required.
  'title' => __( 'Video Options', 'alison' ),

  // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
  'pages' => array( 'post' ),

  // Where the meta box appear: normal (default), advanced, side. Optional.
  'context' => 'normal',

  // Order of meta box: high (default), low. Optional.
  'priority' => 'high',

  // Auto save: true, false (default). Optional.
  'autosave' => true,

  // List of meta fields
  'fields' => array(
    array(
      'type' => 'heading',
      'name' => __( 'Video Types', 'alison' ),
      'id'   => 'fake_id' // Not used but needed for plugin
    ),
    array(
      'name' => __( 'Select A Video Type', 'alison' ),
      'id'   => "{$prefix}video_list",
      'type' => 'radio',
      // Options of checkboxes, in format 'value' => 'Label'
      'options' => array(
        'native' => __( 'HTML5 Native Video', 'alison' ),
        'embed' => __( 'Embed Video (Youtube, Vimeo etc)', 'alison' ),
      ),
      'std' => 'native'
    ),
    array(
      'type' => 'heading',
      'name' => __( 'HTML5 Native Video', 'alison' ),
      'id'   => 'fake_id', // Not used but needed for plugin
      'class'   => 'inner_heading'
    ),
    array(
      'name' => __( 'MP4 File Upload', 'alison' ),
      'id'   => "{$prefix}inner_video_file_mp4",
      'class' => 'video-file-wrapper',
      'type' => 'file_advanced',
      'max_file_uploads' => 1,
      'mime_type' => 'video/mp4' // Leave blank for all file types
    ),
    array(
      'name' => __( 'WEBM File Upload', 'alison' ),
      'id'   => "{$prefix}inner_video_file_webm",
      'class' => 'video-file-wrapper',
      'type' => 'file_advanced',
      'max_file_uploads' => 1,
      'mime_type' => 'video/webm' // Leave blank for all file types
    ),
    array(
      'name' => __( 'OGV File Upload', 'alison' ),
      'id'   => "{$prefix}inner_video_file_ogv",
      'class' => 'video-file-wrapper',
      'type' => 'file_advanced',
      'max_file_uploads' => 1,
      'mime_type' => 'video/ogg' // Leave blank for all file types
    ),
    // HEADING
    array(
      'type' => 'heading',
      'name' => __( 'Embed Video', 'alison' ),
      'id'   => 'fake_id', // Not used but needed for plugin
      'class'   => 'embed_heading'
    ),
    array(
      'name' => __( 'Embed Video URL', 'alison' ),
      'id'   => "{$prefix}embed_video_url",
      'class' => 'embed-video-wrapper',
      'type' => 'oembed'
    )
  )
);

$meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box. Optional since 4.1.5
  'id' => 'audio-options',

  // Meta box title - Will appear at the drag and drop handle bar. Required.
  'title' => __( 'Audio Options', 'alison' ),

  // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
  'pages' => array( 'post' ),

  // Where the meta box appear: normal (default), advanced, side. Optional.
  'context' => 'normal',

  // Order of meta box: high (default), low. Optional.
  'priority' => 'high',

  // Auto save: true, false (default). Optional.
  'autosave' => true,

  // List of meta fields
  'fields' => array(
    array(
      'type' => 'heading',
      'name' => __( 'Audio Types', 'alison' ),
      'id'   => 'fake_id', // Not used but needed for plugin
    ),
    array(
      'name' => __( 'Select An Audio Type', 'alison' ),
      'id'   => "{$prefix}audio_list",
      'type' => 'radio',
      // Options of checkboxes, in format 'value' => 'Label'
      'options' => array(
        'native' => __( 'HTML5 Native Audio', 'alison' ),
        'embed' => __( 'Embed Audio (SoundCloud etc.)', 'alison' ),
      ),
      'std' => 'native'
    ),
    array(
      'type' => 'heading',
      'name' => __( 'HTML5 Native Audio', 'alison' ),
      'id'   => 'fake_id', // Not used but needed for plugin
      'class'   => 'inner_heading'
    ),
    array(
      'type' => 'heading',
      'name' => __( 'Audio Properties', 'alison' ),
      'id'   => 'fake_id', // Not used but needed for plugin
      'class'   => 'inner_heading'
    ),
    array(
      'name' => __( 'Audio MP3 File Upload', 'alison' ),
      'id'   => "{$prefix}audio_mp3_file",
      'class' => 'audio-file-wrapper',
      'type' => 'file_advanced',
      'max_file_uploads' => 1,
      'mime_type' => 'audio/mpeg'
    ),
    array(
      'name' => __( 'Audio OGA File Upload', 'alison' ),
      'id'   => "{$prefix}audio_oga_file",
      'class' => 'audio-file-wrapper',
      'type' => 'file_advanced',
      'max_file_uploads' => 1,
      'mime_type' => 'audio/ogg'
    ),
    array(
      'type' => 'heading',
      'name' => __( 'Embed Audio', 'alison' ),
      'id'   => 'fake_id', // Not used but needed for plugin
      'class'   => 'embed_heading'
    ),
    array(
      'name' => __( 'Embed Audio URL', 'alison' ),
      'id'   => "{$prefix}embed_audio_url",
      'class' => 'embed-audio-wrapper',
      'type' => 'oembed'
    )
  )
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function gorilla_register_meta_boxes()
{
  // Make sure there's no errors when the plugin is deactivated or during upgrade
  if ( !class_exists( 'RW_Meta_Box' ) )
    return;

  global $meta_boxes;
  foreach ( $meta_boxes as $meta_box )
  {
    new RW_Meta_Box( $meta_box );
  }
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'gorilla_register_meta_boxes' );

