<?php
/**
 * Class which handles the output of the WP customizer on the frontend.
 * Meaning that this stuff loads always, no matter if the global $wp_cutomize
 * variable is present or not.
 */
class BuildPress_Customize_Frontent {

	/**
	 * Add actions to load the right staff at the right places (header, footer).
	 */
	function __construct() {
		add_action( 'wp_enqueue_scripts' , array( $this, 'customizer_css' ), 20 );
		add_action( 'wp_head' , array( $this, 'head_output' ) );
		add_action( 'wp_footer' , array( $this, 'footer_output' ) );
	}

	/**
	* This will output the custom WordPress settings to the live theme's WP head.
	*
	* Used by hook: 'wp_head'
	*
	* @see add_action( 'wp_head' , array( $this, 'head_output' ) );
	*/
	public static function customizer_css() {
		// customizer settings
		$cached_css = get_theme_mod( 'cached_css', '' );
		$user_css   = get_theme_mod( 'custom_css', '' );

		ob_start();

		echo '/* WP Customizer start */' . PHP_EOL;
		echo apply_filters( 'buildpress/cached_css', $cached_css );
		echo '/* WP Customizer end */';

		if ( strlen( $user_css ) ) {
			echo PHP_EOL . "/* User custom CSS start */" . PHP_EOL;
			echo $user_css . PHP_EOL; // no need to filter this, because it is 100% custom code
			echo PHP_EOL . "/* User custom CSS end */" . PHP_EOL;
		}

		wp_add_inline_style( 'buildpress-main', ob_get_clean() );
	}


	/**
	 * Outputs the code in head of the every page
	 *
	 * Used by hook: add_action( 'wp_head' , array( $this, 'head_output' ) );
	 */
	public static function head_output() {

		// Theme favicon output, which will be phased out, because of WP core favicon integration
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			$favicon = get_theme_mod( 'favicon', get_template_directory_uri() . '/assets/images/favicon.png' );

			if( ! empty( $favicon ) ) : ?>
				<link rel="shortcut icon" href="<?php echo $favicon; ?>">
			<?php endif;
		}

		// custom JS from the customizer
		$script = get_theme_mod( 'custom_js_head', '' );

		if ( ! empty( $script ) ) {
			echo PHP_EOL . $script . PHP_EOL;
		}
	}

	/**
	 * Outputs the code in footer of the every page, right before closing </body>
	 *
	 * Used by hook: add_action( 'wp_footer' , array( $this, 'footer_output' ) );
	 */
	public static function footer_output() {
		$script = get_theme_mod( 'custom_js_footer', '' );

		if ( ! empty( $script ) ) {
			echo PHP_EOL . $script . PHP_EOL;
		}
	}
}