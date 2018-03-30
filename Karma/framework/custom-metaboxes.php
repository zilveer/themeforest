<?php

/*---------------------------------------------------*/
/*	Setup Custom Functions for Metabox Script
/*---------------------------------------------------*/
//@since 4.0, rewrite portfolio category
//with reference to https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Adding-your-own-field-types
//added using hooks cmb_render_{field-type} and cmb_validate_{field-type}
//DO NOT modify the function names..or filter
//the type is portfolio_select_taxonomy
add_filter( 'cmb_render_portfolio_select_taxonomy', 'tt_render_portfolio_select_taxonomy', 10, 2 );
function tt_render_portfolio_select_taxonomy( $field, $meta ) {

    wp_dropdown_categories(array(
            'show_option_none' => '&#8212; Select Category &#8212;',
            'hierarchical'     => 1,
            'taxonomy'         => $field['taxonomy'],
            'orderby'          => 'name',
            'order'            => 'ASC', 
            'hide_empty'       => 0, 
            'name'             => $field['id'],
            'selected'         => $meta  

        ));
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}

//@since 4.0, rewrite custom sub menu
add_filter( 'cmb_render_custom_sub_menu', 'tt_render_custom_sub_menu', 10, 2 );
function tt_render_custom_sub_menu( $field, $meta ) {

  //retrieve post meta value for check
  //global $post;
  //$post_id = $post->ID;
  //$custom_menu_slug = get_post_meta($post_id,'truethemes_custom_sub_menu',true);
  $custom_menu_slug = $meta;

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		
		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Appearance > Menus</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		    <?php if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>'; ?>
			<select id='<?php echo $field['id']; ?>' name='<?php echo $field['id']; ?>'>
			<option value="">&mdash; Select Custom Sub-menu &mdash;</option>
		<?php
			foreach ( $menus as $menu ) {
				$selected = $custom_menu_slug == $menu->slug ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->slug .'">'. $menu->name .'</option>';
			}
		?>
			</select>

		<?php
}

$prefix = '_cmb_'; // start with an underscore to hide fields from custom fields list
// Include & setup custom metabox and fields
add_filter( 'cmb_meta_boxes', 'be_sample_metaboxes' );

function be_sample_metaboxes( $meta_boxes ) {

/*---------------------------------------------------*/
/*	Meta Boxes for Posts
/*---------------------------------------------------*/
$meta_boxes[] = array(
		'id'         => 'new-meta-boxes',
		'title'      => __( 'Custom Settings', 'truethemes_localize' ),
		'pages'      => array('post'), // post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
		
//these fields are hidden when user "Activates Karma 4.0" within Site Options
array(
	'name' => __('Portfolio Full Size URL  <span style="font-weight:normal !important;"><em>(Image, Flash Video, Youtube Video, etc)</em></span>','truethemes_localize'),
	'desc' => __('<b>Samples:</b><br><br><b>Image:</b>&nbsp;&nbsp; http://www.yourdomain.com/wp-content/uploads/project1.jpg<br>
<b>YouTube:</b>&nbsp;&nbsp; http://www.youtube.com/watch?v=VKS08be78os<br>
<b>Flash:</b>&nbsp;&nbsp; http://www.yourdomain.com/wp-content/uploads/design.swf?width=792&amp;height=294<br>
<b>Vimeo:</b>&nbsp;&nbsp; http://vimeo.com/8245346<br>
<b>iFrame:</b>&nbsp;&nbsp; http://www.apple.com?iframe=true&amp;width=850&amp;height=500<br>','truethemes_localize'),
	'id'   => '_portimage_full_value',
	'type' => 'text'
),
			
array(
	'name' => __('Portfolio Description','truethemes_localize'),
	'desc' => __('<b>Note:</b> This description will be displayed in the JQuery pop-up.','truethemes_localize'),
	'id'   => '_portimage_desc_value',
	'type' => 'text'
),

array(
	'name' => __('Link This Image','truethemes_localize'),
	'desc' => __('Enter a URL if you wish to link this image.<br><b>Sample:</b> &nbsp;http://www.yourdomain.com/about-us','truethemes_localize'),
	'id'   => '_jcycle_url_value',
	'type' => 'text'
	)
)
); //end Karma 4.0 hidden fields

//@since 4.0 - metaboxes moved out of sidebar
$meta_boxes[] = array(
		'id'         => 'tt-new-post-metaboxes',
		'title'      => __('Post Settings','truethemes_localize'),
		'pages'      => array('post'), // post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			
array(
	'name' => __('Featured Media','truethemes_localize'),
	'type' => 'title',
	'desc' => __('Blog Posts can easily feature an Image or Video at the top of each post.<br /><br /><strong>1. Featured Image (normal) -</strong> This is the recommended function if not featuring a Video. Simply use the Wordpress <a href="#postimagediv">Featured Image</a> box on the right side of this screen to upload a featured image.<br /><br /><strong>2. Featured Image (external) -</strong> Use the field below to Feature an image which is located on a different web server.<br /><br /><strong>3. Featured Video -</strong> Use the field below to Feature a Video instead of an image.','truethemes_localize'),
),

array(
	'name' => __('Featured Image (external)','truethemes_localize'),
	'desc' => __('Enter the full URL of the external image that you\'d like to feature.<br /><strong>Sample URL:</strong> http://www.sample-website.com/image.png','truethemes_localize'),
	'id'   => 'truethemes_external_image_url',
	'type' => 'text'
),

array(
	'name' => __('Featured Video','truethemes_localize'),
	'desc' => __('Enter the full URL to the video that you\'d like to feature.<br /><strong>Sample URL:</strong> http://vimeo.com/70149174','truethemes_localize'),
	'id'   => 'truethemes_video_url',
	'type' => 'text'
),

)
);	

