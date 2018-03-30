<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<?php _e('This post is password protected. Enter the password to view comments.', 'framework'); ?>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h3 id="comments"><?php comments_number(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework'));?></h3>

	<!--<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>-->

	<ol class="comment-list clearfix">
		 <?php wp_list_comments('type=comment&avatar_size=100&callback=mytheme_comment'); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p class="hidden"><?php _e('Comments are closed.', 'framework'); ?></p>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="response">

	<?php comment_form(); ?>
	
</div>

<?php endif; ?>
