<?php
/**
 * Setup theme specific frontend functions
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Setup
 * @subpackage Frontend
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add fontawesome stylesheet file to <head> section.
 *
 * @since PrimaShop 2.0
 */
add_action( 'wp_enqueue_scripts', 'prima_styles_fontawesome', 100 );
function prima_styles_fontawesome() {
	wp_enqueue_style('style-fontawesome', prima_childtheme_file('style-fontawesome.min.css'), false, PRIMA_THEME_VERSION, 'screen, projection');
	/* disable ubermenu fontawesome */
	wp_dequeue_style( 'ubermenu-font-awesome' );
}

/**
 * Add main stylesheet file to <head> section.
 *
 * @since PrimaShop 1.0
 */
add_action( 'wp_enqueue_scripts', 'prima_styles_theme', 100 );
function prima_styles_theme() {
    /* If using a child theme, auto-load the parent theme style. */
    if ( is_child_theme() ) {
        wp_enqueue_style( 'style-theme-parent', PRIMA_URI . '/style.css', array(), PRIMA_THEME_VERSION );
    }
	wp_enqueue_style('style-theme', get_bloginfo('stylesheet_url'), false, PRIMA_THEME_VERSION );
}

/**
 * Add responsive stylesheet file to <head> section.
 *
 * @since PrimaShop 1.0
 */
add_action( 'wp_enqueue_scripts', 'prima_styles_responsive', 100);
function prima_styles_responsive() {
	$responsive = prima_get_setting( 'responsive' );
	if ( $responsive == 'no' ) return;
    /* If using a child theme, auto-load the parent theme style. */
    if ( is_child_theme() ) {
        wp_enqueue_style( 'style-responsive-parent', PRIMA_URI . '/style-responsive.css', array(), PRIMA_THEME_VERSION );
    }
	wp_enqueue_style('style-responsive', prima_childtheme_file('style-responsive.css'), false, PRIMA_THEME_VERSION );
}

/**
 * Add responsive meta tag to <head> section.
 *
 * @since PrimaShop 1.0
 */
add_action( 'wp_head', 'prima_meta_responsive' );
function prima_meta_responsive() {
	$responsive = prima_get_setting( 'responsive' );
	if ( $responsive == 'no' ) return;
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">'."\n";
}

/**
 * Add IE-compatible meta tag to <head> section.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_html_before', 'prima_meta_iecompatible' );
function prima_meta_iecompatible() {
	if ( isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) ) {
        header('X-UA-Compatible: IE=edge,chrome=1');
	}
}

/**
 * Add html5shiv-printshiv.js file to support old IE browser to <head> section.
 *
 * @since PrimaShop 1.0
 */
add_action( 'wp_head', 'prima_ie_js_html5shiv' );
function prima_ie_js_html5shiv() {
?>
<!--[if lt IE 9]>
<script src="<?php echo PRIMA_URI; ?>/js/html5shiv-printshiv.js"></script>
<![endif]-->
<?php
}

/**
 * Add respond.min.js file to support media queries for old IE browser to <head> section.
 *
 * @since PrimaShop 1.0
 */
add_action( 'wp_head', 'prima_ie_js_responsive' );
function prima_ie_js_responsive() {
	$responsive = prima_get_setting( 'responsive' );
	if ( $responsive == 'no' ) return;
?>
<!--[if lt IE 9]>
<script src="<?php echo PRIMA_URI; ?>/js/respond.min.js"></script>
<![endif]-->
<?php
}

/**
 * Add responsive status class to <body> class.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'body_class', 'prima_responsive_class' );
function prima_responsive_class( $classes ) {
	$responsive = prima_get_setting( 'responsive' );
	if ( $responsive == 'yes' ) 
		$classes[] = 'responsive-yes';
	else
		$classes[] = 'responsive-no';
	return $classes;
}

/**
 * Add sticky header status class to <body> class.
 */
