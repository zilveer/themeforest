<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 *
 **/

add_action( 'cmb2_admin_init', 'experience_template_metabox' );
function experience_template_metabox() {	
	
	// Start with an underscore to hide fields from custom fields list
	
	// ------------------ POSTS ------------------- //
	
	$post_metabox = new_cmb2_box( array(
		'id'            => 'post_options',
		'title'         => esc_html__( "Header Options", 'experience' ),
		'object_types'  => array( 'post' )
	) );
	
		// ----- NAVIGATION ----- //
		
		// Transparent Navigation Bar
		$post_metabox->add_field( array(
			'name'		=> esc_html__( "Transparent Navigation Bar", 'experience' ),
			'desc'		=> esc_html__( "Enable transparent navigation bar (when page has not been scrolled).", 'experience' ),
			'id'		=> 'experience_transparent_nav_bg',
			'type'		=> 'checkbox'
		) );
	
		// Navigation Logo
		$post_metabox->add_field( array(
			'name' 		=> esc_html__( "Navigation Logo Image", 'experience' ),
			'desc' 		=> esc_html__( "Select an alternative site logo image to show on this page. If this option is left blank the default logo set in the Theme Options screen will be used.", 'experience' ),
			'id'   		=> 'experience_alt_site_logo',
			'type' 		=> 'file'
	
		) );
		
		// Navigation Bar Text Colour
		$post_metabox->add_field( array(
			'name'		=> esc_html__( "Navigation Bar Text Colour", 'experience' ),
			'desc'		=> esc_html__( "Select the navigation text and icon colour.", 'experience' ),
			'id'		=> 'experience_transparent_nav_text_color',
			'type'		=> 'colorpicker',
			'default'	=> ''
		) );
		
		// ----- HEADER ----- //
		
		// Header Type
		$post_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Type", 'experience' ),
			'desc' 		=> esc_html__( "Select the type of header shown on this post.", 'experience' ),
			'id'   		=> 'experience_header_bg_type',
			'type' 		=> 'select',
			'options' 	=> array (				
				''			=> esc_html__( "Small", 'experience' ),
				'fill'		=> esc_html__( "Fill screen", 'experience' ),
				'none'		=> esc_html__( "None", 'experience' )
			)		
		) );
		
		// Header Colour Scheme	
		$post_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Colour Scheme", 'experience' ),
			'desc' 		=> esc_html__( "Select the header colour scheme. Colour schemes are configured on the Theme Options screen.", 'experience' ),
			'id'   		=> 'experience_header_color_scheme',
			'type' 		=> 'select',
			'options' 	=> array (
				''		=> '',
				'1'		=> esc_html__( "Colour Scheme 1", 'experience' ),
				'2'		=> esc_html__( "Colour Scheme 2", 'experience' ),
				'3'		=> esc_html__( "Colour Scheme 3", 'experience' ),
				'4'		=> esc_html__( "Colour Scheme 4", 'experience' ),
				'5'		=> esc_html__( "Colour Scheme 5", 'experience' ),
				'6'		=> esc_html__( "Colour Scheme 6", 'experience' ),
				'7'		=> esc_html__( "Colour Scheme 7", 'experience' ),
				'8'		=> esc_html__( "Colour Scheme 8", 'experience' ),
				'9'		=> esc_html__( "Colour Scheme 9", 'experience' ),
				'10'	=> esc_html__( "Colour Scheme 10", 'experience' )
			)		
		) );
		
		// Header Parallax
		$post_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Parallax", 'experience' ),
			'desc' 		=> wp_kses( __( "Enable background scrolling effect type. <br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
			'id'   		=> 'experience_header_parallax',
			'type' 		=> 'checkbox',
		) );
		
		// Header Parallax Speed
		$post_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Parallax Speed", 'experience' ),
			'desc' 		=> wp_kses( __( "Enter parallax speed ratio (Note: Default value is 1.5, min value is 1).<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
			'id'   		=> 'experience_header_parallax_speed',
			'type' 		=> 'text_small',
		) );
		
		// Header Background Image		
		$post_metabox->add_field( array(
			'name'	 	=> esc_html__( "Header Background Image", 'experience' ),
			'desc' 		=> esc_html__( "Upload an image to display in the page header.", 'experience' ),
			'id'   		=> 'experience_header_bg_image',
			'type' 		=> 'file',
		) );
		
		// Header Background Video
		$post_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Background Video", 'experience' ),
			'desc' 		=> wp_kses( __( "Enter the page URL to a YouTube video to use as the header background.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
			'id'   		=> 'experience_header_bg_video',
			'type' 		=> 'text_url',
		) );
		
		// Show Scroll Link
		$post_metabox->add_field( array(
			'name' 		=> esc_html__( "Show Scroll Link", 'experience' ),
			'desc' 		=> esc_html__( "Enable this option to show a link to scroll to the first piece of content.", 'experience' ),
			'id'   		=> 'experience_header_scroll_link',
			'type' 		=> 'checkbox',
		) );
		
	// ------------------- PAGE ------------------- //
	
	// --------- PAGE OPTIONS --------- //
	
	$page_metabox = new_cmb2_box( array(
		'id'            => 'page_options',
		'title'         => esc_html__( "Page Options", 'experience' ),
		'object_types'  => array( 'page' )
	) );
		
		// ----- NAVIGATION ----- //
		
		// Transparent Navigation Bar
		$page_metabox->add_field( array(
			'name'		=> esc_html__( "Transparent Navigation Bar", 'experience' ),
			'desc'		=> esc_html__( "Enable transparent navigation bar (when page has not been scrolled).", 'experience' ),
			'id'		=> 'experience_transparent_nav_bg',
			'type'		=> 'checkbox'
		) );
		
		// Navigation Logo
		$page_metabox->add_field( array(
			'name' 		=> esc_html__( "Navigation Logo Image", 'experience' ),
			'desc' 		=> esc_html__( "Select an alternative site logo image to show on this page. If this option is left blank the default logo set in the Theme Options screen will be used.", 'experience' ),
			'id'   		=> 'experience_alt_site_logo',
			'type'		=> 'file'
		) );
		
		// Navigation Bar Text Colour
		$page_metabox->add_field( array(
			'name'		=> esc_html__( "Navigation Bar Text Colour", 'experience' ),
			'desc'		=> esc_html__( "Select the navigation text and icon colour.", 'experience' ),
			'id'		=> 'experience_transparent_nav_text_color',
			'type'		=> 'colorpicker',
			'default'	=> '#FFFFFF'
		) );
		
		// ----- GENERAL ----- //
	
		// Show Section Scroll Links
		$page_metabox->add_field( array(
			'name' 		=> esc_html__( "Section Scroll Links", 'experience' ),
			'desc' 		=> esc_html__( "Enable this option to show links to scroll to each section of this page. For a section to have a link the Visual Composer Row must have a unique ID by setting the row's el_id parameter (set on the Row's settings screen). For the section title to display when the link is hovered over the row in the page builder must have a title parameter set.", 'experience' ),
			'id'   		=> 'experience_section_pagination',
			'type' 		=> 'checkbox',
		) );
		
		// ----- FOOTER ----- //
	
		// Hide Footer
		$page_metabox->add_field( array(
			'name' 		=> esc_html__( "Hide Footer", 'experience' ),
			'desc' 		=> esc_html__( "Enable this option to hide the site footer on this page.", 'experience' ),
			'id'   		=> 'experience_hide_footer',
			'type' 		=> 'checkbox',
		) );
	
	// ----- HEADER ----- //
	$header_metabox = new_cmb2_box( array(
		'id'        	=> 'header_options',
		'title'      	=> esc_html__( "Header Options", 'experience' ),
		'object_types'  => array( 'page' )
	) );
	
		// Header Type
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Type", 'experience' ),
			'desc' 		=> esc_html__( "Select the header type to be displayed on this page.", 'experience' ),
			'id'   		=> 'experience_header_type',
			'type' 		=> 'select',
			'options' 	=> array (
				''		 	=> esc_html__( "Image / Video", 'experience' ),					
				'slider'	=> esc_html__( "Slider", 'experience' ),
				'none'		=> esc_html__( "None", 'experience' )
			)
		) );
		
		// ----- TITLE ----- //
	
		// Page Label
		$header_metabox->add_field( array(
			'name'		=> esc_html__( "Page Label", 'experience' ),
			'desc'		=> esc_html__( "Use this option to add a small piece of text above the page title.", 'experience' ),
			'id'		=> 'experience_page_label',
			'type'		=> "text_small"
		) );
		
		// Page Title
		$header_metabox->add_field( array(
			'name'		=> esc_html__( "Page Title", 'experience' ),
			'desc'		=> esc_html__( "Use this option to output a different title on the page. If left blank the title entered at the top of the page edit screen will be used.", 'experience' ),
			'id'		=> 'experience_page_title',
			'type'		=> "text"
		) );
		
		// Page Intro
		$header_metabox->add_field( array(
			'name'		=> esc_html__( "Page Intro", 'experience' ),
			'desc'		=> esc_html__( "Enter a short page subtitle to be displayed below the page title.", 'experience' ),
			'id'		=> 'experience_page_intro',
			'type'		=> 'textarea_small'
		) );
		
		// Header Colour Scheme	
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Colour Scheme", 'experience' ),
			'desc' 		=> esc_html__( "Select the header colour scheme. Colour schemes are configured on the Theme Options screen.", 'experience' ),
			'id'   		=> 'experience_header_color_scheme',
			'type' 		=> 'select',
			'options' 	=> array (
				''		=> '',
				'1'		=> esc_html__( "Colour Scheme 1", 'experience' ),
				'2'		=> esc_html__( "Colour Scheme 2", 'experience' ),
				'3'		=> esc_html__( "Colour Scheme 3", 'experience' ),
				'4'		=> esc_html__( "Colour Scheme 4", 'experience' ),
				'5'		=> esc_html__( "Colour Scheme 5", 'experience' ),
				'6'		=> esc_html__( "Colour Scheme 6", 'experience' ),
				'7'		=> esc_html__( "Colour Scheme 7", 'experience' ),
				'8'		=> esc_html__( "Colour Scheme 8", 'experience' ),
				'9'		=> esc_html__( "Colour Scheme 9", 'experience' ),
				'10'	=> esc_html__( "Colour Scheme 10", 'experience' )
			)		
		) );
		
		// Fill Screen
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Fill Screen", 'experience' ),
			'desc' 		=> esc_html__( "Enable this option to make the header fill the browser height.", 'experience' ),
			'id'   		=> 'experience_header_fill_screen',
			'type' 		=> 'checkbox'
		) );
		
		// Header Parallax
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Parallax", 'experience' ),
			'desc' 		=> wp_kses( __( "Enable background scrolling effect type.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
			'id'   		=> 'experience_header_parallax',
			'type' 		=> 'checkbox',
		) );
		
		// Header Parallax Speed
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Parallax Speed", 'experience' ),
			'desc' 		=> wp_kses( __( "Enter parallax speed ratio (Note: Default value is 1.5, min value is 1).<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
			'id'   		=> 'experience_header_parallax_speed',
			'type' 		=> 'text_small',
		) );
		
		// Header Background Image		
		$header_metabox->add_field( array(
			'name'	 	=> esc_html__( "Header Background Image", 'experience' ),
			'desc' 		=> esc_html__( "Upload an image to display in the page header.", 'experience' ),
			'id'   		=> 'experience_header_bg_image',
			'type' 		=> 'file',
		) );
		
		// Header Background Video
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Background Video", 'experience' ),
			'desc' 		=> wp_kses( __( "Enter the page URL to a YouTube video to use as the header background.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
			'id'   		=> 'experience_header_bg_video',
			'type' 		=> 'text_url',
		) );
		
		// Show Scroll Link
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Show Scroll Link", 'experience' ),
			'desc' 		=> esc_html__( "Enable this option to show a link to scroll to the first piece of content.", 'experience' ),
			'id'   		=> 'experience_header_scroll_link',
			'type' 		=> 'checkbox',
		) );
	
		// Header Slider Start Slide
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Slider Start Slide", 'experience' ),
			'desc' 		=> esc_html__( "Enter the slide number the slider should begin on when first loaded.", 'experience' ),
			'id'   		=> 'experience_header_slider_startat',
			'type'		=> 'text_small'				
		) );
		
		// Header Slider Slideshow Speed
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Slider Slideshow Speed", 'experience' ),
			'desc' 		=> esc_html__( "Enter the duration of each slide (milliseconds)", 'experience' ),
			'id'   		=> 'experience_header_slider_slideshowspeed',
			'type'		=> 'text_small'		
		) );
		
		// Header Slider Animation Speed
		$header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Slider Animation Speed", 'experience' ),
			'desc' 		=> esc_html__( "Enter the duration of slide transition animation (milliseconds).", 'experience' ),
			'id'   		=> 'experience_header_slider_animationspeed',
			'type'		=> 'text_small'				
		) );
		
		// Slides (Repeatable)
		$group_field_id = $header_metabox->add_field( array(
			'name'		=> esc_html__( "Slides", 'experience' ),
			'desc'		=> esc_html__( "Add slides to this page's header slider", 'experience' ),
			'id'        => 'experience_header_slides',
			'type'      => 'group',
			'options'   => array(
				'group_title'   => esc_html__( "Slide {#}", 'experience' ),
				'add_button'    => esc_html__( "Add Slide", 'experience' ),
				'remove_button' => esc_html__( "Remove Slide", 'experience' ),
				'sortable'      => true,
				'closed'     	=> true
			)
		) );
			
			// Slide Colour Scheme
			$header_metabox->add_group_field( $group_field_id, array(
				'name' 			=> esc_html__( "Slide Colour Scheme", 'experience' ),
				'desc' 			=> esc_html__( "Select the slide colour scheme. Colour schemes are configured on the Theme Options screen.", 'experience' ),
				'id'   			=> 'slide_color_scheme',
				'type'			=> 'select',
				'show_option_none'	=> true,
				'options' 	=> array (					
					''		=> '',
					'1'		=> esc_html__( "Colour Scheme 1", 'experience' ),
					'2'		=> esc_html__( "Colour Scheme 2", 'experience' ),
					'3'		=> esc_html__( "Colour Scheme 3", 'experience' ),
					'4'		=> esc_html__( "Colour Scheme 4", 'experience' ),
					'5'		=> esc_html__( "Colour Scheme 5", 'experience' ),
					'6'		=> esc_html__( "Colour Scheme 6", 'experience' ),
					'7'		=> esc_html__( "Colour Scheme 7", 'experience' ),
					'8'		=> esc_html__( "Colour Scheme 8", 'experience' ),
					'9'		=> esc_html__( "Colour Scheme 9", 'experience' ),
					'10'	=> esc_html__( "Colour Scheme 10", 'experience' )
				)
			) );			
		
			// Slide Background Image
			$header_metabox->add_group_field( $group_field_id, array(
				'name' 		=> esc_html__( "Background Image", 'experience' ),
				'id'   		=> 'background_image',
				'type' 		=> 'file'
			) );
			
			// Slide Background Video
			$header_metabox->add_group_field( $group_field_id, array(
				'name' 		=> esc_html__( "Background Video", 'experience' ),
				'id'   		=> 'background_video',
				'desc'		=> wp_kses( __( "Enter the page URL to a YouTube video to use as the slide background. <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'strong' => array() ) ),
				'type' 		=> 'text_url',
			) );
			
			// Slide Label
			$header_metabox->add_group_field( $group_field_id, array(
				'name' 		=> esc_html__( "Label", 'experience' ),
				'id'   		=> 'label',
				'desc'		=> esc_html__( "Use this option to add a small piece of text above the slide title.", 'experience' ),
				'type' 		=> 'text_small'				
			) );
			
			// Slide Title
			$header_metabox->add_group_field( $group_field_id, array(
				'name' 		=> esc_html__( "Title", 'experience' ),
				'id'   		=> 'title',						
				'type' 		=> 'text'
			) );
			
			// Slide Button Text
			$header_metabox->add_group_field( $group_field_id, array(
				'name' 		=> esc_html__( "Button Text", 'experience' ),
				'id'   		=> 'button_text',
				'desc'		=> esc_html__( "Enter the text to be displayed on this slide's button.", 'experience' ),	
				'type' 		=> 'text_medium'
			) );
			
			// Slide Button URL
			$header_metabox->add_group_field( $group_field_id, array(
				'name' 		=> esc_html__( "Button URL", 'experience' ),
				'desc' 		=> esc_html__( "Enter the URL this button links to. Entering the file path to a MP4 or WebM video, or a link to a YouTube, Vimeo or Dailymotion video page will open the video in a lightbox.", 'experience' ),
				'id'   		=> 'button_url',
				'type' 		=> 'text_url'
			) );
	
	// ------------------- PORTFOLIO ITEMS ------------------- //

	// ---------- PAGE OPTIONS ---------- //
	$portfolio_metabox = new_cmb2_box( array(
		'id'        	=> 'portfolio_item_options',
		'title'     	=> esc_html__( "Page Options", 'experience' ),
		'object_types'  => array( 'portfolio' )
	) );
	
		// Page Label
		$portfolio_metabox->add_field( array(
			'name'	=> esc_html__( "Page Label", 'experience' ),
			'desc'	=> esc_html__( "Use this option to add a small piece of text above the page title.", 'experience' ),
			'id'	=> 'experience_page_label',
			'type'	=> "text_small"
		) );
		
		// Page Intro
		$portfolio_metabox->add_field( array(
			'name'	=> esc_html__( "Page Intro", 'experience' ),
			'desc'	=> esc_html__( "Enter a short page subtitle to be displayed below the page title.", 'experience' ),
			'id'	=> 'experience_page_intro',
			'type'	=> 'textarea_small'
		) );
		
		// Client
		$portfolio_metabox->add_field( array(
			'name'	=> esc_html__( "Portfolio Item Client", 'experience' ),
			'desc'	=> esc_html__( "Enter the name of the portfolio item's client. This will be displayed below the portfolio item title.", 'experience' ),
			'id'	=> 'experience_portfolio_item_client',
			'type'	=> 'text_medium'
		) );
		
		// URL
		$portfolio_metabox->add_field( array(
			'name'	=> esc_html__( "Portfolio Item Link", 'experience' ),
			'desc'	=> esc_html__( "Enter the URL of the live site related to this portfolio item. A Link will be displayed on the portfolio item.", 'experience' ),
			'id'	=> 'experience_portfolio_item_link',
			'type'	=> 'text_url'
		) );
		
		// Show Section Scroll Links
		$portfolio_metabox->add_field( array(
			'name' 		=> esc_html__( "Section Scroll Links", 'experience' ),
			'desc' 		=> esc_html__( "Enable this option to show links to scroll to each section of this page. For a section to have a link the Visual Composer Row must have a unique ID by setting the row's el_id parameter (set on the Row's settings screen). For the section title to display when the link is hovered over the row in the page builder must have a title parameter set.", 'experience' ),
			'id'   		=> 'experience_section_pagination',
			'type' 		=> 'checkbox',
		) );
	
	// ---------- HEADER ---------- //
	$portfolio_header_metabox = new_cmb2_box( array(
		'id'        	=> 'portfolio_item_header_options',
		'title'     	=> esc_html__( "Header Options", 'experience' ),
		'object_types'  => array( 'portfolio' )
	) );
		
		// -- NAVIGATION -- //

		// Transparent Navigation Bar
		$portfolio_header_metabox->add_field( array(
			'name'		=> esc_html__( "Transparent Navigation Bar", 'experience' ),
			'desc'		=> esc_html__( "Enable transparent navigation bar (when page has not been scrolled)", 'experience' ),
			'id'		=> 'experience_transparent_nav_bg',
			'type'		=> 'checkbox'
		) );
		
		// Navigation Logo
		$portfolio_header_metabox->add_field( array(
			'name' 		=> esc_html__( "Navigation Logo Image", 'experience' ),
			'desc' 		=> esc_html__( "Select an alternative site logo image to show on this page. If this option is left blank the default logo set in the Theme Options screen will be used.", 'experience' ),
			'id'   		=> 'experience_alt_site_logo',
			'type'		=> 'file'
		) );
		
		// Navigation Bar Text Colour
		$portfolio_header_metabox->add_field( array(
			'name'		=> esc_html__( "Navigation Bar Text Colour", 'experience' ),
			'desc'		=> esc_html__( "Select the navigation text and icon colour.", 'experience' ),
			'id'		=> 'experience_transparent_nav_text_color',
			'type'		=> 'colorpicker',
			'default'	=> '#FFFFFF'
		) );
		
		// -- HEADER -- //
	
		// Header Type
		$portfolio_header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Type", 'experience' ),
			'desc' 		=> esc_html__( "Select the type of header shown on this page.", 'experience' ),
			'id'   		=> 'experience_header_bg_type',
			'type' 		=> 'select',
			'options' 	=> array (				
				''			=> esc_html__( "Small", 'experience' ),
				'fill'		=> esc_html__( "Fill screen", 'experience' ),				
				'none'		=> esc_html__( "None", 'experience' )				
			)		
		) );
		
		// Header Colour Scheme
		$portfolio_header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Colour Scheme", 'experience' ),
			'desc' 		=> esc_html__( "Select the header colour scheme. Colour schemes are configured on the Theme Options screen.", 'experience' ),
			'id'   		=> 'experience_header_color_scheme',
			'type' 		=> 'select',
			'show_option_none'	=> true,
			'options' 	=> array (					
				''		=> '',
				'1'		=> esc_html__( "Colour Scheme 1", 'experience' ),
				'2'		=> esc_html__( "Colour Scheme 2", 'experience' ),
				'3'		=> esc_html__( "Colour Scheme 3", 'experience' ),
				'4'		=> esc_html__( "Colour Scheme 4", 'experience' ),
				'5'		=> esc_html__( "Colour Scheme 5", 'experience' ),
				'6'		=> esc_html__( "Colour Scheme 6", 'experience' ),
				'7'		=> esc_html__( "Colour Scheme 7", 'experience' ),
				'8'		=> esc_html__( "Colour Scheme 8", 'experience' ),
				'9'		=> esc_html__( "Colour Scheme 9", 'experience' ),
				'10'	=> esc_html__( "Colour Scheme 10", 'experience' )
			)
		) );
	
		// Header Parallax
		$portfolio_header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Parallax", 'experience' ),
			'desc' 		=> wp_kses( __( "Enable background scrolling effect type.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
			'id'   		=> 'experience_header_parallax',
			'type' 		=> 'checkbox',
		) );
		
		// Header Parallax Speed
		$portfolio_header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Parallax Speed", 'experience' ),
			'desc' 		=> wp_kses( __( "Enter parallax speed ratio (Note: Default value is 1.5, min value is 1).<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
			'id'   		=> 'experience_header_parallax_speed',
			'type' 		=> 'text_small',
		) );
		
		// Header Background Image		
		$portfolio_header_metabox->add_field( array(
			'name'	 	=> esc_html__( "Header Background Image", 'experience' ),
			'desc' 		=> esc_html__( "Upload an image to display in the page header.", 'experience' ),
			'id'   		=> 'experience_header_bg_image',
			'type' 		=> 'file',
		) );
		
		// Header Background Video
		$portfolio_header_metabox->add_field( array(
			'name' 		=> esc_html__( "Header Background Video", 'experience' ),
			'desc' 		=> wp_kses( __( "Enter the page URL to a YouTube video to use as the header background.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
			'id'   		=> 'experience_header_bg_video',
			'type' 		=> 'text_url',
		) );
		
		// Show Scroll Link
		$portfolio_header_metabox->add_field( array(
			'name' 		=> esc_html__( "Show Scroll Link", 'experience' ),
			'desc' 		=> esc_html__( "Enable this option to show a link to scroll to the first piece of content.", 'experience' ),
			'id'   		=> 'experience_header_scroll_link',
			'type' 		=> 'checkbox',
		) );

	// ---------- PREVIEW --------- //
	$portfolio_preview_metabox = new_cmb2_box( array(
		'id'        	=> 'portfolio_item_archive_options',
		'title'     	=> esc_html__( "Portfolio Archive Options", 'experience' ),
		'object_types'  => array( 'portfolio' )
	) );
	
		// Help
		$portfolio_preview_metabox->add_field( array(
			'name' 		=> false,
			'desc'		=> esc_html__( "The portfolio item's Feature Image will be used as the thumbnail image when this portfolio item is displayed on a  portfolio archive page.", 'experience' ),
			'id'		=> 'experience_portfolio_item_preview_help',
			'type' 		=> 'title'
		) );
		
		// Colour Scheme
		$portfolio_preview_metabox->add_field( array(
			'name' 		=> esc_html__( "Colour Scheme", 'experience' ),
			'desc' 		=> esc_html__( "Select the text colour scheme used for this portfolio item on portfolio archive pages. Colour schemes are configured on the Theme Options screen.", 'experience' ),
			'id'   		=> 'experience_portfolio_item_preview_color_scheme',
			'type'		=> 'select',
			'show_option_none'	=> true,
			'options' 	=> array (
				''		=> '',
				'1'		=> esc_html__( "Colour Scheme 1", 'experience' ),
				'2'		=> esc_html__( "Colour Scheme 2", 'experience' ),
				'3'		=> esc_html__( "Colour Scheme 3", 'experience' ),
				'4'		=> esc_html__( "Colour Scheme 4", 'experience' ),
				'5'		=> esc_html__( "Colour Scheme 5", 'experience' ),
				'6'		=> esc_html__( "Colour Scheme 6", 'experience' ),
				'7'		=> esc_html__( "Colour Scheme 7", 'experience' ),
				'8'		=> esc_html__( "Colour Scheme 8", 'experience' ),
				'9'		=> esc_html__( "Colour Scheme 9", 'experience' ),
				'10'	=> esc_html__( "Colour Scheme 10", 'experience' )
			)
		) );
		
}