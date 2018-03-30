<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

new df_theme_customizer();

class df_theme_customizer
{
    public function __construct()
    {
        add_action( 'admin_menu', array(&$this,'df_remove_customize_submenu_page'));
        add_action( 'admin_menu', array(&$this, 'df_customizer_admin'));
        add_action( 'customize_register', array(&$this, 'df_customize_manager_init' ));
        add_action( 'customize_register', array(&$this, 'df_remove_customizer_sections' ));

    }


    public function df_remove_customize_submenu_page() {
        global $wp_version;

        if ( $wp_version >= '3.6' ) :
            remove_submenu_page( 'themes.php', 'customize.php' );
        endif;
    }

    /**
     * Add the Customize link to the admin menu
     * @return void
     */
    public function df_customizer_admin() {
        add_menu_page( 'Customizer', 'Customizer', 'edit_theme_options', 'customize.php', NULL, NULL );
    }

    // Remove Unused Native Sections
    // =============================================================================

    public function df_remove_customizer_sections( $wp_manager ) {
        $wp_manager->remove_section( 'nav' );
        $wp_manager->remove_section( 'colors' );
        $wp_manager->remove_section( 'title_tagline' );
        $wp_manager->remove_section( 'background_image' );
        $wp_manager->remove_section( 'static_front_page' );
        $wp_manager->remove_section( 'header_image' );
    }

    /**
     * Customizer manager init
     * @param  WP_Customizer_Manager
     * @return void
     */
    public function df_customize_manager_init( $wp_manager )
    {
        $url =  trailingslashit( get_template_directory_uri() ) . 'functions/images/';
        $customizer_path = trailingslashit( trailingslashit( dirname( __FILE__ ) ) . 'customizer' );

        require_once $customizer_path . 'controls/media/media-uploader-custom-control.php';
        require_once $customizer_path . 'controls/text/text-description-custom-control.php';
        require_once $customizer_path . 'controls/layout/layout-picker-custom-control.php';
        require_once $customizer_path . 'controls/text/textarea-custom-control.php';

        $customizer_files = array(
            $customizer_path . 'customizer-header-options.php',
            $customizer_path . 'customizer-footer-options.php',
            $customizer_path . 'customizer-favicon-options.php',
            $customizer_path . 'customizer-social-options.php'
            );

        foreach ($customizer_files as $customizer) {
            require_once  $customizer;
        }

    }


}