<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

<?php if (have_comments()): ?>

	<!-- Comments -->
	<ul id="comments">
		<?php wp_list_comments(array('walker' => new Fastblog_Walker_Comment)); ?>
	</ul>
	<!-- // Comments -->

	<!-- Comments navigation -->
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link(); ?></div>
		<div class="alignright"><?php next_comments_link(); ?></div>
		<div class="clear"></div>
	</div>
	<!-- // Comments navigation -->

<?php endif; ?>

<?php if (comments_open()): // todo: do poprawy na nowy kod formy, spr. od ktorej wersji WP ?>

	<!-- Comment form -->
	<div id="respond">
		<p class="msg">
			<strong>
				<?php comment_form_title(__('Leave a comment', 'fastblog'), __('Leave a reply to %s', 'fastblog'), false); ?>
			</strong>
			<?php cancel_comment_reply_link('('.__('cancel', 'fastblog').')'); ?> &nbsp;
			<?php if (is_user_logged_in()): ?>
				<?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'fastblog'), get_option('siteurl').'/wp-admin/profile.php', $user_identity); ?>
				<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'fastblog'); ?>"><?php _e('Log out &raquo;', 'fastblog'); ?></a>
			<?php elseif (get_option('comment_registration')): ?>
				<?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'fastblog'), wp_login_url(get_permalink())); ?>
			<?php endif; ?>
		</p>
		<?php if ((!get_option('comment_registration')) || is_user_logged_in()) : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
				<?php if (!is_user_logged_in()): ?>
					<p class="input"><input type="text" name="author" value="<?php echo esc_attr($comment_author); ?>" /><?php _e('name', 'fastblog'); if ($req) echo '*'; ?></p>
					<p class="input"><input type="text" name="email" value="<?php echo esc_attr($comment_author_email); ?>" /><?php _e('email', 'fastblog'); if ($req) echo '*'; ?></p>
					<p class="input"><input type="text" name="url" value="<?php echo esc_attr($comment_author_url); ?>" /><?php _e('website', 'fastblog'); ?></p>
				<?php endif; ?>
				<p class="textarea"><textarea name="comment" rows="5" cols="15"></textarea></p>
				<p class="submit"><a title="<?php _e('Submit comment', 'fastblog'); ?>"><?php _e('Submit comment', 'fastblog'); ?></a></p>
				<div><?php comment_id_fields(); ?></div>
				<?php do_action('comment_form', get_the_ID()); ?>
			</form>
		<?php endif; ?>
	</div>
	<!-- // Comment form -->

<?php endif; ?>