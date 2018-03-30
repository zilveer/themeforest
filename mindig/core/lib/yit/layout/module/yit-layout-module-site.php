<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit;
} // Exit if accessed directly


class YIT_Layout_Module_Site extends YIT_Layout_Module {


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
        parent::__construct( 'site', __( 'Site', 'yit' ), true );
    }


    public function get_box() {

        $data = array(
            'model' => 'site',
            'type'  => 'site',
            'tabs'  => array(),
            'label' => __('Default Configuration', 'yit')
        );

        yit_get_template( '/admin/layout/accordion-item.php', $data );

    }

}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Layout_Module_Site() {
    return YIT_Layout_Module_Site::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Layout_Module_Site();
