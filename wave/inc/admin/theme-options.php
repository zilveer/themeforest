<?php

/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'dd_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function dd_theme_options() {
  	
	global $dd_sn;

	/**
 	 * Get a copy of the saved settings array. 
	 */
	$saved_settings = get_option( 'option_tree_settings', array() );

	/**
	 * Custom settings array that will eventually be 
	 * passes to the OptionTree Settings API Class.
	 */
	$custom_settings = array(

		/**
		* The help text.
		*/
		'contextual_help' => array(
			'content' => array( 
				array(
					'id'      => $dd_sn . 'general_help',
					'title'   => 'General',
					'content' => '&nbsp;'
				)
			),
			'sidebar' => '&nbsp;',
		),
		/**
		* Define sections.
		*/
		'sections' => array(
			array(
				'id'    => $dd_sn . 'general',
				'title' => 'General'
			),
			array(
				'id'    => $dd_sn . 'header',
				'title' => 'Header'
			),
			array(
				'id'    => $dd_sn . 'slider',
				'title' => 'Slider'
			),
			array(
				'id'    => $dd_sn . 'homepage',
				'title' => 'Homepage'
			),
			array(
				'id'    => $dd_sn . 'footer',
				'title' => 'Footer'
			),
			array(
				'id'    => $dd_sn . 'code',
				'title' => 'Custom Code'
			),
		),
		
		/**
		 * Settings
		 */
		'settings' => array(

			/**
			 * General
			 */
			array(
				'id'      => $dd_sn . 'logo',
				'label'   => 'Logo',
				'desc'    => 'Upload the logo.',
				'std'     => '',
				'type'    => 'upload',
				'section' => $dd_sn . 'general',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'favicon',
				'label'   => 'Favicon',
				'desc'    => 'Upload the favicon. That\'s the little icon that shows up in the browser tab.',
				'std'     => '',
				'type'    => 'upload',
				'section' => $dd_sn . 'general',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'analytics',
				'label'   => 'Analytics',
				'desc'    => 'Copy your complete analytics code you got from Google Analytics or whichever analytics solution you are using.',
				'std'     => '',
				'type'    => 'textarea_simple',
				'section' => $dd_sn . 'general',
				'class'   => '',
			),

			/**
			 * Slider
			 */

			array(
				'id'      => $dd_sn . 'slider',
				'label'   => 'Slides',
				'desc'    => 'Slides to be used in the slider on the homepage.',
				'std'     => '',
				'type'    => 'list-item',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'settings' => array(
					array(
						'label' => 'Image',
						'id' => 'image',
						'type' => 'upload',
					),
					array(
						'label' => 'Description',
						'id' => 'description',
						'type' => 'textarea_simple',
					),
					array(
						'label' => 'Button - Link',
						'id' => 'link',
						'type' => 'text',
					),
					array(
						'label' => 'Button - Text',
						'id' => 'link_text',
						'type' => 'text',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'slider_overlay',
				'label'   => 'Image Darkening',
				'desc'    => 'Enable/Disable of the image darkening feature. If you have lighter images but want them to be darker in the slider enable this feature.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'slider_animation',
				'label'   => 'Animation',
				'desc'    => 'Choose the animation you want between the slides.',
				'std'     => 'slide',
				'type'    => 'select',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Slide',
						'value' => 'slide',
					),
					array(
						'label' => 'Fade',
						'value' => 'fade',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'slider_autoplay',
				'label'   => 'Autoplay',
				'desc'    => 'If you want the slider to autoplay enter the amount of miliseconds between the slides here. If you don\'t want autoplay the value should be 0.',
				'std'     => '0',
				'type'    => 'text',
				'section' => $dd_sn . 'slider',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'slider_loop',
				'label'   => 'Looping',
				'desc'    => 'Enable/Disable looping. If enabled, after the last slide the first one will be shown. If disabled, it will stop at the last slide.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'slider_arrows_mobile',
				'label'   => 'Mobile - Slider Arrows',
				'desc'    => 'Enable/Disable the arrows for the mobile version (responsive).',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),

			/**
			 * Header
			 */

			array(
				'id'      => $dd_sn . 'header_top_bar',
				'label'   => 'Top Bar',
				'desc'    => 'Enable/Disable the top bar in the header.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'header',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'header_image',
				'label'   => 'Default Header Image',
				'desc'    => 'Upload an image that will serve as the default background image for the header when a specific one isn\'t added to a post/page.',
				'std'     => '',
				'type'    => 'upload',
				'section' => $dd_sn . 'header',
				'class'   => '',
			),

			/**
			 * Footer
			 */

			array(
				'id'      => $dd_sn . 'footer_copyright',
				'label'   => 'Copyright Text',
				'desc'    => 'The copyright text that shows in the footer.',
				'std'     => '&copy; 2013 by Wave. All rights reserved.',
				'type'    => 'text',
				'section' => $dd_sn . 'footer',
				'class'   => '',
			),

			/**
			 * Homepage
			 */

			array(
				'id'      => $dd_sn . 'home_row_1',
				'label'   => 'First Row',
				'desc'    => 'Choose what do you want to show in the first row.',
				'std'     => 'gallery',
				'type'    => 'select',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					),
					array(
						'label' => 'Gallery',
						'value' => 'gallery',
					),
					array(
						'label' => 'Blog',
						'value' => 'blog',
					),
					array(
						'label' => 'Products',
						'value' => 'products',
					),
					array(
						'label' => 'Custom Content',
						'value' => 'custom',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'home_row_2',
				'label'   => 'Second Row',
				'desc'    => 'Choose what do you want to show in the second row.',
				'std'     => 'blog',
				'type'    => 'select',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					),
					array(
						'label' => 'Gallery',
						'value' => 'gallery',
					),
					array(
						'label' => 'Blog',
						'value' => 'blog',
					),
					array(
						'label' => 'Products',
						'value' => 'products',
					),
					array(
						'label' => 'Custom Content',
						'value' => 'custom',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'home_row_3',
				'label'   => 'Third Row',
				'desc'    => 'Choose what do you want to show in the third row.',
				'std'     => 'products',
				'type'    => 'select',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					),
					array(
						'label' => 'Gallery',
						'value' => 'gallery',
					),
					array(
						'label' => 'Blog',
						'value' => 'blog',
					),
					array(
						'label' => 'Products',
						'value' => 'products',
					),
					array(
						'label' => 'Custom Content',
						'value' => 'custom',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'home_row_4',
				'label'   => 'Fourth Row',
				'desc'    => 'Choose what do you want to show in the fourth row.',
				'std'     => 'disabled',
				'type'    => 'select',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					),
					array(
						'label' => 'Gallery',
						'value' => 'gallery',
					),
					array(
						'label' => 'Blog',
						'value' => 'blog',
					),
					array(
						'label' => 'Products',
						'value' => 'products',
					),
					array(
						'label' => 'Custom Content',
						'value' => 'custom',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'home_custom_content',
				'label'   => 'Custom Content',
				'desc'    => 'The custom content that you can choose to show in the rows options above.',
				'std'     => '',
				'type'    => 'textarea',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'home_gallery_amount',
				'label'   => 'Gallery - Amount of Posts',
				'desc'    => 'Amount of gallery posts to show in the gallery section.',
				'std'     => '8',
				'type'    => 'text',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'home_gallery_cats',
				'label'   => 'Gallery - Categories',
				'desc'    => 'Choose which categories to show. If none chosen all will be shown.',
				'std'     => '',
				'type'    => 'taxonomy_checkbox',
				'taxonomy' => 'dd_gallery_cats',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'home_blog_amount',
				'label'   => 'Blog - Amount of Posts',
				'desc'    => 'Amount of blog posts to show in the blog section.',
				'std'     => '5',
				'type'    => 'text',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'home_blog_cats',
				'label'   => 'Blog - Categories',
				'desc'    => 'Choose which categories to show. If none chosen all will be shown.',
				'std'     => '',
				'type'    => 'category_checkbox',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'home_products_amount',
				'label'   => 'Products - Amount of Posts',
				'desc'    => 'Amount of products to show in the products section. <strong>Note:</strong> You need to have WooCommerce installed for this section.',
				'std'     => '8',
				'type'    => 'text',
				'section' => $dd_sn . 'homepage',
				'class'   => '',
			),

			/**
			 * CODE
			 */

			array(
				'id'      => $dd_sn . 'code_css',
				'label'   => 'Custom CSS Code',
				'desc'    => 'Enter your custom CSS code here.',
				'std'     => '',
				'type'    => 'textarea_simple',
				'section' => $dd_sn . 'code',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'code_js',
				'label'   => 'Custom JavaScript Code',
				'desc'    => '<p>Enter your custom JavaScript code here.</p><p>jQuery is enabled, just make sure to wrap it within:</p>jQuery(document).ready(function($){<br>&nbsp;&nbsp;&nbsp;&nbsp;/* your code here */<br> });',
				'std'     => '',
				'type'    => 'textarea_simple',
				'section' => $dd_sn . 'code',
				'class'   => '',
			),

			
		)
	);
	  
	/* settings are not the same update the DB */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings ); 
	}
  
}