<?php
/**
 * Product_Categories
 */
if(!class_exists('WP_Widget_Product_Categories')){
	class WP_Widget_Product_Categories extends WP_Widget {

		function WP_Widget_Product_Categories() {
			$widgetOps = array('classname' => 'wd_widget_product_categories', 'description' => __('Display Woocommerce Product Categories','wpdance'));
			parent::__construct('wd_product_categories', __('WD - Product Categories','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			
			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));		
			$show_post_count = $instance['show_post_count'];		
			$show_sub_cat = $instance['show_sub_cat'];		
			$is_dropdown = $instance['is_dropdown'];		
			$orderby = $instance['orderby'];		
			$order = $instance['order'];		
			$number = empty($instance['number'])?0:absint($instance['number']);		
			
			$current_cat = (isset($_GET['product_cat']) && $_GET['product_cat']!='')?$_GET['product_cat']:get_query_var('product_cat');
			?>
			<?php echo $before_widget;?>
			<?php echo $before_title . $title . $after_title;?>
			<?php $random_id = 'wd_product_categories_'.rand(0,1000); ?>
			<div class="wd_product_categories" id="<?php echo $random_id; ?>">
				<?php 
					$args = array(
						'taxonomy'     => 'product_cat',
						'orderby'      => $orderby,
						'order'        => $order,
						'hierarchical' => 0,
						'parent'       => 0,
						'title_li'     => '',
						'hide_empty'   => 0,
						'number'   	   => $number
					);
					$all_categories = get_categories( $args );
					if( $all_categories ){
						if($orderby == 'rand'){
							shuffle($all_categories);
						}
						echo '<ul class="'.(($is_dropdown || wp_is_mobile())?'dropdown_mode is_dropdown':'hover_mode').'">';
						foreach ($all_categories as $cat) {
							$current_class = ($current_cat==$cat->slug)?'current':''; 
							echo '<li class="cat_item">';
							$category_id = $cat->term_id;
							echo '<span class="icon_toggle"></span>';
							echo '<a href="'. get_term_link($cat->slug, 'product_cat') .'" class="'.$current_class.'"><span class="cat_name">'. $cat->name .'</span>';
							if($show_post_count){
								echo '<span class="num_product"> ('. $cat->count .') </span>';
							}
							echo "</a>";
							if($show_sub_cat){
								$this->get_sub_categories($category_id,$instance,$current_cat);
							}
							echo '</li>';
						}
						echo '</ul>';
					}

				?>
				<div class="clear"></div>
			</div>

			<?php
			echo $after_widget;
			?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					
					var _random_id = '<?php echo $random_id; ?>';
					wd_widget_product_categories(_random_id);
					wd_widget_product_categories_dropdown(_random_id);
					
					if( !jQuery('#'+_random_id+' ul:first').hasClass( 'is_dropdown' ) ){
						jQuery(window).bind('resize',jQuery.debounce( 250, function(){
							wd_widget_product_categories_update(_random_id);
						}) );
					}
					else{
						jQuery('#'+_random_id+' a.current').parents('ul.sub_cat').siblings('.icon_toggle').trigger('click');
					}
				});
				function wd_widget_product_categories_update(_random_id){
					// unbind event
					jQuery("#"+_random_id+" ul li").unbind("mouseenter").unbind("mouseleave");
					jQuery("#"+_random_id+" ul li .icon_toggle").unbind("click");
					
					var _width = jQuery(window).width();
					if( _width <= 1024 ){
						jQuery("#"+_random_id+" ul:first").addClass('dropdown_mode').removeClass('hover_mode');
						wd_widget_product_categories_dropdown(_random_id);
						jQuery("#"+_random_id+" ul li ul").css({'opacity':1});
					}
					else{
						jQuery("#"+_random_id+" ul:first").removeClass('dropdown_mode').addClass('hover_mode');
						wd_widget_product_categories(_random_id);
						jQuery("#"+_random_id+" ul li ul").css({'opacity':0});
					}
				}
				function wd_widget_product_categories(_random_id){
					var _parent_li = jQuery("#"+_random_id+" ul.hover_mode li.cat_item ul.sub_cat").parent("li");
					_parent_li.addClass("has_sub");
					
					_parent_li.hoverIntent(
					function(){
						if( jQuery(this).css('opacity') != 1 )
							return;
						var _child_ul = jQuery(this).find("ul.sub_cat:first");
						var _is_left_sidebar = jQuery(this).parents("#left-sidebar").length == 1;
						if( jQuery(this).parents('.header-category').length > 0 ){
							_is_left_sidebar = !jQuery('body').hasClass('rtl');
						}
						
						if( _is_left_sidebar ){
							_child_ul.css({'opacity':0,'left': '50%'}).show();
							_child_ul.animate({'opacity':1,'left': '100%'},200);
						}
						else{
							_child_ul.css({'opacity':0,'right': '50%','left':'auto'}).show();
							_child_ul.animate({'opacity':1,'right': '100%','left':'auto'},200);
						}
					},
					function(){
						var _child_ul = jQuery(this).find("ul.sub_cat");
						var _is_left_sidebar = jQuery(this).parents("#left-sidebar").length == 1;
						if( jQuery(this).parents('.header-category').length > 0 ){
							_is_left_sidebar = !jQuery('body').hasClass('rtl');
						}
						
						if( _is_left_sidebar ){
							_child_ul.animate({'opacity':0,'left': '50%'},200,function(){_child_ul.hide().css('left','100%');});
						}
						else{
							_child_ul.animate({'opacity':0,'right': '50%','left':'auto'},200,function(){_child_ul.hide().css({'right':'100%','left':'auto'});});
						}
					});
				}
				function wd_widget_product_categories_dropdown(_random_id){
					var _parent_li = jQuery("#"+_random_id+" ul.dropdown_mode li.cat_item ul.sub_cat").parent("li");
					_parent_li.addClass("has_sub");
					
					_parent_li.find('.icon_toggle').bind('click',function(){
						var parent_li = jQuery(this).parent('li.has_sub');
						if( !jQuery(this).hasClass('active') ){
							parent_li.find('ul.sub_cat:first').slideDown();
							jQuery(this).addClass('active');
						}
						else{
							parent_li.find('ul.sub_cat').slideUp();
							jQuery(this).removeClass('active');
							parent_li.find('.icon_toggle').removeClass('active');
						}
					});
				}
				
			</script>
			
			<?php
		}
		function get_sub_categories($category_id,$instance,$current_cat){
			$args = array(
			   'taxonomy'     => 'product_cat',
			   'child_of'     => 0,
			   'parent'       => $category_id,
			   'orderby'      => $instance['orderby'],
			   'order'        => $instance['order'],
			   'hierarchical' => 0,
			   'title_li'     => '',
			   'hide_empty'   => 0
			);
			$sub_cats = get_categories( $args );
			if($sub_cats) {
				if($instance['orderby'] == 'rand'){
					shuffle($sub_cats);
				}
				echo '<ul class="sub_cat">';
				foreach($sub_cats as $sub_category) {
					$current_class = ($current_cat == $sub_category->slug)?'current':'';
					echo '<li>';
					echo '<span class="icon_toggle"></span>';
					echo '<a href="'. get_term_link($sub_category, 'product_cat') .'" class="'.$current_class.'"><span class="cat_name">'. $sub_category->name .'</span>';
					if( $instance['show_post_count'] ){
						echo '<span class="num_product"> (' . $sub_category->count . ') </span>';
					}
					echo "</a>";
					$this->get_sub_categories($sub_category->term_id,$instance,$current_cat);
					echo '</li>';
				}
				echo '</ul>';

			}
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] =  $new_instance['title'];			
			$instance['show_post_count'] =  $new_instance['show_post_count'];			
			$instance['show_sub_cat'] =  $new_instance['show_sub_cat'];			
			$instance['is_dropdown'] =  $new_instance['is_dropdown'];			
			$instance['orderby'] =  $new_instance['orderby'];			
			$instance['order'] =  $new_instance['order'];			
			$instance['number'] =  $new_instance['number'];			
			
			return $instance;
		}

		function form( $instance ) { 
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Categories','show_post_count'=>true,'show_sub_cat'=>true,'is_dropdown'=>false,'orderby'=>'name','order'=>'asc','number' => 0) );
			$instance['title'] = esc_attr($instance['title']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_post_count'); ?>" name="<?php echo $this->get_field_name('show_post_count'); ?>" <?php echo ($instance['show_post_count'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_post_count'); ?>"><?php _e('Show post count','wpdance'); ?></label>
			</p>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_sub_cat'); ?>" name="<?php echo $this->get_field_name('show_sub_cat'); ?>" <?php echo ($instance['show_sub_cat'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_sub_cat'); ?>"><?php _e('Show sub categories','wpdance'); ?></label>
			</p>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('is_dropdown'); ?>" name="<?php echo $this->get_field_name('is_dropdown'); ?>" <?php echo ($instance['is_dropdown'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('is_dropdown'); ?>"><?php _e('Dropdown mode','wpdance'); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of highest parent categories to show','wpdance'); ?></label>
				<input class="widefat" type="number" min="0" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order by','wpdance'); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" >
					<option value="name" <?php echo ($instance['orderby']=="name")?'selected':''; ?> ><?php _e('Name','wpdance'); ?></option>
					<option value="slug" <?php echo ($instance['orderby']=="slug")?'selected':''; ?> ><?php _e('Slug','wpdance'); ?></option>
					<option value="count" <?php echo ($instance['orderby']=="count")?'selected':''; ?> ><?php _e('Number product','wpdance'); ?></option>
					<option value="rand" <?php echo ($instance['orderby']=="rand")?'selected':''; ?> ><?php _e('Random','wpdance'); ?></option>
					<option value="none" <?php echo ($instance['orderby']=="none")?'selected':''; ?> ><?php _e('None','wpdance'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order','wpdance'); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>" >
					<option value="asc" <?php echo ($instance['order']=="asc")?'selected':''; ?> ><?php _e('Ascending','wpdance'); ?></option>
					<option value="desc" <?php echo ($instance['order']=="desc")?'selected':''; ?> ><?php _e('Descending','wpdance'); ?></option>
				</select>
			</p>
			<?php }
	}
}

