<?php
global $post, $adv_search_which_header_show, $adv_search_over_header_pages, $adv_search_selected_pages;

if (is_plugin_active('revslider/revslider.php')) {
    $revslider_alias = get_post_meta($post->ID, 'fave_page_header_revslider', true);
    ?>
    <div class="header-media">
        <div class="page-banner-revolution-slider">
            <?php putRevSlider($revslider_alias) ?>
        </div>
        <?php
        if( $adv_search_which_header_show['header_rs'] != 0 ) {
            if( $adv_search_over_header_pages == 'only_home' ) {
                if (is_front_page()) {
                    get_template_part('template-parts/advanced-search/desktop', 'type2');
                }
            } else if( $adv_search_over_header_pages == 'all_pages' ) {
                get_template_part('template-parts/advanced-search/desktop', 'type2');

            } else if ( $adv_search_over_header_pages == 'only_innerpages' ){
                if (!is_front_page()) {
                    get_template_part('template-parts/advanced-search/desktop', 'type2');
                }
            } else if( $adv_search_over_header_pages == 'specific_pages' ) {
                if( is_page( $adv_search_selected_pages ) ) {
                    get_template_part('template-parts/advanced-search/desktop', 'type2');
                }
            }
        }
        ?>
    </div>

    <?php
}?>
