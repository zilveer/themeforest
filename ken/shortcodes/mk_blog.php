<?php

extract(shortcode_atts(array(
    'style' => 'classic',
    'column' => 3,
    'disable_meta' => 'true',
    'image_height' => 350,
    'image_width' => 220, // Scroller Style Only
    'count' => 10,
    'offset' => 0,
    'cat' => '',
    'posts' => '',
    'author' => '',
    'pagination' => 'true',
    'pagination_style' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'grid_avatar' => 'true',
    'read_more' => 'false',
    'sortable' => 'false',
    'classic_excerpt' => 'excerpt',
    'magazine_strcutre' => 1,
    'excerpt_length' => 200,
    'cropping' => 'true',
    'slideshow_layout' => 'default',
    'author' => 'true',
    'item_id' => '',
    'el_class' => ''

), $atts));

require_once THEME_INCLUDES . "/image-cropping.php";    

global $mk_settings;
$query = array(
    'posts_per_page' => (int) $count,
    'post_type' => 'post',
    'suppress_filters' => 0
);

if ($cat) {
    $query['cat'] = $cat;
}
if ($author) {
    $query['author'] = $author;
}
if ($posts) {
    $query['post__in'] = explode(',', $posts);
}
if ($orderby) {
    $query['orderby'] = $orderby;
}
if ($order) {
    $query['order'] = $order;
}

$id = Mk_Static_Files::shortcode_id();

$item_id = (!empty($item_id)) ? $item_id : 1409305847;

$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);

if ($offset && $pagination_style != 2) {
    $query['offset'] = $offset;
}

$query['paged'] = $paged;

$r = new WP_Query($query);


if (is_page()) {
    global $post;
    $layout = get_post_meta($post->ID, '_layout', true);
} else {

    if (is_archive()) {
        $layout = $mk_settings['archive-layout'];
    } else {
        $layout = 'right';
    }


}



$grid_width    = $mk_settings['grid-width'];
$content_width = $mk_settings['content-width'];

$atts   = array(
    'layout' => $layout,
    'column' => $column,
    'image_height' => $image_height,
    'disable_meta' => $disable_meta,
    'classic_excerpt' => $classic_excerpt,
    'grid_avatar' => $grid_avatar,
    'read_more' => $read_more,
    'grid_width' => $grid_width,
    'content_width' => $content_width,
    'image_width' => $image_width,
    'excerpt_length' => $excerpt_length,
    'cropping' => $cropping,
    'slideshow_layout' => $slideshow_layout,
    'author' => $author,
    'item_id' => $item_id
);
$output = '';



if ($style != 'scroller' && $style != 'slideshow') {
    wp_enqueue_script('jquery-isotope');
    wp_enqueue_script('jquery-jplayer');
}

if ($pagination_style == '2') {
    $paginaton_style_class = 'load-button-style';
    wp_enqueue_script('infinitescroll');
} else if ($pagination_style == '3') {
    $paginaton_style_class = 'scroll-load-style';
    wp_enqueue_script('infinitescroll');
} else {
    $paginaton_style_class = 'page-nav-style';
}


if ($sortable == 'true' && !is_archive() && $style != 'scroller' && $style != 'slideshow') {
    $output .= '<header class="mk-isotop-filter"><ul>';

    $categories_args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'include' => $cat
    );

    $categories = get_categories($categories_args);
    $output .= '<li><a class="current" data-filter="*" href="#">' . __('All', 'mk_framework') . '</a></li>';
    foreach ($categories as $category) {
        $output .= '<li><a data-filter=".category-' . $category->slug . '" href="#">' . $category->name . '</a></li>';
    }

    $output .= '<div class="clearboth"></div></ul>';
    $output .= '<div class="clearboth"></div></header>';
}

$isotope_el_class = ($style != 'scroller' && $style != 'magazine' && $style != 'slideshow') ? 'isotop-enabled mk-theme-loop ' : '';

