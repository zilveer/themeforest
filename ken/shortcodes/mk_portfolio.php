<?php

extract(shortcode_atts(array(
    'style' => 'grid',
    'hover_style' => 'classic',
    'hove_bg_color' => '',
    'column' => 3,
    'count' => 10,
    "sortable" => 'true',
    'sortable_align' => 'center',
    'pagination' => 'true',
    'pagination_style' => '1',
    'width' => 400,
    'height' => 400,
    'dimension' => 400,
    'cat' => '', // Deprecated
    'categories' => '',
    'author' => '',
    'posts' => '',
    'offset' => 0,
    'order' => 'DESC',
    'orderby' => 'date',
    'image_quality' => 1,
    'ajax' => 'false',
    'item_row' => 1,
    'show_logo' => 'true',
    'plus_icon' => 'true',
    'permalink_icon' => 'true',
    'item_id' => '',
    'image_size' => 'crop',
), $atts));

global $mk_settings;

$ken_styles = '';

$cat = !empty($categories) ? $categories : $cat;

$grid_width    = $mk_settings['grid-width'];
$content_width = $mk_settings['content-width'];

$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);


$query = array(
    'post_type' => 'portfolio',
    'posts_per_page' => (int) $count,
    'paged' => $paged,
    'suppress_filters' => 0
);

