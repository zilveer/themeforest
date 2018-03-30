<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!','mthemelocal'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'mthemelocal' ); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
<div class="commentform-wrap">
	<h4 id="comments"><?php comments_number(__('No Responses','mthemelocal'), __('One Response','mthemelocal'), __('% Responses','mthemelocal') );?></h4>

	<div class="comment-nav">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
	<?php 
	$avatar_size=get_option( MTHEME . '_avatar_size' );
	if ( empty($avatar_size) ) { $avatar_size=64; }
	wp_list_comments( 'avatar_size=' . $avatar_size ); 
	?>
	</ol>

	<div class="comment-nav">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->

	<?php endif; ?>
<?php endif; ?>


<div id="commentform">
<?php
$form_args = array( 'title_reply' => 'Leave a reply' );
comment_form( $form_args );
?>
</div>
