<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

<!-- Comment -->
<li id="comment-<?php comment_ID(); ?>" class="comment">
	<div class="content level-<?php echo min($depth, 5); ?>">
		<?php if (!$comment->comment_approved): ?>
			<p><em><?php _e('Your comment is awaiting moderation.', 'fastblog'); ?></em></p>
		<?php endif; ?>
		<?php comment_text(); ?>
		<div class="tools">
			<?php
				$comment_reply_args = array(
					'reply_text' => __('reply', 'fastblog'),
					'depth'      => $depth
				);
				comment_reply_link(array_merge($args, $comment_reply_args));
				edit_comment_link(__('edit', 'fastblog'), $depth < $args['max_depth'] ? ' | ' : '');
			?>
		</div>
	</div>
	<div class="meta">
		<?php echo get_avatar($comment, 32, get_option('avatar_default') == 'mystery' ? get_template_directory_uri().'/schemes/'.fastblog_get_option('scheme').'/images/avatar.png' : ''); ?>
		<div>
			<p><?php comment_author_link(); ?></p>
			<p><?php if (get_comment_date('Y.m.d') == date('Y.m.d')) comment_time(); else comment_date(); ?></p>
		</div>
	</div>
	<div class="clear"></div>
</li>
<!-- // Comment -->