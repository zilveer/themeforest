<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


class YIT_Layout_Panel {


    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    public $options;

    public $prefix;

    public $static_pages;

    protected $current_panel = array(
        'model' => 'site',
        'type'  => 'site',
        'id'    => 'all',
        'info'  => ''
    );

    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since  1.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     *
     * Constructor
     *
     */
    public function __construct() {

        $this->options = include( YIT_CORE_PATH . '/lib/yit/layout/panel-options.php' );

        $this->prefix = 'yit_lp_';

        $this->static_pages = array(
            'front-page'  => __('Front Page','yit'),
            '404-page'    => __('404 Page','yit'),
            'search-page' => __('Search Page','yit'),
        );

        add_action( 'wp_ajax_yit-layout-panel', array( $this, 'ajax_get_panel' ) );

    }

    public function show_panel( $print = false ) {

        if ( $print ) {
            yit_get_template('/admin/layout/layout-panel.php', array( 'options' => $this->options, 'db_options' => $this->get_options(), 'current_panel' => $this->current_panel ) );
        }
        else {
            ob_start();
            yit_get_template( '/admin/layout/layout-panel.php', array( 'options' => $this->options, 'db_options' => $this->get_options(), 'current_panel' => $this->current_panel, 'prefix' => $this->prefix ) );
            return ob_get_clean();
        }

    }

    /**
     * Add a panel to the layout panel
     *
     * Must be called in after_setup_theme
     *
     * @param mixed  $panel The array of panel options
     * @param string $where Can assume after or before value; any other string will be assumed as before
     * @param string $refer The id of the panel which identifies the new field position
     *
     * @return   void
     * @since    1.0.0
     * @author   Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_panel( $panel, $where = 'after', $refer = null ) {
        if ( ! is_null( $refer ) ) {
            $refer_pos = array_search( $refer, array_keys( $this->options ) );
            if ( $refer_pos !== false ) {
                if ( strcmp( $where, 'after' ) == 0 ) {
                    $this->options = array_slice( $this->options, 0, $refer_pos + 1, true ) +
                        $panel +
                        array_slice( $this->options, $refer_pos, count( $this->options ) - 1, true );
                }
                else {
                    $this->options = array_slice( $this->options, 0, $refer_pos, true ) +
                        $panel +
                        array_slice( $this->options, $refer_pos, count( $this->options ) - 1, true );
                }
            }
        }
        else {
            if ( strcmp( $where, 'after' ) == 0 ) {
                $this->options = $this->options + $panel;
            }
            else {
                $this->options = $panel + $this->options;
            }
        }
    }

    /**
     * Remove the panel with the passed id
     *
     * @param $panel_ids array int The ids of the panel to remove
     *
     * @return void
     * @since    1.0.0
     * @author   Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function remove_panels( $panel_ids ) {
        foreach ( $panel_ids as $panel_id ) {
            if ( in_array( $panel_id, array_keys( $this->options ) ) ) {
                unset( $this->options[$panel_id] );
            }
        }
    }


    /**
     * Remove the panel with the passed id
     *
     * @param $panel_id
     *
     * @return void
     * @since    1.0.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */

    public function remove_panel( $panel_id ) {
            if ( isset( $this->options[$panel_id]) ) {
                unset( $this->options[$panel_id] );
            }
    }


