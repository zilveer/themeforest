<?php
require_once CT_THEME_SHORTCODES_DIR.'/ctShortcodeDecorator.class.php';

/**
 * Handles shortcodes
 */
class ctShortcodeHandler {

	/**
	 * Shortcodes
	 * @var ctShortcode[]
	 */

	protected static $shortcodes = array();

	/**
	 * Group cache
	 * @var array
	 */

	protected static $groups = array();

	/**
	 * Shortcode names
	 * @var array
	 */

	protected static $shortcodeNames = array();

	/**
	 * Instance
	 * @var ctShortcodeHandler
	 */

	protected static $instance;

	/**
	 * Registers new shortcode
	 *
	 * @param ctShortcode $shortcode
	 */
	public static function register( $shortcode ) {
		self::$shortcodes[ $shortcode->getGroupName() ][ $shortcode->getShortcodeName() ] = $shortcode;
		self::$groups[ $shortcode->getShortcodeName() ]                                   = $shortcode->getGroupName();

		self::$shortcodeNames[] = $shortcode->getShortcodeName();
	}

	/**
	 * Returns shortcode names
	 * @return array
	 */

	public function getShortcodeNames() {
		return self::$shortcodeNames;
	}

	/**
	 * Returns shortcode
	 * @return array|ctShortcode[]
	 */

	public function getShortcodes() {
		return self::$shortcodes;
	}

	/**
	 * Returns shortcode
	 *
	 * @param string $id
	 *
	 * @return ctShortcode
	 */
	public function getShortcode( $id ) {
		if ( ! $id ) {
			return null;
		}

		if ( isset( self::$groups[ $id ] ) && ( $group = self::$groups[ $id ] ) ) {
			return isset( self::$shortcodes[ $group ][ $id ] ) ? self::$shortcodes[ $group ][ $id ] : null;
		}

		return null;
	}

	/**
	 * Return groups
	 * @return array
	 */

	public static function getGroups() {
		$groups = array_unique( array_values( self::$groups ) );
		if ( ( $index = array_search( 'Internal', $groups ) ) !== false ) {
			unset( $groups[ $index ] );
		}

		return $groups;
	}

	/**
	 * Returns instance
	 * @return ctShortcodeHandler
	 */

