<?php
class td_category_template_1 extends td_category_template {



    function render() {
        ?>

        <!-- subcategory -->

        <div class="td-category-header">
            <div class="td-container td-container-border">
                <div class="td-pb-row">
                    <div class="td-pb-span12">
                        <div class="td-subcategory-header">
                            <?php
                            echo parent::get_sibling_categories();
                            echo parent::get_pull_down();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }


}
