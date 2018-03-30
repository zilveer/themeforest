<?php
/**
 * File Name: theme_comment.php
 *
 * Theme Custom Comment Template
 *
 */
if (!function_exists('theme_comment')) {
    function theme_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li class="pingback">
                    <p><?php _e('Pingback:', 'framework'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'framework'), ' '); ?></p>
                </li>
                <?php
                break;
            default :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>">

                        <div class="comment-wrap clearfix">

                            <a class="avatar"
                               href="<?php echo comment_author_url(); ?>"><?php echo get_avatar($comment, 80); ?></a>

                            <div class="comment-detail-wrap">
                                <div class="comment-meta">
                                    <?php comment_reply_link(array_merge(array('before' => ''), array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                                    <h5 class="author"><cite class="fn"><?php printf(__('%s', 'framework'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?></cite>
                                    </h5>
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php printf(__('%1$s', 'framework'), get_comment_date()); ?>
                                    </time>
                                </div>

                                <div class="comment-body entry-content">
                                    <?php comment_text(); ?>
                                </div>
                            </div>
                        </div>
                    </article>
                    <!-- end of comment -->
                <?php
                break;
        endswitch;
    }
}

?>