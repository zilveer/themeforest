<?php
  
// Brands Slider
add_shortcode('brands', 'venedor_shortcode_brands');
add_shortcode('brand', 'venedor_shortcode_brand');

function venedor_shortcode_brands($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'title' => '',
        'single_item' => 'false',
        'items' => 6,
        'items_desktop' => 4,
        'items_desktop_small' => 3,
        'items_tablet' => 2,
        'animation_type' => '',
        'arrow_pos' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    
    static $venedor_brands_id = 1;

    ob_start();
    ?>
    <div class="shortcode shortcode-brands <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <?php if ($title) : ?>
        <h2 class="entry-title brands-title"><?php echo $title ?></h2>
        <?php endif; ?>
        <?php echo ($single_item=='true'?'':'<div class="row">') ?><div id="brands-<?php echo $venedor_brands_id ?>" class="content-slider owl-carousel <?php echo ($single_item=='true'?'single':'') ?><?php if (!$title) echo ' notitle' ?> <?php if ($arrow_pos) echo $arrow_pos ?> clearfix">
            <?php echo do_shortcode($content); ?>
        </div><?php echo ($single_item=='true'?'':'</div>') ?>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#brands-<?php echo $venedor_brands_id ?>").owlCarousel({
                pagination : false,
                navigation : true,
                navigationText: false,
                singleItem: <?php echo ($single_item=='true'?'true':'false') ?>, 
                items: <?php echo $items ?>,
                itemsDesktop: [1199, <?php echo $items_desktop ?>],
                itemsDesktopSmall: [991, <?php echo $items_desktop_small ?>],
                itemsTablet: [750, <?php echo $items_tablet ?>],
                autoPlay: 5000
            });
        });
        </script>
    </div>
    <?php
    $venedor_brands_id++;
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

function venedor_shortcode_brand($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'title' => '',
        'image' => '',
        'image_id' => '',
        'link' => '',
        'target' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    if (!$image && $image_id)
        $image = wp_get_attachment_url($image_id);
    
    if (!$image)
        return;
    
    ob_start();
    ?>
    <div class="brand content-item <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <?php if ($link) : ?><a href="<?php echo $link ?>" title="<?php echo $title ?>" target="<?php echo $target ?>"><?php endif; ?>
            <img alt="<?php echo $title ?>" src="<?php echo str_replace( array( 'http:', 'https:' ), '', $image ) ?>"/>
        <?php if ($link) : ?></a><?php endif; ?>
    </div>

    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_brands() {
        $vc_icon = venedor_vc_icon().'brands.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Brands",
            "base" => "brands",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'brand'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Single Item",
                    "param_name" => "single_item",
                    "value" => "false"
                ),
                array(
                    "type" => "label",
                    "heading" => "If Single Item is 'false' then",
                    "param_name" => "label"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Items",
                    "param_name" => "items",
                    "value" => "6",
                    "description" => "window width >= 1200px"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Items on Desktop",
                    "param_name" => "items_desktop",
                    "value" => "4",
                    "description" => "992px <= window width < 1200px"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Items on Small Desktop",
                    "param_name" => "items_desktop_small",
                    "value" => "3",
                    "description" => "768px <= window width < 992px"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Items on Tablet",
                    "param_name" => "items_tablet",
                    "value" => "2",
                    "description" => "480px <= window width < 768px"
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
            class WPBakeryShortCode_Brands extends WPBakeryShortCodesContainer {
            }
        }
    }

    function venedor_vc_shortcode_brand() {
        $vc_icon = venedor_vc_icon().'brand.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Brand",
            "base" => "brand",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
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
                    "heading" => "Brand Image",
                    "param_name" => "image_id",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Link URL",
                    "param_name" => "link"
                ),
                array(
                    "type" => "link_target",
                    "heading" => "Link Target",
                    "param_name" => "target"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Brand extends WPBakeryShortCodes {
            }
        }
    }
}
