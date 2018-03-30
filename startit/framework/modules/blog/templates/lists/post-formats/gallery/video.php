<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-overlay"></div>
        <?php qode_startit_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <?php qode_startit_post_info(array('category' => 'yes'), array('show_category_label' => 'no', 'show_category_delimiter' => 'no')) ?>
                <?php qode_startit_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
                <?php qode_startit_excerpt($excerpt_length); ?>
                <div class="qodef-post-info-bottom">
                    <?php qode_startit_post_info(array('date' => 'yes', 'author' => 'yes')) ?>
                </div>
            </div>
        </div>
    </div>
</article>