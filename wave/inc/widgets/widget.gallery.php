<?php

add_action( 'widgets_init', create_function( '', 'register_widget( "dd_gallery" );' ) );
class DD_Gallery extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'dd_gallery', // Base ID
			'DD - Featured Gallery', // Name
			array( 'description' => 'Show a gallery.' ) // Args
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

		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$gallery = $instance['gallery'];

		/* Start - Widget Content */

		$dd_query = new WP_Query( 'post_type=dd_gallery&p=' . $gallery );
	
		/* Vars */

		$count = 0;

		/* Loop */

		if ($dd_query->have_posts()) : while ($dd_query->have_posts()) : $dd_query->the_post(); /* Loop the posts */ $count++;
				

			$gallery_images = get_post_meta( get_the_ID(), $dd_sn . 'gallery_images', true );
			if ( ! empty( $gallery_images ) )
				$gallery_images_count = count( $gallery_images );
			else
				$gallery_images_count = 0;

				?>
				<div class="galleries clearfix">

					<div class="gallery has-thumb">

						<div class="gallery-inner">

							<div class="gallery-thumb">

								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-one-third' ); ?></a>

								<div class="gallery-thumb-overlay">
									<a href="<?php the_permalink(); ?>" class="button"><?php _e( 'VIEW GALLERY', 'dd_string' ); ?></a>
								</div><!-- gallery-thumb-overlay -->

							</div><!-- .gallery-thumb -->

							<div class="gallery-main">

								<div class="gallery-meta clearfix">

									<a href="<?php the_permalink(); ?>" class="gallery-title"><?php the_title(); ?></a>
									<a href="<?php the_permalink(); ?>" class="gallery-images"><span class="icon-docs"></span><?php echo $gallery_images_count; ?></a>

								</div><!-- .gallery-meta -->

							</div><!-- .gallery-main -->

						</div><!-- .gallery-inner -->

					</div><!-- .gallery -->

				</div><!-- .galleries -->
				<?php

		endwhile; else:

			$has_posts = false;

		endif; wp_reset_postdata();

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
		$instance['gallery'] = strip_tags( $new_instance['gallery'] );

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

		$args = array(
			'posts_per_page'  => -1,
			'post_type'       => 'dd_gallery',
		);
		$galleries = get_posts( $args );

		$g_array = array();
		
		foreach ( $galleries as $gal ) {
			$g_array[] = array(
				'title' => $gal->post_title,
				'id' => $gal->ID
			);
		}

		// Get values
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = '';
		if ( isset( $instance[ 'gallery' ] ) ) $gallery = $instance[ 'gallery' ]; else $gallery = '0';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'gallery' ); ?>"><?php _e( 'Gallery:' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'gallery' ); ?>" name="<?php echo $this->get_field_name( 'gallery' ); ?>">
				<?php foreach ( $g_array as $g_single ) : ?>
					<option <?php if ( $gallery == $g_single['id'] ) echo 'selected="selected"'; ?> value="<?php echo $g_single['id']; ?>"><?php echo $g_single['title']; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php 

	}

}