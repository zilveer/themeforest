<?php

include_once 'MetaBox.php';
 
include_once 'MediaAccess.php';
 
// include css to help style our custom meta boxes
add_action( 'init', 'my_metabox_styles' );
 
function my_metabox_styles()
{
    if ( is_admin() )
    {
        wp_enqueue_style( 'wpalchemy-metabox', get_stylesheet_directory_uri() . '/functions/media-uploader/meta.css' );
    }
}
 
$wpalchemy_media_access = new WPAlchemy_MediaAccess();