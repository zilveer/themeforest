<?php
/**
 * Tempalte for custom comments
 *
 * @package Organique
 */


/**
 * Custom template
 */
function organique_comment( $comment, $args, $depth ) {
	// $GLOBALS['comment'] = $comment;
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>

	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( array( 'clearfix', empty( $args['has_children'] ) ? '' : 'parent' ) ); ?>>
		<div class="avatar-container">
			<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
		<div class="comment-content">
			<div class="comment-inner">
				<cite class="comment-author vcard">
					<?php echo lighted_title( get_comment_author_link() ); ?>
				</cite>
				<div class="comment-metadata">
					<time datetime="<?php comment_time( 'c' ); ?>">
					 	<?php printf( _x( '%1$s at %2$s', '1: date, 2: time' , 'organique_wp' ), get_comment_date(), get_comment_time() ); ?>
					</time>
					<?php comment_reply_link( array_merge( $args, array(
						'depth' => $depth,
						'before' => ' / '
					) ) ); ?>
					<?php edit_comment_link( __( 'Edit' , 'organique_wp' ), ' / ' ); ?>
				</div>
				<div class="comment-text">
					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' , 'organique_wp' ); ?></p>
					<?php endif; ?>

					<?php comment_text(); ?>
				</div>
			</div>

	<?php
}


function end_organique_comment( $comment, $args ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		</div>
<?php
	if ( 'div' == $args['style'] )
		echo "</div><!-- #comment-## -->\n";
	else
		echo "</li><!-- #comment-## -->\n";
}