add_filter( 'body_class', 'prima_header_sticky_class' );
function prima_header_sticky_class( $classes ) {
	$responsive = prima_get_setting( 'header_sticky' );
	if ( $responsive == 'yes' && !class_exists( 'UberMenu_Sticky' ) ) 
		$classes[] = 'header-sticky-yes header-sticky-inactive';
	else
		$classes[] = 'header_sticky-no';
	return $classes;
}

/**
 * Add style layout class (full/boxed/custom) to <body> class.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'body_class', 'prima_style_layout_class' );
function prima_style_layout_class( $classes ) {
	$style = prima_get_setting( 'style' );
	if (!$style) $style = 'boxed';
	$classes[] = 'stylelayout-'.$style;
	return $classes;
}

/**
 * Add header logo layout class to <body> class.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'body_class', 'prima_header_logo_class' );
function prima_header_logo_class( $classes ) {
	$logo = prima_get_setting( 'header_logo' );
	if ($logo) $classes[] = 'header-logo-active';
	return $classes;
}

/**
 * Add footer layout class to <body> class.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'body_class', 'prima_footer_body_classes' );
function prima_footer_body_classes($classes) {
	if( (int)prima_get_setting('footer_widgets') > 0 )
		$classes[] = 'footer-widgets-'.prima_get_setting('footer_widgets');
	return $classes; 
}

/**
 * Output header top navigation template file.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_header', 'prima_header_topnav_output', 10 );
function prima_header_topnav_output() {
	if ( !prima_get_setting( 'topnav' ) )
		return;
	$page_id = prima_get_real_page_id();
	if ( prima_get_post_meta( "_prima_header_topnav_hide", $page_id ) )
		return;
	get_template_part( 'prima-header-topnav' );
}

/**
 * Output header content (menu+logo) template file.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_header', 'prima_header_content_output', 20 );
function prima_header_content_output() {
	$page_id = prima_get_real_page_id();
	if ( prima_get_post_meta( "_prima_header_content_hide", $page_id ) )
		return;
	get_template_part( 'prima-header-content' );
}

/**
 * Output header logo stylesheet to "custom styles" area on <head> section.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_custom_styles', 'prima_custom_styles_header_logo' );
function prima_custom_styles_header_logo() {
	$logo = prima_get_setting( 'header_logo' );
	if (!$logo) return;
	echo '.header-logo-active #header-title a { background: url('.$logo.') no-repeat left center; }';
}

/**
 * Function to detect supported featured image types (image/slider/custom/disable) for any post type.
 *
 * @since PrimaShop 1.0
 */
function prima_header_featured_from_page( $page_id, $header = array(), $header_type = '' ) {
	if ( !$header_type ) {
		$header_type = prima_get_post_meta( "_prima_header_featured", $page_id );
	}
	if ( $header_type == 'disable' ) {
		$header['type'] = 'disable';
	}
	elseif ( $header_type == 'custom' && prima_get_post_meta( "_prima_header_custom", $page_id ) ) {
		$header['type'] = 'custom';
		$header['custom'] = prima_get_post_meta( "_prima_header_custom", $page_id );
		$header['nopadding'] = prima_get_post_meta( "_prima_header_nopadding", $page_id );
		$header['fullscreen'] = prima_get_post_meta( "_prima_header_fullscreen", $page_id );
	}
	elseif ( $header_type == 'slider' && prima_get_post_meta( "_prima_header_image_1", $page_id ) ) {
		$header['type'] = 'slider';
		$header['slider'] = array();
		$slider_numbers = intval ( prima_get_setting( 'header_featured_slider_numbers' ) );
		if ( $slider_numbers < 1 ) $slider_numbers = 5; 
		for ($i = 1; $i <= $slider_numbers; $i++) {
			$slider_src = prima_get_post_meta( "_prima_header_image_$i", $page_id );
			if ($slider_src) {
				$header['slider'][$i]['src'] = $slider_src;
				$header['slider'][$i]['url'] = prima_get_post_meta( "_prima_header_image_url_$i", $page_id );
				$header['slider'][$i]['target'] = prima_get_post_meta( "_prima_header_image_target_$i", $page_id );
				$header['slider'][$i]['desc'] = prima_get_post_meta( "_prima_header_image_desc_$i", $page_id );
			}	
		}
		$header['slider_animation'] = prima_get_post_meta( "_prima_header_slider_animation", $page_id );
		$header['slider_slideshowspeed'] = prima_get_post_meta( "_prima_header_slider_slideshowspeed", $page_id );
		$header['slider_animationspeed'] = prima_get_post_meta( "_prima_header_slider_animationspeed", $page_id );
		$header['slider_directionnav'] = prima_get_post_meta( "_prima_header_slider_directionnav", $page_id );
		$header['slider_controlnav'] = prima_get_post_meta( "_prima_header_slider_controlnav", $page_id );
		$header['nopadding'] = prima_get_post_meta( "_prima_header_nopadding", $page_id );
		$header['fullscreen'] = prima_get_post_meta( "_prima_header_fullscreen", $page_id );
	}
	elseif ( prima_get_post_meta( "_prima_header_image_1", $page_id ) ) {
		$header['type'] = 'image';
		$header['image']['src'] = prima_get_post_meta( "_prima_header_image_1", $page_id );
		$header['image']['url'] = prima_get_post_meta( "_prima_header_image_url_1", $page_id );
		$header['image']['target'] = prima_get_post_meta( "_prima_header_image_target_1", $page_id );
		$header['nopadding'] = prima_get_post_meta( "_prima_header_nopadding", $page_id );
		$header['fullscreen'] = prima_get_post_meta( "_prima_header_fullscreen", $page_id );
	}
	return $header;
}

