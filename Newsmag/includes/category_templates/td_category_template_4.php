<?php
class td_category_template_4 extends td_category_template {

    function render() {
        ?>

        <!-- subcategory -->
        <div class="td-category-header">
            <div class="td-container td-container-border">
                <div class="td-pb-row">
                    <div class="td-pb-span12 td-pb-padding-side">
                        <div class="td-crumb-container"><?php echo parent::get_breadcrumbs(); ?></div>
                        <?php echo parent::get_pull_down(); ?>
                        <h1 class="entry-title td-page-title"><?php echo parent::get_title(); ?></h1>
                        <div class="td-subcategory-header">
                            <?php
                            echo parent::get_sibling_categories();
                            ?>
                        </div>
                        <?php echo parent::get_description(); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
}