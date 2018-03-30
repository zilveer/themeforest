<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<!-- boutique template: single.php -->

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'single' ); ?>

    <?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>
