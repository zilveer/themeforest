<?php
/**
 * Template tags
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_wpml_flags' ) ) {
	/**
	 * Display coutry flags if WPML translation plugin is installed
	 *
	 * @return string
	 */
	function wolf_wpml_flags() {
		if ( function_exists( 'icl_get_languages' ) ) {
			if ( 'list' == wolf_get_theme_option( 'top_bar_flags' ) ) {

				$languages = icl_get_languages('skip_missing=0&orderby=code');
				if ( ! empty( $languages ) ) {
					echo '<div class="wolf-flags-container">';
					foreach( $languages as $l ) {
						if ( ! $l['active'] ) echo '<a href="'.$l['url'].'" class="wolf-wpml-flag">';
						echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
						if ( ! $l['active'] ) echo '</a>';
					}
					echo '</div>';
				}

			} else {
				do_action( 'icl_language_selector' );
			}
		}
	}
}

if ( ! function_exists( 'wolf_entry_media' ) ) {
	/**
	 * Display the content of the media editor metabox
	 *
	 * @param
	 * @return
	 */
	function wolf_entry_media( $echo = true ) {

		$raw_media = get_post_meta( get_the_ID(), '_post_media', true );

		if ( $echo )
			echo wolf_format_custom_content_output( stripslashes( $raw_media ) );

		return wolf_format_custom_content_output( stripslashes( $raw_media ) );
	}
}

if ( ! function_exists( 'wolf_entry_title' ) ) {
	/**
	 * Prints the post title
	 *
	 * The title will be linked to the post if we're on an archive page
	 *
	 */
	function wolf_entry_title( $echo = true, $wrapped = true, $force = false ) {

		$title = '';
		$format = get_post_format() ? get_post_format() : 'standard';
		$no_title = array( 'status', 'aside', 'quote','chat' );

		if ( has_post_format( 'link' ) && ! is_single() ) {

			if ( $wrapped )
				$title .= '<h2 class="entry-title">';

			$title .= '<a target="_blank" href="' . esc_url( wolf_get_first_url() ) . '" rel="no-follow">' . get_the_title() . '</a>';

			if ( $wrapped )
				$title .= '</h2>';

		} elseif ( is_single() ) {
			if ( $wrapped )
				$title .= '<h1 class="entry-title">';

			$title .= get_the_title();

			if ( $wrapped )
				$title .= '</h1>';

		} elseif ( ! in_array( $format, $no_title ) || $force ) {

			if ( $wrapped )
				$title .= '<h2 class="entry-title">';

			$title .= '<a href="' . esc_url( get_permalink() ) . '" class="entry-link" rel="bookmark">' . get_the_title() . '</a></h2>';

			if ( $wrapped )
				$title .= '</h2>';
		}

		if ( $echo )
			echo wp_kses( $title, array(
				'h2' => array(),
			) );

		return $title;
	}
}

if ( ! function_exists( 'wolf_post_entry_meta' ) ) {
	/**
	 * Entry Meta
	 *
	 * @return string $output
	 */
	function wolf_post_entry_meta( $echo = true ) {

		$output  = '';
		$post_id = get_the_ID();

		if ( is_sticky() && is_home() && ! is_paged() )
			$output .= '<span class="featured-post">' . __( 'Featured', 'wolf' ) . '</span>';

		if ( ! has_post_format( 'link' ) && 'post' == get_post_type() || is_search() )
			$output .= wolf_entry_date( false );

		// Post author
		if ( 'post' == get_post_type() && is_multi_author() ) {
			$output .= sprintf(
				'<span class="byline"><span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'wolf' ), get_the_author() ) ),
				wolf_the_author( false )
			);
		}

		if ( 'work' == get_post_type() ) {
			$categories_list = get_the_term_list( $post_id, 'work_type', '', ', ', '' );

		} elseif ( 'video' == get_post_type() ) {

			$categories_list = get_the_term_list( $post_id, 'video_type', '', ', ', '' );

		} elseif ( 'gallery' == get_post_type() ) {

			$categories_list = get_the_term_list( $post_id, 'gallery_type', '', ', ', '' );

		} elseif ( 'plugin' == get_post_type() ) {

			$categories_list = get_the_term_list( $post_id, 'plugin_cat', '', ', ', '' );

		} elseif ( 'theme' == get_post_type() ) {

			$categories_list = get_the_term_list( $post_id, 'theme_cat', '', ', ', '' );

		} else {
			// Translators: used between list items, there is a space after the comma.
			$categories_list = get_the_category_list( __( ', ', 'wolf' ) );
		}

		if ( $categories_list ) {
			$output .= '<span class="categories-links">' . $categories_list . '</span>';
		}

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'wolf' ) );
		if ( $tag_list ) {
			$output .= '<span class="tags-links">' . $tag_list . '</span>';
		}

		if ( $echo )
			echo wp_kses( $output, array(
				'span' => array(
					'class' => array(),
				),
				'a' => array(
					'href' => array(),
					'rel' => array(),
					'class' => array()
				),
				'time' => array(
					'class' => array(),
					'datetime' => array(),
				),
			) );

		return $output;
	}
}

