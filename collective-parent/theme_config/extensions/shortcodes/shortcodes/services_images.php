<?php
/**
 * Services Images
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_services_images($atts, $content = null) {
    extract(shortcode_atts(array('multi' => '','title' => ''), $atts));
    $arr_ids = explode(',',$multi);
    $args = array(
        'posts_per_page'=> -1,
        'post_type'     => 'service',
        'orderby'       => 'post_date',
        'order'         => 'DESC',
        'include'       => $arr_ids,
        'post_status'   => 'publish',
    );
    $services = get_posts($args);
    // for order in initial order
    $services_ord = array();
    foreach($arr_ids as $key=>$ord){
        foreach($services as $unord){
            if($ord==$unord->ID) {
                $services_ord[$key] = $unord;
                continue;
            }
        }
    }
    $out = '';
    if($title) $out .= '<div class="title clearfix"><h2>'.$title.'</h2></div>';
    $out .= '<div class="middle_row clearfix">
        <ul class="service_list">';
        foreach($services_ord as $item){
            $image = tfuse_page_options('thumbnail_image','',$item->ID);
            if($image!=''){
                $out .= '<li><a href="'.get_permalink($item->ID).'"><img src="'.$image.'" alt="'.$item->post_title.'"></a></li>';
            }
        }
    $out .= '</ul>
    </div>';

    return $out;
}

$atts = array(
    'name' => __('Services images','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 6,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title.','tfuse'),
            'id' => 'tf_shc_services_images_title',
            'value' => '',
            'type' => 'text',
        ),
        array(
            'name' => __('Enter the service','tfuse'),
            'desc' => __('Enter the service.','tfuse'),
            'id' => 'tf_shc_services_images_multi',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'service',
        )
    )
);

tf_add_shortcode('services_images', 'tfuse_services_images', $atts);