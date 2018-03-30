<?php
/**
 * Action functions
 *
 * Inject content through template hooks
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_404_bg' ) ) {
	/**
	 * Output 404 page background CSS in head
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_404_bg() {

		if ( is_404() && wolf_get_theme_option( '404_bg' ) ) {
			?>
			<style type="text/css">
				.error404 #page-content{
					background-image: url(<?php echo esc_url( wolf_get_url_from_attachment_id( wolf_get_theme_option( '404_bg' ), 'extra-large' ) ); ?>);
				}
			</style>
			<?php
		}
	}
	add_action( 'wp_head', 'wolf_404_bg' );
}

if ( ! function_exists( 'wolf_scroll_arrow' ) ) {
	/**
	 * Output scroll arrow
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_scroll_arrow() {
		if ( ! is_404() )
		?>
		<div id="top"></div><a id="top-arrow" class="scroll" href="#top"></a>
		<?php
	}
	add_action( 'wolf_body_start', 'wolf_scroll_arrow' );
}

if ( ! function_exists( 'wolf_page_loader' ) ) {
	/**
	 * Output loader overlay
	 *
  	 * @access public
  	 * @since 1.0.0
	 * @return void
	 */
	function wolf_page_loader() {

		if ( wolf_get_theme_option( 'page_transition' ) ) :
			$loader = wolf_get_theme_option( 'loader_type' );
		?>
		<div id="loading-overlay"><div id="loader">
			<?php if ( wolf_get_theme_option( 'loading_logo' ) ) : ?>
				<img id="loading-logo" src="<?php echo esc_url( wolf_get_url_from_attachment_id( wolf_get_theme_option( 'loading_logo' ), 'logo' ) ); ?>" alt="loading-logo">
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'loader' ) ) : ?>
				<?php if ( 'loader1' == $loader ) : ?>
					<div class="loader1"></div>
				<?php elseif ( 'loader2' == $loader ) : ?>
					<div class="loader2">
						<div class="loader2-double-bounce1"></div>
						<div class="loader2-double-bounce2"></div>
					</div>
				<?php elseif ( 'loader3' == $loader ) : ?>
					<div class="loader3">
						<div class="loader3-rect1"></div>
						<div class="loader3-rect2"></div>
						<div class="loader3-rect3"></div>
						<div class="loader3-rect4"></div>
						<div class="loader3-rect5"></div>
					</div>
				<?php elseif ( 'loader4' == $loader ) : ?>
					<div class="loader4">
						<div class="loader4-cube1"></div>
						<div class="loader4-cube2"></div>
					</div>
				<?php elseif ( 'loader5' == $loader ) : ?>
					<div class="loader5"></div>
				<?php elseif ( 'loader6' == $loader ) : ?>
					<div class="loader6">
						<div class="loader6-dot1"></div>
						<div class="loader6-dot2"></div>
					</div>
				<?php elseif ( 'loader7' == $loader ) : ?>
					<div class="loader7">
						<div class="loader7-bounce1"></div>
						<div class="loader7-bounce2"></div>
						<div class="loader7-bounce3"></div>
					</div>
				<?php elseif ( 'loader8' == $loader ) : ?>
					<div class="loader8">
						<div class="loader8-container loader8-container1">
							<div class="loader8-circle1"></div>
							<div class="loader8-circle2"></div>
							<div class="loader8-circle3"></div>
							<div class="loader8-circle4"></div>
						</div>
						<div class="loader8-container loader8-container2">
							<div class="loader8-circle1"></div>
							<div class="loader8-circle2"></div>
							<div class="loader8-circle3"></div>
							<div class="loader8-circle4"></div>
						</div>
						<div class="loader8-container loader8-container3">
							<div class="loader8-circle1"></div>
							<div class="loader8-circle2"></div>
							<div class="loader8-circle3"></div>
							<div class="loader8-circle4"></div>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			</div></div>
		<?php
		endif;
	}
	add_action( 'wolf_body_start', 'wolf_page_loader' );
}

