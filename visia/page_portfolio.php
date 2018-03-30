<?php
/*
Template Name: Portfolio
*/
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>
<?php while ($content->looping() ) : ?>
<?php get_template_part("pagecontent","portfolio"); ?>
<?php endwhile; ?>
<?php get_footer(); ?>