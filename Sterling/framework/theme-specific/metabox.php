<?php
//filter into Custom metaboxes and Fields script with our own type gallery_taxonomy_select for use in gallery settings.
add_filter( 'cmb_render_gallery_select_taxonomy', 'tt_render_gallery_select_taxonomy', 10, 2 );
function tt_render_gallery_select_taxonomy( $field, $meta ) {

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


// Include & setup custom metabox and fields
$prefix = '_cmb_'; // start with an underscore to hide fields from custom fields list
add_filter( 'cmb_meta_boxes', 'be_sample_metaboxes' );


function be_sample_metaboxes( $meta_boxes ) {
$meta_boxes[] = array(
'id' => 'test_metabox',
'title' => __('Settings','tt_theme_framework'),
'pages' => array('gallery'), // post type
'context' => 'normal',
'priority' => 'high',
'show_names' => true, // Show field names on the left
'fields' => array(

array(
	'name' => __('Thumbnail, Title and Description','tt_theme_framework'),
	'desc' => __('These 3 items will be displayed directly on the gallery page.','tt_theme_framework'),
	'type' => 'title'
),
array(
	'name' => __('Thumbnail Image','tt_theme_framework'),
	'desc' => __('Upload an image or enter the URL to a thumbnail image. (this will be automatically resized)','tt_theme_framework'),
	'id' => $prefix . 'gal_thumbnail',
	'type' => 'file'
),
array(
 'name' => __('Title','tt_theme_framework'),
 'desc' => __('Would you like to display the title of this item?','tt_theme_framework'),
 'id' => $prefix . 'gal_title_select',
 'type' => 'select',
'options' => array(
array('name' => 'Yes', 'value' => 'yes'),
array('name' => 'No', 'value' => 'no')			
)
),
array(
 'name' => __('Description','tt_theme_framework'),
 'desc' => __('Would you like to display the description of this item?','tt_theme_framework'),
 'id' => $prefix . 'gal_description_select',
 'type' => 'select',
'options' => array(
array('name' => 'Yes', 'value' => 'yes'),
array('name' => 'No', 'value' => 'no')			
)
),
array(
	'name' => __('Description','tt_theme_framework'),
	'desc' => __('This description will be displayed below the title. (you can simply ignore this section if you won\'t be displaying the description)','tt_theme_framework'),
	'id' => $prefix . 'gal_description',
	'type' => 'textarea_small'
),

array(
	'name' => __('Link to a Page','tt_theme_framework'),
	'desc' => __('Enter a url to link the Thumbnail Image to a Page. (This will override Lightbox Settings).','tt_theme_framework'),
	'id' => $prefix . 'gal_link_to_page',
	'type' => 'text'
),


array(
 'name' => __('Open Page Link in','tt_theme_framework'),
 'desc' => __('Would you like to open the page link in current window or new window?','tt_theme_framework'),
 'id' => $prefix . 'gal_link_target',
 'type' => 'select',
'options' => array(
					array('name' => 'Current Window', 'value' => '_self'),
					array('name' => 'New Window', 'value' => '_blank')			
				  )
),


array(
	'name' => __('Lightbox Description','tt_theme_framework'),
	'desc' => __('This description will be displayed within the lightbox overlay.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox_title',
	'type' => 'text'
),

array(
	'name' => __('Lightbox Items','tt_theme_framework'),
	'desc' => __('Each gallery item can have up to 5 lightbox items.<br><br> To display an image simply use the upload button next to each field. To display a video or other media simply paste the proper URL into the given field.<br><br>Sample Media Types:<br><br><strong>YouTube Video:</strong> http://www.youtube.com/watch?v=VKS08be78os<br><strong>Vimeo Video:</strong> http://vimeo.com/8245346<br><strong>Flash SWF:</strong> http://www.adobe.com/products/flashplayer/include/marquee/design.swf?width=792&height=294<br><strong>i-Frame:</strong> http://www.apple.com?iframe=true&width=850&height=500<br><br>','tt_theme_framework'),
	'type' => 'title'
),

array(
	'name' => __('Lightbox Item 1','tt_theme_framework'),
	'desc' => __('This will be the 1st item displayed in the lightbox.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox',
	'type' => 'file'
),

array(
	'name' => __('Lightbox Item 2','tt_theme_framework'),
	'desc' => __('This will be the 2nd item displayed in the lightbox.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox2',
	'type' => 'file'
),

array(
	'name' => __('Lightbox Description 2','tt_theme_framework'),
	'desc' => __('This description will be displayed within the lightbox overlay.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox_title_2',
	'type' => 'text'
),


array(
	'name' => __('Lightbox Item 3','tt_theme_framework'),
	'desc' => __('This will be the 3rd item displayed in the lightbox.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox3',
	'type' => 'file'
),


array(
	'name' => __('Lightbox Description 3','tt_theme_framework'),
	'desc' => __('This description will be displayed within the lightbox overlay.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox_title_3',
	'type' => 'text'
),


array(
	'name' => __('Lightbox Item 4','tt_theme_framework'),
	'desc' => __('This will be the 4th item displayed in the lightbox.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox4',
	'type' => 'file'
),

array(
	'name' => __('Lightbox Description 4','tt_theme_framework'),
	'desc' => __('This description will be displayed within the lightbox overlay.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox_title_4',
	'type' => 'text'
),

array(
	'name' => __('Lightbox Item 5','tt_theme_framework'),
	'desc' => __('This will be the 5th item displayed in the lightbox.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox5',
	'type' => 'file'
),


array(
	'name' => __('Lightbox Description 5','tt_theme_framework'),
	'desc' => __('This description will be displayed within the lightbox overlay.','tt_theme_framework'),
	'id' => $prefix . 'gal_lightbox_title_5',
	'type' => 'text'
),

array(
	'name' => __('Category','tt_theme_framework'),
	'desc' => __('Use the <strong>Categories box</strong> in the right column of this screen to define a category for this gallery post.','tt_theme_framework'),
	'type' => 'title'
),
/**
array(
		'name' => __('Category','tt_theme_framework'),
		'desc' => __('Choose a category for this gallery item. You can also add a new category using the categories box over on the right.','tt_theme_framework'),
		'id' => $prefix . 'text_taxonomy_radio',
		'taxonomy' => 'gallery-category', //Enter Taxonomy Slug
		'type' => 'taxonomy_multicheck',
		),
**/

	)
);




/*---------------------------------------------------*/
/*	FAQ Meta Boxes
/*---------------------------------------------------*/
$meta_boxes[] = array(
		'id' => 'faq_metabox',
		'title' => __('FAQ Details','tt_theme_framework'),
		'pages' => array('faq'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('FAQ Question','tt_theme_framework'),
				'desc' => __('Enter the FAQ Question','tt_theme_framework'),
				'id' => $prefix . 'faq_question',
				'type' => 'textarea_small'
			),
			
			array(
				'name' => __('FAQ Answer','tt_theme_framework'),
				'desc' => __('Enter the FAQ Answer','tt_theme_framework'),
				'id' => $prefix . 'faq_answer',
				'type' => 'wysiwyg'
			),
		)
	);
	
	




/*---------------------------------------------------*/
/*	Meta Boxes for Slider Post Type
/*---------------------------------------------------*/
$meta_boxes[] = array(
		'id' => 'slider_metabox',
		'title' => __('Slider Post Details','tt_theme_framework'),
		'pages' => array('slider'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
		array(
	'name' => __('Category','tt_theme_framework'),
	'desc' => __('Use the <strong>Categories box</strong> in the right column of this screen to define a category for this slider post.','tt_theme_framework'),
	'type' => 'title'
),
		
		array(
	'name' => __('Featured Image','tt_theme_framework'),
	'desc' => __('Setup a featured image for this slide. <a href="#featured-video">Skip this section and scroll down</a> to display a Featured Video instead.','tt_theme_framework'),
	'type' => 'title',
),

		array(
			'name' => __('Featured Image','tt_theme_framework'),
			'desc' => __('Upload an image or enter the URL to the image you\'d like to display. (this will be automatically resized to 445 x 273)','tt_theme_framework'),
			'id' => $prefix . 'slider_image',
			'type' => 'file'
		),
		
		array(
			'name' => __('Featured Image Link','tt_theme_framework'),
			'desc' => __('Would you like the featured image to be a clickable link? If so, enter the URL here.','tt_theme_framework'),
			'id' => $prefix . 'slider_image_url',
			'type' => 'text'
		),
		
		array(
			'name' => __('Featured Image Alt Text','tt_theme_framework'),
			'desc' => __('Add descriptive Alt text to your featured image to help boost your site\'s SEO.','tt_theme_framework'),
			'id' => $prefix . 'slider_image_alt_text',
			'type' => 'text'
		),
		
		array(
	'name' => __('<a name="featured-video"></a>Featured Video','tt_theme_framework'),
	'desc' => __('Enter a YouTube or Vimeo URL below. Full list of supported video services listed at: <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">http://codex.wordpress.org/Embeds</a>.','tt_theme_framework'),
	'type' => 'title',
),

		array(
			'name' => __('Featured Video','tt_theme_framework'),
			'desc' => __('Enter the URL to the YouTube or Vimeo video that you\'d like to display.','tt_theme_framework'),
			'id' => $prefix . 'slider_video',
			'type' => 'text'
		),
		
		array(
				'name' => __('Alignment','tt_theme_framework'),
				'desc' => __('Would you like to align the Image/Video to the right or left?','tt_theme_framework'),
				'id' => $prefix . 'slider_alignment',
				'type' => 'select',
				'options' => array(
					array('name' => 'Align Right', 'value' => 'align_right'),
					array('name' => 'Align Left', 'value' => 'align_left')		
				)
			),
			
			
		)
	);
	
	
	
	
	

/*---------------------------------------------------*/
/*	Meta Boxes for Pages
/*---------------------------------------------------*/
$meta_boxes[] = array(
		'id' 	     => 'page_metabox',
		'title' 	 => __('Page Settings','tt_theme_framework'),
		'pages' 	 => array('page'), // post type
		'context' 	 => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(

			array(
				'name' => __('Page Settings','tt_theme_framework'),
				'type' => 'title',
			),

			array(
				'name' => __('Featured Image','tt_theme_framework'),
				'desc' => __('The featured image will be the first item displayed in the content of the page.','tt_theme_framework'),
				'id'   => $prefix . 'page_featured_image',
				'type' => 'file'
			),
			
			array(
				'name' => __('Banner Title','tt_theme_framework'),
				'desc' => __('Override the default page title displayed in the banner','tt_theme_framework'),
				'id'   => $prefix . 'bannertitle',
				'type' => 'text_small'
			),
			
			array(
				'name'    => __('Searchbar','tt_theme_framework'),
				'desc'    => __('Would you like to display a searchbar on this page?','tt_theme_framework'),
				'id'      => $prefix . 'banner_search',
				'type'    => 'select',
				'options' => array(
					array('name' => 'Yes', 'value' => 'yes'),
					array('name' => 'No', 'value' => 'no')			
				)
			),
			
			array(
				'name' => __('Banner Description','tt_theme_framework'),
				'desc' => __('Short descriptive text for the banner area of this page. (note: if searchbar is enabled this description will not be displayed.)','tt_theme_framework'),
				'id' => $prefix . 'banner_description',
				'type' => 'text'
			),
			
			array(
				'name' => __('Page Comments','tt_theme_framework'),
				'desc' => __('Check this box to enable comments on this page.','tt_theme_framework'),
				'id' => $prefix . 'page_comments',
				'type' => 'checkbox'
			),	
			
		)
	);
	
	
	

// Slider Settings
$meta_boxes[] = array(
		'id'         => 'page_metabox_slide',
		'title'      => __('Slider Settings','tt_theme_framework'),
		'pages'      => array('page'), // post type
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(
array(
	'name' => __('Slider Settings','tt_theme_framework'),
	'desc' => __('Use these settings to display a Slider on this page. Simply ignore this entire section if not displaying a Slider.','tt_theme_framework'),
	'type' => 'title',
),

array(
				'name' => __('Activate','tt_theme_framework'),
				'desc' => __('Check this box to enable a jQuery slider on this page.','tt_theme_framework'),
				'id' => $prefix . 'truethemes_activate_jquery_slider',
				'type' => 'checkbox'
			),
			

array(
	'name'     => __('Category','tt_theme_framework'),
	'desc'     => __('Which post category should the Karma jQuery Slider use to populate the slides?<br /><strong>Note:</strong> this section lists categories that were created within the \'Slider Posts\' custom post-type','tt_theme_framework'),
	'id'       => 'truethemes_sterling_slider_category',
	'type'     => 'taxonomy_select',
	'taxonomy' => 'sterling-slider-category', //Enter Taxonomy Slug
),

//fail safe in case the above category does not work.
array(
    'name' => __('Slider Category ID','truethemes_localize'),
    'desc' => __('Enter the Slider Category ID Number only if the above category dropdown is not working.','truethemes_localize'),
    'id'   => 'slider_cat_id',
    'type' => 'text_small'
),

array(
	'name' => __('3D CU3ER Slider','tt_theme_framework'),
	'desc' => __('Enter the Slider ID Number if you wish to display a 3D CU3ER slider on this page.<br /><a href="'.get_template_directory_uri().'/framework/screenshots/screenshot-cu3er-slider-id.png?TB_iframe=false" class="thickbox">Where do I find the CU3ER Slider ID Number?</a>','tt_theme_framework'),
	'id'   => 'truethemes_slider_cu3er',
	'type' => 'text'
),

array(
	'name' => __('Slider Shortcode','tt_theme_framework'),
	'desc' => __('Enter a Shortcode if you wish to display custom slider such as LayerSlider or Revolution Slider.<br />Example: [layerslider id="1"]','tt_theme_framework'),
	'id'   => 'truethemes_slider_shortcode',
	'type' => 'textarea_code'
),

array(
	'name'     => __('Full Width Mode','tt_theme_framework'),
	'id'       => 'truethemes_slider_full_width',
	'type'     => 'multicheck',
	'options'  => array(
		'true' => 'Check this box to enable Full Width Mode. Slider will span 100% width of the website. Only valid for sliders added to the \'Slider Shortcode\' field above (ie. LayerSlider and Revolution Slider).',
	)
),


)
);
	
	
//Gallery Settings
$meta_boxes[] = array(
		'id'         => 'page_metabox_portfolio',
		'title'      => __('Gallery Settings','tt_theme_framework'),
		'pages'      => array('page'), // post type
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(
		
array(
	  'name' => __('Gallery Settings','tt_theme_framework'),
	  'desc' => __('Use these settings to display a Gallery on this page. Simply ignore this entire section if do not wish for this to be a Gallery page.<br /><br />* Please use the <strong>Page Attributes</strong> box in the right column of this screen to assign the "Filterable Gallery" <a href="#parent_id">Template</a> for this Gallery page.','tt_theme_framework'),
	  'type' => 'title',
  ),
  
array(
	  'name'    => __('Page Layout','tt_theme_framework'),
	  'id'      => 'meta_truethemes_gallery_layout',
	  'type'    => 'select',
	  'options' => array(
		  array('name' => '&mdash; Select a Page Layout &mdash;', 'value' => 'null'),
		  array('name' => '2 Column',            'value'  => 'tt-2-col'),
		  array('name' => '3 Column',            'value'  => 'tt-3-col'),
		  array('name' => '4 Column',            'value'  => 'tt-4-col'),
		  array('name' => 'Portrait - 3 Column', 'value'  => 'tt-3-col-portrait'),
		  array('name' => 'Portrait - 4 Column', 'value'  => 'tt-4-col-portrait'),		
		)
  ),
  
  
array(
	  'name'     => __('Category','tt_theme_framework'),
	  'desc'     => __('Which post category should be used to populate the gallery items? (please select the <strong>parent</strong> category)','tt_theme_framework'),
	  'id'       => 'meta_truethemes_gallery_category',
	  'type'     => 'gallery_select_taxonomy',
	  'taxonomy' => 'gallery-category',
  ),


//fail safe in case the above gallery category does not work.
array(
    'name' => __('Gallery Category ID','truethemes_localize'),
    'desc' => __('Enter the Gallery Category ID Number (<strong>parent</strong> category) only if the above category dropdown is not working.','truethemes_localize'),
    'id'   => 'gallery_cat_id',
    'type' => 'text_small'
), 
  
array(
	  'name'     => '"All Categories"',
	  'desc'     => __('Enter the text for the "All Categories" filtering link.','tt_theme_framework'),
	  'id'       => 'meta_truethemes_gallery_filter_linktext',
	  'std'      => 'All',
	  'type'     => 'text_small'
  ),    	

array(
	  'name' => __('Item Count','tt_theme_framework'),
	  'desc' => __('How many gallery items should be displayed? Leave blank to display all posts.','tt_theme_framework'),
	  'id'       => 'meta_truethemes_gallery_itemcount',
	  'type' => 'text_small'
  ),

)
);
	
	

/*---------------------------------------------------*/
/*	Meta Boxes for Pages - Styling Options
/*---------------------------------------------------*/
$meta_boxes[] = array(
		'id' => 'page_metabox_styling',
		'title' => __('Page Styling Options','tt_theme_framework'),
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(

		array(
	'name' => __('Styling Options','truethemes_localize'),
	'desc' => __('These styling options enable you to choose a unique color scheme exclusively for this page.','truethemes_localize'),
	'type' => 'title',
),
		
		array(
 'name' => __('Primary Color Scheme','tt_theme_framework'),
 'id' => $prefix . 'page_primary_color_scheme',
 'type' => 'select',
'options' => array(
					array('name' => '-- Select a Color Scheme --', 'value' => 'null'),
					array('name' => 'Autumn', 'value' => 'primary-autumn.css'),
					array('name' => 'Black', 'value' => 'primary-black.css'),
					array('name' => 'Blue Grey', 'value' => 'primary-blue-grey.css'),
					array('name' => 'Cool Blue', 'value' => 'primary-blue.css'),
					array('name' => 'Coffee', 'value' => 'primary-coffee.css'),
					array('name' => 'Fire', 'value' => 'primary-fire.css'),
					array('name' => 'Golden', 'value' => 'primary-golden.css'),
					array('name' => 'Green', 'value' => 'primary-green.css'),
					array('name' => 'Lime Green', 'value' => 'primary-lime-green.css'),
					array('name' => 'Periwinkle', 'value' => 'primary-periwinkle.css'),
					array('name' => 'Pink', 'value' => 'primary-pink.css'),
					array('name' => 'Purple', 'value' => 'primary-purple.css'),
					array('name' => 'Red', 'value' => 'primary-red.css'),
					array('name' => 'Royal Blue', 'value' => 'primary-royal-blue.css'),
					array('name' => 'Silver', 'value' => 'primary-silver.css'),
					array('name' => 'Sky Blue', 'value' => 'primary-sky-blue.css'),
					array('name' => 'Teal Grey', 'value' => 'primary-teal-grey.css'),
					array('name' => 'Teal', 'value' => 'primary-teal.css'),			
				  )
),


array(
 'name' => __('Secondary Color Scheme','tt_theme_framework'),
 'id' => $prefix . 'page_secondary_color_scheme',
 'type' => 'select',
'options' => array(
					array('name' => '-- Select a Color Scheme --', 'value' => 'null'),
					array('name' => 'Autumn', 'value' => 'secondary-autumn.css'),
					array('name' => 'Black', 'value' => 'secondary-black.css'),
					array('name' => 'Blue Grey', 'value' => 'secondary-blue-grey.css'),
					array('name' => 'Cool Blue', 'value' => 'secondary-blue.css'),
					array('name' => 'Coffee', 'value' => 'secondary-coffee.css'),
					array('name' => 'Fire', 'value' => 'secondary-fire.css'),
					array('name' => 'Golden', 'value' => 'secondary-golden.css'),
					array('name' => 'Green', 'value' => 'secondary-green.css'),
					array('name' => 'Lime Green', 'value' => 'secondary-lime-green.css'),
					array('name' => 'Periwinkle', 'value' => 'secondary-periwinkle.css'),
					array('name' => 'Pink', 'value' => 'secondary-pink.css'),
					array('name' => 'Purple', 'value' => 'secondary-purple.css'),
					array('name' => 'Red', 'value' => 'secondary-red.css'),
					array('name' => 'Royal Blue', 'value' => 'secondary-royal-blue.css'),
					array('name' => 'Silver', 'value' => 'secondary-silver.css'),
					array('name' => 'Sky Blue', 'value' => 'secondary-sky-blue.css'),
					array('name' => 'Teal Grey', 'value' => 'secondary-teal-grey.css'),
					array('name' => 'Teal', 'value' => 'secondary-teal.css'),			
				  )
			),

array(
	'name' => __('Background','truethemes_localize'),
	'desc' => __('These background settings are exclusive to this page and will only visible in the boxed layout design.','truethemes_localize'),
	'type' => 'title',
),
			
			array(
				'name' => __('Body BG Color','tt_theme_framework'),
				'id' => $prefix . 'page_background_color',
				'type' => 'colorpicker'
			),
			
			array(
				'name' => __('Body BG Image','tt_theme_framework'),
				'id' => $prefix . 'page_background_image',
				'type' => 'file'
			),
			
			array(
				'name' => __('BG Image Position','tt_theme_framework'),
				'id' => $prefix . 'page_background_position',
				'type' => 'select',
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
				'name' => __('BG Image Repeat','tt_theme_framework'),
				'id' => $prefix . 'page_background_repeat',
				'type' => 'select',
				'options' => array(
					array('name' => 'repeat', 'value' => 'repeat'),
					array('name' => 'repeat-x', 'value' => 'repeat-x'),
					array('name' => 'repeat-y', 'value' => 'repeat-y'),
					array('name' => 'no-repeat', 'value' => 'no-repeat'),	
				  )
			),
			

			
		)
	);

		
	
	
return $meta_boxes;
}
add_action('init','be_initialize_cmb_meta_boxes',9999);
function be_initialize_cmb_meta_boxes() {
if (!class_exists('cmb_Meta_Box')) {require_once('init.php');}}
?>
<?php
//Start of new page side meta box
add_action('admin_init', 'truethemes_add_custom_box',1);
add_action('save_post', 'truethemes_save_postdata');

//add box to side column of page
function truethemes_add_custom_box(){
    
	/* add_meta_box(
        'truethemes_meta_box_id',
        __( 'Sub Navigation', 'tt_theme_framework' ), 
        'truethemes_inner_custom_box',
        'page','side','low'
    ); */
    
     add_meta_box(
        'truethemes_video_id',
        __( 'Featured Video', 'tt_theme_framework' ), 
        'truethemes_inner_custom_box_3',
        'post','side','low'
    );
    
     add_meta_box(
        'truethemes_featured_image_2',
        __( 'Featured Image (External Source)', 'tt_theme_framework' ), 
        'truethemes_inner_custom_box_4',
        'post','side','low'
    );
    

//add metabox to page side, rearrange the below add_meta_box code will change the position.
    
     /* add_meta_box(
        'truethemes_slider',
        __( 'Custom Slider', 'tt_theme_framework' ), 
        'truethemes_inner_custom_box_6',
        'page','side','low'
    );  
    
    
       add_meta_box(
        'truethemes_slider',
        __( 'Custom Slider', 'tt_theme_framework' ), 
        'truethemes_inner_custom_box_6',
        'post','side','low'
    );   */     
    
    
      add_meta_box(
        'truethemes_custom_menu',
        __( 'Custom Sub-menu', 'tt_theme_framework' ), 
        'truethemes_inner_custom_box_5',
        'page','side','low'
    );   
    
        

}

//page meta box
function truethemes_inner_custom_box(){

  //nonce
  wp_nonce_field( plugin_basename(__FILE__), 'truethemes_noncename' );
  
  //retrieve post meta value for check
  global $post;
  $post_id = $post->ID;
  $meta_value = get_post_meta($post_id,'truethemes_page_checkbox',true);

  //check box
  echo '<input type="checkbox" id="truethemes_page_checkbox" name="truethemes_page_checkbox" value="yes"';
 if($meta_value=='yes'){
  echo"checked='yes'";
 }else{
  echo"";
 }
  echo '/>';
  echo '<label for="truethemes_checkbox"> ';
  _e("Hide the sub navigation", 'tt_theme_framework' );
  echo '</label> ';
}



//post meta box
function truethemes_inner_custom_box_3(){

  //nonce
  wp_nonce_field( plugin_basename(__FILE__), 'truethemes_noncename' );
  
  //retrieve post meta value for check
  global $post;
  $post_id = $post->ID;
  $video_url = get_post_meta($post_id,'truethemes_video_url',true);

//video url input  
echo "<p><label>";
_e('Video URL','tt_theme_framework');
echo"</label> ";
echo "<input type='text' id='truethemes_video_url' name='truethemes_video_url' value='" . esc_url( $video_url ) . "' /></p>";
}

//post meta box
function truethemes_inner_custom_box_4(){

  //nonce
  wp_nonce_field( plugin_basename(__FILE__), 'truethemes_noncename' );
  
  //retrieve post meta value for check
  global $post;
  $post_id = $post->ID;
  $image_url = get_post_meta($post_id,'truethemes_external_image_url',true);
  
  if(!empty($image_url)){

		//show tim thumb image if there is setted image url.
		if(is_multisite()){
		//multisite timthumb request url - to tested online.
	
		$theme_name = wp_get_theme();
	
		$image_src = TIMTHUMB_SCRIPT_MULTISITE."?src=" . esc_url( $image_url ) . "&w=200";
		
		}else{
		//single site timthumb request url
	
		$image_src = TIMTHUMB_SCRIPT."?src=" . esc_url( $image_url ) . "&w=250";
	
		}

		echo "<img src='" . esc_url( $image_src ) . "' alt=''/>";

	}

//video url input  
echo "<p><label>";
_e('Image URL','tt_theme_framework');
echo "</label> ";
echo "<input type='text' id='truethemes_external_image_url' name='truethemes_external_image_url' value='" . esc_url( $image_url ) . "' /></p>";
}

//post meta box
function truethemes_inner_custom_box_5(){

  //nonce
  wp_nonce_field( plugin_basename(__FILE__), 'truethemes_noncename' );
  
  
    //retrieve post meta value for check
  global $post;
  $post_id = $post->ID;
  $custom_menu_slug = get_post_meta($post_id,'truethemes_custom_sub_menu',true);

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.','tt_theme_framework'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<!-- <label><?php _e('Select Menu:','tt_theme_framework'); ?></label> -->
			<select id='truethemes_custom_sub_menu' name='truethemes_custom_sub_menu'>
			<option value="">-- Select a Menu --</option>
		<?php
			foreach ( $menus as $menu ) {
				$selected = $custom_menu_slug == $menu->slug ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->slug .'">'. $menu->name .'</option>';
			}
		?>
			</select>
		</p>
		<?php


}


/* function truethemes_inner_custom_box_6(){


  wp_nonce_field( plugin_basename(__FILE__), 'truethemes_noncename' );
  
  
  //retrieve post meta value for check
  global $post;
  $post_id = $post->ID;
  $slider_shortcode = get_post_meta($post_id,'truethemes_slider_shortcode',true);
  //$slider_cu3er = get_post_meta($post_id,'truethemes_slider_cu3er',true);
  
  /* echo "<div style=\"padding-bottom:15px;margin-bottom:20px;border-bottom:1px solid #CCC;\"><p>";
  _e('<strong>3D CU3ER Slider</strong><br />Add a CU3ER Slider to this page by entering the CU3ER Slider ID below.','tt_theme_framework');
  echo "</p><p><code>example input: 1</code></p>";
  echo "<p><input type='text' id='truethemes_slider_cu3er' name='truethemes_slider_cu3er' value='" . esc_attr( $slider_cu3er ) . "' style='width:75%;'/></p></div>";
  
  echo "<p>";
  _e('<strong>Layer Slider</strong><br />Add a Layer Slider to this page by entering the custom shortcode below.','tt_theme_framework');
  echo "</p><p><code>example input: [layerslider id=\"1\"]</code></p>";
  echo "<p><input type='text' id='truethemes_slider_shortcode' name='truethemes_slider_shortcode' value='" . esc_attr( $slider_shortcode ) . "' style='width:75%;'/></p><br />";

} */



function truethemes_save_postdata($post_id){
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
      return $post_id;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  
  	if (!isset($_POST['truethemes_noncename']))
	{
	//If nonce not posted, set it with null to prevent debug error.
	$_POST['truethemes_noncename'] = null;
	}   

  if ( !wp_verify_nonce( $_POST['truethemes_noncename'], plugin_basename(__FILE__) ) )
      return $post_id;


	if (!isset($_POST['post_type']))
	{
	//If post_type not set, set it with null to prevent debug error.
	$_POST['post_type'] = null;
	} 
      
 	 if($_POST['post_type'] == 'page'){
 	 
 	 if (!isset($_POST['truethemes_page_checkbox']))
	{
	//If post_type not set, set it with null to prevent debug error.
	$_POST['truethemes_page_checkbox'] = null;
	}  	 

 	$meta = stripslashes( $_POST['truethemes_page_checkbox'] );
  	
  	update_post_meta($post_id,'truethemes_page_checkbox',$meta);
  	
  	$custom_menu_slug = esc_attr( $_POST['truethemes_custom_sub_menu'] );
  	  
  	update_post_meta($post_id,'truethemes_custom_sub_menu',$custom_menu_slug);
  	
  	$slider_shortcode = esc_attr( $_POST['truethemes_slider_shortcode'] );
  	
  	update_post_meta($post_id,'truethemes_slider_shortcode',$slider_shortcode);
	
	$slider_cu3er = esc_attr( $_POST['truethemes_slider_cu3er'] );
  	
  	update_post_meta($post_id,'truethemes_slider_cu3er',$slider_cu3er); 	 	
 	
  
  	}
  
  	if($_POST['post_type'] == 'post'){

  	$video_url = esc_url( $_POST['truethemes_video_url'] );
  	$image_url = esc_url( $_POST['truethemes_external_image_url'] );
  	  
  	update_post_meta($post_id,'truethemes_video_url',$video_url);
  	update_post_meta($post_id,'truethemes_external_image_url',$image_url);
  	
  	
  	$slider_shortcode = esc_attr( $_POST['truethemes_slider_shortcode'] );
  	
  	update_post_meta($post_id,'truethemes_slider_shortcode',$slider_shortcode);
	
	$slider_cu3er = esc_attr( $_POST['truethemes_slider_cu3er'] );
  	
  	update_post_meta($post_id,'truethemes_slider_cu3er',$slider_cu3er);  	
  	
  	  
	}

}
?>