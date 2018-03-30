<?php

$output = $el_class = $image = $img_size = $img_link = $img_link_target = $img_link_large = $title = $alignment = $css_animation = '';

extract(shortcode_atts(array(
    'title' => '',
    'image' => $image,
    'img_size'  => 'full',
    'img_link_large' => false,
    'img_link_custom' => '',
    'img_link_target' => '_self',
    'alignment' => 'left',
    'el_class' => '',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$el_class = $this->getExtraClass($el_class);
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-single-image'.$el_class, $this->settings['base']);

$link_to = '';
$a_class = '';
if ($img_link_large==true) {
    $link_to = wp_get_attachment_image_src( $image, 'large');
    $link_to = $link_to[0];
    $a_class = ' fancybox fancybox-thumb';
}
else if (!empty($img_link_custom)) {
    $link_to = $img_link_custom;
}

$img = wp_get_attachment_image_src( $image, $img_size );
$alt = get_post_meta($image, '_wp_attachment_image_alt', true);

if ( $img == NULL ) {
    echo 'null';
    $img_obj = '<img src="http://placehold.it/400/300" /> <small>'.__('This is image placeholder, edit your page to replace it.', 'krown').'</small>';
} else {

    $custom_size = explode( 'x', $img_size );

    if ( ! empty ( $custom_size ) ) {
        if ( isset( $custom_size[0] ) && is_numeric( $custom_size[0] ) )
            $img[1] = $custom_size[0];
        if ( isset( $custom_size[1] ) && is_numeric( $custom_size[1] ) )
            $img[2] = $custom_size[1];
    }

    $aq_img = aq_resize( $img[0], $img[1], $img[2], true, false );
    $img_obj = '<img' . ( empty( $link_to ) ? ' class="krown-single-image align' . $alignment . $el_class . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') : '' ) .' src="' . $aq_img[0] . '" width="' . $aq_img[1] . '" height="' . $aq_img[2] . '" alt="' . $alt . '" />';

}

$image_string = !empty($link_to) ? '<a class="krown-single-image' . $a_class .' align' . $alignment . $el_class . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . ' href="'.$link_to.'"'.($img_link_target!='_self' ? ' target="'.$img_link_target.'"' : '').'>'.$img_obj.'</a>' : $img_obj;

$output .= "\n\t\t\t".'<div class="krown-image-holder">'.$image_string.'</div>';

echo $output;