<?php

function blog_modern_style($atts)
{
    global $post;
    extract($atts);
    
    $output = $item_cat = '';
    
    if ($layout == 'full') {
        $image_width = $grid_width - 40;
    } else {
        $image_width = (($content_width / 100) * $grid_width) - 40;
    }
    
    $categories = get_the_category();
    
    foreach ($categories as $category) {
        $item_cat .= 'category-' . $category->slug . ' ';
    }
    
    
    $post_type = (get_post_format(get_the_id()) == '0' || get_post_format(get_the_id()) == '') ? 'image' : get_post_format(get_the_id());
    
    $output .= '<article id="entry-' . get_the_ID() . '" class="blog-modern-entry modern-'.$item_id.' mk-parent-element mk-isotop-item ' . $item_cat . '">';
    
    
    switch ($post_type) {
        
        
        
        /* Image Post Type */
        case 'image':
            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
            if($cropping == 'true') {
                $image_src = bfi_thumb($image_src_array[0], array(
                'width' => $image_width,
                'height' => $image_height,
                'crop' => true
                ));
            } else {
                $image_src = $image_src_array[0];
            }
            
            if (has_post_thumbnail()) {
                $output .= '<div class="modern-featured-image">';
                $output .= '<img alt="' . get_the_title() . '" width="' . $image_width . '" class="item-featured-image" height="' . $image_height . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $image_width, $image_height) . '" itemprop="image" />';
                $output .= '<div class="hover-overlay"></div>';
                $output .= '</div>';
            }
            break;
        /***********/
        
        /* Gallery Post Type */
        case 'gallery':
            $attachment_ids = get_post_meta(get_the_id(), '_gallery_images', true);
            $output .= '<div class="blog-gallery-type">';
            $output .= do_shortcode('[mk_image_slideshow images="' . $attachment_ids . '" direction="horizontal" margin_bottom="0" image_width="' . $image_width . '" image_height="' . $image_height . '" effect="slide" animation_speed="700" slideshow_speed="7000" pause_on_hover="true" direction_nav="true"]');
            $output .= '<div class="hover-overlay"></div>';
            $output .= '<div class="clearboth"></div></div>';
            
            break;
        /***********/
 
        default:
            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
            if($cropping == 'true') {
                $image_src = bfi_thumb($image_src_array[0], array(
                'width' => $image_width,
                'height' => $image_height,
                'crop' => true
                ));
            } else {
                $image_src = $image_src_array[0];
            }
            if (has_post_thumbnail()) {
                $output .= '<div class="modern-featured-image">';
                $output .= '<img alt="' . get_the_title() . '" title="' . get_the_title() . '" class="item-featured-image" width="' . $image_width . '" height="' . $image_height . '" src="' . mk_thumbnail_image_gen($image_src, $image_width, $image_height) . '" itemprop="image" />';
                $output .= '<div class="hover-overlay"></div>';
                $output .= '</div>';
            }
            break;
            
    }
    
    
    /* Blog Heading */
    $output .= '<div class="blog-entry-heading mk-caption-item">';
    $output .= '<h3 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    $output .= '<a class="blog-modern-button" href="' . get_permalink() . '">' . __('SEE THE POST', 'mk_framework') . '</a>';
    $output .= '</div>';
    /***********/
    
    
    
    
    /* Blog Meta */
    if ($disable_meta != 'false') {
        $output .= '<div class="blog-meta">';
        $output .= '<span class="post-type-icon"><i class="mk-post-type-icon-' . $post_type . '"></i></span>';
        $output .= '<time datetime="' . get_the_date() . '" itemprop="datePublished" pubdate>';
        $output .= '<a href="' . get_month_link(get_the_time("Y"), get_the_time("m")) . '">' . get_the_date() . '</a>';
        $output .= '</time>';
        $output .= '<div class="blog-categories">' . get_the_category_list(', ') . '</div>';

        ob_start();
        comments_number(__('0', 'mk_framework'), __('1', 'mk_framework'), __('%', 'mk_framework'));
        $output .= '<a href="' . get_permalink() . '#comments" class="blog-comments"><i class="mk-icon-comment"></i> ' . ob_get_clean() . '</a>';
        
        if (function_exists('mk_love_this')) {
            ob_start();
            mk_love_this();
            $output .= '<div class="mk-love-holder">' . ob_get_clean() . '</div>';
        }
        $output .= '<div class="clearboth"></div></div>';
    }
    /***********/
    
    
    
    $output .= '</article>';
    
    
    return $output;
    
}