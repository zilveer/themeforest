<?php

/*
	Begin Create Shortcode Generator Options
*/

add_action('admin_menu', 'grandportfolio_shortcode_generator');

function grandportfolio_shortcode_generator() 
{  
	if ( function_exists('add_meta_box') ) {  
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'grandportfolio_shortcode_generator_options', 'page', 'normal', 'high' );
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'grandportfolio_shortcode_generator_options', 'post', 'normal', 'high' );  
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'grandportfolio_shortcode_generator_options', 'portfolios', 'normal', 'high' );
	}
}

function grandportfolio_shortcode_generator_options() {

  	$plugin_url = get_template_directory_uri().'/plugins/shortcode_generator';
  	
  	//Get all galleries
  	$args = array(
	    'numberposts' => -1,
	    'post_type' => array('galleries'),
	);
	
	$galleries_arr = get_posts($args);
	$galleries_select = array();
	$galleries_select[''] = '';
	
	foreach($galleries_arr as $gallery)
	{
		if(is_object($gallery))
		{
			$galleries_select[$gallery->ID] = $gallery->post_title;
		}
	}
	
	//Get all pricing categories
	$pricing_cat_arr = get_terms('pricingcats', 'hide_empty=0&hierarchical=0&parent=0');
	$pricing_cat_select = array();
	$pricing_cat_select[''] = '';
	
	foreach($pricing_cat_arr as $pricing_cat)
	{
		if(is_object($pricing_cat))
		{
			$pricing_cat_select[$pricing_cat->slug] = $pricing_cat->name;
		}
	}
	
	//Get all testimonials categories
	$testimonial_cat_arr = get_terms('testimonialcats', 'hide_empty=0&hierarchical=0&parent=0');
	$testimonial_cat_select = array();
	$testimonial_cat_select[''] = '';
	
	foreach($testimonial_cat_arr as $testimonial_cat)
	{
		if(is_object($testimonial_cat))
		{
			$testimonial_cat_select[$testimonial_cat->slug] = $testimonial_cat->name;
		}
	}
	
	//Get all button colors options
	$button_color_arr = array(
		'' => '',
		'black' => 'black',
		'grey' => 'grey',
		'blue' => 'blue',
		'yellow' => 'yellow',
		'red' => 'red',
		'orange' => 'orange',
		'dark blue' => 'dark blue',
		'green' => 'green',
		'emerald' => 'emerald',
		'pink' => 'pink',
		'purple' => 'purple',
	);

	//Begin shortcode array
	$shortcodes = array(
		'dropcap' => array(
			'name' => 'Dropcap',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'quote' => array(
			'name' => 'Quote Text',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'tg_button' => array(
			'name' => 'Button',
			'attr' => array(
				'href' => 'text',
				'color' => 'select',
				'bg_color' => 'colorpicker',
				'text_color' => 'colorpicker',
			),
			'title' => array(
				'href' => 'URL',
				'color' => 'Skin',
				'bg_color' => 'Custom Background Color (Optional)',
				'text_color' => 'Custom Font Color (Optional)',
			),
			'desc' => array(
				'href' => 'Enter URL for button',
				'color' => 'Select predefined button colors',
				'bg_color' => 'Enter custom button background color code ex. #4ec380',
				'text_color' => 'Enter custom button text color code ex. #ffffff',
			),
			'options' => array(
				'color' => $button_color_arr,
			),
			'content' => TRUE,
			'content_text' => 'Enter text on button',
		),
		'tg_alert_box' => array(
			'name' => 'Alert Box',
			'attr' => array(
				'style' => 'select',
			),
			'title' => array(
				'style' => 'Type',
			),
			'desc' => array(
				'style' => 'Select alert box type',
			),
			'options' => array(
				'style' => array(
					'error' => 'error',
					'success' => 'success',
					'notice' => 'notice',
				),
			),
			'content' => TRUE,
		),
		'one_half' => array(
			'name' => 'One Half Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 1,
		),
		'one_half_last' => array(
			'name' => 'One Half Last Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 1,
		),
		'one_third' => array(
			'name' => 'One Third Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 2,
		),
		'one_third_last' => array(
			'name' => 'One Third Last Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'two_third' => array(
			'name' => 'Two Third Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'two_third_last' => array(
			'name' => 'Two Third Last Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'one_fourth' => array(
			'name' => 'One Fourth Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 3,
		),
		'one_fifth' => array(
			'name' => 'One Fifth Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 4,
		),
		'one_sixth' => array(
			'name' => 'One Sixth Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 5,
		),
		'one_half_bg' => array(
			'name' => 'One Half Column With Background',
			'attr' => array(
				'bgcolor' => 'colorpicker',
				'fontcolor' => 'colorpicker',
				'padding' => 'text',
			),
			'title' => array(
				'bgcolor' => 'Background Color',
				'fontcolor' => 'Font Color',
				'padding' => 'Padding (Optional)',
			),
			'desc' => array(
				'bgcolor' => 'Select background color',
				'fontcolor' => 'Select font color',
				'padding' => 'Enter padding for this content (in px)',
			),
			'content' => TRUE,
		),
		'one_third_bg' => array(
			'name' => 'One Third Column With Background',
			'attr' => array(
				'bgcolor' => 'colorpicker',
				'fontcolor' => 'colorpicker',
				'padding' => 'text',
			),
			'title' => array(
				'bgcolor' => 'Background Color',
				'fontcolor' => 'Font Color',
				'padding' => 'Padding (Optional)',
			),
			'desc' => array(
				'bgcolor' => 'Select background color',
				'fontcolor' => 'Select font color',
				'padding' => 'Enter padding for this content (in px)',
			),
			'content' => TRUE,
		),
		'two_third_bg' => array(
			'name' => 'Two Third Column With Background',
			'attr' => array(
				'bgcolor' => 'colorpicker',
				'fontcolor' => 'colorpicker',
				'padding' => 'text',
			),
			'title' => array(
				'bgcolor' => 'Background Color',
				'fontcolor' => 'Font Color',
				'padding' => 'Padding (Optional)',
			),
			'desc' => array(
				'bgcolor' => 'Select background color',
				'fontcolor' => 'Select font color',
				'padding' => 'Enter padding for this content (in px)',
			),
			'content' => TRUE,
		),
		'one_fourth_bg' => array(
			'name' => 'One Fourth Column With Background',
			'attr' => array(
				'bgcolor' => 'colorpicker',
				'fontcolor' => 'colorpicker',
				'padding' => 'text',
			),
			'title' => array(
				'bgcolor' => 'Background Color',
				'fontcolor' => 'Font Color',
				'padding' => 'Padding (Optional)',
			),
			'desc' => array(
				'bgcolor' => 'Select background color',
				'fontcolor' => 'Select font color',
				'padding' => 'Enter padding for this content (in px)',
			),
			'content' => TRUE,
		),
		'tg_map' => array(
			'name' => 'Google Map',
			'attr' => array(
				'type' => 'select',
				'width' => 'text',
				'height' => 'text',
				'lat' => 'text',
				'long' => 'text',
				'zoom' => 'text',
				'popup' => 'text',
				'marker' => 'text',
			),
			'title' => array(
				'type' => 'Map Type',
				'width' => 'Width',
				'height' => 'Height',
				'lat' => 'Latitude',
				'long' => 'Longtitude',
				'zoom' => 'Zoom Level',
				'popup' => 'Popup Text (Optional)',
				'marker' => 'Custom Marker Icon (Optional)',
			),
			'desc' => array(
				'type' => 'Select map display type',
				'width' => 'Map width in pixels',
				'height' => 'Map height in pixels',
				'lat' => 'Map latitude <a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>',
				'long' => 'Map longitude <a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>',
				'zoom' => 'Enter zoom number (1-16)',
				'popup' => 'Enter text to display as popup above location on map for example. your company name',
				'marker' => 'Enter custom marker image URL',
			),
			'content' => FALSE,
			'options' => array(
				'type' => array(
					'ROADMAP' => 'Roadmap',
					'SATELLITE' => 'Satellite',
					'HYBRID' => 'Hybrid',
					'TERRAIN' => 'Terrain',
				)
			),
		),
		'googlefont' => array(
			'name' => 'Google Font',
			'attr' => array(
				'font' => 'text',
				'fontsize' => 'text',
				'style' => 'text',
			),
			'title' => array(
				'font' => 'Font Name',
				'fontsize' => 'Font Size',
				'style' => 'Custom CSS style ex. font-style:italic; (Optional)',
			),
			'desc' => array(
				'font' => 'Enter Google Web Font Name you want to use',
				'fontsize' => 'Enter font size in pixels',
				'style' => 'Enter custom CSS styling code',
			),
			'content' => TRUE,
		),
		'tg_thumb_gallery' => array(
			'name' => 'Gallery Thumbnails',
			'attr' => array(
				'gallery_id' => 'select',
				'width' => 'text',
				'height' => 'text',
			),
			'title' => array(
				'gallery_id' => 'Gallery',
				'width' => 'Width',
				'height' => 'Height',
			),
			'desc' => array(
				'gallery_id' => 'Select gallery you want to display its images',
				'width' => 'Gallery image width in pixels',
				'height' => 'Gallery image height in pixels',
			),
			'options' => array(
				'gallery_id' => $galleries_select
			),
			'content' => FALSE,
		),
		'tg_grid_gallery' => array(
			'name' => 'Gallery Grid',
			'attr' => array(
				'gallery_id' => 'select',
				'layout' => 'select',
				'columns' => 'select',
			),
			'title' => array(
				'gallery_id' => 'Gallery',
				'layout' => 'Layout',
				'columns' => 'Columns',
			),
			'desc' => array(
				'gallery_id' => 'Select gallery you want to display its images',
				'layout' => 'Select gallery layout you to display its images',
				'columns' => 'Select gallery columns you to display its images',
			),
			'options' => array(
				'gallery_id' => $galleries_select,
				'layout' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
				'columns' => array(
					2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
				),
			),
			'content' => FALSE,
		),
		'tg_masonry_gallery' => array(
			'name' => 'Gallery Masonry',
			'attr' => array(
				'gallery_id' => 'select',
				'layout' => 'select',
				'columns' => 'select',
			),
			'title' => array(
				'gallery_id' => 'Gallery',
				'layout' => 'Layout',
				'columns' => 'Columns',
			),
			'desc' => array(
				'gallery_id' => 'Select gallery you want to display its images',
				'layout' => 'Select gallery layout you to display its images',
				'columns' => 'Select gallery columns you to display its images',
			),
			'options' => array(
				'gallery_id' => $galleries_select,
				'layout' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
				'columns' => array(
					2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
				),
			),
			'content' => FALSE,
		),
		'tg_gallery_slider' => array(
			'name' => 'Gallery Slider',
			'attr' => array(
				'gallery_id' => 'select',
			),
			'title' => array(
				'gallery_id' => 'Gallery',
			),
			'desc' => array(
				'gallery_id' => 'Select gallery you want to display its images',
			),
			'options' => array(
				'gallery_id' => $galleries_select
			),
			'content' => FALSE,
		),
		'tg_social_icons' => array(
			'name' => 'Social Icons',
			'attr' => array(
				'style' => 'select',
				'size' => 'text',
			),
			'title' => array(
				'style' => 'Color Style',
				'size' => 'Icon Size',
			),
			'desc' => array(
				'style' => 'Select color style for social icons',
				'size' => 'Enter icon size between small and large',
			),
			'options' => array(
				'style' => array(
					'dark' => 'Dark',
					'light' => 'Light',
				)
			),
			'content' => FALSE,
		),
		'tg_social_share' => array(
			'name' => 'Social Share',
			'attr' => array(),
			'content' => FALSE,
		),
		'tg_promo_box' => array(
			'name' => 'Promo Box',
			'attr' => array(
				'title' => 'text',
				'bgcolor' => 'colorpicker',
				'fontcolor' => 'colorpicker',
				'bordercolor' => 'colorpicker',
				'button_text' => 'text',
				'button_url' => 'text',
				'buttoncolor' => 'colorpicker',
			),
			'title' => array(
				'title' => 'Title (Optional)',
				'bgcolor' => 'Background Color',
				'fontcolor' => 'Font Color',
				'bordercolor' => 'Border Color',
				'button_text' => 'Button Text',
				'button_url' => 'Button Link URL',
				'buttoncolor' => 'Button Color',
			),
			'desc' => array(
				'title' => 'Enter promo box title',
				'bgcolor' => 'Select background color for this content',
				'fontcolor' => 'Select font color for this content',
				'bordercolor' => 'Select border color for this content',
				'button_text' => 'Enter promo box button text. For example More Info',
				'button_url' => 'Enter promo box button link URL',
				'bordercolor' => 'Select button color',
			),
			'content' => TRUE,
		),
		'tg_accordion' => array(
			'name' => 'Accordion & Toggle',
			'attr' => array(
				'title' => 'text',
				'icon' => 'text',
				'close' => 'select',
			),
			'title' => array(
				'title' => 'Title',
				'icon' => 'Icon (optional)',
				'close' => 'Open State',
			),
			'desc' => array(
				'title' => 'Enter Accordion\'s title',
				'icon' => 'Enter icon class name ex. fa-star. <a href="http://fontawesome.io/cheatsheet/">See all possible here</a>',
				'close' => 'Select default status (close or open)',
			),
			'content' => TRUE,
			'options' => array(
				'close' => array(
					0 => 'Open',
					1 => 'Close',
				)
			),
		),
		'tg_image' => array(
			'name' => 'Image Animation',
			'attr' => array(
				'src' => 'text',
				'animation' => 'select',
				'frame' => 'select',
			),
			'title' => array(
				'src' => 'Image URL',
				'animation' => 'Animation Type',
				'frame' => 'Frame Style',
			),
			'desc' => array(
				'src' => 'Enter image URL',
				'animation' => 'Select animation type',
				'frame' => 'Select image frame style',
			),
			'content' => TRUE,
			'options' => array(
				'animation' => array(
					'slideRight' => 'Slide Right',
					'slideLeft' => 'Slide Left',
					'slideUp' => 'Slide Up',
					'fadeIn' => 'Fade In',
				),
				'frame' => array(
					'' => 'None',
					'border' => 'Border',
					'glow' => 'Glow',
					'dropshadow' => 'Drop Shadow',
					'bottomshadow' => 'Bottom Shadow',
				),
			),
			'content' => FALSE,
		),
		'tg_divider' => array(
			'name' => 'Divider',
			'attr' => array(
				'style' => 'select',
			),
			'title' => array(
				'style' => 'Style',
			),
			'desc' => array(
				'style' => 'Select HR divider style',
			),
			'options' => array(
				'style' => array(
					'normal' => 'Normal',
					'thick' => 'Thick',
					'dotted' => 'Dotted',
					'dashed' => 'Dashed',
					'faded' => 'Faded',
					'totop' => 'Go To Top',
				)
			),
			'content' => FALSE,
		),
		'tg_teaser' => array(
			'name' => 'Image Teaser',
			'attr' => array(
				'columns' => 'select',
				'image' => 'text',
				'title' => 'text',
				'align' => 'select',
				'bgcolor' => 'colorpicker',
				'fontcolor' => 'colorpicker',
			),
			'title' => array(
				'columns' => 'Columns Type',
				'image' => 'image URL',
				'title' => 'Title',
				'align' => 'Content Align',
				'bgcolor' => 'Background Color',
				'fontcolor' => 'Font Color',
			),
			'desc' => array(
				'columns' => 'Select columns for image teaser',
				'image' => 'Enter full image URL',
				'title' => 'Enter teaser title',
				'align' => 'Enter teaser content text align from left, center and right',
				'bgcolor' => 'Select background color for this content',
				'fontcolor' => 'Select font color for this content',
			),
			'options' => array(
				'columns' => array(
					'one' => 'Fullwidth',
					'one_half' => 'One Half',
					'one_half last' => 'One Half Last',
					'one_third' => 'One Third',
					'one_half last' => 'One Third Last',
					'one_fourth' => 'One Fourth',
					'one_fourth last' => 'One Fourth Last',
				),
				'align' => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
			),
			'content' => TRUE,
		),
		'tg_lightbox' => array(
			'name' => 'Media Lightbox',
			'attr' => array(
				'type' => 'select',
				'src' => 'text',
				'href' => 'text',
				'vimeo_id' => 'text',
				'youtube_id' => 'text',
			),
			'title' => array(
				'type' => 'Content Type',
				'src' => 'Image URL',
				'href' => 'Link URL',
				'vimeo_id' => 'Vimeo Video ID',
				'youtube_id' => 'Youtube Video ID',
			),
			'desc' => array(
				'type' => 'Select ligthbox content type',
				'src' => 'Enter lightbox preview image URL',
				'href' => 'If you selected "Image". Enter full image URL here',
				'vimeo_id' => 'If you selected "Vimeo". Enter Vimeo video ID here ex. 82095744',
				'youtube_id' => 'If you selected "Youtube". Enter Youtube video ID here ex. hT_nvWreIhg',
			),
			'content' => TRUE,
			'options' => array(
				'type' => array(
					'image' => 'Image',
					'vimeo' => 'Vimeo',
					'youtube' => 'Youtube',
				)
			),
			'content' => FALSE,
		),
		'tg_youtube' => array(
			'name' => 'Youtube Video',
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'video_id' => 'text',
			),
			'title' => array(
				'width' => 'Width',
				'height' => 'Height',
				'video_id' => 'Youtube Video ID',
			),
			'desc' => array(
				'width' => 'Enter video width in pixels',
				'height' => 'Enter video height in pixels',
				'video_id' => 'Enter Youtube video ID here ex. hT_nvWreIhg',
			),
			'content' => FALSE,
		),
		'tg_vimeo' => array(
			'name' => 'Vimeo Video',
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'video_id' => 'text',
			),
			'title' => array(
				'width' => 'Width',
				'height' => 'Height',
				'video_id' => 'Vimeo Video ID',
			),
			'desc' => array(
				'width' => 'Enter video width in pixels',
				'height' => 'Enter video height in pixels',
				'video_id' => 'Enter Vimeo video ID here ex. 82095744',
			),
			'content' => FALSE,
		),
		'tg_animate_counter' => array(
			'name' => 'Animated Counter',
			'attr' => array(
				'start' => 'text',
				'end' => 'text',
				'fontsize' => 'text',
				'fontcolor' => 'colorpicker',
				'count_subject' => 'text',
			),
			'title' => array(
				'start' => 'Start',
				'end' => 'End',
				'fontsize' => 'Font Size',
				'fontcolor' => 'Font Color',
				'count_subject' => 'Subject',
			),		
			'desc' => array(
				'start' => 'Enter start number ex. 0',
				'end' => 'Enter end number ex. 100',
				'fontsize' => 'Enter counter number font size in pixel ex. 38',
				'fontcolor' => 'Enter counter number font color code ex. #000000',
				'count_subject' => 'Enter count subject ex. followers',
			),
			'content' => TRUE,
		),
		'tg_animate_bar' => array(
			'name' => 'Animated Progress Bar',
			'attr' => array(
				'percent' => 'text',
				'color' => 'colorpicker',
				'height' => 'text',
			),
			'title' => array(
				'percent' => 'Percentage (Maximum 100)',
				'color' => 'Bar Color',
				'height' => 'Bar Height (In px)',
			),
			'desc' => array(
				'percent' => 'Enter number of percent value (maximum 100)',
				'color' => 'Enter progress bar background color code ex. #000000',
				'height' => 'Enter progress bar height',
			),
			'content' => TRUE,
		),
		'tg_animate_circle' => array(
			'name' => 'Animated Circle',
			'attr' => array(
				'percent' => 'text',
				'dimension' => 'text',
				'width' => 'text',
				'color' => 'colorpicker',
				'fontsize' => 'text',
				'subject' => 'text',
			),
			'title' => array(
				'percent' => 'Percentage (Maximum 100)',
				'dimension' => 'Circle Dimension (In px)',
				'width' => 'Circle Border Width (In px)',
				'color' => 'Circle Border Color',
				'fontsize' => 'Font Size',
				'subject' => 'Sbuject',
			),
			'desc' => array(
				'percent' => 'Enter percent completion number ex. 90',
				'dimension' => 'Enter circle dimension ex. 200',
				'width' => 'Enter circle border width ex. 10',
				'color' => 'Enter circle border color code ex. #000000',
				'fontsize' => 'Enter title font size in pixel ex. 38',
				'subject' => 'Enter circle subject info ex. completion',
			),
			'content' => TRUE,
		),
		'tg_pricing' => array(
			'name' => 'Pricing Table',
			'attr' => array(
				'skin' => 'select',
				'category' => 'select',
				'columns' => 'select',
				'items' => 'text',
				'highlightcolor' => 'colorpicker',
			),
			'title' => array(
				'skin' => 'Skin',
				'category' => 'Pricing Category (Optional)',
				'columns' => 'Columns',
				'items' => 'Items',
				'highlightcolor' => 'Highlight Color',
			),
			'desc' => array(
				'skin' => 'Select skin for this content',
				'category' => 'Select Pricing Category to filter content',
				'columns' => 'Select Number of Pricing Columns',
				'items' => 'Enter number of items you want to display',
				'highlightcolor' => 'Select hightlight color for this content',
			),
			'content' => TRUE,
			'options' => array(
				'skin' => array(
					'light' => 'Light',
					'normal' => 'Normal',
				),
				'category' => $pricing_cat_select,
				'columns' => array(
					2 => '2 Columns',
					3 => '3 Columns',
					4 => '4 Columns',
				),
			),
			'content' => FALSE,
		),
		'tg_testimonial_slider' => array(
			'name' => 'Testimonials Slider',
			'attr' => array(
				'cat' => 'select',
				'items' => 'text',
				'fontcolor' => 'colorpicker',
			),
			'title' => array(
				'cat' => 'Testimonial Category (Optinal)',
				'items' => 'Items',
				'fontcolor' => 'Font Color',
			),
			'desc' => array(
				'cat' => 'Select testimonials category you want to display its contents',
				'items' => 'Enter number of items you want to display',
				'fontcolor' => 'Select font color for this content',
			),
			'options' => array(
				'cat' => $testimonial_cat_select,
			),
			'content' => FALSE,
		),
	);
	
	photograhy_aasort($shortcodes,"name");

?>
<script>
function nl2br (str, is_xhtml) {   
	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

jQuery(document).ready(function(){ 
	jQuery('#shortcode_select').change(function() {
  		var target = jQuery(this).val();
  		jQuery('.rm_section').hide()
  		jQuery('#div_'+target).fadeIn()
	});	
	
	jQuery('.code_area').click(function() { 
		document.getElementById(jQuery(this).attr('id')).focus();
    	document.getElementById(jQuery(this).attr('id')).select();
	});
	
	jQuery('.shortcode_button').click(function() { 
		var target = jQuery(this).attr('id');
		var gen_shortcode = '';
  		gen_shortcode+= '['+target;
  		
  		if(jQuery('#'+target+'_attr_wrapper .attr').length > 0)
  		{
  			jQuery('#'+target+'_attr_wrapper .attr').each(function() {
				gen_shortcode+= ' '+jQuery(this).data('attr')+'="'+jQuery(this).val()+'"';
			});
		}
		
		gen_shortcode+= ']';
		
		if(jQuery('#'+target+'_content').length > 0)
  		{
  			gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+']';
  			gen_shortcode+= '\n';
  			
  			var repeat = jQuery('#'+target+'_content_repeat').val();
  			for (count=1;count<=repeat;count=count+1)
			{
				if(count<repeat)
				{
					gen_shortcode+= '['+target+']';
					gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+']';
					gen_shortcode+= '\n';
				}
				else
				{
					gen_shortcode+= '['+target+'_last]';
					gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+'_last]';
					gen_shortcode+= '\n';
				}
			}
  		}
  		jQuery('#'+target+'_code').val(gen_shortcode);
  		jQuery('#pp-insert-to-post').attr('rel', '#'+target+'_code');
  		
  		jQuery("#"+target+"-pp-insert-to-post").click(function() { 
			var current_id = jQuery(this).attr('rel');
			var current_code = jQuery('#'+target+'_code').val();
			
			tinyMCE.activeEditor.selection.setContent(nl2br(current_code));
		});
	});
});
</script>

	<div style="padding:20px 10px 10px 10px">
	<?php
		if(!empty($shortcodes))
		{
	?>
			<strong>Select Shortcode</strong><hr class="pp_widget_hr">
			<div class="pp_widget_description">Please select short code from list below then enter short code attributes and click "Generate Shortcode".</div>
			<br/>
			<select id="shortcode_select">
				<option value="">(no short code selected)</option>
			
	<?php
			foreach($shortcodes as $shortcode_name => $shortcode)
			{
				$shortcode_key = $shortcode_name;
				
				if(isset($shortcodes[$shortcode_name]['name']))
				{
					$shortcode_name = $shortcodes[$shortcode_name]['name'];
				}
	?>
	
			<option value="<?php echo esc_attr($shortcode_key); ?>"><?php echo esc_html($shortcode_name); ?></option>
	
	<?php
			}
	?>
			</select>
	<?php
		}
	?>
	
	<br/><br/>
	
	<?php
		if(!empty($shortcodes))
		{
			foreach($shortcodes as $shortcode_name => $shortcode)
			{
	?>
	
			<div id="div_<?php echo esc_attr($shortcode_name); ?>" class="rm_section" style="display:none">
				<div style="width:47%;float:left">
			
				<div class="rm_title">
					<h3><?php echo ucfirst($shortcode_name); ?></h3>
					<div class="clearfix"></div>
				</div>
				
				<div class="rm_text" style="padding: 10px 0 20px 0">
			
				<?php
					if(isset($shortcode['attr']) && !empty($shortcode['attr']))
					{
				?>
						
						<div id="<?php echo esc_attr($shortcode_name); ?>_attr_wrapper">
						
				<?php
						foreach($shortcode['attr'] as $attr => $type)
						{
				?>
				
							<?php echo '<strong>'.$shortcode['title'][$attr].'</strong>: '.$shortcode['desc'][$attr]; ?><br/><br/>
							
							<?php
								switch($type)
								{
									case 'text':
							?>
							
									<input type="text" id="<?php echo esc_attr($shortcode_name); ?>_<?php echo esc_attr($attr); ?>" style="width:100%" class="attr" data-attr="<?php echo esc_attr($attr); ?>"/>
							
							<?php
									break;
									
									case 'textarea':
							?>
							
									<textarea id="<?php echo esc_attr($shortcode_name); ?>_<?php echo esc_attr($attr); ?>" style="width:100%" class="attr" data-attr="<?php echo esc_attr($attr); ?>"></textarea>
							
							<?php
									break;
									
									case 'colorpicker':
							?>
							
									<input type="text" id="<?php echo esc_attr($shortcode_name); ?>_<?php echo esc_attr($attr); ?>" style="width:100%" class="attr color_picker" data-attr="<?php echo esc_attr($attr); ?>" readonly/>
									
									<div id="<?php echo esc_attr($shortcode_name); ?>_<?php echo esc_attr($attr); ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo esc_js($shortcode_name); ?>_text').click()" style="background-image: url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png);margin-top:3px">&nbsp;</div><br/>
							
							<?php
									break;
									
									case 'select':
							?>
							
									<select id="<?php echo esc_attr($shortcode_name); ?>_<?php echo esc_attr($attr); ?>" style="width:100%" class="attr" data-attr="<?php echo esc_attr($attr); ?>">
									
										<?php
											if(isset($shortcode['options'][$attr]) && !empty($shortcode['options'][$attr]))
											{
												foreach($shortcode['options'][$attr] as $select_key => $option)
												{
										?>
										
													<option value="<?php echo esc_attr($select_key); ?>"><?php echo esc_html($option); ?></option>
										
										<?php	
												}
											}
										?>							
									
									</select>
							
							<?php
									break;
								}
							?>
							
							<br/><br/>
				
				<?php
						} //end attr foreach
				?>
				
						</div>
				
				<?php
					}
				?>
				
				<?php
					if(isset($shortcode['content']) && $shortcode['content'])
					{
						if(isset($shortcode['content_text']))
						{
							$content_text = $shortcode['content_text'];
						}
						else
						{
							$content_text = 'Your Content';
						}
				?>
				
				<strong><?php echo esc_html($content_text); ?>:</strong><br/><br/>
				<?php if(isset($shortcode['repeat'])) { ?>
					<input type="hidden" id="<?php echo esc_attr($shortcode_name); ?>_content_repeat" value="<?php echo esc_attr($shortcode['repeat']); ?>"/>
				<?php } ?>
				<textarea id="<?php echo esc_attr($shortcode_name); ?>_content" style="width:100%;height:70px" rows="3" wrap="off"></textarea><br/><br/>
				
				<?php
					}
				?>
				
				</div>
				
				</div>
				
				<div style="width:47%;float:right">
				
				<strong>Shortcode:</strong><br/><br/>
				<textarea id="<?php echo esc_attr($shortcode_name); ?>_code" style="width:100%;height:200px;word-wrap: break-word;" rows="3" readonly="readonly" class="code_area" wrap="off"></textarea>
				
				<br/><br/>
				<input type="button" id="<?php echo esc_attr($shortcode_name); ?>" value="Generate Shortcode" class="button shortcode_button button-primary"/>
				</div>
				
				<br style="clear:both"/>
			</div>
	
	<?php
			} //end shortcode foreach
		}
	?>
	
</div>

<?php

}

/*
	End Create Shortcode Generator Options
*/

?>