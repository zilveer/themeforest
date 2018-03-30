<br class="clear"/>

<?php if ('open' == $post->comment_status) : ?>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p><br/>
	<?php else : ?>

					<!-- Start of form --> 
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment_form"> 
					<fieldset> 

			
			
						<h2 class="widgettitle">Leave a Reply</h2>
						
						<?php if ( is_user_logged_in() ) : ?>
						

			<?php else : ?>
						<p style="margin-top:20px"> 
							<input class="round m input" name="author" type="text" id="author" value="" tabindex="1" style="width:97%" title="Name*" /> 
						</p> 
						<p style="margin-top:20px"> 
							<input class="round m input" name="email" type="text" id="email" value="" tabindex="2" style="width:97%" title="Email*" /> 
						</p> 
						<p style="margin-top:20px"> 
							<input class="round m input" name="url" type="text" id="url" value="" tabindex="3" style="width:97%" title="Website" /> 
						</p> 

			<?php endif; ?>
						
						<p style="margin-top:20px"> 
							<textarea name="comment" cols="40" rows="7" id="comment" tabindex="4" style="width:97%" title="Message*"></textarea> 
						</p> 
						<p style="margin-top:20px"> 
							<input name="submit" type="submit" id="submit" value="submit" tabindex="5" />&nbsp;
							<?php cancel_comment_reply_link("Cancel Reply"); ?> 
						</p> 
						<?php comment_id_fields(); ?> 
						<?php do_action('comment_form', $post->ID); ?>

					</fieldset> 
					</form> 
					<!-- End of form --> 
			

	<?php endif; // If registration required and not logged in ?>

<?php endif; // if comment is open ?>
