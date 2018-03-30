<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
    <div class="alert alert-info"><?php _e("This post is password protected. Enter the password to view comments.",LANGUAGE); ?></div>
    <?php
    return;
}
?>
<div class="blog-comment">
<?php    wp_list_comments( array(
        'walker' => new viska_walker_comment(),
        'avatar_size' => 270
    ) );

?>
</div>
<div class="blog-leave-reply">
<?php if ( comments_open() ) : ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $defaults = array(
        'fields' => apply_filters( 'comment_form_default_fields', array(

                'author' =>'<div class="col-ms-12 col-xs-6">' .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                    '" ' . $aria_req . ' placeholder="' . __( 'Name', LANGUAGE ) . '" /></div>',

                'email' =>'<div class="col-ms-12 col-xs-6"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" ' . $aria_req . ' placeholder="' . __( 'Email', 'domainreference' ) . '" /></div>',
                'phone' =>'<div class="col-ms-12 col-xs-6"><input id="phone" name="phone" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" placeholder="' . __( 'Website', 'domainreference' ) . '" /></div>',
                'url' =>'<div class="col-ms-12 col-xs-6"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" placeholder="' . __( 'Website', 'domainreference' ) . '" /></div>',
            )
        ),
        'comment_field' =>  '<div class="clear"></div><div class="col-ms-12 col-xs-12"><textarea id="comment" name="comment" aria-required="true" placeholder="MESSAGE *"></textarea></div><div class="clear"></div>',
        'must_log_in' => '<div class="must-log-in control-group"><div class="controls">' .sprintf(__( 'You must be <a href="%s">logged in</a> to post a comment.' ),wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )) . '</div></div >',
        'logged_in_as' => '<div class="logged-in-as control-group"><div class="controls">' .sprintf(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),admin_url( 'profile.php' ),$user_identity,wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )) . '</div></div>',

        'comment_notes_before' => '<div class="comment-notes control-group"><div class="controls">' .__( 'Your email address will not be published.' ) . ( $aria_req ) .'</div></div>',

        'comment_notes_after' => '',

        'id_form'              => 'commentform',

        'id_submit'            => 'submit',

        'title_reply'          => __( 'LEAVE YOUR COMMENT HERE',LANGUAGE ),

        'title_reply_to'       => __( 'Leave a Reply %s',LANGUAGE ),

        'cancel_reply_link'    => __( 'Cancel reply',LANGUAGE ),

        'label_submit'         => __( 'SUBMIT',LANGUAGE ),

    );

    comment_form($defaults);
    ?>

<?php endif; // if you delete this the sky will fall on your head ?>
</div>