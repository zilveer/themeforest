<?php
/**
 * bbPress forums
 */
if(!class_exists('WP_Widget_bbpress_forums')){
	class WP_Widget_bbpress_forums extends WP_Widget {

		function WP_Widget_bbpress_forums() {
			$widgetOps = array('classname' => 'wd_widget_bbpress_forums', 'description' => __('Display List Forums','wpdance'));
			parent::__construct('wd_bbpress_forums', __('WD - bbPress Forums','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			if( !class_exists('bbPress') )
				return;

			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));		
			$is_dropdown = $instance['is_dropdown'];		
			?>
			<?php echo $before_widget;?>
			<?php echo $before_title . $title . $after_title;?>
			<?php $random_id = 'wd_bbpress_forums_'.rand(0,1000); ?>
			<div class="wd_bbpress_forums" id="<?php echo $random_id; ?>">
				<?php 
					global $post;
					$args = array(
							'orderby' 		=> 'name'
							,'order'  		=> 'asc'
							,'hide_empty'  	=> 1
						);
					if( taxonomy_exists('forum_cat') ){
						$forum_cats = get_terms('forum_cat',$args);
					}
					else{
						$forum_cats = array();
					}
					
					if( count($forum_cats) > 0 ){
						echo '<ul class="'.($is_dropdown?'dropdown_mode is_dropdown':'').'">';
						foreach( $forum_cats as $forum_cat ){
							echo '<li class="forum_cat"><span class="cat_name">'.$forum_cat->name.'</span>';
							echo '<span class="icon_toggle"></span>';
							$this->get_list_forums($forum_cat->slug);
						}
						echo '</ul>';
					}
					else{
						$this->get_list_forums();
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
					
					var _widget_wrapper = jQuery("#<?php echo $random_id; ?>");
						
					var _parent_li = _widget_wrapper.find('ul.dropdown_mode li.forum_cat ul.forum_list').parent('li');
					_parent_li.addClass("has_sub");
					
					_parent_li.find('.icon_toggle').bind('click',function(){
						var parent_li = jQuery(this).parent('li.has_sub');
						if( !jQuery(this).hasClass('active') ){
							parent_li.find('ul.forum_list:first').slideDown();
							jQuery(this).addClass('active');
						}
						else{
							parent_li.find('ul.forum_list').slideUp();
							jQuery(this).removeClass('active');
							parent_li.find('.icon_toggle').removeClass('active');
						}
					});
					
					_widget_wrapper.find('a.current').parents('ul.forum_list').siblings('.icon_toggle').trigger('click');
					
				});
				
			</script>
			
			<?php
		}
		function get_list_forums($forum_cat_slug = ''){
			global $post;
			$current_forum = (isset($_GET['forum']) && $_GET['forum'] != '')?$_GET['forum']:'';
			$args = array();
			if( $forum_cat_slug != ''){
				$args['post_parent'] = 'any';
				$args['tax_query'] 	= array(
										array(
											'taxonomy'	=> 'forum_cat'
											,'terms'	=> $forum_cat_slug
											,'field'	=>'slug'
										)
									); 
			}
			if( bbp_has_forums($args) ){
				echo '<ul class="forum_list">';
				while ( bbp_forums() ) { bbp_the_forum();
					$forum_link = esc_url(bbp_get_forum_permalink( $post->ID ));
					$forum_title = bbp_get_forum_title( $post->ID );
					$current_class = ($current_forum == $post->post_name)?'current':'';
					echo '<li><a class="bbp-forum-title '.$current_class.'" href="'.$forum_link.'">'.$forum_title.'</a>';
						
					echo '</li>';
				}
				echo '</ul>';
			}
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] =  $new_instance['title'];			
			$instance['is_dropdown'] =  $new_instance['is_dropdown'];			
			
			return $instance;
		}

		function form( $instance ) { 
			$default_instance = array(
									'title'	=> 'Forums'
									,'is_dropdown' => 0
								);
			$instance = wp_parse_args( (array) $instance, $default_instance );
			$instance['title'] = esc_attr($instance['title']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('is_dropdown'); ?>" name="<?php echo $this->get_field_name('is_dropdown'); ?>" <?php echo ($instance['is_dropdown'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('is_dropdown'); ?>"><?php _e('Dropdown mode','wpdance'); ?></label>
			</p>
			<?php }
	}
}

