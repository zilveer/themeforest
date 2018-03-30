<?php
global $post, $property_map, $property_streetView, $prop_agent_email;
$size = 'houzez-property-detail-gallery';
$properties_images = rwmb_meta( 'fave_property_images', 'type=plupload_image&size='.$size, $post->ID );
$gallery_view = $map_view = $street_view = '';
$prop_default_active_tab = houzez_option('prop_default_active_tab');
if( $prop_default_active_tab == "image_gallery" ) {
    $gallery_view = 'in active';
} elseif( $prop_default_active_tab == "map_view" ) {
    $map_view = 'in active';
} elseif( $prop_default_active_tab == "street_view" ) {
    $street_view = 'in active';
} else {
    $gallery_view = 'in active';
}

if( !empty($properties_images) ) {
?>

<div class="detail-media detail-content-slideshow">
    <div class="tab-content">

        <div id="gallery" class="tab-pane fade <?php echo esc_attr( $gallery_view );?>">
            <div class="detail-slideshow">
                <div class="slideshow-main">
                    <div class="detail-slider">
                        <?php
                        foreach( $properties_images as $prop_image_id => $prop_image_meta ) {
                            echo '<div class="item" style="background-image: url('.esc_url( $prop_image_meta['url'] ).')">';
                                echo '<a class="popup-trigger banner-link" href="#">';

                                echo '</a>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="slider-thumbs-main">
                    <div class="slider-thumbs">
                        <?php
                        foreach( $properties_images as $prop_image_id=>$prop_image_meta ){
                            $slider_thumb = wp_get_attachment_image_src($prop_image_id,'houzez-widget-prop');
                            echo '<div>';
                            echo '<img src="'.esc_url( $slider_thumb[0] ).'" alt="'.esc_attr( $prop_image_meta['title'] ).'" width="100" height="70" />';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if( $property_map != 0 ) { ?>
            <div id="singlePropertyMap" class="tab-pane fade <?php echo esc_attr( $map_view );?>">
                <div class="mapPlaceholder">
                    <div class="loader-ripple">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <?php wp_nonce_field('houzez_map_ajax_nonce', 'securityHouzezMap', true); ?>
            <input type="hidden" name="prop_id" id="prop_id" value="<?php echo esc_attr($post->ID); ?>" />
        <?php } ?>

        <?php if( $property_streetView != 'hide' ) { ?>
            <div id="street-map" class="tab-pane fade <?php echo esc_attr( $street_view );?>"></div>
        <?php } ?>

    </div>

    <div class="visible-xs">
        <div class="header-detail table-list">
            <div class="header-left table-cell">
                <h1><?php the_title(); ?>
                    <?php if( houzez_taxonomy_simple('property_status') ) { ?>
                    <span class="label label-primary"><?php echo houzez_taxonomy_simple('property_status'); ?></span>
                    <?php } ?>
                </h1>
                <?php
                if( !empty( $prop_address )) {
                echo '<p>'.esc_attr( $prop_address ).'</p>';
                } ?>
            </div>
            <div class="header-right table-cell">
                <?php echo houzez_listing_price_v1(); ?>
            </div>
        </div>
    </div>

    <?php get_template_part( 'property-details/media-tabs' ); ?>
</div>

<?php } ?>