<?php
/**
 *  Comments
 */
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

if ( post_password_required() )
{
    ?><p class="no-comments"><?php echo __('This post is password protected. Enter the password to view comments.', 'bd'); ?></p><?php
    return;
}

if ( have_comments() ) :
    ?>
    <div id="comments" class="comments-container bbox">
        <div class="box-title"><h2><b><?php comments_number(__('No Comments', 'bd'), __('One Comment', 'bd'), '% '.__(' Comments', 'bd' ) );?></b></h2></div>
        <ol class="commentlist">
            <?php wp_list_comments('callback=bd_comment'); ?>
        </ol>
        <div class="comments-navigation">
            <div class="alignleft"><?php previous_comments_link(); ?></div>
            <div class="alignright"><?php next_comments_link(); ?></div>
        </div>
    </div>
<?php
else :
    if ( comments_open() ) :
    else :
        ?><p class="no-comments"><?php echo __('Comments are closed.', 'bd'); ?></p><?php
    endif;
endif;
?>
<?php
$commenter      = wp_get_current_commenter();
$req            = get_option( 'require_name_email' );
$aria_req       = ( $req ? " aria-required='true'" : '' );
$fields         =  array(
    'author'    => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'bd' ) . '  '. ( $req ? '<span class="required">*</span>' : '' ) .'</label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
    'email'     => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'bd' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) .' </label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
    'url'       => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'bd' ) . '</label>' .'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
$required_text = __(' Required fields are marked', 'bd').' <span class="required">*</span>';
comment_form( array(
    'fields'                => apply_filters( 'comment_form_default_fields', $fields ),
    'must_log_in'           => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' , 'bd' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
    'logged_in_as'          => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  , 'bd' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
    'comment_notes_before'  => '<p class="comment-notes">' . __( 'Your email address will not be published.'  , 'bd' ) . ( $req ? $required_text : '' ) . '</p>',
    'title_reply'           => __( 'Leave a Reply'  , 'bd' ),
    'title_reply_to'        => __( 'Leave a Reply to %s'  , 'bd' ),
    'cancel_reply_link'     => __( 'Cancel reply'  , 'bd' ),
    'label_submit'          => __( 'Post Comment'  , 'bd' )
));
?>