<?php

add_action( 'widgets_init', create_function( '', 'register_widget( "dd_events_widget" );' ) );
class DD_Events_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'dd_events_widget', // Base ID
			'DD - Events', // Name
			array( 'description' => 'Show events in a carousel.' ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		global $dd_sn;
		global $donation_currency;

		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$amount = $instance['amount'];

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		/* Start - Widget Content */

		$args = array(
			'paged' => 1,  
			'post_type' => 'dd_events',
			'posts_per_page' => $amount,
			'post_status' => array( 'future' ),
			'orderby' => 'date',
			'order' => 'ASC'
		);

		$widget_posts = new WP_Query( $args );

		if ( $widget_posts->have_posts() ) :  ?>

			<div class="causes-widget-carousel">

				<div class="flexslider">

					<ul class="slides">

						<?php while ( $widget_posts->have_posts() ) : $widget_posts->the_post(); ?>

							<?php $fb_link = get_post_meta( get_the_ID(), $dd_sn . 'event_facebook_link', true ); ?>

							<?php
								// Date of event
								$event_date = get_post_meta( get_the_ID(), $dd_sn . 'event_date', true );
								if ( ! $event_date )
									$event_date = get_the_time( get_option( 'date_format' ) );
							?>

							<li class="event">

								<div class="event-inner">

									<div class="event-thumb">

										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-home-events' ); ?></a>

										<div class="event-date"><span class="icon-calendar"></span><?php echo $event_date; ?></div>

									</div><!-- .event-thumb -->

									<div class="event-main">

										<h2 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											
										<div class="event-excerpt">
											<?php the_excerpt(); ?>
										</div><!-- .event-excerpt -->

									</div><!-- .event-main -->

									<div class="event-info">
										
										<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
										
										<?php if ( $fb_link != '' ) : ?>
											<em>or</em>
											<a href="<?php echo $fb_link; ?>" target="_blank" class="dd-button small blue-light"><?php _e( 'VIEW FACEBOOK PAGE', 'dd_string' ); ?></a>
										<?php endif; ?>

									</div><!-- event-info -->

								</div><!-- .event-inner -->

							</li><!-- .event -->

						<?php endwhile; ?>

					</ul><!-- .slides -->

				</div><!-- .flexslider -->

				<div class="causes-widget-carousel-nav">

					<a href="#" class="causes-widget-carousel-prev"><span class="icon-chevron-left"></span></a>
					<a href="#" class="causes-widget-carousel-next"><span class="icon-chevron-right"></span></a>

				</div><!-- .causes-widget-carousel-prev -->

			</div><!-- .causes-widget-carousel -->

		<?php

		endif; wp_reset_postdata();

		/* End - Widget Content */

		echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['amount'] = strip_tags( $new_instance['amount'] );

		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		// Get values
		if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; } else { $title = ''; }
		if ( isset( $instance[ 'amount' ] ) ) { $amount = $instance[ 'amount' ]; } else { $amount = '8'; }

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>">Amount</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>" />
		</p>
		
		<?php 

	}

}