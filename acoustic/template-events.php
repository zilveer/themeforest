<?php
/*
Template Name: Events
*/
?>
<?php get_header(); ?>

<?php get_template_part('inc_section'); ?>

<div class="row main">
	<div class="nine columns content">
		<div class="content-inner">
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<?php
					$recurrent_params = array(
						'post_type'      => 'cpt_events',
						'posts_per_page' => -1,
						'meta_key'       => 'ci_cpt_event_recurrence',
						'orderby'        => 'meta_value',
						'order'          => 'ASC',
						'meta_query'     => array(
							array(
								'key'     => 'ci_cpt_event_recurrent',
								'value'   => 'enabled',
								'compare' => '='
							)
						)
					);

					$date_params = array(
						'post_type'      => 'cpt_events',
						'posts_per_page' => - 1,
						'meta_query'     => array(
							'relation'    => 'AND',
							'date_clause' => array(
								'key'     => 'ci_cpt_events_date',
								'value'   => date_i18n( 'Y-m-d' ),
								'compare' => '>=',
								'type'    => 'DATE'
							),
							'time_clause' => array(
								'key'     => 'ci_cpt_events_time',
								'compare' => 'EXISTS',
								'type'    => 'TIME'
							),
						),
						'orderby'        => array(
							'date_clause' => 'ASC',
							'time_clause' => 'ASC',
						),
					);

					$future_events = merge_wp_queries($recurrent_params, $date_params);

					global $post;
				?>

				<?php $event_new_win = ci_setting('events_new_win') == '' ? '' : ' target="_blank" '; ?>

				<?php if (ci_setting('events_map_show') == 'enabled'): ?>
					<div class="events-map events-section">
						<h3><?php _e('Events Map','ci_theme'); ?></h3>
						<div id="map" style="width:auto;">map</div>
					
						<script type="text/javascript">
							var locations = [
								<?php
								while ( $future_events->have_posts() ) : $future_events->the_post();
									$map_date 		= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
									$map_time 		= get_post_meta($post->ID, 'ci_cpt_events_time', true);
									$map_location 	= get_post_meta($post->ID, 'ci_cpt_events_location', true);
									$map_venue 		= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
									$map_status 	= get_post_meta($post->ID, 'ci_cpt_events_status', true);
									$map_lat	 	= get_post_meta($post->ID, 'ci_cpt_events_lat', true);
									$map_lon	 	= get_post_meta($post->ID, 'ci_cpt_events_lon', true);
									$map_wording	= get_post_meta($post->ID, 'ci_cpt_events_button', true);
									$recurrent 		= get_post_meta($post->ID, 'ci_cpt_event_recurrent', true);
									$recurrence 	= get_post_meta($post->ID, 'ci_cpt_event_recurrence', true);
									$map_url		= "#";

									switch ($map_status) {
									case "buy":
										if ($map_wording == "") $map_wording 	= __('Buy Tickets','ci_theme'); 
										$map_url		= get_post_meta($post->ID, 'ci_cpt_events_tickets', true);
										break;
									case "sold":
										if ($map_wording == "") $map_wording 	= __('Sold Out','ci_theme'); 
										break;
									case "canceled":
										if ($map_wording == "") $map_wording 	= __('Canceled','ci_theme'); 
										break;
									case "watch":
										if ($map_wording == "") $map_wording 	= __('Watch Live','ci_theme');
										$map_url		= get_post_meta($post->ID, 'ci_cpt_events_live', true); 
										break;
									}

									if($recurrent=='enabled'){
										?>['<h3><?php echo addslashes($map_venue); ?></h3><h4><?php echo addslashes($map_location); ?></h4><p><?php echo $recurrence; ?></p><a href="<?php echo $map_url; ?>"><?php echo esc_attr($map_wording); ?></a><p><?php  ?></p>', <?php echo $map_lat; ?>, <?php echo $map_lon; ?>],<?php
									}
									else {
										?>['<h3><?php echo addslashes($map_venue); ?></h3><h4><?php echo addslashes($map_location); ?></h4><p><?php echo $map_date[2] . "-" . ci_the_month($map_date[1]) . "-" . $map_date[0]; ?>, <?php echo $map_time; ?></p><a href="<?php echo $map_url; ?>"><?php echo esc_attr($map_wording); ?></a><p></p>', <?php echo $map_lat; ?>, <?php echo $map_lon; ?>],<?php
									}
								endwhile;

								wp_reset_postdata(); ?>
							];

							if ( typeof google === 'object' && typeof google.maps === 'object' ) {
								var map = new google.maps.Map( document.getElementById( 'map' ), {
									zoom     : 2,
									center   : new google.maps.LatLng( 0, 0 ),
									mapTypeId: google.maps.MapTypeId.ROADMAP
								} );

								var infowindow = new google.maps.InfoWindow();

								var marker, i;

								for ( i = 0; i < locations.length; i++ ) {
									marker = new google.maps.Marker( {
										position: new google.maps.LatLng( locations[i][1], locations[i][2] ), map: map
									} );

									google.maps.event.addListener( marker, 'click', (function( marker, i ) {
										return function() {
											infowindow.setContent( locations[i][0] );
											infowindow.open( map, marker );
										}
									})( marker, i ) );
								}
							}
						</script>
					</div>
					<?php $future_events->rewind_posts(); ?>
				<?php endif; ?>

				<div class="events-map events-section">
					<h3><?php _e('Upcoming Events','ci_theme'); ?></h3>
					<ul class="widget-events">
						<?php while ( $future_events->have_posts() ) : $future_events->the_post(); ?>
							<?php
								$event_date 	= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
								$event_time 	= get_post_meta($post->ID, 'ci_cpt_events_time', true);
								$event_location = get_post_meta($post->ID, 'ci_cpt_events_location', true);
								$event_venue 	= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
								$event_status 	= get_post_meta($post->ID, 'ci_cpt_events_status', true);
								$event_wording	= get_post_meta($post->ID, 'ci_cpt_events_button', true);
								$recurrent 		= get_post_meta($post->ID, 'ci_cpt_event_recurrent', true);
								$recurrence 	= get_post_meta($post->ID, 'ci_cpt_event_recurrence', true);
								$event_url		= "#";

								switch ($event_status) {
								case "buy":
									if ($event_wording == "") $event_wording 	= __('Buy Tickets','ci_theme'); 
									$event_url		= get_post_meta($post->ID, 'ci_cpt_events_tickets', true);
									break;
								case "sold":
									if ($event_wording == "") $event_wording 	= __('Sold Out','ci_theme'); 
									break;
								case "canceled":
									if ($event_wording == "") $event_wording 	= __('Canceled','ci_theme'); 
									break;
								case "watch":
									if ($event_wording == "") $event_wording 	= __('Watch Live','ci_theme');
									$event_url		= get_post_meta($post->ID, 'ci_cpt_events_live', true); 
									break;    
								}
							?>
							<li class="gradient group">
								<?php if($recurrent=='enabled'): ?>
									<p class="event-date recurrent"><?php echo $recurrence; ?></p>
								<?php else: ?>
									<p class="event-date"><span class="day"><?php echo $event_date[2]; ?></span> <span class="month"><?php echo strtoupper(ci_the_month($event_date[1])); ?></span> <span class="year"><?php echo $event_date[0]; ?></span></p>
								<?php endif; ?>

								<div class="event-info title-pair">
									<h4 class="pair-title"><?php if ($post->post_content != ""): ?><a href="<?php the_permalink(); ?>" <?php echo $event_new_win; ?>><?php endif; ?><?php echo $event_venue; ?><?php if ($post->post_content != ""): ?></a><?php endif; ?></h4>
									<p class="pair-sub"><?php echo $event_location; ?></p>
									<?php if(!empty($event_status)): ?>
										<?php $new_window = in_array($event_status, array('buy', 'watch')) && ci_setting('events_url_buttons_new_win')=="enabled" ? ' target="_blank" ' : ''; ?>
										<a href="<?php echo esc_url($event_url); ?>" class="btn <?php echo esc_attr($event_status); ?>" <?php echo $new_window; ?>><?php echo $event_wording; ?></a>
									<?php endif; ?>
								</div>
							</li>
						<?php endwhile; wp_reset_postdata(); ?>
					</ul><!-- /tour-dates -->
				</div><!-- /events-section -->

				<?php if (ci_setting('events_past') == 'enabled'): ?>
					<div class="events-map events-section">
						<h3><?php _e('Past Events','ci_theme'); ?></h3>
						<ul class="widget-events">
							<?php
								$old_events_args = array(
									'post_type'      => 'cpt_events',
									'meta_key'       => 'ci_cpt_events_date',
									'meta_value'     => date( 'Y-m-d' ),
									'meta_compare'   => '<',
									'orderby'        => 'meta_value',
									'order'          => 'DESC',
									'posts_per_page' => -1
								);

								if(ci_setting('events_pagination')=="enabled")
								{
									global $paged;
									$old_events_args['posts_per_page'] = get_option('posts_per_page');
									$old_events_args['paged'] = $paged;
								}

								$old_events = new WP_Query($old_events_args);
							?>

							<?php while ( $old_events->have_posts() ) : $old_events->the_post(); ?>
								<?php
									$event_date 	= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
									$event_location = get_post_meta($post->ID, 'ci_cpt_events_location', true);
									$event_venue 	= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
									$event_status 	= get_post_meta($post->ID, 'ci_cpt_events_status', true);
									$event_wording	= get_post_meta($post->ID, 'ci_cpt_events_button', true);
									$event_url		= "#";

									switch ($event_status) {
									case "buy":
										if ($event_wording == "") $event_wording 	= __('Buy Tickets','ci_theme');
										$event_url		= get_post_meta($post->ID, 'ci_cpt_events_tickets', true);
										break;
									case "sold":
										if ($event_wording == "") $event_wording 	= __('Sold Out','ci_theme');
										break;
									case "canceled":
										if ($event_wording == "") $event_wording 	= __('Canceled','ci_theme');
										break;
									case "watch":
										if ($event_wording == "") $event_wording 	= __('Watch Live','ci_theme');
										$event_url		= get_post_meta($post->ID, 'ci_cpt_events_live', true);
										break;
									}
								?>
								<li class="gradient group">
									<p class="event-date"><span class="day"><?php echo $event_date[2]; ?></span> <span class="month"><?php echo strtoupper(ci_the_month($event_date[1])); ?></span><span class="year"><?php echo $event_date[0]; ?></span></p>
									<div class="event-info title-pair">
										<h4 class="pair-title"><?php if ($post->post_content != ""): ?><a href="<?php the_permalink(); ?>" <?php echo $event_new_win; ?>><?php endif; ?><?php echo $event_venue; ?><?php if ($post->post_content != ""): ?></a><?php endif; ?></h4>
										<p class="pair-sub"><?php echo $event_location; ?></p>
										<?php if(!empty($event_status)): ?>
											<?php $new_window = in_array($event_status, array('buy', 'watch')) && ci_setting('events_url_buttons_new_win')=="enabled" ? ' target="_blank" ' : ''; ?>
											<a href="<?php echo esc_url($event_url); ?>" class="btn <?php echo esc_attr($event_status); ?>" <?php echo $new_window; ?>><?php echo $event_wording; ?></a>
										<?php endif; ?>
									</div>
								</li>
							<?php endwhile; wp_reset_postdata(); ?>
						</ul><!-- /tour-dates -->
					</div>

					<div class="event-pagination"><?php ci_pagination(array(), $old_events);?></div>

				<?php endif; ?>

			<?php endwhile; endif; ?>

		</div><!-- /content-inner -->
	</div><!-- /nine columns -->

	<aside class="three columns">
		<?php dynamic_sidebar('events-sidebar'); ?>
	</aside><!-- /sidebar -->
</div><!-- /row -->

<?php get_footer(); ?>