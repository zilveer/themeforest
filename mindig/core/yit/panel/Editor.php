<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!defined('YIT')) exit('Direct access forbidden.');

/**
 * Add a Css Editor
 *
 * This class add a Css Editor to customize custom style
 *
 * @class YIT_Editor
 * @package	Yithemes
 */
class YIT_Panel_Editor extends YIT_Submenu {

    /**
     * Css Name
     *
     * @var string Set the name of custom.css
     */
    public $filename = 'custom.css';

    /**
     * Constructor
     *
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function __construct() {
        $this->filename = yit_custom_style_filename();
        $this->menu_title = __( 'Custom Style', 'yit' );
        $this->page_title = __( 'Custom Style', 'yit' );
        $this->priority = 100;
        $this->slug = 'yit_custom_style';

        //actions
        add_action( 'admin_menu', array( $this, 'add_theme_page' ) );
        add_action( 'admin_init', array( $this, 'save_css') );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );
    }

    /**
     * Add theme page function callback
     *
     * The function to be called to output the content for this page.
     *
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @return void
     */
    public function display_page() {
        if ( !current_user_can('edit_theme_options') ) {
            wp_die('<p>'.__('You do not have sufficient permissions to edit templates for this site.', 'yit').'</p>');
        }

        $file = locate_template( $this->filename );

        if ( empty( $file ) ) {
            $custom_path = get_template_directory() . '/' . $this->filename;
            $custom_resource = fopen( get_template_directory() . '/' . $this->filename, 'w' );
            if(isset($custom_resource)) {
                fwrite( $custom_resource, '' );
                fclose( $custom_resource );
                chmod($custom_path, 0777);
                $file = locate_template( $this->filename );
            }
        }

        if( !file_exists( $file ) || !yit_is_writable( $file ) ) {
            echo '<p>'.__('The file does not exist or you do not have sufficient permissions to edit this file.', 'yit').'</p>';
            echo '<p>'.sprintf( __('Make sure the file <strong>%s</strong> exists within the root of your theme folder and the file is writable. In order to use this tool, you need to make this file writable before you can save your changes. See <a href="http://codex.wordpress.org/Changing_File_Permissions">the Codex</a> for more information.', 'yit' ), $this->filename ).'</p>';
            return;
        }

        $content = file_get_contents( $file );
        yit_get_template( 'admin/editor/editor.php', array( 'filename' => $this->filename, 'file' => $file, 'content' => $content ) );
    }

    /**
     * Return file content
     *
     * The function to be called to read and return the custom file content
     *
     * @since 2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @return string
     */
    public function get_file_content() {
        $file = locate_template( $this->filename );
        if( file_exists( $file ) ) {
           return file_get_contents( $file );
        }

        return false;
    }


    /**
     * Phisically save the custom css
     *
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @return void
     */
    public function save_css() {
        if( $this->request->post('customcss_action') == 'update' ) {
            $file = locate_template( $this->filename );

            check_admin_referer( 'yit_custom_style' );
            $newcontent = $this->request->post('newcontent', array( 'stripslashes' ) );
            $location = '';
            if ( is_writeable( $file ) ) {
                $f = fopen( $file, 'w+' );
                if ( $f !== false ) {
                    fwrite( $f, $newcontent );
                    fclose( $f );
                    $location = add_query_arg('updated', 'true');
                } else {
                    $location = add_query_arg('updated', 'false');
                }
            }

            wp_redirect( esc_url( $location ) );
            exit();
        }
    }

    /**
     * Enqueue scripts and stylesheets
     *
     * @param $hook
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @return void
     */

    public function enqueue( $hook ) {
        global $admin_page_hooks;

        if( $hook == $admin_page_hooks['yit_panel'] . '_page_yit_custom_style' ) {
            wp_enqueue_style( 'codemirror', YIT_CORE_LIB_URL . '/vendor/codemirror/codemirror.css', array(), '3.15' );
            wp_enqueue_script( 'codemirror', YIT_CORE_LIB_URL . '/vendor/codemirror/codemirror.js', array(), '3.15' );
            wp_enqueue_script( 'codemirror-css', YIT_CORE_LIB_URL . '/vendor/codemirror/css.js', array('codemirror'), '3.15' );
        }
    }
}

if ( ! function_exists( 'YIT_Custom_Style' ) ) {
    /**
     * Return the instance of Editor Class
     *
     * @return \YIT_CustomStyle
     * @since    2.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function YIT_Custom_Style() {
        return new YIT_Panel_Editor();
    }
}