    /**
     * Add a field to the layout panel
     *
     * Must be called in after_setup_theme
     *
     * @param string $panel_id The panel unique id
     * @param mixed  $field    The array of field options
     * @param string $where    Can assume after or before value; any other string will be assumed as before
     * @param string $refer    The id of the field which identifies the new field position
     *
     * @return   void
     * @since    1.0.0
     * @author   Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_option( $panel_id, $field, $where = 'after', $refer = null ) {
        if ( in_array( $panel_id, array_keys( $this->options ) ) ) {
            if ( ! is_null( $refer ) ) {
                $refer_pos = array_search( $refer, array_keys( $this->options[$panel_id]['fields'] ) );
                if ( $refer_pos !== false ) {
                    if ( strcmp( $where, 'after' ) == 0 ) {
                        $this->options[$panel_id]['fields'] = array_slice( $this->options[$panel_id]['fields'], 0, $refer_pos + 1, true ) +
                            $field +
                            array_slice( $this->options[$panel_id]['fields'], $refer_pos, count( $this->options[$panel_id]['fields'] ), true );
                    }
                    else {
                        $this->options[$panel_id]['fields'] = array_slice( $this->options[$panel_id]['fields'], 0, $refer_pos, true ) +
                            $field +
                            array_slice( $this->options[$panel_id]['fields'], $refer_pos, count( $this->options[$panel_id]['fields'] ), true );
                    }
                }
            }
            else {
                if ( strcmp( $where, 'after' ) == 0 ) {
                    $this->options[$panel_id]['fields'] = $this->options[$panel_id]['fields'] + $field;
                }
                else {
                    $this->options[$panel_id]['fields'] = $field + $this->options[$panel_id]['fields'];
                }
            }
        }
    }

    /**
     * Remove the option with the passed id form the panel
     *
     * @param $panel_id   int The id of the panel container
     * @param $option_ids array int The ids of the option to remove
     *
     * @return void
     * @since    1.0.0
     * @author   Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function remove_options( $panel_id, $option_ids ) {
        foreach ( $option_ids as $option_id ) {
            if ( in_array( $panel_id, array_keys( $this->options ) ) && in_array( $option_id, array_keys( $this->options[$panel_id]['fields'] ) ) ) {
                unset( $this->options[$panel_id]['fields'][$option_id] );
            }
        }
    }

    public function ajax_get_panel() {

        if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'yit-layout-panel-option' ) ) {
            return;
        }

        $this->current_panel = array(
            'model' => $_POST['model'],
            'type'  => $_POST['type'],
            'id'    => $_POST['id'],
        );

        $this->current_panel['info'] = $this->get_current_info();
        echo json_encode( $this->show_panel() );

        die();
    }


    public function get_options() {

        $saved_options = get_option( $this->prefix . $this->current_panel['model'] . '_' . $this->current_panel['type'] );
        if ( isset( $saved_options[$this->current_panel['id']] ) ) {
            return $saved_options[$this->current_panel['id']];
        }
        else {
            return array();
        }

    }

    public function get_option( $key ) {

        $saved_options = $this->get_options();

        if ( ! empty( $saved_options ) && isset( $saved_options[ $key ] ) ) {
            return $saved_options[$this->current_panel['id'][$key]];
        }
        else {
            return '';
        }

    }

    public function get_current_info() {

        $html = '<p>' . __( 'Type: ', 'yit' ) . '<strong>' . ucfirst( $this->current_panel['type'] ) . '</strong>' . '</p>';

        if ( $this->current_panel['model'] == 'taxonomy' ) {
            if ( $this->current_panel['id'] != 'all' ) {
                $taxonomy = get_term( $this->current_panel['id'], $this->current_panel['type'] );
                $html .= '<p>' . __( 'Name', 'yit' ) . ': <strong>' . $taxonomy->name . '</strong>' . '</p>';
                $taxonomy_url = get_term_link( $taxonomy, $this->current_panel['type'] );

                if ( is_wp_error( $taxonomy_url ) ) {

                }
                else {
                    $html .= '<p>' . __( 'URL', 'yit' ) . ': <strong><a href="' . esc_attr( $taxonomy_url ) . '" target="_blank">' . $taxonomy_url . '</a></strong>' . '</p>';
                }
            }
            else {
                $html .= '<p>' . __( 'All ', 'yit' ) . $this->current_panel['type'] . '</p>';
            }
        }



        if ( $this->current_panel['model'] == 'post_type' ) {
            if ( ! isset( $this->static_pages[$this->current_panel['id']] ) ) {
                if ( $this->current_panel['id'] && $this->current_panel['id']!='all' ) {
                    $p = get_post( $this->current_panel['id'] );


                    $html .= '<p>' . __( 'Name', 'yit' ) . ': <strong>' . $p->post_title . '</strong>' . '</p>';
                    $permalink = get_permalink( $p->ID );
                    $html .= '<p>' . __( 'URL', 'yit' ) . ': <strong><a href="' . esc_attr( $permalink ) . '" target="_blank">' . $permalink . '</a></strong>' . '</p>';
                }
            }
            elseif ( isset( $this->static_pages[$this->current_panel['id']] ) ) {
                $html .= '<p>' . $this->static_pages[$this->current_panel['id']] . '</p>';
            }
            else {
                $html .= '<p>' . __( 'All ', 'yit' ) . $this->current_panel['type'] . '</p>';
            }
        }

        if ( $this->current_panel['model'] == 'author' ) {
            if ( $this->current_panel['id'] != 'all' ) {
                if ( $this->current_panel['id'] ) {
                    $user_query = new WP_User_Query( array(
                        'search'         => $this->current_panel['id'],
                        'search_columns' => array( 'ID' ),
                    ) );

                    if ( $user_query->results ) {
                        foreach ( $user_query->results as $user ) {
                            $html .= '<p>' . __( 'Name', 'yit' ) . ': <strong>' . $user->display_name . '</strong>' . '</p>';
                        }
                    }

                    $permalink = get_author_posts_url( $this->current_panel['id'] );
                    $html .= '<p>' . __( 'URL ', 'yit' ) . ': <strong><a href="' . esc_attr( $permalink ) . '" target="_blank">' . $permalink . '</a></strong>' . '</p>';
                }
            }
            else {
                $html .= '<p>' . __( 'All ', 'yit' ) . $this->current_panel['type'] . '</p>';
            }
        }

        if ( $this->current_panel['model'] == 'static' ) {
            if ( $this->current_panel['id'] != 'all' ) {

                $html .= '<p>' . __( 'Name', 'yit' ) . ': <strong>' . $this->current_panel['id'] . '</strong>' . '</p>';

            }
            else {
                $html .= '<p>' . __( 'All ', 'yit' ) . $this->current_panel['type'] . '</p>';
            }
        }

        return $html;

    }
}

/**
 * Main instance of plugin
 *
 * @return \YIT_Layout_Panel
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Layout_Panel() {
    return YIT_Layout_Panel::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */

YIT_Layout_Panel();