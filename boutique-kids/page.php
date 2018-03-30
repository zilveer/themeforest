<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<!-- boutique template: page.php -->
<?php the_post(); ?>

<?php get_template_part( 'content', 'page' ); ?>

<?php // comments_template( '', true ); ?>

<?php get_footer(); ?>
