<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/********************* BEGIN EXTENDING CLASS ***********************/

/**
 * Extend RW_Meta_Box class
 * Add field type: 'taxonomy'
 */
class RW_Meta_Box_Taxonomy extends RW_Meta_Box {
	
	function add_missed_values() {
		parent::add_missed_values();
		
		// add 'multiple' option to taxonomy field with checkbox_list type
		foreach ($this->_meta_box['fields'] as $key => $field) {
			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {
				$this->_meta_box['fields'][$key]['multiple'] = true;
			}
		}
	}
	
	// show taxonomy list
	function show_field_taxonomy($field, $meta) {
		global $post;
		
		if (!is_array($meta)) $meta = (array) $meta;
		
		$this->show_field_begin($field, $meta);
		
		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);
		
		// checkbox_list
		if ('checkbox_list' == $options['type']) {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";
		
			foreach ($terms as $term) {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}
		
		$this->show_field_end($field, $meta);
	}
}

/********************* END EXTENDING CLASS ***********************/

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it
$prefix = 'netlabs_';

$meta_boxes = array();

// first meta box
$meta_boxes[] = array(
	'id' => 'calinfo',							// meta box id, unique per meta box
	'title' => 'Calendar Configuration',			// meta box title
	'pages' => array('calendars'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
	
		array(
			'name' => __('City', 'localize'),
			'id' => $prefix . 'eventcity',
			'type' => 'text',												
			'std' => '',
			'desc' => __('City were show is held', 'localize')
		),	
		array(
			'name' => __('State', 'localize'),
			'id' => $prefix . 'eventstate',
			'type' => 'text',												
			'std' => '',
			'desc' => __('State were show is held', 'localize')
		),	
		array(
			'name' => __('Google maps address', 'localize'),
			'id' => $prefix . 'eventmap',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Detailed address for Google maps', 'localize')
		),		
		array(
			'name' => __('Event Start', 'localize'),				
			'desc' => __('Date that the event will start.', 'localize'),	
			'id' => $prefix . 'datestartentry',									
			'type' => 'date',						
			'format' => 'd/mm/yy',
		),
		array(
			'name' => __('Event end', 'localize'),				
			'desc' => __('Date that the event will end. (leave open if it is a single function or do not have an end)', 'localize'),	
			'id' => $prefix . 'dateendentry',									
			'type' => 'date',						
			'format' => 'd/mm/yy',
		),
		array(
			'name' => __('Starting Time', 'localize'),
			'desc' => __('Starting time of event.', 'localize'),
			'id' => $prefix . 'timestartentry',
			'type' => 'time',						
			'format' => 'hh:mmtt',
			'amp' => 'true'
		),
		array(
			'name' => __('Recurring event', 'localize'),
			'id' => $prefix . 'recurring',
			'type' => 'select',						
			'options' => array(						
				'Never' => 'Never',
				'Every week same day' => 'Every week same day',
				'Every month same date' => 'Every month same date'
			),
			'multiple' => false,						
			'std' => array('Never'),
			'desc' => __('Select here if it is a simple recurring event.', 'localize')
		),
		array(
			'name' => __('Advanced reccuring interval', 'localize'),
			'id' => $prefix . 'recint',
			'type' => 'select',						
			'options' => array(						
				'select interval' => 'select interval',
				'First' => 'First',
				'Second' => 'Second',
				'Third' => 'Third',
				'Fourth' => 'Fourth',
				'Last' => 'Last'
			),
			'multiple' => false,						
			'std' => array('select interval'),
			'desc' => __('Additional advanced recurring events. Remember to set the simple recurring intervals to never when using this one.', 'localize')
		),
		array(
			'name' => __('Advanced reccuring weekday', 'localize'),
			'id' => $prefix . 'recday',
			'type' => 'select',						
			'options' => array(						
				'select day' => 'select day',
				'Sunday' => 'Sunday',
				'Monday' => 'Monday',
				'Tuesday' => 'Tuesday',
				'Wednesday' => 'Wednesday',
				'Thursday' => 'Thursday',
				'Friday' => 'Friday'
			),
			'multiple' => false,						
			'std' => array('select day'),
			'desc' => __('Weekday to set with the above intervals.', 'localize')
		)
	)
);

