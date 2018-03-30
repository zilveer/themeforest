<?php
/** MY Gallery Widget Widget
  * Objective:
  *		1.To list out gallery items
**/
class MY_Gallery_Widget extends WP_Widget {
	#1.constructor
	function __construct() {
		$widget_options = array("classname"=>'widget_popular_entries', 'description'=>'To list out gallery items');
		parent::__construct(false,IAMD_THEME_NAME.__(' Gallery','iamd_text_domain'),$widget_options);
	}
	
	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array('title'=>'','_post_count'=>'','_post_categories'=>'','_enabled_image'=>'','_excerpt'=>'') );
		$title = strip_tags($instance['title']);
		$_post_count = !empty($instance['_post_count']) ? strip_tags($instance['_post_count']) : "-1";
		$_post_categories = !empty($instance['_post_categories']) ? $instance['_post_categories']: array();
		$_enabled_image = isset($instance['_enabled_image']) ? (bool) $instance['_enabled_image'] : false;
		$_excerpt = !empty($instance['_excerpt']) ? $instance['_excerpt'] : 'show title and excerpt';?>
        
        <!-- Form -->
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','iamd_text_domain');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
           
	    <p><label for="<?php echo $this->get_field_id('_post_categories'); ?>">
			<?php _e('Choose the categories you want to display (multiple selection possible)','iamd_text_domain');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('_post_categories').'[]';?>" 
            	name="<?php echo $this->get_field_name('_post_categories').'[]';?>" multiple="multiple">
                <option value=""><?php _e("Select",'iamd_text_domain');?></option>
           	<?php $cats = get_categories('taxonomy=gallery_entries&hide_empty=1');
			foreach ($cats as $cat):
				$id = esc_attr($cat->term_id);
				$selected = ( in_array($id,$_post_categories)) ? 'selected="selected"' : '';
				$title = esc_html($cat->name);
				echo "<option value='{$id}' {$selected}>{$title}</option>";
			endforeach;?>
            </select></p>

        <p><label for="<?php echo $this->get_field_id('_excerpt'); ?>"><?php _e('Display title only or title &amp; excerpt','iamd_text_domain');?></label>
           <?php $answers = array('show title only','show title and excerpt');?>
           <select class="widefat" id="<?php echo $this->get_field_id('_excerpt'); ?>" name="<?php echo $this->get_field_name('_excerpt'); ?>">
		   <?php foreach ($answers  as $answer ): 
           	      $selected = ($_excerpt == $answer ) ? "selected='selected'" : "";?>
                  <option <?php echo esc_attr($selected);?> value="<?php echo esc_attr($answer);?>"><?php echo esc_attr($answer);?></option>
           <?php endforeach; ?>
           </select></p>

        <p><input type="checkbox"  id="<?php echo $this->get_field_id('_enabled_image');?>" name="<?php echo $this->get_field_name('_enabled_image');?>"
	         <?php checked($_enabled_image); ?> /> <?php _e("Show Image",'iamd_text_domain');?></p>  

	    <p><label for="<?php echo $this->get_field_id('_post_count'); ?>"><?php _e('No.of posts to show:','iamd_text_domain');?></label>
		   <input id="<?php echo $this->get_field_id('_post_count'); ?>" name="<?php echo $this->get_field_name('_post_count'); ?>" value="<?php echo esc_attr($_post_count);?>" /></p>
        <!-- Form end-->
<?php
	}
	#3.processes & saves the twitter widget option
	function update( $new_instance,$old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['_post_count'] = strip_tags($new_instance['_post_count']);
		$instance['_post_categories'] = $new_instance['_post_categories'];
		$instance['_excerpt'] = $new_instance['_excerpt'];
		$instance['_enabled_image'] = !empty($new_instance['_enabled_image']) ? 1 : 0;
	return $instance;
	}
	
	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
		global $post;
		$title = empty($instance['title']) ?'' : apply_filters('widget_title', $instance['title']);
		$_post_count = (int) $instance['_post_count'];
		$_post_categories = "";
		if(!empty($instance['_post_categories']) && is_array($instance['_post_categories'])):
			$_post_categories =  array_filter($instance['_post_categories']);
		elseif(!empty($instance['_post_categories'])):
			$_post_categories = explode(",",$instance['_post_categories']);
		endif;
		
		
		$_enabled_image = isset($instance['_enabled_image']) ? $instance['_enabled_image']:0;
		$show_title = ($instance['_excerpt'] == 'show title only') ? (bool) true : (bool) false;
		
		$arg = array('posts_per_page' => $_post_count ,'post_type' => 'dt_galleries');
		$arg = empty($_post_categories) ? $arg : array(
											'posts_per_page'=> $_post_count,
											'tax_query'		=> array(array( 'taxonomy'=>'gallery_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$_post_categories ) ));
		echo $before_widget;
		if ( !empty( $title ) ) echo $before_title.$title.$after_title;		
		echo "<div class='recent-gallery-widget'><ul>";
			 $the_query = new WP_Query($arg);
			 if($the_query->have_posts()) :
			 while($the_query->have_posts()):
			 	$the_query->the_post();
				$title = ( strlen(get_the_title()) > 20 ) ? substr(get_the_title(),0,15)."..." :get_the_title();
				echo "<li>";
					if(1 == $_enabled_image):
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'my-post-thumb',false);
						$image = ( $image != false)? $image[0]:IAMD_BASE_URL."/images/dummy-images/poster-my-post-thumb.jpg";
						echo "<a href='".get_permalink()."' class='thumb'>";
						echo "<img src='$image' alt='{$title}'/>";
						echo "</a>";
					endif;
					
					if($show_title):
						echo "<h6><a href='".get_permalink()."'>{$title}</a></h6>";
					else:
						echo "<h6><a href='".get_permalink()."'>{$title}</a></h6>";
						echo dt_theme_excerpt();
					endif;
				echo "</li>";
			 endwhile;
			 else:
			 	echo "<li>".__('No Gallery Entries found','iamd_text_domain')."</li>";
			 endif;
			 wp_reset_postdata();
	 	echo "</ul></div>";			 
		echo $after_widget;
	}
}?>