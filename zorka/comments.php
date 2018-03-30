<?php
/*
The comments page for Bones
*/

// don't load it if you can't comment
if ( post_password_required() ) {
    return;
}
?>
<?php if ( comments_open() || get_comments_number() ) : ?>

<div class="entry-comments" id="comments">
    <div class="entry-comments-list">
        <h3 class="comments-title">
            <?php comments_number( esc_html__('No Comments','zorka'), esc_html__('One Comment','zorka'), esc_html__('Comments (%)', 'zorka' ) );?>
        </h3>
        <?php if (have_comments()) : ?>
        <div class="comment-list-wrapper">
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
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
                    'callback' => 'zorka_render_comments',
                    'avatar_size' => 70,
                     'short_ping'  => true,
                )); ?>
            </ol>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav class="comment-navigation clearfix pull-right" role="navigation">
                    <?php
                    paginate_comments_links($paginate_comments_args);
                    ?>
                </nav>
                <div class="clearfix"></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <?php if (comments_open()) : ?>
    <div class="entry-comments-form">
        <?php zorka_comment_form(); ?>
    </div>
    <?php endif; ?>
</div>

<?php endif; ?>