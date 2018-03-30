<?php
/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'thb_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function thb_custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create a custom settings array that we pass to 
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'sections'        => array(
      array(
        'title'       => 'General',
        'id'          => 'general'
      ),
      array(
        'title'       => 'Shop Settings',
        'id'          => 'shop'
      ),
      array(
        'title'       => 'Blog Settings',
        'id'          => 'blog'
      ),
      array(
        'title'       => 'Header Settings',
        'id'          => 'header'
      ),
      array(
        'title'       => 'Footer Settings',
        'id'          => 'footer'
      ),
      array(
        'title'       => 'Customization',
        'id'          => 'customization'
      ),
      array(
        'title'       => 'Contact Page Settings',
        'id'          => 'contact'
      ),
      array(
        'title'       => 'Misc',
        'id'          => 'misc'
      ),
      array(
        'title'       => 'Demo Content',
        'id'          => 'import'
      )
    ),
    'settings'        => array(
    	array(
    	  'id'          => 'general_tab0',
    	  'label'       => 'General',
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    		'label'       => 'Search Results',
    		'id'          => 'search_results',
    		'type'        => 'radio',
    		'desc'        => 'What type of results would you like to display in search?',
    		'choices'     => array(
    		  array(
    			'label'       => 'Products',
    			'value'       => 'products'
    		  ),
    		  array(
    			'label'       => 'Blog Posts',
    			'value'       => 'posts'
    		  )
    		),
    		'std'         => 'posts',
    		'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Custom Revolution Slider Arrows?',
    	  'id'          => 'revslider_arrows',
    	  'type'        => 'on_off',
    	  'desc'        => 'This will override the revolution slider arrows to use the North color changing ones.',
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'id'          => 'general_tab1',
    	  'label'       => 'Newsletter',
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	    'id'          => 'newsletter_text0',
    	    'label'       => 'Downloading Newsletter Content',
    	    'desc'        => 'You can download the newsletter list by navigating to <a href="'.THB_THEME_ROOT.'/inc/subscribers.csv">'.THB_THEME_ROOT.'/inc/subscribers.csv</a>',
    	    'std'         => '',
    	    'type'        => 'textblock',
    	    'section'     => 'general'
    	  ),
    	array(
    	  'label'       => 'Display Newsletter Popup?',
    	  'id'          => 'newsletter',
    	  'type'        => 'on_off',
    	  'desc'        => 'Would you like to display the Newsletter Popup?',
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Newsletter refresh interval',
    	  'id'          => 'newsletter-interval',
    	  'type'        => 'radio',
    	  'desc'        => 'When the user closes the popup, the newsletter will not be visible on the next page. After the below period, its going to be visible again unless he closes it again',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Never - the popup will be shown every page',
    	      'value'       => '0'
    	    ),
    	    array(
    	      'label'       => '1 Day',
    	      'value'       => '1'
    	    ),
    	    array(
    	      'label'       => '2 Days',
    	      'value'       => '2'
    	    ),
    	    array(
    	      'label'       => '3 Days',
    	      'value'       => '3'
    	    ),
    	    array(
    	      'label'       => '1 Week',
    	      'value'       => '7'
    	    ),
    	    array(
    	      'label'       => '2 Weeks',
    	      'value'       => '14'
    	    ),
    	    array(
    	      'label'       => '3 Weeks',
    	      'value'       => '21'
    	    ),
    	    array(
    	      'label'       => '1 Month',
    	      'value'       => '30'
    	    )
    	    
    	  ),
    	  'std'         => '1',
    	  'section'     => 'general',
    	  'condition'   => 'newsletter:is(on)'
    	),
		
	  array(
    	  'id'          => 'general_tab3',
    	  'label'       => 'Newsletter Customization',
    	  'type'        => 'tab',
    	  'section'     => 'general'
      ),
	  array(
        'id'          => 'newsletter_text',
        'label'       => 'About Newsletter Content',
        'desc'        => 'The content field below is optional. By default, it will use the default content, which can be translated. Please read the documentation about translating the theme related strings.',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'general'
      ),
	  array(
        'label'       => 'Newsletter Content',
        'id'          => 'newsletter_content',
        'type'        => 'textarea',
        'desc'        => 'This content appears just above the email form.',
        'rows'        => '4',
        'section'     => 'general'
      ),
	  array(
        'label'       => 'Newsletter Background',
        'id'          => 'newsletter_bg',
        'type'        => 'background',
        'desc'        => 'You can change the background of the newsletter from here.',
        'section'     => 'general'
      ),
      array(
        'id'          => 'general_tab2',
        'label'       => 'Social Sharing',
        'type'        => 'tab',
        'section'     => 'general'
      ),
      array(
        'label'       => 'Display sharing buttons',
        'id'          => 'sharing_buttons_content',
        'type'        => 'checkbox',
        'desc'        => 'You can choose to display the sharing buttons on different content',
        'choices'     => array(
          array(
            'label'       => 'Blog Posts',
            'value'       => 'blog'
          ),
          array(
            'label'       => 'Products',
            'value'       => 'products'
          )
        ),
        'section'     => 'general'
      ),
      array(
        'label'       => 'Sharing buttons',
        'id'          => 'sharing_buttons',
        'type'        => 'checkbox',
        'desc'        => 'You can choose which social networks to display',
        'choices'     => array(
          array(
            'label'       => 'Facebook',
            'value'       => 'facebook'
          ),
          array(
            'label'       => 'Twitter',
            'value'       => 'twitter'
          ),
          array(
            'label'       => 'Pinterest',
            'value'       => 'pinterest'
          )
        ),
        'section'     => 'general'
      ),
      array(
        'id'          => 'header_tab1',
        'label'       => 'Header Settings',
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Header Style',
        'id'          => 'header_style',
        'type'        => 'radio',
        'desc'        => 'Which Header Style would you like to use?',
        'choices'     => array(
          array(
            'label'       => 'Style 1',
            'value'       => 'style1'
          ),
          array(
            'label'       => 'Style 2',
            'value'       => 'style2'
          )
        ),
        'std'         => 'style1',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Logo Position',
        'id'          => 'logo_position',
        'type'        => 'radio',
        'desc'        => 'You can change the logo position here',
        'choices'     => array(
          array(
            'label'       => 'Center Logo',
            'value'       => 'center'
          ),
          array(
            'label'       => 'Left Logo',
            'value'       => 'left'
          )
        ),
        'std'         => 'center',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Header Height',
        'id'          => 'header_height',
        'type'        => 'measurement',
        'desc'        => 'You can modify the header height from here',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Header Wishlist',
        'id'          => 'header_wishlist',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display the wishlist icon in the header?',
        'section'     => 'header',
        'std'         => 'on'
      ),
			array(
			  'label'       => 'Header Search',
			  'id'          => 'header_search',
			  'type'        => 'on_off',
			  'desc'        => 'Would you like to display the search icon in the header?',
			  'section'     => 'header',
			  'std'         => 'on'
			),
      array(
        'label'       => 'Header Shopping Cart',
        'id'          => 'header_cart',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display the shopping cart icon in the header',
        'section'     => 'header',
        'std'         => 'on'
      ),
      array(
        'id'          => 'header_tab3',
        'label'       => 'Logo Settings',
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Logo Height',
        'id'          => 'logo_height',
        'type'        => 'measurement',
        'desc'        => 'You can modify the logo height from here. This is maximum height, so your logo may get smaller depending on spacing inside header',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Logo Upload for Light Backgrounds',
        'id'          => 'logo',
        'type'        => 'upload',
        'desc'        => 'You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double size image.</strong> The image should be maximum 100 pixels in height.',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Logo Upload for Dark Backgrounds',
        'id'          => 'logo_dark',
        'type'        => 'upload',
        'desc'        => 'You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double size image.</strong> The image should be maximum 100 pixels in height.',
        'section'     => 'header'
      ),
      array(
        'id'          => 'shop_tab0',
        'label'       => 'General',
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'Catalog Mode',
        'id'          => 'shop_catalog_mode',
        'type'        => 'on_off',
        'desc'        => 'If enabled, this will hide add to cart buttons and prices along the site.',
        'section'     => 'shop',
        'std'         => 'off'
      ),
      array(
        'label'       => 'Product Listing Style',
        'id'          => 'shop_product_listing',
        'type'        => 'radio',
        'desc'        => 'Which style would you like to use on listing pages?',
        'choices'     => array(
          array(
            'label'       => 'Style 1',
            'value'       => 'style1'
          ),
          array(
            'label'       => 'Style 2',
            'value'       => 'style2'
          )
          
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'Product Hover Image',
        'id'          => 'shop_product_hover',
        'type'        => 'on_off',
        'desc'        => 'When enabled, this shows a secondary product image on hover.',
        'section'     => 'shop',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Shop Sidebar',
        'id'          => 'shop_sidebar',
        'type'        => 'radio',
        'desc'        => 'Would you like to display sidebar on shop main and category pages?',
        'choices'     => array(
          array(
            'label'       => 'No Sidebar',
            'value'       => 'no'
          ),
          array(
            'label'       => 'Right Sidebar',
            'value'       => 'right'
          ),
          array(
            'label'       => 'Left Sidebar',
            'value'       => 'left'
          )
        ),
        'std'         => 'no',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'Products per Page',
        'id'          => 'shop_product_count',
        'type'        => 'text',
        'desc'        => 'Number of products to show on shop pages.',
        'std'         => '12',
        'section'     => 'shop'
      ),
      array(
        'id'          => 'shop_tab1',
        'label'       => 'Shop Headers',
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'Shop Header Background',
        'id'          => 'shop_header_bg',
        'type'        => 'upload',
        'desc'        => 'Background settings for the shop header',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'Main Shop Page Menu Color',
        'id'          => 'shop_menu_color',
        'type'        => 'radio',
        'desc'        => 'What color would you like to display for the menu? <small>You can change category headers on individual Edit Category pages</small>',
        'choices'     => array(
          array(
            'label'       => 'Light Menu',
            'value'       => 'background--dark'
          ),
          array(
            'label'       => 'Dark Menu',
            'value'       => 'background--light'
          )
          
        ),
        'std'         => 'background--light',
        'section'     => 'shop'
      ),
      array(
        'id'          => 'shop_tab2',
        'label'       => 'Product Page',
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'Page Style',
        'id'          => 'shop_product_style',
        'type'        => 'radio',
        'desc'        => 'Which style would you like to use on product pages?',
        'choices'     => array(
          array(
            'label'       => 'Style 1',
            'value'       => 'style1'
          ),
          array(
            'label'       => 'Style 2',
            'value'       => 'style2'
          )
          
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'Use Lightbox or Zoom?',
        'id'          => 'shop_product_lightbox',
        'type'        => 'radio',
        'desc'        => 'Would you like to use a lightbox or a mouse hover zoom?',
        'choices'     => array(
          array(
            'label'       => 'Lightbox',
            'value'       => 'lightbox'
          ),
          array(
            'label'       => 'Zoom',
            'value'       => 'zoom'
          )
          
        ),
        'std'         => 'lightbox',
        'section'     => 'shop'
      ),
      array(
        'id'          => 'shop_tab3',
        'label'       => 'My Account',
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'Enable My Account Advertisement?',
        'id'          => 'myaccount-advertisement',
        'type'        => 'on_off',
        'desc'        => 'This will add an Advertisement Image on the top left location of the My Account page',
        'std'         => 'off',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'My Account Advertisement Image',
        'id'          => 'myaccount-ad-bg',
        'type'        => 'background',
        'desc'        => 'You can replace the my-account image from here',
        'section'     => 'shop',
        'condition'   => 'myaccount-advertisement:is(on)'
      ),
      array(
        'label'       => 'My Account Advertisement Link',
        'id'          => 'myaccount-ad-link',
        'type'        => 'text',
        'desc'        => 'You can link the my-account advertisement to your desired page.',
        'section'     => 'shop',
        'condition'   => 'myaccount-advertisement:is(on)'
      ),
      array(
        'id'          => 'shop_tab4',
        'label'       => 'Misc',
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => 'Product "Just Arrived" Badge time',
        'id'          => 'shop_newness',
        'type'        => 'radio',
        'desc'        => 'Products that are added before the below time will display the new product page',
        'choices'     => array(
          array(
            'label'       => 'Never - "Just Arrived" Badge will never be shown',
            'value'       => '0'
          ),
          array(
            'label'       => '1 Day',
            'value'       => '1'
          ),
          array(
            'label'       => '2 Days',
            'value'       => '2'
          ),
          array(
            'label'       => '3 Days',
            'value'       => '3'
          ),
          array(
            'label'       => '1 Week',
            'value'       => '7'
          ),
          array(
            'label'       => '2 Weeks',
            'value'       => '14'
          ),
          array(
            'label'       => '3 Weeks',
            'value'       => '21'
          ),
          array(
            'label'       => '1 Month',
            'value'       => '30'
          )
          
        ),
        'std'         => '7',
        'section'     => 'shop'
      ),
	  array(
        'id'          => 'blog_tab1',
        'label'       => 'General Blog Settings',
        'type'        => 'tab',
        'section'     => 'blog'
      ),
	  array(
        'label'       => 'Blog Header',
        'id'          => 'blog_header',
        'type'        => 'textarea',
        'desc'        => 'This content appears on top of the blog page. You can use your shortcodes here. <small>You can create your content using visual composer and then copy its text here</small>',
        'rows'        => '4',
        'section'     => 'blog'
      ),
		array(
			'label'       => 'Blog Style',
			'id'          => 'blog_style',
			'type'        => 'radio',
			'desc'        => 'Which blog style would you like to use?',
			'choices'     => array(
			  array(
				'label'       => 'Standard',
				'value'       => 'style1'
			  ),
			  array(
				'label'       => 'Masonry',
				'value'       => 'style2'
			  ),
			  array(
			  'label'       => 'Grid',
			  'value'       => 'style3'
			  )
			),
			'std'         => 'style1',
			'section'     => 'blog'
		  ),
      array(
        'id'          => 'blog_tab2',
        'label'       => 'Blog Meta Settings',
        'type'        => 'tab',
        'section'     => 'blog'
      ),
      array(
        'label'       => 'Display post information for',
        'id'          => 'blog_post_meta',
        'type'        => 'checkbox',
        'desc'        => 'You can choose to display various post information',
        'choices'     => array(
          array(
            'label'       => 'Post Date',
            'value'       => 'date'
          ),
          array(
            'label'       => 'Post Author',
            'value'       => 'author'
          ),
          array(
            'label'       => 'Post Categories',
            'value'       => 'category'
          ),
		  array(
            'label'       => 'Post Tags',
            'value'       => 'tag'
          ),
          array(
            'label'       => 'Post Comment Count',
            'value'       => 'comment'
          )
        ),
        'section'     => 'blog'
      ),
      array(
        'id'          => 'misc_tab1',
        'label'       => 'General',
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => 'Login Logo Upload',
        'id'          => 'loginlogo',
        'type'        => 'upload',
        'desc'        => 'You can upload a custom logo for your wp-admin login page here',
        'section'     => 'misc'
      ),
      array(
        'label'       => 'Extra CSS',
        'id'          => 'extra_css',
        'type'        => 'css',
        'desc'        => 'Any CSS that you would like to add to the theme.',
        'section'     => 'misc'
      ),
      array(
        'label'       => 'Google Analytics',
        'id'          => 'ga',
        'type'        => 'textarea-simple',
        'desc'        => 'Google analytics field. Your GA code will be entered at the bottom of the theme.',
        'rows'        => '5',
        'section'     => 'misc'
      ),
	  	array(
        'id'          => 'misc_tab5',
        'label'       => '404 Page',
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
    	  'label'       => 'Display Light or Dark Menu for 404 Page?',
    	  'id'          => '404_menu_color',
    	  'type'        => 'radio',
    	  'desc'        => 'What color would you like to display for the menu? This works with Header - Style 1',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Light Menu',
    	      'value'       => 'background--dark'
    	    ),
    	    array(
    	      'label'       => 'Dark Menu',
    	      'value'       => 'background--light'
    	    )
    	    
    	  ),
    	  'std'         => 'background--light',
        'section'     => 'misc'
    	),
	  	array(
        'label'       => '404 Page Background',
        'id'          => '404-bg',
        'type'        => 'upload',
        'desc'        => 'You can replace the background image for the 404 page here.',
        'section'     => 'misc'
      ),
	  	array(
        'label'       => '404 Page Image',
        'id'          => '404-image',
        'type'        => 'upload',
        'desc'        => 'This will change the actual 404 image in the middle.',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab3',
        'label'       => 'Create Additional Sidebars',
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'sidebars_text',
        'label'       => 'About the sidebars',
        'desc'        => 'All sidebars that you create here will appear both in the Widgets Page(Appearance > Widgets), from where you will have to configure them, and in the pages, where you will be able to choose a sidebar for each page',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => 'Create Sidebars',
        'id'          => 'sidebars',
        'type'        => 'list-item',
        'desc'        => 'Please choose a unique title for each sidebar!',
        'section'     => 'misc',
        'settings'    => array(
          array(
            'label'       => 'ID',
            'id'          => 'id',
            'type'        => 'text',
            'desc'        => 'Please write a lowercase id, with <strong>no spaces</strong>'
          )
        )
      ),
      array(
        'label'       => 'Select Your Demo',
        'id'          => 'demo-select',
        'type'        => 'radio-image',
        'desc'        => '',
        'std'         => '0',
        'section'     => 'import'
      ),
      array(
        'id'          => 'demo_import',
        'label'       => 'About Importing Demo Content',
        'desc'        => '
        <div id="thb-import-messages"></div>
        <p style="text-align:center;"><a class="button button-primary button-hero" id="import-demo-content" href="#">Import Demo Content</a><br /><br />
        <small>Please press only once, and wait till you get the success message above.<br />If you \'re having trouble with import, please see: <a href="https://fuelthemes.ticksy.com/article/2706/">What To Do If Demo Content Import Fails</a></p>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'import'
      ),
      array(
        'id'          => 'customization_tab1',
        'label'       => 'Colors',
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Accent Color',
        'id'          => 'accent_color',
        'type'        => 'colorpicker',
        'desc'        => 'Change the accent color used throughout the theme',
        'section'     => 'customization',
        'std'					=> ''
      ),
      array(
        'label'       => 'Just Arrived Badge Color',
        'id'          => 'badge_justarrived',
        'type'        => 'colorpicker',
        'desc'        => 'You can change the just arrived badge color from here',
        'section'     => 'customization',
        'std'		  => ''
      ),
	  array(
        'label'       => 'On Sale Badge Color',
        'id'          => 'badge_sale',
        'type'        => 'colorpicker',
        'desc'        => 'You can change the on sale badge color from here',
        'section'     => 'customization',
        'std'		  => ''
      ),
	  array(
        'label'       => 'Out of Stock Badge Color',
        'id'          => 'badge_outofstock',
        'type'        => 'colorpicker',
        'desc'        => 'You can change the out of stock badge color from here',
        'section'     => 'customization',
        'std'		  => ''
      ),
	  array(
        'id'          => 'customization_tab5',
        'label'       => 'Menu Customization',
        'type'        => 'tab',
        'section'     => 'customization'
      ),
	  array(
        'id'          => 'menu_margin',
        'label'       => 'Top Level Menu Item Margin',
        'desc'        => 'If you want to fit more menu items to the given space, you can decrease the margin between them here. The default margin is 40px',
        'std'         => '',
        'type'        => 'measurement',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab2',
        'label'       => 'Typography',
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Font Subsets',
        'id'          => 'font_subsets',
        'type'        => 'radio',
        'desc'        => 'You can add additional character subset specific to your language.',
        'choices'     => array(
        	array(
        	  'label'       => 'No Subset',
        	  'value'       => 'no-subset'
        	),
          array(
            'label'       => 'Greek',
            'value'       => 'greek'
          ),
          array(
            'label'       => 'Cyrillic',
            'value'       => 'cyrillic'
          ),
          array(
            'label'       => 'Vietnamese',
            'value'       => 'vietnamese'
          )
        ),
        'std'         => 'no-subset',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Title Typography',
        'id'          => 'title_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for the titles',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Body Text Typography',
        'id'          => 'body_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for general body font',
        'section'     => 'customization'
      ),
	  array(
        'label'       => 'Main Menu Typography',
        'id'          => 'menu_left_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for the main menu',
        'section'     => 'customization'
      ),
	  array(
        'label'       => 'Main Menu Submenu Typography',
        'id'          => 'menu_left_submenu_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for the submenu elements of the main menu',
        'section'     => 'customization'
      ),
	  array(
        'label'       => 'Secondary Menu Typography',
        'id'          => 'menu_right_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for the secondary menu',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Mobile Menu Typography',
        'id'          => 'menu_mobile_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for the mobile menu',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Mobile Menu Submenu Typography',
        'id'          => 'menu_mobile_submenu_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for the submenu elements of the mobile menu',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Secondary Mobile Menu Typography',
        'id'          => 'menu_mobile_secondary_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for the secondary mobile menu',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab3',
        'label'       => 'Backgrounds',
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Header Background',
        'id'          => 'header_bg',
        'type'        => 'background',
        'desc'        => 'Background settings for the header',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Footer Background',
        'id'          => 'footer_bg',
        'type'        => 'background',
        'desc'        => 'Background settings for the footer.',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'footer_tab1',
        'label'       => 'General',
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Display Footer',
        'id'          => 'footer',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display the Footer?',
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Footer Style',
        'id'          => 'footer_style',
        'type'        => 'radio',
        'desc'        => 'Which Footer Style would you like to use?',
        'choices'     => array(
          array(
            'label'       => 'Style 1',
            'value'       => 'style1'
          ),
          array(
            'label'       => 'Style 2',
            'value'       => 'style2'
          )
        ),
        'std'         => 'style1',
        'section'     => 'footer'
      ),
	  	array(
        'label'       => 'Language Switcher',
        'id'          => 'footer_ls',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display the language switcher in the footer? <small>Requires that you have WPML installed. <a href="https://wpml.org/?aid=85928&affiliate_key=PIP3XupfKQOZ">You can purchase WPML here.</a></small>',
        'section'     => 'footer',
        'std'         => 'off'
      ),
	  	array(
        'label'       => 'Currency Switcher',
        'id'          => 'footer_cs',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display the curreny switcher in the footer? <small>Requires that you have WPML + Woocommerce Multilanguage installed. <a href="https://wpml.org/?aid=85928&affiliate_key=PIP3XupfKQOZ">You can purchase WPML + Woocommerce Multilanguage here.</a></small>',
        'section'     => 'footer',
        'std'         => 'off'
      ),
	  	array(
    	  'label'       => 'Display Social Icons or Payment Methods?',
    	  'id'          => 'social-payment',
    	  'type'        => 'radio',
    	  'desc'        => 'Would you like to display social icons or payment methods on the right side of the footer?',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Social Icons',
    	      'value'       => 'social'
    	    ),
    	    array(
    	      'label'       => 'Payment Methods',
    	      'value'       => 'payment'
    	    )
    	    
    	  ),
    	  'std'         => 'payment',
    	  'section'     => 'footer'
    	),
      array(
        'label'       => 'Copyright Text',
        'id'          => 'copyright',
        'type'        => 'text',
        'desc'        => 'Copyright Text at the bottom left',
        'section'     => 'footer'
      ),
	  array(
        'id'          => 'footer_tab2',
        'label'       => 'Footer Products',
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'id'          => 'footer_style_text',
        'label'       => '',
        'desc'        => 'These settings will be used only if the Footer Style is set to Style 1',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'footer'
      ),
	  array(
    	  'label'       => 'Display Footer Products Toggle?',
    	  'id'          => 'footer_products',
    	  'type'        => 'on_off',
    	  'desc'        => 'Would you like to display the footer products toggle?',
    	  'std'         => 'on',
    	  'section'     => 'footer'
    	),
		array(
    	  'label'       => 'Footer Product Selection',
    	  'id'          => 'footer_products_radio',
    	  'type'        => 'radio',
    	  'desc'        => 'What would you like to show on the footer product toggle?',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Just Arrived, Best Sellers, Featured Products',
    	      'value'       => 'just'
    	    ),
    	    array(
    	      'label'       => 'Product Categories',
    	      'value'       => 'cat'
    	    ),
    	    array(
    	      'label'       => 'Widgets',
    	      'value'       => 'wid'
    	    )
    	    
    	  ),
    	  'std'         => 'just',
    	  'section'     => 'footer',
    	  'condition'   => 'footer_products:is(on)'
    	),
    	array(
    	  'label'       => 'Number of Footer Products',
    	  'id'          => 'footer_products_count',
    	  'desc'        => 'Value should be between 6-12',
    	  'std'         => '6',
    	  'type'        => 'numeric-slider',
    	  'section'     => 'footer',
    	  'min_max_step'=> '6,12,1',
    	  'condition'   => 'footer_products:is(on),footer_products_radio:not(wid)'
    	),
    	array(
    	  'label'       => 'Footer Product Sections',
    	  'id'          => 'footer_products_sections',
    	  'type'        => 'checkbox',
    	  'desc'        => 'Select which sections you would like to show.',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Just Arrived',
    	      'value'       => 'just-arrived'
    	    ),
    	    array(
    	      'label'       => 'Best Sellers',
    	      'value'       => 'best-sellers'
    	    ),
    	    array(
    	      'label'       => 'Featured',
    	      'value'       => 'featured'
    	    )
    	  ),
    	  'std'         => '1',
    	  'section'     => 'footer',
    	  'condition'   => 'footer_products:is(on),footer_products_radio:is(just)'
    	),
		array(
			'label'       => 'Select Categories to show',
			'id'          => 'footer_products_categories',
			'type'        => 'product_category_checkbox',
			'desc'        => '',
			'section'     => 'footer',
			  'condition'   => 'footer_products:is(on),footer_products_radio:is(cat)'
        ),
		array(
			'label'       => 'Footer Column Layout',
			'id'          => 'footer_columns',
			'type'        => 'radio-image',
			'desc'        => 'You can change the layout of footer columns here',
			'std'         => 'fourcolumns',
			'section'     => 'footer',
			  'condition'   => 'footer_products:is(on),footer_products_radio:is(wid)'
		  ),
      array(
        'id'          => 'footer_tab3',
        'label'       => 'Social Icons',
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Facebook Link',
        'id'          => 'fb_link',
        'type'        => 'text',
        'desc'        => 'Facebook profile/page link',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Pinterest Link',
        'id'          => 'pinterest_link',
        'type'        => 'text',
        'desc'        => 'Pinterest profile/page link',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Twitter Link',
        'id'          => 'twitter_link',
        'type'        => 'text',
        'desc'        => 'Twitter profile/page link',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Google Plus Link',
        'id'          => 'googleplus_link',
        'type'        => 'text',
        'desc'        => 'Google Plus profile/page link',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Linkedin Link',
        'id'          => 'linkedin_link',
        'type'        => 'text',
        'desc'        => 'Linkedin profile/page link',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Instagram Link',
        'id'          => 'instragram_link',
        'type'        => 'text',
        'desc'        => 'Instagram profile/page link',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Youtube Link',
        'id'          => 'yt_link',
        'type'        => 'text',
        'desc'        => 'Youtube profile/page link',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Xing Link',
        'id'          => 'xing_link',
        'type'        => 'text',
        'desc'        => 'Xing profile/page link',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Tumblr Link',
        'id'          => 'tumblr_link',
        'type'        => 'text',
        'desc'        => 'Tumblr profile/page link',
        'section'     => 'footer'
      ),
	  array(
        'label'       => 'Vkontakte Link',
        'id'          => 'vk_link',
        'type'        => 'text',
        'desc'        => 'Vkontakte profile/page link',
        'section'     => 'footer'
      ),
      array(
        'id'          => 'footer_tab4',
        'label'       => 'Payment Icons',
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Visa',
        'id'          => 'payment_visa',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display Visa logo?',
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => 'MasterCard',
        'id'          => 'payment_mc',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display MasterCard logo?',
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => 'PayPal',
        'id'          => 'payment_pp',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display PayPal logo?',
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Discover',
        'id'          => 'payment_discover',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display Discover logo?',
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Amazon Payments',
        'id'          => 'payment_amazon',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display Amazon Payments logo?',
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Stripe',
        'id'          => 'payment_stripe',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display Stripe logo?',
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => 'American Express',
        'id'          => 'payment_amex',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display American Express logo?',
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Diners Club',
        'id'          => 'payment_diners',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display Diners Club logo?',
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Google Wallet',
        'id'          => 'payment_wallet',
        'type'        => 'on_off',
        'desc'        => 'Would you like to display Google Wallet logo?',
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'id'          => 'twitter_text',
        'label'       => 'About Contact Page Settings',
        'desc'        => 'These settings will be used for the map inside Contact page template.',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'contact'
      ),
      array(
        'label'       => 'Google Maps API Key',
        'id'          => 'map_api_key',
        'type'        => 'text',
        'desc'        => 'Please enter the Google Maps Api Key. <small>You need to create a browser API key. For more information, please visit: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a></small>',
        'section'     => 'contact'
      ),
  		array(
  		  'label'       => 'Map Style',
  		  'id'          => 'contact_map_style',
  		  'type'        => 'radio',
  		  'desc'        => 'You can select different color settings for the map here',
  		  'choices'     => array(
  		    array(
  		      'label'       => 'No Style',
  		      'value'       => '0'
  		    ),
  		    array(
  		      'label'       => 'Paper (Default)',
  		      'value'       => '1'
  		    ),
  		    array(
  		      'label'       => 'Light Monochrome',
  		      'value'       => '2'
  		    ),
  		    array(
  		      'label'       => 'Subtle',
  		      'value'       => '3'
  		    ),
  		    array(
  		      'label'       => 'Cool Grey',
  		      'value'       => '4'
  		    ),
  		    array(
  		      'label'       => 'Bentley',
  		      'value'       => '5'
  		    ),
  		    array(
  		      'label'       => 'Icy Blue',
  		      'value'       => '6'
  		    ),
  		    array(
  		      'label'       => 'Turquoise Water',
  		      'value'       => '7'
  		    )
  		    
  		  ),
  		  'std'         => '1',
  		  'section'     => 'contact'
  		),
		  array(
		  	'label'       => 'Map Zoom Amount',
		    'id'          => 'contact_zoom',
		    'desc'        => 'Value should be between 1-18, 1 being the entire earth and 18 being right at street level.',
		    'std'         => '17',
		    'type'        => 'numeric-slider',
		    'section'     => 'contact',
		    'min_max_step'=> '1,18,1'
		  ),
		  array(
		    'label'       => 'Map Pin Image',
		    'id'          => 'map_pin_image',
		    'type'        => 'upload',
		    'desc'        => 'If you would like to use your own pin, you can upload it here',
		    'section'     => 'contact'
		  ),
		  array(
		    'label'       => 'Map Center Latitude',
		    'id'          => 'map_center_lat',
		    'type'        => 'text',
		    'desc'        => 'Please enter the latitude for the maps center point. <small>You can get lat-long coordinates using <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Latlong.net</a></small>',
		    'section'     => 'contact'
		  ),
		  array(
		    'label'       => 'Map Center Longtitude',
		    'id'          => 'map_center_long',
		    'type'        => 'text',
		    'desc'        => 'Please enter the longitude for the maps center point.',
		    'section'     => 'contact'
		  ),
		  array(
		    'label'       => 'Google Map Pin Locations',
		    'id'          => 'map_locations',
		    'type'        => 'list-item',
		    'desc'        => 'Coordinates to shop on the map',
		    'settings'    => array(
		      array(
		        'label'       => 'Coordinates',
		        'id'          => 'lat_long',
		        'type'        => 'text',
		        'desc'        => 'Coordinates of this location separated by comma. <small>You can get lat-long coordinates using <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Latlong.net</a></small>',
		        'rows'        => '1'
		      ),
		      array(
		        'label'       => 'Location Image',
		        'id'          => 'image',
		        'type'        => 'upload',
		        'desc'        => 'You can upload your own location image here. Suggested image size is 110x115'
		      ),
		      array(
		        'label'       => 'Information',
		        'id'          => 'information',
		        'type'        => 'textarea',
		        'desc'        => 'This content appears below the title of the tooltip',
		        'rows'        => '2',
		      ),
		    ),
		    'section'     => 'contact'
		  )
    )
  );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }

  
  // Add Revolution Slider select option
  function add_revslider_select_type( $array ) {

    $array['revslider-select'] = 'Revolution Slider Select';
    return $array;

  }
  add_filter( 'ot_option_types_array', 'add_revslider_select_type' ); 

  // Show RevolutionSlider select option
  function ot_type_revslider_select( $args = array() ) {
    extract( $args );
    $has_desc = $field_desc ? true : false;
    echo '<div class="format-setting type-revslider-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
    echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      echo '<div class="format-setting-inner">';
      // Add This only if RevSlider is Activated
      if ( class_exists( 'RevSliderAdmin' ) ) {
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

        /* get revolution array */
        $slider = new RevSlider();
        $arrSliders = $slider->getArrSlidersShort();

        /* has slides */
        if ( ! empty( $arrSliders ) ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          foreach ( $arrSliders as $rev_id => $rev_slider ) {
            echo '<option value="' . esc_attr( $rev_id ) . '"' . selected( $field_value, $rev_id, false ) . '>' . esc_attr( $rev_slider ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Sliders Found', 'option-tree' ) . '</option>';
        }
        echo '</select>';
      } else {
          echo '<span style="color: red;">' . __( 'Sorry! Revolution Slider is not Installed or Activated', 'ventus' ). '</span>';
      }
      echo '</div>';
    echo '</div>';
  }
}

/**
 * Menu Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_menu_select' ) ) {
  
  function ot_type_menu_select( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build category */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* get category array */
        $menus = get_terms( 'nav_menu');
        
        /* has cats */
        if ( ! empty( $menus ) ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          foreach ( $menus as $menu ) {
            echo '<option value="' . esc_attr( $menu->slug ) . '"' . selected( $field_value, $menu->slug, false ) . '>' . esc_attr( $menu->name ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Menus Found', 'option-tree' ) . '</option>';
        }
        
        echo '</select>';
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Product Category Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_product_category_checkbox' ) ) {
  
  function ot_type_product_category_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* get category array */

		$args = array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => '0'
		);

		$categories = get_terms( apply_filters( 'ot_type_category_checkbox_query', 'product_cat', $args, $field_id ) );
        
        /* build categories */
        if ( ! empty( $categories ) ) {
          foreach ( $categories as $category ) {
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $category->term_id ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $category->term_id ) . '" value="' . esc_attr( $category->term_id ) . '" ' . ( isset( $field_value[$category->term_id] ) ? checked( $field_value[$category->term_id], $category->term_id, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $category->term_id ) . '">' . esc_attr( $category->name ) . '</label>';
            echo '</p>';
          } 
        } else {
          echo '<p>' . __( 'No Product Categories Found', 'option-tree' ) . '</p>';
        }
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}