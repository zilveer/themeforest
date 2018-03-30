<?php
/**
 * Comment function
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_comment' ) ) {
	/**
	 * Basic Comments function
	 *
	 * @param object $comment
	 * @param array $args
	 * @param int $depth
	 * @return void
	 */
	function wolf_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :

		case 'pingback' :

		case 'trackback' :
			// Display trackbacks differently than normal comments. ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<p><?php _e( 'Pingback:', 'wolf' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'wolf' ), '<span class="ping-meta"><span class="edit-link">', '</span></span>' ); ?></p>
			<?php
					break;

		default :
				// Proceed with normal comments.
			?>
			<li id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 80 ); ?>
					</div><!-- .comment-author -->

					<header class="comment-meta">
						<cite class="fn"><?php comment_author_link(); ?></cite>
							<?php printf( __( '%s ago', 'wolf' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
							<?php edit_comment_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '<span>' );
						?>
					</header><!-- .comment-meta -->

					<div class="comment-content">
						<?php if ( '0' == $comment->comment_approved ) { ?>
							<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wolf' ); ?></p>
						<?php } ?>
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'wolf' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
				</article><!-- #comment-## -->
			<?php
				break;
			endswitch; // End comment_type check.
	}
} // ends check for wolf_comment()