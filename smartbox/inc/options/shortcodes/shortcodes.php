<?php
/**
 * Themes shortcode functions go here
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */


/* ---------- TESTIMONIALS SHORTCODE ---------- */

function oxy_shortcode_testimonials( $atts , $content = '' ) {
    // setup options
    extract( shortcode_atts( array(
        'title'   => '',
        'count'   => 3,
        'layout'  => 'big',
        'columns' => 3,
        'style'   => '',
        'group'   => '',
    ), $atts ) );

    $query_options = array(
        'post_type'      => 'oxy_testimonial',
        'posts_per_page' => $count,
        'order'          => 'ASC',
        'orderby'        => 'menu_order',
    );

    if( !empty( $group ) ) {
        $query_options['tax_query'] = array(
            array(
                'taxonomy' => 'oxy_testimonial_group',
                'field' => 'slug',
                'terms' => $group
            )
        );
    }

    // fetch posts
    $span = $columns == 3? 'span4':'span3';
    $testimonials = new WP_Query( $query_options );
    $output = '';
    if( $testimonials->have_posts()):
        $item_num = 1;
        if( $layout == 'big'){ ?>
            <?php
            while($testimonials->have_posts()):
                $testimonials->next_post();
                setup_postdata($testimonials->post);
                $custom_fields = get_post_custom($testimonials->post->ID);

                $img = wp_get_attachment_image_src(get_post_thumbnail_id($testimonials->post->ID), 'full' );
                $class = ($item_num % 2 == 0)? ' class="pull-right"':'';
                $cite  = (isset($custom_fields[THEME_SHORT.'_citation']))? $custom_fields[THEME_SHORT.'_citation'][0]:'';
                $hr = ($item_num !== $items_count)? '<hr>':'';
                $output .='<div class="row-fluid">';
                if ($item_num % 2 == 1){
                    $output.='<div class="span3"><div class="round-box box-big"><span class="box-inner">';
                    $output.='<img alt="' . get_the_title($testimonials->post->ID) . '" class="img-circle" src="'. $img[0]. '" ></span></div></div>';
                }
                    $output.='<div class="span9"><blockquote' . $class . '>'.'<p class="lead">'. get_the_content();
                    $output.='</p><small>'.get_the_title($testimonials->post->ID) .'<cite title="Source Title"> '.$cite .'</cite></small></blockquote></div>';
                if ($item_num % 2 == 0){
                    $output.='<div class="span3"><div class="round-box box-big"><span class="box-inner">';
                    $output.='<img alt="' . get_the_title($testimonials->post->ID) . '" class="img-circle" src="'. $img[0]. '"></span></div></div>';
                }
                $output .='</div>'. $hr ;
                $item_num++;
            endwhile;
        }
        else {  // Calculate how many items we will render before we need another row
            $items_per_row = ($span == 'span4')? 3:4;
            $item_num = 1;
            $output .='<ul class="inline row-fluid">';
            while($testimonials->have_posts()):
                $testimonials->next_post();
                setup_postdata($testimonials->post);
                $custom_fields = get_post_custom($testimonials->post->ID);
                $cite  = (isset($custom_fields[THEME_SHORT.'_citation']))? $custom_fields[THEME_SHORT.'_citation'][0]:'';
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($testimonials->post->ID), 'full' );

                if($item_num > $items_per_row){
                    $output.= '</ul><ul class="inline row-fluid">';
                    $item_num = 1;
                }

                $output.='<li class="'. $span .'"><div class="well blockquote-well"><blockquote><p>'. get_the_content().'</p>';
                $output.='<small>'.get_the_title($testimonials->post->ID).'<cite title="Source Title"> '.$cite.'</cite></small></blockquote>';
                $output.='<div class="round-box box-medium"><span class="box-inner"><img alt="' . get_the_title($testimonials->post->ID) . '" class="img-circle" src="'. $img[0] .'"></span></div></div></li>';
                $item_num++;

            endwhile;
            $output.='</ul>';
            }

            wp_reset_postdata();
    endif;

    return oxy_shortcode_section( $atts, $output );
}


add_shortcode( 'testimonials', 'oxy_shortcode_testimonials' );


/* ---- BOOTSTRAP BUTTON SHORTCODE ----- */



function oxy_shortcode_button($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'type'        => 'default',
        'size'        => 'default',
        'xclass'      => '',
        'link'        => '',
        'label'       => 'My button',
        'icon'        => '',
        'link_open'   => '_self'
    ), $atts ) );
    return '<a href="'. $link .'" class="btn btn-'. $type . ' '. $size.' '. $xclass . '" target="' . $link_open . '"><i class="'.$icon.'"></i> '. $label . '</a>';
}


