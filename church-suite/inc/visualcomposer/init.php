<?php
if (class_exists('WPBakeryVisualComposerAbstract')) {
	$path =  get_template_directory() . '/inc/visualcomposer/';
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
	wp_deregister_style('flexslider');
	wp_dequeue_style('flexslider');
	wp_deregister_script('flexslider');
	wp_dequeue_script('flexslider');
	wp_deregister_style('js_composer_front');
	wp_dequeue_style('js_composer_front');
	wp_deregister_style('js_composer_custom_css');
	wp_dequeue_style('js_composer_custom_css');
}
add_action('wp_enqueue_scripts', 'webnus_setup_assets');
function webnus_setup_admin_assets(){
	wp_register_style( 'webnus_js_composer', get_template_directory_uri() .'/inc/visualcomposer/assets/webnus_js_composer.css', false, false, false );
	wp_enqueue_style('webnus_js_composer');
	wp_deregister_style('font-awesome');
	wp_enqueue_style( 'font-awesome' );
}
add_action('admin_enqueue_scripts','webnus_setup_admin_assets');
?>