if ( ! function_exists( 'wolf_top_search_form' ) ) {
	/**
	 * Output search form
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_top_search_form() {

		if ( wolf_get_theme_option( 'search_menu_item' ) ) {
			echo '<div id="top-search-form-container"><div id="top-search-form">';
				get_search_form();
			echo '</div></div>';
		}

	}
	add_action( 'wolf_body_start', 'wolf_top_search_form' );
}

if ( ! function_exists( 'wolf_output_message_bar' ) ) {
	/**
	 * Output message bar plugin function
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_output_message_bar() {

		if ( function_exists( 'wolf_message_bar' ) )
			wolf_message_bar();
	}
	add_action( 'wolf_body_start', 'wolf_output_message_bar' );
}

if ( ! function_exists( 'wolf_output_top_bar' ) ) {
	/**
	 * Output message bar plugin function
	 *
  	 * @access public
  	 * @since 1.0.0
	 * @return void
	 */
	function wolf_output_top_bar() {
		if ( wolf_get_theme_option( 'top_bar' ) && 'left' != wolf_get_theme_option( 'menu_position' )  ) {
			get_template_part( 'partials/top', 'bar' );
		}
	}
	add_action( 'wolf_body_start', 'wolf_output_top_bar' );
}

if ( ! function_exists( 'wolf_main_menu' ) ) {
	/**
	 * Output main menu
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_main_menu() {
		if ( 'default' == wolf_get_theme_option( 'menu_position' ) || 'center' == wolf_get_theme_option( 'menu_position' ) ) {
			echo '<div id="ceiling">';
			get_template_part( 'partials/navigation/navigation', 'desktop' );
			echo '</div>';
		}
	}
	add_action( 'wolf_body_start', 'wolf_main_menu' );
}

if ( ! function_exists( 'wolf_main_menu_logo_centered' ) ) {
	/**
	 * Output main menu
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_main_menu_logo_centered() {
		if ( 'logo-centered' == wolf_get_theme_option( 'menu_position' ) ) {
			echo '<div id="ceiling">';
			get_template_part( 'partials/navigation/navigation', 'logo-centered' );
			echo '</div>';
		}
	}
	add_action( 'wolf_body_start', 'wolf_main_menu_logo_centered' );
}

if ( ! function_exists( 'wolf_left_main_menu' ) ) {
	/**
	 * Output main menu
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_left_main_menu() {
		if ( 'left' == wolf_get_theme_option( 'menu_position' ) )
			get_template_part( 'partials/navigation/navigation', 'left' );
	}
	add_action( 'wolf_site_content_start', 'wolf_left_main_menu' );
}

if ( ! function_exists( 'wolf_output_mobile_hello_bar' ) ) {
	/**
	 * Output mobile hello bar
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_output_mobile_hello_bar() {

		if ( 'modern' != wolf_get_theme_option( 'menu_position' ) ) :
		?>
		<div id="mobile-bar" class="clearfix">
			<div id="mobile-bar-inner">
				<div id="menu-toggle" class="menu-toggle">
					<div class="burger-before"></div>
					<div class="burger"></div>
					<div class="burger-after"></div>
				</div>
				<?php echo wolf_logo(); ?>
			</div>
		</div>
		<?php
		endif;

	}
	add_action( 'wolf_body_start', 'wolf_output_mobile_hello_bar' );
}

if ( ! function_exists( 'wolf_output_side_menu_toggle' ) ) {
	/**
	 * Output Secondary Menu toggle
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_output_side_menu_toggle() {
		$menus = array( 'default', 'center', 'logo-centered' );
		if ( wolf_get_theme_option( 'additional_toggle_menu' ) && in_array( wolf_get_theme_option( 'menu_position' ), $menus ) ) : ?>
			<div id="side-menu-toggle"  class="toggle-add-menu"><div class="plus"></div></div>
		<?php
		endif;
	}
	add_action( 'wolf_body_start', 'wolf_output_side_menu_toggle' );
}

if ( ! function_exists( 'wolf_additional_menu' ) ) {
	/**
	 * Output secondary menu
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_additional_menu() {
		if ( wolf_get_theme_option( 'additional_toggle_menu' ) && ( 'default' == wolf_get_theme_option( 'menu_position' ) || 'center' == wolf_get_theme_option( 'menu_position' ) || 'logo-centered' == wolf_get_theme_option( 'menu_position' ) ) ) {
			if ( 'side' == wolf_get_theme_option( 'additional_toggle_menu_type' ) )
				get_template_part( 'partials/navigation/navigation', 'side-panel' );

			if ( 'overlay' == wolf_get_theme_option( 'additional_toggle_menu_type' ) )
				get_template_part( 'partials/navigation/navigation', 'overlay' );
		}
	}
	add_action( 'wolf_body_start', 'wolf_additional_menu' );
}

if ( ! function_exists( 'wolf_mobile_menu' ) ) {
	/**
	 * Output mobile menu
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_mobile_menu() {
		if ( 'modern' != wolf_get_theme_option( 'menu_position' ) )
			get_template_part( 'partials/navigation/navigation', 'mobile' );
	}
	add_action( 'wolf_body_start', 'wolf_mobile_menu' );
}

if ( ! function_exists( 'wolf_modern_menu_toggle' ) ) {
	/**
	 * Output modern menu
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_modern_menu_toggle() {
		if ( 'modern' == wolf_get_theme_option( 'menu_position' ) ) {
			?>
			<div id="menu-toggle-modern" class="menu-toggle">
				<div class="burger-before"></div>
				<div class="burger"></div>
				<div class="burger-after"></div>
			</div>
			<?php
		}
	}
	add_action( 'wolf_body_start', 'wolf_modern_menu_toggle' );
}

if ( ! function_exists( 'wolf_modern_menu_overlay' ) ) {
	/**
	 * Output modern menu overlay
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_modern_menu_overlay() {
		if ( 'modern' == wolf_get_theme_option( 'menu_position' ) ) {
			?>
			<div id="modern-menu-overlay"></div>
			<?php
		}
	}
	add_action( 'wolf_body_start', 'wolf_modern_menu_overlay' );
}

if ( ! function_exists( 'wolf_modern_menu' ) ) {
	/**
	 * Output modern menu
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_modern_menu() {
		if ( 'modern' == wolf_get_theme_option( 'menu_position' ) )
			get_template_part( 'partials/navigation/navigation', 'modern' );
	}
	add_action( 'wolf_body_start', 'wolf_modern_menu' );
}

if ( ! function_exists( 'wolf_cart_menu_item' ) ) {
	/**
	 * Add a cart menu item
	 *
	 * @access public
	 * @since 1.0.0
	 * @param
	 * @return void
	 */
	function wolf_cart_menu_item ( $items, $args ) {

		if ( class_exists( 'WooCommerce' ) && function_exists( 'wc_get_page_id' ) ) {

			$cart_url = get_permalink( wc_get_page_id( 'cart' ) );

			$woo_item = '<li class="cart-menu-item">';
			$woo_item .= "<a class='cart-menu-item-link' href='$cart_url'>";

			$woo_item .= '<span class="product-count">' . WC()->cart->cart_contents_count . '</span>';

			$woo_item .= '<span class="cart-text">' . __( 'Cart', 'wolf' ) . '</span>';

			$woo_item .= '</a>';

				$woo_item .= '<span class="cart-menu-panel">';
					$woo_item .= "<a href='$cart_url'>";
						$woo_item .= '<span class="icon-cart"></span>';

$woo_item .= '<span class="panel-product-count">';
$woo_item .= sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'wolf' ), WC()->cart->cart_contents_count );
$woo_item .= '</span></br>'; // count

			$woo_item .= '<span class="panel-total">';
			$woo_item .= __( 'Total', 'wolf' ) . ' ' .  WC()->cart->get_cart_total();
			$woo_item .= '</span>'; // total

			//' . __( 'Total', 'wolf' ) . ' ' . $total . '
						$woo_item .= '</a>';
				$woo_item .= '</span>';
			$woo_item .= '</li>';

			// var_dump( $woocommerce->cart );
			if ( ( $args->theme_location == 'primary' || $args->theme_location == 'primary-right' ) && wolf_get_theme_option( 'cart_menu_item' ) ) {
				$items .= $woo_item;
			}
		}

		return $items;
	}
	add_filter( 'wp_nav_menu_items', 'wolf_cart_menu_item', 10, 2 );
}

