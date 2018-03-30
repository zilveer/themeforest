<?php
/**
 * Upcoming Events Widget
 *
 * @description: A simple widget to display upcoming events.
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// The widget class
class sd_upcoming_events_widget extends WP_Widget {
	
	// Widget Settings
	function sd_upcoming_events_widget() {
	
		$widget_ops = array( 'classname' => 'sd_upcoming_events_widget', 'description' => __( 'A widget to display the upcoming events.', 'sd-framework' ) );
		$control_ops = "";
		parent::__construct( 'sd_upcoming_events_widget', __( 'Upcoming Events', 'sd-framework' ), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before the widget
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
		echo $before_title . $title . $after_title;
		
		// Display Recent Posts
		
		$ev_items  = $instance['items'];
		$post_id   = get_the_ID();
		$today     = current_time( 'timestamp' );
		$post_type = get_post_type();
		
		if ( $post_type == 'events' ) {
			$this_dov = rwmb_meta( 'sd_dov' );
		} else {
			$this_dov = '';	
		}

		$args = array(
			'post_type'           => 'events',
			'posts_per_page'      => $ev_items,
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish',
			'meta_key'            => 'sd_dov',
			'meta_value'          => $today,
			'meta_compare'        => '>=',
			'meta_query' => array(
				array( 
					'key'     => 'sd_dov',
					'compare' => '!=',
					'value'   => $this_dov,
				),
			),
			'orderby'             => 'meta_value',
			'order'               => 'ASC',
		);
		
		if ( $post_type !== 'events' ) {
			unset( $args['meta_query'] );
		}
		
		$ev_query = new WP_Query( $args );
		
		?>
		<div class="ev-widget">
			<?php if ( $ev_query->have_posts() ) : while ( $ev_query->have_posts() ) : $ev_query->the_post(); ?>
					<?php 
						$dov     = rwmb_meta( 'sd_dov' );
						$ev_city = rwmb_meta( 'sd_event_city' );
						$ev_date = date_i18n( get_option( 'date_format' ), $dov );
						$ev_time = gmdate( get_option( 'time_format' ), $dov ); 
					
					?>
					<div class="ev-listing-item">
						<?php if ( has_post_thumbnail() ) : ?>
							<figure>
								<?php the_post_thumbnail( 'sd-campaign-grid' ); ?>
							</figure>
						<?php endif; ?>
						<div class="ev-listing-content">
							<h3 class="sd-entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h3>
							<?php if ( ! empty( $ev_city ) ) : ?>
								<span class="ev-city"><?php echo $ev_city; ?></span>
							<?php endif; ?>
							<p><?php echo substr( get_the_excerpt(), 0, 100 ) . '...'; ?></p>
							<a class="sd-more sd-link-trans" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'READ MORE', 'sd-framework' ); ?></a>
						</div>
						<!-- ev-listing-content -->
						<span class="ev-listing-date"><?php echo $ev_date . _x( ' @ ', 'at time', 'sd-framework' ) . $ev_time; ?></span>
					</div>
					<!-- ev-listing-item -->
				<?php endwhile; endif;  wp_reset_postdata(); ?>
			</div>
			<!-- ev-widget -->

<?php 
		// After the widget
		echo $after_widget;
	}
	// Update the widget		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items'] = strip_tags( $new_instance['items'] );

		return $instance;
	}

	// Widget panel settings
	function form( $instance ) {

	// Default widgets settings
		$defaults = array(
		'title' => 'Upcoming Events',
		'items' => '3'
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults ); ?>

<!-- Widget Title: Text Input -->
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>">
		<?php _e('Title:', 'sd-framework') ?>
	</label>
	<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<!-- Post Count: Text Input -->
<p>
	<label for="<?php echo $this->get_field_id( 'items' ); ?>">
		<?php _e('Items', 'sd-framework') ?>
	</label>
	<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" value="<?php echo $instance['items']; ?>" />
</p>
<?php
	}
}
// Register and load the widget
function sd_upcoming_events_widget() {
	register_widget( 'sd_upcoming_events_widget' );
}
add_action( 'widgets_init', 'sd_upcoming_events_widget' );
?>
