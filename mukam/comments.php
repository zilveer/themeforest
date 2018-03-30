<?php
// Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if ( post_password_required() ) { ?>
        <p class="nocomments" style="margin-bottom:0px;"><?php echo __('This post is password protected. Enter the password to view comments.', 'mukam'); ?></p>
    <?php
        return;
    }
?>
 
    <?php // You can start editing here -- including this comment! ?>
 
    <?php if ( have_comments() ) : ?>
        <h3 class="comment-title"><?php echo __('Comments', 'mukam'); ?></h3>
        <p class="comment-title">
            <?php
                printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'mukam' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </p>
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
            <h4 class="assistive-text"><?php _e( 'Comment navigation', 'mukam' ); ?></h4>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mukam' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mukam' ) ); ?></div>
        </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
        <ol class="commentlist">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 */
                wp_list_comments( array( 'callback' => 'mukam_comment' ) );
            ?>
        </ol><!-- .commentlist -->
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
            <h4 class="assistive-text"><?php _e( 'Comment navigation', 'mukam' ); ?></h4>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mukam' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mukam' ) ); ?></div>
        </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
    <?php endif; // have_comments() ?>
 
    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'mukam' ); ?></p>
    <?php endif; ?>

    <?php // comment form ?>
    <div id ="commentrespond" class="comment-respond">
 
                <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                <p><?php echo __("You must be ",'mukam');?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php echo __("logged in",'mukam');?></a> <?php echo __("to post a comment.",'mukam');?></p><div id="cancel-comment-reply">
                <small><?php cancel_comment_reply_link() ?></small></div>

                <?php else : ?>
                <?php comment_form(); ?>
                <?php endif; // if you delete this the sky will fall on your head ?>
	
    </div>