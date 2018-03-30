<?php

/* ------------------------------------------------------------------------*
 * COLUMNS
 * ------------------------------------------------------------------------*/

// columns wrapper
if( !function_exists( 'show_columns' ) ){
    function show_columns($atts, $content = null) {
        return '<div class="row-fluid">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('columns', 'show_columns');

// single column
if( !function_exists( 'show_single_column' ) ){
    function show_single_column($atts, $content = null) {
        return '<div class="span12">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('single_column', 'show_single_column');

// two columns
if( !function_exists( 'show_two_column' ) ){
    function show_two_column($atts, $content = null) {
        return '<div class="span6">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('one_half', 'show_two_column');

// three columns
if( !function_exists( 'show_one_third' ) ){
    function show_one_third($atts, $content = null) {
        return '<div class="span4">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('one_third', 'show_one_third');


// four columns
if( !function_exists( 'show_one_fourth' ) ){
    function show_one_fourth($atts, $content = null) {
        return '<div class="span3">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('one_fourth', 'show_one_fourth');

// six columns
if( !function_exists( 'show_one_sixth' ) ){
    function show_one_sixth($atts, $content = null) {
        return '<div class="span2">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('one_sixth', 'show_one_sixth');

// three columns
if( !function_exists( 'show_three_fourth' ) ){
    function show_three_fourth($atts, $content = null) {
        return '<div class="span9">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('three_fourth', 'show_three_fourth');


?>