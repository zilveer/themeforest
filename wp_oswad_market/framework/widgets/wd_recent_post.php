<?php 
if(!class_exists('WP_Widget_WD_Recent_Post')){
	class WP_Widget_WD_Recent_Post extends WP_Widget {
    	function WP_Widget_WD_Recent_Post() {
				$widget_ops = array('description' => 'This widget show recent posts.' );

				parent::__construct('wd_recent_post_widget', 'WD - Recent Posts', $widget_ops);
		}
	  
		function widget($args, $instance){
			global $wpdb; // call global for use in function

			ob_start();			
			
			extract($args); // gives us the default settings of widgets
			
			$title = apply_filters('widget_title', empty($instance['title']) ? __('','wpdance') : $instance['title']);
			
			$_limit = absint($instance['limit']) == 0 ? 5 : absint($instance['limit']);
			$type = isset($instance['type'])?$instance['type']:1;
			
			$limit_excerpt_word = empty($instance['limit_excerpt_word'])?10:absint($instance['limit_excerpt_word']);
			$show_thumbnail = ($instance['show_thumbnail'] == 'on')?1:0;
			$show_title = ($instance['show_title'] == 'on')?1:0;
			$show_excerpt = ($instance['show_excerpt'] == 'on')?1:0;
			$show_read_more_button = ($instance['show_read_more_button'] == 'on')?1:0;
			$show_date = ($instance['show_date'] == 'on')?1:0;
			$show_author = ($instance['show_author'] == 'on')?1:0;
			
			$is_slider = ($instance['is_slider'] == 'on')?1:0;
			$show_nav = ($instance['show_nav'] == 'on')?1:0;
			$auto_play = ($instance['auto_play'] == 'on')?1:0;
			
			echo $before_widget; // echos the container for the widget || obtained from $args
			if($title!==""){
				echo $before_title . $title . $after_title;
			}
			if( class_exists('WP_Widget_Productaz') ){
				global $wp_widget_factory;
				remove_action( 'posts_where', array( $wp_widget_factory->widgets['WP_Widget_Productaz'], 'add_a2z_query_to_post_where'  ),11 );
			}
			wp_reset_query();	
			$num_count = count(query_posts("showposts={$_limit}&ignore_sticky_posts=1"));
			if( $num_count < 2 ){
				$is_slider = 0;
			}
			$random_id = 'wd_recent_post_widget_wrapper_'.mt_rand(0,10000);
			$extra_class = ($is_slider)?'loading':'';
			$extra_class .= ($is_slider)?' slider_mode':'';
			$extra_class .= ' type-'.$type;
			if($show_nav ){
				echo '<div class="wd_recent_post_widget_wrapper has_navi '.$extra_class.'" id="'.$random_id.'">';
			}
			else{
				echo '<div class="wd_recent_post_widget_wrapper '.$extra_class.'" id="'.$random_id.'">';
			}
			
			if(have_posts())	{
				echo '<div class="wd_recent_posts_slider_widget">';
				$i = 0;
				while(have_posts()) {the_post();global $post;
					?>
					<div class="item">
						<div class="detail">
							<?php if( $show_thumbnail ){ ?>
							<div class="post_thumbnail">
								<a class="wd-effect-blog" href="<?php the_permalink(); ?>">
								<?php if(has_post_thumbnail()){ ?>
									<?php the_post_thumbnail(array(240,240),array('title'=>get_the_title()));?>	
								<?php } else { ?>	
									<img alt="<?php the_title(); ?>" height="240" width="240" title="<?php the_title();?>" src="<?php echo get_template_directory_uri(); ?>/images/no-image-blog.gif"/>
								<?php } ?>
								</a>
							</div>
							<?php } ?>
							
							<div class="post_meta">
								<?php if( $show_date && $type == 2 ) { ?>
									<span class="date-time">
										<span><?php echo get_the_date('d'); ?></span>
										<span><?php echo get_the_date('M'); ?></span>
									</span>
								<?php } ?>
														
								<?php if( $show_title ){ ?>
								<div class="entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
										<?php echo esc_attr(get_the_title()); ?>
									</a>
								</div>
								<?php } ?>
								
								<?php if( $show_excerpt ){ ?>
								<p class="entry-desc">
									<?php echo the_excerpt_max_words($limit_excerpt_word, '', false).' [...]';?>
								</p>
								<?php } ?>
								<div class="info-detail">
									<?php if($show_author) { ?>
										<span class="author">
											<?php echo ($type == 2)?__('Post by ','wpdance'):''; ?>
											<?php the_author_posts_link(); ?> 
										</span>
									<?php } ?>
									<?php if( $show_date && $type == 1 ) { ?>
										<span class="date-time"><?php echo get_the_date('M d, Y') ?></span>
									<?php } ?>
								</div>
								<?php if( $show_read_more_button ){ ?>
								<a class="read-more wd-more" href="<?php the_permalink(); ?>" ><?php _e('Read more','wpdance');?></a>
								<?php } ?>
							</div>
						</div>
						
					</div>
				
				<?php }
				echo '</div>';
				echo '<div class="clearfix"></div>';
				if( $is_slider && $show_nav ){
					echo '<div class="slider_control"><a class="prev" title="prev" href="#">&lt;</a>';
					echo '<a class="next" title="next" href="#" >&gt;</a> </div>';
				}
			}
			echo '</div>';
			if( $is_slider ){
?>			
			<script type="text/javascript" language="javascript">
		//<![CDATA[
			jQuery(document).ready(function() {
				"use strict";
				
				var $_this = jQuery('#<?php echo $random_id; ?>');
				var _auto_play = <?php echo $auto_play; ?> == 1;
				var owl = $_this.find('.wd_recent_posts_slider_widget').owlCarousel({
								loop : true
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
								,responsive:{
									0:{
										items : 1
									},
									480:{
										items : 2
									},
									720:{
										items : 3
									},
									960:{
										items : 4
									},
									1200:{
										items : 5
									}
								}
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
		//]]>	
		</script>
		<?php		
			}
			wp_reset_query();
			
			echo $after_widget; // close the container || obtained from $args
			$content = ob_get_clean();

			echo $content;			
			
		}

		
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] 					= $new_instance['title'];
			$instance['type'] 					= $new_instance['type'];
			$instance['limit_excerpt_word'] 	= $new_instance['limit_excerpt_word'];
			$instance['show_thumbnail'] 		= $new_instance['show_thumbnail'];
			$instance['show_title'] 			= $new_instance['show_title'];
			$instance['show_excerpt'] 			= $new_instance['show_excerpt'];
			$instance['show_read_more_button'] 	= $new_instance['show_read_more_button'];
			$instance['show_date'] 				= $new_instance['show_date'];
			$instance['show_author'] 			= $new_instance['show_author'];
			$instance['limit'] 					= $new_instance['limit'];
			$instance['is_slider'] 				= $new_instance['is_slider'];
			$instance['show_nav'] 				= $new_instance['show_nav'];
			$instance['auto_play'] 				= $new_instance['auto_play'];
			return $instance;
		}

		
		function form($instance) {        
			$instance_default = array(
									'title' 				=> 'Recent Posts'
									,'type'					=> 1
									,'limit'				=> 4
									,'limit_excerpt_word'	=> 10
									,'show_thumbnail' 		=> 0
									,'show_title' 			=> 1
									,'show_excerpt' 		=> 1
									,'show_read_more_button'=> 0
									,'show_date' 			=> 1
									,'show_author' 			=> 1
									,'is_slider' 			=> 1
									,'show_nav' 			=> 1
									,'auto_play' 			=> 1
								);
			//Defaults
			$instance = wp_parse_args( (array) $instance, $instance_default );
			$title = esc_attr( $instance['title'] );
			$limit = absint( $instance['limit'] );
			$limit_excerpt_word = absint( $instance['limit_excerpt_word'] );
			
			?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title','wpdance' ); ?>: </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
			<p>
				<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Type to show','wpdance' ); ?>: </label>
				<select class="widefat" name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>">
					<option value="1" <?php selected($instance['type'], 1); ?>>1</option>
					<option value="2" <?php selected($instance['type'], 2); ?>>2</option>
				</select>
			</p>
			<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( 'Limit post','wpdance' ); ?>: </label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" min="1" value="<?php echo $limit; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('limit_excerpt_word'); ?>"><?php _e( 'Limit excerpt word','wpdance' ); ?>: </label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit_excerpt_word'); ?>" name="<?php echo $this->get_field_name('limit_excerpt_word'); ?>" type="number" min="1" value="<?php echo $limit_excerpt_word; ?>" /></p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" type="checkbox" <?php echo ($instance['show_thumbnail'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e( 'Show thumbnail image','wpdance' ); ?></label>
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" type="checkbox" <?php echo ($instance['show_title'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e( 'Show post title','wpdance' ); ?></label>
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" type="checkbox" <?php echo ($instance['show_excerpt'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e( 'Show post excerpt','wpdance' ); ?></label>
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" type="checkbox" <?php echo ($instance['show_date'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date time','wpdance' ); ?></label>
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>" type="checkbox" <?php echo ($instance['show_author'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e( 'Show author','wpdance' ); ?></label>
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id('show_read_more_button'); ?>" name="<?php echo $this->get_field_name('show_read_more_button'); ?>" type="checkbox" <?php echo ($instance['show_read_more_button'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_read_more_button'); ?>"><?php _e( 'Show read more button','wpdance' ); ?></label>
			</p>
			<hr />
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id('is_slider'); ?>" name="<?php echo $this->get_field_name('is_slider'); ?>" type="checkbox" <?php echo ($instance['is_slider'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('is_slider'); ?>"><?php _e( 'Slider mode','wpdance' ); ?></label>
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id('show_nav'); ?>" name="<?php echo $this->get_field_name('show_nav'); ?>" type="checkbox" <?php echo ($instance['show_nav'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_nav'); ?>"><?php _e( 'Slider - Show navigation button','wpdance' ); ?></label>
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id('auto_play'); ?>" name="<?php echo $this->get_field_name('auto_play'); ?>" type="checkbox" <?php echo ($instance['auto_play'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('auto_play'); ?>"><?php _e( 'Slider - Auto play','wpdance' ); ?></label>
			</p>
	<?php
		   
		}
	}
}
?>