/*---------------------------------------------------*/
/*	Meta Boxes for Pages
/*---------------------------------------------------*/
// Display in Pages Sidebar
$meta_boxes[] = array(
		'id'         => 'truethemes_meta_box_id',
		'title'      => __( 'Custom Sub-menu', 'truethemes_localize' ),
		'pages'      => array('page'), // post type
		'context'    => 'side',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(
		
array(
	'name' => __('Sub-menu','truethemes_localize'),
	'desc' => __('Display a custom sub-menu by selecting it from the dropdown list below.', 'truethemes_localize'),
	'type' => 'title',
),
		
array(
	'id'   => 'truethemes_custom_sub_menu',
	'type' => 'custom_sub_menu'
),

array(
	'desc' => __('Check the box below to completely disable the sub-menu on this page.', 'truethemes_localize'),
	'type' => 'title',
),

array(
	'desc' => __('Disable sub-menu','truethemes_localize'),
	'id' => 'truethemes_page_checkbox',
	'type' => 'checkbox',
),

)
);

//Display below WYSIWYG editor

/*-------------------------------------------------------------- 
Page Settings
--------------------------------------------------------------*/
$meta_boxes[] = array(
		'id'         => 'page_metabox',
		'title'      => __('Page Settings','truethemes_localize'),
		'pages'      => array('page'), // post type
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(
		
array(
	'name' => __('Page Settings','truethemes_localize'),
	'type' => 'title',
),
array(
	'name'     => __('Page Title Bar','truethemes_localize'),
	'desc'    => __('Should a page title bar be displayed on this page? (page title, breadcrumbs, search box)','truethemes_localize'),
	'id'       => 'slider_disable_toolbar',
	'type'     => 'select',
	'options' => array(
		array('name' => 'Yes', 'value'  => ''),
		array('name' => 'No', 'value' => 'true'),
	)
),
array(
	'name' => __('Page Title','truethemes_localize'),
	'desc' => __('Use this to override the title displayed in page title bar.','truethemes_localize'),
	'id'   => '_pagetitle_value',
	'type' => 'text_medium',
),

array(
	'name'    => __('Searchbox','truethemes_localize'),
	'desc'    => __('Should a searchbox be displayed on this page?','truethemes_localize'),
	'id'      => 'banner_search',
	'type'    => 'select',
	'options' => array(
		array('name' => 'Yes', 'value' => 'yes'),
		array('name' => 'No', 'value'  => 'no'),		
	)
),

array(
	'name'    => __('Page Comments','truethemes_localize'),
	'desc'    => __('Should a comments form be displayed at the bottom of this page?','truethemes_localize'),
	'id'      => 'page_comments',
	'type'    => 'select',
	'options' => array(
		array('name' => 'No', 'value'  => ''),
		array('name' => 'Yes', 'value' => 'on'),
	)
),

)
);
/*-------------------------------------------------------------- 
Slider Settings
--------------------------------------------------------------*/
$meta_boxes[] = array(
		'id'         => 'page_metabox_slide',
		'title'      => __('Slider Settings','truethemes_localize'),
		'pages'      => array('page'), // post type
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(
array(
	'name' => __('Slider Settings','truethemes_localize'),
	//'desc' => __('Use these settings if you wish to display a Slider on this page.','truethemes_localize'),
	'type' => 'title',
),
			
array(
	'name'    => __('Karma Slider','truethemes_localize'),
	'desc'    => __('Display a slider on this page by selecting one from the dropdown list. <a href="'.get_template_directory_uri().'/framework/screenshots/screenshot-slider-types.png?TB_iframe=false" class="thickbox">View Examples</a>','truethemes_localize'),
	'id'      => 'karma_slider_type',
	'type'    => 'select',
	'options' => array(
		array('name' => '&mdash; Select Slider Type &mdash;', 'value' => 'null'),
		array('name' => 'Karma jQuery 1', 'value' => 'karma-custom-jquery-1'),
		array('name' => 'Karma jQuery 2', 'value' => 'karma-custom-jquery-2'),
		array('name' => 'Karma jQuery 3', 'value' => 'karma-custom-jquery-3')			
	)
),
array(
	'name'     => __('Slider Category','truethemes_localize'),
	'desc'     => __('Which slider category should be used to populate the slides?','truethemes_localize'),
	'id'       => 'tt_karma_slider_category',
	'type'     => 'taxonomy_select',
	'taxonomy' => 'karma-slider-category', //Enter Taxonomy Slug
),
//@since 4.0.1 mod by Denzel as a fail safe in case the above category does not work.
array(
    'name' => __('Slider Category ID','truethemes_localize'),
    'desc' => __('Enter the category ID only if the above category dropdown is not working.','truethemes_localize'),
    'id'   => 'slider_cat_id',
    'type' => 'text_small'
),
array(
	'name' => __('Slider BG Color','truethemes_localize'),
	'id'   => 'truethemes_slider_jq_bgcolor',
	'desc' => __('Customize the background color of the slider on this page.','truethemes_localize'),
	'type' => 'colorpicker'
),
array(
	'name' => __('3D CU3ER Slider','truethemes_localize'),
	'desc' => __('Enter the Slider ID Number if you wish to display a 3D CU3ER slider on this page.<br /><a href="'.get_template_directory_uri().'/framework/screenshots/screenshot-cu3er-slider-id.png?TB_iframe=false" class="thickbox">Where do I find the CU3ER Slider ID Number?</a>','truethemes_localize'),
	'id'   => 'slider_3d_cu3er_id',
	'type' => 'text'
),

array(
	'name' => __('Slider Shortcode','truethemes_localize'),
	'desc' => __('Enter a Shortcode if you wish to display custom slider such as LayerSlider or Revolution Slider.<br />Example: [layerslider id="1"]','truethemes_localize'),
	'id'   => 'slider_custom_shortcode',
	'type' => 'textarea_code'
),

array(
	'name'     => __('Full Width Mode','truethemes_localize'),
	'id'       => 'truethemes_slider_full_width',
	'type'     => 'multicheck',
	'options'  => array(
	'true' => __('Check this box to enable Full Width Mode. Slider will span 100% width of the website. Only valid for sliders added to the \'Slider Shortcode\' field above (ie. LayerSlider and Revolution Slider).','truethemes_localize'),
	)
),


)
);
/*-------------------------------------------------------------- 
Gallery Settings
--------------------------------------------------------------*/
$meta_boxes[] = array(
		'id'         => 'page_metabox_portfolio',
		'title'      => __('Gallery Settings','truethemes_localize'),
		'pages'      => array('page'), // post type
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(
		
array(
	  'name' => __('Gallery Settings','truethemes_localize'),
	  //'desc' => __('Use these settings to display a gallery on this page.<br /><br />* Please use the <strong>Page Attributes</strong> box in the right column of this screen to assign the "Filterable Gallery" <a href="#parent_id">Template</a> for this Gallery page.','truethemes_localize'),
	  'desc' => __('Use these settings to display a gallery on this page. Please ensure to assign the "Filterable Gallery" template to this page.','truethemes_localize'),
	  'type' => 'title',
  ),
  
array(
	  'name'    => __('Page Layout','truethemes_localize'),
	  'id'      => 'meta_truethemes_gallery_layout',
	  'type'    => 'select',
	  'options' => array(
		  array('name' => '&mdash; Select a Page Layout &mdash;', 'value' => 'null'),
		  array('name' => '1 Column',            'value'  => 'tt-1-col'),
		  array('name' => '2 Column',            'value'  => 'tt-2-col'),
		  array('name' => '3 Column',            'value'  => 'tt-3-col'),
		  array('name' => '3 Column - Square',   'value'  => 'tt-3-col-square'),
		  array('name' => '4 Column',            'value'  => 'tt-4-col'),
		  array('name' => 'Portrait - 1 Column', 'value'  => 'tt-1-col-portrait'),
		  array('name' => 'Portrait - 3 Column', 'value'  => 'tt-3-col-portrait'),		
		)
  ),
  
array(
	  'name'    => __('Image Frame Style','truethemes_localize'),
	  'desc'    => __('<a href="'.get_template_directory_uri().'/framework/screenshots/screenshot-image-frames.png?TB_iframe=false" class="thickbox">View Examples</a>','truethemes_localize'),
	  'id'      => 'meta_truethemes_gallery_framestyle',
	  'type'    => 'select',
	  'options' => array(
		  array('name' => '&mdash; Select a Frame Style &mdash;', 'value' => 'null'),
		  array('name' => 'Modern Image Frame', 'value'  => 'modern'),
		  array('name' => 'Shadow Image Frame', 'value'  => 'shadow'),		
		)
  ),
  
array(
	  'name'    => __('Title','truethemes_localize'),
	  'desc'    => __('Should the post title be displayed below each gallery item?','truethemes_localize'),
	  'id'      => 'meta_truethemes_gallery_title_check',
	  'type'    => 'select',
	  'options' => array(
		  array('name' => 'Yes', 'value'  => 'yes'),
		  array('name' => 'No', 'value'  => 'no'),		
		)
  ), 
array(
	  'name'    => __('Description','truethemes_localize'),
	  'desc'    => __('Should the description be displayed below each gallery item?','truethemes_localize'),
	  'id'      => 'meta_truethemes_gallery_description_check',
	  'type'    => 'select',
	  'options' => array(
		  array('name' => 'Yes', 'value'  => 'yes'),
		  array('name' => 'No', 'value'  => 'no'),		
		)
),
array(
	  'name'     => __('Category','truethemes_localize'),
	  'desc'     => __('Which gallery category should be used to populate the gallery?','truethemes_localize'),
	  'id'       => 'meta_truethemes_gallery_category',
	  'type'     => 'taxonomy_select',
	  'taxonomy' => 'truethemes-gallery-category',
),
//@since 4.0.1 mod by Denzel as a fail safe in case the above gallery category does not work.
array(
    'name' => __('Gallery Category ID','truethemes_localize'),
    'desc' => __('Enter the category ID only if the above category dropdown is not working.','truethemes_localize'),
    'id'   => 'gallery_cat_id',
    'type' => 'text_small'
),
array(
	  'name'     => '"All Categories"',
	  'desc'     => __('Enter the text for the "All Categories" filtering link.','truethemes_localize'),
	  'id'       => 'meta_truethemes_gallery_filter_linktext',
	  'std'      => 'All',
	  'type'     => 'text_small'
),
array(
	  'name' => __('Item Count','truethemes_localize'),
	  'desc' => __('How many gallery items should be displayed? (leave blank to display all posts)','truethemes_localize'),
	  'id'       => 'meta_truethemes_gallery_itemcount',
	  'type' => 'text_small'
),
array(
	  'name' => __('Non-Filterable','truethemes_localize'),
	  'desc' => __('Use these settings to create a non-filterable Gallery from items created using Normal Posts. <br />Please ignore Filterable Settings and ensure you\'ve assigned a "Portfolio" <a href="#parent_id">Page Template</a> to this page for proper rendering.','truethemes_localize'),
	  'id'   => 'truethemes_nonfilter_heading',
	  'type' => 'title',
  ),	

array(
	  'name'     => 'Category',
	  'desc'     => __('Which post category should be used to populate the gallery items?','truethemes_localize'),
	  'id'       => '_multiple_portfolio_cat_id',
	  'type'     => 'portfolio_select_taxonomy',
	  'taxonomy' => 'category',
  ),      	

array(
	  'name' => __('Item Count','truethemes_localize'),
	  'desc' => __('How many gallery items should be displayed?','truethemes_localize'),
	  'id'   => '_sc_port_count_value',
	  'type' => 'text_small'
  ),
)
);
/*-------------------------------------------------------------- 
Parallax Banner
--------------------------------------------------------------*/
$meta_boxes[] = array(
		'id'         => 'page_metabox_parallax',
		'title'      => __('Parallax Banner','truethemes_localize'),
		'pages'      => array('page'), // post type
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(

//@since 4.0.2 - added parallax banner image option
array(
	'name' => __('Parallax Banner','truethemes_localize'),
	'type' => 'title',
),
array(
	'name'     => __('Parallax Banner','truethemes_localize'),
	'id'       => 'truethemes_parallax_banner',
	'desc'    => __('Should a Parallax Banner be displayed on this page?','truethemes_localize'),
	'type'     => 'select',
	'options' => array(
		array('name' => 'Yes', 'value'  => 'true'),
		array('name' => 'No', 'value' => ''),
	)

),
array(
	'name' => __('Banner BG Color','truethemes_localize'),
	'id'   => 'truethemes_parallax_bgcolor',
	'desc' => __('Select a background color for this banner area.','truethemes_localize'),
	'type' => 'colorpicker'
),
array(
	'name' => __('Banner BG Image','truethemes_localize'),
	'desc' => __('Upload a banner image.','truethemes_localize'),
	'id'   => 'truethemes_parallax_bgimage',
	'type' => 'file'
),
array(
	'name' => __('Padding','truethemes_localize'),
	'desc' => __('Define the top and bottom padding of this banner area.','truethemes_localize'),
	'id'   => 'truethemes_parallax_padding',
	'std'  => '80px',
	'type' => 'text_small',
),
array(
	'name'    => __('Banner Text','truethemes_localize'),
	'desc'    => __('Enter text to be displayed within this banner or simply leave blank.','truethemes_localize'),
	'id'      => 'truethemes_parallax_text',
	'type'    => 'wysiwyg',
	'options' => array( 'textarea_rows' => 10, )
),


)
);
/*-------------------------------------------------------------- 
Styling Options
--------------------------------------------------------------*/
$meta_boxes[] = array(
		'id'         => 'page_metabox_styling',
		'title'      => __('Styling Options','truethemes_localize'),
		'pages'      => array('page'), // post type
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(
		
array(
	'name' => __('Styling Options','truethemes_localize'),
	//'desc' => __('These styling options enable you to choose a unique color scheme exclusively for this page.','truethemes_localize'),
	'type' => 'title',
),
array(
	'name'    => __('Primary','truethemes_localize'),
	'id'      => 'page_primary_color_scheme',
	'type'    => 'select',
	'options' => array(
		array('name' => '&mdash; Select a Color Scheme &mdash;', 'value' => 'null'),
		array('name' => 'Alpha Green', 'value'    => 'karma-alpha-green.css'),
		array('name' => 'Autumn', 'value'         => 'karma-autumn.css'),
		array('name' => 'Black', 'value'          => 'karma-dark.css'),
		array('name' => 'Blue Grey', 'value'      => 'karma-blue-grey.css'),
		array('name' => 'Buoy Red', 'value'       => 'karma-buoy-red.css'),
		array('name' => 'Cherry', 'value'         => 'karma-cherry.css'),
		array('name' => 'Cool Blue', 'value'      => 'karma-cool-blue.css'),
		array('name' => 'Coffee', 'value'         => 'karma-coffee.css'),
		array('name' => 'Fire', 'value'           => 'karma-fire.css'),
		array('name' => 'Forest Green', 'value'   => 'karma-forest-green.css'),
		array('name' => 'French Green', 'value'   => 'karma-french-green.css'),
		array('name' => 'Golden', 'value'         => 'karma-golden.css'),
		array('name' => 'Grey', 'value'           => 'karma-grey.css'),
		array('name' => 'Lime Green', 'value'     => 'karma-lime-green.css'),
		array('name' => 'Orange', 'value'         => 'karma-orange.css'),
		array('name' => 'Periwinkle', 'value'     => 'karma-periwinkle.css'),
		array('name' => 'Political Blue', 'value' => 'karma-political-blue.css'),
		array('name' => 'Pink', 'value'           => 'karma-pink.css'),
		array('name' => 'Purple', 'value'         => 'karma-purple.css'),
		array('name' => 'Royal Blue', 'value'     => 'karma-royal-blue.css'),
		array('name' => 'Saffron Blue', 'value'   => 'karma-saffron-blue.css'),
		array('name' => 'Silver', 'value'         => 'karma-silver.css'),
		array('name' => 'Steel Green', 'value'    => 'karma-steel-green.css'),
		array('name' => 'Sky Blue', 'value'       => 'karma-sky-blue.css'),
		array('name' => 'Teal Grey', 'value'      => 'karma-teal-grey.css'),
		array('name' => 'Teal', 'value'           => 'karma-teal.css'),
		array('name' => 'Tuf Green', 'value'      => 'karma-tuf-green.css'),
		array('name' => 'Violet', 'value'         => 'karma-violet.css'),
		array('name' => 'Vista Blue', 'value'     => 'karma-vista-blue.css'),
		array('name' => 'Yogi green', 'value'     => 'karma-yogi-green.css'),			
	  )
),
array(
	 'name'    => __('Secondary','truethemes_localize'),
	 'id'      => 'page_secondary_color_scheme',
	 'type'    => 'select',
	 'options' => array(
		array('name' => '&mdash; Select a Color Scheme &mdash;', 'value' => 'null'),
		array('name' => 'Alpha Green', 'value'    => 'secondary-alpha-green.css'),
		array('name' => 'Autumn', 'value'         => 'secondary-autumn.css'),
		array('name' => 'Black', 'value'          => 'secondary-dark.css'),
		array('name' => 'Blue Grey', 'value'      => 'secondary-blue-grey.css'),
		array('name' => 'Buoy Red', 'value'       => 'secondary-buoy-red.css'),
		array('name' => 'Cherry', 'value'         => 'secondary-cherry.css'),
		array('name' => 'Cool Blue', 'value'      => 'secondary-cool-blue.css'),
		array('name' => 'Coffee', 'value'         => 'secondary-coffee.css'),
		array('name' => 'Fire', 'value'           => 'secondary-fire.css'),
		array('name' => 'Forest Green', 'value'   => 'secondary-forest-green.css'),
		array('name' => 'French Green', 'value'   => 'secondary-french-green.css'),
		array('name' => 'Golden', 'value'         => 'secondary-golden.css'),
		array('name' => 'Grey', 'value'           => 'secondary-grey.css'),
		array('name' => 'Lime Green', 'value'     => 'secondary-lime-green.css'),
		array('name' => 'Orange', 'value'         => 'secondary-orange.css'),
		array('name' => 'Periwinkle', 'value'     => 'secondary-periwinkle.css'),
		array('name' => 'Political Blue', 'value' => 'secondary-political-blue.css'),
		array('name' => 'Pink', 'value'           => 'secondary-pink.css'),
		array('name' => 'Purple', 'value'         => 'secondary-purple.css'),
		array('name' => 'Royal Blue', 'value'     => 'secondary-royal-blue.css'),
		array('name' => 'Saffron Blue', 'value'   => 'secondary-saffron-blue.css'),
		array('name' => 'Silver', 'value'         => 'secondary-silver.css'),
		array('name' => 'Steel Green', 'value'    => 'secondary-steel-green.css'),
		array('name' => 'Sky Blue', 'value'       => 'secondary-sky-blue.css'),
		array('name' => 'Teal Grey', 'value'      => 'secondary-teal-grey.css'),
		array('name' => 'Teal', 'value'           => 'secondary-teal.css'),
		array('name' => 'Tuf Green', 'value'      => 'secondary-tuf-green.css'),
		array('name' => 'Violet', 'value'         => 'secondary-violet.css'),
		array('name' => 'Vista Blue', 'value'     => 'secondary-vista-blue.css'),
		array('name' => 'Yogi green', 'value'     => 'secondary-yogi-green.css'),			
	  )
),
array(
	'name' => __('Gradient Design Style','truethemes_localize'),
	'desc' => __('Check this box for gradient design style','truethemes_localize'),
	'id'   => 'truethemes_gradient_style',
	'type' => 'checkbox'
),
array(
	'name' => __('Flat Design Style','truethemes_localize'),
	'desc' => __('Check this box for flat design style','truethemes_localize'),
	'id'   => 'truethemes_flat_style',
	'type' => 'checkbox'
),
array(
	'name' => __('Background','truethemes_localize'),
	'desc' => __('These background settings are exclusive to this page and will only visible in the boxed layout design.','truethemes_localize'),
	'type' => 'title',
),
array(
	'name' => __('Body BG Color','truethemes_localize'),
	'id'   => 'page_background_color',
	'type' => 'colorpicker'
),
array(
	'name' => __('Body BG Image','truethemes_localize'),
	'id'   => 'page_background_image',
	'type' => 'file'
),
array(
	'name'    => __('BG Image Position','truethemes_localize'),
	'id'      => 'page_background_position',
	'type'    => 'select',
	'options' => array(
		array('name' => 'left top', 'value' => 'left top'),
		array('name' => 'center top', 'value' => 'center top'),
		array('name' => 'right top', 'value' => 'right top'),
		array('name' => 'center center', 'value' => 'center center'),
		array('name' => 'left bottom', 'value' => 'left bottom'),
		array('name' => 'center bottom', 'value' => 'center bottom'),
		array('name' => 'right bottom', 'value' => 'right bottom'),	
	  )
),
array(
	'name'    => __('BG Image Repeat','truethemes_localize'),
	'id'      => 'page_background_repeat',
	'type'    => 'select',
	'options' => array(
		array('name' => 'repeat', 'value' => 'repeat'),
		array('name' => 'repeat-x', 'value' => 'repeat-x'),
		array('name' => 'repeat-y', 'value' => 'repeat-y'),
		array('name' => 'no-repeat', 'value' => 'no-repeat'),	
	  )
),
array(
	'name' => __('BG Image Fixed','truethemes_localize'),
	'desc' => __('Check this box to set the BG Image to Fixed.','truethemes_localize'),
	'id'   => 'truethemes_page_background_fixed',
	'type' => 'checkbox'
),
)
);
/*---------------------------------------------------*/
/*	Meta Boxes for Gallery post-type
/*---------------------------------------------------*/
$meta_boxes[] = array(
'id'         => 'tt_truethemes_gallery',
'title'      => __('Settings','truethemes_localize'),
'pages'      => array('tt-gallery'), // post type
'context'    => 'normal',
'priority'   => 'high',
'show_names' => true, // Show field names on the left
'fields'     => array(

array(
	'name' => __('Category','truethemes_localize'),
	'desc' => __('Use the <strong>Categories box</strong> in the right column of this screen to define a category for this gallery post. (this category will be used for filtering.)','truethemes_localize'),
	'type' => 'title'
),

array(
	'name' => __('Thumbnail','truethemes_localize'),
	'desc' => __('Thumbnails are the images displayed in a grid layout on the gallery page.','truethemes_localize'),
	'type' => 'title'
),

array(
	'name' => __('Image','truethemes_localize'),
	'desc' => __('Upload a thumbnail image for this gallery post. This image will be automatically resized.<br /><a href="'.get_template_directory_uri().'/framework/screenshots/screenshot-image-dimensions.png?TB_iframe=false" class="thickbox">View Image Dimensions</a>','truethemes_localize'),
	'id'   => 'truethemes_gallery_thumbnail',
	'type' => 'file'
),

array(
	'name' => __('Content','truethemes_localize'),
	'desc' => __('This content is displayed below the thumbnail. Simply leave blank if prefer not to display content.','truethemes_localize'),
	'type' => 'title'
),

array(
	'name' => __('Title','truethemes_localize'),
	'id' => 'truethemes_gallery_title',
	'type' => 'text'
),

array(
	'name' => __('Description','truethemes_localize'),
	'id' => 'truethemes_gallery_description',
	'type' => 'wysiwyg',
	'options' => array( 'textarea_rows' => 10, )
),


array(
	'name' => __('Page Linking','truethemes_localize'),
	'desc' => __('Use this section to link this gallery post to a Page rather than a Lightbox. Simply ignore this section if you prefer Lightbox.','truethemes_localize'),
	'type' => 'title'
),

array(
	'name' => __('Page URL','truethemes_localize'),
	'desc' => __('Enter a URL if you prefer to link this gallery post to a page.','truethemes_localize'),
	'id' => 'truethemes_gallery_link_to_page',
	'type' => 'text'
),


array(
 'name' => __('Open Page Link in','truethemes_localize'),
 'id' => 'truethemes_gallery_link_target',
 'type' => 'select',
'options' => array(
					array('name' => 'Current Window', 'value' => '_self'),
					array('name' => 'New Window', 'value' => '_blank')			
				  )
),

array(
	'name' => __('Lightbox','truethemes_localize'),
	'desc' => __('Each gallery post can have up to 5 Lightbox items. Each item can be given a Title which is displayed within the Lightbox.<br /><br />Use the "Upload File" button to display an image or enter the full URL to display one of the other <a href="'.get_template_directory_uri().'/framework/screenshots/screenshot-lightbox-media.png?TB_iframe=false" class="thickbox">Lightbox Media Types</a>.','truethemes_localize'),
	'type' => 'title'
),

array(
	'name' => __('Lightbox Item 1','truethemes_localize'),
	'id'   => 'truethemes_gallery_lightbox',
	'type' => 'file'
),

array(
	'name' => __('Title','truethemes_localize'),
	'id'   => 'truethemes_gallery_lightbox_title_1',
	'type' => 'text_medium'
),

array(
	'name' => __('Lightbox Item 2','truethemes_localize'),
	'id'   => 'truethemes_gallery_lightbox_2',
	'type' => 'file'
),

array(
	'name' => __('Title','truethemes_localize'),
	'id'   => 'truethemes_gallery_lightbox_title_2',
	'type' => 'text_medium'
),

array(
	'name' => __('Lightbox Item 3','truethemes_localize'),
	'id' => 'truethemes_gallery_lightbox_3',
	'type' => 'file'
),

array(
	'name' => __('Title','truethemes_localize'),
	'id'   => 'truethemes_gallery_lightbox_title_3',
	'type' => 'text_medium'
),

array(
	'name' => __('Lightbox Item 4','truethemes_localize'),
	'id' => 'truethemes_gallery_lightbox_4',
	'type' => 'file'
),

array(
	'name' => __('Title','truethemes_localize'),
	'id'   => 'truethemes_gallery_lightbox_title_4',
	'type' => 'text_medium'
),

array(
	'name' => __('Lightbox Item 5','truethemes_localize'),
	'id' => 'truethemes_gallery_lightbox_5',
	'type' => 'file'
),

array(
	'name' => __('Title','truethemes_localize'),
	'id'   => 'truethemes_gallery_lightbox_title_5',
	'type' => 'text_medium'
),

)
);
/*---------------------------------------------------*/
/*	Meta Boxes for Slider post-type
/*---------------------------------------------------*/
$meta_boxes[] = array(
		'id'         => 'slider_metabox',
		'title'      => __('Slide Settings','truethemes_localize'),
		'pages'      => array('karma-slider'), // post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
		
array(
	'name' => __('Blank Canvas Mode','truethemes_localize'),
	'desc' => __('Check this box to enable a blank canvas for this slide. All settings below will be ignored and only content entered into the content editor of this post will be displayed.','truethemes_localize'),
	'id'   => 'slider_blank_canvas',
	'type' => 'checkbox'
),
		
array(
	'name' => __('Category','truethemes_localize'),
	'desc' => __('Use the <strong>Categories box</strong> in the right column of this screen to define a category for this slider post.','truethemes_localize'),
	'type' => 'title'
),
			
array(
	'name' => __('Featured Image','truethemes_localize'),
	'desc' => __('Setup a featured image for this slide. <a href="#featured-video">Skip this section and scroll down</a> to display a Featured Video instead.','truethemes_localize'),
	'type' => 'title',
),


array(
	'name'    => 'Image Size',
	'desc' => __('All images automatically re-sized to the dimensions below:<br /><br /><strong>jQuery 1 Slider - Image Dimensions:</strong><br />Normal Image: 404 x 256<br />Full-width Image: 940 x 283<br /><br /><strong>jQuery 2 Slider - Image Dimensions:</strong><br />Normal Image: 436 x 270<br />Full-width Image: 840 x 270<br />Full-bleed Image: 920 x 358<br /><br /><strong>jQuery 3 Slider - Image Dimensions:</strong><br />Normal Image: 436 x 270<br />Full-width Image: 960 x 350','truethemes_localize'),	
	'id'      => 'slider_image_layout',
	'type'    => 'select',
	'options' => array(
		array('name' => '&mdash; Select Image Size &mdash;', 'value' => 'video'), //defined as "video" for custom class added to slider <li>
		array('name' => 'Normal Image', 'value' => 'normal-image'),
		array('name' => 'Full-width Image', 'value' => 'full-width-image'),
		array('name' => 'Full-bleed Image (for jQuery-2 slider only)', 'value' => 'full-bleed-image')			
	),
),

array(
'name' => __('Featured Image','truethemes_localize'),
'id'   => 'slider_image',
'type' => 'file'
),

array(
'name' => __('Image Linking','truethemes_localize'),
'desc' => __('Turn this image into a clickable link by entering the full URL here.','truethemes_localize'),
'id'   => 'slider_image_linking',
'type' => 'text_medium'
),

array(
'name' => __('ALT Text','truethemes_localize'),
'desc' => __('Add ALT text to this image to help boost your website\'s SEO.','truethemes_localize'),
'id'   => 'slider_image_alt_text',
'type' => 'text_medium'
),


array(
	'name' => __('<a name="featured-video"></a>Featured Video','truethemes_localize'),
	'desc' => __('Enter a YouTube or Vimeo URL below. Full list of supported video services listed at: <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>.','truethemes_localize'),
	'type' => 'title',
),


array(
	'name' => __('Featured Video','truethemes_localize'),
	'id'   => 'slider_video',
	'desc' => __('<strong>Sample URL:</strong> http://vimeo.com/70149174','truethemes_localize'),
	'type' => 'oembed',
),
)
);

return $meta_boxes;
}
add_action('init','be_initialize_cmb_meta_boxes',9999);
function be_initialize_cmb_meta_boxes() {
if (!class_exists('cmb_Meta_Box')) {require_once('init.php');}}
?>