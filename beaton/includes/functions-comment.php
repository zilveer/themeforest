<?php
function wize_comment_reply() {
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        // enqueue the javascript that performs in-link comment reply fanciness
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_print_scripts', 'wize_comment_reply');

if (!function_exists('wizedesign_comment')):
    function wizedesign_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type):
            case '':
?>		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>">
                <div class="comment-author vcard">
                    <?php echo get_avatar($comment, 80); ?>
                    <?php printf(__('%s <span class="says">says:</span>', 'wizedesign'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
                </div><!-- .comment-author .vcard -->
                            <?php if ($comment->comment_approved == '0'): ?>
                <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'wizedesign'); ?></em>
                            <br />
                        <?php endif; ?>

                <div class="comment-meta commentmetadata"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
			<?php printf(__('%1$s at %2$s', 'wizedesign'), get_comment_date(), get_comment_time()); ?></a><?php edit_comment_link(esc_html__('(Edit)', 'wizedesign'), ' '); ?>
                </div>

				<div class="reply">
					<?php
                comment_reply_link(array_merge($args, array(
                    'depth' => $depth,
                    'max_depth' => $args['max_depth']
                )));
?>

                </div><!-- .reply -->
				
                <div class="comment-body"><?php comment_text(); ?></div>
            </div><!-- #comment etc...  -->

                <?php
                break;
            case 'pingback':
            case 'trackback':
?>
                <li class="post pingback">
		<p><?php esc_html_e('Pingback:', 'wizedesign'); ?> <?php comment_author_link(); ?><?php edit_comment_link(esc_html__('(Edit)', 'wizedesign'), ' '); ?></p>
	<?php
                break;
        endswitch;
    }
endif;