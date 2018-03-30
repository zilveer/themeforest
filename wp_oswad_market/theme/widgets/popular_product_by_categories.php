<?php
/**
 * Popular product by categories Widget
 */
if(!class_exists('WP_Widget_Popular_Product_By_Categories')){
	class WP_Widget_Popular_Product_By_Categories extends WP_Widget {

		function WP_Widget_Popular_Product_By_Categories() {
			$widgetOps = array('classname' => 'wd_widget_popular_product_by_categories woocommerce', 'description' => __('Display WooCommerce Popular Product by Categories','wpdance'));
			parent::__construct('wd_popular_product_by_categories', __('WD - Popular Product By Categories','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			
			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));
			$categories = $instance['categories'];
			if( !is_array($categories) || count($categories) == 0){
				return;
			}		
			$number_per_category = empty($instance['number_per_category'])?8:absint($instance['number_per_category']);		
			$show_thumbnail = (isset($instance['show_thumbnail']) && $instance['show_thumbnail'])?true:false;		
			$show_categories = (isset($instance['show_categories']) && $instance['show_categories'])?true:false;		
			$show_product_title = (isset($instance['show_product_title']) && $instance['show_product_title'])?true:false;		
			$show_price = (isset($instance['show_price']) && $instance['show_price'])?true:false;		
			$show_rating = (isset($instance['show_rating']) && $instance['show_rating'])?true:false;		
			$show_add_to_cart = (isset($instance['show_add_to_cart']) && $instance['show_add_to_cart'])?true:false;		
			$is_slider = ($instance['is_slider'])?true:false;		
			$show_nav = ($instance['show_nav'])?true:false;		
			$auto_play = ($instance['auto_play'])?1:0;	
			$per_slide = empty($instance['per_slide'])?2:absint($instance['per_slide']);	
			if( !$is_slider ){
				$per_slide = $number_per_category;
			}
			wp_reset_query();
			?>
			<?php echo $before_widget;?>
			<?php echo $before_title . $title . $after_title;?>
			<?php 
				$category_product = array();
				$category_name = array();
				$category_image_src = array();
				foreach( $categories as $category ){
					$args = array(
						'post_type'	=> 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'	=> 1,
						'posts_per_page' => $number_per_category,
						'orderby' => 'date',
						'order' => 'desc',				
						'meta_query' => array(
							array(
								'key' => '_visibility',
								'value' => array('catalog', 'visible'),
								'compare' => 'IN'
							)
						),
						'tax_query' => array(
										array(
											'taxonomy' => 'product_cat'
											,'terms' => $category
											,'field' => 'term_id'
										)
									)
					);
					$result = new WP_Query( $args );
					$category_product[$category] = $result->posts;
					$category_name[$category] = '';
					$category_image_src[$category] = '';
					
					$category_obj = get_term_by('id',$category,'product_cat');
					if( is_object($category_obj) ){
						$category_name[$category] = $category_obj->name;
						$thumbnail_id = get_woocommerce_term_meta( $category_obj->term_id, 'thumbnail_id', true );
						if( $thumbnail_id ){
							$image_size = in_array('wd_pc_thumb', get_intermediate_image_sizes())?'wd_pc_thumb':'shop_thumbnail';
							$attach_image = wp_get_attachment_image_src($thumbnail_id, $image_size);
							if( is_array($attach_image) ){
								$category_image_src[$category] = $attach_image[0];
							}
						}
					}
				}
				
					global $post;

				?>
				<?php if(count($category_product)>0){
				$i = 0; 
				$random_id = 'wd_widget_product_slider_wrapper_'.rand();
				$extra_class = ($show_nav)?'has_navi':'';
				$extra_class .= ($is_slider)?' loading ':'';
				?>
				<div class="wd_widget_product_slider_wrapper woocommerce <?php echo ($show_nav)?'has_navi':''; ?> <?php echo $extra_class; ?>" id="<?php echo $random_id; ?>" >
					<div class="widget_product_list_inner">
						<?php for( $index = 0;$index < $number_per_category; $index+=$per_slide ){ ?>
						<div class="product_per_slide">
								<?php foreach( $category_product as $key => $cat_product ){
									if( isset( $cat_product[$index] ) ){
								?>	
									<div class="cat_title">
										<?php if( $category_image_src[$key] != '' ): ?>
										<img class="cat_thumbnail" src="<?php echo $category_image_src[$key]; ?>" />
										<?php endif; ?>
										<span class="cat_name"><?php echo $category_name[$key]; ?></span>
									</div>
									<ul>
									<?php
											for( $temp = 0 ; $temp < $per_slide ; $temp++){
												if( isset( $cat_product[$index + $temp] )){
												$GLOBALS['post'] = $cat_product[$index + $temp];
												$GLOBALS['product'] = wc_get_product($post->ID);
										?>
													<li>
														<?php if($show_categories) get_product_categories(); ?>
														<a class="thumbnail" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
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
											<?php }
											}
										?>
									</ul>
									<?php
									}
								}
								?>
						</div>
						<?php } ?>
					</div>
					<?php if( $show_nav && $is_slider ): ?>
					<div class="slider_control">
						<a title="prev" class="prev" href="#">&lt;</a>
						<a title="next" class="next" href="#">&gt;</a>
					</div>
					<?php endif; ?>
				</div>
			<?php }
			wp_reset_query(); ?>
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
			$instance['title'] 					=  strip_tags($new_instance['title']);
			$instance['categories'] 			=  $new_instance['categories'];
			$instance['number_per_category'] 	=  $new_instance['number_per_category'];									
			$instance['show_thumbnail'] 		=  $new_instance['show_thumbnail'];									
			$instance['show_categories'] 		=  $new_instance['show_categories'];									
			$instance['show_product_title'] 	=  $new_instance['show_product_title'];									
			$instance['show_price'] 			=  $new_instance['show_price'];									
			$instance['show_rating'] 			=  $new_instance['show_rating'];
			$instance['show_add_to_cart'] 		=  $new_instance['show_add_to_cart'];
			$instance['is_slider'] 				=  $new_instance['is_slider'];									
			$instance['show_nav'] 				=  $new_instance['show_nav'];									
			$instance['auto_play'] 				=  $new_instance['auto_play'];									
			$instance['per_slide'] 				=  $new_instance['per_slide'];									
												
			return $instance;
		}
		
		function get_list_categories($cat_parent_id){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return array();
			}
			$args = array(
					'taxonomy' =>'product_cat'
					,'hierarchical'=>1
					,'parent'=>$cat_parent_id
					,'title_li'=>''
					,'child_of'=>0
				);
			$cats = get_categories($args);
			return $cats;
		}
		function get_list_sub_categories($cat_parent_id,$instance){
			$sub_categories = $this->get_list_categories($cat_parent_id); 
			if( count($sub_categories) > 0){
			?>
				<ul class="children">
					<?php foreach( $sub_categories as $sub_cat ){ ?>
						<li>
							<label>
								<input type="checkbox" name="<?php echo $this->get_field_name('categories'); ?>[<?php $sub_cat->term_id; ?>]" value="<?php echo $sub_cat->term_id; ?>" <?php echo (in_array($sub_cat->term_id,$instance['categories']))?'checked':''; ?> />
								<?php echo $sub_cat->name; ?>
							</label>
							<?php $this->get_list_sub_categories($sub_cat->term_id,$instance); ?>
						</li>
					<?php } ?>
				</ul>
			<?php }
		}

		function form( $instance ) {
			$array_default = array(
							'title' 				=> 'Popular Products'
							,'categories' 			=> array()
							,'number_per_category' 	=> 8
							,'show_thumbnail' 		=> 1
							,'show_categories' 		=> 1
							,'show_product_title' 	=> 1
							,'show_price' 			=> 1
							,'show_rating' 			=> 1
							,'show_add_to_cart' 	=> 0
							,'is_slider' 			=> 1
							,'show_nav' 			=> 1
							,'auto_play' 			=> 0
							,'per_slide' 			=> 2
							);
			$product_cats = $this->get_list_categories(0);
			$instance = wp_parse_args( (array) $instance, $array_default );
			$instance['title'] = esc_attr($instance['title']);
			$instance['number_per_category'] = absint($instance['number_per_category']);
			$instance['per_slide'] = absint($instance['per_slide']);
			
			if( !is_array($instance['categories']) )
				$instance['categories'] = array();
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
			<p>
				<label><?php _e('Select Categories','wpdance'); ?> : </label>
				<div class="categorydiv">
					<div class="tabs-panel">
						<ul class="categorychecklist">
							<?php foreach($product_cats as $cat){ ?>
							<li>
								<label>
									<input type="checkbox" name="<?php echo $this->get_field_name('categories'); ?>[<?php $cat->term_id; ?>]" value="<?php echo $cat->term_id; ?>" <?php echo (in_array($cat->term_id,$instance['categories']))?'checked':''; ?> />
									<?php echo $cat->name; ?>
								</label>
								<?php $this->get_list_sub_categories($cat->term_id,$instance); ?>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number_per_category'); ?>"><?php _e('Number of products per category','wpdance'); ?></label>
				<input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('number_per_category'); ?>" name="<?php echo $this->get_field_name('number_per_category'); ?>" value="<?php echo $instance['number_per_category']; ?>" />
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
				<label for="<?php echo $this->get_field_id('show_nav'); ?>"><?php _e('Slider - Show navigation button','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('auto_play'); ?>" name="<?php echo $this->get_field_name('auto_play'); ?>" <?php echo ($instance['auto_play'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('auto_play'); ?>"><?php _e('Slider - Auto play','wpdance'); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('per_slide'); ?>"><?php _e('Number of products per category per slide','wpdance'); ?></label>
				<input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('per_slide'); ?>" name="<?php echo $this->get_field_name('per_slide'); ?>" value="<?php echo $instance['per_slide']; ?>" />
			</p>
			<?php }
	}
}

