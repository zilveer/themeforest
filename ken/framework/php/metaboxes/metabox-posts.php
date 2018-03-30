<?php

$config  = array(
  'title' => sprintf( '%s Posts Options', THEME_NAME ),
  'id' => 'mk-metaboxes-tabs',
  'pages' => array(
    'post'
  ),
  'callback' => '',
  'context' => 'normal',
  'priority' => 'core'
);
$options = array(

  array(
    "name" => __( "Page Elements", "mk_framework" ),
    "subtitle" => __( "", "mk_framework" ),
      "desc" => __( "Depending on your need you can change this page's general layout", "mk_framework" ),
    "id" => "_template",
    "default" => '',
    "placeholder" => 'true',
    "width" => 400,
    "options" => array(
          "no-header" => __('Remove Header', "mk_framework"),
          "no-title" => __('Remove Page Title', "mk_framework"),
          "no-header-title" => __('Remove Header & Page Title', "mk_framework"),
          "no-title-footer" => __('Remove Page Title & Footer', "mk_framework"),
          "no-title-sub-footer" => __('Remove Page Title & Sub Footer', "mk_framework"),
          "no-title-footer-sub-footer" => __('Remove Page Title & Footer & Sub Footer', "mk_framework"),
          "no-footer-only" => __('Remove Footer', "mk_framework"),
          "no-sub-footer" => __('Remove Sub Footer', "mk_framework"),
          "no-footer" => __('Remove Footer & Sub Footer', "mk_framework"),
          "no-footer-title" => __('Remove Footer & Page Title', "mk_framework"),
          "no-sub-footer-title" => __('Remove Footer & Sub Footer & Page Title', "mk_framework"),
          "no-header-footer" => __('Remove Header & Footer & Sub Footer', "mk_framework"),
          "no-header-title-only-footer" => __('Remove Header & Page Title & Footer', "mk_framework"),
          "no-header-title-footer" => __('Remove Header & Page Title & Footer & Sub Footer', "mk_framework")
    ),
    "type" => "select"
  ),

  array(
    "name" => __("Stick Template?", "mk_framework" ),
        "subtitle" => __( "If enabled this option page will have no padding after header and before footer.", "mk_framework" ),
    "desc" => __( "Use this option if you need to use header slideshow or use a callout box before footer.", "mk_framework" ),
    "id" => "_padding",
    "default" => 'false',
    "type" => "toggle"
  ),
  array(
      "name" => __("Header Toolbar?", "mk_framework"),
      "subtitle" => __("", "mk_framework"),
      "desc" => __("", "mk_framework"),
      "id" => "_header_toolbar",
      "default" => 'true',
      "type" => "toggle"
  ),

  array(
    "name" => __("Featured Image?", "mk_framework" ),
    "subtitle" => __( "", "mk_framework" ),
    "desc" => __( "If you do not want to set a featured image (in case of sound post type : Audio player, in case of video post type : Video Player) kindly disable it here.", "mk_framework" ),
    "id" => "_featured_image",
    "default" => 'true',
    "type" => "toggle"
  ),

  array(
    "name" => __("Show Meta?", "mk_framework" ),
    "subtitle" => __( "", "mk_framework" ),
    "desc" => __( "If you do not want to set a metabox kindly disable it here.", "mk_framework" ),
    "id" => "_meta",
    "default" => 'true',
    "type" => "toggle"
  ),

  array(
    "name" => __( "Gallery Images", "mk_framework" ),
    "subtitle" => __( "Add Images for the gallery post type", "mk_framework" ),
    "desc" => __( "You can re-arrange images by drag and drop as well as deleting images.", "mk_framework" ),
    "id" => "_gallery_images",
    "default" => '',
    "type" => "gallery"
  ),

  array(
    "name" => __( "Video URL", "mk_framework" ),
    "subtitle" => __( "URL to the video site to feed from.", "mk_framework" ),
    "desc" => __( "Examples:<br />http://www.youtube.com/watch?v=g6gu798<br />https://vimeo.com/s8j6g7v<br />http://www.dailymotion.com/embed/video/g8ju87", "mk_framework" ),
    "id" => "_video_url",
    "type" => "text"
  ),

  array(
    "name" => __( "Upload MP3 File", "mk_framework" ),
    "desc" => __( "Upload MP3 your file or paste the full URL for external files. This file formate needed for Safari, Internet Explorer, Chrome. ", "mk_framework" ),
    "id" => "_mp3_file",
    "preview" => false,
    "default" => "",
    "type" => "upload"
  ),

  array(
    "name" => __( "Upload OGG File", "mk_framework" ),
    "desc" => __( "Upload OGG your file or paste the full URL for external files. This file formate needed for Firefox, Opera, Chrome. ", "mk_framework" ),
    "id" => "_ogg_file",
    "preview" => false,
    "default" => "",
    "type" => "upload"
  ),

  array(
    "name" => __( "Soundcloud", "mk_framework" ),
    "desc" => __( "You can get both iframe or shortcode for wordpress from soundcould share=>embed popup. both formats are acceptable.", "mk_framework" ),
    "subtitle" => __( "Paste embed iframe or Wordpress shortcode.", "mk_framework" ),
    "id" => "_audio_iframe",
    "preview" => false,
    "default" => "",
    "type" => "textarea"
  )
);
new mk_metaboxesGenerator( $config, $options );
