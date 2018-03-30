<?php
use \Handyman\Front as F;
global $wp_customize;

$tl_key = '';
if((is_page() && !is_page_template('template-blog.php'))){
    $tl_key = 'cpage-';
}

if(!F\tl_copt('footer-' . $tl_key . 'map-show')){
    return;
}

$tl_map_height   = F\tl_copt('footer-' . $tl_key . 'map-height');
$tl_map_zoom    = F\tl_copt('footer-' . $tl_key . 'map-zoom');

$tl_map_lat     = F\tl_copt('contact-map-lat');
$tl_map_long    = F\tl_copt('contact-map-long');
$tl_map_address = F\tl_copt('contact-address');


$long_lat = '';

if($tl_map_lat && $tl_map_long){
    $long_lat = $tl_map_long . ',' . $tl_map_lat;
    $long_lat =  $tl_map_lat . ',' . $tl_map_long;
}

if ( !isset( $wp_customize ) ) {
    wp_enqueue_script( LAYERS_THEME_SLUG . " -map-api","//maps.googleapis.com/maps/api/js?sensor=false");
}  // Enqueue the map js

?>
<section class="widget content-vertical-massive layers-contact-widget no-inset-top no-inset-bottom">
    <div class="grid">
        <div class="column no-push-bottom span-12">
            <?php if ( isset($wp_customize) ) { ?>
                <div class="layers-map-static" style="height: <?php echo esc_attr( $tl_map_height ); ?>px; overflow: hidden;">
                    <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo esc_attr( $long_lat ); ?>&zoom=<?php echo esc_attr($tl_map_zoom);?>&size=1960x<?php echo esc_attr($tl_map_height) ?>&scale=3&markers=color:red|<?php echo esc_attr( $long_lat ); ?>" class="google-map-img" />
                </div>
            <?php } else { ?>
                <div class="layers-map" data-zoom-level="<?php echo esc_attr($tl_map_zoom);?>" style="height: <?php echo esc_attr( $tl_map_height ); ?>px;" <?php if( '' != $long_lat ) { ?>data-longlat="<?php echo esc_attr($long_lat); }?>"></div>
            <?php } ?>

        </div>
    </div>
</section>