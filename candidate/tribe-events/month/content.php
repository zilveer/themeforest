<?php
/**
 * Month View Content Template
 * The content template for the month view of events. This template is also used for
 * the response that is returned on month view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/content.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>


<!-- Events Calendar -->
<div id="tribe-events-content" class="events-calendar tribe-events-month">
	
	
	<!-- Events Calendar Header -->
	<div class="calendar-header animate-onscroll">
		
		<div class="row">
			
			<div class="col-lg-6 col-md-6 col-sm-6">
			<!-- Month Title -->
			<?php do_action( 'tribe_events_before_the_title' ) ?>
			<h3><?php tribe_events_title() ?></h3>
			<?php do_action( 'tribe_events_after_the_title' ) ?>
			</div>
			
			
			
			
			<?php
			$views   = tribe_events_get_views();
			global $wp;
			$current_url = esc_url( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
			?>
			 
			<?php if ( count( $views ) > 1 ) { ?> 
			<div class="col-lg-6 col-md-6 col-sm-6 align-right">
				<label><?php _e( 'View As', 'candidate' ); ?>:</label>
				<ul class="filter-dropdown">
					<li><span>
					<?php foreach ( $views as $view ) : 
					if(tribe_is_view( $view['displaying'] )) {
					echo $view['anchor'];
					}
					?>
					<?php endforeach; ?>
					</span>
						<ul>
						<?php foreach ( $views as $view ) : ?>
							<li class="filter" data-filter=""><a href="<?php echo $view['url'] ?>"><?php echo $view['anchor'] ?></a></li>
						<?php endforeach; ?>	
						</ul>
					</li>
				</ul>
			</div>
			<?php } // if ( count( $views ) > 1 ) ?>
			 
			 

		</div>
		
	</div>
	<!-- /Events Calendar Header -->

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!-- Notices -->
	<?php tribe_the_notices() ?>


	<!-- Month Header -->
	<?php do_action( 'tribe_events_before_header' ) ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

		<!-- Header Navigation -->
		<?php //tribe_get_template_part( 'month/nav' ); ?>

	</div><!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ) ?>

	
	<!-- Month Grid -->
	<?php tribe_get_template_part( 'month/loop', 'grid' ) ?>

	
	
	<!-- Month Footer -->
	<?php do_action( 'tribe_events_before_footer' ) ?>
	<div id="tribe-events-footer">

		<!-- Footer Navigation -->
		<?php do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php tribe_get_template_part( 'month/nav' ); ?>
		<?php do_action( 'tribe_events_after_footer_nav' ); ?>

	</div><!-- #tribe-events-footer -->
	<?php do_action( 'tribe_events_after_footer' ) ?>
	
	<?php tribe_get_template_part( 'month/mobile' ); ?>
	<?php //tribe_get_template_part( 'month/tooltip' ); ?>
	
</div><!-- #tribe-events-content -->
