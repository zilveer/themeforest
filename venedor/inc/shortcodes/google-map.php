<?php

// Google Map
add_shortcode('map', 'venedor_shortcode_map');

function venedor_shortcode_map($atts, $content = null) {

    wp_enqueue_script( 'google.maps' );
    wp_enqueue_script( 'jquery.ui.map' );

    extract(shortcode_atts(array(
        'address' => '',
        'type' => 'roadmap',
        'width' => '100%',
        'height' => '300px',
        'zoom' => '14',
        'scrollwheel' => 'true',
        'scale' => 'true',
        'zoom_pancontrol' => 'true',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    static $venedor_map_counter = 1;

    $addresses = explode('|', $address);

    $markers = '';
    foreach($addresses as $address_string) {
        $markers .= "{
            address: '{$address_string}',
            html: {
                content: '{$address_string}',
                popup: true
            } 
        },";    
    }

    ob_start();
    ?>
    <script type='text/javascript'>
    jQuery(document).ready(function($) {
        jQuery('#gmap-<?php echo $venedor_map_counter ?>').goMap({
            address: '<?php echo $addresses[0] ?>',
            zoom: <?php echo $zoom ?>,
            scrollwheel: <?php echo $scrollwheel ?>,
            scaleControl: <?php echo $scale ?>,
            navigationControl: <?php echo $zoom_pancontrol ?>,
            maptype: '<?php echo $type ?>',
            markers: [<?php echo $markers ?>]
        });
    });
    </script>

    <div class="shortcode google-map <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?> id="gmap-<?php echo $venedor_map_counter ?>"
         style="width:<?php echo $width ?>;height:<?php echo $height ?>;">
    </div>
    <?php
    $str = ob_get_contents();
    ob_end_clean();

    $venedor_map_counter++;

    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_google_map() {
        $vc_icon = venedor_vc_icon().'google_map.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Google Map",
            "base" => "map",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textarea",
                    "heading" => "Address",
                    "param_name" => "address",
                    "description" => '"|" separated list of google map addresses.',
                    "admin_label" => true
                ),
                array(
                    "type" => "gmap_type",
                    "heading" => "Type",
                    "param_name" => "type",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Width",
                    "param_name" => "width",
                    "value" => "100%"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Height",
                    "param_name" => "height",
                    "value" => "300px"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Zoom Level",
                    "param_name" => "zoom",
                    "value" => "14"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Scroll Wheel",
                    "param_name" => "scrollwheel",
                    "value" => "true"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Show Scale",
                    "param_name" => "scale",
                    "value" => "true"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Show Zoom Pan Control",
                    "param_name" => "zoom_pancontrol",
                    "value" => "true"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Google_Map extends WPBakeryShortCodes {
            }
        }
    }
}