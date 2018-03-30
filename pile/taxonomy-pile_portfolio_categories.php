<?php
/**
 * The template for displaying Portfolio Category Archive pages.
 *
 * @package Pile
 * @since   Pile 1.0
 */

// Since this isn't any different than a regular portfolio archive, use that template
// We can't use a single template due to the WordPress'es template hierarchy (it would have worked for regular posts, not CPTs)
// https://developer.wordpress.org/themes/basics/template-hierarchy/
get_template_part( 'archive', 'pile_portfolio' ); ?>
