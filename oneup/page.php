<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
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
<div class="pe-wp-default pe-portfolio-scroller-item">
	<?php $content->content(); ?>
	<?php $content->linkPages(); ?>
</div>
<?php $t->get_template_part("common","layout-end"); ?>
<?php endwhile; ?>

<?php get_footer(); ?>

