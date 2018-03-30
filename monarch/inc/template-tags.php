<?php
/**
 * Custom template tags for monarch
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

if ( ! function_exists( 'wp_link_pages_monarch' ) ) :
/**
 * Display post navigation.
 *
 * @since Monarch 1.0
 */
function wp_link_pages_monarch() {
	wp_link_pages( array(
		'before'      => '<div class="nav-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'monarch' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span class="numbers">',
		'link_after'  => '</span>',
		'pagelink'    => '<span class="sr-only">' . esc_html__( 'Page', 'monarch' ) . ' </span>%',
		'separator'   => '<span class="sr-only">, </span>',
	) );
}
endif;

if ( ! function_exists( 'monarch_notification' ) ) :
/**
 * Display user notification count.
 *
 * @since Monarch 1.0
 */
function monarch_notification() {
	$monarch_notification = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ); 
	if ($monarch_notification > 0) {
	   echo "<a class='notifications badge' href='";
	   echo bp_loggedin_user_domain();
	   echo "notifications'>";
	   echo bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
	   echo "</a>";
	}
}
endif;

if ( ! function_exists( 'monarch_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Monarch 1.0
 */
function monarch_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="sr-only"><?php _e( 'Comment navigation', 'monarch' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'monarch' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'monarch' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @since Monarch 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function monarch_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'monarch_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'monarch_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so monarch_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so monarch_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in {@see monarch_categorized_blog()}.
 *
 * @since Monarch 1.0
 */
function monarch_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'monarch_categories' );
}
add_action( 'edit_category', 'monarch_category_transient_flusher' );
add_action( 'save_post',     'monarch_category_transient_flusher' );

if ( ! function_exists( 'monarch_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Monarch 1.0
 */
function monarch_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'monarch_post_format_header' ) ) :
/**
 * Display an optional post format.
 *
 * @since Monarch 1.0
 */
function monarch_post_format_header() {
	$format = get_post_format(); 
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<a class="post-format %2$s" href="%1$s">%2$s</a>', esc_url( get_post_format_link( $format ) ), get_post_format_string( $format ) );
	}

}
endif;

if ( ! function_exists( 'monarch_post_format_footer' ) ) :
/**
 * Display an optional post format.
 *
 * @since Monarch 1.0
 */
function monarch_post_format_footer() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
          $format = get_post_format();
	          if ( current_theme_supports( 'post-formats', $format ) ) {
	          	printf( '<li class="type %2$s"><a href="%1$s">%2$s</a></li>', esc_url( get_post_format_link( $format ) ), get_post_format_string( $format ) );
	          } 
          }

}
endif;

if ( ! function_exists( 'monarch_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Monarch 1.0
 *
 * @see get_url_in_content()
 *
 * @return string The Link format URL.
 */
function monarch_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;

if ( ! function_exists( 'monarch_read_more_link' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @since Monarch 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function monarch_read_more_link() {
	return "<span class='more-link'><a class='btn btn-primary' href='" . get_permalink() . "'>" . sprintf( esc_html__( 'Continue reading &raquo;', 'monarch' ) ) . "</a></span>";
}
add_filter( 'the_content_more_link', 'monarch_read_more_link' );
endif;

if ( ! function_exists( 'login_footer_links' ) ) :
/**
 * Modal form footer links.
 *
 * This filter is documented in wp-includes/general-template.php
 *
 * @since Monarch 1.1
 */
function login_footer_links() {
      if ( ! isset( $_GET['checkemail'] ) || ! in_array( $_GET['checkemail'], array( 'confirm', 'newpass' ) ) ) :
        if ( get_option( 'users_can_register' ) ) :
        	$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), esc_html__( 'Register', 'monarch' ) );
        	echo apply_filters( 'register', $registration_url ) . ' - ';
        endif;
        	echo '<a href="' . esc_url( wp_lostpassword_url() ) . '" title="' . esc_html__( 'Password Lost and Found', 'monarch' ) . '">' . esc_html__( 'Lost your password?', 'monarch' ) . '</a>';
      endif;
}
endif;

if ( ! function_exists( 'monarch_attachments' ) ) :
/**
 * Display an optional post attachments.
 *
 * @since Monarch 1.0
 */
function monarch_attachments() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$metadata = wp_get_attachment_metadata();
		printf( '<li class="full-size-link"><span class="sr-only">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></li>', _x( 'Full size', 'Used before full size attachment link.', 'monarch' ), esc_url( wp_get_attachment_url() ), $metadata['width'], $metadata['height'] );
	} ;
}
endif;

if ( ! function_exists( 'monarch_post_date' ) ) :
/**
 * Display post date.
 *
 * @since Monarch 1.1
 */
function monarch_post_date() {
	echo get_the_date( 'j M' );
	printf('<br>');
	echo get_the_date( 'H:i' );
}
endif;