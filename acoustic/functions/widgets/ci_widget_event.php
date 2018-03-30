<?php 
/**
 * Single Event Widget.
 */
if( !class_exists('CI_Event') ):
class CI_Event extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'CI_Event_widget', // Base ID
			'-= CI Event =-', // Name
			array( 'description' => __( 'Display a single event', 'ci_theme' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$event = intval($instance['event']);

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
		$event = new WP_Query( array( 
			'post_type' => 'cpt_events',
			'p' => $event
		));

		$event_new_win = ci_setting('events_new_win') == '' ? '' : ' target="_blank" ';

		echo '<ul class="widget-events">';

		while ( $event->have_posts() ) : $event->the_post();

			global $post;
			$event_date 	= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
			$event_location = get_post_meta($post->ID, 'ci_cpt_events_location', true);
			$event_venue 	= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
			$recurrent 		= get_post_meta($post->ID, 'ci_cpt_event_recurrent', true);
			$recurrence 	= get_post_meta($post->ID, 'ci_cpt_event_recurrence', true);

			?>
			<li class="group">
				<?php if(has_post_thumbnail()): ?>
					<p class="event-flyer gradient"><a href="<?php the_permalink(); ?>" <?php echo $event_new_win; ?>><?php the_post_thumbnail('ci_width'); ?></a></p>
				<?php endif; ?>
				<?php if($recurrent=='enabled'): ?>
					<p class="event-date recurrent"><?php echo $recurrence; ?></p>
				<?php else: ?>
					<p class="event-date"><span class="day"><?php echo $event_date[2]; ?></span> <span class="month"><?php echo strtoupper(ci_the_month($event_date[1])); ?></span> <span class="year"><?php echo $event_date[0]; ?></span></p>
				<?php endif; ?>

				<div class="event-info title-pair">
					<h4 class="pair-title"><?php echo $event_location; ?></h4>
					<p class="pair-sub"><?php echo $event_venue; ?></p>
					<a href="<?php the_permalink(); ?>" class="btn" <?php echo $event_new_win; ?>><?php _e('Read more','ci_theme'); ?></a>
				</div>
			</li>
			<?php
		endwhile;
		wp_reset_postdata();

		echo '</ul>';

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['event'] = absint( $new_instance['event'] );
		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'event' => ''
		));
		extract($instance);

		echo '<p><label for="'.$this->get_field_id('title').'">' . __('Title:', 'ci_theme') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" class="widefat" /></p>';

		?>
		<p>
			<label for="<?php echo $this->get_field_id('event'); ?>"><?php _e( 'Select event:','ci_theme' ); ?></label>
			<?php wp_dropdown_posts(array(
				'post_type' => 'cpt_events',
				'selected' => $event
			), $this->get_field_name('event')); ?>
		</p>
		<?php 
	} // form

} // class CI_Event

register_widget('CI_Event');

endif; // !class_exists
?>