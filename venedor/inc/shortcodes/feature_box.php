<?php
  
// Feature Box
add_shortcode('feature_box_slider', 'venedor_shortcode_featurebox_slider');
add_shortcode('feature_box', 'venedor_shortcode_featurebox');

function venedor_shortcode_featurebox_slider($atts, $content = null) {

    extract(shortcode_atts(array(
        'title' => '',
        'arrow_pos' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    ob_start();
    ?>
<div class="shortcode feature-slider <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
    <?php if ($animation_type) : ?>
     animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
    <?php endif; ?>>
    <div class="product-slider">
    <?php if ($title) : ?>
    <h2 class="entry-title"><?php echo $title ?></h2>
    <?php endif; ?>
    <div class="product-row product-slider <?php if (!$title) echo ' notitle' ?> <?php if ($arrow_pos) echo $arrow_pos ?> clearfix">
        <div class="product-carousel owl-carousel post-carousel">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
</div></div>
<?php
    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}

function venedor_shortcode_featurebox($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'color' => '',
        'hcolor' => '',
        'size' => 124,
        'type' => 'circle',
        'image'  => '',
        'image_id' => '',
        'image_bordercolor'  => '',
        'image_hbordercolor' => '',
        'icon' => '',
        'icon_bg' => '',
        'icon_hbg' => '',
        'icon_color' => '',
        'icon_hcolor' => '',
        'icon_bordercolor'  => '',
        'icon_hbordercolor'  => '',
        'title' => '',
        'link' => '',
        'align' => 'center',
        'border' => 'true',
        'show_bg' => 'false',
        'bg_color' => '',
        'hbg_color' => '',
        'line_color' => '',
        'line_hcolor' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    if (!$image && $image_id)
        $image = wp_get_attachment_url($image_id);

    static $venedor_feature_box = 1;

    ob_start();
    ?>
<div class="feature-item">
    <div class="shortcode feature-box feature-box-<?php echo $venedor_feature_box ?> <?php if($align) echo 'text-'.$align; ?> <?php echo $class ?><?php if ($border != 'true') echo ' noborder' ?><?php if ($show_bg == 'true') echo ' hover' ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <?php if ($image || $icon) : ?>
        <div class="feature-image" style="width:<?php echo $size ?>px; height:<?php echo $size ?>px; border-radius:<?php echo ($type == 'rect')?'0':($size / 2) ?>px;">
            <?php if ($image) : ?>
                <img src="<?php echo str_replace( array( 'http:', 'https:' ), '', $image ); ?>" style="width:<?php echo $size - 4 ?>px; height:<?php echo $size - 4 ?>px; border-radius:<?php echo ($size - 4) / 2 ?>px" />
            <?php else : ?>
                <span class="fa fa-<?php echo $icon ?>" style="font-size:<?php echo $size * 0.4 ?>px; line-height:<?php echo $size - 4 ?>px;"></span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="feature-content" style="<?php if ($align == 'left') echo 'padding-left:'.($size + 20).'px;'; if ($align == 'right') echo 'padding-right:'.($size + 20).'px;'; ?>">
            <?php if ($link) : ?><a href="<?php echo $link ?>"><?php endif; ?>
            <h4><span><?php echo $title; ?></span><span class="line"></span></h4>
            <?php if ($link) : ?></a><?php endif; ?>
            <p><?php echo do_shortcode($content); ?></p>
        </div>
        <?php if ($color || ($hcolor && $border == 'true') || $bg_color || $hbg_color || $icon_bg || $image_bordercolor || $icon_bordercolor || $icon_hbg || $image_hbordercolor || $icon_hbordercolor || $icon_color || $icon_hcolor || $line_color || $line_hcolor) : ?>
        <style type="text/css">
            <?php if ($color) : ?>
                .feature-box-<?php echo $venedor_feature_box ?>,
                .feature-box-<?php echo $venedor_feature_box ?> h4  { color: <?php echo $color ?>; }
            <?php endif; ?>
            <?php if ($hcolor && $border == 'true') : ?>
                .feature-box-<?php echo $venedor_feature_box ?>.hover,
                .feature-box-<?php echo $venedor_feature_box ?>:hover,
                .feature-box-<?php echo $venedor_feature_box ?>.hover h4,
                .feature-box-<?php echo $venedor_feature_box ?>:hover h4,
                .feature-box-<?php echo $venedor_feature_box ?> a:hover h4,
                .feature-box-<?php echo $venedor_feature_box ?> a:focus h4{ color: <?php echo $hcolor ?>; }
            <?php endif; ?>
            <?php if ($bg_color) : ?>
                .feature-box-<?php echo $venedor_feature_box ?> { background-color: <?php echo $bg_color ?>; }
            <?php endif; ?>
            <?php if ($hbg_color) : ?>
                .feature-box-<?php echo $venedor_feature_box ?>.hover,
                .feature-box-<?php echo $venedor_feature_box ?>:hover { background-color: <?php echo $hbg_color ?>; border-color: <?php echo $hbg_color ?>; }
            <?php endif; ?>
            <?php if ($icon_bg || $image_bordercolor || $icon_bordercolor) : ?>
                .feature-box-<?php echo $venedor_feature_box ?> .feature-image {
                    <?php if ($icon_bg) : ?>background-color: <?php echo $icon_bg ?>;<?php endif ;?>
                    <?php if ($image_bordercolor) : ?>border-color: <?php echo $image_bordercolor ?>;<?php endif ;?>
                    <?php if ($icon_bordercolor) : ?>border-color: <?php echo $icon_bordercolor ?>;<?php endif ;?>
                }
            <?php endif; ?>
            <?php if ($icon_hbg || $image_hbordercolor || $icon_hbordercolor) : ?>
                .feature-box-<?php echo $venedor_feature_box ?>.hover .feature-image,
                .feature-box-<?php echo $venedor_feature_box ?>:hover .feature-image {
                    <?php if ($icon_hbg) : ?>background-color: <?php echo $icon_hbg ?>;<?php endif ;?>
                    <?php if ($image_hbordercolor) : ?>border-color: <?php echo $image_hbordercolor ?>;<?php endif ;?>
                    <?php if ($icon_hbordercolor) : ?>border-color: <?php echo $icon_hbordercolor ?>;<?php endif ;?>
                }
            <?php endif; ?>
            <?php if ($icon_color) : ?>
                .feature-box-<?php echo $venedor_feature_box ?> .feature-image .fa { color: <?php echo $icon_color ?>; }
            <?php endif; ?>
            <?php if ($icon_hcolor) : ?>
                .feature-box-<?php echo $venedor_feature_box ?>.hover .feature-image .fa,
                .feature-box-<?php echo $venedor_feature_box ?>:hover .feature-image .fa { color: <?php echo $icon_hcolor ?>; }
            <?php endif; ?>
            <?php if ($line_color) : ?>
                .feature-box-<?php echo $venedor_feature_box ?> .line { background-color: <?php echo $line_color ?>; }
            <?php endif; ?>
            <?php if ($line_hcolor) : ?>
                .feature-box-<?php echo $venedor_feature_box ?>.hover .line,
                .feature-box-<?php echo $venedor_feature_box ?>:hover .line { background-color: <?php echo $line_hcolor ?>; }
            <?php endif; ?>
        </style>
        <?php endif; ?>
    </div>
</div>
    <?php
    $venedor_feature_box++;
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_feature_box_slider() {
        $vc_icon = venedor_vc_icon().'feature_box_slider.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Feature Box Slider",
            "base" => "feature_box_slider",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'feature_box'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Arrow Position",
                    'param_name' => 'arrow_pos',
                    'value' => array("" => "", "Top" => "arrow-top", "Bottom" => "arrow-bottom"),
                    'description' => ''
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Feature_Box_Slider extends WPBakeryShortCodesContainer {
            }
        }
    }

    function venedor_vc_shortcode_feature_box() {
        $vc_icon = venedor_vc_icon().'feature_box.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Feature Box",
            "base" => "feature_box",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "params" => array(
                array(
                    "type" => "colorpicker",
                    "heading" => "Text Color",
                    "param_name" => "color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Text Hover Color",
                    "param_name" => "hcolor"
                ),
                array(
                    "type" => "label",
                    "heading" => "Configure with image or icon options",
                    "param_name" => "label"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Image or Icon Wrapper Size",
                    "param_name" => "size",
                    "value" => "124"
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Image or Icon Wrapper Type",
                    'param_name' => 'type',
                    'value' => array("Circle" => "circle", "Rect" => "rect"),
                    'description' => '',
                    "admin_label" => true
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
                    "heading" => "Image",
                    "param_name" => "image_id",
                    "admin_label" => true
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Image Border Color",
                    "param_name" => "image_bordercolor"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Image Hover Border Color",
                    "param_name" => "image_hbordercolor"
                ),
                array(
                    "type" => "fontawesome_icon",
                    "heading" => "FontAwesome Icon Name",
                    "param_name" => "icon",
                    "admin_label" => true
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Icon Background Color",
                    "param_name" => "icon_bg"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Icon Hover Background Color",
                    "param_name" => "icon_hbg"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Icon Color",
                    "param_name" => "icon_color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Icon Hover Color",
                    "param_name" => "icon_hcolor"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Icon Border Color",
                    "param_name" => "icon_bordercolor"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Icon Hover Border Color",
                    "param_name" => "icon_hbordercolor"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Link",
                    "param_name" => "link"
                ),
                array(
                    "type" => "align",
                    "heading" => "Align",
                    "param_name" => "align",
                    "value" => "center"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Background Color",
                    "param_name" => "bg_color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Hover Background Color",
                    "param_name" => "hbg_color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Line Color",
                    "param_name" => "line_color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Line Hover Color",
                    "param_name" => "line_hcolor"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Hover Effect, Show Image or Icon Wrapper",
                    "param_name" => "border",
                    "value" => "true"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Show Background",
                    "param_name" => "show_bg",
                    "value" => "false"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Feature_Box extends WPBakeryShortCodesContainer {
            }
        }
    }
}
