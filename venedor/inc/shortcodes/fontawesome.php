<?php
  
// FontAwesome Icons
add_shortcode('fontawesome', 'venedor_shortcode_fontawesome');
function venedor_shortcode_fontawesome($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'icon' => '',
        'size' => '',
        'fontsize' => '',
        'color' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    
    ob_start();
    ?>
    <span class="fa fa-<?php echo $icon ?> fa-<?php echo $size ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
          animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?> style="<?php if ($color) echo 'color:'.$color.';' ?><?php if ($fontsize) echo 'font-size:'.$fontsize.';' ?>"></span>
    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_fontawesome() {
        $vc_icon = venedor_vc_icon().'fontawesome.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Fontawesome Icon",
            "base" => "fontawesome",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "fontawesome_icon",
                    "heading" => "Icon Name",
                    "param_name" => "icon",
                    "admin_label" => true
                ),
                array(
                    "type" => "fontawesome_size",
                    "heading" => "Icon Size",
                    "param_name" => "size"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Icon Font Size",
                    "param_name" => "fontsize"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Icon Color",
                    "param_name" => "color"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Fontawesome extends WPBakeryShortCodes {
            }
        }
    }
}

