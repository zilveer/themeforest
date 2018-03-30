<?php
$config  = array(
  'title' => sprintf( '%s Photo Album Options', THEME_NAME ),
  'id' => 'mk-metaboxes-gallery',
  'pages' => array(
    'photo_album'
  ),
  'callback' => '',
  'context' => 'normal',
  'priority' => 'core'
);

$options = array(


  array(
    "name" => __( "Gallery Images", "mk_framework" ),
    "desc" => __( "You can re-arrange images by drag and drop as well as deleting images.", "mk_framework" ),
    "id" => "_gallery_images",
    "default" => '',
    "type" => "gallery"
  ),

  array(
    "name" => __( "Short Description", "mk_framework" ),
    "desc" => __( "", "mk_framework" ),
    "id" => "_desc",
    "default" => '',
    "type" => "textarea"
  ),


);
new mkMetaboxesGenerator( $config, $options );
