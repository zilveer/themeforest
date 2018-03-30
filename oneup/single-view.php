<?php
/**
 * The template for displaying a single view custom post type.
 *
 * Only meant for preview purposes since one wouldn't use a view cpt on its own
 * but just include it inside a page
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $view =& $t->view; ?>
<?php $content =& $t->content; ?>
<?php add_filter("pe_theme_page_layout",array(&$view,"pe_theme_page_layout_filter")); ?>

<?php get_header(); ?>

<?php while ($content->looping() ) : ?>
<?php $t->get_template_part("common","layout-start"); ?>
<?php $view->output(); ?>
<?php $t->get_template_part("common","layout-end"); ?>
<?php endwhile; ?>

<?php get_footer(); ?>

