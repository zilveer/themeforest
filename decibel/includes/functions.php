<?php
/**
 * Theme specific functions
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_inject_vc_params' ) ) {
	/**
	 * Inject some params in vc map params index
	 *
	 * @access public
	 * @since 1.0.0
	 * @param array $new_params
	 * @param array $params
	 * @return  array $params
	 */
	function wolf_inject_vc_params( $new_params, $params ) {

		foreach ( $new_params as $k => $param ) {
			array_push( $params['params'], $param );
		}

		return $params;
	}
}


if ( ! function_exists( 'wolf_get_slider_loop_ids' ) ) {
	/**
	 * Get the ids of the posts featured in the home slider
	 *
	 * @access public
	 * @return array $ids
	 */
	function wolf_get_slider_loop_ids() {

		$ids  = array();
		$args = array(
			'post_type' => array( 'post', 'page', 'gallery', 'release', 'video', 'show', 'product', 'plugin', 'work' ),
			'posts_per_page' => -1,
			'ignore_sticky_posts' => 1,
			'meta_query' => array(
				'relation' => 'AND',
					array(
						'key' => '_thumbnail_id',
						'compare' => '!=',
						'value' => '',
					),
					array(
						'key' => '_featured_post',
						'compare' => '=',
						'value' => 'on',
					),
			),
		);

		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) {
				$loop->the_post();
				$ids[] = get_the_ID();
			}
		}

		return $ids;
	}
}

if ( ! function_exists( 'wolf_get_slide_loop' ) ) {
	/**
	 * Get featured post loop
	 *
	 * @access public
	 * @return object $loop
	 */
	function wolf_get_slide_loop() {

		$args = array(
			'post_type' => array( 'post', 'page', 'gallery', 'release', 'video', 'show', 'product', 'plugin', 'work' ),
			'posts_per_page' => -1,
			'ignore_sticky_posts' => 1,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => '_thumbnail_id',
					'compare' => '!=',
					'value' => ''
				),
				array(
					'key' => '_featured_post',
					'compare' => '=',
					'value' => 'on'
				),
			),
		);

		$loop = new WP_Query( $args );

		return $loop;
	}
}

if ( ! function_exists( 'wolf_logo' ) ) {
	/**
	 * Output the Logo
	 *
	 * @access public
	 * @return string
	 */
	function wolf_logo() {

		$logo_dark_id = wolf_get_theme_option( 'logo_dark' );
		$logo_light_id = wolf_get_theme_option( 'logo_light' );
		$logo_sticky_id = wolf_get_theme_option( 'logo_sticky' );

		if ( $logo_dark_id || $logo_light_id ) {
			$logo_dark = wolf_get_url_from_attachment_id( $logo_dark_id, 'full' );
			$logo_light = wolf_get_url_from_attachment_id( $logo_light_id, 'full' );
			$logo_sticky = wolf_get_url_from_attachment_id( $logo_sticky_id, 'full' );
			$output = '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';

			if ( $logo_dark_id )
				$output .= '<img class="logo-dark" src="' . $logo_dark . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';

			if ( $logo_light_id )
				$output .= '<img class="logo-light" src="' . $logo_light . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';

			//if ( $logo_sticky_id )
				//$output .= '<img id="logo-sticky" src="' . $logo_sticky . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';

			//elseif( $logo_dark_id )
				//$output .= '<img id="logo-sticky" src="' . $logo_dark . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';

			$output .= '</a></div>';
			echo wp_kses( $output, array(
				'a' => array(
					'href' => array(),
					'title' => array(),
					'rel' => array(),
				),
				'img' => array(
					'src' => array(),
					'class' => array(),
					'alt' => array(),
				),
				'div' => array(
					'class' => array(),
				),
			) );
		}
	}
}

if ( ! function_exists( 'wolf_excerpt_length' ) ) {
	/**
	 * Excerpt length hook
	 * Set the number of character to display in the excerpt
	 *
	 * @access public
	 * @param int $length
	 * @return int
	 */
	function wolf_excerpt_length( $length ) {

		$length = 30;

		if ( wolf_is_blog() && 'masonry' == wolf_get_theme_option( 'blog_type' ) ) {

			$length = 18;
		}

		return $length;
	}
	add_filter( 'excerpt_length', 'wolf_excerpt_length' );
}

