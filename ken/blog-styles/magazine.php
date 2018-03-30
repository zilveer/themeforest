<?php

function blog_magazine_style($atts, $i)
{
    global $post;
    extract($atts);
    
    $output = '';
    
    if ($i == 1):

    	if ($layout == 'full') {
	        $image_width = $grid_width - 40;
	        $image_height = ($image_width)*0.6;
	    } else {
	        $image_width = (($content_width / 100) * $grid_width) - 40;
	        $image_height = ($image_width)*0.6;
	    }

        $output .= '<article id="entry-' . get_the_ID() . '" class="blog-magazine-entry magazine-featured-post">';
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
            $output .= '<div class="featured-image" onClick="return true">';
            $output .= '<img alt="' . get_the_title() . '" width="' . $image_width . '" class="item-featured-image" height="' . $image_height . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $image_width, $image_height) . '" itemprop="image" />';
            $output .= '<div class="hover-overlay"></div>';
            $output .= '<a title="' . get_the_title() . '" href="' . get_permalink() . '"><i class="mk-theme-icon-next-big hover-plus-icon-xsmall"></i></a>';
            $output .= '<h3 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
            $output .= '</div>';
        }
        
        
        if ($disable_meta != 'false') {
            $output .= '<div class="blog-meta">';
            $output .= '<time datetime="' . get_the_date() . '" itemprop="datePublished" pubdate>';
        	$output .= '<a href="' . get_month_link(get_the_time("Y"), get_the_time("m")) . '">' . get_the_date() . '</a>';
        	$output .= '</time>';
            $output .= '<div class="blog-categories">' . get_the_category_list(', ') . '</div>';
            ob_start();
            comments_number(__('0', 'mk_framework'), __('1', 'mk_framework'), __('%', 'mk_framework'));
            $output .= '<a href="' . get_permalink() . '#comments" class="blog-comments"><i class="mk-icon-comment"></i>' . ob_get_clean() . '</a>';
            
            if (function_exists('mk_love_this')) {
                ob_start();
                mk_love_this();
                $output .= '<div class="mk-love-holder">' . ob_get_clean() . '</div>';
            }
            $output .= '<div class="clearboth"></div></div>';
        }
        
        
       
       if($excerpt_length != 0) {
            ob_start();
            mk_excerpt_max_charlength($excerpt_length);
            $output .= '<div class="blog-excerpt">' . ob_get_clean() . '</div>';
        }
        
        $output .= '</article>';
    else:
        $image_width  = 200;
        $image_height = 200;
        $output .= '<article id="entry-' . get_the_ID() . '" class="blog-magazine-entry magazine-thumb-post">';
        
        
        $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
        $image_src       = bfi_thumb($image_src_array[0], array(
            'width' => $image_width,
            'height' => $image_height,
            'crop' => true
        ));
        if (has_post_thumbnail()) {
            $output .= '<div class="featured-image"><a title="' . get_the_title() . '" href="' . get_permalink() . '">';
            $output .= '<img alt="' . get_the_title() . '" width="' . $image_width . '" class="item-featured-image" height="' . $image_height . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $image_width, $image_height) . '" itemprop="image" />';
            $output .= '<div class="hover-overlay"></div>';
            $output .= '</a></div>';
        }
        
        $output .= '<div class="blog-thumb-content">';
        $output .= '<time datetime="' . get_the_date() . '" itemprop="datePublished" pubdate>';
        $output .= '<a href="' . get_month_link(get_the_time("Y"), get_the_time("m")) . '">' . get_the_date() . '</a>';
        $output .= '</time>';
        $output .= '<span class="blog-cat">' . get_the_category_list(', ') . '</span>';
        $output .= '<h3 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
        $output .= '<div class="clearboth"></div></div>';
        
        $output .= '</article>';
    endif;
    
    return $output;
    
}