<?php
/*
** single-employee.php
** mk_build_main_wrapper : builds the main divisions that contains the content. Located in framework/helpers/global.php
** mk_get_view gets the parts of the pages, modules and components. Function located in framework/helpers/global.php
*/

get_header();


$style = get_post_meta( $post->ID, '_employees_single_layout', true );

$wrapper_class = 'mk-single-employee layout-'.$style;

mk_build_main_wrapper( mk_get_view('singular', 'wp-single-employees', true), $wrapper_class );


get_footer();
