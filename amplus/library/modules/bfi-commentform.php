<?php
add_filter('previous_comments_link_attributes', 'bfi_prev_comments');
function bfi_prev_comments($attributes) {
    return "class='comments-prev'";
}
add_filter('next_comments_link_attributes', 'bfi_next_comments');
function bfi_next_comments($attributes) {
    return "class='comments-next'";
}

function bfi_comment_form( $args = array(), $post_id = null ) {
    global $user_identity, $id;

    if ( null === $post_id )
        $post_id = $id;
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter();

    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(
        'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', BFI_I18NDOMAIN) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /><small class="error"></small></p>',
        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', BFI_I18NDOMAIN) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /><small class="error"></small></p>',
        'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', BFI_I18NDOMAIN) . '</label>' .
                    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /><small class="error"></small></p>',
    );

    $required_text = sprintf( ' ' . __('Required fields are marked %s', BFI_I18NDOMAIN), '<span class="required">*</span>' );
    $defaults = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', BFI_I18NDOMAIN ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.__('Enter your comment here', BFI_I18NDOMAIN).'"></textarea><small class="error"></small></p>',
        'must_log_in'          => '<p class="must-log-in"><a href="'.wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ).'">' .  __( 'You must be logged in to post a comment.', BFI_I18NDOMAIN) . '</a></p>',
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as %s.', BFI_I18NDOMAIN), $user_identity) . ' <a href="'.wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ).'"> title="'.__('Log out of this account', BFI_I18NDOMAIN).'">'.__('Log out?', BFI_I18NDOMAIN).'</a></p>',
        'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', BFI_I18NDOMAIN) . ( $req ? $required_text : '' ) . '</p>',
        'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these HTML tags and attributes: %s', BFI_I18NDOMAIN), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => __( 'Leave a Reply', BFI_I18NDOMAIN),
        'title_reply_to'       => __( 'Leave a Reply to %s', BFI_I18NDOMAIN),
        'cancel_reply_link'    => __( 'Cancel reply', BFI_I18NDOMAIN),
        'label_submit'         => __( 'Post Comment', BFI_I18NDOMAIN),
    );

    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

    ?>
        <?php if ( comments_open() ) : ?>
            <?php do_action( 'comment_form_before' ); ?>
            <a name="commentform"></a>
            <div id="respond">
                <h3 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?></h3>
                <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                    <?php echo $args['must_log_in']; ?>
                    <?php do_action( 'comment_form_must_log_in_after' ); ?>
                <?php else : ?>
                    <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
                        <?php do_action( 'comment_form_top' ); ?>
                        <?php if ( is_user_logged_in() ) : ?>
                            <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                            <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                        <?php else : ?>
                            <?php echo $args['comment_notes_before']; ?>
                            <?php
                            do_action( 'comment_form_before_fields' );
                            foreach ( (array) $args['fields'] as $name => $field ) {
                                echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                            }
                            do_action( 'comment_form_after_fields' );
                            ?>
                        <?php endif; ?>
                        <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
                        <?php echo $args['comment_notes_after']; ?>
                        <?php echo do_action('bfi_recaptcha_display'); ?>
                        <p class="form-submit">
                            <input name="submit" class="button" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
                            <?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?>
                            <?php comment_id_fields(); ?>
                        </p>
                        <?php do_action( 'comment_form', $post_id ); ?>
                    </form>
                <?php endif; ?>
            </div><!-- #respond -->
            <?php do_action( 'comment_form_after' ); ?>
        <?php else : ?>
            <?php do_action( 'comment_form_comments_closed' ); ?>
        <?php endif; ?>
    <?php
}

add_filter('cancel_comment_reply_link', 'bfi_cancel_comment_reply_link', 10, 3);
function bfi_cancel_comment_reply_link($content, $link, $text) {
    return "<a rel='nofollow' id='cancel-comment-reply-link' class='button white' href='$link' style='display: none'>$text</a>";
}