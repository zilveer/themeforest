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
 * Icon handler.
 *
 * It can handle Icon from Web Fonts
 *
 * @class YIT_Icon
 * @package    Yithemes
 * @since      1.0.0
 * @author     Your Inspiration Themes
 *
 */

class YIT_Icon extends YIT_Object {

    /**
     * Font file name
     *
     * @var string
     * @access protected
     */
    protected $_icon_file_name = 'icons.php';

    /**
     * Font file name
     *
     * @var string
     * @access protected
     */
    protected $_icon_config_file_name = 'config.json';

    /**
     * Font folder url of icon fonts
     *
     * @var string
     * @access protected
     */
    protected $_icon_font_folder_url = '' ;

    /**
     * Font folder path of icon fonts
     *
     * @var string
     * @access protected
     */
    protected $_icon_font_folder_path = '' ;

    /**
     * Content of icon_file_name
     *
     * @var string
     * @access protected
     */
    protected $_icon = array();


    /**
     * Content of icon_list
     *
     * @var string
     * @access protected
     */
    protected $_icon_list = array();


    /**
     *
     * Include the style and scripts file and create the array of icons
     *
     * @return YIT_Icon
     * @since  2.0.0
     * @access public
     * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
     */
    public function __construct() {

        if( ! file_exists(  YIT_THEME_PATH . '/' . $this->_icon_file_name ) ){
            return;
        }

        $this->_icon  = include( YIT_THEME_PATH . '/' . $this->_icon_file_name );

        $this->_icon_font_folder_url  = YIT_THEME_ASSETS_URL . '/fonts';
        $this->_icon_font_folder_path = YIT_THEME_ASSETS_PATH . '/fonts';

        if ( !empty( $this->_icon ) ) {
            if( is_admin() ){
                add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
                add_action( 'yit_lightbox_style', array( $this, 'enqueue_styles' ) );

            }else{
                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
            }
        }

        //add the list of icons into $this->_icon
        $this->add_icon_list();

        add_filter( 'yit_icon_list', array( $this, 'icon_list_hook' ) );
    }


    /**
     *
     * Include the style and scripts file
     *
     * @return YIT_Icon
     * @since  2.0.0
     * @access public
     * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
     */
    public function enqueue_styles(){

        foreach( $this->_icon as $value ){

            $font_style = $this->_icon_font_folder_path . '/'. $value .'/style.css';

            if( file_exists( $font_style ) ){
                wp_enqueue_style( 'yit-icon-'.$value,  $this->_icon_font_folder_url . '/'. $value .'/style.css' );
            }
        }
    }

    /**
     *
     * Include the list of icons inside _icon
     *
     * @return YIT_Icon
     * @since  2.0.0
     * @access public
     * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
     */
    public function add_icon_list(){


        foreach( $this->_icon as $value ){

            $font_list =  $this->_icon_font_folder_path . '/'. $value . '/' . $this->_icon_config_file_name;

            if( file_exists( $font_list ) ){

                $this->_icon_list[ $value ]  = json_decode( file_get_contents( $font_list ), true );
            }
        }

    }

    /**
     *
     * Include the list of icons inside _icon
     *
     * @param string $font
     *
     * @return mixed | the array with the complete list | the array with the list of $font | false
     * @since  2.0.0
     * @access public
     * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
     */

    public function get_icon_list( $font = '' ){
        if( $font == '' ){
            return $this->_icon_list;
        }elseif( isset( $this->$_icon_list[ $font ] ) ){
            return $this->$_icon_list[ $font ];
        }else{
            return false;
        }
    }


    /**
     *
     * Include the list of icons inside YIT_Plugin_Common::get_icon_list()
     *
     * @param $icon_list
     *
     *
     * @return array
     * @since    2.0.0
     * @access   public
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.com>
     */

    function icon_list_hook( $icon_list ){
        return array_merge( $icon_list, $this->get_icon_list() );
    }


    /**
     *
     * Return the data info to show the icon
     *
     * @param $icon (FontFamily:Icon Code)
     *
     *
     * @return   string
     * @since    2.0.0
     * @access   public
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.com>
     */
    function get_icon_data( $icon ){

        $icon_list = class_exists( 'YIT_Plugin_Common' ) ? YIT_Plugin_Common::get_icon_list() : array();

        $icon_data = '';
        if ( $icon != '' ) {
            $ic        = explode( ':', $icon );

            if ( count($ic) < 2 ) {
                return $icon_data;
            }

            $icon_code =  array_search( $ic[1], $icon_list[$ic[0]] );

            if( $icon_code ){
                $icon_code =  ( strpos( $icon_code, '\\' ) === 0 ) ? '&#x' . substr( $icon_code, 1 ) . ';' : $icon_code;
            }

            $icon_data = 'data-font="' . esc_attr($ic[0]) . '" data-name="'. esc_attr($icon_code) .'" data-key="' . esc_attr($ic[1]) . '" data-icon="' . esc_attr($icon_code) . '"';
        }

        return $icon_data;
    }

}

if ( ! function_exists( 'YIT_Icon' ) ) {
    /**
     * Return the instance of YIT_Icon class
     *
     * @return \YIT_Icon
     * @since    2.0.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.com>
     */
    function YIT_Icon() {
        return YIT_Registry::get_instance()->icon;
    }
}
