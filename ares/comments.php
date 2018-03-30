<div class="comment_inner">
	<?php
	if ( post_password_required() ) { ?>
		<p><?php _e( 'This post is password protected. Enter the password to view comments.', THEMEDOMAIN ); ?></p>
	<?php
		return;
	}
	
	if( have_comments() ) : ?> 
						
		<h2 class="widgettitle"><?php comments_number('No comment', '1 Comment', '% Comments'); ?></h2><br/>
	
		<?php wp_list_comments( array('callback' => 'pp_comment', 'avatar_size' => '40') ); ?>
		
		<!-- End of thread -->  
		<br class="clear"/>
	<?php endif; ?>  
	
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<div class="pagination"><p><?php previous_comments_link(); ?> <?php next_comments_link(); ?></p></div><br class="clear"/><div class="line"></div><br/><br/>
	<?php endif; // check for comment navigation ?>
	
	
	<?php if ('open' == $post->comment_status) : ?> 
	
			<div id="respond">
				<?php include(TEMPLATEPATH . '/templates/comments-form.php'); ?>
			</div>
				
	<?php endif; ?> 
	
	<br class="clear"/>
</div>