<?php
/**
 * Comment Functions
 */

/**
 * Comment List
 * 
 * Based on code from default WordPress Twenty Eleven theme
 * Trackbacks/pingbacks are shown same as comments but without avatar and without Reply link
 */
 
if ( ! function_exists( 'risen_comment_list' ) ) {

	function risen_comment_list( $comment, $args, $depth ) {

		global $post;

		$GLOBALS['comment'] = $comment;

		// is this a trackback/pingback?
		$trackback = in_array( $comment->comment_type, array( 'trackback', 'pingback' ) ) ? true : false;
		
		// don't show "Author" by comment name if certain post type
		$post_type = get_post_type( $post );
		$post_types_hide_author = array(
			'risen_multimedia' // avoid confusing with Speaker taxonomy (author of post may not be speaker)
		);
		$post_types_hide_author = apply_filters( 'risen_comments_post_types_hide_author', $post_types_hide_author );
		
		?>

		<li <?php comment_class( 'comment-item' ); ?> id="li-comment-<?php comment_ID(); ?>">

			<article id="comment-<?php comment_ID(); ?>">

				<footer class="comment-meta box">

					<?php
					$avatar_img = get_avatar( $comment, 80 );
					if ( $avatar_img ) : // 40x40 (doubled to 80 for HiDPI/Retina); don't show for trackback/pingback
					?>
					<div class="comment-avatar">
						<?php echo $avatar_img ?>
					</div>
					<?php endif; ?>

					<div class="comment-buttons">
						
						<?php
						if ( ! $trackback ) { // no reply button for trackbacks/pingbacks
							comment_reply_link( array_merge( $args, array(
								'reply_text' => __( 'Reply', 'risen' ),
								'login_text' => __( 'Log in to Reply', 'risen' ),
								'depth' => $depth,
								'max_depth' => $args['max_depth']
							) ) );
						}
						?>
						
						<?php edit_comment_link( __( 'Edit', 'risen' ) ); ?>

					</div>

					<div class="<?php echo ( $trackback ? 'comment-trackback-link' : 'comment-author' ); // use appopriate class for type of comment or trackback/pingback ?> ">
						<?php comment_author_link(); ?>
						<span><?php
						if ( $trackback ) { // show "Trackback" or "Pingback" after link
							if ( $comment->comment_type == 'trackback' ) {
								_e( 'Trackback', 'risen' );
							} else if ( $comment->comment_type == 'pingback' ) {
								_e( 'Pingback', 'risen' );
							}
						} else if ( $post = get_post( $comment->comment_post_ID ) ) { // show "Author" after name if post author
							if ( $comment->user_id === $post->post_author && ! in_array( $post_type, $post_types_hide_author ) ) {
								_e( 'Author', 'risen' );
							}
						}
						?></span>
					</div>

					<?php
					printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s<span class="hide-on-small-screen"> at %4$s</span></time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ), // comment link
						get_comment_time( 'c' ), // datetime attribute
						get_comment_date(), // human friendly date
						get_comment_time() // human friendly time
					);
					?>

				</footer>

				<div class="clear"></div>

				<div class="comment-content">

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="comment-moderation"><?php _e( 'Your comment is awaiting moderation.', 'risen' ); ?></p>
					<?php endif; ?>

					<?php comment_text(); ?>

				</div>

			</article>

		<?php
		
		// </li> will be auto-closed

	}

}