add_shortcode( 'button', 'oxy_shortcode_button' );


/* ---- BOOTSTRAP ALERT SHORTCODE ----- */


function oxy_shortcode_alert($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'type'        => 'default',
        'label'       => 'warning!',
        'description' => 'something is wrong!',

    ), $atts ) );

    return '<div class="alert ' . $type . '"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>'.$label.'</h4>'. $description .'</div>';
}


add_shortcode( 'alert', 'oxy_shortcode_alert' );

/* ----------------- BOOTSTRAP ACCORDION SHORTCODES ---------------*/

function oxy_shortcode_accordions($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'id'        => rand(100,999)
    ), $atts ) );

    $pattern = get_shortcode_regex();
    $count = preg_match_all( '/'. $pattern .'/s', $content, $matches );
    //var_dump($matches);
    if( is_array( $matches ) && array_key_exists( 2, $matches ) && in_array( 'accordion', $matches[2] ) ) {
        $lis = array();
        for( $i = 0; $i < $count; $i++ ) {
            $group_id = 'group_'.rand(100,999);
            // is it a tab?
            if( 'accordion' == $matches[2][$i] ) {
                $accordion_atts = shortcode_parse_atts( $matches[3][$i] );
                $open_close_class = 'collapse';
                if( isset( $accordion_atts['open'] ) ) {
                    $open_close_class = 'true' == $accordion_atts['open'] ? 'in' : 'collapse';
                }
                $lis[] = '<div class="accordion-group"><div class="accordion-heading">';
                $lis[] .= '<a class="accordion-toggle collapsed" data-parent="#'.$id.'" data-toggle="collapse" href="#'.$group_id.'">';
                $lis[] .= $accordion_atts['title'] .'</a></div>';
                $lis[] .= '<div class="accordion-body ' . $open_close_class . '" id="'.$group_id.'"><div class="accordion-inner">' .do_shortcode( $matches[5][$i] ) .'</div></div></div>';
            }
        }
    }

    return '<div class="accordion" id="'.$id.'">' . implode( $lis ) . '</div>';
}

add_shortcode( 'accordions', 'oxy_shortcode_accordions' );


function oxy_shortcode_accordion($atts , $content=''){

    return do_shortcode($content);
}

add_shortcode( 'accordion' , 'oxy_shortcode_accordion');


/* ----------- BOOTSTRAP TABS AND TAB PANES SHORTCODES --------- */


function oxy_shortcode_tab($atts , $content = '' ) {
    extract( shortcode_atts( array(
        'style'        => 'top',

    ), $atts ) );
    $pattern = get_shortcode_regex();
    $count = preg_match_all( '/'. $pattern .'/s', $content, $matches );
    if( is_array( $matches ) && array_key_exists( 2, $matches ) && in_array( 'tab', $matches[2] ) ) {
        $lis  = array();
        $divs = array();
        $extraclass = ' active';
        for( $i = 0; $i < $count; $i++ ) {
            $pane_id = 'group_'.rand(100,999);
            // is it a tab?
            if( 'tab' == $matches[2][$i] ) {
                $tab_atts = wp_parse_args( $matches[3][$i] );
                $lis[] ='<li class="'.$extraclass.'"><a data-toggle="tab" href="#'.$pane_id.'">'.substr( $tab_atts['title'], 1, -1 ) .'</a></li>';
                $divs[] ='<div class="tab-pane'.$extraclass.'" id="'.$pane_id.'">'.do_shortcode( $matches[5][$i] ).'</div>';
                $extraclass = '';
            }
        }
    }
    switch ($style) {
        case 'top':
            $position = '';
            break;
        case 'bottom':
            $position = 'tabs-below';
            break;
        case 'left':
            $position = 'tabs-left';
            break;
        case 'right':
            $position = 'tabs-right';
            break;
        default:
            $position = '';
            break;
    }
    if($style == 'bottom'){
        return '<div class="tabbable '.$position.'"><div class="tab-content">'.implode( $divs ).'</div><ul class="nav nav-tabs" data-tabs="tabs">' . implode( $lis ) . '</ul></div>';
   }
    else{
        return '<div class="tabbable '.$position.'"><ul class="nav nav-tabs" data-tabs="tabs">' . implode( $lis ) . '</ul><div class="tab-content">'.implode( $divs ).'</div></div>';
    }
}

add_shortcode( 'tabs', 'oxy_shortcode_tab' );


function oxy_shortcode_tab_pane($atts , $content=''){

    return do_shortcode($content);
}

add_shortcode( 'tab' , 'oxy_shortcode_tab_pane');


