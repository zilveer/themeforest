<?php
class td_category_template_5 extends td_category_template {

    function render() {
        ?>

        <!-- subcategory -->
        <div class="td-category-header">
            <div class="td-container td-image-gradient-style5">
                <div class="td-pb-row">
                    <div class="td-pb-span12 td-pb-padding-side">
                        <div class="td-crumb-container"><?php echo parent::get_breadcrumbs(); ?></div>
                        <h1 class="entry-title td-page-title"><?php echo parent::get_title(); ?></h1>
                        <div class="td-subcategory-header">
                            <?php echo parent::get_sibling_categories(); ?>
                        </div>
                        <?php echo parent::get_description(); ?>
                    </div>
                </div>
                <?php echo parent::get_pull_down(); ?>
            </div>
        </div>

    <?php
    }
}

