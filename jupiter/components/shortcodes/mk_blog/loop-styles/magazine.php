<?php
global $mk_options;

if ($view_params['i'] == 1) {
    $loop_style = 'magazine-featured-post';
    
    if ($view_params['layout'] == 'full') {
        $image_width = $mk_options['grid_width'] - 40;
        $image_height = ($image_width) * 0.6;
    } 
    else {
        $image_width = (($mk_options['content_width'] / 100) * $mk_options['grid_width']) - 40;
        $image_height = ($image_width) * 0.6;
    }
    
    $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), $view_params['image_size'], $image_width, $image_height, $crop = true, $dummy = true);

} 
else {
    $loop_style = 'magazine-thumb-post';
    $image_width = $image_height = 200;
    $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'blog-magazine-thumbnail', $image_width, $image_height, $crop = true, $dummy = true);
}

$post_type = get_post_meta($post->ID, '_single_post_type', true);
$post_type = !empty($post_type) ? $post_type : 'image';

$output = '<article id="' . get_the_ID('Y-m-d') . '" class="mk-blog-magazine-item ' . $loop_style . ' '.$post_type.'-post-type mk-isotop-item"><div class="blog-item-holder">';

if (has_post_thumbnail()) {
    
    $output.= '<div class="featured-image"><a title="' . the_title_attribute(array('echo' => false)) . '" href="' . esc_url( get_permalink() ) . '">';
    $output.= '  <img alt="' . the_title_attribute(array('echo' => false)) . '" title="' . the_title_attribute(array('echo' => false)) . '" src="' . $featured_image_src['dummy'] . '" '.$featured_image_src['data-set'].' itemprop="image" />';
    $output.= '  <div class="image-gradient-overlay"></div>';
    $output.= '</a></div>';
}

$output.= '<div class="item-wrapper">';

$output.= mk_get_shortcode_view('mk_blog', 'components/title', true);

// start: [mk-blog-meta]
if ($view_params['disable_meta'] == 'true') {
    $output.= '<div class="mk-blog-meta">';
    $output.= '<time datetime="' . get_the_date() . '">';
    $output.= '<a href="' . get_month_link(get_the_time("Y") , get_the_time("m")) . '">' . get_the_date() . '</a>';
    $output.= '</time>';
    $output.= '<span class="mk-categories">&nbsp;' . __('', 'mk_framework') . ' ' . get_the_category_list(', ') . '</span>';
    $output.= '<div class="clearboth"></div>';
    $output.= '</div>';
}

// end: [mk-blog-meta]

if ($view_params['i'] == 1) {
    $output.= mk_get_shortcode_view('mk_blog', 'components/excerpt', true, ['excerpt_length' => $view_params['excerpt_length'], 'full_content' => false]);
    
    
        $output.= '<div class="blog-magazine-social-section">';
        if ($view_params['comments_share'] != 'false') {
            $output.= mk_get_shortcode_view('mk_blog', 'components/comments', true);
        }
        $output.= mk_get_shortcode_view('mk_blog', 'components/love-this', true);
        $output.= '</div>';
    
}

$output.= '</div>';
$output.= '</article>' . "\n\n\n";

echo $output;
?>
