<?php
  
// Content Slider
add_shortcode('sw_slider', 'venedor_shortcode_slider');
add_shortcode('sw_slide', 'venedor_shortcode_slide');

function venedor_shortcode_slider($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'pagination' => 'false',
        'navigation' => 'true',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    
    static $venedor_slider_id = 1;

    ob_start();
    ?>
    <div class="shortcode shortcode-slider <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <div id="slider-<?php echo $venedor_slider_id ?>" class="sw-slider owl-carousel clearfix">
            <?php echo do_shortcode($content); ?>
        </div>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#slider-<?php echo $venedor_slider_id ?>").owlCarousel({
                pagination : <?php echo ($pagination == 'true')?'true':'false' ?>,
                navigation : <?php echo ($navigation == 'true')?'true':'false' ?>,
                navigationText: false,
                singleItem: true,
                //transitionStyle : "fade",
                autoPlay: 5000
            });
        });
        </script>
    </div>
    <?php
    $venedor_slider_id++;
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

function venedor_shortcode_slide($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'class' => ''
    ), $atts));
    
    ob_start();
    ?>
    <div class="shortcode slide <?php echo $class ?>">
        <?php echo do_shortcode($content); ?>
    </div>

    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_sw_slider() {
        $vc_icon = venedor_vc_icon().'sw_slider.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => __("SW Slider", "venedor"),
            "base" => "sw_slider",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'sw_slide'),
            "params" => array(
                array(
                    "type" => "boolean",
                    "heading" => __("Pagination", "venedor"),
                    "param_name" => "pagination",
                    "value" => "false"
                ),
                array(
                    "type" => "boolean",
                    "heading" => __("Navigation", "venedor"),
                    "param_name" => "navigation",
                    "value" => "true"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Sw_Slider extends WPBakeryShortCodesContainer {
            }
        }
    }

    function venedor_vc_shortcode_sw_slide() {
        $vc_icon = venedor_vc_icon().'sw_slide.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => __("SW Slide", "venedor"),
            "base" => "sw_slide",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_child" => array('only' => 'sw_slider'),
            "params" => array(
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Sw_Slide extends WPBakeryShortCodesContainer {
            }
        }
    }
}
