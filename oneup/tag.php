<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php get_header(); ?>

<?php $t->layout->pageTitle = sprintf(__("Tag: %s",'Pixelentity Theme/Plugin'),single_tag_title("",false)); ?>
<?php $t->get_template_part("common","layout-start"); ?>
<?php $t->content->loop() ?>
<?php $t->get_template_part("common","layout-end"); ?>

<?php get_footer(); ?>