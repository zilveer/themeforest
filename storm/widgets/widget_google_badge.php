<?php
/**
 * Plugin Name: BK-Ninja: Google Badge
 * Plugin URI: http://bk-ninja.com/
 * Description: This widget displays the google badge in the sidebar.
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_googlebadge_widget');

function bk_register_googlebadge_widget()
{
	register_widget('bk_googlebadge');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class bk_googlebadge extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget-googlebadge', 'description' => __('[Sidebar widget] Displays google badge box in sidebar.','bkninja'));
		
		/* Create the widget. */
		parent::__construct('bk_googlebadge', __('*BK: Widget Google Badge','bkninja'), $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance)
	{
		
		extract($args);
 		$title = $instance['title'];
		$gg_profileid = $instance['gg_profileid'];
		$layout = $instance['layout'];
		$coverphoto = $instance['coverphoto'];
        if($coverphoto == 'on'){
            $showcoverphoto = 'true';
        }else{
            $showcoverphoto = 'false';
        }
        
		$theme = $instance['theme'];
        
		echo $before_widget;
		if ( $title )
		echo $before_title . $title . $after_title;
		?>
            <div id="gplus-badge" class="g-person" data-href="https://plus.google.com/<?php echo $gg_profileid;?>" data-layout="<?php echo $layout;?>" data-showcoverphoto="<?php echo $showcoverphoto;?>" data-theme="<?php echo $theme;?>" data-width=298></div>
		<?php 
			echo $after_widget;

	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['gg_profileid'] = $new_instance['gg_profileid'];
		$instance['layout'] = $new_instance['layout'];
		$instance['coverphoto'] = $new_instance['coverphoto'];
		$instance['theme'] = $new_instance['theme'];
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance)
	{
		$defaults = array( 'title' => 'Find us on google', 'gg_profileid' => '', 'layout' => '', 'coverphoto' => 'on', 'theme' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e('Title:', 'bkninja'); ?></strong></label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gg_profileid' ); ?>"><strong><?php _e('Google plus profile ID:', 'bkninja'); ?></strong></label>
			<input type="text" id="<?php echo $this->get_field_id('gg_profileid'); ?>" name="<?php echo $this->get_field_name('gg_profileid'); ?>" value="<?php echo $instance['gg_profileid']; ?>" style="width:100%;" />
		</p>
        		
        <p>     
            <label for="<?php echo $this->get_field_id( 'layout' ); ?>"><strong><?php _e('Layout: ','bkninja'); ?></strong></label>    		 	
            <select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>">            
                <option value="portrait" <?php if ($instance['layout'] == 'portrait') echo 'selected="selected"'; ?>><?php _e('Portrait', 'bkninja');?></option>               
                <option value="landscape" <?php if ($instance['layout'] == 'landscape') echo 'selected="selected"'; ?>><?php _e('Landscape', 'bkninja');?></option>                   	
             </select>          
        </p>
        

        <p>     
            <label for="<?php echo $this->get_field_id( 'theme' ); ?>"><strong><?php _e('Theme: ','bkninja'); ?></strong></label>    		 	
            <select id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this->get_field_name( 'theme' ); ?>">            
                <option value="light" <?php if ($instance['theme'] == 'light') echo 'selected="selected"'; ?>>Light</option>               
                <option value="dark" <?php if ($instance['theme'] == 'dark') echo 'selected="selected"'; ?>>Dark</option>                   	
             </select>          
        </p>

        <p>
    		<input class="checkbox" type="checkbox" <?php checked( $instance['coverphoto'], 'on' ); ?> id="<?php echo $this->get_field_id( 'coverphoto' ); ?>" name="<?php echo $this->get_field_name( 'coverphoto' ); ?>" />
    		<label for="<?php echo $this->get_field_id( 'coverphoto' ); ?>"><?php _e('Show cover photo', 'bkninja'); ?></label>
		</p>
        
	<?php
	}
}
?>