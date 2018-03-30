<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) { ?>
	<div id="comments"> 
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'agera'); ?></p>
	</div>
	<?php 
	return;
} ?>
 
<div id="comments"> 
<?php if ( have_comments() ) : ?>
	<h2 id="response_number"><?php comments_number('No Comments', '1 Comment', '% Comments' );?></h2>
	<ol class="commentlist">
		<?php wp_list_comments('callback=comments_all'); ?>
	</ol>
 
	<div class="mpc-comments-nav">
		<div class="mpc-prev-comments"><?php previous_comments_link() ?></div>
		<div class="mpc-next-comments"><?php next_comments_link() ?></div>
		<div class="clear"></div>
	</div>
	
	<?php else : // this is displayed if there are no comments so far ?>
		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. --> 
		<?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<!-- <p class="nocomments">Comments are closed.</p> -->
</div>
	<?php endif; ?>
<?php endif; ?>
	  
	<div id="respond">
	
		<?php
		
		$fields = array(
					'author' => '<div class="comment-from-who"><p class="contact-name"><input type="text" name="author" id="author" value="Name *" size="22" tabindex="1" aria-required="true" class="author_c required" onfocus="if(this.value==\'Name *\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'Name *\';"/></p>',
					'email' => '<p class="contact-email"><input type="text" name="email" id="email" value="Email *" size="22" tabindex="2" aria-required="true" class="email_f required" onfocus="if(this.value==\'Email *\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'Email *\';"/></p>',
					'url' => '<p><input type="text" name="url" id="url" value="Website" size="22" tabindex="3" class="website_f" onfocus="if(this.value==\'Website\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'Website\';"/></p></div>'
			);
			
			$defaults = array(
				'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
				'id_form'              => 'commentform',
				'id_submit'            => 'submit',
				'title_reply'          => __( 'Leave a Comment', 'appview' ),
				'title_reply_to'       => __( 'Leave a Reply to %s', 'appview' ),
				'cancel_reply_link'    => __( '- cancel reply', 'appview' ),
				'label_submit'         => __( 'Post Comment', 'appview' ),
				'comment_field' 	   => '<p class="comment-textarea"><textarea name="comment" id="comment" cols="1" rows="1" tabindex="4" class="comments_form text_f required" onfocus="if(this.value==\'Message *\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'Message *\';">Message *</textarea></p>'
			);
			
		comment_form($defaults);

		?>
	 </div><!-- #respond --> 
</div> 