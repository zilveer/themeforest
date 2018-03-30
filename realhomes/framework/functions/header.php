<?php
/**
 * Dynamic CSS
 */
include_once( get_template_directory() . '/css/dynamic-css.php' );


if ( ! function_exists( 'get_default_banner' ) ) {
	/**
	 * Get Default Banner
	 *
	 * @return mixed|string|void
	 */
	function get_default_banner() {
		$banner_image_path = get_option( 'theme_general_banner_image' );
		return empty( $banner_image_path ) ? get_template_directory_uri() . '/images/banner.gif' : $banner_image_path;
	}
}


if ( ! function_exists( 'output_quick_css' ) ) {
	/**
	 * Output Quick CSS Fix
	 */
	function output_quick_css() {
		// Quick CSS from Theme Options
		$quick_css = stripslashes( get_option( 'theme_quick_css' ) );

		if ( ! empty( $quick_css ) ) {
			echo "<style type='text/css' id='quick-css'>\n\n";
			echo $quick_css . "\n\n";
			echo "</style>";
		}
	}

	add_action( 'wp_head', 'output_quick_css' );
}


if ( ! function_exists( 'output_analytics_script' ) ) {
	/**
	 * Output Analytics Script
	 */
	function output_analytics_script() {
		echo stripslashes( get_option( 'theme_google_analytics' ) );
	}

	add_action( 'wp_head', 'output_analytics_script' );
}


if ( ! function_exists( 'output_recaptcha_js' ) ) {
	/**
	 * Output reCAPTCHA JavaScript
	 */
	function output_recaptcha_js() {
		$show_reCAPTCHA = get_option( 'theme_show_reCAPTCHA' );
		$reCAPTCHA_public_key = get_option( 'theme_recaptcha_public_key' );
		$reCAPTCHA_private_key = get_option( 'theme_recaptcha_private_key' );

		if ( ! empty( $reCAPTCHA_public_key ) && ! empty( $reCAPTCHA_private_key ) && $show_reCAPTCHA == 'true' ) {
			?>
			<script type="text/javascript">
				var RecaptchaOptions = {
					theme : 'custom', custom_theme_widget : 'recaptcha_widget'
				};
			</script>
			<?php
		}
	}

	add_action( 'wp_head', 'output_recaptcha_js' );
}


if ( ! function_exists( 'add_opengraph_doctype' ) ) {
	/**
	 * Adding the Open Graph in the Language Attributes
	 *
	 * @param $output
	 * @return string
	 */
	function add_opengraph_doctype( $output ) {
		if ( is_singular( 'property' ) && ( 'true' == get_option( 'theme_add_meta_tags' ) ) ) {
			return $output . '
                xmlns:og="http://opengraphprotocol.org/schema/"
                xmlns:fb="http://www.facebook.com/2008/fbml"';
		}
	}

	add_filter( 'language_attributes', 'add_opengraph_doctype' );
}


if ( ! function_exists( 'insert_og_in_head' ) ) {
	/**
	 * Adding the Open Graph Meta Info
	 */
	function insert_og_in_head() {
		if ( is_singular( 'property' ) && ( 'true' == get_option( 'theme_add_meta_tags' ) ) ) {

			global $post;
			if ( has_excerpt( $post->ID ) ) {
				$description = strip_tags( get_the_excerpt() );
			} else {
				$description = str_replace( "\r\n", ' ', substr( strip_tags( strip_shortcodes( $post->post_content ) ), 0, 160 ) );
			}
			if ( empty( $description ) ) {
				$description = get_bloginfo( 'description' );
			}

			echo '<meta property="og:title" content="' . get_the_title() . '"/>';
			echo '<meta property="og:description" content="' . $description . '" />';
			echo '<meta property="og:type" content="article"/>';
			echo '<meta property="og:url" content="' . get_permalink() . '"/>';
			echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '"/>';
			if ( has_post_thumbnail( $post->ID ) ) {
				$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[ 0 ] ) . '"/>';
			}

		}
	}

	add_action( 'wp_head', 'insert_og_in_head', 5 );
}


if ( ! function_exists( 'inspiry_sticky_header' ) ) {
	/**
	 * Sticky Header Class
	 *
	 * @param $classes
	 * @return array
	 */
	function inspiry_sticky_header( $classes ) {
		$sticky_header = get_option( 'theme_sticky_header' );
		if ( $sticky_header == 'true' ) {
			$classes[] = 'sticky-header';
		}
		return $classes;
	}

	add_filter( 'body_class', 'inspiry_sticky_header' );
}


if ( ! function_exists( 'inspiry_add_ie_html5_shim' ) ) :
	function inspiry_add_ie_html5_shim() {
		$protocol = is_ssl() ? 'https' : 'http';
		?>
		<!--[if lt IE 9]>
		<script src="<?php echo $protocol; ?>://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php
	}

	add_action( 'wp_head', 'inspiry_add_ie_html5_shim' );
endif;

