<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package omni
 */

if ( ! function_exists( 'crum_posts_navigation' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @param string $query_name Query for pagination.
	 *
	 * @return void
	 */
	function crum_posts_navigation( $query_name = 'wp_query' ) {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS[ $query_name ]->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="paginator" role="navigation">
			<h2 class="screen-reader-text hidden"><?php esc_html_e( 'Posts navigation', 'omni' ); ?></h2>

				<?php
				global $wp_query;
				global ${$query_name};
				global $allowedposttags;
				$big = 999999999;

				if ( isset( $query_name ) && ! ( 'wp_query' === $query_name ) ) {
					$the_query = ${$query_name};
				} else {
					$the_query = $wp_query;
				}

				echo wp_kses(paginate_links( array(
					'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'    => '?paged=%#%',
					'type'      => 'list',
					'mid_size'  => '2',
					'current'   => max( 1, get_query_var( 'paged' ) ),
					'total'     => $the_query->max_num_pages,
					'prev_text' => '',
					'next_text' => '',
				)),$allowedposttags );
				?>


			<div>
				<?php if ( get_previous_posts_link() ) :
					echo '<a href="' . esc_url( previous_posts( false ) ) . '" class="arrow-button previous-link"><span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span> ' . esc_html__( 'Prev Page', 'omni' ) . '</a>';
				endif; if ( get_next_posts_link('', $the_query->max_num_pages) ) :
					echo '<a href="' . esc_url( next_posts(  $the_query->max_num_pages, false ) ) . '" class="arrow-button">' . esc_html__( 'Next Page', 'omni' ) . '<span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span></a>';
				endif; ?>
			</div>
			<div class="clear"></div>
			<!-- .nav-links -->
		</nav><!-- .navigation -->
	<?php
	}
endif;

if ( ! function_exists( 'crum_post_navigation' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 * @return void
	 */
	function crum_post_navigation() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>

		<nav class="navigation post-navigation" role="navigation">
			<h2 class="screen-reader-text hide"><?php esc_html_e( 'Post navigation', 'omni' ); ?></h2>
			<ul class="pager">
				<?php
				previous_post_link( '<li class="previous">%link</li>', '%title' );
				next_post_link( '<li class="next">%link</li>', '%title' );
				?>
			</ul>
			<!-- .pager -->
		</nav><!-- .navigation -->
	<?php
	}
endif;

if ( ! function_exists( 'omni_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @param array $args Function settings array.
	 */
	function omni_posted_on( $args = array() ) {

		global $allowedtags;

		$defaults = array(
			'post_id'         => get_the_ID(),
			'show_author'     => false,
			'show_categories' => false,
			'show_date'       => false,
			'show_comments'   => false,
			'avatar_size'     => 100,
		);

		$args = wp_parse_args( $args, $defaults );

		$post_id         = $args['post_id'];
		$show_author     = $args['show_author'];
		$show_categories = $args['show_categories'];
		$show_date       = $args['show_date'];
		$show_comments   = $args['show_comments'];
		$avatar_size     = $args['avatar_size'];

		$time_string = '<span aria-hidden="true" class="glyphicon glyphicon-calendar"></span><time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c', $post_id ) ),
			esc_html( get_the_date( '', $post_id ) )
		);

		$author_id = get_post_field( 'post_author', $args['post_id'] );
		$author_info = get_userdata($author_id);
		if(!(false === $author_info)){
			$author_display_name = $author_info->display_name;
		}else{
			$author_display_name = esc_html__('Anonymous','omni');
		}

		$posted_on = '<span class="block"> ' . $time_string . ' </span>';

		$avatar = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="author-thumbnail">' . get_avatar( $author_id, $avatar_size ) . '</a>';
		$byline = esc_html__( 'by', 'omni' );
		$byline .= ' <span class="author vcard"><a class="url fn n name" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . $author_display_name . '</a></span> ';

		$category = ' ' . get_the_category_list( ', ' );

		if ( true === $show_author ) {
			echo '<div class="author-entry">';
			echo $avatar; // WPCS: XSS OK.
			echo '<div class="author-text">';
			echo $byline; // WPCS: XSS OK.
		}
		if ( true === $show_categories ) {
			esc_html_e( 'for', 'omni' );
			echo $category; // WPCS: XSS OK.
		}

		if ( true === $show_date ) {
			echo $posted_on; // WPCS: XSS OK.
		}

		if ( true === $show_comments && ! post_password_required( $post_id ) && ( comments_open( $post_id ) || get_comments_number( $post_id ) ) ) {
			echo '<span class="block comments-link"><span aria-hidden="true" class="glyphicon glyphicon-comment"></span> ';
			comments_popup_link( esc_html__( 'Leave a comment', 'omni' ), wp_kses( __( '<span class="category">1</span> Comment', 'omni' ), $allowedtags ), wp_kses( __( '<span class="category">%</span> Comments', 'omni' ), $allowedtags ) );
			echo '</span>';
		}

		if ( true === $show_author ) {
			echo '</div>';
			echo '</div>';
		}
	}
endif;

if ( ! function_exists( 'omni_post_text' ) ) {
	/**
	 * Trim excerpt length.
	 *
	 * @param int $post_id         Id of post.
	 * @param int $excerpt_length Length of excerpt.
	 *
	 * @return string
	 */
	function omni_post_text( $post_id, $excerpt_length = 20 ) {

		$post_excerpt = get_post_field( 'post_excerpt', $post_id );
		if ( isset( $post_excerpt ) && ! ( empty( $post_excerpt ) ) ) {
			$post_content = $post_excerpt;
		} else {
			$post_content = strip_tags( get_post_field( 'post_content', $post_id ) );
		}

		$post_content = strip_shortcodes( $post_content );

		$post_text = wp_trim_words( $post_content, $excerpt_length );

		return wpautop($post_text);

	}
}

if ( ! function_exists( 'omni_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function omni_entry_footer() {
		// Hide category and tag text for pages.
		if ( is_single() ) {
			edit_post_link( esc_html__( 'Edit', 'omni' ) );
		}
	}
endif;


if ( ! function_exists( 'crumina_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param string $size Size of image thumbnail.
	 *
	 * @return string|void
	 */
	function crumina_post_thumbnail( $size = 'full' ) {
		if ( post_password_required() || is_attachment() ) {
			return false;
		}

		if ( is_singular() ) :

			$thumbnail = get_the_post_thumbnail( get_the_ID(), $size , array( 'alt' => get_the_title() ) );

		else :

			$thumbnail = '<a href="'. get_permalink().'" aria-hidden="true">';

			$thumbnail .= get_the_post_thumbnail( get_the_ID(), $size , array( 'alt' => get_the_title() ) );

			$thumbnail .= '</a>';

		endif; // End is_singular().

		return $thumbnail;
	}

endif;


if ( ! ( function_exists( 'crumina_post_gallery' ) ) ) {
	/**
	 * Display an gallery instead post thumbnail.
	 *
	 * @param string $size         Size of image thumbnail.
	 *
	 * @param bool   $blog_style   Blog Display Variant.
	 *
	 * @return bool
	 * @since Omni 1.0
	 */
	function crumina_post_gallery( $size = 'full', $blog_style = false ) {
		global $post;
		$post_meta = get_post_meta( get_the_ID(), 'post-format-gallery-feature', true );

		if ( isset( $post_meta['post_gallery_feature'] ) && ! empty( $post_meta['post_gallery_feature'] ) ) {
			$gallery        = $post_meta['post_gallery_feature'];
			$gallery_images = explode( ',', $gallery );
		} elseif ( has_shortcode( $post->post_content, 'gallery' ) ) {
			// Retrieve the first gallery in the post.
			$gallery_images = get_post_gallery_images( $post );
		} else {
			return false;
		}

		$feature_output = '<div class="swiper-container horizontal-pagination" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">';
		$feature_output .= '<div class="swiper-wrapper">';
		if ( isset( $gallery_images ) && is_array( $gallery_images ) ) {
			foreach ( $gallery_images as $galley_image ) {

				$gallery_thumb = wp_get_attachment_image( $galley_image, $size );

				$feature_output .= '<div class="swiper-slide">';

				$feature_output .= $gallery_thumb;

				$feature_output .= '</div>';
			}
		}
		$feature_output .= '</div>'; // Close wrapper.

		if ( 'full' === $blog_style ) {
			$feature_output .= '<div class="pagination" style="display: none;"></div>';
			$feature_output .= '<div class="thumbnails"><div class="row">';
			if ( isset( $gallery_images ) && is_array( $gallery_images ) ) {

				foreach ( $gallery_images as $key => $value ) {
					if ( 0 === $key ) {
						$active_class = 'active';
					} else {
						$active_class = '';
					}
					$feature_output .= '<div class="col-xs-4 col-sm-2 entry '.$active_class.'">'.wp_get_attachment_image( $value, 'thumbnail' ).'</div>';
				}
			}
			$feature_output .= '</div></div>';
		} else {
			$feature_output .= '<div class="pagination"></div>';
			$feature_output .= '<div class="swiper-arrow left default-arrow"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></div>
			<div class="swiper-arrow right default-arrow"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></div>';
		}

		$feature_output .= '</div>';

		return $feature_output;

	}
}


if ( ! ( function_exists( 'crumina_post_video' ) ) ) {
	/**
	 * Display video in blog list.
	 *
	 * @param string $size Size of image thumbnail.
	 *
	 * @return string
	 * @since Omni 1.0
	 */
	function crumina_post_video( $size = 'full' ) {
		$thumb = $feature_output = '';

		if ( has_post_thumbnail() ) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
		}

		$post_meta = get_post_meta( get_the_ID(), 'post-format-video-feature', true );

		if ( isset( $post_meta['post_video_feature'] ) && ! empty( $post_meta['post_video_feature'] ) ) {

			$feature_output = apply_filters( 'the_content', $post_meta['post_video_feature'] );

		} elseif ( isset( $post_meta['post_video_feature_mp4'] ) && ! empty( $post_meta['post_video_feature_mp4'] ) && isset( $post_meta['post_video_feature_mp4_webm'] ) && ! empty( $post_meta['post_video_feature_mp4_webm'] ) ) {

			$feature_output = do_shortcode( '[video src="' . esc_url( $post_meta['post_video_feature_mp4_webm'] ) . '"  webm="' . esc_url( $post_meta['post_video_feature_mp4_webm'] ) . '" poster="' . esc_url( $thumb ) . '"]' );

		} elseif ( isset( $post_meta['post_video_feature_mp4'] ) && ! empty( $post_meta['post_video_feature_mp4'] ) ) {

			$feature_output = do_shortcode( '[video src="' . esc_url( $post_meta['post_video_feature_mp4_webm'] ) . '" poster="' . esc_url( $thumb ) . '"]' );

		} elseif ( isset( $post_meta['post_video_feature_mp4_webm'] ) && ! empty( $post_meta['post_video_feature_mp4_webm'] ) ) {

			$feature_output = do_shortcode( '[video src="' . esc_url( $post_meta['post_video_feature_mp4_webm'] ) . '" poster="' . esc_url( $thumb ) . '"]' );

		} elseif ( ! empty( $thumb ) ) {

			$feature_output = crumina_post_thumbnail( $size );

		}

		return $feature_output; // WPCS: XSS OK.
	}
}


if ( ! ( function_exists( 'crumina_post_audio' ) ) ) {
	/**
	 * Display audio meta in blog.
	 *
	 * @return string
	 * @since Omni 1.0
	 */
	function crumina_post_audio() {
		$post_meta = get_post_meta( get_the_ID(), 'post-format-audio-feature', true );
		if ( isset( $post_meta['post_audio_feature'] ) && ! empty( $post_meta['post_audio_feature'] ) ) {
			$feature_output = apply_filters( 'the_content', esc_url( $post_meta['post_audio_feature'] ) );
		} elseif ( isset( $post_meta['post_audio_feature_self_hosted'] ) && ! empty( $post_meta['post_audio_feature_self_hosted'] ) ) {
			$feature_output = do_shortcode( '[audio src="' . esc_url( $post_meta['post_audio_feature_self_hosted'] ) . '"]' );
		} else {
			$feature_output = '';
		}

		return $feature_output; // WPCS: XSS OK.
	}
}


if ( ! ( function_exists( 'crumina_post_image' ) ) ) {
	/**
	 * Display image with zoom in post list.
	 *
	 * @return string | bool
	 * @since Omni 1.0
	 */
	function crumina_post_image() {

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return false;
		}
		$feature_output = '<a href="'. get_permalink() .'" aria-hidden="true">';

		$feature_output .= get_the_post_thumbnail( get_the_ID(),'full', array( 'alt' => get_the_title() ) );

		$feature_output .= '</a>';

		return $feature_output; // WPCS: XSS OK.
	}
}


if ( ! ( function_exists( 'crumina_post_quote' ) ) ) {
	/**
	 * Display quote in post list.
	 *
	 * @return string | bool
	 * @since Omni 1.0
	 */
	function crumina_post_quote() {

		$post_meta = get_post_meta( get_the_ID(), 'post-format-quote-feature', true );

		$feature_output = $author_output = $desc_output = '';

		if(isset($post_meta['post_quote_text']) && !empty($post_meta['post_quote_text'])){

			$feature_output .= '<blockquote>';

            $feature_output .= '<span class="blockquote-icon">&ldquo;';
            $feature_output .= '</span>';

			$feature_output .= '<p>'.wpautop($post_meta['post_quote_text']).'</p>';

			if(isset($post_meta['post_quote_author']) && !empty($post_meta['post_quote_author'])){
				$author_output = '<cite>'.$post_meta['post_quote_author'].'</cite>';
			}

			if(isset($post_meta['post_quote_author_desc']) && !empty($post_meta['post_quote_author_desc'])){
				$desc_output = $post_meta['post_quote_author_desc'];
			}

			if ( !empty($author_output) || !empty($desc_output) ) {
				$feature_output .= '<footer>' . $author_output . $desc_output . '</footer>';
			}

			$feature_output .= '</blockquote>';

		}


		return $feature_output; // WPCS: XSS OK.
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function omni_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'omni_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'omni_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so omni_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so omni_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'strawberry_entry_categories' ) ) :

	function omni_entry_categories( $tags = false ) {

		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'omni' ) );
			if ( $categories_list && strawberry_categorized_blog() ) {
				if ( !is_single() ) {
					echo( '<span class="cat-links category single">' . $categories_list . '</span>' ); // WPCS: XSS OK.
				} else {
					printf( '<span class="cat-links category">' . esc_html__( 'In %1$s', 'omni' ) . '</span>', $categories_list ); // WPCS: XSS OK.
				}
			}
			if ( $tags ) {
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'omni' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links category">' . esc_html__( 'Tags %1$s', 'omni' ) . ':</span>', $tags_list ); // WPCS: XSS OK.
				}
			}
		}
	}

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function strawberry_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'strawberry_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'strawberry_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so strawberry_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so strawberry_categorized_blog should return false.
		return false;
	}
}


