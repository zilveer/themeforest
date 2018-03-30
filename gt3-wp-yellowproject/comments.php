<?php
if (post_password_required()) {
?>
<p class="nocomments"><?php (get_theme_option("translator_status") == "enable") ? the_text("password_protected") : _e('This post is password protected. Enter the password to view comments.','theme_localization') ; ?></p>
<?php return;
}
?>


<div id="comments">
    <?php // Do not delete these lines

    #Required for nested reply function that moves reply inline with JS
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    ?>

    <!-- You can start editing here. -->
    <?php /* Begin Comments & Trackbacks */ ?>
    <?php if (have_comments()) : ?>
    <h2 class="postcomment"><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("comments_number") : __('Comments','theme_localization')).": "; echo comments_number( '0', '1', '%' ); ?></h2>

    <ol class="commentlist">
        <?php wp_list_comments('type=comment&callback=theme_comment'); ?>
    </ol>

    <div class="dn"><?php paginate_comments_links(); ?></div>

    <?php // End Comments ?>

    <?php else : // this is displayed if there are no comments so far ?>

    <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->

        <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p><?php /*echo "Sorry, the comment form is closed at this time.";*/ ?></p>

        <?php endif; ?>
    <?php endif; ?>

    <?php if ('open' == $post->comment_status) :

    $comment_form = array(
        'fields' => apply_filters( 'comment_form_default_fields', array(
            'author' => '<input type="text" value="'.((get_theme_option("translator_status") == "enable") ? get_text("comment_form_name") : __('Name *','theme_localization')).'" title="'.((get_theme_option("translator_status") == "enable") ? get_text("comment_form_name") : __('Name *','theme_localization')).'" id="author" name="author" class="form_field">',
            'email'  => '<input type="text" value="'.((get_theme_option("translator_status") == "enable") ? get_text("comment_form_email") : __('Email *','theme_localization')).'" title="'.((get_theme_option("translator_status") == "enable") ? get_text("comment_form_email") : __('Email *','theme_localization')).'" id="email" name="email" class="form_field">',
            'url'    => '<input type="text" value="'.((get_theme_option("translator_status") == "enable") ? get_text("comment_form_url") : __('URL','theme_localization')).'" title="'.((get_theme_option("translator_status") == "enable") ? get_text("comment_form_url") : __('URL','theme_localization')).'" id="web" name="url" class="form_field">'
        ) ),
        'comment_field' => '<textarea name="comment" cols="45" rows="5" title="'.((get_theme_option("translator_status") == "enable") ? get_text("comment_form_message") : __('Message...','theme_localization')).'" id="comment-message" class="form_field">'.((get_theme_option("translator_status") == "enable") ? get_text("comment_form_message") : __('Message...','theme_localization')).'</textarea>',
        'comment_form_before' => '',
        'comment_form_after' => '',
        'must_log_in' => ((get_theme_option("translator_status") == "enable") ? get_text("you_must_logged_in") : __('You must be logged in to post a comment.','theme_localization')),
        'title_reply' => ((get_theme_option("translator_status") == "enable") ? get_text("leave_a_comment") : __('Leave a Comment!','theme_localization')),
        'label_submit' => ((get_theme_option("translator_status") == "enable") ? get_text("post_comment") : __('Post Comment','theme_localization')),
        'logged_in_as' => '<p class="logged-in-as">' . ((get_theme_option("translator_status") == "enable") ? get_text("logged_in_as") : __('Logged in as','theme_localization')) . ' <a href="'.admin_url( 'profile.php' ).'">'.$user_identity.'</a>. <a href="'.wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) )).'">' . ((get_theme_option("translator_status") == "enable") ? get_text("log_out") : __('Log out?','theme_localization')) . '</a></p>',
    );
    comment_form($comment_form, $post->ID);

    else : // Comments are closed ?>
    <p><?php (get_theme_option("translator_status") == "enable") ? the_text("comment_form_is_closed") : _e('Sorry, the comment form is closed at this time.','theme_localization') ?></p>
    <?php endif; ?>
</div>