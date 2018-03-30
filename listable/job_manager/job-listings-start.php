<?php
/**
 * The template for displaying the WP Job Manager start part of the listings list
 *
 * @package Listable
 */

if ( is_archive() ) :
	global $wp_query;
	$term = $wp_query->queried_object;

	if ( isset( $term->description ) && !empty( $term->description ) ) : ?>

	<div class="listing_category_description" itemprop="description"><?php echo $term->description; ?></div>

<?php endif;
endif;

if ( listable_using_facetwp() ) :

	do_action( 'listify_facetwp_sort' );

	$output = '';
	$output .= facetwp_display( 'template', 'listings' );
	$output .= facetwp_display( 'pager' );

	echo $output;

else : ?>

<div class="grid list job_listings">

<?php endif;