/* ------------------ PROGRESS BAR SHORTCODE -------------------- */

function oxy_shortcode_progress_bar($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'percentage'  =>  50,
        'type'        => 'progress',
        'style'       => 'progress-info',

    ), $atts ) );

    return '<div class="'. $type .' '.$style.'"><div class="bar" style="width: '.$percentage.'%"></div></div>';
}


add_shortcode( 'progress', 'oxy_shortcode_progress_bar' );



/* --------------------- PRICING SHORTCODE ---------------------- */

function oxy_shortcode_pricing($atts , $content=''){
    extract( shortcode_atts( array(
        'heading'     => 'standard',
        'price'       =>  10,
        'per'         => 'month',
        'featured'    => 'no',
        'currency'    => 'dollar',
    ), $atts ) );

    switch ( $currency ) {
        case 'dollar':
            $currency = "&#36;";
        break;
        case 'euro':
            $currency = "&#128;";
        break;
        case 'pound':
            $currency = "&#163;";
        break;
        case 'yen':
            $currency = "&#165;";
        break;
    }
    $featured_class = ($featured == 'yes')?'<span class="tag"><i class="icon-star"></i></span>':'';
    $output ='<div class="span4"><div class="well well-package"><h3 class="well-package-heading">';
    $output.= $heading.$featured_class.'</h3>';
    $output.= '<div class="well-package-price"><small>'.$currency.'</small>'.$price.'<small>/'.$per.'</small></div>';

    return $output .do_shortcode($content) . '</div></div>' ;
}

add_shortcode( 'pricing' , 'oxy_shortcode_pricing');


/* ------------------------ IMAGE SHORTCODE ------------------------*/

function oxy_shortcode_image($atts , $content = ''){
    // setup options
    extract( shortcode_atts( array(
        'size'       => 'box-medium',
        'rounded'    => 'yes',
        'polaroid'   => 'no',
        'source'     => '',
        'alt'        => '',
        'icon'       => '',
        'link'       => ''
    ), $atts ) );

    $iconclass= ($icon != '')?'<i class="'.$icon.'"></i>':'';
    $polaroidclss = ( $polaroid == 'yes')? 'img-polaroid':'';
    $extraclass = ($rounded == 'no')?' no-rounded':'';
    $tag = ($link != '')?'a':'span';
    $ref = ($tag == 'a')?' href="'.$link.'"':'';

    $output = '<div class="round-box'.$extraclass.' '.$size.'"> <'.$tag.' class="box-inner"'.$ref.'>';
    $output.= '<img class="img-circle '.$polaroidclss.'"  src="'.$source.'" alt="'.$alt.'">'.$iconclass.'</'.$tag.'></div>';

    return $output;
}

add_shortcode( 'image' , 'oxy_shortcode_image');



/* --------------------- PORTFOLIO SHORTCODES --------------------- */

