<?php
/**
 * List View Content Template
 * The content template for the list view. This template is also used for
 * the response that is returned on list view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/content.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div id="tribe-events-content" class="tribe-events-list">





	<!-- Events Calendar Header -->
	<div class="calendar-header animate-onscroll">
		
		<div class="row">
			
			<div class="col-lg-6 col-md-6 col-sm-6">
			<!-- Month Title -->
			<?php do_action( 'tribe_events_before_the_title' ) ?>
			<h3><?php tribe_events_title(); ?></h3>
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

	<!-- List Header -->
    <?php do_action( 'tribe_events_before_header' ); ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

		<!-- Header Navigation -->
		<?php do_action( 'tribe_events_before_header_nav' ); ?>
		<?php //tribe_get_template_part('list/nav', 'header'); ?>
		<?php do_action( 'tribe_events_after_header_nav' ); ?>

	</div><!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ); ?>


	<!-- Events Loop -->
	<?php if ( have_posts() ) : ?>
		<?php do_action( 'tribe_events_before_loop' ); ?>
		<?php tribe_get_template_part( 'list/loop' ) ?>
		<?php do_action( 'tribe_events_after_loop' ); ?>
	<?php endif; ?>

	<!-- List Footer -->
	<?php do_action( 'tribe_events_before_footer' ); ?>
	<div id="tribe-events-footer"  >

		<!-- Footer Navigation -->
		<?php do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php tribe_get_template_part( 'list/nav', 'footer' ); ?>
		<?php do_action( 'tribe_events_after_footer_nav' ); ?>

	</div><!-- #tribe-events-footer -->
	<?php do_action( 'tribe_events_after_footer' ) ?>

</div><!-- #tribe-events-content -->
