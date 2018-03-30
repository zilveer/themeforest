<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_featured_product");'));

class stag_widget_featured_product extends WP_Widget{
	function __construct(){
		$widget_ops  = array( 'classname' => 'widget-featured-product', 'description' => __( 'Display a list of featured products on your site.', 'stag' ) );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'stag_widget_featured_product' );
		parent::__construct( 'stag_widget_featured_product', __( 'Section: Custom Featured Products', 'stag' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract($args);

		// VARS FROM WIDGET SETTINGS
		$title = apply_filters('widget_title', $instance['title'] );
		$count = $instance['count'];

		echo $before_widget;

		$slider_id = rand(1000,9999);

		?>

	    <script>
		(function($){
			$(window).load(function(){

				$('#featured-product-slider-<?php echo $slider_id ?> .featured-product-slider').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					scrollbar: true,
					scrollbarHide: true,
					scrollbarLocation: 'bottom',
					scrollbarHeight: '2px',
					scrollbarBackground: '#ccc',
					scrollbarBorder: '0',
					scrollbarMargin: '0',
					scrollbarOpacity: '1',
					navNextSelector: $('#featured-product-slider-<?php echo $slider_id ?> .paging-navigation--wrapper .slider-nav-right'),
					navPrevSelector: $('#featured-product-slider-<?php echo $slider_id ?> .paging-navigation--wrapper .slider-nav-left'),
					onSliderLoaded: updateSliderHeight
				});

				function updateSliderHeight(args) {
					var t = 0; // height of the highest element
					var t_elem; // the highest element (after the function runs)

					$('#featured-product-slider-<?php echo $slider_id ?> .product').each(function(){
						$this = $(this);
						if ( $this.outerHeight() > t ) {
							t_elem = this;
							t = $this.outerHeight();
						}
					});

					setTimeout(function() {
						$('#featured-product-slider-<?php echo $slider_id ?> .featured-product-slider').css({
							height: t+30,
							visibility: "visible"
						});
					},300);
				}

			})
		})(jQuery);
		</script>

		<div id="featured-product-slider-<?php echo $slider_id; ?>" class="featured-product-slider-wrapper">
			<div class="inside">

				<div class="featured-product-header">
					<?php echo $before_title . $title . $after_title; ?>

					<div class="paging-navigation--wrapper">
						<div class="nav-previous">
							<a class="slider-nav-left"><i class="fa fa-angle-left"></i></a>
						</div>
						<div class="nav-next">
							<a class="slider-nav-right"><i class="fa fa-angle-right"></i></a>
						</div>
					</div>
				</div>

				<div class="product-slider-item-wrapper">

					<div class="featured-product-slider">
						<ul class="slider products">
						<?php

							$args = array(
								'post_status'         => 'publish',
								'post_type'           => 'product',
								'ignore_sticky_posts' => 1,
								'meta_key'            => '_featured',
								'meta_value'          => 'yes',
								'posts_per_page'      => 12,
								'orderby'             => 'date',
								'order'               => 'desc',
							);

							$products = new WP_Query( $args );

							if ( $products->have_posts() ) : ?>

							    <?php while ( $products->have_posts() ) : $products->the_post(); ?>

							        <?php woocommerce_get_template_part( 'content', 'product-featured' ); ?>

							    <?php endwhile; // end of the loop. ?>

							<?php

							endif;

							wp_reset_query();

						?>
						</ul>
					</div>

				</div>

			</div>
		</div><!-- .featured-products-wrapper -->

		<?php

		echo $after_widget;

	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;

		// STRIP TAGS TO REMOVE HTML
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);

		return $instance;
	}

	function form($instance){
		$defaults = array(
			/* Deafult options goes here */
			'title' => __( 'Featured Products', 'stag' ),
			'count' => 6
		);

		$instance = wp_parse_args((array) $instance, $defaults);

	/* HERE GOES THE FORM */
	?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stag'); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:', 'stag'); ?></label>
		<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" />
	</p>

	<?php
  }
}
