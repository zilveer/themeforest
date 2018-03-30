<?php

/*------------------------------------------------------------
 * Custom Comments Callback
 *------------------------------------------------------------*/

function sleek_comments($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}

?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>



		<div class="comment__image">
			<?php echo get_avatar( $comment, 100 ); ?>
		</div>



		<div class="comment__content">

			<div class="comment__author">
				<?php printf(__('<div class="author">%s</div>', 'sleek'), get_comment_author_link()) ?>
			</div>

			<?php
				echo '<div class="comment__date">';
					comment_date();
					echo ' ';
					comment_time();
				echo '</div>';
			?>

			<?php if ($comment->comment_approved == '0') : ?>
				<div class="comment__moderated"><?php _e('Your comment is awaiting moderation.','sleek') ?></div>
			<?php endif; ?>

			<div class="comment__text">
				<?php comment_text();?>
			</div>

		</div>

		<div class="comment__links">
			<?php edit_comment_link(__('Edit Comment','sleek'),'  ','' );	?>
			<?php comment_reply_link( array_merge( $args, array(
				'add_below' => $add_below,
				'depth' => $depth,
				'max_depth' => $args['max_depth'],
				'reply_text' => __('Reply', 'sleek'),
				'login_text' => __('Log in to leave a comment', 'sleek'),
			))); ?>
		</div>



	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>

<?php }