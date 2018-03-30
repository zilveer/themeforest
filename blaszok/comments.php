<?php
/**
 * The Comments base for MPC Themes
 *
 * Displays comments for posts and pages.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */
?>

<?php if (post_password_required())
	return;
?>

<?php if (have_comments()) : ?>
	<div id="mpcth_comments_wrap">
		<h4 class="mpcth-comments-title">
			<span class="mpcth-color-main-border">
				<?php echo comments_number(__('0 comments', 'mpcth'), __('1 comment', 'mpcth') , __('% comments', 'mpcth')); ?>
			</span>
		</h4>

		<ul id="mpcth_comments_list">
			<?php
				wp_list_comments(array(
					'callback'		=> 'mpcth_single_comment_template',
					'short_ping'	=> true,
					'avatar_size'	=> 60
				));
			?>
		</ul>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { ?>
			<nav class="mpcth-comments-navigation" role="navigation">
				<div class="mpcth-previous"><?php previous_comments_link(__('Older Comments', 'mpcth')); ?></div>
				<div class="mpcth-next"><?php next_comments_link(__('Newer Comments', 'mpcth')); ?></div>
			</nav>
		<?php } ?>
		<?php if (! comments_open() && get_comments_number()) { ?>
			<p class="mpcth-no-comments"><?php _e('Comments are closed.' , 'mpcth'); ?></p>
		<?php } ?>
	</div>
<?php endif; ?>

	<?php
		$field_name 	= __('NAME', 'mpcth');
		$field_email 	= __('EMAIL', 'mpcth');
		$field_url 		= __('WEBSITE', 'mpcth');
		$field_comment 	= __('MESSAGE', 'mpcth');

		$fields =  array(
			'author' => '<p class="comment-form-author"><input id="mpcth_comment_form_author" name="author" type="text" value="' . $field_name .  '*" size="30"' . ($req ? ' aria-required="true" ' : '') . 'onfocus="if(this.value==\''. $field_name .'*\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''. $field_name .'*\';"/><label class="mpcth-color-main-color" for="mpcth_comment_form_author">' . $field_name . '</label></p>',
			'email' => '<p class="comment-form-email"><input id="mpcth_comment_form_mail" name="email" type="text" value="' . $field_email . '*" size="30"' . ($req ? ' aria-required="true" ' : '') . 'onfocus="if(this.value==\''. $field_email .'*\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''. $field_email .'*\';"/><label class="mpcth-color-main-color" for="mpcth_comment_form_mail">' . $field_email . '</label></p>',
			'url' => '<p class="comment-form-url"><input id="mpcth_comment_form_url" name="url" type="text" value="' . $field_url . '" size="30" onfocus="if(this.value==\''. $field_url .'\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''. $field_url .'\';"/><label class="mpcth-color-main-color" for="mpcth_comment_form_url">' . $field_url . '</label></p>'
		);

		$defaults = array(
			'fields' 			=> apply_filters('comment_form_default_fields', $fields),
			'id_form' 			=> 'mpcth_comment_form',
			'id_submit' 		=> 'mpcth_comment_submit',
			'title_reply' 		=> __('Leave a Reply', 'mpcth'),
			'title_reply_to' 	=> __('Leave a Reply to %s', 'mpcth'),
			'cancel_reply_link' => __('- Cancel Reply', 'mpcth'),
			'label_submit' 		=> __('Leave a Comment', 'mpcth'),
			'comment_field' 	=> '<p class="comment-form-comment"><textarea id="mpcth_comment_form_message" name="comment" cols="45" rows="6" aria-required="true" onfocus="if(this.value==\''.$field_comment.'\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''. $field_comment .'\';">' . $field_comment . '</textarea><label class="mpcth-color-main-color" for="mpcth_comment_form_message">' . $field_comment . '</label>'
		);

		comment_form($defaults);
	?>