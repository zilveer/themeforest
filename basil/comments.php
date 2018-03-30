<?php

$show_comments = true;

$disable_post_comments = ot_get_option('to_disable_post_comments','no');
$disable_post_comments = ($disable_post_comments == 'yes' ? true : false);

$disable_page_comments = ot_get_option('to_disable_page_comments','no');
$disable_page_comments = ($disable_page_comments == 'yes' ? true : false);

if (is_single() && $disable_post_comments && 'post' == get_post_type()) {
	$show_comments = false;
}

if (is_page() && $disable_page_comments) {
	$show_comments = false;
}

if ( comments_open() || have_comments() ) :

	// If $show_comments
	if ($show_comments){
				
		if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
			die (__('Please do not load this page directly. Thanks!','basil'));
		
		if ( post_password_required() ) {
			_e('This post is password protected. Enter the password to view comments.','basil');
			return;
		}
		
		if ( have_comments() ) : ?>
			
			<div id="comments-list">
				<h2 id="comments"><span><?php comments_number(__('No comments','basil'),__('1 comment','basil'),'% '.__('comments','basil')); ?></span></h2>
			
				<div class="navigation">
					<div class="next-posts"><?php previous_comments_link() ?></div>
					<div class="prev-posts"><?php next_comments_link() ?></div>
				</div>
			
				<ol class="commentlist">
					<?php wp_list_comments(); ?>
				</ol>
			
				<div class="navigation">
					<div class="next-posts"><?php previous_comments_link() ?></div>
					<div class="prev-posts"><?php next_comments_link() ?></div>
				</div>
			</div>
			
		 <?php else : // this is displayed if there are no comments so far ?>
		
			<?php if ( comments_open() ) : ?>
				<!-- If comments are open, but there are no comments. -->
		
			 <?php else : // comments are closed ?>
				<p class="closed-comments"><?php _e('Comments are closed.','basil'); ?></p>
		
			<?php endif; ?>
			
		<?php endif; ?>
		
		<?php if ( comments_open() ) :
				
			$comment_field = '<p><label for="comment">'.__('Your Comment','basil').' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
			comment_form(array('title_reply'=>'<h2>'.__('Comments','basil').'</h2>','comment_field'=>$comment_field));
			
		endif;
	
	}

endif;