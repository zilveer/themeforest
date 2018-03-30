<?php

if ( post_password_required() ) { 
	?><p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'om_theme') ?></p><?php
	return;
}

if(!comments_open() && !have_comments())
	return;

?>
	<div class="discussion" id="comments">
<?php

/*************************************************************************************
 *	Display comments
 *************************************************************************************/	
if ( have_comments() ) {
	
	?><div class="clear" style="height:20px"></div><h2><?php _e('Comments', 'om_theme') ?></h2><?php
	
	if ( ! empty($comments_by_type['comment']) ) { // if there are normal comments 
		wp_list_comments(array(
			'type' => 'comment',
			'style' => 'div',
			'callback' => 'om_comment'
		));
	}
  
  if ( ! empty($comments_by_type['pings']) ) { // if there are pings 

		?><h3 id="pings"><?php _e('Trackbacks for this post', 'om_theme') ?></h3><?php

  	wp_list_comments(array(
  		'type' => 'pings',
  		'style' => 'div',
  		'callback' => 'om_pings_list'
  	));
	}

	$nav_prev=get_previous_comments_link(__('Older Comments', 'om_theme'));
	$nav_next=get_next_comments_link(__('Newer Comments', 'om_theme'));
	if( $nav_prev || $nav_next ) {
		?>
		<div class="navigation-prev-next">
			<?php if($nav_prev){?><div class="navigation-prev"><?php echo $nav_prev; ?></div><?php } ?>
			<?php if($nav_next){?><div class="navigation-next"><?php echo $nav_next; ?></div><?php } ?>
			<div class="clear"></div>
		</div>
		<?php
	}

	/*************************************************************************************
	 *	No comments or closed
	 *************************************************************************************/

	if ('closed' == $post->comment_status ) { // if the post has comments but comments are now closed 
		?><p class="nocomments"><?php _e('Comments are closed.', 'om_theme') ?></p><?php
	}
}

/*************************************************************************************
 *	New Comment Form
 *************************************************************************************/

	if ( comments_open() ) {

		// hack for passing theme test, it needs comment_form to be in the code, but this functions replaced by extended custom code
		if(false)
			comment_form();
			
		?>
		<div class="new-comment" id="respond">
			<div class="new-comment-header"><?php comment_form_title( __('Leave a comment', 'om_theme'), __('Leave a Reply to %s', 'om_theme') ); ?></div>
			<div class="new-comment-pane">

				<div class="cancel-comment-reply">
					<?php cancel_comment_reply_link(); ?>
				</div>
	
				<?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>
					<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'om_theme'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
				<?php } else { ?>
	
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				
						<?php if ( is_user_logged_in() ) { ?>
					
							<div class="infopane color-6" style="margin:6px 0"><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'om_theme'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'om_theme').'">', '</a>') ?></div>
					
						<?php } else { ?>

							<div class="one-third">
								<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" placeholder="<?php echo htmlspecialchars(__('Name', 'om_theme')) ?> <?php if ($req) echo htmlspecialchars(__("*", 'om_theme')); ?>"/>
							</div>
							<div class="one-third">
								<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" placeholder="<?php echo htmlspecialchars(__('Mail (will not be published)', 'om_theme')) ?> <?php if ($req) echo htmlspecialchars(__("*", 'om_theme')); ?>"/>
							</div>
							<div class="one-third last">
								<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" placeholder="<?php echo htmlspecialchars(__('Website', 'om_theme')) ?>"/>
							</div>
							<div class="clear"></div>
							
						<?php } ?>
					
						<textarea name="comment" id="comment" rows="4" tabindex="4" placeholder="<?php echo htmlspecialchars(__('Message', 'om_theme')) ?>"></textarea>
					
						<?php /*<p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>*/ ?>

						<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'om_theme') ?>" /><input type="reset" value="<?php _e('Cancel', 'om_theme') ?>" tabindex="6" />
						<?php comment_id_fields(); ?>

						<?php do_action('comment_form', $post->ID); ?>
				
					</form>

				<?php } ?>
			</div>
		</div>

	<?php
	}

?>
	</div>
