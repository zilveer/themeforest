<?php

/* ************************************************************************************** 
	Create Seperate Customize Menu
************************************************************************************** */

if ( $wp_version >= '3.6' ) {
  function swm_remove_customize_submenu_page() {
    remove_submenu_page( 'themes.php', 'customize.php' );
  }

  add_action( 'admin_menu', 'swm_remove_customize_submenu_page' );
}

function swm_add_customizer_menu() {
  add_menu_page( __('Customizer','swmtranslate'), __('Customizer','swmtranslate'), 'edit_theme_options', 'customize.php', NULL, NULL,59);
  add_submenu_page( 'customize.php', __('Customizer Import','swmtranslate'), __('Import','swmtranslate'), 'edit_theme_options', 'import', 'swm_customizer_import_page' );
  add_submenu_page( 'customize.php', __('Customizer Export','swmtranslate'), __('Export','swmtranslate'), 'edit_theme_options', 'export', 'swm_customizer_export_page' );
}

add_action( 'admin_menu', 'swm_add_customizer_menu' );

/* ************************************************************************************** 
	Remove Default Sections
************************************************************************************** */

function swm_remove_customizer_sections( $wp_customize ) {
  $wp_customize->remove_section( 'nav' );
  $wp_customize->remove_section( 'colors' );
  $wp_customize->remove_section( 'title_tagline' );
  $wp_customize->remove_section( 'background_image' );
  $wp_customize->remove_section( 'static_front_page' );
}

add_action( 'customize_register', 'swm_remove_customizer_sections' );

/* ************************************************************************************** 
	Include Customizer Custom options, settings etc. files
************************************************************************************** */

require_once( SWM_ADMIN . 'customizer/controls.php' );
require_once( SWM_ADMIN . 'customizer/theme-options.php' );
require_once( SWM_ADMIN . 'customizer/import-export.php' );

add_action('customize_controls_enqueue_scripts', 'swm_customizer_admin_init');

if ( ! function_exists( 'swm_customizer_admin_init' ) ) {
  function swm_customizer_admin_init()  {
    $swm_template_uri = get_template_directory_uri();    
    wp_register_style('swm_customizer_styles', $swm_template_uri . '/framework/customizer/css/customizer.css', '', '1.0');
    wp_enqueue_style( 'swm_customizer_styles' );
  }
}

if ( ! function_exists( 'swm_customizer_scripts' ) ) {
    function swm_customizer_scripts() {

    wp_register_script( 'customizer-app-js', get_template_directory_uri() . '/framework/customizer/js/customizer.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'customizer-app-js' );

    }

    add_action( 'customize_controls_print_footer_scripts', 'swm_customizer_scripts' );
}

/* ************************************************************************************** 
  Include Preloader
************************************************************************************** */

function swm_customizer_preloader() {
  echo '<div id="swm_customizer_loading"><div id="proload_content"><p><span class="loading"></span><span>Loading</span><span class="title">Customizer</span></p></div>
</div>';
}

add_action( 'customize_controls_print_styles', 'swm_customizer_preloader' );