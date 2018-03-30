<?php



/**
 * dtbaker.function
 * Version 1.1
 *
 */


/**
 * Display navigation to next/previous pages when applicable
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'boutique_content_nav' ) ) :
	function boutique_content_nav( $nav_id ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) :
			boutique_pagination();
		endif;
	}
endif;

if ( ! function_exists( 'boutique_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own boutique_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since boutique 1.0
	 */
	function boutique_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
				<p><?php esc_html_e( 'Pingback:', 'boutique-kids' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'boutique-kids' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default :
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>" class="comment border1">
					<div class="comment-meta">
						<div class="comment-author vcard">
							<?php
							$avatar_size = apply_filters( 'boutique_comment_avatar_size', 68 );
							if ( '0' != $comment->comment_parent ) {
								$avatar_size = apply_filters( 'boutique_comment_avatar_size_child', 39 );
							}

							echo get_avatar( $comment, $avatar_size );

							/* translators: 1: comment author, 2: date and time */
							printf( wp_kses_post( __( '%1$s on %2$s <span class="says">said:</span>', 'boutique-kids' ) ),
								sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( esc_html__( '%1$s at %2$s', 'boutique-kids' ), get_comment_date(), get_comment_time() )
								)
							);
							?>

							<?php edit_comment_link( esc_html__( 'Edit', 'boutique-kids' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .comment-author .vcard -->

						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'boutique-kids' ); ?></em>
							<br/>
						<?php endif; ?>

					</div>

					<div class="comment-content"><?php comment_text(); ?></div>

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => wp_kses_post( __( 'Reply <span>&darr;</span>', 'boutique-kids' ) ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) ); ?>
					</div><!-- .reply -->
				</div><!-- #comment-## -->

				<?php
				break;
		endswitch;
	}
endif; // ends check for boutique_comment()

