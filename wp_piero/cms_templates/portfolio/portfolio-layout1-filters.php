<?php
    global $portfolio_filters; 
?>
<div class="cshero_portfolio_filters <?php echo $filter_align.' '.str_replace('.','-',$layout).' '.esc_attr($el_class); ?>" <?php echo $filter_style; ?>>
    <ul class="nav nav-tabs nav-justified" data-filter-group="category">
        <li class="presentation filter-items"><a class="active" href="#" data-filter=""><?php echo __('All', THEMENAME); ?></a></li>
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
                <li class="presentation filter-items">
                    <a class="" href="#" data-filter=".cat-<?php echo esc_attr($term->slug); ?>">
                        <?php echo __($term->name, THEMENAME); ?>
                    </a>
                </li>
                <?php
                endif;
            }
        }
        ?>
    </ul>
</div>
