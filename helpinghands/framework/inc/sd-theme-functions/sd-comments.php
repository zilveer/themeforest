<?php
/**
 * Theme Custom Comments
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// Show number of comments in post excluding trackbacks/pings
if ( !function_exists( 'sd_comment_count' ) ) {
	function sd_comment_count( $count ) {
		if ( ! is_admin() ) {
			global $id;
			$get_comments = get_comments( 'status=approve&post_id=' . $id );
			$comments_by_type = separate_comments($get_comments);
			return count( $comments_by_type['comment'] );
		} else {
		return $count;
		}
	}
	add_filter( 'get_comments_number', 'sd_comment_count', 0 );
}
	
// Add nofollow to reply links
if ( !function_exists( 'sd_reply_link_nofollow' ) ) {
	function sd_reply_link_nofollow( $link ) {
	global $user_ID;

	// Registration required login link is already nofollowed
	if ( get_option( 'comment_registration' ) && ! $user_ID )
		return $link;
	// Add nofollow otherwise
	else
		return str_replace( '")\'>', '")\' rel=\'nofollow\'>', $link );
	}
	add_filter( 'comment_reply_link', 'sd_reply_link_nofollow' );
}

// Custom Comments Callback

if ( !function_exists( 'sd_custom_comments' ) ) {
	function sd_custom_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="sd-comment-body clearfix">
		<div class="sd-author-avatar"> <?php echo get_avatar( $comment,$size=$args['avatar_size'] ); ?> </div>
		<div class="sd-comment-text">
			<div class="sd-comment-author">
				<cite><?php echo get_comment_author_link(); ?></cite>
				<span class="sd-comment-meta"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'sd-framework' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
				<span class="sd-comment-date"><?php echo get_comment_date( get_option( 'date_format' ) );?></span>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
			<em>
			<?php _e( 'You comment awaits moderation.', 'sd-framework' ) ?>
			</em>
			<?php endif; ?>
			<div class="sd-comment-meta sd-comment-meta-data"> <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"></a>
				<?php edit_comment_link( __( '(Edit)', 'sd-framework'),'&nbsp;&nbsp;','' ) ?>
			</div>
			<div class="sd-text-of-comment">
				<?php comment_text(); ?>
			</div>
			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'REPLY', 'sd-framework' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	</div>
	<?php // Do not include the </li> tag.
	}
}
// Trackback and pings callback
if ( !function_exists( 'list_pings' ) ) {
	function list_pings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
?>
<li id="comment-<?php comment_ID(); ?>">
	<?php comment_author_link(); ?>
<?php } 
}
?>