/**
 * Function to detect supported featured image types (image/slider/custom/disable) for any taxonomy.
 *
 * @since PrimaShop 1.1
 */
function prima_header_featured_from_tax( $term_id, $taxonomy, $header = array(), $header_type = '' ) {
	if ( !$header_type ) {
		$header_type = prima_get_tax_meta( "_prima_header_featured", $term_id, $taxonomy );
	}
	if ( $header_type == 'disable' ) {
		$header['type'] = 'disable';
	}
	elseif ( $header_type == 'custom' && prima_get_tax_meta( "_prima_header_custom", $term_id, $taxonomy ) ) {
		$header['type'] = 'custom';
		$header['custom'] = prima_get_tax_meta( "_prima_header_custom", $term_id, $taxonomy );
		$header['nopadding'] = prima_get_tax_meta( "_prima_header_nopadding", $term_id, $taxonomy );
		$header['fullscreen'] = prima_get_tax_meta( "_prima_header_fullscreen", $term_id, $taxonomy );
	}
	elseif ( $header_type == 'slider' && prima_get_tax_meta( "_prima_header_image_1", $term_id, $taxonomy ) ) {
		$header['type'] = 'slider';
		$header['slider'] = array();
		$slider_numbers = intval ( prima_get_setting( 'header_featured_slider_numbers' ) );
		if ( $slider_numbers < 1 ) $slider_numbers = 5; 
		for ($i = 1; $i <= $slider_numbers; $i++) {
			$slider_src = prima_get_tax_meta( "_prima_header_image_$i", $term_id, $taxonomy );
			if ($slider_src) {
				$header['slider'][$i]['src'] = $slider_src;
				$header['slider'][$i]['url'] = prima_get_tax_meta( "_prima_header_image_url_$i", $term_id, $taxonomy );
				$header['slider'][$i]['target'] = prima_get_tax_meta( "_prima_header_image_target_$i", $term_id, $taxonomy );
				$header['slider'][$i]['desc'] = prima_get_tax_meta( "_prima_header_image_desc_$i", $term_id, $taxonomy );
			}	
		}
		$header['slider_animation'] = prima_get_tax_meta( "_prima_header_slider_animation", $term_id, $taxonomy );
		$header['slider_slideshowspeed'] = prima_get_tax_meta( "_prima_header_slider_slideshowspeed", $term_id, $taxonomy );
		$header['slider_animationspeed'] = prima_get_tax_meta( "_prima_header_slider_animationspeed", $term_id, $taxonomy );
		$header['slider_directionnav'] = prima_get_tax_meta( "_prima_header_slider_directionnav", $term_id, $taxonomy );
		$header['slider_controlnav'] = prima_get_tax_meta( "_prima_header_slider_controlnav", $term_id, $taxonomy );
		$header['nopadding'] = prima_get_tax_meta( "_prima_header_nopadding", $term_id, $taxonomy );
		$header['fullscreen'] = prima_get_tax_meta( "_prima_header_fullscreen", $term_id, $taxonomy );
	}
	elseif ( prima_get_tax_meta( "_prima_header_image_1", $term_id, $taxonomy ) ) {
		$header['type'] = 'image';
		$header['image']['src'] = prima_get_tax_meta( "_prima_header_image_1", $term_id, $taxonomy );
		$header['image']['url'] = prima_get_tax_meta( "_prima_header_image_url_1", $term_id, $taxonomy );
		$header['image']['target'] = prima_get_tax_meta( "_prima_header_image_target_1", $term_id, $taxonomy );
		$header['nopadding'] = prima_get_tax_meta( "_prima_header_nopadding", $term_id, $taxonomy );
		$header['fullscreen'] = prima_get_tax_meta( "_prima_header_fullscreen", $term_id, $taxonomy );
	}
	return $header;
}

