<?php

function theme_styles() {
	if (!is_admin()) {
		wp_register_style( 'shortcodes', get_template_directory_uri() . '/css/shortcodes.css' );
		wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css' );
		wp_enqueue_style( 'shortcodes' );
		wp_enqueue_style( 'prettyPhoto' );
	}
}
add_action('wp_print_styles', 'theme_styles');
							
?>