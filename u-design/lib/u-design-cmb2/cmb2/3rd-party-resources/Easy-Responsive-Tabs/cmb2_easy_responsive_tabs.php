<?php
/**
 * Plugin Name: Easy Responsive Tabs Plugin
 * Plugin URI:  https://github.com/samsono/Easy-Responsive-Tabs-to-Accordion
 * Description: Easy responsive tabs - is a lightweight jQuery plugin which optimizes normal horizontal or vertical tabs to accordion on multi devices like: web, tablets, Mobile (IPad & IPhone). This plugin adapts the screen size and changes its action accordingly.
 * Version:     1.0.0
 * Author:      Samson Onna
 * License:     MIT-license
 */


class Easy_Responsive_Tabs {
    
	const VERSION = '1.0.0';

	public function hooks() {
		add_action( 'admin_enqueue_scripts', array( $this, 'ert_setup_admin_scripts' ) );
	}
        
	public function ert_setup_admin_scripts() {
		wp_enqueue_style( 'easy-responsive-tabs', get_template_directory_uri() . '/lib/u-design-cmb2/cmb2/3rd-party-resources/Easy-Responsive-Tabs/css/easy-responsive-tabs.css', array('cmb2-styles'), self::VERSION );
		wp_enqueue_script( 'easy-responsive-tabs-js', get_template_directory_uri() . '/lib/u-design-cmb2/cmb2/3rd-party-resources/Easy-Responsive-Tabs/js/easyResponsiveTabs.min.js', array( 'jquery' ), self::VERSION, true );
	}
        
}
$own_field_slider = new Easy_Responsive_Tabs();
$own_field_slider->hooks();

