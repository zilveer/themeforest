<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'shorti') ?></p>
	<?php
		return;
	}

/* Comments */

		if ( have_comments() ) : // if there are comments ?>
        
        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
		
		<h4 id="comments_title">
			<?php comments_number(__('No Comments', 'shorti'), __('One Comment', 'shorti'), __('% Comments', 'shorti')); ?>
            <span><?php echo stripslashes(get_option('si_comment_caption')); ?></span>
        </h4>
		
		<ol class="commentlist">
        <?php wp_list_comments('type=comment&avatar_size=40&callback=si_comment'); ?>
        </ol>

        <?php endif; ?>

        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
		<h4 id="pings"><?php _e('Trackbacks for this post', 'shorti') ?></h4>
		
		<ol class="pinglist">
        <?php wp_list_comments('type=pings&callback=si_list_pings'); ?>
        </ol>

        <?php endif; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		
		<?php if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		
		<p class="nocomments"><?php _e('Comments are now closed for this article.', 'shorti') ?></p>
		
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php _e('Comments are closed.', 'shorti') ?></p><?php } ?>

        <?php endif; ?>
        
<?php endif;


/* Form */

	if ( comments_open() ) : ?>

	<div id="respond">
		
		<h4 id="respond_title">
			<?php comment_form_title( __('Leave a Comment', 'shorti'), __('Leave a Comment to %s', 'shorti') ); ?>
            <span><?php echo stripslashes(get_option('si_respond_caption')); ?></span>
        </h4>
	
		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>
	
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'shorti'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
		<?php else : ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	
			<?php if ( is_user_logged_in() ) : ?>
		
			<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'shorti'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'shorti').'">', '</a>') ?></p>
		
			<?php else : ?>
		
			<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" />
			<label for="author"><?php _e('Name', 'shorti') ?> <small><?php if ($req) _e("*", 'shorti'); ?></small></label></p>
		
			<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" />
			<label for="email"><?php _e('Email', 'shorti') ?> <small><?php if ($req) _e("*", 'shorti'); ?></small> <span><?php _e('(never published)', 'shorti') ?></span></label></p>
		
			<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
			<label for="url"><?php _e('Website', 'shorti') ?></label></p>
		
			<?php endif; ?>
		
			<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
			
			<!--<p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
		
			<p><button name="submit" type="submit" id="submit" class="btn" tabindex="5"><?php _e('Submit Comment', 'shorti') ?></button>
			<?php comment_id_fields(); ?>
			</p>
			<?php do_action('comment_form', $post->ID); ?>
	
		</form>

	<?php endif; ?>
	</div>

	<?php endif; ?>
