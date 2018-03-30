<?php

/**
 * Class Radium_Theme_Importer
 *
 * This class provides the capability to import demo content as well as import widgets and WordPress menus
 *
 * Slightly modified for the Wolf Framework by me! (wpwolf)
 *
 * @since 2.3.0
 *
 * @category RadiumFramework
 * @package  NewsCore WP
 * @author   Franklin M Gitonga
 * @link     http://radiumthemes.com/
 *
 */
class Radium_Theme_Importer {

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $theme_options_file;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $widgets;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $content_demo;

	/**
	 * Flag imported to prevent duplicates
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $flag_as_imported = array();

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 2.2.0
	 */
	public function __construct(
			$theme_options_name = null,
			$theme_options_file = null,
			$widgets_file = null,
			$content_file = null,
			$menus = array(),
			$import_content = true,
			$import_widgets = true,
			$import_settings = true
		) {

		self::$instance = $this;
		$this->theme_options_name = $theme_options_name;
		$this->theme_options_file = $theme_options_file;
		$this->widgets_file = $widgets_file;
		$this->content_file = $content_file;
		$this->menus = $menus;
		$this->import_content = $import_content;
		$this->import_widgets = $import_widgets;
		$this->import_settings = $import_settings;
		$this->demo_installer();
	}

	/**
	* [demo_installer description]
	*
	* @since 2.2.0
	*
	* @return [type] [description]
	*/
	public function demo_installer() {

		//var_dump($this->content_demo)

		if ( $this->import_settings ) {
			$this->set_demo_theme_options( $this->theme_options_file );
		}

		if ( $this->import_content ) {
			ini_set( 'max_execution_time', 1200 );
			$this->set_demo_data( $this->content_file );
			$this->set_reading_settings();
			$this->set_woocommerce_pages();
			$this->set_demo_menus();
		}

		if ( $this->import_widgets ) {
			$this->import_widgets( $this->widgets_file );
		}

		// Hook after import
    		do_action( 'wolf_after_demo_data_import' );
	}

	public function set_demo_data( $file ) {

		if ( ! defined('WP_LOAD_IMPORTERS') ) {
			define('WP_LOAD_IMPORTERS', true);
		}

		require_once ABSPATH . 'wp-admin/includes/import.php';

		$importer_error = false;

		if ( ! class_exists( 'WP_Importer' ) ) {

			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

			if ( file_exists( $class_wp_importer ) ) {

				require_once($class_wp_importer);
			} else {

				$importer_error = true;
			}
		}

		if ( !class_exists( 'WP_Import' ) ) {

			$class_wp_import = dirname( __FILE__ ) .'/wordpress-importer.php';

			if ( file_exists( $class_wp_import ) ) 
				require_once($class_wp_import);
			else
				$importer_error = true;

		}

		if($importer_error){

			die("Error on import");

		} else {

			if(!is_file( $file )){

				_e( 'The XML file containing the demo content is not available or could not be read.', 'wolf' );

			} else {

				$wp_import = new WP_Import();
				$wp_import->fetch_attachments = true;
				$wp_import->import( $file );
			}
		}
	}

	public function set_demo_menus() {

		$menu_data = array();

		foreach ( $this->menus as $id => $name ) {
			$menu = get_term_by( 'name', $name, 'nav_menu' );
			$menu_data[$id] = $menu->term_id;
		}

		set_theme_mod( 'nav_menu_locations' , $menu_data );
	}

	public function set_demo_theme_options( $file ) {

		// File exists?
		if ( ! file_exists( $file ) ) {
			wp_die(
				__( 'Theme options Import file could not be found. Please try again.', 'wolf' ),
				'wolf',
				array( 'back_link' => true )
			);
		}

		// Get file contents and decode
		$file_content = file_get_contents( $file );
		$data = @unserialize( $file_content );

		//var_dump($data);

		// Have valid data?
		// If no data or could not decode
		if ( empty( $data ) || ! is_array( $data ) ) {
			wp_die(
				__( 'Theme options import data could not be read. Please try a different file.', 'wolf' ),
				'wolf',
				array( 'back_link' => true )
			);
		}

		// Hook before import
		$data = apply_filters( 'radium_theme_import_theme_options', $data );
		update_option( $this->theme_options_name, $data );
	}

