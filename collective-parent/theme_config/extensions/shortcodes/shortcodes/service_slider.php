<?php
/**
 * Services Slider
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_services_slider($atts, $content = null) {
    $out = '';
    $uniq = rand(1,100);
    extract(shortcode_atts(array('title' => ''), $atts));
    $get_services_slider = do_shortcode($content);

    if($title != '') $out .= '<div class="title clearfix"><h2>'.$title.'</h2></div>';
    $out .= '<div class="services_carousel carousel clearfix">
        <div class="services_carousel_inner">
            <div class="row">
                <div id="service_list'.$uniq.'">'.$get_services_slider.'</div>
            </div>
        </div>
        <div class="carousel_nav"><a class="prev" id="service_item_prev'.$uniq.'" href="#"></a><a class="link_all" href="?post_type=service"></a><a class="next" id="service_item_next'.$uniq.'" href="#"></a></div>
        <script>
            jQuery(window).load(function() {
                jQuery("#service_list'.$uniq.'").carouFredSel({
                    width: "100%",
                    height: "variable",
                    items: {
                        visible: "variable",
                        minimum: 1,
                        width: "variable",
                        height: "variable"
                    },
                    scroll: {
                        items: 1,
                        pauseOnHover: true
                    },
                    auto: false,
                    prev: "#service_item_prev'.$uniq.'",
                    next: "#service_item_next'.$uniq.'",
                    swipe: true,
                    mousewheel: false
                });
            });
        </script>
    </div>';

    return $out;
}

$atts = array(
    'name' => __('Services Slider','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Title for Services Slider','tfuse'),
            'id' => 'tf_shc_services_slider_title',
            'value' => '',
            'divider' => TRUE,
            'type' => 'text'
        ),
        array(
            'name' => __('Select service','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_services_slider_service',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'options' => tfuse_list_services(),
            'type' => 'select',
        ),
        array(
            'name' => __('Background','tfuse'),
            'desc' => 'Enter background color. Ex: #ccc',
            'id' => 'tf_shc_services_slider_background',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable tf_shc_addable_last'),
            'divider' => TRUE,
            'type' => 'text'
        )
    )
);

tf_add_shortcode('services_slider', 'tfuse_services_slider', $atts);

function tfuse_service_slide($atts, $content = null) {
    extract(shortcode_atts(array('service' => '','background' => ''), $atts));
    $item = get_post($service);
    $image = tfuse_page_options('thumbnail_image','',$item->ID);
    if($image != ''){
        $result = '<div class="service_item rounded_corners">
                <div class="service_img" style="background:'.$content.'"><a href="'.get_permalink($item->ID).'"><img src="'.$image.'" alt="'.$item->post_title.'"></a></div>
                <div class="service_title clearfix"><h5>'.$item->post_title.'</h5></div>
              </div>';
        return $result;
    }
}

$atts = array(
    'name' => __('Service slide','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Select service','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_service_slide_service',
            'value' => '',
            'options' => tfuse_list_services(),
            'type' => 'select',
        ),
        array(
            'name' => __('Background','tfuse'),
            'desc' => 'Enter background color. Ex: #ccc',
            'id' => 'tf_shc_service_slide_background',
            'value' => '',
            'type' => 'text',
            'divider' => true
        )
    )
);

add_shortcode('service_slide', 'tfuse_service_slide', $atts);