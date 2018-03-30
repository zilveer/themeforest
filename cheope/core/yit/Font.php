<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Fonts handler.
 * It can handle Goolge Fonts and Web fonts
 * @since 1.0.0
 */
class YIT_Font {
    /**
     * Web fonts array
     *
     * @var array
     * @since 1.0.0
     */
    public $web;

    /**
     * Google fonts array
     *
     * @var array
     * @since 1.0.0
     */
    public $google;

    /**
     * Set web and google fonts
     *
     * @since 1.0.0
     */
    public function __construct() {}

	/**
	 * Init
	 *
	 */
	public function init() {

        $this->web = $this->_get_web_fonts();
        $this->google = $this->_get_google_fonts();
        $theme_options_fonts = yit_get_option_by( 'type', 'typography' );

        add_action( 'init', array( &$this, 'load_options_font' ) );
    }

    /**
     * Load Google Fonts stylesheets
     *
     * @return void
     * @since 1.0.0
     */
    public function load_options_font() {
        $theme_options_fonts = yit_get_option_by( 'type', 'typography' );
        $google_fonts        = array_map( 'stripslashes', ( array ) $this->google->items );

        foreach( $theme_options_fonts as $option ) {
            $option_value = yit_get_option( $option['id'] );

            // Prevent Undefined Index
            if ( ! array_key_exists( 'family', $option_value ) ) {
                continue;
            }

            if( $option_value['family'] != $option['std']['family'] ) {
                $family = $option_value['family'];
            } else {
                $family = $option['std']['family'];
            }

            if( in_array( $family, $google_fonts ) ) {
                yit_add_google_font( $family );
            }
        }
    }

    /**
     * Save json Google Fonts in the cache
     *
     * @return void
     * @since 1.0.0
     */
    public function retrieve_google_fonts_callback() {
        if( isset( $_POST['google_fonts'] ) ) {
            $fonts = $_POST['google_fonts'];
            $fonts = apply_filters( 'yit_google_fonts', $fonts );

            $cache = yit_get_model( 'cache' );
            if( $cache->is_expired( 'google_fonts.json' ) ) {
                $cache->save( 'google_fonts.json', json_encode( $fonts ) );
            }
        }

        die();
    }

    /**
     * Get a list of web fonts
     *
     * @return array
     * @since 1.0.0
     */
    protected function _get_web_fonts() {
        $fonts = array(
            'Arial' => 'Arial, Helvetica',
            'Arial Black' => '"Arial Black", Gadget',
            'Comic Sans MS' => '"Comic Sans MS", cursive',
            'Courier New' => '"Courier New", Courier, monospace',
            'Georgia' => 'Georgia',
            'Impact' => 'Impact, Charcoal',
            'Lucida Console' => '"Lucida Console", Monaco, monospace',
            'Lucida Sans Unicode' => '"Lucida Sans Unicode", "Lucida Grande"',
            'Thaoma' => 'Tahoma, Geneva',
            'Trebuchet MS' => '"Trebuchet MS", Helvetica',
            'Verdana' => 'Verdana, Geneva'
        );

        return apply_filters( 'yit_web_fonts', $fonts );
    }

    /**
     * Get a list of google fonts
     *
     * @return array
     * @since 1.0.0
     */
    protected function _get_google_fonts() {
        return json_decode( yit_get_json_google_fonts() );
    }
}

if( !function_exists( 'yit_get_google_fonts' ) ) {
    /**
     * Return google fonts list
     *
     * @return object
     * @since 1.0.0
     */
    function yit_get_google_fonts() {
        $font = yit_get_model( 'font' );
        return $font->google;
    }
}

if( !function_exists( 'yit_get_web_fonts' ) ) {
    /**
     * Return web fonts list
     *
     * @return array
     * @since 1.0.0
     */
    function yit_get_web_fonts() {
        $font = yit_get_model( 'font' );
        return $font->web;
    }
}

if( !function_exists('yit_get_json_google_fonts')) {
    function yit_get_json_google_fonts() {
        $google_fonts   = 'google_fonts.json';
        $file           = apply_filters( 'yit_google_fonts_json_file_path', YIT_CORE_ASSETS . "/fonts/google-fonts/{$google_fonts}" );
        return file_exists( $file ) ? file_get_contents( $file ) : '';
    }
}

if( !function_exists('yit_get_json_web_fonts')) {
    function yit_get_json_web_fonts() {
        $font = yit_get_model( 'font' );
        return json_encode( array('items'=>array_keys($font->web)) );
    }
}
