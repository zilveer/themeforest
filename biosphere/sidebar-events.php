<?php
/**
 * The Sidebar for the events.
 */
	
	global $dd_sn;
	$event_info = get_post_meta( get_the_ID(), $dd_sn . 'event_info', true );
	$event_fb = get_post_meta( get_the_ID(), $dd_sn . 'event_facebook_link', true );

?>

	<div id="sidebar" class="one-third column last">

		<div id="sidebar-inner">

			<?php if ( is_single() ) : ?>

				<div class="widget">

					<div class="widget-wrap">

						<div class="event-info-widget">

							<?php dd_multicol_colors(); ?>

							<div class="event-info-widget-when">
								<em><?php _e( 'When is it?', 'dd_string' ); ?></em>
								<span><?php the_time( get_option( 'date_format' ) ); ?></span>
							</div>
							
							<?php $parity = 'odd'; ?>

							<?php if ( ! empty ( $event_info ) ) : ?>
								<?php foreach ( $event_info as $e_info ) : ?>
									<div class="event-info-widget-info <?php echo $parity; ?>">
										<em><?php echo $e_info['title']; ?></em>
										<span><?php echo $e_info['value']; ?></span>
									</div>
									<?php if ( $parity == 'odd' ) { $parity = 'even'; } else { $parity = 'odd'; }  ?>
								<?php endforeach; ?>	
							<?php endif; ?>

							<?php if ( $event_fb != '' ) : ?>
								<div class="event-info-widget-view-fb <?php echo $parity; ?>">
									<a href="<?php echo $event_fb; ?>" class="dd-button big dd-button-fb has-icon"><?php _e( 'VIEW FACEBOOK PAGE', 'dd_string' ); ?><span class="dd-button-icon"><span class="icon-social-facebook"></span></span></a>
								</div>
							<?php endif; ?>

						</div><!-- .event-info-widget -->

					</div><!-- .widget-wrap -->

				</div><!-- .widget -->

			<?php endif; ?>

			<?php if ( ! dynamic_sidebar( 'sidebar-events' ) ) : ?>

				<!-- No widgets -->

			<?php endif; ?>

		</div><!-- #sidebar-inner -->

	</div><!-- #sidebar -->