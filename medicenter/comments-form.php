<?php 
if(comments_open())
{
	?>
<div class="comment_form_container">
	<h3 class="box_header">
		<?php _e("Leave a reply", 'medicenter'); ?>
	</h3>
	<form class="comment_form" id="comment_form" method="post" action="">
	<?php
	if(get_option('comment_registration') && !is_user_logged_in())
	{
	?>
	<p>You must be <a href="<?php echo wp_login_url(get_permalink()); ?>">logged in</a> to post a comment.</p>
	<?php
	}
	else
	{
	?>
		<fieldset class="left">
			<label class="first"><?php echo __('Your Name', 'medicenter'); ?></label>
			<div class="block">
				<input class="text_input" name="name" type="text" value="" />
			</div>
			<label><?php echo __('Your Email', 'medicenter'); ?></label>
			<div class="block">
				<input class="text_input" name="email" type="text" value="" />
			</div>
			<label><?php echo __('Website (optional)', 'medicenter'); ?></label>
			<div class="block">
				<input class="text_input" name="website" type="text" value="" />
			</div>
		</fieldset>
		<fieldset class="right">
			<label class="first"><?php echo __('Message', 'medicenter'); ?></label>
			<div class="block">
				<textarea name="message"></textarea>
			</div>
			<input name="submit" type="submit" value="<?php _e('Send', 'medicenter'); ?>" class="more mc_button" />
			<a href="#cancel" id="cancel_comment" title="<?php _e('Cancel reply', 'medicenter'); ?>"><?php _e('Cancel reply', 'medicenter'); ?></a>
			<input type="hidden" name="action" value="theme_comment_form" />
			<input type="hidden" name="comment_parent_id" value="0" />
			<input type="hidden" name="paged" value="1" />
			<input type="hidden" name="prevent_scroll" value="0" />
		</fieldset>
	<?php
	}
	?>
		<fieldset>
			<input type="hidden" name="post_id" value="<?php echo esc_attr(get_the_ID()); ?>" />
			<input type="hidden" name="post_type" value="<?php echo $post->post_type; ?>" />
		</fieldset>
	</form>
</div>
<?php
}
?>