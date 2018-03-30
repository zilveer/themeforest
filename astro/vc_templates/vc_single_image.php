<?php

$output = $el_class = $image = $img_size = $img_link = $img_link_target = $img_link_large = $title = $alignment = $css_animation = '';

extract(shortcode_atts(array(
    'title' => '',
    'image' => $image,
    'img_size'  => 'thumbnail',
    'img_link_large' => false,
    'img_link' => '',
    'img_link_target' => '_self',
    'alignment' => 'left',
    'el_class' => '',
    'css_animation' => '',
    'style' => '',
    'onclick' => '',
    'link' => '',
    'border_color' => ''
), $atts));

$style = ($style!='') ? $style : '';
$border_color = ($border_color!='') ? ' vc_box_border_' . $border_color : '';

$img_id = preg_replace('/[^\d]/', '', $image);
$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => $style.$border_color ));
if ( $img == NULL ) $img['thumbnail'] = '<img class="'.$style.$border_color.'" src="'.$this->assetUrl('vc/no_image.png').'" />';//' <small>'.__('This is image placeholder, edit your page to replace it.', 'js_composer').'</small>';

$el_class = $this->getExtraClass($el_class);

$a_class = '';
if ( $el_class != '' ) {
    $tmp_class = explode(" ", strtolower($el_class));
    $tmp_class = str_replace(".", "", $tmp_class);
}

$link_to = '';
if ( $img_link_large == true || $onclick=="img_link_large") {
    $link_to = wp_get_attachment_image_src( $img_id, 'full');
    $link_to = $link_to[0];
}
else if (!empty($img_link)) {
    $link_to = $img_link;
    $a_class.= ' class=no_magnize';
}
else if (!empty($link)) {
    $link_to = $link;
    $a_class.= ' class=no_magnize';
}
if(!empty($link_to) && !preg_match('/^(https?\:\/\/|\/\/)/', $link_to)) $link_to = 'http://'.$link_to;
$img_output = ($style=='vc_box_shadow_3d') ? '<span class="vc_box_shadow_3d_wrap">' . $img['thumbnail'] . '</span>' : $img['thumbnail'];
$image_string = !empty($link_to) ? '<a'.$a_class.' href="'.$link_to.'"'.($img_link_target!='_self' ? ' target="'.$img_link_target.'"' : '').'>'.$img_output.'</a>' : $img_output;
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_single_image wpb_content_element'.$el_class, $this->settings['base']);
$css_class .= $this->getCSSAnimation($css_animation);

$css_class .= ' vc_align_'.$alignment;

$output .= "\n\t".'<div class="'.$css_class.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_singleimage_heading'));
$output .= "\n\t\t\t".$image_string;
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_single_image');

echo $output;