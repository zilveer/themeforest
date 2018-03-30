<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

/**
 * Get the bootstrap!
 */
if ( file_exists(  get_template_directory() . '/inc/meta/init.php' ) ) {
	require_once  get_template_directory() . '/inc/meta/init.php';
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function cmb2_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

add_filter( 'cmb2_meta_boxes', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb2_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['test_metabox'] = array(
		'id'            => 'test_metabox',
		'title'         => __( 'Test Metabox', 'wpcharming' ),
		'object_types'  => array( 'page', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		'fields'        => array(
			array(
				'name'       => __( 'Test Text', 'wpcharming' ),
				'desc'       => __( 'field description (optional)', 'wpcharming' ),
				'id'         => $prefix . 'test_text',
				'type'       => 'text',
				'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			),
			array(
				'name' => __( 'Test Text Small', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_textsmall',
				'type' => 'text_small',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Test Text Medium', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_textmedium',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Website URL', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'url',
				'type' => 'text_url',
				// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Test Text Email', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'email',
				'type' => 'text_email',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Test Time', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_time',
				'type' => 'text_time',
			),
			array(
				'name' => __( 'Time zone', 'wpcharming' ),
				'desc' => __( 'Time zone', 'wpcharming' ),
				'id'   => $prefix . 'timezone',
				'type' => 'select_timezone',
			),
			array(
				'name' => __( 'Test Date Picker', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_textdate',
				'type' => 'text_date',
			),
			array(
				'name' => __( 'Test Date Picker (UNIX timestamp)', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_textdate_timestamp',
				'type' => 'text_date_timestamp',
				// 'timezone_meta_key' => $prefix . 'timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
			),
			array(
				'name' => __( 'Test Date/Time Picker Combo (UNIX timestamp)', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_datetime_timestamp',
				'type' => 'text_datetime_timestamp',
			),
			// This text_datetime_timestamp_timezone field type
			// is only compatible with PHP versions 5.3 or above.
			// Feel free to uncomment and use if your server meets the requirement
			// array(
			// 	'name' => __( 'Test Date/Time Picker/Time zone Combo (serialized DateTime object)', 'wpcharming' ),
			// 	'desc' => __( 'field description (optional)', 'wpcharming' ),
			// 	'id'   => $prefix . 'test_datetime_timestamp_timezone',
			// 	'type' => 'text_datetime_timestamp_timezone',
			// ),
			array(
				'name' => __( 'Test Money', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_textmoney',
				'type' => 'text_money',
				// 'before_field' => '£', // override '$' symbol if needed
				// 'repeatable' => true,
			),
			array(
				'name'    => __( 'Test Color Picker', 'wpcharming' ),
				'desc'    => __( 'field description (optional)', 'wpcharming' ),
				'id'      => $prefix . 'test_colorpicker',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			array(
				'name' => __( 'Test Text Area', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_textarea',
				'type' => 'textarea',
			),
			array(
				'name' => __( 'Test Text Area Small', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_textareasmall',
				'type' => 'textarea_small',
			),
			array(
				'name' => __( 'Test Text Area for Code', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_textarea_code',
				'type' => 'textarea_code',
			),
			array(
				'name' => __( 'Test Title Weeeee', 'wpcharming' ),
				'desc' => __( 'This is a title description', 'wpcharming' ),
				'id'   => $prefix . 'test_title',
				'type' => 'title',
			),
			array(
				'name'    => __( 'Test Select', 'wpcharming' ),
				'desc'    => __( 'field description (optional)', 'wpcharming' ),
				'id'      => $prefix . 'test_select',
				'type'    => 'select',
				'options' => array(
					'standard' => __( 'Option One', 'wpcharming' ),
					'custom'   => __( 'Option Two', 'wpcharming' ),
					'none'     => __( 'Option Three', 'wpcharming' ),
				),
			),
			array(
				'name'    => __( 'Test Radio inline', 'wpcharming' ),
				'desc'    => __( 'field description (optional)', 'wpcharming' ),
				'id'      => $prefix . 'test_radio_inline',
				'type'    => 'radio_inline',
				'default' => 'standard',
				'options' => array(
					'standard' => __( 'Option One', 'wpcharming' ),
					'custom'   => __( 'Option Two', 'wpcharming' ),
					'none'     => __( 'Option Three', 'wpcharming' ),
				),
			),
			array(
				'name'    => __( 'Test Radio', 'wpcharming' ),
				'desc'    => __( 'field description (optional)', 'wpcharming' ),
				'id'      => $prefix . 'test_radio',
				'type'    => 'radio',
				'options' => array(
					'option1' => __( 'Option One', 'wpcharming' ),
					'option2' => __( 'Option Two', 'wpcharming' ),
					'option3' => __( 'Option Three', 'wpcharming' ),
				),
			),
			array(
				'name'     => __( 'Test Taxonomy Radio', 'wpcharming' ),
				'desc'     => __( 'field description (optional)', 'wpcharming' ),
				'id'       => $prefix . 'text_taxonomy_radio',
				'type'     => 'taxonomy_radio',
				'taxonomy' => 'category', // Taxonomy Slug
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name'     => __( 'Test Taxonomy Select', 'wpcharming' ),
				'desc'     => __( 'field description (optional)', 'wpcharming' ),
				'id'       => $prefix . 'text_taxonomy_select',
				'type'     => 'taxonomy_select',
				'taxonomy' => 'category', // Taxonomy Slug
			),
			array(
				'name'     => __( 'Test Taxonomy Multi Checkbox', 'wpcharming' ),
				'desc'     => __( 'field description (optional)', 'wpcharming' ),
				'id'       => $prefix . 'test_multitaxonomy',
				'type'     => 'taxonomy_multicheck',
				'taxonomy' => 'post_tag', // Taxonomy Slug
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name' => __( 'Test Checkbox', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'test_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name'    => __( 'Test Multi Checkbox', 'wpcharming' ),
				'desc'    => __( 'field description (optional)', 'wpcharming' ),
				'id'      => $prefix . 'test_multicheckbox',
				'type'    => 'multicheck',
				'options' => array(
					'check1' => __( 'Check One', 'wpcharming' ),
					'check2' => __( 'Check Two', 'wpcharming' ),
					'check3' => __( 'Check Three', 'wpcharming' ),
				),
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name'    => __( 'Test wysiwyg', 'wpcharming' ),
				'desc'    => __( 'field description (optional)', 'wpcharming' ),
				'id'      => $prefix . 'test_wysiwyg',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 5, ),
			),
			array(
				'name' => __( 'Test Image', 'wpcharming' ),
				'desc' => __( 'Upload an image or enter a URL.', 'wpcharming' ),
				'id'   => $prefix . 'test_image',
				'type' => 'file',
			),
			array(
				'name'         => __( 'Multiple Files', 'wpcharming' ),
				'desc'         => __( 'Upload or add multiple images/attachments.', 'wpcharming' ),
				'id'           => $prefix . 'test_file_list',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
			array(
				'name' => __( 'oEmbed', 'wpcharming' ),
				'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'wpcharming' ),
				'id'   => $prefix . 'test_embed',
				'type' => 'oembed',
			),
		),
	);

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$meta_boxes['about_page_metabox'] = array(
		'id'           => 'about_page_metabox',
		'title'        => __( 'About Page Metabox', 'wpcharming' ),
		'object_types' => array( 'page', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
		'fields'       => array(
			array(
				'name' => __( 'Test Text', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . '_about_test_text',
				'type' => 'text',
			),
		)
	);

	/**
	 * Repeatable Field Groups
	 */
	$meta_boxes['field_group'] = array(
		'id'           => 'field_group',
		'title'        => __( 'Repeating Field Group', 'wpcharming' ),
		'object_types' => array( 'page', ),
		'fields'       => array(
			array(
				'id'          => $prefix . 'repeat_group',
				'type'        => 'group',
				'description' => __( 'Generates reusable form entries', 'wpcharming' ),
				'options'     => array(
					'group_title'   => __( 'Entry {#}', 'wpcharming' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Entry', 'wpcharming' ),
					'remove_button' => __( 'Remove Entry', 'wpcharming' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Entry Title',
						'id'   => 'title',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
					array(
						'name' => 'Description',
						'description' => 'Write a short description for this entry',
						'id'   => 'description',
						'type' => 'textarea_small',
					),
					array(
						'name' => 'Entry Image',
						'id'   => 'image',
						'type' => 'file',
					),
					array(
						'name' => 'Image Caption',
						'id'   => 'image_caption',
						'type' => 'text',
					),
				),
			),
		),
	);

	/**
	 * Metabox for the user profile screen
	 */
	$meta_boxes['user_edit'] = array(
		'id'               => 'user_edit',
		'title'            => __( 'User Profile Metabox', 'wpcharming' ),
		'object_types'     => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
		'fields'           => array(
			array(
				'name'     => __( 'Extra Info', 'wpcharming' ),
				'desc'     => __( 'field description (optional)', 'wpcharming' ),
				'id'       => $prefix . 'exta_info',
				'type'     => 'title',
				'on_front' => false,
			),
			array(
				'name'    => __( 'Avatar', 'wpcharming' ),
				'desc'    => __( 'field description (optional)', 'wpcharming' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
			),
			array(
				'name' => __( 'Facebook URL', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter URL', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Google+ URL', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'googleplusurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Linkedin URL', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'linkedinurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'User Field', 'wpcharming' ),
				'desc' => __( 'field description (optional)', 'wpcharming' ),
				'id'   => $prefix . 'user_text_field',
				'type' => 'text',
			),
		)
	);

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb2_metabox_form` helper function. See wiki for more info.
	 */
	$meta_boxes['options_page'] = array(
		'id'      => 'options_page',
		'title'   => __( 'Theme Options Metabox', 'wpcharming' ),
		'show_on' => array( 'options-page' => array( $prefix . 'theme_options', ), ),
		'fields'  => array(
			array(
				'name'    => __( 'Site Background Color', 'wpcharming' ),
				'desc'    => __( 'field description (optional)', 'wpcharming' ),
				'id'      => $prefix . 'bg_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}
