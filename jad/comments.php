<?php
	if (post_password_required()) {
		echo '<p class="nocomments">' . __('This post is password protected. Enter the password to view comments.', SG_TDN) . '</p>';
		return;
	}
?>
<div class="ef-col alignnone">
<?php if (have_comments()){ ?>
	<h4><?php comments_number(__('No Comment', SG_TDN), __('This Post Has One Comment:', SG_TDN), __('This Post Has % Comments:', SG_TDN));?></h4>
	<ul class="comments-list">
		<?php wp_list_comments(array('callback' => 'sg_comment')); ?>
	</ul>
	<?php sg_comments_navigation(); ?>
<?php } ?>
<?php sg_comment_form(); ?>
</div>