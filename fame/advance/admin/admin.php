<?php

/*
 * Scripts and styles added in admin area
 */
if(!function_exists('a13_admin_head')){
    function a13_admin_head(){
        // color picker
        wp_register_script('jquery-wheelcolorpicker', A13_TPL_JS . '/jquery-wheelcolorpicker/jquery.wheelcolorpicker.js', array('jquery'), '2.0.3' );

        //main admin scripts
        wp_register_script('apollo13-admin', A13_TPL_JS . '/admin-script.js',
            array(
                'jquery',   //dom operation
                'thickbox',  //thickbox for inline documentation
                'jquery-wheelcolorpicker', //color picker
                'jquery-ui-slider', //slider for font-size setting
                'jquery-ui-sortable' //sortable socials and metas
            ),
            A13_THEME_VER
        );

        wp_enqueue_script('apollo13-admin');

//        //options transfered to js files
//        $admin_params = array(
//            'colorDir' => A13_TPL_JS . '/jquery.wheelcolorpicker'
//        );
//        wp_localize_script( 'apollo13-admin', 'AdminParams', $admin_params );

        //styles for uploading window
        wp_enqueue_style('thickbox');

        //some styling for admin options
	    wp_enqueue_style( 'a13-font-awesome', A13_TPL_CSS.'/font-awesome.min.css', false, '4.4.0');
        wp_enqueue_style( 'jquery-wheelcolorpicker', A13_TPL_JS . '/jquery-wheelcolorpicker/css/wheelcolorpicker.css', false, A13_THEME_VER, 'all' );
        wp_enqueue_style( 'admin-css', A13_TPL_CSS . '/admin-css.css', false, A13_THEME_VER, 'all' );
        wp_enqueue_style( 'apollo-jquery-ui', A13_TPL_CSS . '/ui-lightness/jquery-ui-1.10.4.custom.css', false, A13_THEME_VER, 'all'  );

    }
}


/*
 * Scripts in admin_enqueue_scripts hook
 */
if(!function_exists('a13_admin_scripts')){
    function a13_admin_scripts(){
        wp_enqueue_media();
    }
}


/**
 * Adds menu with settings for theme
 */
if(!function_exists('a13_admin_pages')){
    function a13_admin_pages() {
        add_menu_page(A13_TPL_ALT_NAME . ' theme', A13_TPL_ALT_NAME . ' theme', 'manage_options', 'apollo13_settings', 'a13_show_settings_page', A13_TPL_GFX . '/admin/icon.png' );
        add_submenu_page('apollo13_settings', __be( 'General' ), __be( 'General' ), 'manage_options', 'apollo13_settings', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Layout' ), __be( 'Layout' ), 'manage_options', 'apollo13_appearance', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Typography' ), __be( 'Typography' ), 'manage_options', 'apollo13_fonts', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Blog' ), __be( 'Blog' ), 'manage_options', 'apollo13_blog', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Works(Portfolio)' ), __be( 'Works(Portfolio)' ), 'manage_options', 'apollo13_cpt_work', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Galleries' ), __be( 'Galleries' ), 'manage_options', 'apollo13_cpt_gallery', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Sidebars' ), __be( 'Sidebars' ), 'manage_options', 'apollo13_sidebars', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Socials' ), __be( 'Socials' ), 'manage_options', 'apollo13_socials', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Contact' ), __be( 'Contact' ), 'manage_options', 'apollo13_contact', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Advanced' ), __be( 'Advanced' ), 'manage_options', 'apollo13_advanced', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Import &amp; export' ), __be( 'Import &amp; export' ), 'manage_options', 'apollo13_import', 'a13_show_settings_page');
        add_submenu_page('apollo13_settings', __be( 'Custom CSS' ), __be( 'Custom CSS' ), 'manage_options', 'apollo13_customize', 'a13_show_settings_page');
    }
}

/**
 * Settings page template
 */
if(!function_exists('a13_show_settings_page')){
    function a13_show_settings_page() {
        if (!current_user_can('manage_options')){
            wp_die( __be( 'You do not have sufficient permissions to access this page.' ) );
        }
        global $title;  //get the title of page from <title> tag
        //get options list for current settings page
        $func = $_GET['page'] . '_options';
        $option_list = $func();
        //get name of options we will change
        $options_name = str_replace( 'apollo13_', '', $_GET['page']);

        ?>
    <div class="wrap apollo13-settings apollo13-options metabox-holder" id="apollo13-settings">
        <h2><img id="a13-logo" src="<?php echo esc_url(A13_TPL_GFX .'/admin/icon_big.png'); ?>" /><?php echo $title; ?></h2>
        <div class="apollo-help">
            <p><span>!</span><?php printf( __be( 'If you need any help check <a href="%s" target="_blank">documentation</a> or <a href="%s" target="_blank">visit our support forum</a>' ), esc_url(A13_DOCS_LINK), 'http://support.apollo13.eu/' ); ?></p>
        </div>
        <?php
        if ( isset( $_POST[ 'theme_updated' ] ) ) {
            ?>
            <div id="message" class="updated">
                <p><?php printf( __be( 'Template updated. <a href="%s">Visit your site</a> to see how it looks.' ), esc_url(home_url( '/' )) ); ?></p>
            </div>
            <?php
        }
        a13_print_options( $option_list, $options_name );
        ?>

    </div>
    <?php
    }
}

function a13_admin_footer() {
    echo '<div id="a13-fa-icons">';

    define('A13_FA_GENERATOR_DIR', A13_TPL_ADV_DIR . '/inc/font-awesome-classes-generator/');

    $classes = require_once(A13_FA_GENERATOR_DIR.'/index.php');
    foreach($classes as $name){
        echo '<span class="a13-font-icon fa fa-'.$name.'" title="'.$name.'"></span>';
    }
    echo '</div>';
}

//flush if settings has changed (important for CUSTOM POST TYPES and their slugs)
function a13_flush_for_cpt(){
    if ( defined( 'A13_SETTINGS_CHANGED' ) && A13_SETTINGS_CHANGED ) {
        flush_rewrite_rules();
    }
}

add_action( 'init', 'a13_flush_for_cpt', 20 ); /* run after register of CPT's */
add_action( 'admin_menu', 'a13_admin_pages' );
add_action( 'admin_init', 'a13_admin_head' );
add_action( 'admin_enqueue_scripts', 'a13_admin_scripts');
add_action( 'admin_footer', 'a13_admin_footer');