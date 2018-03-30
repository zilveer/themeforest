<?php
/**
 * The main template file.
 * index.php
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 ** mk_build_main_wrapper : builds the main divisions that contains the content. Located in framework/helpers/global.php
 ** mk_get_view gets the parts of the pages, modules and components. Function located in framework/helpers/global.php
 *
 */

get_header();


mk_build_main_wrapper( mk_get_view('templates', 'wp-index', true) );


get_footer();
