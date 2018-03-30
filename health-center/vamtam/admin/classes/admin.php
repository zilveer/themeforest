<?php

/**
 * Framework admin enhancements
 *
 * @author Nikolay Yordanov <me@nyordanov.com>
 * @package wpv
 */

/**
 * class WpvAdmin
 */
class WpvAdmin {
	public static $option_pages = array();

	/**
	 * Initialize the theme admin
	 */
	public static function actions() {
		self::$option_pages = array(
			'general' => array(
				__( 'VamTam | General Settings', 'health-center' ),
				__( 'General Settings', 'health-center' ),
			),

			'layout' => array(
				__( 'VamTam | Layout', 'health-center' ),
				__( 'Layout', 'health-center' ),
			),

			'styles' => array(
				__( 'VamTam | Styles', 'health-center' ),
				__( 'Styles', 'health-center' ),
			),

			'import' => array(
				__( 'VamTam | Quick Import', 'health-center' ),
				__( 'Quick Import', 'health-center' ),
			),

			'help' => array(
				__( 'VamTam | help', 'health-center' ),
				__( 'Help', 'health-center' ),
			),
		);

		add_action( 'admin_init', array( 'WpvUpdateNotice', 'check' ) );

		add_action( 'admin_footer', array( __CLASS__, 'icons_selector' ) );

		add_action( 'admin_menu', array( __CLASS__, 'load_menus' ) );
		add_action( 'menu_order', array( __CLASS__, 'reorder_menus' ) );

		add_action( 'add_meta_boxes', array( __CLASS__, 'load_metaboxes' ) );
		add_action( 'save_post', array( __CLASS__, 'load_metaboxes' ) );

		add_action( 'sidebar_admin_setup', array( __CLASS__, 'sidebar_admin_setup' ) );
		add_action( 'wp_ajax_wpv-delete-widget-area', array( 'WpvSidebarInterface', 'delete_widget_area' ) );

		add_filter( 'upload_mimes', array( __CLASS__, 'upload_mimes' ) );

		add_filter( 'admin_notices', array( __CLASS__, 'update_warning' ) );

		require_once WPV_ADMIN_METABOXES . 'shortcode.php';

		self::load_functions();
		new WpvSkinManagement;
		new WpvIconsHelper;
		new WpvFontsHelper;

		require_once WPV_ADMIN_HELPERS . 'updates/version-checker.php';

		if ( ! wpv_get_option( THEME_SLUG.'_vamtam_theme_activated', false ) ) {
			wpv_update_option( THEME_SLUG.'_vamtam_theme_activated', true );
			delete_option( 'default_comment_status' );
		}
	}

	public static function update_warning() {
		if ( did_action( 'load-update-core.php' ) ) {
			echo '<div class="updated fade"><p><strong>'; // xss ok;
			_e( 'Hey, just a polite reminder that if you update WordPress you will also need to update your theme and plugins.', 'health-center' );
			echo '</strong>'; // xss ok
			echo '</p><p>'; // xss ok
			printf( __( 'You should see any available theme updates on this page if you have entered your purchase information in <a href="%s">VamТam/General</a>', 'health-center' ), esc_url( admin_url( 'admin.php?page=wpv_general#purchase-tab-3' ) ) );
			echo '</p><p>'; // xss ok
			_e( "Please note that if we haven't released an update, you shouldn't update your WordPress and plugins until we release one. Otherwise you may run into various compatibility issues.", 'health-center' );
			echo '</p><p>'; // xss ok
			printf( __( 'If you are unsure as to whether it is safe to update your site, please do ask us at <a href="%s">%s</a> and we\'ll help you.', 'health-center' ), esc_url( 'http://support.vamtam.com' ), 'our support site' );
			echo '</p></div>'; // xss ok;
		}
	}

	public static function icons_selector() {
		?>
		<div class="wpv-config-icons-selector hidden">
			<input type="search" placeholder="<?php esc_attr_e( 'Filter icons', 'health-center' ) ?>" class="icons-filter"/>
			<div class="icons-wrapper spinner">
				<input type="radio" value="" checked="checked"/>
			</div>
		</div>
		<?php
	}

