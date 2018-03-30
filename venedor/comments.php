
<?php
// Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die (__('Please do not load this page directly. Thanks!'. 'venedor'));

    if ( post_password_required() ) { ?>
        <p class="no-comments"><?php echo __('This post is password protected. Enter the password to view comments.', 'venedor'); ?></p>
    <?php
        return;
    }
    global $venedor_layout;
?>

<div id="comments" class="comments-area<?php if ($venedor_layout == 'widewidth') echo ' container' ?>">

    <?php if ( have_comments() ) : ?>
    <div class="entry-comments">
        <div class="title"><h3><?php
            printf( _nx( 'Comment (1)', 'Comments (%1$s)', get_comments_number(), 'comments title', 'venedor' ),
                number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
        ?></h3><div class="title-gap-wrap"><div class="title-gap"></div></div></div>
        
        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 70,
                    'callback' => 'venedor_comment'
                ) );
            ?>
        </ol><!-- .comment-list -->
        
        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <div class="navigation comment-navigation" role="navigation">
            <div class="nav-previous"><?php previous_comments_link( '<span class="fa fa-angle-left"></span>' ); ?></div>
            <div class="nav-next"><?php next_comments_link( '<span class="fa fa-angle-right"></span>' ); ?></div>
        </div>
        <?php endif; // Check for comment navigation ?>
        
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'venedor' ); ?></p>
        <?php endif; ?>
    </div>
    <?php endif; // have_comments() ?>

    <?php comment_form(); ?>

</div><!-- #comments -->