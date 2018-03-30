<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package progression
 */

function show_pagination_links()
{
    global $wp_query;

    $page_tot   = $wp_query->max_num_pages;
    $page_cur   = get_query_var( 'paged' );
    $big        = 999999999;

    if ( $page_tot == 1 ) return;

    echo paginate_links( array(
            'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ), // need an unlikely integer cause the url can contains a number
            'format'    => '?paged=%#%',
            'current'   => max( 1, $page_cur ),
            'total'     => $page_tot,
            'prev_next' => true,
			'prev_text'    => __('&lsaquo; Previous', 'progression'),
			'next_text'    => __('Next &rsaquo;', 'progression'),
            'end_size'  => 1,
            'mid_size'  => 2,
            'type'      => 'list'
        )
    );
}


if ( ! function_exists( 'progression_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function progression_content_nav( $nav_id ) {
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

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<div id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'progression' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>' , '' . __('<span>&larr;</span> Previous Article', 'progression' ) , TRUE); ?>	
		<?php next_post_link( '<div class="nav-next">%link</div>' , '' . __('Next Article <span>&rarr;</span>', 'progression' ) , TRUE); ?>	
		
		
		

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'progression' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'progression' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</div><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // progression_content_nav

if ( ! function_exists( 'progression_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function progression_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'progression' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'progression' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta">
				<div class="comment-author vcard">
					
					<?php
						$avatar_size = 70;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 60;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s %2$s', 'progression' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s %2$s', 'progression' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
					<?php edit_comment_link( __( 'Edit', 'progression' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'progression' ); ?></p>
				<?php endif; ?>
			</div><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for progression_comment()


if ( ! function_exists( 'progression_review' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function progression_review( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'progression' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'progression' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta">
				<div class="comment-author vcard">
					
					<?php
						$avatar_size = 70;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 60;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s %2$s', 'progression' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s %2$s', 'progression' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
					<?php edit_comment_link( __( 'Edit', 'progression' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your review is awaiting moderation.', 'progression' ); ?></p>
				<?php endif; ?>
			</div><!-- .comment-meta -->

			<div class="comment-content">
	
				
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for progression_comment()

if ( ! function_exists( 'progression_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function progression_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'progression_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'progression_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
	function progression_posted_on() {
		printf( __( '<time class="entry-date" datetime="%3$s">%4$s</time>', 'progression' ),
			esc_url( get_month_link(get_the_time('Y'), get_the_time('m')) ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'progression' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
	}
	endif;

/**
 * Returns true if a blog has more than 1 category
 */
function progression_categorized_blog() {
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
		// This blog has more than 1 category so progression_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so progression_categorized_blog should return false
		return false;
	}
}



/**
 * Flush out the transients used in progression_categorized_blog
 */
function progression_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'progression_category_transient_flusher' );
add_action( 'save_post',     'progression_category_transient_flusher' );

/**
 * Display a navigation for the portfolio including the parent category
 */
function progression_portfolio_category_nav() {
	$term 			= get_queried_object();
	$term_all 		= ( $term->parent ? $term->parent : $term->term_id );
	$term_children 	= get_term_children( $term->term_id, 'portfolio_type' );

	// if the current term has neither children nor a parent then display nothing
	if ( empty( $term_children ) && ! $term->parent  ) {
		return false;
	}

	// build the link to the parent ("all") category
	$term_link_classes = join( ' ', array( 'cat-item', 'cat-item-'. $term_all, ( $term->parent ? ' ' : 'current-cat' )));

	return sprintf(
		// HTML link template
		'<li class="%s"><a href="%s">%s</a></li>',

		// the string containing item classes
		$term_link_classes,

		// URL to the term archive
		get_term_link( $term_all, 'portfolio_type' ),

		// link text
		__( 'All', 'progression' ) )

		// append the subcategories
		.wp_list_categories( 'taxonomy=portfolio_type&echo=0&show_count=0&title_li=&show_option_none=&child_of=' . $term_all );
}


function progression_service_category_nav() {
	$term 			= get_queried_object();
	$term_all 		= ( $term->parent ? $term->parent : $term->term_id );
	$term_children 	= get_term_children( $term->term_id, 'service_type' );

	// if the current term has neither children nor a parent then display nothing
	if ( empty( $term_children ) && ! $term->parent  ) {
		return false;
	}

	// build the link to the parent ("all") category
	$term_link_classes = join( ' ', array( 'cat-item', 'cat-item-'. $term_all, ( $term->parent ? ' ' : 'current-cat' )));

	return sprintf(
		// HTML link template
		'<li class="%s"><a href="%s">%s</a></li>',

		// the string containing item classes
		$term_link_classes,

		// URL to the term archive
		get_term_link( $term_all, 'service_type' ),

		// link text
		__( 'All', 'progression' ) )

		// append the subcategories
		.wp_list_categories( 'taxonomy=service_type&echo=0&show_count=0&title_li=&show_option_none=&child_of=' . $term_all );
}


function progression_testimonial_category_nav() {
	$term 			= get_queried_object();
	$term_all 		= ( $term->parent ? $term->parent : $term->term_id );
	$term_children 	= get_term_children( $term->term_id, 'testimonial_type' );

	// if the current term has neither children nor a parent then display nothing
	if ( empty( $term_children ) && ! $term->parent  ) {
		return false;
	}

	// build the link to the parent ("all") category
	$term_link_classes = join( ' ', array( 'cat-item', 'cat-item-'. $term_all, ( $term->parent ? ' ' : 'current-cat' )));

	return sprintf(
		// HTML link template
		'<li class="%s"><a href="%s">%s</a></li>',

		// the string containing item classes
		$term_link_classes,

		// URL to the term archive
		get_term_link( $term_all, 'testimonial_type' ),

		// link text
		__( 'All', 'progression' ) )

		// append the subcategories
		.wp_list_categories( 'taxonomy=testimonial_type&echo=0&show_count=0&title_li=&show_option_none=&child_of=' . $term_all );
}

