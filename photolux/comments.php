<?php 
/**
 * Comments template.
 */
?>
<div id="comments">
<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>

<p class="nocomments">This post is password protected. Enter the
  password to view comments.</p>
  </div>
<?php
return;
}
?>
<?php if ( comments_open() ) { ?>
<?php if(have_comments()){ ?>
<h4>
  <?php comments_number(pex_text('_no_comments_text'), pex_text('_one_comment_text'), '% '.pex_text('_comments_text'))?>
</h4>
<?php } //end if have comments ?>
<div id="comment-content-container">
  <?php if(have_comments()){?>
  <ul class="commentlist">
    <?php wp_list_comments('type=all&callback=pexetotheme_comment'); ?>
  </ul>
  <div class="comment-navigation" class="navigation">
  <div class="alignleft">
    <?php next_comments_link('<span>&laquo;</span> Previous') ?>
  </div>
  <div class="alignright">
    <?php previous_comments_link('Next<span>&raquo;</span>') ?>
  </div>
</div>
<?php } //end if have comments 

$fields =  array(
	'author' => '<p class="comment-form-author">' . '<label for="author">' . pex_text('_comment_name_text') . '</label> ' . ( $req ? '<span class="mandatory">*</span>' : '' ) .
	            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . ' /></p>',
	'email'  => '<p class="comment-form-email"><label for="email">' . pex_text('_email_text') . '</label> ' . ( $req ? '<span class="mandatory">*</span>' : '' ) .
	            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . ' /></p>',
	'url'    => '<p class="comment-form-url"><label for="url">' .pex_text('_website_text') . '</label>' .
	            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
$args=array();
$args['fields']=$fields;
$args['comment_field']='<p class="comment-form-comment"><label for="comment">' . pex_text('_your_comment_text') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
$args['comment_notes_before']='<div class="double-line"></div>';
$args['comment_notes_after']='';
$args['title_reply']=pex_text('_leave_comment_text');
$args['label_submit']=pex_text('_submit_comment_text');
$args['logged_in_as']='';
$args['title_reply_to']=pex_text('_leave_reply_to_text').' %s';
$args['cancel_reply_link']=pex_text('_cancel_reply_text');
 comment_form( $args ); 
 ?>
</div>
<?php } //end if comments open ?>
</div>