/**
 * Register featured slider shortcode.
 *
 * @since PrimaShop 1.1
 */ 
add_shortcode('prima_featured_slider', 'prima_featured_slider_shortcodes');
function prima_featured_slider_shortcodes($atts, $content=null, $code=""){
	global $wp_query, $prima_shortcodes_scripts;

	$header = array();
	$header['type'] = '';
	$header['image']['src'] = '';
	$header['image']['url'] = '';
	
	if ( function_exists( 'is_shop' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product_attribute() || is_product() ) ) {
		$prima_page_id = woocommerce_get_page_id( 'shop' );
		$header = prima_header_featured_from_page( $prima_page_id, $header, 'slider' );
	}
	if ( is_tax() || is_category() || is_tag() ) {
		$term = $wp_query->get_queried_object();
		$header = prima_header_featured_from_tax( $term->term_id, $term->taxonomy, $header, 'slider' );
	}
	if ( is_front_page() && get_option('show_on_front') == 'page' && get_option('page_on_front') > 0 ) {
		$prima_page_id = get_option('page_on_front');
		$header = prima_header_featured_from_page( $prima_page_id, $header, 'slider' );
	}
	elseif ( is_home() && get_option('show_on_front') == 'page' && get_option('page_for_posts') > 0 ) {
		$prima_page_id = get_option('page_for_posts');
		$header = prima_header_featured_from_page( $prima_page_id, $header, 'slider' );
	}
	elseif ( is_singular() ) {
		$prima_page_id = $wp_query->post->ID;
		$header = prima_header_featured_from_page( $prima_page_id, $header, 'slider' );
	}
	$output = '';
	if ( isset( $header['slider'] ) && count( $header['slider'] ) > 0 ) {
		$box_id = rand(1000, 9999);
		$output .= '<div id="slider-'.$box_id.'" class="flexslider ps-slider-overlay">';
		$output .= '<ul class="slides">';
		foreach ( $header['slider'] as $slider_src ) {
			$output .= '<li>';
			if ( $slider_src['url'] ) {
				$target = $slider_src['target'] ? 'target="_blank"' : '';
				$output .= '<a href="'.esc_url( $slider_src['url'] ).'" '.$target.'>';
				$output .= '<img src="'.esc_url( $slider_src['src'] ).'" alt="" />';
				$output .= '</a>';
			}
			else {
				$output .= '<img src="'.esc_url( $slider_src['src'] ).'" alt="" />';
			}
			if ( $slider_src['desc'] ) {
				$output .= '<div class="ps-slider-content">';
				$output .= esc_html( $slider_src['desc'] );
				$output .= '</div>';
			}
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div>';
		$prima_shortcodes_scripts .= 'jQuery(window).load(function() {';
		$prima_shortcodes_scripts .= 'jQuery("#slider-'.$box_id.'").flexslider({';
		$prima_shortcodes_scripts .= 'pauseOnHover: "true", ';
		$animation = $header['slider_animation'];
		if ( !$animation ) $animation = 'slide';
		$prima_shortcodes_scripts .= 'animation: "'.$animation.'", ';
		$slideshowspeed = $header['slider_slideshowspeed'];
		if ( is_numeric($slideshowspeed) )
			$prima_shortcodes_scripts .= 'slideshowSpeed: '.$slideshowspeed.', ';
		$animationspeed = $header['slider_animationspeed'];
		if ( is_numeric($animationspeed) )
			$prima_shortcodes_scripts .= 'animationSpeed: '.$animationspeed.', ';
		$directionnav = $header['slider_directionnav'];
		if ( $directionnav )
			$prima_shortcodes_scripts .= 'directionNav: false,';
		else
			$prima_shortcodes_scripts .= 'directionNav: true,';
		$controlnav = $header['slider_controlnav'];
		if ( $controlnav )
			$prima_shortcodes_scripts .= 'controlNav: false,';
		else
			$prima_shortcodes_scripts .= 'controlNav: true,';
		$prima_shortcodes_scripts .= 'slideshow: true';
		$prima_shortcodes_scripts .= '});';
		$prima_shortcodes_scripts .= '});';
		$prima_shortcodes_scripts .= "\n";
	}
	return $output;
}

/**
 * Output featured header template file.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_header', 'prima_header_featured_output', 30 );
function prima_header_featured_output() {
	get_template_part( 'prima-header-featured' );
}

/**
 * Output call-to-action template file.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_header', 'prima_header_action_output', 40 );
function prima_header_action_output() {
	if ( !prima_get_setting( 'calltoaction' ) ) 
		return;
	$page_id = prima_get_real_page_id();
	if ( prima_get_post_meta( "_prima_header_cta_hide", $page_id ) )
		return;
	get_template_part( 'prima-header-action' );
}

/**
 * Output footer widgets area template file.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_footer', 'prima_footer_widgets_output', 10 );
function prima_footer_widgets_output() {
	if( (int)prima_get_setting('footer_widgets') < 1 )
		return;
	$page_id = prima_get_real_page_id();
	if ( prima_get_post_meta( "_prima_footer_widgets_hide", $page_id ) )
		return;
	get_template_part( 'prima-footer-widgets' );
}

/**
 * Output footer content template file.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_footer', 'prima_footer_content_output', 20 );
function prima_footer_content_output() {
	$page_id = prima_get_real_page_id();
	if ( prima_get_post_meta( "_prima_footer_content_hide", $page_id ) )
		return;
	get_template_part( 'prima-footer-content' );
}

/**
 * Output footer query counter template file.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_after', 'prima_footer_query_output', 30 );
function prima_footer_query_output() {
	if ( prima_get_setting('footer_query') && current_user_can( 'edit_themes' ) )
		get_template_part( 'prima-footer-query' );
}

/**
 * Output left slidebar.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_after', 'prima_slidebar_left_output', 40 );
function prima_slidebar_left_output() {
	if ( has_nav_menu( 'header-menu' ) )
		get_template_part( 'prima-slidebar-left' );
}

/**
 * Output right slidebar.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_after', 'prima_slidebar_right_output', 40 );
function prima_slidebar_right_output() {
	if ( class_exists('woocommerce') )
		get_template_part( 'prima-slidebar-right' );
}

/**
 * Add simple custom script to remove "no-js" class when page is completely loaded.
 *
 * @since PrimaShop 1.0
 */
add_action('prima_custom_scripts', 'prima_scripts_remove_nojs');
function prima_scripts_remove_nojs() {
	echo 'jQuery(window).load(function() {';
	echo 'jQuery("body").removeClass("no-js")';
	echo '});';
	echo "\n";
}

/**
 * Filter function to count comment type only (trackback excluded).
 *
 * @since PrimaShop 1.0
 */
add_filter('get_comments_number', 'prima_comment_count', 0);
function prima_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$args = get_comments('status=approve&post_id=' . $id);
		
		$comments_by_type = separate_comments($args);
		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}

