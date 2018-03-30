<?php
  
// Container
add_shortcode('container', 'venedor_shortcode_container');
function venedor_shortcode_container($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    
    ob_start();
    ?>
    <div class="shortcode container <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <?php echo do_shortcode($content) ?>
    </div>
    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_container() {
        $vc_icon = venedor_vc_icon().'container.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Container",
            "base" => "container",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            "show_settings_on_create" => false,
            'js_view' => 'VcColumnView',
            "params" => array(
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Container extends WPBakeryShortCodesContainer {
            }
        }
    }
}

