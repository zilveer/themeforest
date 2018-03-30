<?php
  
// Counter Circle

add_shortcode('counter_circle', 'venedor_shortcode_counter_circle');
add_shortcode('counter_box', 'venedor_shortcode_counter_box');

function venedor_shortcode_counter_circle($atts, $content = null) {
    global $venedor_design;

    extract(shortcode_atts(array(
        'filledcolor' => '',
        'unfilledcolor' => '',
        'size' => '220',
        'speed' => '1000',
        'strokesize' => '11',
        'percent' => '100',
        'desc' => '',
        'desc_link' => '',
        'desc_fontsize' => '',
        'desc_color' => '',
        'class' => ''
    ), $atts));

    if(!$filledcolor) {
        $filledcolor = $venedor_design['btn-hbg-color'];
    }

    if(!$unfilledcolor) {
        $unfilledcolor = $venedor_design['block-bg-color'];
    }

    ob_start();
    ?>
    <div class="shortcode counter-circle-wrapper <?php echo $class ?>">
        <div class="counter-circle-content" data-unfilledcolor="<?php echo $unfilledcolor ?>" data-filledcolor="<?php echo $filledcolor ?>" data-percent="<?php echo $percent ?>" data-size="<?php echo $size ?>" data-speed="<?php echo $speed ?>" data-strokesize="<?php echo $strokesize ?>"
            <?php if ($size) : ?> style="width: <?php echo $size ?>px; height: <?php echo $size ?>px; line-height: <?php echo $size ?>px; font-size: <?php echo 50 * $size / 220 ?>px;"<?php endif; ?>>
            <?php echo do_shortcode($content) ?>
        </div>
        <?php if ($desc) : ?>
            <?php if ($desc_link) : ?><a href="<?php echo $desc_link ?>"><?php endif; ?>
            <div class="desc" style="<?php if ($desc_fontsize) echo 'font-size:'.$desc_fontsize.';'; ?><?php if ($desc_color) echo ' color:'.$desc_color.';' ?>"><?php echo $desc ?></div>
            <?php if ($desc_link) : ?></a><?php endif; ?>
        <?php endif; ?>
    </div>

    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

function venedor_shortcode_counter_box($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'value' => '1000',
        'unit' => '',
        'color' => '',
        'link' => '',
        'class' => ''
    ), $atts));

    ob_start();
    ?>
    <div class="shortcode counter-box-wrapper <?php echo $class ?>">
        <?php if ($link) : ?><a href="<?php echo $link ?>"><?php endif; ?>
        <div class="content-box-percentage"<?php if ($color): ?>style="color:<?php echo $color ?>;"<?php endif; ?>>
            <span class="display-percentage" data-percentage="<?php echo $value ?>">0</span>
            <span class="unit"><?php echo $unit ?></span>
        </div>
        <?php if ($link) : ?></a><?php endif; ?>
        <div class="counter-box-content">
            <?php echo do_shortcode($content) ?>
        </div>
    </div>
    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_counter_circle() {
        $vc_icon = venedor_vc_icon()."counter_circle.png";
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Counter Circle",
            "base" => "counter_circle",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "params" => array(
                array(
                    "type" => "colorpicker",
                    "heading" => "Filled Color",
                    "param_name" => "filledcolor",
                    "description" => "default: button hover background color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Unfilled Color",
                    "param_name" => "unfilledcolor",
                    "description" => "default: block background color"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Circle Size",
                    "param_name" => "size",
                    "value" => "220",
                    "description" => "numerical value (unit: pixels)",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Animation Speed",
                    "param_name" => "speed",
                    "value" => "1000",
                    "description" => "numerical value (unit: miliseconds)"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Stroke Size",
                    "param_name" => "strokesize",
                    "value" => "11",
                    "description" => "numerical value (unit: pixels)"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Filled Percent",
                    "param_name" => "percent",
                    "value" => "100",
                    "description" => "numerical value (min: 0, max: 100)",
                    "admin_label" => true
                ),
                array(
                    "type" => "textarea",
                    "heading" => "Description",
                    "param_name" => "desc",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Description Link",
                    "param_name" => "desc_link"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Description Font Size",
                    "param_name" => "desc_fontsize"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Description Color",
                    "param_name" => "desc_color"
                ),
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Counter_Circle extends WPBakeryShortCodesContainer {
            }
        }
    }

    function venedor_vc_shortcode_counter_box() {
        $vc_icon = venedor_vc_icon()."counter_box.png";;
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Counter Box",
            "base" => "counter_box",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Counter Value",
                    "param_name" => "value",
                    "value" => "1000",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Counter Unit",
                    "param_name" => "unit",
                    "admin_label" => true
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Counter Color",
                    "param_name" => "color"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Link URL",
                    "param_name" => "link"
                ),
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Counter_Box extends WPBakeryShortCodesContainer {
            }
        }
    }
}