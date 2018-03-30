<?php
/**
 * Recent Product Slider Widget
 */
if(!class_exists('WP_Widget_Recent_Product_Slider')){
	class WP_Widget_Recent_Product_Slider extends WP_Widget {

		function WP_Widget_Recent_Product_Slider() {
			$widgetOps = array('classname' => 'wd_widget_recent_product_slider woocommerce', 'description' => __('Display WooCommerce Recent Product Slider','wpdance'));
			parent::__construct('wd_recent_product_slider', __('WD - Recent Product Slider','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			
			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));				
			$row = empty($instance['row'])?4:absint($instance['row']);		
			$number = empty($instance['number'])?8:absint($instance['number']);	
			$show_thumbnail = (isset($instance['show_thumbnail']) && $instance['show_thumbnail'])?true:false;		
			$show_categories = (isset($instance['show_categories']) && $instance['show_categories'])?true:false;		
			$show_product_title = (isset($instance['show_product_title']) && $instance['show_product_title'])?true:false;		
			$show_price = (isset($instance['show_price']) && $instance['show_price'])?true:false;		
			$show_rating = (isset($instance['show_rating']) && $instance['show_rating'])?true:false;		
			$show_add_to_cart = (isset($instance['show_add_to_cart']) && $instance['show_add_to_cart'])?true:false;		
			$is_slider = ($instance['is_slider'])?true:false;						
			$show_nav = ($instance['show_nav'])?true:false;		
			$auto_play = ($instance['auto_play'])?1:0;	
			?>
			<?php echo $before_widget;?>
			<?php echo $before_title . $title . $after_title;?>
			<?php 
				$args = array(
					'post_type'	=> 'product',
					'post_status' => 'publish',
					'ignore_sticky_posts'	=> 1,
					'posts_per_page' => $number,
					'orderby' => 'date',
					'order' => 'desc',				
					'meta_query' => array(
						array(
							'key' => '_visibility',
							'value' => array('catalog', 'visible'),
							'compare' => 'IN'
						)
					)
				);
				wp_reset_query();
				$recent_products = new WP_Query( $args );
				global $post;

			?>
			<?php if($recent_products->post_count>0){
			$i = 0; 
			$random_id = 'wd_widget_product_slider_wrapper_'.rand();
			?>
			<div class="wd_widget_product_slider_wrapper woocommerce <?php echo ($is_slider)?'loading':''; ?> <?php echo ($show_nav)?'has_navi':''; ?>" id="<?php echo $random_id; ?>" >
				<div class="widget_product_list_inner">
					<?php while ($recent_products->have_posts()) : $recent_products->the_post();?>
					<?php if( $i == 0 || $i % $row == 0 ){ ?>
					<div class="product_per_slide">
						<ul>
						<?php } ?>
							<li>
								<?php if($show_categories) get_product_categories(); ?>
								<a class="thumbnail" href="<?php echo get_permalink($post->ID); ?>">
									<?php  
										if ( has_post_thumbnail() && $show_thumbnail ) {
											the_post_thumbnail('prod_tini_thumb',array('title' => esc_attr(get_the_title()),'alt' => esc_attr(get_the_title()) ));
										} 
									?>
									<?php if($show_product_title) echo esc_attr(get_the_title($post->ID)); ?>
								</a>		
							
								<?php if(function_exists('wd_template_single_rating') && $show_rating) wd_template_single_rating(); ?>
								<?php if($show_price) woocommerce_template_loop_price(); ?>
								<?php if($show_add_to_cart){ echo '<p>'; woocommerce_template_loop_add_to_cart(); echo '</p>'; } ?>
							</li>
							<?php $i++;
							if ( $i % $row == 0 || $i == $recent_products->post_count){ ?>
						</ul>
					</div>
					<?php } ?>
					<?php endwhile;?>
				</div>
				<?php if( $show_nav && $is_slider): ?>
				<div class="slider_control">
					<a title="prev" class="prev" href="#">&lt;</a>
					<a title="next" class="next" href="#">&gt;</a>
				</div>
				<?php endif; ?>
			</div>
			<?php } ?>
			<?php wp_reset_query(); ?>
			<div class="clear"></div>

			<?php
			echo $after_widget;
			?>
			<?php if( $is_slider ): ?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					
					var $_this = jQuery('#<?php echo $random_id; ?>');
					var _auto_play = <?php echo $auto_play; ?> == 1;
					var owl = $_this.find('.widget_product_list_inner').owlCarousel({
								loop : true
								,items : 1
								,nav : false
								,dots : false
								,navSpeed : 1000
								,slideBy: 1
								,rtl:jQuery('body').hasClass('rtl')
								,navRewind: false
								,autoplay: _auto_play
								,autoplayTimeout: 5000
								,autoplayHoverPause: true
								,autoplaySpeed: false // or number
								,mouseDrag: true
								,touchDrag: true
								,responsiveBaseElement: $_this
								,responsiveRefreshRate: 1000
								,onInitialized: function(){
									$_this.addClass('loaded').removeClass('loading');
								}
							});
							$_this.on('click', '.next', function(e){
								e.preventDefault();
								owl.trigger('next.owl.carousel');
							});

							$_this.on('click', '.prev', function(e){
								e.preventDefault();
								owl.trigger('prev.owl.carousel');
							});
				});
			</script>
			<?php endif; ?>
			<?php
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] 					=  $new_instance['title'];					
			$instance['row'] 					=  $new_instance['row'];
			$instance['number'] 				=  $new_instance['number'];	
			$instance['show_thumbnail'] 		=  $new_instance['show_thumbnail'];									
			$instance['show_categories'] 		=  $new_instance['show_categories'];									
			$instance['show_product_title'] 	=  $new_instance['show_product_title'];									
			$instance['show_price'] 			=  $new_instance['show_price'];									
			$instance['show_rating'] 			=  $new_instance['show_rating'];												
			$instance['show_add_to_cart'] 		=  $new_instance['show_add_to_cart'];												
			$instance['is_slider'] 				=  $new_instance['is_slider'];									
			$instance['show_nav'] 				=  $new_instance['show_nav'];									
			$instance['auto_play'] 				=  $new_instance['auto_play'];									
			
			return $instance;
		}

		function form( $instance ) {
			$array_default = array(
							'title' 				=> 'Recent Products'
							,'row' 					=> 4
							,'number' 				=> 8
							,'show_thumbnail' 		=> 1
							,'show_categories' 		=> 1
							,'show_product_title' 	=> 1
							,'show_price' 			=> 1
							,'show_rating' 			=> 1
							,'show_add_to_cart' 	=> 0
							,'is_slider'			=> 1
							,'show_nav' 			=> 1
							,'auto_play' 			=> 0
							);
			$instance = wp_parse_args( (array) $instance, $array_default );
			$instance['title'] = esc_attr($instance['title']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('A number of products','wpdance'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('row'); ?>"><?php _e('A number of products per slide','wpdance'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('row'); ?>" name="<?php echo $this->get_field_name('row'); ?>" value="<?php echo $instance['row']; ?>" />
			</p>
			
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" <?php echo ($instance['show_thumbnail'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e('Show thumbnail','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('show_categories'); ?>" name="<?php echo $this->get_field_name('show_categories'); ?>" <?php echo ($instance['show_categories'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_categories'); ?>"><?php _e('Show categories','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('show_product_title'); ?>" name="<?php echo $this->get_field_name('show_product_title'); ?>" <?php echo ($instance['show_product_title'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_product_title'); ?>"><?php _e('Show product title','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('show_price'); ?>" name="<?php echo $this->get_field_name('show_price'); ?>" <?php echo ($instance['show_price'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_price'); ?>"><?php _e('Show price','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('show_rating'); ?>" name="<?php echo $this->get_field_name('show_rating'); ?>" <?php echo ($instance['show_rating'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_rating'); ?>"><?php _e('Show rating','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('show_add_to_cart'); ?>" name="<?php echo $this->get_field_name('show_add_to_cart'); ?>" <?php echo ($instance['show_add_to_cart'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_add_to_cart'); ?>"><?php _e('Show add to cart button','wpdance'); ?></label>
			</p>
			
			<hr />
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('is_slider'); ?>" name="<?php echo $this->get_field_name('is_slider'); ?>" <?php echo ($instance['is_slider'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('is_slider'); ?>"><?php _e('Slider mode','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('show_nav'); ?>" name="<?php echo $this->get_field_name('show_nav'); ?>" <?php echo ($instance['show_nav'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_nav'); ?>"><?php _e('Show navigation button','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('auto_play'); ?>" name="<?php echo $this->get_field_name('auto_play'); ?>" <?php echo ($instance['auto_play'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('auto_play'); ?>"><?php _e('Auto play','wpdance'); ?></label>
			</p>
			<?php }
	}
}

