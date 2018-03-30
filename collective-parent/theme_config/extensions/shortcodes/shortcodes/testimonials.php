<?php
/**
 * Testimonials
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 * Optional arguments:
 * title:
 * order: RAND, ASC, DESC
 */

function tfuse_testimonials($atts, $content = null) {
    global $testimonials_uniq;
    extract(shortcode_atts(array('order' => 'RAND','title' => '', 'display' => '', 'phrase' => ''), $atts));
    $output = $slide = $nav = $single = '';
    $testimonials_uniq = rand(800, 900);

    if (!empty($order) && ($order == 'ASC' || $order == 'DESC'))
        $order = '&order=' . $order;
    else
        $order = '&orderby=rand';

    $posts = get_posts('post_type=testimonials&posts_per_page=-1' . $order);
    if($display == 'toggle'){
        $c = 0;
        if($title != '') $output .= '<h6>'.$title.'</h6>';
        $output .= '<div class="accordion clearfix" id="accordion'.$testimonials_uniq.'">';
        foreach($posts as $item){
            $c++;
            $output .= '<div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$testimonials_uniq.'" href="#collapse'.$c.'"><span class="toogle_ico"></span><span class="guest-name">'.$item->post_title.'</span><span class="guest-post">'.tfuse_page_options('profession','',$item->ID).'</span></a>
                </div>
                <div id="collapse'.$c.'" class="accordion-body collapse"><div class="accordion-inner">'.$item->post_content.'</div></div>
            </div>';
        }
        $output .= '</div>';
    }
    elseif($display == 'cols2'){
        $output .= '<div class="middle_row clearfix">
        <div class="container">
            <div class="testimonials_list">';
                if($title != '') $output .= '<h2 class="testimonial_title">'.$title.'</h2>';
                $output .= '<div class="row">';
            foreach($posts as $item){
                if(tfuse_page_options('thumbnail_image','',$item->ID) !=''){
                    $image = new TF_GET_IMAGE();
                    $img = $image->width(89)->height(89)->src(tfuse_page_options('thumbnail_image','',$item->ID))->get_img();
                }
                else $img = '';
                $output .= '<div class="span6 testimonials_item clearfix">
                    <div class="testimonials_ava">'.$img.'</div>
                    <div class="testimonials_entry">'.$item->post_content.'<div class="testimonials_meta"><span class="author">'.$item->post_title.'</span></div></div>
                </div>';
            }
            $output .= '</div>';
            if($phrase != '') $output .= '<span class="reply">'.$phrase.'</span>';
            $output .= '</div></div></div>';
    }
    elseif($display == 'cols4'){
        $output .= '<div class="middle_row clearfix">
        <div class="testimonials_list columns">';
        if($title != '') $output .= '<h2 class="testimonial_title">'.$title.'</h2>';
        foreach($posts as $item){
            if(tfuse_page_options('thumbnail_image','',$item->ID) !=''){
                $image = new TF_GET_IMAGE();
                $img = $image->width(89)->height(89)->src(tfuse_page_options('thumbnail_image','',$item->ID))->get_img();
            }
            else $img = '';
            $output .= '<div class="testimonials_item">
                <div class="testimonials_inner">
                    <div class="testimonials_ava">'.$img.'</div>
                    <div class="testimonials_meta"><span class="name">'.$item->post_title.'</span><span class="post">'.tfuse_page_options('profession','',$item->ID).'</span></div>
                    <div class="testmonials_entry">'.$item->post_content.'</div>
                </div></div>';
        }
        if($phrase != '')$output .= '<span class="reply">'.$phrase.'</span>';
        $output .= '</div></div>';
    }
    else{
        $output .= '<div class="middle_row">
        <div class="container testimonials_slider">';
            if($title != '') $output .= '<div class="title clearfix"><h2>'.$title.'</h2></div>';
            $output .= '<div class="testimonials_carousel carousel clearfix">
            <div class="testimonials_carousel_inner">
                <div class="row">
                    <div id="testimonials_list'.$testimonials_uniq.'">';
                        foreach($posts as $item){
                            $output .= '<div class="testimonials_item span12"><h3>'.$item->post_title.'</h3>'.$item->post_content.'</div>';
                        }
                $output .= '</div></div></div>

            <div class="carousel_nav">
                <a class="prev" id="testimonials_item_prev'.$testimonials_uniq.'" href="#"></a><a class="next" id="testimonials_item_next'.$testimonials_uniq.'" href="#"></a>
            </div>
            <script>
            jQuery(window).load(function() {
                jQuery("#testimonials_list'.$testimonials_uniq.'").carouFredSel({
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
                        pauseOnHover: true,
                        fx:"fade"
                    },
                    auto: 7000,
                    prev: "#testimonials_item_prev'.$testimonials_uniq.'",
                    next: "#testimonials_item_next'.$testimonials_uniq.'",
                    swipe: true,
                    mousewheel: false
                });
            });
            </script>
        </div></div></div>';
    }

    return $output;
}

$atts = array(
    'name' => __('Testimonials','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of an shortcode','tfuse'),
            'id' => 'tf_shc_testimonials_title',
            'value' => 'Testimonials',
            'type' => 'text'
        ),
        array(
            'name' => __('Display type','tfuse'),
            'desc' => __('Select display type','tfuse'),
            'id' => 'tf_shc_testimonials_display',
            'value' => 'slider',
            'options' => array(
                'slider' => __('Slider','tfuse'),
                'toggle' => __('In Toggle','tfuse'),
                'cols2' => __('In 2 Columns','tfuse'),
                'cols4' => __('In 4 Columns','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Order','tfuse'),
            'desc' => __('Select display order','tfuse'),
            'id' => 'tf_shc_testimonials_order',
            'value' => 'DESC',
            'options' => array(
                'RAND' => __('Random','tfuse'),
                'ASC' => __('Ascending','tfuse'),
                'DESC' => __('Descending','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('After Phrase','tfuse'),
            'desc' => __('Enter the phrase after the testimonials.This phrase apear only for 2 columns display','tfuse'),
            'id' => 'tf_shc_testimonials_phrase',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('testimonials', 'tfuse_testimonials', $atts);