if ( ! function_exists( 'wolf_main_menu_socials' ) ) {
	/**
	 * Output social icons in main menu
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_main_menu_socials( $items, $args ) {

		$services = wolf_get_theme_option( 'menu_socials_services' );
		$socials_item = '';
		if ( $services ) {
			$socials_item = '<li class="socials-menu-item">';
			$socials_item .= wolf_theme_socials( $services, '1x', 'span' );
			$socials_item .= '</li>';
		}

		if ( 'default' == wolf_get_theme_option(  'menu_position' ) || 'logo-centered' == wolf_get_theme_option( 'menu_position' ) ) {
			if ( $args->theme_location == 'primary' || $args->theme_location == 'primary-right' ) {
				$items .= $socials_item;
			}
		}
		return $items;
	}
	add_filter( 'wp_nav_menu_items', 'wolf_main_menu_socials', 10, 2 );
}

if ( ! function_exists( 'wolf_search_menu_item' ) ) {
	/**
	 * Add a search menu item
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_search_menu_item( $items, $args ) {

		$search_item = '<li class="search-menu-item">
			<a class="search-menu-item-link" href="#">
			<span class="search-text">' . __( 'Search', 'wolf' ) . '</span></a></li>';

		if ( ( $args->theme_location == 'primary' || $args->theme_location == 'primary-right' ) && wolf_get_theme_option( 'search_menu_item' ) ) {
			$items .= $search_item;
		}
		return $items;
	}
	add_filter( 'wp_nav_menu_items', 'wolf_search_menu_item', 10, 2 );
}

if ( ! function_exists( 'wolf_toggle_menu_item' ) ) {
	/**
	 * Add a toggle menu item
	 */
	function wolf_toggle_menu_item ( $items, $args ) {

		$menus = array( 'default', 'center', 'logo-centered' );
		$toggle_text = wolf_get_theme_option( 'toggle_side_menu_item_text' );
		$toggle_item = '<li class="toggle-menu-item"><a class="toggle-menu-item-link toggle-add-menu" href="#">';
		if ( $toggle_text )
			$toggle_item .= '<span class="toggle-text">' . $toggle_text . '</span>';
		$toggle_item .= '</a></li>';

		if (
			( $args->theme_location == 'primary' || $args->theme_location == 'primary-right' )
			&& wolf_get_theme_option( 'additional_toggle_menu' )
			&& in_array( wolf_get_theme_option( 'menu_position' ), $menus )
		) {
			$items .= $toggle_item;
		}
		return $items;
	}
	add_filter( 'wp_nav_menu_items', 'wolf_toggle_menu_item', 10, 2 );
}

