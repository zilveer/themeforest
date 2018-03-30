<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package quote
 */

if ( ! function_exists( 'quote_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function quote_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation gap" role="navigation">
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<i class="fa fa-angle-left"></i> Older posts', 'quote' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <i class="fa fa-angle-right"></i>', 'quote' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'quote_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function quote_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav role="navigation" class="mt gap">
		<ul class="post-navigation">

		<?php if ( is_single() ) : // navigation links for single posts ?>

			<?php previous_post_link( '<li class="nav-previous previous previous-post"><h4 class="post-nav-title">'. __( 'Previous Post', 'arcite' ) .'</h4> %link</li>', '<span class="meta-nav"> %title </span>' ); ?>
			<?php next_post_link( '<li class="nav-next next next-post"><h4 class="post-nav-title">'. __( 'Next Post', 'arcite' ) .'</h4>%link</li>', '<span class="meta-nav"> %title </span>' ); ?>

		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

			<?php if ( get_next_posts_link() ) : ?>
			<li class="nav-previous previous previous-post"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'arcite' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="nav-next next next-post"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'arcite' ) ); ?></li>
			<?php endif; ?>

		<?php endif; ?>

		</ul>
	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif;

if ( ! function_exists( 'quote_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function quote_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '<p class="post-details"><i class="fa fa-clock-o"></i> %s</p>', 'post date', 'quote' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( '<p class="post-details"><i class="fa fa-user"></i> %s', 'post author', 'quote' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></p>'
	);

	echo '' . $byline . '' . $posted_on . '';

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function quote_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'quote_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'quote_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so quote_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so quote_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in quote_categorized_blog.
 */
function quote_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'quote_categories' );
}
add_action( 'edit_category', 'quote_category_transient_flusher' );
add_action( 'save_post',     'quote_category_transient_flusher' );
