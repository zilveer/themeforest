<?php
/*
 * Widget Name: Featured Properties
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */
 
class HOUZEZ_featured_properties extends WP_Widget {
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'houzez_featured_properties', // Base ID
			esc_html__( 'HOUZEZ: Featured Properties', 'houzez' ), // Name
			array( 'description' => esc_html__( 'Show featured properties', 'houzez' ), ) // Args
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
		$widget_type = $instance['widget_type'];
		
		echo wp_kses( $before_widget, $allowed_html_array );
			
			
			if ( $title ) echo wp_kses( $before_title, $allowed_html_array ) . $title . wp_kses( $after_title, $allowed_html_array );
            ?>
            
            <?php
			$wp_qry = new WP_Query(
				array(
					'post_type' => 'property',
					'posts_per_page' => $items_num,
					'meta_key' => 'fave_featured',
					'meta_value' => '1',
					'ignore_sticky_posts' => 1,
					'post_status' => 'publish'
				)
			);
			?>
            

			<div class="widget-body">

				<?php if( $widget_type == "slider" ) { ?>
				<div class="property-widget-slider slide-animated">
				<?php } ?>

				<?php if( $wp_qry->have_posts() ): while( $wp_qry->have_posts() ): $wp_qry->the_post(); ?>
					<?php $prop_featured       = get_post_meta( get_the_ID(), 'fave_featured', true ); ?>
					<?php $prop_images        = get_post_meta( get_the_ID(), 'fave_property_images', false ); ?>
					<?php if( $widget_type == "slider" ) { ?>

							<div>
								<div class="figure-block">
									<figure class="item-thumb">
										<?php if( $prop_featured != 0 ) { ?>
											<span class="label-featured label label-success"><?php esc_html_e( 'Featured', 'houzez' ); ?></span>
										<?php } ?>
										<div class="label-wrap label-right">
											<?php get_template_part('template-parts/listing', 'status' ); ?>
										</div>

										<a href="<?php the_permalink() ?>" class="hover-effect">
											<?php
											if( has_post_thumbnail( $post->ID ) ) {
												the_post_thumbnail( 'property-thumb-image' );
											}else{
												houzez_image_placeholder( 'property-thumb-image' );
											}
											?>
										</a>
										<figcaption class="thumb-caption">
											<div class="cap-price pull-left"><?php echo houzez_listing_price(); ?></div>
											<ul class="list-unstyled actions pull-right">
												<li>
													<span title="" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo count($prop_images); ?> <?php echo esc_html__('Photos', 'houzez'); ?>">
														<i class="fa fa-camera"></i>
													</span>
												</li>
											</ul>
										</figcaption>
									</figure>
								</div>
							</div>

					<?php } else { ?>
						<div class="figure-block">
							<figure class="item-thumb">
								<?php if( $prop_featured != 0 ) { ?>
									<span class="label-featured label label-success"><?php esc_html_e( 'Featured', 'houzez' ); ?></span>
								<?php } ?>
								<div class="label-wrap label-right">
									<?php get_template_part('template-parts/listing', 'status' ); ?>
								</div>

								<a href="<?php the_permalink() ?>" class="hover-effect">
									<?php
									if( has_post_thumbnail( $post->ID ) ) {
										the_post_thumbnail( 'property-thumb-image' );
									}else {
										houzez_image_placeholder( 'property-thumb-image' );
									}
									?>
								</a>
								<figcaption class="thumb-caption clearfix">
									<div class="cap-price pull-left"><?php echo houzez_listing_price(); ?></div>

									<ul class="list-unstyled actions pull-right">
										<li>
											<span title="" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo count($prop_images); ?> <?php echo esc_html__('Photos', 'houzez'); ?>">
												<i class="fa fa-camera"></i>
											</span>
										</li>
									</ul>
								</figcaption>
							</figure>
						</div>
					<?php } ?>


				<?php endwhile; endif; ?>
				<?php if( $widget_type == "slider" ) { ?>
				</div>
				<?php } ?>
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
		$instance['widget_type'] = strip_tags( $new_instance['widget_type'] );
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'Featured',
			'items_num' => '5',
			'widget_type' => 'slider'
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
		<p>
			<input type="radio" id="<?php echo esc_attr( $this->get_field_id( 'slider' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_type' ) ); ?>" <?php if ($instance["widget_type"] == 'slider') echo 'checked="checked"'; ?> value="<?php esc_html_e('slider', 'houzez'); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'slider' ) ); ?>"><?php esc_html_e( 'Display Properties as Slider', 'houzez' ); ?></label><br />

			<input type="radio" id="<?php echo esc_attr( $this->get_field_id( 'entries' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_type' ) ); ?>" <?php if ($instance["widget_type"] == 'entries') echo 'checked="checked"'; ?> value="<?php esc_html_e('entries', 'houzez'); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'entries' ) ); ?>"><?php esc_html_e( 'Display Properties as List', 'houzez' ); ?></label>
		</p>
		
	<?php
	}

}

if ( ! function_exists( 'HOUZEZ_featured_properties_loader' ) ) {
    function HOUZEZ_featured_properties_loader (){
     register_widget( 'HOUZEZ_featured_properties' );
    }
     add_action( 'widgets_init', 'HOUZEZ_featured_properties_loader' );
}