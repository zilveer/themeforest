<?php
/**
 * The team for the page builder
 *
 * @package Organique
 */

class Widget_Team_Slider extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			false, // ID, auto generate when false
			_x( 'Organique: Team slider', 'backend', 'organique_wp' ), // Name
			array(
				'description' => _x( 'Used only in the page builder', 'backend', 'organique_wp' )
			)
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
		$query_members = new WP_Query( array(
			'post_type' => 'team',
			'nopaging'  => true,
			'orderby'   => 'menu_order',
			'order'     => 'ASC',
		) );
		$num_of_members = absint( $query_members->found_posts );

		?>
		<div class="testimonials">
			<div class="row">
				<div class="col-xs-12">
				<?php if ( $num_of_members > 4 ): ?>
					<a href="#js--team-carousel-<?php echo $args['widget_id']; ?>" data-slide="prev"><span class="glyphicon  glyphicon-circle  glyphicon-chevron-left"></span></a>
				<?php endif ?>
					<h3 class="testimonials__title"><?php echo apply_filters( 'widget_title', $instance['title'] ); ?></h3>
				<?php if ( $num_of_members > 4 ): ?>
					<a href="#js--team-carousel-<?php echo $args['widget_id']; ?>" data-slide="next"><span class="glyphicon  glyphicon-circle  glyphicon-chevron-right"></span></a>
				<?php endif ?>
					<div class="push-down-35"></div>
				</div>
			</div>
			<div id="js--team-carousel-<?php echo $args['widget_id']; ?>" class="carousel  slide" data-ride="carousel" data-interval="<?php echo 0 === absint( $instance['interval'] ) ? 'false' : absint( $instance['interval'] ); ?>">
				<div class="carousel-inner">
					<div class="item  active">
						<div class="row">
						<?php
							if ( $query_members->have_posts() ) :
								$i = -1;
								while( $query_members->have_posts() ) :
									$query_members->the_post();
									$i++;

									if ( 0  !== $i && $i % 4 === 0 ) {
										echo '</div></div><div class="item"><div class="row">';
									}
						?>
							<div class="col-xs-12  col-sm-3">
								<?php the_post_thumbnail( 'team-slider', array( 'class' => 'product__image  team-image' ) ); ?>
								<h5><?php echo strip_tags( get_the_title() ); ?></h5>
								<span class="team-slider__title"><?php echo get_post_meta( get_the_ID(), 'subtitle', true ); ?></span>
							</div>
						<?php
								endwhile;
							endif;
							wp_reset_postdata();
						?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
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

		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['interval'] = strip_tags( $new_instance['interval'] );

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
		$title    = isset( $instance['title'] ) ? $instance['title'] : 'Meet the Team';
		$interval = isset( $instance['interval'] ) ? absint( $instance['interval'] ) : 5000;

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _ex( 'Title:', 'backend', 'organique_wp'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'interval' ); ?>"><?php _ex( 'Slider interval (in miliseconds, set to 0 to disable autoplay):', 'backend', 'organique_wp'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'interval' ); ?>" name="<?php echo $this->get_field_name( 'interval' ); ?>" type="text" value="<?php echo $interval; ?>" />
		</p>

		<p>
			<?php _ex( 'All the team members are added as the custom posts (in the main menu of the WP admin on the left find <strong>Team</strong> and add new members there with featured images).', 'backend', 'organique_wp' ); ?>
		</p>

		<?php
	}

} // class Widget_Team_Slider
add_action( 'widgets_init', create_function( '', 'register_widget( "Widget_Team_Slider" );' ) );
