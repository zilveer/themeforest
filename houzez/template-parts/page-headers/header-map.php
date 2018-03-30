<?php
global $fave_header_full_screen, $post, $adv_search_which_header_show, $adv_search_over_header_pages, $adv_search_selected_pages;
$geo_location = houzez_option('geo_location');
?>

<div class="header-media">
    <div id="houzez-gmap-main" class="<?php echo esc_attr( $fave_header_full_screen ); ?>">
        <div id="houzez-listing-map">
        </div>
        <div id="houzez-map-loading">
            <div class="mapPlaceholder">
                <div class="loader-ripple">
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <?php wp_nonce_field('houzez_header_map_ajax_nonce', 'securityHouzezHeaderMap', true); ?>

        <div  class="map-arrows-actions">
            <button id="listing-mapzoomin" class="map-btn"><i class="fa fa-plus"></i> </button>
            <button id="listing-mapzoomout" class="map-btn"><i class="fa fa-minus"></i></button>
            <input type="text" id="google-map-search" placeholder="<?php esc_html_e('Google Map Search', 'houzez'); ?>" class="map-search">
        </div>
        <div class="map-next-prev-actions">
            <ul class="dropdown-menu" aria-labelledby="houzez-gmap-view">
                <li><a href="#" class="houzezMapType" data-maptype="roadmap"><span><?php esc_html_e( 'Roadmap', 'houzez' ); ?></span></a></li>
                <li><a href="#" class="houzezMapType" data-maptype="satellite"><span><?php esc_html_e( 'Satelite', 'houzez' ); ?></span></a></li>
                <li><a href="#" class="houzezMapType" data-maptype="hybrid"><span><?php esc_html_e( 'Hybrid', 'houzez' ); ?></span></a></li>
                <li><a href="#" class="houzezMapType" data-maptype="terrain"><span><?php esc_html_e( 'Terrain', 'houzez' ); ?></span></a></li>
            </ul>
            <button id="houzez-gmap-view" class="map-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-globe"></i> <span><?php esc_html_e( 'View', 'houzez' ); ?></span></button>

            <button id="houzez-gmap-prev" class="map-btn"><i class="fa fa-chevron-left"></i> <span><?php esc_html_e('Prev', 'houzez'); ?></span></button>
            <button id="houzez-gmap-next" class="map-btn"><span><?php esc_html_e('Next', 'houzez'); ?></span> <i class="fa fa-chevron-right"></i></button>
        </div>
        <div  class="map-zoom-actions">
            <?php if( $geo_location != 0 ) { ?>
                <span id="houzez-gmap-location" class="map-btn"><i class="fa fa-map-marker"></i> <span><?php esc_html_e('My location', 'houzez'); ?></span></span>
            <?php } ?>
            <span id="houzez-gmap-full"  class="map-btn"><i class="fa fa-arrows-alt"></i> <span><?php esc_html_e('Fullscreen', 'houzez'); ?></span></span>
        </div>
    </div>
    <?php
    if( $adv_search_which_header_show['header_map'] != 0 ) {
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