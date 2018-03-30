<?php
/**
 * Decibel single post custom style
 *
 * @package WordPress
 * @subpackage Decibel
 * @since Decibel 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'wolf_get_header_post_id' ) ) {
	/**
	 * Get the post id to use to display a header
	 * For example, if a header is set for the blog, we will use it for the archive and search page
	 *
	 * @return int $id
	 */
	function wolf_get_header_post_id() {

		if ( is_404() || is_page_template( 'page-templates/home.php' ) )
			return;

		$post_id = null;
		$shop_page_id = wolf_get_woocommerce_shop_page_id();
		$is_shop_page = function_exists( 'is_shop' ) ? is_shop() : false;
		$is_product_taxonomy = function_exists( 'is_product_taxonomy' ) ? is_product_taxonomy() : false;
		$is_single_product = function_exists( 'is_product' ) ? is_product() : false;

		// is blog
		if ( get_option( 'page_for_posts' ) && wolf_is_blog() && false == $is_shop_page && false == $is_product_taxonomy ) {

			$post_id = get_option( 'page_for_posts' );

		// if woocommerce
		} elseif ( $is_shop_page || $is_product_taxonomy ) {

			$post_id = $shop_page_id;

		// is single product
		} elseif ( $is_single_product ) {

			if ( get_post_meta( get_the_ID(), '_header_bg_img', true ) || get_post_meta( get_the_ID(),'_header_bg_color', true ) ) {
				$post_id = get_the_ID();
			} else {
				$post_id = $shop_page_id;
			}

		} else {

			$post_id = get_the_ID();
		}

		return $post_id;
	}
}

