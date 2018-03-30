<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
$title = $atts['title'];
$latitude = $atts['latitude'];
$longitude = $atts['longitude'];
$zoom = (int)$atts['zoom'];
?>
<?php if(!empty($latitude) && !empty($longitude)):?>
    <!-- OPEN MAP -->
    <div class="call-to-action">
        <div class="w-container">
            <div class="hero-center-div">
                <a class="w-inline-block map-block" href="#" data-toggle="open">
                    <div class="mp-txt"><?php echo fw_theme_translate(esc_html($title));?></div>
                    <div class="map-arrow">
                        <div class="w-embed"><i class="fa fa-chevron-down"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="map map-shortcode">
        <div class="w-widget w-widget-map" data-widget-latlng="<?php echo esc_attr($latitude) .','. esc_attr($longitude);?>" data-widget-style="terrain" data-widget-zoom="<?php echo esc_attr($zoom);?>" data-disable-scroll="1"></div>
    </div>
    <!-- END OPEN MAP -->
<?php endif;?>