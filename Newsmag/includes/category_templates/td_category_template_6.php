<?php
class td_category_template_6 extends td_category_template {

    function render() {
        ?>

        <!-- subcategory -->
        <div class="td-category-header td-container">
            <div class="td-crumb-container td-pb-padding-side">
                <?php echo parent::get_breadcrumbs(); ?>
                <?php echo parent::get_pull_down(); ?>
            </div>
            <div class="td-background-style6">
                <h1 class="entry-title td-page-title"><?php echo parent::get_title(); ?></h1>
                <?php echo parent::get_description(); ?>
            </div>
        </div>

    <?php
    }
}

