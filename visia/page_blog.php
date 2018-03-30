<?php
/*
Template Name: Blog
*/
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>
<?php while ($content->looping() ) : ?>
<?php get_template_part("pagecontent","blog"); ?>
<?php endwhile; ?>
<?php get_footer(); ?>