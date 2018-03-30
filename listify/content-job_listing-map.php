<?php
/**
 *
 */
?>

<?php do_action( 'listify_map_before' ); ?>

<div class="job_listings-map-wrapper listings-map-wrapper--<?php echo get_theme_mod( 'listing-archive-map-position', 'side' ); ?>">
	<?php do_action( 'listify_map_above' ); ?>

	<div class="job_listings-map">
		<div id="job_listings-map-canvas"></div>
	</div>

	<?php do_action( 'listify_map_below' ); ?>
</div>

<?php do_action( 'listify_map_after' ); ?>