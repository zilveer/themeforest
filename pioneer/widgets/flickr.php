<?php
class RM_Flickr extends WP_Widget {

	function RM_Flickr() {	
	$widget_ops = array( 'classname' => 'flickr_widget', 'description' => 'Show off your favorite Flickr photos!' );
		$this->WP_Widget( 'flickr_widget', 'Flickr Posts', $widget_ops);
	}
	
	function form($instance) {
	
		
		$instance = wp_parse_args( (array) $instance, array('title' => 'Flickr Photos', 'number' => 5, 'flickr_id' => '') );

        $title = esc_attr($instance['title']);
        $flickr_id = $instance['flickr_id'];
		$number = absint($instance['number']);

?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		

		<p>
            <label for="<?php echo $this->get_field_id('flickr_id'); ?>">
               Flickr username:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" />
                
        </p>

		<p>

		<p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
               Number of Photos:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>


<?php
    }

	function update($new_instance, $old_instance) {
        $instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['flickr_id']=$new_instance['flickr_id'];
        $instance['number']=$new_instance['number'];
        return $instance;

    }

	function widget($args, $instance) {
	
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;

        $flickr_id = $instance['flickr_id'];
		$number = absint( $instance['number'] );
		
		$key = get_option('epic_flickr_key');
		
		require_once(TEMPLATEPATH . "/widgets/phpFlickr/phpFlickr.php");
		$f = new phpFlickr(''.$key.''); //Insert API key here
		
		
		
		if (!empty($flickr_id)) {
		
			
			echo $before_widget;
		
			if($title){
				echo $before_title;
				echo $title; 
				echo $after_title;
			}
			
			$person = $f->people_findByUsername($flickr_id);   
   			$photos_url = $f->urls_getUserPhotos($person['id']);	
    		$photos = $f->people_getPublicPhotos($person['id'], NULL, NULL, $number);
					
    		echo '<div class="flickrlist_wrap clearfix"><ul class="flickrlist">';
 
			foreach ($photos['photos']['photo'] as $photo) {
				echo "<li>\n";
				echo '<a href='.$photos_url.$photo[id].'>';
				echo '<img alt="'.$photo[title].'" ';
				echo "src=" . $f->buildPhotoURL($photo, "Square") . ">";
				echo "</a>";
				
				echo "<li>\n";
			}
			echo '</ul></div>';
			echo $after_widget;

		}
		
	}

}


add_action( 'widgets_init', 'rm_load_widgets' );
function rm_load_widgets() {
	register_widget('RM_Flickr');
}
?>