if ( ! function_exists( 'boutique_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 * Create your own boutique_posted_on to override in a child theme
	 *
	 * @since boutique 1.0
	 */
	function boutique_posted_on( $date = true ) {
		if ( ! $date ) {
			return sprintf( wp_kses_post( __( '<span class="by-author"> <i class="fa fa-user"></i> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'boutique-kids' ) ),
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'boutique-kids' ), get_the_author() ),
				esc_html( get_the_author() )
			);
		} else {

			return sprintf( wp_kses_post( __( '<i class="fa fa-calendar"></i> <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a> <span class="blog_links_sep">/</span> <span class="by-author"> <i class="fa fa-user"></i> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'boutique-kids' ) ),
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'boutique-kids' ), get_the_author() ),
				esc_html( get_the_author() )
			);
		}
	}
endif;


if ( ! isset( $content_width ) ) {
	$content_width = 895;
}


if ( ! function_exists( 'array_unshift_assoc' ) ) {
	function array_unshift_assoc( &$arr, $key, $val ) {
		$arr         = array_reverse( $arr, true );
		$arr[ $key ] = $val;
		$arr         = array_reverse( $arr, true );
	}
}

if ( ! function_exists( 'boutique_blog_links' ) ) {
	function boutique_blog_links() {
		do_action('boutique_blog_links_before');
		if ( 'post' == get_post_type() ) : ?>
			<div class="blog_links">
				<?php
				$blog_links    = array();
				$blog_links ['date'] = sprintf( wp_kses_post( __( '<span class="the-date"> <i class="fa fa-calendar"></i> <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a> </span>', 'boutique-kids' ) ),
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
				$blog_links ['author'] = sprintf( wp_kses_post( __( '<span class="by-author"> <i class="fa fa-user"></i> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>', 'boutique-kids' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					sprintf( esc_attr__( 'View all posts by %s', 'boutique-kids' ), get_the_author() ),
					esc_html( get_the_author() )
				);
				if ( comments_open() ) {
					ob_start();
					comments_popup_link( '<span class="leave-comment"><i class="fa fa-comment"></i> ' . esc_html__( 'Leave a comment', 'boutique-kids' ) . '</span>', wp_kses_post( __( '<i class="fa fa-comment"></i> <strong>1</strong> Comment', 'boutique-kids' ) ), wp_kses_post( __( '<i class="fa fa-comment"></i> <strong>%</strong> Comments', 'boutique-kids' ) ) );
					$blog_links['comments'] = ob_get_clean();
				}
				$categories_list = get_the_category_list( esc_html__( ', ', 'boutique-kids' ) );
				if ( $categories_list ) {
					$blog_links['categories'] = sprintf( wp_kses_post( __( '<span class="%1$s"><i class="fa fa-files-o"></i></span> %2$s', 'boutique-kids' ) ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
				}
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'boutique-kids' ) );
				if ( $tags_list ) {
					$blog_links['tags'] = sprintf( wp_kses_post( __( '<span class="%1$s"><i class="fa fa-tags"></i></span> %2$s', 'boutique-kids' ) ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				}
				echo implode( ' <span class="blog_links_sep">/</span> ', apply_filters( 'boutique_blog_links', $blog_links ) );
				?>
			</div>
		<?php endif;
		do_action('boutique_blog_links_after');
	}
}
if ( ! function_exists( 'boutique_color_background' ) ) {
	function boutique_color_background( $colors, $type = 'default' ) {
		if ( empty( $colors['primary'] ) ) {
			return '';
		}
		$colors['lighter1'] = boutique_color_adjust( $colors['primary'], 20 );
		$colors['lighter2'] = boutique_color_adjust( $colors['primary'], 40 );
		// $html = preg_replace('#<div#','<div data-boutique_colors="'.esc_attr(json_encode($colors)).'"',$html,1);
		switch ( $type ) {
			case 'menu':
				$color_stops = array(
					array( 'p' => 0, 'c' => $colors['lighter2'] ),
					array( 'p' => 70, 'c' => $colors['lighter2'] ),
					array( 'p' => 70, 'c' => $colors['lighter1'] ),
					array( 'p' => 100, 'c' => $colors['lighter1'] ),
				);
				break;
			case 'box':
			case 'blog':
			case 'widget':
				$color_stops = array(
					array( 'p' => 0, 'c' => $colors['primary'] ),
					array( 'p' => 70, 'c' => $colors['primary'] ),
					array( 'p' => 70, 'c' => $colors['lighter2'] ),
					array( 'p' => 75, 'c' => $colors['lighter2'] ),
					array( 'p' => 75, 'c' => $colors['lighter1'] ),
					array( 'p' => 100, 'c' => $colors['lighter1'] ),
				);
				break;
			case 'circle':
			default:

				$color_stops = array(
					array( 'p' => 0, 'c' => $colors['primary'] ),
					array( 'p' => 30, 'c' => $colors['primary'] ),
					array( 'p' => 31, 'c' => $colors['lighter1'] ),
					array( 'p' => 45, 'c' => $colors['lighter1'] ),
					array( 'p' => 46, 'c' => $colors['primary'] ),
					array( 'p' => 80, 'c' => $colors['primary'] ),
					array( 'p' => 81, 'c' => $colors['lighter2'] ),
					array( 'p' => 90, 'c' => $colors['lighter2'] ),
					array( 'p' => 91, 'c' => $colors['primary'] ),
					array( 'p' => 100, 'c' => $colors['primary'] ),
				);
		}
		$str    = 'background: ' . $colors['primary'] . ';';
		$prefix = array( '-moz-', '-webkit-', '-o-', '-ms-', '' );
		$str .= 'background:-webkit-gradient(left bottom, right top';
		for ( $i = 0; $i < count( $color_stops ); $i ++ ) {
			$str .= ', color-stop(' . $color_stops[ $i ]['p'] . '%, ' . $color_stops[ $i ]['c'] . ')';
		}
		$str .= ');';
		for ( $p = 0; $p < count( $prefix ); $p ++ ) {
			$str .= $prefix[ $p ] . 'background:linear-gradient(72deg';
			for ( $i = 0; $i < count( $color_stops ); $i ++ ) {
				$str .= ', ' . $color_stops[ $i ]['c'] . ' ' . $color_stops[ $i ]['p'] . '%';
			}
			$str .= ');';
		}

		/*filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $lighter2; ?>', endColorstr='<?php echo $lighter1; ?>', GradientType=1);*/

		return array( $colors, $str, $type );
	}
}
if ( ! function_exists( 'boutique_color_adjust' ) ) {
	function boutique_color_adjust( $hex, $steps ) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( - 255, min( 255, $steps ) );

		// Normalize into a six character long hex string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Split into three parts: R, G and B
		$color_parts = str_split( $hex, 2 );
		$return      = '#';

		foreach ( $color_parts as $color ) {
			$color = hexdec( $color ); // Convert to decimal
			$color = max( 0, min( 255, $color + $steps ) ); // Adjust color
			$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
		}

		return $return;
	}
}


function boutique_keep_sidebar_checker_happy() {
	// sidebar registration happens within the "Widget Area Manager" plugin.
	// this plugin should be installed automatically on theme activation.
	// if not, it can be downloaded from here: http://widget-area-manager-wordpress-plugin.dtbaker.net/
	register_sidebar( array() );
}


// Numbered Pagination
if ( ! function_exists( 'boutique_pagination' ) ) {

	function boutique_pagination() {

		echo '<div class="dtbaker_pagination">';
		$prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
		$next_arrow = is_rtl() ? '&larr;' : '&rarr;';

		global $wp_query;
		$total = $wp_query->max_num_pages;
		$big   = 999999999; // need an unlikely integer
		if ( $total > 1 ) {
			if ( ! $current_page = get_query_var( 'paged' ) ) {
				$current_page = 1;
			}
			if ( get_option( 'permalink_structure' ) ) {
				$format = 'page/%#%/';
			} else {
				$format = '&paged=%#%';
			}
			$html = paginate_links( apply_filters ( 'boutique_pagination_args', array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => $format,
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $total,
				'mid_size'  => 3,
				'type'      => 'list',
				'prev_text' => $prev_arrow,
				'next_text' => $next_arrow,
			) ) );
			echo wp_kses_post( str_replace( 'page-numbers', 'dtbaker-page-numbers', $html ) );
		}
		echo '</div>';
	}
}
