<?php

function blog_thumb_style($atts)
{
    global $post;
    extract($atts);
    
    $output = $item_cat = '';
    
    
    $image_width  = 250;
    $image_height = 250;
    
    $categories = get_the_category();
    
    foreach ($categories as $category) {
        $item_cat .= 'category-' . $category->slug . ' ';
    }
    
    
    $output .= '<article id="entry-' . get_the_ID() . '" class="blog-thumb-entry thumb-'.$item_id.' mk-isotop-item ' . $item_cat . '">';
    
    
    $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
    $image_src       = bfi_thumb($image_src_array[0], array(
        'width' => $image_width,
        'height' => $image_height,
        'crop' => true
    ));
    $output .= '<div class="featured-image"><a title="' . get_the_title() . '" href="' . get_permalink() . '">';
    $output .= '<img alt="' . get_the_title() . '" width="' . $image_width . '" class="item-featured-image" height="' . $image_height . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $image_width, $image_height) . '" itemprop="image" />';
    $output .= '<div class="hover-overlay"></div>';
    $output .= '</a></div>';
   
    
    $output .= '<div class="blog-thumb-content">';
    $output .= '<time datetime="' . get_the_date() . '" itemprop="datePublished" pubdate>';
    $output .= '<a href="' . get_month_link(get_the_time("Y"), get_the_time("m")) . '">' . get_the_date() . '</a>';
    $output .= '</time>';
    $output .= '<h3 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    
    
    if($excerpt_length != 0) {
        ob_start();
        mk_excerpt_max_charlength($excerpt_length);
        $output .= '<div class="blog-excerpt">' . ob_get_clean() . '</div>';
    }
    $output .= '<div class="clearboth"></div></div>';
    
    $output .= '</article>';
    
    
    return $output;
    
}