	/**
	 * Allow SVG uploads
	 * @param  array  $mimes allowed mime types
	 * @return array         svg added to the allowed mime types
	 */
	public static function upload_mimes( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	/**
	 * Widgets page
	 */
	public static function sidebar_admin_setup() {
		new WpvSidebarInterface;
	}

	/**
	 * Theme admin menus
	 */
	public static function load_menus() {
		global $menu;

		$main = 'wpv_general';

		if ( current_user_can( 'edit_theme_options' ) )
			$menu[] = array( '', 'read', 'separator-vamtam-theme', '', 'wp-menu-separator vamtam-theme' );

		add_menu_page( 'VamTam', 'VamTam', 'edit_theme_options', $main, array( __CLASS__, 'load_options_page' ), 'none', '55.2' );

		foreach ( self::$option_pages as $id => $tr ) {
			add_submenu_page( $main, $tr[0], $tr[1], 'edit_theme_options', "wpv_$id", array( __CLASS__, 'load_options_page' ) );
		}
	}

	/**
	 * Reorder the menu items in admin.
	 *
	 * @param mixed $menu_order
	 * @return void
	 */
	public static function reorder_menus( $menu_order ) {
		// Initialize our custom order array
		$new_menu_order = array();

		// Get the index of our custom separator
		$separator = array_search( 'separator-vamtam-theme', $menu_order );

		$portfolio    = array_search( 'edit.php?post_type=portfolio', $menu_order );
		$testimonials = array_search( 'edit.php?post_type=testimonials', $menu_order );

		// Loop through menu order and do some rearranging
		foreach ( $menu_order as $index => $item ) {
			if ( 'wpv_general' == $item ) {
				$new_menu_order[] = 'separator-vamtam-theme';
				$new_menu_order[] = $item;
				$new_menu_order[] = 'edit.php?post_type=portfolio';
				$new_menu_order[] = 'edit.php?post_type=testimonials';
				unset( $menu_order[$separator] );
				unset( $menu_order[$portfolio] );
				unset( $menu_order[$testimonials] );
			} elseif ( ! in_array( $item, array( 'separator-vamtam-theme' ) ) ) {
				$new_menu_order[] = $item;
			}
		}

		return $new_menu_order;
	}

	/**
	 * Theme options pages callback
	 */
	public static function load_options_page() {
		$page_str = str_replace( 'wpv_', '', $_GET['page'] );
		$page     = WPV_ADMIN_OPTIONS . $page_str . '.php';

		if ( file_exists( $page ) ) {
			$options = include $page;
		} else {
			$name = self::$option_pages[$page_str][0];

			$options = array(
				'name' => $name,
				'auto' => true,
				'config' => array(
					array(
						'name' => $name,
						'type' => 'title',
						'desc' => '',
					),
				),
			);

			$tabs = include WPV_THEME_OPTIONS . $page_str . '/list.php';

			foreach ( $tabs as $tab ) {
				$tab_contents = include WPV_THEME_OPTIONS.$page_str."/$tab.php";

				$options['config'] = array_merge( $options['config'], $tab_contents );
			}
		}

		if ( $options['auto'] )
			new WpvConfigGenerator( $options['name'], $options['config'] );
	}

	/**
	 * Theme metaboxes
	 *
	 * @param int|null $post_id  id of the current post ( if any )
	 */
	public static function load_metaboxes( $post_id = null ) {
		$config = array(
			'id' => 'testimonials-post-options',
			'title' => __( 'VamTam Testimonials', 'health-center' ),
			'pages' => array( 'testimonials' ),
			'context' => 'normal',
			'priority' => 'high',
			'post_id' => $post_id,
		);


		$options = include WPV_THEME_METABOXES . 'testimonials.php';
		new WpvMetaboxesGenerator( $config, $options );


		$config = array(
			'id' => 'vamtam-post-format-options',
			'title' => __( 'VamTam Post Formats', 'health-center' ),
			'pages' => array( 'post' ),
			'context' => 'normal',
			'priority' => 'high',
			'post_id' => $post_id,
		);


		$options = include WPV_THEME_METABOXES . 'post-formats.php';
		new WpvMetaboxesGenerator( $config, $options );

		$config = array(
			'id' => 'vamtam-portfolio-format-options',
			'title' => __( 'VamTam Portfolio Formats', 'health-center' ),
			'pages' => array( 'portfolio' ),
			'context' => 'normal',
			'priority' => 'high',
			'post_id' => $post_id,
		);


		$options = include WPV_THEME_METABOXES . 'portfolio-formats.php';
		new WpvMetaboxesGenerator( $config, $options );

		$config = array(
			'id' => 'vamtam-portfolio-formats-select',
			'title' => __( 'VamTam Portfolio Format', 'health-center' ),
			'pages' => array( 'portfolio' ),
			'context' => 'side',
			'priority' => 'high',
			'post_id' => $post_id,
		);


		$options = include WPV_THEME_METABOXES . 'portfolio-formats-select.php';
		new WpvMetaboxesGenerator( $config, $options );

		$config = array(
			'id' => 'general-post-options',
			'title' => __( 'VamTam Options', 'health-center' ),
			'pages' => WpvFramework::$complex_layout,
			'context' => 'normal',
			'priority' => 'high',
			'post_id' => $post_id,
		);


		$options = include WPV_THEME_METABOXES . 'general.php';
		new WpvMetaboxesGenerator( $config, $options );
	}

	/**
	 * Admin helper functions
	 */
	private static function load_functions() {
		require_once WPV_ADMIN_HELPERS . 'base.php';
		require_once WPV_ADMIN_AJAX_DIR . 'base.php';
		require_once WPV_ADMIN_TYPES . 'portfolio.php';
	}
}
