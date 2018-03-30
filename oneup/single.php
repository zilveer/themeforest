<?php
/**
 * The default Template for displaying all single posts.
 *
 * This is the template that displays all single posts by default, 
 * custom post types have their dedicate templates: single-$cpt.php
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php get_header(); ?>

<?php $t->layout->pageTitle = __("Our Blog",'Pixelentity Theme/Plugin'); ?>
<?php $t->layout->sidebar = isset($_REQUEST["pe-no-sb"]) ? "no" : "right"; ?>
<?php $t->get_template_part("common","layout-start"); ?>
<?php $t->content->loop(); ?>
<?php $t->get_template_part("common","layout-end"); ?>

<?php get_footer(); ?>