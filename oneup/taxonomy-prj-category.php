<?php
/**
 * The template for displaying project tag pages.
 *
 * Used to display archive-type pages for project in a project tag.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php get_header(); ?>

<?php $t->layout->sidebar = false; ?>
<?php $t->get_template_part("common","layout-start"); ?>
<?php $t->content->loop("project") ?>
<?php $t->get_template_part("common","layout-end"); ?>

<?php get_footer(); ?>
