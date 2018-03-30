<?php

function blog_scroller_style($atts)
{
    global $post;
    extract($atts);
    
    $output = '';
    
    
    $output .= '<article id="entry-' . get_the_ID() . '" class="blog-scroller-entry swiper-slide mk-isotop-item" style="width:' . ($image_width + 1) . 'px">';
    
    
    $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
    $image_src       = bfi_thumb($image_src_array[0], array(
        'width' => $image_width,
        'height' => $image_height,
        'crop' => true
    ));
    if (has_post_thumbnail()) {
        $output .= '<div class="thumb-featured-image"><a title="' . get_the_title() . '" href="' . get_permalink() . '">';
        $output .= '<img alt="' . get_the_title() . '" width="' . $image_width . '" class="item-featured-image" height="' . $image_height . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $image_width, $image_height) . '" itemprop="image" />';
        $output .= '</a></div>';
    }
    
    $output .= '<h3 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
   
    $output .= '</article>';
    
    
    return $output;
    
}