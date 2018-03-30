<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>

<p class="nocomments">This post is password protected. Enter the
  password to view comments.</p>
<?php
return;
}
?>
<?php if ( comments_open() ) : ?>
<?php if(have_comments()):?>
<h2>
  <?php comments_number(get_opt('_no_comments_text'), get_opt('_one_comment_text'), '% '.get_opt('_comments_text'))?>
</h2>
<hr />
<?php endif; ?>
<div id="commentContentContainer">
  <?php if(have_comments()):?>
  <ul class="commentlist">
    <?php wp_list_comments('type=all&callback=mytheme_comment'); ?>
  </ul>
  <div class="commentNavigation" class="navigation">
  <div class="alignleft">
    <?php next_comments_link('<span>&laquo;</span> Previous') ?>
  </div>
  <div class="alignright">
    <?php previous_comments_link('Next<span>&raquo;</span>') ?>
  </div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<div id="respond">
  <div class="cancel-comment-reply"><small>
    <?php cancel_comment_reply_link(); ?>
    </small></div>
  <?php if(have_comments()):?>
  <div class="space"></div>
  <?php endif; ?>
  <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
  <p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged
    in</a> to post a comment.</p>
  <?php else : ?>
  <h2><?php echo get_opt('_leave_comment_text'); ?></h2>
  <hr />
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php"
	method="post" id="commentform">
    <?php if ( !is_user_logged_in() ) : ?>
    <h6><span
	class="commentFormTitle"><?php echo get_opt('_comment_name_text'); ?></span><span class="mandatory">*</span><span
	id="nameError" class="errorMessage"></span></h6>
    <input type="text" name="author" id="author" class="commentInput"
	value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1"
	<?php if ($req) echo "aria-required='true'"; ?> />
    <br />
    <h6><span class="commentFormTitle"><?php echo get_opt('_email_text'); ?></span><span class="mandatory">*</span><span
	id="emailError" class="errorMessage"></span></h6>
    <input type="text" name="email" id="email" class="commentInput"
	value="<?php echo esc_attr($comment_author_email); ?>" size="22"
	tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
    <br />
    <h6><span class="commentFormTitle"><?php echo get_opt('_website_text'); ?></span></h6>
    <input type="text" name="url" id="url" class="commentInput"
	value="<?php echo esc_attr($comment_author_url); ?>" size="22"
	tabindex="3" />
	<br />
    <?php endif; ?>
    <h6><span class="commentFormTitle"><?php echo get_opt('_your_comment_text'); ?></span><span class="mandatory">*</span></h6>
    <textarea name="comment" id="comment" class="commentTextArea" cols=""
	rows="10" tabindex="4"></textarea>
    <p>
    
    <a href="" class="button-small" id="submit_comment_button" ><span><?php echo get_opt('_submit_comment_text'); ?></span></a>
<!--      <input name="submit" type="submit" id="submit" tabindex="5"-->
<!--	value="<?php echo get_opt('_submit_comment_text'); ?>" />-->
      <?php comment_id_fields(); ?>
    </p>
    <?php do_action('comment_form', $post->ID); ?>
  </form>
  <?php endif; // If registration required and not logged in ?>
</div>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>