if ( ! function_exists( 'wolf_post_meta_get_background_css' ) ) {
	/**
	 * Get background CSS
	 *
	 * @param string $selector
	 * @param string $meta_name
	 */
	function wolf_post_meta_get_background_css( $selector, $meta_name ) {

		$css = '';

		if ( wolf_get_header_post_id() && ! is_search() ) {

			$post_id 		= wolf_get_header_post_id();
			$url       		= null;
			$attachment_id 	= get_post_meta( $post_id, $meta_name . '_img', true );
			$color      		= get_post_meta( $post_id, $meta_name . '_color', true );
			$repeat     		= get_post_meta( $post_id, $meta_name . '_repeat', true );
			$position   		= get_post_meta( $post_id, $meta_name . '_position', true );
			$attachment 		= get_post_meta( $post_id, $meta_name . '_attachment', true );
			$size       		= get_post_meta( $post_id, $meta_name . '_size', true );

			$overlay_opacity 	= get_post_meta( $post_id, '_header_overlay_opacity', true );
			$overlay_img        	= get_post_meta( $post_id, '_header_overlay_img', true );
			$overlay_pattern 	= ( $overlay_img ) ? esc_url( wolf_get_url_from_attachment_id( $overlay_img ) ) : '';
			$overlay_color      	= get_post_meta( $post_id, '_header_overlay_color', true );

			if ( wolf_get_category_meta( 'header_bg_img' ) || wolf_get_category_meta( 'header_bg_color' ) ) {
				$attachment_id 	= wolf_get_category_meta( 'header_bg_img' );
				$color      		= wolf_get_category_meta( 'header_bg_color' );
				$repeat     		= wolf_get_category_meta( 'header_bg_repeat' );
				$position   		= wolf_get_category_meta( 'header_bg_position' );
				$attachment 		= wolf_get_category_meta( 'header_bg_attachment' );
				$size       		= wolf_get_category_meta( 'header_bg_size' );
			}

			/* do overlay */
			if (
				( wolf_get_category_meta( 'header_bg_img' ) && 'image' == wolf_get_category_meta( 'header_bg_type' ) )
				|| ( wolf_get_category_meta( 'header_video_bg_mp4' ) && 'video' == wolf_get_category_meta( 'header_bg_type' ) )
			) {
				$overlay_opacity 	= wolf_get_category_meta( 'header_overlay_opacity' );
				$overlay_img        	= wolf_get_category_meta( 'header_overlay_img' );
				$overlay_pattern 	= ( $overlay_img ) ? esc_url( wolf_get_url_from_attachment_id( $overlay_img ) ) : '';
				$overlay_color      	= wolf_get_category_meta( 'header_overlay_color' );
			}

			if ( $attachment_id )
				$url = 'url("'. wolf_get_url_from_attachment_id( $attachment_id, 'extra-large' ) .'")';

			if ( $color || $attachment_id ) {

				$css .= "$selector {background : $color $position $repeat $attachment}";

				if ( $attachment_id ) {
					$css .= "$selector {background-image:$url;}";
				}

				if ( $size == 'cover' ) {

					$css .= "$selector {
						-webkit-background-size: 100%;
						-o-background-size: 100%;
						-moz-background-size: 100%;
						background-size: 100%;
						-webkit-background-size: cover;
						-o-background-size: cover;
						background-size: cover;
					}";
				}

				if ( $size == 'resize' ) {

					$css .= "$selector {
						-webkit-background-size: 100%;
						-o-background-size: 100%;
						-moz-background-size: 100%;
						background-size: 100%;
					}";
				}
			}

			if ( $overlay_color ) {
				$css .= ".has-header-image .header-overlay{background-color:$overlay_color;}";
			}

			if ( $overlay_pattern ) {
				$css .= ".has-header-image .header-overlay{background-image:url($overlay_pattern);}";
			}

			if ( 0 < $overlay_opacity ) {
				$css .= '.has-header-image .header-overlay{opacity:' . $overlay_opacity / 100 . '}';
			}

			if ( 'dark' == get_post_meta( $post_id, '_header_font_color', true ) ) {

				$css .= "
					.menu-transparent.has-header-image.show-title-area #navbar-container .nav-menu li a,
					.menu-semi-transparent.has-header-image.show-title-area #navbar-container .nav-menu li a{
						color: #333;
					}

					.menu-transparent.has-header-image.show-title-area #navbar-container .nav-menu li a:hover,
					.menu-semi-transparent.has-header-image.show-title-area #navbar-container .nav-menu li a:hover{
						color: #0d0d0d;
					}

					.menu-transparent.has-header-image.show-title-area .logo-light,
					.menu-semi-transparent.has-header-image.show-title-area .logo-light{
						opacity:0;
					}

					.menu-transparent.has-header-image.show-title-area .logo-dark,
					.menu-semi-transparent.has-header-image.show-title-area .logo-dark{
						opacity:1;
					}

					.menu-border.menu-transparent #navbar-container,
					.menu-border.menu-semi-transparent #navbar-container{
						border-bottom: 1px solid rgba(0,0,0,.1);
					}

					.has-header-image .page-header-container .breadcrumb,
					.has-header-image .page-header-container .breadcrumb a,
					.has-header-image .page-header-container .page-title-container h1,
					.has-header-image .page-header-container .page-title-container .subheading{
						color: #333;
					}

				";

				if ( ! wolf_get_theme_option( 'sub_menu_bg_color' ) ) {
					$css .= "
						.menu-hover-border-top.menu-transparent.has-header-image .nav-menu li:hover a,
						.menu-hover-border-top.menu-semi-transparent.has-header-image .nav-menu li:hover a,
						.menu-hover-border-top.menu-transparent.has-header-image .nav-menu li.current-menu-item > a:first-child,
						.menu-hover-border-top.menu-transparent.has-header-image .nav-menu li.current-menu-ancestor > a:first-child,
						.menu-hover-border-top.menu-semi-transparent.has-header-image .nav-menu li.current-menu-item > a:first-child,
						.menu-hover-border-top.menu-semi-transparent.has-header-image .nav-menu li.current-menu-ancestor > a:first-child {
							-webkit-box-shadow: inset 0px 3px 0px 0px #0d0d0d;
							box-shadow: inset 0px 3px 0px 0px #0d0d0d;
						}
					";
				}
			}

			if ( get_post_meta( $post_id, '_hide_featured_image', true ) ) {
				$css .= ".entry-thumbnail{display:none;}";
			}

			$custom_css = get_post_meta( $post_id, '_custom_css', true );
			if ( $custom_css ) {
				$css .= $custom_css;
			}
		}

		if ( $css )
			return '/* Post Style */' . "\n" . wolf_compact_css( $css );
	}
}

if ( ! function_exists( 'wolf_output_post_header_css' ) ) {
	/**
	 * Output the post CSS
	 */
	function wolf_output_post_header_css() {
		echo '<style type="text/css">';
	    	echo wolf_post_meta_get_background_css( '.page-header-container', '_header_bg' );
	    	echo '</style>';
	}
	add_action( 'wp_head', 'wolf_output_post_header_css' );
}

