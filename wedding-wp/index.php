<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


GLOBAL $webnus_options;




$blogType =  $webnus_options->webnus_blog_template();

switch( $blogType ){
case 1:
get_template_part('blog','default');
break;
case 3:
get_template_part('blog','timeline');
break;

default:
get_template_part('blog','default');
}




?>