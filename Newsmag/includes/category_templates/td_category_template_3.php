<?php
class td_category_template_3 extends td_category_template {

    function render() {
        ?>

        <!-- subcategory -->
        <div class="td-category-header">
            <div class="td-container td-container-border">
                <div class="td-scrumb-holder">
                    <div class="td-pb-row">
                        <div class="td-pb-span12 td-pb-padding-side">
                            <div class="td-crumb-container"><?php echo parent::get_breadcrumbs(); ?></div>
                        </div>
                    </div>
                    <?php echo parent::get_pull_down(); ?>
                </div>

                <div class="td-pb-row">
                    <div class="td-pb-span12 td-pb-padding-side">
                        <h1 class="entry-title td-page-title"><?php echo parent::get_title(); ?></h1>
                        <?php echo parent::get_description(); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
}