if ( ! function_exists( 'crumina_formatted_post_date' ) ) {

	/**
	 * Formatted date for blog posts
	 */
	function crumina_formatted_post_date() {
		$date = sprintf( '<time class="date entry-date" datetime="%1$s"><span>%2$s</span> %3$s <br/>%4$s</time>',
			esc_attr( get_the_date( 'c' ) ),
			esc_attr( get_the_date( 'd' ) ),
			esc_attr( get_the_date( 'M' ) ),
			esc_attr( get_the_date( 'Y' ) )
		);
		echo ( $date ); // WPCS: XSS OK.
	}
}


if ( ! function_exists( 'crumina_relative_time' ) ) {

	/**
	 * Convert dates to readable format.
	 *
	 * @param int $a Time in Unix format.
	 *
	 * @return string
	 */
	function crumina_relative_time( $a ) {
		// Get current timestampt.
		$b = strtotime( esc_html__( 'now', 'omni' ) );
		// Get timestamp when tweet created.
		$c = strtotime( $a );
		// Get difference.
		$d = $b - $c;
		// Calculate different time values.
		$minute = 60;
		$hour   = $minute * 60;
		$day    = $hour * 24;

		if ( is_numeric( $d ) && $d > 0 ) {
			// If less then 3 seconds.
			if ( $d < 3 ) {
				return esc_html__( 'right now', 'omni' );
			}
			// If less then minute.
			if ( $d < $minute ) {
				return floor( $d ) . esc_html__( 'seconds ago', 'omni' );
			}
			// If less then 2 minutes.
			if ( $d < $minute * 2 ) {
				return esc_html__( 'about 1 minute ago', 'omni' );
			}
			// If less then hour.
			if ( $d < $hour ) {
				return floor( $d / $minute ) . ' ' . esc_html__( 'minutes ago', 'omni' );
			}
			// If less then 2 hours.
			if ( $d < $hour * 2 ) {
				return 'about 1 hour ago';
			}
			// If less then day.
			if ( $d < $day ) {
				return floor( $d / $hour ) . ' ' . esc_html__( 'hours ago', 'omni' );
			}
			// If more then day, but less then 2 days.
			if ( $d > $day && $d < $day * 2 ) {
				return 'yesterday';
			}
			// If less then year.
			if ( $d < $day * 365 ) {
				return floor( $d / $day ) . ' ' . esc_html__( 'days ago', 'omni' );
			}

			// Else return more than a year.
			return esc_html__( 'over a year ago', 'omni' );
		} else {
			return '';
		}

	}
}

/**
 * Flush out the transients used in omni_categorized_blog.
 */
function omni_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'omni_categories' );
}

add_action( 'edit_category', 'omni_category_transient_flusher' );
add_action( 'save_post', 'omni_category_transient_flusher' );
