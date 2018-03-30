<?php

function lip_front_end_js() {
	wp_enqueue_script('love-it', get_template_directory_uri() . '/includes/plugins/love-it-pro/includes/js/love-it.js', array( 'jquery' ), NULL, TRUE );
	if(!is_user_logged_in()) {
		wp_enqueue_script( 'jquery-coookies', get_template_directory_uri() . '/includes/plugins/love-it-pro/includes/js/jquery.cookie.js', array( 'jquery' ), NULL, TRUE );
	}
	wp_localize_script( 'love-it', 'love_it_vars', 
		array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('love-it-nonce'),
			'already_loved_message' => __('You have already loved this item.', 'swiftframework'),
			'error_message' => __('Sorry, there was a problem processing your request.', 'swiftframework'),
			'logged_in' => is_user_logged_in() ? 'true' : 'false'
		) 
	);	
}
add_action('wp_enqueue_scripts', 'lip_front_end_js');

function lip_custom_css() {
	global $lip_options;
	if(isset($lip_options['custom_css']) && $lip_options['custom_css'] != '') {
		echo '<style type="text/css">' . $lip_options['custom_css'] . '</style>';
	}
}
add_action('wp_head', 'lip_custom_css');