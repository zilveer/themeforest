<?php

function blog_list_style($atts)
{
    global $post;
    extract($atts);
    
    $output = $item_cat = '';
    
    
    $categories = get_the_category();
    
    foreach ($categories as $category) {
        $item_cat .= 'category-' . $category->slug . ' ';
    }
    
    
    $post_type = (get_post_format(get_the_id()) == '0' || get_post_format(get_the_id()) == '') ? 'image' : get_post_format(get_the_id());
    
    $output .= '<article id="entry-' . get_the_ID() . '" class="blog-list-entry list-'.$item_id.' mk-isotop-item ' . $item_cat . '">';
    
    $output .= '<div class="list-posttype-col">';
    $output .= '<a href="' . get_permalink() . '" class="post-type-icon"><i class="mk-post-type-icon-' . $post_type . '"></i></a>';
    $output .= '</div>';

    $output .= '<div class="listtype-meta">';
    
    $output .= '<time datetime="' . get_the_time('F, j') . '" itemprop="datePublished" pubdate>';
    $output .= '<a href="' . get_month_link(get_the_time("Y"), get_the_time("m")) . '">' . get_the_date() . '</a>';
    $output .= '</time> ';
    
    $output .= '<span>' . get_the_category_list(', ') . '</span>';
    
    $output .= '</div>';
    
    $output .= '<div class="list-content-col">';
    $output .= '<h3 class="the-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    
    
    if($excerpt_length != 0) {
        ob_start();
        mk_excerpt_max_charlength($excerpt_length);
        $output .= '<div class="blog-excerpt">' . ob_get_clean() . '</div>';
    }
    
    $output .= '</div>';
    
    
    $output .= '</article>';
    
    
    return $output;
    
}