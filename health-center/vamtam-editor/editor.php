<?php
/*
Plugin Name: Vamtam visual editor
Plugin URI: http://vamtam.com
Description: A drag and drop content editor
Version: 1
Author: Vamtam
Author URI: http://vamtam.com
License:
*/

/**
 * @package wpv
 * @subpackage editor
 */

if ( !defined( 'ABSPATH' ) ) die( 'Move along, nothing to see here.' );

class WPV_Editor {
	private $shortcodes = array(
		'accordion',
		'blank',
		'blockquote',
		'blog',
		'column',
		'contact_info',
		'divider',
		'flickr',
		'gmap',
		'iframe',
		'linkarea',
		'portfolio',
		'price',
		'services',
		'services_expandable',
		'sitemap',
		'slogan',
		'tabs',
		'team_member',
		'text',
		'text_divider',
		'wpv_progress',

		// third-party
		'contact-form-7',
		'layerslider',
		'rev_slider',

		// third party, but partially implemented by us
		'wpv_featured_products',
		'wpv_tribe_events',
	);

	private $handlers = array(
		'accordion',
		'blank',
		'blockquote',
		'blog',
		'column',
		'contact_info',
		'divider',
		'flickr',
		'gmap',
		'iframe',
		'linkarea',
		'portfolio',
		'price',
		'services',
		'services_expandable',
		'sitemap',
		'slider',
		'slogan',
		'tabs',
		'team_member',
		'text',
		'text_divider',
		'wpv_progress',

		'wpv_featured_products',
		'wpv_tribe_events',
	);

	private static $instance;

	private $kses_args = array(
		'a' => array(
			'href' => array(),
			'title' => array(),
			'target' => array(),
		),
		'br' => array(),
		'em' => array(),
		'strong' => array()
	);

	public function __construct() {
		$this->is_plugin = !defined( 'VAMTAM_EDITOR_IN_THEME' );

		if ( $this->is_plugin && !load_plugin_textdomain( 'editor', false, '../languages/' ) )
			load_plugin_textdomain( 'editor', false, dirname( plugin_basename( __FILE__ ) ) . '/po/' );

		$this->url = $this->is_plugin ? plugin_dir_url( __FILE__ ) : THEME_URI.'vamtam-editor/';
		$this->dir = realpath( dirname( __FILE__ ) ).'/';
		$this->generators_dir = $this->dir . 'shortcodes/config/';
		$this->handlers_dir   = $this->dir . 'shortcodes/handlers/';
		define( 'WPV_EDITOR_ASSETS', $this->url . 'assets/' );
		define( 'WPV_EDITOR_ASSETS_DIR', $this->dir . 'assets/' );

		add_action( 'admin_init', array( &$this, 'admin_init' ), 0, 999 );
		add_action( 'admin_enqueue_scripts', array( &$this, 'enqueues' ) );
		add_action( 'init', array( &$this, 'setup_shortcodes' ) );
		add_filter( 'vamtam-editor-available-shortcodes', array( &$this, 'third_party_shortcodes' ) );

		add_filter('wpv_escaped_shortcodes', array( __CLASS__, 'escape_shortcodes' ) );

		require_once 'ajax.php';
	}

	public static function escape_shortcodes($codes) {
		$codes = array_merge(array_keys(include('available-shortcodes.php')), $codes);
		$codes[] = 'wpv_tribe_events';
		$codes[] = 'wpv_featured_products';
		$codes[] = 'tab';
		$codes[] = 'pane';
		$codes[] = 'split';
		$codes[] = 'column(?:_\d+)?';

		return $codes;
	}

