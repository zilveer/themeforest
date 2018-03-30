<?php
/**
 * The template for displaying Comments.
 */
?>

<?php
    /*
     * If the current post is protected by a password and
     * the visitor has not yet entered the password we will
     * return early without loading the comments.
     */
    if (post_password_required()) return;
?>
<?php if ( comments_open() ) : ?>
    <div id="comments" class="comments-area clear-fix">

        <div class="comments-area-title">
            <h3>
                <?php
                    if (have_comments()):
                        printf( _n('1 comment', '%1$s comments', get_comments_number(), 'bkninja'),  number_format_i18n(get_comments_number()));
                    else:
                        _e('No comments', 'bkninja');
                    endif;
                ?>
            </h3>
            <?php echo '<a class="add-comment-btn" href="#reply-title">'. __('Add yours', 'bkninja') .'</a>'; ?>
        </div>

        <?php // You can start editing here -- including this comment! ?>

        <?php if ( have_comments() ) : ?>

            <ol class="commentlist">
                <?php
                    /* Loop through and list the comments. Tell wp_list_comments()
                     * to use wpgrade_comment() to format the comments.
                     * If you want to overload this in a child theme then you can
                     * define wpgrade_comment() and that will be used instead.
                     * See wpgrade_comment() in inc/template-tags.php for more.
                     */
                    wp_list_comments( array( 'callback' => 'bk_comments','short_ping'  => true ) );
                ?>
            </ol><!-- .commentlist -->

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav role="navigation" id="comment-nav-bottom" class="comment-navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bkninja' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bkninja' ) ); ?></div>
            </nav>
            <?php endif; // check for comment navigation ?>
            

        <?php endif; // have_comments() ?>
        <?php
            // If comments are closed and there are comments, let's leave a little note, shall we?
            if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) && !is_page() ) :
        ?>
            <p class="nocomments"><?php _e( 'Comments are closed.', 'bkninja' ); ?></p>
        <?php endif; ?>

    </div><!-- #comments .comments-area -->
    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $comments_args = array(
            // change the title of send button
            'title_reply'=> __('Post a new comment', 'bkninja'),
            // remove "Text or HTML to be displayed after the set of comment fields"
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' => '<p class="comment-form-author"><label for="author" >'.__('Name', 'bkninja').'</label><input id="author" name="author" type="text" placeholder="'.__('Name', 'bkninja').'..." size="30" ' .  $aria_req . ' /></p>',
                'email' => '<p class="comment-form-email"><label for="email" >'.__('Email', 'bkninja').'</label><input id="email" name="email" size="30" type="text" placeholder="'.__('Email', 'bkninja').'..." '. $aria_req .' /></p>' ) ),
            'id_submit' => 'comment-submit',
            'label_submit' => __('Send', 'bkninja'),
            // redefine your own textarea (the comment body)
            'comment_field' => '<p class="comment-form-comment"><label for="comment" >'.__('Comment', 'bkninja').'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . _x( 'Message', 'noun', 'bkninja' ) . '"></textarea></p>');
    } else {
        $comments_args = array(
        // change the title of send button
        'title_reply'=> __('Post a new comment', 'bkninja'),
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' => '<p class="comment-form-author"><label for="author" >'.__('Name', 'bkninja').'</label><input id="author" name="author" type="text" placeholder="'.__('Name', 'bkninja').'..." size="30" ' .  $aria_req . ' /></p><!--',
                'email' => '--><p class="comment-form-email"><label for="email" >'.__('Email', 'bkninja').'</label><input id="email" name="email" size="30" type="text" placeholder="'.__('Email', 'bkninja').'..." '. $aria_req .' /></p><!--',
                'url' => '--><p class="comment-form-url"><label for="url" >'.__('Url', 'bkninja').'</label><input id="url" name="url" size="30" placeholder="'.__('Website', 'bkninja').'..." type="text"></p>') ),
        'id_submit' => 'comment-submit',
        'label_submit' => __('Send', 'bkninja'),
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><label for="comment" >'.__('Comment', 'bkninja').'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . _x( 'Message', 'noun', 'bkninja' ) . '"></textarea></p>');
    }
	
	//if we have no comments than we don't a second title, one is enough
	if ( !have_comments() ){
		$comments_args['title_reply'] = '';
	}
	
    comment_form($comments_args); ?>
 <?php endif; ?>