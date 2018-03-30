<?php
// Extended subscription function with subscription type variable
function berg_shortcode_dropcap( $atts, $content ) {
    $atts = shortcode_atts( array('style'=>''), $atts );
   	return '<span class="dropcap '.$atts['style'].'">' . do_shortcode($content) . '</span>';
}
function berg_shortcode_highlight( $atts, $content ) {
    $atts = shortcode_atts( array('color'=>''), $atts );
   	return '<span class="highlight '.$atts['color'].'">' . do_shortcode($content) . '</span>';
}

function berg_shortcode_alert( $atts, $content ) {
    $atts = shortcode_atts( array('color'=>''), $atts );
   	return '<div class="alert '.$atts['color'].'">' . do_shortcode($content) . '</div>';
}

function berg_shortcode_btn( $atts, $content ) {
    $atts = shortcode_atts( array('size'=>'', 'color'=>'', 'href'=>'', 'target'=>''), $atts );
    return '<a href="'.$atts['href'].'" class="btn '.$atts['size'].' '.$atts['color'].'" target="'.$atts['target'].'">' . do_shortcode($content) . '</a>';
}

function berg_shortcode_badge( $atts, $content ) {
    $atts = shortcode_atts( array('color'=>''), $atts );
    return '<span class="badge '.$atts['color'].'">' . do_shortcode($content) . '</span>';
}

function berg_shortcode_label( $atts, $content ) {
    $atts = shortcode_atts( array('color'=>''), $atts );
    return '<span class="label '.$atts['color'].'">' . do_shortcode($content) . '</span>';
}



add_shortcode( 'dropcap', 'berg_shortcode_dropcap' );
add_shortcode( 'highlight', 'berg_shortcode_highlight' );
add_shortcode( 'alert', 'berg_shortcode_alert' );
add_shortcode( 'btn', 'berg_shortcode_btn' );
add_shortcode( 'badge', 'berg_shortcode_badge' );
add_shortcode( 'label', 'berg_shortcode_label' );


