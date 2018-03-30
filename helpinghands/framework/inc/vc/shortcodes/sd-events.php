<?php
/**
 * Latest Events VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if (!function_exists( 'sd_latest_events' ) ) {
	function sd_latest_events( $atts ) {
		$sd = shortcode_atts( array(
			'cats' => '',
		), $atts );
		
		$cats = $sd['cats'];
		
		if ( ! empty( $cats ) ) {
			$cats = explode( ", ", ", $cats  " );
		}
		
		$today = current_time( 'timestamp' );
		
		$args = array(
			'post_type'           => 'events',
			'posts_per_page'      => 5,
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish',
			'meta_key'            => 'sd_dov',
			'meta_value'          => $today,
			'meta_compare'        => '>=',
			'orderby'             => 'meta_value',
			'order'               => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'event_category',
					'field'    => 'term_id',
					'terms'    => $cats,
				),
			),
		);
		
		if ( empty( $cats ) ) {
			unset( $args['tax_query'] );
		}
		
		$sd_query = new WP_Query( $args );
		
		$items = $sd_query->post_count;

	
		ob_start();
		?>
		
		<div class="row">
			<div class="sd-event-shortcode">
				<?php $i = 0; ?>
				<?php if ( $sd_query->have_posts() ) : while ( $sd_query->have_posts() ) : $sd_query->the_post(); $i++; ?>
				<?php 
					$dov = rwmb_meta( 'sd_dov' );
					$sd_ev_addr = rwmb_meta( 'sd_event_address' );
					$sd_ev_city = rwmb_meta( 'sd_event_city' );
				
				?>
				<?php if ( $i == 1 ) : ?>
				
					<div class="col-md-6">
						<div class="sd-event-upcoming">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="sd-event-thumb">
									<figure>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'sd-event-upcoming-thumb' ); ?></a>
									</figure>
									<span class="sd-upcoming"><?php _e( 'UPCOMING EVENT', 'sd-framework' ); ?></span>
								</div>
							<?php endif; ?>
							<div class="sd-event-data">
								<span class="sd-dov"><?php echo date_i18n( get_option( 'date_format' ), $dov );  ?> <?php echo _x( 'at', 'refering to time', 'sd-framework' ); ?> <?php echo gmdate( get_option( 'time_format' ), $dov ); ?></span>
								<span class="sd-event-address"><?php echo $sd_ev_addr; ?></span>
								<span class="sd-event-city"><?php echo $sd_ev_city; ?></span>
							</div>
							<!-- sd-event-data -->
							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
						</div>
						<!-- sd-event-upcoming -->
					</div>
					<!-- col-md-6 -->
				<?php else : ?>
				<?php if ( $i == 2 && $i !== 3 && $i !== 4 ) : ?>
					<div class="col-md-6">
						<div class="row">
				<?php endif; ?>
				
					<div class="col-md-6 col-sm-6 sd-later-events">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="sd-event-thumb">
								<figure>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'sd-events-thumbs' ); ?></a>
								</figure>
							</div>
						<?php endif; ?>
						<div class="sd-event-data">
							<span class="sd-dov"><?php echo date_i18n( get_option( 'date_format' ), $dov );  ?></span>
							<span class="sd-event-city"><?php echo $sd_ev_city; ?></span>
						</div>
						<!-- sd-event-data -->
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                     
					</div>
					<!-- sd-later-events -->
					<?php if ( $i == 3 ) : ?>
						<div class="clearfix"></div>
					<?php endif; ?>

				<?php if ( $items == $i ) : ?>
						</div>
					</div>
				<?php endif; ?>
					
					<?php if ( $i == 5 ) { $i = 0;	} ?>
				
				<?php endif; ?>
					
					
				<?php endwhile; endif;  wp_reset_postdata(); ?>
			</div>
			<!-- sd-event-shortcode -->
		</div>
		<!-- row -->
		<?php return ob_get_clean();	
	}
	add_shortcode( 'sd_latest_events','sd_latest_events' );
}

// Register shortcode to VC

add_action( 'init', 'sd_latest_events_vcmap' );

if ( ! function_exists( 'sd_latest_events_vcmap' ) ) {
	function sd_latest_events_vcmap() {
		vc_map( array(
			'name'              => __( 'Latest Events', 'sd-framework' ),
			'description'       => __( 'Latest event items', 'sd-framework' ),
			'base'              => "sd_latest_events",
			'class'             => "sd_latest_events",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-events",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'            => array(
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Categories', 'sd-framework' ),
					'param_name'  => 'cats',
					'value'       => '',
					'description' => __( 'Insert the ids of the categories you want to pull posts from (optional). Comma separated. (eg. 2, 43)', 'sd-framework' ),
				),
			),
		));
	}
}