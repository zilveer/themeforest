<?php
/*
 * Widget Name: Featured Properties
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */
 
class HOUZEZ_properties_viewed extends WP_Widget {
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'houzez_properties_viewed', // Base ID
			esc_html__( 'HOUZEZ: Recent View Properties', 'houzez' ), // Name
			array( 'description' => esc_html__( 'Show properties Recently viewed properties', 'houzez' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {

		global $before_widget, $after_widget, $before_title, $after_title, $post;
		extract( $args );

		$allowed_html_array = array(
			'div' => array(
				'id' => array(),
				'class' => array()
			),
			'h3' => array(
				'class' => array()
			)
		);

		$title = apply_filters('widget_title', $instance['title'] );
		$items_num = $instance['items_num'];
		
		echo wp_kses( $before_widget, $allowed_html_array );
			
			
			if ( $title ) echo wp_kses( $before_title, $allowed_html_array ) . $title . wp_kses( $after_title, $allowed_html_array );
            ?>
            
            <?php
			$wp_qry = new WP_Query(
				array(
					'post_type' => 'property',
					'posts_per_page' => $items_num,
					'orderby' => 'meta_value',
					'meta_key' => 'houzez_recently_viewed',
					'ignore_sticky_posts' => 1,
					'post_status' => 'publish',
					'meta_query' => array(
						array (
						'meta_key' => 'houzez_recently_viewed',
						'meta_value' => date( 'm-d-Y', time() ),
						'compare' => '=',
						'type' => 'DATE'
						)
					)
				)
			);
			?>
            

			<div class="widget-body">

				<?php if( $wp_qry->have_posts() ): while( $wp_qry->have_posts() ): $wp_qry->the_post(); ?>
					<?php $prop_images = get_post_meta( get_the_ID(), 'fave_property_images', false ); ?>

					<div class="media">
						<div class="media-left">
							<figure class="item-thumb">
								<a class="hover-effect" href="<?php the_permalink(); ?>">
									<?php
									if( has_post_thumbnail( ) ) {
										the_post_thumbnail( 'widget-prop' );
									}else{
										houzez_image_placeholder( 'widget-prop' );
									}
									?>
								</a>
							</figure>
						</div>
						<div class="media-body">
							<h3 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<h4><?php echo houzez_listing_price(); ?></h4>
							<div class="amenities">
								<p><?php echo houzez_listing_meta_widget(); ?></p>
								<p><?php echo houzez_taxonomy_simple('property_type'); ?></p>
							</div>
						</div>
					</div>

				<?php endwhile; endif; ?>
				<?php wp_reset_postdata(); ?>
				
			</div>


	    <?php 
		echo wp_kses( $after_widget, $allowed_html_array );
		
	}
	
	
	/**
	 * Sanitize widget form values as they are saved
	**/
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();

		/* Strip tags to remove HTML. For text inputs and textarea. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items_num'] = strip_tags( $new_instance['items_num'] );
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'Properties',
			'items_num' => '5'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'houzez'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'items_num' ) ); ?>"><?php esc_html_e('Maximum posts to show:', 'houzez'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'items_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'items_num' ) ); ?>" value="<?php echo esc_attr( $instance['items_num'] ); ?>" size="1" />
		</p>
		
	<?php
	}

}

if ( ! function_exists( 'HOUZEZ_properties_viewed_loader' ) ) {
    function HOUZEZ_properties_viewed_loader (){
     register_widget( 'HOUZEZ_properties_viewed' );
    }
     add_action( 'widgets_init', 'HOUZEZ_properties_viewed_loader' );
}