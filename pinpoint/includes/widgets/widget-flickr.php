<?php

/* ==================================================

WordPress Flickr Widget

================================================== */

class sf_flickr_widget extends WP_Widget {

	function sf_flickr_widget() {	
		$widget_ops = array( 'classname' => 'flickr-widget', 'description' => 'Show off your favorite Flickr photos' );
		parent::__construct( 'flickr-widget', 'Flickr', $widget_ops);
	}
	
	function form($instance) {
		
		$instance = wp_parse_args( (array) $instance, array('title' => 'Flickr Photos', 'number' => 6, 'flickr_api' => '', 'flickr_id' => '') );
        $title = esc_attr($instance['title']);
		$flickr_api = $instance['flickr_api'];
        $flickr_id = $instance['flickr_id'];
		$number = absint($instance['number']);

?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'swiftframework');?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>

	<p>
		<label for="<?php echo $this->get_field_id('flickr_api'); ?>"><?php _e('Flickr API Key', 'swiftframework');?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('flickr_api'); ?>" name="<?php echo $this->get_field_name('flickr_api'); ?>" type="text" value="<?php echo $flickr_api; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr Username', 'swiftframework');?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Photos', 'swiftframework');?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
	</p>

<?php
    }

	function update($new_instance, $old_instance) {
       
		$instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_api']=$new_instance['flickr_api'];
        $instance['flickr_id']=$new_instance['flickr_id'];
        $instance['number']=$new_instance['number'];

        return $instance;
    }

	function widget($args, $instance) {
	
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;
		
		$flickr_api = $instance['flickr_api'];
        $flickr_id = $instance['flickr_id'];
		$number = absint( $instance['number'] );
		
		require_once(get_template_directory() . "/includes/widgets/phpFlickr/phpFlickr.php");
		$f = new phpFlickr($flickr_api); //Insert API key here
		$f->enableCache("fs", get_template_directory() ."/includes/widgets/cache/");
		
		if (!empty($flickr_id)) {

			echo $before_widget;
		
			if($title){
				echo $before_title;
				echo $title; 
				echo $after_title;
			}
			
			$apikey = $f->people_findByUsername($flickr_api);  
			$person = $f->people_findByUsername($flickr_id);   
   			$photos_url = $f->urls_getUserPhotos($person['id']);	
    		$photos = $f->people_getPublicPhotos($person['id'], NULL, NULL, $number);
					
    		echo "<ul class='flickr_images clearfix'>";
 
			foreach ((array)$photos['photos']['photo'] as $photo) {
				$photo_url = $f->buildPhotoURL($photo, "Large");
				echo "<li><a class='view flickr-img-link' rel='flickr-gallery' target='_blank' href=$photo_url>";
				echo "<img class='flickr' alt='$photo[title]' ".
					"src=" . $f->buildPhotoURL($photo, "Small") . ">";
				echo "</a></li>";
			}

			echo "</ul>";
		
			echo $after_widget;

		}
		
	}

}

add_action( 'widgets_init', 'sf_load_flickr_widget' );

function sf_load_flickr_widget() {
	register_widget('sf_flickr_widget');
}

?>