<div class = "qodef-shop-filter-holder qodef-masonry-filter">
    <div class = "qodef-shop-filter-holder-inner">
        <?php
        if(is_array($filter_categories) && count($filter_categories)){ ?>
            <ul>
                <li class="filter" data-filter="*"><span><?php esc_html_e('All', 'suprema') ?></span></li>
                <?php foreach($filter_categories as $cat){
                    $rand_number = rand();
                    ?>
                    <li data-class="filter filter_<?php print $rand_number; ?>" class="filter_<?php print $rand_number; ?>" data-filter = ".product_cat-<?php print $cat->term_id; ?>">
                    <span>
                        <?php print $cat->name ?>
                    </span>
                    </li>
                <?php } ?>
            </ul>
        <?php }?>
    </div>
</div>