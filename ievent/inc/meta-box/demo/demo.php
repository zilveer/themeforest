<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */
add_filter( 'rwmb_meta_boxes', 'YOUR_PREFIX_register_meta_boxes' );
/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'YOUR_PREFIX_';
	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'standard',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Standard Fields', 'ievent' ),
		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post', 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',
		// Auto save: true, false (default). Optional.
		'autosave' => true,
		// List of meta fields
		'fields' => array(
			// TEXT
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Text', 'ievent' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}text",
				// Field description (optional)
				'desc'  => esc_html__( 'Text description', 'ievent' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => esc_html__( 'Default text value', 'ievent' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => true,
			),
			// CHECKBOX
			array(
				'name' => esc_html__( 'Checkbox', 'ievent' ),
				'id'   => "{$prefix}checkbox",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 1,
			),
			// RADIO BUTTONS
			array(
				'name'    => esc_html__( 'Radio', 'ievent' ),
				'id'      => "{$prefix}radio",
				'type'    => 'radio',
				// Array of 'value' => 'Label' pairs for radio options.
				// Note: the 'value' is stored in meta field, not the 'Label'
				'options' => array(
					'value1' => esc_html__( 'Label1', 'ievent' ),
					'value2' => esc_html__( 'Label2', 'ievent' ),
				),
			),
			// SELECT BOX
			array(
				'name'     => esc_html__( 'Select', 'ievent' ),
				'id'       => "{$prefix}select",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'value1' => esc_html__( 'Label1', 'ievent' ),
					'value2' => esc_html__( 'Label2', 'ievent' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'value2',
				'placeholder' => esc_html__( 'Select an Item', 'ievent' ),
			),
			// HIDDEN
			array(
				'id'   => "{$prefix}hidden",
				'type' => 'hidden',
				// Hidden field must have predefined value
				'std'  => esc_html__( 'Hidden value', 'ievent' ),
			),
			// PASSWORD
			array(
				'name' => esc_html__( 'Password', 'ievent' ),
				'id'   => "{$prefix}password",
				'type' => 'password',
			),
			// TEXTAREA
			array(
				'name' => esc_html__( 'Textarea', 'ievent' ),
				'desc' => esc_html__( 'Textarea description', 'ievent' ),
				'id'   => "{$prefix}textarea",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
		),
		'validation' => array(
			'rules' => array(
				"{$prefix}password" => array(
					'required'  => true,
					'minlength' => 7,
				),
			),
			// optional override of default jquery.validate messages
			'messages' => array(
				"{$prefix}password" => array(
					'required'  => esc_html__( 'Password is required', 'ievent' ),
					'minlength' => esc_html__( 'Password must be at least 7 characters', 'ievent' ),
				),
			)
		)
	);
	// 2nd meta box
	$meta_boxes[] = array(
		'title' => esc_html__( 'Advanced Fields', 'ievent' ),
		'fields' => array(
			// HEADING
			array(
				'type' => 'heading',
				'name' => esc_html__( 'Heading', 'ievent' ),
				'id'   => 'fake_id', // Not used but needed for plugin
			),
			// SLIDER
			array(
				'name' => esc_html__( 'Slider', 'ievent' ),
				'id'   => "{$prefix}slider",
				'type' => 'slider',
				// Text labels displayed before and after value
				'prefix' => esc_html__( '$', 'ievent' ),
				'suffix' => esc_html__( ' USD', 'ievent' ),
				// jQuery UI slider options. See here http://api.jqueryui.com/slider/
				'js_options' => array(
					'min'   => 10,
					'max'   => 255,
					'step'  => 5,
				),
			),
			// NUMBER
			array(
				'name' => esc_html__( 'Number', 'ievent' ),
				'id'   => "{$prefix}number",
				'type' => 'number',
				'min'  => 0,
				'step' => 5,
			),
			// DATE
			array(
				'name' => esc_html__( 'Date picker', 'ievent' ),
				'id'   => "{$prefix}date",
				'type' => 'date',
				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
				'js_options' => array(
					'appendText'      => esc_html__( '(yyyy-mm-dd)', 'ievent' ),
					'dateFormat'      => esc_html__( 'yy-mm-dd', 'ievent' ),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			),
			// DATETIME
			array(
				'name' => esc_html__( 'Datetime picker', 'ievent' ),
				'id'   => $prefix . 'datetime',
				'type' => 'datetime',
				// jQuery datetime picker options.
				// For date options, see here http://api.jqueryui.com/datepicker
				// For time options, see here http://trentrichardson.com/examples/timepicker/
				'js_options' => array(
					'stepMinute'     => 15,
					'showTimepicker' => true,
				),
			),
			// TIME
			array(
				'name' => esc_html__( 'Time picker', 'ievent' ),
				'id'   => $prefix . 'time',
				'type' => 'time',
				// jQuery datetime picker options.
				// For date options, see here http://api.jqueryui.com/datepicker
				// For time options, see here http://trentrichardson.com/examples/timepicker/
				'js_options' => array(
					'stepMinute' => 5,
					'showSecond' => true,
					'stepSecond' => 10,
				),
			),
			// COLOR
			array(
				'name' => esc_html__( 'Color picker', 'ievent' ),
				'id'   => "{$prefix}color",
				'type' => 'color',
			),
			// CHECKBOX LIST
			array(
				'name' => esc_html__( 'Checkbox list', 'ievent' ),
				'id'   => "{$prefix}checkbox_list",
				'type' => 'checkbox_list',
				// Options of checkboxes, in format 'value' => 'Label'
				'options' => array(
					'value1' => esc_html__( 'Label1', 'ievent' ),
					'value2' => esc_html__( 'Label2', 'ievent' ),
				),
			),
			// EMAIL
			array(
				'name'  => esc_html__( 'Email', 'ievent' ),
				'id'    => "{$prefix}email",
				'desc'  => esc_html__( 'Email description', 'ievent' ),
				'type'  => 'email',
				'std'   => 'name@email.com',
			),
			// RANGE
			array(
				'name'  => esc_html__( 'Range', 'ievent' ),
				'id'    => "{$prefix}range",
				'desc'  => esc_html__( 'Range description', 'ievent' ),
				'type'  => 'range',
				'min'   => 0,
				'max'   => 100,
				'step'  => 5,
				'std'   => 0,
			),
			// URL
			array(
				'name'  => esc_html__( 'URL', 'ievent' ),
				'id'    => "{$prefix}url",
				'desc'  => esc_html__( 'URL description', 'ievent' ),
				'type'  => 'url',
				'std'   => 'http://google.com',
			),
			// OEMBED
			array(
				'name'  => esc_html__( 'oEmbed', 'ievent' ),
				'id'    => "{$prefix}oembed",
				'desc'  => esc_html__( 'oEmbed description', 'ievent' ),
				'type'  => 'oembed',
			),
			// SELECT ADVANCED BOX
			array(
				'name'     => esc_html__( 'Select', 'ievent' ),
				'id'       => "{$prefix}select_advanced",
				'type'     => 'select_advanced',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'value1' => esc_html__( 'Label1', 'ievent' ),
					'value2' => esc_html__( 'Label2', 'ievent' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				// 'std'         => 'value2', // Default value, optional
				'placeholder' => esc_html__( 'Select an Item', 'ievent' ),
			),
			// TAXONOMY
			array(
				'name'    => esc_html__( 'Taxonomy', 'ievent' ),
				'id'      => "{$prefix}taxonomy",
				'type'    => 'taxonomy',
				'options' => array(
					// Taxonomy name
					'taxonomy' => 'category',
					// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
					'type' => 'checkbox_list',
					// Additional arguments for get_terms() function. Optional
					'args' => array()
				),
			),
			// POST
			array(
				'name'    => esc_html__( 'Posts (Pages)', 'ievent' ),
				'id'      => "{$prefix}pages",
				'type'    => 'post',
				// Post type
				'post_type' => 'page',
				// Field type, either 'select' or 'select_advanced' (default)
				'field_type' => 'select_advanced',
				// Query arguments (optional). No settings means get all published posts
				'query_args' => array(
					'post_status' => 'publish',
					'posts_per_page' => '-1',
				)
			),
			// WYSIWYG/RICH TEXT EDITOR
			array(
				'name' => esc_html__( 'WYSIWYG / Rich Text Editor', 'ievent' ),
				'id'   => "{$prefix}wysiwyg",
				'type' => 'wysiwyg',
				// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
				'raw'  => false,
				'std'  => esc_html__( 'WYSIWYG default value', 'ievent' ),
				// Editor settings, see wp_editor() function: look4wp.com/wp_editor
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => true,
					'media_buttons' => false,
				),
			),
			// DIVIDER
			array(
				'type' => 'divider',
				'id'   => 'fake_divider_id', // Not used, but needed
			),
			// FILE UPLOAD
			array(
				'name' => esc_html__( 'File Upload', 'ievent' ),
				'id'   => "{$prefix}file",
				'type' => 'file',
			),
			// FILE ADVANCED (WP 3.5+)
			array(
				'name' => esc_html__( 'File Advanced Upload', 'ievent' ),
				'id'   => "{$prefix}file_advanced",
				'type' => 'file_advanced',
				'max_file_uploads' => 4,
				'mime_type' => 'application,audio,video', // Leave blank for all file types
			),
			// IMAGE UPLOAD
			array(
				'name' => esc_html__( 'Image Upload', 'ievent' ),
				'id'   => "{$prefix}image",
				'type' => 'image',
			),
			// THICKBOX IMAGE UPLOAD (WP 3.3+)
			array(
				'name' => esc_html__( 'Thickbox Image Upload', 'ievent' ),
				'id'   => "{$prefix}thickbox",
				'type' => 'thickbox_image',
			),
			// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
			array(
				'name'             => esc_html__( 'Plupload Image Upload', 'ievent' ),
				'id'               => "{$prefix}plupload",
				'type'             => 'plupload_image',
				'max_file_uploads' => 4,
			),
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => esc_html__( 'Image Advanced Upload', 'ievent' ),
				'id'               => "{$prefix}imgadv",
				'type'             => 'image_advanced',
				'max_file_uploads' => 4,
			),
			// BUTTON
			array(
				'id'   => "{$prefix}button",
				'type' => 'button',
				'name' => ' ', // Empty name will "align" the button to all field inputs
			),
		)
	);
	return $meta_boxes;
}
