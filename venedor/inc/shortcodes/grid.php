<?php

// Grid
add_shortcode('grid_container', 'venedor_shortcode_grid_container');
add_shortcode('grid_item', 'venedor_shortcode_grid_item');

function venedor_shortcode_grid_container($atts, $content = null) {

    extract(shortcode_atts(array(
        'grid_size' => '0px',
        'gutter_size' => '5px',
        'max_width' => '767px',
        'class' => ''
    ), $atts));

    static $venedor_grid_id = 1;

    ob_start();
    ?>
    <div class="shortcode shortcode-grid <?php echo $class ?>" style="margin-top:<?php echo $gutter_size ?>; margin-bottom:<?php echo $gutter_size ?>">
        <div id="grid-<?php echo $venedor_grid_id ?>" class="grid clearfix">
            <div class="grid-sizer" style="width:<?php echo $grid_size ?>"></div>
            <div class="gutter-sizer" style="width:<?php echo $gutter_size ?>"></div>
            <?php echo do_shortcode($content); ?>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var $grid = $("#grid-<?php echo $venedor_grid_id ?>");
                $grid.find("img").imagesLoaded(function() {
                    $grid.packery({
                        itemSelector: '.grid-item',
                        columnWidth: '.grid-sizer',
                        gutter: '.gutter-sizer'
                    });
                });
            });
        </script>
        <style>
            @media (max-width:<?php echo $max_width ?>) {
                #grid-<?php echo $venedor_grid_id ?> .grid-item {
                    width: 100% !important;
                }
            }
        </style>
    </div>
    <?php
    $venedor_grid_id++;
    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}

function venedor_shortcode_grid_item($atts, $content = null) {

    extract(shortcode_atts(array(
        'width' => '200px',
        'class' => ''
    ), $atts));

    ob_start();
    ?>
    <div class="shortcode grid-item <?php echo $class ?>" style="width:<?php echo $width ?>">
        <?php echo do_shortcode($content); ?>
    </div>

    <?php
    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_grid() {

        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        $vc_icon = venedor_vc_icon().'grid_container.png';
        vc_map( array(
            "name" => __("Grid Container", "venedor"),
            "base" => "grid_container",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'grid_item'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Grid Size", "venedor"),
                    "param_name" => "grid_size",
                    "value" => "0px"
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Gutter Size", "venedor"),
                    "param_name" => "gutter_size",
                    "value" => "5px"
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Max Width", "venedor"),
                    "param_name" => "max_width",
                    "description" => "Will be show as grid only when window width > max width.",
                    "value" => "767px"
                ),
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Grid_Container extends WPBakeryShortCodesContainer {
            }
        }

        $vc_icon = venedor_vc_icon().'grid_item.png';
        vc_map( array(
            "name" => __("Grid Item", "venedor"),
            "base" => "grid_item",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_child" => array('only' => 'grid_container'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Width", "venedor"),
                    "param_name" => "width",
                    "value" => "200px"
                ),
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Grid_Item extends WPBakeryShortCodesContainer {
            }
        }
    }
}
