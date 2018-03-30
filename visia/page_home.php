<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php while ($content->looping() ) : ?>
<?php get_template_part("pagecontent","home"); ?>
<?php endwhile; ?>
<?php get_footer(); ?>