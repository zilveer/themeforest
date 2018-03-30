<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>


<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

if(is_user_logged_in()){
    $comment_field = '<textarea class="w-input text-area" placeholder="'.__('You Message Here','fw').'" id="fd" name="comment" ' . $aria_req . ' required></textarea>';
    $textarea_field = '';
}
else{
    $comment_field = '';
    $textarea_field = '<textarea class="w-input text-area" placeholder="'.__('You Message Here','fw').'" id="fd" name="comment" ' . $aria_req . ' required></textarea>';
}

$args = array(
    'id_form'           => 'email-form',
    'id_submit'         => 'submit',
    'title_reply'       => __( 'Leave a reply', 'fw' ),
    'title_reply_to'    => __( 'Leave Your Reply to %s','fw'  ),
    'cancel_reply_link' => __( 'Cancel Reply','fw'  ),
    'label_submit'      => __( 'Post comment','fw'  ),

    'comment_field' => $comment_field,

    'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'You must be <a href="%s">logged in</a> to post a comment.','fw'  ),
            esc_url(wp_login_url( apply_filters( 'the_permalink', esc_url(get_permalink()) ) ))
        ) . '</p>',

    'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','fw'  ),
            esc_url(admin_url( 'profile.php' )),
            $user_identity,
            esc_url(wp_logout_url( apply_filters( 'the_permalink', esc_url(get_permalink( )) ) ))
        ) . '</p>',

    'comment_notes_before' => '',

    'comment_notes_after' => '',

    'fields' => apply_filters( 'comment_form_default_fields', array(

            'author' =>'<input class="w-input text-field txt-f-2" id="author" name="author" type="text" placeholder="'.__('Enter your name','fw').'" value="' . esc_attr( $commenter['comment_author'] ) .'" ' . $aria_req . ' required>',

            'email' =>'<input id="email" class="w-input text-field txt-f-2" name="email" type="email" placeholder="'.__('Enter your email address','fw').'" value="' . esc_attr(  $commenter['comment_author_email'] ) .'"  ' . $aria_req . ' required>',

            'comment_field' => $textarea_field
        )
    )
);
?>

    <?php  if ( have_comments() ) : ?>
        <div class="comment-template">
            <div class="tittle-line">
                <h5><?php comments_number( __( '0 comments', 'fw' ), __( '1 comment', 'fw' ), __( '% comments', 'fw' ) ); ?></h5>
                <div class="divider-1 small">
                    <div class="divider-small"></div>
                </div>
            </div>

            <?php
                get_template_part( 'comments', 'template' );
                wp_list_comments( array( 'callback' => 'fw_theme_comment' ) );
            ?>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav class="navigation paging-navigation" role="navigation">
                    <div class="pagination loop-pagination">
                        <?php
                        $args = array(
                            'prev_text'    => '<span> '.__('PREV','fw').'</span>',
                            'next_text'    => '<span>'.__('NEXT','fw').'</span>',
                        );
                        paginate_comments_links($args); ?>
                    </div>
                </nav>
            <?php endif; // Check for comment navigation. ?>

            <?php if ( ! comments_open() ) : ?>
                <p class="no-comments"><?php _e( 'Comments are closed.', 'fw' ); ?></p>
            <?php endif; ?>
        </div>
        <div class="divider-space less-space">
            <div class="divider-1-pattern"></div>
        </div>

    <?php endif; // have_comments() ?>


    <div>
        <div>
            <?php comment_form($args); ?>
        </div>
    </div>