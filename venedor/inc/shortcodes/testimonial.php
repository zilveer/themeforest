<?php
  
// Testimonials Slider
add_shortcode('testimonials', 'venedor_shortcode_testimonials');
add_shortcode('testimonial', 'venedor_shortcode_testimonial');

function venedor_shortcode_testimonials($atts, $content = null) {
    
    global $venedor_design;
    
    extract(shortcode_atts(array(
        'title' => '',
        'type' => 'normal',
        'color' => '',
        'shadow' => '',
        'single_item' => 'true',
        'items' => 3,
        'items_desktop' => 3,
        'items_desktop_small' => 2,
        'arrow_pos' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    
    static $venedor_testimonials_id = 1;

    ob_start();
    ?>
    <div class="shortcode shortcode-testimonials <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <?php if ($title) : ?>
        <h2 id="testimonials-title-<?php echo $venedor_testimonials_id ?>" class="testimonials-title <?php echo $type; ?> <?php if ($type !== 'banner') echo 'entry-title' ?>">
            <?php echo $title ?>
        </h2>
        <?php if ($type != 'normal') : ?><div id="testimonials-line-<?php echo $venedor_testimonials_id ?>" class="testimonials-line"></div><?php endif; ?>
        <?php endif; ?>
        <?php echo ($single_item=='true'?'':'<div class="row">') ?><div id="testimonials-<?php echo $venedor_testimonials_id ?>" class="content-slider owl-carousel <?php echo $type ?> <?php echo ($single_item=='true'?'single':'') ?><?php if (!$title) echo ' notitle' ?> <?php if ($arrow_pos) echo $arrow_pos ?> clearfix">
            <?php echo do_shortcode($content); ?>
        </div><?php echo ($single_item=='true'?'':'</div>') ?>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#testimonials-<?php echo $venedor_testimonials_id ?>").owlCarousel({
                //transitionStyle : "fade",
                autoPlay: 5000,
                <?php if ($type != 'normal') : ?>
                pagination : true,
                navigation : false,
                singleItem: true
                <?php else : ?>
                pagination : false,
                navigation : true,
                navigationText: false,
                singleItem: <?php echo ($single_item=='true'?'true':'false') ?>, 
                items: <?php echo $items ?>,
                itemsDesktop: [1199, <?php echo $items_desktop ?>],
                itemsDesktopSmall: [991, <?php echo $items_desktop_small ?>],
                itemsTablet: [750, 1]
                <?php endif; ?>
            });
        });
        </script>
        <?php if ($color) : ?>
        <style type="text/css">
            #testimonials-title-<?php echo $venedor_testimonials_id ?>,
            #testimonials-<?php echo $venedor_testimonials_id ?> * { 
                color: <?php echo $color ?> !important;
                <?php if ($shadow) : ?>
                text-shadow: <?php echo $shadow ?> !important;
                <?php endif; ?>
            }
            #testimonials-<?php echo $venedor_testimonials_id ?> .owl-controls .owl-page span {
                background-color: <?php echo $color ?> !important;
                border-color: <?php echo $color ?> !important;
                <?php if ($shadow) : ?>
                text-shadow: <?php echo $shadow ?> !important;
                <?php endif; ?>
            }
			#testimonials-<?php echo $venedor_testimonials_id ?> .owl-controls .owl-page.active span {
                background-color: <?php echo $venedor_design['btn-hbg-color'] ?> !important;
                border-color: <?php echo $venedor_design['btn-hbg-color'] ?> !important;
                <?php if ($shadow) : ?>
                text-shadow: <?php echo $shadow ?> !important;
                <?php endif; ?>
            }
            #testimonials-<?php echo $venedor_testimonials_id ?> a:hover,
            #testimonials-<?php echo $venedor_testimonials_id ?> a:focus,
            #testimonials-<?php echo $venedor_testimonials_id ?> a:hover *,
            #testimonials-<?php echo $venedor_testimonials_id ?> a:focus * {
                color: <?php echo $venedor_design['btn-hbg-color'] ?> !important;
            }
            #testimonials-line-<?php echo $venedor_testimonials_id ?> {
                <?php if ($shadow) : ?>
                -webkit-box-shadow: <?php echo $shadow ?> !important;
                   -moz-box-shadow: <?php echo $shadow ?> !important;
                        box-shadow: <?php echo $shadow ?> !important;
                <?php endif; ?>
            }
        </style>
        <?php endif; ?>
    </div>
    <?php
    $venedor_testimonials_id++;
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

function venedor_shortcode_testimonial($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'title' => '',
        'name' => '',
        'photo' => '',
        'photo_id' => '',
        'link' => '',
        'target' => '',
        'date' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    if (!$photo && $photo_id)
        $photo = wp_get_attachment_url($photo_id);

    ob_start();
    ?>
    <div class="shortcode testimonial content-item <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <div class="testimonial-details">
            <?php if ($title) : ?>
            <div class="testimonial-title"><?php echo $title ?></div>
            <?php endif; ?>
            <?php echo do_shortcode($content) ?>
        </div>
    
        <?php if ($photo) : ?>
        <div class="testimonial-meta clearfix">
            <div class="testimonial-photo"><img src="<?php echo str_replace( array( 'http:', 'https:' ), '', $photo ) ?>"/></div>
            <div class="meta-content">
        <?php else : ?>
        <div class="testimonial-meta clearfix">
            <div class="meta-content no-photo">
        <?php endif; ?>
                <?php if ($link) : ?><a href="<?php echo $link ?>" target="<?php echo $target ?>"><?php endif; ?>
                <span class="meta-name"><?php echo $name ?></span>
                <?php if ($link) : ?></a>,
                <?php endif; ?>
                <?php if ($date) : ?>
                <br/><span class="meta-date"><?php echo $date ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_testimonials() {
        $vc_icon = venedor_vc_icon().'testimonials.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Testimonials",
            "base" => "testimonials",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'testimonial'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "testimonial_type",
                    "heading" => "Type",
                    "param_name" => "type",
                    "value" => "normal",
                    "admin_label" => true
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Color",
                    "param_name" => "color"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Shadow",
                    "param_name" => "shadow"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Single Item",
                    "param_name" => "single_item",
                    "value" => "true"
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
                    "value" => "3",
                    "description" => "window width >= 1200px"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Items on Desktop",
                    "param_name" => "items_desktop",
                    "value" => "3",
                    "description" => "992px <= window width < 1200px"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Items on Small Desktop",
                    "param_name" => "items_desktop_small",
                    "value" => "2",
                    "description" => "768px <= window width < 992px"
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
            class WPBakeryShortCode_Testimonials extends WPBakeryShortCodesContainer {
            }
        }
    }

    function venedor_vc_shortcode_testimonial() {
        $vc_icon = venedor_vc_icon().'testimonial.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Testimonial",
            "base" => "testimonial",
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
                    "type" => "textfield",
                    "heading" => "Name",
                    "param_name" => "name",
                    "admin_label" => true
                ),
                array(
                    "type" => "label",
                    "heading" => "Input Photo URL or Select Photo.",
                    "param_name" => "label"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Photo URL",
                    "param_name" => "photo"
                ),
                array(
                    "type" => "attach_image",
                    "heading" => "Photo",
                    "param_name" => "photo_id"
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
                array(
                    "type" => "textfield",
                    "heading" => "Date",
                    "param_name" => "date",
                    "admin_label" => true
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Testimonial extends WPBakeryShortCodesContainer {
            }
        }
    }
}
