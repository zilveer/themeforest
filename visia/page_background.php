<?php
/*
Template Name: Page With Background
*/
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>
<?php while ($content->looping() ) : ?>
<?php get_template_part("pagecontent","background"); ?>
<?php endwhile; ?>
<?php get_footer(); ?>
