<?php


/**
 * Template Colors and Defaults:
 */

if ( ! defined( 'ABSPATH' ) ) exit;


$current_color_selection = get_theme_mod( 'boutique_site_color', 'blue' );
// hack to get defaults working correctly.
global $wp_customize;
if ( isset( $wp_customize ) && $wp_customize->is_preview() ) {
	if(isset($_POST['wp_customize']) && !empty($_POST['customized'])){
		$customized = json_decode(stripslashes($_POST['customized']),true);
		if(!empty($customized['boutique_site_color'])){
			$current_color_selection = $customized['boutique_site_color'];
		}
	}
}


global $boutique_theme_defaults;

$boutique_theme_defaults = array(

	'logo_show_text' => '1',
	'logo_header_text' => 'Boutique Kids',

	//'background_option' => 'headerimage',
	'background_color' => 'FFFFFF',
	'menu_color' => 'brown',
	'border_color' => 'blue',
	'menu_overlay' => 'enabled',
//	'footer_overlay' => 'enabled',
//	'footer_background' => '2b475f',
	'boutique_site_color' => $current_color_selection,
	'boutique_site_color_options' => array(),

	'color_background_fancy_header' => 'f8f4e9',
	//'color_blog_line' => '26a0a3',
	//'color_background_widget' => 'f5ede2', //'fff6c3',
	//'color_background_content' => 'FFFFFF',
	'color_comment_border' => 'f8e6d0',
	'color_background_forms' => 'f8f4e9',
//	'color_comment_border' => 'f8e6d0',
	//'color_banner_outer_glow' => 'edd2a3',
	//'color_banner_inner_color' => 'fddf92',
	// font color
	'font_color_highlight_color' => 'A8895C',
	'font_color_link_color' => 'deb682',
	'font_color_link_hover_color' => 'A8895C',

	// other
	'logo_header_image' => get_template_directory_uri() . '/images/logo.png',
	'gallery_background_image' => get_template_directory_uri().'/images/bg-widget.png',
	'sidebar_width' => '200',
	// bg images:
	/* other settings */
	//'page_header_mode' => 1, // 1 = bird line, 2 = fancy, 3 = nothing
	'responsive_enabled' => 1,
	'full_width_fluid' => 0,
	'boutique_full_blog' => 0,
	//'show_post_share' => 1,
	//'menu_fade_in' => 1,
);

$default_styles = array();
if (version_compare(phpversion(), '5.3.0', '>')) {
	$overlay_options = array();

	$default_styles = array(
		'blue' => array(
			'name' => 'Blue',
			'filters' => array(
				'theme_mod_boutique_site_color' => 'blue',
			),
			'demo_filters' => $overlay_options,
			'image' => get_template_directory_uri().'/widgets/demo/blue.jpg',
		),
	);

	add_filter('boutique_default_styles',function() use ($default_styles){
		return $default_styles;
	});

	add_action( 'boutique_set_default_style', function ( $style ) use ( $default_styles ) {

		// we only filter the theme settings if we're in demo mode or if we're in the customizer and changing styles.
		// if we change the default style in the customizer we run the filter. otherwise leave values as from db.
		$do_filters = defined( 'boutique_DO_DEMO' );
		global $wp_customize;
		if ( isset( $wp_customize ) ) {
			if(isset($_POST['wp_customize']) && !empty($_POST['customized']) && ( empty($_POST['action']) || $_POST['action'] != 'customize_save' ) ){
				$customized = json_decode(stripslashes($_POST['customized']),true);
				if(!empty($customized['boutique_site_color'])){
					$do_filters = true;
				}
			}
		}

		if ( $do_filters && isset( $default_styles[ $style ] ) ) {
			foreach ( $default_styles[ $style ]['filters'] as $filter_name => $filter_args ) {
				if ( is_array( $filter_args ) && is_callable( $filter_args[1] ) ) {
					add_filter( $filter_name, $filter_args[1], 100, $filter_args[0] );
				} else if ( is_string( $filter_args ) || is_array( $filter_args ) ) {
					add_filter( $filter_name, function () use ( $filter_args ) {
						return $filter_args;
					}, 100 );
				}
			}
		}
	} );

	add_action( 'wp_loaded', function () use ( $boutique_theme_defaults ) {
		do_action( 'boutique_set_default_style', get_theme_mod( 'boutique_site_color', $boutique_theme_defaults['boutique_site_color'] ) );
	} );

}


foreach ( $default_styles as $default_style_key => $default_style_data ) {
	$boutique_theme_defaults['boutique_site_color_options'][ $default_style_key ] = $default_style_data['name'];
}


if ( ! function_exists( 'boutique_default_css_output' ) ) {
	function boutique_default_css_output( $tags = true ) {
		global $boutique_theme_defaults;
		// pull otu our customisations
		$boutique_theme_settings = array();
		foreach ( $boutique_theme_defaults as $key => $val ) {
			$boutique_theme_settings[ $key ] = get_theme_mod( $key, $val );
		}
		include( get_template_directory() . '/style.custom.php' );
	}
}


add_action( 'wp_before_admin_bar_render', 'boutique_add_appearance_menu' );
if ( ! function_exists( 'boutique_add_appearance_menu' ) ) {
	function boutique_add_appearance_menu() {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'parent' => 'appearance',
			'id'     => 'customize',
			'title'  => esc_html__( 'Customize', 'boutique-kids' ),
			'href'   => wp_customize_url( get_stylesheet() )
		) );
	}
}

