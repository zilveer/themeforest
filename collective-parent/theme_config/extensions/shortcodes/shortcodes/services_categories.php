<?php
/**
 * Services Categories
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_services_categories($atts, $content = null) {
    extract(shortcode_atts(array('title' => '', 'multi' => ''), $atts));
    $arr_ids = explode(',',$multi);
    $uniq = rand(100,200);
    $args = array(
        'hide_empty'    => true,
        'parent'        => 0,
        'child_of'      => 0,
        'fields'        => 'all',
        'hierarchical'  => true,
        'include'       => $arr_ids
    );
    $terms = get_terms( 'services', $args );
    // for order in initial order
    $term_arr_ord = array();
    foreach($arr_ids as $key=>$ord){
        foreach($terms as $unord){
            if($ord==$unord->term_id) {
                $term_arr_ord[$key] = $unord;
                continue;
            }
        }
    }
    $out = '';
    if($title !='' ) $out .= '<div class="title clearfix"><h2>'.tfuse_qtranslate($title).'</h2></div>';
    $out .= '<div class="services_carousel carousel clearfix">
        <div class="services_carousel_inner">
            <div class="row">
                <div id="service_list'.$uniq.'">';
                    foreach($term_arr_ord as $item){
                        $image = tfuse_options('image','',$item->term_id);
                        $link = get_term_link($item->slug,'services');
                        if($image != ''){
                            $out .= '<div class="service_item" style="background:'.tfuse_options('bg_image','#ff6666',$item->term_id).'">
                                <div class="service_img"><a href="'.$link.'"><img src="'.$image.'" alt="'.$item->name.'"></a></div>
                                <div class="service_title clearfix"><h5><a href="'.$link.'">'.$item->name.'</a></h5></div>
                            </div>';
                        }
                    }
                $out .= '</div>
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
    'name' => __('Services categories','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 6,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title.','tfuse'),
            'id' => 'tf_shc_services_categories_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Enter the service category','tfuse'),
            'desc' => __('Enter the service category.','tfuse'),
            'id' => 'tf_shc_services_categories_multi',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'services',
        )
    )
);

tf_add_shortcode('services_categories', 'tfuse_services_categories', $atts);