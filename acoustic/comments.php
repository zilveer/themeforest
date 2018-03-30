<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'ci_theme'));
	if ( post_password_required() ) {
		echo '<p class="nocomments">' . _e('This post is password protected. Enter the password to view comments.', 'ci_theme') . '</p>';
		return;
	}
?>

<?php if (have_comments()): ?>
	<div class="row post-comments">
		<div class="twelve columns">
			<h2 class="section-title"><?php comments_number(__('No comments', 'ci_theme'), __('1 comment', 'ci_theme'), __('% comments', 'ci_theme')); ?></h2>
			<div class="comments-pagination"><?php paginate_comments_links(); ?></div>
			<ol class="pad" id="comment-list">
				<?php wp_list_comments(array(
					'callback' => 'ci_comment'
				)); ?>
			</ol>
			<div class="comments-pagination"><?php paginate_comments_links(); ?></div>
		</div><!-- .post-comments -->
	</div>
<?php endif; ?>

<?php if(comments_open()): ?>
	<div class="row" id="respond">
		<div class="twelve columns">
			<?php get_template_part('comment-form'); ?>
		</div>
	</div>
<?php endif; ?>