<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
    function of_options() {

        global $ish_fonts;
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, 'Select a category:');    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
        $of_pages_obj = get_pages();

        $of_pages['-1'] = __( 'Select a page', 'ishyoboy');
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_title;
        }

        //Sidebars
        $of_sidebars = array();
        foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar){
            $of_sidebars[ $sidebar['id'] ] =  $sidebar['name'];
        }

        //Menus
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false, 'taxonomy' => 'tax_nav_menu' ) );
        $of_menus = array( '' => __( 'Select a menu', 'ishyoboy') );
        foreach ( $menus as $menu ) {
            $of_menus[$menu->term_id] = $menu->name;
        }

        //Social icons
        $social_icons = '[social icon="icon-mail" url="mailto:example@example.com" tooltip="Email us"]
[social icon="icon-twitter" url="http://www.twitter.com" tooltip="Twitter - Username"]
[social icon="icon-facebook" url="http://www.facebook.com" tooltip="Facebook - Username"]';

		//Testing 
		$of_options_select = array('one','two','three','four','five'); 
		$of_options_radio = array('one' => 'One','two' => 'Two','three' => 'Three','four' => 'Four','five' => 'Five');
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> 'placebo', //REQUIRED!
				"block_one"		=> 'Block One',
				"block_two"		=> 'Block Two',
				"block_three"	=> 'Block Three',
			), 
			"enabled" => array (
				'placebo' => 'placebo', //REQUIRED!
				'block_four'	=> 'Block Four',
			),
		);

        //$googleFonts = array('none' => __( 'Select a font', 'ishyoboy') );
        $googleFonts = json_decode(ishyoboy_get_google_fonts());
        $googleFontsArray = array('none' => __( 'Select a font', 'ishyoboy') );

        foreach ($googleFonts as $key => $details) {
            $googleFontsArray[$key] = $key;
        }

        /*
        $googleVariantsArray = array();
        foreach ($googleFonts as $key => $details) {
            if ( FONT_1 == $details->family){
                foreach ($details->variants as $variant) {
                    $googleVariantsArray[$variant] = $variant;
                }
            }
        }
        /**/

        $regular_fonts = array(
            'arial'     =>  'Arial',
            'verdana'   =>  'Verdana, Geneva',
            'trebuchet' =>  'Trebuchet',
            'georgia'   =>  'Georgia',
            'times'     =>  'Times New Roman',
            'tahoma'    =>  'Tahoma, Geneva',
            'palatino'  =>  'Palatino',
            'helvetica' =>  'Helvetica'
        );

        $regular_variants = array(
            'normal'        =>  'Normal',
            'italic'        =>  'Italic',
            'bold'          =>  'Bold',
            'bold italic'   =>  'Bold Italic'
        );



        //Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
        $alt_stylesheets_imgs = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, '.php') !== false)
		            {
		                $alt_stylesheets[$alt_stylesheet_file] = ucfirst(substr($alt_stylesheet_file, 0, -4));
                        $alt_stylesheets_imgs[$alt_stylesheet_file] = IYB_TEMPLATE_URI . '/admin/layouts/' . substr($alt_stylesheet_file, 0, -4).'.png';
		            }
		        }    
		    }
		}

        asort($alt_stylesheets);
        asort($alt_stylesheets_imgs);


		//Background Images Reader
		//$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		//$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images

        $bg_images_path = IYB_HTML_DIR . '/core/images/bg-patterns'; // change this to where you store your bg images
        $bg_images_url = IYB_HTML_URI . '/core/images/bg-patterns'; // change this to where you store your bg images

        $bg_images_first = array( '' => IYB_HTML_URI . '/core/images/none.png');

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if( (stristr($bg_images_file, '.png') !== false || stristr($bg_images_file, '.jpg') !== false || stristr($bg_images_file, '.gif') !== false )) {
		                $bg_images[$bg_images_file] = $bg_images_url . '/' . $bg_images_file;
		            }
		        }    
		    }
		}

        asort($bg_images);
        $bg_images = array_merge($bg_images_first, $bg_images);
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array('Select a number:','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19');
		$body_repeat = array('no-repeat','repeat-x','repeat-y','repeat');
		$body_pos = array('top left','top center','top right','center left','center center','center right','bottom left','bottom center','bottom right');
		
		// Image Alignment radio box
		$of_options_thumb_align = array('alignleft' => 'Left','alignright' => 'Right','aligncenter' => 'Center'); 
		
		// Image Links to Options
		$of_options_image_link_to = array('image' => 'The Image','post' => 'The Post'); 


        /*-----------------------------------------------------------------------------------*/
        /* The Options Array */
        /*-----------------------------------------------------------------------------------*/

        // Set the Options Array
        global $of_options;
        $of_options = array();

        /* *********************************************************************************************************************
         * 1. General Settings
         */
        $of_options[] = array(  'name' => __( 'General Options', 'ishyoboy' ),
                                'class' => 'generaloptions',
                                'type' => 'heading');

            // PAGE WIDTH
            $of_options[] = array(  'name' => __( 'Page Width', 'ishyoboy' ),
                                    'desc' => __( 'Choose one of the pre-defined widths or enter custom one.', 'ishyoboy'),
                                    'id' => 'use_predefined_page_width',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 0,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //__( 'Page Width', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'predefined_page_width',
                                    'std' => '1290',
                                    'type' => 'radio',
                                    'fold' => 'use_predefined_page_width',
                                    'options' => array(
                                        '1290' => __( 'Wide Screen', 'ishyoboy' ) . ' (1290px)',
                                        '960' => __( 'NoteBook', 'ishyoboy' ) . ' (960px)',
                                        )
                                    );

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => 'px',
                                    'id' => 'custom_page_width',
                                    'std' => '1290',
                                    'fold' => 'off_' . 'use_predefined_page_width',
                                    'type' => 'text');

            $of_options[] = array(  'name' => __( 'Responsive layout', 'ishyoboy' ),
                                    'desc' => __( 'Make the page width fit the screen of every device or set it to never resize.', 'ishyoboy' ),
                                    'id' => 'use_responsive_layout',
                                    'std' => 1,
                                    'on' => __( 'Responsive', 'ishyoboy' ),
                                    'off' => __( 'Fixed', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( 'px - from this point the layout will change to a mobile version.', 'ishyoboy' ),
                                    'id' => 'responsive_layout_breakingpoint',
                                    'std' => IYB_BREAKINGPOINT,
                                    'fold' => 'use_responsive_layout',
                                    'type' => 'text');

            // BREADCRMBS
            $of_options[] = array(  'name' => __( 'Breadcrumbs', 'ishyoboy' ),
                                    'desc' => __( 'Display a breadcrumbs navigation in the content of each page.', 'ishyoboy' ),
                                    'id' => 'show_breadcrumbs',
                                    'std' => 0,
                                    'type' => 'switch');

            // BACK TO TOP LINK
            $of_options[] = array(  'name' => __( 'Back-to-top link', 'ishyoboy' ),
                                    'desc' => __( 'Display back to top link in the right bottom corner of each page.', 'ishyoboy' ),
                                    'id' => 'show_back_to_top',
                                    'std' => 1,
                                    'type' => 'switch');

            // PAGE SETTINGS
            $of_options[] = array(  'name' => __( 'Regular Pages Sidebar', 'ishyoboy' ),
                                    'desc' => __( "Display the sidebar on each page by default. This settings can be overridden in each page's settings.", 'ishyoboy') . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy' ) . '</span>',
                                    'id' => 'show_page_sidebar',
                                    'std' => 0,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //'name' => __( 'Regular Pages Sidebar position', 'ishyoboy' ),
                                    'desc'  => __( 'Choose whether to display the sidebar on the left or on the right side of the page.', 'ishyoboy' ),
                                    'id'    => 'page_sidebar_position',
                                    'std'   => 'right',
                                    'fold'  => 'show_page_sidebar',
                                    'type'  => 'select',
                                    'options' => array('left' => 'Left', 'right' => 'Right') );

            $of_options[] = array(  'name' => '', //'name' => __( 'Regular Pages Sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Select which sidebar will be displayed on each page by default.', 'ishyoboy' ),
                                    'id' => 'page_sidebar',
                                    'std' => 'sidebar-main',
                                    'fold' => 'show_page_sidebar',
                                    'type' => 'select',
                                    'options' => $of_sidebars);

            // 404 PAGE
            $of_options[] = array(  'name' => __( '404 Error page', 'ishyoboy' ),
                                    'desc' => __( 'Select a page to be displayed instead of the standard 404 Not Found page.', 'ishyoboy' ),
                                    'id' => 'use_page_for_404',
                                    'std' => '0',
                                    'folds' => '1',
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( 'The page which will be displayed instead of the standard 404 page.', 'ishyoboy' ),
                                    'id' => 'page_for_404',
                                    'std' => '',
                                    'fold' => 'use_page_for_404',
                                    'type' => 'select',
                                    'options' => $of_pages );

            // TRACKING
            $of_options[] = array(  'name' => __( 'Tracking Code', 'ishyoboy' ),
                                    'desc' =>  __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'ishyoboy' ),
                                    'id' => 'tracking_script',
                                    'std' => '',
                                    'type' => 'textarea');

            // ADDTHIS SHARE
            $of_options[] = array(  'name' => __( 'Social Sharing Code', 'ishyoboy' ),
                                    'desc' => __( 'Paste your addthis sharing code from https://www.addthis.com/get/sharing', 'ishyoboy' ),
                                    'id' => 'addthis_share',
                                    'std' => '<!-- AddThis Button BEGIN --><div class="addthis_toolbox addthis_default_style "><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a><a class="addthis_button_tweet"></a><a class="addthis_button_pinterest_pinit"></a><a class="addthis_counter addthis_pill_style"></a></div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script><!-- AddThis Button END -->',
                                    'type' => 'textarea');


            // CUSTOM CSS
            $of_options[] = array(  'name' => __( 'Custom CSS', 'ishyoboy' ),
                                    'desc' => __( 'Quickly add some CSS to your theme by adding it to this block.', 'ishyoboy'),
                                    'id' => 'custom_css',
                                    'std' => '',
                                    'type' => 'textarea');

            // CUSTOM SCRIPTS
            $of_options[] = array(  'name' => __( 'Custom Scripts', 'ishyoboy' ),
                                    'desc' => __( 'Quickly add some JavaScript includes to your theme by adding it to this block.', 'ishyoboy'),
                                    'id' => 'custom_scripts',
                                    'std' => '',
                                    'type' => 'textarea');

            // FAVICON
            $of_options[] = array(  'name' => __( 'Custom Favicons', 'ishyoboy' ),
                                    'desc' => __( "Upload a regular 16px x 16px png/gif/ico image that will represent your website's favicon.", 'ishyoboy' ),
                                    'id' => 'custom_favicon_16',
                                    'std' => '', //IYB_HTML_URI_USER . '/favicon.ico',
                                    'type' => 'media');

            $of_options[] = array(  'name' => '', //__( 'Custom Favicon', 'ishyoboy' ),
                                    'desc' => __( "For iPad 1, 2 - 72px x 72px png image", 'ishyoboy' ),
                                    'id' => 'custom_favicon_72',
                                    'std' => '', //IYB_HTML_URI_USER . '/apple-touch-icon.png',
                                    'type' => 'media');

            $of_options[] = array(  'name' => '', //__( 'Custom Favicon', 'ishyoboy' ),
                                    'desc' => __( "For iPhone Retina - 114px x 114px png image", 'ishyoboy' ),
                                    'id' => 'custom_favicon_114',
                                    'std' => '',
                                    'type' => 'media');

            $of_options[] = array(  'name' => '', //__( 'Custom Favicon', 'ishyoboy' ),
                                    'desc' => __( "For iPad 3 Retina - 144px x 144px png image", 'ishyoboy' ),
                                    'id' => 'custom_favicon_144',
                                    'std' => '',
                                    'type' => 'media');

        /* *********************************************************************************************************************
         * 2. Header Options
         */

        $of_options[] = array(  'name' => __( 'Header Options', 'ishyoboy' ),
            'class' => 'headeroptions',
            'type' => 'heading');


            $of_options[] = array(  'name' => __( 'Site Logo', 'ishyoboy' ),
                                    'desc' => __( 'Use image logo instead of a simple Site Title and if not empty, Tagline.', 'ishyoboy' ),
                                    'id' => 'logo_as_image',
                                    'std' => 0,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => __( ' ', 'ishyoboy' ),
                                    'desc' => __( 'Select an image for the Site Logo.', 'ishyoboy' ),
                                    'id' => 'logo_image',
                                    'std' => '',
                                    'fold' => 'logo_as_image',
                                    'mod' => 'min',
                                    'type' => 'media');

            $of_options[] = array(  'name' => __( ' ', 'ishyoboy' ),
                                    'desc' => __( 'Retina devices logo alternative - 2 times bigger than the normal logo.', 'ishyoboy' ) .'<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>The Site Logo must be set.', 'ishyoboy' ) . '</span>',
                                    'id' => 'logo_retina_image',
                                    'std' => '',
                                    'fold' => 'logo_as_image',
                                    'mod' => 'min',
                                    'type' => 'media');

            // HEADER HEIGHT
            $of_options[] = array(	'name' 		=> 'Header height',
                                    'desc' 		=> __( 'Enter the height of the header in pixels. Default is 140.', 'ishyoboy' ),
                                    'id' 		=> 'header_height',
                                    'std' 		=> 140,
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '300',
                                    'type' 		=> 'sliderui' );

            // Main Navigation Style
            $of_options[] = array(  'name' => __( 'Main Navigation style', 'ishyoboy' ),
                                    'desc' => __( 'Choose whether to display the Main navigation in Full-Height or Mini.', 'ishyoboy' ),
                                    'id' => 'mainnav_full',
                                    'std' => 1,
                                    'on' => 'Full',
                                    'off' => 'Mini',
                                    'folds' => 0,
                                    'type' => 'switch');

            // STICKY NAV
            $of_options[] = array(  'name' => __( 'Sticky Navigation', 'ishyoboy' ),
                                    'desc' => __( 'Choose whether the navigation remains sticked to the top of the page while scrolling down.', 'ishyoboy' ),
                                    'id' => 'sticky_nav',
                                    'std' => 0,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //'name' => __( '', 'ishyoboy' ),
                                    'desc' => __( 'Display Sticky Nav on tablets and mobile devices', 'ishyoboy' ),
                                    'id' => 'sticky_nav_responsive',
                                    'std' => 1,
                                    'fold' => 'sticky_nav',
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //'name' => __( '', 'ishyoboy' ),
                                    'desc' => __( 'Show Site Logo in Sticky Nav', 'ishyoboy' ),
                                    'id' => 'sticky_nav_logo',
                                    'std' => 1,
                                    'fold' => 'sticky_nav',
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //'name' => __( '', 'ishyoboy' ),
                                    'desc' => __( 'Show Site Tagline in Sticky Nav', 'ishyoboy' ),
                                    'id' => 'sticky_nav_tagline',
                                    'std' => 1,
                                    'fold' => 'sticky_nav',
                                    'type' => 'switch');

            // HEADER EXPANDABLE
            $of_options[] = array(  'name' => __( 'Header Expandable area', 'ishyoboy' ),
                                    'desc' => __( 'Make the top part of the header expandable.', 'ishyoboy' ),
                                    'id' => 'expandable_header',
                                    'std' => 0,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //'name' => __( 'Expandable header sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Select which sidebar will be displayed inside the expandable area by default.', 'ishyoboy' ),
                                    'id' => 'header_sidebar',
                                    'std' => 'sidebar-header',
                                    'fold' => 'expandable_header',
                                    'type' => 'select',
                                    'options' => $of_sidebars);

            $of_options[] = array(  'name' => '', //'name' => __( 'Expandable default state', 'ishyoboy' ),
                                    'desc'  => __( 'Choose whether the expandable area will be opened or closed by default.', 'ishyoboy' ),
                                    'id'    => 'header_sidebar_on',
                                    'std'   => 0,
                                    'fold'  => 'expandable_header',
                                    "on" => 'Opened',
                                    "off" => 'Closed',
                                    'type'  => 'switch');

            // HEADER BAR
            $of_options[] = array(  'name' => __( 'Header Bar', 'ishyoboy' ),
                                    'desc' => __( 'Show the header bar used to display social icons and menu', 'ishyoboy' ),
                                    'id' => 'use_header_bar',
                                    'std' => 0,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //'name' => __( 'Expandable header sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Select which menu to display in top bar', 'ishyoboy' ),
                                    'id' => 'header_bar_menu',
                                    'std' => '',
                                    'fold' => 'use_header_bar',
                                    'type' => 'select',
                                    'options' => $of_menus);

            $of_options[] = array(  'name' => '', //__( 'Social icons', 'ishyoboy' ),
                                    'desc' =>  __( 'Social icons: Paste the social icons using the [social] shortcode', 'ishyoboy' ),
                                    'id' => 'header_bar_social_icons',
                                    'std' => $social_icons,
                                    'fold' => 'use_header_bar',
                                    'type' => 'textarea');

            if ( ishyoboy_wpml_plugin_active() ){
                $of_options[] = array(  'name' => '', //__( 'Language Selector', 'ishyoboy' ),
                                        'desc' => __( 'Display the language selector', 'ishyoboy'),
                                        'id' => 'header_bar_languages',
                                        'std' => 0,
                                        'folds' => 1,
                                        'fold' => 'use_header_bar',
                                        'type' => 'switch');
            }

            $of_options[] = array(  'name' => '', //'name' => __( 'Expandable header sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Positions', 'ishyoboy' ),
                                    'id' => 'header_bar_order',
                                    'std' => 'social-left',
                                    'fold' => 'use_header_bar',
                                    'type' => 'select',
                                    'options' => array(
                                        'social-left' => 'Social on left / Menu on right',
                                        'social-right' => 'Menu on left / Social on right',

                                    ));

            // HEADER SEARCH
            $of_options[] = array(  'name' => __( 'Header navigation search form', 'ishyoboy' ),
                                    'desc' => __( 'Add search form as last navigation item.', 'ishyoboy' ),
                                    'id' => 'use_navigation_search',
                                    'std' => '1',
                                    'type' => 'switch');

        /* *********************************************************************************************************************
         * 3. Footer Settings
         */
        $of_options[] = array(  'name' => __( 'Footer Options', 'ishyoboy' ),
                                'class' => 'footeroptions',
                                'type' => 'heading');
            // FOOTER WIDGETS
            $of_options[] = array(  'name' => __( 'Footer widget area', 'ishyoboy' ),
                                    'desc' => __( 'Show the footer widget area.', 'ishyoboy' ),
                                    'id' => 'footer_widget_area',
                                    'std' => 1,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 'name' => '', //'name' => __( 'Expandable header sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Select which sidebar will be displayed inside the footer widget area by default.', 'ishyoboy' ),
                                    'id' => 'footer_sidebar',
                                    'std' => 'sidebar-footer',
                                    'fold' => 'footer_widget_area',
                                    'type' => 'select',
                                    'options' => $of_sidebars);

            // FOOTER LEGALS
            $of_options[] = array(  'name' => __( 'Footer legals area', 'ishyoboy' ),
                                    'desc' => __( 'Show the footer legals area.', 'ishyoboy' ),
                                    'id' => 'footer_legals_area',
                                    'std' => 1,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 'name' => '', //'name' => __( 'Expandable header sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Select which sidebar will be displayed inside the footer legals area by default.', 'ishyoboy' ),
                                    'id' => 'footer_legals',
                                    'std' => 'sidebar-footer-legals',
                                    'fold' => 'footer_legals_area',
                                    'type' => 'select',
                                    'options' => $of_sidebars);

        /* *********************************************************************************************************************
         * 3. Portfolio Settings
         */
        $of_options[] = array(  'name' => __( 'Portfolio Options', 'ishyoboy' ),
                                'class' => 'portfoliooptions',
                                'type' => 'heading');

            $url =  ADMIN_DIR . 'assets/images/portfolio-styles/';
            $of_options[] = array(  'name' => __( 'Portfolio Layout Options', 'ishyoboy' ),
                                    'desc' => __( 'Layout Style', 'ishyoboy' ),
                                    'id' => 'portfolio_layout_style',
                                    'std' => '1',
                                    'type' => 'images',
                                    'options' => Array(
                                        '1' => $url . 'portfolio-style1.png',
                                        '2' => $url . 'portfolio-style2.png',
                                        '3' => $url . 'portfolio-style3.png',
                                        '4' => $url . 'portfolio-style4.png'
                                ));

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( "If Fluid layout selected, the image widths will be scaled down depending on the browser's width", 'ishyoboy' ),
                                    'id' => 'portfolio_fluid_layout',
                                    'std' 		=> 0,
                                    "on" 		=> __( 'Fluid', 'ishyoboy' ),
                                    "off" 		=> __( 'Fixed', 'ishyoboy' ),
                                    'type' 		=> 'switch' );

            $of_options[] = array(  'name' => '', //__( 'Masonry effect', 'ishyoboy' ),
                                    'desc' => __( 'Masonry effect - Use masonry effect to align items with different heights', 'ishyoboy' ),
                                    'id' => 'portfolio_masonry',
                                    'std' 		=> 0,
                                    "on" 		=> __( 'Enable', 'ishyoboy' ),
                                    "off" 		=> __( 'Disable', 'ishyoboy' ),
                                    'type' 		=> 'switch' );

            $of_options[] = array(  'name' => __( 'Additional Layout Options', 'ishyoboy' ),
                                    'desc' => __( "Animate filter", 'ishyoboy' ),
                                    'id' => 'portfolio_animate_filter',
                                    'std' 		=> 0,
                                    "on" 		=> __( 'Yes', 'ishyoboy' ),
                                    "off" 		=> __( 'No', 'ishyoboy' ),
                                    'type' 		=> 'switch' );

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( "Show title", 'ishyoboy' ),
                                    'id' => 'portfolio_show_title',
                                    'std' 		=> 1,
                                    "on" 		=> __( 'Yes', 'ishyoboy' ),
                                    "off" 		=> __( 'No', 'ishyoboy' ),
                                    'type' 		=> 'switch' );

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( "Show categories", 'ishyoboy' ),
                                    'id' => 'portfolio_show_categories',
                                    'std' 		=> 1,
                                    "on" 		=> __( 'Yes', 'ishyoboy' ),
                                    "off" 		=> __( 'No', 'ishyoboy' ),
                                    'type' 		=> 'switch' );

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( "Show link button", 'ishyoboy' ),
                                    'id' => 'portfolio_show_link_button',
                                    'std' 		=> 1,
                                    "on" 		=> __( 'Yes', 'ishyoboy' ),
                                    "off" 		=> __( 'No', 'ishyoboy' ),
                                    'type' 		=> 'switch' );

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( "Show popup button", 'ishyoboy' ),
                                    'id' => 'portfolio_show_popup_button',
                                    'std' 		=> 1,
                                    "on" 		=> __( 'Yes', 'ishyoboy' ),
                                    "off" 		=> __( 'No', 'ishyoboy' ),
                                    'type' 		=> 'switch' );

            $of_options[] = array(  'name' => __( 'Portfolio page', 'ishyoboy' ),
                                    'desc' => __( 'The page which will serve as Portfolio homepage.', 'ishyoboy' ),
                                    'id' => 'page_for_custom_post_type_portfolio-post',
                                    'std' => '',
                                    'type' => 'select',
                                    'options' => $of_pages );

            $of_options[] = array(  'name' => __( 'Items per page', 'ishyoboy' ),
                                    'desc' => __( 'Number of items displayed per page. To see all items set the value to "-1"', 'ishyoboy' ),
                                    'id' => 'portfolio_posts_per_page',
                                    'std' => '9',
                                    'type' => 'text');

            $of_options[] = array(  'name' => __( 'Max height', 'ishyoboy' ),
                                    'desc' => 'Images will be cut if their height is more than this size. Please enter a number with pixels. E.g: "200px"',
                                    'id' => 'portfolio_height',
                                    'std' => '',
                                    'type' => 'text');

            $of_options[] = array(  'name' => __( 'Columns', 'ishyoboy' ),
                                    'desc' => __( 'Number of columns in a row', 'ishyoboy' ),
                                    'id' => 'portfolio_columns',
                                    'std' => '4',
                                    'type' => 'select',
                                    'options' => array('2' => '2', '3' => '3', '4' => '4') );

            $of_options[] = array(  'name' => __( 'Portfolio Sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Display Sidebar on Portfolio overview and Blog detail pages.', 'ishyoboy') . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy' ) . '</span>',
                                    'id' => 'show_portfolio_sidebar',
                                    'std' => 0,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //'name' => __( 'Portfolio Sidebar position', 'ishyoboy' ),
                                    'desc'  => __( 'Choose whether to display the sidebar on the left or on the right side of the page.', 'ishyoboy' ),
                                    'id'    => 'portfolio_sidebar_position',
                                    'std'   => 'right',
                                    'fold'  => 'show_portfolio_sidebar',
                                    'type'  => 'select',
                                    'options' => array('left' => 'Left', 'right' => 'Right') );

            $of_options[] = array(  'name' => '', //'name' => __( 'Portfolio Sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Select which sidebar will be displayed on Portfolio overview and Portfolio detail pages.', 'ishyoboy' ),
                                    'id' => 'portfolio_sidebar',
                                    'std' => 'sidebar-main',
                                    'fold' => 'show_portfolio_sidebar',
                                    'type' => 'select',
                                    'options' => $of_sidebars);


        /* *********************************************************************************************************************
         * 3. Blog Settings
         */

        $of_options[] = array(  'name' => __( 'Blog Options', 'ishyoboy' ),
                                'class' => 'blogoptions',
                                'type' => 'heading');

            $of_options[] = array(  'name' => __( 'Blog Sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Display Sidebar on Blog overview and Blog detail pages.', 'ishyoboy') . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy' ) . '</span>',
                                    'id' => 'show_blog_sidebar',
                                    'std' => 1,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //'name' => __( 'Blog Sidebar position', 'ishyoboy' ),
                                    'desc'  => __( 'Choose whether to display the sidebar on the left or on the right side of the page.', 'ishyoboy' ),
                                    'id'    => 'blog_sidebar_position',
                                    'std'   => 'right',
                                    'fold'  => 'show_blog_sidebar',
                                    'type'  => 'select',
                                    'options' => array('left' => 'Left', 'right' => 'Right') );

            $of_options[] = array(  'name' => '', //'name' => __( 'Blog Sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Select which sidebar will be displayed on Blog overview and Blog detail pages.', 'ishyoboy' ),
                                    'id' => 'blog_sidebar',
                                    'std' => 'sidebar-main',
                                    'fold' => 'show_blog_sidebar',
                                    'type' => 'select',
                                    'options' => $of_sidebars);

            $of_options[] = array(  'name' => __( 'Blog Social Sharing', 'ishyoboy' ),
                                    'desc' => __( 'Chose whether to display a social sharing buttons box by default.', 'ishyoboy' ),
                                    'id' => 'use_addthis_share',
                                    'std' => '1',
                                    'type' => 'switch');

        /* *********************************************************************************************************************
         * 4. Styling Settings
         */
        $of_options[] = array(  'name' => __( 'Styling Options', 'ishyoboy' ),
                                'class' => 'stylingoptions',
                                'type' => 'heading');
            /*
            $of_options[] = array(  'name' => __( 'Theme Skin', 'ishyoboy' ),
                                    'desc' => __( 'Use one of the pre-defined skins or manually set all skin options', 'ishyoboy' ),
                                    'id' => 'use_skin',
                                    'std' => 1,
                                    //'folds' => 0,
                                    "on" => 'Use skin',
                                    'off' => 'Custom colors',
                                    'type' => 'switch');*/


            $of_options[] = array(  'name' => __( 'Theme Skins', 'ishyoboy' ),
                                    'desc' => __( 'Select one of the pre-defined skins.', 'ishyoboy' ) . '<br><br><span style="color: red;">' . __( '<strong>IMPORTANT:</strong><br>Changing the skin will reset all your currently defined Styling and Fonts options.', 'ishyoboy' ) . '</span>',
                                    'id' => 'skin',
                                    'std' => 'default.php',
                                    'type' => 'images',
                                    //'fold' => 'use_skin',
                                    'options' => $alt_stylesheets_imgs);

            $url =  ADMIN_DIR . 'assets/images/';
            $of_options[] = array(  'name' => __( 'Boxed / Unboxed Layout', 'ishyoboy' ),
                                    'desc' => ' Default layout of the theme. Either boxed with a background image or unboxed (full-width).',
                                    'id' => 'boxed_layout',
                                    'std' => 'boxed',
                                    'type' => 'images',
                                    'options' => Array(
                                        'boxed' => $url . '3cm.png',
                                        'unboxed' => $url . '1col.png'
                                ));

            $of_options[] = array(  'name' => __( 'Main Color Options', 'ishyoboy' ),
                                    'desc' => __( 'Color 1', 'ishyoboy' ),
                                    'id' => 'color1',
                                    'std' => ISH_COLOR_1,
                                    //'fold' => 'off_' . 'use_skin',
                                    'type' => 'color');

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Color 2', 'ishyoboy' ),
                                    'id' => 'color2',
                                    'std' => ISH_COLOR_2,
                                    //'fold' => 'off_' . 'use_skin',
                                    'type' => 'color');

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Color 3', 'ishyoboy' ),
                                    'id' => 'color3',
                                    'std' => ISH_COLOR_3,
                                    //'fold' => 'off_' . 'use_skin',
                                    'type' => 'color');

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Color 4', 'ishyoboy' ),
                                    'id' => 'color4',
                                    'std' => ISH_COLOR_4,
                                    //'fold' => 'off_' . 'use_skin',
                                    'type' => 'color');

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Text color', 'ishyoboy' ),
                                    'id' => 'text_color',
                                    'std' => ISH_TEXT_COLOR,
                                    //'fold' => 'off_' . 'use_skin',
                                    'type' => 'color');

            $of_options[] = array( 	'name'  => '', //__( '', 'ishyoboy' ),
                                    'desc'  => __( 'Body content color', 'ishyoboy' ),
                                    'id'    => 'body_color',
                                    'std'   => '#ffffff',
                                    'type' 	=> 'color');

            $of_options[] = array( 	'name'  => '', //__( '', 'ishyoboy' ),
                                    'desc'  => __( 'Background color (when no pattern or image)', 'ishyoboy' ),
                                    'id'    => 'background_color',
                                    'std'   => '#ffffff',
                                    'type' 	=> 'color');

            $of_options[] = array(  'name'  => __( 'Patterns & Custom Images', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'ish-patterns-options',
                                    'std'   => '',
                                    'icon'	=> false,
                                    'type'  => 'ish-acc-section');

            // Background Pattern (Boxed layout only)
            $of_options[] = array(  'name' => __( 'Background Pattern (Boxed layout only)', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'use_background_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'background_bg_pattern',
                                    'std' 		=> 'ish-solid-wood-light.jpg',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_background_pattern',
                                    'options' 	=> $bg_images,
                                    );

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id' => 'background_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_background_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( 'Background position', 'ishyoboy' ),
                                    'id' => 'background_bg_image_cover',
                                    'std' => 0,
                                    'fold' => 'off_' . 'use_background_pattern',
                                    'type' => 'radio',
                                    'options' => array( '0' => __( 'Repeat and scroll', 'ishyoboy' ),
                                                        '1' => __( 'Fixed and cover', 'ishyoboy' ),
                                    )
            );

            // Expandable Pattern
            $of_options[] = array(  'name' => __( 'Header Expandable area pattern', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'use_expandable_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'expandable_bg_pattern',
                                    'std' 		=> 'ish-transparent-stripes-very-dark.png',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_expandable_pattern',
                                    'options' 	=> $bg_images,
                                    );

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id' => 'expandable_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_expandable_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

            // Header Pattern
            $of_options[] = array(  'name' => __( 'Header pattern', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'use_header_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'header_bg_pattern',
                                    'std' 		=> 'ish-transparent-stripes-light.png',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_header_pattern',
                                    'options' 	=> $bg_images,
                                    );

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id' => 'header_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_header_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

            // Lead Pattern
            $of_options[] = array(  'name' => __( 'Lead pattern', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'use_lead_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'lead_bg_pattern',
                                    'std' 		=> 'ish-transparent-stripes-dark.png',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_lead_pattern',
                                    'options' 	=> $bg_images,
                                    );

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id' => 'lead_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_lead_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

            // Content Pattern
            $of_options[] = array(  'name' => __( 'Content pattern', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'use_content_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'content_bg_pattern',
                                    'std' 		=> 'ish-transparent-stripes-light.png',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_content_pattern',
                                    'options' 	=> $bg_images,
                                    );

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id' => 'content_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_content_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

            // Footer Pattern
            $of_options[] = array(  'name' => __( 'Footer Widget area pattern', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'use_footer_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'footer_bg_pattern',
                                    'std' 		=> 'ish-transparent-stripes-very-dark.png',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_footer_pattern',
                                    'options' 	=> $bg_images,
                                    );

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id' => 'footer_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_footer_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

        /* *********************************************************************************************************************
         * 4. Font Settings
         */
        /*
        $of_options[] = array(  'name' => __( 'Font Options', 'ishyoboy' ),
                                'class' => 'fontoptions',
                                'type' => 'heading');
            /*
            $of_options[] = array( 	'name' => __( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Please choose the font which will be used for all elements across the website.', 'ishyoboy' ),
                                    'id' => 'google_font_1',
                                    'std' => FONT_1,
                                    'fold' => 'use_google_fonts',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFonts
                            );
            */
            /*
            $of_options[] = array( 	'name' => __( 'Text Font', 'ishyoboy' ),
                                    'desc' => __( 'Please choose the font which will be used for all text across the website.', 'ishyoboy' ),
                                    'id' => 'google_font_2',
                                    'std' => FONT_1,
                                    'fold' => 'use_google_fonts',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz<br>.,:;?!@#$%^&*()[]{}\'"|<>/\\', //this is the text from preview box
                                                    'size' => '12px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFonts
                            );
            /**/

            $id = 'body_font'; // Important!

                $of_options[] = array(  'name'  => __( 'Fonts Options', 'ishyoboy' ),
                                        'desc'  => '', //__( '', 'ishyoboy' ),
                                        'id'    => 'ish_fonts_options',
                                        'std'   => '',
                                        'icon'	=> false,
                                        'type'  => 'ish-acc-section');

                $of_options[] = array(  'name' => __( 'Body Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Type', 'ishyoboy' ),
                                        'id' => $id . '_use_google_font',
                                        'std' => 1,
                                        'on' => 'Google',
                                        'off' => 'Regular',
                                        'folds' => 1,
                                        'type' => 'switch');
                // GOOGLE FONT
                $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Family', 'ishyoboy' ),
                                        'id' =>  $id . '_google',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select_google_font',
                                        'preview' 	=> array(
                                                        'text' => __( '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz', 'ishyoboy' ), //this is the text from preview box
                                                        'size' => '16px' //this is the text size from preview box
                                        ),
                                        'options' 	=> $googleFontsArray
                            );
                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_google_variant',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> ishyoboy_google_variants( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans' ) );


                // REGULAR FONT
                $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                        'id' => $id . '_regular',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_fonts);

                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_regular_variant',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_variants);

                // OTHER SETTINGS
                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                        'id' 		=> $id . '_size',
                                        'std' 		=> $ish_fonts[$id]['size'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                        'id' 		=> $id . '_line_height',
                                        'std' 		=> $ish_fonts[$id]['line_height'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

            $id = 'header_font'; // Important!


                $of_options[] = array(  'name' => __( 'Header Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Type', 'ishyoboy' ),
                                        'id' => $id . '_use_google_font',
                                        'std' => 1,
                                        'on' => 'Google',
                                        'off' => 'Regular',
                                        'folds' => 1,
                                        'type' => 'switch');
                // GOOGLE FONT
                $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Family', 'ishyoboy' ),
                                        'id' =>  $id . '_google',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select_google_font',
                                        'preview' 	=> array(
                                                        'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                        'size' => '30px' //this is the text size from preview box
                                        ),
                                        'options' 	=> $googleFontsArray
                            );
                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_google_variant',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> ishyoboy_google_variants( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans' ) );


                // REGULAR FONT
                $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                        'id' => $id . '_regular',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_fonts);

                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_regular_variant',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_variants);

                // OTHER SETTINGS
                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                        'id' 		=> $id . '_size',
                                        'std' 		=> $ish_fonts[$id]['size'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

            $id = 'h1_font'; // Imortant!

                $of_options[] = array(  'name' => __( 'H1', 'ishyoboy' ),
                                        'desc' => __( 'Font Type', 'ishyoboy' ),
                                        'id' => $id . '_use_google_font',
                                        'std' => 1,
                                        'on' => 'Google',
                                        'off' => 'Regular',
                                        'folds' => 1,
                                        'type' => 'switch');
                // GOOGLE FONT
                $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Family', 'ishyoboy' ),
                                        'id' =>  $id . '_google',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select_google_font',
                                        'preview' 	=> array(
                                                        'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                        'size' => '30px' //this is the text size from preview box
                                        ),
                                        'options' 	=> $googleFontsArray
                            );
                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_google_variant',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '300',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> ishyoboy_google_variants( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans' ) );


                // REGULAR FONT
                $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                        'id' => $id . '_regular',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_fonts);

                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_regular_variant',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_variants);
                // OTHER SETTINGS
                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                        'id' 		=> $id . '_size',
                                        'std' 		=> $ish_fonts[$id]['size'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                        'id' 		=> $id . '_line_height',
                                        'std' 		=> $ish_fonts[$id]['line_height'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

            $id = 'h2_font'; // Imortant!

                $of_options[] = array(  'name' => __( 'H2', 'ishyoboy' ),
                                        'desc' => __( 'Font Type', 'ishyoboy' ),
                                        'id' => $id . '_use_google_font',
                                        'std' => 1,
                                        'on' => 'Google',
                                        'off' => 'Regular',
                                        'folds' => 1,
                                        'type' => 'switch');
                // GOOGLE FONT
                $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Family', 'ishyoboy' ),
                                        'id' =>  $id . '_google',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select_google_font',
                                        'preview' 	=> array(
                                                        'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                        'size' => '30px' //this is the text size from preview box
                                        ),
                                        'options' 	=> $googleFontsArray
                            );
                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_google_variant',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '300',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> ishyoboy_google_variants( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans' ) );


                // REGULAR FONT
                $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                        'id' => $id . '_regular',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_fonts);

                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_regular_variant',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_variants);
                // OTHER SETTINGS
                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                        'id' 		=> $id . '_size',
                                        'std' 		=> $ish_fonts[$id]['size'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                        'id' 		=> $id . '_line_height',
                                        'std' 		=> $ish_fonts[$id]['line_height'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

            $id = 'h3_font'; // Imortant!

                $of_options[] = array(  'name' => __( 'H3', 'ishyoboy' ),
                                        'desc' => __( 'Font Type', 'ishyoboy' ),
                                        'id' => $id . '_use_google_font',
                                        'std' => 1,
                                        'on' => 'Google',
                                        'off' => 'Regular',
                                        'folds' => 1,
                                        'type' => 'switch');
                // GOOGLE FONT
                $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Family', 'ishyoboy' ),
                                        'id' =>  $id . '_google',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select_google_font',
                                        'preview' 	=> array(
                                                        'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                        'size' => '30px' //this is the text size from preview box
                                        ),
                                        'options' 	=> $googleFontsArray
                            );
                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_google_variant',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> ishyoboy_google_variants( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans' ) );


                // REGULAR FONT
                $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                        'id' => $id . '_regular',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_fonts);

                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_regular_variant',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_variants);
                // OTHER SETTINGS
                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                        'id' 		=> $id . '_size',
                                        'std' 		=> $ish_fonts[$id]['size'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                        'id' 		=> $id . '_line_height',
                                        'std' 		=> $ish_fonts[$id]['line_height'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

            $id = 'h4_font'; // Imortant!

                $of_options[] = array(  'name' => __( 'H4', 'ishyoboy' ),
                                        'desc' => __( 'Font Type', 'ishyoboy' ),
                                        'id' => $id . '_use_google_font',
                                        'std' => 1,
                                        'on' => 'Google',
                                        'off' => 'Regular',
                                        'folds' => 1,
                                        'type' => 'switch');
                // GOOGLE FONT
                $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Family', 'ishyoboy' ),
                                        'id' =>  $id . '_google',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select_google_font',
                                        'preview' 	=> array(
                                                        'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                        'size' => '30px' //this is the text size from preview box
                                        ),
                                        'options' 	=> $googleFontsArray
                            );
                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_google_variant',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '700',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> ishyoboy_google_variants( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans' ) );


                // REGULAR FONT
                $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                        'id' => $id . '_regular',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_fonts);

                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_regular_variant',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_variants);
                // OTHER SETTINGS
                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                        'id' 		=> $id . '_size',
                                        'std' 		=> $ish_fonts[$id]['size'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                        'id' 		=> $id . '_line_height',
                                        'std' 		=> $ish_fonts[$id]['line_height'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

            $id = 'h5_font'; // Imortant!

                $of_options[] = array(  'name' => __( 'H5', 'ishyoboy' ),
                                        'desc' => __( 'Font Type', 'ishyoboy' ),
                                        'id' => $id . '_use_google_font',
                                        'std' => 1,
                                        'on' => 'Google',
                                        'off' => 'Regular',
                                        'folds' => 1,
                                        'type' => 'switch');
                // GOOGLE FONT
                $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Family', 'ishyoboy' ),
                                        'id' =>  $id . '_google',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select_google_font',
                                        'preview' 	=> array(
                                                        'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                        'size' => '30px' //this is the text size from preview box
                                        ),
                                        'options' 	=> $googleFontsArray
                            );
                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_google_variant',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> ishyoboy_google_variants( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans' ) );


                // REGULAR FONT
                $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                        'id' => $id . '_regular',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_fonts);

                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_regular_variant',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_variants);
                // OTHER SETTINGS
                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                        'id' 		=> $id . '_size',
                                        'std' 		=> $ish_fonts[$id]['size'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                        'id' 		=> $id . '_line_height',
                                        'std' 		=> $ish_fonts[$id]['line_height'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

            $id = 'h6_font'; // Imortant!

                $of_options[] = array(  'name' => __( 'H6', 'ishyoboy' ),
                                        'desc' => __( 'Font Type', 'ishyoboy' ),
                                        'id' => $id . '_use_google_font',
                                        'std' => 1,
                                        'on' => 'Google',
                                        'off' => 'Regular',
                                        'folds' => 1,
                                        'type' => 'switch');
                // GOOGLE FONT
                $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                        'desc' => __( 'Font Family', 'ishyoboy' ),
                                        'id' =>  $id . '_google',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select_google_font',
                                        'preview' 	=> array(
                                                        'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                        'size' => '30px' //this is the text size from preview box
                                        ),
                                        'options' 	=> $googleFontsArray
                            );
                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_google_variant',
                                        'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                        'fold' => $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> ishyoboy_google_variants( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'Open Sans' ) );


                // REGULAR FONT
                $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                        'id' => $id . '_regular',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_fonts);

                $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                        'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                        'id' => $id . '_regular_variant',
                                        'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                        'fold' => 'off_' . $id . '_use_google_font',
                                        'type' => 'select',
                                        'options' 	=> $regular_variants);
                // OTHER SETTINGS
                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                        'id' 		=> $id . '_size',
                                        'std' 		=> $ish_fonts[$id]['size'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

                $of_options[] = array( 	'name' 		=> '',
                                        'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                        'id' 		=> $id . '_line_height',
                                        'std' 		=> $ish_fonts[$id]['line_height'],
                                        "min" 		=> '0',
                                        "step"		=> '1',
                                        "max" 		=> '200',
                                        'type' 		=> 'sliderui' );

        /* *********************************************************************************************************************
         * 6. Woocommerce Settings
         */
        if (ishyoboy_woocommerce_plugin_active()){
            $of_options[] = array(  'name' => __( 'Woocommerce', 'ishyoboy' ),
                                    'class' => 'woocommerce',
                                    'type' => 'heading');

                $of_options[] = array(  'name' => __( 'Woocommerce Sidebar', 'ishyoboy' ),
                                        'desc' => __( "Display the sidebar on each woocommerce page by default. This settings can be overridden in each page's settings.", 'ishyoboy') . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy' ) . '</span>',
                                        'id' => 'show_woocommerce_sidebar',
                                        'std' => 0,
                                        'folds' => 1,
                                        'type' => 'switch');

                $of_options[] = array(  'name' => '', //'name' => __( 'Woocommerce Sidebar position', 'ishyoboy' ),
                                        'desc'  => __( 'Choose whether to display the sidebar on the left or on the right side of woocommerce pages.', 'ishyoboy' ),
                                        'id'    => 'woocommerce_sidebar_position',
                                        'std'   => 'right',
                                        'fold'  => 'show_woocommerce_sidebar',
                                        'type'  => 'select',
                                        'options' => array('left' => 'Left', 'right' => 'Right') );

                $of_options[] = array(  'name' => '', //'name' => __( 'Woocommerce Sidebar', 'ishyoboy' ),
                                        'desc' => __( 'Select which sidebar will be displayed on each woocommerce page by default.', 'ishyoboy' ),
                                        'id' => 'woocommerce_sidebar',
                                        'std' => 'sidebar-woocommerce',
                                        'fold' => 'show_woocommerce_sidebar',
                                        'type' => 'select',
                                        'options' => $of_sidebars);

                $of_options[] = array(  'name' => __( 'Products per page', 'ishyoboy' ),
                                        'desc' => __( 'Number of products displayed per page. To see all items set the value to "-1"', 'ishyoboy' ),
                                        'id' => 'woocommerce_posts_per_page',
                                        'std' => '8',
                                        'type' => 'text');
        }

        /* *********************************************************************************************************************
         * 7. Misc Options
         */

        $of_options[] = array(  'name' => __( 'Misc Options', 'ishyoboy' ),
                                'class' => 'misc-options',
                                'type' => 'heading');

            $of_options[] = array(  'name' => __( 'Twitter Widget', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'twitter_ifo',
                                    'std' => '',
                                    'type' => 'twitter-info');

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( 'Consumer key', 'ishyoboy' ),
                                    'id' => 'twitter_widget_consumer_key',
                                    'std' => '',
                                    'type' => 'text');

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( 'Consumer secret', 'ishyoboy' ),
                                    'id' => 'twitter_widget_consumer_secret',
                                    'std' => '',
                                    'type' => 'text');

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( 'Access token', 'ishyoboy' ),
                                    'id' => 'twitter_widget_access_token',
                                    'std' => '',
                                    'type' => 'text');

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( 'Access token secret', 'ishyoboy' ),
                                    'id' => 'twitter_widget_access_token_secret',
                                    'std' => '',
                                    'type' => 'text');

        /* *********************************************************************************************************************
         * 8. Backup Options
         */
        $of_options[] = array(  'name' => __( 'Backup Options' , 'ishyoboy' ),
                                'class' => 'backupoptions',
                                'type' => 'heading');

            $of_options[] = array( 'name' => __( 'Backup and Restore Options', 'ishyoboy' ),
                                'id' => 'of_backup',
                                'std' => '',
                                'type' => 'backup',
                                'desc' => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
                                );

            $of_options[] = array( 'name' => __( 'Transfer Theme Options Data', 'ishyoboy' ),
                                'id' => 'of_transfer',
                                'std' => '',
                                'type' => 'transfer',
                                'desc' => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
                                    ',
                                );

        /* *********************************************************************************************************************
         * 9. Theme Update
         */
        $of_options[] = array(  'name' => __( 'Theme Update', 'ishyoboy' ),
                                'class' => 'themeupdate',
                                'ish-updates' => '1',
                                'type' => 'heading');

            $of_options[] = array(  'name' => __( 'Theme Update', 'ishyoboy' ),
                                    'desc' => '',
                                    'id' => 'theme_update',
                                    'std' => '',
                                    'type' => 'theme_update');

	}
}