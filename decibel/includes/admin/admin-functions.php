<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_invite_wpb' ) ) {
	/**
	 * Invite user to switch to Wolf Page Builder
	 *
	 * @param
	 * @return
	 */
	function wolf_invite_wpb() {

		if ( class_exists( 'Wolf_Page_Builder' ) ) {
			return;
		}

		if ( isset( $_GET[ 'try-wpb' ] ) ) {

			wolf_wpb_get_plugins(
				array(
					'name' => 'wolf-page-builder', 
					'path' => 'http://plugins.wolfthemes.com/wolf-page-builder/wolf-page-builder.zip',
					'install' => 'wolf-page-builder/wolf-page-builder.php'
				)
			);
			wp_redirect( admin_url( 'admin.php?page=wpb-about' ) );
		}

		$message = sprintf(
			wp_kses(
				__( 'Woulf you like to try our <a href="%1$s" target="_blank"><strong>Wolf Page Builder</strong></a> instead of Visual Composer? It is simple, light, supported, automatically updated and it\'s totally <strong>FREE</strong>!
					<br>You will be able to switch back to Visual Composer without losing any content if needed.
					<br>And if you want to switch to one of our newer theme later, you will keep all your content as is!
					<br><br>
					<a href="%2$s" class="button" target="_blank">More infos</a>
					&nbsp;
					<a href="%3$s" class="button button-primary">Try Now</a>', 'wolf' ),
				array(
					'a' => array(
						'href' => array(),
						'class' => array(),
						'target' => array(),
					),
					'br' => array(),
					'strong' => array(),
				)
			),
			'http://wolfthemes.com/wolf-page-builder/',
			'http://wolfthemes.com/wolf-page-builder/',
			admin_url( 'plugins.php?try-wpb' )
		);

		wolf_admin_notice( $message, 'updated', true, 'try-wpb' );
		return false;	
	}
	// wolf_invite_wpb();
}

if ( ! function_exists( 'wolf_work_post_formats' ) ) {
	/**
	 * Remove unuseful post formats on work posts
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_work_post_formats() {

		$post_type = '';

		if ( isset( $_GET['post_type'] ) ) {
			$post_type = sanitize_title( $_GET['post_type'] );

		} elseif ( isset( $_GET['post'] ) ) {
			$post_type = get_post_type( absint( $_GET['post'] ) );
		}

		if ( 'work' == $post_type ) {
			add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'gallery' ) );
		}

	}
	add_action( 'load-post.php', 'wolf_work_post_formats' );
	add_action( 'load-post-new.php', 'wolf_work_post_formats' );
}

if ( ! function_exists( 'wolf_generate_admin_css' ) ) {
	/**
	 * Add font import to admin CSS
	 *
	 * Overwrite the admin CSS adding @import fonts to enable google fonts in editor
	 *
	 * @access public
	 * @since 1.0.0
	 * @param array $options
	 * @return bool true
	 */
	function wolf_generate_admin_css( $options ) {

		global $wolf_google_fonts;

		$css = '';

		if ( $wolf_google_fonts && is_array( $wolf_google_fonts ) && $wolf_google_fonts != array() ) {

			$wolf_google_fonts = array_unique( $wolf_google_fonts );
			$protocol   = is_ssl() ? 'https' : 'http';
			$query_args = array(
				'family' 	=> implode( '|', $wolf_google_fonts ),
				'subset' => 'latin,latin-ext', // can be changed to cyrilic or greek
			);
			$css .= '@import url("' . esc_url( add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ) ) . '");' . "\n";
		}
		if ( is_file( WOLF_THEME_DIR . '/css/admin/editor-style.css' ) ) {
			$css .= file_get_contents( WOLF_THEME_DIR . '/css/admin/editor-style.css' );
		}
		// $css = $options;
		if ( file_put_contents( WOLF_THEME_DIR . '/css/editor-style.css', $css ) ) {
			return true;
		} else {
			return false;
		}
	}
	add_action( 'wolf_after_options_save', 'wolf_generate_admin_css' );
}

if ( ! function_exists( 'wolf_save_plugin_page_id' ) ) {
	/**
	 * Save plugins index page id hook
	 *
	 * Allow to set the plugins index page ID's in the theme options
	 * to keep all settings in the same place
	 *
	 * @access public
	 * @since 1.0.0
	 * @param array $options
	 */
	function wolf_save_plugin_page_id( $options ) {

		if ( isset( $options['gallery_page_id'] ) ) {
			update_option( '_wolf_albums_page_id', $options['gallery_page_id'] );
		}

		if ( isset( $options['work_page_id'] ) ) {
			update_option( '_wolf_portfolio_page_id', $options['work_page_id'] );
		}

		if ( isset( $options['video_page_id'] ) ) {
			update_option( '_wolf_videos_page_id', $options['video_page_id'] );
		}

		if ( isset( $options['release_page_id'] ) ) {
			update_option( '_wolf_discography_page_id', $options['release_page_id'] );
		}
	}
	add_action( 'wolf_after_options_save', 'wolf_save_plugin_page_id' );
}

