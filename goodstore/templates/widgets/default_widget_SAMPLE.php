<?php
/**
 * Just a sample widget so you can see how to create widgets with default_widget
 * class
 */

class default_widget_sample extends default_widget {
	/**
	 *  Defining the widget options
	 */
     protected $options = array(
        'title' => array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',  // [[ text, check, select ]]
                // if select --> 'values' => array( array('name' = 'Some Name', 'value' = 'some_value') ),
                'default' => 'Recent Posts Widget'),
     );
	/**
	 * Registering the widget to the wordpress
	 */
    function default_widget_sample() {
		$options = array('classname' => 'default_widget_sample', 'description' => "Theme styled recent posts with optional preview image." );
		$controls = array('width' => 250, 'height' => 200);
		$this->WP_Widget('recentposts', 'Recent Post - Custom Widget', $options, $controls);
    }

	/**
	 * Printing widget, called by wordpress
	 */
    function widget($args, $instance) {
 
		

    }
}
?>