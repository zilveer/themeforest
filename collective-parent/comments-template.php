<?php
if ( ! function_exists( 'tfuse_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own tfuse_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
    function tfuse_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
       <a name="comment-<?php comment_ID() ?>"></a>
        <div id="li-comment-<?php comment_ID() ?>" class="comment-container comment-body">
            <p><?php _e( 'Pingback:', 'tfuse' ); ?> <?php comment_author_link(); ?>
                <span class="comment-date"><?php comment_date(); ?></span>
                <?php comment_text(); ?>
        </div><?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <a name="comment-<?php comment_ID() ?>"></a>
        <div id="li-comment-<?php comment_ID() ?>" class="comment_body">

            <div class="comment_avatar"><?php echo get_avatar( $comment, 50 ); ?></div>
            <?php $defaults = array('add_below' => 'comment', 'respond_id' => 'respond', 'reply_text' => __('Reply','tfuse'),
                'login_text' => __('Log in to Reply','tfuse'), 'depth' => 0, 'before' => '', 'after' => '');
                $args = wp_parse_args($args, $defaults);
            ?>
            <div class="comment_text">
                <a href="#" class="link-author"><?php comment_author_link() ?></a>
                <span class="comment-date"><?php comment_date(); ?></span> | <?php comment_reply_link( array_merge( $args, array(  'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>

                <div class="clear"></div>
                <div class="comment_entry"><?php echo get_comment_text() ?></div>

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <p class='unapproved'><?php _e('Your comment is awaiting moderation.', 'tfuse'); ?></p>
                    <br />
                <?php endif; ?>
            </div><!-- /.comment_text -->

            <div id="comment-<?php comment_ID(); ?>"></div>
            <div class="clear"></div>
        </div><!-- /.comment-container -->
    <?php
        break;
        endswitch;
    }
endif; // ends check for tfuse_comment()