$meta_boxes[] = array(
	'id' => 'utliltyinfo',							// meta box id, unique per meta box
	'title' => 'Utility Configuration',			// meta box title
	'pages' => array('utilities'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('Utility Type', 'localize'),
			'id' => $prefix . 'linktype',
			'type' => 'select',						
			'options' => array(						
				'feedback' => 'feedback',
				'image' => 'image'
			),
			'multiple' => false,						
			'std' => array('Never'),
			'desc' => __('Select here if it is a simple recurring event.', 'localize')
		),
		array(
			'name' => __('Link to', 'localize'),
			'id' => $prefix . 'link_to',
			'type' => 'picklist',						
			'options' => array(
				'galleries' => 'galleries',
				'members' => 'members',
				'menus' => 'menus',
				'calendars' => 'calendars',								
				'page' => 'page',
				'post' => 'post'
			),
			'multiple' => false,						
			'std' => '',
			'desc' => __('Select what to link to if using an image link.', 'localize')
		)
	)
);

$meta_boxes[] = array(
	'id' => 'albuminfo',							// meta box id, unique per meta box
	'title' => 'Album Configuration',			// meta box title
	'pages' => array('albums'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('Artist Name', 'localize'),
			'id' => $prefix . 'artname',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Name of the Artist.', 'localize')
		),
		array(
			'name' => __('Link to buy 1 label', 'localize'),
			'id' => $prefix . 'ltb1label',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Label of the first link to buy. eg: Itunes, Amazon, Shop.....', 'localize')
		),
		array(
			'name' => __('Link to buy 1 address', 'localize'),
			'id' => $prefix . 'ltb1address',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Adress of the page where the album is available to buy.', 'localize')
		),
		array(
			'name' => __('Link to buy 2 label', 'localize'),
			'id' => $prefix . 'ltb2label',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Label of the second link to buy. eg: Itunes, Amazon, Shop.....', 'localize')
		),
		array(
			'name' => __('Link to buy 2 address', 'localize'),
			'id' => $prefix . 'ltb2address',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Adress of the page where the album is available to buy.', 'localize')
		)
	)
);


$meta_boxes[] = array(
	'id' => 'reminderinfo',							// meta box id, unique per meta box
	'title' => 'Reminder Configuration',			// meta box title
	'pages' => array('reminders'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('Email', 'localize'),
			'id' => $prefix . 'rememail',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Reminder email', 'localize')
		),
		array(
			'name' => __('Event id', 'localize'),
			'id' => $prefix . 'eventinfo',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Id of event that needs reminding', 'localize')
		),
		array(
			'name' => __('Event date', 'localize'),
			'id' => $prefix . 'eventdate',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Unix timestamp for the date', 'localize')
		),
		array(
			'name' => __('Reminder timespan', 'localize'),
			'id' => $prefix . 'timespan',
			'type' => 'text',												
			'std' => '',
			'desc' => __('How many days before needs reminding', 'localize')
		),
		array(
			'name' => __('Status', 'localize'),
			'id' => $prefix . 'remstatus',
			'type' => 'text',												
			'std' => '',
			'desc' => __('Was a reminder sent?', 'localize')
		)
	)
);


foreach ($meta_boxes as $meta_box) {
	new RW_Meta_Box_Taxonomy($meta_box);
}

/********************* END DEFINITION OF META BOXES ***********************/

/********************* BEGIN VALIDATION ***********************/

/**
 * Validation class
 * Define ALL validation methods inside this class
 * Use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)
 */
class RW_Meta_Box_Validate {
	function check_name($text) {
		if ($text == 'Anh Tran') {
			return 'He is Rilwis';
		}
		return $text;
	}
}

/********************* END VALIDATION ***********************/
?>
