<?php
$output = $color = $icon = $size = $target = $href = $title = $call_text = $position = $el_class = '';
extract(shortcode_atts(array(
    'custom_color' => '#eeeeee',
    'custom_icon' => '_none',
    'custom_pos' => 'left',
    'target' => '',
    'href' => '',
    'title' => __('Text on the button', "js_composer"),
    'call_text' => '',
    'position' => 'cta_align_right',
    'el_class' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);

if ( $target == 'same' || $target == '_self' ) { $target = ''; }
if ( $target != '' ) { $target = ' target="'.$target.'"'; }

$h_custom_icon = ( $custom_icon != '_none' ) ? '<i class="fa ' . $custom_icon . '"></i>' : '';
$h_custom_color = ( $custom_color != '' ) ? 'background-color:' . $custom_color : '';
$h_custom_color_arrow = ( $custom_color != '' ) ? 'border-color:' . $custom_color : '';
$h_custom_pos = ( $custom_pos != '' ) ? ' mpc-vc-icon-pos-' . $custom_pos : '';

$a_class = '';
if ( $el_class != '' ) {
    $tmp_class = explode(" ", $el_class);
    if ( in_array("prettyphoto", $tmp_class) ) {
        wp_enqueue_script( 'prettyphoto' );
        wp_enqueue_style( 'prettyphoto' );
        $a_class .= ' prettyphoto'; $el_class = str_ireplace("prettyphoto", "", $el_class);
    }
}

if ( $href != '' ) {
    if ($custom_pos == 'left' || $custom_pos == 'top')
        $button = '<span class="mpcth-cta-button'.$h_custom_pos.'">'.$h_custom_icon.$title.'</span>';
    else
        $button = '<span class="mpcth-cta-button'.$h_custom_pos.'">'.$title.$h_custom_icon.'</span>';
    $button = '<a class="wpb_button_a'.$a_class.'" title="'.$title.'" href="'.$href.'"'.$target.'><span class="mpcth-cta-button-wrap">' . $button . '<span class="mpcth-cta-arrow"></span></span></a>';
} else {
    $button = '';
    $el_class .= ' cta_no_button';
}
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_call_to_action wpb_content_element clearfix '.$position.$el_class, $this->settings['base']);
$cssID = 'mpcth_cta_' . mpcth_random_ID();
$output .= '<div class="'.$css_class.'" id="' . $cssID . '">';
    $output .= '<style type="text/css">#' . $cssID . '.wpb_call_to_action .wpb_button_a .mpcth-cta-arrow {' . $h_custom_color_arrow . '} #' . $cssID . ' .wpb_button_a {' . $h_custom_color . '}</style>';
    if ( $position == 'cta_align_left' ) $output .= $button;
    $output .= apply_filters('wpb_cta_text', '<p class="wpb_call_text">'. $call_text . '</p>', array('content'=>$call_text));
    if ( $position != 'cta_align_left' ) $output .= $button;
$output .= '</div> ' . $this->endBlockComment('.wpb_call_to_action') . "\n";

echo $output;