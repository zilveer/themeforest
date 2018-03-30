<?php

/* ---------------------------------------------------------*/
/* REGISTER CORE STYLESHEETS */
/* ---------------------------------------------------------*/
function mythology_core_register_styles() {
	if(!is_admin()){	

        wp_enqueue_style( 'mythology-style', get_stylesheet_uri() ); 

        wp_register_style ( 'foundation', get_template_directory_uri() . '/mythology-core/core-assets/stylesheets/core-1-foundation.css' );
        wp_enqueue_style( 'foundation' );

        wp_register_style ( 'skeleton', get_template_directory_uri() . '/mythology-core/core-assets/stylesheets/core-2-skeleton.css' );
        wp_enqueue_style( 'skeleton' );

        wp_register_style ( 'structure', get_template_directory_uri() . '/mythology-core/core-assets/stylesheets/core-3-structure.css' );
        wp_enqueue_style( 'structure' );

        wp_register_style ( 'superfish', get_template_directory_uri() . '/mythology-core/core-assets/stylesheets/core-4-superfish.css' );
        wp_enqueue_style( 'superfish' );

        wp_register_style ( 'ajaxy', get_template_directory_uri() . '/mythology-core/core-assets/stylesheets/core-5-ajaxy.css' );
        wp_enqueue_style( 'ajaxy' );

        wp_register_style ( 'comments', get_template_directory_uri() . '/mythology-core/core-assets/stylesheets/core-6-comments.css' );
        wp_enqueue_style( 'comments' );

        wp_register_style ( 'plugins', get_template_directory_uri() . '/mythology-core/core-assets/stylesheets/core-7-plugins.css' );
        wp_enqueue_style( 'plugins' );

        wp_register_style ( 'media-queries', get_template_directory_uri() . '/mythology-core/core-assets/stylesheets/core-8-media-queries.css' );
        wp_enqueue_style( 'media-queries' );

    }
}
add_action('wp_enqueue_scripts', 'mythology_core_register_styles'); /* Run the above function at the init() hook */

?>