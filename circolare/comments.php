<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die (__('Please do not load this page directly. Thanks!', 'circolare'));
 
if ( post_password_required() ) { ?>
<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'circolare'); ?></p>
<?php
return;
}
?>
 
<!-- You can start editing here. -->
 <div class="clear"></div>
<?php if ( have_comments() ) : ?>
<div class="sep-line-block medium-margin">
	<div class="sep-line-points-container">
		<div class="sep-line-points"></div>
	</div>
	<div class="sep-line-center-text">
		<h3><?php _e('Comments', 'circolare'); ?></h3>
	</div>
	<div class="sep-line-points-container">
		<div class="sep-line-points"></div>
	</div>
</div>
 
<div class="comments-navigation">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>
 
<ol class="commentlist">
<?php wp_list_comments('callback=mytheme_comment'); ?>
</ol>
 
<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->

<div class="sep-line-block medium-margin">
	<div class="sep-line-points-container">
		<div class="sep-line-points"></div>
	</div>
	<div class="sep-line-center-text">
		<h3><?php _e('Comments', 'circolare'); ?></h3>
	</div>
	<div class="sep-line-points-container">
		<div class="sep-line-points"></div>
	</div>
</div>
 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"><?php _e('Comments are closed.', 'circolare'); ?></p>
 
<?php endif; ?>
<?php endif; ?>
 
<?php if ('open' == $post->comment_status) : ?>

<div class="clear"></div>
 
<div class="comment-form-container">
 
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="blog_comment">
 
<?php if ( $user_ID ) : ?>
<div class="comments-button"><?php _e('Logged in as', 'circolare'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out &raquo;', 'circolare'); ?></a></div>
<div class="comments-avatar"></div>
<?php else : ?>
<div class="comments-avatar"></div>
<div class="comments-text other-fields">
	<div class="one-half form-name float-left">
		<label for="author"><?php _e('Your Name', 'circolare'); ?></label>
		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" class="required" <?php if ($req) echo "required"; ?> />
	</div>
	
	<div class="one-half last form-name float-right">
		<label for="email"><?php _e('Your E-mail', 'circolare'); ?></label>
		<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" class="required email" <?php if ($req) echo "required"; ?> />
	</div>
	
	<div class="clear"></div>
</div>
<?php endif; ?>

<!-- <div class="general-field comments-text">
	<textarea name="comment" id="comment" cols="20" rows="4" class="required txtarea-comment"></textarea>
</div> -->
<div class="comments-text">
	<textarea name="comment" id="comment" cols="20" rows="4" class="required"></textarea>
</div>

<br class="clear" />
 
<input name="submit" type="submit" id="comment-submit" class="button comments-button red-submit-button" value="<?php _e('Submit comment', 'circolare'); ?>" />

<?php comment_id_fields(); ?>

<?php do_action('comment_form', $post->ID); ?>

<div class="clear"></div>
</form>
 
<?php endif; // If registration required and not logged in ?>
</div>
 
<?php endif; // if you delete this the sky will fall on your head ?>