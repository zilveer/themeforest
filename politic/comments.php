<?php $template_directory =  get_template_directory_uri(); ?>
<?php

// Do not delete these lines or the sky will fall over your head
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'framework') ?></p>
	<?php
		return;
	}

/*-----------------------------------------------------------------------------------*/
/*	Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

	if ( have_comments() ) : // if there are comments ?>
        
    <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>


	<h2 style="margin-top: 20px; margin-bottom: 0px"><?php echo get_option('icy_comments_title'); ?></h2>

	<div class="three columns alpha commentaries-border">
		<?php if(get_option('icy_comments_message') == '') : ?>
			<?php _e('Write us your thoughts about this post. Play nice.', 'framework'); ?>
		<?php else : ?>
			<?php echo get_option('icy_comments_message'); ?>
		<?php endif; ?> 
		
	</div>

	<!-- BEGIN .list-of-comments -->	
    <div class="nine columns alpha omega commentaries-border">
        
        <!--BEGIN .list-of-comments OUTPUT -->
		<ol id="comments" class="list-of-comments">
        
        <?php wp_list_comments('type=comment&avatar_size=30&callback=icy_comment'); ?>
        
        <!--END .list-of-comments OUTPUT -->
        </ol>

        <?php endif; ?>

        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
		
		<!--START separated pings listing -->
		<h4 id="pings"><?php _e('Trackbacks for this post', 'framework') ?></h4>

		<ol class="pinglist">
        
			<?php wp_list_comments('type=pings&callback=icy_list_pings'); ?>
        
        </ol>
        <!--END separated pings listing -->
        
		
        
        <?php endif; ?>
		
		<!--BEGIN comment navigation -->
		<div class="navigation">
        
			<div class="alignright"><?php next_comments_link(); ?></div>
            <div class="alignleft"><?php previous_comments_link(); ?></div>
        
        <!--END comment navigation -->
		</div>

	<!--END .list-of-comments -->
	</div>

		<?php
		
		
/*-----------------------------------------------------------------------------------*/
/*	Dealing with no comments or closed comments
/*-----------------------------------------------------------------------------------*/
		
		if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		
		<p class="nocomments"><?php _e('Comments are closed now.', 'framework') ?></p>
		
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php _e('Comments are closed.', 'framework') ?></p><?php } ?>

        <?php endif; ?>
        
<?php endif;


/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

	if ( comments_open() ) : ?>
    
    <div class="eight columns top-margin alpha omega">

    	
	    <h2><?php comment_form_title( __('Express your thoughts', 'framework'), __('Say what you think to %s', 'framework') ); ?></h2>


		<div class="cancel-comment-reply">
        
			<?php cancel_comment_reply_link(); ?>
		
        </div>
	
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		
        <p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'framework'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
		
		<?php else : ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="eleven columns alpha omega no-bottom" id="comments-form">
	
			<?php if ( is_user_logged_in() ) : ?>
		
			<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'framework'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'framework').'">', '</a>') ?></p>
		
			<?php else : ?>
		
			<p>
			<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="20" tabindex="1" />
			<label for="author"><small><?php _e('Name', 'framework') ?> <span><?php if ($req) _e("*", 'framework'); ?></span></small></label>
			</p>
		
			<p>
			<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="20" tabindex="2" />
			<label for="email"><small><?php _e('Email', 'framework') ?><span> <?php if ($req) _e("*", 'framework'); ?></span> <span><?php _e('(never published)', 'framework'); ?></span> </small></label>
			</p>
		
			<p>
			<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="20" tabindex="3" />
			<label for="url"><small><?php _e('Website', 'framework') ?></small></label>
			</p>
		
			<?php endif; ?>
		
			<p>
			<textarea name="comment" id="comment" cols="55" rows="10" tabindex="4"></textarea>
			</p>
		
			<p class="no-bottom">
			<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'framework') ?>" />
			<?php comment_id_fields(); ?>
			</p>
			<?php do_action('comment_form', $post->ID); ?>
	
		</form>

	<?php endif; // If registration required and not logged in ?>
	</div>
	<?php endif; // if you delete this the sky will fall on your head ?>
