<?php 
// Create widget tabs post
if(!class_exists('WP_Widget_Sale_Product')){
	class WP_Widget_Sale_Product extends WP_Widget {
		function WP_Widget_Sale_Product() {
			$widget_ops = array( 'classname' => 'widget_sale_product woocommerce', 'description' => __( "Show On Sale Products",'wpdance' ) );
			parent::__construct('sale_product', __('WD - Sale Products','wpdance'), $widget_ops);
		}

		function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title_sale']) ? __('On Sale Products','wpdance') : $instance['title_sale']);
			$num_sale = empty( $instance['num_sale'] ) ? 5 : absint($instance['num_sale']);
			
			$post_type = "product";
			
			$thumbnail_width = 60;
			$thumbnail_height = 60;

			$output = $before_widget;
			if ( $title )
				$output .= $before_title . $title . $after_title;
			
			echo $output;
			wp_reset_query();
			global $post;
			$args_query = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $num_sale,
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					),
					array(
						'key' => '_sale_price',
						'value' =>  0,
						'compare'   => '>',
						'type'      => 'NUMERIC'
					)
				)
			);
		
			$sale=new wp_query($args_query);
	?>
			<?php if($sale->post_count>0){$i = 0;
			?>
			<ul class="product_list_widget">
				<?php while ($sale->have_posts()) : $sale->the_post();?>
				<li <?php echo ($i==0)?"class='first'":($i == count($sale)?"class='last'":""); ?>>

					<a class="thumbnail" href="<?php echo get_permalink($post->ID); ?>">
						<?php  
							if ( has_post_thumbnail() ) {
								the_post_thumbnail('prod_tini_thumb',array('title' => esc_attr(get_the_title()),'alt' => esc_attr(get_the_title()) ));
							} 
						?>
						<?php echo esc_attr(get_the_title($post->ID)); ?>
					</a>							
					<?php if(function_exists('wd_template_single_rating')) wd_template_single_rating(); ?>
					<?php woocommerce_template_loop_price(); ?>
					
				</li>
				<?php $i++; endwhile;?>
			</ul>
			<?php }?>
			<?php wp_reset_query(); ?>
			
	<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title_sale'] = strip_tags($new_instance['title_sale']);
				$instance['num_sale'] = absint($new_instance['num_sale']);
				return $instance;
		}

		function form( $instance ) {
				//Defaults
				$instance = wp_parse_args( (array) $instance, array( 'title_sale' => 'On Sale Products' , 'num_sale' => 5 ) );
				$title_sale = esc_attr( $instance['title_sale'] );
				$num_sale = absint( $instance['num_sale'] );

	?>
				<p><label for="<?php echo $this->get_field_id('title_sale'); ?>"><?php _e( 'Title for sale tab:','wpdance' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title_sale'); ?>" name="<?php echo $this->get_field_name('title_sale'); ?>" type="text" value="<?php echo $title_sale; ?>" /></p>

				<p><label for="<?php echo $this->get_field_id('num_sale'); ?>"><?php _e( 'The number of sale post','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id('num_sale'); ?>" name="<?php echo $this->get_field_name('num_sale'); ?>" type="text" value="<?php echo $num_sale; ?>" /></p>
				

	<?php
		}
	}
}
?>