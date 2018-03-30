<?php stag_comments_before(); ?>

<?php

  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'stag') ?></p>
  <?php
    return;
  }

/*-----------------------------------------------------------------------------------*/
/*  Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

    if ( have_comments() ) : // if there are comments ?>

        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>

        <div id="comment-wrap">
            <div class="inner-block">
                <div class="comments-header clearfix">
                  <h3 id="comments"><?php comments_number(__('0 Comments', 'stag'), __('1 Comment', 'stag'), __('% Comments', 'stag')); ?></h3>
                  <a href="#respond" class="button respond-button accent-background"><?php comment_form_title( __('Submit a Comment', 'stag'), __('Submit a Comment', 'stag') ); ?></a>
                </div>

                <ul class="commentlist">
                  <?php wp_list_comments('type=comment&avatar_size=30&callback=stag_comments'); ?>
                </ul>

              <?php endif; ?>

              <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>

              <h3 id="pings"><?php _e('Trackbacks for this post', 'stag') ?></h3>

              <ol class="pinglist">
                <?php wp_list_comments('type=pings&callback=stag_list_pings'); ?>
              </ol>

                <?php endif; ?>

                <div class="navigation">
                  <div class="alignleft"><?php previous_comments_link(); ?></div>
                  <div class="alignright"><?php next_comments_link(); ?></div>
                </div>
            </div>
      </div>
    <?php


/*-----------------------------------------------------------------------------------*/
/*  Deal with no comments or closed comments
/*-----------------------------------------------------------------------------------*/

    if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>

    <p class="nocomments"><?php _e('Comments are now closed for this article.', 'stag') ?></p>

    <?php endif; ?>

    <?php else :  ?>

        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>

        <?php else : // if comments are closed ?>

        <?php endif; ?>

<?php endif;


/*-----------------------------------------------------------------------------------*/
/*  Comment Form
/*-----------------------------------------------------------------------------------*/

  if ( comments_open() ) : ?>

  <div id="respond-wrap" class="clearfix">

  <?php
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $fields = array(
    'comment_field' => '<p class="comment-form-comment"><span>'.__('Your Comment', 'stag').'</span><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
    'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'stag' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
    'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', 'stag' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'title_reply' => __('Submit a Comment<span class="section-description">Please be polite. We appreciate that.</span>', 'stag'),
    'title_reply_to' => __('Leave a Reply to %s', 'stag'),
    'cancel_reply_link' => __('Cancel Reply', 'stag'),
    'label_submit' => __('Submit Comment', 'stag'),
    'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Your Name', 'stag' ) . '</label><input required id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',
    'email' => '<p class="comment-form-email"><label for="email">' . __( 'Your Email', 'stag' ) . '<span>* Will not be published</span></label><input required id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /></p>',
    ) )
  );

      comment_form($fields); ?>

  </div>
  <?php endif; // if you delete this the sky will fall on your head ?>

<?php stag_comments_after(); ?>