if( ! class_exists( 'boutique_customize_save_hook' ) ) {
	class boutique_customize_save_hook {
		public $old_site_color = '';

		public function __construct() {

			add_action( 'customize_save', array( $this, 'save_before' ), 10, 1 );
			add_action( 'customize_save_after', array( $this, 'save_after' ), 10, 1 );

		}

		public function save_color_options( $color = false ){
			$default_styles = apply_filters( 'boutique_default_styles', array() );

			update_option( 'tt_font_theme_options' ,array());
			delete_transient( 'tt_font_theme_options' );

			$font_options = EGF_Register_Options::get_options( false );
			$font_options = apply_filters( 'boutique_font_options',$font_options );

			if(!$color){
				$color = key($default_styles);
			}

			if ( isset( $default_styles[ $color ] ) ) {
				foreach ( $default_styles[ $color ]['filters'] as $filter_name => $filter_args ) {
					if ( is_array( $filter_args ) && is_callable( $filter_args[1] ) ) {
						if( strpos($filter_name,'option_') !== false ){
							$option_name = str_replace('option_','',$filter_name);
							if($option_name == 'tt_font_theme_options'){
								$font_options = call_user_func($filter_args[1], $font_options);
//										set_transient( 'tt_font_theme_options', $font_options, 0 );
								if(!empty($font_options)){
									update_option($option_name, $font_options);
								}
							}else{
								$current_option = get_option($option_name);
								$new_option = call_user_func($filter_args[1], $current_option);
								if(!empty($new_option)){
									update_option($option_name, $new_option);
								}
							}
						}
					} else if ( is_string( $filter_args ) || is_array( $filter_args ) ) {
						// get the current option:
						if ( strpos( $filter_name, 'theme_mod_' ) !== false ) {
							$theme_mod_name = str_replace( 'theme_mod_', '', $filter_name );
							set_theme_mod( $theme_mod_name, $filter_args );
						}
					}
				}
			}

			delete_transient( 'tt_font_theme_options' );
		}

		public function save_before( $WP_Customize_Manager ) {
			global $boutique_theme_defaults;
			$this->old_site_color = get_theme_mod( 'boutique_site_color', $boutique_theme_defaults['boutique_site_color'] );
			if(isset($_POST['wp_customize']) && !empty($_POST['customized']) && $_POST['action'] == 'customize_save'){
				$customized = json_decode(stripslashes($_POST['customized']),true);
				if(!empty($customized['boutique_site_color'])){ //} && $this->old_site_color != $customized['boutique_site_color']){
					// we save this site color first, and all the default options that come with this site color

					$this->save_color_options( $customized['boutique_site_color'] );

				}
			}

		}

		private function _array_merge_recursive_distinct( $array1, $array2 ) {
			$merged = $array1;
			foreach ( $array2 as $key => &$value ) {
				if ( is_array( $value ) && isset ( $merged [ $key ] ) && is_array( $merged [ $key ] ) ) {
					$merged [ $key ] = $this->_array_merge_recursive_distinct( $merged [ $key ], $value );
				} else {
					$merged [ $key ] = $value;
				}
			}
			return $merged;
		}

		public function save_after( $WP_Customize_Manager ) {
			global $boutique_theme_defaults;

			// write our stylesheet to the cache file.
			ob_start();
			echo "/* WARNING - this file will be overwritten every time changes are saved in the Theme Customizer */\n\n\n\n";
			boutique_default_css_output( false );
			$file_name    = get_template_directory() . '/style.custom.css';
			$css_contents = ob_get_clean();
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			WP_Filesystem();
			global $wp_filesystem;
			$wp_filesystem->put_contents( $file_name, $css_contents );
			$version = (int) get_option( 'boutique_dynamic_css_version', 1 );
			$version ++;
			update_option( 'boutique_dynamic_css_version', $version );

			$attachment_url = get_theme_mod( 'logo_header_image', get_template_directory_uri() . '/images/' . get_theme_mod( 'boutique_site_color', $boutique_theme_defaults['boutique_site_color'] ) . '/logo.png' );
			if ( $attachment_url ) {
				set_theme_mod( 'logo_header_image_height', 0 );
				global $wpdb;
				$attachment_id = false;

				// If there is no url, return.
				if ( '' == $attachment_url ) {
					return;
				}

				// Get the upload directory paths
				$upload_dir_paths = wp_upload_dir();

				// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
				if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

					// If this is the URL of an auto-generated thumbnail, get the URL of the original image
					$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

					// Remove the upload path base directory from the attachment URL
					$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

					// Finally, run a custom database query to get the attachment ID from the modified attachment URL
					$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

					if ( $attachment_id ) {
						// woo! find out the image size.
						$attr = wp_get_attachment_image_src( $attachment_id, 'full' );
						if ( $attr && ! empty( $attr[1] ) && ! empty( $attr[2] ) ) {
							// we have a width and height for this image. awesome.
							$logo_width  = (int) get_theme_mod( 'logo_header_image_width', '126' );
							$scale       = $logo_width / $attr[1];
							$logo_height = $attr[2] * $scale;
							if ( $logo_height > 0 ) {
								set_theme_mod( 'logo_header_image_height', $logo_height );
							}
						}
					}
				}
			}
		}
	}

	new boutique_customize_save_hook();
}
