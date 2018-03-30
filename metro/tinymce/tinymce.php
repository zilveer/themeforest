<?php

define('OM_TINYMCE_PATH', get_template_directory().'/tinymce');
define('OM_TINYMCE_URI', TEMPLATE_DIR_URI.'/tinymce');

require_once( get_template_directory().'/tinymce/options.php' );

function om_tmce_admin_head() {
	echo '<script>var OM_TEMPLATE_DIR_URI="'.TEMPLATE_DIR_URI.'";</script>';
}
add_action('admin_head', 'om_tmce_admin_head');

function om_tmce_admin_init() {

	wp_enqueue_style( 'om-tmce-shortcodes', OM_TINYMCE_URI . '/css/style.css', array(), OM_THEME_VERSION );
	wp_enqueue_script('om-tmce-core', OM_TINYMCE_URI.'/js/core.js', array('jquery'), OM_THEME_VERSION);

	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('wp-color-picker');
		
}
add_action('admin_init', 'om_tmce_admin_init');


function om_tmce_init()
{
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') == 'true' )
	{
		add_filter( 'mce_external_plugins', 'om_tmce_plugins'  );
		add_filter( 'mce_buttons', 'om_tmce_buttons' );
	}
}
add_action('init', 'om_tmce_init' );

function om_tmce_plugins( $plugin_array )
{
	if(version_compare(get_bloginfo('version') , '3.9', '>='))
		$plugin_array['om_shortcode_plugin'] = OM_TINYMCE_URI . '/js/plugin4.js';
	else
		$plugin_array['om_shortcode_plugin'] = OM_TINYMCE_URI . '/js/plugin.js';
	return $plugin_array;
}

function om_tmce_buttons( $buttons )
{
	array_push( $buttons, "|", 'om_shortcode_button' );
	return $buttons;
}

/******************************
 * Popup Callback
 ******************************/

function om_sc_popup_callback() {

	echo '<div class="om-sc-popup-wrapper">';
		echo '<div class="om-sc-popup-title"><h2>'. __('Insert shortcode: ', 'om_shortcodes') . esc_html($_POST['title']) . '</h2></div>';
		echo '<div class="om-sc-clearfix">';
			echo '<div class="om-sc-popup-button-box om-sc-popup-button-box-top">';
				echo '<input type="button" class="om-sc-popup-submit-button button button-primary button-large" data-shortcode-id="'.esc_attr($_POST['id']).'" value="'.__('Insert Shortcode', 'om_shortcodes').'" />';
			echo '</div>';
			echo '<div class="om-sc-popup-options-box">';
			echo om_tmce_shortcode_options_machine($_POST['id']);
			echo '</div>';
			echo '<div class="om-sc-popup-button-box om-sc-popup-button-box-bottom">';
				echo '<input type="button" class="om-sc-popup-submit-button button button-primary button-large" data-shortcode-id="'.esc_attr($_POST['id']).'" value="'.__('Insert Shortcode', 'om_shortcodes').'" />';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	
	exit();

}
add_action('wp_ajax_om_sc_popup', 'om_sc_popup_callback');