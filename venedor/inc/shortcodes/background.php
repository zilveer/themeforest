<?php
  
// Background
add_shortcode('background', 'venedor_shortcode_background');
function venedor_shortcode_background($atts, $content = null) {

    global $venedor_design;

    extract(shortcode_atts(array(
        'bg_color' => '',
        'color' => '',
        'link_color' => '',
        'image' => '',
        'image_id' => '',
        'padding' => '30px 30px 30px 30px',
        'parallax' => 0,
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    if (!$image && $image_id)
        $image = wp_get_attachment_url($image_id);

    static $venedor_background = 1;

    ob_start();
    ?>
    <div class="shortcode shortcode-bg shortcode-bg-<?php echo $venedor_background ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
        animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>
         style="padding:<?php echo $padding; ?>;<?php if ($bg_color) : ?>background-color:<?php echo $bg_color ?>;<?php endif; ?>">
        <?php if ($image) : ?>
        <div class="bg-image sw-parallax" data-velocity="<?php echo $parallax ?>" style="background-image:url(<?php echo str_replace( array( 'http:', 'https:' ), '', $image ) ?> ); "></div>
        <?php endif; ?>
        <div class="bg-content">
        <?php echo do_shortcode($content) ?>
        </div>
        <?php if ($color || $link_color) : ?>
        <style type="text/css">
            <?php if ($color) : ?>
                .shortcode-bg-<?php echo $venedor_background ?>,
                .shortcode-bg-<?php echo $venedor_background ?> h1,
                .shortcode-bg-<?php echo $venedor_background ?> h2,
                .shortcode-bg-<?php echo $venedor_background ?> h3,
                .shortcode-bg-<?php echo $venedor_background ?> h4,
                .shortcode-bg-<?php echo $venedor_background ?> h5,
                #main .shortcode-bg-<?php echo $venedor_background ?> .title-desc,
                #main .shortcode-bg-<?php echo $venedor_background ?> .slider-desc,
                .shortcode-bg-<?php echo $venedor_background ?> .osc-progressbar-label,
                .shortcode-bg-<?php echo $venedor_background ?> .sr-only { color: <?php echo $color ?>; }
                .shortcode-bg-<?php echo $venedor_background ?> .products .product > .inner { background: transparent; }
                .shortcode-bg-<?php echo $venedor_background ?> .person .person-role { color: <?php echo $venedor_design['link-color']['regular'] ?>; }
            <?php endif; ?>
            <?php if ($link_color) : ?>
                .shortcode-bg-<?php echo $venedor_background ?> a { color: <?php echo $link_color ?>; }
                .shortcode-bg-<?php echo $venedor_background ?> .btn,
                .shortcode-bg-<?php echo $venedor_background ?> .button,
                .shortcode-bg-<?php echo $venedor_background ?> .owl-theme .owl-controls .owl-buttons div { color: <?php echo $link_color ?>; background: transparent; border-color: <?php echo $link_color ?>; }
                .shortcode-bg-<?php echo $venedor_background ?> .btn:hover, .shortcode-bg-<?php echo $venedor_background ?> .btn:focus,
                .shortcode-bg-<?php echo $venedor_background ?> .button:hover, .shortcode-bg-<?php echo $venedor_background ?> .button:focus,
                .shortcode-bg-<?php echo $venedor_background ?> .owl-theme .owl-controls .owl-buttons div:hover { background: <?php echo $venedor_design['btn-hbg-color'] ?>; border-color: <?php echo $venedor_design['btn-hborder']['border-color'] ?>; }
            <?php endif; ?>
        </style>
        <?php endif; ?>
    </div>
    <?php
    $venedor_background++;
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_background() {
        $vc_icon = venedor_vc_icon().'background.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Background",
            "base" => "background",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "params" => array(
                array(
                    "type" => "colorpicker",
                    "heading" => "Background Color",
                    "param_name" => "bg_color"
                ),
                array(
                    "type" => "label",
                    "heading" => "Input Image URL or Select Image.",
                    "param_name" => "label"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Image URL",
                    "param_name" => "image",
                    "admin_label" => true
                ),
                array(
                    "type" => "attach_image",
                    "heading" => "Background Image",
                    "param_name" => "image_id",
                    "admin_label" => true
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Text Color",
                    "param_name" => "color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Link Color",
                    "param_name" => "link_color"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Padding",
                    "param_name" => "padding",
                    "value" => "30px 30px 30px 30px"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Parallax",
                    "param_name" => "parallax",
                    "value" => "0",
                    "description" => "numerical value",
                    "admin_label" => true
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Background extends WPBakeryShortCodesContainer {
            }
        }
    }
}
