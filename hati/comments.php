<?php

  if ( post_password_required() ) return; // if access denied
  if ( !comments_open() && !get_comments_number() ) return; // if closed and no comments
  if ( $post && !post_type_supports($post->post_type, 'comments')) return; // if no support
  
?>

<?php if ( have_comments() ) : // if there are comments ?>

<br>
<div class="main wrap group post" id="comments">
<div class="sidewrap group">

  <h3><?php _e( 'Discussion', A_DOMAIN ) ?></h3>

  <ol class="commentlist">
  <?php wp_list_comments( array( 'callback' => 'comment_cb', 'style' => 'ol', 'type' => 'comment', 'max_depth' => 1, 'per_page' => -1 ) ); ?>
  </ol><!-- /commentlist -->

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <?php $l = get_previous_comments_link(__('Older Comments', A_DOMAIN )); if ($l) : ?>
    <div class="clear"></div>
    <p>&larr; <?php echo $l ?></p></div>
    <?php endif; ?>
  <?php endif; // check for comment navigation ?>

  <?php if ( !comments_open() && get_comments_number() ) : // If there are no comments and comments are closed, let's leave a note ?>
  <p class="nocomments"><?php _e( 'Comments are closed for now.', A_DOMAIN ); ?></p>
  <?php endif; ?>

</div>
</div>

<?php endif; // /have_comments()


/*--------------------------------------------------------------------------
  Custom Comment Form Hooks
/*------------------------------------------------------------------------*/

function a_comment_form_before() { echo '<br><div class="main wrap group post"><div class="sidewrap group"><div class="fieldset">'; }
function a_comment_form_after() { echo '</div></div></div>'; }

/*--------------------------------------------------------------------------
  Comment Form
/*------------------------------------------------------------------------*/

if ( comments_open() ) :

  $args = array(
    'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea></p>',
    'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', A_DOMAIN ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
    'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', A_DOMAIN ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'title_reply' => __('Leave a Reply', A_DOMAIN),
    'title_reply_to' => __('Leave a Reply to %s', A_DOMAIN),
    'cancel_reply_link' => __('Cancel Reply', A_DOMAIN),
    'label_submit' => __('Submit Comment', A_DOMAIN)
  );

  add_action('comment_form_before', 'a_comment_form_before');
  add_action('comment_form_after', 'a_comment_form_after');
  comment_form($args); 

endif; // end if comments open check

/*--------------------------------------------------------------------------
  Comment Styling (Callback Function)
/*------------------------------------------------------------------------*/

function comment_cb ( $comment, $args, $depth ) {
  
  static $count; $third = (++$count%3 === 0);

  $GLOBALS['comment'] = $comment; ?>

  <li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">

    <h4><?php printf('%1$02d', $count) ?>. <?php comment_author_link() ?> <?php edit_comment_link( __( '#EDIT', A_DOMAIN ) ) ?></h4>
    
    <?php if (!$comment->comment_approved) : ?>
    <p class="moderation"><?php _e( 'Your comment is awaiting moderation.', A_DOMAIN ) ?></p>
    <?php endif; ?>
    
    <?php comment_text() ?>

  <?php if (false && $third) : ?>
  </li><li class="clear">
  <?php endif; ?>

  <?php  // <li> will be auto-closed!
}