if ( ! function_exists( 'wolf_entry_date' ) ) {
	/**
	 * Prints HTML with date information for current post.
	 *
	 * Create your own wolf_entry_date() to override in a child theme.
	 *
	 *
	 * @param boolean $echo Whether to echo the date. Default true.
	 * @return string
	 */
	function wolf_entry_date( $echo = true, $link = true ) {
		$display_time = get_the_date();
		$modified_display_time = get_the_modified_date();

		if ( 'human_diff' == wolf_get_theme_option( 'date_format' ) ) {
			$display_time = sprintf( __( '%s ago', 'wolf' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
			$modified_display_time = sprintf( __( '%s ago', 'wolf' ), human_time_diff( get_the_modified_time( 'U' ), current_time( 'timestamp' ) ) );
		}

		$date = $display_time;

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>
			<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( $display_time ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( $modified_display_time )
		);

		if ( $link ) {
			$date = sprintf(
				'<span class="posted-on date"><a href="%1$s" rel="bookmark">%2$s</a></span>',
				esc_url( get_permalink() ),
				$time_string
			);
		} else {
			$date = sprintf(
				'<span class="posted-on date">%2$s</span>',
				esc_url( get_permalink() ),
				$time_string
			);
		}


		if ( $echo )
			echo wp_kses( $date, array(
				'span' => array(
					'class' => array()
				),
				'a' => array(
					'href' => array(),
					'rel' => array(),
					'class' => array()
				),
			) );

		return $date;
	}
}

if ( ! function_exists( 'wolf_the_subheading' ) ) {
	function wolf_the_subheading() {
		echo sanitize_text_field( get_post_meta( get_the_ID(), '_subheading', true ) );
	}
}

if ( ! function_exists( 'wolf_entry_thumbnail' ) ) {
	/**
	 * Get a different post thumbnail depending on context
	 *
	 * @param boolean $echo Whether to echo the date. Default true.
	 * @return string
	 */
	function wolf_entry_thumbnail( $echo = true ) {

		$thumbnail = '';
		$format = get_post_format() ? get_post_format() : 'standard';
		$no_thumb = array( 'video', 'gallery', 'link', 'status', 'quote', 'aside', 'link', 'chat' );

		$is_instagram = 'image' == $format && preg_match( wolf_get_regex( 'instagram' ), get_the_content() );

		if ( has_post_thumbnail() ) {

			if ( 'work' == get_post_type() && ! is_single() ) {

				$thumbnail = get_the_post_thumbnail( get_the_ID(), 'classic-thumb' );

			} elseif ( 'image' == $format && is_single() ) {

				$img_excerpt = get_post( get_post_thumbnail_id() )->post_excerpt;
				$img_alt = esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) );

				$caption = ( $img_excerpt ) ? $img_excerpt : get_the_title();
				$caption = '';

				$img = wolf_get_post_thumbnail_url( 'big' );

				$full_img = wolf_get_post_thumbnail_url( 'full' );

				$lightbox_class = 'lightbox';
				$thumbnail = '<div class="entry-thumbnail">';
				$thumbnail .= "<a title='$caption' class='$lightbox_class zoom' href='$full_img'>";
				$thumbnail .= "<img src='$img' alt='$img_alt'>";
				$thumbnail .= '</a>';
				$thumbnail .= '</div>';

			} elseif ( 'video' == $format && ! is_single() ) {

				$thumbnail = get_the_post_thumbnail( get_the_ID(), '1x1' );

			} elseif ( ! is_single() ) {

				$thumbnail = get_the_post_thumbnail( get_the_ID(), '2x2' );
			}

		} elseif ( is_page_template( 'page-templates/home.php' ) ) {
			$thumbnail = '<img src="' . wolf_get_theme_uri( '/images/empty.gif' ) . '">';
		}

		if ( $echo )
			echo wp_kses( $thumbnail, array(
				'div' => array(
					'class' => array(),
				),
				'img' => array(
					'src' => array(),
					'alt' => array(),
					'class' => array(),
				),
				'a' => array(
					'href' => array(),
					'class' => array(),
					'rel' => array(),
					'title' => array(),
				),
			) );

		return $thumbnail;
	}
}

