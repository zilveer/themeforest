<?php 
class MY_Flickr extends WP_Widget {
	#1.constructor
	function __construct() {
		$widget_options = array("classname"=>'widget_flickr', 'description'=>'A widget that show last flickr photo streams');
		parent::__construct(false,IAMD_THEME_NAME.__(' Flickr Widget','iamd_text_domain'),$widget_options);
	}

	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title'=>'','flickr_id'=>'','count'=>'3','show'=>'latest','size'=>'s') );
						
		$title = 			empty($instance['title']) ?	'' : strip_tags($instance['title']);
		$flickr_id = 		empty($instance['flickr_id']) ? '' : strip_tags($instance['flickr_id']);
		$count = 			empty($instance['count']) ? '' : strip_tags($instance['count']);
		$show = 			empty($instance['show']) ? '' : strip_tags($instance['show']);
		$size = 			empty($instance['size']) ? '' : strip_tags($instance['size']);?>
        
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','iamd_text_domain');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
           
        <p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:','iamd_text_domain');?>
           <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>"
            type="text" value="<?php echo esc_attr($flickr_id); ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many entries do you want to show:','iamd_text_domain');?>
        	<select class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>">
            <?php for($i = 1; $i <= 30; $i++):	
					$selected = ($count == $i ) ? "selected='selected'" : "";?>
	              <option <?php echo esc_attr($selected);?> value="<?php echo esc_attr($i);?>"><?php echo esc_attr($i);?></option>
            <?php endfor;?>
            </select></label></p>

         <p><label for="<?php echo $this->get_field_id('show');?>"><?php _e('What pictures to display','iamd_text_domain'); ?>
         	<select class="widefat" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>">
            <?php  $a = array("latest"=>__("Latest",'iamd_text_domain'),"random"=>__("Random",'iamd_text_domain'));
			foreach($a as $key => $value ):
				$selected = ($show == $key ) ? "selected='selected'" : ""; 
				echo "<option value='$key' $selected> $value</option>";
			endforeach;?>	
            </select>
         </label></p>

         <p><label for="<?php echo $this->get_field_id('size');?>"><?php _e('What pictures to display','iamd_text_domain'); ?>
         	<select class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
            <?php  $a = array("s"=>__("square",'iamd_text_domain'),"t"=>__("thumbnail",'iamd_text_domain'), "m" => __("medium",'iamd_text_domain'));
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
			
			if ( !empty( $title ) ) echo $before_title.$title.$after_title;
			echo "<div class='flickrs'>";
			echo'<script type="text/javascript" 
			src="http'.dt_theme_ssl().'://www.flickr.com/badge_code_v2.gne?count='.$count.'&amp;display='.$show.'&amp;size='.$size.'&amp;layout=x&amp;source=user&amp;user='.$flickr_id.'"></script>'; 
			echo "</div>";
		echo $after_widget;
	}
}?>