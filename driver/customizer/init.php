<?php

/*
 * Enqueue Customizer Styles
 */
function iron_enqueue_customizer_styles() {

	if(is_admin() || iron_is_login_page())
		return -1;

	wp_enqueue_style('customizer', IRON_PARENT_URL.'/customizer/css/style.css', false ,'0.90', 'all' );

}
add_action('wp_enqueue_scripts', 'iron_enqueue_customizer_styles');

/*
 * Enqueue Customizer Scripts
 */
function iron_enqueue_customizer_scripts() {

	if(is_admin() || iron_is_login_page())
		return -1;

	wp_enqueue_script('iron_customizer', IRON_PARENT_URL.'/customizer/js/init.js', array('jquery'), null, true);

	wp_localize_script('iron_customizer', 'customizer_vars', array(
		'theme_url' => IRON_PARENT_URL,
		'ajaxurl' => admin_url('admin-ajax.php'),
	));

}
add_action('wp_enqueue_scripts', 'iron_enqueue_customizer_scripts');