if ( ! function_exists( 'wolf_more_text' ) ) {
	/**
	 * Excerpt more
	 * Render "Read more" link text differenttly depending on post format
	 * the_content( wolf_more_text() )
	 *
	 * @access public
	 * @return string
	 */
	function wolf_more_text() {
		global $post;

		$format    = null;
		$text      = __( 'Continue reading &rarr;', 'wolf' );
		$format    = get_post_format();
		$post_type = get_post_type();

		if ( 'video' == $format || 'video' == $post_type ) {

			$text = __( 'More about this video &rarr;', 'wolf' );

		} elseif ( 'gallery' == $format || 'image' == $format || 'gallery' == $post_type ) {

			$text = __( 'View more &rarr;', 'wolf' );

		} elseif ( 'audio' == $format || 'release' == $post_type || 'show' == $post_type ) {

			$text = __( 'More info &rarr;', 'wolf' );

		} else {
			$text = __( 'Continue reading &rarr;', 'wolf' );
		}

		return $text;
	}
}

if ( ! function_exists( 'wolf_excerpt_more' ) ) {
	/**
	 * Excerpt "more" link
	 *
	 * @access public
	 * @param string $more
	 * @return string
	 */
	function wolf_excerpt_more( $more ) {

		$more =  '...<p><a rel="bookmark" class="more-link wolf-button border-button-accent-hover" href="'. get_permalink() . '">' . wolf_more_text() . '</a></p>';

		if ( is_search() )
			$more = '...';

		return $more;
	}
	add_filter( 'excerpt_more', 'wolf_excerpt_more' );
}

if ( ! function_exists( 'wolf_add_more_link_class' ) ) {
	/**
	 * Add custom class to the more link
	 *
	 * @access public
	 * @param string $link
	 * @param string $text
	 */
	function wolf_add_more_link_class( $link, $text ) {

		$size = 'medium';

		if ( wolf_is_blog() && 'masonry' == wolf_get_theme_option( 'blog_type' ) ) {
			$size = 'small';
		}

		return str_replace(
			'more-link',
			"more-link wolf-button $size border-button-accent-hover",
			$link
		);
	}
	add_action( 'the_content_more_link', 'wolf_add_more_link_class', 10, 2 );
}

if ( ! function_exists( 'wolf_add_author_socials' ) ) {
	/**
	 * Add social networks to author profile
	 *
	 * @access public
	 * @param array $contactmethods
	 * @return array $contactmethods
	 */
	function wolf_add_author_socials( $contactmethods ) {
		global $team_member_socials;
		$contactmethods = array();
		foreach ( $team_member_socials as $social ) {
			$contactmethods[ $social ] = $social ;
		}
		return $contactmethods;
	}
	add_filter( 'user_contactmethods', 'wolf_add_author_socials',10,1 );
}

if ( ! function_exists( 'wolf_display_author_socials' ) ) {
	/**
	 * Display social networks in author bio box
	 *
	 * @access public
	 * @return string
	 */
	function wolf_display_author_socials() {
		global $team_member_socials;
		$website = get_the_author_meta( 'user_url' );
		$name = get_the_author_meta( 'user_nicename' );

		if ( $website ) {
			echo '<a target="_blank" title="' . sprintf( __( 'Visit %s website', 'wolf' ), $name ) . '" href="'. $website .'" class="author-link">' . __( 'website', 'wolf' ) . '</a>';
		}

		foreach ( $team_member_socials as $social ) {
			$url = get_the_author_meta( $social );
			$social_name = ( 'google' == $social ) ? $social . '+' : $social;
			if ( get_the_author_meta( $social ) ) {
				echo '<a target="_blank" title="' . sprintf( __( 'Find %1$s on %2$s', 'wolf' ), $name, $social_name ) . '" href="'. esc_url( $url ) .'" class="author-link">' . $social_name . '</a>';
			}
		}
	}
}

