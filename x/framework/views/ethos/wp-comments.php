<?php

// =============================================================================
// VIEWS/ETHOS/WP-COMMENTS.PHP
// -----------------------------------------------------------------------------
// The area of the page that contains both current comments and the comment
// form. The actual display of comments is handled by a callback to
// x_comment().
// =============================================================================

$commenter     = wp_get_current_commenter();
$req           = get_option( 'require_name_email' );
$asterisk      = ( $req ? '*' : '' );
$asterisk_html = ( $req ? '<span class="required">*</span>' : '' );
$aria_req      = ( $req ? " aria-required='true' required='required'" : '' );

?>

<?php

//
// 1. If the current post is protected by a password and the visitor has not
//    yet entered the password, we will return early without loading the
//    comments.
//

if ( post_password_required() )
  return; // 1

?>

<div id="comments" class="x-comments-area">

  <?php if ( have_comments() ) : ?>

    <h2 class="h-comments-title"><span><?php _e( 'Comments' , '__x__' ); ?></span></h2>
    <ol class="x-comments-list">
      <?php
      wp_list_comments( array(
        'callback' => 'x_ethos_comment',
        'style'    => 'ol'
      ) );
      ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="navigation" role="navigation">
      <h1 class="visually-hidden"><?php _e( 'Comment navigation', '__x__' ); ?></h1>
      <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', '__x__' ) ); ?></div>
      <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', '__x__' ) ); ?></div>
    </nav>
    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() ) : ?>
    <p class="nocomments"><?php _e( 'Comments are closed.' , '__x__' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <?php
  comment_form( array(
    'comment_notes_before' => '',
    'comment_notes_after'  => '',
    'id_submit'            => 'entry-comment-submit',
    'label_submit'         => __( 'Submit' , '__x__' ),
    'title_reply'          => __( '<span>Leave a Comment</span>' , '__x__' ),
    'fields'               => array(
      'author' =>
        '<p class="comment-form-author">' .
          '<label for="author">' . __( 'Name', '__x__' ) . ' ' . $asterisk_html . '</label> ' .
          '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Your Name', '__x__' ) . ' ' . $asterisk . '" size="30"' . $aria_req . ' />' .
        '</p>',
      'email'  =>
        '<p class="comment-form-email">' .
          '<label for="email">' . __( 'Email', '__x__' ) . ' ' . $asterisk_html . '</label> ' .
          '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Your Email', '__x__' ) . ' ' . $asterisk . '" size="30"' . $aria_req . ' />' .
        '</p>',
      'url'    =>
        '<p class="comment-form-url">' .
          '<label for="url">' . __( 'Website', '__x__' ) . '</label>' .
          '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . __( 'Your Website', '__x__' ) . '" size="30" />' .
        '</p>'
    ),
    'comment_field' => '<p class="comment-form-comment">' .
                         '<label for="comment">' . _x( 'Comment', 'noun', '__x__' ) . '</label>' .
                         '<textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . _x( 'Your Comment *', 'noun', '__x__' ) . '"' . $aria_req . '></textarea>' .
                       '</p>'
  ) );
  ?>

</div>