<?php
add_shortcode('cs-event-carousel', 'cs_shortcode_event_carousel');
function cs_shortcode_event_carousel($atts, $content = null) {
    extract(shortcode_atts(array(
    'title' => '',
    'heading_size' =>'h3',
    'title_color' =>'',
    'subtitle' => '',
    'subtitle_heading_size'=>'h4',
    'description' => '',
    'category' => '',
    'styles'=> 1,
    'type' => 0,
    'crop_image' => false,
    'width_image' => 300,
    'height_image' => 200,
    'width_item' => 150,
    'margin_item' => 20,
    'auto_scroll' => false,
    'show_nav' => false,
    'same_height' => false,
    'show_title' => false,
    'show_date' => false,
    'show_description' => false,
    'excerpt_length' => 100,
    'read_more' => '',
    'rows' => 1,
    'posts_per_page' => 12,
    'orderby' => 'event_start_date',
    'order' => 'DESC',
    'el_class' => ''
    ), $atts));
    
    
    $date_sever = date_i18n('Y-m-d');

    $_query_lv1 = array(
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'meta_query'        => array(
            array(
                'key' => '_event_start_date',
                'compare' => 'EXISTS',
                'type' => 'DATE'
            ),
            array(
                'key' => '_event_end_date',
                'compare' => '>=',
                'value' => $date_sever,
                'type' => 'DATE'
            )
        ),
        'orderby'   => 'meta_value',
        'meta_key'  => '_event_start_date',
        'order'     => 'ASC'
    );

    if(!empty($category)){
        $_query_lv1['tax_query'] = array(
            array(
                'taxonomy' => 'event-categories',
                'field'    => 'term_id',
                'terms'    => explode(',', $category),
            )
        );
    }

    $_event = new WP_Query($_query_lv1);

    $date = time() . '_' . uniqid(true);

    wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', 'jquery', '1.0', TRUE);
    wp_register_script('jm-bxslider', get_template_directory_uri() . '/js/jquery.jm-bxslider.js', 'jquery', '1.0', TRUE);

    wp_enqueue_script('bxslider');
    wp_enqueue_script('jm-bxslider');

    $cl_show = '';
    if ($title != "" || $description != "") {
        $cl_show .= 'show-header';
    }
    if ($show_nav == true || $show_nav == 1) {
        $cl_show .= ' show-nav';
    }
    ob_start();
    if($_event){
        require 'styles/style-1.php';
    }
    return ob_get_clean();
}