if ( ! function_exists( 'wolf_top_tags' ) ) {
	/**
	 * Get the most used tags
	 *
	 * @access public
	 * @return int
	 */
	function wolf_top_tags( $text = '', $nb = 10 ) {
		$tags = get_tags();

		$list = '';

		if ( empty( $tags ) )
			return;

		$counts = $tag_links = array();

		foreach ( (array) $tags as $tag ) {
			$counts[$tag->name] = $tag->count;
			$tag_links[$tag->name] = get_tag_link( $tag->term_id );
		}
		asort( $counts );
		$counts = array_reverse( $counts, true );
		$i = -1;
		foreach ( $counts as $tag => $count ) {
			$i++;
			$tag_link = esc_url( $tag_links[$tag] );

			$tag = str_replace( ' ', '&nbsp;', esc_html( $tag ) );

			if ( $i < $nb ) {
				$list .= "<a href=\"$tag_link\">$tag</a>, ";
			}
		}

		return '<div class="most-used-tags">' . $text . substr( $list, 0, -2 ) . '</div>';
	}
}

if ( ! function_exists( 'wolf_posts_link_next_title' ) ) {
	/**
	 * Add title attribute to next link post navigation
	 *
	 * @access public
	 * @return string
	 */
	function wolf_posts_link_next_title() {
		return 'title="' . __( 'Older', 'wolf' ) . '"';
	}
	add_filter( 'next_posts_link_attributes', 'wolf_posts_link_next_title' );
}

if ( ! function_exists( 'wolf_posts_link_prev_title' ) ) {
	/**
	 * Add title attribute to previous link post navigation
	 *
	 * @access public
	 * @return string
	 */
	function wolf_posts_link_prev_title() {
		return 'title="' . __( 'Newer', 'wolf' ) . '"';
	}
	add_filter( 'previous_posts_link_attributes', 'wolf_posts_link_prev_title' );
}

if ( ! function_exists( 'wolf_get_page_title' ) ) {
	/**
	 * Returns page title outside the loop
	 *
	 * @access public
	 * @return string
	 */
	function wolf_get_page_title() {

		global $post, $wp_query;
		$title = null;
		$desc = null;
		$output = null;
		$subheading = null;

		if ( have_posts() ) {

			/* Main condition not 404 and not woocommerce page */
			if ( ! is_404() && ! wolf_is_woocommerce() ) {

				$subheading = get_post_meta( get_the_ID(), '_subheading', true );

				if ( is_category() ) {

					$subheading = '';
					$title   = single_cat_title( '', false );
					$desc = category_description();

				} elseif ( is_tag() ) {

					$title   = single_tag_title( '', false );
					$desc = category_description();

				} elseif ( is_author() ) {

					the_post();
					$title = get_the_author();
					rewind_posts();

				} elseif ( is_day() ) {

					get_the_date();

				} elseif ( is_month() ) {

					$title = get_the_date( 'F Y' );

				} elseif ( is_year() ) {

					$title = get_the_date( 'Y' );

				} elseif ( is_tax() ) {

					$subheading = '';
					$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
					if ( $the_tax && is_object( $wp_query ) && isset( $wp_query->queried_object ) && isset( $wp_query->queried_object->name ) ) {

						$title  = $wp_query->queried_object->name;
						$desc = category_description();
					}

				} elseif ( is_search() ) {

					$title = sprintf( __( 'Search Results for: %s', 'wolf' ), get_search_query() );

				} elseif ( is_single() ) {

					$format = get_post_format();
					$title = get_the_title();

					/* is blog index */
				} elseif (
					is_object( $wp_query ) && isset( $wp_query->queried_object ) && isset( $wp_query->queried_object->ID )
					&& $wp_query->queried_object->ID == get_option( 'page_for_posts' )
				) {
					$title  = $wp_query->queried_object->post_title;
					$desc = wolf_get_theme_option( 'blog_tagline' ); // blog tagline from theme options
					$subheading = get_post_meta( $wp_query->queried_object->ID, '_subheading', true );

				} elseif ( is_object( $wp_query ) && isset( $wp_query->queried_object ) && isset( $wp_query->queried_object->ID )  ) {

					$title = $wp_query->queried_object->post_title;
					$subheading = get_post_meta( $wp_query->queried_object->ID, '_subheading', true );
				}

			} elseif ( wolf_is_woocommerce() ) { // shop title

				if ( is_woocommerce() ) {
					$title = woocommerce_page_title( false );
					$subheading = get_post_meta( wolf_get_woocommerce_shop_page_id(), '_subheading', true );
				}
			}
		} // end have posts

		$max_font_size = ( wolf_get_theme_option( 'page_title_font_size', 32 ) ) ? wolf_get_theme_option( 'page_title_font_size', 32 ) : 32;

		if ( $title )
			$output .= "<h1 class='page-title fittext' data-max-font-size='$max_font_size'>$title</h1>";

		if ( $desc )
			$output .= "<div class='category-description'>$desc</div>";



		if ( $subheading ) {
			$output .= "<div class='subheading'>$subheading</div>";
		}

		return $output;
	}
}

