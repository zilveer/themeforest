<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package mediacenter
 */

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'is_dokan_activated' ) ) {
	function is_dokan_activated() {
		return class_exists( 'WeDevs_Dokan' ) ? true : false;
	}
}

/**
 * Check if Visual Composer is activated
 */
if( ! function_exists( 'is_visual_composer_activated' ) ) {
	function is_visual_composer_activated() {
		return class_exists( 'WPBakeryVisualComposerAbstract' ) ? true : false;
	}
}

/**
 * Check if Redux Framework is activated
 */
if( ! function_exists( 'is_redux_activated' ) ) {
	function is_redux_activated() {
		return class_exists( 'ReduxFrameworkPlugin' ) ? true : false;
	}	
}

/**
 * Query WooCommerce Extension Activation.
 * @var  $extension main extension class name
 * @return boolean
 */
function is_woocommerce_extension_activated( $extension ) {

	if( is_woocommerce_activated() ) {
		$is_activated = class_exists( $extension ) ? true : false;
	} else {
		$is_activated = false;
	}
	
	return $is_activated;
}

/**
 * Checks if YITH Wishlist is activated
 *
 * @return boolean
 */
if( ! function_exists( 'is_yith_wcwl_activated' ) ) {
	function is_yith_wcwl_activated() {
		return is_woocommerce_extension_activated( 'YITH_WCWL' );
	}
}

/**
 * Checks if YITH WooCompare is activated
 *
 * @return boolean
 */
if( ! function_exists( 'is_yith_woocompare_activated' ) ) {
	function is_yith_woocompare_activated() {
		return is_woocommerce_extension_activated( 'YITH_Woocompare' );
	}
}

/**
 * Checks if WPML is activated
 *
 * @return  boolean
 */
if( ! function_exists( 'is_wpml_activated' ) ) {
	function is_wpml_activated() {
		return function_exists( 'icl_object_id' );
	}
}


if ( ! function_exists( 'mc_get_social_networks' ) ) {
	/**
	 * List of all available social networks
	 *
	 * @return array array of all social networks and its details
	 */
	function mc_get_social_networks() {
		return apply_filters( 'mc_get_social_networks', array(
			'facebook' 		=> array(
				'label'	=> __( 'Facebook', 'mediacenter' ),
				'icon'	=> 'fa fa-facebook',
				'id'	=> 'facebook_link'
			),
			'twitter' 		=> array(
				'label'	=> __( 'Twitter', 'mediacenter' ),
				'icon'	=> 'fa fa-twitter',
				'id'	=> 'twitter_link'
			),
			'pinterest' 	=> array(
				'label'	=> __( 'Pinterest', 'mediacenter' ),
				'icon'	=> 'fa fa-pinterest',
				'id'	=> 'pinterest_link'
			),
			'linkedin' 		=> array(
				'label'	=> __( 'LinkedIn', 'mediacenter' ),
				'icon'	=> 'fa fa-linkedin',
				'id'	=> 'linkedin_link'
			),
			'googleplus' 	=> array(
				'label'	=> __( 'Google+', 'mediacenter' ),
				'icon'	=> 'fa fa-google-plus',
				'id'	=> 'googleplus_link'
			),
			'tumblr' 	=> array(
				'label'	=> __( 'Tumblr', 'mediacenter' ),
				'icon'	=> 'fa fa-tumblr',
				'id'	=> 'tumblr_link'
			),
			'instagram' 	=> array(
				'label'	=> __( 'Instagram', 'mediacenter' ),
				'icon'	=> 'fa fa-instagram',
				'id'	=> 'instagram_link'
			),
			'youtube' 		=> array(
				'label'	=> __( 'Youtube', 'mediacenter' ),
				'icon'	=> 'fa fa-youtube',
				'id'	=> 'youtube_link'
			),
			'vimeo' 		=> array(
				'label'	=> __( 'Vimeo', 'mediacenter' ),
				'icon'	=> 'fa fa-vimeo-square',
				'id'	=> 'vimeo_link'
			),
			'dribbble' 		=> array(
				'label'	=> __( 'Dribbble', 'mediacenter' ),
				'icon'	=> 'fa fa-dribbble',
				'id'	=> 'dribbble_link'
			),
			'stumbleupon' 	=> array(
				'label'	=> __( 'StumbleUpon', 'mediacenter' ),
				'icon'	=> 'fa fa-stumbleupon',
				'id'	=> 'stumble_upon_link'
			),
			'rss'			=> array(
				'label'	=> __( 'RSS', 'mediacenter' ),
				'icon'	=> 'fa fa-rss',
				'id'	=> 'rss_link'
			)
		) );
	}
}

if ( ! function_exists( 'mc_init_structured_data' ) ) {
	/**
	 * Generate the structured data...
	 * Initialize Enter::$structured_data via Enter::set_structured_data()...
	 * Hooked into:
	 * `mc_loop_post`
	 * `mc_single_post`
	 * `mc_page`
	 * Apply `mc_structured_data` filter hook for structured data customization :)
	 */
	function mc_init_structured_data() {
		if ( is_home() || is_category() || is_date() || is_search() || is_single() && ( is_woocommerce_activated() && ! is_woocommerce() ) ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'normal' );
			$logo  = apply_filters( 'mc_logo_image_src', wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ) );

			$json['@type']            = 'BlogPosting';
			$json['mainEntityOfPage'] = array(
				'@type'                 => 'webpage',
				'@id'                   => get_the_permalink(),
			);
			$json['image']            = array(
				'@type'                 => 'ImageObject',
				'url'                   => $image[0],
				'width'                 => $image[1],
				'height'                => $image[2],
			);
			$json['publisher']        = array(
				'@type'                 => 'organization',
				'name'                  => get_bloginfo( 'name' ),
				'logo'                  => array(
					'@type'               => 'ImageObject',
					'url'                 => $logo[0],
					'width'               => $logo[1],
					'height'              => $logo[2],
				),
			);

			$json['author']           = array(
				'@type'                 => 'person',
				'name'                  => get_the_author(),
			);
			$json['datePublished']    = get_post_time( 'c' );
			$json['dateModified']     = get_the_modified_date( 'c' );
			$json['name']             = get_the_title();
			$json['headline']         = get_the_title();
			$json['description']      = get_the_excerpt();
		} elseif ( is_page() ) {
			$json['@type']            = 'WebPage';
			$json['url']              = get_the_permalink();
			$json['name']             = get_the_title();
			$json['description']      = get_the_excerpt();
		}
		if ( isset( $json ) ) {
			MediaCenter::set_structured_data( apply_filters( 'mc_structured_data', $json ) );
		}
	}
}

if ( ! function_exists( 'pr' ) ) {
	function pr( $var ) {
		echo '<pre>' . print_r( $var, 1 ) . '</pre>';
	}
}