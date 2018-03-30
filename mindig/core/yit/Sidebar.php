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
    exit( 'Direct access forbidden.' );
}


/**
 * Perform Sidebar (script and style) init and manage
 *
 * @class YIT_Sidebar
 * @package    Yithemes
 * @since      2.0.0
 * @author     Your Inspiration Themes
 *
 */
class YIT_Sidebar extends YIT_Object {

    /**
     * Sidebar file name
     *
     * @var string
     * @access protected
     */
    protected $_sidebar_file_name = 'sidebars.php';


    /**
     * Sidebars value
     *
     * @var array
     * @access protected
     */
    protected $_sidebars = array();


    /**
     * Sidebars default value
     *
     * @var array
     * @access protected
     */
    protected $_sidebars_default_args = array(
            'name'         => '',
            'description'  => '',
            'widget_class' => 'widget',
            'title'        => 'h3'
    );

    /**
     *
     * Register default sidebars
     *
     * @return \YIT_Sidebar
     * since  2.0.0
     * @access public
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function __construct() {

        $this->_sidebars = include( YIT_THEME_PATH . '/' . $this->_sidebar_file_name );


        add_action( 'after_setup_theme'  , array( $this, 'register' ) );
    }

    /**
     *
     * Return the sidebars to register
     *
     * @return array
     *
     * @since  2.0.0
     * @access public
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */

    public function get() {
        return $this->_sidebars;
    }


    /**
     *
     * Set the arguments with default values to send to register_sidebar function
     *
     * @param $args
     *
     * @return void
     *
     * @since  2.0.0
     * @access public
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function sidebar_args( $args ) {

        $args     = wp_parse_args( (array) $args, $this->_sidebars_default_args );

        return array(
            'name'          => $args['name'],
            'id'            => $args['id'],
            'description'   => $args['description'],
            'before_widget' => '<div id="%1$s" class="' . esc_attr( $args['widget-class'] ) . ' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<' .  $args['title'] . '>',
            'after_title'   => '</' . $args['title'] . '>',
        );

    }

    /**
     *
     * Register and Enqueue Script and Style
     *
     * @return void
     *
     * @since  2.0.0
     * @access public
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function register() {

        foreach ( $this->_sidebars as $id => $options ) {
            $options['id'] = $id;
            register_sidebar( $this->sidebar_args( $options ) );
        }

    }
}

if ( ! function_exists( 'YIT_Sidebar' ) ) {
    /**
     * Return the instance of YIT_Sidebar class
     *
     * @return \YIT_Sidebar
     * @since    2.0.0
     * @author   Emanuela Castorina <andrea.grillo@yithemes.com>
     */
    function YIT_Sidebar() {
        return YIT_Registry::get_instance()->sidebar;
    }
}
