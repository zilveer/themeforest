<?php
/**
 * The template for displaying Author archive pages.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php get_header(); ?>

<?php $author = $wp_query->get_queried_object(); ?>
<?php $author = empty($author->user_nicename) ? '' : $author->user_nicename; ?>

<?php $t->layout->pageTitle = sprintf(__("Author: %s",'Pixelentity Theme/Plugin'),$author); ?>
<?php $t->get_template_part("common","layout-start"); ?>
<?php $t->content->loop() ?>
<?php $t->get_template_part("common","layout-end"); ?>

<?php get_footer(); ?>