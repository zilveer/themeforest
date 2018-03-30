<?php
/**
 * Plugin Name: BK-Ninja: Flickr Widget
 * Plugin URI: http://bk-ninja.com
 * Description: This widget allows to display flickr images.
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'bk_register_flickr_widget' );

function bk_register_flickr_widget() {
	register_widget( 'bk_flickr' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class bk_flickr extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */		
		$widget_ops = array('classname' => 'widget_flickr', 'description' => __('[Sidebar widget] Displays Flickr images in sidebar.','bkninja') );
		
		/* Create the widget. */
		parent::__construct('bk_flickr', __('*BK: Widget Flickr', 'bkninja'), $widget_ops);
	}

	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $flickr_id = empty($instance['flickr_id']) ? ' ' : apply_filters('widget_user', $instance['flickr_id']);
        $flickr_counter = empty($instance['flickr_counter']) ? ' ' : apply_filters('widget_counter', $instance['flickr_counter']);

		if ( $title )
		  echo $before_title . $title . $after_title;
        ?>
		<ul id="flickr" class="clear-fix"></ul>
            <script type="text/javascript">
				jQuery(document).ready(function($){
					$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?ids=<?php print $flickr_id; ?>&lang=en-us&format=json&jsoncallback=?", function(data){
				          $.each(data.items, function(index, item){
				                if(index >= <?php echo $flickr_counter;?>){
                                    return false;
                                  }
				                $("<img/>").attr("src", item.media.m).appendTo("#flickr")
				                  .wrap("<li><a href='" + item.link + "'></a></li>");
				          });
				        });
				});
			</script>
			
		<?php
		
        echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
        $instance['flickr_counter'] = strip_tags($new_instance['flickr_counter']);
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	 
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Flickr', 'flickr_id' => '', 'flickr_counter' => 9 ) );
	?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><strong><?php _e('Title:', 'bkninja') ?></strong>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><strong><?php _e('Flickr User ID ', 'bkninja') ?></strong>( <a href="http://www.idgettr.com" target="_blank" >idGettr</a> ): 
            <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $instance['flickr_id']; ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('flickr_counter'); ?>"><strong><?php _e('Number of images:', 'bkninja') ?></strong>
            <input class="widefat" id="<?php echo $this->get_field_id('flickr_counter'); ?>" name="<?php echo $this->get_field_name('flickr_counter'); ?>" type="text" value="<?php echo $instance['flickr_counter']; ?>" /></label></p>
<?php
	}
}