function oxy_shortcode_portfolio($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'title'      => '',
        'count'      => 3,
        'columns'    => 3,
        'cat'        => '',
        'style'      => '',
        'img_style'  => '',
        'portfolio'  => ''
    ), $atts ) );

    $query_options = array(
        'post_type'      => 'oxy_portfolio_image',
        'posts_per_page' => $count === '0' ? -1 : $count,
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    );
    $filters = get_terms( 'oxy_portfolio_categories', array( 'hide_empty' => 1 ) );

    if( !empty( $portfolio ) ) {
        $portfolios = explode( ',', $portfolio );
        $query_options['tax_query'][] = array(
            'taxonomy' => 'oxy_portfolio_categories',
            'field' => 'slug',
            'terms' => $portfolios
        );

        // remove portfolios from filters
        foreach( $filters as $key => $filter ) {
            // remove portfolio from filter if not needed
            if( !in_array( $filter->slug, $portfolios ) ) {
                unset( $filters[$key] );
            }
        }
    }
    $span = $columns == 3? 'span4':'span3';
    $box_size = $columns == 3? 'box-huge':'box-big';
    // fetch posts
    $projects = new WP_Query( $query_options );
    $output = '';
    if( $projects->have_posts()) {
        $projects_per_row = ($span == 'span4')? 3:4;
        $project_num = 1;

        $output.='<div class="portfolio-filters"><h5 class="text-center"><a class="active" data-filter="all" href="#">' . __('all', THEME_FRONT_TD) . '</a>';
        foreach( $filters as $filter ) {
            $output.=' / <a href="#" data-filter="'.urldecode($filter->slug).'">'.$filter->name.'</a>';
        }
        $output.='</h5></div><div class="row-fluid"><ul class="thumbnails portfolio">';

        while ($projects->have_posts()) {
            $projects->next_post();
            setup_postdata($projects->post);

            $format = get_post_format( $projects->post->ID );
            if( false === $format ) {
                $format = 'standard';
            }

            $image_link = $format == 'link' ? '<a class="box-inner" href="' . get_the_content() . '">' : '<a class="box-inner" href="' . get_permalink($projects->post->ID) . '">';
            $title_link = $format == 'link' ? '<a href="'. get_the_content() . '">' : '<a href="'. get_permalink($projects->post->ID) . '">';
            $extra_gallery_images = array();

            $use_fancybox = get_post_meta( $projects->post->ID, THEME_SHORT . '_open_fancybox' , true );
            if( $use_fancybox ) {
                switch ( $format ) {
                    case 'gallery':
                        $gallery_ids = oxy_get_content_gallery( $projects->post );
                        if( $gallery_ids !== null ) {
                            if( count( $gallery_ids ) > 0 ) {
                                // ok lets create a gallery
                                $gallery_rel = 'rel="gallery' . $projects->post->ID . '"';
                                $gallery_image = wp_get_attachment_image_src( $gallery_ids[0], 'full');
                                $image_link = '<a class="box-inner fancybox" href="' . $gallery_image[0] . '" ' . $gallery_rel . '>';

                                // remove first gallery image from array
                                array_shift( $gallery_ids );
                                foreach( $gallery_ids as $gallery_image_id ) {
                                    $gallery_image = wp_get_attachment_image_src( $gallery_image_id, 'full');
                                    $extra_gallery_images[] = '<a class="fancybox" href="' . $gallery_image[0] . '" ' . $gallery_rel . '></a>';
                                }
                            }
                        }
                    break;
                    case 'video':
                        $video_shortcode = oxy_get_content_shortcode( $projects->post, 'embed' );
                        if( $video_shortcode !== null ) {
                            if( isset( $video_shortcode[5] ) ) {
                                $video_shortcode = $video_shortcode[5];
                                if( isset( $video_shortcode[0] ) ) {
                                    $image_link = '<a href="' . $video_shortcode[0] . '" class="box-inner fancybox-media">';
                                }
                            }
                        }
                    break;
                    case 'link':
                        $link_shortcode = oxy_get_content_shortcode( $projects->post->ID, 'link' );
                        if( $link_shortcode !== null ) {
                            if( isset( $link_shortcode[5] ) ) {
                                $link_shortcode = $link_shortcode[5];
                                if( isset( $link_shortcode[0] ) ) {
                                    $title_link = '<a href="' . $link_shortcode[0] . '">';
                                    $image_link = '<a href="' . $link_shortcode[0] . '">';
                                }
                            }
                        }
                    break;
                    default:
                    case 'standard':
                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($projects->post->ID), 'full');
                        $image_link = '<a class="box-inner fancybox" href="' . $featured_image[0] . '">';
                    break;
                }
            }

            $filter_tags = get_the_terms( $projects->post->ID, 'oxy_portfolio_categories' );
            $author_id  = get_the_author_meta('ID');
            $post_filters = array();
            if( $filter_tags && ! is_wp_error( $filter_tags ) ) {
                foreach( $filter_tags as $tag ) {
                      $post_filters[] = 'filter-' .urldecode($tag->slug);
                }
            }
            $output .= '<li class=" '. $span .' '. implode( ' ', $post_filters ) .'" >';
            $output .= '<figure class="round-box ' . $box_size . ' ' . $img_style . '">';
            $output .= $image_link;
            $output .= get_the_post_thumbnail( $projects->post->ID, 'portfolio-thumb', array( 'class' => 'img-circle', 'alt' => get_the_title($projects->post->ID) ) ).'<i class="plus-icon"></i>';
            $output .= '</a>';
            $output .= '<figcaption><h4>';
            $output .= $title_link;
            $output .= get_the_title($projects->post->ID);
            $output .= '</a></h4>';
            if( $format !== 'link' ) {
                $output .= '<p>' . oxy_limit_excerpt( get_the_excerpt(), oxy_get_option( 'portfolio_excerpt_words' ) ) . '</p>';
            }
            else{
                $output .= '<p>' . get_the_content() . '</p>';
            }
            $output .= '</figcaption></figure>';
            foreach( $extra_gallery_images as $extra_image ) {
                $output .= $extra_image;
            }
            $output .= '</li>';
        }
        $output .= '</ul></div>';
    }
    wp_reset_postdata();
    return oxy_shortcode_section( $atts, $output );

}

add_shortcode( 'portfolio', 'oxy_shortcode_portfolio' );


