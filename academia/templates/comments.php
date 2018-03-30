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
        <h3 class="comments-title p-font">
                <span>
                    <?php comments_number(esc_html__('No Comments', 'g5plus-academia'), esc_html__('One Comment', 'g5plus-academia'), esc_html__('Some Toughts (%)', 'g5plus-academia')); ?>
                </span>
        </h3>
        <?php if (have_comments()) : ?>
            <div class="entry-comments-list">
                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                    <nav class="comment-navigation text-right" role="navigation">
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
                                'avatar_size' => 120,
                                'short_ping' => true,
                            )); ?>
                        </ol>
                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                    <nav class="comment-navigation comment-navigation-bottom text-right" role="navigation">
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