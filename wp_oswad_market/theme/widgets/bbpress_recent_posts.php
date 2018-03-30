<?php
/**
 * bbPress Recent Posts
 */
if(!class_exists('WP_Widget_bbpress_recent_posts')){
	class WP_Widget_bbpress_recent_posts extends WP_Widget {

		function WP_Widget_bbpress_recent_posts() {
			$widgetOps = array('classname' => 'wd_widget_bbpress_recent_posts', 'description' => __('Display Recent Posts of Forum','wpdance'));
			parent::__construct('wd_bbpress_recent_posts', __('WD - bbPress Recent Posts','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			if( !class_exists('bbPress') )
				return;

			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));		
			$limit = empty($instance['limit'])?5:absint($instance['limit']);		
			$show_nav = $instance['show_nav'];
			$is_slider = $instance['is_slider'];
			$auto_play = $instance['auto_play'];
			?>
			<?php echo $before_widget;?>
			<?php echo $before_title . $title . $after_title;?>
			<?php $random_id = 'wd_bbpress_recent_posts_'.rand(0,1000); ?>
			<div class="wd_bbpress_recent_posts" id="<?php echo $random_id; ?>">
				<?php 
					global $post;
					$args = array(
							'post_type'		   	   => bbp_get_topic_post_type()
							,'post_status'		   => array( bbp_get_public_status_id(), bbp_get_closed_status_id() )
							,'ignore_sticky_posts' => true
							,'no_found_rows'       => true
							,'posts_per_page'	   => $limit
							,'meta_key'            => '_bbp_last_active_time'
							,'orderby'             => 'meta_value'
							,'order'               => 'DESC'
						);
					
					$recent_posts =  new WP_Query( $args );
					if( $recent_posts->have_posts() ){
						echo '<ul>';
						while( $recent_posts->have_posts() ){
							$recent_posts->the_post();
							?>
								<li>
									<div class="detail">
										<?php
											$content = get_the_content();
											$content = apply_filters( 'the_content', $content );
											$content = str_replace( ']]>', ']]&gt;', $content );
											$content = wp_strip_all_tags($content);
										?>
										<blockquote class="post_content"><?php echo string_limit_words($content,15).' [...]'; ?></blockquote>
										<div class="post_user_info">
											<?php $user = get_user_by('id',$post->post_author); ?>
											<div class="avatar"><a href="<?php the_permalink() ; ?>"><?php echo get_avatar( $user->user_email, get_option('woo_shortcode_size_w')  ); ?></a></div>
											<span class="author"><a href="<?php echo (get_author_posts_url($post->post_author)=='')?'javascript: void(0)':get_author_posts_url($post->post_author); ?>" class="url" rel="external nofollow"><?php the_author(); ?></a></span>
											<span class="twitter">
												<?php 
													
													$twitter_id = '';
													if( $user ){
														$twitter_id = get_user_meta($user->ID,'twitter',true);
													}
												?>
												<a href="http://twitter.com/<?php echo $twitter_id; ?>" target="_blank" title="" ><?php _e('View Tweet', 'wpdance'); ?></a>
											</span>
										</div>
									</div>
								</li>
							<?php
						}	
						echo '</ul>';
					}
				?>
				<?php if( $show_nav && $is_slider ){ ?>
				<div class="slider_control">
					<a href="#" class="prev">&lt;</a>
					<a href="#" class="next">&gt;</a>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<?php if( $is_slider ): ?>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					
					var $_this = jQuery('#<?php echo $random_id; ?>');
					var _auto_play = <?php echo $auto_play; ?> == 1;
					var owl = $_this.find('ul').owlCarousel({
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
								,autoplaySpeed: false
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
					});
				</script>
			<?php endif; ?>
			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] 		= esc_attr($new_instance['title']);			
			$instance['limit'] 		= $new_instance['limit'];			
			$instance['is_slider'] 	= $new_instance['is_slider'];
			$instance['show_nav'] 	= $new_instance['show_nav'];
			$instance['auto_play'] 	= $new_instance['auto_play'];
			return $instance;
		}

		function form( $instance ) { 
			$default_instance = array(
									'title'			=> 'Recent Posts'
									,'limit' 		=> 5
									,'is_slider' 	=> 1
									,'show_nav' 	=> 1
									,'auto_play' 	=> 1
								);
			$instance = wp_parse_args( (array) $instance, $default_instance );
			$instance['title'] = esc_attr($instance['title']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
			<p>
				<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit','wpdance'); ?></label>
				<input type="number" class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo $instance['limit']; ?>" />
				
			</p>
			<p>
				<input value="1" id="<?php echo $this->get_field_id('is_slider'); ?>" name="<?php echo $this->get_field_name('is_slider'); ?>" type="checkbox" <?php echo ($instance['is_slider'])?'checked':'' ?> />
				<label for="<?php echo $this->get_field_id('is_slider'); ?>"><?php _e('Slider mode','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" id="<?php echo $this->get_field_id('show_nav'); ?>" name="<?php echo $this->get_field_name('show_nav'); ?>" type="checkbox" <?php echo ($instance['show_nav'])?'checked':'' ?> />
				<label for="<?php echo $this->get_field_id('show_nav'); ?>"><?php _e('Slider - Show navigation button','wpdance'); ?></label>
			</p>
			<p>
				<input value="1" id="<?php echo $this->get_field_id('auto_play'); ?>" name="<?php echo $this->get_field_name('auto_play'); ?>" type="checkbox" <?php echo ($instance['auto_play'])?'checked':'' ?> />
				<label for="<?php echo $this->get_field_id('auto_play'); ?>"><?php _e('Slider - Auto play','wpdance'); ?></label>
			</p>
			<?php }
	}
}

