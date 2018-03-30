<?php

add_action( 'init', 'of_options' );

if ( ! function_exists( 'of_options' ) ) {
	function of_options() {
		//Access the WordPress Categories via an Array
		$of_categories     = array();
		$of_categories_obj = get_categories( 'hide_empty=0' );
		foreach ( $of_categories_obj as $of_cat ) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
		}
		$categories_tmp = array_unshift( $of_categories, "Select a category:" );

		//Access the WordPress Pages via an Array
		$of_pages     = array();
		$of_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
		foreach ( $of_pages_obj as $of_page ) {
			$of_pages[$of_page->ID] = $of_page->post_name;
		}
		$of_pages_tmp = array_unshift( $of_pages, "Select a page:" );

		//Testing 
		$of_options_select = array( "one", "two", "three", "four", "five" );
		$of_options_radio  = array( "one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five" );

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		(
			"disabled" => array(
				"placebo"     => "placebo", //REQUIRED!
				"block_one"   => "Block One",
				"block_two"   => "Block Two",
				"block_three" => "Block Three",
			),
			"enabled"  => array(
				"placebo"    => "placebo", //REQUIRED!
				"block_four" => "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets     = array();

		if ( is_dir( $alt_stylesheet_path ) ) {
			if ( $alt_stylesheet_dir = opendir( $alt_stylesheet_path ) ) {
				while ( ( $alt_stylesheet_file = readdir( $alt_stylesheet_dir ) ) !== false ) {
					if ( stristr( $alt_stylesheet_file, ".css" ) !== false ) {
						$alt_stylesheets[] = $alt_stylesheet_file;
					}
				}
			}
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory() . '/assets/images/patterns/'; // change this to where you store your patterns images
		$bg_images_url  = get_template_directory_uri() . '/assets/images/patterns/'; // change this to where you store your patterns images
		$bg_images      = array();

		if ( is_dir( $bg_images_path ) ) {
			if ( $bg_images_dir = opendir( $bg_images_path ) ) {
				while ( ( $bg_images_file = readdir( $bg_images_dir ) ) !== false ) {
					if ( stristr( $bg_images_file, ".png" ) !== false || stristr( $bg_images_file, ".jpg" ) !== false ) {
						natsort( $bg_images ); //Sorts the array into a natural order
						$bg_images[] = $bg_images_url . $bg_images_file;
					}
				}
			}
		}


		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr      = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads      = get_option( 'of_uploads' );
		$other_entries    = array( "Select a number:", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19" );
		$body_repeat      = array( "no-repeat", "repeat-x", "repeat-y", "repeat" );
		$body_pos         = array( "top left", "top center", "top right", "center left", "center center", "center right", "bottom left", "bottom center", "bottom right" );

		// Image Alignment radio box
		$of_options_thumb_align = array( "alignleft" => "Left", "alignright" => "Right", "aligncenter" => "Center" );

		// Image Links to Options
		$of_options_image_link_to = array( "image" => "The Image", "post" => "The Post" );


		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

// Set the Options Array
		global $of_options;
		$of_options = array();
		/*General Settings*/
		$of_options[] = array( "name" => esc_html__('General Settings', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-settings.png"
		);
		$logo         = THEME_URL . 'assets/images/logo.png';

		$of_options[] = array( "name" => esc_html__('Logo', 'zorka' ),
							   "desc" => esc_html__('Enter URL or Upload an image file as your logo.', 'zorka' ),
							   "id"   => "site-logo",
							   "std"  => $logo,
							   "type" => "media"
		);

		$logo_second  = THEME_URL . 'assets/images/logo-white.png';
		$of_options[] = array( "name" => esc_html__('Logo White', 'zorka' ),
							   "desc" => esc_html__('Enter URL or Upload an image file as your logo.', 'zorka' ),
							   "id"   => "site-logo-white",
							   "std"  => $logo_second,
							   "type" => "media"
		);

		$favicon      = THEME_URL . 'assets/images/favicon.ico';
		$of_options[] = array( "name" => esc_html__('Favicon', 'zorka' ),
							   "desc" => esc_html__("Enter URL or upload an icon image to represent your website's favicon (16px x 16px)", 'zorka' ),
							   "id"   => "favicon",
							   "std"  => $favicon,
							   "type" => "media"
		);


		$of_options[] = array( "name"    => esc_html__('Archive Paging Style', 'zorka' ),
							   "desc"    => esc_html__('Select paging style for Archive Page', 'zorka' ),
							   "id"      => "post-archive-paging-style",
							   "std"     => "default",
							   "type"    => "select",
							   "options" => array(
								   'default'         => 'Default',
								   'load-more'       => 'Load More',
								   'infinite-scroll' => 'Infinite Scroll'
							   )
		);


		$url          = ADMIN_DIR . 'assets/images/';
		$of_options[] = array( "name"    => esc_html__('Archive Layout', 'zorka' ),
							   "desc"    => esc_html__('Select layout for Archive Page', 'zorka' ),
							   "id"      => "post-archive-layout",
							   "std"     => "right-sidebar",
							   "type"    => "images",
							   "options" => array(
								   'full-content'  => $url . '1col.png',
								   'left-sidebar'  => $url . '2cl.png',
								   'right-sidebar' => $url . '2cr.png'
							   )
		);

		$of_options[] = array( "name"    => esc_html__('Page Layout', 'zorka' ),
							   "desc"    => esc_html__('Select layout for Page', 'zorka' ),
							   "id"      => "page-layout",
							   "std"     => "right-sidebar",
							   "type"    => "images",
							   "options" => array(
								  /* 'full-content'  => $url . '1col.png',*/
                                   'container-full-content'  => $url . '3cm.png',
                                   'left-sidebar'  => $url . '2cl.png',
								   'right-sidebar' => $url . '2cr.png'
							   )
		);

        $of_options[] = array( 	 "name" 		=> esc_html__('Single Portfolio Style','zorka'),
            "desc" 		=> esc_html__('Select style for single portfolio page','zorka'),
            "id" 		=> "portfolio-single-style",
            "std" 		=> "fullwidth",
            "type" 		=> "select",
            "options" 	=> array(
                'fullwidth' 	=> 'Full',
                'smallslider' 	=> 'Small Slider',
                'bigslider' 	=> 'Big Slider',
                'sidebar' 	=> 'Side bar',
                'verticalslider' => 'Vertical Slider'
            )
        );


		$of_options[] = array( "name" => esc_html__('Show Back To Top', 'zorka' ),
							   "id"   => esc_html__('show-back-to-top', 'zorka' ),
							   "std"  => 1,
							   "type" => "switch",
							   "on"   => "Show",
							   "off"  => "Hide"
		);

        $of_options[] = array( "name" => esc_html__('Show Loading', 'zorka' ),
            "id"   => esc_html__('show-loading', 'zorka' ),
            "std"  => 1,
            "type" => "switch",
            "on"   => "Show",
            "off"  => "Hide"
        );


        $of_options[] = array( "name" => esc_html__('Show Panel Selector Style', 'zorka' ),
            "id"   => esc_html__('show-panel-selector-style', 'zorka' ),
            "std"  => 0,
            "type" => "switch",
            "on"   => "Show",
            "off"  => "Hide"
        );

        $of_options[] = array( "name" => esc_html__('Smooth Page Scroll', 'zorka' ),
            "id"   => esc_html__('smooth-page-scroll', 'zorka' ),
            "std"  => 1,
            "type" => "switch",
            "on"   => "On",
            "off"  => "Off"
        );

        $of_options[] = array( "name" => esc_html__('Show Breadcrumb', 'zorka' ),
            "id"   => esc_html__('show-breadcrumb', 'zorka' ),
            "std"  => 1,
            "type" => "switch",
            "on"   => "On",
            "off"  => "Off"
        );

        $page_title_bg = THEME_URL . 'assets/images/float_header_bg.jpg';
        $of_options[] = array( "name" => esc_html__('Page Title Background', 'zorka' ),
            "desc" => esc_html__("Enter URL or upload an image to set as your heading background with page title", 'zorka' ),
            "id"   => "page-title-background",
            "std"  => $page_title_bg,
            "type" => "media"
        );

		/*Site Top Options*/
		$of_options[] = array( "name" => esc_html__('Site Top - Header Options', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-header.png"
		);

		$of_options[] = array( "name"  => esc_html__('Show Site Top', 'zorka' ),
							   "desc"  => "",
							   "id"    => "show-site-top",
							   "std"   => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"  => esc_html__('Show Language Selector', 'zorka' ),
							   "desc"  => "",
							   "id"    => "show-language-selector",
							   "std"   => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"  => esc_html__('Show Login Link', 'zorka' ),
							   "desc"  => "",
							   "id"    => "show-login-link",
							   "std"   => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"  => esc_html__('Show Mini Cart', 'zorka' ),
							   "desc"  => "",
							   "id"    => "show-mini-cart",
							   "std"   => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"  => esc_html__('Show Search Button Mobile', 'zorka' ),
			"desc"  => "",
			"id"    => "show-search-button-mobile",
			"std"   => 1,
			"type"  => "switch"
		);

		$of_options[] = array( "name"  => esc_html__('Show Mini Cart Mobile', 'zorka' ),
			"desc"  => "",
			"id"    => "show-mini-cart-mobile",
			"std"   => 0,
			"type"  => "switch"
		);

		$of_options[] = array( "name"  => esc_html__('Enable Header Sticky', 'zorka' ),
			"desc"  => "",
			"id"    => "header-sticky",
			"std"   => 1,
			"type"  => "switch"
		);

		/*Header Options*/
		$of_options[] = array( "name" => esc_html__('Header Options', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-header.png"
		);


		$of_options[] = array( "name"    => esc_html__('Header Layout', 'zorka' ),
							   "desc"    => esc_html__('Select layout for Header', 'zorka' ),
							   "id"      => "header-layout",
							   "std"     => "1",
							   "type"    => "images",
							   "options" => array(
								   '1' => $url . 'header/header-1.jpg',
								   '2' => $url . 'header/header-2.jpg',
                                   '3' => $url . 'header/header-3.jpg',
                                   '4' => $url . 'header/header-4.jpg',
                                   '5' => $url . 'header/header-5.jpg',
                                   '6' => $url . 'header/header-6.jpg',
                                   '7' => $url . 'header/header-7.jpg',
                                   '8' => $url . 'header/header-8.jpg',
                                   '9' => $url . 'header/header-9.jpg',
                                   '10' => $url . 'header/header-10.jpg',
								   '11' => $url . 'header/header-11.jpg',

							   )
		);
		$of_options[] = array( "name" => esc_html__('Custom content for Header', 'zorka' ),
							   "desc" => esc_html__('Apply only Header-6, Header-7, Header-8', 'zorka' ),
							   "id"   => "header-custom-content",
							   "std"  => '<ul>
<li><i class="fa fa-phone"></i>(+100) 6666 8888</li>
<li><i class="fa fa-envelope-o"></i>info@domain.com</li>
<li><i class="fa fa-map-marker"></i>99 Collins Street, London, UK.</li>
</ul>',
							   "type" => "textarea"
		);


		/*Footer Options*/

        $of_options[] = array( 	"name" 		=> esc_html__('Footer Options','zorka'),
            "type" 		=> "heading",
            "icon" 		=> ADMIN_IMAGES . "icon-footer.png"
        );


        $of_options[] = array( "name" => esc_html__('Enable Parallax Scrolling', 'zorka' ),
            "id"   => esc_html__('enable-parallax-footer', 'zorka' ),
            "std"  => 0,
            "type" => "switch",
            "on"   => "Enable",
            "off"  => "Disable"
        );


        $of_options[] = array( 	"name" 		=> esc_html__('Footer Layout','zorka'),
            "desc" 		=> esc_html__('Select layout for Footer','zorka'),
            "id" 		=> "footer-layout",
            "std" 		=> "1",
            "type" 		=> "select",
            "options" 	=> array(
                '1' => esc_html__('Light', 'zorka' ),
                '2' => esc_html__('Dark', 'zorka' )
            )
        );


        $of_options[] = array( "name" => esc_html__('Visa Url', 'zorka' ),
            "id"   => "visa_url",
            "std"  => "http://www.visa.com",
            "type" => "text"
        );

        $of_options[] = array( "name" => esc_html__('Master Card Url', 'zorka' ),
            "id"   => "mastercard_url",
            "std"  => "https://www.mastercard.us",
            "type" => "text"
        );

        $of_options[] = array( "name" => esc_html__('Paypal Url', 'zorka' ),
            "id"   => "paypal_url",
            "std"  => "https://www.paypal.com/",
            "type" => "text"
        );
        $of_options[] = array( "name" => esc_html__('2CO Url', 'zorka' ),
            "id"   => "twoCO_url",
            "std"  => "https://www.2co.com/",
            "type" => "text"
        );
        $of_options[] = array( "name" => esc_html__('American Express Url', 'zorka' ),
            "id"   => "american_express_url",
            "std"  => "https://www.americanexpress.com/",
            "type" => "text"
        );
        $of_options[] = array( "name" => esc_html__('Skrill Url', 'zorka' ),
            "id"   => "skrill_url",
            "std"  => "https://www.skrill.com/en/home/",
            "type" => "text"
        );
        $of_options[] = array( "name" => esc_html__('Google Wallet Url', 'zorka' ),
            "id"   => "google_wallet_url",
            "std"  => "https://www.google.com/wallet/",
            "type" => "text"
        );
        $of_options[] = array( "name" => esc_html__('Western Union Url', 'zorka' ),
            "id"   => "western_union_url",
            "std"  => "https://www.westernunion.com",
            "type" => "text"
        );


		$of_options[] = array( "name" => esc_html__('Copyright Text', 'zorka' ),
							   "desc" => esc_html__('You can use  shortcodes in your footer text', 'zorka' ),
							   "id"   => "copyright-text",
							   "std"  => "Powered by <a href=\"http://wordpress.org\">WordPress</a>. Built on the <a href=\"http://g5plus.net\">G5Plus</a>.",
							   "type" => "textarea"
		);
		/*Styling Options*/
		$of_options[] = array( "name" => esc_html__('Styling Options', 'zorka' ),
							   "type" => "heading"
		);

		$of_options[] = array( "name"    => esc_html__('Layout Style', 'zorka' ),
							   "desc"    => esc_html__('Select a layout', 'zorka' ),
							   "id"      => "layout-style",
							   "std"     => "wide",
							   "type"    => "radio",
							   "options" => array(
								   'boxed' => 'Boxed',
								   'wide'  => 'Wide',
							   ) );


		$of_options[] = array( "name"  => esc_html__('Background Images', 'zorka' ),
							   "desc"  => "",
							   "id"    => "use-bg-image",
							   "std"   => 0,
							   "folds" => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"    => esc_html__('Background Pattern', 'zorka' ),
							   "desc"    => esc_html__('Select a background pattern.', 'zorka' ),
							   "id"      => "bg-pattern",
							   "type"    => "tiles",
							   "options" => $bg_images,
							   "fold"    => "use-bg-image",
							   "std"     => $bg_images[1]
		);

		$of_options[] = array( "name" => esc_html__('Upload Background', 'zorka' ),
							   "desc" => esc_html__('Upload your own background', 'zorka' ),
							   "id"   => "bg-pattern-upload",
							   "std"  => THEME_URL . '/assets/images/bg-images/bg-0.jpg',
							   "type" => "upload",
							   "fold" => "use-bg-image"
		);

		$of_options[] = array( "name"    => esc_html__('Background Repeat', 'zorka' ),
							   "desc"    => "",
							   "id"      => "bg-repeat",
							   "std"     => "no-repeat",
							   "type"    => "select",
							   "options" => array( 'repeat' => esc_html__('repeat', 'zorka' ), 'repeat-x' => esc_html__('repeat-x', 'zorka' ), 'repeat-y' => esc_html__('repeat-y', 'zorka' ), 'no-repeat' => esc_html__('no-repeat', 'zorka' ) ),
							   "fold"    => "use-bg-image"
		);
		$of_options[] = array( "name"    => esc_html__('Background Position', 'zorka' ),
							   "desc"    => "",
							   "id"      => "bg-position",
							   "std"     => "center center",
							   "type"    => "select",
							   "options" => array( 'left top'      => esc_html__('left top', 'zorka' ),
												   'left center'   => esc_html__('left center', 'zorka' ),
												   'left bottom'   => esc_html__('left bottom', 'zorka' ),
												   'right top'     => esc_html__('right top', 'zorka' ),
												   'right center'  => esc_html__('right center', 'zorka' ),
												   'right bottom'  => esc_html__('right bottom', 'zorka' ),
												   'center top'    => esc_html__('center top', 'zorka' ),
												   'center center' => esc_html__('center center', 'zorka' ),
												   'center bottom' => esc_html__('center bottom', 'zorka' )
							   ),
							   "fold"    => "use-bg-image"
		);
		$of_options[] = array( "name"    => esc_html__('Background Attachment', 'zorka' ),
							   "desc"    => "",
							   "id"      => "bg-attachment",
							   "std"     => "fixed",
							   "type"    => "select",
							   "options" => array( 'scroll'  => esc_html__('scroll', 'zorka' ),
												   'fixed'   => esc_html__('fixed', 'zorka' ),
												   'local'   => esc_html__('local', 'zorka' ),
												   'initial' => esc_html__('initial', 'zorka' ),
												   'inherit' => esc_html__('inherit', 'zorka' )
							   ),
							   "fold"    => "use-bg-image"
		);
		$of_options[] = array( "name"    => esc_html__('Background Size', 'zorka' ),
							   "desc"    => "",
							   "id"      => "bg-size",
							   "std"     => "cover",
							   "type"    => "select",
							   "options" => array( 'auto'    => esc_html__('auto', 'zorka' ),
												   'cover'   => esc_html__('cover', 'zorka' ),
												   'contain' => esc_html__('contain', 'zorka' ),
												   'initial' => esc_html__('initial', 'zorka' ),
												   'inherit' => esc_html__('inherit', 'zorka' )
							   ),
							   "fold"    => "use-bg-image"
		);

		$of_options[] = array( "name" => esc_html__('Primary Color', 'zorka' ),
							   "desc" => esc_html__('Pick a primary color for the theme.', 'zorka' ),
							   "id"   => "primary-color",
							   "std"  => "#C97178",
							   "type" => "color"
		);

        $of_options[] = array( "name" => esc_html__('Text Color', 'zorka' ),
            "desc" => esc_html__('Pick a text color for the theme.', 'zorka' ),
            "id"   => "text-color",
            "std"  => "#868686",
            "type" => "color"
        );

        $of_options[] = array( "name" => esc_html__('Text Bold Color', 'zorka' ),
            "desc" => esc_html__('Pick a text bold color for the theme.', 'zorka' ),
            "id"   => "text-bold-color",
            "std"  => "#25282C",
            "type" => "color"
        );





		/*Social Sharing Box*/
		$of_options[] = array( "name" => esc_html__('Social', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-header.png"
		);


		$of_options[] = array( "name"    => esc_html__('Social Sharing Box', 'zorka' ),
							   "desc"    => esc_html__('Show the social sharing in blog posts.', 'zorka' ),
							   "id"      => "social-sharing",
							   "type"    => "multicheck",
							   "std"     => array( "sharing-facebook", "sharing-twitter", "sharing-google" ),
							   "options" => array(
                                   "sharing-facebook" => esc_html__('Facebook', 'zorka' ),
                                   "sharing-twitter" => esc_html__('Twitter', 'zorka' ),
                                   "sharing-google" => esc_html__('Google', 'zorka' ),
                                   "sharing-linkedin" => esc_html__('LinkedIn', 'zorka' ),
                                   "sharing-tumblr" => esc_html__('Tumblr', 'zorka' ),
                                   "sharing-pinterest" => esc_html__('Pinterest', 'zorka' ),
                                   "sharing-email" => esc_html__('Email', 'zorka' )
                               )
		);
		/*Social Link*/
		$of_options[] = array( "name" => esc_html__('Email Link', 'zorka' ),
							   "id"   => "social-email-link",
							   "std"  => "#",
							   "type" => "text"
		);
		$of_options[] = array( "name" => esc_html__('LinkedIn Link', 'zorka' ),
							   "id"   => "social-linkedin-link",
							   "std"  => "#",
							   "type" => "text"
		);
		$of_options[] = array( "name" => esc_html__('Facebook Link', 'zorka' ),
							   "id"   => "social-face-link",
							   "std"  => "#",
							   "type" => "text"
		);

		$of_options[] = array( "name" => esc_html__('Twitter Link', 'zorka' ),
							   "id"   => "social-twitter-link",
							   "std"  => "#",
							   "type" => "text"
		);
		$of_options[] = array( "name" => esc_html__('Dribbble Link', 'zorka' ),
							   "id"   => "social-dribbble-link",
							   "std"  => "#",
							   "type" => "text"
		);


		$of_options[] = array( "name" => esc_html__('Google Link', 'zorka' ),
							   "id"   => "social-google-link",
							   "std"  => "",
							   "type" => "text"
		);

		$of_options[] = array( "name" => esc_html__('Vimeo Link', 'zorka' ),
							   "id"   => "social-vimeo-link",
							   "std"  => "",
							   "type" => "text"
		);
		$of_options[] = array( "name" => esc_html__('Pinterest Link', 'zorka' ),
							   "id"   => "social-pinteres-link",
							   "std"  => "",
							   "type" => "text"
		);
		$of_options[] = array( "name" => esc_html__('Youtube Link', 'zorka' ),
							   "id"   => "social-youtube-link",
							   "std"  => "",
							   "type" => "text"
		);
		$of_options[] = array( "name" => esc_html__('Instagram Link', 'zorka' ),
							   "id"   => "social-instagram-link",
							   "std"  => "",
							   "type" => "text"
		);

        /*WooCommerce*/
        $of_options[] = array( "name" => esc_html__('WooCommerce', 'zorka' ),
            "type" => "heading",
            "icon" => ADMIN_IMAGES . "woo_icon.png"
        );

        $of_options[] = array( "name"    => esc_html__('Archive Product Layout', 'zorka' ),
            "desc"    => esc_html__('Select layout for Archive Product Page', 'zorka' ),
            "id"      => "product-archive-layout",
            "std"     => "left-sidebar",
            "type"    => "images",
            "options" => array(
                'full-content'  => $url . '1col.png',
                'left-sidebar'  => $url . '2cl.png',
                'right-sidebar' => $url . '2cr.png'
            )
        );

        $of_options[] = array(
            "name"    => esc_html__('Archive Product Columns', 'zorka' ),
            "desc"    => esc_html__('Choose the number of columns to display on shop/category pages', 'zorka' ),
            "id"      => "archive-product-columns",
            "std"     => "3",
            "type"    => "select",
            'options' => array(
                '2'		=> '2',
                '3'		=> '3',
                '4'		=> '4'
            ),
        );


        $shop_page_title_bg = THEME_URL . 'assets/images/shop-page-title-bg.jpg';
        $of_options[] = array( "name" => esc_html__('Shop Page Title Background', 'zorka' ),
            "desc" => esc_html__("Enter URL or upload an image to set as your heading background with page shop title", 'zorka' ),
            "id"   => "shop-page-title-background",
            "std"  => $shop_page_title_bg,
            "type" => "media"
        );

        $of_options[] = array( "name"  => esc_html__('Enable Quick View', 'zorka' ),
            "desc"  => "",
            "id"    => "enable-quick-view",
            "std"   => 1,
            "folds" => 1,
            "type"  => "switch"
        );


        $of_options[] = array(
            "name"    => esc_html__('Sale Flash Mode', 'zorka' ),
            "desc"    => esc_html__('Chose Sale Flash Mode', 'zorka' ),
            "id"      => "product-sale-flash-mode",
            "std"     => "percent",
            "type"    => "select",
            'options' => array(
                'text'		=> 'Text',
                'percent'		=> 'Percent'
            ),
        );

		$of_options[] = array(
			"name" => esc_html__('Product Image Hover Effect','zorka'),
			"id" => "archive-product-image-hover-effect",
			"std" => "change-images",
			"type" => "select",
			"options" => array(
				'none'          => esc_html__('none','zorka'),
				"change-images" => esc_html__('Change images','zorka'),
				"flip-back" => esc_html__('Flip back','zorka'),
				"translate-top-to-bottom" => esc_html__('Translate Top To Bottom','zorka'),
				"translate-bottom-to-top" => esc_html__('Translate Bottom To Top','zorka'),
				"translate-left-to-right" => esc_html__('Translate Left To Right','zorka'),
				"translate-right-to-left" => esc_html__('Translate Right To Left','zorka'),
			)
		);



		/*Typography*/
		$of_options[] = array( "name" => esc_html__('Typography', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-typography.gif"

		);
		$of_options[] = array( "name" => esc_html__('Body Font', 'zorka' ),
							   "desc" => esc_html__('Specify the body font properties', 'zorka' ),
							   "id"   => "body-font",
							   "std"  => array( 'face' => 'Lato', 'size' => '14px', 'weight' => 'normal', 'face-type' => '1' ),
							   "type" => "typography"
		);

		$of_options[] = array( "name" => esc_html__('Heading Options', 'zorka' ),
							   "desc" => "",
							   "id"   => "heading-font",
							   "std"  => array( 'face' => 'Montserrat', 'face-type' => '1' ),
							   "type" => "typography"
		);

		$of_options[] = array( "name" => esc_html__('Font H1', 'zorka' ),
							   "desc" => "",
							   "id"   => "h1-font",
							   "std"  => array( 'face' => '', 'size' => '36px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => esc_html__('Font H2', 'zorka' ),
							   "desc" => "",
							   "id"   => "h2-font",
							   "std"  => array( 'face' => '', 'size' => '30px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => esc_html__('Font H3', 'zorka' ),
							   "desc" => "",
							   "id"   => "h3-font",
							   "std"  => array( 'face' => '', 'size' => '26px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => esc_html__('Font H4', 'zorka' ),
							   "desc" => "",
							   "id"   => "h4-font",
							   "std"  => array( 'face' => '', 'size' => '24px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => esc_html__('Font H5', 'zorka' ),
							   "desc" => "",
							   "id"   => "h5-font",
							   "std"  => array( 'face' => '', 'size' => '22px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => esc_html__('Font H6', 'zorka' ),
							   "desc" => "",
							   "id"   => "h6-font",
							   "std"  => array( 'face' => '', 'size' => '19px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);

		/*Resources Options*/
		$of_options[] = array( "name" => esc_html__('Resources Options', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-bootstrap.png"
		);
		$of_options[] = array( "name" => esc_html__('CDN Bootstrap Script', 'zorka' ),
							   "desc" => "Empty using theme resources",
							   "id"   => "bootstrap-js",
							   "std"  => "",
							   "type" => "text"
		);

		$of_options[] = array( "name" => esc_html__('CDN Bootstrap StyleSheet', 'zorka' ),
							   "desc" => "Empty using theme resources",
							   "id"   => "bootstrap-css",
							   "std"  => "",
							   "type" => "text"
		);

		$of_options[] = array( "name" => esc_html__('CDN Font Awesome', 'zorka' ),
							   "desc" => "Empty using theme resources",
							   "id"   => "font-awesome",
							   "std"  => "",
							   "type" => "text",
		);

		/*Custom CSS*/
		$of_options[] = array( "name" => esc_html__('Custom CSS', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "css.png"
		);

		$of_options[] = array( "name" => esc_html__('Custom CSS', 'zorka' ),
							   "desc" => "",
							   "id"   => "css-custom",
							   "std"  => ".class-custom{}",
							   "type" => "textarea"
		);

		/*Backup Options*/
		$of_options[] = array( "name" => esc_html__('Backup Options', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-slider.png"
		);

		$of_options[] = array( "name" => esc_html__('Backup and Restore Options', 'zorka' ),
							   "id"   => "of-backup",
							   "std"  => "",
							   "type" => "backup",
							   "desc" => esc_html__('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'zorka' ),
		);

		$of_options[] = array( "name" => esc_html__('Transfer Theme Options Data', 'zorka' ),
							   "id"   => "of-transfer",
							   "std"  => "",
							   "type" => "transfer",
							   "desc" => esc_html__('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'zorka' ),
		);

	}
	//End function: of_options()
}//End chack if function exists: of_options()
