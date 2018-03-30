<li class="<?php echo implode(' ',get_comment_class()); ?> commentrow" id="comment-<?php comment_ID() ?>">

    <div class="image">
        <a href="<?php echo get_comment_author_url() ?>" class="post-comment-avatar">
         <?php echo get_avatar($comment,$size='66' ); ?>
        </a>
    </div>

    
    <div class="content">
        <h3>I love it!</h3>
        <p>
            <?php if($comment->comment_approved == 0): ?>
                <span class="post-comment-approving">
                    <?php _e('Your comment is awaiting approval. Please have some patience.', $bSettings->getPrefix()) ?>
                </span>
            <?php else: ?>
                <?php comment_text() ?>
            <?php endif; ?>
        </p>
        <p class="authorinfo">
            <?php _e('comment by', $bSettings->getPrefix()) ?>
            <?php comment_author_link() ?> 
            <?php _e('posted', $bSettings->getPrefix()) ?> 
            <?php echo get_comment_date('M jS, Y H:i') ?> 
            <?php _e('-', $bSettings->getPrefix()) ?> 
            <?php
                comment_reply_link(array_merge(
                    $args,
                    array(
                        'depth' => $depth,
                    'max_depth' => $args['max_depth']
                    )
                )); 
            ?>
        </p>
    </div>

    
  <br class="clear" />