<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
                              
yit_register_portfolio_style(  $portfolio_type, 'portfolio-' . $portfolio_type, 'css/style.css' );
yit_register_portfolio_script(  $portfolio_type, 'jquery-yit_pagination', YIT_CORE_ASSETS_URL . '/js/yit/jquery.yit_pagination.js' );
yit_register_portfolio_script(  $portfolio_type, 'jquery-imagesLoaded', YIT_THEME_JS_URL . '/jquery.imagesLoaded.js');
yit_register_portfolio_script(  $portfolio_type, 'jquery-yit_portfolio_thumbs', 'js/jquery.yit_portfolio_thumbs.js' );

// add the image size
yit_add_image_size( 'thumb_small_portfolio_thumbs', 60, 60, true );
yit_add_image_size( 'thumb_medium_portfolio_thumbs', 437, 261, true );
 
// add the slider fields for the admin
yit_add_portfolio_config( $portfolio_type, array(
	array(
        'name' => __( 'Enable lightbox icon', 'yit' ),
        'id' => 'event_lightbox',
        'type' => 'onoff',
        'desc' => __( 'Enable lightbox icon on projects image.', 'yit' ),
	),
) );

yit_add_portfolio_config( $portfolio_type, array(
	array(
        'name' => __( 'Thumbs title', 'yit' ),
        'id' => 'thumbs_title',
        'type' => 'text',
        'desc' => '',
	),
) );

yit_add_portfolio_config( $portfolio_type, array(
	array(
        'name' => __( 'Project description title', 'yit' ),
        'id' => 'project_description_title',
        'type' => 'text',
        'desc' => '',
	),
) );