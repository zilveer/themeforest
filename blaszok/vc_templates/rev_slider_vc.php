<?php
$output = $title = $alias = $el_class = '';
extract( shortcode_atts( array(
    'title' => '',
    'alias' => '',
    'el_class' => '',
    'simple_arrows' => false
), $atts ) );

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_revslider_element wpb_content_element' . $el_class, $this->settings['base'], $atts );

$output .= '<div class="'.$css_class.($simple_arrows ? ' mpcth-simple-arrows' : '').'">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_revslider_heading'));
$output .= do_shortcode('[rev_slider '.$alias.']');
$output .= '</div>'.$this->endBlockComment('wpb_revslider_element')."\n";

echo $output;