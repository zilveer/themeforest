<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$optionsframework_settings = get_option( 'optionsframework' ); 
	$optionsframework_settings['id'] = 'themeva'; // _themeva_mod
	update_option( 'optionsframework', $optionsframework_settings );
}


function optionsframework_options() {

	// WP Editor data
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/lib/adm/images/';	
	
	$theme = wp_get_theme();
	$theme_name = $theme->Name;

	// Page Layout
	$page_layout_array = array(
		'layout_one' => $imagepath . 'layout-1.png',
		'layout_two' => $imagepath . 'layout-2.png',
		'layout_three' => $imagepath . 'layout-3.png',
		'layout_four' => $imagepath . 'layout-4.png',	
		'layout_five' => $imagepath . 'layout-5.png',
		'layout_six' => $imagepath . 'layout-6.png'	 			 			 			 			 		 
	);		

	// Columns data
	$columns_array = array(
		'1' => __('One', 'themeva-admin'),
		'2' => __('Two', 'themeva-admin'),
		'3' => __('Three', 'themeva-admin'),
		'4' => __('Four', 'themeva-admin'),
	);

	// Sidebar data
	$sidebars = ( of_get_option('sidebars_num') !='' ? of_get_option('sidebars_num') : 2 );
	
	for ( $i=1; $i <= $sidebars; $i++ )
	{
		 $sidebar_array['Sidebar'.$i] = 'Sidebar '.$i;
	}
	
	$post_formats = get_theme_support( 'post-formats' );

	foreach( $post_formats[0] as $format )
	{
		 $format_array[$format] = $format;
	}	

	// Author Bio
	$author_bio_array = array(
		'posts' => __('Posts', 'themeva-admin'),
		'enable' => __('Posts &amp; Pages', 'themeva-admin'),
		'disable' => __('Disable', 'themeva-admin'),
	);

	// Twitter Fedd
	$twitter_feed_array = array(
		'none' => __('Disabled', 'themeva-admin'),
		'pagetop' => __('Top', 'themeva-admin'),
		'pagebot' => __('Bottom', 'themeva-admin'),
	);	

	// Social Icon data
	$social_icon_array = social_icon_data();

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category){
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}


	$options = array();

	$options[] = array(
		'name' => __('General', 'themeva-admin'),
		'type' => 'heading'
	);	

	$options[] = array(
		'name' => __('Layout', 'themeva-admin'),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __('Responsive Design', 'themeva-admin'),
		'desc' => '',
		'id' => 'enable_responsive',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);	
	
	$options['max_sitewidth'] = array(
		'name' => __('Maximum Site Width', 'themeva-admin'),
		'desc' => __('Default is 1140', 'themeva-admin'),
		'id' => 'max_sitewidth',
		'std' => '',
		'class' => 'mini', //mini, tiny, small
		'type' => 'text'
	);

	$options[] = array(
		'name' => 'Page Layout',
		'desc' => '',
		'id' => 'pagelayout',
		'std' => 'layout_one',
		'type' => "images",
		'options' => $page_layout_array
	);		

	$options[] = array(
		'name' => __('Breadcrumbs', 'themeva-admin'),
		'desc' => '',
		'id' => 'breadcrumb',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);

	$options[] = array(
		'name' => __('Page Comments', 'themeva-admin'),
		'desc' => '',
		'id' => 'pagecomments',
		'std' => 'disable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);

	$options[] = array(
		'name' => __('Show Author Bio', 'themeva-admin'),
		'desc' => __('Enable this option to display author bio information.', 'themeva-admin'),
		'id' => 'author_bio',
		'std' => 'disable',
		'type' => 'radio',
		'options' => $author_bio_array
	);	

	$options[] = array(
		'name' => __('Number of Sidebars', 'themeva-admin'),
		'plac' => __('Default is 2 sidebars', 'themeva-admin'),
		'id' => 'sidebars_num',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Typography', 'themeva-admin'),
		'type' => 'info',
		'id' => 'typopgraphy_info',
		'tooltip' => 'See documentation for how to setup custom <a target="_blank" href="http://themeva.com/docs/'. strtolower($theme_name) .'/google-cufon-font-settings/">Google / Cuf&oacute;n</a> Fonts.',		
	);	

	$options[] = array(
		'name' => __('Font Type', 'themeva-admin'),
		'desc' => '',
		'id' => 'nv_font_type',
		'std' => 'enable_google',
		'type' => 'radio',
		'options' => array(
			'enable' => __('Cuf&oacute;n', 'themeva-admin'),
			'enable_google' => __('Google', 'themeva-admin'),
			'disable' => __('Standard', 'themeva-admin')
		)	
	);		
	
	$options[] = array(
		'name' => __('Custom Cuf&oacute;n Font', 'themeva-admin'),
		'desc' => '',
		'id' => 'cufon_font',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __('Custom Google Font One', 'themeva-admin'),
		'desc' => '',
		'id' => 'googlefont_url_1',
		'plac' => 'URL Name',
		'std' => '',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => '',
		'desc' => '',
		'id' => 'googlefont_css_1',
		'plac' => 'CSS Name',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Custom Google Font Two', 'themeva-admin'),
		'desc' => '',
		'id' => 'googlefont_url_2',
		'plac' => 'URL Name',
		'std' => '',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => '',
		'desc' => '',
		'id' => 'googlefont_css_2',
		'plac' => 'CSS Name',
		'std' => '',
		'type' => 'text'
	);			

	$options[] = array(
		'name' => __('Image Resizing + First Image Detection', 'themeva-admin'),
		'type' => 'info',
		'id' => 'image_resize_info',
	);	

	$options[] = array(
		'name' => __('Image Resizer', 'themeva-admin'),
		'desc' => '',
		'id' => 'timthumb_disable',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);	

	$options[] = array(
		'name' => __('First Image Detection', 'themeva-admin'),
		'desc' => '',
		'id' => 'firstimage_detect',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);		

	$options[] = array(
		'name' => __('Visual Composer', 'themeva-admin'),
		'type' => 'info',
	);	

	$options[] = array(
		'name' => __('Standard VC Elements', 'themeva-admin'),
		'desc' => __('Enable all visual composer elements, this will add extra CSS to the front end and may result in longer load times.', 'themeva-admin'),
		'id' => 'display_vc_elements',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'enable' => __('On', 'themeva-admin'),
			'disable_vc_elements' => __('Off', 'themeva-admin'),
		)	
	);				

	

	$options[] = array(
		'name' => __('Flickr', 'themeva-admin'),
		'type' => 'info',
		'desc' => __('See documentation for how to setup Flickr', 'themeva-admin'),		
	);		

	$options[] = array(
		'name' => __('Flickr User ID', 'themeva-admin'),
		'desc' => '',
		'id' => 'flickr_userid',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Header', 'themeva-admin'),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Header', 'themeva-admin'),
		'type' => 'info',
	);

	$options['header_height'] = array(
		'name' => __('Height', 'themeva-admin'),
		'desc' => '',
		'id' => 'header_height',
		'std' => '',
		'desc' => 'Minimum Header Height',
		'class' => 'mini',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => __('Logo', 'themeva-admin'),
		'type' => 'info',
	);
	
	$options['branding_disable'] = array(
		'name' => __('Logo Display', 'themeva-admin'),
		'desc' => '',
		'id' => 'branding_disable',
		'std' => 'enable',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'enable' => 'Enable',
			'disable' => 'Disable',
		)
	);	

	$options['branding_alignment'] = array(
		'name' => __('Logo Align', 'themeva-admin'),
		'desc' => '',
		'id' => 'branding_alignment',
		'std' => 'left',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right',
		)
	);			
	
	$options['branding_margin'] = array(
		'name' => __('Top Margin', 'themeva-admin'),
		'desc' => '',
		'id' => 'branding_margin',
		'std' => '',
		'desc' => 'Top Margin of Logo',
		'class' => 'mini',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => __('Primary Logo', 'themeva-admin'),
		'type' => 'info',
	);	

	$options[] = array(
		'name' => __('Logo', 'themeva-admin'),
		'desc' => '',
		'id' => 'branding_url',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __('Retina Logo', 'themeva-admin'),
		'desc' => '',
		'id' => 'branding_2x',
		'type' => 'upload'
	);	

	$options[] = array(
		'name' => __('Retina Logo Width x Height', 'themeva-admin'),
		'desc' => '',
		'id' => 'branding_2x_dimensions',
		'std' => '',
		'plac' => 'e.g. 200x100 ( See description below )',
		'desc' => 'Enter a value half the size of the "Retina Logo" image e.g. 400x200 equals: <strong>200x100</strong>',
		'class' => 'mini',
		'type' => 'text'
	);			

	$options[] = array(
		'name' => __('Secondary Logo', 'themeva-admin'),
		'type' => 'info',
	);	

	$options[] = array(
		'name' => __('Logo', 'themeva-admin'),
		'desc' => '',
		'id' => 'branding_url_sec',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __('Retina Logo', 'themeva-admin'),
		'desc' => '',
		'id' => 'branding_sec_2x',
		'type' => 'upload'
	);	

	$options[] = array(
		'name' => __('Retina Logo Width x Height', 'themeva-admin'),
		'desc' => '',
		'id' => 'branding_sec_2x_dimensions',
		'std' => '',
		'plac' => 'e.g. 200x100 ( See description below )',
		'desc' => 'Enter a value half the size of the "Retina Logo" image e.g. 400x200 equals: <strong>200x100</strong>',
		'class' => 'mini',
		'type' => 'text'
	);			

	$options[] = array(
		'name' => __('Main Menu', 'themeva-admin'),
		'type' => 'info'
	);

	$options['menu_alignment'] = array(
		'name' => __('Menu Align', 'themeva-admin'),
		'desc' => '',
		'id' => 'menu_alignment',
		'std' => 'right',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right',
		)
	);			
	
	$options['menu_margin'] = array(
		'name' => __('Top Margin', 'themeva-admin'),
		'desc' => '',
		'id' => 'menu_margin',
		'std' => '',
		'desc' => 'Top Margin of Menu',
		'class' => 'mini',
		'type' => 'text'
	);		

	$options[] = array(
		'name' => __('WP Custom Menu', 'themeva-admin'),
		'id' => 'wpcustomm_enable',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);
	
	$options[] = array(
		'name' => __('Menu Subtitles', 'themeva-admin'),
		'id' => 'menu_subtitles',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);	

	$options[] = array(
		'name' => __('Menu Descriptions', 'themeva-admin'),
		'id' => 'wpcustommdesc_enable',
		'std' => 'disable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);	

	$options[] = array(
		'name' => __('Widget Area', 'themeva-admin'),
		'type' => 'info'
	);	

	$options[] = array(
		'name' => __('Width', 'themeva-admin'),
		'desc' => '',
		'id' => 'header_widget_width',
		'std' => 'normal',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'width_100' => '100%',
			'width_75' => '75%',
			'width_50' => '50%'
		)
	);	
	
	$options[] = array(
		'name' => __('Text Align', 'themeva-admin'),
		'desc' => '',
		'id' => 'header_widget_align',
		'std' => 'normal',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'center' => 'Center',
			'left' => 'Left',
			'right' => 'Right'
		)
	);		
	
	$options[] = array(
		'name' => __('Top Margin', 'themeva-admin'),
		'id' => 'header_widget_topmargin',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => __('Bottom Margin', 'themeva-admin'),
		'id' => 'header_widget_bottommargin',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);		
	
	$options[] = array(
		'name' => __('Drop Panel / Search', 'themeva-admin'),
		'type' => 'info',
	);

	$options[] = array(
		'name' => __('Display Drop Panel', 'themeva-admin'),
		'id' => 'enable_droppanel',
		'std' => 'disable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);

	$options[] = array(
		'name' => __('Display Search', 'themeva-admin'),
		'id' => 'enable_search',
		'std' => 'disable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);	

	$options[] = array(
		'name' => __('Trigger Button Align', 'themeva-admin'),
		'id' => 'droppanel_button_align',
		'std' => 'center',
		'type' => 'radio',
		'options' => array(
			'left' => __('Left', 'themeva-admin'),
			'center' => __('Center', 'themeva-admin')
		)	
	);

	$options[] = array(
		'name' => __('Drop Panel Columns', 'themeva-admin'),
		'id' => 'droppanel_columns_num',
		'std' => '4',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $columns_array
	);	

	$options[] = array(
		'name' => __('Extras', 'themeva-admin'),
		'type' => 'info',
	);

	$options[] = array(
		'name' => __('Display Tagline', 'themeva-admin'),
		'id' => 'header_tagline',
		'std' => 'disable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);

	$options[] = array(
		'name' => __('Sticky Menu', 'themeva-admin'),
		'id' => 'sticky_menu',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('Desktop & Mobile', 'themeva-admin'),
			'enabledesktop' => __('Desktop', 'themeva-admin')
		)	
	);	

	$options[] = array(
		'name' => __('Mobile Menu', 'themeva-admin'),
		'id' => 'mobile_menu',
		'std' => 'floating',
		'type' => 'radio',
		'options' => array(
			'floating' => __('Floating Menu', 'themeva-admin'),
			'select' => __('Select Menu', 'themeva-admin')
		)	
	);		

	$options[] = array(
		'name' => __('Favicon', 'themeva-admin'),
		'desc' => '',
		'id' => 'header_favicon',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __('Custom Header HTML / Shortcode', 'themeva-admin'),
		'id' => 'header_html',
		'type' => 'textarea',
		'settings' => array(
			'rows' => '20'
		)
	);	

	$options[] = array(
		'name' => __('Header Custom Field', 'themeva-admin'),
		'id' => 'header_customfield',
		'type' => 'editor',
		'settings' => $wp_editor_settings 
	);

	$options[] = array(
		'name' => __('Header Infobar Message', 'themeva-admin'),
		'id' => 'header_infobar',
		'type' => 'editor',
		'settings' => $wp_editor_settings 
	);

	$options[] = array(
		'name' => __('Tracking Code', 'themeva-admin'),
		'id' => 'tracking_code',
		'type' => 'textarea',
		'desc' => __('Add Google Analytics / tracking code within this field.', 'themeva-admin'),
		'settings' => array(
			'rows' => '20'
		)		
	);		
		
	$options[] = array(
		'name' => __('Footer', 'themeva-admin'),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Main Footer', 'themeva-admin'),
		'type' => 'info',
	);		

	$options[] = array(
		'name' => __('Display Footer', 'themeva-admin'),
		'id' => 'mainfooter',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);	

	$options[] = array(
		'name' => __('Footer Columns', 'themeva-admin'),
		'id' => 'footer_columns_num',
		'std' => '4',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $columns_array
	);

	$options[] = array(
		'name' => __('Lower Footer', 'themeva-admin'),
		'type' => 'info',
	);

	$options[] = array(
		'name' => __('Display Lower Footer', 'themeva-admin'),
		'id' => 'lowerfooter',
		'std' => 'enable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'enable' => __('On', 'themeva-admin')
		)	
	);

	$options[] = array(
		'name' => __('Left Column', 'themeva-admin'),
		'id' => 'lowfooterleft',
		'type' => 'textarea',
		'settings' => $wp_editor_settings 
	);

	$options[] = array(
		'name' => __('Right Column', 'themeva-admin'),
		'id' => 'lowfooterright',
		'type' => 'textarea',
		'settings' => $wp_editor_settings 
	);


	$options[] = array(
		'name' => __('Blog', 'themeva-admin'),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Layout', 'themeva-admin'),
		'type' => 'info',
	);	

	$options[] = array(
		'name' => 'Page Layout',
		'desc' => '',
		'id' => 'arhlayout',
		'std' => 'layout_four',
		'type' => "images",
		'options' => $page_layout_array
	);

	$options[] = array(
		'name' => __('Column 1 Sidebar', 'themeva-admin'),
		'id' => 'archcolone',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $sidebar_array
	);

	$options[] = array(
		'name' => __('Column 2 Sidebar', 'themeva-admin'),
		'id' => 'archcoltwo',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $sidebar_array
	);	

	$options[] = array(
		'name' => __('Layout Format', 'themeva-admin'),
		'desc' => '',
		'id' => 'arhpostdisplay',
		'std' => 'normal',
		'type' => 'radio',
		'options' => array(
			'normal' => __('Normal', 'themeva-admin'),
			'grid' => __('Grid', 'themeva-admin')
		)	
	);

	$options[] = array(
		'name' => __('Grid Columns', 'themeva-admin'),
		'desc' => '',
		'id' => 'arhpostcolumns',
		'std' => 'normal',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'2' => 'Two',
			'3' => 'Three',
			'4' => 'Four',
			'5' => 'Five',
			'6' => 'Six',
		)
	);	

	$options[] = array(
		'name' => __('Post Content', 'themeva-admin'),
		'id' => 'arhpostcontent',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'excerpt' => 'Excerpt',
			'full_post' => 'Full Post',
		)
	);

	$options[] = array(
		'name' => __('Featured Image', 'themeva-admin'),
		'id' => 'arhpostimage',
		'type' => 'select',
		'class' => 'mini',
		'std' => '',
		'options' => array (
			'' => 'Single & Archive',
			'archive' => 'Archive',
			'single' => 'Single',
			'disable' => 'Disable',
		)
	);		

	$options[] = array(
		'name' => __('Display Post Metadata', 'themeva-admin'),
		'id' => 'arhpostpostmeta',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'' => 'Archive / Single Post',
			'archive_only' => 'Archive Only',
			'post_only' => 'Single Post Only',
			'disabled' => 'Disabled',
		)
	);

	$options[] = array(
		'name' => __('Post Metadata Align', 'themeva-admin'),
		'desc' => '',
		'id' => 'postmetaalign',
		'std' => 'default',
		'type' => 'radio',
		'options' => array(
			'default' => __('Left', 'themeva-admin'),
			'post_title' => __('Below Title', 'themeva-admin')
		)	
	);	

	$options[] = array(
		'name' => __('Blog Page Images', 'themeva-admin'),
		'type' => 'info',
	);	

	$options[] = array(
		'name' => __('Image Alignment', 'themeva-admin'),
		'id' => 'arhimgalign',
		'std' => 'aligncenter',
		'type' => 'radio',
		'options' => array(
			'alignleft' => __('Left', 'themeva-admin'),
			'aligncenter' => __('Center', 'themeva-admin'),
			'alignright' => __('Right', 'themeva-admin')
		)	
	);
	
	$options[] = array(
		'name' => __('Image Lightbox', 'themeva-admin'),
		'id' => 'arhimgdisplay',
		'std' => 'disable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'lightbox' => __('On', 'themeva-admin')
		)	
	);	
	
	$options[] = array(
		'name' => __('Image Effect', 'themeva-admin'),
		'id' => 'arhimgeffect',
		'type' => 'select',
		'std' => 'none',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'none' => 'None',
			'' => 'Shadow + Reflection',
			'reflect' => 'Reflection',
			'shadow' => 'Shadow',
			'frame' => 'Frame',
			'blackwhite' => 'Black & White',
			'frameblackwhite' => 'Frame + Black & White',
			'shadowblackwhite' => 'Shadow + Black & White',
		)
	);

	$options[] = array(
		'name' => __('Image Width', 'themeva-admin'),
		'id' => 'arhimgwidth',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Image Height', 'themeva-admin'),
		'id' => 'arhimgheight',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Single Post Images', 'themeva-admin'),
		'type' => 'info',
	);	

	$options[] = array(
		'name' => __('Image Alignment', 'themeva-admin'),
		'id' => 'postimgalign',
		'std' => 'aligncenter',
		'type' => 'radio',
		'options' => array(
			'alignleft' => __('Left', 'themeva-admin'),
			'aligncenter' => __('Center', 'themeva-admin'),
			'alignright' => __('Right', 'themeva-admin')
		)	
	);
	
	$options[] = array(
		'name' => __('Image Lightbox', 'themeva-admin'),
		'id' => 'postimgdisplay',
		'std' => 'disable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Off', 'themeva-admin'),
			'lightbox' => __('On', 'themeva-admin')
		)	
	);	
	
	$options[] = array(
		'name' => __('Image Effect', 'themeva-admin'),
		'id' => 'postimgeffect',
		'type' => 'select',
		'std' => 'none',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'none' => 'None',
			'' => 'Shadow + Reflection',
			'reflection' => 'Reflection',
			'shadow' => 'Shadow',
			'frame' => 'Frame',
		)
	);

	$options[] = array(
		'name' => __('Image Width', 'themeva-admin'),
		'id' => 'postimgwidth',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);		

	$options[] = array(
		'name' => __('Image Height', 'themeva-admin'),
		'id' => 'postimgheight',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Portfolio', 'themeva-admin'),
		'type' => 'heading'
	);

	
	$options[] = array(
		'name' => __('Parent Portfolio Page', 'themeva-admin'),
		'id' => 'portfoliopage',
		'std' => '',
		'desc' => 'Default is the Archive page.',		
		'class' => 'mini',
		'type' => 'select',
		'options' => $options_pages	
	);	

	$options[] = array(
		'name' => __('Portfolio Page Link', 'themeva-admin'),
		'id' => 'portfoliopagelink',
		'std' => '',
		'type' => 'radio',
		'options' => array(
			'' => __('Enable', 'themeva-admin'),
			'disable' => __('Disable', 'themeva-admin'),
		)	
	);	

	$options[] = array(
		'name' => __('Metadata', 'themeva-admin'),
		'id' => 'portfoliometaalign',
		'std' => 'disable',
		'type' => 'radio',
		'options' => array(
			'disable' => __('Disable', 'themeva-admin'),
			'default' => __('Left', 'themeva-admin'),
			'post_title' => __('Below Title', 'themeva-admin')
		)	
	);

	$options[] = array(
		'name' => __('Single Portfolio Images', 'themeva-admin'),
		'type' => 'info',
	);	

	$options[] = array(
		'name' => __('Image Alignment', 'themeva-admin'),
		'id' => 'portfolioimgalign',
		'std' => 'aligncenter',
		'type' => 'radio',
		'options' => array(
			'alignleft' => __('Left', 'themeva-admin'),
			'aligncenter' => __('Center', 'themeva-admin'),
			'alignright' => __('Right', 'themeva-admin')
		)	
	);
	
	$options[] = array(
		'name' => __('Image Lightbox', 'themeva-admin'),
		'id' => 'portfolioimgdisplay',
		'std' => 'disable',
		'type' => 'radio',
		'options' => array(
			'' => __('Default', 'themeva-admin'),
			'disable' => __('Off', 'themeva-admin'),
			'lightbox' => __('On', 'themeva-admin')
		)	
	);	
	
	$options[] = array(
		'name' => __('Image Width', 'themeva-admin'),
		'id' => 'portfolioimgwidth',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Image Height', 'themeva-admin'),
		'id' => 'portfolioimgheight',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);			

	/*
	$options[] = array(
		'name' => __('Filter Blog Posts', 'themeva-admin'),
		'type' => 'info',
	);	

	$options[] = array(
		'name' => __('Disable Post Format(s)', 'themeva-admin'),
		'id' => 'filter_formats',
		'std' => '',
		'type' => 'multicheck',
		'options' => $format_array		
	);		
	*/

	if (class_exists( 'BP_Core_User' ) || class_exists( 'bbPress' ) ) { 

		$options[] = array(
			'name' => __('BuddyPress / BBPress', 'themeva-admin'),
			'type' => 'heading'
		);
	
		$options[] = array(
			'name' => __('Layout', 'themeva-admin'),
			'type' => 'info',
		);	
	
		$options[] = array(
			'name' => 'Page Layout',
			'desc' => '',
			'id' => 'buddylayout',
			'std' => 'layout_four',
			'type' => "images",
			'options' => $page_layout_array
		);
	
		$options[] = array(
			'name' => __('Column 1 Sidebar', 'themeva-admin'),
			'id' => 'buddycolone',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $sidebar_array
		);
	
		$options[] = array(
			'name' => __('Column 2 Sidebar', 'themeva-admin'),
			'id' => 'buddycoltwo',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $sidebar_array
		);

		$options[] = array(
			'name' => __('Content Border', 'themeva-admin'),
			'desc' => '',
			'id' => 'buddycontentborder',
			'std' => 'default',
			'type' => 'radio',
			'options' => array(
				'default' => __('Default', 'themeva-admin'),
				'disabled' => __('Disable', 'themeva-admin')
			)	
		);				
	
	}

	if (class_exists( 'woocommerce' ) ) { 

		$options[] = array(
			'name' => __('Woocommerce', 'themeva-admin'),
			'type' => 'heading'
		);
	
		$options[] = array(
			'name' => __('Layout', 'themeva-admin'),
			'type' => 'info',
		);	
	
		$options[] = array(
			'name' => 'Page Layout',
			'desc' => '',
			'id' => 'woocomlayout',
			'std' => 'layout_four',
			'type' => "images",
			'options' => $page_layout_array
		);
	
		$options[] = array(
			'name' => __('Column 1 Sidebar', 'themeva-admin'),
			'id' => 'woocomcolone',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $sidebar_array
		);
	
		$options[] = array(
			'name' => __('Column 2 Sidebar', 'themeva-admin'),
			'id' => 'woocomcoltwo',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $sidebar_array
		);
	}	
	
	
	$options[] = array(
		'name' => __('Social Media', 'themeva-admin'),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Social Icons', 'themeva-admin'),
		'type' => 'info',
		'id' => 'social_info',
		'tooltip' => 'Switch Social Icons "On" if you want to enable social icons on every Page / Post, it can be disabled on individual pages if required.',		
	);	

	$options[] = array(
		'name' => __('Social Icons', 'themeva-admin'),
		'desc' => '',
		'id' => 'display_socialicons',
		'std' => 'off',
		'type' => 'radio',
		'options' => array(
			'off' => __('Off', 'themeva-admin'),
			'yes' => __('On', 'themeva-admin')
		)	
	);	

	$options[] = array(
		'name' => __('Share Icon', 'themeva-admin'),
		'desc' => '',
		'id' => 'socialicons_share',
		'std' => 'on',
		'type' => 'radio',
		'desc' => __('Set this option to "Off" to show social icons individually.', 'themeva-admin'),
		'options' => array(
			'yes' => __('Off', 'themeva-admin'),
			'on' => __('On', 'themeva-admin')
		)	
	);		

	$options[] = array(
		'name' => __('Social Icons Color', 'themeva-admin'),
		'id' => 'socialicons_color',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array (
			'' => 'Default',
			'light' => 'Light',
			'dark' => 'Dark',
			'color' => 'Color',
		)
	);	

	foreach ( $social_icon_array as $key => $socialicon )
	{
		$social_array[ strtolower( str_replace('.','',$socialicon['name'] ) ) ] = $socialicon['name'];
	}

	$options[] = array(
		'name' => __('Enable Social Icons', 'themeva-admin'),
		'id' => 'socialicons',
		'std' => '',
		'type' => 'multicheck',
		'options' => $social_array		
	);	
	

	$options[] = array(
		'name' => __('Social Icon URL\'s', 'themeva-admin'),
		'type' => 'info',
		'id' => 'socialurl_info',		
	);			
	
	foreach ( $social_icon_array as $key => $socialicon )
	{
		$options[] = array(
			'name' => $socialicon['name'],
			'id' => $key,
			'std' => $socialicon['path'],
			'type' => 'text'
		);	
	}

	$options[] = array(
		'name' => __('Twitter Feed', 'themeva-admin'),
		'type' => 'info',
		'id' => 'twitter_info',
		'tooltip' => 'Enter your Twitter details, if you wish to enable Twitter Feed globally, set the Twitter Display, this can be overriden on individual pages.',
	);

	$options[] = array(
		'name' => __('Twitter Username', 'themeva-admin'),
		'id' => 'twitter_usrname',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => __('Consumer Key', 'themeva-admin'),
		'id' => 'twitter_conkey',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Consumer Secret', 'themeva-admin'),
		'id' => 'twitter_consecret',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Access Token', 'themeva-admin'),
		'id' => 'twitter_acctoken',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => __('Access Token Secret', 'themeva-admin'),
		'id' => 'twitter_acctokensecret',
		'type' => 'text'
	);				
	
	$options[] = array(
		'name' => __('Number of Tweets', 'themeva-admin'),
		'id' => 'twitter_feednum',
		'plac' => 'Enter the number of tweets to display',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => __('Twitter Display', 'themeva-admin'),
		'id' => 'twitter_display',
		'std' => 'none',
		'type' => 'radio',
		'options' => $twitter_feed_array
	);		
	
	$options[] = array(
		'name' => __('Main RSS Feed', 'themeva-admin'),
		'type' => 'info',
	);	
		
	$options[] = array(
		'name' => __('Main RSS Title', 'themeva-admin'),
		'id' => 'rss_title',
		'std' => 'Blog',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Main RSS Feed URL', 'themeva-admin'),
		'id' => 'rss_feed',
		'plac' => 'e.g. /category/YOUR-CATEGORY-NAME/feed/',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Customize', 'themeva-admin'),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Custom CSS', 'themeva-admin'),
		'id' => 'header_css',
		'type' => 'textarea',
		'settings' => array(
			'rows' => '20'
		)	
	);	

	$options[] = array(
		'name' => __('Mobile CSS', 'themeva-admin'),
		'id' => 'responsive_css',
		'desc' => __('CSS for Mobile / Responsive mode e.g. ( hides sidebars ) <strong>.content-wrap .sidebar {display:none !important;}</strong>', 'themeva-admin'),
		'type' => 'textarea',
		'settings' => array(
			'rows' => '20'
		)	
	);

	$options[] = array(
		'name' => __('JavaScript', 'themeva-admin'),
		'id' => 'footer_javascript',
		'desc' => __('Add your scripts here, loads at the end of the page. E.g. <strong>&lt;script&gt; YOUR CODE &lt;/script&gt;</strong>', 'themeva-admin'),
		'type' => 'textarea',
		'settings' => array(
			'rows' => '20'
		)
	);	

	$options[] = array(
		'name' => __('Docs + Getting Started', 'themeva-admin'),
		'type' => 'heading'
	);	

	$options[] = array(
		'name' => __('1. Import Demo Content', 'themeva-admin'),
		'type' => 'info',
		'desc' => __('
		<p>Click the button below to Import the demo content. Please note, some of the demo images have been removed due to copyright.</p>
		<p><strong>Warning!</strong> It\'s not recommended to install if you have existing content, your current content may interfere with the demo content and not display correctly.</p>
		<p><strong>Activate the following plugins first</strong></p>
		<ul>
		<li><em>Visual Composer</em></li>
		<li><em>Revolution Slider</em></li>
		<li><em>Contact Form 7</em></li>
		</ul>
		<p><strong>Optional</strong><br/>
		Activate the following plugin(s) to import their demo data.</p>
		<ul>
		<li><em>Woocommerce</em></li>
		</ul>		
		<a href="#" class="import-demo button button-primary">'. __( 'Import Demo Content', 'optionsframework' ) .'</a>
		
		<p><div class="ajax-message"></div></p>
		', 'themeva-admin'),			
	);	

	$options[] = array(
		'name' => __('2. Documentation', 'themeva-admin'),
		'type' => 'info',
		'desc' => __('<p>See the Getting Started section of the documentation below.</p>
		
		<a target="_blank" href="http://themeva.com/docs/'. strtolower($theme_name) .'/category/getting-started/" class="documentation_link button button-primary">'. __( 'Documentation', 'optionsframework' ) .'</a>
		
		', 'themeva-admin'),			
	);	

	$options[] = array(
		'name' => __('3. Customize Skin', 'themeva-admin'),
		'type' => 'info',
		'desc' => __('<p>Click here to Customize a Skin, once the customization screen has loaded - <strong>Select a Skin</strong> to edit from the <strong>Edit + Set Default Skin</strong> section.</p>
	
		<a href="/wp-admin/customize.php" target="_blank" class="documentation_link button button-primary">'. __( 'Customize', 'optionsframework' ) .'</a>
		
		', 'themeva-admin'),			
	);	

	$options[] = array(
		'name' => __('Theme Updates', 'themeva-admin'),
		'type' => 'heading'
	);	

	$options[] = array(
		'name' => __('ThemeForest User Details', 'themeva-admin'),
		'type' => 'info',	
	);	

	$options[] = array(
		'name' => __('ThemeForest Username', 'themeva-admin'),
		'id' => 'tf_username',
		'type' => 'text',
		'desc' => __('<p>Enter the ThemeForest Username you used to purchase this them.</p>', 'themeva-admin'),		
	);
	
	$options[] = array(
		'name' => __('ThemeForest API Key', 'themeva-admin'),
		'id' => 'tf_apikey',
		'type' => 'text',
		'desc' => __('<p>Enter your ThemeForest API Key here. To find your API Key, click <a target="_blank" href="http://themeva.com/themeforest/images/find-api-key.jpg">'. __( 'here', 'optionsframework' ) .'</a>.</p>', 'themeva-admin'),			
	);		
	
	// Check for Theme Updates
	if( of_get_option( 'tf_username' ) != '' && of_get_option( 'tf_apikey' ) != '' ) 
	{		
		include_once( get_template_directory() . '/lib/adm/inc/theme-updates/class-envato-wordpress-theme-upgrader.php' );
		
		$upgrader = new Envato_WordPress_Theme_Upgrader( of_get_option( 'tf_username' ) , of_get_option( 'tf_apikey' ) );
		$theme_update = $upgrader->check_for_theme_update( wp_get_theme()->Name, $allow_cache = false );	
		$current_theme = wp_get_theme();		
	
		if ( ( $theme_update->latest_version - $current_theme->get('Version') ) > 0 && ! $theme_update->errors > 0 )
		{
			add_action( 'admin_notices', 'acoda_theme_update_admin_notice' );	
	
			function acoda_theme_update_admin_notice()
			{
				$message = sprintf( __( "An update for the theme is available! Head over to %s to update it now.", "themeva-admin" ),
					"<a href='" . admin_url() . "admin.php?page=options-framework#themeupdates'>Theme Updates</a>" );
				echo "<div id='message' class='updated'><p>{$message}</p></div>";
			}	
			
			$options[] = array(
				'name' => __( 'Version '. $theme_update->latest_version .' is Available!', 'themeva-admin'),
				'type' => 'info',
				'desc' => '<p>Your current version <strong>'. $current_theme->get('Version') .'</strong> needs to be updated. Please click the update button below to update to <strong>version '. $theme_update->latest_version .'</strong></p>
				<p class="ajax-theme-update-message"></p>
				<a href="#" class="update-theme button button-primary">'. __( 'Update Theme', 'optionsframework' ) .'</a>
				',		
			);	
		}
		elseif( $theme_update->errors > 0 )
		{
			$options[] = array(
				'name' => __( 'Incorrect Details', 'themeva-admin'),
				'type' => 'info',
				'desc' => '<p>The details entered above appear to be incorrect. Please re-enter your <strong>ThemeForest Username</strong> and <strong>ThemeForest API Key</strong> into the relevant fields.</p>',		
			);				
		}
		else
		{
			$options[] = array(
				'name' => __( $current_theme->get('Name') .' is Up-to-date!', 'themeva-admin'),
				'type' => 'info',
				'desc' => '<p>You\'re using the latest version of <strong>'. $current_theme->get('Version') .'</strong>.</p>',		
			);				
		}
	}
	else
	{
		$current_theme = wp_get_theme();
		$options[] = array(
			'name' => __( 'Theme Updates', 'themeva-admin'),
			'type' => 'info',
			'desc' => '<p>You\'re using version <strong>'. $current_theme->get('Version') .' </strong> of the '. $current_theme->get('Name') .' theme. To check for the latest updates, please enter your <strong>ThemeForest Username</strong> and <strong>ThemeForest API Key</strong> into the above fields.</p>',		
		);		
	}

	return $options;
}



function themeva_theme_update()
{
	// Check AJAX Referer
    check_ajax_referer('_theme_options', '_ajax_nonce');

	ob_start();
	include_once( NV_FILES .'/adm/inc/theme-updates/class-envato-wordpress-theme-upgrader.php' );
	$upgrader = new Envato_WordPress_Theme_Upgrader( of_get_option( 'tf_username' ) , of_get_option( 'tf_apikey' ) );
	$upgrader->upgrade_theme(wp_get_theme()->Name);

	ob_end_clean();

	_e( '<strong>Update Complete.</strong> You\'re now using the latest version of the theme. Please wait whilst the page reloads.', 'themeva-admin' );
	die();
}

add_action( 'wp_ajax_themeva_theme_update', 'themeva_theme_update' );