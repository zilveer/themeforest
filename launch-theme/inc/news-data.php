	<!-- dark div to server as popup background-->
	<div id="dark"></div>
	
	<!-- NEWS POSTS DATA -->
	<div id="news-data">
		<?php 		
		$wp_query->rewind_posts();
										
		if (have_posts()) : 
			while (have_posts()) : 
				the_post(); 
				?>
				<div <?php post_class('clearfix'); ?>>
				
					<a class="close" href="#"></a>					
					
					<h2 class="post-title"><?php the_title(); ?></h2>
					
					<div class="date-comments">
						<span class="date"><?php _e('Date:','framework'); ?> <span><?php the_time('F j, Y'); ?></span></span>
					</div><!-- date-commetns -->
					
					<?php the_content(); ?>					
					<div class="bottom-border clearfix"></div>
					
					
					
					<?php
					// Display any comments rleated to current post
					$args = array(
						'status' => 'approve',
						'post_id' => $post->ID
					);
					
					$comments = get_comments($args);
					$comments_count = count($comments);
					if($comments_count > 0)
					{
						?>
						<h3 class="comments-title"><?php comments_number( __('No Comments','framework'), __('One Comment','framework'), __('% Comments','framework') );?></h3>
						<div class="comments-list">
						<?php						
						foreach($comments as $comment) :
							?>
							<div class="post-comment clearfix">
								<a href="<?php echo $comment->comment_author_url; ?>">
				    				<?php echo get_avatar($comment->comment_author_email,50); ?>
								</a>
								<h5 class="comment-meta"><?php _e('posted by','framework'); ?> <a href="<?php echo $comment->comment_author_url; ?>"><?php echo $comment->comment_author; ?></a> <?php _e('on','framework'); ?> <span><?php echo date( 'F j, Y', strtotime($comment->comment_date)); ?></span></h5>
								<div class="comment-data">					    			
					    			<?php echo $comment->comment_content ?> 
					    		</div>
							</div>
							<?php
						endforeach;
						?>
						</div>
						<?php
					}
					
					
					
					// Display Comment Form
					if ( comments_open($post->ID) ) : 
					?>
					<div class="respond">
					
							<h3 class="respond-title"><?php comment_form_title( 'Leave a Comment', 'Leave a Reply to %s' ); ?></h3>														
							
							<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
								
								<p><?php _e('You must be','framework'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in','framework'); ?></a> <?php _e('to post a comment.','framework'); ?></p>
								<?php else : ?>
							
								<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="commentform">
								
									<?php 
									if ( is_user_logged_in() ) : 
									
										global $current_user;
										get_currentuserinfo();
									?>
								
									<p><?php _e('Logged in as','framework'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $current_user->display_name; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','framework'); ?>"><?php _e('Log out &raquo;','framework'); ?></a></p>			
					
									<?php else : ?>			
										<p><input type="text" name="author" id="author-<?php echo $post->ID; ?>" value="" size="22" tabindex="1"/><label for="author-<?php echo $post->ID; ?>"><?php _e('Name*','framework'); ?></label></p>				
										<p><input type="text" name="email" id="email-<?php echo $post->ID; ?>" value="" size="22" tabindex="2" /><label for="email-<?php echo $post->ID; ?>"><?php _e('Mail*','framework'); ?></label></p>				
										<p><input type="text" name="url" id="url-<?php echo $post->ID; ?>" value="" size="22" tabindex="3" /><label for="url-<?php echo $post->ID; ?>"><?php _e('Website','framework'); ?></label></p>			
									<?php endif; ?>								
									<p>
										<textarea name="comment" id="comment-<?php echo $post->ID; ?>" cols="70" rows="8" tabindex="4"></textarea>
									</p>
								
									<p>
										<input name="submit" type="submit" class="submit" tabindex="5" value="<?php _e('Submit Comment','framework'); ?>" />
										<input type="hidden" value="<?php echo $post->ID; ?>" name="comment_post_ID" />
									</p>
									
									<?php do_action('comment_form', $post->ID); ?>
												
								</form>
							
							<?php endif; // If registration required and not logged in ?>							
					</div>					
					<?php 
					endif; 
					?>																		
				</div><!-- end of .post -->
				<?php
			endwhile;
		endif; 
		?>		
	</div>	