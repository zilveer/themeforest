<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library
 */

function heartfelt_customizer_options() {

	// Theme defaults
	$primary_color   = '#5bc08c';
	$secondary_color = '#666';
	$primary_dark 	 = '#333333';
	$primary_darker  = '#111111';
	$primary_yellow  = '#fec840';
	$button_default  = '#625152';
	$white 			 = '#ffffff';

	// Categories
    $categories = get_categories();
	$cats = array();
	$i = 0;
	foreach ( $categories as $category ){
		if ( $i == 0 ){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}

	// Animations
	$animate = array(
		'none' => __('none', 'heartfelt'),
		'bounce' => __('bounce', 'heartfelt'),
		'flash' => __('flash', 'heartfelt'),
		'pulse' => __('pulse', 'heartfelt'),
		'shake' => __('shake', 'heartfelt'),
		'wobble' => __('wobble', 'heartfelt'),
		'bounceIn' => __('bounceIn', 'heartfelt'),
		'bounceInDown' => __('bounceInDown', 'heartfelt'),
		'bounceInLeft' => __('bounceInLeft', 'heartfelt'),
		'bounceInRight' => __('bounceInRight', 'heartfelt'),
		'bounceInUp' => __('bounceInUp', 'heartfelt'),
		'fadeIn' => __('fadeIn', 'heartfelt'),
		'fadeInDown' => __('fadeInDown', 'heartfelt'),
		'fadeInDownBig' => __('fadeInDownBig', 'heartfelt'),
		'fadeInLeft' => __('fadeInLeft', 'heartfelt'),
		'fadeInLeftBig' => __('fadeInLeftBig', 'heartfelt'),
		'fadeInRight' => __('fadeInRight', 'heartfelt'),
		'fadeInRightBig' => __('fadeInRightBig', 'heartfelt'),
		'fadeInUp' => __('fadeInUp', 'heartfelt'),
		'fadeInUpBig' => __('fadeInUpBig', 'heartfelt'),
		'lightSpeedIn' => __('lightSpeedIn', 'heartfelt'),
		'lightSpeedOut' => __('lightSpeedOut', 'heartfelt'),
		'rotateIn' => __('rotateIn', 'heartfelt'),
		'rotateInDownLeft' => __('rotateInDownLeft', 'heartfelt'),
		'rotateInDownRight' => __('rotateInDownRight', 'heartfelt'),
		'rotateInUpLeft' => __('rotateInUpLeft', 'heartfelt'),
		'rotateInUpRight' => __('rotateInUpRight', 'heartfelt'),
		'zoomIn' => __('zoomIn', 'heartfelt'),
		'zoomInDown' => __('zoomInDown', 'heartfelt'),
		'zoomInLeft' => __('zoomInLeft', 'heartfelt'),
		'zoomInRight' => __('zoomInRight', 'heartfelt'),
		'zoomInUp' => __('zoomInUp', 'heartfelt')
	);

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Theme Options Panel
	$panel = 'theme-options';

	$panels[] = array(
	    'id' => $panel,
	    'title' => __( 'Theme Options', 'heartfelt' ),
	    'priority' => '10'
	);

	$section = 'panel-section';

	// Typography
	$section = 'typography';
	$font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' 		=> $section,
		'title' 	=> __( 'Typography', 'heartfelt' ),
		'priority' 	=> '5',
		'panel' => $panel
	);

	$options['main_color'] = array(
		'id' 		=> 'main_color',
		'label'   	=> __( 'Main sitewide accent color', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'color',
		'default' 	=> $primary_yellow,
	);

	$options['header-font'] = array(
		'id' 		=> 'header-font',
		'label'   	=> __( 'Header Font', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'select',
		'choices' 	=> $font_choices,
		'default' 	=> 'Open Sans',
		'transport'	=> 'postMessage',
	);

	$options['paragraph-font'] = array(
		'id' 		=> 'paragraph-font',
		'label'   	=> __( 'Paragraph Font', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'select',
		'choices' 	=> $font_choices,
		'default' 	=> 'Open Sans',
		'transport'	=> 'postMessage',
	);

	// Header
	$section = 'header';

	$sections[] = array(
		'id' 			=> $section,
		'title' 		=> __( 'Header', 'heartfelt' ),
		'priority' 		=> '10',
		'description' 	=> __( 'Options for the header.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['logo_image'] = array(
		'id' 		=> 'logo_image',
		'label'   	=> __( 'Logo Image', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'image',
		'default' 	=> '',
	);

	$options['top_nav_bg'] = array(
		'id' 		=> 'top_nav_bg',
		'label'   	=> __( 'Top navigation background color', 'heartfelt' ),
		'section' 	=> $section,
		'type'   	=> 'color',
		'default' 	=> $primary_darker,
		'transport'	=> 'postMessage',
	);

	$options['bottom_nav_bg'] = array(
		'id' 		=> 'bottom_nav_bg',
		'label'   	=> __( 'Bottom navigation background color', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'color',
		'default' 	=> $primary_dark,
		'transport'	=> 'postMessage',
	);

	$options['page_loader_choice'] = array(
		'id' 		=> 'page_loader_choice',
		'label'   	=> __( 'Display page loading bar.', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'checkbox',
		'default' 	=> 0,
	);

	// Header Button
	$section = 'header-button';

	$sections[] = array(
		'id' 			=> $section,
		'title' 		=> __( 'Header: Button', 'heartfelt' ),
		'priority' 		=> '15',
		'description' 	=> __( 'Options for the header button.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['button_choice'] = array(
		'id' 		=> 'button_choice',
		'label'   	=> __( 'Display the header button.', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'checkbox',
		'default' 	=> 1,
	);

	$options['button_color'] = array(
		'id' 		=> 'button_color',
		'label'   	=> __( 'Header button color', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'color',
		'default' 	=> $primary_yellow,
		'transport'	=> 'postMessage',

	);

	$options['button_text_color'] = array(
		'id' 		=> 'button_text_color',
		'label'   	=> __( 'Header button text color', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'color',
		'default' 	=> $button_default,
		'transport'	=> 'postMessage',
	);

	$options['button_hover_color'] = array(
		'id' 		=> 'button_hover_color',
		'label'   	=> __( 'Header button hover color', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'color',
		'default' 	=> $white,
	);

	$options['button_text'] = array(
		'id' 		=> 'button_text',
		'label'   	=> __( 'Text in the header button.', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'text',
		'default' 	=> 'Donate',
		'transport'	=> 'postMessage',
	);

	$options['button_page'] = array(
		'id' 		=> 'button_page',
		'label'   	=> __( 'Page content linked to when button is clicked.', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'dropdown-pages',
		'default' 	=> '',
	);

	$options['donate_modal'] = array(
		'id' 	  => 'donate_modal',
		'label'   => __( 'Display donation page content in a modal window.', 'heartfelt' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);

	$options['button_animate'] = array(
		'id' 	  => 'button_animate',
		'label'   => __( 'Donation button animation effect', 'heartfelt' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $animate,
		'default' => 'none',
	);

	// Home Hero
	$section = 'home-hero';

	$sections[] = array(
		'id' 			=> $section,
		'title' 		=> __( 'Home: Hero', 'heartfelt' ),
		'priority' 		=> '20',
		'description' 	=> __( 'Options for the home hero section.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['home_hero_choice'] = array(
		'id'	  => 'home_hero_choice',
		'label'   => __( 'Display the Home Hero section', 'heartfelt' ),
		'section' => $section,
		'type'    => 'checkbox',
	);

	$options['hero_page'] = array(
		'id' 	  => 'hero_page',
		'label'   => __( 'Hero Section Page', 'heartfelt' ),
		'section' => $section,
		'type'    => 'dropdown-pages',
		'default' => '',
	);

	// Home Hero Widgets
	$section = 'hero-widgets';

	$sections[] = array(
		'id' 			=> $section,
		'title' 		=> __( 'Home: Hero Widgets', 'heartfelt' ),
		'priority' 		=> '25',
		'description' 	=> __( 'Options for the home hero widgets section.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['hero_widgets_animate'] = array(
		'id' 	  => 'hero_widgets_animate',
		'label'   => __( 'Top Widgets Animation Effect', 'heartfelt' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $animate,
		'default' => 'fadeIn',
	);

	$options['hero_widgets_bg_color'] = array(
		'id' 		=> 'hero_widgets_bg_color',
		'label'   	=> __( 'Top Widgets background color', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'color',
		'default' 	=> $primary_dark,
		'transport'	=> 'postMessage',
	);

	$options['hero_text_hover_color'] = array(
		'id' 	  => 'hero_text_hover_color',
		'label'   => __( 'Top Widgets text accent color', 'heartfelt' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_yellow,
	);

	// Home Blog
	$section = 'home-blog';

	$sections[] = array(
		'id' 			=> $section,
		'title' 		=> __( 'Home: Blog', 'heartfelt' ),
		'priority' 		=> '30',
		'description' 	=> __( 'Options for the home blog section.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['blog_section_choice'] = array(
		'id' 	  => 'blog_section_choice',
		'label'   => __( 'Display the Home Posts section', 'heartfelt' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['home_blog_title'] = array(
		'id' 		=> 'home_blog_title',
		'label'   	=> __( 'Title for the Home Posts section', 'heartfelt' ),
		'section' 	=> $section,
		'type'    	=> 'text',
		'default' 	=> 'Recent News & Posts',
		'transport'	=> 'postMessage',
	);

	$options['home_blog_subtitle'] = array(
		'id' => 'home_blog_subtitle',
		'label'   => __( 'Sub-Title for the Home Posts section', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'Learn about what&apos;s going on and keep up to date.',
		'transport'	=> 'postMessage',
	);

	$options['home_blog_link'] = array(
		'id' => 'home_blog_link',
		'label'   => __( 'Link to the blog page', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '#',
	);

	$options['home_blog_button_text'] = array(
		'id' => 'home_blog_button_text',
		'label'   => __( 'Text for the Home Posts section link', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'Read More ',
		'transport'	=> 'postMessage',
	);

	$options['home_blog_bg_image'] = array(
		'id' => 'home_blog_bg_image',
		'label'   => __( 'Blog Section background image', 'heartfelt' ),
		'section' => $section,
		'type'    => 'image',
		'default' => '',
	);

	$options['home_blog_bg_color'] = array(
		'id' => 'home_blog_bg_color',
		'label'   => __( 'Background color', 'heartfelt' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_dark,
		'transport'	=> 'postMessage',
	);

	$options['home_blog_category'] = array(
		'id' => 'home_blog_category',
		'label'   => __( 'Blog posts category.', 'heartfelt' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $cats,
	);

	$options['home_blog_qty'] = array(
		'id' => 'home_blog_qty',
		'label'   => __( 'Maximum number of blog posts to display', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '12',
	);

	$options['blog_animate'] = array(
		'id' => 'blog_animate',
		'label'   => __( 'Blog section animation effect', 'heartfelt' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $animate,
		'default' => 'none',
	);

	// Home Shop
	$section = 'home-shop';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Home: Shop', 'heartfelt' ),
		'priority' => '35',
		'description' => __( 'Options for the home shop section.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['shop_section_choice'] = array(
		'id' => 'shop_section_choice',
		'label'   => __( 'Display the Home Shop section', 'heartfelt' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);

	$options['home_shop_title'] = array(
		'id' => 'home_shop_title',
		'label'   => __( 'Title for the Home Shop section', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'Shop and Support Us',
		'transport'	=> 'postMessage',
	);

	$options['home_shop_subtitle'] = array(
		'id' => 'home_shop_subtitle',
		'label'   => __( 'Sub-Title for the Home Shop section', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'All of the proceeds from your purchase benefit our cause.',
		'transport'	=> 'postMessage',
	);

	$options['home_shop_link'] = array(
		'id' => 'home_shop_link',
		'label'   => __( 'Link to the shop page', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '#',
	);

	$options['home_shop_link_text'] = array(
		'id' => 'home_shop_link_text',
		'label'   => __( 'Text for the Home Shop section link', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'Read More',
	);

	$options['home_shop_animate'] = array(
		'id' => 'home_shop_animate',
		'label'   => __( 'Shop section animation effect', 'heartfelt' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $animate,
		'default' => 'none',
	);

	// Forum
	$section = 'forum';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Forum', 'heartfelt' ),
		'priority' => '40',
		'description' => __( 'Main title for the forum page.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['forum_title'] = array(
		'id' => 'forum_title',
		'label'   => __( 'Title to main forums page', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'Community Forums',
		'transport'	=> 'postMessage',
	);

	// Contact
	$section = 'contact';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Contact Page', 'heartfelt' ),
		'priority' => '40',
		'description' => __( 'To use the Google Map, activate the <a href="https://wordpress.org/plugins/rescue-shortcodes/">Rescue Shortcodes plugin</a>,and get a Google API key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">Get API key</a>', 'heartfelt' ),
		'panel' => $panel
	);

	$options['map_choice'] = array(
		'id' => 'map_choice',
		'label'   => __( 'Select to display Google Map on the contact page.', 'heartfelt' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);

	$options['map_location'] = array(
		'id' => 'map_location',
		'label'   => __( 'Map Location', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '5046 S Greenwood Ave, Chicago IL 60615',
	);

	$options['map_height'] = array(
		'id' => 'map_height',
		'label'   => __( 'Map Height (px)', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '500',
	);

	$options['map_title'] = array(
		'id' => 'map_title',
		'label'   => __( 'Map Title', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'Rescue Themes Offices',
	);

	$options['map_zoom'] = array(
		'id' => 'map_zoom',
		'label'   => __( 'Map Zoom', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '14',
	);

	$options['google_map_api_key'] = array(
		'id' => 'google_map_api_key',
		'label'   => __( 'Google Map API Key', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '',
		'panel' => 'theme_options',
	);
	
	// Footer
	$section = 'footer';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer', 'heartfelt' ),
		'priority' => '45',
		'description' => __( 'Options for the footer section.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['footer_section_choice'] = array(
		'id' => 'footer_section_choice',
		'label'   => __( 'Display the footer widgets section', 'heartfelt' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['footer_copyright'] = array(
		'id' => 'footer_copyright',
		'label'   => __( 'Enter copyright text', 'heartfelt' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => '<a href="https://rescuethemes.com">Rescue Themes</a>. All Rights Reserved.',
		'transport'	=> 'postMessage',
	);

	// Footer Button
	$section = 'footer-button';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer: Button', 'heartfelt' ),
		'priority' => '50',
		'description' => __( 'Options for the footer button.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['footer_button_choice'] = array(
		'id' => 'footer_button_choice',
		'label'   => __( 'Display the footer button', 'heartfelt' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['footer_button_color'] = array(
		'id' => 'footer_button_color',
		'label'   => __( 'Footer button color', 'heartfelt' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_yellow,
		'transport'	=> 'postMessage',
	);

	$options['footer_button_text_color'] = array(
		'id' => 'footer_button_text_color',
		'label'   => __( 'Footer button text color', 'heartfelt' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $button_default,
		'transport'	=> 'postMessage',
	);

	$options['footer_button_link'] = array(
		'id' => 'footer_button_link',
		'label'   => __( 'Link for the footer button', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '#'
	);

	$options['footer_button_text'] = array(
		'id' => 'footer_button_text',
		'label'   => __( 'Text for the footer button', 'heartfelt' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'Donate Now',
		'transport'	=> 'postMessage',
	);

    $options['footer_button_animate'] = array(
        'id' => 'footer_button_animate',
        'label'   => __( 'Footer button Animation Effect', 'heartfelt' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $animate,
        'default' => 'none',
    );

	// Custom CSS
	$section = 'custom-css';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Custom CSS', 'heartfelt' ),
		'priority' => '60',
		'description' => __( 'Input area for custom CSS.', 'heartfelt' ),
		'panel' => $panel
	);

	$options['custom_css_textarea'] = array(
		'id' => 'custom_css_textarea',
		'label'   => __( 'Enter any custom CSS here', 'heartfelt' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => ''
	);
 
	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'heartfelt_customizer_options' );
