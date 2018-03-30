<?php
/*
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
 *
 *
 * @class Skin
 * @package    Yithemes
 * @since      Version 2.0.0
 * @author     Andrea Grillo <andrea.grillo@yithemes.com>
 *
 */

class YIT_Skins extends YIT_Object {

	public $current_skin;

	protected $_skins_path = '';

    protected $_skins_list = array();

    protected $_skins_list_file = 'skins.php';

	public function __construct() {

		if( defined( 'YIT_HAS_SKINS' ) && ! YIT_HAS_SKINS ){
			return false;
		}

		$this->_skins_path = YIT_THEME_ASSETS_PATH . '/skins/';
		$skins_file = YIT_THEME_PATH . '/' . $this->_skins_list_file;

		if( file_exists( $skins_file ) ){
			$this->_skins_list = include( $skins_file );
		}

		add_action( 'admin_init', array( $this, 'init' ) );
		add_filter( 'yit_dynamics_style', array( $this, 'add_css_to_dynamic' ) );
	}

	public function init() {

		add_action( 'admin_enqueue_scripts', array( $this, 'skins_localize_script' ) );
		add_action( 'wp_ajax_yit_change_skin', array( $this, 'change_skin' ) );
		add_action( 'wp_ajax_yit_reset_skin', array( $this, 'reset_skin' ) );

		if ( isset( $_GET['yith_new_skin'] ) ) {
			$this->create_skin();
		}
	}

	public function create_skin() {

		$options = $this->getModel( 'options' )->get_options_from_prefix( $this->getModel('options')->options_name );
		$skin    = isset( $_GET['skin_name'] ) ? $_GET['skin_name'] : 'skin_' . time();

		array_walk_recursive( $options, array( $this->getModel( 'backup_reset' ), 'convert_url' ), 'in_export' );
		file_put_contents( $this->_skins_path . $skin, base64_encode( serialize( $options ) ), FS_CHMOD_FILE );
	}

	/**
	 * Return the skin save in the database
	 *
	 * @return string
	 * @since  Version 1.0.0
	 * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
	 */
	public function get_skin() {
		return $this->getModel( 'options' )->get_option( 'general-skin' );
	}

	/**
	 * Return the skin save in the database
	 *
	 * @return string
	 * @since  Version 1.0.0
	 * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
	 */
	public function save_skin_option( $skin ) {
		return $this->getModel( 'options' )->update_option( 'general-skin', $skin );
	}

	public function change_skin() {

		$panel = $this->getModel( 'panel' )->get_panel();

		$skin         = $this->request->post( 'general_skin' );
		$skin_file    = $this->_skins_path . $skin;

		if ( ! file_exists( $skin_file ) ) {
			$this->getModel( 'message' )->addMessage( __( "There isn't any skin with this name", 'yit' ), 'error', 'panel' );
			$this->getModel( 'message' )->printMessages();
			die();
		}

		$skin_options = unserialize( base64_decode( file_get_contents( $skin_file ) ) );
        array_walk_recursive( $skin_options, array( $this->getModel( 'backup_reset' ), 'convert_url' ), 'in_import' );
		$defaults     = $this->getModel( 'options' )->get_default_options();

		$this->save_skin_option( $this->request->post( 'general_skin' ) );

		foreach ( $panel as $themeoptions => $sections ) {
			foreach ( $sections as $pages => $subpages ) {
				foreach ( $subpages as $key => $options ) {
					foreach ( $options as $k => $option ) {
						if ( isset( $option['in_skin'] ) && $option['in_skin'] ) {
							//$value = is_array( $skin_options['yit-panel-options_' . get_template()][ $option['id'] ] ) ? $skin_options['yit-panel-options_' . get_template()][ $option['id'] ] : array( $skin_options['yit-panel-options_' . get_template()][ $option['id'] ] );
							$value = $skin_options[$option['id']];
							$this->getModel( 'options' )->update_option( $option['id'], $value );

							$defaults[$option['id']] = $value;
						}
					}
				}
			}

		}

		// save the default options in the database
		update_option( $this->getModel( 'options' )->options_name . '_defaults', $skin != 'default' ? $defaults : false );

		// add the skin css stylesheet in to the dynamic css file
		$this->getModel('css')->save_css();

		$this->getModel( 'options' )->update_db_options();
		$this->getModel( 'message' )->addMessage( __( 'Please wait, Theme Options reloading...', 'yit' ), 'updated', 'panel' );
		$this->getModel( 'message' )->printMessages();
		die();
	}

	public function reset_skin() {
		$this->change_skin();
	}

	public function skins_localize_script() {
		wp_localize_script( 'yit-panel', 'skins', array(
			'change' => __( 'Are you sure you want to active "%skin_name%" skin?', 'yit' ),
			'reset' => __( 'Are you sure you want to reset "%skin_name%" skin to default values?', 'yit' ),
		) );
	}

	/**
	 * Get the css code of a specific stylesheet of current skin
	 *
	 * @return string
	 * @since  1.0.0
	 * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
	 */
	public function get_stylesheet_css() {

		$skin = $this->get_skin();
		$skin_css = $this->_skins_path . $skin . '.css';

		if ( ! file_exists( $skin_css ) ) {
			return;
		}

		// write file content into dynamic css
		return file_get_contents( $skin_css );
	}

	/**
	 * Used in 'yit_dynamics_style' filter
	 *
	 * @param $css
	 *
	 * @return string
	 * @since  1.0.0
	 * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
	 */
	public function add_css_to_dynamic( $css ) {
		$skin_css = $this->get_stylesheet_css();

		if ( empty( $skin_css ) ) {
			return $css;
		}

		return $css . "\n\n/* " . $this->get_skin() . " Skin */\n" . $this->get_stylesheet_css();
	}

    public function get_skins_list(){
        return $this->_skins_list;
    }
}