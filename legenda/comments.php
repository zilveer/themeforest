<?php 
	// Prevent the direct loading
	
	if(!empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php') {
		die(__('You cannot access this file', ETHEME_DOMAIN));
	}

	// Check if post is pwd protected

	if(post_password_required()){
		?>
			<p><?php _e('This post is password protected. Enter the password to view the comments.', ETHENE_DOMAIN); ?></p>
		<?php
		return;
	}
	
	if(have_comments()) :?>
	
		<h4 class="comments-title"><?php comments_number(__('No Comments', ETHEME_DOMAIN), __('One Comment', ETHEME_DOMAIN), __('% Comments', ETHEME_DOMAIN)); ?></h4>

		<ol class="commentslist">
			<?php wp_list_comments('callback=etheme_comments'); ?>
		</ol>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
			
			<div class="comments-nav">
				<div class="left"><?php previous_comments_link(__('&larr; Older Comments', ETHEME_DOMAIN)); ?></div>
				<div class="right"><?php next_comments_link(__('Newer Comments &rarr;', ETHEME_DOMAIN)); ?></div>
				<div class="clear"></div>
			</div>

		<?php endif ?>

	<?php elseif(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
		
		<p><?php _e('Comments are closed', ETHEME_DOMAIN) ?></p>

	<?php 
	endif;

	// Display Comment Form
	comment_form();
?>