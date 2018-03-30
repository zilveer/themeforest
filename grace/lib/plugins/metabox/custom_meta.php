<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_tb_';

	$meta_boxes[] = array(
		'id'         => 'article_settings',
		'title'      => 'Article Settings',
		'pages'      => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Show Featured Image',
				'desc'    => 'Do you want to show featured image?',
				'id'      => $prefix . 'show_featured',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Default Settings', 'value' => 'default', ),
					array( 'name' => 'Show featured image', 'value' => 'show', ),
					array( 'name' => 'Hide featured image', 'value' => 'hide', ),
				),
				'std' => 'default'
			)
		)
	);
	
	$numberOfArticles = array();
	$numberOfArticlesIndex = 1;
	while ($numberOfArticlesIndex < 10) {
		$numberOfArticles[] = array('name' => $numberOfArticlesIndex, 'value' => $numberOfArticlesIndex);
		$numberOfArticlesIndex++;
	}

	// HOME PAGE TEMPLATE
	$meta_boxes[] = array(
		'id'         => 'hp_settings',
		'title'      => 'Home Page Settings',
		'pages'      => array( 'page' ),
		'show_on' => array( 'key' => 'page-template', 'value' => 'page-home.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Slider - alias',
				'desc'    => 'Please choose slider you want to use or leave blank.',
				'id'      => $prefix . 'slider_alias',
				'type'    => 'select',
				'options' => tb_get_rev_sliders(),
				'std' => ''
			),
			array(
				'name'    => 'Intro Text Title',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'intro_text_title',
				'type'    => 'text',
				'std' => ''
			),
			array(
				'name'    => 'Intro Text Subtitle',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'intro_text_subtitle',
				'type'    => 'text',
				'std' => ''
			),
			array(
				'name'    => 'Intro Text',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'intro_text',
				'type'    => 'textarea',
				'std' => ''
			),
			array(
				'name'    => 'Content Title',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'content_title',
				'type'    => 'text',
				'std' => ''
			),
			array(
				'name'    => 'Content Area',
				'desc'    => 'Do you want to show content area? It is populated through content editor.',
				'id'      => $prefix . 'content_area',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no' ),
					array( 'name' => 'Yes', 'value' => 'yes' )
				),
				'std' => 'no'
			),
			array(
				'name'    => 'Articles Area',
				'desc'    => 'Do you want to show articles area? It is populated through content editor.',
				'id'      => $prefix . 'articles_area',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no' ),
					array( 'name' => 'Yes', 'value' => 'yes' )
				),
				'std' => 'yes'
			),
			array(
				'name'    => 'Articles Title',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'articles_title',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Number of articles',
				'desc'    => '',
				'id'      => $prefix . 'number_of_articles',
				'type'    => 'select',
				'options' => $numberOfArticles,
				'std' => '5'
			)
		)
	);
	
	// HOME PAGE TEMPLATE - Wide Slider
	$meta_boxes[] = array(
		'id'         => 'hp_settings',
		'title'      => 'Home Page Settings',
		'pages'      => array( 'page' ),
		'show_on' => array( 'key' => 'page-template', 'value' => 'page-home-wide-slider.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Slider - alias',
				'desc'    => 'Please choose slider you want to use or leave blank.',
				'id'      => $prefix . 'slider_alias',
				'type'    => 'select',
				'options' => tb_get_rev_sliders(),
				'std' => ''
			),
			array(
				'name'    => 'Intro Text Title',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'intro_text_title',
				'type'    => 'text',
				'std' => ''
			),
			array(
				'name'    => 'Intro Text Subtitle',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'intro_text_subtitle',
				'type'    => 'text',
				'std' => ''
			),
			array(
				'name'    => 'Intro Text',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'intro_text',
				'type'    => 'textarea',
				'std' => ''
			),
			array(
				'name'    => 'Content Title',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'content_title',
				'type'    => 'text',
				'std' => ''
			),
			array(
				'name'    => 'Content Area',
				'desc'    => 'Do you want to show content area? It is populated through content editor.',
				'id'      => $prefix . 'content_area',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no' ),
					array( 'name' => 'Yes', 'value' => 'yes' )
				),
				'std' => 'no'
			),
			array(
				'name'    => 'Articles Area',
				'desc'    => 'Do you want to show articles area? It is populated through content editor.',
				'id'      => $prefix . 'articles_area',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no' ),
					array( 'name' => 'Yes', 'value' => 'yes' )
				),
				'std' => 'yes'
			),
			array(
				'name'    => 'Articles Title',
				'desc'    => 'Leave blank if you don\'t want to use it.',
				'id'      => $prefix . 'articles_title',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Number of articles',
				'desc'    => '',
				'id'      => $prefix . 'number_of_articles',
				'type'    => 'select',
				'options' => $numberOfArticles,
				'std' => '5'
			)
		)
	);


	// BLOG PAGE TEMPLATE
	$meta_boxes[] = array(
		'id'         => 'blog_settings',
		'title'      => 'Blog Page Settings',
		'pages'      => array( 'page' ),
		'show_on' => array( 'key' => 'page-template', 'value' => 'page-blog.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Category',
				'desc'    => 'Please choose category you want to use.',
				'id'      => $prefix . 'category',
				'type'    => 'select',
				'options' => tb_get_categories(),
				'std' => ''
			)
		)
	);

	// GALLERY PAGE TEMPLATE
	$meta_boxes[] = array(
		'id'         => 'gallery_settings',
		'title'      => 'Gallery Page Settings',
		'pages'      => array( 'page' ),
		'show_on' => array( 'key' => 'page-template', 'value' => 'page-gallery.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Number of Columns',
				'desc'    => '',
				'id'      => $prefix . 'number_of_columns',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => '2 columns', 'value' => '2' ),
					array( 'name' => '3 columns', 'value' => '3' ),
					array( 'name' => '4 columns', 'value' => '4' )
				),
				'std' => '3'
			),
			array(
				'name'    => 'Show Filter',
				'desc'    => 'Do you want to show filter?',
				'id'      => $prefix . 'show_filter',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no' ),
					array( 'name' => 'Yes', 'value' => 'yes' )
				),
				'std' => 'no'
			),
			array(
				'name'    => 'Show Pagination',
				'desc'    => 'If you choose "No", all gallery items will be shown',
				'id'      => $prefix . 'show_pagination',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no' ),
					array( 'name' => 'Yes', 'value' => 'yes' )
				),
				'std' => 'yes'
			),
			array(
				'name'    => 'Index Page Preview',
				'desc'    => '',
				'id'      => $prefix . 'preview',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Title', 'value' => 'title', ),
					array( 'name' => 'Title and description', 'value' => 'description', ),
					array( 'name' => 'Just image', 'value' => 'nothing', )
				),
				'std' => 'title'
			)
		)
	);


	// CHURCH
	$meta_boxes[] = array(
		'id'         => 'church_info',
		'title'      => 'About Church',
		'pages'      => array( TB_CHURCH_CPT ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Service Times',
				'desc'    => '',
				'id'      => $prefix . 'service_times',
				'type'    => 'wysiwyg',
				'std' => ''
			),
			array(
				'name'    => 'Address',
				'desc'    => '',
				'id'      => $prefix . 'address',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Email',
				'desc'    => 'Please, add valid email address.',
				'id'      => $prefix . 'email',
				'type'    => 'text_email',
				'std' => ''
			),
			array(
				'name'    => 'Phone Number',
				'desc'    => '',
				'id'      => $prefix . 'phone',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Mobile',
				'desc'    => '',
				'id'      => $prefix . 'mobile',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Twitter',
				'desc'    => 'Please, add full URL of your Twitter account.',
				'id'      => $prefix . 'twitter',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Facebook',
				'desc'    => 'Please, add full URL of your Facebook account.',
				'id'      => $prefix . 'facebook',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Featured image',
				'desc'    => 'Do you want to show post\'s featured image below title?',
				'id'      => $prefix . 'featured_area',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no', ),
					array( 'name' => 'Featured Image - keep aspect ratio', 'value' => 'i', ),
					array( 'name' => 'Featured Image', 'value' => 'i2', )
				),
				'std' => 'i'
			),
			array(
				'name'    => 'Gallery',
				'desc'    => 'Just insert WP gallery in this area.',
				'id'      => $prefix . 'gallery',
				'type'    => 'wysiwyg',
				'std' => ''
			),
			array(
				'name'    => 'Show priests button?',
				'desc'    => '',
				'id'      => $prefix . 'show_priests_button',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no', ),
					array( 'name' => 'Yes', 'value' => 'yes', ),
				),
				'std' => 'yes'
			)

		)
	);

	// PRIEST
	$meta_boxes[] = array(
		'id'         => 'priest_info',
		'title'      => 'About',
		'pages'      => array( TB_PRIEST_CPT ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Title',
				'desc'    => 'Pastor, Lead pastor, etc',
				'id'      => $prefix . 'title',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name' 	=> 'Quotes',
				'desc' 	=> 'Each quote in separate line, please.',
				'id'   	=> $prefix . 'life_motto',
				'type'	=> 'textarea',
				'std' 	=> ''
			),
			array(
				'name'    => 'Email',
				'desc'    => 'Please, add valid email address.',
				'id'      => $prefix . 'email',
				'type'    => 'text_email',
				'std' => ''
			),
			array(
				'name'    => 'Phone Number',
				'desc'    => '',
				'id'      => $prefix . 'phone',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Mobile',
				'desc'    => '',
				'id'      => $prefix . 'mobile',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Twitter',
				'desc'    => 'Please, add full URL of your Twitter account.',
				'id'      => $prefix . 'twitter',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Facebook',
				'desc'    => 'Please, add full URL of your Facebook account.',
				'id'      => $prefix . 'facebook',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Church',
				'desc'    => '',
				'id'      => $prefix . 'church',
				'type'    => 'select',
				'options' => tb_get_pages(TB_CHURCH_CPT),
				'std' => ''
			)
		)
	);

	// GALLERY
	$meta_boxes[] = array(
		'id'         => 'gallery_info',
		'title'      => 'About',
		'pages'      => array( TB_GALLERY_CPT ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Description',
				'desc'    => 'Few words about this gallery.',
				'id'      => $prefix . 'description',
				'type'    => 'textarea',
				'std' => ''
			),
			array(
				'name'    => 'Video',
				'desc'    => 'Enter a youtube, vimeo or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.<br>Leave blank if you don\'t want to use this.',
				'id'      => $prefix . 'video',
				'type'    => 'oembed',
				'std' => ''
			),
			array(
				'name'    => 'Gallery',
				'desc'    => 'Just insert WP gallery in this area.',
				'id'      => $prefix . 'gallery',
				'type'    => 'wysiwyg',
				'std' => ''
			),
			array(
				'name' 	=> 'Live URL',
				'desc' 	=> 'Custom URL',
				'id'   	=> $prefix . 'live_url',
				'type'	=> 'text',
				'std' 	=> ''
			),
			array(
				'name' 	=> 'Live URL - button text',
				'desc' 	=> 'Custom URL',
				'id'   	=> $prefix . 'live_url_text',
				'type'	=> 'text',
				'std' 	=> 'Our Website'
			),
			array(
				'name'    => 'Open in new page?',
				'desc'    => '',
				'id'      => $prefix . 'blank_href',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no', ),
					array( 'name' => 'Yes', 'value' => 'yes', )
				),
				'std' => 'no'
			),
			array(
				'name'    => 'Featured image',
				'desc'    => 'Do you want to show post\'s featured image below title?<br>Note: images will be shown on every gallery index page.',
				'id'      => $prefix . 'featured_area',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no', ),
					array( 'name' => 'Featured Image - keep aspect ratio', 'value' => 'i', ),
					array( 'name' => 'Featured Image', 'value' => 'i2', )
				),
				'std' => 'i'
			),
			array(
				'name'    => 'Pretty Photo Settings',
				'desc'    => 'Do you want to use pretty photo for this entry on gallery index page?',
				'id'      => $prefix . 'pretty_photo',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no', ),
					array( 'name' => 'Yes', 'value' => 'yes', )
				),
				'std' => 'no'
			)
		)
	);

	// EVENT
	$buttonColor = array();
	$colorArray = array('Custom', 'White', 'Gray', 'Black', 'Light Blue', 'Blue', 'Dark Blue', 'Light Green', 'Green', 'Dark Green', 'Light Red', 'Red', 'Dark Red', 'Yellow', 'Orange', 'Brown');
	foreach ($colorArray as $color) {
		$buttonColor[] = array('name' => $color, 'value' => strtolower(str_replace(' ', '', $color)));
	}
	
	$meta_boxes[] = array(
		'id'         => 'event_info',
		'title'      => 'Event Details',
		'pages'      => array( TB_EVENT_CPT ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Date',
				'desc'    => '',
				'id'      => $prefix . 'start_date',
				'type'    => 'text_date_timestamp',
				'std' => ''
			),
			array(
				'name'    => 'Time',
				'desc'    => '',
				'id'      => $prefix . 'start_time',
				'type'    => 'text_time',
				'std' => ''
			),
			array(
				'name'    => 'Venue',
				'desc'    => '',
				'id'      => $prefix . 'venue',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Address',
				'desc'    => '',
				'id'      => $prefix . 'address',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Location',
				'desc'    => '',
				'id'      => $prefix . 'location',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Phone Number',
				'desc'    => '',
				'id'      => $prefix . 'phone',
				'type'    => 'text_medium',
				'std' => ''
			),
			array(
				'name'    => 'Featured image',
				'desc'    => 'Do you want to show post\'s featured image below title?',
				'id'      => $prefix . 'featured_area',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no', ),
					array( 'name' => 'Featured Image - keep aspect ratio', 'value' => 'i', ),
					array( 'name' => 'Featured Image', 'value' => 'i2', )
				),
				'std' => 'i'
			),
			array(
				'name'    => 'Gallery',
				'desc'    => 'Just insert WP gallery in this area.',
				'id'      => $prefix . 'gallery',
				'type'    => 'wysiwyg',
				'std' => ''
			),
			array(
				'name'    => 'Attend - URL',
				'desc'    => 'Insert URL or leave blank. You can use external links, too.',
				'id'      => $prefix . 'atend_url',
				'type'    => 'text',
				'std' => ''
			),
			array(
				'name'    => 'Attend - Button title',
				'desc'    => '',
				'id'      => $prefix . 'atend_button',
				'type'    => 'text_small',
				'std' => 'Attend'
			),
			array(
				'name'    => 'Attend - Button Color',
				'desc'    => '',
				'id'      => $prefix . 'button_color',
				'type'    => 'select',
				'options' => $buttonColor,
				'std' => 'custom'
			),
			array(
				'name'    => 'Attend - Button Target',
				'desc'    => '',
				'id'      => $prefix . 'button_target',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Same Window', 'value' => '_self', ),
					array( 'name' => 'New Window', 'value' => '_blank', )
				),
				'std' => '_blank'
			)
		)
	);

	// SERMON
	$meta_boxes[] = array(
		'id'         => 'sermon_info',
		'title'      => 'Sermon Details',
		'pages'      => array( TB_SERMON_CPT ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Date',
				'desc'    => '',
				'id'      => $prefix . 'date',
				'type'    => 'text_date_timestamp',
				'std' => ''
			),
			array(
				'name'    => 'Time',
				'desc'    => '',
				'id'      => $prefix . 'time',
				'type'    => 'text_time',
				'std' => ''
			),
			array(
				'name'    => 'Subtitle',
				'desc'    => '',
				'id'      => $prefix . 'subtitle',
				'type'    => 'text',
				'std' => ''
			),
			array(
				'name'    => 'Video',
				'desc'    => 'Enter a youtube, vimeo or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'      => $prefix . 'video',
				'type'    => 'oembed',
				'std' => ''
			),
			array(
				'name'  => 'MP3',
				'desc'  => 'Enter a mp3 file URL or upload a mp3 file on your server.',
				'id'    => $prefix . 'mp3',
				'type'  => 'file',
				'allow' => array( 'url', 'attachment' ),
				'std'	=> ''
			),
			array(
				'name'    => 'PDF',
				'desc'    => 'Enter a pdf file URL or upload a pdf file on your server.',
				'id'      => $prefix . 'pdf',
				'type'  => 'file',
				'allow' => array( 'url', 'attachment' ),
				'std'	=> ''
			),
			array(
				'name'    => 'Church',
				'desc'    => '',
				'id'      => $prefix . 'church',
				'type'    => 'select',
				'options' => tb_get_pages(TB_CHURCH_CPT),
				'std' => ''
			),
			array(
				'name'    => 'Speaker',
				'desc'    => '',
				'id'      => $prefix . 'speaker',
				'type'    => 'select',
				'options' => tb_get_pages(TB_PRIEST_CPT),
				'std' => ''
			),
			array(
				'name'    => 'Featured image',
				'desc'    => 'Do you want to show post\'s featured image below title? Only if you didn\'t provide video URL.',
				'id'      => $prefix . 'featured_area',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no', ),
					array( 'name' => 'Featured Image - keep aspect ratio', 'value' => 'i', ),
					array( 'name' => 'Featured Image', 'value' => 'i2', )
				),
				'std' => 'i'
			),
			array(
				'name'    => 'Google Map',
				'desc'    => 'Do you want to show Google map above content? It will work only if you choose church.',
				'id'      => $prefix . 'google_map',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'No', 'value' => 'no', ),
					array( 'name' => 'Yes', 'value' => 'yes', )
				),
				'std' => 'no'
			),
			array(
				'name'    => 'Gallery',
				'desc'    => 'Just insert WP gallery in this area.',
				'id'      => $prefix . 'gallery',
				'type'    => 'wysiwyg',
				'std' => ''
			)
		)
	);
	
	$googleZoomArray = array();
	$googleZoomIndex = 1;
	while ($googleZoomIndex < 21) {
		$googleZoomArray[] = array('name' => $googleZoomIndex, 'value' => $googleZoomIndex);
		$googleZoomIndex++;
	}

	$meta_boxes[] = array(
		'id'         => 'google_maps',
		'title'      => 'Google Maps',
		'pages'      => array( TB_CHURCH_CPT, TB_EVENT_CPT ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Google maps - URL',
				'desc'    => 'Visit <a href="http://maps.google.com/">Google maps</a>, find your address and then click "Link" button to get your map link.',
				'id'      => $prefix . 'google_map_url',
				'type'    => 'text',
				'std' => ''
			),
			array(
				'name'    => 'Type',
				'desc'    => '',
				'id'      => $prefix . 'google_map_type',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Map', 'value' => 'm', ),
					array( 'name' => 'Satellite', 'value' => 'h', ),
					array( 'name' => 'Terrain', 'value' => 'p', ),
				),
				'std' => 'm'
			),
			array(
				'name'    => 'Zoom',
				'desc'    => '',
				'id'      => $prefix . 'google_map_zoom',
				'type'    => 'select',
				'options' => $googleZoomArray,
				'std' => '16'
			),
			array(
				'name'    => 'Height',
				'desc'    => '',
				'id'      => $prefix . 'google_map_height',
				'type'    => 'text_small',
				'std' => '350'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'highlight_sidebar_settings',
		'title'      => 'Sidebar Settings - Highlight area',
		'pages'      => array( 'page' ),
		'show_on' => array( 'key' => 'page-template', 'value' => 'page-home.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Sidebar',
				'desc'    => 'Select the sidebar you wish to display on this page.<br /><strong>Note:</strong> You can create more sidebars under Appearance > Sidebars. ',
				'id'      => $prefix . 'highlight_sidebar_choice',
				'type'    => 'select',
				'options' => tb_get_custom_sidebars(),
				'std' => '0'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'highlight_sidebar_settings',
		'title'      => 'Sidebar Settings - Highlight area',
		'pages'      => array( 'page' ),
		'show_on' => array( 'key' => 'page-template', 'value' => 'page-home-wide-slider.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Sidebar',
				'desc'    => 'Select the sidebar you wish to display on this page.<br /><strong>Note:</strong> You can create more sidebars under Appearance > Sidebars. ',
				'id'      => $prefix . 'highlight_sidebar_choice',
				'type'    => 'select',
				'options' => tb_get_custom_sidebars(),
				'std' => '0'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'sidebar_settings',
		'title'      => 'Sidebar Settings',
		'pages'      => array( 'post', 'page', TB_GALLERY_CPT, TB_PRIEST_CPT ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Sidebar',
				'desc'    => 'Select the sidebar you wish to display on this page.<br /><strong>Note:</strong> You can create more sidebars under Appearance > Sidebars. ',
				'id'      => $prefix . 'sidebar_choice',
				'type'    => 'select',
				'options' => tb_get_custom_sidebars(),
				'std' => '0'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'sidebar_settings',
		'title'      => 'Sidebar Settings',
		'pages'      => array( TB_CHURCH_CPT, TB_EVENT_CPT, TB_SERMON_CPT ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => 'Sidebar',
				'desc'    => 'Select the sidebar you wish to display on this page.<br /><strong>Note:</strong> You can create more sidebars under Appearance > Sidebars. ',
				'id'      => $prefix . 'sidebar_choice',
				'type'    => 'select',
				'options' => tb_get_custom_sidebars(1),
				'std' => '0'
			)
		)
	);

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}

/*-------------CUSTOM FIELDS----------------*/
/*-----------------EMAIL--------------------*/
add_action( 'cmb_render_text_email', 'rrh_cmb_render_text_email', 10, 2 );
function rrh_cmb_render_text_email( $field, $meta ) {
    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" style="width:230px" />','<p class="cmb_metabox_description">', $field['desc'], '</p>';
}

add_filter( 'cmb_validate_text_email', 'rrh_cmb_validate_text_email' );
function rrh_cmb_validate_text_email( $new ) {
    if ( !is_email( $new ) ) {$new = "";}   
    return $new;
}


?>