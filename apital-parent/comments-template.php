<?php
if ( ! function_exists( 'fw_theme_comment' ) ) :
    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own fw_theme_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     */
    function fw_theme_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
            ?>
            <div <?php comment_class(); ?>>
                <div class="w-clearfix comment-body" id="li-comment-<?php comment_ID() ?>">
                    <a name="comment-<?php comment_ID() ?>"></a>

                    <div class="comment-photo"><?php echo get_avatar( $comment, 50);?></div>
                    <div class="comment-wraper">
                        <h5 class="h-comment"><?php comment_author_link(); ?></h5>
                        <div class="meta-tag">
                            <div><?php comment_date(); ?> <span class="blue">/</span>&nbsp;
                                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="space">
                        <?php echo esc_html($comment->comment_content); ?>

                        <?php if ( $comment->comment_approved == '0' ) : ?>
                            <br />
                            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fw' ); ?></em>
                            <br />
                        <?php endif; ?>

                        <div class="divider-1 div-blog"></div>
                    </div>

                    <div id="comment-<?php comment_ID(); ?>"></div>
                </div>
            </div>
        <?php
            break;
            default : ?>
                <div <?php comment_class(); ?>>
                    <div class="w-clearfix comment-body" id="li-comment-<?php comment_ID() ?>">
                        <a name="comment-<?php comment_ID() ?>"></a>

                        <div class="comment-photo"><?php echo get_avatar( $comment, 50);?></div>
                        <div class="comment-wraper">
                            <h5 class="h-comment"><?php comment_author_link(); ?></h5>
                            <div class="meta-tag">
                                <div><?php comment_date(); ?> <span class="blue">/</span>&nbsp;
                                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="space">
                            <?php echo esc_html($comment->comment_content); ?>

                            <?php if ( $comment->comment_approved == '0' ) : ?>
                                <br />
                                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fw' ); ?></em>
                                <br />
                            <?php endif; ?>

                            <div class="divider-1 div-blog"></div>
                        </div>

                        <div id="comment-<?php comment_ID(); ?>"></div>
                    </div>
                </div>

                <?php
                break;
        endswitch;
    }
endif; // ends check for fw_theme_comment()