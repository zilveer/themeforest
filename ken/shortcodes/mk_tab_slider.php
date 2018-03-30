<?php

extract(shortcode_atts(array(
    'slides' => '',
    'orderby' => 'date',
    'order' => 'DESC',
    "full_height" => "true",
    "height" => 700,
    "animation_speed" => 700,
    "el_class" => ''
), $atts));

$output = $color_mask_css = $menu_titles = $min = '';

global $post, $mk_accent_color;

$query = array(
    'post_type' => 'tab_slider',
    'suppress_filters' => false
);

if (!empty($slides)) {
    $query['post__in'] = explode(',', $slides);
}
if ($order) {
    $query['order'] = $order;
}
if ($orderby) {
    $query['orderby'] = $orderby;
}

if($full_height == 'false') {
    $min = 'style="min-height:' . $height . 'px;"';
}

$id = Mk_Static_Files::shortcode_id();
$loop = new WP_Query($query);

$output .= '<div id="mk-tab-slider-'.$id.'" class="mk-tab-slider mk-swiper-container" '.$min.' data-height="' . $height . '" data-fullHeight="' . $full_height . '" data-pause="" data-speed="' . $animation_speed . '" data-pagination="true">';
    $output .= '<div '.$min.' class="edge-slider-holder mk-swiper-wrapper">';

    while ($loop->have_posts()):
        $loop->the_post();

        $post_id = $post->ID;

        $type            = get_post_meta($post_id, '_edge_type', true) ? get_post_meta($post_id, '_edge_type', true) : 'image';
        $mp4             = get_post_meta($post_id, '_video_mp4', true);
        $webm            = get_post_meta($post_id, '_video_webm', true);
        $video_preview   = get_post_meta($post_id, '_video_preview', true);
        $slide_image     = get_post_meta($post_id, '_slide_image', true);
        $slide_bg_color  = get_post_meta($post_id, '_bg_color', true);
        $cover_bg        = get_post_meta($post_id, '_cover', true);
        $tab_skin        = get_post_meta($post_id, '_tab_skin', true);

        if(empty($tab_skin)) $tab_skin = 'dark';

        $bg_image_css = ($type == 'image') ? ' style="background-image:url(' . $slide_image . ');" ' : '';
        $content_bg = 'style="background-color:' . $slide_bg_color . ';"';
        $cover_bg = ($cover_bg != 'false') ? ' mk-background-stretch' : '';





    $output .= '<div class="swiper-slide" data-skin="'.$tab_skin.'">';

        $output .= '<div class="mk-half-layout">';
            $output .= '<div class="mk-video-holder ' . $cover_bg . '"' . $bg_image_css . '>';

            // if (!empty($overlay)) {
            //     $color_mask_css = ' style="background-color:' . $overlay . ';opacity:' . $overlay_opacity . ';"';
            // }
            $output .= '<div' . $color_mask_css . ' class="mk-section-color-mask"></div>';

            if ($type == 'video') {
                 if(!empty($video_preview)) {
                    $output .= '<div style="background-image:url('.$video_preview.');" class="mk-video-section-touch"></div>';
                 }
                $output .= '<div class="mk-section-video"><video poster="' . $video_preview . '" muted="muted" preload="auto" loop="true" autoplay="true">';

                if (!empty($mp4)) {
                    $output .= '<source type="video/mp4" src="' . $mp4 . '" />';
                }
                if (!empty($webm)) {
                    $output .= '<source type="video/webm" src="' . $webm . '" />';
                }
                if (!empty($ogv)) {
                    $output .= '<source type="video/ogg" src="' . $ogv . '" />';
                }
                $output .= '</video></div>';
            }
            $output .= '</div>';
        $output .= '</div>';


        $output .= '<div class="mk-half-layout mk-half-layout-right" '.$content_bg.'>';
            $output .= '<div class="mk-tab-slider-content" '.$min.'>';
             $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));

            if (!empty($content)) {
                $output .= '<div class="mk-grid">' . $content . '</div>';
            }

            $output .= '</div><!--/mk-grid-->';
        $output .= '</div>';

    $output .= '</div><!--/swiper-slide-->' . "\n\n\n";

    endwhile;
    wp_reset_postdata();
    $output .= '</div>';

    $output .= '<div class="mk-tab-slider-pagination">';
    $output .= '    <div class="swiper-pagination pagination-underline" data-skin=""></div>';
    $output .= '</div>';

    $output .= '<div class="edge-slider-loading"><div class="mk-preloader"><div class="mk-loader"></div></div></div>';


$output .= '</div>';

echo $output;
