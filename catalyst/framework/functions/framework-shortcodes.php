<?php
//Hrule [hr]
function mHr( $atts, $content = null ) {
   return '<div class="hrule"></div>';
}
add_shortcode('hr', 'mHr');

//Hrule [hr]
function mHr_top( $atts, $content = null ) {
   return '<div class="hrule top"><a href="#">'.__('Top','mtheme').'</a></div>';
}
add_shortcode('hr_top', 'mHr_top');

//Hrule [hr]
function mHr_padding( $atts, $content = null ) {
   return '<div class="hr_padding"></div>';
}
add_shortcode('hr_padding', 'mHr_padding');
?>