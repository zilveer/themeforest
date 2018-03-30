<?php if ('open' == $post->comment_status) : ?>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p><br/>
	<?php else : ?>

					<!-- Start of form --> 
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment_form"> 
					<fieldset> 

			
			
						<h2 class="widgettitle"><?php echo _e("Leave a Reply", THEMEDOMAIN); ?></h2>
						
						<?php if ( is_user_logged_in() ) : ?>
						

			<?php else : ?>
						<p> 
							<input class="round m input" name="author" type="text" id="author" title="<?php echo _e( 'Name', THEMEDOMAIN ); ?>*" value="" tabindex="1" style="width:50%" /> 
						</p> 
						<p> 
							<input class="round m input" name="email" type="text" id="email" title="<?php echo _e( 'Email', THEMEDOMAIN ); ?>*" value="" tabindex="2" style="width:50%" /> 
						</p> 
						<p> 
							<input class="round m input" name="url" type="text" id="url" title="<?php echo _e( 'Website', THEMEDOMAIN ); ?>" value="" tabindex="3" style="width:50%" /> 
						</p> 

			<?php endif; ?>
						
						<p> 
							<textarea name="comment" cols="40" rows="7" id="comment" tabindex="4" title="<?php echo _e( 'Message', THEMEDOMAIN ); ?>*" style="width:97%"></textarea> 
						</p> 
						<p> 
							<input name="submit" type="submit" id="submit" value="submit" tabindex="5" />&nbsp;
							<?php cancel_comment_reply_link(__( 'Cancel Reply', THEMEDOMAIN )); ?> 
						</p> 
						<?php comment_id_fields(); ?> 
						<?php do_action('comment_form', $post->ID); ?>

					</fieldset> 
					</form> 
					<!-- End of form --> 
			

	<?php endif; // If registration required and not logged in ?>

<?php endif; // if comment is open ?>