if ( ! function_exists( 'wolf_custom_widget_menu' ) ) {
	/**
	 * Add the icon options to menu widget
	 *
	 * @access public
	 * @param array $args
	 * @return
	 */
	function wolf_custom_widget_menu( $args ) {
		return array_merge(
			$args,
			array(
				'walker' => new Wolf_Custom_Fields_Nav_Walker(),
			)
		);
	}
	add_filter( 'wp_nav_menu_args', 'wolf_custom_widget_menu' );
}

if ( ! function_exists( 'wolf_remove_vc_teaser_metabox' ) ) {
	/**
	 * Remove the Visual Composer teaser metabox
	 *
	 * @access public
	 * @return void
	 */
	function wolf_remove_vc_teaser_metabox() {

		$post_types = array( 'page', 'post', 'work', 'video', 'gallery', 'release', 'show', 'slide', 'plugin', 'theme', 'demo' );
		foreach ( $post_types as $post_type ) {
			remove_meta_box( 'vc_teaser' , $post_type, 'side' );
		}

	}
	add_action( 'do_meta_boxes', 'wolf_remove_vc_teaser_metabox' );
}

if ( ! function_exists( 'all_rev_sliders_in_array' ) ) {
	/**
	 * Get the rev slider list
	 *
	 * @access public
	 * @see http://themeforest.net/forums/thread/add-rev-slider-to-theme-please-authors-reply/97711
	 * @return array $result
	 */
	function all_rev_sliders_in_array() {

		if ( class_exists( 'RevSlider' ) ) {
			$theslider     = new RevSlider();
			$arrSliders = $theslider->getArrSliders();
			$arrA     = array();
			$arrT     = array();
			foreach($arrSliders as $slider){
			$arrA[]     = $slider->getAlias();
			$arrT[]     = $slider->getTitle();
		}

		if ( $arrA && $arrT ) {
			$result = array_combine($arrA, $arrT);
		} else {
			$result = array( '' => __( 'No slider yet', 'wolf' ) );
		}
			return $result;
		}
	}
}

if ( ! function_exists( 'wolf_get_image_size' ) ) {
	/**
	 * Get square image size, fallback if the original image isn't big enough
	 *
	 * @access public
	 * @return string
	 */
	function wolf_get_image_size( $thumb_size ) {

		$thumb_size = ( $thumb_size ) ? $thumb_size : '2x2';

		if ( 'classic-thumb' == $thumb_size ) {

			if ( ! wolf_has_high_res_thumbnail( $thumb_size, 640 ) ) {
				$thumb_size = 'classic-video-thumb';
			}

		} elseif ( 'square' == $thumb_size || '2x2' == $thumb_size ) {
			$thumb_size = '2x2';
			if ( ! wolf_has_high_res_thumbnail( $thumb_size, 960, 960 ) ) {
				$thumb_size = '1x1';
			}
		}

		return $thumb_size;
	}
}

if ( ! function_exists( 'wolf_get_blog_layout' ) ) {
	/**
	 * Get blog layout
	 *
	 * @return string $blog_type
	 */
	function wolf_get_blog_layout() {

		$blog_type = ( wolf_get_theme_option( 'blog_type' ) ) ? wolf_get_theme_option( 'blog_type' ) : 'sidebar';

		if ( is_category() ) {

			$cat_id = get_query_var( 'cat' );
			$cat_meta = get_option( "_wolf_post_category_meta_$cat_id" );
			if ( $cat_meta ) {
				if ( isset( $cat_meta['blog_layout'] ) && '' != $cat_meta['blog_layout'] ) {
					$blog_type = $cat_meta['blog_layout'];
				}
			}
		}

		return $blog_type;
	}
}