/* ------------------ LAYOUT SHORTCODES ------------------- */

/* ------------------ COLUMNS SHORTCODES ------------------- */

function oxy_shortcode_row( $atts, $content = null, $code ) {
    return '<div class="row-fluid">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'row', 'oxy_shortcode_row' );

function oxy_shortcode_layout( $atts, $content = null, $code ) {
    return '<div class="' . $code . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'span1', 'oxy_shortcode_layout' );
add_shortcode( 'span2', 'oxy_shortcode_layout' );
add_shortcode( 'span3', 'oxy_shortcode_layout' );
add_shortcode( 'span4', 'oxy_shortcode_layout' );
add_shortcode( 'span5', 'oxy_shortcode_layout' );
add_shortcode( 'span6', 'oxy_shortcode_layout' );
add_shortcode( 'span7', 'oxy_shortcode_layout' );
add_shortcode( 'span8', 'oxy_shortcode_layout' );
add_shortcode( 'span9', 'oxy_shortcode_layout' );
add_shortcode( 'span10', 'oxy_shortcode_layout' );
add_shortcode( 'span11', 'oxy_shortcode_layout' );
add_shortcode( 'span12', 'oxy_shortcode_layout' );


/* ---------- LEAD SHORTCODE ---------- */
function oxy_shortcode_lead( $atts, $content ) {
    extract( shortcode_atts( array(
        'centered'  => 'yes'
    ), $atts ) );
    $extraclass = ( $centered == 'yes')? ' text-center':'';
    return '<p class="lead'.$extraclass.'">' . do_shortcode($content) . '</p>';
}
add_shortcode( 'lead', 'oxy_shortcode_lead' );

function oxy_shortcode_donothing() {
    return '';
}
add_shortcode( 'link', 'oxy_shortcode_donothing' );


function oxy_shortcode_blockquote( $atts, $content ) {
    extract( shortcode_atts( array(
        'who'   => '',
        'cite'  => '',
    ), $atts ) );
    $output = '<blockquote>"' . do_shortcode($content) . '"';
    if( !empty( $who ) ) {
        $output .= '<small>' . $who;
        if( !empty( $cite ) ) {
            $output .= ' <cite title="source title">' . $cite . '</cite>';
        }
        $output .= '</small>';
    }
    $output .= '</blockquote>';

    return $output;
}add_shortcode( 'blockquote', 'oxy_shortcode_blockquote' );


/************************************      SECTIONS       ********************************/

/* Basic Section */
function oxy_shortcode_section($atts , $content = '') {
    extract( shortcode_atts( array(
        'style'      => '',
        'title'      => '',
        'class'      => '',
        'header_size'=> 'h1',
    ), $atts ) );

    switch( $style ) {
        case 'gray':
            $style = ' section-alt';
        break;
        case 'dark':
            $style = ' section-alt section-dark';
        break;
    }

    $section_title = ( $title != '' ) ? '<div class="section-header"><'.$header_size.'>' . oxy_filter_title( $title ) . '</'.$header_size.'></div>' : '';
    return '<section class="section section-padded' . $style . ' ' . $class . '"><div class="container-fluid">' . $section_title . '<div class="row-fluid">'.do_shortcode( $content ) .'</div></div></section>';
}
add_shortcode( 'section', 'oxy_shortcode_section' );

/* Services Section */
function oxy_shortcode_services( $atts ) {
    extract( shortcode_atts( array(
        'category'    => '',
        'count'       => 3,
        'columns'     => 3,
        'links'       => 'show',
        'lead'        => 'hide',
        'title'       => '',
        'style'       => '',
        'title_size'  => 'medium',
        'image_style' => ''
    ), $atts ) );

    $query = array(
        'post_type'      => 'oxy_service',
        'posts_per_page' =>  $count === '0' ? -1 : $count,
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    );

    if( !empty( $category ) ) {
        $query['tax_query'] = array(
            array(
                'taxonomy' => 'oxy_service_category',
                'field' => 'slug',
                'terms' => $category
            )
        );
    }

    global $post;
    $tmp_post = $post;

    $services = new WP_Query( $query );
    $output = '';
    if( $services->have_posts() ) {
        $output .= '<ul class="unstyled row-fluid">';
        if ($title_size == 'big')
            $header = 'h2';
        else if ( $title_size == 'medium')
            $header = 'h3';
        else
            $header = 'h4';
        $size = ($columns == 4)? 'round-medium': 'box-big';
        $text_class = ($lead == 'show')?' class="lead text-center"':'';
        $services_per_row = ($columns == 3)? 3:4;
        $span = ($columns== 4)?'span3':'span4';
        $service_num = 1;
        while( $services->have_posts() ) {
            $services->next_post();
            setup_postdata($services->post);
            global $more;
            $more = 0;
            if( $links == 'show' ){
                $link = oxy_get_slide_link( $services->post );
                if( null == $link ) {
                    $link = get_permalink($services->post->ID);
                }
            }
            if( $service_num > $services_per_row){
                $output .='</ul><ul class="unstyled row-fluid">';
                $service_num = 1;
            }
            $icon = get_post_meta( $services->post->ID, THEME_SHORT. '_icon', true );
            $output .= '<li class="'.$span.'">';
            $output .= '<div class="round-box '.$size.' '.$image_style.'">';
            if( $links == 'show' ) {
                $output .= '<a href="' . $link . '" class="box-inner">';
            }
            else {
                $output .= '<span class="box-inner">';
            }

            $output .= get_the_post_thumbnail( $services->post->ID, 'portfolio-thumb', array( 'class' => 'img-circle', 'alt' => get_the_title() ) );
            if( $icon != '' ) {
                $output .= '<i class="' . $icon . '"></i>';
            }

            if( $links == 'show' ) {
                $output .= '</a>';
            }
            else {
                $output .= '</span>';
            }
            $output .= '</div>';
            if( $links == 'show' ) {
                $output .= '<a href="' . $link . '">';
            }
            $output .= '<'.$header.' class="text-center">' . get_the_title($services->post->ID) . '</'.$header.'>';
            if( $links == 'show' ) {
                $output .= '</a>';
            }
            $output .= '<p'.$text_class.'>' .  apply_filters( 'the_content', get_the_content('') ) . '</p>';
             if( $links == 'show' ) {
                $more_text = oxy_get_option('blog_readmore')? oxy_get_option('blog_readmore'): __('Read more', THEME_FRONT_TD);
                $output .= '<a href="'.$link.'" class="more-link">'. $more_text.'</a>';
            }
            $output .= '</li>';
            $service_num++;
        }
        $output .= '</ul>';
    }

    wp_reset_postdata();

    return oxy_shortcode_section( $atts, $output );
}
add_shortcode( 'services', 'oxy_shortcode_services' );

/* Recent Posts */
function oxy_get_recent_posts( $count, $category= null, $authors=null, $post_formats=null ) {
    $query = array();
    // set post count
    $query['posts_per_page'] = $count;
    $query['ignore_sticky_posts'] = true;
    // set category if selected
    if( !empty( $category ) ) {
        $query['category_name'] = $category;
    }
    // set author if selected
    if( !empty( $authors ) ) {
        $query['author'] = implode( ',', $authors );
    }
    // set post format if selected
    if( !empty( $post_formats ) ) {
        foreach( $post_formats as $key => $value ) {
            $post_formats[$key] = 'post-format-' . $value;
        }
        $query['tax_query'] = array();
        $query['tax_query'][] = array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => $post_formats
        );
    }
    // fetch posts
    return new WP_Query( $query );
}

