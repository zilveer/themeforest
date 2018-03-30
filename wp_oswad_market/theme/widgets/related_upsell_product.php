<?php
/**
 * Related Upsell Product Widget
 */
if(!class_exists('WP_Widget_Related_Upsell_Product')){
	class WP_Widget_Related_Upsell_Product extends WP_Widget {

		function WP_Widget_Related_Upsell_Product() {
			$widgetOps = array('classname' => 'wd_widget_related_upsell_product woocommerce', 'description' => __('Display WooCommerce Related or Upsell product. It only is shown in Single Product page','wpdance'));
			parent::__construct('wd_related_upsell_product', __('WD - Related Upsell Product','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			
			if( !is_singular('product') )
				return;
			
			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));				
			$per_slide 			= empty($instance['per_slide'])?1:absint($instance['per_slide']);		
			$number 			= empty($instance['number'])?8:absint($instance['number']);	
			$product_type 		= $instance['product_type'];
			$show_image 		= ($instance['show_image'] == 'on')?1:0;	
			$show_categories 	= ($instance['show_categories'] == 'on')?1:0;	
			$show_title 		= ($instance['show_title'] == 'on')?1:0;	
			$show_price 		= ($instance['show_price'] == 'on')?1:0;	
			$show_short_desc 	= ($instance['show_short_desc'] == 'on')?1:0;	
			$show_add_to_cart 	= ($instance['show_add_to_cart'] == 'on')?1:0;	
			$show_rating 		= ($instance['show_rating'] == 'on')?1:0;	
			$show_wishlist 		= (isset($instance['show_wishlist']) && $instance['show_wishlist'] == 'on')?1:0;	
			$show_compare 		= (isset($instance['show_compare']) && $instance['show_compare'] == 'on')?1:0;	
			
			$is_slider = ($instance['is_slider'] == 'on')?1:0;		
			$show_nav = ($instance['show_nav'] == 'on')?1:0;		
			$auto_play = ($instance['auto_play'] == 'on')?1:0;	
			?>
			<?php echo $before_widget;?>
			<?php echo $before_title . $title . $after_title;?>
			<?php 
				global $product, $post;
				$post_in = array();
				if( $product_type == 'related' ){
					$related = $product->get_related();
					$post_in = $related;
					if( sizeof( $related ) == 0 ) return;
				}
				else{
					$upsells = $product->get_upsells();
					$post_in = $upsells;
					if ( sizeof( $upsells ) == 0 ) return;
				}
				
				$args = array(
					'post_type'	=> 'product',
					'post_status' => 'publish',
					'no_found_rows'	=> 1,
					'ignore_sticky_posts'	=> 1,
					'posts_per_page' => $number,
					'orderby' => 'rand',
					'order' => 'desc',				
					'post__in' => $post_in,				
					'post__not_in' => array($product->id),				
					'meta_query' => array(
						array(
							'key' => '_visibility',
							'value' => array('catalog', 'visible'),
							'compare' => 'IN'
						)
					)
				);
				wp_reset_query();
				$related_upsell_products = new WP_Query( $args );

			?>
			<?php 
			if( $related_upsell_products->post_count > 0 ){
				if( $related_upsell_products->post_count == 1 ){
					$is_slider = 0;
				}
			$loading_class = ($is_slider)?'loading':'';
			$i = 0; 
			$random_id = 'wd_widget_related_upsell_wrapper_'.rand();
			?>
			<div class="wd_widget_related_upsell_wrapper woocommerce <?php echo $loading_class; ?> <?php echo ($show_nav)?'has_navi':''; ?>" id="<?php echo $random_id; ?>" >
				<div class="widget_product_list_inner">
					<?php while ($related_upsell_products->have_posts()) : $related_upsell_products->the_post();?>
					<?php if( $i == 0 || $i % $per_slide == 0 ){ ?>
					<div class="product_per_slide">
						<ul class="products">
						<?php } ?>
							<li class="product">
								<div class="product_item_wrapper">
									<div class="product_thumbnail_wrapper">
										<?php if( $show_image ){ ?>
										<a class="thumbnail" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
											<?php  
												add_label_to_product_list();
												woocommerce_template_loop_product_thumbnail();
											?>
										</a>	
									</div>
								<?php } ?>
									<div class="product-meta-wrapper">
										<?php 
										if( $show_categories ){
											get_product_categories();
										}
										if( $show_title ){
											add_product_title();
										}
										?>
										<?php 
											if( $show_price )
												woocommerce_template_loop_price(); 
											if( $show_short_desc ){
												wd_template_loop_excerpt();
											}
										?>
										<div class="list_add_to_cart_wrapper">
											<?php 
											if( $show_add_to_cart )
												wd_list_template_loop_add_to_cart();
											if( function_exists('wd_add_wishlist_button_to_product_list') && $show_wishlist )
												wd_add_wishlist_button_to_product_list();
											if( function_exists('wd_add_compare_button_to_product_list') && $show_compare )
												wd_add_compare_button_to_product_list();
											if( $show_rating )
												woocommerce_template_loop_rating();
											?>
										</div>
									</div>
								</div>
							</li>
							<?php $i++;
							if ( $i % $per_slide == 0 || $i == $related_upsell_products->post_count){ ?>
						</ul>
					</div>
					<?php } ?>
					<?php endwhile;?>
				</div>
				<?php if( $show_nav && $is_slider ): ?>
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
			if( $is_slider ){
			?>
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
			<?php
			}
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] =  $new_instance['title'];					
			$instance['product_type'] =  $new_instance['product_type'];	
			$instance['number'] =  $new_instance['number'];				
			$instance['show_image'] =  $new_instance['show_image'];				
			$instance['show_categories'] =  $new_instance['show_categories'];				
			$instance['show_title'] =  $new_instance['show_title'];				
			$instance['show_price'] =  $new_instance['show_price'];				
			$instance['show_short_desc'] =  $new_instance['show_short_desc'];				
			$instance['show_add_to_cart'] =  $new_instance['show_add_to_cart'];				
			$instance['show_rating'] =  $new_instance['show_rating'];				
			$instance['show_wishlist'] =  $new_instance['show_wishlist'];				
			$instance['show_compare'] =  $new_instance['show_compare'];				
			$instance['is_slider'] =  $new_instance['is_slider'];			
			$instance['show_nav'] =  $new_instance['show_nav'];									
			$instance['auto_play'] =  $new_instance['auto_play'];									
			$instance['per_slide'] =  $new_instance['per_slide'];
			return $instance;
		}

		function form( $instance ) {
			$array_default = array(
							'title' 				=> 'Related Product'
							,'product_type' 		=> 'related'
							,'number' 				=> 8
							,'show_image' 			=> 1
							,'show_categories'		=> 1
							,'show_title' 			=> 1
							,'show_price' 			=> 1
							,'show_short_desc' 		=> 1
							,'show_add_to_cart' 	=> 1
							,'show_rating' 			=> 1
							,'show_wishlist'		=> 1
							,'show_compare'			=> 1
							,'is_slider' 			=> 1
							,'show_nav' 			=> 1
							,'auto_play' 			=> 1
							,'per_slide' 			=> 1
							);
			$instance = wp_parse_args( (array) $instance, $array_default );
			$instance['title'] = esc_attr($instance['title']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
			<p>
				<label for="<?php $this->get_field_name('product_type'); ?>"><?php _e('Product type','wpdance'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('product_type'); ?>" id="<?php echo $this->get_field_id('product_type'); ?>">
					<option value="related" <?php echo ($instance['product_type']=='related')?'selected':''; ?> ><?php _e('Related Product','wpdance'); ?></option>
					<option value="upsell" <?php echo ($instance['product_type']=='upsell')?'selected':''; ?> ><?php _e('Upsell Product','wpdance'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('A number of products','wpdance'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" <?php echo ($instance['show_image'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e('Show product image','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_categories'); ?>" name="<?php echo $this->get_field_name('show_categories'); ?>" <?php echo ($instance['show_categories'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_categories'); ?>"><?php _e('Show categories','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" <?php echo ($instance['show_title'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show product title','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_price'); ?>" name="<?php echo $this->get_field_name('show_price'); ?>" <?php echo ($instance['show_price'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_price'); ?>"><?php _e('Show product price','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_short_desc'); ?>" name="<?php echo $this->get_field_name('show_short_desc'); ?>" <?php echo ($instance['show_short_desc'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_short_desc'); ?>"><?php _e('Show product short description','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_add_to_cart'); ?>" name="<?php echo $this->get_field_name('show_add_to_cart'); ?>" <?php echo ($instance['show_add_to_cart'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_add_to_cart'); ?>"><?php _e('Show Add to cart button','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_rating'); ?>" name="<?php echo $this->get_field_name('show_rating'); ?>" <?php echo ($instance['show_rating'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_rating'); ?>"><?php _e('Show product rating','wpdance'); ?></label>
			</p>
			<p class="<?php echo function_exists('wd_add_wishlist_button_to_product_list')?'':'hidden'; ?>">
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_wishlist'); ?>" name="<?php echo $this->get_field_name('show_wishlist'); ?>" <?php echo ($instance['show_wishlist'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_wishlist'); ?>"><?php _e('Show wishlist button','wpdance'); ?></label>
			</p>
			<p class="<?php echo (class_exists('YITH_Woocompare_Frontend') && defined( 'YITH_WOOCOMPARE' ))?'':'hidden'; ?>">
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_compare'); ?>" name="<?php echo $this->get_field_name('show_compare'); ?>" <?php echo ($instance['show_compare'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_compare'); ?>"><?php _e('Show compare button','wpdance'); ?></label>
			</p>
			<hr />
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('is_slider'); ?>" name="<?php echo $this->get_field_name('is_slider'); ?>" <?php echo ($instance['is_slider'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('is_slider'); ?>"><?php _e('Slider mode','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_nav'); ?>" name="<?php echo $this->get_field_name('show_nav'); ?>" <?php echo ($instance['show_nav'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_nav'); ?>"><?php _e('Slider - Show navigation button','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('auto_play'); ?>" name="<?php echo $this->get_field_name('auto_play'); ?>" <?php echo ($instance['auto_play'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('auto_play'); ?>"><?php _e('Slider - Auto play','wpdance'); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('per_slide'); ?>"><?php _e('A number of products per slide','wpdance'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('per_slide'); ?>" name="<?php echo $this->get_field_name('per_slide'); ?>" value="<?php echo $instance['per_slide']; ?>" />
			</p>
			<?php }
	}
}

