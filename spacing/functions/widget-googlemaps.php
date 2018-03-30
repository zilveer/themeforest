<?php

/*

Plugin Name: Google Maps
Plugin URI: http://themeforest.net/user/Tauris/
Description: Display a Google map.
Version: 1.1
Author: Tauris
Author URI: http://themeforest.net/user/Tauris/

*/


/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'pr_widget_googlemaps' );

/* Function that registers our widget. */
function pr_widget_googlemaps() {
	register_widget( 'PR_Widget_Googlemaps' );
}

// Widget class.
class PR_Widget_Googlemaps extends WP_Widget {


	function PR_Widget_Googlemaps() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'pr_widget_googlemaps', 'description' => 'Display a selected number of googlemaps images.' );

		/* Create the widget. */
		$this->WP_Widget( 'pr_widget_googlemaps', '(C) Google Maps', $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$location = $instance['location'];
		$zoom = $instance['zoom'];
		$color = $instance['color'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display name from widget settings. */
		?>
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.ui.map.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<?php
        $address = $location;
        $prepAddr = str_replace(' ','+',$address);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $geocode = curl_exec($ch);
        curl_close($ch);
        
        $output= json_decode($geocode);
        
        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;			
        ?>
		<script type="text/javascript" charset="utf-8">
        jQuery(function()
            {
                jQuery('#widget_gmap').gmap({'zoom':<?php echo $zoom ?><?php if($color){ echo",styles:[{stylers:[{lightness:1},{saturation:-95}]}]"; } ?>, 'center': '<?php echo $lat.",".$long ?>'}).bind('init', function(ev, map) {
                jQuery('#widget_gmap').gmap('addMarker', { 'position': map.getCenter(), 'bounds': false});
            });
        });			
        </script>
        <div class="video-container">
            <div id="widget_gmap">
                <p>This will be replaced with the Google Map.</p>
            </div>
		</div>
        <?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['location'] = strip_tags( $new_instance['location'] );	
		$instance['zoom'] = strip_tags( $new_instance['zoom'] );	
		$instance['color'] = strip_tags( $new_instance['color'] );	
		return $instance;
	}
	
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Map', 'location' => 'Seattle, USA', 'zoom' => '15', 'color' => '1');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>  
        
        <p>
        <label for="<?php echo $this->get_field_id('location'); ?>">Location:</label>
		<input id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" type="text" value="<?php echo $instance['location']; ?>" style="width:100%;" />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id('zoom'); ?>">Zoom:</label>
		<input id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" type="text" value="<?php echo $instance['zoom']; ?>" style="width:25px;" />
        </p>
        
        <p>
        <input id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" type="checkbox" <?php if($instance['color']){ echo "checked"; } ?>>
        <label for="<?php echo $this->get_field_id('color'); ?>">Black & White</label>
        </p>
        
        <?php
	}
}