function oxy_shortcode_recent_posts($atts , $content = '' ) {
    // setup options
    extract( shortcode_atts( array(
        'title'        => '',
        'cat'          => null,
        'count'        => 3,
        'style'        => '',
        'columns'      => 3
    ), $atts ) );

    $span = $columns > 0 ? 'span'.floor(12/$columns) : 'span3';

    $posts = oxy_get_recent_posts( $count , $cat );
    $output = '';
    if( $posts->have_posts() ) :
        $output .='<ul class="unstyled row-fluid">';
        $item_num = 1;
        $items_per_row = $columns;
        while($posts->have_posts()):
            $posts->next_post();
            $post = $posts->post;
            setup_postdata( $post );
            if('link' == get_post_format()){
                $post_link = oxy_get_external_link();
            }
            else{
                $post_link = get_permalink($posts->post->ID);
            }

            if($item_num > $items_per_row){
                $output.=  '</ul><ul class="unstyled row-fluid">';
                $item_num = 1;
            }

            $output .='<li class="'.$span.'"><div class="row-fluid"><div class="span4">';
            $output .='<div class="round-box box-small box-colored"><a href="' . $post_link . '" class="box-inner">';
            if( has_post_thumbnail( $posts->post->ID ) ) {
                $output .= get_the_post_thumbnail( $posts->post->ID, 'portfolio-thumb', array('title'=>$posts->post->post_title,'alt'=>$posts->post->post_title, 'class'=>'img-circle'));
                $output .= oxy_post_icon($posts->post->ID ,false);
            }
            else{
                $output .= '<img class="img-circle" src="'.IMAGES_URI.'box-empty.gif">';
                $output .=  oxy_post_icon($posts->post->ID ,false);
            }
            $output.='</a></div><h5 class="text-center light">'. get_the_date(get_option('date_format'), $posts->post->ID) .'</h5>';
            $output.='</div><div class="span8"><h3><a href="' . $post_link . '">'.get_the_title($posts->post->ID).'</a>';
            $output.='</h3><p>'.oxy_limit_excerpt(get_the_excerpt(),15 ).'</p></div></div></li>';
            $item_num++;
        endwhile;
        $output .= '</ul>';
    endif;
    // reset post data
    wp_reset_postdata();
    return oxy_shortcode_section( $atts, $output );
}
add_shortcode( 'recent_posts', 'oxy_shortcode_recent_posts' );

