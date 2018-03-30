<?php
// Do not delete these lines
global $post;

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
return;
}
?>

<div id="comments">

<?php if ( have_comments() ) : ?>
	
<div class="basicInfo">
<?php
	$numberOfComments = get_comments_number();
	$commentsWording = 'Comments';
	
	if ($numberOfComments == 1) $commentsWording = 'Comment';
	
	echo $numberOfComments . " " . $commentsWording . ' to "' . $post->post_title . '"';
	
?>
	<a href="#respond" title="add comment" class="tinyButton roundButton right scroll">add comment</a>
</div>

<div class="commentlist">
<?php wp_list_comments('avatar_size=52&style=div&callback=tb_comment_template'); ?>
</div>

<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<div class="basicInfo">No comments yet. Be the first!</div>

<?php else : // comments are closed ?>
<div class="basicInfo nocomments">Comments are closed.</div>

<?php endif; ?>

<?php endif; ?>   



<?php if ('open' == $post->comment_status) : ?>

       <div id="respond">
      	
        	 <div class="cancel-comment-reply">
				<small><?php cancel_comment_reply_link(); ?></small>
    		</div>


<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

<?php else : ?>

<div class="respondHeader">Leave a Reply</div>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="horizform" id="commentform" onsubmit="if (url.value == 'Website (optional)') {url.value = '';}">
<fieldset>
<?php if ( is_user_logged_in() ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<div class="form-data respondTextarea">
    <label for="form_message">Comment</label>
    <textarea id="form_message" name="comment" tabindex="4" onfocus="if (this.value == 'Type your comment here...') {this.value = '';}"  onblur="if (this.value == '') {this.value = 'Type your comment here...';}">Type your comment here...</textarea>
</div>

<div class="respondSubmit">
	<input type="submit" id="submit" class="tinyButton roundButton" name="submit" value="Comment" />
</div>

<?php else : ?>
<div class="personal-data">

<div class="respondInput">
    <label for="author">Full name</label>
    <input type="text" name="author" id="author" tabindex="1" class="txt" value="Name <?php if ($req) echo "(required)"; ?>" onfocus="if (this.value == 'Name (required)') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Name (required)';}" />
</div>

<div class="respondInput">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" tabindex="2" value="Email <?php if ($req) echo "(required)"; ?>" onfocus="if (this.value == 'Email (required)') {this.value = '';}" class="txt" onblur="if (this.value == '') {this.value = 'Email (required)';}" />
</div>

<div class="respondInput">
    <label for="url">Website</label>
    <input type="text" name="url" id="url" tabindex="3" value="Website (optional)" onfocus="if (this.value == 'Website (optional)') {this.value = '';}" class="txt" onblur="if (this.value == '') {this.value = 'Website (optional)';}" />
</div>

</div>

<div class="form-data respondTextarea">
    <label for="form_message">Comment</label>
    <textarea id="form_message" name="comment" tabindex="4" onfocus="if (this.value == 'Type your comment here...') {this.value = '';}"  onblur="if (this.value == '') {this.value = 'Type your comment here...';}">Type your comment here...</textarea>
</div>

<div class="respondSubmit">
	<input type="submit" id="submit" class="tinyButton roundButton" name="submit" value="Comment" />
</div>

<?php endif; // If logged in ?>
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</fieldset>
</form>

<?php endif; ?>
</div>

<?php endif; ?>

</div>