<?php

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

?>		
		<?php if (have_comments()) : ?>
			<div class="clear"></div>
			<h3><?php comments_number("", __("One Response To ", "alive") . get_the_title() , __("% Responses To " , "alive") . get_the_title()); ?></h3>

			<ul class="commentList">
			<?php wp_list_comments('callback=custom_comments'); ?>
			</ul>
			
			<h4><?php if(!comments_open()): _e("Comments are closed.","alive"); endif; ?></h4>
			<?php endif; ?>
			
			<div class="clear"></div>
			<?php if(comments_open()): ?>
			<h3><?php _e("Leave a comment", "alive"); ?></h3>

			<?php if ('open' == $post->comment_status) : ?>
			
			<div class="cancel-comment-reply">
				<p><?php $cancel_comment = cancel_comment_reply_link(); ?></p>
			</div>
			
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p><?php _e("You must be", "alive"); ?> <a href="<?php echo home_url(); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e("logged in", "alive"); ?></a> <?php _e("to post a comment", "alive"); ?></p>
			<?php else : ?>
			
			<div id="commentForm" class="commentForm">
				<form name="themeCommentForm" id="themeCommentForm" action="<?php echo home_url(); ?>/wp-comments-post.php" method="post">
					<?php if ( $user_ID ) : ?>
					<p><?php _e("Logged in as", "alive"); ?> <a href="<?php echo home_url(); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e("Log out", "alive"); ?> &raquo;</a></p>
					<p class="form">
						<textarea  class="tarea" rows="8" name="comment" id="blogComment" cols="0"><?php _e("Comment", "alive"); ?>*</textarea><br />
					</p>
					<input type="submit" value="SEND" name="submit" class="button medium <?php echo of_get_option('blog_button_color'); ?> alignRight" id="submitComment" />
					<?php comment_id_fields(); ?>
					<?php do_action('comment_form', $post->ID); ?>
					 
					<?php else : ?>
			
					<p class="form left" >
						<input class="field" type="text" name="author" id="blogName" value="<?php _e("Name", "alive"); ?>*" />
						<input class="field" type="text" name="email" id="blogEmail" value="<?php _e("E-mail", "alive"); ?>*" />
						<input class="field" type="text" name="website" id="blogWebsite" value="<?php _e("Website", "alive"); ?>" />
					</p>
					<p class="form" >
						<textarea  class="tarea" rows="8" name="comment" id="blogComment" cols="0"><?php _e("Comment", "alive"); ?>*</textarea><br />
					</p>
					<p id="formProgress" class="formProgress">*<?php _e("required", "alive"); ?></p>
					<input type="submit" value="SEND" class="button medium <?php echo of_get_option('blog_button_color'); ?> alignRight" id="submitComment" />
					<?php comment_id_fields(); ?>
					<?php do_action('comment_form', $post->ID); ?>
					<?php endif;?>
					
				</form> 
				   
			</div>      

			<?php  endif; endif; endif; ?>