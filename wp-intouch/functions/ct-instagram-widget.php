<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Instagram Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget thats displays your photos from instagram.com
 	Version: 1.0
 	Author: ZERGE
 	Author URI: http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init', 'ct_instagram_widget');

function ct_instagram_widget() {
	register_widget('CT_Instagram_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Instagram_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CT_Instagram_Widget() {
		
		/* Widget settings. */
		$widget_ops = array(	'classname'		=> 'ct-instagram-widget',
								'description'	=> __( 'CT: Instagram Widget', 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 200,
								'height'	=> 350,
								'id_base'	=> 'ct-instagram-widget'
							);

		/* Create the widget. */
		parent::__construct( 'ct-instagram-widget', 'CT: Instagram Widget ', $widget_ops);
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		if ( !is_admin() ) {
			/* Instagram */
			wp_register_script('jquery-instagram',get_template_directory_uri().'/js/spectragram.min.js',false, null , true);
			wp_enqueue_script('jquery-instagram',array('jquery'));
		}

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['title'] );
		$access_token = $instance['access_token'];
		$client_id = $instance['client_id'];
		$your_query = $instance['your_query'];
		$num_images = $instance['num_images'];
		$feed_type = $instance['feed_type'];
		$background_title = $instance['background_title'];

		$time_id = rand();

		/* Before widget (defined by themes). */
		echo "\n<!-- START INSTAGRAM WIDGET -->\n";
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) :
			if ( $feed_type == 'UserFeed' ) :
				echo '<h3 class="widget-title" style="background:'.$background_title.';"><a target="_blank" title="'.__('Visit our Instagram photostream','color-theme-framework').'" href="http://instagram.com/'.$your_query.'">'.$title.'</a><span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
			else :
				echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
			endif;
		endif;


		if ( $feed_type == 'Popular' ) : $get_feed_type = 'getPopular';
		elseif ( $feed_type == 'RecentTagged' ) : $get_feed_type = 'getRecentTagged';
		else : $get_feed_type = 'getUserFeed';
		endif;
		?>

		<?php if ( empty($access_token) || empty($client_id) ) : ?>
			<p>You must define an accessToken and a clientID</p>
		<?php else : ?>
		<script type="text/javascript">
		/* <![CDATA[ */
			jQuery.noConflict()(function($){
				$(document).ready(function() {
					jQuery.fn.spectragram.accessData = {
						accessToken: '<?php echo $access_token; ?>',
						clientID: '<?php echo $client_id; ?>'
					};

					//Call spectagram function on the container element and pass it your query
					$('.ct-instagram-<?php echo $time_id; ?>').spectragram('<?php echo $get_feed_type; ?>', {
						query: '<?php echo $your_query; ?>', //this gets user photo feed
						size: 'small',
						max: <?php echo $num_images; ?>
					});
				});
			});
		/* ]]> */
		</script>
		<?php endif; ?>

		<ul class="ct-instagram-<?php echo $time_id; ?> clearfix"></ul>

		<?php

		// After widget (defined by theme functions file)
		echo $after_widget;
		echo "\n<!-- END INSTAGRAM WIDGET -->\n";
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['access_token'] = stripslashes( $new_instance['access_token']);
	$instance['client_id'] = stripslashes( $new_instance['client_id']);
	$instance['your_query'] = stripslashes( $new_instance['your_query']);
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
	$defaults = array(	'title'				=> __( 'Instagram Feed' , 'color-theme-framework' ),
						'access_token'		=> '',
						'client_id'			=> '',
						'your_query'		=> 'awesomeinventions',
						'num_images'		=> '6',
						'feed_type'			=> 'UserFeed',
						'background_title'	=> '#4f7ca1'
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

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'color-theme-framework') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'client_id' ); ?>"><?php _e('Your Instagram application clientID:', 'color-theme-framework') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'client_id' ); ?>" name="<?php echo $this->get_field_name( 'client_id' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['client_id'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><?php _e('Your Instagram access token:', 'color-theme-framework') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['access_token'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'your_query' ); ?>"><?php _e('Query (user name or tag):', 'color-theme-framework') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'your_query' ); ?>" name="<?php echo $this->get_field_name( 'your_query' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['your_query'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'num_images' ); ?>"><?php _e('The number of displayed images:', 'color-theme-framework') ?></label>
		<input type="number" min="1" max="30" class="widefat" id="<?php echo $this->get_field_id( 'num_images' ); ?>" name="<?php echo $this->get_field_name( 'num_images' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['num_images'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'feed_type' ); ?>"><?php _e('Feed type:', 'color-theme-framework'); ?></label> 
		<select id="<?php echo $this->get_field_id( 'feed_type' ); ?>" name="<?php echo $this->get_field_name( 'feed_type' ); ?>" class="widefat" style="width:100%;">
			<option <?php if ( 'UserFeed' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>UserFeed</option>
			<option <?php if ( 'Popular' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>Popular</option>
			<option <?php if ( 'RecentTagged' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>RecentTagged</option>
		</select>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
		<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" data-default-color="#4f7ca1" />
	</p>
	<?php
	}
}
?>