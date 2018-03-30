<?php
/**
 * The template for displaying the WP Job Manager end part of the listings list
 *
 * @package Listable
 */
?>

<?php if ( ! listable_using_facetwp() ) : ?>

</div><!-- .grid.list.job_listings -->
<?php get_template_part( 'assets/svg/loader-svg' ); ?>

<?php endif;
