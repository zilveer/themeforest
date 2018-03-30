<?php
/**
 * Post Grid Widget
 *
 * Learn more: http://codex.wordpress.org/Widgets_API
 *
 * @package Total WordPress Theme
 * @subpackage Widgets
 * @version 3.3.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
class WPEX_Recent_Posts_Thumbnails_Grid_Widget extends WP_Widget {
	private $defaults;
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$branding = wpex_get_theme_branding();
		$branding = $branding ? $branding . ' - ' : '';
		parent::__construct(
			'wpex_recent_posts_thumb_grid',
			$branding . esc_html__( 'Posts Thumbnail Grid', 'total' )
		);

		$this->defaults = array(
			'title'      => esc_html__( 'Recent Posts', 'total' ),
			'number'     => '6',
			'post_type'  => 'post',
			'taxonomy'   => '',
			'terms'      => '',
			'order'      => 'DESC',
			'orderby'    => 'date',
			'columns'    => '3',
			'img_size'   => 'wpex_custom',
			'img_hover'  => 'opacity',
			'img_width'  => '',
			'img_height' => '',
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

		// Parse instance
		extract( wp_parse_args( $instance, $this->defaults ) );
		$img_hover_classes = wpex_image_hover_classes( $img_hover );

		// Apply filters to the title
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		// Before widget WP hook
		echo $args['before_widget'];

		// Display title if defined
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title']; 
		} ?>

		<ul class="wpex-recent-posts-thumb-grid wpex-row clr">

			<?php
			// Query args
			$query_args = array(
				'post_type'      => $post_type,
				'posts_per_page' => $number,
				'meta_key'       => '_thumbnail_id',
				'no_found_rows'  => true,
			);

			// Order params - needs FALLBACK don't ever edit!
			if ( ! empty( $orderby ) ) {
				$query_args['order']   = $order;
				$query_args['orderby'] = $orderby;
			} else {
				$query_args['orderby'] = $order; // THIS IS THE FALLBACK
			}

			// Taxonomy args
			if ( ! empty( $taxonomy ) && ! empty( $terms ) ) {

				// Sanitize terms and convert to array
				$terms = str_replace( ', ', ',', $terms );
				$terms = explode( ',', $terms );

				// Add to query arg
				$query_args['tax_query'] = array( array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $terms,
				) );

			}

			// Exclude current post
			if ( is_singular() ) {
				$query_args['post__not_in'] = array( get_the_ID() );
			}

			// Query posts
			$wpex_query = new WP_Query( $query_args );

			// Set post counter variable
			$count=0;

			// Loop through posts
			while ( $wpex_query->have_posts() ) : $wpex_query->the_post(); ?>

				<?php
				// Add to counter variable
				$count++; ?>

				<li class="<?php echo wpex_grid_class( $columns ); ?> nr-col col-<?php echo esc_attr( $count ); ?>">
					<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>"<?php if ( $img_hover_classes ) echo ' class="'. esc_attr( $img_hover_classes ) .'"'; ?>>
						<?php wpex_post_thumbnail( array(
							'size'   => $img_size,
							'width'  => $img_width,
							'height' => $img_height,
							'alt'    => wpex_get_esc_title(),
						) ); ?>
					</a>
				</li>

				<?php
				// Reset counter to clear floats
				if ( $count == $columns ) {
					$count = '0';
				} ?>

			<?php
			// End loop
			endwhile; ?>

			<?php
			// Reset global query post data
			wp_reset_postdata(); ?>

		</ul>

		<?php
		// After widget WP hook
		echo $args['after_widget']; ?>
		
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
		$instance               = $old_instance;
		$instance['title']      = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['post_type']  = ! empty( $new_instance['post_type'] ) ? strip_tags( $new_instance['post_type'] ) : '';
		$instance['taxonomy']   = ! empty( $new_instance['taxonomy'] ) ? strip_tags( $new_instance['taxonomy'] ) : '';
		$instance['terms']      = ! empty( $new_instance['terms'] ) ? strip_tags( $new_instance['terms'] ) : '';
		$instance['number']     = ! empty( $new_instance['number'] ) ? intval( $new_instance['number'] ) : '';
		$instance['order']      = ! empty( $new_instance['order'] ) ? strip_tags( $new_instance['order'] ) : '';
		$instance['orderby']    = ! empty( $new_instance['orderby'] ) ? strip_tags( $new_instance['orderby'] ) : '';
		$instance['style']      = ! empty( $new_instance['style'] ) ? strip_tags( $new_instance['style'] ) : '';
		$instance['img_hover']  = ! empty( $new_instance['img_hover'] ) ? strip_tags( $new_instance['img_hover'] ) : '';
		$instance['img_size']   = ! empty( $new_instance['img_size'] ) ? strip_tags( $new_instance['img_size'] ) : 'wpex_custom';
		$instance['img_height'] = ! empty( $new_instance['img_height'] ) ? intval( $new_instance['img_height'] ) : '';
		$instance['img_width']  = ! empty( $new_instance['img_height'] ) ? intval( $new_instance['img_width'] ) : '';
		$instance['columns']    = ! empty( $new_instance['columns'] ) ? strip_tags( $new_instance['columns'] ) : '';
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

		extract( wp_parse_args( $instance, $this->defaults ) ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'total' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Post Type', 'total' ); ?></label>
		<br />
		<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" style="width:100%;">
			<option value="post" <?php if ( $post_type == 'post' ) { ?>selected="selected"<?php } ?>><?php esc_html_e( 'Post', 'total' ); ?></option>
			<?php
			// Get Post Types and loop through them to create dropdown
			$get_post_types = wpex_get_post_types();
			foreach ( $get_post_types as $key => $val ) : ?>
				<?php if ( $key != 'post' ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $post_type, $key ); ?>><?php echo  $val; ?></option>
				<?php } ?>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>"><?php esc_html_e( 'Query By Taxonomy', 'total' ); ?></label>
		<br />
		<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>" style="width:100%;">
			<option value="post" <?php selected( $taxonomy, '' ) ?>><?php esc_html_e( 'No', 'total' ); ?></option>
			<?php
			// Get Taxonomies
			$get_taxonomies = get_taxonomies( array(
				'public' => true,
			), 'objects' ); ?>
			<?php foreach ( $get_taxonomies as $get_taxonomy ) : ?>
				<option value="<?php echo esc_attr( $get_taxonomy->name ); ?>" <?php if ( $get_taxonomy->name == $taxonomy ) { ?>selected="selected"<?php } ?>><?php echo ucfirst( $get_taxonomy->labels->singular_name ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'terms' ) ); ?>"><?php esc_html_e( 'Terms', 'total' ); ?></label>
			<br />
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'terms' ) ); ?>" type="text" value="<?php echo esc_attr( $terms ); ?>" />
			<small><?php esc_html_e( 'Enter the term slugs to query by seperated by a "comma"', 'total' ); ?></small>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'total' ); ?></label>
			<br />
			<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<option value="DESC" <?php selected( $order, 'DESC' ); ?>><?php esc_html_e( 'Descending', 'total' ); ?></option>
				<option value="ASC" <?php selected( $order, 'ASC' ); ?>><?php esc_html_e( 'Ascending', 'total' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By', 'total' ); ?>:</label>
			<br />
			<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
			<?php
			// Orderby options
			$orderby_array = array (
				'date'          => esc_html__( 'Date', 'total' ),
				'title'         => esc_html__( 'Title', 'total' ),
				'modified'      => esc_html__( 'Modified', 'total' ),
				'author'        => esc_html__( 'Author', 'total' ),
				'rand'          => esc_html__( 'Random', 'total' ),
				'comment_count' => esc_html__( 'Comment Count', 'total' ),
			);
			foreach ( $orderby_array as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $orderby, $key ); ?>>
					<?php echo strip_tags( $value ); ?>
				</option>
			<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number', 'total' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>"><?php esc_html_e( 'Columns', 'total' ); ?></label>
			<br />
			<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'columns' ) ); ?>">
				<option value="1" <?php selected( $columns, '1' ); ?>>1</option>
				<option value="2" <?php selected( $columns, '2' ); ?>>2</option>
				<option value="3" <?php selected( $columns, '3' ); ?>>3</option>
				<option value="4" <?php selected( $columns, '4' ); ?>>4</option>
				<option value="5" <?php selected( $columns, '5' ); ?>>5</option>
				<option value="6" <?php selected( $columns, '6' ); ?>>6</option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'img_hover' ) ); ?>"><?php esc_html_e( 'Image Hover', 'total' ); ?></label>
			<br />
			<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'img_hover' ) ); ?>" style="width:100%;">
				<?php
				// Get image sizes
				$hovers = wpex_image_hovers();
				// Loop through hovers and add options
				foreach ( $hovers as $key => $val ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $img_hover, $key ); ?>>
						<?php echo strip_tags( $val ); ?>
					</option>
				<?php } ?>
				
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'img_size' ) ); ?>"><?php esc_html_e( 'Image Size', 'total' ); ?></label>
			<br />
			<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'img_size' ) ); ?>" style="width:100%;">
			<option value="wpex_custom" <?php selected( $img_size, 'wpex_custom' ); ?>><?php esc_html_e( 'Custom', 'total' ); ?></option>
				<?php
				// Get image sizes
				$get_img_sizes = wpex_get_thumbnail_sizes(); ?>

				<?php foreach ( $get_img_sizes as $key => $val ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $img_size, $key ); ?>><?php echo strip_tags( $key ); ?></option>
				<?php } ?>
				
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'img_width' ) ); ?>"><?php esc_html_e( 'Image Crop Width', 'total' ); ?></label> 
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'img_width' ) ); ?>" type="text" value="<?php echo esc_attr( $img_width ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'img_height' ) ); ?>"><?php esc_html_e( 'Image Crop Height', 'total' ); ?></label> 
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'img_height' ) ); ?>" type="text" value="<?php echo esc_attr( $img_height ); ?>" />
		</p>
		
	<?php
	}
}
register_widget( 'WPEX_Recent_Posts_Thumbnails_Grid_Widget' );