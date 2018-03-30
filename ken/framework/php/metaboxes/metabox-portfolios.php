<?php

$config  = array(
  'title' => sprintf( '%s Portfolio Options', THEME_NAME ),
  'id' => 'mk-metaboxes-tabs',
  'pages' => array(
    'portfolio'
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
        "name" => __("Header Style", "mk_framework"),
        "subtitle" => __("Defines how header appear in top.", "mk_framework"),
        "desc" => __("", "mk_framework"),
        "id" => "_header_style",
        "default" => 'block',
        "placeholder" => 'true',
        "width" => 400,
        "options" => array(
            "block" => __('Block module', "mk_framework"),
            "transparent" => __('Transparent Layer', "mk_framework")
        ),
        "type" => "select"
    ),
    array(
        "name" => __("Transparent Header Style Skin", "mk_framework"),
        "subtitle" => __("", "mk_framework"),
        "desc" => __("", "mk_framework"),
        "id" => "_trans_header_skin",
        "default" => 'light',
        "placeholder" => 'false',
        "width" => 400,
        "options" => array(
            "light" => __('Light', "mk_framework"),
            "dark" => __('Dark', "mk_framework")
        ),
        "type" => "select"
    ),
    array(
        "name" => __("Transparent Header Style Sticky Scroll Offset", "mk_framework"),
        "subtitle" => __("", "mk_framework"),
        "desc" => __("zero means window height which is relative to the device screen height. any value bigger than 0 will set the sticky header to user defined value.", "mk_framework"),
        "id" => "_trans_header_offset",
        "default" => "120",
        "min" => "0",
        "max" => "5000",
        "step" => "1",
        "unit" => 'px',
        "type" => "range"
    ),
  array(
    "name" => __( "Portfolio Loop Overlay Logo", "mk_framework" ),
    "subtitle" => __( "Optionally you can upload a logo to appear on portfolio loop images.", "mk_framework" ),
    "desc" => __( "Its width should not be larger than 300px and height relative to the loop image heights. so try to adjust it as you need.", "mk_framework" ),
    "id" => "_portfolio_item_logo",
    "preview" => true,
    "default" => "",
    "type" => "upload"
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
    "name" => __( "Ajax Description", "mk_framework" ),
    "desc" => __( "You are allowed to use HTML tags as well as shortcodes.", "mk_framework" ),
    "subtitle" => __( "Short description for ajax content. This content will be shown if you have enabled ajax feature for your portfolio loop.", "mk_framework" ),
    "id" => "_portfolio_short_desc",
    "default" => '',
    "type" => "editor"
  ),



  array(
    "name" => __( "Masonry Image size", "mk_framework" ),
    "desc" => __( "Make your hand picked image sizes.", "mk_framework" ),
    "subtitle" => __( "Masonry loop style image size.", "mk_framework" ),
    "id" => "_masonry_img_size",
    "default" => 'two_x_two_x',
    "width" => 250,
    "options" => array(
      /*"regular" => 'Regular',
      "wide" => 'Wide',
      "tall" => 'Tall',
      "wide_tall" => 'Wide & Tall',*/
      "x_x" => __('X * X', 'mk_framework'),
      "two_x_x" => __('2X * X', 'mk_framework'),
      "three_x_x" => __('3X * X', 'mk_framework'),
      "four_x_x" => __('4X * X', 'mk_framework'),
      "x_two_x" => __('X * 2X', 'mk_framework'),
      "two_x_two_x" => __('2X * 2X (Regular)', 'mk_framework'),
      "two_x_four_x" => __('2X * 4X (Tall)', 'mk_framework'),
      "three_x_two_x" => __('3X * 2X', 'mk_framework'),
      "four_x_two_x" => __('4X * 2X (Wide)', 'mk_framework'),
      "four_x_four_x" => __('4X * 4X (Wide & Tall)', 'mk_framework'),
    ),
    "type" => "select"
  ),


  array(
    "name" => __( "Show Featured Image in Single Post?", "mk_framework" ),
    "desc" => __( "Please note that this option will disable featured image, video player (when video post type chosen) and gallery slideshow (when gallery post type chosen).", "mk_framework" ),
    "id" => "_single_featured",
    "default" => "true",
    "type" => "toggle"
  ),


  array(
    "name" => __( "Custom URL", "mk_framework" ),
    "desc" => __( "If you may choose to change the permalink to a page, post or external URL. If left empty the single post permalink will be used instead.", "mk_framework" ),
    "subtitle" => __( "External link other than the single post.", "mk_framework" ),
    "id" => "_portfolio_permalink",
    "default" => "",
    "type" => "superlink"
  ),

  array(
    "name" => __( "Previous & Next Arrows?", "mk_framework" ),
    "desc" => __( "Using this option you can turn on/off the navigation arrows when viewing the portfolio single page.", "mk_framework" ),
    "id" => "_portfolio_meta_next_prev",
    "default" => "true",
    "type" => "toggle"
  ),

  array(
    "name" => __( "Related Projects?", "mk_framework" ),
    "desc" => __( "", "mk_framework" ),
    "id" => "_portfolio_related_project",
    "default" => "true",
    "type" => "toggle"
  ),

);
new mk_metaboxesGenerator( $config, $options );
