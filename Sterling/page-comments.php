<?php
// Prevent Comments page from being accessed directly.
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
    die( 'Please do not load this page directly. Thank You!' );

// Prevent Comments page from being displayed if password protected.
if ( post_password_required() ) { ?><p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'tt_theme_framework' ); ?></p><?php return; }

// Get page comments status.
global $post, $user_ID, $user_identity;
$page_comments_status = get_post_meta( $post->ID, 'page_comments', true );

/**
 * Custom callback function for outputting the comments in the theme on a page.
 *
 * @since 2.1.0
 *
 * @param object $comment The current comment object
 * @param array $args An array of comment arguments
 * @param int $depth The depth of comment nesting
 */
function truethemes_page_comments( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div class="comment-wrap">
            <div class="comment-content" id="comment-<?php comment_ID(); ?>">
                <div class="comment-gravatar">
                    <?php
                    //@since 2.1.5 modified by denzel to allow WordPress default avatar               
                    global $ttso;
                    $default_avatar_setting = $ttso->st_default_avatar;
                    if(empty($default_avatar_setting) || $default_avatar_setting == 'true'):
                    	echo get_avatar( $comment, '60', get_template_directory_uri() . '/images/global/img-default-grav.png' );
                    else:
                    	echo get_avatar( $comment, '60');
                    endif;
                    ?>
                </div><!-- end .comment-gravatar -->

                <div class="comment-text">
                    <span class="comment-author"><?php comment_author_link(); ?></span>
                    <span class="comment-date"><?php comment_date( 'F j, Y' ); ?></span>

                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <?php _e( 'Your comment is awaiting moderation.', 'tt_theme_framework' ); ?>
                    <?php endif; ?>

                    <?php comment_text(); ?>
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'reply', 'tt_theme_framework' ), 'depth' => absint( $depth ), 'max_depth' => absint( $args['max_depth'] ) ) ) ); ?> <?php edit_comment_link( __( '(edit)', 'tt_theme_framework' ), ' ', '' ); ?>
                </div><!-- end .comment-text -->
            </div><!-- end .comment-content -->
        </div><!-- end .comment-wrap -->
    <?php // Leave trailing </li> open for WordPress to close.

}

if ( have_comments() ) :
	$comment_count 	= count( $comments_by_type['comment'] );
    $comment_text 	= ( 1 !== count( $comments_by_type['comment'] ) ) ? __( 'Comments', 'tt_theme_framework' ) : __( 'Comment', 'tt_theme_framework' );
    echo '<p class="tt-comment-count">' . $comment_count . ' ' . $comment_text . '</p>';

    if ( ! empty( $comments_by_type['comment'] ) ) : ?>
        <div id="blog-comment-outer-wrap">
            <ol class="comment-ol" id="post-comments">
                <?php wp_list_comments( 'callback=truethemes_page_comments&type=comment' ); ?>
            </ol>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // We have comments to navigate through. ?>
                <div id="comments">
                    <nav id="comment-nav-below">
                        <div class="nav-next"><?php paginate_comments_links(); ?></div>
                    </nav>
                </div>
            <?php endif; // Check for comment navigation. ?>
    <?php endif;
endif; ?>

<?php // Wordpress Coments Form.
if ( 'on' == $page_comments_status ) :
    if ( ! have_comments() ) : ?>
        <div id="blog-comment-outer-wrap">
    <?php endif; ?>

    <div id="respond">
        <h3 class="comment-title">
            <?php
                $comment_form_title     = __( 'Leave a Comment', 'tt_theme_framework' );
                $comment_form_replyto   = __( 'Reply to %s', 'tt_theme_framework' );
                comment_form_title( $comment_form_title, $comment_form_replyto );
            ?>
        </h3>

        <div class="comment-cancel"><?php cancel_comment_reply_link(); ?></div><!-- end .comment-cancel -->

            <?php if ( get_option( 'comment_registration' ) && ! $user_ID ) : ?>
                <p><?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'tt_theme_framework' ), esc_url(wp_login_url(get_permalink()))); ?></p>
            <?php else : ?>
                <form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform">
                    <?php if ( is_user_logged_in() ) : ?>
                        <p><?php printf( __( 'Logged in as %1$s. %2$sLog out &raquo;%3$s', 'tt_theme_framework' ), '<a href="' . get_option( 'siteurl' ) . '/wp-admin/profile.php">' . $user_identity . '</a>', '<a href="' . wp_logout_url( get_permalink() ) . '" title="' . __( 'Log out of this account', 'tt_theme_framework' ) . '">', '</a>'); ?></p>
                    <?php else : ?>
                        <p>
                            <input type="text" name="author" id="author" value="<?php echo esc_attr( $comment_author ); ?>" size="22" tabindex="1" />
                            <label for="author"><?php _e( 'Name', 'tt_theme_framework' ); if ( $req ) echo '<span>&#42;</span>'; ?></label>
                        </p>
                        <p>
                            <input type="text" name="email" id="email" value="<?php echo esc_attr( $comment_author_email ); ?>" size="22" tabindex="2" />
                            <label for="email"><?php _e( 'Email', 'tt_theme_framework' ); if ( $req ) echo '<span>&#42;</span>'; echo '<small> ' . _e( '(will not be published)', 'tt_theme_framework' ) . '</small>'; ?></label>
                        </p>
                        <p>
                            <input type="text" name="url" id="url" value="<?php echo esc_attr( $comment_author_url ); ?>" size="22" tabindex="3" />
                            <label for="url"><?php _e( 'Website', 'tt_theme_framework' ); ?></label>
                        </p>
                    <?php endif; ?>

                    <p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>

                    <!-- <p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p> -->

                    <p>
                        <input name="submit" type="submit" id="submit-button" tabindex="5" value="<?php _e( 'Submit', 'tt_theme_framework' ); ?>" />
                        <?php comment_id_fields(); ?>
                    </p>
                    <?php do_action( 'comment_form', $post->ID ); ?>
                </form><!-- end #commentform -->
            <?php endif; // If registration required and not logged in. ?>
        </div><!-- end #respond -->
    </div><!-- end #blog-comment-outer-wrap -->
<?php endif; ?>