if ( ! function_exists( 'wolf_get_single_blog_post_layout' ) ) {
	/**
	 * Get blog layout single blog post layout
	 *
	 * @return string $layout
	 */
	function wolf_get_single_blog_post_layout() {

		$layout_meta = wolf_get_theme_option( 'single_blog_post_layout' );

		$category = get_the_category();

		if ( isset( $category[0] ) && isset( $category[0]->cat_ID ) ) {
			$cat_id = $category[0]->cat_ID;
			$cat_meta = get_option( "_wolf_post_category_meta_$cat_id" );
			if ( $cat_meta ) {
				if ( isset( $cat_meta['single_blog_post_layout'] ) ) {
					$layout_meta = $cat_meta['single_blog_post_layout'];
				}
			}
		}

		if ( get_post_meta( get_the_ID(), '_layout', true ) ) {
			$layout_meta = get_post_meta( get_the_ID(), '_layout', true );
		}

		$layout = ( $layout_meta ) ? $layout_meta : 'standard';

		return $layout;
	}
}

if ( ! function_exists( 'wolf_get_single_blog_post_nav_type' ) ) {
	/**
	 * Get blog layout single blog post layout
	 *
	 * @return string $layout
	 */
	function wolf_get_single_blog_post_nav_type() {

		$nav_type_meta = wolf_get_theme_option( 'post_nav_type' );

		$category = get_the_category();

		if ( isset( $category[0] ) && isset( $category[0]->cat_ID ) ) {
			$cat_id = $category[0]->cat_ID;
			$cat_meta = get_option( "_wolf_post_category_meta_$cat_id" );
			if ( $cat_meta ) {
				if ( isset( $cat_meta['post_nav_type'] ) ) {
					$nav_type_meta = $cat_meta['post_nav_type'];
				}
			}
		}

		if ( get_post_meta( get_the_ID(), '_post_nav_type', true ) ) {
			$nav_type_meta = get_post_meta( get_the_ID(), '_post_nav_type', true );
		}

		$nav_type = ( $nav_type_meta ) ? $nav_type_meta : 'standard';

		return $nav_type;
	}
}

/*================================================
 The functions below are not used
 I wanted to force the pagination to 12 when grid blog layout is ued
 Better let the user choose the number of posts per page manually
 I also wanted to force 12 posts per page when there are sticky post
 but with no success
 =================================================*/

if ( ! function_exists( 'wolf_limit_posts_on_blog_grid' ) ) {
	/**
	 * Set 12 post on blog grid
	 *
	 * @access public
	 * @return int
	 */
	function wolf_limit_posts_on_blog_grid( $posts_per_page ) {

		if ( 'grid' == wolf_get_theme_option( 'blog_type' ) && wolf_is_blog() )
			$posts_per_page = 12;

		return $posts_per_page;
	}
	// add_filter( 'pre_option_posts_per_page', 'wolf_limit_posts_on_blog_grid' );
}

if ( ! function_exists( 'wolf_fix_posts_per_page_with_sticky_posts' ) ) {
	/**
	 * If I we any sticky posts, the query will display more than the 12 posts we have specified in the function above
	 *
	 * We will fix this with a pre_get_posts hook
	 *
	 * @see http://wordpress.stackexchange.com/questions/76620/sticky-posts-exceed-posts-per-page-limit
	 * @access public
	 * @return void
	 */
	function wolf_fix_posts_per_page_with_sticky_posts( $query ) {

		if ( $query->is_main_query() && 'grid' == wolf_get_theme_option( 'blog_type' ) && wolf_is_blog() ) {

			// set the number of posts per page
			$posts_per_page = 12;

			// get sticky posts array
			$sticky_posts = get_option( 'sticky_posts' );

			// get queried post ids array
			$ids = array();
			$args = array(
				'post_type' => 'post',
				'post_per_page' => $posts_per_page,
				'paged' => 1
			);

			$posts = get_posts( $args );

			foreach ( $posts as $post ) {
				$ids[] = $post->ID;
			}

			// if we have any sticky posts and we are at the first page
			if ( is_array( $sticky_posts ) && ! $query->is_paged() ) {

				// count the number of sticky posts
				$sticky_count = count( $sticky_posts );

				foreach ( $sticky_posts as $sticky_post ) {
					if ( in_array( $sticky_post, $ids ) ) {

						$sticky_count--;
					}
				}

				if ( $sticky_count < $posts_per_page ) {
					$query->set( 'posts_per_page', $posts_per_page - $sticky_count );

				} else {
					$query->set( 'posts_per_page', 1 );
				}

			} else {
				$query->set( 'posts_per_page', $posts_per_page );
			}
		}
	}
	// add_action( 'pre_get_posts', 'wolf_fix_posts_per_page_with_sticky_posts'  );
}
