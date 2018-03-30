<?php
function obox_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar($comment, $size = '60'); ?>
			</div>

			<div class="comment-meta commentmetadata">
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Your comment is awaiting moderation.', 'ocmx') ?></em>
					<br />
				<?php endif; ?>
				<?php printf(__('<cite class="fn">%s</cite>', 'ocmx'), get_comment_author_link()) ?>
				<a class="date" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'ocmx'), get_comment_date(),  get_comment_time()) ?></a>
				<?php edit_comment_link(__('(Edit)', 'ocmx'),'  ','') ?>
				<?php comment_text() ?>
			</div>

			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
	</li>
<?php
}