/**
 * Filter function for better search form output.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'get_search_form', 'prima_custom_search_form' );
function prima_custom_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div>
    <input type="text" value="'.__( 'Search...', 'primathemes' ).'" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr(__( 'Search', 'primathemes' )) .'" />
    </div>
    </form>';
    return $form;
}

/**
 * Change default excerpt words length.
 *
 * @since PrimaThemes 2.0
 */
add_filter( 'excerpt_length', 'prima_excerpt_length' );
function prima_excerpt_length( $length ) {
	return 70;
}

/**
 * Return continue reading link.
 *
 * @since PrimaThemes 2.0
 */
function prima_continue_reading_link() {
	return ' <a class="more-link" href="'. esc_url( get_permalink() ) . '">' . __( 'Read More &rarr;', 'primathemes' ) . '</a>';
}

/**
 * Add continue reading link to excerpt.
 *
 * @since PrimaThemes 2.0
 */
add_filter( 'get_the_excerpt', 'prima_custom_excerpt_more' );
function prima_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= prima_continue_reading_link();
	}
	return $output;
}

/**
 * Add continue reading link to auto excerpt.
 *
 * @since PrimaThemes 2.0
 */
add_filter( 'excerpt_more', 'prima_auto_excerpt_more' );
function prima_auto_excerpt_more( $more ) {
	return ' &hellip;' . prima_continue_reading_link();
}

