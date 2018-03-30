<div id="cs_portfolio_filters">
    <ul>
        <li class="active"><a href="#" data-filter="*"><?php echo esc_html__('All', 'wp_nuvo'); ?></a></li>
        <?php
        if (empty($term_cats)) {
            $terms = get_terms('portfolio_category', 'orderby=count&hide_empty=0');
        } else {
            $terms = $term_cats;
        }

        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                ?>
                <li class="filter-items"><a href="#" term-id="<?php echo esc_attr($term->term_id); ?>" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a></li>
                <?php
            }
        }
        ?>
    </ul>
</div>