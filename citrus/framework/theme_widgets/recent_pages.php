<?php
/** My Recent Pages Widget
  * Objective:
  *		1.To list out pages
**/
class MY_Recent_Pages extends WP_Widget {
	#1.constructor
	function MY_Recent_Pages() {
		$widget_options = array("classname"=>'widget_popular_entries', 'description'=>'To list out posts');
		parent::__construct(false,IAMD_THEME_NAME.__(' Pages','dt_themes'),$widget_options);
	}
	
	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array('title'=>'','_pages'=>'','_enabled_image'=>'','_excerpt'=>'') );
		$title = strip_tags($instance['title']);
		$_pages = !empty($instance['_pages']) ? $instance['_pages']: array();
		$_enabled_image = isset($instance['_enabled_image']) ? (bool) $instance['_enabled_image'] : false;
		$_excerpt = !empty($instance['_excerpt']) ? $instance['_excerpt'] : 'show title and excerpt';?>
        <!-- Form -->
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dt_themes');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
           
	    <p><label for="<?php echo $this->get_field_id('_pages'); ?>">
			<?php _e('Choose the pages you want to display (multiple selection possible)','dt_themes');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('_pages').'[]';?>" 
            	name="<?php echo $this->get_field_name('_pages').'[]';?>" multiple="multiple">
                <option value=""><?php _e("Select Page",'dt_themes');?></option>
           	<?php $pages = get_pages('title_li=&orderby=name');
			foreach ($pages as $page):
				$id = esc_attr($page->ID);
				$title = esc_html($page->post_title);
				$selected = ( in_array($id,$_pages)) ? 'selected="selected"' : '';
				echo "<option value='{$id}' {$selected}>{$title}</option>";
			endforeach;?>
            </select></p>

        <p><label for="<?php echo $this->get_field_id('_excerpt'); ?>"><?php _e('Display title only or title &amp; excerpt','dt_themes');?></label>
           <?php $answers = array('show title only','show title and excerpt');?>
           <select class="widefat" id="<?php echo $this->get_field_id('_excerpt'); ?>" name="<?php echo $this->get_field_name('_excerpt'); ?>">
		   <?php foreach ($answers  as $answer ): 
           	      $selected = ($_excerpt == $answer ) ? "selected='selected'" : "";?>
                  <option <?php echo($selected);?> value="<?php echo($answer);?>"><?php echo($answer);?></option>
           <?php endforeach; ?>
           </select></p>

        <p><input type="checkbox"  id="<?php echo $this->get_field_id('_enabled_image');?>" name="<?php echo $this->get_field_name('_enabled_image');?>"
	         <?php checked($_enabled_image); ?> /> <?php _e("Show Image",'dt_themes');?></p>  
        <!-- Form end-->
<?php
	}
	#3.processes & saves the twitter widget option
	function update( $new_instance,$old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['_pages'] = $new_instance['_pages'];
		$instance['_excerpt'] = $new_instance['_excerpt'];
		$instance['_enabled_image'] = !empty($new_instance['_enabled_image']) ? 1 : 0;
	return $instance;
	}
	
	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
		global $post;
		$title = empty($instance['title']) ?'' : apply_filters('widget_title', $instance['title']);
		$_pages = "";
		if(!empty($instance['_pages']) && is_array($instance['_pages'])):
			$_pages =  array_filter($instance['_pages']);
		elseif(!empty($instance['_pages'])):
			$_pages = explode(",",$instance['_pages']);
		endif;

		$_enabled_image = isset($instance['_enabled_image']) ? $instance['_enabled_image']:0;
		$show_title = ($instance['_excerpt'] == 'show title only') ? (bool) true : (bool) false;
		$arg = empty($_pages) ? array('post_type'=>'page') : array('post_type'=>'page','post__in'=>$_pages);

		echo $before_widget;
 	    echo $before_title.$title.$after_title;
		echo "<div class='recent-pages-widget'><ul>";
			 query_posts($arg);
			 if( have_posts()) :
			 while(have_posts()):
			 	the_post();
				$title = ( strlen(get_the_title()) > 20 ) ? substr(get_the_title(),0,19)."..." :get_the_title();
				echo "<li>";
					if(1 == $_enabled_image):
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'my-post-thumb',false);
						$image = ( $image != false)? $image[0]:IAMD_BASE_URL."/images/dummy-images/poster-my-post-thumb.jpg";
						echo "<a href='".get_permalink()."' class='thumb'>";
						echo "<img src='$image' width='71' height='63' alt='{$title}'/>";
						echo "</a>";
					endif;
					
					if($show_title):
						echo "<h6>{$title}</h6>";
					else:
						echo "<h6>{$title}</h6>";
						#echo dttheme_excerpt('dttheme_excerptlength_teaser1', 'dttheme_excerptmore');
						echo dttheme_excerpt();
					endif;
				echo "</li>";
			 endwhile;
			 else:
				echo "<li><h6>".__('No Pages found','dt_themes')."</h6></li>";			 
			 endif;
			 wp_reset_query();
	 	echo "</ul></div>";			 
		echo $after_widget;
	}
}?>