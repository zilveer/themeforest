<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

/**
 *
 *
 * @class      YIT_Panel_Script_Editor
 * @package    Yithemes
 * @since      Version 2.0.0
 * @author     Your Inspiration Themes
 *
 */

class YIT_Panel_Script_Editor extends YIT_Submenu {

    /**
     * @var string Option name
     */
    public $option_name = 'yit-custom-script';

    /**
     * Constructor
     *
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function __construct() {
        $this->menu_title   = __( 'Custom Script', 'yit' );
        $this->page_title   = __( 'Custom Script', 'yit' );
        $this->priority     = 110;
        $this->slug         = 'yit_custom_script';
        $this->option_name .= '_'.get_template();

        //actions
        add_action( 'admin_init', array( $this, 'add_option' ) );
        add_action( 'admin_init', array( $this, 'update_option' ) );
        add_action( 'admin_menu', array( $this, 'add_theme_page' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

    }

    /**
     * Add theme page function callback
     *
     * The function to be called to output the content for this page.
     *
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     * @return void
     */
    public function display_page() {
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_die( '<p>' . __( 'You do not have sufficient permissions to edit templates for this site.', 'yit' ) . '</p>' );
        }

        yit_get_template( 'admin/script-editor/script-editor.php', array('option_name' => $this->option_name) );
    }

    /**
     * Enqueue scripts and stylesheets
     *
     * @param $hook
     *
     * @return void
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     * @since  2.0.0
     */

    public function enqueue( $hook ) {
        global $admin_page_hooks;

        if ( $hook == $admin_page_hooks['yit_panel'] . '_page_yit_custom_script' ) {
            wp_enqueue_style( 'codemirror', YIT_CORE_LIB_URL . '/vendor/codemirror/codemirror.css', array(), '3.15' );
            wp_enqueue_script( 'codemirror', YIT_CORE_LIB_URL . '/vendor/codemirror/codemirror.js', array(), '3.15' );
            wp_enqueue_script( 'codemirror-css', YIT_CORE_LIB_URL . '/vendor/codemirror/javascript.js', array( 'codemirror' ), '3.15' );
        }
    }

    /**
     * Add option
     *
     * @return void
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     * @since 2.0.0
     */
    public function add_option() {
        add_option( $this->option_name );
    }

    /**
     * Update option
     *
     * @return void
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     * @since 2.0.0
    */
    public function update_option() {
        if ( YIT_Request()->post( 'custom_script_action' ) == 'update' ) {
            if ( wp_verify_nonce( YIT_Request()->post( 'custom_script_nonce' ), 'yit_custom_script_nonce' ) && ( ! defined( 'DOING_AUTOSAVE' ) || DOING_AUTOSAVE ) && current_user_can( 'edit_theme_options' ) && YIT_Request()->post( $this->option_name ) !== false ) {
                update_option( $this->option_name, YIT_Request()->post( $this->option_name ) );
                $update = 'true';
            }
            else {
                $update = 'false';
            }

            wp_redirect( esc_url( add_query_arg( 'updated', $update ) ) );
            exit();
        }
    }
}