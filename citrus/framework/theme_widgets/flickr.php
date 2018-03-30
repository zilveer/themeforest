<?php 
class MY_Flickr extends WP_Widget {
	#1.constructor
	function MY_Flickr() {
		$widget_options = array("classname"=>'flickrbox', 'description'=>'A widget that show last flickr photo streams');
		parent::__construct(false,IAMD_THEME_NAME.__(' Flickr Widget','dt_themes'),$widget_options);
	}

	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title'=>'','flickr_id'=>'','count'=>'3','show'=>'latest','size'=>'t') );
						
		$title = 			empty($instance['title']) ?	'' : strip_tags($instance['title']);
		$flickr_id = 		empty($instance['flickr_id']) ? '' : strip_tags($instance['flickr_id']);
		$count = 			empty($instance['count']) ? '' : strip_tags($instance['count']);
		$show = 			empty($instance['show']) ? '' : strip_tags($instance['show']);
		$size = 			empty($instance['size']) ? '' : strip_tags($instance['size']);?>
        
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dt_themes');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
           
        <p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:','dt_themes');?>
           <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>"
            type="text" value="<?php echo esc_attr($flickr_id); ?>" /></label></p>
            
        <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many entries do you want to show:','dt_themes');?>
        	<select class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>">
            <?php for($i = 1; $i <= 10; $i++):	
					$selected = ($count == $i ) ? "selected='selected'" : "";?>
	              <option <?php echo($selected);?> value="<?php echo($i);?>"><?php echo($i);?></option>
            <?php endfor;?>
            </select></label></p>
         
         <p><label for="<?php echo $this->get_field_id('show');?>"><?php _e('What pictures to display','dt_themes'); ?>
         	<select class="widefat" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>">
            <?php  $a = array("latest"=>__("Latest",'dt_themes'),"random"=>__("Random",'dt_themes'));
			foreach($a as $key => $value ):
				$selected = ($show == $key ) ? "selected='selected'" : ""; 
				echo "<option value='$key' $selected> $value</option>";
			endforeach;?>	
            </select>
         </label></p>

         <p><label for="<?php echo $this->get_field_id('size');?>"><?php _e('What pictures to display','dt_themes'); ?>
         	<select class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
            <?php  $a = array("s"=>__("square",'dt_themes'),"t"=>__("thumbnail",'dt_themes'), "m" => __("medium",'dt_themes'));
			foreach($a as $key => $value ):
				$selected = ($size == $key ) ? "selected='selected'" : ""; 
				echo "<option value='$key' $selected> $value</option>";
			endforeach;?>	
            </select>
         </label></p>
<?php
	}
	
	#3.processes & saves the twitter widget option
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['show'] = strip_tags($new_instance['show']);
		$instance['size'] = strip_tags($new_instance['size']);
		return $instance;
	}
	
	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
		echo $before_widget;
			$title =		empty($instance['title']) ?	'' : strip_tags($instance['title']);
			$flickr_id =	empty($instance['flickr_id']) ? '' : strip_tags($instance['flickr_id']);
			$count = 		empty($instance['count']) ? '' : strip_tags($instance['count']);
			$show = 		$instance['show'];
			$size = 		$instance['size'];
			
			$title = apply_filters('widget_title', $title );
			if ( !empty( $title ) ) echo $before_title.$title.$after_title;
			echo "<div class='flickr-widget'>";
			echo'<script type="text/javascript" 
			src="http://www.flickr.com/badge_code_v2.gne?count='.$count.'&amp;display='.$show.'&amp;size='.$size.'&amp;layout=x&amp;source=user&amp;user='.$flickr_id.'"></script>'; 
			echo "</div>";
		echo $after_widget;
	}
}?>