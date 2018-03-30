<div class="mkdf-bnl-navigation-holder">
    <div data-rel="<?php echo esc_attr($params['query_result']->max_num_pages) ?> " class="mkdf-btn mkdf-bnl-load-more mkdf-load-more mkdf-btn-solid mkdf-btn-large">
        <i class="mkdf-icon-ion-icon ion-chevron-right mkdf-btn-icon-element"></i>
        <?php echo get_next_posts_link( esc_html__('Show More', 'hashmag'), $params['query_result']->max_num_pages ) ?>
    </div>
    <div class="mkdf-btn mkdf-bnl-load-more-loading mkdf-btn-solid mkdf-btn-large">
        <i class="mkdf-icon-ion-icon ion-chevron-right mkdf-btn-icon-element"></i>
        <a href="javascript: void(0)" class="">
            <?php echo esc_html__('Loading...', 'hashmag') ?>
        </a>
    </div>
</div>