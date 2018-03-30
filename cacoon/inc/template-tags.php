<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package metcreative
 */

if ( ! function_exists( 'metcreative_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function metcreative_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

	?>
	<nav class="pagination n_pagination <?php echo $nav_class; ?>" id="<?php echo esc_attr( $nav_id ); ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'metcreative' ); ?></h1>
		<ul>
	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<li class="nav-previous">%link</li>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'metcreative' ) . '</span> %title' ); ?>
		<?php next_post_link( '<li class="nav-next">%link</li>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'metcreative' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<li class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'metcreative' ) ); ?></li>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<li class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'metcreative' ) ); ?></li>
		<?php endif; ?>

	<?php endif; ?>
		</ul><!-- #<?php echo esc_html( $nav_id ); ?> -->
	</nav>
	<?php
}
endif; // metcreative_content_nav

if ( ! function_exists( 'metcreative_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function metcreative_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<div class="n_comment_box post pingback">
		<blockquote><?php _e( 'Pingback:', 'metcreative' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'metcreative' ), ' -- <span class="edit-link">', '<span>' ); ?></blockquote>
	<?php
			break;
		default :
	?>

	<li id="li-comment-<?php comment_ID(); ?>">
		<div class="met_comment clearfix" id="comment-<?php comment_ID(); ?>">
			<?php echo get_avatar( $comment, 120 ); ?>

			<div class="met_comment_reply_link met_bgcolor met_color2"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?> <span>↓</span></div>

			<div class="clearfix met_comment_descr">
				<h5><?php printf( __( '%s <span class="says">says:</span>', 'metcreative' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h5>
				<span class="met_color">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'metcreative' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
				</span>
				<p><?php comment_text(); ?></p>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<div class="met_comment_awaiting_moderation"><?php _e( 'Your comment is awaiting moderation.', 'metcreative' ); ?></div>
				<?php endif; ?>

				<div class="met_comment_edit_link"><?php edit_comment_link( __( 'Edit', 'metcreative' ) ); ?></div>
			</div>
		</div>
	</li>


	<?php
			break;
	endswitch;
}
endif; // ends check for metcreative_comment()

if ( ! function_exists( 'metcreative_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function metcreative_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'metcreative' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'metcreative' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;
/**
 * Returns true if a blog has more than 1 category
 */
function metcreative_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so metcreative_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so metcreative_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in metcreative_categorized_blog
 */
function metcreative_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'metcreative_category_transient_flusher' );
add_action( 'save_post', 'metcreative_category_transient_flusher' );