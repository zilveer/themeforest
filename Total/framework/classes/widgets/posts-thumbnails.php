<?php
/**
 * Recent posts with Thumbnails custom widget
 *
 * Learn more: http://codex.wordpress.org/Widgets_API
 *
 * @package Total WordPress Theme
 * @subpackage Widgets
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
class WPEX_Recent_Posts_Thumbnails_Widget extends WP_Widget {
	private $defaults;

	/**
	 * Register widget with WordPress.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Defaults
		$this->defaults = array(
			'title'           => esc_html__( 'Recent Posts', 'total' ),
			'number'          => '3',
			'style'           => 'default',
			'post_type'       => 'post',
			'taxonomy'        => '',
			'terms'           => '',
			'order'           => 'DESC',
			'orderby'         => 'date',
			'columns'         => '3',
			'img_size'        => 'wpex_custom',
			'img_hover'       => '',
			'img_width'       => '',
			'img_height'      => '',
			'date'            => '',
			'thumbnail_query' => true,
		);

		// Construtor
		$branding = wpex_get_theme_branding();
		$branding = $branding ? $branding . ' - ' : '';
		parent::__construct(
			'wpex_recent_posts_thumb',
			$branding . esc_html__( 'Posts With Thumbnails', 'total' )
		);

	}

	/**
	 * Front-end display of widget.
	 *
	 * @since 1.0.0
	 */
	public function widget( $args, $instance ) {

		// Parse instance
		extract( wp_parse_args( $instance, $this->defaults ) );

		// Apply filters to the title
		$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';

		// Before widget WP hook
		echo $args['before_widget'];

		// Display title if defined
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title']; 
		} ?>

		<ul class="wpex-widget-recent-posts wpex-clr style-<?php echo esc_attr( $style ); ?>">

			<?php
			// Query args
			$query_args = array(
				'post_type'      => $post_type,
				'posts_per_page' => $number,
				'no_found_rows'  => true,
			);

			// Query by thumbnail meta_key
			if ( $thumbnail_query ) {
				$query_args['meta_key'] = '_thumbnail_id';
			}

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
				$query_args['tax_query']  = array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $terms,
					),
				);

			}

			// Exclude current post
			if ( is_singular() ) {
				$query_args['post__not_in'] = array( get_the_ID() );
			}

			// Query posts
			$wpex_query = new WP_Query( $query_args );

			// If there are posts loop through them
			if ( $wpex_query->have_posts() ) :

				// Loop through posts
				while ( $wpex_query->have_posts() ) : $wpex_query->the_post();

					// Check thumb
					$has_thumb = has_post_thumbnail();

					// Get hover classes
					if ( $img_hover ) {
						$hover_classes = ' '. wpex_image_hover_classes( $img_hover );
					} else {
						$hover_classes = '';
					} ?>

					<li class="wpex-widget-recent-posts-li clr<?php if ( ! $has_thumb ) echo ' wpex-no-thumb'; ?>">

						<?php if ( $has_thumb ) : ?>
							<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="wpex-widget-recent-posts-thumbnail<?php echo esc_attr( $hover_classes ); ?>">
								<?php wpex_post_thumbnail( array(
									'size'   => $img_size,
									'width'  => $img_width,
									'height' => $img_height,
									'alt'    => wpex_get_esc_title(),
								) ); ?>
							</a>
						<?php endif; ?>

						<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="wpex-widget-recent-posts-title"><?php the_title(); ?></a>

						<?php
						// Display date if enabled
						if ( '1' != $date ) : ?>

							<div class="wpex-widget-recent-posts-date">
								<?php echo get_the_date(); ?>
							</div><!-- .wpex-widget-recent-posts-date -->

						<?php endif; ?>

					</li><!-- .wpex-widget-recent-posts-li -->

				<?php endwhile; ?>

			<?php endif; ?>

		</ul><!-- .wpex-widget-recent-posts -->

		<?php wp_reset_postdata(); ?>
		
		<?php
		// After widget WordPress hook
		echo $args['after_widget'];
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @since 1.0.0
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['title']           = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['post_type']       = ! empty( $new_instance['post_type'] ) ? strip_tags( $new_instance['post_type'] ) : '';
		$instance['taxonomy']        = ! empty( $new_instance['taxonomy'] ) ? strip_tags( $new_instance['taxonomy'] ) : '';
		$instance['terms']           = ! empty( $new_instance['terms'] ) ? strip_tags( $new_instance['terms'] ) : '';
		$instance['number']          = ! empty( $new_instance['number'] ) ? strip_tags( $new_instance['number'] ) : '';
		$instance['order']           = ! empty( $new_instance['order'] ) ? strip_tags( $new_instance['order'] ) : '';
		$instance['orderby']         = ! empty( $new_instance['orderby'] ) ? strip_tags( $new_instance['orderby'] ) : '';
		$instance['style']           = ! empty( $new_instance['style'] ) ? strip_tags( $new_instance['style'] ) : '';
		$instance['img_hover']       = ! empty( $new_instance['img_hover'] ) ? strip_tags( $new_instance['img_hover'] ) : '';
		$instance['img_size']        = ! empty( $new_instance['img_size'] ) ? strip_tags( $new_instance['img_size'] ) : 'wpex_custom';
		$instance['img_height']      = ! empty( $new_instance['img_height'] ) ? intval( $new_instance['img_height'] ) : '';
		$instance['img_width']       = ! empty( $new_instance['img_width'] ) ? intval( $new_instance['img_width'] ) : '';
		$instance['date']            = isset( $new_instance['date'] ) ? true : false;
		$instance['thumbnail_query'] = isset( $new_instance['thumbnail_query'] ) ? true : false;
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {

		extract( wp_parse_args( ( array ) $instance, $this->defaults ) ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'total' ); ?></label> 
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Style', 'total' ); ?></label>
			<br />
			<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
				<option value="default" <?php selected( $style, 'default' ); ?>><?php esc_html_e( 'Small Image', 'total' ); ?></option>
				<option value="fullimg" <?php selected( $style, 'fullimg' ); ?>><?php esc_html_e( 'Full Image', 'total' ); ?></option>
			</select>
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Post Type', 'total' ); ?></label>
		<br />
		<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" style="width:100%;">
			<option value="post" <?php selected( $post_type, 'post' ); ?>><?php esc_html_e( 'Post', 'total' ); ?></option>
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
			<option value="" <?php if ( ! $taxonomy ) { ?>selected="selected"<?php } ?>><?php esc_html_e( 'No', 'total' ); ?></option>
			<?php
			// Get Taxonomies
			$get_taxonomies = get_taxonomies( array(
				'public' => true,
			), 'objects' ); ?>
			<?php foreach ( $get_taxonomies as $get_taxonomy ) : ?>
				<option value="<?php echo esc_attr( $get_taxonomy->name ); ?>" <?php selected( $taxonomy, $get_taxonomy->name ); ?>><?php echo ucfirst( $get_taxonomy->labels->singular_name ); ?></option>
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
				<option value="DESC" <?php selected( $order, 'DESC', true ); ?>><?php esc_html_e( 'Descending', 'total' ); ?></option>
				<option value="ASC" <?php selected( $order, 'ASC', true ); ?>><?php esc_html_e( 'Ascending', 'total' ); ?></option>
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
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
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
				$get_img_sizes = wpex_get_thumbnail_sizes();
				// Loop through image sizes
				foreach ( $get_img_sizes as $key => $val ) { ?>
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
		<p>
			<input name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" type="checkbox" value="1" <?php checked( $date, '1', true ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>"><?php esc_html_e( 'Disable Date?', 'total' ); ?></label>
		</p>
		<p>
			<input name="<?php echo esc_attr( $this->get_field_name( 'thumbnail_query' ) ); ?>" type="checkbox" value="1" <?php checked( $thumbnail_query, '1', true ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'thumbnail_query' ) ); ?>"><?php esc_html_e( 'Post With Thumbnails Only', 'total' ); ?></label>
		</p>

	<?php
	}
}
register_widget( 'WPEX_Recent_Posts_Thumbnails_Widget' );