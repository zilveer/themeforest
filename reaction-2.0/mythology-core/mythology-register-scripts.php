<?php

/* ---------------------------------------------------------*/
/* REGISTER CORE SCRIPTS */
/* ---------------------------------------------------------*/
function mythology_core_register_scripts() {
	if(!is_admin()){

    	wp_enqueue_script( 'jquery' );

        // HTML5SHIV
        wp_register_script( 'HTML5Shiv', get_template_directory_uri() . '/mythology-core/core-assets/javascripts/html5shiv.js', false, null, true);
        wp_enqueue_script( 'HTML5Shiv' );

        // REM POLYFILL
        wp_register_script( 'REM', get_template_directory_uri() . '/mythology-core/core-assets/javascripts/rem.min.js', false, null, true);
        wp_enqueue_script( 'REM' );  

        // FITVIDS
        wp_register_script( 'FitVids', get_template_directory_uri() . '/mythology-core/core-assets/javascripts/fitvids.js', false, null, true);
        wp_enqueue_script( 'FitVids' );
    	
    	//Dropdown Menu
        wp_deregister_script('hoverIntent');
    	wp_register_script( 'HoverIntent', get_template_directory_uri() . '/mythology-core/core-assets/javascripts/superfish/jquery.hoverIntent.js', false, null, true);
    	wp_enqueue_script( 'HoverIntent' );	
    	
    	wp_register_script( 'Superfish', get_template_directory_uri() . '/mythology-core/core-assets/javascripts/superfish/superfish.js', false, null, true);
    	wp_enqueue_script( 'Superfish' );
	
		wp_register_script( 'SuperSubs', get_template_directory_uri() . '/mythology-core/core-assets/javascripts/superfish/supersubs.js', false, null, true);
    	wp_enqueue_script( 'SuperSubs' );     
		
    }
}
add_action('wp_enqueue_scripts', 'mythology_core_register_scripts');

?>