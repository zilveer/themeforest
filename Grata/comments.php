<?php

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="w-comments has_form">

	<h4 class="w-comments-title"><?php comments_number('<i class="fa fa-comments"></i>'.__('No comments', 'us'), '<i class="fa fa-comments"></i>'.__('1 Comment.', 'us').' <a href="#respond">'.__('Leave new', 'us').'</a>', '<i class="fa fa-comments"></i>'.__('% Comments.', 'us').' <a href="#respond">'.__('Leave new', 'us').'</a>' );?></h4>


	<div class="w-comments-list">
		<?php wp_list_comments(array( 'callback' => 'us_comment_start', 'end-callback' => 'us_comment_end', 'walker' => new Walker_Comments_US() )); ?>
	</div>

	<div class="w-comments-pagination">
		<?php previous_comments_link() ?>
		<?php next_comments_link() ?>
	</div>

	<?php if ( comments_open() ) : ?>

		<div id="respond" class="w-comments-form">
			<?php /* <h4 class="w-comments-form-title"><?php comment_form_title(__('Leave comment', 'us'), __('Leave comment', 'us')); ?></h4> */ ?>
			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>
				<div class="w-comments-form-text"><?php printf(__('You must be %slogged in%s to post a comment.', 'us'), '<a href="'.wp_login_url( get_permalink() ).'">', '</a>'); ?></div>
			<?php } else { ?>

				<?php comment_form(); ?>
			<?php } ?>


		</div>
	<?php endif;?>

</div>