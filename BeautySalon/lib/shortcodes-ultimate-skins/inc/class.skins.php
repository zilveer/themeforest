<?php
class Shortcodes_Ultimate_Skins {

	/**
	 * Constructor
	 */
	function __construct() {
		// Load textdomain
		load_plugin_textdomain( 'sus', false, dirname( plugin_basename( SUS_PLUGIN_FILE ) ) . '/lang/' );
		// Reset cache on activation
		if ( class_exists( 'Su_Generator' ) ) register_activation_hook( SUS_PLUGIN_FILE, array( 'Su_Generator', 'reset' ) );
		// Init plugin
		add_action( 'plugins_loaded', array( __CLASS__, 'init' ), 20 );
		// Translate plugin meta
		__( 'Shortcodes Ultimate: Additional Skins', 'sus' );
		__( 'Vladimir Anokhin', 'sus' );
		__( 'Extra set of skins for Shortcodes Ultimate', 'sus' );
		// Enable autoupdates
		new AutoUpdate_Client( SUS_PLUGIN_FILE, SUS_PLUGIN_VERSION, 'http://gndev.info/' );
	}

	/**
	 * Plugin init
	 */
	public static function init() {
		// Check for SU
		if ( !function_exists( 'shortcodes_ultimate' ) ) {
			// Show notice
			add_action( 'admin_notices', array( __CLASS__, 'su_notice' ) );
			// Break init
			return;
		}
		// Register assets
		add_action( 'su/assets/register', array( __CLASS__, 'register_assets' ) );
		// Enqueue assets
		add_action( 'su/assets/enqueue',  array( __CLASS__, 'enqueue_assets' ), 10, 1 );
		add_action( 'su/assets/print',    array( __CLASS__, 'print_assets' ), 10, 1 );
		// Register new skins
		add_filter( 'su/data/shortcodes', array( __CLASS__, 'register' ) );
		// Register examples
		add_filter( 'su/data/examples',   array( __CLASS__, 'examples' ) );
	}

	/**
	 * Install SU notice
	 */
	public static function su_notice() {
		?><div class="updated">
			<p><?php _e( 'Please install and activate latest version of <b>Shortcodes Ultimate</b> to use it\'s addon <b>Shortcodes Ultimate Skins</b>.<br />Deactivate this addon to hide this message.', 'sus' ); ?></p>
			<p><a href="<?php echo admin_url( 'plugin-install.php?tab=plugin-information&plugin=shortcodes-ultimate' ); ?>" onClick="document.getElementById('sus_su_install_iframe').style.display='block';this.style.display='none';return false;" target="_blank" class="button button-primary"><?php _e( 'Install Sortcodes Ultimate', 'sus' ); ?> &rarr;</a></p>
			<iframe src="<?php echo admin_url( 'plugin-install.php?tab=plugin-information&plugin=shortcodes-ultimate' ); ?>" id="sus_su_install_iframe" style="display:none;width:100%;height:600px;margin-top:1em;overflow:auto;border:none"></iframe>
		</div><?php
	}