/* Staff Featured */
function oxy_shortcode_staff_featured($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'title'        => '',
        'member'       => '',
        'style'        => ''
    ), $atts ) );

    $output = '';
    if($member !== ''):
        $item = get_post( $member );
        $custom_fields  = get_post_custom($item->ID);
        $img            = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'full' );
        $position       = (isset($custom_fields[THEME_SHORT.'_position']))? $custom_fields[THEME_SHORT.'_position'][0]:'';
        $skills         = wp_get_post_terms( $item->ID, 'oxy_staff_skills' );
        $output.='<div class="row-fluid"><div class="span6"><img alt="'  . $item->post_title . '" class="push-bottom" src="'.$img[0].'"></div>';
        $output.='<div class="span6"><p class="lead">'.$item->post_content.'</p>';
        if ( !empty($skills) ) {
            $output.='<ul class="lead icons icons-small">';
            foreach ($skills as $skill) {
                $output.='<li><i class="icon-ok"></i>'.$skill->name.'</li>';
            }
             $output.='</ul>';
        }
        $output.='</div></div>';
        wp_reset_postdata();
    endif;
    return oxy_shortcode_section( $atts, $output );
}
add_shortcode( 'staff_featured', 'oxy_shortcode_staff_featured' );

/* Staff List */
function oxy_shortcode_staff_list($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'title'       => '',
        'count'       => 3,
        'columns'     => 3,
        'style'       => '',
        'department'  => '',
        'link_target' => '_self'
    ), $atts ) );

    $query_options = array(
        'post_type'      => 'oxy_staff',
        'posts_per_page' => $count === '0' ? -1 : $count,
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
    );

    $span = $columns == 3 ? 'span4' : 'span3';

    if( !empty( $department ) ) {
        $query_options['tax_query'] = array(
            array(
                'taxonomy' => 'oxy_staff_department',
                'field' => 'slug',
                'terms' => $department
            )
        );
    }

    // fetch posts
    $members = new WP_Query( $query_options );
    $output = '';
    if( $members->have_posts()):
        $members_per_row = $columns;
        $member_num = 1;

        $output .= '<ul class="unstyled row-fluid">';

        while ($members->have_posts()) :
            $members->next_post();
            setup_postdata($members->post);
            $custom_fields = get_post_custom($members->post->ID);
            $position       = (isset($custom_fields[THEME_SHORT . '_position']))? $custom_fields[THEME_SHORT . '_position'][0]:'';
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($members->post->ID), 'full' );

            if($member_num > $members_per_row){
                $output.='</ul><ul class="unstyled row-fluid">';
                $member_num = 1;
            }

            $output.='<li class="'.$span.'"><div class="round-box box-big"><span class="box-inner"><img alt="' . get_the_title($members->post->ID) . '" class="img-circle" src="'.$img[0].'">';
            $output.='</span></div><h3 class="text-center">'.get_the_title($members->post->ID) .'<small class="block">'.$position.'</small></h3>';
            $output.='<p>'.get_the_content() .'</p>';
            $output.='<ul class="inline text-center big social-icons">';
            // must render
            for( $i = 0; $i < 5; $i++){
                $icon = (isset($custom_fields[THEME_SHORT . '_icon'.$i]))? $custom_fields[THEME_SHORT . '_icon'.$i][0]:'';
                $link = (isset($custom_fields[THEME_SHORT . '_link'.$i]))? $custom_fields[THEME_SHORT . '_link'.$i][0]:'';
                $output.=($link !== '')?'<li><a data-iconcolor="'.oxy_get_icon_color($icon).'" href="'. $link.'" target="'.$link_target.'" style="color: rgb(66, 87, 106);"><i class="'.$icon.'"></i></a></li>':'';
            }
            $output.='</ul>';
            $output.='</li>';
            $member_num++;
        endwhile;
        $output .= '</ul>';
    endif;
    wp_reset_postdata();
    return oxy_shortcode_section( $atts, $output );

}
add_shortcode( 'staff_list', 'oxy_shortcode_staff_list' );


