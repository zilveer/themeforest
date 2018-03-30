<?php
/**
 * Home Page Testimonials Widget
 *
 * @package Organique
 */

class Organique_Testimonials extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			false, // ID, auto generate when false
			_x( "Organique: Testimonials", 'backend' , 'organique_wp'), // Name
			array(
				'description' => _x( 'Widget for the page builder, to display list of testimonials', 'backend', 'organique_wp'),
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
		$testimonials = new WP_Query( array(
			'post_type' => 'testimonials',
			'nopaging'  => true,
			'orderby'   => 'menu_order',
			'order'     => 'ASC'
		) );
		?>

		<?php echo $args['before_widget']; ?>
		<div class="testimonials  clearfix">

			<div class="col-sm-3  hidden-xs">
				<div class="testimonials__quotes">
					<img alt="quote" width="224" height="175" class="testimonials__quotes--img" src="<?php echo get_template_directory_uri(); ?>/assets/images/quotes.png">
				</div>
			</div>

			<div class="col-xs-12  col-sm-6">

				<?php if ( $testimonials->found_posts > 1 ): ?>
					<a href="#js--testimonails-<?php echo $args['widget_id'] ?>" data-slide="prev"><span class="glyphicon  glyphicon-circle  glyphicon-chevron-left"></span></a>
				<?php endif ?>
				<h4 class="testimonials__title"><?php echo apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ); ?></h4>
				<?php if ( $testimonials->found_posts > 1 ): ?>	
					<a href="#js--testimonails-<?php echo $args['widget_id'] ?>" data-slide="next"><span class="glyphicon  glyphicon-circle  glyphicon-chevron-right"></span></a>
				<?php endif ?>
				<hr class="divider-dark">


				<div id="js--testimonails-<?php echo $args['widget_id'] ?>" class="carousel  slide" data-ride="carousel" data-interval="<?php echo absint( $instance['interval'] ) > 0 ? absint( $instance['interval'] ) : 'false' ; ?>">
					<div class="carousel-inner">
					<?php

					if ( $testimonials->have_posts() ) :
						$i = -1;
						while( $testimonials->have_posts() ) :
							$i++;
							$testimonials->the_post();
					?>

						<div class="item<?php echo 0 === $i ? '  active' : ''; ?>">
							<blockquote class="testimonials__text">
								<?php the_content(); ?>
								<br>
								<?php $author_title = get_post_meta( get_the_ID(), 'author_title', true ); ?>
								<cite><b><?php echo strip_tags ( get_the_title() ); ?></b></cite><?php echo $author_title ? ', ' . $author_title : ''; ?>
							</blockquote>
						</div>

					<?php
						endwhile;
					endif;
					wp_reset_postdata();
					?>
					</div>
				</div>

			</div><!-- col-xs-12  col-sm-6 -->

			<div class="col-sm-3  hidden-xs">
				<div class="testimonials__quotes--rotate">
					<img alt="quote" width="224" height="175" class="testimonials__quotes--img" src="<?php echo get_template_directory_uri(); ?>/assets/images/quotes.png">
				</div>
			</div>
		</div><!-- testimonials -->

		<?php echo $args['after_widget']; ?>

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
		$instance['interval'] = absint( $new_instance['interval'] );

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
		$title    = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Others about us';
		$interval = isset( $instance[ 'interval' ] ) ? absint( $instance[ 'interval' ] ) : 5000;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _ex( 'Title:', 'backend', 'organique_wp'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'interval' ); ?>"><?php _ex( 'Interval between slides (in ms, 1s = 1000ms):', 'backend', 'organique_wp'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'interval' ); ?>" name="<?php echo $this->get_field_name( 'interval' ); ?>" type="text" value="<?php echo esc_attr( $interval ); ?>" />
			<small><?php _ex( 'If you set this to 0, the testimonials will not auto rorate.', 'backend', 'organique_wp' ) ?></small>
		</p>

		<?php
	}

} // class Organique_Testimonials
add_action( 'widgets_init', create_function( '', 'register_widget( "Organique_Testimonials" );' ) );