/**
 * Add responsive logo to the header
 *
 * Backward compatilibility for everyone who has applied this feature on child theme
 *
 * @since PrimaShop 1.2
 */
if ( function_exists( 'prima_custom_responsive_logo' ) ) {
	remove_action( 'prima_header_left', 'prima_custom_responsive_logo', 5 );
	remove_filter( 'body_class', 'prima_custom_header_logo_class', 20 );
}
/* add responsive logo to header left area */
add_action( 'prima_header_left', 'prima_logo_responsive_output', 5 );
function prima_logo_responsive_output() {
	$logo = prima_get_setting( 'header_logo' );
	$width = prima_get_setting( 'header_logo_width' );
	if ( !$width ) $width = 200;
	if ( $logo ) {
		echo '<a href="'.home_url().'" class="header-logo"><img src="'.$logo.'" width="'.$width.'" alt=""/></a>';
	}
}
/* remove default header logo class */
add_filter( 'body_class', 'prima_logo_responsive_class', 20 );
function prima_logo_responsive_class( $classes ) {
	$classes = array_diff( $classes, array('header-logo-active') );
	$logo = prima_get_setting( 'header_logo' );
	if ($logo) $classes[] = 'header-logo-responsive';
	return $classes;
}

/**
 * Output footer script to the bottom of footer. High priority is used to make sure it is placed in the end of footer.
 *
 * @since PrimaShop 1.3.0
 */
add_action( 'wp_footer', 'prima_footer_script_code_output', 101 );
function prima_footer_script_code_output() {
	$script = prima_get_setting( 'footer_script_code' );
	if (!$script) return;
	echo $script;
}


/**
 * Enqueue socialite javascripts file.
 *
 * @since PrimaShop 1.2
 */
add_action( 'get_header', 'prima_socialite_script', 100);
function prima_socialite_script() {
	if ( 
		( is_singular( 'product' ) && prima_get_setting( 'socialite_product' ) ) || 
		( is_singular( 'post' ) && prima_get_setting( 'socialite_post' ) ) || 
		( is_page() && prima_get_setting( 'socialite_page' ) ) 
	) {
		wp_enqueue_script('socialite', PRIMA_URI.'/js/socialite.min.js', array('jquery'), PRIMA_THEME_VERSION, true);
	}
}

/**
 * Output socialite on the bottom of product summary.
 *
 * @since PrimaShop 1.2
 */
