<?php
class td_category_top_posts_style_2 extends td_category_top_posts_style {
    function show_top_posts() {

        parent::render_posts_to_buffer();

        if (parent::get_rendered_post_count() == 0) {
            echo '<div class="td_line_above_cat_big_grid"> </div>';
            return;
        }
        ?>

        <!-- big grid -->
        <div class="td-pb-row">
            <div class="td-pb-span12">
                <div class="td-subcategory-header">
                    <?php
                    echo parent::get_buffer();
                    ?>
                </div>
            </div>
        </div>

    <?php
    }
}