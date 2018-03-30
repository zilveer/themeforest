<?php
$config  = array(
  'title' => sprintf( '%s News Post Options', THEME_NAME ),
  'id' => 'mk-metaboxes-news',
  'pages' => array(
    'news'
  ),
  'callback' => '',
  'context' => 'normal',
  'priority' => 'core'
);
$options = array(

  array(
    "name" => __( "Post Style", "mk_framework" ),
    "desc" => __( "Please choose post style how they will look in news post loop.", "mk_framework" ),
    "id" => "_news_post_style",
    "default" => 'full-with-image',
    "preview" => false,
    "options" => array(
        "full-with-image" => __( "Full With Image", "mk_framework" ),
        "full-without-image" => __( "Full Without Image", "mk_framework" ),
        "half-with-image" => __( "Half With Image", "mk_framework" ),
        "half-without-image" => __( "Half Without Image", "mk_framework" ),
        "fourth-with-image" => __( "One Fourth With Image", "mk_framework" ),
        "fourth-without-image" => __( "One Fourth Without Image", "mk_framework" ),
    ),
    "type" => "select"
  ),

);
new mkMetaboxesGenerator( $config, $options );