if ( ! function_exists( 'wolf_paging_nav' ) ) {
	/**
	 * Displays navigation to next/previous set of posts when applicable.
	 *
	 */
	function wolf_paging_nav( $loop = null ) {

		if ( ! $loop ) {
			global $wp_query;
			$max = $wp_query->max_num_pages;
		} else {
			$max = $loop->max_num_pages;
		}

		// Don't print empty markup if there's only one page.
		if ( $max < 2 )
			return;

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="nav-links clearfix">
				<?php if ( get_next_posts_link( '', $max ) ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'wolf' ), $max ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link( '', $max ) ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wolf' ), $max ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'wolf_post_nav' ) ) {
	/**
	 * Displays navigation to next/previous work post when applicable.
	 *
	 */
	function wolf_post_nav() {
		global $post;

		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;

		$next_post = get_next_post();
		$prev_post = get_previous_post();
		?>
		<nav class="nav-single clearfix">

			<div class="nav-previous"<?php
				if( ! empty( $prev_post ) && wolf_get_post_thumbnail_url( 'large', $prev_post->ID ) ) : ?>
					data-bg="<?php echo esc_url( wolf_get_post_thumbnail_url( 'large', $prev_post->ID ) ); ?>"
				<?php endif; ?>>
				<?php previous_post_link( '%link', '<span class="nav-label">' . __( 'Previous post', 'wolf' ) . '</span><span class="meta-nav"></span> %title' ); ?>
			</div>
			<div class="nav-next"<?php
				if( ! empty( $next_post ) && wolf_get_post_thumbnail_url( 'large', $next_post->ID ) ) : ?>
					data-bg="<?php echo esc_url( wolf_get_post_thumbnail_url( 'large', $next_post->ID ) ); ?>"
				<?php endif; ?>>
				<?php next_post_link( '%link', '<span class="nav-label">' . __( 'Next post', 'wolf' ) . '</span> %title <span class="meta-nav"></span>' ); ?>
			</div>
		</nav><!-- .nav-single -->
		<?php
	}
}

if ( ! function_exists( 'wolf_the_author' ) ) {
	/**
	 * Get the author
	 *
	 * @param bool $echo
	 * @return string $author
	 */
	function wolf_the_author( $echo = true ) {
		global $post;
		if ( ! is_object( $post ) )
			return;
		$author_id = $post->post_author;
		$author = get_the_author_meta( 'user_nicename', $author_id );

		if ( get_the_author_meta( 'nickname', $author_id ) ) {
			$author = get_the_author_meta( 'nickname', $author_id );
		}

		if ( get_the_author_meta( 'first_name', $author_id ) ) {
			$author = get_the_author_meta( 'first_name', $author_id );

			if ( get_the_author_meta( 'last_name', $author_id ) ) {
				$author .= ' ' .  get_the_author_meta( 'last_name', $author_id );
			}
		}

		$author = sprintf( '<span class="vcard author"><span class="fn">%s</span></span>', $author );

		if ( $echo )
			echo wp_kses( $author, array(
				'span' => array(
					'class' => array()
				),
				'a' => array(
					'href' => array(),
					'rel' => array(),
					'class' => array()
				),
			) );

		return $author;
	}
}

if ( ! function_exists( 'wolf_excerpt' ) ) {
	/**
	 *
	 *
	 * @param
	 * @return
	 */
	function wolf_excerpt( $echo = true ) {

		$media = wolf_post_media( false );
		$excerpt = str_replace( $media, '', get_the_excerpt() );

		if ( $echo )
			echo '<p>' . $excerpt . '</p>';

		return '<p>' . $excerpt . '</p>';
	}
}

if ( ! function_exists( 'wolf_excerpt_text' ) ) {
	/**
	 * Display the excerpt of the content depending on options
	 *
	 * @param
	 * @return
	 */
	function wolf_excerpt_text() {

		if ( 'auto' == wolf_get_theme_option( 'excerpt_type' ) ) {
			wolf_excerpt();

		} else {
			echo wolf_content();
		}
	}
}

if ( ! function_exists( 'wolf_icon_meta' ) ) {
	/**
	 * Display comments, views and like
	 *
	 * @access public
	 * @return void
	 */
	function wolf_icon_meta() {
		$post_id = get_the_ID();
		$post_type = get_post_type();
		$format = get_post_format() ? get_post_format() : 'standard';
		$views = wolf_format_number( absint( get_post_meta( $post_id, '_wolf_views', true ) ) );
		$likes = wolf_format_number( absint( get_post_meta( $post_id, '_wolf_likes', true ) ) );
		$comments = wolf_format_number( absint( get_comments_number() ) );
		$no_views = array( 'status', 'aside', 'link', 'quote' );
		$enable_comments = ( 'post' == $post_type ) ? true : wolf_get_theme_option( $post_type . '_comments' );
		?>
			<?php if ( comments_open() && ( wolf_get_theme_option( $post_type . '_comments' ) || 'post' == $post_type ) ) : ?>
				<span class="item-icon" title="<?php printf( __( '%d comments', 'wolf' ), $comments ); ?>">
					<a href="<?php echo get_permalink(); ?>#comments">
						<i class="fa fa-comment-o"></i> <span class="item-comments-count"><?php echo absint( $comments ); ?></span>
					</a>
				</span><!-- .comments-link -->
				<?php endif; // comments_open() ?>

			<?php if ( wolf_get_theme_option( $post_type . '_likes' ) ) : ?>
				<span class="item-icon item-like" title="<?php _e( 'Like this', 'wolf' ); ?>">
					<i class="fa fa-heart-o"></i> <span class="item-likes-count"><?php echo sanitize_text_field( $likes ); ?></span>
				</span>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( $post_type . '_views' ) && ! in_array( $format, $no_views ) ) : ?>
				<span class="item-icon" title="<?php printf( __( '%d views', 'wolf' ), $views ); ?>">
					<i class="fa fa-eye"></i> <span class="item-views-count"><?php echo sanitize_text_field( $views ); ?></span>
				</span>
			<?php endif; ?>
		<?php
	}
}

