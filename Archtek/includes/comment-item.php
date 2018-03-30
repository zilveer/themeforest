<?php            

// ---------------------------------------------- //
// This function is for comment item template
// ---------------------------------------------- //

// Pluggable
if (! function_exists( 'uxbarn_create_custom_comment' ) ) {
     
    function uxbarn_create_custom_comment($comment, $args, $depth) {
        
                $GLOBALS['comment'] = $comment;
                extract($args, EXTR_SKIP);
        
                if ( 'div' == $args['style'] ) {
                    $tag = 'div';
                    $add_below = 'comment';
                } else {
                    $tag = 'li';
                    $add_below = 'div-comment';
                }
    
    ?>
                <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? 'comment-item' : 'parent comment-item') ?> id="comment-<?php comment_ID() ?>-list">
                
                <?php if ( 'div' != $args['style'] ) : ?>
                <a id="comment-<?php comment_ID() ?>" class="topic"></a>
                <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
                <?php endif; ?>
                    <div class="comment-author vcard commenter-photo">
                        <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                    </div>
                    <div class="comment-post-wrapper">
                        <div class="comment-item-meta">
                            <span class="commenter-name"><?php printf('<cite class="fn">%s</cite> ', get_comment_author_link()); ?></span>
                            <span class="comment-date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(_x('%1$s at %2$s', '1 = date, 2 = time', 'uxbarn'), get_comment_date(),  get_comment_time()) ?></a></span>
                        </div>
                        <div class="reply">
                            <?php edit_comment_link(__('Edit', 'uxbarn'),'  ', '  ' ); ?>
                            <?php 
                                
                                $reply_link = get_comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'uxbarn'), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '&nbsp;&nbsp;&nbsp;')));
                                
                                if($reply_link != '') {
                                    echo $reply_link;
                                }
                                
                            ?>
                        </div>
                        <div class="comment-post">
                            <?php comment_text() ?>
                            <?php if ($comment->comment_approved == '0') : ?>
                                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'uxbarn'); ?></em>
                                <br />
                            <?php endif; ?>
                        </div>
                    </div>
                    
                <?php if ( 'div' != $args['style'] ) : ?>
                </div>
                <?php endif; ?>
                <?php    
                
    }

}