<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = uniqid();

$lightbox_enabled = $src_lightbox = $image_svg_enabled = $max_width_css = $is_svg_class = '';

$image_id = mk_get_attachment_id_from_url($src);
$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
$image_media_title = get_the_title($image_id);

$image_alt = !(empty($alt)) ? $alt : $image_media_title;
$image_title = !(empty($image_media_title)) ? $image_media_title : (!empty($title) ? $title : $alt);

if ($lightbox == 'true') {
    $lightbox_enabled = 'lightbox-enabled';
    $custom_lightbox = !empty($custom_lightbox) ? ($src_lightbox = $custom_lightbox) : $src_lightbox = $src;
}

$is_svg = (pathinfo($src, PATHINFO_EXTENSION) == 'svg');


if ($image_size == 'crop') {
    $image_output_src = Mk_Image_Resize::resize_by_url($src, $image_width, $image_height, $crop = true, $dummy = true);
} 
else {

    if (!empty($image_id)) {

        if (!Mk_Image_Resize::is_default_thumb(wp_get_attachment_image_src($image_id, 'full') [0])) {
            $image_src_array = wp_get_attachment_image_src($image_id, $image_size, true);
            $image_output_src = $image_src_array[0];
            $image_width = $image_src_array[1];
            $image_height = $image_src_array[2];
        } 
        else {
            $image_output_src = Mk_Image_Resize::resize_by_url($src, $image_width, $image_height, $crop = true, $dummy = true);
        }
    } else {
        
        // When image size is not crop and image is not locally hosted. we return the image itself without touching it
        $image_output_src = $src;
    }
}

if(!empty($image_id)) {
        
    $image_src_array = wp_get_attachment_image_src($image_id, $image_size, true);
    $actual_image_width = $image_src_array[1];
    $actual_image_height = $image_src_array[2];

} else {
    $imageSize = mk_getimagesize($image_output_src);
    $actual_image_width = $imageSize[0];
    $actual_image_height = $imageSize[1];
}

if($is_svg) {
    $is_svg_class = 'is-svg';
    if($svg == 'true') {
        $max_width_css = 'width:100%;';
        $image_svg_enabled = 'style="width:100%;"';
    }
}else {
    $max_width_css = 'max-width: ' . $actual_image_width . 'px;';
}




$output.= '<div class="mk-image ' . $visibility . ' ' . $lightbox_enabled . ' align-' . $align . ' ' . get_viewport_animation_class($animation) . $frame_style . '-frame ' . $caption_location . ' ' . $el_class . '" style="margin-bottom:' . $margin_bottom . 'px">';

$output.= mk_get_view('global', 'shortcode-heading', true, ['title' => $heading_title]);

$svg = ($svg == 'true') ? ('style="max-width:' . $actual_image_width . 'px" ') : '';
$output.= '<div class="mk-image-holder" style="'.$max_width_css.'">';
$output.= '<div class="mk-image-inner '.$is_svg_class.'">';
$output.= ($link) ? '<a href="' . $link . '" target="' . $target . '" class="mk-image-link">' : '';

$output.= '<img class="lightbox-' . $lightbox . '" alt="' . esc_attr($image_alt) . '" title="' . esc_attr($image_title) . '" width="' . $actual_image_width . '" height="' . $actual_image_height . '" src="' . $image_output_src . '" ' . $image_svg_enabled . '/>';

$output.= ($link) ? '</a>' : '';

if ($lightbox == 'true') {
    $output.= '<div class="mk-image-overlay"></div>';
    $output.= '<a href="' . $src_lightbox . '" alt="' . $image_alt . '" data-fancybox-group="image-shortcode-' . $group . '" title="' . esc_attr($title) . '" class="mk-lightbox ' . $group . ' mk-image-lightbox">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-jupiter-icon-plus-circle').'</a>';
}

$output.= '</div>';

if ((!empty($title) || !empty($desc))) {
    $output.= '<div class="mk-image-caption">';
    if (!empty($title)) {
        $output.= '<span class="mk-caption-title">' . $title . '</span>';
    }
    if (!empty($desc)) {
        $output.= '<span class="mk-caption-desc">' . $desc . '</span>';
    }
    $output.= '</div>';
}
$output.= '</div>';
$output.= '<div class="clearboth"></div></div>';

echo $output;
