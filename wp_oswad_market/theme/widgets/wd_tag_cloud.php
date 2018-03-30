<?php 
// Create widget tabs post
if(!class_exists('WP_Widget_WD_Tag_Cloud')){
	class WP_Widget_WD_Tag_Cloud extends WP_Widget {
		function WP_Widget_WD_Tag_Cloud() {
			$widget_ops = array( 'classname' => 'wd_tag_cloud woocommerce', 'description' => __( "Present your tag",'wpdance' ) );
			parent::__construct('wd_tag_cloud', __('WD - Tag Cloud','wpdance'), $widget_ops);
		}

		function widget( $args, $instance ) {
			extract( $args );
			
			if ( !in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ) {
				$instance['prod_tag'] = 0;
				$instance['prod_cat'] = 0;
			}
			
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Tag','wpdance') : $instance['title']);
			$is_prod_tag = ($instance['prod_tag'])?true:false;
			$is_prod_cat = ($instance['prod_cat'])?true:false;
			$is_post_tag = ($instance['post_tag'])?true:false;
			$is_post_cat = ($instance['post_cat'])?true:false;
			$min_font_size = empty($instance['min_font_size'])?9:absint($instance['min_font_size']);
			$max_font_size = empty($instance['max_font_size'])?14:absint($instance['max_font_size']);
			if( $max_font_size < $min_font_size )
				$max_font_size = $min_font_size;
			
			$background_color = empty($instance['background_color'])?'ffffff':$instance['background_color'];
			$background_transparent = ($instance['background_transparent'])?true:false;
			$tag_color = empty($instance['tag_color'])?'333333':$instance['tag_color'];
			$color_for_gradient = empty($instance['color_for_gradient'])?'333333':$instance['color_for_gradient'];
			$highlight_color = empty($instance['highlight_color'])?'000000':$instance['highlight_color'];
			
			$is_flash = ($instance['is_flash'])?true:false;
			$speed = empty($instance['speed'])?100:absint($instance['speed']);
			if( $is_flash ){
				wp_register_script( 'theme_swfobject', get_template_directory_uri().'/js/swfobject.js');
				wp_enqueue_script('theme_swfobject');
			}
			echo $before_widget;
			echo $before_title . $title . $after_title;
			wp_reset_query();
			
			$post_tags = '';
			if( $is_post_tag ){
				$tags_list = get_tags();
				foreach( $tags_list as $tag ){
					$rand_font_size = mt_rand($min_font_size,$max_font_size);
					$post_tags .= '<a href="'.esc_url(get_term_link($tag)).'" style="font-size: '.$rand_font_size.'px;">'.$tag->name.'</a>';
				}
			}
			$post_tags = urlencode($post_tags);
			
			$post_cats = '';
			if( $is_post_cat ){
				$cats_list = get_categories();
				foreach( $cats_list as $cat ){
					$rand_font_size = mt_rand($min_font_size,$max_font_size);
					$post_cats .= '<a href="'.esc_url(get_term_link($cat)).'" style="font-size: '.$rand_font_size.'px;">'.$cat->name.'</a>';
				}
			}
			$post_cats = urlencode($post_cats);
			
			$product_tags = '';
			if( $is_prod_tag ){
				$tags_list = get_categories(array('taxonomy' => 'product_tag'));
				foreach( $tags_list as $tag ){
					$rand_font_size = mt_rand($min_font_size,$max_font_size);
					$product_tags .= '<a href="'.esc_url(get_term_link($tag)).'" style="font-size: '.$rand_font_size.'px;">'.$tag->name.'</a>';
				}
			}
			$product_tags = urlencode($product_tags);
			
			$product_cats = '';
			if( $is_prod_cat ){
				$cats_list = get_categories(array('taxonomy' => 'product_cat'));
				foreach( $cats_list as $cat ){
					$rand_font_size = mt_rand($min_font_size,$max_font_size);
					$product_cats .= '<a href="'.esc_url(get_term_link($cat)).'" style="font-size: '.$rand_font_size.'px;">'.$cat->name.'</a>';
				}
			}
			$product_cats = urlencode($product_cats);
			
			$random_id = 'wd_widget_tag_cloud_'.mt_rand(0,1000);
			$random_id_tagclound = 'tagcloud_'.mt_rand(0,1000); 
	?>
				<div id="<?php echo $random_id; ?>" class="wd_widget_tag_cloud <?php echo (!$is_flash)?'no_flash':''; ?>">
					<?php 
						if( !$is_flash ){
							echo urldecode($post_tags).urldecode($post_cats).urldecode($product_tags).urldecode($product_cats);
						}
					?>
				</div>
			<?php if( $is_flash ){ ?>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					
					var _width = jQuery("#<?php echo $random_id; ?>").width();
					var _so = new SWFObject("<?php echo get_template_directory_uri().'/js/'; ?>tagcloud.swf", "<?php echo $random_id_tagclound; ?>", _width, _width, "7", "#<?php echo $background_color; ?>");
					// uncomment next line to enable transparency
					<?php if( $background_transparent ){ ?>
					_so.addParam("wmode", "transparent");
					<?php } ?>
					_so.addVariable("tcolor", "0x<?php echo $tag_color; ?>");
					_so.addVariable("tcolor2", "0x<?php echo $color_for_gradient; ?>");
					_so.addVariable("hicolor", "0x<?php echo $highlight_color; ?>"); // Highlight color
					_so.addVariable("mode", "tags");
					_so.addVariable("distr", "true"); // Distribute evenly on sphere
					_so.addVariable("tspeed", "<?php echo $speed; ?>");
					_so.addVariable("tagcloud", "<tags><?php echo $post_tags.$post_cats.$product_tags.$product_cats; ?></tags>");
					_so.write("<?php echo $random_id; ?>");
				});		
				</script>
			<?php 
			}
			wp_reset_query(); 
			?>
	<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title'] = strip_tags($new_instance['title']);
				$instance['post_tag'] = $new_instance['post_tag'];
				$instance['post_cat'] = $new_instance['post_cat'];
				$instance['prod_tag'] = $new_instance['prod_tag'];
				$instance['prod_cat'] = $new_instance['prod_cat'];
				$instance['min_font_size'] = absint($new_instance['min_font_size']);
				$instance['max_font_size'] = absint($new_instance['max_font_size']);
				$instance['is_flash'] = $new_instance['is_flash'];
				$instance['background_color'] = strip_tags($new_instance['background_color']);
				$instance['background_transparent'] = $new_instance['background_transparent'];
				$instance['tag_color'] = strip_tags($new_instance['tag_color']);
				$instance['color_for_gradient'] = strip_tags($new_instance['color_for_gradient']);
				$instance['highlight_color'] = strip_tags($new_instance['highlight_color']);
				$instance['speed'] = absint($new_instance['speed']);
				
				if( $instance['max_font_size'] < $instance['min_font_size'] )
					$instance['max_font_size'] = $instance['min_font_size'];
				
				return $instance;
		}

		function form( $instance ) {
				$instance_default = array( 
										'title' => 'Tag' 
										,'post_tag' => 1 
										,'post_cat' => 0 
										,'prod_tag' => 1 
										,'prod_cat' => 0 
										,'min_font_size' => 9
										,'max_font_size' => 14
										,'is_flash' => 1 
										,'background_color' => 'ffffff' 
										,'background_transparent' => 1
										,'tag_color' => '333333' 
										,'color_for_gradient' => '333333' 
										,'highlight_color' => '000000' 
										,'speed' => 100 
										
										);
				$instance = wp_parse_args( (array) $instance, $instance_default );
				$instance['title'] = esc_attr($instance['title']);
				
				$woo_actived = true;
				if ( !in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ) {
					$woo_actived = false;
				}

	?>
				<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:','wpdance' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
				<p>
					<input id="<?php echo $this->get_field_id('post_tag'); ?>" name="<?php echo $this->get_field_name('post_tag'); ?>" type="checkbox" value="1" <?php echo ($instance['post_tag'])?'checked':''; ?> />
					<label for="<?php echo $this->get_field_id('post_tag'); ?>"><?php _e( 'Post tag','wpdance' ); ?></label>
				</p>
				<p>
					<input id="<?php echo $this->get_field_id('post_cat'); ?>" name="<?php echo $this->get_field_name('post_cat'); ?>" type="checkbox" value="1" <?php echo ($instance['post_cat'])?'checked':''; ?> />
					<label for="<?php echo $this->get_field_id('post_cat'); ?>"><?php _e( 'Post category','wpdance' ); ?></label>
				</p>
				<p style="<?php echo (!$woo_actived)?'display: none;':''; ?>" >
					<input id="<?php echo $this->get_field_id('prod_tag'); ?>" name="<?php echo $this->get_field_name('prod_tag'); ?>" type="checkbox" value="1" <?php echo ($instance['prod_tag'])?'checked':''; ?> />
					<label for="<?php echo $this->get_field_id('prod_tag'); ?>"><?php _e( 'Product tag','wpdance' ); ?></label>
				</p>
				<p style="<?php echo (!$woo_actived)?'display: none;':''; ?>" >
					<input id="<?php echo $this->get_field_id('prod_cat'); ?>" name="<?php echo $this->get_field_name('prod_cat'); ?>" type="checkbox" value="1" <?php echo ($instance['prod_cat'])?'checked':''; ?> />
					<label for="<?php echo $this->get_field_id('prod_cat'); ?>"><?php _e( 'Product category','wpdance' ); ?></label>
				</p>
				<p>
					<label style="clear: both; width: 100%; display: block" for="<?php echo $this->get_field_id('min_font_size'); ?>"><?php _e( 'Font size:','wpdance' ); ?></label>
					<label for="<?php echo $this->get_field_id('min_font_size'); ?>"><?php _e( 'Min','wpdance' ); ?></label>
					<input class="small-text" id="<?php echo $this->get_field_id('min_font_size'); ?>" name="<?php echo $this->get_field_name('min_font_size'); ?>" type="number" value="<?php echo $instance['min_font_size']; ?>" />
					<label for="<?php echo $this->get_field_id('max_font_size'); ?>"><?php _e( 'Max','wpdance' ); ?></label>
					<input class="small-text" id="<?php echo $this->get_field_id('max_font_size'); ?>" name="<?php echo $this->get_field_name('max_font_size'); ?>" type="number" value="<?php echo $instance['max_font_size']; ?>" />
				</p>
				<hr />
				<p>
					<input id="<?php echo $this->get_field_id('is_flash'); ?>" name="<?php echo $this->get_field_name('is_flash'); ?>" type="checkbox" value="1" <?php echo ($instance['is_flash'])?'checked':''; ?> />
					<label for="<?php echo $this->get_field_id('is_flash'); ?>"><?php _e( 'Flash mode','wpdance' ); ?></label>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e( 'Background color:','wpdance' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" type="text" value="<?php echo $instance['background_color']; ?>" />
				</p>
				<p>
					<input id="<?php echo $this->get_field_id('background_transparent'); ?>" name="<?php echo $this->get_field_name('background_transparent'); ?>" type="checkbox" value="1" <?php echo ($instance['background_transparent'])?'checked':''; ?> />
					<label for="<?php echo $this->get_field_id('background_transparent'); ?>"><?php _e( 'Background transparent','wpdance' ); ?></label>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('tag_color'); ?>"><?php _e( 'Tag color:','wpdance' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('tag_color'); ?>" name="<?php echo $this->get_field_name('tag_color'); ?>" type="text" value="<?php echo $instance['tag_color']; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('color_for_gradient'); ?>"><?php _e( 'Color for gradient:','wpdance' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('color_for_gradient'); ?>" name="<?php echo $this->get_field_name('color_for_gradient'); ?>" type="text" value="<?php echo $instance['color_for_gradient']; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('highlight_color'); ?>"><?php _e( 'Highlight color:','wpdance' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('highlight_color'); ?>" name="<?php echo $this->get_field_name('highlight_color'); ?>" type="text" value="<?php echo $instance['highlight_color']; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e( 'Speed:','wpdance' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="number" value="<?php echo $instance['speed']; ?>" />
				</p>
				
				
	<?php
		}
	}
}
?>