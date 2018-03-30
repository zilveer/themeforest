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
 * Perform Asset (script and style) init and manage
 *
 * @class YIT_Asset
 * @package    Yithemes
 * @since      2.0.0
 * @author     Your Inspiration Themes
 *
 */
class YIT_Asset extends YIT_Object {
    /**
     * Assets file name
     *
     * @var string
     * @access protected
     */
    protected $_assets_file_name = 'assets.php';

    /**
     * Assets IE8 and IE9 file name
     *
     * @var string
     * @access protected
     */
    protected $_cache_old_ie_file_name = 'ie_assets.css';


    /**
     * Script and Style value
     *
     * @var array
     * @access protected
     */
    protected $_assets = array();


    /**
     * Script and Style default value
     *
     * @var array
     * @access protected
     */
    protected $_assets_default_value = array(
        'style'  => array(
            'deps'          => array(),
            'ver'           => false,
            'media'         => 'all',
            'enqueue'       => false,
            'registered'    => false, // flag to indicate if the asset is already registered
			'use_in_mobile' => true
        ),

        'script' => array(
            'deps'          => array(),
            'ver'           => false,
            'in_footer'     => true,
            'enqueue'       => false,
            'registered'    => false, // flag to indicate if the asset is already registered
			'localize'      => array(),
			'use_in_mobile' => true
        ),
    );

    /**
     *
     * Include the style and scripts file and create the array of style and script to enqueue/register
     * Add the action to register/enqueue script and style on wp_enqueue_scripts
     *
     * @return YIT_Asset
     * @since  2.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function __construct() {

	    $this->_assets  = include( YIT_THEME_PATH . '/' . $this->_assets_file_name );

	    add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 99 );
        add_action( 'wp_footer', array( $this, 'register_assets' ), 1 );
    }

    /**
     *
     * Return the style and script array to enqueue/register
     *
     * @return array
     *
     * @since  2.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */

    public function get() {
        return $this->_assets;
    }

