<?php
/**
 * The template for displaying a single video custom post type.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>

<?php while ($content->looping() ) : ?>
<?php $t->get_template_part("common","layout-start"); ?>
<?php $t->video->output(); ?>
<?php $t->get_template_part("common","layout-end"); ?>
<?php endwhile; ?>

<?php get_footer(); ?>
