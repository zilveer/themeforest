<?php if ('open' == $post->comment_status) : ?>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p><br/>
	<?php else : ?>

					<!-- Start of form --> 
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment_form"> 
					<fieldset> 

			
			
						<h6 class="cufon"><?php esc_html_e('Leave A Reply', 'grandportfolio-translation' ); ?></h6>
						
						<?php if ( is_user_logged_in() ) : ?>

					<?php esc_html_e('Logged in as', 'grandportfolio-translation' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo esc_html($user_identity); ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a><br/><br/>

			<?php else : ?>
						<br/>
						<input class="round m input" title="<?php esc_html_e('Name (required)', 'grandportfolio-translation' ); ?>" name="author" type="text" id="author" value="" tabindex="1" style="width:96%" /> 
						<br/>
							
						<input class="round m input" title="<?php esc_html_e('Email (required)', 'grandportfolio-translation' ); ?>" name="email" type="text" id="email" value="" tabindex="2" style="width:96%" /> 
						<br/> 
							
						<input class="round m input" title="<?php esc_html_e('Website', 'grandportfolio-translation' ); ?>" name="url" type="text" id="url" value="" tabindex="3" style="width:96%" /> 
						<br/> 

			<?php endif; ?>
						
						<br/>
						<textarea name="comment" title="<?php esc_html_e('Message', 'grandportfolio-translation' ); ?>*" cols="40" rows="3" id="comment" tabindex="4" style="width:96%"></textarea> 

						<br /> 
						<p> 
							<input name="submit" type="submit" id="submit" value="<?php esc_html_e('Submit', 'grandportfolio-translation' ); ?>" tabindex="5" />&nbsp;
							<?php cancel_comment_reply_link("Cancel Reply"); ?> 
						</p> 
						<?php comment_id_fields(); ?> 
						<?php do_action('comment_form', $post->ID); ?>

					</fieldset> 
					</form> 
					<!-- End of form --> 
			

	<?php endif; // If registration required and not logged in ?>

<?php endif; // if comment is open ?>
