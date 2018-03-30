<?php
	/*
	  Code Adopted From: Shortcodes Ultimate Plugin by Vladimir Anokhin (http://gndev.info/)
	  Edited and Improved by MNKY Studio (http://mnkystudio.com)
	  License: GPL2
	*/
	
	if ( !function_exists( 'su_plugin_init' ) ) {

	// Load libs
	require_once 'lib/available.php';
	require_once 'lib/color.php';
	require_once 'lib/csv.php';
	require_once 'lib/shortcodes.php';

	function su_plugin_init() {

		// Register styles
		wp_register_style( 'shortcodes-css', MNKY_PLUGIN_URL . '/shortcodes/css/style.css', false, su_get_version(), 'all' );
		wp_register_style( 'shortcodes-generator', MNKY_PLUGIN_URL . '/shortcodes/css/generator.css', false, su_get_version(), 'all' );
		wp_register_style( 'nivo-slider', MNKY_PLUGIN_URL . '/shortcodes/css/nivoslider.css', false, su_get_version(), 'all' );
		wp_register_style( 'jcarousel', MNKY_PLUGIN_URL . '/shortcodes/css/jcarousel.css', false, su_get_version(), 'all' );

		// Register scripts
		wp_register_script( 'shortcodes-js', MNKY_PLUGIN_URL . '/shortcodes/js/init.js', array( 'jquery' ), su_get_version(), false );
		wp_register_script( 'shortcodes-generator', MNKY_PLUGIN_URL . '/shortcodes/js/generator.js', array( 'jquery' ), su_get_version(), false );
		wp_register_script( 'nivo-slider', MNKY_PLUGIN_URL . '/shortcodes/js/jquery.nivo.slider.pack.js', array( 'jquery' ), su_get_version(), false );
		wp_register_script( 'jcarousel', MNKY_PLUGIN_URL . '/shortcodes/js/jcarousel.js', array( 'jquery' ), su_get_version(), false );

		// Front-end scripts and styles
		if ( !is_admin() ) {

			// Enqueue styles
			wp_enqueue_style( 'nivo-slider' );
			wp_enqueue_style( 'jcarousel' );
			wp_enqueue_style( 'shortcodes-css' );

			// Enqueue scripts
			wp_enqueue_script( 'tweets' );
			wp_enqueue_script( 'nivo-slider' );
			wp_enqueue_script( 'jcarousel' );
			wp_enqueue_script( 'shortcodes-js' );
		}

		// Scipts and stylesheets for editing pages (shortcode generator popup)
		elseif ( is_admin() ) {

			// Get current page type
			global $pagenow;

			// Pages for including
			$su_generator_includes_pages = array( 'post.php', 'edit.php', 'post-new.php', 'index.php', 'edit-tags.php');

			if ( in_array( $pagenow, $su_generator_includes_pages ) ) {
				// Enqueue styles
				wp_enqueue_style( 'wp-color-picker' );
				wp_register_style( 'chosen', MNKY_PLUGIN_URL . '/shortcodes/css/chosen.css', false, su_get_version(), 'all' );
				wp_enqueue_style( 'chosen' );
				wp_enqueue_style( 'shortcodes-generator' );

				// Enqueue scripts
				wp_enqueue_script( 'jquery' );
				wp_enqueue_script( 'wp-color-picker' );	
				wp_register_script( 'chosen', MNKY_PLUGIN_URL . '/shortcodes/js/chosen.js', array( 'jquery' ), su_get_version(), false );
				wp_enqueue_script( 'chosen' );
				wp_enqueue_script( 'shortcodes-generator' );
			}
		}

		// Register shortcodes
		foreach ( su_shortcodes() as $shortcode => $params ) {
			if ( $params['type'] != 'opengroup' && $params['type'] != 'closegroup' )
				add_shortcode( su_compatibility_mode_prefix() . $shortcode, 'su_' . $shortcode . '_shortcode' );
		}
	}

	add_action( 'init', 'su_plugin_init' );

	/**
	 * Returns current plugin version.
	 *
	 * @return string Plugin version
	 */
	function su_get_version() {
		return '1.0';
	}

	/**
	 * Shortcode names prefix in compatibility mode
	 *
	 * @return string Special prefix
	 */
	function su_compatibility_mode_prefix() {
		$prefix = '';
		return $prefix;
	}

	/**
	 * Hook to translate plugin information
	 */
	function su_add_locale_strings() {
		$strings = '';
	}

	/*
	 * Custom shortcode function for nested shortcodes support
	 */

	function su_do_shortcode( $content, $modifier ) {
		if ( strpos( $content, '[_' ) !== false ) {
			$content = preg_replace( '@(\[_*)_(' . $modifier . '|/)@', "$1$2", $content );
		}
		return do_shortcode( $content );
	}


	/**
	 * Add generator button to Upload/Insert buttons
	 */
	function su_add_generator_button( $page = null, $target = null ) {
		echo '<a href="#" class="button" title="Add Shortcode" id="su-generator-button"><span class="shortcodes-button-icon"></span>Add Shortcode</a>'; 
	}
	
	add_action( 'media_buttons', 'su_add_generator_button', 11 );


	/**
	 * Generator popup box
	 */
	function su_generator_popup() {
		?>
		<div id="su-generator-overlay" class="su-overlay-bg" style="display:none"></div>
		<div id="su-generator-wrap" style="display:none">
			<div id="su-generator">
				<a href="#" id="su-generator-close"><span class="su-close-icon"></span></a>
				<div id="su-generator-shell">
					<div id="su-generator-header">
						<select id="su-generator-select" data-placeholder="<?php _e( 'Select shortcode', 'mnky-admin' ); ?>" data-no-results-text="<?php _e( 'Shortcode not found', 'mnky-admin' ); ?>">
							<option value="raw"></option>
							<?php
							foreach ( su_shortcodes() as $name => $shortcode ) {

								// Open optgroup
								if ( $shortcode['type'] == 'opengroup' )
									echo '<optgroup label="' . $shortcode['name'] . '">';

								// Close optgroup
								elseif ( $shortcode['type'] == 'closegroup' )
									echo '</optgroup>';

								// Option
								else
									echo '<option value="' . $name . '">' . strtoupper( $shortcode['name'] ) . ':&nbsp;&nbsp;' . $shortcode['desc'] . '</option>';
							}
							?>
						</select>
					</div>
					<div id="su-generator-settings"></div>
					<div id="su-insert-vector-icon" style="display:none;">
						<div class="su-mnky-generator-icon-select">
						<ul class="su-moon-icon-list">
						<?php 
						include_once 'lib/vil.php';
						foreach ( $su_vector_icon_list['su-moon-icons'] as $su_moon_icon ) {
							echo '<li><input name="name" type="radio" value="' . $su_moon_icon . '" id="' . $su_moon_icon . '"><label for="' . $su_moon_icon . '"><i class="' . $su_moon_icon . '"></i></label></li>';
						} 
						?>
						</ul>
					</div>
					</div>
					<input type="hidden" name="su-generator-url" id="su-generator-url" value="<?php echo MNKY_PLUGIN_URL . '/shortcodes'; ?>" />
					<input type="hidden" name="su-compatibility-mode-prefix" id="su-compatibility-mode-prefix" value="<?php echo su_compatibility_mode_prefix(); ?>" />
				</div>
			</div>
		</div>

		<?php
	}

	add_action( 'admin_footer', 'su_generator_popup' );
	
	}
?>