    /**
     *
     * Add a script or a style from enqueue array
     *
     * @param string $type
     * @param string $id
     * @param array  $options
     * @param string $where (first, last, after, before) (optional, default: last)
     * @param string $who   (optional, default: empty string)
     *
     * @return void
     *
     * @since  2.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function set( $type, $id, $options, $where = 'last', $who = '' ) {

        $assets_to_add = array(
            $id => $options,
        );

        if ( $type == 'script' || $type == 'style' ) {

            switch ( $where ) {

                case 'first':
                    $this->_assets[$type] = array_merge( $assets_to_add, $this->_assets[$type] );
                    break;

                case 'last':
                    $this->_assets[$type] = array_merge( $this->_assets[$type], $assets_to_add );
                    break;

                case 'before':
                case 'after' :

                    if ( array_key_exists( $who, $this->_assets[$type] ) ) {

                        $who_position = array_search( $who, array_keys( $this->_assets[$type] ) );

                        if ( $where == 'after' ) {
                            $who_position = ( $who_position + 1 );
                        }

                        $before = array_slice( $this->_assets[$type], 0, $who_position );
                        $after  = array_slice( $this->_assets[$type], $who_position );

                        $this->_assets[$type] = array_merge( $before, $assets_to_add, $after );
                    }
                    break;
            }
        }
    }

    /**
     *
     * Remove a script or a style from enqueue array
     *
     * @param string $type
     * @param string $id
     *
     * @return void
     *
     * @since  2.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function remove( $type, $id ) {
        if ( array_key_exists( $id, $this->_assets[$type] ) ) {
            unset( $this->_assets[$type][$id] );
        }
    }

    /**
     *
     * Register and Enqueue Script and Style
     *
     * @return void
     *
     * @since  2.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function register() {

        foreach ( $this->_assets as $type => $assets ) {
            foreach ( $assets as $handle => $args ) {
                $args = wp_parse_args( $args, $this->_assets_default_value[$type] );
                if ( $args['registered'] ) {
                    continue;
                }

                $function_register = 'wp_register_' . $type;
                $function_enqueue  = 'wp_enqueue_' . $type;
                extract( $args );

                // set in_footer or media
                $last_param = false;
                if ( 'style' == $type ) {
                    $last_param = $media;
                }
                elseif ( 'script' == $type ) {
                    $last_param = $in_footer;

                    // localize
                    if ( isset( $args['localize'] ) && ! empty( $args['localize'] ) ) {
                        wp_localize_script( $handle, str_replace( '-', '_', sanitize_title( $handle ) ), $args['localize'] );
                    }
                }

                // Register
                $function_register( $handle, $src, $deps, $ver, $last_param );

                // enqueue
                if ( $enqueue && ( $use_in_mobile || ! YIT_Mobile()->isMobile() ) ) {
                    $function_enqueue( $handle );
                }

                $args['registered'] = true;
            }
        }
    }

    /**
     *
     * Register and Enqueue Script and Style for old version of IE
     *
     * @return void
     *
     * @since  2.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function register_assets(){

        global $wp_current_filter, $wpdb;

	    $is_old_ie      = yit_is_old_ie();

	    if( ! $is_old_ie ){
		    $this->register();
	    }
	    else {

		    $index = $wpdb->blogid != 0 ? '-' . $wpdb->blogid : '';
		    $this->_cache_old_ie_file_name = str_replace( '.css', $index . '.css', $this->_cache_old_ie_file_name );

		    $wp_enqueue_style = in_array( 'wp_enqueue_scripts', $wp_current_filter ) ? true : false;

		    if ( $wp_enqueue_style ) {
			    $yit_ie_cache_transient      = get_site_transient( 'yit_ie_old_cache_file' );
			    $yit_ie_responsive_transient = get_site_transient( 'yit_ie_responsive' );
			    $enable_responsive           = yit_get_option( 'general-activate-responsive' );

			    if ( false === $yit_ie_cache_transient ) {
				    set_site_transient( 'yit_ie_old_cache_file', ( time() + ( 48 * HOUR_IN_SECONDS ) ) );
			    }

			    if ( false === $yit_ie_responsive_transient ) {
				    set_site_transient( 'yit_ie_responsive', yit_get_option( 'general-activate-responsive' ) );
			    }

			    if ( $yit_ie_cache_transient < time() || ! file_exists( $this->getModel( 'cache' )->locate_file( $this->_cache_old_ie_file_name ) ) || $yit_ie_responsive_transient != $enable_responsive ) {
				    $enable_responsive == 'yes' ? $this->remove( 'style', 'non-responsive' ) : $this->remove( 'style', 'responsive' );
				    $file = $this->getModel( 'css' )->create_minified_css( $this->_assets, $this->_cache_old_ie_file_name );
				    set_site_transient( 'yit_ie_old_cache_file', ( time() + ( 48 * HOUR_IN_SECONDS ) ) );
				    set_site_transient( 'yit_ie_responsive', $enable_responsive );
			    }

			    foreach ( $this->_assets['style'] as $id => $style ) {
				    if ( isset( $style['enqueue'] ) && $style['enqueue'] ) {
					    $this->remove( 'style', $id );
					    wp_deregister_style( $id );
				    }
			    }

			    $ie_cache_file = array(
				    'src'     => $this->getModel( 'cache' )->locate_url( $this->_cache_old_ie_file_name ),
				    'enqueue' => true,
			    );

			    $asset_id = str_replace( '.css', '', $this->_cache_old_ie_file_name );

			    $where = 'first';
			    $who   = '';
			    $this->set( 'style', $asset_id, $ie_cache_file, $where, $who );
		    }

		    $this->register();

	    }
    }

    /**
     *
     * Register and Enqueue Script and Style for old version of IE
     *
     * @param $asset_uri
     * @param $type | you can use style or script
     *
     * @return mixed | The asset handle if exist, false otherwise
     *
     * @since  2.0.0
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function get_stylesheet_handle( $asset_uri, $type ) {

        if( isset( $asset_uri ) && ! empty( $asset_uri ) ){
            foreach( $this->_assets[ $type ] as $handle => $asset ) {

//                if( is_ssl() ){
//                    $asset_uri = str_replace( 'https', 'http', $asset_uri );
//                }

                if( $asset['src'] === $asset_uri ) {
                    return $handle;
                }
            }
        }

        return false;
    }

    /**
     *
     * Dequeue Script and Style
     *
     * @param $type | you can use style or script
     *
     * @param $exclude | Array of scripts or styles handle to exclude
     *
     * @return bool | Return false if an error occured
     *
     * @since    2.0.0
     * @access public
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function dequeue_all( $type, $exclude = array() ) {

        if( 'style' != $type && 'script' != $type ){
            return false;
        }

        $assets          = $this->get();
        $dequeue         = $assets[ $type ];
        $dequeue_method  = 'wp_dequeue_' . $type;

        foreach( $dequeue as $handle => $args ){
            if ( empty( $exclude ) || ( ! empty( $exclude ) && ! in_array( $handle, $exclude ) ) ) {
                $dequeue_method( $handle ) ;
            }
        }
    }
}

if ( ! function_exists( 'YIT_Asset' ) ) {
    /**
     * Return the instance of YIT_Asset class
     *
     * @return \YIT_Asset
     * @since    2.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function YIT_Asset() {
        return YIT_Registry::get_instance()->asset;
    }
}
