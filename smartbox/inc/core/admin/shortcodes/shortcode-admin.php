<?php
/**
 * Sets up the shortcode editor actions
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

class ShortcodeAdmin
{
    private $theme;

    function __construct( $theme ) {
        $this->theme = $theme;

        // Don't bother doing this stuff if the current user lacks permissions
        if( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
            return;
        }


        // Add only in Rich Editor mode
        if( get_user_option('rich_editing') == 'true') {
            add_filter( 'mce_external_plugins', array( $this, 'oxy_add_mce_shortcode_plugin') );
            add_filter( 'mce_buttons', array( &$this, 'oxy_add_mce_shortcode_button') );
        }

        // enqueue scripts & styles
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        // remove notice from wp-includes/functions.php
        remove_action( 'admin_enqueue_scripts', 'wp_auth_check_load' );
        // add tinyMCE shortcode plugin
        add_action('admin_init', array( &$this, 'oxy_add_mce_shortcode') );
        // add action for loading shortcode page
        add_action( 'wp_ajax_oxy_shortcodes', array( &$this, 'oxy_load_mce_shortcode_page' ) );
        // add action for loading shortcode page
        add_action( 'wp_ajax_oxy_shortcode_preview', array( &$this, 'oxy_load_mce_shortcode_preview' ) );
        // add action for loading menu data
        add_action( 'wp_ajax_oxy_shortcodes_menu', array( &$this, 'oxy_load_mce_shortcode_menu' ) );
    }

    function admin_enqueue_scripts() {
        global $pagenow;
        if( 'post-new.php' == $pagenow || 'post.php' == $pagenow ) {
            wp_enqueue_style( 'oxy-shortcodes-html-menu', ADMIN_CSS_URI . 'shortcodes/shortcode-html-menu.css' );
            wp_enqueue_script( 'oxy-shortcodes-html-menu', ADMIN_JS_URI . 'shortcodes/html-menu.js' );
        }
    }

    function oxy_load_mce_shortcode_page() {
        // check for rights
        if ( !current_user_can('edit_pages') && !current_user_can('edit_posts') )
            die(__('You are not allowed to be here', THEME_ADMIN_TD));

        // load shortcodes js
        wp_enqueue_script( 'oxy-shortcodes', ADMIN_JS_URI . 'shortcodes/shortcodes.js', array( 'jquery' ) );
        wp_enqueue_script( 'oxy-shortcode-options', ADMIN_JS_URI . 'shortcodes/shortcode-options.js', array( 'jquery', 'jquery-ui-accordion' ) );
        wp_enqueue_style( 'oxy-shortcodes', ADMIN_CSS_URI . 'shortcodes/shortcode-popup.css', array( 'jquery-ui-theme' ) );
        //wp_enqueue_style( 'oxy-shortcodes', ADMIN_CSS_URI . 'shortcodes/shortcode-popup.css' );

        include_once ADMIN_SC_DIR . 'shortcode-editor.php';

        die();
    }

    function oxy_load_mce_shortcode_preview() {
        // check for rights
        if ( !current_user_can('edit_pages') && !current_user_can('edit_posts') )
            die(__('You are not allowed to be here', THEME_ADMIN_TD));

        check_ajax_referer( 'oxy-preview-nonce' );

        // load an extra css for for the preview view only
        wp_enqueue_style( 'shortcode-preview', CSS_URI . 'shortcode-preview.css', array( 'style', 'responsive' ) );

        //$this->theme->load_javascripts();
        // $this->theme->fix_shortcodes_autop();
        // $this->theme->load_stylesheets();
        // $this->theme->load_options( 'shortcodes' );
        $this->theme->load_shortcodes();

        include_once ADMIN_SC_DIR . 'preview.php';

        die();
    }

    function oxy_load_mce_shortcode_menu() {
        // check for rights
        if ( !current_user_can('edit_pages') && !current_user_can('edit_posts') )
            die(__('You are not allowed to be here', THEME_ADMIN_TD));

        $shortcode_options = include_once OPTIONS_DIR . 'shortcodes/shortcode-options.php';

        echo json_encode( $shortcode_options );

        die();
    }

    function oxy_add_mce_shortcode_button( $buttons ) {
        array_push( $buttons, 'shortcodes' );
        return $buttons;
    }

    function oxy_add_mce_shortcode_plugin( $plugin_array ) {
       if( version_compare( get_bloginfo( 'version' ), '3.9', '<' ) ) {
            $plugin_array['shortcodes'] = ADMIN_JS_URI . 'shortcodes/editor_plugin.js';
        }
        else {
            $plugin_array['shortcodes'] = ADMIN_JS_URI . 'shortcodes/plugin.js';
        }
        return $plugin_array;
    }
}