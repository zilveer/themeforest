<?php

if (post_password_required())
    return;
?>

<div id="comments" class="comments">
    <?php if(have_comments()){ ?>
        <div>
            <h4>
                <?php comments_number(__('0 Comment', TEXT_DOMAIN), __('1 Comment', TEXT_DOMAIN), __('% Comments', TEXT_DOMAIN)); ?>
            </h4>
        </div>
        <hr>
    <?php } ?>

    

    <?php if (have_comments()) { ?>
        <ul class="commentlists">
            <?php wp_list_comments('callback=ova_theme_comment'); ?>
        </ul>
        <?php
        // Are there comments to navigate through?

        if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <footer class="navigation comment-navigation" role="navigation">
                <?php _e( 'Comment navigation', TEXT_DOMAIN ); ?>
                <div class="previous"><?php previous_comments_link(__('&larr; Older Comments', TEXT_DOMAIN)); ?></div>
                <div class="next right"><?php next_comments_link(__('Newer Comments &rarr;', TEXT_DOMAIN)); ?></div>
            </footer><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>

        <?php if (!comments_open() && get_comments_number()) : ?>
            <p class="no-comments"><?php _e('Comments are closed.', TEXT_DOMAIN); ?></p>
        <?php endif; ?>
    <?php } ?>

    <?php

    $aria_req = ($req ? " aria-required='true'" : '');
    $comment_args = array(
        'title_reply' => __('<h4 class="block-title">' . __('Leave a Comment', TEXT_DOMAIN) . '</h4><hr>', TEXT_DOMAIN),
        'fields' => apply_filters('comment_form_default_fields', array(
            'author' => '<div class="form-group">                                
                                <div class="form-group"><input type="text" name="author" value="' . esc_attr($commenter['comment_author']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. __('Name',TEXT_DOMAIN) .'" /></div>',
            'phone' => '<div class="form-group"><input type="text" name="url" value="' . esc_url($commenter['comment_author_url']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. __('Website',TEXT_DOMAIN) .'" /></div>',
            'email' => '<div class="form-group"><input type="text" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. __('Email',TEXT_DOMAIN) .'" /></div></div><div class="form-group">                                
                                    <textarea class="form-control" rows="7" name="comment" placeholder="'. __('Your Message',TEXT_DOMAIN) .' ..."></textarea>
                            </div><div class="form-group">
                                <input type="submit" value="'. __('Send Comment',TEXT_DOMAIN) .'" class="btn btn-theme pull-left">
                            </div>',
        )),
        'comment_field' => '',
        'label_submit' => '',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
    );
    ?>

    <?php global $post; ?>
    <?php if ('open' == $post->comment_status) { ?>
        <div class="commentform">
            <div class="span12">
                <?php comment_form($comment_args); ?>
            </div>
        </div><!-- end commentform -->
    <?php } ?>


</div><!-- end comments -->