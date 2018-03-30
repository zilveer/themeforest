<?php

extract(shortcode_atts(array(
    'count' => 10,
    'column' => 3,
    'style' => 'column_rounded',
    'dimension' => 250,
    'employees' => '',
    'animation' => '',
    'scroll' => 'true',
    'description' => 'true',
    'el_class' => '',
    'offset' => '',
    'autoplay' => 'true',
    'directionNav' => 'true',
    'full_width_image' => 'false',
    'orderby' => 'date',
    'order' => 'DESC'
), $atts));

require_once THEME_INCLUDES . "/image-cropping.php";    

$id     = Mk_Static_Files::shortcode_id();
$output = $image_width = '';

$scroll_stuff = array(
    '',
    '',
    '',
    '',
    ''
);


if($full_width_image == 'true'){
    $image_width = 'width:100%;';
}



$query = array(
    'post_type' => 'employees',
    'showposts' => $count
);

if ($employees) {
    $query['post__in'] = explode(',', $employees);
}
if ($offset) {
    $query['offset'] = $offset;
}
if ($orderby) {
    $query['orderby'] = $orderby;
}
if ($order) {
    $query['order'] = $order;
}

$loop = new WP_Query($query);

$animation_css = ($animation != '') ? ' mk-animate-element ' . $animation . ' ' : '';

if ($style == 'column' || $style == 'column_rounded'):
    $image_dimension = $column_css = '';
    switch ($column) {
        case 1:
            $image_dimension = 550;
            $column_css      = 'one';
            break;
        case 2:
            $image_dimension = 508;
            $column_css      = 'two';
            break;
        case 3:
            $image_dimension = 500;
            $column_css      = 'three';
            break;
        case 4:
            $image_dimension = 500;
            $column_css      = 'four';
            break;
        case 5:
            $image_dimension = 300;
            $column_css      = 'five';
            break;
    }


    $output .= '<div id="employees-' . $id . '" class="mk-employees mk-shortcode ' . $el_class . ' ' . $column_css . '-column ' . $style . '-style"><ul>';

    $i = 0;
    while ($loop->have_posts()):
        $loop->the_post();
        $i++;

        $facebook        = get_post_meta(get_the_ID(), '_facebook', true);
        $linkedin        = get_post_meta(get_the_ID(), '_linkedin', true);
        $twitter         = get_post_meta(get_the_ID(), '_twitter', true);
        $email           = get_post_meta(get_the_ID(), '_email', true);
        $website         = get_post_meta(get_the_ID(), '_website', true);
        $pinterest       = get_post_meta(get_the_ID(), '_pinterest', true);
        $googleplus      = get_post_meta(get_the_ID(), '_googleplus', true);
        $instagram       = get_post_meta(get_the_ID(), '_instagram', true);
        $dribbble        = get_post_meta(get_the_ID(), '_dribbble', true);
        $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
        $image_src       = bfi_thumb($image_src_array[0], array(
            'width' => $image_dimension,
            'height' => $image_dimension,
            'crop' => true
        ));

        $first_column = '';

        $output .= '<li class="mk-employee-item"><div class="employee-item-wrapper">';


        $output .= '<div class="team-thumbnail ' . $animation_css . '" onClick="return true"><img alt="' . get_the_title() . '" style="'.$image_width.'" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $image_dimension, $image_dimension) . '" />';
        $output .= '<div class="hover-overlay"></div>';
        if ($image_dimension > 200) {
            $output .= '<ul class="mk-employeee-networks">';
            if (!empty($email)) {
                $output .= '<li><a href="mailto:' . antispambot($email) . '" title="' . __('Get In Touch With', 'mk_framework') . ' ' . get_the_title() . '"><i class="mk-icon-envelope-o"></i></a></li>';
            }
            if (!empty($facebook)) {
                $output .= '<li><a href="' . $facebook . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Facebook"><i class="mk-icon-facebook"></i></a></li>';
            }
            if (!empty($website)) {
                $output .= '<li><a href="' . $website . '" title="' . get_the_title() . ' ' . __('Website', 'mk_framework') . '"><i class="mk-icon-globe"></i></a></li>';
            }
            if (!empty($dribbble)) {
                $output .= '<li><a href="' . $dribbble . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Dribbble"><i class="mk-icon-dribbble"></i></a></li>';
            }
            if (!empty($instagram)) {
                $output .= '<li><a href="' . $instagram . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Instagram"><i class="mk-icon-instagram"></i></a></li>';
            }
            if (!empty($twitter)) {
                $output .= '<li><a href="' . $twitter . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Twitter"><i class="mk-icon-twitter"></i></a></li>';
            }
            if (!empty($googleplus)) {
                $output .= '<li><a href="' . $googleplus . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Google Plus"><i class="mk-icon-google-plus"></i></a></li>';
            }
            if (!empty($pinterest)) {
                $output .= '<li><a href="' . $pinterest . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Pinterest"><i class="mk-icon-pinterest"></i></a></li>';
            }
            if (!empty($linkedin)) {
                $output .= '<li><a href="' . $linkedin . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Linked In"><i class="mk-icon-linkedin"></i></a></li>';
            }
            $output .= '</ul></div>';
        }

        $output .= '<div class="team-info-wrapper">';
        $output .= '<span class="team-member-name">' . get_the_title() . '</span>';
        $output .= '<span class="team-member-position">' . get_post_meta(get_the_ID(), '_position', true) . '</span>';

        if ($description == 'true') {
            $content = get_post_meta(get_the_ID(), '_desc', true);
            $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content));
            $output .= '<span class="team-member-desc">' . $content . '</span>';
        }

        $output .= '</div>';

        $output .= '</div></li>';



        if ($i % $column == 0) {
            $output .= '<div class="clearboth"></div>';
        }
    endwhile;
    wp_reset_query();

    $output .= '</ul><div class="clearboth"></div></div>';
