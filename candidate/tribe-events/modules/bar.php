<?php
/**
 * Events Navigation Bar Module Template
 * Renders our events navigation bar used across our views
 *
 * $filters and $views variables are loaded in and coming from
 * the show funcion in: lib/tribe-events-bar.class.php
 *
 * @package TribeEventsCalendar
 *
 */
?>

<?php

$filters = tribe_events_get_filters();
$views   = tribe_events_get_views();

global $wp;
$current_url = esc_url( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );

 ?>

<?php do_action('tribe_events_bar_before_template') ?>



	<form id="tribe-bar-form" class="tribe-clearfix white-box animate-onscroll" name="tribe-bar-form" method="post" action="<?php echo esc_attr( $current_url ); ?>">
		
		<h5><?php _e( 'Find Events', 'candidate' ); ?></h5>
		<div class="inline-inputs">
		


		<?php if ( !empty( $filters ) ) { 
		$s_class='col-lg-3 col-md-3 col-sm-4';
		?>
		
				<?php foreach ( $filters as $filter ) : ?>
					<div class="<?php echo $s_class; ?>">
						<?php echo $filter['html'] ?>
					</div>
				<?php 
				$s_class='col-lg-7 col-md-7 col-sm-5';
				endforeach; ?>
				<div class="col-lg-2 col-md-2 col-sm-3">
					<button type="submit" name="submit-bar"  class="medium"><i class="icons icon-search"></i> <?php _e( 'Find Events', 'candidate' ); ?></button>
				</div><!-- .tribe-bar-submit -->
			
		<?php } // if ( !empty( $filters ) ) ?>
		
		
		</div>
	</form><!-- #tribe-bar-form -->


<?php do_action('tribe_events_bar_after_template') ?>