if ( ! function_exists( 'wolf_plugins_default_page_options' ) ) {
	/**
	 * Inject plugin page options in theme option array
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_plugins_default_page_options() {

		if ( ! wolf_get_theme_option( 'gallery_page_id' ) && get_option( '_wolf_albums_page_id' ) ) {
			wolf_update_theme_option( 'gallery_page_id', get_option( '_wolf_albums_page_id' ) );
		}

		if ( ! wolf_get_theme_option( 'work_page_id' ) && get_option( '_wolf_portfolio_page_id' ) ) {
			wolf_update_theme_option( 'work_page_id', get_option( '_wolf_portfolio_page_id' ) );
		}

		if ( ! wolf_get_theme_option( 'video_page_id' ) && get_option( '_wolf_videos_page_id' ) ) {
			wolf_update_theme_option( 'video_page_id', get_option( '_wolf_videos_page_id' ) );
		}

		if ( ! wolf_get_theme_option( 'release_page_id' ) && get_option( '_wolf_discography_page_id' ) ) {
			wolf_update_theme_option( 'release_page_id', get_option( '_wolf_discography_page_id' ) );
		}
	}
	add_action( 'admin_init', 'wolf_plugins_default_page_options' );
}

if ( ! function_exists( 'wolf_add_media_manager_options' ) ) {
	/**
	 * Add settings to gallery media manager
	 *
	 * @see http://wordpress.stackexchange.com/questions/90114/enhance-media-manager-for-gallery
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_add_media_manager_options() {
		// define your backbone template;
		// the "tmpl-" prefix is required,
		// and your input field should have a data-setting attribute
		// matching the shortcode name
		?>
		<script type="text/html" id="tmpl-custom-gallery-setting">

			<label class="setting">
				<span><?php _e( 'Layout', 'wolf' ); ?></span>
				<select data-setting="layout">
					<option value="simple"><?php _e( 'Simple', 'wolf' ); ?></option>
					<option value="mosaic"><?php _e( 'Mosaic', 'wolf' ); ?></option>
					<?php if ( 'gallery' != get_post_type() ) : ?>
						<option value="carousel_simple"><?php _e( 'Simple Carousel', 'wolf' ); ?></option>
					<?php endif; ?>
					<?php if ( 'gallery' == get_post_type() ) : ?>
					<option value="masonry"><?php _e( 'Masonry', 'wolf' ); ?></option>
					<?php endif; ?>
				</select>
			</label>
			<label class="setting">
				<span><?php _e( 'Size', 'wolf' ); ?></span>
				<select data-setting="size">
					<option value="classic-thumb"><?php _e( 'Standard', 'wolf' ); ?></option>
					<option value="2x2"><?php _e( 'Square', 'wolf' ); ?></option>
					<option value="portrait"><?php _e( 'Portrait', 'wolf' ); ?></option>
				</select>
			</label>
			<label class="setting">
				<span><?php _e( 'Padding', 'wolf' ); ?></span>
				<select data-setting="padding">
					<option value="yes"><?php _e( 'Yes', 'wolf' ); ?></option>
					<option value="no"><?php _e( 'No', 'wolf' ); ?></option>
				</select>
			</label>
			<label class="setting">
				<span><?php _e( 'Hover effect', 'wolf' ); ?></span>
				<select data-setting="hover_effect">
					<option value="default"><?php _e( 'Default', 'wolf' ); ?></option>
					<option value="greyscale"><?php _e( 'Black and white to colored', 'wolf' ); ?></option>
					<option value="to-greyscale"><?php _e( 'Colored to Black and white', 'wolf' ); ?></option>
					<option value="scale-greyscale"><?php _e( 'Scale + Black and white to colored', 'wolf' ); ?></option>
					<option value="scale-to-greyscale"><?php _e( 'Scale + Colored to Black and white', 'wolf' ); ?></option>
					<option value="none"><?php _e( 'None', 'wolf' ); ?></option>
				</select>
				<small><?php _e( 'Note that not all browser support the black and white effect', 'wolf' ); ?></small>
			</label>
		</script>

		<script>

		jQuery( document ).ready( function() {
			// add your shortcode attribute and its default value to the
			// gallery settings list; $.extend should work as well...
			_.extend(wp.media.gallery.defaults, {
				size : 'standard',
				padding : 'no',
				hover_effet : 'default'
			} );

			// merge default gallery settings template with yours
			wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend( {
				template: function( view ) {
					return wp.media.template( 'gallery-settings' )( view )
					+ wp.media.template( 'custom-gallery-setting' )( view );
				}
			} );
		} );
		</script>
		<?php

	}
	add_action( 'print_media_templates', 'wolf_add_media_manager_options' );
}