else:
    if ($scroll == 'true') {
        $scroll_stuff = array(
            'mk-swiper-container mk-swiper-slider ',
            ' data-freeModeFluid="true" data-slidesPerView="auto" data-loop="false" data-pagination="false" data-freeMode="false" data-mousewheelControl="false" data-direction="horizontal" data-slideshowSpeed="4000" data-animationSpeed="400" data-directionNav="false" ',
            'mk-swiper-wrapper',
            'swiper-slide'
        );
    }


    $output .= '<div id="employees-' . $id . '" class="mk-employees ' . $scroll_stuff[0] . $el_class . ' ' . $style . '-style "' . $scroll_stuff[1] . '><ul class="' . $scroll_stuff[2] . '">';

    while ($loop->have_posts()):
        $loop->the_post();

        $facebook        = get_post_meta(get_the_ID(), '_facebook', true);
        $linkedin        = get_post_meta(get_the_ID(), '_linkedin', true);
        $twitter         = get_post_meta(get_the_ID(), '_twitter', true);
        $email           = get_post_meta(get_the_ID(), '_email', true);
        $website         = get_post_meta(get_the_ID(), '_website', true);
        $pinterest       = get_post_meta(get_the_ID(), '_pinterest', true);
        $googleplus      = get_post_meta(get_the_ID(), '_googleplus', true);
        $instagram       = get_post_meta(get_the_ID(), '_instagram', true);
        $dribbble        = get_post_meta(get_the_ID(), '_dribbble', true);
        $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
        $image_src       = bfi_thumb($image_src_array[0], array(
            'width' => $dimension,
            'height' => $dimension,
            'crop' => true
        ));

        $output .= $style == 'grid' ? '<li class="mk-employee-item ' . $scroll_stuff[3] . '" onClick="return true">' : '<li class="mk-employee-item ' . $scroll_stuff[3] . '">';
        $output .= '<img alt="' . get_the_title() . '" style="'.$image_width.'" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src, $dimension, $dimension) . '" />';
        $output .= '<div class="hover-overlay"></div>';


        $output .= '<div class="team-info-wrapper"><div class="team-info-holder">';
        $output .= '<span class="team-member-name">' . get_the_title() . '</span>';
        $output .= '<span class="team-member-position">' . get_post_meta(get_the_ID(), '_position', true) . '</span>';
        if ($dimension > 200) {
            $output .= '<ul class="mk-employeee-networks">';
            if (!empty($email)) {
                $output .= '<li><a href="mailto:' . antispambot($email) . '" title="' . __('Get In Touch With', 'mk_framework') . ' ' . get_the_title() . '"><i class="mk-icon-envelope-o"></i></a></li>';
            }
            if (!empty($facebook)) {
                $output .= '<li><a href="' . $facebook . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Facebook"><i class="mk-icon-facebook"></i></a></li>';
            }
            if (!empty($website)) {
                $output .= '<li><a href="' . $website . '" title="' . get_the_title() . ' ' . __('Website', 'mk_framework') . '"><i class="mk-icon-globe"></i></a></li>';
            }
            if (!empty($dribbble)) {
                $output .= '<li><a href="' . $dribbble . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Dribbble"><i class="mk-icon-dribbble"></i></a></li>';
            }
            if (!empty($instagram)) {
                $output .= '<li><a href="' . $instagram . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Instagram"><i class="mk-icon-instagram"></i></a></li>';
            }
            if (!empty($twitter)) {
                $output .= '<li><a href="' . $twitter . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Twitter"><i class="mk-icon-twitter"></i></a></li>';
            }
            if (!empty($googleplus)) {
                $output .= '<li><a href="' . $googleplus . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Google Plus"><i class="mk-icon-google-plus"></i></a></li>';
            }
            if (!empty($pinterest)) {
                $output .= '<li><a href="' . $pinterest . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Pinterest"><i class="mk-icon-pinterest"></i></a></li>';
            }
            if (!empty($linkedin)) {
                $output .= '<li><a href="' . $linkedin . '" title="' . get_the_title() . ' ' . __('On', 'mk_framework') . ' Linked In"><i class="mk-icon-linkedin"></i></a></li>';
            }
            $output .= '</ul>';
        }

        $output .= '</div></div></li>';
    endwhile;
    wp_reset_query();

    $output .= '</ul></div>';
endif;


echo $output;
