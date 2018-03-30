<?php
/**
 *
 * @author alex
 */

class ctCustomizeManagerHandler {

	/**
	 *
	 */
	public function __construct() {
		add_action('customize_register', array($this, 'customizeRegister'), 20);
		add_theme_support('custom-background', array('wp-head-callback' => array($this, 'wpHeadCallback')));
	}

	/**
	 * Customize theme preview
	 * @param WP_Customize_Manager $wp_manager
	 * @return \WP_Customize_Manager
	 */

	public function customizeRegister($wp_manager) {
		//$wp_manager->remove_section('colors');
		/** @var $sec WP_Customize_Section */
		$sec = $wp_manager->get_section('colors');
		$sec->title = __('Nonus - General settings', 'ct_theme');
		$sec->priority = 1;

		$wp_manager->add_setting('lead_color');
		$wp_manager->add_control(new WP_Customize_Color_Control($wp_manager, 'lead_color', array(
			'label' => __('Motive color', 'ct_theme'),
			'section' => 'colors',
			'default' => '#405b7f',
			'priority' => 1
		)));


		$wp_manager->add_section('ct_header', array(
			'title' => __('Nonus - Header', 'ct_theme'),
			'priority' => 2
		));
		$wp_manager->add_setting('header_background_color');
		$wp_manager->add_control(new WP_Customize_Color_Control($wp_manager, 'header_background_color', array(
			'label' => __('Background color','ct_theme'),
			'section' => 'ct_header',
		)));

		$wp_manager->add_section('ct_footer', array(
			'title' => __('Nonus - Footer', 'ct_theme'),
			'priority' => 3
		));
		$wp_manager->add_setting('footer_background_color');
		$wp_manager->add_control(new WP_Customize_Color_Control($wp_manager, 'footer_background_color', array(
			'label' => __('Background color','ct_theme'),
			'section' => 'ct_footer',
		)));

		$wp_manager->add_setting('subfooter_background_color');
		$wp_manager->add_control(new WP_Customize_Color_Control($wp_manager, 'subfooter_background_color', array(
			'label' => __('Subfooter background color', 'ct_theme'),
			'section' => 'ct_footer',
		)));

		return $wp_manager;
	}

	public function wpHeadCallback() {
		ctThemeLoader::getFilesLoader()->requireOnce(CT_THEME_SETTINGS_MAIN_DIR . '/custom_style.php');
	}

}