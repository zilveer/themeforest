<?php
extract(shortcode_atts(array(
    'image_height' => 350,
    'slideshow_cat' => '',
    'side_thumb_cat' => '',
    'orderby' => 'date',
    'order' => 'DESC',
    'el_class' => ''
) , $atts));

global $mk_settings;

require_once THEME_INCLUDES . "/image-cropping.php";

$slider_query = array(
    'posts_per_page' => 5,
    'post_type' => 'post'
);
if ($slideshow_cat) {
    $slider_query['cat'] = $slideshow_cat;
}
if ($orderby) {
    $slider_query['orderby'] = $orderby;
}
if ($order) {
    $slider_query['order'] = $order;
}

$output.= '<section class="mk-blog-teaser ' . $el_class . '">';

$output.= '<div class="mk-slideshow-wrapper mk-swiper-container blog-slider-item mk-swiper-slider" data-loop="false" data-freeModeFluid="true" data-slidesPerView="1" data-pagination="false" data-freeMode="false" data-mousewheelControl="false" data-direction="horizontal" data-slideshowSpeed="6000" data-animationSpeed="500" data-directionNav="true">' . "\n";
$output.= '<div class="mk-swiper-wrapper">';
$r = new WP_Query($slider_query);
if ($r->have_posts()):
    while ($r->have_posts()):
        $r->the_post();
        
        $image_width = $mk_settings['grid-width'] * 0.667;
        
        $post_type = (get_post_format(get_the_id()) == '0' || get_post_format(get_the_id()) == '') ? 'image' : get_post_format(get_the_id());
        
        $output.= '<article id="entry-' . get_the_ID() . '" class="blog-slideshow-entry swiper-slide">';
        
        $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', true);
        $image_src = bfi_thumb($image_src_array[0], array(
            'width' => $image_width,
            'height' => $image_height,
            'crop' => true
        ));
        if (has_post_thumbnail()) {
            $output.= '<div class="thumb-featured-image"><a title="' . get_the_title() . '" href="' . get_permalink() . '">';
            $output.= '<img alt="' . get_the_title() . '" width="' . $image_width . '" class="item-featured-image" height="' . $image_height . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $image_width, $image_height) . '" itemprop="image" />';
            $output.= '</a></div>';
        }
        
        $output.= '<div class="blog-meta">';
        $output.= '<span class="post-type-icon"><i class="mk-theme-icon-' . $post_type . '"></i></span>';
        $output.= '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
        
        if (function_exists('mk_love_this')) {
            ob_start();
            mk_love_this();
            $output.= '<div class="mk-love-holder">' . ob_get_clean() . '</div>';
        }
        $output.= '<div class="blog-categories">' . get_the_category_list(', ') . '</div>';
        $output.= '<time datetime="' . get_the_date() . '" itemprop="datePublished" pubdate>';
        $output.= '<a href="' . get_month_link(get_the_time("Y") , get_the_time("m")) . '">' . get_the_date() . '</a>';
        $output.= '</time>';
        $output.= '<div class="clearboth"></div></div>';
        
        $output.= '</article>';
    endwhile;
endif;

$output.= '</div>';
$output.= '<a class="mk-swiper-prev blog-scroller-arrows"><i class="mk-theme-icon-prev-big"></i></a>';
$output.= '<a class="mk-swiper-next blog-scroller-arrows"><i class="mk-theme-icon-next-big"></i></a>';
$output.= '</div>';

/***********************************/

$side_query = array(
    'posts_per_page' => 3,
    'post_type' => 'post'
);
if ($side_thumb_cat) {
    $side_query['cat'] = $side_thumb_cat;
}
if ($orderby) {
    $side_query['orderby'] = $orderby;
}
if ($order) {
    $side_query['order'] = $order;
}

$output.= '<div class="mk-teaser-blog-side">' . "\n";

$i = 0;
$image_height = $image_height / 2;

$r = new WP_Query($side_query);
if ($r->have_posts()):
    while ($r->have_posts()):
        $r->the_post();
        
        if ($i == 0) {
            $image_width = $mk_settings['grid-width'] * 0.334;
            $item_class = 'full-item';
        } 
        else {
            $image_width = $mk_settings['grid-width'] * 0.167;
            $item_class = 'half-item';
        }
        
        $output.= '<article id="entry-' . get_the_ID() . '" class="blog-teaser-side-item ' . $item_class . '"><div class="item-holder">';
        
        $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', true);
        $image_src = bfi_thumb($image_src_array[0], array(
            'width' => $image_width,
            'height' => $image_height,
            'crop' => true
        ));
        if (has_post_thumbnail()) {
            $output.= '<div class="thumb-featured-image"><a title="' . get_the_title() . '" href="' . get_permalink() . '">';
            $output.= '<img alt="' . get_the_title() . '" width="' . $image_width . '" class="item-featured-image" height="' . $image_height . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $image_width, $image_height) . '" itemprop="image" />';
            $output.= '</a></div>';
        }
        
        $output.= '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
        
        $output.= '</div></article>';
        $i++;
    endwhile;
endif;

$output.= '</div>';

$output.= '</section><div class="clearboth"></div>';

wp_reset_postdata();
echo $output;
