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
 * Save the theme option in a CSS file
 *
 * @class YIT_Css
 * @package    Yithemes
 * @since      1.0.0
 * @author     Andrea Grillo <andrea.grillo@yithemes.com>
 *
 */
class YIT_Css extends YIT_Object {

    /**
     * All rules to save in file css
     *
     * @var array
     * @access protected
     * @since 1.0.0
     */
    protected $_rules = array();

    /**
     * Theme Options file name CSS
     *
     * @var string
     * @access public
     * @since 1.0.0
     */
    public $custom_filename = 'dynamics.css';

    /**
     * IE8 and IE9 Css Import file name
     *
     * @var string
     * @access public
     * @since 1.0.0
     */
    public $old_ie_css_filename = 'old_ie.css';

    /**
     * String to save internal stylesheets content
     *
     * @var string
     * @access protected
     * @since 1.0.0
     */
    protected $_style = '';

    /**
     * All stylesheets to enqueue
     *
     * @var array
     * @access protected
     * @since 1.0.0
     */
    protected $_stylesheets = array();


     /**
      * Class Init -> Transform a panel options in a css rules
      *
      * @since  1.0.0
      * @return void
      * @access public
      * @author Andrea Grillo <andrea.grillo@yithemes.com>
      */

    public function __construct() {
		add_action( 'init', array( $this, 'custom_file_exists' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_dynamics_css' ), 16 );
    }

    /**
     * Css Option Parse -> Transform a panel options in a css rules
     *
     * @param $option string
     * @param $value string
     * @param $options mixed array
     *
     * @return mixed
     * @since  1.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function add_by_option( $option, $value, $options ) {

        if ( ! isset( $option['style'] ) ) {
            return;
        }

        // used to store the properties of the rules
        $args = array();

        if( isset( $option['style']['selectors'] )  ){
            $style = array(
                array(
                    'selectors' => $option['style']['selectors'],
                    'properties' => $option['style']['properties']
                )
            );
        }elseif( isset( $option['variations'] ) ){
            $style = array( $option['style'] );
        }else {
            $style = $option['style'];
        }

        foreach( $style as $style_option ){
            $args=array();
            $option['style'] = $style_option;


        if ( $option['type'] == 'colorpicker' ) {

            //For simply colorpicker type
            if ( ! isset( $option['variations'] ) ) {

                if ( isset( $value['color'] ) && $value['color'] == '' ) {
                    $value['color'] = $option['std']['color'];
                }

                $properties = explode( ',', $option['style']['properties'] );

                if ( isset( $option['std']['opacity'] ) && $value['opacity'] != 100 ) {
                    $ex_color = $value['color'];
                    $opacity = ( $value['opacity'] / 100 );
                    $value   = $this->getModel( 'colors' )->hex2rgb( ( $value['color'] ) );
                    $value   = array(
                        'color' => "$ex_color; %property%: rgba( $value[0], $value[1], $value[2], $opacity )"
                    );
                }

                foreach ( $properties as $property ) {
                    $args[$property] = str_replace( '%property%', $property, $value['color'] );
                }

                $this->add( $option['style']['selectors'], $args );
            }
            else {
                //For advanced colorpicker type (variations colorpicker)
                foreach ( $option['variations'] as $variation => $label ) {

                    $properties = explode( ',', $option['style'][$variation]['properties'] );

                    if ( isset( $value['color'][$variation] ) && $value['color'][$variation] == '' ) {
                        $value['color'][$variation] = $option['std']['color'][$variation];
                    }

                    if ( isset( $option['std']['opacity'] ) ) {
                        $opacity                    = ( $value['opacity'][$variation] / 100 );
                        $ex_color                   = $value['color'][$variation];
                        $rgba_color_value           = $this->getModel( 'colors' )->hex2rgb( $value['color'][$variation] );
                        $value['color'][$variation] = "$ex_color; %property%: rgba( $rgba_color_value[0], $rgba_color_value[1], $rgba_color_value[2], $opacity )";
                    }

                    foreach ( $properties as $property ) {
                        if( isset( $value['color'][$variation] ) ){
                            $args[$variation][$property] = str_replace( '%property%', $property, $value['color'][$variation] );
                        }

                        if( isset( $option['style'][$variation] ) &&  isset( $args[$variation] ) ) {
                            $this->add( $option['style'][$variation]['selectors'], $args[$variation] );
                        }
                    }
                }
            }


        }
        elseif ( $option['type'] == 'bgpreview' ) {

            $this->add( $option['style']['selectors'], array( 'background' => "{$value['color']} url('{$value['image']}')" ) );

        }
        elseif ( $option['type'] == 'typography' ) {

            if ( isset( $value['size'] ) && isset( $value['unit'] ) ) {

                $args['font-size'] = $value['size'] . $value['unit'];
            }

            if ( isset( $value['family'] ) ) {

                if ( $value['family'] == 'default' && isset( $options['default_font_id'] ) ) {
                    $default_font_family = yit_get_option( $options['default_font_id'] );
                    $value['family']     = $default_font_family['family'];
                }

                $web_fonts = $this->getModel( 'font' )->web_fonts;

                if ( isset( $web_fonts[$value['family']] ) ) {
                    $family = $web_fonts[$value['family']];
                }
                else {
                    $family = $value['family'];
                }

                if ( strpos( $family, ',' ) ) {
                    $args['font-family'] = stripslashes( preg_replace( '/:[0-9a-z]var_d/', '', $family ) ) . ", sans-serif";
                }
                else {
                    $args['font-family'] = "'" . stripslashes( preg_replace( '/:[0-9a-z]+/', '', $family ) ) . "', sans-serif";
                }
            }

            if ( isset( $value['color'] ) ) {
                $args['color'] = $value['color'];
            }

            if ( isset( $option['opacity'] ) && $value['color'][0] == '#' ) {
                $value['color'] = $this->getModel( 'colors' )->hex2rgb( $value['color'] );
                $value['color'] = "rgba( $value[color][0], $value[color][1], $value[color][2], $option[opacity] )";
            }

            if ( isset( $value['style'] ) ) {

                switch ( $value['style'] ) {

                    case 'bold' :
                        $args['font-style']  = 'normal';
                        $args['font-weight'] = '700';
                        break;

                    case 'extra-bold' :
                        $args['font-style']  = 'normal';
                        $args['font-weight'] = '800';
                        break;

                    case 'italic' :
                        $args['font-style']  = 'italic';
                        $args['font-weight'] = 'normal';
                        break;

                    case 'bold-italic' :
                        $args['font-style']  = 'italic';
                        $args['font-weight'] = '700';
                        break;

                    case 'regular' :
                    case 'normal' :
                        $args['font-style']  = 'normal';
                        $args['font-weight'] = '400';
                        break;

                    default:
                        if( is_numeric( $value['style'] ) ) {
                            $args['font-style']  = 'normal';
                            $args['font-weight'] = $value['style'];
                        }else {
                            $args['font-style']  = 'italic';
                            $args['font-weight'] = str_replace( 'italic', '', $value['style'] );
                        }
                        break;
                }

            }

            if ( isset ( $value['align'] ) ) {
                $args['text-align'] = $value['align'];
            }

            if ( isset ( $value['transform'] ) ) {
                $args['text-transform'] = $value['transform'];
            }

            $this->add( $option['style']['selectors'], $args );

        }
        elseif ( $option['type'] == 'upload' && $value ) {

            $this->add( $option['style']['selectors'], array( $option['style']['properties'] => "url('$value')" ) );

        }
        elseif ( $option['type'] == 'number' ) {

            $this->add( $option['style']['selectors'], array( $option['style']['properties'] => "{$value}px" ) );

        }
        elseif ( $option['type'] == 'select' ) {

            $this->add( $option['style']['selectors'], array( $option['style']['properties'] => "$value" ) );
        }
            }
    }

    /**
     * Add the rule css
     *
     * @param string $rule
     * @param array  $args
     *
     * @return bool
     * @since  1.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function add( $rule, $args = array() ) {
        if ( isset( $this->_rules[$rule] ) ) {
            $this->_rules[$rule] = array_merge( $this->_rules[$rule], $args );
        }
        else {
            $this->_rules[$rule] = $args;
        }
    }

    /**
     * Save the file with all css
     *
     * @return bool
     * @since  1.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function save_css() {
        global $wpdb;

        $css = array();

        // collect all css rules

        if( empty( $this->_rules ) ) {
            $this->get_theme_options_css_rules();
        }

        foreach ( $this->_rules as $rule => $args ) {
            $args_css = array();

            if( empty($args) ){
                continue;
            }

            foreach ( $args as $arg => $value ) {

                $args_css[] = $arg . ': ' . $value . ';';
            }
            $css[] = $rule . ' { ' . implode( ' ', $args_css ) . ' }';
        }

        $css = apply_filters( 'yit_dynamics_style', implode( "", $css ) );

        // save the css in the file
        $index = $wpdb->blogid != 0 ? '-' . $wpdb->blogid : '';
		$file = $this->getModel( 'cache' )->locate_file( str_replace( '.css', $index . '.css', $this->custom_filename ) );

		if ( ! is_writable( dirname( $file ) ) ) {
			return false;
		}

        return file_put_contents( $file, $css, FS_CHMOD_FILE );
    }

    /**
	 * Return the custom.css filename including the id of the site
	 * if the site is in a Network
	 *
	 * @return string
	 * @since 1.0.0
     * @access protected
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	protected function _getCustomFilename() {
		global $wpdb;
		$index = $wpdb->blogid != 0 ? '-' . $wpdb->blogid : '';
		return str_replace( '.css', $index . '.css', $this->custom_filename );
	}

    /**
	 * Get all css rules by Theme Options
	 *
	 * @return void
	 * @since 2.0.0
     * @access public
     * Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function get_theme_options_css_rules() {
		$theme_options_rules = $this->getModel('panel')->get_option_by( 'css', 'all' );
        foreach($theme_options_rules as $css_rule){
            if( isset( $css_rule['id'] ) ) {
                $this->add_by_option( $css_rule, yit_get_option( $css_rule['id'] ), $css_rule );
            }
        }
	}

    /**
     * Get all css rules by Theme Options
     *
     * @param $assets | Array the assets list from assets.php file
     * @param $file_name | the cahce filename for ie
     *
     * @return string | minified filename
     * @since 2.0.0
     * @access public
     * Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function create_minified_css( $assets, $file_name ){
        global $wpdb, $wp_current_filter;
        /** WordPress Administration File API */
		require_once(ABSPATH . 'wp-admin/includes/file.php');

        $styles = $assets['style'];
        $file = $this->getModel( 'cache' )->locate_file( $file_name );
        $content = '';
        $after_content = '';

        foreach( $styles as $id => $style ){

            if( is_array( $style ) ){
                if( isset( $style['enqueue'] ) && $style['enqueue'] == true ) {
                    $content .= "/* {$id} - {$style['src']} */\n";
                    $content .= "@import url({$style['src']});\n";
                }else{
                    $after_content .= "/* {$id} - {$style['src']} */\n";
                    $after_content .= "@import url({$style['src']});\n";
                }
            }
        }

        $content = $content . $after_content;
        file_put_contents( $file, $content, FS_CHMOD_FILE );

        return $file_name;
    }

	/**
	 * Generate custom.css file if it doesn't exist
	 *
	 * @return bool
	 * @since 1.0.0
     * @access public
     * Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function custom_file_exists() {
		$file = $this->getModel( 'cache' )->locate_file( $this->_getCustomFilename() );

        if( !file_exists($file) ) {
			return $this->save_css();
		} else {
			return true;
		}
	}

	/**
	 * Enqueue dinamycs.css file
	 *
	 * @return void
	 * @since 1.0.0
     * @access public
     * Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function enqueue_dynamics_css() {

		if( $this->custom_file_exists() ) {
            $args = array(
                'src'       => $this->getModel('cache')->locate_url( $this->_getCustomFilename() ),
                'enqueue'   => true
            );

            YIT_Asset()->set( 'style', 'cache-dynamics', $args );
		}
	}

    /**
	 * Get the stylesheet file name
	 *
	 * @return string
	 * @since 1.0.0
     * @access public
     * Andrea Grillo <andrea.grillo@yithemes.com>
	 */
    public function get_stylesheet_name(){
        return $this->custom_filename;
    }
}

if ( ! function_exists( 'YIT_Css' ) ) {
    /**
     * Return the instance of YIT_Css class
     *
     * @return \YIT_Css
     * @since    2.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function YIT_Css() {
        return YIT_Registry::get_instance()->css;
    }
}
