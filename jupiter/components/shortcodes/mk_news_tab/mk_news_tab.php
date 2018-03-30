<?php

$has_posts = wp_count_posts('news')->publish;
if( !$has_posts ) {
    echo 'No news posts to show!';
    return;
}

$phpinfo = pathinfo(__FILE__);
$path = $phpinfo['dirname'];
include ($path . '/config.php');

$id = uniqid();

$output = '';

$output .= mk_get_view('global', 'shortcode-heading', false, ['title' => $widget_title]);

$output .= '<div class="mk-news-tab mobile-' . $responsive . ' ' . $el_class . ' js-el" data-mk-component="Tabs">';

$cat_terms = get_terms('news_category', 'hide_empty=1');
$output .= '<div class="mk-news-tab-heading">';
$output .= '<span class="mk-news-tab-title">' . $tab_title . '</span>';
$output .= '<ul class="mk-tabs-tabs">';
$tab_count = 0;
foreach ($cat_terms as $cat_term) {

    $output.= '<li class="mk-tabs-tab';
    if($tab_count == 0) {
    	$output .= ' is-active';
    }
    $output .= '"><a href="#">' . $cat_term->name . '</a></li>';
    $tab_count++;
}
$output .= '</ul>';
$output.= '<div class="clearboth"></div>';
$output .= '</div>';
$output.= '<div class="mk-tabs-panes page-bg-color clearfix">';

$pane_count = 0;
foreach ($cat_terms as $cat_term) {

    $output.= '<div class="mk-tabs-pane';
    if($pane_count == 0) {
    	$output .= ' is-active ';
    }
     $output.= ' clearfix">';
    $output.= '<div class="title-mobile">' . $cat_term->name . '</div>';
    $query = array(
        'post_type' => 'news',
        'posts_per_page' => 3,
        'offset' => 0
    );
    
    $query['tax_query'] = array(
        array(
            'taxonomy' => 'news_category',
            'field' => 'slug',
            'terms' => $cat_term->slug
        )
    );
    
    $r = new WP_Query($query);
    $i = 0;
    if ($r->have_posts()):
        while ($r->have_posts()):
            $r->the_post();
            $i++;
            
            $terms = get_the_terms(get_the_id() , 'news_category');
            $terms_slug = array();
            $terms_name = array();
            if (is_array($terms)) {
                foreach ($terms as $term) {
                    $terms_slug[] = $term->slug;
                    $terms_name[] = $term->name;
                }
            }
            if ($i == 1) {
                $output.= '<div class="news-tab-wrapper left-side">';
                
                $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'crop', 500, 340, $crop = true, $dummy = true);
                if (has_post_thumbnail()) {
                    $output.= '<a href="' . esc_url( get_permalink() ) . '" class="news-tab-thumb"><img alt="' . the_title_attribute(array('echo' => false)) . '" title="' . the_title_attribute(array('echo' => false)) . '" src="'.$featured_image_src['dummy'].'" '.$featured_image_src['data-set'].' /></a>';
                }
                $output.= '<h3 class="the-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';
                $output.= '<div class="the-excerpt">' . get_the_excerpt() . '</div>';
                $output.= '<a class="new-tab-readmore" href="' . esc_url( get_permalink() ) . '">' . __('Read More', 'mk_framework') . Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-caret-right', 14).'</a>';
                $output.= '</div>';
            } 
            else {
                $output.= '<div class="news-tab-wrapper">';
                $output.= '<h3 class="the-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';
                $output.= '<div class="the-excerpt">' . get_the_excerpt() . '</div>';
                $output.= '<a class="new-tab-readmore" href="' . esc_url( get_permalink() ) . '">' . __('Read More', 'mk_framework') . Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-caret-right', 14).'</a>';
                $output.= '</div>';
            }
        endwhile;
        wp_reset_query();
    endif;
    $output.= '</div>';
    $pane_count++;
}

$output.= '<div class="clearboth"></div></div>';
$output.= '</div> ';

echo $output;

