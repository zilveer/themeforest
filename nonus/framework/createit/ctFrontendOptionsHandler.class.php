<?php
/**
 * Frontend options handler
 * @author alex
 */

class ctFrontendOptionsHandler {

	/**
	 * Creates admin handler
	 */
	public function __construct() {
	}

	/**
	 * Inits events
	 */

	public function init() {
		add_action('wp_head', array($this, 'handleFaviconOption'));
		add_action('wp_head', array($this, 'handleAppleTouchOption'));
		add_action('wp_head', array($this, 'handleCustomCss'));
		add_action('wp_head', array($this, 'handleCustomJS'));
		add_action('wp_head', array($this, 'handleGoogleWebfonts'), 1);
		add_action('wp_head', array($this, 'handleGoogleAnalytics'));
	}

	/**
	 * Adds google stylesheet
	 */

	function handleGoogleWebfonts() {
		if ($f = ct_get_option('style_font_style')) {
			$font = explode(':', $f);
			if (isset($font[1])) {
				wp_enqueue_style('google.webfont', '//fonts.googleapis.com/css?subset=latin,latin-ext&family=' . str_replace(' ', '+', $font[0]));
			}
		}
	}

	/**
	 * Generates favicon icon
	 */

	function handleFaviconOption()
	{

		if (!function_exists('has_site_icon') || !has_site_icon()) {//Backward-compatible favicons/icons
			if ($f = (function_exists('ct_get_context_option') ? ct_get_context_option('general_favicon', '') : ct_get_option('general_favicon', ''))) {
				echo '<link rel="shortcut icon" href="' . esc_url($f) . '" />';
			}
		}
	}

	/**
	 * Generates apple touch icon
	 */

	function handleAppleTouchOption() {
		if ($f = (function_exists('ct_get_context_option')?ct_get_context_option( 'general_apple_touch_icon', '' ):ct_get_option( 'general_apple_touch_icon', '' ))) {
			echo '<link rel="apple-touch-icon" href="' . esc_url($f) . '" />';
		}
	}

	/**
	 * Includes user css + css from general settings
	 */

	function handleCustomCss() {
		ctThemeLoader::getFilesLoader()->tryIncludeOnce(CT_THEME_SETTINGS_MAIN_DIR . '/custom_style.php');
	}

	/**
	 * Custom JS
	 */

	function handleCustomJS() {
		if ($e = ct_get_option('code_custom_styles_js')) {
			$hasTag = stripos($e, '<script') !== false;
			if (!$hasTag) {
				echo '<script type="text/javascript">';
			}
			//custom JS added by customers
			echo $e . "\n";

			if (!$hasTag) {
				echo '</script>';
			}
		}
	}

	/**
	 * @deprecated
	 */
	function handleGoogleAnalytics() {
		return'';
	}
}