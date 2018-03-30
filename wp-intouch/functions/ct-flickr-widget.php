<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Flickr Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget thats displays your projects from flickr.com
 	Version: 1.0
 	Author: ZERGE
 	Author URI: http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init', 'ct_flickr_widget');

function ct_flickr_widget() {
	register_widget('CT_Flickr_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Flickr_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CT_Flickr_Widget() {
		
		/* Widget settings. */
		$widget_ops = array( 'classname'		=> 'ct-flickr-widget',
							 'description'		=> __( 'CT: Flickr Widget', 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array( 'width'		=> 255,
							  'height'		=> 350,
							  'id_base'		=> 'ct-flickr-widget'
							);

		/* Create the widget. */		
		parent::__construct( 'ct-flickr-widget', 'CT: Flickr Widget ', $widget_ops);
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		if ( !is_admin() ) {
			/* Flickr */
			wp_register_script('jquery-flickr',get_template_directory_uri().'/js/jflickrfeed.min.js',false, null , true);
			wp_enqueue_script('jquery-flickr',array('jquery'));
		}

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['title'] );
		$user_id = $instance['user_id'];
		$num_images = $instance['num_images'];
		$feed_type = $instance['feed_type'];
		$background_title = $instance['background_title'];

		/* Before widget (defined by themes). */
		echo "\n<!-- START FLICKR WIDGET -->\n";
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) :
			echo '<h3 class="widget-title" style="background:'.$background_title.';"><a target="_blank" title="'.__('Visit our Flickr photostream','color-theme-framework').'" href="http://www.flickr.com/photos/'.$user_id.'">'.$title.'</a><span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
		endif;

		// Display widget
		$time_id = rand();	
		?>

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery.noConflict()(function($){
			$(document).ready(function() {
				$(".ct-flickr-<?php echo $time_id; ?>").jflickrfeed({
					limit: <?php echo $instance['num_images']; ?>,
					feedapi:"<?php echo $instance['feed_type']; ?>",
					qstrings: {
						id: "<?php echo $instance['user_id']; ?>"
					},
					itemTemplate: '<li>'+
								'<a rel="prettyPhoto[flickr]" href="{{image_b}}" title="{{title}}">' +
								'<img width="70" width="70" src="{{image_s}}" alt="{{title}}" />' +
								'</a>' +
								'</li>'
				},  function(data) {
						$('.ct-flickr-<?php echo $time_id; ?> a').prettyPhoto({
							animationSpeed: 'normal', /* fast/slow/normal */
							opacity: 0.80, /* Value between 0 and 1 */
							showTitle: true, /* true/false */
							deeplinking: false,
							theme:'light_square'
						});
				});

			});
		});
		/* ]]> */
		</script>

		<ul class="ct-flickr-<?php echo $time_id; ?> clearfix"></ul>
	
		<?php
		// After widget (defined by theme functions file)
		echo $after_widget;
		echo "\n<!-- END FLICKR WIDGET -->\n";
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['user_id'] = stripslashes( $new_instance['user_id']);
	$instance['num_images'] = stripslashes( $new_instance['num_images']);
	$instance['feed_type'] = $new_instance['feed_type'];
	$instance['background_title'] = strip_tags($new_instance['background_title']);

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(	'title'				=> __( 'Flickr' , 'color-theme-framework' ),
						'user_id'			=> '52617155@N08',
						'num_images'		=> '9',
						'feed_type'			=> 'photos_public.gne',
						'background_title'	=> '#e89319'
	);
	
	$instance = wp_parse_args((array) $instance, $defaults);
	$background_title = $instance['background_title'];
	?>

	<script type="text/javascript">
	//<![CDATA[
		jQuery(document).ready(function($) {  
			$('.ct-color-picker').wpColorPicker();
		});
	//]]>
	</script>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'color-theme-framework') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e('User ID:', 'color-theme-framework') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['user_id'] ), ENT_QUOTES)); ?>" />
		<span><?php _e('Can be found here:', 'color-theme-framework') . 'http://idgettr.com'; ?> </span>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'num_images' ); ?>"><?php _e('The number of displayed images:', 'color-theme-framework') ?></label>
		<input type="number" min="1" max="50" class="widefat" id="<?php echo $this->get_field_id( 'num_images' ); ?>" name="<?php echo $this->get_field_name( 'num_images' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['num_images'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'feed_type' ); ?>"><?php _e('Feed type:', 'color-theme-framework'); ?></label> 
		<select id="<?php echo $this->get_field_id( 'feed_type' ); ?>" name="<?php echo $this->get_field_name( 'feed_type' ); ?>" class="widefat" style="width:100%;">
			<option <?php if ( 'photos_public.gne' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>photos_public.gne</option>
			<option <?php if ( 'photos_friends.gne' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>photos_friends.gne</option>
			<option <?php if ( 'photos_faves.gne' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>photos_faves.gne</option>
			<option <?php if ( 'groups_pool.gne' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>groups_pool.gne</option>				
		</select>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
		<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" data-default-color="#e89319" />
	</p>
	<?php
	}
}
?>