if ( ! function_exists( 'wolf_header_overlay' ) ) {
	/**
	 * Output home header
	 */
	function wolf_header_overlay() {
		if ( ! wolf_is_slider_in_home_header() && 'wolf_slider' != wolf_get_theme_option( 'home_header_type' ) ) :
		?>
		<div class="header-overlay"></div>
		<?php endif;
	}
	add_action( 'wolf_header_start', 'wolf_header_overlay' );
}

if ( ! function_exists( 'wolf_home_header' ) ) {
	/**
	 * Output home header
	 */
	function wolf_home_header() {

		if (
			is_front_page() && ! is_paged()
			|| is_page_template( 'page-templates/home.php' )
			&& 'none' != wolf_get_theme_option( 'home_header_type' )
		)
			get_template_part( 'partials/header', 'home' );
	}
	add_action( 'wolf_header_start', 'wolf_home_header' );
}

if ( ! function_exists( 'wolf_header_gallery_slideshow' ) ) {
	/**
	 * Output header gallery slideshow
	 */
	function wolf_header_gallery_slideshow() {

		if ( is_single() && 'gallery' == get_post_format() ) {
			get_template_part( 'partials/slider', 'header-gallery' );
		}
	}
	add_action( 'wolf_header_start', 'wolf_header_gallery_slideshow' );
}

