<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/8/2015
 * Time: 8:35 AM
 */
if (post_password_required()) {
    return;
}
?>
<?php if (comments_open() || get_comments_number()) : ?>
    <div class="entry-comments" id="comments">
        <?php if (have_comments()) : ?>
            <h3 class="comments-title">
                <span>
                    <?php comments_number(esc_html__('No Comments', 'g5plus-handmade'), esc_html__('One Comment', 'g5plus-handmade'), esc_html__('Comments (%)', 'g5plus-handmade')); ?>
                </span>
            </h3>
            <div class="entry-comments-list">
                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                            <nav class="comment-navigation clearfix pull-right" role="navigation">
                                <?php $paginate_comments_args = array(
                                    'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                                    'next_text' => '<i class="fa fa-angle-double-right"></i>'
                                );
                                paginate_comments_links($paginate_comments_args);
                                ?>
                            </nav>
                            <div class="clearfix"></div>
                        <?php endif; ?>
                <ol class="commentlist clearfix">
                            <?php wp_list_comments(array(
                                'style' => 'li',
                                'callback' => 'g5plus_render_comments',
                                'avatar_size' => 70,
                                'short_ping' => true,
                            )); ?>
                        </ol>
                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                            <nav class="comment-navigation clearfix pull-right comment-navigation-bottom" role="navigation">
                                <?php paginate_comments_links($paginate_comments_args); ?>
                            </nav>
                            <div class="clearfix"></div>
                        <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if (comments_open()) : ?>
            <div class="entry-comments-form">
                <?php g5plus_comment_form(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>