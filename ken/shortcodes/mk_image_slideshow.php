<?php

extract(shortcode_atts(array(
    "images" => '',
    "image_width" => 770,
    "image_height" => 350,
    "effect" => 'fade',
    "animation_speed" => 700,
    "slideshow_speed" => 7000,
    "direction" => 'horizontal',
    "direction_nav" => "true",
    "pagination" => "false",
    "freeModeFluid" => "true",
    "freeMode" => "false",
    "margin_bottom" => 20,
    'loop' => 'true',
    "mousewheelControl" => 'false',
    "slideshow_aligment" => 'left',
    "el_class" => ''
), $atts));

if ($images == '')
    return null;


$style_id     = Mk_Static_Files::shortcode_id();
$slides = $output = '';
$images = explode(',', $images);
$i      = -1;

foreach ($images as $attach_id) {
    if(!empty($attach_id)) {
        $i++;
        $image_src_array = wp_get_attachment_image_src($attach_id, 'full');
        $image_src = mk_thumbnail_image_gen($image_src_array[0], $image_width, $image_height);

        $slides .= '<div class="swiper-slide">';
        $slides .= '<img alt="" src="' . $image_src . '" />';
        $slides .= '</div>' . "\n\n";
    }

}


$output .= '<div class="mk-image-slideshow" id="mk-image-slideshow-' . $style_id . '" style="max-width:100%;max-height:' . $image_height . 'px; margin-bottom:'.$margin_bottom.'px; float:'.$slideshow_aligment.';"><div id="mk-swiper-' . $style_id . '" style="max-width:100%" data-loop="true" data-freeModeFluid="' . $freeModeFluid . '" data-slidesPerView="1" data-pagination="' . $pagination . '" data-freeMode="' . $freeMode . '" data-mousewheelControl="false" data-direction="' . $direction . '" data-slideshowSpeed="' . $slideshow_speed . '" data-animationSpeed="' . $animation_speed . '" data-directionNav="' . $direction_nav . '" class="mk-swiper-container mk-swiper-slider ' . $el_class . '">';

$output .= '<div class="mk-swiper-wrapper">' . $slides . '</div>';

if ($direction_nav == 'true') {
    $output .= '<a class="mk-swiper-prev slideshow-swiper-arrows"><i class="mk-theme-icon-prev-big"></i></a>';
    $output .= '<a class="mk-swiper-next slideshow-swiper-arrows"><i class="mk-theme-icon-next-big"></i></a>';
}

if ($pagination == 'true') {
    $output .= '<div class="swiper-pagination"></div>';
}

$output .= '</div></div>';



Mk_Static_Files::addCSS('
    @media handheld, only screen and (max-width:'.$image_width.'px) {
        #mk-image-slideshow-' . $style_id . ' {
            float:none !important;
        }
    }
', $style_id);

echo $output;