if ( ! function_exists( 'wolf_scroll_down_arrow' ) ) {
	/**
	 * Output scroll down arrow
	 */
	function wolf_scroll_down_arrow() {

		if ( wolf_get_theme_option( 'scroll_down_arrow' ) ) {
			?>
			<a id="scroll-down" class="scroll" href="#main"></a>
			<?php
		}
	}
	add_action( 'wolf_header_end', 'wolf_scroll_down_arrow' );
}

if ( ! function_exists( 'wolf_share_links' ) ) {
	/**
	 * Share links below single posts
	 *
	 * @param bool $display
	 * @return string
	 */
	function wolf_share_links() {

		$post_type = get_post_type();
		if ( wolf_get_theme_option( $post_type . '_share' ) ) { // is theme option checked
			get_template_part( 'partials/share', 'post' );
		}
	}
	add_action( 'wolf_post_end_singular', 'wolf_share_links' );
}

if ( ! function_exists( 'wolf_author_meta' ) ) {
	/**
	 * Output author bio box
	 */
	function wolf_author_meta() {

		if (
			wolf_get_theme_option( 'show_author_box' )
			&& 'post' == get_post_type() || 'review' == get_post_type()
		) {
			get_template_part( 'partials/author', 'bio' );
		}
	}
	add_action( 'wolf_post_end_singular', 'wolf_author_meta' );
}

if ( ! function_exists( 'wolf_display_author_info_in_author_archive' ) ) {
	/**
	 * Display the author info at the top of the author archive pages
	 */
	function wolf_display_author_info_in_author_archive() {

		if ( is_author() && wolf_get_theme_option( 'show_author_box' ) )
			get_template_part( 'partials/author', 'bio' );

	}
	add_action( 'wolf_page_before', 'wolf_display_author_info_in_author_archive' );
}

if ( ! function_exists( 'wolf_output_music_network' ) ) {
	/**
	 * Output music network icons
	 */
	function wolf_output_music_network() {

		if ( function_exists( 'wolf_music_network' ) ) {
			if ( wolf_is_music_network() ) {
				echo '<div class="music-social-icons-container">';
				wolf_music_network();
				echo '</div>';
			}
		}

	}
	add_action( 'wolf_footer_before', 'wolf_output_music_network' );
}

if ( ! function_exists( 'wolf_bottom_menu' ) ) {
	/**
	 * Output bottom menu
	 */
	function wolf_bottom_menu() {
		if ( has_nav_menu( 'tertiary' ) ) {
		?>
			<nav id="site-navigation-tertiary" class="wrap navigation tertiary-navigation" role="navigation">
				<?php wp_nav_menu(
					array(
						'theme_location' => 'tertiary',
						'menu_class' => 'nav-menu-tertiary inline-list',
						'fallback_cb'  => '',
						'depth'           => 1,
					)
				); ?>
			</nav><!-- #site-navigation-tertiary-->
		<?php
		}
	}
	add_action( 'wolf_footer_end', 'wolf_bottom_menu' );
}

if ( ! function_exists( 'wolf_bottom_socials' ) ) {
	/**
	 * Output social icons
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_bottom_socials() {

		if ( wolf_get_theme_option( 'bottom_socials' ) ) {
			$services = wolf_get_theme_option( 'bottom_socials_services' );

			echo wolf_theme_socials( $services, '1x' );
		}
	}
	add_action( 'wolf_footer_end', 'wolf_bottom_socials' );
}

if ( ! function_exists( 'wolf_output_pagination' ) ) {
	/**
	 * Output pagination on blog page
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_output_pagination() {

		if ( wolf_is_blog() ) {

			get_template_part( 'partials/pagination' );
		}
	}
	add_action( 'wolf_page_after', 'wolf_output_pagination' );
}

if ( ! function_exists( 'wolf_print_post_navigation' ) ) {
	/**
	 * Output related post or post nav depending on metabox
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_print_post_navigation() {

		$nav_type = wolf_get_single_blog_post_nav_type();
		$post_types = array( 'post' );

		if ( in_array( get_post_type(), $post_types ) ) {

			if ( 'related' == $nav_type ) {
				get_template_part( 'partials/related', 'posts' );
			} else {
				wolf_post_nav();
			}
		}
	}
	add_action( 'wolf_post_end', 'wolf_print_post_navigation' );
}