	/**
	 * Import widgets
	 * @param array $data
	 */
	public static function import_widgets( $file ) {

		// File exists?
		if ( ! file_exists( $file ) ) {
			wp_die(
				__( 'Widget Import file could not be found. Please try again.', 'wolf' ),
				'',
				array( 'back_link' => true )
			);
		}

		// Get file contents and decode
		$file_content = file_get_contents( $file );
		$data = json_decode( $file_content );
		$import_array = $data;
		$sidebars_data = (array)$import_array[0];
		$widget_data = (array)$import_array[1];
		$current_sidebars = get_option( 'sidebars_widgets' );
		$new_sidebars = array();
		$new_widgets = array();

		foreach ( $sidebars_data as $import_sidebar => $import_widgets ) {

			foreach ( $import_widgets as $import_widget ) {

				//if the sidebar exists
				if ( isset( $current_sidebars[$import_sidebar] ) ) {

					$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
					$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
					$current_widget_data = get_option( 'widget_' . $title );
					$new_widget_name = self::get_new_widget_name( $title, $index );
					$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

					if ( ! empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
						while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
							$new_index++;
						}
					}
					$new_sidebars[$import_sidebar][] = $title . '-' . $new_index;
					if ( array_key_exists( $title, $new_widgets ) ) {

						$new_widgets[$title][$new_index] = $widget_data->title[$index];
						$multiwidget = $new_widgets[$title]['_multiwidget'];
						unset( $new_widgets[$title]['_multiwidget'] );
						$new_widgets[$title]['_multiwidget'] = $multiwidget;

					} else {

						$current_widget_data[$new_index] = $widget_data->title->index;
						$current_multiwidget = $current_widget_data['_multiwidget'];
						$new_multiwidget = isset($widget_data->title['_multiwidget']) ? $widget_data->title['_multiwidget'] : false;
						$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
						unset( $current_widget_data['_multiwidget'] );
						$current_widget_data['_multiwidget'] = $multiwidget;
						$new_widgets[$title] = $current_widget_data;
					}

				}
			}
		}


		// insert widgets only in empty sidebars
		foreach ( $current_sidebars as $index => $current_sidebar ) {
			if ( ! is_active_sidebar( $index ) ) {
				$current_sidebars[$index] = $new_sidebars[$index];
			}
		}

		if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
			update_option( 'sidebars_widgets', $current_sidebars );

			foreach ( $new_widgets as $title => $content ) {
				$content = apply_filters( 'widget_data_import', $content, $title );
				update_option( 'widget_' . $title, $content );
			}

			return true;
		}

		return false;
	}

	/**
	 *
	 * @param string $widget_name
	 * @param string $widget_index
	 * @return string
	 */
	public static function get_new_widget_name( $widget_name, $widget_index ) {
		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array( );
		foreach ( $current_sidebars as $sidebar => $widgets ) {
			if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
				foreach ( $widgets as $widget ) {
					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}

	/**
	 * Set home and blog page
	 */
	public function set_reading_settings() {
		$home = get_page_by_title( 'Home' );
		$blog = get_page_by_title( 'Blog' );

		if ( ! $blog )
			$blog = get_page_by_title( 'News' );

		$o = array(
			'show_on_front' => 'page',
			'posts_per_page' => 8,
			'thread_comments' => 1,
			'thread_comments_depth ' => 2,
		);

		if ( $blog ) {
			$o['page_for_posts'] = $blog->ID;
		}

		if ( $home ) {
			$o['page_on_front'] = $home->ID;
		}

		foreach ( $o as $k => $v ){
			update_option( $k, $v );
		}
	}

	/**
	 * Set home and blog page
	 */
	public function set_woocommerce_pages() {
		$o = array();
		$shop = get_page_by_title( 'Shop' );
		$cart = get_page_by_title( 'Cart' );
		$checkout = get_page_by_title( 'Checkout' );
		$user_account = get_page_by_title( 'My Account' );

		if ( ! $shop )
			$shop = get_page_by_title( 'Store' );

		if ( $shop ) {
			$o['woocommerce_shop_page_id'] = $shop->ID;
		}

		if ( $cart ) {
			$o['woocommerce_cart_page_id'] = $cart->ID;
		}

		if ( $checkout ) {
			$o['woocommerce_checkout_page_id'] = $checkout->ID;
		}

		if ( $account ) {
			$o['woocommerce_myaccount_page_id'] = $account->ID;
		}

		foreach ( $o as $k => $v ){
			update_option( $k, $v );
		}
	}
} // end class