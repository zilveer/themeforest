<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <div class="qodef-post-content" <?php suprema_qodef_inline_style($holder_style); ?>>
        <span class="qodef-post-content-overlay"></span>
        <div class="qodef-post-content-inner">
            <div class="qodef-post-text">
                <div class="qodef-post-text-inner">
                    <?php suprema_qodef_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
                    <div class="qodef-post-info">
                        <?php suprema_qodef_post_info(array('date' => 'yes', 'author' => 'no', 'category' => 'no', 'comments' => 'no', 'share' => 'no', 'like' => 'no')) ?>
                    </div>
                    <?php
                    suprema_qodef_excerpt($excerpt_length);
                    suprema_qodef_read_more_button();
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>