if ( ! function_exists( 'wolf_output_title' ) ) {
	/**
	 * Display Page Title
	 */
	function wolf_output_title() {

		$post_id = wolf_get_header_post_id();

		$hide_title_area = ( 'none' == wolf_get_theme_option( 'page_header_type' ) );

		if ( get_post_meta( $post_id, '_page_header_type', true ) ) {
			$hide_title_area = ( 'none' == get_post_meta( $post_id, '_page_header_type', true ) );
		}

		if (
			$post_id
			&& wolf_get_page_title()
			&& ! $hide_title_area
			&& ! is_front_page()
			&& ! is_page_template( 'page-templates/home.php' )
		) {

			$type = ( get_post_meta( $post_id, '_header_bg_type', true ) ) ? get_post_meta( $post_id, '_header_bg_type', true ) : 'image';

			$video_mp4 = get_post_meta( $post_id, '_header_video_bg_mp4', true );
			$video_webm = get_post_meta( $post_id, '_header_video_bg_webm', true );
			$video_ogv = get_post_meta( $post_id, '_header_video_bg_ogv', true );
			$video_img = get_post_meta( $post_id, '_header_video_bg_img', true );
			$video_opacity = absint( get_post_meta( $post_id, '_header_video_bg_opacity', true ) ) / 100;
			$video_bg_type = ( get_post_meta( $post_id, '_header_video_bg_type', true ) ) ? get_post_meta( $post_id, '_header_video_bg_type', true ) : 'selfhosted';
			$video_youtube_url = get_post_meta( $post_id, '_header_video_bg_youtube_url', true );

			$image_id = get_post_meta( $post_id, '_header_bg_img', true );
			$header_effect = get_post_meta( $post_id, '_header_bg_effect', true );
			$do_parallax = 'parallax' == $header_effect;
			$full_screen = 'full' == get_post_meta( $post_id, '_page_header_type', true );

			if ( wolf_get_category_meta( 'header_bg_img' ) && 'image' == wolf_get_category_meta( 'header_bg_type' ) ) {
				$type = 'image';
				$image_id = wolf_get_category_meta( 'header_bg_img' );
				$header_effect = wolf_get_category_meta( 'header_bg_effect' );
				$do_parallax = 'parallax' == $header_effect;
				$full_screen = 'full' == wolf_get_category_meta( 'page_header_type' );
			}

			if ( 'video' == wolf_get_category_meta( 'header_bg_type' ) ) {
				$type = 'video';
				$video_mp4 = wolf_get_category_meta( 'header_video_bg_mp4' );
				$video_webm = wolf_get_category_meta( 'header_video_bg_webm' );
				$video_ogv = wolf_get_category_meta( 'header_video_bg_ogv' );
				$video_opacity = absint( wolf_get_category_meta( 'header_video_bg_opacity' ) ) / 100;
				$video_img = wolf_get_category_meta( 'header_video_bg_img' );
				$video_bg_type = wolf_get_category_meta( 'header_video_bg_type' );
				$video_youtube_url = wolf_get_category_meta( 'header_video_bg_youtube_url' );
			}

			$class = 'page-header-container';

			$_image = esc_url( wolf_get_url_from_attachment_id( $image_id, 'extra-large' ) );

			if ( $do_parallax && $image_id ) {
				$class .= ' section-parallax';
			}

			if ( $full_screen ) {
				$class .= ' full-height';
			}

			echo '<section class="' . esc_attr( $class ) . '">';

			if ( 'video' == $type && ! is_search() ) {
				?>
				<div class="video-container">
					<?php
					if ( $video_mp4 && 'selfhosted' == $video_bg_type ) {
						echo wolf_video_bg( $video_mp4, $video_webm, $video_ogv, $video_img );
					}
					
					elseif( $video_youtube_url && 'youtube' == $video_bg_type ) {
						// debug(  $video_img );
						echo wolf_youtube_video_bg( $video_youtube_url, $video_img );
					}
					?>
				</div>
				<?php
			}

			if (
				'zoomin' == $header_effect
				&& $image_id
				&& 'image' == $type
				&& ! is_search()
			) {
				echo '<div class="bg"><img src="' . $_image . '"></div>';
			}

			$page_header_type = wolf_get_theme_option( 'page_header_type' );

			if ( get_post_meta( $post_id, '_page_header_type', true ) ) {
				$page_header_type = get_post_meta( $post_id, '_page_header_type', true );
				$page_header_type = ( 'full' == $page_header_type ) ? 'big' : $page_header_type;
			}

			if ( wolf_get_category_meta( 'page_header_type' ) ) {
				$page_header_type = wolf_get_category_meta( 'page_header_type' );
			}

			echo '<div class="page-header text-center">';

			if ( 'small' == $page_header_type ) {

				if ( ! get_post_meta( $post_id, '_header_hide_title', true ) ) {

					echo '<div class="wrap intro">';
						echo '<div class="breadcrumb">';
						echo wolf_breadcrumb();
						echo '</div>';

						echo '<div class="page-title-container">';
						echo wolf_get_page_title();
						echo '</div>';
					echo '</div>';
				}

			} else {
				if ( ! get_post_meta( $post_id, '_header_hide_title', true ) ) {

					echo '<div class="page-title-container intro">';
					echo wolf_get_page_title();
						if ( is_singular( 'post' ) ) {
							echo '<div class="entry-meta">';
							wolf_post_entry_meta();
							echo '</div>';
						}
					echo '</div>';
				}
			}

			echo '</div><!--.page-header --></section>';
		}
	}
	add_action( 'wolf_header_end', 'wolf_output_title' );
}
