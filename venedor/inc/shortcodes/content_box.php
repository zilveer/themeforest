<?php

// Content Box
add_shortcode('content_box', 'venedor_shortcode_content_box');

function venedor_shortcode_content_box($atts, $content = null) {

    extract(shortcode_atts(array(
        "title" => '',
        "desc" => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    ob_start();
    ?>

    <div class="shortcode shortcode-content <?php if (!$title) echo ' notitle'; ?><?php if ($desc) echo ' with-desc'; ?> <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
            animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>

        <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>

        <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>

        <?php echo do_shortcode($content) ?>

    </div>
    <?php
    $str = ob_get_contents();
    ob_end_clean();
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_content_box() {
        $vc_icon = venedor_vc_icon().'content_box.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Content Box",
            "base" => "content_box",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "textarea",
                    "heading" => "Description",
                    "param_name" => "desc"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Content_Box extends WPBakeryShortCodesContainer {
            }
        }
    }
}