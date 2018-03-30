<?php
if( !class_exists('WP_Widget_Recent_Comments_Custom') ){
	class WP_Widget_Recent_Comments_Custom extends WP_Widget {

		function WP_Widget_Recent_Comments_Custom() {
			$widget_ops = array( 'classname' => 'widget_recent_comments_custom', 'description' => __( "The most recent comments",'wpdance' ) );
			parent::__construct('recent_comments_custom', __('WD - Recent Comments','wpdance'), $widget_ops);
		}
	
		function widget( $args, $instance ) {
			global $comments, $comment;

			if ( ! isset( $args['widget_id'] ) )
				$args['widget_id'] = $this->id;

			extract($args);
			$output = '';
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Comments','wpdance' ) : $instance['title'], $instance, $this->id_base );

			if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
				$number = 5;
			$post_type = $instance['post_type'];
			$show_avatar = ($instance['show_avatar'] == 'on')?1:0;
			$show_author = ($instance['show_author'] == 'on')?1:0;
			$show_twitter = ($instance['show_twitter'] == 'on')?1:0;
			$is_slider = ($instance['is_slider'] == 'on')?1:0;
			$auto_play = ($instance['auto_play'] == 'on')?1:0;
			$show_nav = ($instance['show_nav'] == 'on')?1:0;
			$per_slide = empty($instance['per_slide'])?2:absint($instance['per_slide']);
			$args = array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'comment_type' => '');
			if( $post_type != 'all'){
				$args['post_type'] = $post_type;
			}
			$comments = get_comments( $args );
			echo  $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;

			if ( $comments ) {
				$num_comment = count($comments);
				if( $num_comment < 2 || $num_comment <= $per_slide ){
					$is_slider = 0;
				}
				$random_id = 'wd_widget_recent_comments_wrapper_'.mt_rand();
				?>
				<div class="wd_widget_recent_comments_wrapper <?php echo ($show_nav)?'has_navi':''; ?>" id="<?php echo $random_id; ?>">
					<div class="widget_list_comment_inner">
				<?php
				$count = 0;	
				foreach ( (array) $comments as $comment) {
					
					$GLOBALS['comment'] = $comment;
					if ($count == 0 || $count % $per_slide == 0 ){
					?>
						<div class="widget_per_slide">
							<ul>
						<?php } ?>
							<li>
								
								<div class="detail">
									<blockquote class="comment-body"><?php echo string_limit_words(get_comment_text(),15).' [...]'; ?></blockquote>
									
									<div class="wd_info_comment">
										<?php if( $show_avatar ){ ?>
											<div class="avatar"><a href="<?php comment_link() ; ?>"><?php echo get_avatar( $comment->comment_author_email, get_option('woo_shortcode_size_w')  ); ?></a></div>
										<?php } ?>
									
										<?php if( $show_author ){ ?>
										<span class="author"><a href="<?php echo (get_comment_author_url()=='')?'javascript: void(0)':get_comment_author_url(); ?>" class="url" rel="external nofollow"><?php echo $comment->comment_author; ?></a></span>
										<?php } ?>
										<?php if( $show_twitter ){ ?>
										<span class="twitter">
											<?php 
												$user = get_user_by('email',$comment->comment_author_email);
												$twitter_id = '';
												if( $user ){
													$twitter_id = get_user_meta($user->ID,'twitter',true);
												}
											?>
											<a href="http://twitter.com/<?php echo $twitter_id; ?>" target="_blank" title="" ><?php _e('View Tweet', 'wpdance'); ?></a>
										</span>
										<?php } ?>
									</div>
									
								</div>
							</li>
						<?php $count++; if( $count % $per_slide == 0 || $count == $num_comment){ ?>
							</ul>
						</div>
					<?php
					}
				}
				?>
					</div>
				<?php if( $show_nav && $is_slider ){ ?>
					<div class="slider_control">
						<a href="#" class="prev">&lt;</a>
						<a href="#" class="next">&gt;</a>
					</div>
					<?php } ?>
				</div>
				<?php
			}
			$output .= $after_widget;

			echo $output;
			if( $is_slider ){
			?>
			<script type="text/javascript">
			jQuery(document).ready(function(){
					"use strict";
					
					var $_this = jQuery('#<?php echo $random_id; ?>');
					var _auto_play = <?php echo $auto_play; ?> == 1;
					var owl = $_this.find('.widget_list_comment_inner').owlCarousel({
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
			<?php
			}
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = esc_attr($new_instance['title']);
			$instance['number'] = $new_instance['number'];
			$instance['post_type'] = $new_instance['post_type'];
			$instance['show_avatar'] = $new_instance['show_avatar'];
			$instance['show_author'] = $new_instance['show_author'];
			$instance['show_twitter'] = $new_instance['show_twitter'];
			$instance['is_slider'] = $new_instance['is_slider'];
			$instance['show_nav'] = $new_instance['show_nav'];
			$instance['auto_play'] = $new_instance['auto_play'];
			$instance['per_slide'] = $new_instance['per_slide'];

			return $instance;
		}

		function form( $instance ) {
			$instance_default = array(
									'title' 		=> 'Recent Comments'
									,'number' 		=> 10
									,'post_type' 	=> 'all'
									,'show_avatar' 	=> 1
									,'show_author' 	=> 1
									,'show_twitter' => 1
									,'is_slider' 	=> 1
									,'show_nav' 	=> 1
									,'auto_play' 	=> 1
									,'per_slide' 	=> 2
									);
			$args = array('public' => true,'show_ui' => true);
			$post_types = get_post_types($args ,'names');
			foreach($post_types as $key => $post_type){
				if( !post_type_supports($key,'comments') ){
					unset( $post_types[$key] );
				}
			}
			
			$post_types = array_merge(array('all'=>__('All Posts','wpdance')),$post_types);
			$instance = wp_parse_args( (array) $instance, $instance_default );
			$instance['title'] = esc_attr($instance['title']);
	?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','wpdance'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show','wpdance'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" min="1" max="999" value="<?php echo $instance['number']; ?>" /></p>
			<p>
				<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php echo _e('Post type','wpdance'); ?> </label>
				<select class="widefat" name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>">
					<?php foreach($post_types as $key => $post_type){ ?>
						<option value="<?php echo $key; ?>" <?php echo ($instance['post_type']==$key)?'selected':''; ?> > <?php echo $post_type; ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('show_avatar'); ?>" name="<?php echo $this->get_field_name('show_avatar'); ?>" type="checkbox" <?php echo ($instance['show_avatar'])?'checked':'' ?> />
				<label for="<?php echo $this->get_field_id('show_avatar'); ?>"><?php _e('Show Avatar','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>" type="checkbox" <?php echo ($instance['show_author'])?'checked':'' ?> />
				<label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e('Show Author','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('show_twitter'); ?>" name="<?php echo $this->get_field_name('show_twitter'); ?>" type="checkbox" <?php echo ($instance['show_twitter'])?'checked':'' ?> />
				<label for="<?php echo $this->get_field_id('show_twitter'); ?>"><?php _e('Show Twitter','wpdance'); ?></label>
			</p>
			<hr />
			<p>
				<input id="<?php echo $this->get_field_id('is_slider'); ?>" name="<?php echo $this->get_field_name('is_slider'); ?>" type="checkbox" <?php echo ($instance['is_slider'])?'checked':'' ?> />
				<label for="<?php echo $this->get_field_id('is_slider'); ?>"><?php _e('Slider mode','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('show_nav'); ?>" name="<?php echo $this->get_field_name('show_nav'); ?>" type="checkbox" <?php echo ($instance['show_nav'])?'checked':'' ?> />
				<label for="<?php echo $this->get_field_id('show_nav'); ?>"><?php _e('Slider - Show navigation button','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('auto_play'); ?>" name="<?php echo $this->get_field_name('auto_play'); ?>" type="checkbox" <?php echo ($instance['auto_play'])?'checked':'' ?> />
				<label for="<?php echo $this->get_field_id('auto_play'); ?>"><?php _e('Slider - Auto play','wpdance'); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('per_slide'); ?>"><?php _e('Slider - Number of Comments per slide','wpdance'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('per_slide'); ?>" name="<?php echo $this->get_field_name('per_slide'); ?>" type="number" min="1" max="100" value="<?php echo $instance['per_slide']; ?>" />
			</p>
	<?php
		}
	}
}
?>