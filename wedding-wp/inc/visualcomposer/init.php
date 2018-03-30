<?php

if (class_exists('WPBakeryVisualComposerAbstract')) {
	$path = dirname(__FILE__);
	$files = glob($path . '/shortcodes/*.php');
	
	foreach($files as $file)
		if( __FILE__ != basename($file) )
			include_once $file;
		
	$files = glob($path . '/setup/*.php');
	foreach($files as $file)
		if( __FILE__ != basename($file) )
			include_once $file;

}

function webnus_setup_assets(){
	
wp_deregister_style('prettyphoto');
wp_deregister_style('flexslider');
wp_dequeue_style('prettyphoto');
wp_dequeue_style('flexslider');


wp_deregister_script('prettyphoto');
wp_deregister_script('flexslider');
wp_dequeue_script('prettyphoto');
wp_dequeue_script('flexslider');


wp_deregister_style('js_composer_front');
wp_dequeue_style('js_composer_front');

wp_deregister_style('js_composer_custom_css');
wp_dequeue_style('js_composer_custom_css');



// wp_register_style( 'js_composer_front', get_template_directory_uri() .'/inc/visualcomposer/assets/js_composer_front.css' );
// wp_enqueue_style('js_composer_front');	

}

add_action('wp_enqueue_scripts', 'webnus_setup_assets');






function webnus_setup_admin_assets(){

//wp_deregister_style( 'js_composer');
//wp_dequeue_style('js_composer');		
	
wp_register_style( 'webnus_js_composer', get_template_directory_uri() .'/inc/visualcomposer/assets/webnus_js_composer.css', false, false, false );
wp_enqueue_style('webnus_js_composer');		
	
}



add_action('admin_enqueue_scripts','webnus_setup_admin_assets');




?>