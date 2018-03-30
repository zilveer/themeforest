<?php

$rockthemes_to_default_options = array(
	array(
		'category_name' => 'General Settings',
		'category_id'	=> 'general_settings',
		'class'			=> '',
		'elements'		=> array(
		
			array(
				'label'			=> 'Company Logo',
				'id'			=> 'company_logo',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'is_translate'	=> 'true',
				'description'	=> 'Upload your company logo. If you want to use your site title instead of logo, leave this area empty.',
				'choices'		=> '',
				'default'		=> F_WAY.'/images/demo/quasar-logo.png'
			),
						
			array(
				'label'			=> 'Company Logo Retina',
				'id'			=> 'company_logo_retina',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'is_translate'	=> 'true',
				'description'	=> 'If you are using retina plugin, upload your company logo retina size. You should name your logo with @2X. For example, if your originial logo named as "company_logo.png" your retina logo should be named as "company_logo@2X.png".',
				'choices'		=> '',
				'default'		=> F_WAY.'/images/demo/quasar-logo@2x.png'
			),
			
			array(
				'label'			=> 'Logo Width',
				'id'			=> 'logo_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Your logo\'s regular width',
				'choices'		=> '',
				'default'		=> '157px'
			),
			
			array(
				'label'			=> 'Logo Height',
				'id'			=> 'logo_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Your logo\'s regular height',
				'choices'		=> '',
				'default'		=> '48px'
			),
			
			array(
				'label'			=> 'Logo Margin Top',
				'id'			=> 'logo_margin_top',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Top margin of logo',
				'choices'		=> '',
				'default'		=> '10px'
			),
			
			array(
				'label'			=> 'Logo Margin Bottom',
				'id'			=> 'logo_margin_bottom',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Bottom margin of logo',
				'choices'		=> '',
				'default'		=> '10px'
			),
		
			array(
				'label'			=> 'Company Logo Favico',
				'id'			=> 'company_logo_favicon',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'description'	=> 'Upload your .ico file of your logo here.',
				'choices'		=> '',
				'default'		=> F_WAY.'/images/demo/favico.ico'
			),
		
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Google Analytics',
			),
			
			
			array(
				'label'			=> 'Google Analytics Code',
				'id'			=> 'google_analytics_code',
				'type'			=> 'text_area',
				'is_hidden'		=> 'false',
				'is_translate'	=> 'false',
				'description'	=> 'Paste your Google Analytics Code here.',
				'choices'		=> '',
				'default'		=> ''
			),
			
			
			array(
				'label'			=> 'Quasar Products Page',
				'id'			=> 'quasar_products_page',
				'type'			=> 'page_list',
				'is_hidden'		=> 'false',
				'is_translate'	=> 'false',
				'description'	=> 'Choose your Quasar Products page for improved SEO and Breadcrumbs',
				'choices'		=> '',
				'default'		=> ''
			),
			
			array(
				'label'			=> 'Quasar Product Slug',
				'id'			=> 'quasar_product_slug',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'Slug of the Quasar Products. If you change this option you need to go to "Settings > Permalinks" and click "Save Changes"',
				'choices'		=> '',
				'default'		=> 'portfolio-item'
			),
			
			array(
				'label'			=> 'Quasar Product Category Slug',
				'id'			=> 'quasar_product_category_slug',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'Slug of the Quasar Product Category. If you change this option you need to go to "Settings > Permalinks" and click "Save Changes"',
				'choices'		=> '',
				'default'		=> 'portfolio-category',
			),
			
			array(
				'label'			=> 'Quasar Gallery Slug',
				'id'			=> 'quasar_gallery_slug',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'Slug of the Quasar Gallery. If you change this option you need to go to "Settings > Permalinks" and click "Save Changes"',
				'choices'		=> '',
				'default'		=> 'gallery-item'
			),
			
			array(
				'label'			=> 'Quasar Gallery Category Slug',
				'id'			=> 'quasar_gallery_category_slug',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'Slug of the Quasar Gallery Category. If you change this option you need to go to "Settings > Permalinks" and click "Save Changes"',
				'choices'		=> '',
				'default'		=> 'gallery-category',
			),
		
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Advanced Style',
			),
		
			array(
				'label'			=> 'Your Extra CSS Code',
				'id'			=> 'extra_css_code',
				'type'			=> 'text_area',
				'is_hidden'		=> 'false',
				'is_translate'	=> 'false',
				'description'	=> 'If you want to change some styles or add some extra CSS code, enter those codes here.',
				'choices'		=> '',
				'default'		=> ''
			),
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Miscellaneous',
			),
			
			array(
				'label'			=> 'Activate Smooth Scroll',
				'id'			=> 'activate_smooth_scroll',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'You can activate/deactivate the smooth scroll effect. Smooth scroll effect works perfectly on most of the desktops but may cause fast sliding on touch based mouses.',
				'choices'		=> '',
				'default'		=> 'FALSE'
			),
			
			array(
				'label'			=> 'Use Attached Images in Wordpress Gallery',
				'id'			=> 'attach_images_in_wp_gallery',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'Images attached to the post will be displayed as default in Wordpress gallery. If you do not want to display attached images, choose "NO"',
				'choices'		=> '',
				'default'		=> 'YES'
			),
			
			array(
				'label'			=> 'Activate Linking in Wordpress Gallery',
				'id'			=> 'activate_linking_in_wp_gallery',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'Wordpress gallery will use lightbox effect as default. If you also want to activate linking choose "YES"',
				'choices'		=> '',
				'default'		=> 'NO'
			),
		
		)
	),
	
	array(
		'category_name' => 'Reading',
		'category_id'	=> 'reading_settings',
		'class'			=> '',
		'elements'		=> array(
		
			array(
				'label'			=> 'Blog, Archive Summary',
				'id'			=> 'post_summary',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'Blog and arhive summary will display excerpt or the content?',
				'choices'		=> array(
					array(
						'text'	=> 'Display Excerpt',
						'value'	=> 'excerpt',
					),
					array(
						'text'	=> 'Display Content',
						'value'	=> 'content',
					)
				
				),
				'default'		=> 'content'
			),
			
			array(
				'label'			=> 'Show Post Name on Title',
				'id'			=> 'show_post_name_on_title',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to display post title in the breadcrumbs title area, choose "YES". Choosing this option will display same title in the breadcrumbs area and in the top of the post.',
				'choices'		=> '',
				'default'		=> 'FALSE'
			),
			
			array(
				'label'			=> 'Activate Comments on Pages?',
				'id'			=> 'activate_comments_on_pages',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to activate comments on pages, choose "YES". This option will only effect to regular pages.',
				'choices'		=> '',
				'default'		=> 'FALSE'
			),
			
			array(
				'label'			=> 'Activate Comments on Quasar Products?',
				'id'			=> 'activate_comments_on_quasar_products',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to activate comments on Quasar Products, choose "YES". This option will only effect to Quasar Product pages.',
				'choices'		=> '',
				'default'		=> 'FALSE'
			),
			
		),
	),	

	
	array(
		'category_name' => 'Typography Settings',
		'category_id'	=> 'typography_settings',
		'class'			=> '',
		'elements'		=> array(
			array(
				'label'			=> 'Enter Your Google Font Standard Code',
				'id'			=> 'google_font_standard_code',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'Enter the Google Font Standard Code to use a Google Font. You can find your font standard code in "Use" section at step "3. Add this code to your website:"',
				'choices'		=> '',
				'default'		=> '<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300|PT+Sans+Narrow:400,700|Pacifico" rel="stylesheet" type="text/css">',
			),
			
			array(
				'label'			=> 'Site Default Font Details',
				'id'			=> 'site_default_font_details',
				'type'			=> 'font_option_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'This font rule will apply all of the regular fields.',
				'choices'		=> '',
				'default'		=> array(
					'font_family'	=>	'font-family: "Open Sans", sans-serif;',
					'font_size'		=>	"13px",
				),
			),
			
			array(
				'label'			=> 'Site Heading Font Family',
				'id'			=> 'site_heading_font_family',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'This font rule will apply all of the headings.',
				'choices'		=> '',
				'default'		=> 'font-family: "PT Sans Narrow", sans-serif;',
			),
			
			array(
				'label'			=> 'Menu Font Family',
				'id'			=> 'menu_font_family',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'Enter the font family of the menu',
				'choices'		=> '',
				'default'		=> 'font-family: "PT Sans Narrow", sans-serif;',
			),
			
			array(
				'label'			=> 'Menu Font Size',
				'id'			=> 'main_nav_font_size',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'Enter a "px" value for the menu font size.',
				'choices'		=> '',
				'default'		=> '14px',
			),
			
			array(
				'label'			=> 'Sub Menu Font Size',
				'id'			=> 'main_nav_sub_font_size',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'hidden_val'	=> '',
				'description'	=> 'Enter a "px" value for the sub menu font size.',
				'choices'		=> '',
				'default'		=> '14px',
			),
			
		),
	),	
	

	array(
		'category_name' => 'Color Settings',
		'category_id'	=> 'color_settings',
		'class'			=> '',
		'elements'		=> array(
		
			
		
			array(
				'label'			=> 'Main Color',
				'id'			=> 'site_general_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Main color of the site. This color will be the main color that will attend to menus, buttons, links etc.',
				'choices'		=> '',
				'default'		=> '#00aae8'
			),
					
			array(
				'label'			=> 'Default Text Color',
				'id'			=> 'default_text_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Default text color',
				'choices'		=> '',
				'default'		=> '#444444'
			),
			
			array(
				'label'			=> 'Link Color',
				'id'			=> 'a_link_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Regular link color (a tag color)',
				'choices'		=> '',
				'default'		=> '#444444'
			),
			
			array(
				'label'			=> 'Link Hover Color',
				'id'			=> 'a_link_hover_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Link hover color (a:hover tag color). Usually the same color with Main Color',
				'choices'		=> '',
				'default'		=> '#00aae8'
			),
			
			array(
				'label'			=> 'Blog Post Type Icon Color',
				'id'			=> 'blog_post_type_icon_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose the color of blog post type icon',
				'choices'		=> '',
				'default'		=> '#FFFFFF'
			),
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Main Gradient Settings',
			),
			
			array(
				'label'			=> 'Main Gradient Top Color',
				'id'			=> 'main_gradient_top_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Top color of the main gradient. This will be applied to multiple gradient areas such as pagination numbers, blog post date and so on.',
				'choices'		=> '',
				'default'		=> '#FFFFFF'
			),

			array(
				'label'			=> 'Main Gradient Bottom Color',
				'id'			=> 'main_gradient_bottom_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Bottom color of the main gradient. This will be applied to multiple gradient areas such as pagination numbers, blog post date and so on.',
				'choices'		=> '',
				'default'		=> '#f4f4f4'
			),
			
			array(
				'label'			=> 'Pagination Hover Top Color',
				'id'			=> 'pagination_hover_top_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Top color of the pagination buttons hover state. Pagination button uses main gradient for default state',
				'choices'		=> '',
				'default'		=> '#FFFFFF'
			),

			array(
				'label'			=> 'Pagination Hover Bottom Color',
				'id'			=> 'pagination_hover_bottom_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Bottom color of the pagination buttons hover state. Pagination button uses main gradient for default state',
				'choices'		=> '',
				'default'		=> '#DCDCDC'
			),

			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Elements with Boxed Layout',
			),
			
			array(
				'label'			=> 'Boxed Layout Background',
				'id'			=> 'boxed_layout_element_background_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Background color of boxed layouts for elements',
				'choices'		=> '',
				'default'		=> '#f3f4ed'
			),
			
			array(
				'label'			=> 'Boxed Layout Text Color',
				'id'			=> 'boxed_layout_text_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Text color of the content in the boxed layout',
				'choices'		=> '',
				'default'		=> '#666666'
			),
			
			
			array(
				'label'			=> 'Boxed Layout Link Color',
				'id'			=> 'boxed_layout_a_link_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Boxed layout\'s link color (a tag color)',
				'choices'		=> '',
				'default'		=> '#666666'
			),
			
			array(
				'label'			=> 'Boxed Layout Link Hover Color',
				'id'			=> 'boxed_layout_a_link_hover_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Boxed Layout\'s hover color (a:hover tag color). Usually the same color with the main color',
				'choices'		=> '',
				'default'		=> '#00aae8'
			),
			
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Custom Button Colors',
			),
			
			array(
				'label'			=> 'Custom Button 1st Color',
				'id'			=> 'custom_button_color_1',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Darkest color for your button',
				'choices'		=> '',
				'default'		=> '#c41411'
			),
			
			array(
				'label'			=> 'Custom Button 2nd Color',
				'id'			=> 'custom_button_color_2',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Lightest color for your button',
				'choices'		=> '',
				'default'		=> '#ed6b4e'
			),
			
			array(
				'label'			=> 'Custom Button 3rd Color',
				'id'			=> 'custom_button_color_3',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Reference color for your button',
				'choices'		=> '',
				'default'		=> '#ec4f2c'
			),
			
			array(
				'label'			=> 'Custom Button 4th Color',
				'id'			=> 'custom_button_color_4',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Light color for your button',
				'choices'		=> '',
				'default'		=> '#ed5634'
			),

			array(
				'label'			=> 'Custom Button 5th Color',
				'id'			=> 'custom_button_color_5',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Dark color for your button',
				'choices'		=> '',
				'default'		=> '#d23613'
			),
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Font Colors',
			),
			
			array(
				'label'			=> 'General Font Color',
				'id'			=> 'general_font_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'General font color of the site',
				'choices'		=> '',
				'default'		=> '#333'
			),
			
			array(
				'label'			=> 'H1 Color',
				'id'			=> 'font_h1_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Color of h1 tag',
				'choices'		=> '',
				'default'		=> '#333'
			),
			
			array(
				'label'			=> 'H2 Color',
				'id'			=> 'font_h2_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Color of h2 tag',
				'choices'		=> '',
				'default'		=> '#333'
			),

			array(
				'label'			=> 'H3 Color',
				'id'			=> 'font_h3_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Color of h3 tag',
				'choices'		=> '',
				'default'		=> '#333'
			),

			array(
				'label'			=> 'H4 Color',
				'id'			=> 'font_h4_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Color of h4 tag',
				'choices'		=> '',
				'default'		=> '#333'
			),

			array(
				'label'			=> 'H5 Color',
				'id'			=> 'font_h5_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Color of h5 tag',
				'choices'		=> '',
				'default'		=> '#333'
			),

			array(
				'label'			=> 'H6 Color',
				'id'			=> 'font_h6_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Color of h6 tag',
				'choices'		=> '',
				'default'		=> '#333'
			),
			
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Miscellaneous Element Colors',
			),
			
			array(
				'label'			=> 'Tabs & Toggles Background',
				'id'			=> 'tabs_toggles_bg_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Background color of the tabs and toggles elements.',
				'choices'		=> '',
				'default'		=> '#FAFAFA'
			),
			
			array(
				'label'			=> 'Tabs & Toggles Border Color',
				'id'			=> 'tabs_toggles_border_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Border color of the tabs and toggles',
				'choices'		=> '',
				'default'		=> '#E4E4E4'
			),
			
			array(
				'label'			=> 'Light Font Color',
				'id'			=> 'light_font_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'There are several area where the fonts using a little bit lighter color than the regular font color. You can set up this color here',
				'choices'		=> '',
				'default'		=> '#666666'
			),
					
			array(
				'label'			=> 'Search Box Color',
				'id'			=> 'search_box_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Background color of the search box in the menu',
				'choices'		=> '',
				'default'		=> '#ececec'
			),
			
			array(
				'label'			=> 'Iconic Text Icon Box Default Color',
				'id'			=> 'iconic_text_icon_box_default_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Default color of the iconic text element icon box.',
				'choices'		=> '',
				'default'		=> '#4f5864'
			),
		)
	),
	
	
	array(
		'category_name' => 'Image Settings',
		'category_id'	=> 'image_settings',
		'class'			=> '',
		'elements'		=> array(

			//General Thumbnail Image Width and Height
			array(
				'label'			=> 'General Thumbnail Image Width',
				'id'			=> 'rockthemes_thumbnail_image_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the general thumbnail image. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '200px'
			),
			
			array(
				'label'			=> 'General Thumbnail Image Height',
				'id'			=> 'rockthemes_thumbnail_image_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the height value of the general thumbnail image. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '150px'
			),
			
			//General Medium Image Width and Height
			array(
				'label'			=> 'General Medium Image Width',
				'id'			=> 'rockthemes_medium_image_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the general medium image. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '540px'
			),
			
			array(
				'label'			=> 'General Medium Image Height',
				'id'			=> 'rockthemes_medium_image_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the height value of the general medium image. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '405px'
			),
			
			//General Large Image Width and Height
			array(
				'label'			=> 'General Large Image Width',
				'id'			=> 'rockthemes_large_image_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the general large image. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '720px'
			),
			
			array(
				'label'			=> 'General Large Image Height',
				'id'			=> 'rockthemes_large_image_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the height value of the general large image. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '540px'
			),
			
			
			//General Featured Image Width and Height
			array(
				'label'			=> 'General Featured Image Width',
				'id'			=> 'rockthemes_featured_image_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the general featured image. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '1060px'
			),
			
			array(
				'label'			=> 'General Featured Image Height',
				'id'			=> 'rockthemes_featured_image_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the height value of the general featured image. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '440px'
			),
			
			/*Move this to General or Page Builder Settings*/
			array(
				'label'			=> 'Auto Add Featured Image',
				'id'			=> 'auto_add_featured_image_to_builder',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you activate this option, page builder will automatically add a featured image area for each new page. (Recommended)',
				'choices'		=> '',
				'default'		=> 'YES'
			),
		
		),
	),
	
	array(
		'category_name' => 'Layout Settings',
		'category_id'	=> 'layout_settings',
		'class'			=> '',
		'elements'		=> array(
		
			array(
				'label'			=> 'Choose Main Layout Grid',
				'id'			=> 'main_layout_grid',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> '',
				'choices'		=> array(
					array('text' => '960px Content Area', 'value'=>'990px'),
					array('text' => '1060px Content Area (Default)', 'value'=>'1090px'),
					array('text' => '1140px Content Area', 'value'=>'1170px'),
					array('text' => '1440px Content Area', 'value'=>'1470px'),
				),
				'default'		=> '1090px'
			),
			
			array(
				'label'			=> 'Border Radius',
				'id'			=> 'layout_border_radius',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the border radius in the px or em format. For example : 4px',
				'choices'		=> '',
				'default'		=> '4px'
			),
			
			array(
				'label'			=> 'Content Padding',
				'id'			=> 'content_padding',
				'type'			=> 'text_field',
				'is_hidden'		=> 'true',
				'hidden_val'	=> '15px',
				'description'	=> 'Enter the general content padding in px or em. (i.e. 10px)',
				'choices'		=> '',
				'default'		=> '15px'
			),
			
			array(
				'label'			=> 'Disable Responsivity',
				'id'			=> 'disable_responsivity',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to disable the responsivity, check this option',
				'choices'		=> '',
				'default'		=> 'FALSE'
			),
			
			array(
				'label'			=> 'Use Boxed Layout',
				'id'			=> 'use_boxed_layout',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you choose "YES" boxed layout will be activated',
				'choices'		=> '',
				'default'		=> 'FALSE'
			),
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Main Background Settings',
			),
			
			array(
				'label'			=> 'Main Background Image Retina',
				'id'			=> 'main_bg_image_retina',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'description'	=> 'Main background image of the Wordpress does not contain Retina support. You can upload your retina version of your background image',
				'choices'		=> '',
				'default'		=> '',
			),
			
			array(
				'label'			=> 'Main Background Image Width',
				'id'			=> 'main_bg_image_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the Main Background Image.',
				'choices'		=> '',
				'default'		=> '149px',
			),
			
			array(
				'label'			=> 'Main Background Image Height',
				'id'			=> 'main_bg_image_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the height value of the Main Background Image.',
				'choices'		=> '',
				'default'		=> '139px',
			),
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Main Boxed Layout Settings',
			),
			
			array(
				'label'			=> 'Main Boxed Layout Background Image',
				'id'			=> 'main_boxed_layout_bg_image',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to use an image for Main Boxed Layout Background, upload your Image Here',
				'choices'		=> '',
				'default'		=> '',
			),
			
			array(
				'label'			=> 'Main Boxed Layout Background Image Retina',
				'id'			=> 'main_boxed_layout_bg_image_retina',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'description'	=> 'If you use a background image for Main Boxed Layout Background, you can add Retina version of your background image here.',
				'choices'		=> '',
				'default'		=> '',
			),
			
			array(
				'label'			=> 'Main Boxed Layout Background Image Width',
				'id'			=> 'main_boxed_layout_bg_image_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the Main Boxed Layout Background Image.',
				'choices'		=> '',
				'default'		=> '297px',
			),
			
			array(
				'label'			=> 'Main Boxed Layout Background Image Height',
				'id'			=> 'main_boxed_layout_bg_image_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the height value of the Main Boxed Layout Background Image.',
				'choices'		=> '',
				'default'		=> '297px',
			),
			
			array(
				'label'			=> 'Main Boxed Layout Background Image Repeat',
				'id'			=> 'main_boxed_layout_bg_image_repeat',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'If you used an image for Main Boxed Layout Background you can choose the repeat mode here.',
				'choices'		=> array(
					array('text' => 'Repeat Both', 'value'=>'repeat'),
					array('text' => 'Repeat X', 'value'=>'repeat-x'),
					array('text' => 'Repeat Y', 'value'=>'repeat-y'),
					array('text' => 'No Repeat', 'value'=>'no-repeat'),
				),
				'default'		=> 'repeat',
			),
			
			array(
				'label'			=> 'Main Boxed Layout Background Color',
				'id'			=> 'main_boxed_layout_bg_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to use a color for background, you should leave the image area empty',
				'choices'		=> '',
				'default'		=> '',
			),
			
			
			
			
			array(
				'label'			=> 'Small Block Grid',
				'id'			=> 'small_block_grid',
				'type'			=> 'select',
				'is_hidden'		=> 'true',
				'hidden_val'	=> 2,
				'description'	=> 'When site is viewed in the small screens, block grids will change their number. You can choose how may blocks will be shown for each row.',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12')
				),
				'default'		=> '2'
			),
			
			array(
				'label'			=> 'Medium Block Grid',
				'id'			=> 'medium_block_grid',
				'type'			=> 'select',
				'is_hidden'		=> 'true',
				'hidden_val'	=> 3,
				'description'	=> '',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12')
				),
				'default'		=> '3'
			),
					
		)
	),
	
	array(
		'category_name' => 'Ajax Filtered Portfolio',
		'category_id'	=> 'ajax_filtered_settings',
		'class'			=> '',
		'elements'		=> array(
		
			array(
				'label'			=> 'Ajax Thumbnail Width',
				'id'			=> 'rockthemes_ajaxfiltered_thumbnail_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the thumbnail. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '116px'
			),
			
			array(
				'label'			=> 'Ajax Thumbnail Height',
				'id'			=> 'rockthemes_ajaxfiltered_thumbnail_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the thumbnail. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '77px'
			),
			
			array(
				'label'			=> 'Hover Box Width',
				'id'			=> 'ajax_filtered_hover_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the box when hovered Ajax Filtered Gallery item. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '472px'
			),
			
			array(
				'label'			=> 'Hover Box Height',
				'id'			=> 'ajax_filtered_hover_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the height value of the box when hovered Ajax Filtered Gallery item. Do not forget to add "px". For example : 4px',
				'choices'		=> '',
				'default'		=> '240px'
			),
			
			array(
				'label'			=> 'Ajax Filtered Hover Box Background Color',
				'id'			=> 'ajax_filtered_hover_box_bg',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Background color of Ajax Filtered Portfolio Hover Box',
				'choices'		=> '',
				'default'		=> '#FAFAFA'
			),
			
			
			array(
				'label'			=> 'Ajax Filtered Hover Box Border Color',
				'id'			=> 'ajax_filtered_hover_box_border',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Border color of Ajax Filtered Portfolio Hover Box',
				'choices'		=> '',
				'default'		=> '#BEBEBE'
			),
			
			array(
				'label'			=> 'Ajax Filtered Hover Box Font Color',
				'id'			=> 'ajax_filtered_hover_box_font',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Font color of Ajax Filtered Portfolio Hover Box',
				'choices'		=> '',
				'default'		=> '#666666'
			),			
					
		)
	),
	
	array(
		'category_name' => 'Header Settings',
		'category_id'	=> 'header_settings',
		'class'			=> '',
		'elements'		=> array(
		
			array(
				'label'			=> 'Header Model',
				'id'			=> 'header_model',
				'type'			=> 'select_images_vertical',
				'description'	=> 'Choose a header model',
				'choices'		=> array(
					array(
						'value' => 1,
						'url'  => OPTIONS_URI.'images/header_model_01.jpg'
					),
					
					array(
						'value' => 2,
						'url'  => OPTIONS_URI.'images/header_model_02.jpg'
					),
					
					array(
						'value' => 3,
						'url'  => OPTIONS_URI.'images/header_model_03.jpg'
					),
					
					array(
						'value' => 4,
						'url'  => OPTIONS_URI.'images/header_model_04.jpg'
					),
					
					array(
						'value' => 5,
						'url'  => OPTIONS_URI.'images/header_model_05.jpg'
					),
				
					array(
						'value' => 6,
						'url'  => OPTIONS_URI.'images/header_model_06.jpg'
					),
					
					array(
						'value' => 7,
						'url'  => OPTIONS_URI.'images/header_model_07.jpg'
					),
				),
				'default'		=> '7'
			),
		
			array(
				'label'			=> 'Header Contact Info',
				'id'			=> 'header_contact_info',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'is_translate'	=> 'true',
				'description'	=> 'You can enter your small contact information to the header',
				'choices'		=> '',
				'default'		=> '<strong> Call Us:</strong> +1 555 5 555 | <strong> Email : </strong><a href="mailto:info@rockthemes.net">info@rockthemes.net</a>',
			),

			array(
				'label'			=> 'Social Icons',
				'id'			=> 'social_icons',
				'type'			=> 'socialicons',
				'is_hidden'		=> 'false',
				'description'	=> 'Add social icon',
				'choices'		=> '',
				'default'		=> json_encode(array('shortcode' => ''))
			),
			
			
			array(
				'label'			=> 'Header Large Background',
				'id'			=> 'header_large_background',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'description'	=> 'You can upload an image for header large area. If you leave this area empty, you can choose a color for your background large area.',
				'choices'		=> '',
				'default'		=> ''
			),
			
			array(
				'label'			=> 'Header Large Background Repeat',
				'id'			=> 'header_large_background_repeat',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'If you used an image for header large area you can choose the repeat mode for the header large background image.',
				'choices'		=> array(
					array('text' => 'Repeat Both', 'value'=>'repeat'),
					array('text' => 'Repeat X', 'value'=>'repeat-x'),
					array('text' => 'Repeat Y', 'value'=>'repeat-y'),
					array('text' => 'No Repeat', 'value'=>'no-repeat'),
				),
				'default'		=> 'repeat'
			),
			
			array(
				'label'			=> 'Header Large Background Color',
				'id'			=> 'header_large_background_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to use a color for background, you should leave the image area empty',
				'choices'		=> '',
				'default'		=> '#4f5864'
			),
			
			array(
				'label'			=> 'Header Large Font Color',
				'id'			=> 'header_large_font_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your header large area text',
				'choices'		=> '',
				'default'		=> '#ededde'
			),
			
			array(
				'label'			=> 'Header Large Link Color',
				'id'			=> 'header_large_link_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your header large area links',
				'choices'		=> '',
				'default'		=> '#f4f3e6'
			),
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Header Top',
			),
						
			array(
				'label'			=> 'Header Top Background Color',
				'id'			=> 'header_top_background_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for Header Top Area background',
				'choices'		=> '',
				'default'		=> '#4f5864',
			),
						
			array(
				'label'			=> 'Header Top Font Color',
				'id'			=> 'header_top_font_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your header top area text',
				'choices'		=> '',
				'default'		=> '#cccccc',
			),
			
			array(
				'label'			=> 'Header Top Link Color',
				'id'			=> 'header_top_link_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your header top area links',
				'choices'		=> '',
				'default'		=> '#dddddd',
			),
			
			array(
				'label'			=> 'Header Top Link Hover Color',
				'id'			=> 'header_top_link_hover_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your header top area hover',
				'choices'		=> '',
				'default'		=> '#dedede',
			),

			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Social Media Icons',
			),
			
			array(
				'label'			=> 'Social Media Icons Default Color',
				'id'			=> 'social_media_icons_default_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a default color for social media icons',
				'choices'		=> '',
				'default'		=> '#ededde'
			),
						
		),
	),	
	
	array(
		'category_name' => 'Menu Settings',
		'category_id'	=> 'menu_settings',
		'class'			=> '',
		'elements'		=> array(
			array(
				'label'			=> 'Activate Menu Description',
				'id'			=> 'activate_menu_description',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'You can easily activate/deactivate menu description. If you want to use menu description fields in the Appearance > Menu, you should activate this option',
				'choices'		=> '',
				'default'		=> 'NO'
			),
			
			array(
				'label'			=> 'Activate Menu Bottom Shadow',
				'id'			=> 'activate_menu_bottom_shadow',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'You can easily activate/deactivate menu bottom shadow.',
				'choices'		=> '',
				'default'		=> 'NO'
			),
			
			array(
				'label'			=> 'Add Search Box To Menu',
				'id'			=> 'add_search_box_to_menu',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to add the special search box to the menu, choose "YES"',
				'choices'		=> '',
				'default'		=> 'YES'
			),
			
			array(
				'label'			=> 'Disable Top Links For iPad Landscape',
				'id'			=> 'disable_top_links_for_ipad',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you choose "YES" when reviewing your site with iPad on landscape mode, a menu with sub menus will not link to the page. This option is recommended to use as "Yes"',
				'choices'		=> '',
				'default'		=> 'YES'
			),
			
			array(
				'label'			=> 'Activate Menu Background Transparency',
				'id'			=> 'activate_menu_transparency',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'Menu background uses alpha effect to give it a half transparent look. If you want to disable it, choose "NO"',
				'choices'		=> '',
				'default'		=> 'YES'
			),
			
			array(
				'label'			=> 'Search Icon Padding Top',
				'id'			=> 'search_icon_padding_top',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter a px value for your search icon top padding.',
				'choices'		=> '',
				'default'		=> '13px'
			),
			
			array(
				'label'			=> 'Search Icon Padding Bottom',
				'id'			=> 'search_icon_padding_bottom',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter a px value for your search icon bottom padding.',
				'choices'		=> '',
				'default'		=> '15px'
			),
			
			array(
				'label'			=> 'Menu Padding Top',
				'id'			=> 'menu_padding_top',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter a px value for your menu top padding.',
				'choices'		=> '',
				'default'		=> '19px'
			),
			
			array(
				'label'			=> 'Menu Padding Bottom',
				'id'			=> 'menu_padding_bottom',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter a px value for your menu bottom padding.',
				'choices'		=> '',
				'default'		=> '19px'
			),
			
			array(
				'label'			=> 'Menu Background Gradient Top Color',
				'id'			=> 'menu_bg_gradient_top',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Background color of the main menu uses gradient. You can change this background gradient top color here',
				'choices'		=> '',
				'default'		=> '#f9f9f9'
			),
			
			array(
				'label'			=> 'Menu Background Gradient Bottom Color',
				'id'			=> 'menu_bg_gradient_bottom',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Background color of the main menu uses gradient. You can change this background gradient bottom color here',
				'choices'		=> '',
				'default'		=> '#e8e8e8'
			),
			
			array(
				'label'			=> 'Menu Border Top Color',
				'id'			=> 'menu_border_top_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Border top color of the main menu',
				'choices'		=> '',
				'default'		=> '#f9f9f9'
			),
			
			array(
				'label'			=> 'Menu Border Bottom Color',
				'id'			=> 'menu_border_bottom_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'true',
				'hidden_val'	=> '#DDDDDD',
				'description'	=> 'Border bottom color of the main menu',
				'choices'		=> '',
				'default'		=> '#DDDDDD'
			),
			
			array(
				'label'			=> 'Menu First Level Font Color',
				'id'			=> 'menu_level1_font_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Menu first level font color',
				'choices'		=> '',
				'default'		=> '#423b3b'
			),
			
			array(
				'label'			=> 'Menu First Level Font Hover Color',
				'id'			=> 'menu_level1_font_hover_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Menu first level font hover color',
				'choices'		=> '',
				'default'		=> '#00aae8'
			),
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Sub Menu Settings',
			),
			
			array(
				'label'			=> 'Submenu Background Color',
				'id'			=> 'menu_level2_bg_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Submenu background color',
				'choices'		=> '',
				'default'		=> '#4f5864'
			),
			
			array(
				'label'			=> 'Submenu Hover Background Color',
				'id'			=> 'menu_level2_bg_hover_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Submenu hover background color',
				'choices'		=> '',
				'default'		=> '#00aae8'
			),
			
			array(
				'label'			=> 'Submenu Font Color',
				'id'			=> 'menu_level2_font_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Submenu font color',
				'choices'		=> '',
				'default'		=> '#fffaf2'
			),
			
			array(
				'label'			=> 'Submenu Font Hover Color',
				'id'			=> 'menu_level2_font_hover_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Submenu font hover color',
				'choices'		=> '',
				'default'		=> '#ffffff'
			),
			
			array(
				'label'			=> 'Submenu Border Top Color',
				'id'			=> 'menu_level2_border_top_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Border top color of the sub menu elements',
				'choices'		=> '',
				'default'		=> '#656b6e'
			),
			
			array(
				'label'			=> 'Submenu Border Bottom Color',
				'id'			=> 'menu_level2_border_bottom_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Border bottom color of the sub menu elements',
				'choices'		=> '',
				'default'		=> '#41474d'
			),
			
			array(
				'label'			=> 'Submenu Border Radius',
				'id'			=> 'menu_level2_border_radius',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the border radius in px.',
				'choices'		=> '',
				'default'		=> '3px'
			),
			
		),
	),	
	
	array(
		'category_name' => 'Title & Breadcrumbs',
		'category_id'	=> 'title_and_breadcrumbs',
		'class'			=> '',
		'elements'		=> array(
		
			array(
				'label'			=> 'Title Area Background Image',
				'id'			=> 'title_area_background_image',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to use another image for Title Area, upload your Image Here',
				'choices'		=> '',
				'default'		=> F_WAY.'/images/bright_squares.png'
			),
			
			array(
				'label'			=> 'Title Area Background Image Retina',
				'id'			=> 'title_area_background_image_retina',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'description'	=> 'If you use a background image for Title Area, you can add Retina version of your background image here.',
				'choices'		=> '',
				'default'		=> F_WAY.'/images/bright_squares_@2x.png'
			),
			
			array(
				'label'			=> 'Title Area Background Image Width',
				'id'			=> 'title_area_background_image_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the Title Area Background Image.',
				'choices'		=> '',
				'default'		=> '297px'
			),
			
			array(
				'label'			=> 'Title Area Background Image Height',
				'id'			=> 'title_area_background_image_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the height value of the Title Area Background Image.',
				'choices'		=> '',
				'default'		=> '297px'
			),
			
			array(
				'label'			=> 'Title Area Background Image Repeat',
				'id'			=> 'title_area_background_image_repeat',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'If you used an image for Title Area Background you can choose the repeat mode here.',
				'choices'		=> array(
					array('text' => 'Repeat Both', 'value'=>'repeat'),
					array('text' => 'Repeat X', 'value'=>'repeat-x'),
					array('text' => 'Repeat Y', 'value'=>'repeat-y'),
					array('text' => 'No Repeat', 'value'=>'no-repeat'),
				),
				'default'		=> 'repeat'
			),
			
			array(
				'label'			=> 'Title Area Background Color',
				'id'			=> 'title_area_background_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to use a color for background, you should leave the image area empty',
				'choices'		=> '',
				'default'		=> ''
			),
			
			array(
				'label'			=> 'Title Area Font Color',
				'id'			=> 'title_area_font_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your Title Area text',
				'choices'		=> '',
				'default'		=> '#333'
			),
			
			array(
				'label'			=> 'Title Area Link Color',
				'id'			=> 'title_area_link_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your Title Area link',
				'choices'		=> '',
				'default'		=> '#666'
			),
			
			array(
				'label'			=> 'Use Top Shadow',
				'id'			=> 'title_area_top_shadow',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to activate the shadow at the top of the area choose "YES"',
				'choices'		=> '',
				'default'		=> 'YES'
			),
			
			array(
				'label'			=> 'Use Bottom Shadow',
				'id'			=> 'title_area_bottom_shadow',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to activate the shadow at the bottom of the area choose "YES"',
				'choices'		=> '',
				'default'		=> 'YES'
			),
			
			array(
				'label'			=> 'Deactivate Breadcrumbs',
				'id'			=> 'deactivate_breadcrumbs',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to deactivate the breadcrumbs choose "YES"',
				'choices'		=> '',
				'default'		=> 'NO'
			),
			
			array(
				'label'			=> 'Disable Breadcrumbs Title Area',
				'id'			=> 'disable_breadcrumbs_title_area',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to disable the Header Title and Breadcrumbs area, choose "YES". This will not take effect if you specifically set another option inside page.',
				'choices'		=> '',
				'default'		=> 'NO'
			),
			
			array(
				'label'			=> 'Disable Space Under Header',
				'id'			=> 'disable_space_under_header',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'This option will remove the extra vertical space under header. This will not take effect if you specifically set another option inside page.',
				'choices'		=> '',
				'default'		=> 'NO'
			),

		),
	),	
	
	array(
		'category_name' => 'Footer Settings',
		'category_id'	=> 'footer_settings',
		'class'			=> '',
		'elements'		=> array(
		
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Footer Large Settings',
			),
			
			array(
				'label'			=> 'Display Footer Large Area',
				'id'			=> 'display_footer_large_area',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'As default footer large area will be displayed. If you want to remove the footer large area you can choose to remove it. This will be a general rule for every page. But you can still make page specific choice in Advanced Details',
				'choices'		=> array(
					array('text' => 'Display Footer Large Area', 'value'=>'true'),
					array('text' => 'Remove Footer Large Area', 'value'=>'false'),
				),
				'default'		=> 'true'
			),
			
			array(
				'label'			=> 'Large Footer Blocks',
				'id'			=> 'large_footer_blocks',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'How many blocks will be there in the Footer Large Area?',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12'),
				),
				'default'		=> '4'
			),
		
			array(
				'label'			=> 'Footer Large Background Image',
				'id'			=> 'footer_large_background_image',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to use image for Footer Large, upload your Image Here',
				'choices'		=> '',
				'default'		=> ''
			),
			
			array(
				'label'			=> 'Footer Large Background Image Retina',
				'id'			=> 'footer_large_background_image_retina',
				'type'			=> 'image',
				'is_hidden'		=> 'false',
				'description'	=> 'If you use a background image for Footer Large, you can add Retina version of your background image here.',
				'choices'		=> '',
				'default'		=> ''
			),
			
			array(
				'label'			=> 'Footer Large Background Image Width',
				'id'			=> 'footer_large_background_image_width',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the width value of the Footer Large Background Image.',
				'choices'		=> '',
				'default'		=> ''
			),
			
			array(
				'label'			=> 'Footer Large Background Image Height',
				'id'			=> 'footer_large_background_image_height',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter the height value of the Footer Large Background Image.',
				'choices'		=> '',
				'default'		=> ''
			),
			
			array(
				'label'			=> 'Footer Large Background Image Repeat',
				'id'			=> 'footer_large_background_image_repeat',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'If you used an image for Footer Large Background you can choose the repeat mode here.',
				'choices'		=> array(
					array('text' => 'Repeat Both', 'value'=>'repeat'),
					array('text' => 'Repeat X', 'value'=>'repeat-x'),
					array('text' => 'Repeat Y', 'value'=>'repeat-y'),
					array('text' => 'No Repeat', 'value'=>'no-repeat'),
				),
				'default'		=> 'repeat'
			),
			
			array(
				'label'			=> 'Footer Large Background Color',
				'id'			=> 'footer_large_background_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to use a color for background, you should leave the image area empty',
				'choices'		=> '',
				'default'		=> '#21262e'
			),
			
			array(
				'label'			=> 'Footer Large Font Color',
				'id'			=> 'footer_large_font_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your Footer Large text',
				'choices'		=> '',
				'default'		=> '#a8a8a1'
			),
			
			array(
				'label'			=> 'Footer Large Link Color',
				'id'			=> 'footer_large_link_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your Footer Large link',
				'choices'		=> '',
				'default'		=> '#bab9b2'
			),
			
			array(
				'label'			=> 'Footer Large Border Top Color',
				'id'			=> 'footer_large_border_top_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Border top color of the Footer Large Area Headers',
				'choices'		=> '',
				'default'		=> '#1d1e24'
			),
			
			array(
				'label'			=> 'Footer Large Border Bottom Color',
				'id'			=> 'footer_large_border_bottom_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Border bottom color of the Footer Large Area Headers',
				'choices'		=> '',
				'default'		=> '#292e3d'
			),
			
			array(
				'label'			=> 'Use Shadow on Headers',
				'id'			=> 'footer_large_headers_shadow',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to activate the shadow on Footer Large Headers choose "YES"',
				'choices'		=> '',
				'default'		=> 'YES'
			),
			
			array(
				'label'			=> 'Use Top Shadow',
				'id'			=> 'footer_large_top_shadow',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to activate the shadow on top of Footer Large choose "YES"',
				'choices'		=> '',
				'default'		=> 'NO'
			),
			
			array(
				'label'			=> 'Use Top Border',
				'id'			=> 'footer_large_top_border',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to activate the border on top of Footer Large choose "YES"',
				'choices'		=> '',
				'default'		=> 'NO'
			),
			
			array(
				'id'			=> '',
				'type'			=> 'header',
				'description'	=> 'Footer Bottom Settings',
			),
			
			array(
				'label'			=> 'Display Footer Bottom Area',
				'id'			=> 'display_footer_bottom_area',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'As default footer bottom area will be displayed. If you want to remove the footer bottom area you can choose to remove it. This will be a general rule for every page. But you can still make page specific choice in Advanced Details',
				'choices'		=> array(
					array('text' => 'Display Footer Bottom Area', 'value'=>'true'),
					array('text' => 'Remove Footer Bottom Area', 'value'=>'false'),
				),
				'default'		=> 'true'
			),
			
			array(
				'label'			=> 'Footer Bottom Background Color',
				'id'			=> 'footer_bottom_background_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose footer bottom area background color',
				'choices'		=> '',
				'default'		=> '#181818'
			),
			
			array(
				'label'			=> 'Footer Bottom Font Color',
				'id'			=> 'footer_bottom_font_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your Footer Bottom text',
				'choices'		=> '',
				'default'		=> '#999999'
			),
			
			array(
				'label'			=> 'Footer Bottom Link Color',
				'id'			=> 'footer_bottom_link_color',
				'type'			=> 'colorpicker',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose a color for your Footer Bottom link',
				'choices'		=> '',
				'default'		=> '#C4C4C4'
			),
			
			array(
				'label'			=> 'Footer Copyright Information',
				'id'			=> 'footer_copyright',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter your footer copyright information here',
				'choices'		=> '',
				'default'		=> '© Copyright - Quasar Theme'
			),

		),	
	),
	
	
	array(
		'category_name' => 'WooCommerce Settings',
		'category_id'	=> 'woocommerce_settings',
		'class'			=> '',
		'elements'		=> array(
			array(
				'label'			=> 'Add Cart Icon To Menu',
				'id'			=> 'add_cart_icon_to_menu',
				'type'			=> 'checkbox',
				'is_hidden'		=> 'false',
				'description'	=> 'If you want to add the special cart icon with cart contents to the menu, choose "YES"',
				'choices'		=> '',
				'default'		=> 'YES'
			),
			
			array(
				'label'			=> 'Cart Icon Margin Top',
				'id'			=> 'cart_icon_margin_top',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter a px value for your cart icon top margin.',
				'choices'		=> '',
				'default'		=> '19px'
			),
			
			array(
				'label'			=> 'Cart Icon Margin Bottom',
				'id'			=> 'cart_icon_margin_bottom',
				'type'			=> 'text_field',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter a px value for your search cart bottom margin.',
				'choices'		=> '',
				'default'		=> '26px'
			),
			
			array(
				'label'			=> 'Cross & Related & Up Sells Total in Cart',
				'id'			=> 'cross_up_sells_total_cart',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'How many products should be displayed in cross & related & up sells in the cart.',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12'),
				),
				'default'		=> '2'
			),
			
			array(
				'label'			=> 'Cross & Related & Up Sells Blocks in Cart',
				'id'			=> 'cross_up_sells_blocks_cart',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose the blocks of cross & related & up sells in the cart.',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12'),
				),
				'default'		=> '2'
			),
			
			array(
				'label'			=> 'Cross & Related & Up Sells Total in Product',
				'id'			=> 'cross_up_sells_total_item',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'How many products should be displayed in cross & related & up sells in the product.',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12'),
				),
				'default'		=> '3'
			),
			
			array(
				'label'			=> 'Cross & Related & Up Sells Blocks in Product',
				'id'			=> 'cross_up_sells_blocks_item',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'Choose the blocks of cross & related & up sells in the product.',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12'),
				),
				'default'		=> '3'
			),
						
			array(
				'label'			=> 'Shop Product Blocks Large',
				'id'			=> 'woo_shop_blocks_large',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'How many products should be displayed in a row on the shop page. Only for bigger than 768px ',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12'),
				),
				'default'		=> '3'
			),
			
			array(
				'label'			=> 'Shop Product Blocks Medium',
				'id'			=> 'woo_shop_blocks_medium',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'How many products should be displayed in a row on the shop page. For tablets',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12'),
				),
				'default'		=> '2'
			),
			
			array(
				'label'			=> 'Shop Product Blocks Small',
				'id'			=> 'woo_shop_blocks_small',
				'type'			=> 'select',
				'is_hidden'		=> 'false',
				'description'	=> 'How many products should be displayed in a row on the shop page. For smaller devices',
				'choices'		=> array(
					array('text' => '1 Block', 'value'=>'1'),
					array('text' => '2 Block', 'value'=>'2'),
					array('text' => '3 Block', 'value'=>'3'),
					array('text' => '4 Block', 'value'=>'4'),
					array('text' => '5 Block', 'value'=>'5'),
					array('text' => '6 Block', 'value'=>'6'),
					array('text' => '7 Block', 'value'=>'7'),
					array('text' => '8 Block', 'value'=>'8'),
					array('text' => '9 Block', 'value'=>'9'),
					array('text' => '10 Block', 'value'=>'10'),
					array('text' => '11 Block', 'value'=>'11'),
					array('text' => '12 Block', 'value'=>'12'),
				),
				'default'		=> '1'
			),


		),
	),
	
	
	array(
		'category_name' => 'Theme Update',
		'category_id'	=> 'theme_update',
		'class'			=> '',
		'elements'		=> array(
			
			array(
				'label'			=> 'Enter Your API Key and Username For Update',
				'id'			=> 'theme_update_field',
				'type'			=> 'theme_update',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter your API Key and Username to be able to use easy update feature.',
				'choices'		=> '',
				'default'		=> ''
			),
								
		)
	),
	
	
	array(
		'category_name' => 'License',
		'category_id'	=> 'license_settings',
		'class'			=> '',
		'elements'		=> array(
			
			array(
				'label'			=> 'Enter Your Purchase Code Here',
				'id'			=> 'license_field',
				'type'			=> 'license',
				'is_hidden'		=> 'false',
				'description'	=> 'Enter your purchase code. <br/><strong style="color=#ff0000;">!Important</strong>If this is your testing server, do not enter your purchase code. Purchase code can only be used in one site and can not be changed.',
				'choices'		=> '',
				'default'		=> ''
			),
								
		)
	),



);

?>