	public static function register_assets() {
		wp_register_style( 'su-heading-skins', plugins_url( 'assets/css/heading.css', SUS_PLUGIN_FILE ), array( 'su-content-shortcodes' ), SUS_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-tabs-skins', plugins_url( 'assets/css/tabs.css', SUS_PLUGIN_FILE ), array( 'su-box-shortcodes' ), SUS_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-spoiler-skins', plugins_url( 'assets/css/spoiler.css', SUS_PLUGIN_FILE ), array( 'su-box-shortcodes' ), SUS_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-quote-skins', plugins_url( 'assets/css/quote.css', SUS_PLUGIN_FILE ), array( 'su-box-shortcodes' ), SUS_PLUGIN_VERSION, 'all' );
	}

	public static function enqueue_assets( $assets ) {
		if ( did_action( 'su/shortcode/heading' ) ) wp_enqueue_style( 'su-heading-skins' );
		if ( did_action( 'su/shortcode/tabs' ) ) wp_enqueue_style( 'su-tabs-skins' );
		if ( did_action( 'su/shortcode/spoiler' ) ) wp_enqueue_style( 'su-spoiler-skins' );
		if ( did_action( 'su/shortcode/quote' ) ) wp_enqueue_style( 'su-quote-skins' );
	}

	public static function print_assets( $assets ) {
		if ( did_action( 'su/shortcode/heading' ) ) wp_print_styles( array( 'su-heading-skins' ) );
		if ( did_action( 'su/shortcode/tabs' ) ) wp_print_styles( array( 'su-tabs-skins' ) );
		if ( did_action( 'su/shortcode/spoiler' ) ) wp_print_styles( array( 'su-spoiler-skins' ) );
		if ( did_action( 'su/shortcode/quote' ) ) wp_print_styles( array( 'su-quote-skins' ) );
	}

	/**
	 * Register new skins
	 */
	public static function register( $shortcodes ) {
		// Heading
		$shortcodes['heading']['atts']['style']['values']['modern-1-dark']      = sprintf( '%s 1: %s', __( 'Modern', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['modern-1-light']     = sprintf( '%s 1: %s', __( 'Modern', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['modern-1-blue']      = sprintf( '%s 1: %s', __( 'Modern', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['modern-1-orange']    = sprintf( '%s 1: %s', __( 'Modern', 'sus' ), __( 'Orange', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['modern-1-violet']    = sprintf( '%s 1: %s', __( 'Modern', 'sus' ), __( 'Violet', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['modern-2-dark']      = sprintf( '%s 2: %s', __( 'Modern', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['modern-2-light']     = sprintf( '%s 2: %s', __( 'Modern', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['modern-2-blue']      = sprintf( '%s 2: %s', __( 'Modern', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['modern-2-orange']    = sprintf( '%s 2: %s', __( 'Modern', 'sus' ), __( 'Orange', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['modern-2-violet']    = sprintf( '%s 2: %s', __( 'Modern', 'sus' ), __( 'Violet', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['line-dark']          = sprintf( '%s: %s', __( 'Line', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['line-light']         = sprintf( '%s: %s', __( 'Line', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['line-blue']          = sprintf( '%s: %s', __( 'Line', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['line-orange']        = sprintf( '%s: %s', __( 'Line', 'sus' ), __( 'Orange', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['line-violet']        = sprintf( '%s: %s', __( 'Line', 'sus' ), __( 'Violet', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['dotted-line-dark']   = sprintf( '%s: %s', __( 'Dotted line', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['dotted-line-light']  = sprintf( '%s: %s', __( 'Dotted line', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['dotted-line-blue']   = sprintf( '%s: %s', __( 'Dotted line', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['dotted-line-orange'] = sprintf( '%s: %s', __( 'Dotted line', 'sus' ), __( 'Orange', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['dotted-line-violet'] = sprintf( '%s: %s', __( 'Dotted line', 'sus' ), __( 'Violet', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['flat-dark']          = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['flat-light']         = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['flat-blue']          = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['heading']['atts']['style']['values']['flat-green']         = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Green', 'sus' ) );
		// Spoiler
		$shortcodes['spoiler']['atts']['style']['values']['carbon']        = __( 'Carbon', 'sus' );
		$shortcodes['spoiler']['atts']['style']['values']['sharp']         = __( 'Sharp', 'sus' );
		$shortcodes['spoiler']['atts']['style']['values']['grid']          = __( 'Grid', 'sus' );
		$shortcodes['spoiler']['atts']['style']['values']['wood']          = __( 'Wood', 'sus' );
		$shortcodes['spoiler']['atts']['style']['values']['fabric']        = __( 'Fabric', 'sus' );
		$shortcodes['spoiler']['atts']['style']['values']['modern-dark']   = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['spoiler']['atts']['style']['values']['modern-light']  = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['spoiler']['atts']['style']['values']['modern-violet'] = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Violet', 'sus' ) );
		$shortcodes['spoiler']['atts']['style']['values']['modern-orange'] = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Orange', 'sus' ) );
		$shortcodes['spoiler']['atts']['style']['values']['glass-dark']    = sprintf( '%s: %s', __( 'Glass', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['spoiler']['atts']['style']['values']['glass-light']   = sprintf( '%s: %s', __( 'Glass', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['spoiler']['atts']['style']['values']['glass-blue']    = sprintf( '%s: %s', __( 'Glass', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['spoiler']['atts']['style']['values']['glass-green']   = sprintf( '%s: %s', __( 'Glass', 'sus' ), __( 'Green', 'sus' ) );
		$shortcodes['spoiler']['atts']['style']['values']['glass-gold']    = sprintf( '%s: %s', __( 'Glass', 'sus' ), __( 'Gold', 'sus' ) );
		// Tabs
		$shortcodes['tabs']['atts']['style']['values']['carbon']        = __( 'Carbon', 'sus' );
		$shortcodes['tabs']['atts']['style']['values']['sharp']         = __( 'Sharp', 'sus' );
		$shortcodes['tabs']['atts']['style']['values']['grid']          = __( 'Grid', 'sus' );
		$shortcodes['tabs']['atts']['style']['values']['wood']          = __( 'Wood', 'sus' );
		$shortcodes['tabs']['atts']['style']['values']['fabric']        = __( 'Fabric', 'sus' );
		$shortcodes['tabs']['atts']['style']['values']['modern-dark']   = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['tabs']['atts']['style']['values']['modern-light']  = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['tabs']['atts']['style']['values']['modern-blue']   = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['tabs']['atts']['style']['values']['modern-orange'] = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Orange', 'sus' ) );
		$shortcodes['tabs']['atts']['style']['values']['flat-dark']     = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['tabs']['atts']['style']['values']['flat-light']    = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['tabs']['atts']['style']['values']['flat-blue']     = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['tabs']['atts']['style']['values']['flat-green']    = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Green', 'sus' ) );
		// Quotes
		$shortcodes['quote']['atts']['style']['values']['carbon']        = __( 'Carbon', 'sus' );
		$shortcodes['quote']['atts']['style']['values']['sharp']         = __( 'Sharp', 'sus' );
		$shortcodes['quote']['atts']['style']['values']['grid']          = __( 'Grid', 'sus' );
		$shortcodes['quote']['atts']['style']['values']['wood']          = __( 'Wood', 'sus' );
		$shortcodes['quote']['atts']['style']['values']['fabric']        = __( 'Fabric', 'sus' );
		$shortcodes['quote']['atts']['style']['values']['modern-dark']   = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['quote']['atts']['style']['values']['modern-light']  = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['quote']['atts']['style']['values']['modern-blue']   = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['quote']['atts']['style']['values']['modern-orange'] = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Orange', 'sus' ) );
		$shortcodes['quote']['atts']['style']['values']['modern-violet'] = sprintf( '%s: %s', __( 'Modern', 'sus' ), __( 'Violet', 'sus' ) );
		$shortcodes['quote']['atts']['style']['values']['flat-dark']     = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Dark', 'sus' ) );
		$shortcodes['quote']['atts']['style']['values']['flat-light']    = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Light', 'sus' ) );
		$shortcodes['quote']['atts']['style']['values']['flat-blue']     = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Blue', 'sus' ) );
		$shortcodes['quote']['atts']['style']['values']['flat-green']    = sprintf( '%s: %s', __( 'Flat', 'sus' ), __( 'Green', 'sus' ) );
		return $shortcodes;
	}

	public static function examples( $examples ) {
		$examples['skins'] = array(
			'title' => __( 'Shortcodes Ultimate Skins', 'sus' ),
			'items' => array(
				array(
					'name' => __( 'Heading skins', 'sus' ),
					'id'   => 'heading',
					'code' => plugin_dir_path( SUS_PLUGIN_FILE ) . '/inc/examples/heading.example',
					'icon' => 'h-square'
				),
				array(
					'name' => __( 'Spoiler skins', 'sus' ),
					'id'   => 'spoiler',
					'code' => plugin_dir_path( SUS_PLUGIN_FILE ) . '/inc/examples/spoiler.example',
					'icon' => 'list-ul'
				),
				array(
					'name' => __( 'Tabs skins', 'sus' ),
					'id'   => 'tabs',
					'code' => plugin_dir_path( SUS_PLUGIN_FILE ) . '/inc/examples/tabs.example',
					'icon' => 'folder'
				),
				array(
					'name' => __( 'Quote skins', 'sus' ),
					'id'   => 'quote',
					'code' => plugin_dir_path( SUS_PLUGIN_FILE ) . '/inc/examples/quote.example',
					'icon' => 'quote-right'
				),
			)
		);
		return $examples;
	}
}

new Shortcodes_Ultimate_Skins;