/******************************************      COMPONENTS        *************************************/

/* Slideshow Shortcode */

function oxy_shortcode_flexslider( $atts, $content = null ){
    $params = shortcode_atts( array(
        'slideshow'        => '',
        'animation'        => 'slide',
        'speed'            => 7000,
        'duration'         => 600,
        'directionnav'     => 'hide',
        'directionnavpos'  => 'outside',
        'controlsposition' => 'inside',
        'itemwidth'        => '',
        'showcontrols'     => 'show',
        'captions'         => 'show',
        'captionsize'      => 'super',
        'captionanimation' => 'animated',
        'autostart'        => 'true'
    ), $atts );
    return oxy_create_flexslider($params['slideshow'], $params , false);
}
add_shortcode( 'flexslider', 'oxy_shortcode_flexslider' );

/**
 * Icon List Shortcode
 *
 * @return Icon List
 **/
function oxy_shortcode_iconlist( $atts, $content = null ) {
    $output = '<ul class="icons">';
    $output .= do_shortcode( $content );
    $output .= '</ul>';
    return $output;
}
add_shortcode( 'iconlist', 'oxy_shortcode_iconlist' );

/**
 * Icon Item Shortcode - for use inside an iconlist shortcode
 *
 * @return Icon Item HTML
 **/
function oxy_shortcode_iconitem( $atts, $content = null) {
    extract( shortcode_atts( array(
        'title'       => '',
        'icon'        => '',
    ), $atts ) );

    $output = '<li>';
    $output .= '<h4>';
    $output .= '<i class="' . $icon . '"></i>';
    $output .= $title;
    $output .= '</h4>';
    $output .= '<p>';
    $output .= $content;
    $output .= '</p>';
    $output .= '</li>';
    return $output;
}
add_shortcode( 'iconitem', 'oxy_shortcode_iconitem' );

/**
 * Code shortcode - for showing code!
 *
 * @return Code html
 **/
function oxy_shortcode_code( $atts, $content = null) {
    return '<pre>' . htmlentities( $content ) . '</pre>';
}
add_shortcode( 'code', 'oxy_shortcode_code' );

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * images on a post.
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 * @since 1.2
 */
function oxy_gallery_shortcode($attr) {
    $post = get_post();

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'medium',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby,  'posts_per_page' => -1) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $columns = intval($columns);
    $span_width = $columns > 0 ? floor(12/$columns) : 12;
    $gallery_rel = 'gallery-' . rand(1,100);


    $output = '<ul class="thumbnails">';
    foreach ( $attachments as $id => $attachment ) {
        $thumb = wp_get_attachment_image_src( $id, $size );
        $full = wp_get_attachment_image_src( $id, 'full' );
        $output .= '<li class="span' . $span_width . '">';
        $output .= '<div class="thumbnail">';
        $output .= '<a class="fancybox" rel="' . $gallery_rel . '" href="' . $full[0]  . '">';
        $output .= '<img src="' . $thumb[0] . '">';
        $output .= '</a>';
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= '<div class="caption">';
            $output .= '<p>' . wptexturize($attachment->post_excerpt) . '</p>';
            $output .= '</div>';
        }
        $output .= '</div>';
        $output .= '</li>';
    }

    $output .= '</ul>';
    return $output;
}
add_shortcode( 'gallery', 'oxy_gallery_shortcode' );

/**
 * Icon shortcode - for showing an icon
 *
 * @return Icon html
 **/
function oxy_shortcode_icon( $atts, $content = null) {
    extract( shortcode_atts( array(
        'size'       => 0,
    ), $atts ) );

    $output = '<i class="' . $content . '"';
    if( $size !== 0 ) {
        $output .= ' style="font-size:' . $size . 'px"';
    }
    $output .= '></i>';
    return $output;
}
add_shortcode( 'icon', 'oxy_shortcode_icon' );


/**
 * Categories shortcode - for showing a category dropdown
 *
 * @return Categories html
 **/

function oxy_shortcode_categories( $atts, $content = null) {
    extract( shortcode_atts( array(
        'categoriespostcount'   => 'on',
        'categorieshierarchy'   => 'on',
    ), $atts ) );

    $h = $categorieshierarchy == 'on'? "1" : "0";
    $c = $categoriespostcount == 'on'? "1" : "0";

    $cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h, 'echo' => 0);
    return wp_list_categories( $cat_args );
}

add_shortcode( 'categories', 'oxy_shortcode_categories' );
