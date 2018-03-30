<?php
/**
 * Header Builder Addon
 *
 * @package Total WordPress theme
 * @subpackage Framework
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class WPEX_Header_Builder {
	private $is_admin;

	/**
	 * Start things up
	 *
	 * @since 3.5.0
	 */
	public function __construct() {

		$this->is_admin = is_admin();

		if ( $this->is_admin ) {

			// Add admin page
			add_action( 'admin_menu', array( 'WPEX_Header_Builder', 'add_page' ), 20 );

			// Admin scripts
			add_action( 'admin_enqueue_scripts',array( 'WPEX_Header_Builder', 'scripts' ) );

			// Register admin options
			add_action( 'admin_init', array( 'WPEX_Header_Builder', 'register_page_options' ) );

		}

		// Run actions and filters if header_builder ID is defined
		if ( self::header_builder_id() ) {

			// Do not register header sidebars
			add_filter( 'wpex_register_header_sidebars', '__return_false' );

			// Alter the header on init
			add_action( 'wp', array( 'WPEX_Header_Builder', 'alter_header' ) );

			// Include ID for Visual Composer custom CSS
			add_filter( 'wpex_vc_css_ids', array( 'WPEX_Header_Builder', 'wpex_vc_css_ids' ) );

			// Remove header customizer settings
			add_filter( 'wpex_customizer_panels', array( 'WPEX_Header_Builder', 'remove_customizer_header_panel' ) );

			// Alter include template
			if ( wpex_vc_is_inline() ) {
				add_filter( 'template_include', array( 'WPEX_Header_Builder', 'builder_template' ), 9999 );
			}

			// Redirect live url for seo
			elseif ( ! $this->is_admin ) {
				add_action( 'template_redirect', array( 'WPEX_Header_Builder', 'redirect' ) );
			}

			// Remove Meta options
			if ( $this->is_admin ) {
				add_filter( 'wpex_metabox_array', array( 'WPEX_Header_Builder', 'remove_meta' ), 99, 2 );
			}

			// CSS
			add_filter( 'wpex_head_css', array( 'WPEX_Header_Builder', 'wpex_head_css' ), 99 );

		}

	}

	/**
	 * Add sub menu page
	 *
	 * @since 3.5.0
	 */
	public static function header_builder_id() {
		$pageid = intval( apply_filters( 'wpex_header_builder_page_id', wpex_get_mod( 'header_builder_page_id' ) ) );
		return $pageid ? wpex_parse_obj_id( $pageid, 'page' ) : '';
	}

	/**
	 * Add sub menu page
	 *
	 * @since 3.5.0
	 */
	public static function add_page() {
		add_submenu_page(
			WPEX_THEME_PANEL_SLUG,
			esc_html__( 'Header Builder', 'total' ),
			esc_html__( 'Header Builder', 'total' ),
			'administrator',
			WPEX_THEME_PANEL_SLUG .'-header-builder',
			array( 'WPEX_Header_Builder', 'create_admin_page' )
		);
	}

	/**
	 * Load scripts for admin
	 *
	 * @since 1.6.0
	 */
	public static function scripts( $hook ) {

		if ( WPEX_ADMIN_PANEL_HOOK_PREFIX . '-header-builder' != $hook ) {
			return;
		}

		// Media Uploader
		wp_enqueue_media();

		wp_enqueue_script(
			'wpex-media-uploader-field',
			WPEX_FRAMEWORK_DIR_URI .'addons/assets/admin-fields/media-uploader.js',
			array( 'media-upload' ),
			false,
			true
		);

		// Color Picker
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'wpex-color-picker-field', WPEX_FRAMEWORK_DIR_URI .'addons/assets/admin-fields/color-picker.js', false, false, true );

		// CSS
		wp_enqueue_style( 'wpex-admin', WPEX_FRAMEWORK_DIR_URI .'addons/assets/admin-fields/admin.css' );

	}

	/**
	 * Returns settings array
	 *
	 * @since 3.5.0
	 */
	private static function settings() {
		return array(
			'page_id'      => esc_html__( 'Header Builder page', 'total' ),
			'bg'           => esc_html__( 'Background Color', 'total' ),
			'bg_img'       => esc_html__( 'Background Image', 'total' ),
			'bg_img_style' => esc_html__( 'Background Image Style', 'total' ),
		);
	}

	/**
	 * Function that will register admin page options
	 *
	 * @since 3.5.0
	 */
	public static function register_page_options() {

		// Register settings
		register_setting(
			'wpex_header_builder',
			'header_builder',
			array( 'WPEX_Header_Builder', 'sanitize' )
		);

		// Register setting section
		add_settings_section(
			'wpex_header_builder_main',
			false,
			array( 'WPEX_Header_Builder', 'section_main_callback' ),
			'wpex-header-builder-admin'
		);

		// Add settings
		$settings = self::settings();
		foreach ( $settings as $key => $val ) {
			add_settings_field(
				$key,
				$val,
				array( 'WPEX_Header_Builder', $key .'_field_callback' ),
				'wpex-header-builder-admin',
				'wpex_header_builder_main'
			);
		}

	}

	/**
	 * Sanitization callback
	 *
	 * @since 3.5.0
	 */
	public static function sanitize( $options ) {

		$settings = self::settings();

		foreach ( $settings as $key => $val ) {

			if ( empty( $options[$key] ) ) {
				remove_theme_mod( 'header_builder_'. $key );
			} else {
				set_theme_mod( 'header_builder_'. $key, $options[$key] );
			}

		}

		$options = ''; return;
	}

	/**
	 * Main Settings section callback
	 *
	 * @since 3.5.0
	 */
	public static function section_main_callback( $options ) {
		// not needed
	}

	/**
	 * Fields callback functions
	 *
	 * @since 3.5.0
	 */

	// Header Builder Page ID
	public static function page_id_field_callback() {

		// Get header builder page ID
		$page_id = wpex_get_mod( 'header_builder_page_id' ); ?>

		<?php
		// Display dropdown of pages
		wp_dropdown_pages( array(
			'echo'             => true,
			'selected'         => $page_id,
			'name'             => 'header_builder[page_id]',
			'id'               => 'wpex-header-builder-select',
			'show_option_none' => esc_html__( 'None', 'total' ),
		) ); ?>
		<br />

		<p class="description"><?php esc_html_e( 'Select your custom page for your header layout.', 'total' ) ?></p>

		<br />

		<div id="wpex-header-builder-edit-links">

			<a href="<?php echo admin_url( 'post.php?post='. $page_id .'&action=edit' ); ?>" class="button" target="_blank">
				<?php esc_html_e( 'Backend Edit', 'total' ); ?>
			</a>

			<?php if ( WPEX_VC_ACTIVE ) { ?>

				<a href="<?php echo admin_url( 'post.php?vc_action=vc_inline&post_id='. $page_id .'&post_type=page' ); ?>" class="button" target="_blank">
					<?php esc_html_e( 'Frontend Edit', 'total' ); ?>
				</a>

			<?php } ?>

		</div>
		
	<?php }

	// Background Setting
	public static function bg_field_callback() {

		// Get background
		$bg = wpex_get_mod( 'header_builder_bg' ); ?>

		<input id="background_color" type="text" name="header_builder[bg]" value="<?php echo esc_attr( $bg ); ?>" class="wpex-color-field">

	<?php }

	// Background Image Setting
	public static function bg_img_field_callback() {

		// Get background
		$bg = wpex_get_mod( 'header_builder_bg_img' ); ?>

		<div class="uploader">
			<input class="wpex-media-input" type="text" name="header_builder[bg_img]" value="<?php echo esc_attr( $bg ); ?>">
			<input class="wpex-media-upload-button button-secondary" type="button" value="<?php esc_html_e( 'Upload', 'total' ); ?>" />
			<?php $preview = wpex_sanitize_data( $bg, 'image_src_from_mod' ); ?>
			<a href="#" class="wpex-media-remove button-secondary" style="display:none;"><span class="dashicons dashicons-no-alt" style="line-height: inherit;"></span></a>
			<div class="wpex-media-live-preview">
				<?php if ( $preview ) { ?>
					<img src="<?php echo esc_url( $preview ); ?>" alt="<?php esc_html_e( 'Preview Image', 'total' ); ?>" />
				<?php } ?>
			</div>
		</div>

	<?php }

	// Background Image Style Setting
	public static function bg_img_style_field_callback() {

		// Get setting
		$style = wpex_get_mod( 'header_builder_bg_img_style' ); ?>

			<select name="header_builder[bg_img_style]">
			<?php
			$bg_styles = wpex_get_bg_img_styles();
			foreach ( $bg_styles as $key => $val ) { ?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $style, $key, true ); ?>>
					<?php echo strip_tags( $val ); ?>
				</option>
			<?php } ?>
		</select>

	<?php }

	/**
	 * Settings page output
	 *
	 * @since 3.5.0
	 */
	public static function create_admin_page() { ?>
		<div id="wpex-admin-page" class="wrap">
			<h2><?php esc_html_e( 'Header Builder', 'total' ); ?> <a href="#" id="wpex-help-toggle" aria-hidden="true" style="text-decoration:none;"><span class="dashicons dashicons-editor-help"></span></a></h2>
			<div id="wpex-notice" class="notice notice-info" style="display:none;">
				<p style="font-size:1.1em;">
				<?php echo esc_html__( 'Use this setting to replace the default theme header with content created with the Visual Composer. When enabled all Customizer settings for the Header will be removed. This is an advanced functionality so if this is the first time you use the theme we recommend you first test out the built-in header which can be customized at Appearance > Customize > Header.', 'total' ); ?>	
				</p>
			</div>
			<form method="post" action="options.php">
				<?php settings_fields( 'wpex_header_builder' ); ?>
				<?php do_settings_sections( 'wpex-header-builder-admin' ); ?>
				<?php submit_button(); ?>
			</form>
			<script>
				( function( $ ) {
					"use strict";

					// Notice
					$( 'a#wpex-help-toggle' ).click( function() {
						$( '#wpex-notice' ).toggle();
						return false;
					} );

					// Hide/Show fields
					var $tableTr     = $( '#wpex-admin-page table tr' );
					var	$select      = $( '#wpex-header-builder-select' );
					var $selectTr    = $select.parents( 'tr' );
					var $footerLinks = $( '#wpex-header-builder-edit-links' );

					// Check initial val
					if ( ! $select.val() ) {
						$footerLinks.hide();
						$tableTr.not( $selectTr ).hide();
					}

					// Check on change
					$( $select ).change(function () {
						if ( ! $( this ).val() ) {
							$tableTr.not( $selectTr ).hide();
							$footerLinks.hide();
						} else {
							$tableTr.show();
							$footerLinks.show();
						}
					} );
				} ) ( jQuery );
			</script>
		</div><!-- .wrap -->
	<?php }

	/**
	 * Remove the header and add custom header if enabled
	 *
	 * @since 3.5.0
	 */
	public static function alter_header() {

		// Remove all actions in header hooks
		$hooks = wpex_theme_hooks();
		if ( isset( $hooks['header']['hooks'] ) ) {
			foreach( $hooks['header']['hooks'] as $hook ) {
				remove_all_actions( $hook, false );
			}
		}

		// Add builder header
		add_action( 'wpex_hook_header_inner', array( 'WPEX_Header_Builder', 'get_part' ), 0 );

	}

	/**
	 * Alters get template
	 *
	 * @since 3.5.0
	 */
	public static function builder_template( $template ) {
		if ( is_page( wpex_global_obj( 'header_builder' ) ) ) {
			$new_template = locate_template( array( 'partials/header/builder-template.php' ) );
			if ( $new_template ) {
				return $new_template;
			}
		}
		return $template;
	}

	/**
	 * Add header builder to array of ID's with CSS to load site-wide
	 *
	 * @since 3.5.0
	 */
	public static function wpex_vc_css_ids( $ids ) {
		$ids[] = wpex_global_obj( 'header_builder' );
		return $ids;
	}

	/**
	 * Remove the header and add custom header if enabled
	 *
	 * @since 3.5.0
	 */
	public static function remove_customizer_header_panel( $panels ) {
		unset( $panels['header'] );
		return $panels;
	}

	/**
	 * Gets the header builder template part if the header is enabled
	 *
	 * @since 3.5.0
	 */
	public static function get_part() {
		if ( wpex_global_obj( 'has_header' ) ) {
			get_template_part( 'partials/header/header-builder' );
		}
	}

	/**
	 * Remove header meta that isn't needed anymore
	 *
	 * @since 3.5.0
	 */
	public static function remove_meta( $array, $post ) {
		if ( $post && $post->ID == self::header_builder_id() ) {
			$array = ''; // remove on actual builderpage
		} else {
			unset( $array['header']['settings']['custom_menu'] );
			unset( $array['header']['settings']['overlay_header_style'] );
			unset( $array['header']['settings']['overlay_header_dropdown_style'] );
			unset( $array['header']['settings']['overlay_header_font_size'] );
			unset( $array['header']['settings']['overlay_header_logo'] );
			unset( $array['header']['settings']['overlay_header_logo_retina'] );
			unset( $array['header']['settings']['overlay_header_retina_logo_height'] );
		}
		return $array;
	}

	/**
	 * Redirect page to prevent issues with live site.
	 *
	 * @since 3.5.0
	 */
	public static function redirect() {
		if ( is_page( wpex_global_obj( 'header_builder' ) ) ) {
			wp_redirect( home_url( '/' ), 301 );
		}
	}

	/**
	 * Custom CSS for header builder
	 *
	 * @since 3.5.0
	 */
	public static function wpex_head_css( $css ) {
		$add_css = '';
		if ( $bg = wpex_get_mod( 'header_builder_bg' ) ) {
			$add_css .= 'background-color:'. $bg .';';
		}
		if ( $bg_img = wpex_sanitize_data( wpex_get_mod( 'header_builder_bg_img' ), 'image_src_from_mod' ) ) {
			$add_css .= 'background-image:url('. $bg_img .');';
		}
		if ( $bg_img && $bg_img_style = wpex_sanitize_data( wpex_get_mod( 'header_builder_bg_img_style' ), 'background_style_css' ) ) {
			$add_css .= $bg_img_style;
		}
		if ( $add_css ) {
			$add_css = '#site-header.header-builder{ '. $add_css .'}';
			$css .= '/*HEADER BUILDER*/'. $add_css;
		}
		return $css;
	}

}
new WPEX_Header_Builder();