add_action( 'woocommerce_single_product_summary', 'prima_socialite_output', 50 ); 
function prima_socialite_output() {
	if ( is_singular( 'product' ) && prima_get_setting( 'socialite_product' ) ) {
		$size = prima_get_setting( 'socialite_size' ) ? prima_get_setting( 'socialite_size' ) : 'small';
		$locale = get_locale();
		$url = get_permalink();
		$title = get_the_title();
		$twitter_title = ( strlen( trim( $title ) ) > 110 ) ? substr( trim( $title ), 0, 107 )."..." : trim( $title );
		$twitter_id = prima_get_setting( 'socialite_twitter' ) ? ' data-via="'.prima_get_setting( 'socialite' ).'" ' : '';
		$output = array();
		for ($i = 1; $i <= 5; $i++) {
			if ( prima_get_setting( "socialite_button_{$i}" ) == 'twitter' ) {
				$output['twitter'] = '<li><a href="http://'.'twitter.com/share" class="socialite twitter-share" data-lang="'.$locale.'" '.$twitter_id.' data-text="'.$twitter_title.'" data-url="'.$url.'" data-count="'.( $size == 'small' ? 'horizontal' : 'vertical' ).'" rel="nofollow" target="_blank"><span class="vhidden">'.__( 'Share on Twitter', 'primathemes' ).'</span></a></li>';
			}
			elseif ( prima_get_setting( "socialite_button_{$i}" ) == 'google-plus' ) { 
				$output['google-plus'] = '<li><a href="https://'.'plus.google.com/share?url='.$url.'" class="socialite googleplus-one" data-size="'.( $size == 'small' ? 'medium' : 'tall' ).'" data-href="'.$url.'" rel="nofollow" target="_blank"><span class="vhidden">'.__( 'Share on Google+', 'primathemes' ).'</span></a></li>';
			}
			elseif ( prima_get_setting( "socialite_button_{$i}" ) == 'facebook' ) { 
				$output['facebook'] = '<li><a href="http://'.'www.facebook.com/sharer.php?u='.$url.'&amp;locale='.$locale.'&amp;t='.$title.'" class="socialite facebook-like" data-href="'.$url.'" data-send="false" data-layout="'.( $size == 'small' ? 'button_count' : 'box_count' ).'" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden">'.__( 'Share on Facebook', 'primathemes' ).'</span></a></li>';
			}
			elseif ( prima_get_setting( "socialite_button_{$i}" ) == 'pinterest' ) { 
				$image = prima_get_image( array( 'output' => 'url' ) );
				$output['pinterest'] = '<li><a href="http://'.'pinterest.com/pin/create/button/?url='.$url.'&amp;media='.$image.'&amp;description='.$title.'" class="socialite pinterest-pinit" data-count-layout="'.( $size == 'small' ? 'horizontal' : 'vertical' ).'"><span class="vhidden">'.__( 'Pin it!', 'primathemes' ).'</span></a></li>';
			}
			elseif ( prima_get_setting( "socialite_button_{$i}" ) == 'linkedin' ) { 
				$output['linkedin'] = '<li><a href="http://'.'www.linkedin.com/shareArticle?mini=true&amp;url='.$url.'&amp;title='.$title.'" class="socialite linkedin-share" data-url="'.$url.'" data-counter="'.( $size == 'small' ? 'right' : 'top' ).'" rel="nofollow" target="_blank"><span class="vhidden">'.__( 'Share on LinkedIn', 'primathemes' ).'</span></a></li>';
			}
		}
		if ( !empty( $output ) )
			echo '<ul class="social-buttons'.( $size == 'small' ? '-small' : '' ).' group">'.implode('', $output).'</ul>';
	}
}

/**
 * Output socialite on the bottom of post content.
 *
 * @since PrimaShop 1.2
 */
