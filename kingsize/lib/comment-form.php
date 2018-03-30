<?php
/**
 * @KingSize 2011-2014
 * Comment Form single.php
 **/
?>
<?php if ('open' == $post->comment_status) : ?> 		

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<?php _e('<div class="blog_post"><p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p></div>', 'kslang'); ?><br/>
		
	<?php else : ?>

		<?php 
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		?>

		<!-- Leave a comment box -->
		<div id="respond" class="blog_post">
			 <h4><?php _e('Leave a reply', 'kslang'); ?></h4>

			 <div class="post_text">
				<?php
				if($req)
				{
				?>
				<p><?php _e('Fields marked with * are required', 'kslang'); ?></p>	
				<?php
				}	
				?>
			 </div>

			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment_form">

			<?php if ( is_user_logged_in() ) : ?>
				<?php _e('Logged in as', 'kslang'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out', 'kslang'); ?> &raquo;</a><br/><br/>
			<?php else : ?>
			<div class="row">
				<input type="text" class="four columns text center"  name="author" id="author" onFocus="if(this.value == '<?php _e('Name', 'kslang'); ?><?php  if($req) echo '*';?>'){this.value = '';}" onBlur="if(this.value == ''){this.value='<?php _e('Name', 'kslang'); ?><?php  if($req) echo '*';?>';}" value="<?php _e('Name', 'kslang'); ?><?php  if($req) echo '*';?>" />
			</div>
			<div class="row">
				<input type="text" class="four columns" name="email" id="email" onFocus="if(this.value == '<?php _e('E-mail', 'kslang'); ?><?php  if($req) echo '*';?>'){this.value = '';}" onBlur="if(this.value == ''){this.value='<?php _e('E-mail', 'kslang'); ?><?php  if($req) echo '*';?>';}" value="<?php _e('E-mail', 'kslang'); ?><?php  if($req) echo '*';?>">
			</div>
			<div class="row">
				 <input type="text" class="four columns" name="url" id="url" onFocus="if(this.value == '<?php _e('Website', 'kslang'); ?>'){this.value = '';}" onBlur="if(this.value == ''){this.value='<?php _e('Website', 'kslang'); ?>';}" value="<?php _e('Website', 'kslang'); ?>">
			</div>
			<?php endif; ?>
            <?php do_action( 'comment_form_after_fields' ); ?>

			<div class="row">
				 <textarea class="twelve columns" rows="6" name="comment" id="comment" onFocus="if(this.value == '<?php _e('Message', 'kslang'); ?>'){this.value = '';}" onBlur="if(this.value == ''){this.value='<?php _e('Message', 'kslang'); ?>';}" value="<?php _e('Message', 'kslang'); ?>" > </textarea>
			</div>

			<div class="row">
				<input type="submit" class="send-link" id="submit" name="submit" value="<?php _e('Post Comment', 'kslang'); ?>">&nbsp;<?php cancel_comment_reply_link("Cancel Reply"); ?> 
			</div>

			<?php comment_id_fields(); ?> 
			<?php do_action('comment_form', $post->ID); ?>
			</form>
		</div>
		<!-- Leave a comment box ends here -->	

	<?php endif; // If registration required and not logged in ?>
<?php endif; ?> 