if ( ! function_exists( 'wolf_theme_work_meta' ) ) {
	/**
	 * Display work meta
	 *
	 * @access public
	 * @return void
	 */
	function wolf_theme_work_meta() {
		$post_id = get_the_ID();
		$client = get_post_meta( $post_id, '_work_client', true );
		$link = get_post_meta( $post_id, '_work_link', true );
		$skills = get_the_term_list( $post_id, 'work_type', '', __( ', ', 'wolf' ), '' );
		$display_date = wolf_get_theme_option( 'work_date' );
		?>
		<?php if ( $display_date ) : ?>
			<span class="work-meta work-date">
				<i class="fa line-icon-calendar"></i> <strong><?php _e( 'Date', 'wolf' ); ?></strong> : <?php wolf_entry_date(); ?>
			</span>
		<?php endif; ?>

		<?php if ( $skills ) : ?>
			<span class="work-meta work-categories">
				<i class="fa line-icon-tag"></i> <strong><?php _e( 'Category', 'wolf' ); ?></strong> : <?php echo sanitize_text_field( $skills ); ?>
			</span>
		<?php endif; ?>

		<?php if ( $client ) : ?>
			<span class="work-meta work-client">
				<i class="fa line-icon-user"></i> <strong><?php _e( 'Client', 'wolf' ); ?></strong> : <?php echo sanitize_text_field( $client ); ?>
			</span>
		<?php endif; ?>

		<?php if ( $link ) :
			$link_text = mb_strimwidth( str_replace( 'http://', '', $link ), 0, 25, '...' );
		?>
			<span class="work-meta work-link">
				<i class="fa fa-external-link"></i> <strong><?php _e( 'Link', 'wolf' ); ?></strong> : <a href="<?php echo esc_url( $link ); ?>"><?php echo sanitize_text_field( $link_text ); ?></a>
			</span>
		<?php endif; ?>
		<?php wolf_icon_meta(); ?>
		<?php
	}
}

if ( ! function_exists( 'wolf_secondary_meta' ) ) {
	/**
	 * Display meta in single post view depending on header option
	 *
	 * @access public
	 * @return void
	 */
	function wolf_secondary_meta() {

		$post_id          = get_the_ID();
		$post_type        = get_post_type();
		$page_header_type = wolf_get_theme_option( 'page_header_type' );
		$hide_title       = get_post_meta( $post_id, '_header_hide_title', true );
		$hide_title_area  = ( 'none' == wolf_get_theme_option( 'page_header_type' ) || $hide_title );

		if ( get_post_meta( $post_id, '_page_header_type', true ) ) {
			$page_header_type = get_post_meta( $post_id, '_page_header_type', true );
			$page_header_type = ( 'full' == $page_header_type ) ? 'big' : $page_header_type;
			$hide_title_area  = ( 'none' == get_post_meta( $post_id, '_page_header_type', true ) || $hide_title );
		}

		if ( 'post' == $post_type ) {
			if ( $hide_title_area ) {
				?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php
			}

			if ( $hide_title_area || 'small' == $page_header_type ) {
				?>
				<div class="entry-meta">
					<?php wolf_post_entry_meta(); ?>
				</div>
				<?php
			}
		}

		if ( 'work' == $post_type ) {

			if ( $hide_title_area ) {
				?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php
			}
		}

		if ( 'video' == $post_type ) {
			if ( $hide_title_area ) {
				?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php
			}
		}
	}
}
