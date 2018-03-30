<?php
/**
 * Neat Skin Class
 *
 * @package Total WordPress Theme
 * @subpackage Skins
 * @deprecated Since 3.0.0
 */


if ( ! class_exists( 'Total_Neat_Skin' ) ) {
	
	class Total_Neat_Skin {

		/**
		 * Main constructor.
		 *
		 * @since 1.3.0
		 */
		public function __construct() {

			// Load skin CSS
			add_action( 'wp_enqueue_scripts', array( $this, 'load_styles' ), 999 );

			// Add accent colors
			add_filter( 'wpex_accent_backgrounds', array( $this, 'accent_backgrounds' ) );
			add_filter( 'wpex_accent_texts', array( $this, 'accent_texts' ) );

		}

		/**
		 * Load custom stylesheet for this skin.
		 *
		 * @since 1.3.0
		 */
		public function load_styles() {
			wp_enqueue_style( 'wpex-neat-skin', WPEX_SKIN_DIR_URI .'classes/neat/css/neat-style.css', array( 'wpex-style' ), '1.0', 'all' );
		}

		/**
		 * Adds background accents for this skin
		 *
		 * @since   2.1.0
		 */
		public function accent_backgrounds( $backgrounds ) {
			$backgrounds = array_merge( array(
				'#top-bar-wrap',
				'.vcex-filter-links a:hover',
				'.vcex-filter-links li.active a',
				'.vcex-navbar.style-buttons a:hover',
				'.vcex-navbar.style-buttons a.active',
				'.page-numbers a:hover',
				'.page-numbers.current',
				'.page-numbers.current:hover',
				'.woocommerce nav.woocommerce-pagination ul li a:focus',
				'.woocommerce nav.woocommerce-pagination ul li a:hover',
				'.woocommerce nav.woocommerce-pagination ul li span.current',
			), $backgrounds );
			return $backgrounds;
		}

		/**
		 * Adds color accents for this skin
		 *
		 * @since   2.1.0
		 */
		public function accent_texts( $texts ) {
			$texts = array_merge( array(
				'#site-navigation .dropdown-menu > li.sfHover > a',
				'#site-navigation .dropdown-menu > li > a:hover',
				'#site-navigation .dropdown-menu a:hover',
				'#site-navigation .dropdown-menu > .current-menu-parent > a',
				'#site-navigation .dropdown-menu > .current-menu-item > a',
			), $texts );
			return $texts;
		}

	}

}
$wpex_neat_skin = new Total_Neat_Skin();