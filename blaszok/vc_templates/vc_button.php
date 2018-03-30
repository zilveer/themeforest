<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = '';
extract(shortcode_atts(array(
    'custom_color' => '#eeeeee',
    'custom_icon' => '_none',
    'custom_pos' => 'left',
    'target' => '_self',
    'href' => '',
    'el_class' => '',
    'title' => '',
), $atts));
$a_class = '';

if ( $el_class != '' ) {
    $tmp_class = explode(" ", strtolower($el_class));
    $tmp_class = str_replace(".", "", $tmp_class);
    if ( in_array("prettyphoto", $tmp_class) ) {
        wp_enqueue_script( 'prettyphoto' );
        wp_enqueue_style( 'prettyphoto' );
        $a_class .= ' prettyphoto';
        $el_class = str_ireplace("prettyphoto", "", $el_class);
    }
    if ( in_array("pull-right", $tmp_class) && $href != '' ) { $a_class .= ' pull-right'; $el_class = str_ireplace("pull-right", "", $el_class); }
    if ( in_array("pull-left", $tmp_class) && $href != '' ) { $a_class .= ' pull-left'; $el_class = str_ireplace("pull-left", "", $el_class); }
}

if ( $target == 'same' || $target == '_self' ) { $target = ''; }
$target = ( $target != '' ) ? ' target="'.$target.'"' : '';

$h_custom_icon = ( $custom_icon != '_none' ) ? '<i class="fa ' . $custom_icon . '"></i>' : '';
$h_custom_color = ( $custom_color != '' ) ? 'background-color:' . $custom_color : '';
$h_custom_pos = ( $custom_pos != '' ) ? ' mpc-vc-icon-pos-' . $custom_pos : '';

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_button '.$el_class.$h_custom_pos.($title == '' ? ' mpc-vc-icon-button' : ''), $this->settings['base']);

$cssID = 'mpcth_button_' . mpcth_random_ID();
$output .= '<style type="text/css">#' . $cssID . '.wpb_button_a > span {' . $h_custom_color . '}</style>';
if ($custom_pos == 'left' || $custom_pos == 'top')
    $output .= '<span class="'.$css_class.'">'.$h_custom_icon.$title.'</span>';
else
    $output .= '<span class="'.$css_class.'">'.$title.$h_custom_icon.'</span>';
$output = '<a id="' . $cssID . '" class="wpb_button_a'.$a_class.'" title="'.$title.'" href="'.$href.'"'.$target.'>' . $output . '</a>';

echo $output . $this->endBlockComment('button') . "\n";