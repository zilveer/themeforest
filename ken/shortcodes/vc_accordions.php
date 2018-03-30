<?php
global $mk_settings;
$el_class = $output = '';

extract( shortcode_atts( array(
            'container_bg_color' => '',
            'style' => 'simple',
            'open_toggle' => 0,
            'responsive' => 'true',
            'el_class' => ''
		), $atts ) );


$id = Mk_Static_Files::shortcode_id();
$el_class = $this->getExtraClass( $el_class );


// The logic is inverted in options to whatever we have in code so tweak it as this
// to get to right output without breaking potentially right code.
// Current state output classes that mean:
// mobile-true - the shortcode is disabled for mobile and all panes are expanded
// mobile-false - the shortcode is enabled, panesare toggled and clickable to change its state
$responsive = ($responsive == 'true') ? 'false' : 'true';


if ( $style == 'simple' ) {
    Mk_Static_Files::addCSS('
        #accordion-'.$id.' .mk-accordion-single.current-item .mk-accordion-tab{
            color:'.$mk_settings['accent-color'].';
        }
    ', $id);
}

Mk_Static_Files::addCSS('
    #accordion-'.$id.' .mk-accordion-pane .inner-box{
        background-color: '.$container_bg_color.';
    }
', $id);

$output .= '<div id="accordion-'.$id.'" class="mk-accordion mobile-'.$responsive.' '.$style.'-style '.$el_class.'" data-item-index="'.$open_toggle.'">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';


echo $output;
