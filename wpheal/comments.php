<div id="comment-section-wrap">
	<?php 
		if ( post_password_required() ) {
	?>
	<p class="nopassword"><?php echo 'This post is password protected. Enter the password to view any comments.'; ?></p>
</div>

<?php
			return;
		}
?>

<?php if ( have_comments() ) : ?>
<div id="comments-count">
	<?php
		printf(_n('1 Comment','%s Comments', get_comments_number()), get_comments_number() );
	?>
</div>
<?php
	wp_list_comments( array( 'max_depth' => 1, 'style' => 'div', 'callback' => 'display_comment') );
?>
<div class="clear"></div>

<?php else : 
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php echo 'Comments are closed.'; ?></p>
<?php endif; ?>

<?php endif; ?>

<?php comment_form(array('fields' => array('author' => '<label for="name">Name <span>*</span></label><input type="text" name="author" id="name"/>', 'email' => '<label for="email">Email <span>*</span></label><input type="text" name="email" id="email"/>', 'url' => '<label for="telephone">Website</label><input type="text" name="website" id="website"/>'), 'comment_field' => '<p class="comment-form-comment"><label for="comment">Comment <span> *</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>', 'comment_notes_before' => ' ', 'comment_notes_after' => ' ', 'label_submit' => 'Submit', 'id_submit' => 'submit-button')); ?>

</div>