	public static function getInstance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
			self::$instance->initialize();
		}

		return self::$instance;
	}

	protected function __construct() {
		define( 'CT_SHORTCODE_TINYMCE_URI', CT_THEME_LIB_DIR_URI . '/shortcodes/tinymce' );
		define( 'CT_SHORTCODE_TINYMCE_DIR', CT_THEME_LIB_DIR . 'tinymce' );

		add_action( 'init', array( &$this, 'init' ) );
		//todo - only in tinymce
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		add_action( 'admin_head', array( &$this, 'print_scripts' ) );

//		add_action('wp_ajax_theme-shortcode-menu', array(&$this, 'menu'));
		add_action( 'wp_ajax_theme-shortcode-popup', array( &$this, 'popup' ) );
		add_action( 'wp_ajax_theme-shortcode-preview', array( &$this, 'preview' ) );
	}

	/**
	 * Shortcodes menu
	 */

	public function menu( $echo = true ) {
		$shortcodes = self::getInstance()->getShortcodes();
		$result     = array();
		foreach ( self::getGroups() as $group ) {

			$node         = array();
			$node['text'] = $group;

			/** @var $shortcode ctShortcode */
			foreach ( $shortcodes[ $group ] as $shortcode ) {
				//$node['menu'][] = array('text'=>$shortcode->getShortcodeMenuItem());
				$node['menu'][] = array_merge( $shortcode->getShortcodeMenuItem(), array( 'text' => $shortcode->getName() ) );
			}
			$result[] = $node;
		}
		$result = apply_filters( 'ct.shortcode_handler.menu', $result );
		if ( $echo ) {
			echo json_encode( $result );
		} else {
			return $result;
		}
		//exit;
	}

	/**
	 * Shortcode preview
	 */

	public function preview() {

		if ( ! is_admin() ) {
			exit;
		}

		//init session - we cannot go with GET cause suhosin patch
		if ( ! session_id() ) {
			session_start();
		}

		if ( isset( $_POST['shortcode'] ) ) {


			$_SESSION['ct_shortcode_preview'] = $_POST['shortcode'];
			var_dump( $_SESSION['ct_shortcode_preview'] );
			exit;
		}

		$shortcode = $_SESSION['ct_shortcode_preview'];

		require CT_THEME_SHORTCODES_DIR . '/view/preview.php';
		exit;
	}

	/**
	 * Popup menu
	 */

	public function popup() {
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_style( 'global' );
		wp_enqueue_style( 'wp-admin' );
		wp_enqueue_style( 'colors' );
		wp_enqueue_style( 'ie' );

		add_thickbox();

		wp_dequeue_script( 'theme-shortcode-menu' );

		wp_register_script( 'theme-shortcode-dialog', CT_SHORTCODE_TINYMCE_URI . '/dialog.js', array(
			'jquery',
			'common'
		) );
		wp_enqueue_script( 'theme-shortcode-dialog' );

		if ( defined( 'ICL_SITEPRESS_VERSION' ) && ICL_SITEPRESS_VERSION == '2.0.4.1' ) {
			wp_dequeue_script( 'sitepress-translation-management' );
		}
		if ( ! $shortcode = self::getInstance()->getShortcode( $_GET['id'] ) ) {
			exit( "No shortcode found" );
		}

		if ( $child = $shortcode->getChildShortcode() ) {
			$shortcodes = array();
			$childInfo  = $shortcode->getChildShortcodeInfo();
			$max        = isset( $childInfo['default_qty'] ) ? $childInfo['default_qty'] : 1;

			for ( $x = 0; $x < $max; $x ++ ) {
				$shortcodes[] = $child;
			}
		} else {
			$shortcodes = array( $shortcode );
		}

		$defaultView = CT_THEME_SHORTCODES_DIR . '/view/popup.php';

		if ( $e = $shortcode->getCustomFormView( array( 'template' => $defaultView ) ) ) {
			echo $e;
			exit;
		} else {
			$decorator = new ctShortcodeDecorator( $shortcodes, false, (bool) $child );
			if ( (bool) $child ) {
				$decorator->setParentShortcode( $shortcode );
			}

			require $defaultView;
		}
		exit;
	}

	/**
	 * Initializes
	 */

	public function initialize() {
		//add scripts
		require_once CT_THEME_LIB_DIR . '/shortcodes/ctShortcodeQueryable.class.php';
		//load all shortcodes
		ctThemeLoader::getFilesLoader()->includeOnceByPattern( CT_THEME_SHORTCODE_DIR, '*/*.php' );
	}

	/**
	 * Attach plugins
	 */

	function init() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}

		if ( get_user_option( 'rich_editing' ) == 'true' ) {
			add_filter( 'mce_external_plugins', array( $this, 'add_rich_plugins' ) );
			//add_filter('wp_fullscreen_buttons', array($this, 'register_rich_buttons_fullscreen'));
			add_filter( 'mce_buttons', array( $this, 'register_rich_buttons' ) );
		}

		// Add button to Fullscreen editor
		add_filter( 'wp_fullscreen_buttons', array( &$this, 'add_fullscreen_button' ) );
	}

	// applied to the array of fullscreen butons
	function add_fullscreen_button( $buttons ) {
		$buttons[]            = 'separator';
		$buttons['shortcode'] = array(
			'title'   => esc_html__( 'shortcode', 'ct_theme' ),
			'both'    => true,
			'onclick' => ""
		);

		return $buttons;
	}

	/**
	 * FFullscreen buttons
	 *
	 * @param $buttons
	 */


	/**
	 * @param $plugin_array
	 *
	 * @return mixed
	 */
	function add_rich_plugins( $plugin_array ) {
		global $wp_version;
		$name = 'plugin.js';

		//old TinyMCE 3 has different API
		if ( version_compare( $wp_version, '3.9' ) < 0 ) {
			$name = 'plugin_legacy.js';
		}

		$plugin_array['ctShortcode'] = CT_SHORTCODE_TINYMCE_URI . '/' . $name;

		return $plugin_array;
	}

	/**
	 * @param $buttons
	 *
	 * @return mixed
	 */
	function register_rich_buttons( $buttons ) {
		array_push( $buttons, "|", 'ctShortcode' );

		return $buttons;
	}

	function admin_init() {
		wp_register_script( 'theme-shortcode-menu', CT_SHORTCODE_TINYMCE_URI . '/shortcode-menu.js', array( 'jquery' ) );
		wp_enqueue_script( 'theme-shortcode-menu' );

		wp_register_script( 'jquery-buttonMenu', CT_SHORTCODE_TINYMCE_URI . '/buttonMenu.js', array( 'jquery' ) );
		wp_enqueue_script( 'jquery-buttonMenu' );
	}

	protected $scripts_printed = false;

	// print scripts
	function print_scripts() {
		if ( $this->scripts_printed == true ) {
			return;
		}
		$this->scripts_printed = true;
		?>
		<script type="text/javascript">
			// <![CDATA[
			var ctShortcodesList = <?php $this->menu() ?>;
			(function ($) {
				$(document).ready(function () {
					if (typeof shortcodeMenu != 'undefined') {
						shortcodeMenu.init({
							langs: {
								shortcodes: "<?php esc_html_e('shortcodes', 'ct_theme');?>",
							}
						});
					}
				});
			})(jQuery);// ]]>
		</script>
	<?php
	}

}

?>