<?php
add_action( 'init', 'bold_buttons' );
if ( ! function_exists( 'bold_buttons' ) ) {
	function bold_buttons() {
		add_filter( 'mce_external_plugins', 'bold_add_buttons' );
		add_filter( 'mce_buttons_3', 'bold_register_buttons' );
		add_filter( 'mce_external_languages', 'add_tinymce_lang' );
	}
}
if ( ! function_exists( 'bold_add_buttons' ) ) {
	function bold_add_buttons( $plugin_array ) {
		$plugin_array['boldthemes'] = get_template_directory_uri() . '/editor-buttons/editor-buttons-plugin.js';
		return $plugin_array;
	}
}
if ( ! function_exists( 'bold_register_buttons' ) ) {
	function bold_register_buttons( $buttons ) {
		array_push( $buttons, 'drop_cap' );
		array_push( $buttons, 'highlight' );
		return $buttons;
	}
}
if ( ! function_exists( 'add_tinymce_lang' ) ) {
	function add_tinymce_lang( $arr ) {
		$arr['boldthemes'] = get_template_directory() . '/editor-buttons/editor-lang.php';
		return $arr;
	}
}