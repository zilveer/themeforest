<?php
/**
 * The template for displaying a single gallery custom post type.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>

<?php get_header(); ?>

<?php // force a fullwidth page layout (if not password protected) ?>
<?php if (!post_password_required()): ?>
<?php $t->layout->content = "fullwidth"; ?>
<?php endif; ?>

<?php while ($content->looping() ) : ?>
<?php $t->get_template_part("common","layout-start"); ?>
<?php if (post_password_required()): ?>
<?php // if password protected, show the password field ?>
<?php $content->content(); ?>
<?php else: ?>
<?php $t->gallery->output(); ?>
<?php endif; ?>
<?php $t->get_template_part("common","layout-end"); ?>
<?php endwhile; ?>

<?php get_footer(); ?>