<?php  

global $wp_version;

$wp_logo = function_exists( 'has_custom_logo' ) && has_custom_logo() ;

$yiw_options['general'] = array (

    /* =================== SKIN =================== */
    'select-skin' => array(    
        array( 'name' => __('General Settings', 'yiw'),
        	   'type' => 'title'),
    
        array( 'name' => __('Select skin', 'yiw'),
        	   'type' => 'section',
               'effect' => 0),
        array( 'type' => 'open'),                 
         
        array( 'name' => __('Theme skin', 'yiw'),
        	   'desc' => __('Select the skin you want to use in this theme. NB: if you want to change the skin, select it before continue.', 'yiw'),
        	   'yiw-callback-save' => 'yiw_select_skin_option',
        	   'id' => 'select_skin',
        	   'type' => 'select_skin',
        	   'options' => array(
        	        '' => '',
                    'elegant' => __( 'Elegant', 'yiw' ),
                    'creative' => __( 'Creative', 'yiw' )
               ),
        	   'button' => __( 'Select', 'yiw' ),
               'std' => '' ),

        array( 'name' => __('Activate responsive', 'yiw'),
        	   'desc' => __('Select if you want to active or not the responsive', 'yiw'),
        	   'id' => 'responsive',
        	   'type' => 'on-off',
        	   'button' => __( 'Save', 'yiw' ),
               'std' => 1 ),

        array( 'name' => __('Activate select menu', 'yiw'),
            'desc' => __('Select if you want to active or not replace the standard menu to the select menu on mobile', 'yiw'),
            'id' => 'responsive-menu',
            'type' => 'on-off',
            'button' => __( 'Save', 'yiw' ),
            'std' => 0,
            'deps' => array(
                'id' => 'responsive',
                'value' => 1
            ),
        ),
        	
        array( 'type' => 'close')
    ),        
    /* =================== END SKIN =================== */
	 
    /* =================== GENERAL =================== */
    'general' => array(    
        array( 'name' => __('General', 'yiw'),
        	   'type' => 'section'),
        array( 'type' => 'open'),                 
        	
        array( 'name' => __('Layout theme', 'yiw'),
        	   'desc' => __('Select the general layout of the theme.', 'yiw'),
        	   'id' => 'theme_layout',
        	   'type' => 'select',
        	   'options' => array(
			   		'stretched' => __( 'Stretched', 'yiw' ),
			   		'boxed' => __( 'Boxed', 'yiw' ),
			   ),
        	   'std' => 'stretched' ),	
        	
        version_compare( $wp_version, '4.3', '>=' ) ? false : array( 'name' => __('Custom Favicon', 'yiw'),
        	   'desc' => __('A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image', 'yiw'),
        	   'id' => 'favicon',
        	   'type' => 'upload',
        	   'std' => get_template_directory_uri() .'/favicon.ico'),		  
        	
        array( 'name' => __('Custom Style', 'yiw'),
        	   'desc' => __('You can write here your custom css, that will replace the default css.', 'yiw'),
        	   'id' => 'custom_style',
        	   'type' => 'textarea',
        	   'std' => ''),	     
        	
        array( 'name' => __('Google Analytics Code', 'yiw'),
        	   'desc' => __('You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.', 'yiw'),
        	   'id' => 'ga_code',
        	   'type' => 'textarea',
        	   'std' => ''),
        array(
            'id' => 'general-lock-down-admin',
            'type' => 'on-off',
            'name' => __( 'Disable WP admin bar', 'yiw' ),
            'desc' => __( 'Enable this option to disable the wordpress admin bar in frontend for user are logged in', 'yiw' ),
            'std' => apply_filters( 'yit_general-lock-down-admin_std', 'no' )
        ),
        	
        array( 'type' => 'close')
    ),        
    /* =================== END GENERAL =================== */
    
                                                 
    /* =================== HEADER =================== */
    'header' => array(
        array( 'name' => __('Header', 'yiw'),
        	   'type' => 'section'),
        array( 'type' => 'open'),                 
        	
        array( 'name' => __('Header Background', 'yiw'),
        	   'desc' => __('Select the type of header background.', 'yiw'),
        	   'id' => 'header_bg_type',     
        	   'type' => 'select',
        	   'options' => array(
			   		'color-unit' => __( 'Color Unit', 'yiw' ),
			   		'bg-image' => __( 'Image', 'yiw' )
			   ),
        	   'std' => 'bg-image' ),             
        	
        array( 'name' => __('Header Color', 'yiw'),
        	   'desc' => __('Select the type of header background.', 'yiw'),
        	   'id' => 'header_bg_color',     
        	   'type' => 'color-picker',
        	   'std' => '#000000' ),            
        	
        array( 'name' => __('Header Image', 'yiw'),
        	   'desc' => __('Select the type of header background or if you want to upload a own bg image.', 'yiw'),
        	   'id' => 'header_bg_image',     
        	   'type' => 'header_preview',
        	   'options' => array(
			   		'images/headers/001.jpg' => __( 'Blue 1', 'yiw' ),   
			   		'images/headers/007.jpg' => __( 'Blue 2', 'yiw' ),
			   		'images/headers/002.jpg' => __( 'Black 1', 'yiw' ),   
			   		'images/headers/010.jpg' => __( 'Black 2', 'yiw' ),
			   		'images/headers/003.jpg' => __( 'Bokeh', 'yiw' ),
			   		'images/headers/004.jpg' => __( 'Blue grey', 'yiw' ),
			   		'images/headers/005.jpg' => __( 'Fuchsia', 'yiw' ),
			   		'images/headers/006.jpg' => __( 'Dark Brown', 'yiw' ),
			   		'images/headers/008.jpg' => __( 'Brown', 'yiw' ),
			   		'images/headers/009.jpg' => __( 'Dark green', 'yiw' ), 
			   		'custom' => __( 'Custom', 'yiw' ),
			   ),
        	   'deps' => array(
			   		'id' => 'header_bg_type',
			   		'value' => 'bg-image'
			   ),
        	   'std' => 'images/headers/002.jpg' ), 
        	
        array( 'name' => __('Header Image Custom', 'yiw'),
        	   'desc' => __('Upload your background image.', 'yiw'),
        	   'id' => 'header_bg_image_custom',     
        	   'type' => 'upload',
        	   'deps' => array(
			   		'id' => 'header_bg_image',
			   		'value' => 'custom'
			   ),
        	   'std' => '' ),    
        	
        array( 'name' => __('Header Image Repeat', 'yiw'),
        	   'desc' => __('The repeat attribute of header image uploaded above.', 'yiw'),
        	   'id' => 'header_bg_image_custom_repeat',     
        	   'type' => 'select',
        	   'options' => array(
			   		'repeat' => __( 'Repeat', 'yiw' ),
			   		'repeat-x' => __( 'Repeat Horizontally', 'yiw' ),
			   		'repeat-y' => __( 'Repeat Vertically', 'yiw' ),
			   		'no-repeat' => __( 'No Repeat', 'yiw' ),
			   ),
        	   'deps' => array(
			   		'id' => 'header_bg_image',
			   		'value' => 'custom'
			   ),
        	   'std' => 'no-repeat' ),  
        	
        array( 'name' => __('Header Image Position', 'yiw'),
        	   'desc' => __('The position attribute of header image uploaded above.', 'yiw'),
        	   'id' => 'header_bg_image_custom_position',     
        	   'type' => 'select',
        	   'options' => array(          
			   		'center' => __( 'Center', 'yiw' ),
			   		'top left' => __( 'Top left', 'yiw' ),
			   		'top center' => __( 'Top center', 'yiw' ),
			   		'top right' => __( 'Top right', 'yiw' ),
			   		'bottom left' => __( 'Bottom left', 'yiw' ),
			   		'bottom center' => __( 'Bottom center', 'yiw' ),
			   		'bottom right' => __( 'Bottom right', 'yiw' ),
			   ),
        	   'deps' => array(
			   		'id' => 'header_bg_image',
			   		'value' => 'custom'
			   ),
        	   'std' => 'bottom center' ),

        $wp_logo ? false : array( 'name' => __('Active logo image', 'yiw'),
        	   'desc' => __('If yes, you can replace an image to the logo section, uploading it on option below. If no, you write the site title on wp settings.', 'yiw'),
        	   'id' => 'show_image_logo',     
        	   'type' => 'on-off',
        	   'std' => 0 ),

        $wp_logo ? false : array( 'name' => __('Logo URL', 'yiw'),
        	   'desc' => __('Enter the URL to your logo image.', 'yiw'),
        	   'id' => 'logo',     
        	   'type' => 'upload',
        	   'deps' => array(
			   		'id' => 'show_image_logo',
			   		'value' => 1
			   ),
        	   'std' => get_template_directory_uri() .'/images/logo.png'),               
        	
        array( 'name' => __('Show description logo', 'yiw'),
        	   'desc' => __('Select if you want to show the description near the logo. Configure it on Settings -> General.', 'yiw'),
        	   'id' => 'show_description_logo',     
        	   'type' => 'on-off',
        	   'std' => 1 ),                   
        	
        array( 'name' => __('Navigation Style', 'yiw'),
        	   'desc' => __('Select the type of navigation.', 'yiw'),
        	   'id' => 'nav_type',     
        	   'type' => 'select',
        	   'options' => array(
			   		'elegant' => __( 'Elegant', 'yiw' ),
			   		'creative' => __( 'Creative', 'yiw' ),
			   ),
        	   'std' => 'elegant'),  
        	
        array( 'name' => __('Show search form', 'yiw'),
        	   'desc' => __('Select if you want to show the search form near the navigation.', 'yiw'),
        	   'id' => 'show_searchform',     
        	   'type' => 'on-off',
        	   'std' => 1 ),
        
        array( 'name' => __('Search for', 'yiw'),
        	   'desc' => __('Select what to search in main search form.', 'yiw'),
        	   'id' => 'search_form_post_type',
        	   'type' => 'select',
        	   'options' => array(
                    'product' => __( 'Products', 'yiw' ),
                    'post' => __( 'Posts', 'yiw' ),
               ),
               'deps' => array(
			   		'id' => 'show_searchform',
			   		'value' => 1
			   ),
        	   'std' => 'post'),
        
        array( 'type' => 'close')
    ),   
    /* =================== END HEADER =================== */
    
                                                 
    /* =================== LINKS BAR =================== */
    'linksbar' => array(
        array( 'name' => __('Links Bar', 'yiw'),
        	   'type' => 'section'),
        array( 'type' => 'open'),      
        	
        array( 'name' => __('Show Links bar', 'yiw'),
        	   'desc' => __('Select if you want to show the bar of links, shown near logo on header section.', 'yiw'),
        	   'id' => 'show_linksbar',     
        	   'type' => 'on-off',
        	   'std' => 1 ),       
        	
        array( 'name' => __('Show Cart widget', 'yiw'),
        	   'desc' => __('Select if you want to show the cart widget of shop on bar of links.', 'yiw'),
        	   'id' => 'show_linksbar_cart',     
        	   'type' => 'on-off',
        	   'deps' => array(
			   		'id' => 'show_linksbar',
			   		'value' => 1
			   ),
        	   'std' => 1 ),
        	
        array( 'name' => __('Show Login link', 'yiw'),
        	   'desc' => __('Select if you want to show the "Login" link on bar of links.', 'yiw'),
        	   'id' => 'show_linksbar_login',     
        	   'type' => 'on-off',  
        	   'deps' => array(
			   		'id' => 'show_linksbar',
			   		'value' => 1
			   ),
        	   'std' => 1 ),      
        
        array( 'type' => 'close')
    ),   
    /* =================== END LINKS BAR =================== */
    
                                                 
    /* =================== BLOG =================== */
    'blog' => array(
        array( 'name' => __('Blog Settings', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),         
               
        array( 'name' => __('Blog Type', 'yiw'),
               'desc' => __('Say the layout for your blog page.', 'yiw'),
               'id' => 'blog_type',
               'type' => 'select',
               'options' => array('big' => __('Big Thumbnail', 'yiw'), 'small' => __('Small Thumbnail', 'yiw')),
               'std' => 'big'),
/*
        array( 'name' => __('Items', 'yiw'),
               'desc' => __('Select how many items you want to show on Blog Page', 'yiw'),
               'id' => 'posts_per_page',
               'min' => 1,
               'max' => 50,
               'type' => 'slider_control',
               'std' => 10),          
*/
        array( 'name' => __('Exclude categories', 'yiw'),
               'desc' => __('Select witch categories you want exlude from blog.', 'yiw'),
               'id' => 'blog_cats_exclude',
               'type' => 'cat',
               'cols' => 2,          // number of columns for multickecks
               'heads' => array(__('Blog Page', 'yiw'), __('List cat. sidebar', 'yiw')),  // in case of multi columns, specific the head for each column
               'std' => ''),          
/*
        array( 'name' => __('Show post date', 'yiw'),
               'desc' => __('Select if you want to show the date in your posts.', 'yiw'),
               'id' => 'blog_show_date',
               'type' => 'on-off',
               'std' => 1 ),
*/
        array( 'name' => __('Read more text', 'yiw'),
               'desc' => __('Write what you want to show on more link', 'yiw'),
               'id' => 'blog_read_more_text',
               'type' => 'text',
               'std' => 'Read more' ),
               
/*
        array( 'name' => __('Featured Images Alignment', 'yiw'),
               'desc' => __('Specific the featured images alignment', 'yiw'),
               'id' => 'blog_image_align',
               'type' => 'select',
               'options' => array(
                    'alignleft' => 'Left', 
                    'alignright' => 'Right', 
                    'aligncenter' => 'Center'
                ),
               'std' => 'aligncenter'),
            
        array( 'name' => __('Featured Images Size', 'yiw'),
               'desc' => __('Specific the featured images size', 'yiw'),
               'id' => 'blog_image_size',
               'type' => 'select',
               'options' => array(
                    'post-thumbnail' => 'Standard', 
                    'thumbnail' => 'Thumbnail', 
                    'medium' => 'Medium',
                    'large' => 'Large',
                    'custom' => 'Custom'
                ),
               'std' => 'post-thumbnail'),
            
        array( 'name' => __('Featured Images Width', 'yiw'),
               'desc' => __('Specific the featured images width, <strong>if you have selected custom size on option above.</strong>', 'yiw'),
               'id' => 'blog_image_width',
               'type' => 'text',
               'std' => ''),
            
        array( 'name' => __('Featured Images Height', 'yiw'),
               'desc' => __('Specific the featured images height, <strong>if you have selected custom size on option above.</strong>', 'yiw'),
               'id' => 'blog_image_height',
               'type' => 'text',
               'std' => ''),
*/
        array( 'type' => 'close')   
    ),
    /* =================== END BLOG =================== */  
    
                                                      
    /* =================== NEWSLETTER =================== */  
    'newsletter-form' => array(
        array( 'name' => __('Newsletter form', 'yiw'),
        	   'type' => 'section'),
        array( 'type' => 'open'),         
        	
        array( 'name' => __('Show', 'yiw'),
        	   'desc' => __('Select if you want to show the newsletter form, above the footer.', 'yiw'),
        	   'id' => 'newsletter_form_show',
        	   'type' => 'on-off',
        	   'std' => 1),          
        	
        array( 'name' => __('Title', 'yiw'),
        	   'desc' => __('The title of this section, shown bolded.', 'yiw'),
        	   'id' => 'newsletter_form_title',
        	   'type' => 'text',
        	   'std' => 'Stay Updated:'), 
        	
        array( 'name' => __('Description', 'yiw'),
        	   'desc' => __('A description of this section, shown near the title.', 'yiw'),
        	   'id' => 'newsletter_form_description',
        	   'type' => 'text',
        	   'std' => 'subscribe our special newsletter'), 
        	
        array( 'name' => __('Technical information', 'yiw'),
        	   'desc' => __('The options below are for the configuration of the newsletter form. to make functional the form, you need to link it with an external services and you can do it configurating it with the options below.', 'yiw'),
        	   'type' => 'simple-text'),        
        	
        array( 'name' => __('Action', 'yiw'),
        	   'desc' => __('The page where make the request (&lt;form <strong>action=""</strong>&gt;).', 'yiw'),
        	   'id' => 'newsletter_form_action',
        	   'type' => 'text',
        	   'std' => ''),                
        	
        array( 'name' => __('Method of request', 'yiw'),
        	   'desc' => __('The method of the form request (&lt;form <strong>method="POST|GET"</strong>&gt;).', 'yiw'),
        	   'id' => 'newsletter_form_method',
        	   'type' => 'select',
        	   'options' => array(
                    'post' => 'POST',
                    'get' => 'GET'
               ),
        	   'std' => 'post'),
        	
        array( 'name' => __('Identification name of the "Name" field', 'yiw'),
        	   'desc' => __('Configure the identification name of the "Name" field, to allow the script to comunicate the value of this field to the external services (&lt;input <strong>name=""</strong>... /&gt;).', 'yiw'),
        	   'id' => 'newsletter_form_name',
        	   'type' => 'text',
        	   'std' => 'fullname'),
        	
        array( 'name' => __('Identification name of the "Email" field', 'yiw'),
        	   'desc' => __('Configure the identification name of the "Email" field, to allow the script to comunicate the value of this field to the external services (&lt;input <strong>name=""</strong>... /&gt;).<br><small>( NOTE: Mailchimp needs this attribute "EMAIL" uppercased )</small>', 'yiw'),
        	   'id' => 'newsletter_form_email',
        	   'type' => 'text',
        	   'std' => 'email'),
        	
        array( 'name' => __('Label of "Name" field', 'yiw'),
        	   'desc' => __('The label of the "Name" field.', 'yiw'),
        	   'id' => 'newsletter_form_label_name',
        	   'type' => 'text',
        	   'std' => __( 'Your name', 'yiw' )),
        	
        array( 'name' => __('Label of "Email" field', 'yiw'),
        	   'desc' => __('The label of the "Email" field.', 'yiw'),
        	   'id' => 'newsletter_form_label_email',
        	   'type' => 'text',
        	   'std' => __( 'Your email', 'yiw' )),
        	
        array( 'name' => __('Label of "Submit" button', 'yiw'),
        	   'desc' => __('The label of the "Submit" button.', 'yiw'),
        	   'id' => 'newsletter_form_label_submit',
        	   'type' => 'text',
        	   'std' => __( 'Subscribe', 'yiw' )),
        	
        array( 'name' => __('Hidden fields', 'yiw'),
        	   'desc' => __('Optional: In this option you can set the hidden fields, to write in serializate way (es. field1=value1&field2=value2&field3=value3&...&fieldN=valueN).', 'yiw'),
        	   'id' => 'newsletter_form_label_hidden_fields',
        	   'type' => 'text',
        	   'std' => ''),
        
        array( 'type' => 'close')   
    ),
    /* =================== END NEWSLETTER =================== */  
    
                                                      
    /* =================== FOOTER =================== */
    'footer' => array(
        array( 'name' => __('Footer', 'yiw'),
        	   'type' => 'section'),
        array( 'type' => 'open'),     
         
        array( 'name' => __('Show footer', 'yiw'),
        	   'desc' => __('Select if you want to show the big footer, above the copyright section. Configure it on widgets admin panel, on "Footer Main" and "Footer Sidebar" widget.', 'yiw'),
        	   'id' => 'show_footer',
        	   'type' => 'on-off',
        	   'std' => 1),  
         
        array( 'name' => __('Footer Layout', 'yiw'),
        	   'desc' => __('Select the layout of footer, if you want the sidebar, divided by a boder, or only one section, without sidebar and border divider.', 'yiw'),
        	   'id' => 'footer_layout',
        	   'type' => 'select',
        	   'options' => array(
					'sidebar-left' => __( 'with left sidebar', 'yiw' ), 
					'sidebar-right' => __( 'with right sidebar', 'yiw' ), 
					'no-sidebar' => __( 'without sidebar', 'yiw' )
				),
				'deps' => array(
					'id' => 'show_footer',
					'value' => 1
				),
        	   'std' => 'sidebar-right'),  
         
        array( 'name' => __('Columns of footer main section.', 'yiw'),
        	   'desc' => __('Select number of columns for the main footer section.', 'yiw'),
        	   'id' => 'footer_columns',
        	   'type' => 'slider_control',
			   'min' => 1,
			   'max' => 5,
			   'step' => 1,  
			   'deps' => array(
					'id' => 'show_footer',
					'value' => 1
			   ),
        	   'std' => 3),  
         
        array( 'name' => __('Copyright Section', 'yiw'),
        	   'desc' => __('Select the copyright layout type for the theme', 'yiw'),
        	   'id' => 'copyright_type',
        	   'type' => 'select',
        	   'options' => array(
					'two-columns' => __( 'Two Columns Footer', 'yiw' ), 
					'centered' => __( 'Centered Footer', 'yiw' )
				),
        	   'std' => 'two-columns'),  
        	
        array( 'name' => __('Copyright centered text', 'yiw'),
        	   'desc' => __('Enter text used in <strong>centered footer</strong>. It can be HTML.', 'yiw'),
        	   'id' => 'copyright_text_centered',
        	   'type' => 'textarea',
        	   'deps' => array(
			   		'id' => 'copyright_type',
			   		'value' => 'centered'
			   ),
        	   'std' => '' ),
        	
        array( 'name' => __('Copyright copyright text Left', 'yiw'),
        	   'desc' => __('Enter text used in the left side of the footer. It can be HTML.', 'yiw'),
        	   'id' => 'copyright_text_left',
        	   'type' => 'textarea',    
        	   'deps' => array(
			   		'id' => 'copyright_type',
			   		'value' => 'two-columns'
			   ),
        	   'std' => '[logo]%name_site%[/logo] [credit]' ),
        	
        array( 'name' => __('Copyright copyright text Right', 'yiw'),
        	   'desc' => __('Enter text used in the right side of the footer. It can be HTML.', 'yiw'),
        	   'id' => 'copyright_text_right',
        	   'type' => 'textarea',        
        	   'deps' => array(
			   		'id' => 'copyright_type',
			   		'value' => 'two-columns'
			   ),
        	   'std' => '<img src="http://yithemes.com/cdn/images/various/footer_yith_blu.png" alt="Your Inspiration Themes" style="position:relative; top:9px; margin-top: -11px;" /> Powered by <a href="http://yithemes.com/" title="free themes wordpress" rel="nofollow"><strong>Your Inspiration Themes</strong></a>'),
         
        array( 'type' => 'close')   
    ),            
    
                                                      
    /* =================== SHOP =================== */
    'shop' => array(
        array( 'name' => __('Shop', 'yiw'),
        	   'type' => 'section'),
        array( 'type' => 'open'),     
         
        array( 'desc' => '<strong>' . __('General', 'yiw') . '</strong>',
               'type' => 'simple-text'),      

        array( 'name' => __('Checkout Redirect', 'yiw'),
               'desc' => __('Enable the redirect to checkout page after "add to cart".', 'yiw'),
               'id' => 'shop-redirect-to-checkout',
               'type' => 'on-off',
               'std' => 0),

        array( 'name' => __('Count All Items in the cart', 'yiw'),
               'desc' => __('It changes the way like the cart in the header count items. If ON, everytime you add an item to the cart (also if the item already is in the cart) the quantity will be increased. If OFF, multiple items of the same type will be counted only one time. (Default: Off)', 'yiw'),
               'id' => 'shop-cart-count-items-mode',
               'type' => 'on-off',
               'std' => 0),

        array( 'desc' => '<strong>' . __('Products page', 'yiw') . '</strong>',
        	   'type' => 'simple-text'),      
         
        array( 'name' => __('Number of products to show', 'yiw'),
        	   'desc' => __('Select the number of products to show on the pages.', 'yiw'),
        	   'id' => 'shop_products_per_page',
        	   'type' => 'slider_control',
        	   'min' => 1,
        	   'max' => 100,
        	   'std' => 8),     
         
        array( 'name' => __('Title position', 'yiw'),
        	   'desc' => __('Select the position of the title. You can say if put it inside the thumbnail or below the image.', 'yiw'),
        	   'id' => 'shop_title_position',
        	   'type' => 'select',
        	   'options' => array(
                    'inside-thumb' => __( 'Inside the thumbnail', 'yiw' ),
                    'below-thumb' => __( 'Below the thumbnail', 'yiw' ),
               ),
        	   'std' => 'inside-thumb'),    
         
        array( 'name' => __('Border thumbnail', 'yiw'),
        	   'desc' => __('Select if you want to show a border on thumbnail.', 'yiw'),
        	   'id' => 'shop_border_thumbnail',
        	   'type' => 'on-off',
        	   'std' => 1),   
         
        array( 'name' => __('Shadow thumbnail', 'yiw'),
        	   'desc' => __('Select if you want to show a shadow on thumbnail.', 'yiw'),
        	   'id' => 'shop_shadow_thumbnail',
        	   'type' => 'on-off',
        	   'std' => 1),  
         
        array( 'name' => __('Show price', 'yiw'),
        	   'desc' => __('Select if you want to show a the price on the products list.', 'yiw'),
        	   'id' => 'shop_show_price',
        	   'type' => 'on-off',
        	   'std' => 1),  
         
        array( 'name' => __('Show button details', 'yiw'),
        	   'desc' => __('Select if you want to show the button for product details.', 'yiw'),
        	   'id' => 'shop_show_button_details',
        	   'type' => 'on-off',
        	   'std' => 1),  
         
        array( 'name' => __('Show button add to cart', 'yiw'),
        	   'desc' => __('Select if you want to show the purchase button.', 'yiw'),
        	   'id' => 'shop_show_button_add_to_cart',
        	   'type' => 'on-off',
        	   'std' => 1),  
         
        array( 'name' => __('Label button details', 'yiw'),
        	   'desc' => __('Select the text for the button for product details.', 'yiw'),
        	   'id' => 'shop_button_details_label',
        	   'type' => 'text',
        	   'std' => strtoupper( __( 'Details', 'yiw' ))),
         
        array( 'name' => __('Label button add to cart', 'yiw'),
        	   'desc' => __('Select the text for the purchase button.', 'yiw'),
        	   'id' => 'shop_button_addtocart_label',
        	   'type' => 'text',
        	   'std' => strtoupper( __( 'Add to cart', 'yiw' ))), 
         
        array( 'desc' => '<strong>' . __('Product detail page', 'yiw') . '</strong>',
        	   'type' => 'simple-text'),         
         
        array( 'name' => __('Show the shop sidebar', 'yiw'),
        	   'desc' => __('Select the layout for the single page.', 'yiw'),
        	   'id' => 'shop_layout_page_single',
        	   'type' => 'select',
        	   'options' => array(
                   'sidebar-right' => __( 'Sidebar right', 'yiw' ),
                   'sidebar-left' => __( 'Sidebar left', 'yiw' ),
                   'sidebar-no' => __( 'No Sidebar', 'yiw' ),
               ),
        	   'std' => 'sidebar-no'),         
         
        array( 'name' => __('Show price', 'yiw'),
        	   'desc' => __('Select if you want to show the price, on the product detail page.', 'yiw'),
        	   'id' => 'shop_show_price_single_page',
        	   'type' => 'on-off',
        	   'std' => 1),       
         
        array( 'name' => __('Show button add to cart', 'yiw'),
        	   'desc' => __('Select if you want to show the purchase button, on the product detail page.', 'yiw'),
        	   'id' => 'shop_show_button_add_to_cart_single_page',
        	   'type' => 'on-off',
        	   'std' => 1),   
        	   
		array( 'name' => __('Custom Related/Up-Sells Products number', 'yiw'),
        	   'desc' => __('Select if you want to customize the number of related/up-sells Products. Note: if you are already using a custom filter to do that, please don\'t enable this option.', 'yiw'),
        	   'id' => 'shop_show_related_single_product',
        	   'type' => 'on-off',
        	   'std' => 0),
        	   
		array( 'name' => __('Number of Related/Up-Sells Products', 'yiw'),
        	   'desc' => __('Select the total numbers of the related/up-sells products displayed, on the product detail page. Note: related products are displayed randomly from Woocommerce/Jigoshop. Sometimes the number of related products could be less than the number of items selected. This number depends from the query plugin, not from the theme', 'yiw'),
        	   'id' => 'shop_number_related_single_product',
        	   'min' => 1,
               'max' => 10,
               'step' => 1,
               'type' => 'slider_control',
               'std' => 5,
        	   'deps' => array(
                  'id' => 'shop_show_related_single_product',
                  'value' => 1
               ),
        ),

        array( 'name' => __('Columns of Related/Up-Sells Products', 'yiw'),
            'desc' => __('Select the columns of the related/up-sells products, on the product detail page.', 'yiw'),
            'id' => 'shop_columns_related_single_product',
            'min' => 1,
            'max' => 5,
            'step' => 1,
            'type' => 'slider_control',
            'std' => 5,
            'deps' => array(
                'id' => 'shop_show_related_single_product',
                'value' => 1
            ),
        ),
         
        array( 'type' => 'close')   
    ),           
    /* =================== END FOOTER =================== */         
	 
    /* =================== LOGIN PAGE =================== */
    'login-page' => array(    
        array( 'name' => __('Login Page', 'yiw'),
        	   'type' => 'section'),
        array( 'type' => 'open'),        	
        	
        array( 'name' => __('Logo', 'yiw'),
        	   'desc' => __('Upload your image logo, to replace with the default logo of the login page (leave empty, if you want to leave the default logo).', 'yiw'),
        	   'id' => 'login_logo',
        	   'type' => 'upload',
        	   'std' => ''),	    	
        	
        array( 'name' => __('Logo URL', 'yiw'),
        	   'desc' => __('Change the standard url of the logo, in the login page.', 'yiw'),
        	   'id' => 'login_url',
        	   'type' => 'text',
        	   'std' => home_url()),		
        	
        array( 'type' => 'close')
    ),        
    /* =================== END GENERAL =================== */

    /* ============ TWITTER API INTEGRATION ============*/
    'twitter_api' => array(
        array( 'name' => __('Twitter API Integration', 'yiw'),
            'type' => 'section'),
        array( 'type' => 'open'),

        array( 'desc' => '<strong>' . __('Insert your Twitter API created from <a href="https://dev.twitter.com/apps">https://dev.twitter.com/apps</a>', 'yiw') . '</strong>',
            'type' => 'simple-text'),

        array( 'name' => __('Twitter username', 'yiw'),
            'desc' => __('Enter the username of Twitter.', 'yiw'),
            'id' => 'twitter_username',
            'type' => 'text',
            'std' => '' ),

        array( 'name' => __('Consumer key', 'yiw'),
            'desc' => __('Enter the Consumer key of Twitter.', 'yiw'),
            'id' => 'twitter_consumer_key',
            'type' => 'text',
            'std' => '' ),

        array( 'name' => __('Consumer secret', 'yiw'),
            'desc' => __('Enter the Consumer secret of Twitter.', 'yiw'),
            'id' => 'twitter_consumer_secret',
            'type' => 'text',
            'std' => '' ),

        array( 'name' => __('Access token', 'yiw'),
            'desc' => __('Enter the Access Token of Twitter.', 'yiw'),
            'id' => 'twitter_access_token',
            'type' => 'text',
            'std' => '' ),

        array( 'name' => __('Access token secret', 'yiw'),
            'desc' => __('Enter the Access Token secret of Twitter.', 'yiw'),
            'id' => 'twitter_access_token_secret',
            'type' => 'text',
            'std' => '' ),
    ),
 
);   
?>