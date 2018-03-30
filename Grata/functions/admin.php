<?php
// Improve TinyMCE look
function us_enqueue_editor_style() {

	add_editor_style( 'functions/tinymce/mce_styles.css' );
}

add_action('admin_enqueue_scripts', 'us_enqueue_editor_style');

// Redirect to Demo Import page after Theme activation
function us_theme_activation()
{
	global $pagenow;
	if (is_admin() && $pagenow == 'themes.php' && isset($_GET['activated']))
	{
		//Set menu
		$user = wp_get_current_user();
		update_user_option( $user->ID, 'grata_cpt_in_menu_set', false, true );

		//Redirect to demo import
		header( 'Location: '.admin_url().'admin.php?page=us-home' ) ;
	}
}

add_action('admin_init','us_theme_activation', 99);

function us_include_cpt_to_menu() {
	global $pagenow;
	if ( is_admin() AND $pagenow == 'nav-menus.php' ) {
		$already_set = get_user_option( 'grata_cpt_in_menu_set' );

		if ( ! $already_set ) {
			$hidden_meta_boxes = get_user_option( 'metaboxhidden_nav-menus' );

			if ($hidden_meta_boxes !== false) {
				if (($key = array_search('add-us_main_page_section', $hidden_meta_boxes)) !== false) {
					unset($hidden_meta_boxes[$key]);
				}
				if (($key = array_search('add-us_portfolio', $hidden_meta_boxes)) === false) {
					$hidden_meta_boxes[] = 'add-us_portfolio';
				}
				if (($key = array_search('add-us_portfolio_category', $hidden_meta_boxes)) === false) {
					$hidden_meta_boxes[] = 'add-us_portfolio_category';
				}
				if (($key = array_search('add-us_client', $hidden_meta_boxes)) === false) {
					$hidden_meta_boxes[] = 'add-us_client';
				}

				$user = wp_get_current_user();
				update_user_option( $user->ID, 'metaboxhidden_nav-menus', $hidden_meta_boxes, true );
				update_user_option( $user->ID, 'grata_cpt_in_menu_set', true, true );
			}
		}
	}
}

add_action('admin_head','us_include_cpt_to_menu', 99);

// Improve MetaBox look
function us_enqueue_metabox_style() {
    wp_enqueue_style( 'us-rwmb', RWMB_CSS_URL . 'us_meta_box_style.css', array(), RWMB_VER );
}

add_action( 'admin_enqueue_scripts', 'us_enqueue_metabox_style', 12);

// TinyMCE buttons
function us_enqueue_admin_style() {
    wp_enqueue_style( 'us-admin-css', get_template_directory_uri() . '/functions/assets/css/us.admin.css' );
}

add_action( 'admin_enqueue_scripts', 'us_enqueue_admin_style', 12);

/**
 * Get current Grata Theme version
 * @return String Current Impreza Theme version
 */
function us_get_main_theme_version(){
	$theme = wp_get_theme();
	if (is_child_theme()){
		$theme = wp_get_theme($theme->get('Template'));
	}
	return $theme->get('Version');
}
