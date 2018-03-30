<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Maintenance_Module
 * @since G1_Maintenance_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_Maintenance_Module extends G1_Module {

    public function __construct() {
        parent::__construct();

        $this->set_version( '1.0.0' );
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        parent::setup_hooks();

        add_action( 'init', array( $this, 'setup_maintenance_mode' ) );
        add_action( get_redux_opts_sections_filter_name(), array( $this, 'add_theme_options' ) );
        add_action('admin_bar_menu', array( $this, 'add_info_to_admin_toolbar' ), 100);
    }

    public function add_info_to_admin_toolbar ( $wp_admin_bar ) {
        if ( $this->maintenance_mode_enabled() ) {
            $wp_admin_bar->add_menu( array(
                'parent' => 'root',
                'id' => 'g1-maintenance-mode-status',
                'title' => '<div class="g1-maintenance-mode-status">'.__( 'Maintenance mode is ON', 'g1_theme' ).'</div>',
            ) );
        }
    }

    public function setup_maintenance_mode () {
        if ( $this->maintenance_mode_enabled() && !g1_has_current_user_role( 'administrator' ) ) {
            add_filter( 'status_header', array( $this, 'set_status_header' ), 10, 4 );
            add_filter( 'request', array( $this, 'alter_request' ), 999 );
        }
    }

    public function set_status_header ( $status_header, $header, $text, $protocol ) {
        return $protocol .' 503 Service Unavailable';
    }

    public function alter_request ( $request ) {
        $new_request = array(
            'page_id' => $this->get_page_id()
        );

        return $new_request;
    }


    public function add_theme_options ( $sections ) {
        $sections['maintenance_mode'] = array(
            'priority'   => 1000,
            'icon'       => 'off',
            'icon_class' => 'icon-large',
            'title'      => __( 'Maintenance Mode', Redux_TEXT_DOMAIN ),
            'fields'     => array(
                array(
                    'id'        => 'maintenance_mode',
                    'priority'  => 10,
                    'type'      => 'select',
                    'title'     => __( 'State', Redux_TEXT_DOMAIN ),
                    'sub_desc'  => __('Logged in administrator gets full access to the site, while regular visitors will be redirected to the chosen page.', Redux_TEXT_DOMAIN ),
                    'options'   => array(
                        'none'          => __( 'off', 'g1_theme' ),
                        'standard'      => __( 'on', 'g1_theme' ),
                    ),
                    'switch'    => true,
                    'std'       => 'none',
                ),
                array(
                    'id'        => 'maintenance_mode_page_id',
                    'priority'  => 20,
                    'type'      => 'pages_select',
                    'title'     => __( 'Page', Redux_TEXT_DOMAIN ),
                    'desc'      => __( 'Select a page which will be shown when maintenance mode is enabled', Redux_TEXT_DOMAIN )
                ),
            )
        );

        return $sections;
    }

    protected function maintenance_mode_enabled () {
        $maintenance_mode = g1_get_theme_option( 'maintenance_mode', '', 'none' );
        $page_id = $this->get_page_id();

        return ($maintenance_mode === 'standard' && !empty( $page_id ));
    }

    protected function get_page_id () {
        return g1_get_theme_option( 'maintenance_mode', 'page_id', '' );
    }
}
function G1_Maintenance_Module() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Maintenance_Module();

    return $instance;
}
// Fire in the hole :)
G1_Maintenance_Module();
