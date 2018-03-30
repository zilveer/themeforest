<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'simplekey_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category SimpleKey
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */


/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function simplekey_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function simplekey_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function simplekey_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'simplekey_register_page_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function simplekey_register_page_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$suffix = '_value';

	/**
	 * Custom Page Settings
	 */
	$cmb_simplekey_page_setting = new_cmb2_box( array(
		'id'            => 'page_setting_metabox',
		'title'         => esc_html__( 'Custom Page Settings', 'SimpleKey' ),
		'object_types'  => array( 'page'), // Post type
		'priority'   => 'high',
	) );

	
	$cmb_simplekey_page_setting->add_field( array(
		'name'             => esc_html__( 'Hide Title', 'SimpleKey' ),
		'desc'             => esc_html__( 'Hide the title for the current page.', 'SimpleKey' ),
		'id'               => 'hide_title'.$suffix,
		'type'             => 'select',
	    'options' => array(
	        'No'=>'No','Yes'=>'Yes' // Hide the text input for the url
	    )
	) );

	$cmb_simplekey_page_setting->add_field( array(
		'name'             => esc_html__( 'Page main heading', 'SimpleKey' ),
		'desc'             => esc_html__( 'Replace to the default page title.', 'SimpleKey' ),
		'id'               => 'page_mainheading'.$suffix,
		'type'             => 'text'
	) );

	$cmb_simplekey_page_setting->add_field( array(
		'name'             => esc_html__( 'Page SubHeading', 'SimpleKey' ),
		'desc'             => esc_html__( 'Replace to the default page title.', 'SimpleKey' ),
		'id'               => 'page_subHeading'.$suffix,
		'type'             => 'text'
	) );

	/*$cmb_simplekey_page_setting->add_field( array(
		'name'             => esc_html__( 'Top Menu For This Page', 'SimpleKey' ),
		'desc'             => esc_html__( 'This menu will instead of the default top menu.', 'SimpleKey' ),
		'id'               => 'page_menu'.$suffix,
		'type'             => 'text'
	) );*/

	/**
	 * Custom Page Style
	 */
	$cmb_simplekey_page_style = new_cmb2_box( array(
		'id'            => 'page_style_metabox',
		'title'         => esc_html__( 'Custom Page Style', 'SimpleKey' ),
		'object_types'  => array( 'page'), // Post type
		'priority'   => 'high',
	) );

	$cmb_simplekey_page_style->add_field( array(
		'name'             => esc_html__( 'Preset Page Background Patterns', 'SimpleKey' ),
		'desc'             => esc_html__( 'Change the background patterns for the current page.', 'SimpleKey' ),
		'id'               => 'page_bgcolor'.$suffix,
		'type'             => 'select',
		"options" 		   =>array(
			'Light' => 'Light',
			'Dark'=> 'Dark',
			'Sand Paper' => 'Sand Paper',
			'Diamond' => 'Diamond',
			'Dark Cross' => 'Dark Cross',
			'Tactile Noise' => 'Tactile Noise',
			'Minium Red' => 'Minium Red',
			'Picture1' => 'Picture1',
			'Picture2' => 'Picture2',
			'Picture3' => 'Picture3'
		),
	) );

	$cmb_simplekey_page_style->add_field( array(
		'name'             => esc_html__( 'Parallax', 'SimpleKey' ),
		'desc'             => esc_html__( 'Enable the parallax background image.', 'SimpleKey' ),
		'id'               => 'page_parallax'.$suffix,
		'type'             => 'select',
		'options'		   => array('parallax'=>'Yes',''=>'No'),
		'default'		   => 'parallax'
	) );

	$cmb_simplekey_page_style->add_field( array(
		'name'             => esc_html__( 'Custom Background', 'SimpleKey' ),
		'desc'             => esc_html__( 'Use the custom background to instead of the present background pattern', 'SimpleKey' ),
		'id'               => 'page_custom'.$suffix,
		'type'             => 'select',
		'options'		   => array('No'=>'No','Yes'=>'Yes'),
		'default'		   => 'No'
	) );

	$cmb_simplekey_page_style->add_field( array(
		'name'             => esc_html__( 'Custom Background Color', 'SimpleKey' ),
		'desc'             => esc_html__( 'Change the background color for the current page.', 'SimpleKey' ),
		'id'               => 'page_custom_bgcolor'.$suffix,
		'type'             => 'colorpicker',
		"default" 		   => '#ffffff'
	) );

	$cmb_simplekey_page_style->add_field( array(
		'name'             => esc_html__( 'Custom Text Color', 'SimpleKey' ),
		'desc'             => esc_html__( 'Change the text color for the current page.', 'SimpleKey' ),
		'id'               => 'page_custom_fontcolor'.$suffix,
		'type'             => 'colorpicker',
		"default" 		   => '#000000'
	) );

	$cmb_simplekey_page_style->add_field( array(
		'name'             => esc_html__( 'Custom Background Picture', 'SimpleKey' ),
		'desc'             => esc_html__( 'Optimal width is 2000px if you want it to be fullscreen background.', 'SimpleKey' ),
		'id'               => 'page_custom_img'.$suffix,
		'type'             => 'file',
		// Optional:
	    'options' => array(
	        'url' => false, // Hide the text input for the url
	    ),
	    'text'    => array(
	        'add_upload_file_text' => esc_html__( 'Add Picture File', 'SimpleKey' ), // Change upload button text. Default: "Add or Upload File"
	    ),
	) );

	$cmb_simplekey_page_style->add_field( array(
		'name'             => esc_html__( 'Background Image Repeat', 'SimpleKey' ),
		'id'               => 'page_bg_repeat'.$suffix,
		'type'             => 'select',
		'options'		   => array('repeat'=>'repeat','no-repeat'=>'no-repeat','repeat-x'=>'repeat-x','repeat-y'=>'repeat-y'),
		'default'		   => 'no-repeat'
	) );

	$cmb_simplekey_page_style->add_field( array(
		'name'             => esc_html__( 'Background Image Fixed', 'SimpleKey' ),
		'desc'             => esc_html__( 'Fixed the image poistion when scroll down the page.', 'SimpleKey' ),
		'id'               => 'page_bg_fixed'.$suffix,
		'type'             => 'select',
		'options'		   => array('scroll'=>'scroll','fixed'=>'fixed'),
		'default'		   => 'fixed'
	) );

	$cmb_simplekey_page_style->add_field( array(
		'name'             => esc_html__( 'Fullscreen Embed Code', 'SimpleKey' ),
		'desc'             => esc_html__( 'You can embed the youtube/vimeo video or maps here with fullscreen effect to instead of the background picture and the default page content.', 'SimpleKey' ),
		'id'               => 'page_full_embed'.$suffix,
		'type'             => 'textarea_code'
	) );

	/**
	 * Portfolios Settings
	 */
	$cmb_simplekey_portfolios = new_cmb2_box( array(
		'id'            => 'portfolios_metabox',
		'title'         => esc_html__( 'Portfolio Settings', 'SimpleKey' ),
		'object_types'  => array( 'portfolio'), // Post type
		'priority'   => 'high',
	) );

	$cmb_simplekey_portfolios->add_field( array(
		'name'             => esc_html__( 'Portfolio Type', 'SimpleKey' ),
		'desc'             => esc_html__( 'Select the portfolio type. Note: if you selected Image type, just upload the pictures via "Add Photo" section below.', 'SimpleKey' ),
		'id'               => 'portfolio_type'.$suffix,
		'type'             => 'select',
		"options" 		   =>array(
			'Image' => 'Image',
			'Video'=> 'Video',
			'Audio' => 'Audio'
		),
	) );

	$cmb_simplekey_portfolios->add_field( array(
		'name'             => esc_html__( 'Hover Thumbnail', 'SimpleKey' ),
		'desc'             => esc_html__( 'The hover thumbnail will be displayed when the mouse over on the portfolio thumbnail area. The standard size: 640x640px', 'SimpleKey' ),
		'id'               => 'portfolio_hover_image'.$suffix,
		'type'             => 'file',
		// Optional:
	    'options' => array(
	        'url' => false, // Hide the text input for the url
	    ),
	    'text'    => array(
	        'add_upload_file_text' => esc_html__( 'Add Picture File', 'SimpleKey' ), // Change upload button text. Default: "Add or Upload File"
	    ),
	) );

	$cmb_simplekey_portfolios->add_field( array(
		'name'             => esc_html__( 'Hide The Gallery/Video/Audio', 'SimpleKey' ),
		'desc'             => esc_html__( 'If you want to insert the gallery,video or audio into content, please check it.', 'SimpleKey' ),
		'id'               => 'portfolio_gallery'.$suffix,
		'type'             => 'select',
		"options" 		   =>array(
			'No' => 'No',
			'Yes'=> 'Yes'
		),
		'default'		   => 'No'
	) );

	$cmb_simplekey_portfolios->add_field( array(
		'name'             => esc_html__( 'Gallery Layout', 'SimpleKey' ),
		'id'               => 'portfolio_layout'.$suffix,
		'type'             => 'select',
		"options" 		   =>array(
			'Slider' => 'Slider',
			'Grid'=> 'Grid'
		),
		'default'		   => 'Slider'
	) );

	$cmb_simplekey_portfolios->add_field( array(
		'name'             => esc_html__( 'Grid Columns', 'SimpleKey' ),
		'id'               => 'portfolio_col'.$suffix,
		'type'             => 'select',
		"options" 		   =>array(
			'3' => '3',
			'4'=> '4',
			'5'=> '5'
		),
		'default'		   => '3'
	) );

	$cmb_simplekey_portfolios->add_field( array(
		'name'             => esc_html__( 'Youtube/Vimeo Embed Code', 'SimpleKey' ),
		'id'               => 'portfolio_video'.$suffix,
		'type'             => 'textarea_code',
		'desc'			   =>'<a href="'.get_template_directory_uri().'/inc/functions/assets/images/help/video.jpg" target="_blank">'.esc_html__('How to get Youtube/Vimeo embed code?','SimpleKey').'</a>'
	) );

	$cmb_simplekey_portfolios->add_field( array(
		'name'             => esc_html__( 'SoundCloud Embed Code', 'SimpleKey' ),
		'id'               => 'portfolio_audio'.$suffix,
		'type'             => 'textarea_code',
		'desc'			   =>'<a href="'.get_template_directory_uri().'/inc/functions/assets/images/help/sc.jpg" target="_blank">'.esc_html__('How to get SoundCloud embed code?','SimpleKey').'</a>'
	) );

	$cmb_simplekey_portfolios->add_field( array(
		'name'             => esc_html__( 'External Link', 'SimpleKey' ),
		'id'               => 'portfolio_link'.$suffix,
		'type'             => 'text',
		'desc'			   => esc_html__('The page will redirected to the external website when user click the portfolio thumbnail','SimpleKey')
	) );
	
	
}