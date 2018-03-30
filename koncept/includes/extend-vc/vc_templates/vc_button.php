<?php
$output = $size = $icon = $target = $href = $el_class = $title = $position = '';
extract(shortcode_atts(array(
    'size' => '',
    'icon' => 'none',
    'target' => '_self',
    'href' => '',
    'el_class' => '',
    'align' => 'left',
    'style' => 'fill',
    'title' => __('Text on the button', "krown"),
    'position' => '',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-button '.$style.' '.$size.$el_class.$position, $this->settings['base']);

if ( $align == 'center' ) 
	$output .= '<p style="text-align:center">';

$output .= '<a class="' . $css_class . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . ' target="' . $target . '" href="' . $href . '">';

if ( $icon != 'none' ) {
    $output .= '<i class="' . $icon . '"></i>';
}

$output .= $title . '</a>';

if ( $align == 'center' ) 
	$output .= '</p>';

echo $output . $this->endBlockComment('button') . "\n";