if ($style == 'scroller' || $style == 'slideshow') {

	$slidesPerView = ($style == 'scroller') ? 'auto' : 1;
    $scroller_atts = array(
        'mk-swiper-container mk-swiper-slider ',
        'data-loop="false" data-freeModeFluid="true" data-slidesPerView="'.$slidesPerView.'" data-pagination="false" data-freeMode="false" data-mousewheelControl="false" data-direction="horizontal" data-slideshowSpeed="6000" data-animationSpeed="500" data-directionNav="true"'
    );
} else {
    $scroller_atts = array(
        '',
        ''
    );
}

switch ($magazine_strcutre) {
	case 1:
		$magazine_style_class = 'mag-one-column';
		break;
	case 2:
		$magazine_style_class = 'mag-two-column-left';
		break;
	case 3:
		$magazine_style_class = 'mag-two-column-right';
		break;

	default:
		$magazine_style_class = 'mag-one-column';
		break;
}



$output .= '<div class="loop-main-wrapper"><section id="mk-blog-loop-' . $id . '" data-style="' . $style . '" data-uniqid="'.$item_id.'" class="mk-blog-container mk-' . $style . '-wrapper '.$magazine_style_class.' ' . $scroller_atts[0] . $isotope_el_class . $paginaton_style_class . ' '.$el_class.'" ' . $scroller_atts[1] . ' '.get_schema_markup('blog').'>' . "\n";

if ($style == 'scroller' || $style == 'slideshow') {
    $output .= '<div class="mk-swiper-wrapper">';
}

$i = 0;
if (is_archive()):
    if (have_posts()):
        while (have_posts()):
            the_post();
            $i++;
            switch ($style) {

                case 'classic':
                    $output .= blog_classic_style($atts);
                    break;
                case 'masonry':
                    $output .= blog_masonry_style($atts);
                    break;
                case 'modern':
                    $output .= blog_modern_style($atts);
                    break;
                case 'list':
                    $output .= blog_list_style($atts);
                    break;
                case 'thumb':
                    $output .= blog_thumb_style($atts);
                    break;
                case 'scroller':
                    $output .= blog_scroller_style($atts);
                    break;
                case 'magazine':
                    $output .= blog_magazine_style($atts, $i);
                    break;
                case 'tile':
                    $output .= blog_tile_style($atts, $i);
                    break;
				case 'slideshow':
                    $output .= blog_slideshow_style($atts);
                    break;
                default:
                    $output .= blog_classic_style($atts);
            }
        endwhile;
    endif;
else:
    if ($r->have_posts()):
        while ($r->have_posts()):
            $r->the_post();
            $i++;
            switch ($style) {

                case 'classic':
                    $output .= blog_classic_style($atts);
                    break;
                case 'modern':
                    $output .= blog_modern_style($atts);
                    break;
                case 'masonry':
                    $output .= blog_masonry_style($atts);
                    break;
                case 'list':
                    $output .= blog_list_style($atts);
                    break;
                case 'thumb':
                    $output .= blog_thumb_style($atts);
                    break;
                case 'scroller':
                    $output .= blog_scroller_style($atts);
                    break;
                case 'magazine':
                    $output .= blog_magazine_style($atts, $i);
                    break;
                case 'tile':
                    $output .= blog_tile_style($atts, $i);
                    break;
				case 'slideshow':
                    $output .= blog_slideshow_style($atts);
                    break;
                default:
                    $output .= blog_classic_style($atts);
            }
        endwhile;
    endif;
endif;

if ($style == 'scroller' || $style == 'slideshow') {
    $output .= '</div>';
}

if ($style == 'scroller' || $style == 'slideshow') {
    $output .= '<a class="mk-swiper-prev blog-scroller-arrows"><i class="mk-theme-icon-prev-big"></i></a>';
    $output .= '<a class="mk-swiper-next blog-scroller-arrows"><i class="mk-theme-icon-next-big"></i></a>';
}

$output .= '</section><div class="clearboth"></div>';


if ($pagination == 'true' && $style != 'scroller' && $style != 'magazine'  && $style != 'slideshow') {
    $output .= '<a class="mk-loadmore-button" style="display:none;" href="#"><i class="mk-icon-circle-o-notch"></i><i class="mk-icon-chevron-down"></i></a>';
    ob_start();
    mk_theme_blog_pagenavi('', '', $r, $paged);
    $output .= ob_get_clean();
}
$output .= '</div>';
wp_reset_postdata();
echo $output;
