<?php get_header(); if (have_posts()) the_post(); ?>

<?php get_template_part( 'tile', 'item' ) ?>

<?php get_footer() ?>