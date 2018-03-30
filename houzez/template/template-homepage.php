<?php
/**
 * Template Name: Visual Composer
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/12/15
 * Time: 1:35 PM
 */
get_header(); ?>

<?php
while ( have_posts() ): the_post();
the_content();
endwhile;
?>

<?php get_footer(); ?>
