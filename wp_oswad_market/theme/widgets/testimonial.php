<?php
/**
 * Testimonial Widget
 */
if(!class_exists('WP_Widget_Testimonial')){
	class WP_Widget_Testimonial extends WP_Widget {

		function WP_Widget_Testimonial() {
			$widgetOps = array('classname' => 'wd_widget_testimonial', 'description' => __('Display Testimonial - Use Testimonial By Wootheme Plugin','wpdance'));
			parent::__construct('wd_testimonial', __('WD - Testimonials','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "testimonials-by-woothemes/woothemes-testimonials.php", $_actived ) ) {
				return;
			}
			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));				
			$limit = empty($instance['limit'])?4:absint($instance['limit']);		
			$order_by = $instance['order_by'];	
			$order = $instance['order'];	
			$show_title = ($instance['show_title'] == 'on')?1:0;		
			$show_avatar = ($instance['show_avatar'] == 'on')?1:0;	
			$show_twitter = ($instance['show_twitter'] == 'on')?1:0;	
			$category = $instance['category'];	
			$specific_ids = $instance['specific_ids'];

			$is_slider = ($instance['is_slider'] == 'on')?1:0;				
			$show_nav = ($instance['show_nav'] == 'on')?1:0;				
			$auto_play = ($instance['auto_play'] == 'on')?1:0;				
			
			?>
			<?php echo $before_widget;?>
			
			<?php 
				$args = array(
					'post_type'	=> 'testimonial',
					'post_status' => 'publish',
					'ignore_sticky_posts'	=> 1,
					'posts_per_page' => $limit,
					'orderby' => $order_by,
					'order' => $order,				
				);
				if( $category != 'all' ){
					$args['tax_query'] = array(
											array(
												'taxonomy' => 'testimonial-category'
												,'terms' => array($category)
												,'field' => 'term_id'
											)
										);
				}
				if( strlen(trim($specific_ids)) > 0){
					$args['post__in'] = explode(',',str_replace(' ','',$specific_ids));
				}
				wp_reset_query();
				$testimonials = new WP_Query( $args );
				global $post;
				if( !$is_slider ){
					echo $before_title . $title . $after_title;
				}
			?>
			<?php 
			if( $testimonials->post_count > 0 ){
				if( $testimonials->post_count <= 1 ){
					$is_slider = 0;
				}
				$i = 0; 
				$random_id = 'wd_widget_testimonial_wrapper_'.mt_rand();
			?>
			<div class="wd_widget_testimonial_wrapper" id="<?php echo $random_id; ?>" >
				<div class="widget_testimonial_list_inner <?php if($is_slider==1){echo "wp_slider";} ?>">
					<?php while ($testimonials->have_posts()) : $testimonials->the_post();
						$_url = esc_url(get_post_meta($post->ID,'_url',true));
						$_twitter_username = get_post_meta($post->ID,THEME_SLUG.'username_twitter_testimonial',true);
					?>
						<div class="testimonial-item testimonial">
							<div class="testimonial-content"><?php echo string_limit_words(get_the_content(),15).' ...';?></div>
							<div class="wd_info">
								<?php if( $show_avatar ): ?>
								<div class="avatar">
									<a href="<?php echo $_url; ?>"><?php the_post_thumbnail('woo_shortcode');?></a>
								</div>
								<?php endif; ?>
								<?php if( $show_title ): ?>
								<a class="title" href="<?php echo $_url; ?>"><?php the_title();?></a>
								<?php endif; ?>
								<?php if( $show_twitter ): ?>
								<span class="twitter"><a href="http://twitter.com/<?php echo $_twitter_username; ?>" target="_blank" title="<?php _e('Follow us', 'wpdance'); ?>" ><?php _e('VIEW TWEET', 'wpdance'); ?></a></span>					
								<?php endif; ?>
							</div>
						</div>
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
			<?php 
				if( $is_slider ){
					echo '<div class="widget_bottom_title">' . $before_title . $title . $after_title . '</div>';
				}
			?>
			<?php wp_reset_query(); ?>
			<div class="clear"></div>

			<?php
			echo $after_widget;
			?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					
				<?php if( $is_slider ){ ?>
					var $_this = jQuery('#<?php echo $random_id; ?>');
					var _auto_play = <?php echo $auto_play; ?> == 1;
					var owl = $_this.find('.widget_testimonial_list_inner').owlCarousel({
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
				<?php } ?>
				});
			</script>
			
			<?php
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] =  $new_instance['title'];					
			$instance['limit'] =  $new_instance['limit'];
			$instance['order_by'] =  $new_instance['order_by'];									
			$instance['order'] =  $new_instance['order'];									
			$instance['show_title'] =  $new_instance['show_title'];									
			$instance['show_avatar'] =  $new_instance['show_avatar'];																	
			$instance['show_twitter'] =  $new_instance['show_twitter'];																	
			$instance['category'] =  $new_instance['category'];									
			$instance['specific_ids'] =  $new_instance['specific_ids'];									
			$instance['is_slider'] =  $new_instance['is_slider'];									
			$instance['show_nav'] =  $new_instance['show_nav'];									
			$instance['auto_play'] =  $new_instance['auto_play'];									
			
			return $instance;
		}

		function form( $instance ) {
			$array_default = array(
							'title' 		=> ''
							,'limit' 		=> 4
							,'order_by' 	=> 'title'
							,'order'  		=> 'desc'
							,'show_title' 	=> 1
							,'show_avatar' 	=> 1
							,'show_twitter' => 1
							,'category' 	=> 'all'
							,'specific_ids' => ''
							,'is_slider' 	=> 1
							,'show_nav' 	=> 1
							,'auto_play' 	=> 1
							);
			$array_order_by = array(
									'none' => __('No order','wpdance')
									,'title' => __('Title','wpdance')
									,'date' => __('Date','wpdance')
									,'rand' => __('Random','wpdance')
								);
			$array_order = array(
								'desc' => __('Descending','wpdance')
								,'asc' => __('Ascending','wpdance')
							);
			
			$categories = get_categories(array('taxonomy'=>'testimonial-category'));
			if( !is_array($categories) )
				$categories = array();
			
			$instance = wp_parse_args( (array) $instance, $array_default );
			$instance['title'] = esc_attr($instance['title']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
			<p>
				<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:','wpdance'); ?></label>
				<input class="widefat" type="number" min="1" step="1" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo $instance['limit']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('order_by'); ?>"><?php _e('Order by:','wpdance'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('order_by'); ?>" id="<?php echo $this->get_field_id('order_by'); ?>">
					<?php foreach( $array_order_by as $key => $value ){ ?>
					<option value="<?php echo $key; ?>" <?php echo ($instance['order_by']==$key)?'selected':'' ?> ><?php echo $value; ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order Direction:','wpdance'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>">
					<?php foreach( $array_order as $key => $value ){ ?>
					<option value="<?php echo $key; ?>" <?php echo ($instance['order']==$key)?'selected':'' ?> ><?php echo $value; ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" <?php echo ($instance['show_title'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Display Title','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_avatar'); ?>" name="<?php echo $this->get_field_name('show_avatar'); ?>" <?php echo ($instance['show_avatar'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_avatar'); ?>"><?php _e('Display Avatar','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_twitter'); ?>" name="<?php echo $this->get_field_name('show_twitter'); ?>" <?php echo ($instance['show_twitter'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_twitter'); ?>"><?php _e('Display Twitter','wpdance'); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:','wpdance'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>">
					<option value="all" <?php echo ($instance['category']=='all')?'selected':''; ?> ><?php _e('All Category','wpdance'); ?></option>
					<?php foreach( $categories as $key => $value ){ ?>
					<option value="<?php echo $value->term_id; ?>" <?php echo ($instance['category']==$value->term_id)?'selected':'' ?> ><?php echo $value->name; ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('specific_ids'); ?>"><?php _e('Specific IDs:','wpdance'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('specific_ids'); ?>" name="<?php echo $this->get_field_name('specific_ids'); ?>" value="<?php echo $instance['specific_ids']; ?>" />
				<span><?php _e('Display a list specific testimonial. Add commas between IDs','wpdance'); ?></span>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('is_slider'); ?>" name="<?php echo $this->get_field_name('is_slider'); ?>" <?php echo ($instance['is_slider'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('is_slider'); ?>"><?php _e('Slider Mode','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('show_nav'); ?>" name="<?php echo $this->get_field_name('show_nav'); ?>" <?php echo ($instance['show_nav'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_nav'); ?>"><?php _e('Slider - Show Navigation','wpdance'); ?></label>
			</p>
			<p>
				<input class="" type="checkbox" id="<?php echo $this->get_field_id('auto_play'); ?>" name="<?php echo $this->get_field_name('auto_play'); ?>" <?php echo ($instance['auto_play'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('auto_play'); ?>"><?php _e('Slider - Auto Play','wpdance'); ?></label>
			</p>
			<?php }
	}
}

