<div id="comments">
<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<div class="comment-header"><h3><?php comments_number('Leave your comment', '1 Comment', '% Comments' );?></h3></div>
		<div id="commentlist-wrap">
			<ol class="commentlist">
<?php 
$args = array(
'type' => 'comment',
'avatar_size' => 60
);
wp_list_comments($args); ?>
			</ol>
			<div class="comment-nav">
 <?php paginate_comments_links(); ?>
 </div> <!-- end comment pagination -->
	<div class="clear"></div>
		</div>

<?php endif; ?>
	
<?php comment_form(); ?>

</div>

<div class="clear"></div>