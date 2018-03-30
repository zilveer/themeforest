<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


class YIT_Layout_Module_Static extends YIT_Layout_Module {


    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;


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
        parent::__construct( 'static', __( 'Static', 'yit' ), true );
    }


    protected function _get_content( $args = array() ) {
        $static = array(
            'front_page'	=> __('Front Page', 'yit'),
            'search'		=> __('Search Results', 'yit'),
            '404'			=> __('404 Page', 'yit')
        );
        if(isset($args['include'])) {
            $static = array_intersect_key($static, array_flip($args['include']));
        }
        return $static;
    }


    public function get_box() {

        $recent_posts = $this->_get_content();

        $tabs = array();


        if( ! empty($recent_posts)){

            $tabs['view-all'] = array(
                'title'    => __( 'View all', 'yit' ),
                'content'  => $recent_posts,

            );

        }

        $data = array(
            'model' => 'static',
            'type'  => 'static',
            'tabs'  => $tabs,
            'label' => $this->name,
            'label_all' => sprintf( __( 'All %s', 'yit' ), $this->name )
        );

        yit_plugin_get_template( YIT_Layout()->plugin_path, 'admin/accordion-item.php', $data );

    }


}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Layout_Module_Static() {
    return YIT_Layout_Module_Static::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Layout_Module_Static();
