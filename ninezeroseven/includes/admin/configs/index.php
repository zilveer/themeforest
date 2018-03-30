<?php
//Bail no-go amigo :)
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/************************************************************************
* ReduxFrameWork
*************************************************************************/
if ( !function_exists( 'wbc907_load_panel_plugin' ) ) {

	function wbc907_load_panel_plugin() {
		require_once dirname( __FILE__ ) . '/meta-config.php';
		require_once dirname( __FILE__ ) . '/theme-config.php';
	}
	
	global $wp_customize;
	if ( is_admin() || isset( $wp_customize ) ) {
		add_action( 'init' , 'wbc907_load_panel_plugin', 10 );
	}else {
		add_action( 'wp' , 'wbc907_load_panel_plugin', 10 );
	}

}

/************************************************************************
* Remove Redux Dashboard widget
*************************************************************************/
if(!function_exists('wbc907_remove_redux_widget')){
	function wbc907_remove_redux_widget(){
		remove_meta_box('redux_dashboard_widget', 'dashboard', 'side');
	}
	add_action('wp_dashboard_setup', 'wbc907_remove_redux_widget',20);
}
/************************************************************************
* Redux Widget Markup
*************************************************************************/

if ( !function_exists( 'wbc907_widght_markup' ) ) {
	function wbc907_widght_markup( $options ) {
		$options = array(
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		);
		return $options;
	}

	add_filter( 'redux_custom_widget_args' , 'wbc907_widght_markup' , 10 , 1 );
}

/************************************************************************
* WPML function for admin texts/string translations.
*************************************************************************/
if ( !function_exists( 'wbc907_wmpl_save_file' ) ) {

	function wbc907_wmpl_save_file( $option_values, $changed_options ) {

		if ( !function_exists( 'icl_register_string' ) ) {
			return;
		}

		//Only needs to be updated if topbar left in use.
		if ( !array_key_exists( 'opts-topbar-left', $changed_options ) ) {
			return;
		}

		$options = get_option( 'wbc907_data' );


		$wpml_text  = '';
		$wpml_text .='<wpml-config>'."\n";
		$wpml_text .='<admin-texts>'."\n";
		$wpml_text .='<key name="wbc907_data">'."\n";
		$wpml_text .='	<key name="opts-nav-text" />'."\n";
		$wpml_text .='	<key name="opts-footer-credit" />'."\n";
		$wpml_text .='	<key name="opts-topbar-left">'."\n";
		$wpml_text .='		<key name="field-info">'."\n";

		for ( $j=0; $j < count( $options['opts-topbar-left']['field-info'] ); $j++ ) {
			$wpml_text .='			<key name="'.esc_attr($j).'" />'."\n";
		}

		$wpml_text .='		</key>'."\n";
		$wpml_text .='	</key>'."\n";
		$wpml_text .='</key>'."\n";
		$wpml_text .='</admin-texts>'."\n";
		$wpml_text .='</wpml-config>'."\n";


		@file_put_contents( get_template_directory().'/wpml-config.xml', $wpml_text, LOCK_EX );


	}

	add_action( 'redux/options/wbc907_data/saved', 'wbc907_wmpl_save_file', 10, 2 );
}