add_filter( 'the_content', 'prima_socialite_filter_output', 50 ); 
function prima_socialite_filter_output( $content ) {
	if ( 
		( is_singular( 'post' ) && prima_get_setting( 'socialite_post' ) ) || 
		( is_page() && prima_get_setting( 'socialite_page' ) ) 
	) {
		$size = prima_get_setting( 'socialite_size' ) ? prima_get_setting( 'socialite_size' ) : 'small';
		$locale = get_locale();
		$url = get_permalink();
		$title = get_the_title();
		$twitter_title = ( strlen( trim( $title ) ) > 110 ) ? substr( trim( $title ), 0, 107 )."..." : trim( $title );
		$twitter_id = prima_get_setting( 'socialite_twitter' ) ? ' data-via="'.prima_get_setting( 'socialite' ).'" ' : '';
		$output = array();
		for ($i = 1; $i <= 5; $i++) {
			if ( prima_get_setting( "socialite_button_{$i}" ) == 'twitter' ) {
				$output['twitter'] = '<li><a href="http://'.'twitter.com/share" class="socialite twitter-share" data-lang="'.$locale.'" '.$twitter_id.' data-text="'.$twitter_title.'" data-url="'.$url.'" data-count="'.( $size == 'small' ? 'horizontal' : 'vertical' ).'" rel="nofollow" target="_blank"><span class="vhidden">'.__( 'Share on Twitter', 'primathemes' ).'</span></a></li>';
			}
			elseif ( prima_get_setting( "socialite_button_{$i}" ) == 'google-plus' ) { 
				$output['google-plus'] = '<li><a href="https://'.'plus.google.com/share?url='.$url.'" class="socialite googleplus-one" data-size="'.( $size == 'small' ? 'medium' : 'tall' ).'" data-href="'.$url.'" rel="nofollow" target="_blank"><span class="vhidden">'.__( 'Share on Google+', 'primathemes' ).'</span></a></li>';
			}
			elseif ( prima_get_setting( "socialite_button_{$i}" ) == 'facebook' ) { 
				$output['facebook'] = '<li><a href="http://'.'www.facebook.com/sharer.php?u='.$url.'&amp;locale='.$locale.'&amp;t='.$title.'" class="socialite facebook-like" data-href="'.$url.'" data-send="false" data-layout="'.( $size == 'small' ? 'button_count' : 'box_count' ).'" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden">'.__( 'Share on Facebook', 'primathemes' ).'</span></a></li>';
			}
			elseif ( prima_get_setting( "socialite_button_{$i}" ) == 'pinterest' ) { 
				$image = prima_get_image( array( 'output' => 'url' ) );
				$output['pinterest'] = '<li><a href="http://'.'pinterest.com/pin/create/button/?url='.$url.'&amp;media='.$image.'&amp;description='.$title.'" class="socialite pinterest-pinit" data-count-layout="'.( $size == 'small' ? 'horizontal' : 'vertical' ).'"><span class="vhidden">'.__( 'Pin it!', 'primathemes' ).'</span></a></li>';
			}
			elseif ( prima_get_setting( "socialite_button_{$i}" ) == 'linkedin' ) { 
				$output['linkedin'] = '<li><a href="http://'.'www.linkedin.com/shareArticle?mini=true&amp;url='.$url.'&amp;title='.$title.'" class="socialite linkedin-share" data-url="'.$url.'" data-counter="'.( $size == 'small' ? 'right' : 'top' ).'" rel="nofollow" target="_blank"><span class="vhidden">'.__( 'Share on LinkedIn', 'primathemes' ).'</span></a></li>';
			}
		}
		if ( !empty( $output ) )
			$content .= '<ul class="social-buttons'.( $size == 'small' ? '-small' : '' ).' group">'.implode('', $output).'</ul>';
	}
	return $content;
}

/**
 * Custom Background Callback
 */
function prima_custom_background_cb() {
	// $background is the saved custom image, or the default image.
	$background = set_url_scheme( get_background_image() );

	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_background_color();

	if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
		$color = false;
	}

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat_css = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position_css = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment_css = " background-attachment: $attachment;";

		$style .= $image . $repeat_css . $position_css . $attachment_css;
	}
?>
<style type="text/css" id="custom-background-css">
body.custom-background { <?php echo trim( $style ); ?> }
</style>
<?php
}
