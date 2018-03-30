<?php

/*
*	Admin functions and definitions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Default hidden metaboxes for portfolio
 */
function blade_grve_change_default_hidden( $hidden, $screen ) {
    if ( 'portfolio' == $screen->id ) {
        $hidden = array_flip( $hidden );
        unset( $hidden['portfolio_categorydiv'] ); //show portfolio category box
        $hidden = array_flip( $hidden );
        $hidden[] = 'postexcerpt';
		$hidden[] = 'postcustom';
		$hidden[] = 'commentstatusdiv';
		$hidden[] = 'commentsdiv';
		$hidden[] = 'authordiv';
    }
    return $hidden;
}
add_filter( 'default_hidden_meta_boxes', 'blade_grve_change_default_hidden', 10, 2 );


/**
 * Enqueue scripts and styles for the back end.
 */
function blade_grve_backend_scripts( $hook ) {
	global $post, $pagenow;

	wp_register_style( 'blade-grve-page-feature-section', get_template_directory_uri() . '/includes/css/grve-page-feature-section.css', array(), '2.2.3' );
	wp_register_style( 'blade-grve-admin-meta', get_template_directory_uri() . '/includes/css/grve-admin-meta.css', array(), '1.0' );
	wp_register_style( 'blade-grve-custom-sidebars', get_template_directory_uri() . '/includes/css/grve-custom-sidebars.css', array(), '1.0'  );
	wp_register_style( 'blade-grve-custom-nav-menu', get_template_directory_uri() . '/includes/css/grve-custom-nav-menu.css', array(), '1.0'  );


	$grve_upload_slider_texts = array(
		'modal_title' => esc_html__( 'Insert Images', 'blade' ),
		'modal_button_title' => esc_html__( 'Insert Images', 'blade' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_upload_image_replace_texts = array(
		'modal_title' => esc_html__( 'Replace Image', 'blade' ),
		'modal_button_title' => esc_html__( 'Replace Image', 'blade' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_upload_media_texts = array(
		'modal_title' => esc_html__( 'Insert Media', 'blade' ),
		'modal_button_title' => esc_html__( 'Insert Media', 'blade' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_upload_image_texts = array(
		'modal_title' => esc_html__( 'Insert Image', 'blade' ),
		'modal_button_title' => esc_html__( 'Insert Image', 'blade' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_feature_section_texts = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_custom_sidebar_texts = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	wp_register_script( 'blade-grve-custom-sidebars', get_template_directory_uri() . '/includes/js/grve-custom-sidebars.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-custom-sidebars', 'grve_custom_sidebar_texts', $grve_custom_sidebar_texts );

	wp_register_script( 'blade-grve-upload-slider-script', get_template_directory_uri() . '/includes/js/grve-upload-slider.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-upload-slider-script', 'grve_upload_slider_texts', $grve_upload_slider_texts );

	wp_register_script( 'blade-grve-upload-feature-slider-script', get_template_directory_uri() . '/includes/js/grve-upload-feature-slider.js', array( 'jquery'), false, '1.3.0' );
	wp_localize_script( 'blade-grve-upload-feature-slider-script', 'grve_upload_feature_slider_texts', $grve_upload_slider_texts );

	wp_register_script( 'blade-grve-upload-image-replace-script', get_template_directory_uri() . '/includes/js/grve-upload-image-replace.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-upload-image-replace-script', 'grve_upload_image_replace_texts', $grve_upload_image_replace_texts );

	wp_register_script( 'blade-grve-upload-simple-media-script', get_template_directory_uri() . '/includes/js/grve-upload-simple.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-upload-simple-media-script', 'grve_upload_media_texts', $grve_upload_media_texts );

	wp_register_script( 'blade-grve-upload-image-script', get_template_directory_uri() . '/includes/js/grve-upload-image.js', array( 'jquery'), false, '1.0.0' );
	wp_localize_script( 'blade-grve-upload-image-script', 'grve_upload_image_texts', $grve_upload_image_texts );

	wp_register_script( 'blade-grve-page-feature-section-script', get_template_directory_uri() . '/includes/js/grve-page-feature-section.js', array( 'jquery', 'wp-color-picker' ), false, '2.0.0' );
	wp_localize_script( 'blade-grve-page-feature-section-script', 'grve_feature_section_texts', $grve_feature_section_texts );

	wp_register_script( 'blade-grve-post-options-script', get_template_directory_uri() . '/includes/js/grve-post-options.js', array( 'jquery'), false, '1.0.0' );
	wp_register_script( 'blade-grve-portfolio-options-script', get_template_directory_uri() . '/includes/js/grve-portfolio-options.js', array( 'jquery'), false, '1.0.0' );

	wp_register_script( 'blade-grve-custom-nav-menu-script', get_template_directory_uri().'/includes/js/grve-custom-nav-menu.js', array( 'jquery'), false, '1.4.0' );

	if ( 'post-new.php' == $hook || 'post.php' == $hook ) {


		$feature_section_post_types = blade_grve_option( 'feature_section_post_types' );

		if ( !empty( $feature_section_post_types ) && in_array( $post->post_type, $feature_section_post_types ) && 'attachment' != $post->post_type ) {

			wp_enqueue_style( 'blade-grve-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'blade-grve-page-feature-section' );

			wp_enqueue_script( 'blade-grve-upload-simple-media-script' );
			wp_enqueue_script( 'blade-grve-upload-image-script' );
			wp_enqueue_script( 'blade-grve-upload-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-feature-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-image-replace-script' );
			wp_enqueue_script( 'blade-grve-page-feature-section-script' );
		}


        if ( 'post' === $post->post_type ) {

			wp_enqueue_style( 'blade-grve-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( 'blade-grve-page-feature-section' );

			wp_enqueue_script( 'blade-grve-upload-simple-media-script' );
			wp_enqueue_script( 'blade-grve-upload-image-script' );
			wp_enqueue_script( 'blade-grve-upload-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-feature-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-image-replace-script' );
			wp_enqueue_script( 'blade-grve-page-feature-section-script' );
			wp_enqueue_script( 'blade-grve-post-options-script' );

        } else if ( 'page' === $post->post_type || 'portfolio' === $post->post_type || 'product' === $post->post_type ) {

			wp_enqueue_style( 'blade-grve-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( 'blade-grve-page-feature-section' );

			wp_enqueue_script( 'blade-grve-upload-simple-media-script' );
			wp_enqueue_script( 'blade-grve-upload-image-script' );
			wp_enqueue_script( 'blade-grve-upload-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-feature-slider-script' );
			wp_enqueue_script( 'blade-grve-upload-image-replace-script' );
			wp_enqueue_script( 'blade-grve-page-feature-section-script' );

			wp_enqueue_script( 'blade-grve-portfolio-options-script' );

        } else if ( 'testimonial' === $post->post_type ) {

			wp_enqueue_style( 'blade-grve-admin-meta' );

        }
    }

	if ( 'edit-tags.php' == $hook || 'term.php' == $hook ) {
		wp_enqueue_style( 'blade-grve-admin-meta' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'blade-grve-page-feature-section' );


		wp_enqueue_media();
		wp_enqueue_script( 'blade-grve-page-feature-section-script' );
		wp_enqueue_script( 'blade-grve-upload-image-script' );
		wp_enqueue_script( 'blade-grve-upload-image-replace-script' );

	}

	if ( 'nav-menus.php' == $hook ) {
		wp_enqueue_style( 'blade-grve-custom-nav-menu' );

		wp_enqueue_media();
		wp_enqueue_script( 'blade-grve-upload-simple-media-script' );
		wp_enqueue_script( 'blade-grve-custom-nav-menu-script' );
	}


	if ( isset( $_GET['page'] ) && ( 'blade-grve-custom-sidebar-settings' == $_GET['page'] ) ) {

		wp_enqueue_style( 'blade-grve-custom-sidebars' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'blade-grve-custom-sidebars' );
	}

	wp_register_style(
		'redux-custom-css',
		get_template_directory_uri() . '/includes/css/grve-redux-panel.css',
		array(),
		time(),
		'all'
	);
	wp_enqueue_style( 'redux-custom-css' );



}
add_action( 'admin_enqueue_scripts', 'blade_grve_backend_scripts', 10, 1 );

/**
 * Helper function to get custom fields with fallback
 */
function blade_grve_post_meta( $id, $fallback = false ) {
	global $post;
	$post_id = $post->ID;
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

function blade_grve_admin_post_meta( $post_id, $id, $fallback = false ) {
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

function blade_grve_get_term_meta( $term_id, $meta_key ) {
	$grve_term_meta  = '';

	if ( function_exists( 'get_term_meta' ) ) {
		$grve_term_meta = get_term_meta( $term_id, $meta_key, true );
	} else {
		if ( 'grve_custom_title_options' == $meta_key ) {
			$grve_term_meta = get_option( 'grve_term_meta_' . $term_id );
		}
	}

	return $grve_term_meta;

}

function blade_grve_update_term_meta( $term_id , $meta_key, $meta_value ) {

	if ( function_exists( 'update_term_meta' ) ) {
		update_term_meta( $term_id, $meta_key, $meta_value );
	} else {
		if ( 'grve_custom_title_options' == $meta_key ) {
			update_option( 'grve_term_meta_' . $term_id , $meta_value );
		}
	}

}

/**
 * Helper function to get theme options with fallback
 */
function blade_grve_option( $id, $fallback = false, $param = false ) {
	global $blade_grve_options;
	$grve_theme_options = $blade_grve_options;

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($grve_theme_options[$id]) && $grve_theme_options[$id] !== '' ) ? $grve_theme_options[$id] : $fallback;
	if ( !empty($grve_theme_options[$id]) && $param ) {
		$output = ( isset($grve_theme_options[$id][$param]) && $grve_theme_options[$id][$param] !== '' ) ? $grve_theme_options[$id][$param] : $fallback;
		if ( 'font-family' == $param ) {
			$output = urldecode( $output );
			if ( strpos($output, ' ') && !strpos($output, ',') ) {
				$output = '"' . $output . '"';
			}
		}
	}
	return $output;
}

/**
 * Helper function to print css code if not empty
 */
function blade_grve_css_option( $id, $fallback = false, $param = false ) {
	$option = blade_grve_option( $id, $fallback, $param );
	if ( !empty( $option ) && 0 !== $option && $param ) {
		return $param . ': ' . $option . ';';
	}
}

/**
 * Helper function to get array value with fallback
 */
function blade_grve_array_value( $input_array, $id, $fallback = false, $param = false ) {

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($input_array[$id]) && $input_array[$id] !== '' ) ? $input_array[$id] : $fallback;
	if ( !empty($input_array[$id]) && $param ) {
		$output = ( isset($input_array[$id][$param]) && $input_array[$id][$param] !== '' ) ? $input_array[$id][$param] : $fallback;
	}
	return $output;
}

/**
 * Helper function to return trimmed css code
 */
function blade_grve_get_css_output( $css ) {
	/* Trim css for speed */
	$css_trim =  preg_replace( '/\s+/', ' ', $css );

	/* Add stylesheet Tag */
	return "<!-- Dynamic css -->\n<style type=\"text/css\">\n" . $css_trim . "\n</style>";
}

/**
 * Helper functions to set/get current template
 */
function blade_grve_set_current_view( $id ) {
	global $blade_grve_options;
	$blade_grve_options['current_view'] = $id;
}
function blade_grve_get_current_view( $fallback = '' ) {
	global $blade_grve_options;
	$grve_theme_options = $blade_grve_options;

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($grve_theme_options['current_view']) && $grve_theme_options['current_view'] !== '' ) ? $grve_theme_options['current_view'] : $fallback;
	return $output;
}

/**
 * Helper function convert hex to rgb
 */
function blade_grve_hex2rgb( $hex ) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1) );
		$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1) );
		$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1) );
	} else {
		$r = hexdec( substr( $hex, 0, 2) );
		$g = hexdec( substr( $hex, 2, 2) );
		$b = hexdec( substr( $hex, 4, 2) );
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb);
}

/**
 * Helper function to get theme visibility options
 */
function blade_grve_visibility( $id, $fallback = '' ) {
	$visibility = blade_grve_option( $id, $fallback  );
	if ( '1' == $visibility ) {
		return true;
	}
	return false;
}

/**
 * Get Color
 */
function blade_grve_get_color( $color = 'dark', $color_custom = '#000000' ) {

	switch( $color ) {

		case 'dark':
			$color_custom = '#000000';
			break;
		case 'light':
			$color_custom = '#ffffff';
			break;
		case 'primary-1':
			$color_custom = blade_grve_option( 'body_primary_1_color' );
			break;
		case 'primary-2':
			$color_custom = blade_grve_option( 'body_primary_2_color' );
			break;
		case 'primary-3':
			$color_custom = blade_grve_option( 'body_primary_3_color' );
			break;
		case 'primary-4':
			$color_custom = blade_grve_option( 'body_primary_4_color' );
			break;
		case 'primary-5':
			$color_custom = blade_grve_option( 'body_primary_5_color' );
			break;
	}

	return $color_custom;
}

/**
 * Backend Theme Activation Actions
 */
function blade_grve_backend_theme_activation() {
	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {

		$catalog = array(
			'width'   => '600',    // px
			'height'  => '600',    // px
			'crop'	  => 1,        // true
		);

		$single = array(
			'width'   => '600',    // px
			'height'  => '600',    // px
			'crop'    => 1,        // true
		);

		$thumbnail = array(
			'width'   => '180',    // px
			'height'  => '180',    // px
			'crop'    => 1,        // true
		);

		update_option( 'shop_catalog_image_size', $catalog );
		update_option( 'shop_single_image_size', $single );
		update_option( 'shop_thumbnail_image_size', $thumbnail );
		update_option( 'woocommerce_enable_lightbox', false );

		//Redirect to Theme Options
		header( 'Location: ' . admin_url() . 'admin.php?page=blade_grve_options&tab=0' ) ;
	}
}

add_action('admin_init','blade_grve_backend_theme_activation');

/**
 * Check if Revolution slider is active
 */

/**
 * Check if to replace Backend Logo
 */
function blade_grve_admin_login_logo() {

	$replace_logo = blade_grve_option( 'replace_admin_logo' );
	if ( $replace_logo ) {
		$grve_logo = blade_grve_option( 'logo','','url' );
		$grve_logo_height = blade_grve_option( 'logo', '84', 'height' );
		if ( $grve_logo_height > 84 ) {
			$grve_logo_height = 84;
		}
		$grve_logo_width = blade_grve_option( 'logo', '300', 'width' );
		if ( $grve_logo_width > 300 ) {
			$grve_logo_width = 300;
		}
		if ( !empty( $grve_logo ) ) {
			echo "
			<style>
			.login h1 a {
				background-image: url('" . esc_url( $grve_logo ) . "');
				width: 100%;
				height: " . esc_attr( $grve_logo_height ) . "px;
				background-size: " . esc_attr( $grve_logo_width ) . "px auto;
			}
			</style>
			";
		}
	}
}
add_action( 'login_head', 'blade_grve_admin_login_logo' );

function blade_grve_login_headerurl( $url ){
	$replace_logo = blade_grve_option( 'replace_admin_logo' );
	if ( $replace_logo ) {
		return esc_url( home_url( '/' ) );
	}
	return esc_url( $url );
}
add_filter('login_headerurl', 'blade_grve_login_headerurl');

function blade_grve_login_headertitle( $title ) {
	$replace_logo = blade_grve_option( 'replace_admin_logo' );
	if ( $replace_logo ) {
		return esc_attr( get_bloginfo( 'name' ) );
	}
	return esc_attr( $title );
}
add_filter('login_headertitle', 'blade_grve_login_headertitle' );

/**
 * Disable SEO Page Analysis
 */
function blade_grve_disable_page_analysis( $bool ) {
	if( '1' == blade_grve_option( 'disable_seo_page_analysis', '0' ) ) {
		return false;
	}
	return $bool;
}
add_filter( 'wpseo_use_page_analysis', 'blade_grve_disable_page_analysis' );

/**
 * Browser Webkit Check
 */
function blade_grve_browser_webkit_check() {

	if ( empty($_SERVER['HTTP_USER_AGENT'] ) ) {
		return false;
	}

	$u_agent = $_SERVER['HTTP_USER_AGENT'];

	if (
		( preg_match( '!linux!i', $u_agent ) || preg_match( '!windows|win32!i', $u_agent ) ) && preg_match( '!webkit!i', $u_agent )
	) {
		return true;
	}

	return false;
}

/**
 * Add Hooks for Page Redirect ( Coming Soon )
 */
add_filter( 'template_include', 'blade_grve_redirect_page_template', 99 );

if ( ! function_exists( 'blade_grve_redirect_page_template' ) ) {
	function blade_grve_redirect_page_template( $template ) {
		if ( blade_grve_visibility('coming_soon_enabled' )  && !is_user_logged_in() ) {
			$redirect_page = blade_grve_option( 'coming_soon_page' );
			$redirect_template = blade_grve_option( 'coming_soon_template' );
			if ( !empty( $redirect_page ) && 'content' == $redirect_template ) {
				$new_template = locate_template( array( 'page-templates/template-content-only.php' ) );
				if ( '' != $new_template ) {
					return $new_template ;
				}
			}
		}
		return $template;
	}
}

add_filter( 'template_redirect', 'blade_grve_redirect' );

if ( ! function_exists( 'blade_grve_redirect' ) ) {
	function blade_grve_redirect() {
		if ( blade_grve_visibility('coming_soon_enabled' ) && !is_user_logged_in() ) {
			$redirect_page = blade_grve_option( 'coming_soon_page' );
			$protocol = is_ssl() ? 'https://' : 'http://';

			if ( !empty( $redirect_page )
				&& !in_array( $GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php') )
				&& !is_admin()
				&& ( $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] != get_permalink( $redirect_page ) ) ) {

				wp_redirect( get_permalink( $redirect_page ) );
				exit();

			}
		}
		return false;
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
