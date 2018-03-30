<?php
    global $portfolio_filters;
    $cshero_portfolio_filters_id = "cshero_portfolio_filters_{$portfolio_filters['filter']}";
?>
<div class="cshero_portfolio_filters <?php echo $filter_align.' '.str_replace('.','-',$layout).' '.esc_attr($el_class); ?>" <?php echo $filter_style; ?>>
    <ul class="list-unstyled btn-group" data-filter-group="category">
        <li class="filter-items"><a class="<?php echo $filter_btn.' '.$filter_btn_size;?> active" href="#" data-filter=""><span><?php echo __('All', THEMENAME); ?></span></a></li>
        <?php
        global $portfolio_options;
        if (empty($portfolio_options['term_cats'])) {
            $terms = get_terms('portfolio_category', 'orderby=count&hide_empty=0');
        } else {
            $terms = $portfolio_options['term_cats'];
        }
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                if($term):
                ?>
                <li class="filter-items">
                    <a class="<?php echo $filter_btn.' '.$filter_btn_size;?>" href="#" data-filter=".cat-<?php echo esc_attr($term->slug); ?>">
                        <span><?php echo __($term->name, THEMENAME); ?></span>
                    </a>
                </li>
                <?php
                endif;
            }
        }
        ?>
    </ul>
</div>
