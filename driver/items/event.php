<?php
global $wp_query, $events_filter;

$expanded = ( isset($_GET['id']) && $_GET['id'] == get_the_ID() ? 'expanded' : false );
$show_countdown = (bool)get_iron_option('events_show_countdown_rollover');
$item_show_countdown = (bool)get_field('event_enable_countdown');
if($show_countdown != $item_show_countdown) {
	$show_countdown = $item_show_countdown;
}

if((!empty($events_filter) && $events_filter == 'past') || (!empty($wp_query->query_vars['filter']) && $wp_query->query_vars['filter'] == 'past')) {
	$show_countdown = false;
	$no_countdown = true;
}	

?>		
<li id="post-<?php the_ID(); ?>" <?php post_class($expanded); ?>>
	<!-- title-row -->
	<div class="title-row <?php echo ((!empty($show_countdown)) ? 'has_countdown' : '')?> <?php echo ((!empty($no_countdown)) ? 'no-countdown' : '')?>">
		<div class="event-centering">
			<time class="datetime" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
			<h2 class="event-text-wrap">
				<span class="location"><?php the_title(); ?></span>
				
				<span class="city">
					<?php 
					$showtime = (bool)get_field('event_show_time');
					$city = get_field('event_city');
					$venue = get_field('event_venue');
					
					if( !empty($showtime) ) {
						echo get_the_time();
						
					}
					
					if( !empty($showtime) && !empty($city) ) {
						echo ', ';
					}
					
					if ( !empty($city) ) { 
						echo esc_html($city); 
					}	
					
					if( !empty($city) && !empty($venue)) {
						echo ', ';
					}
					
					if ( !empty($venue) ) { 
						echo esc_html($venue); 
					}
					
					?>
				</span>
			</h2>
			<div class="event-more-button"><?php echo __('More', IRON_TEXT_DOMAIN);?></div>
			<div class="clear"></div>
		</div>
		<a href="<?php the_permalink(); ?>" class="buttons no-touch">
			<?php if(!empty($show_countdown)): ?>
			<!-- HOVER COUNTDOWN -->
				<div class="countdown-wrap">
					<script>
					jQuery(function () {
						/* Countdown Call */
						function CountCall(Row,Day){
							jQuery('.'+Row+' .countdown-block').countdown({until: Day, padZeroes: true, format:'DHMS'});
							var totalcount = jQuery('.'+Row+' .countdown-block').countdown('getTimes');
							if(totalcount[3] == 0 && totalcount[4] == 0 && totalcount[5] == 0 && totalcount[6] == 0){
								jQuery('.'+Row+' .countdown-block').addClass('finished');
							}
						};
						var event_y = <?php echo get_the_time('Y'); ?>;
						var event_m = <?php echo get_the_time('m'); ?>;
						var event_d = <?php echo get_the_time('d'); ?>;
						var event_g = <?php echo get_the_time('H'); ?>;
						var event_i = <?php echo get_the_time('i'); ?>;
						var targetRow = 'post-<?php the_ID(); ?>';
						var targetDay = new Date(event_y,event_m-1,event_d,event_g,event_i);
						CountCall(targetRow,targetDay);
						//Remove the following line's comment to stop the timers
						//jQuery('.countdown-block').countdown('pause');
					});
					</script>
					<div class="countdown-block"></div>
					<h2 class="event-text-wrap btn">
						<span class="location-h"><?php the_title(); ?></span>
						<?php if ( get_field('event_city') ) { ?>
							<span class="city-h">
								<?php 
								$showtime = get_field('gig_show_time');
								if($showtime == '1'){
									echo get_the_time();
									echo ', ';
								}?>
								<?php the_field('event_city'); ?>, <?php the_field('event_venue'); ?>
							</span>
						<?php } ?>
					</h2>
					<div class="clear:both;"></div>
				</div>
			<?php endif; ?>
			<div class="button-wrap"></div>
		</a>
		<div class="clear"></div>
	</div>
</li>

