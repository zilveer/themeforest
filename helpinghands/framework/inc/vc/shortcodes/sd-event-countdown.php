<?php
/**
 * Event Countdown VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if (!function_exists( 'sd_event_countdown' ) ) {
	function sd_event_countdown( $atts ) {
		$sd = shortcode_atts( array(
			'slug'    => '',
			'day'     => 'Day',
			'days'    => 'Days',
			'hour'    => 'Hour',
			'hours'   => 'Hours',
			'minute'  => 'Minute',
			'minutes' => 'Minutes',
			'second'  => 'Second',
			'seconds' => 'Seconds',
		), $atts );
		
		$slug    = $sd['slug'];
		$day     = $sd['day'];
		$days    = $sd['days'];
		$hour    = $sd['hour'];
		$hours   = $sd['hours'];
		$minute  = $sd['minute'];
		$minutes = $sd['minutes'];
		$second  = $sd['second'];
		$seconds = $sd['seconds'];
		
		$args = array(
			'post_type'           => 'events',
			'name'                => $slug,
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish',
		);
		
		$sd_query = new WP_Query( $args );

	
		ob_start();
		?>
		<div class="sd-event-count">
		<div class="row">
				<?php if ( $sd_query->have_posts() ) : while ( $sd_query->have_posts() ) : $sd_query->the_post(); ?>
				<?php 
					$dov = rwmb_meta( 'sd_dov' );
					$ev_date = gmdate( 'Y/m/d', $dov );
					$ev_time = gmdate(  'H:i:00', $dov );
					$sd_ev_city = rwmb_meta( 'sd_event_city' );
				?>
					<div class="col-md-6">
						<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
						<?php if ( !empty( $dov ) ) : ?>
							<span class="sd-ev-count-date">
								<i class="fa fa-calendar"></i>
								<?php echo date_i18n( get_option( 'date_format' ), $dov );  ?> <?php echo _x( 'at', 'refering to time', 'sd-framework' ); ?> <?php echo gmdate( get_option( 'time_format' ), $dov ); ?>
							</span>
						<?php endif; ?>
						<?php if ( !empty( $sd_ev_city ) ) : ?>
							<span class="sd-ev-count-location">
								<i class="fa fa-map-marker"></i>
								<span class="sd-event-city"><?php echo $sd_ev_city; ?></span>
							</span>
						<?php endif; ?>
					</div>
					<!-- col-md-6 -->
					
					<div class="col-md-6">
						<div class="sd-countdown">
							<?php echo do_shortcode( '[ult_countdown count_style="ult-cd-s2" datetime="' . $ev_date . ' ' . $ev_time . '" ult_tz="ult-usrtz" countdown_opts="sday,shr,smin,ssec" tick_col="#435061" tick_size="30" tick_style="bold" tick_sep_col="#91a1b4" tick_sep_size="12" br_time_space="0" string_days="' . $day . '" string_days2="' . $days . '" string_weeks="Week" string_weeks2="Weeks" string_months="Month" string_months2="Months" string_years="Year" string_years2="Years" string_hours="' . $hour . '" string_hours2="' . $hours . '" string_minutes="' . $minute . '" string_minutes2="' . $minutes . '" string_seconds="' . $second . '" string_seconds2="' . $seconds . '"]' ); ?>
						</div>
					</div>
					<!-- col-md-6 -->
				<?php endwhile; endif;  wp_reset_postdata(); ?>
			</div>
			<!-- row -->
		</div>
		<!-- sd-event-count -->
		<?php return ob_get_clean();	
	}
	add_shortcode( 'sd_event_countdown','sd_event_countdown' );
}

// Register shortcode to VC


add_action( 'init', 'sd_event_countdown_vcmap' );

if ( ! function_exists( 'sd_event_countdown_vcmap' ) ) {
	function sd_event_countdown_vcmap() {
		vc_map( array(
			'name'              => __( 'Event Countdown', 'sd-framework' ),
			'description'       => __( 'Latest event countdown', 'sd-framework' ),
			'base'              => "sd_event_countdown",
			'class'             => "sd_event_countdown",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-event-countdown",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'            => array(
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Event Slug', 'sd-framework' ),
					'param_name'  => 'slug',
					'value'       => '',
					'description' => __( 'Insert the slug of the upcoming event you want to display (eg. my-event).', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Day (singular)', 'sd-framework' ),
					'param_name'  => 'day',
					'value'       => 'Day',
					'group'       => __( 'Translations', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Days (plural)', 'sd-framework' ),
					'param_name'  => 'days',
					'value'       => 'Days',
					'group'       => __( 'Translations', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Hour (singular)', 'sd-framework' ),
					'param_name'  => 'hour',
					'value'       => 'Hour',
					'group'       => __( 'Translations', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Hours (plural)', 'sd-framework' ),
					'param_name'  => 'hours',
					'value'       => 'Hours',
					'group'       => __( 'Translations', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Minute (singular)', 'sd-framework' ),
					'param_name'  => 'minute',
					'value'       => 'Minute',
					'group'       => __( 'Translations', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Minutes (plural)', 'sd-framework' ),
					'param_name'  => 'minutes',
					'value'       => 'Minutes',
					'group'       => __( 'Translations', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Second (singular)', 'sd-framework' ),
					'param_name'  => 'second',
					'value'       => 'Second',
					'group'       => __( 'Translations', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Seconds (plural)', 'sd-framework' ),
					'param_name'  => 'seconds',
					'value'       => 'Seconds',
					'group'       => __( 'Translations', 'sd-framework' ),
				),
			),
		));
	}
}