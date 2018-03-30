<?php

// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = 'clapat_' . THEME_ID . '_theme_options';


if ( !function_exists( "clapat_bg_add_metaboxes" ) ){

    function clapat_bg_add_metaboxes( $metaboxes ) {

    $metaboxes = array();


    ////////////// Page Options //////////////
    $page_options = array();
    $page_options[] = array(
        'title'         => __('General', THEME_LANGUAGE_DOMAIN),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
        'desc'          => __('Options concerning all page templates.', THEME_LANGUAGE_DOMAIN),
        'fields'        => array(

    		array(
                'id'        => 'cpbg-opt-page-ajax-load',
                'type'      => 'switch',
                'title'     => __('Load Page With AJAX', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Loads the page using AJAX when accessed through the menu. If Yes, it will not reload the &lt;head&gt; or the scripts.', THEME_LANGUAGE_DOMAIN),
                'default'   => true,
                'on'        => 'Yes',
                'off'       => 'No'
            ),
            
			/**************************HERO SECTION OPTIONS**************************/
			array(
                'id'        => 'cpbg-opt-page-hero-type',
                'type'      => 'select',
                'title'     => __('Hero Type', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Type of the "hero" section displayed as page header. Does not apply to Contact Page Template, where "hero" section is the map.', THEME_LANGUAGE_DOMAIN),
				'options'   => array(
                    'image' => __('Image', THEME_LANGUAGE_DOMAIN),
                    'slider' => __('Slider', THEME_LANGUAGE_DOMAIN),
					'video' => __('Video', THEME_LANGUAGE_DOMAIN),
                    'none' => __('None', THEME_LANGUAGE_DOMAIN),
                ),
                'default'   => 'none'
            ),
		
			// Image Hero
			array(
                'id'        => 'cpbg-opt-page-hero-image',
                'type'      => 'media',
                'required'  => array('cpbg-opt-page-hero-type', '=', 'image'),
                'url'       => true,
                'title'     => __('Upload Hero Image', THEME_LANGUAGE_DOMAIN),
                'desc'      => '',
            ),
			
			array(
                'id'        => 'cpbg-opt-page-hero-image-overlay-color',
                'type'      => 'color',
                'required'  => array('cpbg-opt-page-hero-type', '=', 'image'),
                'title'     => __('Hero Image Overlay Color', THEME_LANGUAGE_DOMAIN),
                'subtitle'  => __('Pick an overlay color for your hero image (default: #FFFFFF).', THEME_LANGUAGE_DOMAIN),
                'transparent' => false,
                'default'   => '#FFFFFF',
                'validate'  => 'color',
            ),
			
            array(
                'id'            => 'cpbg-opt-page-hero-image-overlay-color-opacity',
                'type'          => 'slider',
                'required'  	=> array('cpbg-opt-page-hero-type', '=', 'image'),
                'title'         =>  __('Hero Image Overlay Color Opacity', THEME_LANGUAGE_DOMAIN),
                'subtitle'      => __('Specifies the opacity. From 0.0 (fully transparent) to 1.0 (fully opaque)', THEME_LANGUAGE_DOMAIN),
                'default'       => 0,
                'min'           => 0,
                'step'          => .1,
                'max'           => 1,
                'resolution'    => 0.1,
                'display_value' => 'text'
            ),
			
			array(
                'id'        => 'cpbg-opt-page-hero-image-caption',
                'type'      => 'textarea',
				'required' 	=> array('cpbg-opt-page-hero-type', '=', 'image'),
                'title'     => __('Hero Image Caption', THEME_LANGUAGE_DOMAIN),
                'subtitle'  => __('Caption displayed over hero\'s image. HTML code allowed in this field.', THEME_LANGUAGE_DOMAIN),
                'validate'  => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
				'required'  => array('cpbg-opt-page-hero-type', '=', 'image'),
            ),
		
			array(
                'id'        => 'cpbg-opt-page-hero-image-caption-position',
                'type'      => 'select',
                'title'     => __('Hero Image Caption Position', THEME_LANGUAGE_DOMAIN),
                'options'   => array(
                    'center-center' => 'Center-Center',
                    'center-left' => 'Center-Left',
                    'center-right' => 'Center-Right',
                    'bottom-center' => 'Bottom-Center',
                    'bottom-left' => 'Bottom-Left',
                    'bottom-right' => 'Bottom-Right',
                    'top-center' => 'Top-Center',
                    'top-left' => 'Top-Left',
                    'top-right' => 'Top-Right',
                ),
				'required'  => array('cpbg-opt-page-hero-type', '=', 'image'),
                'default'   => 'center-center'
            ),
		
			// Video hero
			array(
                 'id'       => 'cpbg-opt-page-hero-video-url',
                 'type'     => 'text',
                 'title'    => __( 'Video URL', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'The url of the video displayed in the hero section.', THEME_LANGUAGE_DOMAIN ),
                 'validate' => 'url',
				 'required' => array('cpbg-opt-page-hero-type', '=', 'video'),
             ),
			
			array(
                'id'        => 'cpbg-opt-page-hero-video-placeholder',
                'type'      => 'media',
                'required'  => array('cpbg-opt-page-hero-type', '=', 'video'),
                'url'       => true,
                'title'     => __('Upload Video Placeholder Image', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Video placeholder image will be displayed on mobile devices', THEME_LANGUAGE_DOMAIN),
				'required'  => array('cpbg-opt-page-hero-type', '=', 'video'),
            ),
			
			// General hero options
			array(
                'id'        => 'cpbg-opt-page-hero-position',
                'type'      => 'select',
                'title'     => __('Hero Position', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Position of the "hero" section displayed as page header.', THEME_LANGUAGE_DOMAIN),
				'options'   => array(
                    'static' => __('Static', THEME_LANGUAGE_DOMAIN),
                    'parallax' => __('Parallax', THEME_LANGUAGE_DOMAIN),
					'fixed' => __('Normal', THEME_LANGUAGE_DOMAIN)
                ),
                'default'   => 'static',
				'required'  => array( 'cpbg-opt-page-hero-type', '!=', 'none' ),
            ),
			
			array(
                'id'        => 'cpbg-opt-page-hero-scroll-opacity',
                'type'      => 'switch',
                'title'     => __('Enable Scrolling Opacity', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Enable scrolling opacity effect for hero section.', THEME_LANGUAGE_DOMAIN),
                'default'   => true,
                'on'        => 'Yes',
                'off'       => 'No',
				'required'  => array( 'cpbg-opt-page-hero-type', '!=', 'none' ),
            ),
			
			array(
                'id'        => 'cpbg-opt-page-hero-height',
                'type'      => 'select',
                'title'     => __('Hero Height', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Height of the "hero" section displayed as page header.', THEME_LANGUAGE_DOMAIN),
				'options'   => array(
                    'big' => __('Big', THEME_LANGUAGE_DOMAIN),
                    'small' => __('Small', THEME_LANGUAGE_DOMAIN),
					'full' => __('Full', THEME_LANGUAGE_DOMAIN)
                ),
                'default'   => 'big',
				'required'  => array( 'cpbg-opt-page-hero-type', '!=', 'none' ),
            ),
			
			array(
                'id'        => 'cpbg-opt-page-hero-content',
                'type'      => 'select',
                'title'     => __('Hero Content', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Type of content in "hero" section.', THEME_LANGUAGE_DOMAIN),
				'options'   => array(
                    'dark' => __('Dark', THEME_LANGUAGE_DOMAIN),
                    'light' => __('Light', THEME_LANGUAGE_DOMAIN)
                ),
                'default'   => 'dark',
				'required'  => array('cpbg-opt-page-hero-type', '=', array('image', 'slider') ),
            ),
			
			array(
                 'id'       => 'cpbg-opt-page-hero-use-main-slider',
                 'type'     => 'switch',
                 'title'    => __( 'Use Main Slider', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'Use the main slider or use other slider type.', THEME_LANGUAGE_DOMAIN ),
                 'on'       => 'Yes',
				 'off'      => 'No',
				 'default'	=> true,
                 'required' => array('cpbg-opt-page-hero-type', '=', 'slider')
            ),
			 
			array(
                 'id'       => 'cpbg-opt-page-hero-custom-slider',
                 'type'     => 'text',
                 'title'    => __( 'Your slider shortcode', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'Most of the popular slider plugins use shortcodes to insert sliders into content. Paste your shortcode here.', THEME_LANGUAGE_DOMAIN ),
                 'required' => array('cpbg-opt-page-hero-use-main-slider', '=', false)
             ),
			 
			/**************************END - HERO SECTION OPTIONS**************************/
			
			array(
                'id'        => 'cpbg-opt-page-show-title',
                'type'      => 'switch',
                'title'     => __('Show Page Title', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Shows or hides title at the top of the page.', THEME_LANGUAGE_DOMAIN),
                'default'   => true,
                'on'        => 'Yes',
                'off'       => 'No'
            ),
			
			array(
                'id'        => 'cpbg-opt-page-subtitle',
                'type'      => 'textarea',
				'title'     => __('Page Subtitle', THEME_LANGUAGE_DOMAIN),
                'subtitle'  => __('Content displayed underneath page title. HTML code allowed in this field.', THEME_LANGUAGE_DOMAIN),
                'validate'  => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
				'required'  => array('cpbg-opt-page-show-title', '=', true),
            ),
			
        ),
    );
	
	$page_options[] = array(
        'title'         => __('Portfolio Templates', THEME_LANGUAGE_DOMAIN),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-folder-open',
        'desc'          => __('Options concerning only Portfolio templates (Portfolio and Portfolio Mixed).', THEME_LANGUAGE_DOMAIN),
        'fields'        => array(

			array(
                'id'        => 'cpbg-opt-page-portfolio-columns',
                'type'      => 'select',
                'title'     => __('Portfolio Columns', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Number of portfolio items columns displayed in the portfolio page.', THEME_LANGUAGE_DOMAIN),
				'options'   => array( '2' => '2', '3' => '3' ),
                'default'   => '3'
            ),
            
            array(
                'id'        => 'cpbg-opt-page-portfolio-enable-lightbox',
                'type'      => 'switch',
                'title'     => __('Enable Lightbox Pop-up For All Projects', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Display all portfolio items as lightbox pop-ups in the portfolio page. The pop-up image can be set as \'Image Pop-up\' in portfolio item options.', THEME_LANGUAGE_DOMAIN),
				'default'   => false
            ),
			
			array(
                'id'        => 'cpbg-opt-page-portfolio-margins',
                'type'      => 'switch',
                'title'     => __('Enable Portfolio Thumbnail Margins', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Enable margins for portfolio items thumbnails displayed in portfolio page.', THEME_LANGUAGE_DOMAIN),
                'default'   => true
            ),
			
			array(
                'id'        => 'cpbg-opt-page-portfolio-hover-effect',
                'type'      => 'select',
                'title'     => __('Hover effect', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Type of hover effect over portfolio items thumbnails displayed in the portfolio page.', THEME_LANGUAGE_DOMAIN),
				'options'   => array( 'hover-black' => 'Black Hover', 
									  'hover-white' => 'White Hover',
									  'hover-gradient' => 'Gradient Hover',
									  'padding-black' => 'Padding Black',
									  'padding-white' => 'Padding White',
									  'padding-gradient' => 'Padding Gradient' ),
                'default'   => 'hover-black'
            ),
			
			array(
                'id'        => 'cpbg-opt-page-portfolio-autoconstruct',
                'type'      => 'switch',
                'title'     => __('Enable Portfolio Autoconstruct', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Show portfolio items with scrolling.', THEME_LANGUAGE_DOMAIN),
                'default'   => true
            ),
			
			array(
                'id'        => 'cpbg-opt-page-portfolio-show-filters',
                'type'      => 'switch',
                'title'     => __('Show Portfolio Filters', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Shows or hides the portfolio category filters in the portfolio page.', THEME_LANGUAGE_DOMAIN),
                'default'   => true,
				'on'        => 'Yes',
                'off'       => 'No'
            ),
			
			array(
                 'id'       => 'cpbg-opt-page-portfolio-mixed-items',
                 'type'     => 'text',
                 'title'    => __( 'Maximum Number Of Items In Portfolio Mixed', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'Available only for Portfolio Mixed Template: the maximum number of portfolio items displayed. Leave empty for ALL.', THEME_LANGUAGE_DOMAIN )
             ),
        ),
    );

        $page_options[] = array(
            'title'         => __('Contact Template', THEME_LANGUAGE_DOMAIN),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-map-marker',
            'desc'          => __('Options concerning only Contact template.', THEME_LANGUAGE_DOMAIN),
            'fields'        => array(

                array(
                    'id'        => 'cpbg-opt-page-map-position',
                    'type'      => 'select',
                    'title'     => __('Map Position', THEME_LANGUAGE_DOMAIN),
                    'desc'      => __('Position of the map section displayed as page header.', THEME_LANGUAGE_DOMAIN),
                    'options'   => array(
                        'static' => __('Static', THEME_LANGUAGE_DOMAIN),
                        'parallax' => __('Parallax', THEME_LANGUAGE_DOMAIN),
                        'fixed' => __('Normal', THEME_LANGUAGE_DOMAIN)
                    ),
                    'default'   => 'static'
                ),

                array(
                    'id'        => 'cpbg-opt-page-map-scroll-opacity',
                    'type'      => 'switch',
                    'title'     => __('Enable Scrolling Opacity', THEME_LANGUAGE_DOMAIN),
                    'desc'      => __('Enable scrolling opacity effect for map section.', THEME_LANGUAGE_DOMAIN),
                    'default'   => true,
                    'on'        => 'Yes',
                    'off'       => 'No'
                ),

                array(
                    'id'        => 'cpbg-opt-page-map-height',
                    'type'      => 'select',
                    'title'     => __('Map Height', THEME_LANGUAGE_DOMAIN),
                    'desc'      => __('Height of the map section displayed as page header.', THEME_LANGUAGE_DOMAIN),
                    'options'   => array(
                        'big' => __('Big', THEME_LANGUAGE_DOMAIN),
                        'small' => __('Small', THEME_LANGUAGE_DOMAIN),
                        'full' => __('Full', THEME_LANGUAGE_DOMAIN)
                    ),
                    'default'   => 'big'
                ),

                array(
                    'id'        => 'cpbg-opt-page-map-content',
                    'type'      => 'select',
                    'title'     => __('Content Type', THEME_LANGUAGE_DOMAIN),
                    'desc'      => __('Type of content in map section.', THEME_LANGUAGE_DOMAIN),
                    'options'   => array(
                        'dark' => __('Dark', THEME_LANGUAGE_DOMAIN),
                        'light' => __('Light', THEME_LANGUAGE_DOMAIN)
                    ),
                    'default'   => 'dark'
                ),

                array(
                    'id'        => 'cpbg-opt-page-map-toggle-contact-info',
                    'type'      => 'switch',
                    'title'     => __('Toggle Contact Info', THEME_LANGUAGE_DOMAIN),
                    'desc'      => __('Shows or hides contact info section (email, address and telephone number).', THEME_LANGUAGE_DOMAIN),
                    'default'   => false
                ),

                array(
                    'id'        => 'cpbg-opt-page-map-contact-email',
                    'type'      => 'Text',
                    'title'     => __('Email', THEME_LANGUAGE_DOMAIN),
                    'desc'      => __('Email displayed in the contact info section.', THEME_LANGUAGE_DOMAIN),
                    'default'   => false,
                    'required'  => array('cpbg-opt-page-map-toggle-contact-info', '=', true)
                ),

                array(
                    'id'        => 'cpbg-opt-page-map-contact-address',
                    'type'      => 'Text',
                    'title'     => __('Address', THEME_LANGUAGE_DOMAIN),
                    'desc'      => __('Address displayed in the contact info section.', THEME_LANGUAGE_DOMAIN),
                    'default'   => false,
                    'required'  => array('cpbg-opt-page-map-toggle-contact-info', '=', true)
                ),

                array(
                    'id'        => 'cpbg-opt-page-map-contact-phone',
                    'type'      => 'Text',
                    'title'     => __('Phone Number', THEME_LANGUAGE_DOMAIN),
                    'desc'      => __('Phone number displayed in the contact info section.', THEME_LANGUAGE_DOMAIN),
                    'default'   => false,
                    'required'  => array('cpbg-opt-page-map-toggle-contact-info', '=', true)
                ),
            ),
        );

    $metaboxes[] = array(
        'id'            => 'clapat_' . THEME_ID . '_page_options',
        'title'         => __( 'Page Options', THEME_LANGUAGE_DOMAIN ),
        'post_types'    => array( 'page' ),
        'position'      => 'normal', // normal, advanced, side
        'priority'      => 'high', // high, core, default, low
        'sidebar'       => false, // enable/disable the sidsebar in the normal/advanced positions
        'sections'      => $page_options,
    );

    $blog_post_options = array();
    $blog_post_options[] = array(

         'icon_class'    => 'icon-large',
         'icon'          => 'el-icon-wrench',
         'fields'        => array(

             /**************************HERO SECTION OPTIONS**************************/
             array(
                 'id'        => 'cpbg-opt-post-hero-type',
                 'type'      => 'select',
                 'title'     => __('Hero Type', THEME_LANGUAGE_DOMAIN),
                 'desc'      => __('Type of the "hero" section displayed as page header.', THEME_LANGUAGE_DOMAIN),
                 'options'   => array(
                     'image' => __('Image', THEME_LANGUAGE_DOMAIN),
                     'slider' => __('Slider', THEME_LANGUAGE_DOMAIN),
                     'video' => __('Video', THEME_LANGUAGE_DOMAIN),
                     'none' => __('None', THEME_LANGUAGE_DOMAIN),
                 ),
                 'default'   => 'none'
             ),

             // Image Hero
             array(
                 'id'        => 'cpbg-opt-post-hero-image',
                 'type'      => 'media',
                 'required'  => array('cpbg-opt-post-hero-type', '=', 'image'),
                 'url'       => true,
                 'title'     => __('Upload Hero Image', THEME_LANGUAGE_DOMAIN),
                 'desc'      => '',
             ),

             array(
                 'id'        => 'cpbg-opt-post-hero-image-overlay-color',
                 'type'      => 'color',
                 'required'  => array('cpbg-opt-post-hero-type', '=', 'image'),
                 'title'     => __('Hero Image Overlay Color', THEME_LANGUAGE_DOMAIN),
                 'subtitle'  => __('Pick an overlay color for your hero image (default: #FFFFFF).', THEME_LANGUAGE_DOMAIN),
                 'transparent' => false,
                 'default'   => '#FFFFFF',
                 'validate'  => 'color',
             ),

             array(
                 'id'            => 'cpbg-opt-post-hero-image-overlay-color-opacity',
                 'type'          => 'slider',
                 'required'  	=> array('cpbg-opt-post-hero-type', '=', 'image'),
                 'title'         =>  __('Hero Image Overlay Color Opacity', THEME_LANGUAGE_DOMAIN),
                 'subtitle'      => __('Specifies the opacity. From 0.0 (fully transparent) to 1.0 (fully opaque)', THEME_LANGUAGE_DOMAIN),
                 'default'       => 0,
                 'min'           => 0,
                 'step'          => .1,
                 'max'           => 1,
                 'resolution'    => 0.1,
                 'display_value' => 'text'
             ),

             array(
                 'id'        => 'cpbg-opt-post-hero-image-caption',
                 'type'      => 'textarea',
                 'required' 	=> array('cpbg-opt-post-hero-type', '=', 'image'),
                 'title'     => __('Hero Image Caption', THEME_LANGUAGE_DOMAIN),
                 'subtitle'  => __('Caption displayed over hero\'s image. HTML code allowed in this field.', THEME_LANGUAGE_DOMAIN),
                 'validate'  => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                 'required'  => array('cpbg-opt-post-hero-type', '=', 'image'),
             ),

             array(
                 'id'        => 'cpbg-opt-post-hero-image-caption-position',
                 'type'      => 'select',
                 'title'     => __('Hero Image Caption Position', THEME_LANGUAGE_DOMAIN),
                 'options'   => array(
                     'center-center' => 'Center-Center',
                     'center-left' => 'Center-Left',
                     'center-right' => 'Center-Right',
                     'bottom-center' => 'Bottom-Center',
                     'bottom-left' => 'Bottom-Left',
                     'bottom-right' => 'Bottom-Right',
                     'top-center' => 'Top-Center',
                     'top-left' => 'Top-Left',
                     'top-right' => 'Top-Right',
                 ),
                 'required'  => array('cpbg-opt-post-hero-type', '=', 'image'),
                 'default'   => 'center-center'
             ),

             // Video hero
             array(
                 'id'       => 'cpbg-opt-post-hero-video-url',
                 'type'     => 'text',
                 'title'    => __( 'Video URL', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'The url of the video displayed in the hero section.', THEME_LANGUAGE_DOMAIN ),
                 'validate' => 'url',
                 'required' => array('cpbg-opt-post-hero-type', '=', 'video'),
             ),

             array(
                 'id'        => 'cpbg-opt-post-hero-video-placeholder',
                 'type'      => 'media',
                 'required'  => array('cpbg-opt-post-hero-type', '=', 'video'),
                 'url'       => true,
                 'title'     => __('Upload Video Placeholder Image', THEME_LANGUAGE_DOMAIN),
                 'desc'      => __('Video placeholder image will be displayed on mobile devices', THEME_LANGUAGE_DOMAIN),
                 'required'  => array('cpbg-opt-post-hero-type', '=', 'video'),
             ),

             // General hero options
             array(
                 'id'        => 'cpbg-opt-post-hero-position',
                 'type'      => 'select',
                 'title'     => __('Hero Position', THEME_LANGUAGE_DOMAIN),
                 'desc'      => __('Position of the "hero" section displayed as page header.', THEME_LANGUAGE_DOMAIN),
                 'options'   => array(
                     'static' => __('Static', THEME_LANGUAGE_DOMAIN),
                     'parallax' => __('Parallax', THEME_LANGUAGE_DOMAIN),
                     'fixed' => __('Normal', THEME_LANGUAGE_DOMAIN)
                 ),
                 'default'   => 'static',
                 'required'  => array( 'cpbg-opt-post-hero-type', '!=', 'none' ),
             ),

             array(
                 'id'        => 'cpbg-opt-post-hero-scroll-opacity',
                 'type'      => 'switch',
                 'title'     => __('Enable Scrolling Opacity', THEME_LANGUAGE_DOMAIN),
                 'desc'      => __('Enable scrolling opacity effect for hero section.', THEME_LANGUAGE_DOMAIN),
                 'default'   => true,
                 'on'        => 'Yes',
                 'off'       => 'No',
                 'required'  => array( 'cpbg-opt-post-hero-type', '!=', 'none' ),
             ),

             array(
                 'id'        => 'cpbg-opt-post-hero-height',
                 'type'      => 'select',
                 'title'     => __('Hero Height', THEME_LANGUAGE_DOMAIN),
                 'desc'      => __('Height of the "hero" section displayed as page header.', THEME_LANGUAGE_DOMAIN),
                 'options'   => array(
                     'big' => __('Big', THEME_LANGUAGE_DOMAIN),
                     'small' => __('Small', THEME_LANGUAGE_DOMAIN),
                     'full' => __('Full', THEME_LANGUAGE_DOMAIN)
                 ),
                 'default'   => 'big',
                 'required'  => array( 'cpbg-opt-post-hero-type', '!=', 'none' ),
             ),

             array(
                 'id'        => 'cpbg-opt-post-hero-content',
                 'type'      => 'select',
                 'title'     => __('Hero Content', THEME_LANGUAGE_DOMAIN),
                 'desc'      => __('Type of content in "hero" section.', THEME_LANGUAGE_DOMAIN),
                 'options'   => array(
                     'dark' => __('Dark', THEME_LANGUAGE_DOMAIN),
                     'light' => __('Light', THEME_LANGUAGE_DOMAIN)
                 ),
                 'default'   => 'dark',
                 'required'  => array('cpbg-opt-post-hero-type', '=', array('image', 'slider') ),
             ),
			 
			array(
                 'id'       => 'cpbg-opt-post-hero-use-main-slider',
                 'type'     => 'switch',
                 'title'    => __( 'Use Main Slider', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'Use the main slider or use other slider type.', THEME_LANGUAGE_DOMAIN ),
                 'on'       => 'Yes',
				 'off'      => 'No',
				 'default'	=> true,
                 'required' => array('cpbg-opt-post-hero-type', '=', 'slider')
            ),
			 
			array(
                 'id'       => 'cpbg-opt-post-hero-custom-slider',
                 'type'     => 'text',
                 'title'    => __( 'Your slider shortcode', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'Most of the popular slider plugins use shortcodes to insert sliders into content. Paste your shortcode here.', THEME_LANGUAGE_DOMAIN ),
                 'required' => array('cpbg-opt-post-hero-use-main-slider', '=', false)
             ),
             /**************************END - HERO SECTION OPTIONS**************************/
         )
    );

    $metaboxes[] = array(
       'id'            => 'clapat_' . THEME_ID . '_post_options',
       'title'         => __( 'Post Options', THEME_LANGUAGE_DOMAIN ),
       'post_types'    => array( 'post' ),
       'position'      => 'normal', // normal, advanced, side
       'priority'      => 'high', // high, core, default, low
       'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
       'sections'      => $blog_post_options,
    );


    $portfolio_options = array();
    $portfolio_options[] = array(

        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
        'fields'        => array(

			array(
                'id'        => 'cpbg-opt-portfolio-thumbnail-size',
                'type'      => 'select',
                'title'     => __('Thumbnail Size', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Size of the thumbnail for this item as it appears in portfolio page. The thumbnail image is the featured image assigned for this item.', THEME_LANGUAGE_DOMAIN),
				'options'   => array(
                    'normal' => __('Normal', THEME_LANGUAGE_DOMAIN),
                    'wide' => __('Wide', THEME_LANGUAGE_DOMAIN),
					'wide-tall' => __('Wide Tall', THEME_LANGUAGE_DOMAIN),
                    'tall' => __('Tall', THEME_LANGUAGE_DOMAIN),
                ),
                'default'   => 'normal'
            ),
			
			array(
                'id'        => 'cpbg-opt-portfolio-ajax-load',
                'type'      => 'switch',
                'title'     => __('Load Portfolio Item With AJAX', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Loads the portfolio item page using AJAX when accessed through the portfolio page. If Yes, it will not reload the &lt;head&gt; or the scripts.', THEME_LANGUAGE_DOMAIN),
                'default'   => true,
                'on'        => 'Yes',
                'off'       => 'No'
            ),
            
			// Image popup
			array(
                'id'        => 'cpbg-opt-portfolio-popup-image',
                'type'      => 'media',
                'url'       => true,
                'title'     => __('Lightbox Pop-up Image', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Pop-up Image for the portfolio item when the portfolio page has \'Lightbox Pop-up For All Projects\' enabled ', THEME_LANGUAGE_DOMAIN),'',
            ),
            
            /**************************HERO SECTION OPTIONS**************************/
			array(
                'id'        => 'cpbg-opt-portfolio-hero-type',
                'type'      => 'select',
                'title'     => __('Hero Type', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Type of the "hero" section displayed as page header.', THEME_LANGUAGE_DOMAIN),
				'options'   => array(
                    'image' => __('Image', THEME_LANGUAGE_DOMAIN),
                    'slider' => __('Slider', THEME_LANGUAGE_DOMAIN),
					'video' => __('Video', THEME_LANGUAGE_DOMAIN),
                    'none' => __('None', THEME_LANGUAGE_DOMAIN),
                ),
				'default'   => 'none'
            ),
		
			// Image Hero
			array(
                'id'        => 'cpbg-opt-portfolio-hero-image',
                'type'      => 'media',
                'required'  => array('cpbg-opt-portfolio-hero-type', '=', 'image'),
                'url'       => true,
                'title'     => __('Upload Hero Image', THEME_LANGUAGE_DOMAIN),
                'desc'      => '',
            ),
			
			array(
                'id'        => 'cpbg-opt-portfolio-hero-image-overlay-color',
                'type'      => 'color',
                'required'  => array('cpbg-opt-portfolio-hero-type', '=', 'image'),
                'title'     => __('Hero Image Overlay Color', THEME_LANGUAGE_DOMAIN),
                'subtitle'  => __('Pick an overlay color for your hero image (default: #FFFFFF).', THEME_LANGUAGE_DOMAIN),
                'transparent' => false,
                'default'   => '#FFFFFF',
                'validate'  => 'color',
            ),
			
            array(
                'id'            => 'cpbg-opt-portfolio-hero-image-overlay-color-opacity',
                'type'          => 'slider',
                'required'  	=> array('cpbg-opt-portfolio-hero-type', '=', 'image'),
                'title'         =>  __('Hero Image Overlay Color Opacity', THEME_LANGUAGE_DOMAIN),
                'subtitle'      => __('Specifies the opacity. From 0.0 (fully transparent) to 1.0 (fully opaque)', THEME_LANGUAGE_DOMAIN),
                'default'       => 0,
                'min'           => 0,
                'step'          => .1,
                'max'           => 1,
                'resolution'    => 0.1,
                'display_value' => 'text'
            ),
			
			array(
                'id'        => 'cpbg-opt-portfolio-hero-image-caption',
                'type'      => 'textarea',
				'required' 	=> array('cpbg-opt-portfolio-hero-type', '=', 'image'),
                'title'     => __('Hero Image Caption', THEME_LANGUAGE_DOMAIN),
                'subtitle'  => __('Caption displayed over hero\'s image. HTML code allowed in this field.', THEME_LANGUAGE_DOMAIN),
                'validate'  => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
				'required'  => array('cpbg-opt-portfolio-hero-type', '=', 'image'),
            ),
		
			array(
                'id'        => 'cpbg-opt-portfolio-hero-image-caption-position',
                'type'      => 'select',
                'title'     => __('Hero Image Caption Position', THEME_LANGUAGE_DOMAIN),
                'options'   => array(
                    'center-center' => 'Center-Center',
                    'center-left' => 'Center-Left',
                    'center-right' => 'Center-Right',
                    'bottom-center' => 'Bottom-Center',
                    'bottom-left' => 'Bottom-Left',
                    'bottom-right' => 'Bottom-Right',
                    'top-center' => 'Top-Center',
                    'top-left' => 'Top-Left',
                    'top-right' => 'Top-Right',
                ),
				'required'  => array('cpbg-opt-portfolio-hero-type', '=', 'image'),
                'default'   => 'center-center'
            ),
		
			// Video hero
			array(
                 'id'       => 'cpbg-opt-portfolio-hero-video-url',
                 'type'     => 'text',
                 'title'    => __( 'Video URL', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'The url of the video displayed in the hero section. Only youtube videos are allowed.', THEME_LANGUAGE_DOMAIN ),
                 'validate' => 'url',
				 'required' => array('cpbg-opt-portfolio-hero-type', '=', 'video'),
             ),
			
			array(
                'id'        => 'cpbg-opt-portfolio-hero-video-placeholder',
                'type'      => 'media',
                'required'  => array('cpbg-opt-portfolio-hero-type', '=', 'video'),
                'url'       => true,
                'title'     => __('Upload Video Placeholder Image', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Video placeholder image will be displayed on mobile devices', THEME_LANGUAGE_DOMAIN),
				'required'  => array('cpbg-opt-portfolio-hero-type', '=', 'video'),
            ),
			
			// General hero options
			array(
                'id'        => 'cpbg-opt-portfolio-hero-position',
                'type'      => 'select',
                'title'     => __('Hero Position', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Position of the "hero" section displayed as page header.', THEME_LANGUAGE_DOMAIN),
				'options'   => array(
                    'static' => __('Static', THEME_LANGUAGE_DOMAIN),
                    'parallax' => __('Parallax', THEME_LANGUAGE_DOMAIN),
					'fixed' => __('Normal', THEME_LANGUAGE_DOMAIN)
                ),
                'default'   => 'static',
				'required'  => array( 'cpbg-opt-portfolio-hero-type', '!=', 'none' ),
            ),
			
			array(
                'id'        => 'cpbg-opt-portfolio-hero-scroll-opacity',
                'type'      => 'switch',
                'title'     => __('Enable Scrolling Opacity', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Enable scrolling opacity effect for hero section.', THEME_LANGUAGE_DOMAIN),
                'default'   => true,
                'on'        => 'Yes',
                'off'       => 'No',
				'required'  => array( 'cpbg-opt-portfolio-hero-type', '!=', 'none' ),
            ),
			
			array(
                'id'        => 'cpbg-opt-portfolio-hero-height',
                'type'      => 'select',
                'title'     => __('Hero Height', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Height of the "hero" section displayed as page header.', THEME_LANGUAGE_DOMAIN),
				'options'   => array(
                    'big' => __('Big', THEME_LANGUAGE_DOMAIN),
                    'small' => __('Small', THEME_LANGUAGE_DOMAIN),
					'full' => __('Full', THEME_LANGUAGE_DOMAIN)
                ),
                'default'   => 'big',
				'required'  => array( 'cpbg-opt-portfolio-hero-type', '!=', 'none' ),
            ),
			
			array(
                'id'        => 'cpbg-opt-portfolio-hero-content',
                'type'      => 'select',
                'title'     => __('Hero Content', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Type of content in "hero" section.', THEME_LANGUAGE_DOMAIN),
				'options'   => array(
                    'dark' => __('Dark', THEME_LANGUAGE_DOMAIN),
                    'light' => __('Light', THEME_LANGUAGE_DOMAIN)
                ),
                'default'   => 'dark',
				'required'  => array('cpbg-opt-portfolio-hero-type', '=', array('image', 'slider') ),
            ),
			
			array(
                 'id'       => 'cpbg-opt-portfolio-hero-use-main-slider',
                 'type'     => 'switch',
                 'title'    => __( 'Use Main Slider', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'Use the main slider or use other slider type.', THEME_LANGUAGE_DOMAIN ),
                 'on'       => 'Yes',
				 'off'      => 'No',
				 'default'	=> true,
                 'required' => array('cpbg-opt-portfolio-hero-type', '=', 'slider')
            ),
			 
			array(
                 'id'       => 'cpbg-opt-portfolio-hero-custom-slider',
                 'type'     => 'text',
                 'title'    => __( 'Your slider shortcode', THEME_LANGUAGE_DOMAIN ),
                 'subtitle' => __( 'Most of the popular slider plugins use shortcodes to insert sliders into content. Paste your shortcode here.', THEME_LANGUAGE_DOMAIN ),
                 'required' => array('cpbg-opt-portfolio-hero-use-main-slider', '=', false)
             ),
			 
			/**************************END - HERO SECTION OPTIONS**************************/
			
			array(
                'id'        => 'cpbg-opt-portfolio-show-title',
                'type'      => 'switch',
                'title'     => __('Show Page Title', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Shows or hides title at the top of the page.', THEME_LANGUAGE_DOMAIN),
                'default'   => true,
                'on'        => 'Yes',
                'off'       => 'No'
            ),
			
			array(
                'id'        => 'cpbg-opt-portfolio-subtitle',
                'type'      => 'textarea',
				'title'     => __('Page Subtitle', THEME_LANGUAGE_DOMAIN),
                'subtitle'  => __('Content displayed underneath page title. HTML code allowed in this field.', THEME_LANGUAGE_DOMAIN),
                'validate'  => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
				'required'  => array('cpbg-opt-portfolio-show-title', '=', true),
            ),


        ),
    );

    $metaboxes[] = array(
        'id'            => 'clapat_' . THEME_ID . '_portfolio_options',
        'title'         => __( 'Portfolio Item Options', THEME_LANGUAGE_DOMAIN ),
        'post_types'    => array( THEME_ID . '_portfolio' ),
        'position'      => 'normal', // normal, advanced, side
        'priority'      => 'high', // high, core, default, low
        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'      => $portfolio_options,
    );

    ////////////// Main Slider Options//////////////
    $slider_options = array();
    $slider_options[] = array(
        //'title'         => __('Add here a title if you want to show it as a section', THEME_LANGUAGE_DOMAIN),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
        'fields'        => array(

            array(
                'id'        => 'cpbg-opt-slider-image',
                'type'      => 'media',
                'url'       => true,
                'title'     => __('Upload background image for the slide', THEME_LANGUAGE_DOMAIN),
                'desc'      => '',
            ),
            array(
                'id'        => 'cpbg-opt-slider-bknd-repeat',
                'type'      => 'switch',
                'title'     => __('Background Repeat', THEME_LANGUAGE_DOMAIN),
                'default'   => 0,
                'on'        => 'Yes',
                'off'       => 'No',
            ),
            array(
                'id'            => 'cpbg-opt-slider-overlay-color',
                'type'          => 'color',
                'title'         => __('Slide Overlay Color', THEME_LANGUAGE_DOMAIN),
                'transparent'   => false,
                'default'       => '#FFFFFF',
                'validate'      => 'color',
            ),
            array(
                'id'            => 'cpbg-opt-slider-overlay-opacity',
                'type'          => 'slider',
                'title'         =>  __('Slide Overlay Color Opacity', THEME_LANGUAGE_DOMAIN),
                'subtitle'      => __('Specifies the opacity. From 0.0 (fully transparent) to 1.0 (fully opaque)', THEME_LANGUAGE_DOMAIN),
                'default'       => 0,
                'min'           => 0,
                'step'          => .1,
                'max'           => 1,
                'resolution'    => 0.1,
                'display_value' => 'text'
            ),
            array(
                'id'        => 'cpbg-opt-slider-caption-alignment',
                'type'      => 'select',
                'title'     => __('Slider Caption Alignment', THEME_LANGUAGE_DOMAIN),
                'options'   => array(
                    'center-center' => 'Center-Center',
                    'center-left' => 'Center-Left',
                    'center-right' => 'Center-Right',
                    'bottom-center' => 'Bottom-Center',
                    'bottom-left' => 'Bottom-Left',
                    'bottom-right' => 'Bottom-Right',
                    'top-center' => 'Top-Center',
                    'top-left' => 'Top-Left',
                    'top-right' => 'Top-Right',
                ),
                'default'   => 'center-center'
            ),
            array(
                'id'        => 'cpbg-opt-slider-content-type',
                'type'      => 'radio',
                'title'     => __('Content type', THEME_LANGUAGE_DOMAIN),
                'options'   => array(
                    'light' => __('Light', THEME_LANGUAGE_DOMAIN),
                    'dark' => __('Dark', THEME_LANGUAGE_DOMAIN),
                ),
                'default'   => 'dark'
            ),


        ),
    );

    $metaboxes[] = array(
        'id'            => 'clapat_' . THEME_ID . '_main_slider_options',
        'title'         => __( 'Main Slider Options', THEME_LANGUAGE_DOMAIN ),
        'post_types'    => array(  THEME_ID . '_main_slider' ),
        'position'      => 'normal', // normal, advanced, side
        'priority'      => 'high', // high, core, default, low
        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'      => $slider_options,
    );
    
    return $metaboxes;
  }

  add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'clapat_bg_add_metaboxes');

}