	public function third_party_shortcodes( $available_shortcodes ) {
		if ( in_array( 'layerslider/layerslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
			$available_shortcodes['layerslider'] = 'layouts';

		if ( in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
			$available_shortcodes['rev_slider'] = 'layouts';

		if ( class_exists( 'WPCF7_ContactForm' ) )
			$available_shortcodes['contact-form-7'] = 'layouts';

		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
			$available_shortcodes['wpv_featured_products'] = 'layouts';

		if ( in_array( 'the-events-calendar/the-events-calendar.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
			$available_shortcodes['wpv_tribe_events'] = 'layouts';

		return $available_shortcodes;
	}

	public static function array_pluck( $key, $array ) {
		if ( is_array( $key ) || !is_array( $array ) ) return array();
		$funct = create_function( '$e', '$e = (array)$e; return is_array($e) && array_key_exists("'.$key.'",$e) ? $e["'. $key .'"] : null;' );
		return array_map( $funct, $array );
	}

	public static function get_wpcf7_posts( $by = 'ID' ) {
		if ( !class_exists( 'WPCF7_ContactForm' ) ) return array();

		$posts = get_posts( array(
				'posts_per_page' => -1,
				'post_type' => WPCF7_ContactForm::post_type,
			) );

		$data = self::array_pluck( $by, $posts );

		return array_combine( $data, $data );
	}

	public function setup_shortcodes() {
		foreach ( $this->handlers as $h ) {
			require_once "{$this->handlers_dir}{$h}.php";
		}
	}

	public function admin_init() {
		// add_action('after_setup_theme', array(&$this, 'map_shortcodes'));
		add_action( 'edit_post', array( &$this, 'save_meta' ) );

		// for now, you must explicitly set which post types can use the editor
		$post_types = WpvFramework::$complex_layout;
		foreach ( $post_types as $type ) {
			add_meta_box( 'wpv_visual_editor', __( 'Visual Editor', 'health-center' ), array( &$this, 'editor' ), $type, 'advanced', 'low' );
		}

		$this->map_shortcodes();
	}

	public function enqueues() {
		wp_enqueue_script( 'wpv-editor', $this->url . 'assets/js/editor.js', array( 'jquery', 'jquery-ui-tabs', 'jquery-ui-accordion', 'jquery-ui-droppable', 'jquery-ui-draggable', 'underscore' ), false, true );

		wp_enqueue_style( 'wpv-editor', $this->url . 'assets/css/editor.css' );

		wp_localize_script( 'wpv-editor', 'WPVED_LANG', array(
				'empty_notice' => __( 'Please drag  any element you want here.', 'health-center' ),
			) );
	}

	/**
	 * outputs the basic html code for the editor in a meta box
	 */
	public function editor( $post, $metabox ) {
		include 'editor-tpl.php';
	}

	/**
	 * save some meta fields which are used to preserve the state of the editor
	 */
	public function save_meta( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;

		$fields = array( '_wpv_ed_js_status' );

		foreach ( $fields as $f ) {
			if ( isset( $_POST[$f] ) && !empty( $_POST[$f] ) ) {
				update_post_meta( $post_id, $f, trim( $_POST[$f] ) );
			} else {
				delete_post_meta( $post_id, $f );
			}
		}
	}

	/**
	 * map the shortcode configuration generator files to $wpv_sc and $wpv_sc_menus
	 */

	public function map_shortcodes() {
		global $wpv_sc, $wpv_sc_menus;
		$wpv_sc = array();
		$wpv_sc_menus = array();

		$available_shortcodes = apply_filters( 'vamtam-editor-available-shortcodes', include 'available-shortcodes.php' );

		$sorted = array();

		foreach ( $this->shortcodes as $slug ) {
			if ( isset( $available_shortcodes[$slug] ) ) {
				$shortcode_options = include $this->generators_dir . $slug . '.php';

				$wpv_sc[$slug] = $shortcode_options;

				$sorted[$slug] = $shortcode_options['name'];
			}
		}

		asort( $sorted );

		foreach ( $sorted as $slug => $name ) {
			$wpv_sc_menus[$available_shortcodes[$slug]][] = $slug;
		}
	}

	private function complex_elements() {
		global $wpv_sc, $wpv_sc_menus;

		foreach ( $wpv_sc_menus as $menu_name => $menu_codes ): ?>
			<li class='<?php echo esc_attr( $menu_name )?>'>
				<ul>
					<?php foreach ( $menu_codes as $slug ): ?>
						<?php
							$id    = "shortcode-$slug";
							$class = '';

							if ( $slug === 'column' )
								$id = $class = 'column-11';
						?>
						<li>
							<a id="<?php echo esc_attr($id) ?>" class="<?php echo esc_attr($class) ?> droppable_source clickable_action" href="javascript:void(0)">
								<?php
									if ( isset( $wpv_sc[$slug]['icon'] ) ):
										$icon = $wpv_sc[$slug]['icon'];
								?>
									<span class="shortcode-icon" style="font-size:<?php echo esc_attr($icon['size']) ?>;font-family:<?php echo esc_attr($icon['family']) ?>;line-height:<?php echo esc_attr($icon['lheight']) ?>"><?php echo esc_html($icon['char']) ?></span>
								<?php endif ?>
								<span class="title"><?php echo esc_html($wpv_sc[$slug]['name']) ?></span>
							</a>
							<?php if ( isset( $wpv_sc[$slug]['desc'] ) ): ?>
								<div class="description">
									<span class="description-trigger va-icon va-icon-info"></span>
									<div>
										<section class="content"><?php echo wp_kses($wpv_sc[$slug]['desc'], $this->kses_args) ?></section>
										<footer><a href="<?php echo esc_attr(admin_url( 'admin.php?page=wpv_help' )) ?>" title="<?php _e( 'Read more in our documentation', 'health-center' ) ?>"><?php _e( 'Read more in our documentation', 'health-center' ) ?></a></footer>
									</div>
								</div>
							<?php endif ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</li>
		<?php endforeach;
	}

	public static function get_icon( $key ) {
		$icons = include WPV_EDITOR_ASSETS_DIR . 'fonts/icomoon/list.php';

		if ( isset( $icons[$key] ) )
			return "&#{$icons[$key]};";

		return $key;
	}

	public static function get_instance() {
		if ( !isset( self::$instance ) )
			self::$instance = new self;

		return self::$instance;
	}
}

WPV_Editor::get_instance();
