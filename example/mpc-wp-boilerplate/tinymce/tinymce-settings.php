<?php

/*-----------------------------------------------------------------------------------*/
/*	Constants
/*-----------------------------------------------------------------------------------*/
	
define('MPC_TINYMCE_PATH', get_template_directory() . '/mpc-wp-boilerplate/tinymce');
define('MPC_TINYMCE_URI', get_template_directory_uri() . '/mpc-wp-boilerplate/tinymce');


/*-----------------------------------------------------------------------------------*/
/*	Hooks
/*-----------------------------------------------------------------------------------*/

add_action('admin_init', 'tinymce_enqueue');					// enqueue scripts
add_action('init', 'tinymce_register_buttons');				// register buttons


/*-----------------------------------------------------------------------------------*/
/*	Functions
/*-----------------------------------------------------------------------------------*/
 
/* Enqueue Scripts */
function tinymce_enqueue() {
	/* MPC custom JS/CSS */
	wp_enqueue_style('mpc-win', MPC_TINYMCE_URI . '/css/mpc-win.css');
	wp_enqueue_style('shortcodes-style', MPC_TINYMCE_URI.'/../css/shortcodes.css');
	
	/* Libraries */
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-livequery', MPC_TINYMCE_URI . '/js/jquery.livequery.js', false);
	wp_enqueue_script('jquery-appendo', MPC_TINYMCE_URI . '/js/jquery.appendo.js', false);
	wp_enqueue_script('base64', MPC_TINYMCE_URI . '/js/base64.js', false);
	wp_enqueue_script('mpc-win', MPC_TINYMCE_URI . '/js/mpc-win.js', false);
	wp_enqueue_script('shortcodes-js', MPC_TINYMCE_URI . '/../js/mpcth-shortcodes.js', false);

	/* Localize */
	wp_localize_script('mpc-win', 'mpcthLocalize', array(
		'listAlert' => __('Woah there turbo, you need at least one element.', 'mpcth'),
	) );
}
	
/* Register TinyMCE Button*/
function tinymce_register_buttons(){
	if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
		if (get_user_option('rich_editing') == 'true'){
			add_filter('mce_external_plugins', 'mpc_add_plugin');
			add_filter('mce_buttons', 'mpc_add_button');
		}
	}
}
		
/* Main.js adds the button and other stuff to the post editor */
function mpc_add_plugin($array){
	$array['mpc_sh'] = MPC_TINYMCE_URI . '/main.js';
	return $array;
}
	
/* Adds button */
function mpc_add_button( $buttons ){
	array_push( $buttons, 'mpc_sh_button' ); // you can choose bettwen diferent icons here bold, italic, image ect.
	//var_dump( $buttons);
	return $buttons;
}
									
?>