if ($cat != '') {
    $query['tax_query'] = array(
        array(
            'taxonomy' => 'portfolio_category',
            'field' => 'slug',
            'terms' => explode(',', $cat)
        )
    );
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

if ($author) {
    $query['author'] = $author;
}

if ($offset && $pagination_style != 2) {
    $query['offset'] = $offset;
}

$r = new WP_Query($query);


if (is_singular()) {
    global $post;
    $layout = get_post_meta($post->ID, '_layout', true);
} else {
    $layout = 'right';
}

$item_id = (!empty($item_id)) ? $item_id : 1409305847;

$atts                  = array(
    'column' => $column,
    'ajax' => $ajax,
    'layout' => $layout,
    'width' => $width,
    'height' => $height,
    'show_logo' => $show_logo,
    'pagination' => $pagination,
    'grid_width' => $grid_width,
    'content_width' => $content_width,
    'dimension' => $dimension,
    'image_quality' => $image_quality,
    'item_row' => $item_row,
    'permalink_icon' => $permalink_icon,
    'plus_icon' => $plus_icon,
    'hover_style' => $hover_style,
    'item_id' => $item_id,
    'image_size' => $image_size
);
$paginaton_style_class = $output = '';

$scroller_style = array(
    '',
    ''
);

if ($pagination_style == '2') {
    $paginaton_style_class = 'load-button-style';
} else if ($pagination_style == '3') {
    $paginaton_style_class = 'scroll-load-style';
} else {
    $paginaton_style_class = 'page-nav-style';
}


$ajax_state_class = ($ajax == 'true') ? 'portfolio-ajax-enabled' : '';

$enable_isotop = ($style != 'scroller') ? 'isotop-enabled mk-theme-loop ' : '';


if ($style == 'scroller') {
    $scroller_style = array(
        'mk-swiper-container mk-swiper-slider ',
        ' data-freeModeFluid="true" data-loop="false" data-slidesPerView="auto" data-pagination="false" data-freeMode="true" data-mousewheelControl="false" data-direction="horizontal" data-slideshowSpeed="5000" data-animationSpeed="600" data-directionNav="false" '
    );
}

$id = Mk_Static_Files::shortcode_id();



$output .= '<div class="portfolio-grid ' . $ajax_state_class . '">';

if ($sortable == 'true' && !is_archive() && $style != 'scroller') {
    $output .= '<header class="mk-isotop-filter"><ul class="align-'.$sortable_align.'">';
    $terms = array();
    if ($cat != '') {
        foreach (explode(',', $cat) as $term_slug) {
            $terms[] = get_term_by('slug', $term_slug, 'portfolio_category');
        }
    } else {
        $terms = get_terms('portfolio_category', 'hide_empty=1&suppress_filters=0');

        /*
        In order to order category filter by Ascending or Descending change above line as below :

        Descending Order : $terms = get_terms( 'portfolio_category', 'hide_empty=1&order=DESC' );

        Ascending Order : $terms = get_terms( 'portfolio_category', 'hide_empty=1&order=ASC' );

        Alternatively you can order them by :

        * orderby
        - id
        - count
        - name - Default
        - slug
        - none
        You will need to add this param as below example :

        Order by count and ascending :  $terms = get_terms( 'portfolio_category', 'hide_empty=1&order=ASC&orderby=count' );

        */

    }
    $output .= '<li><a class="current" data-filter="*" href="#">' . __('All', 'mk_framework') . '</a></li>';
    
    foreach ($terms as $term) {
        $output .= '<li><a data-filter=".' . $term->slug . '" href="#">' . $term->name . '</a></li>';
    }

    $output .= '<div class="clearboth"></div></ul>';
    $output .= '<div class="clearboth"></div></header>';
}


if ($ajax == 'true' && $style != 'scroller') {
    $output .= '<div class="mk-inner-grid"><div class="ajax-container"><div class="portfolio-ajax-holder">';

    $output .= '<div class="ajax-controls">';
    $output .= '<a href="#" class="prev-ajax"><i class="mk-theme-icon-prev-big"></i></a>';
    $output .= '<a href="#" class="next-ajax"><i class="mk-theme-icon-next-big"></i></a>';
    $output .= '<a href="#" class="close-ajax"><i class="mk-icon-times"></i></a>';
    $output .= '</div>';

    $output .= '</div></div></div>';
}


$output .= '<div class="loop-main-wrapper">';
$output .= '<div class="portfolio-loader"><div class="mk-loader"></div></div>';
$output .= '<section id="mk-portfolio-loop-' . $id . '" data-uniqid="'.$item_id.'" data-style="' . $style . '" class="mk-portfolio-container ' . $enable_isotop . 'mk-portfolio-' . $style . ' ' . $scroller_style[0] . $paginaton_style_class . ' "' . $scroller_style[1] . '>' . "\n";

if ($style == 'scroller') {
    $output .= '<div class="mk-swiper-wrapper">';
}

$i = 0;
if (is_archive()):
    if (have_posts()):
        while (have_posts()):
            the_post();
             $i++;
            switch ($style) {

                case 'grid':
                    $output .= mk_portfolio_grid_loop($r, $atts, 1);
                    break;
                case 'standard':
                    $output .= mk_portfolio_standard_loop($r, $atts, 1);
                    break;

                case 'masonry':
                    $output .= mk_portfolio_masonry_loop($r, $atts, 1);
                    break;

                case 'flip':
                    $output .= mk_portfolio_flip_loop($r, $atts, 1);
                    break;

                case 'scroller':
                    $output .= mk_portfolio_scroller_loop($r, $atts, 1, $i);
                    break;
            }
        endwhile;
    endif;
else:
    if ($r->have_posts()):
        while ($r->have_posts()):
            $r->the_post();
            $i++;
            switch ($style) {

                case 'grid':
                    $output .= mk_portfolio_grid_loop($r, $atts, 1);
                    break;

                case 'standard':
                    $output .= mk_portfolio_standard_loop($r, $atts, 1);
                    break;

                case 'masonry':
                    $output .= mk_portfolio_masonry_loop($r, $atts, 1);
                    break;

                case 'flip':
                    $output .= mk_portfolio_flip_loop($r, $atts, 1);
                    break;

                case 'scroller':
                    $output .= mk_portfolio_scroller_loop($r, $atts, 1, $i);
                    break;
            }
        endwhile;
    endif;
endif;

if ($style == 'scroller') {
    $output .= '</div>';
}

$gradient_color = isset($hove_bg_color) && !empty($hove_bg_color) ? $hove_bg_color : $mk_settings['accent-color'] ;

if ($hover_style == 'gradient'){

    Mk_Static_Files::addCSS('
        #mk-portfolio-loop-' . $id .' .hover-overlay {
            background: -webkit-linear-gradient('.mk_convert_rgba($gradient_color, 0).' 0%, '.mk_convert_rgba($gradient_color, 0.6).' 100%);
            background: -o-linear-gradient('.mk_convert_rgba($gradient_color, 0).' 0%, '.mk_convert_rgba($gradient_color, 0.6).' 100%);
            background: linear-gradient('.mk_convert_rgba($gradient_color, 0).' 0%, '.mk_convert_rgba($gradient_color, 0.6).' 100%);
        }
    ', $id);
}

$output .= '</section><div class="clearboth"></div>' . "\n\n";


if ($style != 'scroller') {


    if ($pagination == 'true') {
        $output .= '<a class="mk-loadmore-button" style="display:none;" href="#"><i class="mk-icon-circle-o-notch"></i><i class="mk-icon-chevron-down"></i></a>';
        ob_start();
        mk_theme_blog_pagenavi('', '', $r, $paged);
        $output .= ob_get_clean();
    }
}
$output .= '</div></div>';
wp_reset_postdata();
echo $output;



