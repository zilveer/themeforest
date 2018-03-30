<?php
/* Template Name: Portfolio */
?>
<?php $GLOBALS['is_portfolio'] = 1; ?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php
   get_template_part('portfolio', 'display');
?>
<?php get_footer(); ?>
