<?php 
// fix bug confic with revolution slider
if(function_exists('layerslider_enqueue_content_res')){
    remove_action('wp_enqueue_scripts','layerslider_enqueue_content_res');
    add_action('wp_enqueue_scripts', 'layerslider_enqueue_content_res',36);
}

do_action('st_theme_start');
get_header(); 
/**
* WARNING : be careful when you change this file.
* load layout file.
*/
$GLOBALS['st_template_file_name'] = st_get_tpl_file_name();
do_action('st_before_layout');
get_template_part('templates/layout/'.st_get_layout());
do_action('st_after_layout');
get_footer();
do_action('st_theme_end');