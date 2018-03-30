<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package humbleshop
 */

if ( ! function_exists( 'humbleshop_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function humbleshop_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<ul class="pager">

			<?php if ( get_next_posts_link() ) : ?>
			<li class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'humbleshop' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'humbleshop' ) ); ?></li>
			<?php endif; ?>

		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'humbleshop_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function humbleshop_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<!-- Navigation -->
	<ul class="pager">
		<li class="previous"><?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'humbleshop' ) ); ?></li>
		<li class="next"><?php next_post_link(     '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'humbleshop' ) ); ?><li>
	</ul>
	<?php
}
endif;

if ( ! function_exists( 'humbleshop_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function humbleshop_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<span class="label label-default"><?php _e( 'Pingback:', 'humbleshop' ); ?></span> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'humbleshop' ), '<span class="edit-link"><small><i class="fa fa-pencil"></i> ', '</small></span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta row">
				<div class="col-sm-1 col-xs-2 text-center comment-author vcard">
					<p><?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?></p>
					<?php edit_comment_link( __( 'Edit', 'humbleshop' ), '<p class="edit-link text-center"><small>', '</small></p>' ); ?>
				</div>
				<div class="col-sm-11 col-xs-8">
					<div class="comment-author vcard">
						<strong><small><?php printf( __( '%s', 'humbleshop' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></small></strong>
					</div>
					<div class="comment-metadata">
						<small>
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<i class="fa fa-calendar"></i>	<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'humbleshop' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a> | 
							<?php
								comment_reply_link( array_merge( $args, array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<span class="reply"><i class="fa fa-reply"></i> ',
									'after'     => '</span>',
								) ) );
							?>
							<?php if ( '0' == $comment->comment_approved ) : ?>
							 | <span class="comment-awaiting-moderation label label-warning"><?php _e( 'Your comment is awaiting moderation.', 'humbleshop' ); ?></span>
							<?php endif; ?>	
						</small>
					</div><!-- .comment-metadata -->
					
					<div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->
					
				</div>
			</footer><!-- .comment-meta -->
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for humbleshop_comment()

if ( ! function_exists( 'humbleshop_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function humbleshop_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		//$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on"><small><i class="fa fa-calendar"></i> %1$s</small></span><span class="byline hidden"> by %2$s</span>', 'humbleshop' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function humbleshop_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so humbleshop_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so humbleshop_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in humbleshop_categorized_blog.
 */
function humbleshop_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'humbleshop_category_transient_flusher' );
add_action( 'save_post',     'humbleshop_category_transient_flusher' );
