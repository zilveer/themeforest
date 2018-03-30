<?php

function blog_slideshow_style($atts)
{
    global $post;
    extract($atts);
    
    $output = '';

    if($slideshow_layout == 'default') {
        if ($layout == 'full') {
            $image_width = $grid_width - 40;
        } else {
            $image_width = (($content_width / 100) * $grid_width) - 40;
        } 
    }else {
        if ($slideshow_layout == 'full') {
            $image_width = $grid_width - 40;
        } else {
            $image_width = (($content_width / 100) * $grid_width) - 40;
        } 
    }
    $post_type = (get_post_format(get_the_id()) == '0' || get_post_format(get_the_id()) == '') ? 'image' : get_post_format(get_the_id());
    
    $output .= '<article id="entry-' . get_the_ID() . '" class="blog-slideshow-entry swiper-slide mk-isotop-item">';
    
    
    $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
    $image_src       = bfi_thumb($image_src_array[0], array(
        'width' => $image_width,
        'height' => $image_height,
        'crop' => true
    ));
        $output .= '<div class="thumb-featured-image"><a title="' . get_the_title() . '" href="' . get_permalink() . '">';
        $output .= '<img alt="' . get_the_title() . '" width="' . $image_width . '" class="item-featured-image" height="' . $image_height . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $image_width, $image_height) . '" itemprop="image" />';
        $output .= '</a></div>';
    
    
    
    
    
    if ($disable_meta != 'false') {
        $output .= '<div class="blog-meta">';
        $output .= '<span class="post-type-icon"><i class="mk-post-type-icon-' . $post_type . '"></i></span>';
        $output .= '<h3 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
        
        

        if (function_exists('mk_love_this')) {
            ob_start();
            mk_love_this();
            $output .= '<div class="mk-love-holder">' . ob_get_clean() . '</div>';
        }
        $output .= '<div class="blog-categories">' . get_the_category_list(', ') . '</div>';
        $output .= '<time datetime="' . get_the_date() . '" itemprop="datePublished" pubdate>';
        $output .= '<a href="' . get_month_link(get_the_time("Y"), get_the_time("m")) . '">' . get_the_date() . '</a>';
        $output .= '</time>';
        $output .= '<div class="clearboth"></div></div>';
    }
    

    $output .= '</article>';
    
    
    return $output;

}