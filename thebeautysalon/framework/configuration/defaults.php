<?php
/** Elderberry Defaults
  *
  * This file enables you to set up all the defaults,
  * shortcodes, widgets and so on in your theme. See
  * the config.sample.php file in the samples directory
  * for more info and examples.
  *
  * @package Elderberry
  * @subpackage The Vacation Rental Admin
  *
  **/


/** Color Definitions
  *
  * These colors will be available to users wherever
  * they can modify a color for shortcodes and other
  * elements.
  *
  **/
$eb_defaults['colors'] = array(
	'primary'      => '#E84242',
	'red'          => '#E23455',
	'cyan'         => '#139BC1',
	'yellow'       => '#F4D248',
	'black'        => '#4D4D4D',
	'blue'         => '#569CD1',
	'green'        => '#88BF53',
	'purple'       => '#C355BD',
	'orange'       => '#EC9F5F',
);



/** Available Shortcodes
  *
  * Add the name of your shortcode to this array to make it available
  * in the backend. We have a few built-in ones as well:
  * - line
  * - linelink
  * - highlight
  * - state
  * - postlist
  * - postslider
  * - imageslider
  * - button
  * - message
  * - toggle
  * - map
  * - tabs
  *
  * For a description of each, take a look at the documentation.
  *
  **/
$eb_defaults['shortcodes'] = array( 'line', 'linelink', 'highlight', 'state', 'button', 'message', 'imageslider', 'postslider', 'toggle', 'map', 'tabs', 'page', 'tiles', 'tile' );


/** Sidebar Location
  *
  * The default location of the sidebar. Possible values are:
  * - left
  * - right
  *
  **/
$eb_defaults['sidebar_location'] = 'right';

/** Post Types
  *
  * Define the post types you would like to use.
  * You will need to define these post types in the post_types.php
  * file. See post_types.php or post_types.sample.php in the
  * samples directory for more information.
  *
  **/
$eb_defaults['post_types'] = array();

/** Menus
  *
  * Define the menus you would like to use.
  *
  **/
$eb_defaults['menus'] =  array(
	'site_header' => 'Site Header',
);

/** Taxonomies
  *
  * Define the post taxonomies you would like to use.
  * You will need to define these taxonomies in the taxonomies.php
  * file. See taxonomies.php or taxonomies.sample.php in the
  * samples directory for more information.
  *
  **/
$eb_defaults['taxonomies'] = array();

/** Sidebars
  *
  * Define the built-in sidebars you would like to use.
  * Sidebars must be given in the following format:
  * 'sidebar_id' => array( 'scheme' => 'your_scheme' )
  *
  * Individual widgets will receive the 'your_scheme' value
  * as a class, enabling you to create different color schemes
  * for different sidebars
  *
  **/
$eb_defaults['sidebars'] = array(
	'Sidebar' => array( 'scheme' => 'light' ),
);




/** Field Definitions
  *
  * More friequently used fields are separated out for
  * ease of use and brevity here in this file.
  *
  **/
include( 'defaults-fields.php' );


/** Shortcode Defaults
  *
  * Add the default values for shortcode attributes. Defining
  * a shortcode and its attributes here will not automatically
  * create the shortcode or make it available. To make a shortcode
  * available for use you must add it to the $eb_defaults['shortcodes']
  * array.
  *
  **/
$eb_defaults['shortcode_defaults'] = array(
	'line'                 => array(
		'margin'              => 'normal',
		'color'               => '#dddddd',
		'line_style'          => 'solid',
		'height'              => '1px',
		'style'               => '',
	),
	'tiles'                   => array(
		'margin'              => 'normal',
		'columns'             => 4,
		'background'          => 'primary',
		'excerpt_length'      => '50',
		'show_title'          => 'yes',
		'show_excerpt'        => 'no',
		'show_link'           => 'yes',
		'style'               => '',
		'tile_style'          => '',
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 12,
		'author'              => '',
		'cat'                 => '',
		'tag'                 => '',
		'offset'              => 0,
		'order'               => 'DESC',
		'orderby'             => 'date',
		'only_thumbnailed'    => 'yes',
		'query_vars'          => '',
		'slideshow'			  => 'yes',
		'slideshow_speed'     => 4500,
		'animation_speed'     => 300,
		'animation_order'     => 'random'
	),
	'linelink'             => array(
		'margin'              => 'normal',
		'color'               => '#dddddd',
		'line_style'               => 'solid',
		'height'              => '1px',
		'linktext'            => 'top',
		'url'                 => '#',
		'text_align'          => 'right',
		'style'               => '',
	),
	'highlight'            => array(
		'color'               => '#ffffff',
		'background'          => 'primary',
		'style'               => '',
	),
	'state'                => array(
		'type'                => 'loggedin',
	),
	'button'               => array(
		'margin'              => 'normal',
		'color'               => 'auto',
		'background'          => 'primary',
		'radius'              => '5px',
		'border_style'        => 'solid',
		'border_width'        => '1px',
		'border_color'        => 'auto',
		'border_auto_color'   => array( '-', '33' ),
		'outline_style'       => 'solid',
		'outline_width'       => '0px',
		'outline_color'       => 'auto',
		'outline_auto_color'  => array( '-', '22' ),
		'gradient'            => 'no',
		'shadow'              => 'no',
		'shadow_value'        => '0px 1px 0px 0px rgba(255,255,255,0.3) inset, 0px 1px 1px 0px rgba(0,0,0,0.2)',
		'arrow'               => 'yes',
		'url'                 => '',
		'style'               => '',
		'target'              => '',
	),
	'message'              => array(
		'margin'              => 'normal',
		'color'               => 'auto',
		'background'          => 'primary',
		'radius'              => '5px',
		'border_style'        => 'solid',
		'border_width'        => '1px',
		'border_color'        => 'auto',
		'border_auto_color'   => array( '+', '22' ),
		'outline_style'       => 'solid',
		'outline_width'       => '0px',
		'outline_color'       => 'auto',
		'outline_auto_color'  => array( '-', '22' ),
		'gradient'            => 'no',
		'shadow'              => 'yes',
		'shadow_value'        => '0px 1px 1px 0px rgba(0,0,0,0.3) ',
		'style'               => '',
	),
	'imageslider'          => array(
		'margin'              => 'normal',
		'animation'           => 'slide',
		'direction'           => 'horizontal',
		'slideshow_speed'     => 7000,
		'animation_speed'     => 600,
		'pause_on_hover'      => 'yes',
		'height'              => '400px',
		'controls'            => 'yes',
		'show_title'          => 'no',
		'show_description'    => 'no',
		'images'              => 'all',
		'layout'              => 'default',
		'style'               => '',
	),
	'postslider'           => array(
		'margin'              => 'normal',
		'height'              => '400px',
		'animation'           => 'slide',
		'direction'           => 'horizontal',
		'slideshow_speed'     => 7000,
		'animation_speed'     => 600,
		'pause_on_hover'      => 'yes',
		'controls'            => 'yes',
		'show_title'          => 'no',
		'show_description'    => 'no',
		'smooth_height'       => 'no',
		'images'              => 'all',
		'layout'              => 'default',
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 10,
		'author'              => '',
		'cat'                 => '',
		'tag'                 => '',
		'offset'              => 0,
		'order'               => 'DESC',
		'orderby'             => 'date',
		'only_thumbnailed'    => 'yes',
		'query_vars'          => '',
		'style'               => '',
	),
	'toggle'               => array(
		'margin'              => 'normal',
		'title'               => 'Toggle This Section',
		'title_level'         => 3,
		'default'             => 'open',
		'animation'           => 'slide',
		'animation_speed'     => 500,
		'style'               => '',
	),
	'map'                  => array(
		'margin'              => 'normal',
		'location'            => 'New York, USA',
		'marker_text'         => 'My Location',
		'zoom'                => '10',
		'maptype'             => 'ROADMAP',
		'marker'              => 'yes',
		'height'              => 400,
		'style'               => '',
	),
	'tabs'                 => array(
		'margin'              => 'normal',
		'example'             => '[tabs] [tab title="My Tab"] The Content of this tab [/tab] [tab title="My Second Tab"] The content of the second tab [/tab] [/tabs]',
		'style'               => '',
	),
	'page'                  => array(
		'margin'              => 'none',
		'id'                  => '',
	),
);



/** Widgets
  *
  * Define the widgets and the settings you would like to use for them.
  * You will need to extend the WP_Widget class with your new widgets.
  * see the sample eb-custom_widgets.sample.php file for more information,
  * examples and default settings for all available built-in widgets
  *
  **/

$eb_defaults['widgets'] = array(
	'groups' => array (
		'search' => array(
			'tabs' => array(
				'main_settings' => array(
					'guid'        => 'search',
					'id'          => 'search',
					'unregister'  => 'WP_Widget_Search',
					'tab_title'   => 'Search',
					'name'        => 'Search',
					'description' => 'A customizable search widget',
					'width'       => 600,
					'items'       => array(
						'title' => array(
							'guid' => 'title',
							'id' => 'title',
							'control' => array(
								'type' => 'text',
								'default' => 'Search',
								'allow_empty' => true,
								'empty_value' => '',
							),
							'label' => 'Widget Title',
							'help'  => 'The widget title will be shown above the widget'
						),
						'placeholder' => array(
							'guid' => 'placeholder',
							'id' => 'placeholder',
							'control' => array(
								'type' => 'text',
								'default' => 'Enter your search terms',
								'allow_empty' => true,
							),
							'label' => 'Placeholder Text',
							'help'  => 'The text shown in the search input before the user enters a value'
						),
						'background_color' => array(
							'guid' => 'background_color',
							'id' => 'background_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#f1f1f1',
								'allow_empty' => false
							),
							'label' => 'Field Background Color',
							'help'  => 'The background color of the search field'
						),
						'border_color' => array(
							'guid' => 'border_color',
							'id' => 'border_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#dddddd',
								'allow_empty' => false
							),
							'label' => 'Field Border Color',
							'help'  => 'The border color of the search field'
						),
						'icon' => array(
							'guid' => 'icon',
							'id' => 'icon',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/search.png',
								'required' => true,
								'allow_empty' => false
							),
							'label' => 'Search Icon',
							'help'  => 'This image will be used as the icon in the field'
						),
					)
				)
			)
		),


		'contact' => array(
			'tabs' => array(
				'main_settings' => array(
					'guid'        => 'contact',
					'id'          => 'rf_widget_contact',
					'tab_title'   => 'Contact Settings',
					'name'        => 'Customizable Contact Sheet',
					'description' => 'A widget that displays social icons and contact information',
					'width'       => 600,
					'items'       => array(
						'title' => array(
							'guid' => 'title',
							'id' => 'title',
							'control' => array(
								'type' => 'text',
								'default' => 'Get in touch',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Widget Title',
							'help'  => 'The widget title will be shown above the widget'
						),
						'rss' => array(
							'guid' => 'rss',
							'id' => 'rss',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show Rss Icon' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Display RSS Icon',
							'help'  => 'An icon linking to your site\'s RSS feed will be shown'
						),
						'twitter' => array(
							'guid' => 'twitter',
							'id' => 'twitter',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Twitter Username',
							'help'  => 'A twitter icon linking to the given Twitter user will be shown'
						),
						'facebook' => array(
							'guid' => 'facebook',
							'id' => 'facebook',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Facebook Link',
							'help'  => 'A Facebook icon linking to the given Facebook link will be shown'
						),
						'linkedin' => array(
							'guid' => 'linkedin',
							'id' => 'linkedin',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Linkedin Link',
							'help'  => 'A Linkedin icon linking to the given Linkedin link will be shown'
						),
						'flickr' => array(
							'guid' => 'flickr',
							'id' => 'flickr',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Flickr Link',
							'help'  => 'A flickr icon linking to the given Flickr link will be shown'
						),
						'phone' => array(
							'guid' => 'phone',
							'id' => 'phone',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Phone Number',
							'help'  => 'The given phone number will be shown next to a phone icon'
						),
						'phone_icon' => array(
							'guid' => 'phone_icon',
							'id' => 'phone_icon',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/contact-phone.png',
								'allow_empty' => true
							),
							'label' => 'Phone Icon',
							'help'  => 'This icon will be used in the widget'
						),
						'email' => array(
							'guid' => 'email',
							'id' => 'email',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Email',
							'help'  => 'The given email address will be shown next to an email icon (use at your own risk!)'
						),
						'email_icon' => array(
							'guid' => 'email_icon',
							'id' => 'email_icon',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/contact-email.png',
								'allow_empty' => true
							),
							'label' => 'Email Icon',
							'help'  => 'This icon will be used in the widget'
						),
						'location' => array(
							'guid' => 'location',
							'id' => 'location',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Location',
							'help'  => 'The given address will be shown next to a location icon'
						),
						'location_icon' => array(
							'guid' => 'location_icon',
							'id' => 'location_icon',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/contact-location.png',
								'allow_empty' => true
							),
							'label' => 'Location Icon',
							'help'  => 'This icon will be used in the widget'
						),
					)
				)
			)
		),
		'twitter' => array(
			'tabs' => array(
				'main_settings' => array(
					'guid'        => 'twitter',
					'id'          => 'rf_widget_twitter',
					'tab_title'   => 'Twitter Settings',
					'name'        => 'Customisable Twitter Box',
					'description' => 'A widget that displays tweets from a certain user',
					'width'       => 600,
					'items'       => array(
						'title' => array(
							'guid' => 'title',
							'id' => 'title',
							'control' => array(
								'type' => 'text',
								'default' => 'My Tweets',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Widget Title',
							'help'  => 'The widget title will be shown above the widget'
						),
						'username' => array(
							'guid' => 'username',
							'id' => 'username',
							'control' => array(
								'type' => 'text',
								'default' => 'redfactory',
								'required' => true,
								'classes' => 'widefat',
							),
							'label' => 'Twitter Username',
							'help'  => 'Tweets will be shown from this user'
						),
						'count' => array(
							'guid' => 'count',
							'id' => 'count',
							'control' => array(
								'type' => 'text',
								'default' => 3,
								'required' => true
							),
							'label' => 'Tweets to show',
							'help'  => 'The number of tweets to show from the given user'
						),
						'followme' => array(
							'guid' => 'followme',
							'id' => 'followme',
							'control' => array(
								'type' => 'text',
								'default' => 'follow me',
								'required' => false
							),
							'label' => 'Follow Link Text',
							'help'  => 'The text to show on the follow link under the tweets. If left blank, no link will be shown.'
						),
					)
				)
			)
		),
		'featured' => array(
			'tabs' => array(
				'main_settings' => array(
					'guid'        => 'featured',
					'id'          => 'rf_widget_featured',
					'tab_title'   => 'Featured Item Settings',
					'name'        => 'Featured Item Display',
					'description' => 'Feature an arbitrary image and text',
					'width'       => 600,
					'items'       => array(
						'title' => array(
							'guid' => 'title',
							'id' => 'title',
							'control' => array(
								'type' => 'text',
								'default' => 'Featured Content',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Widget Title',
							'help'  => 'The widget title will be shown above the widget'
						),
						'image' => array(
							'guid' => 'image',
							'id' => 'image',
							'control' => array(
								'type' => 'upload',
								'default' => '',
								'required' => false,
							),
							'label' => 'Featured Image',
							'help'  => 'This image will be used'
						),
						'text' => array(
							'guid' => 'text',
							'id' => 'text',
							'control' => array(
								'type' => 'textarea',
								'default' => '',
								'required' => false
							),
							'label' => 'Text',
							'help'  => 'The text displayed under the featured image'
						),
						'link_text' => array(
							'guid' => 'link_text',
							'id' => 'link_text',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'required' => false
							),
							'label' => 'Link Text',
							'help'  => 'The text of the link below the featured image and text. If left blank, no link will be shown'
						),
						'link_url' => array(
							'guid' => 'link_url',
							'id' => 'link_url',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'required' => false
							),
							'label' => 'Link URL',
							'help'  => 'The URL where the link should point'
						),

					)
				)
			)
		),
		'map' => array(
			'tabs' => array(
				'main_settings' => array(
					'guid'        => 'map',
					'id'          => 'rf_widget_map',
					'tab_title'   => 'Map Settings',
					'name'        => 'Customisable Map Display',
					'description' => 'Add any location shown on a Google Map to the sidebar',
					'width'       => 600,
					'items'       => array(
						'title' => array(
							'guid' => 'title',
							'id' => 'title',
							'control' => array(
								'type' => 'text',
								'default' => 'My Location',
								'required' => false,
								'classes' => 'widefat',
							),
							'label' => 'Widget Title',
							'help'  => 'The widget title will be shown above the widget'
						),
						'location' => array(
							'guid' => 'location',
							'id' => 'location',
							'control' => array(
								'type' => 'text',
								'default' => 'New York',
								'required' => true
							),
							'label' => 'Location',
							'help'  => 'Any valid string which you can use in Google Maps or Google Earth can be used here'
						),
						'height' => array(
							'guid' => 'height',
							'id' => 'height',
							'control' => array(
								'type' => 'text',
								'default' => 300,
								'required' => true
							),
							'label' => 'Map Height',
							'help'  => 'Input a fixed map height'
						),
						'maptype' => array(
							'guid' => 'maptype',
							'id' => 'maptype',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Road map' => 'ROADMAP',
									'Satellite map' => 'SATELLITE',
									'Hybrid map' => 'HYBRID',
									'Terrain map' => 'TERRAIN',
								),
								'default' => 'ROADMAP',
								'required' => true
							),
							'label' => 'Map Type',
							'help'  => 'The selected map type will be used to display your location'
						),
						'marker' => array(
							'guid' => 'marker',
							'id' => 'marker',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Add a marker to the map?' => 'yes',
								),
								'default' => 'yes',
								'required' => false
							),
							'label' => 'Marker',
							'help'  => 'If checked, a pin will be added to the map'
						),
						'zoom' => array(
							'guid' => 'zoom',
							'id' => 'zoom',
							'control' => array(
								'type' => 'text',
								'default' => '12',
								'required' => true
							),
							'label' => 'Zoom',
							'help'  => 'How close the map should zoom to the given location. For street maps, 12-ish works best'
						),
						'text_above' => array(
							'guid' => 'text_above',
							'id' => 'text_above',
							'control' => array(
								'type' => 'textarea',
								'default' => '',
								'required' => true
							),
							'label' => 'Text Above Map',
							'help'  => 'Write some text to display above the map'
						),
						'text_below' => array(
							'guid' => 'text_below',
							'id' => 'text_below',
							'control' => array(
								'type' => 'textarea',
								'default' => '',
								'required' => true
							),
							'label' => 'Text Below Map',
							'help'  => 'Write some text to display below the map'
						),
					)
				)
			)
		),
	)
);


/** Meta Boxes
  *
  * Define the meta boxes you would like to use.
  * You will need to define these meta boxes in the metaboxes.php
  * file. See metaboxes.php or metaboxes.sample.php in the
  * samples directory for more information.
  *
  **/
$eb_defaults['metaboxes'] = array();

/** Custom Fields
  *
  * Define the custom fields you would like to use. The outermost
  * array's key must be the same as the WordPress page template
  * name. For post types this is the name of the post type, for
  * page templates this is the filename which handles the template
  * (don't forget that the .php at the end is also needed).
  *
  * This array must contain another array with the key of 'items'.
  * The members of this array create the tabs in the post settings.
  * each tab must be an array with the following members:
  * guid, tab_title, items.
  *
  * The guid stores an identifier for the tab, the tab_title
  * is used to show the tab's title, while the items show
  * the relevant controls. See the controls section of the
  * documentation for more info.
  *
  **/
$eb_defaults['custom_fields'] = array(
	'groups' => array(
		'page' => array(
			'disable_meta' => 'yes',
			'tabs' => array (
				'page_structure' => array(
					'guid' => 'page_structure',
					'tab_title' => 'Page Structure',
					'header' => array(
						'title' => 'Page Structure',
						'description' => 'Modify the general structure of this page',
					),
					'items' => array(
						'sidebar' => array(
							'guid' => 'sidebar',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array('framework', 'get_sidebars_array'),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default' => 'default',
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar', 'page' ),
								'allow_empty' => false
							),
							'label' => 'Sidebar to Show',
							'help'  => 'Select which sidebar you would like to show on this page. You can create multiple sidebars in the theme settings.'
						),
						'sidebar_position' => array(
							'guid' => 'sidebar_position',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Left' => 'left',
									'Right' => 'right',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar_position', 'page' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Sidebar Position',
							'help'  => 'Modify the placement of the sidebar on this page'
						),
						'show_sidebar' => array(
							'guid' => 'show_sidebar',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_sidebar', 'page' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Sidebar?',
							'help'  => 'If checked the page will be shown without a sidebar'
						),
						'show_title' => array(
							'guid' => 'show_title',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_title', 'page' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Title',
							'help'  => 'Specify weather you would like the title to be shown'
						),
						'show_breadcrumb' => array(
							'guid' => 'show_breadcrumb',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_breadcrumb', 'page' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Breadcrumb',
							'help'  => 'Specify weather you would like the breadcrumb to be shown'
						),
						'show_thumbnail' => array(
							'guid' => 'show_thumbnail',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_thumbnail', 'page' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Featured Image',
							'help'  => 'Specify weather you would like the featured image to be shown'
						),
					)
				),
			)
		),
		'post' => array(
			'disable_meta' => 'yes',
			'tabs' => array (
				'page_structure' => array(
					'guid' => 'page_structure',
					'tab_title' => 'Page Structure',
					'header' => array(
						'title' => 'Page Structure',
						'description' => 'Modify the general structure of this page',
					),
					'items' => array(
						'sidebar' => array(
							'guid' => 'sidebar',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array('framework', 'get_sidebars_array'),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default' => 'default',
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar', 'post' ),
								'allow_empty' => false
							),
							'label' => 'Sidebar to Show',
							'help'  => 'Select which sidebar you would like to show on this page. You can create multiple sidebars in the theme settings.'
						),
						'sidebar_position' => array(
							'guid' => 'sidebar_position',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Left' => 'left',
									'Right' => 'right',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar_position', 'post' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Sidebar Position',
							'help'  => 'Modify the placement of the sidebar on this page'
						),
						'show_sidebar' => array(
							'guid' => 'show_sidebar',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_sidebar', 'post' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Sidebar?',
							'help'  => 'If checked the page will be shown without a sidebar'
						),
						'show_title' => array(
							'guid' => 'show_title',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_title', 'post' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Title',
							'help'  => 'Specify weather you would like the title to be shown'
						),
						'show_breadcrumb' => array(
							'guid' => 'show_breadcrumb',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_breadcrumb', 'post' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Breadcrumb',
							'help'  => 'Specify weather you would like the breadcrumb to be shown'
						),

						'show_thumbnail' => array(
							'guid' => 'show_thumbnail',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_thumbnail', 'post' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Featured Image',
							'help'  => 'Specify weather you would like the featured image to be shown'
						),
					)
				),
				'metadata' => array(
					'guid' => 'metadata',
					'tab_title' => 'Metadata',
					'header' => array(
						'title' => 'Metadata',
						'description' => 'Modify how the postmeta is shown',
					),
					'items' => array(
						'show_post_metabar' => array(
							'guid' => 'show_post_metabar',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the post meta sidebar' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Meta Sidebar',
							'help'  => 'Select yes to show the meta sidebar (post date, categories, tags, author) or to disable it'
						),
						'show_post_metaauthor' => array(
							'guid' => 'show_post_metaauthor',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the author' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Author',
							'help'  => 'Decide weather or not the author should be shown'
						),
						'show_post_metacategories' => array(
							'guid' => 'show_post_metacategories',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the categories' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Categories',
							'help'  => 'Decide weather or not the categories should be shown'
						),
						'show_post_metatags' => array(
							'guid' => 'show_post_metatags',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the tags' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Tags',
							'help'  => 'Decide weather or not the tags should be shown'
						),
						'show_post_metacomments' => array(
							'guid' => 'show_post_metacomments',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the comment count' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Comment Count',
							'help'  => 'Decide weather or not the comment count should be shown'
						),

					)
				),
				'authorbox' => array(
					'guid' => 'authorbox',
					'tab_title' => 'Author Box',
					'header' => array(
						'title' => 'Author Box',
						'description' => 'Modify the author box',
					),
					'items' => array(
						'show_post_authorbox' => array(
							'guid' => 'show_post_authorbox',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the authorbox' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Author Box',
							'help'  => 'Decide if an author box should be shown below the post'
						),
						'show_post_authorimage' => array(
							'guid' => 'show_post_authorimage',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the author\'s Image' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Author Image',
							'help'  => 'Decide weather or not the author image should be shown'
						),
					)
				),
			)
		),
		'eb_product' => array(
			'disable_meta' => 'yes',
			'tabs' => array (
				'page_structure' => array(
					'guid' => 'page_structure',
					'tab_title' => 'Page Structure',
					'header' => array(
						'title' => 'Page Structure',
						'description' => 'Modify the general structure of this page',
					),
					'items' => array(
						'sidebar' => array(
							'guid' => 'sidebar',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array('framework', 'get_sidebars_array'),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default' => 'default',
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar', 'eb_product' ),
								'allow_empty' => false
							),
							'label' => 'Sidebar to Show',
							'help'  => 'Select which sidebar you would like to show on this page. You can create multiple sidebars in the theme settings.'
						),
						'sidebar_position' => array(
							'guid' => 'sidebar_position',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Left' => 'left',
									'Right' => 'right',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar_position', 'eb_product' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Sidebar Position',
							'help'  => 'Modify the placement of the sidebar on this page'
						),
						'show_sidebar' => array(
							'guid' => 'show_sidebar',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_sidebar', 'eb_product' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Sidebar?',
							'help'  => 'If checked the page will be shown without a sidebar'
						),
						'show_title' => array(
							'guid' => 'show_title',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_title', 'eb_product' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Title',
							'help'  => 'Specify weather you would like the title to be shown'
						),
						'show_breadcrumb' => array(
							'guid' => 'show_breadcrumb',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_breadcrumb', 'eb_product' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Breadcrumb',
							'help'  => 'Specify weather you would like the breadcrumb to be shown'
						),

						'show_thumbnail' => array(
							'guid' => 'show_thumbnail',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_thumbnail', 'eb_product' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Featured Image',
							'help'  => 'Specify weather you would like the featured image to be shown'
						),
					)
				),
				'product_data' => array(
					'guid' => 'product_data',
					'tab_title' => 'Product Data',
					'header' => array(
						'title' => 'Product Data',
						'description' => 'Add custom data to this product',
					),
					'items' => array(
						'price' => array(
							'guid' => 'price',
							'control' => array(
								'type' => 'text',
								'default' => 0,
								'help' => 'Just add the amount, <strong>without</strong> the currency',
								'allow_empty' => false,
								'empty_value' => 0,
								'classes' => 'small'
							),
							'label' => 'Price',
							'help'  => 'The price of this item'
						),
						'custom_data' => array(
							'guid' => 'custom_data',
							'control' => array(
								'type' => 'custom_fields',
								'required' => false,
								'name' => '',
								'button_text' => 'add another',
								'remove_text' => 'remove data',
								'default' => '',
								'allow_empty' => true
							),
							'label' => 'Custom Data',
							'help'  => 'Add any custom data to your product. If you\'re selling food you can add calories, or screen size for monitors, etc.'
						),
						'show_post_custom_data' => array(
							'guid' => 'show_post_custom_data',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the custom data for the product' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Custom Data',
							'help'  => 'Show the custom data for the product'
						),

					)
				),
				'related_products' => array(
					'guid' => 'related_products',
					'tab_title' => 'Related Products',
					'header' => array(
						'title' => 'Related Products',
						'description' => 'Modify the related product behaviour for this product',
					),
					'items' => array(
						'show_post_related_products' => array(
							'guid' => 'show_post_related_products',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'related_products_show_related_products' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Show Related Products',
							'help'  => 'Select weather or not the related products should be shown.'
						),
						'related_products_columns' => array(
							'guid' => 'related_products_columns',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'2' => '2',
									'3' => '3',
									'4' => '4',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'related_products_columns' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Columns',
							'help'  => 'Select the number of columns to organize the products into'
						),
						'related_products_count' => array(
							'guid' => 'related_products_count',
							'control' => array(
								'type' => 'text',
								'default' => eb_get_default_option( 'related_products_count' ),
								'allow_empty' => false
							),
							'label' => 'Products to Show',
							'help'  => 'Select the number of products to show'
						),
						'show_post_related_products_thumbnail' => array(
							'guid' => 'show_post_related_products_thumbnail',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'related_products_show_thumbnail' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Display Thumbnail',
							'help'  => 'Control if the image is shown'
						),
						'show_post_related_products_title' => array(
							'guid' => 'show_post_related_products_title',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'related_products_show_title' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Display Title',
							'help'  => 'Control if the title is shown'
						),
						'show_post_related_products_price' => array(
							'guid' => 'show_post_related_products_price',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'related_products_show_price' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Display Price',
							'help'  => 'Control if the price is shown'
						),
						'show_post_related_products_excerpt' => array(
							'guid' => 'show_post_related_products_excerpt',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'related_products_show_excerpt' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Display Excerpt',
							'help'  => 'Control if the excerpt is shown'
						),
						'related_products_excerpt_length' => array(
							'guid' => 'related_products_excerpt_length',
							'control' => array(
								'type' => 'text',
								'default' => eb_get_default_option( 'related_products_excerpt_length' ),
								'allow_empty' => false
							),
							'label' => 'Excerpt Length (chars)',
							'help'  => 'Define the excerpt length in characters'
						),

					)
				),
			)
		),
		'eb_product_list' => array(
			'disable_meta' => 'yes',
			'tabs' => array (
				'page_structure' => array(
					'guid' => 'page_structure',
					'tab_title' => 'Page Structure',
					'header' => array(
						'title' => 'Page Structure',
						'description' => 'Modify the general structure of this page',
					),
					'items' => array(
						'show_title' => array(
							'guid' => 'show_title',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_title', 'eb_product_list' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Title',
							'help'  => 'Specify weather you would like the title to be shown'
						),
						'show_breadcrumb' => array(
							'guid' => 'show_breadcrumb',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_breadcrumb', 'eb_product_list' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Breadcrumb',
							'help'  => 'Specify weather you would like the breadcrumb to be shown'
						),


						'show_thumbnail' => array(
							'guid' => 'show_thumbnail',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_thumbnail', 'eb_product_list' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Featured Image',
							'help'  => 'Specify weather you would like the featured image to be shown'
						),
						'disable_links' => array(
							'guid' => 'disable_links',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'disable_links', 'eb_product_list' ),
								'default_value' => 'no',
								'allow_empty' => false,
							),
							'label' => 'Disable Links For Products',
							'help'  => 'If set to yes, products will not link to single product pages '
						),

					)
				),
				'products' => array(
					'guid' => 'products',
					'tab_title' => 'Products',
					'header' => array(
						'title' => 'Products',
						'description' => 'Modify the products on this page',
					),
					'items' => array(
						'product_page_content' => array(
							'guid' => 'product_page_content',
							'control' => array(
								'fullwidth' => true,
								'type' => 'product_page_content',
								'default' => '',
								'allow_empty' => true,
							),
							'label' => 'Product List Content',
							'help'  => 'Select the products you would like to display on this product list'
						),
					)
				),
				'product_display' => array(
					'guid' => 'product_display',
					'tab_title' => 'Product Display',
					'header' => array(
						'title' => 'Product Display',
						'description' => 'Modify the products on this page',
					),
					'items' => array(
						'layout' => array(
							'guid' => 'layout',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array( 'framework', 'get_layouts_array' ),
								'function_args' => array( 'type' => 'productlist', 'default' => true ),
								'default' => '',
								'default_label' => 'current default: ' . eb_get_default_layout( 'productlist' ),
								'allow_empty' => false
							),
							'label' => 'Layout',
							'help'  => 'Select the layout for posts on this page'
						),
						'show_item_thumbnail' => array(
							'guid' => 'show_item_thumbnail',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the thumbnail for this product' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Thumbnail',
							'help'  => 'Show the thumbnail for the products'
						),
						'show_item_price' => array(
							'guid' => 'show_item_price',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the price for the products' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Price',
							'help'  => 'Show the price for the products'
						),
						'show_item_title' => array(
							'guid' => 'show_item_title',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the title for the products' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Title',
							'help'  => 'Show the title for the products'
						),
						'show_item_excerpt' => array(
							'guid' => 'show_item_excerpt',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the excerpt for the products' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Excerpt',
							'help'  => 'Show the excerpt for the products'
						),

					)
				),

			)
		),

		'template-postlist' => array(
			'disable_meta' => 'yes',
			'tabs' => array (
				'page_structure' => array(
					'guid' => 'page_structure',
					'tab_title' => 'Page Structure',
					'header' => array(
						'title' => 'Page Structure',
						'description' => 'Modify the general structure of this page',
					),
					'items' => array(
						'sidebar' => array(
							'guid' => 'sidebar',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array('framework', 'get_sidebars_array' ),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default' => 'default',
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar', 'template-postlist' ),
								'allow_empty' => false
							),
							'label' => 'Sidebar to Show',
							'help'  => 'Select which sidebar you would like to show on this page. You can create multiple sidebars in the theme settings.'
						),
						'sidebar_position' => array(
							'guid' => 'sidebar_position',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Left' => 'left',
									'Right' => 'right',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar_position', 'template-postlist' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Sidebar Position',
							'help'  => 'Modify the placement of the sidebar on this page'
						),
						'show_sidebar' => array(
							'guid' => 'show_sidebar',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_sidebar', 'template-postlist' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Sidebar?',
							'help'  => 'If checked the page will be shown without a sidebar'
						),
						'show_title' => array(
							'guid' => 'show_title',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_title', 'template-postlist' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Title',
							'help'  => 'Specify weather you would like the title to be shown'
						),
						'show_breadcrumb' => array(
							'guid' => 'show_breadcrumb',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_breadcrumb', 'template-postlist' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Breadcrumb',
							'help'  => 'Specify weather you would like the breadcrumb to be shown'
						),

						'show_content' => array(
							'guid' => 'show_content',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_content', 'template-postlist' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Content',
							'help'  => 'Specify weather you would like the content to be shown'
						),
						'show_thumbnail' => array(
							'guid' => 'show_thumbnail',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_thumbnail', 'template-postlist' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Featured Image',
							'help'  => 'Specify weather you would like the featured image to be shown'
						),
					)
				),
				'postlist_content' => array(
					'guid' => 'postlist_content',
					'tab_title' => 'Postlist Content',
					'header' => array(
						'title' => 'Postlist Content',
						'description' => 'Modify what is shown on this page',
					),
					'items' => array(
						'posts_per_page' => array(
							'guid' => 'posts_per_page',
							'control' => array(
								'type' => 'text',
								'default' => get_option( 'posts_per_page' ),
								'allow_empty' => false
							),
							'label' => 'Items Per Page',
							'help'  => 'Select how many items you want to show on each page. Adding 0 or -1 will retrieve all the posts without using nn'
						),
						'category' => array(
							'guid' => 'category',
							'control' => array(
								'fullwidth' => true,
								'type' => 'dualboxes',
								'options' => 'function',
								'function' => array( 'framework', 'get_taxonomies_array'),
								'function_args' => array( 'taxonomy' => 'category' ),
								'default' => '',
								'allow_empty' => true
							),
							'label' => 'Categories',
							'help'  => 'Select the categories to use on this page'
						),
						'orderby' => array(
							'guid' => 'orderby',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Date Published' => 'date',
									'Title' => 'title',
									'Date Modified' => 'modified',
									'Random' => 'rand',
									'Comment Count' => 'comment_count',
									'Menu Order' => 'menu_order',
								),
								'default' => 'date',
								'allow_empty' => false
							),
							'label' => 'Order By',
							'help'  => 'Select how you want to order the posts'
						),
						'order' => array(
							'guid' => 'order',
							'control' => array(
								'type' => 'radio',
								'boxes' => array(
									'Ascending' => 'ASC',
									'Descending' => 'DESC',
								),
								'default' => 'DESC',
								'allow_empty' => false
							),
							'label' => 'Order Direction',
							'help'  => 'Select the direction of the item order'
						),
						'only_thumbnailed' => array(
							'guid' => 'only_thumbnailed',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Only show items which have thumbnails' => 'yes',
								),
								'default' => 'no',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Only With Images',
							'help'  => 'Check the box to make sure only items with featured images are shown'
						),
					)
				),
				'postlist_items' => array(
					'guid' => 'postlist_items',
					'tab_title' => 'Postlist Items',
					'header' => array(
						'title' => 'Postlist Items',
						'description' => 'Modify how each item is displayed',
					),
					'items' => array(
						'layout' => array(
							'guid' => 'layout',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array( 'framework', 'get_layouts_array' ),
								'function_args' => array( 'type' => 'post', 'default' => true ),
								'default' => '',
								'default_label' => 'current default: ' . eb_get_default_layout( 'post' ),
								'allow_empty' => false
							),
							'label' => 'Layout',
							'help'  => 'Select the layout for posts on this page'
						),
						'show_meta' => array(
							'guid' => 'show_meta',
							'control' => array(
								'type' => 'radio',
								'boxes' => array(
									'Show Metadata' => 'show',
									'Hide Metadata' => 'hide',
								),
								'default' => 'show',
								'allow_empty' => false
							),
							'label' => 'Show/Hide Metadata',
							'help'  => 'This setting enables you to show or hide the metadata for items in the list'
						),

					)
				)

			)
		),
		'template-gallery' => array(
			'disable_meta' => 'yes',
			'tabs' => array (
				'page_structure' => array(
					'guid' => 'page_structure',
					'tab_title' => 'Page Structure',
					'header' => array(
						'title' => 'Page Structure',
						'description' => 'Modify the general structure of this page',
					),
					'items' => array(
						'sidebar' => array(
							'guid' => 'sidebar',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array( 'framework', 'get_sidebars_array'),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default' => 'default',
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar', 'template-gallery' ),
								'allow_empty' => false
							),
							'label' => 'Sidebar to Show',
							'help'  => 'Select which sidebar you would like to show on this page. You can create multiple sidebars in the theme settings.'
						),
						'sidebar_position' => array(
							'guid' => 'sidebar_position',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Left' => 'left',
									'Right' => 'right',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'sidebar_position', 'template-gallery' ),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Sidebar Position',
							'help'  => 'Modify the placement of the sidebar on this page'
						),
						'show_sidebar' => array(
							'guid' => 'show_sidebar',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_sidebar', 'template-gallery' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Sidebar?',
							'help'  => 'If checked the page will be shown without a sidebar'
						),
						'show_title' => array(
							'guid' => 'show_title',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_title', 'template-gallery' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Title',
							'help'  => 'Specify weather you would like the title to be shown'
						),
						'show_breadcrumb' => array(
							'guid' => 'show_breadcrumb',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_breadcrumb', 'template-gallery' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Breadcrumb',
							'help'  => 'Specify weather you would like the breadcrumb to be shown'
						),

						'show_content' => array(
							'guid' => 'show_content',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_content', 'template-gallery' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Content',
							'help'  => 'Specify weather you would like the content to be shown'
						),
						'show_thumbnail' => array(
							'guid' => 'show_thumbnail',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Default Setting --' => 'default',
								),
								'default_label' => 'current default: ' . eb_get_default_option( 'show_thumbnail', 'template-gallery' ),
								'default_value' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show Featured Image',
							'help'  => 'Specify weather you would like the featured image to be shown'
						),
					)
				),
				'gallery_content' => array(
					'guid' => 'gallery_content',
					'tab_title' => 'Gallery Content',
					'header' => array(
						'title' => 'Gallery Content',
						'description' => 'Modify what is shown on this page',
					),
					'items' => array(
						'columns' => array(
							'guid' => 'columns',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'2' => '2',
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
								),
								'default' => '3',
								'allow_empty' => false
							),
							'label' => 'Number of Columns',
							'help'  => 'Select the number of columns to organize content in on this page'
						),
						'posts_per_page' => array(
							'guid' => 'posts_per_page',
							'control' => array(
								'type' => 'text',
								'default' => get_option( 'posts_per_page' ),
								'allow_empty' => false
							),
							'label' => 'Items Per Page',
							'help'  => 'Select how many items you want to show on each page. Adding 0 or -1 will retrieve all the posts without using nn'
						),
						'show_item_filters' => array(
							'guid' => 'show_item_filters',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'show gallery filters' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Show Gallery Filters',
							'help'  => 'Check box to show the gallery filter'
						),
						'category' => array(
							'guid' => 'category',
							'control' => array(
								'fullwidth' => true,
								'type' => 'dualboxes',
								'options' => 'function',
								'function' => array( 'framework', 'get_taxonomies_array'),
								'function_args' => array( 'taxonomy' => 'category' ),
								'default' => '',
								'allow_empty' => true
							),
							'label' => 'Categories',
							'help'  => 'Select the categories to use on this page'
						),
						'orderby' => array(
							'guid' => 'orderby',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Date Published' => 'date',
									'Title' => 'title',
									'Date Modified' => 'modified',
									'Random' => 'rand',
									'Comment Count' => 'comment_count',
									'Menu Order' => 'menu_order',
								),
								'default' => 'date',
								'allow_empty' => false
							),
							'label' => 'Order By',
							'help'  => 'Select how you want to order the posts'
						),
						'order' => array(
							'guid' => 'order',
							'control' => array(
								'type' => 'radio',
								'boxes' => array(
									'Ascending' => 'ASC',
									'Descending' => 'DESC',
								),
								'default' => 'DESC',
								'allow_empty' => false
							),
							'label' => 'Order Direction',
							'help'  => 'Select the direction of the item order'
						),
						'only_thumbnailed' => array(
							'guid' => 'only_thumbnailed',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Only show items which have thumbnails' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Only With Images',
							'help'  => 'Check the box to make sure only items with featured images are shown'
						),
					)
				),
				'gallery_items' => array(
					'guid' => 'gallery_items',
					'tab_title' => 'Gallery Items',
					'header' => array(
						'title' => 'Gallery Items',
						'description' => 'Modify how each item is displayed',
					),
					'items' => array(
						'layout' => array(
							'guid' => 'layout',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array( 'framework', 'get_layouts_array' ),
								'function_args' => array( 'type' => 'gallery', 'default' => true ),
								'default' => '',
								'default_label' => 'current default: ' . eb_get_default_layout( 'gallery' ),
								'allow_empty' => false
							),
							'label' => 'Layout',
							'help'  => 'Select the layout for posts on this page'
						),
						'content_align' => array(
							'guid' => 'content_align',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Center' => 'center',
									'Left' => 'left',
									'Right' => 'right',
								),
								'search' => false,
								'default' => 'center',
								'allow_empty' => false,
							),
							'label' => 'Item Content Alignment',
							'help'  => 'Select the alignment of the content inside the individual gallery items'
						),
						'show_item_title' => array(
							'guid' => 'show_item_title',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show gallery item titles?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show Title',
							'help'  => 'If checked the title will be shown on gallery items'
						),
						'show_item_date' => array(
							'guid' => 'show_item_date',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show gallery item dates?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show Dates',
							'help'  => 'If checked the dates will be shown on gallery items'
						),
						'show_item_excerpt' => array(
							'guid' => 'show_item_excerpt',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show gallery item excerpts?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show Excerpt',
							'help'  => 'If checked the excerpts will be shown on gallery items'
						),
						'show_item_link' => array(
							'guid' => 'show_item_link',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show gallery item read more links?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show Read More Links',
							'help'  => 'If checked the read more links will be shown on gallery items'
						),
						'show_item_image' => array(
							'guid' => 'show_item_image',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Hide gallery item image?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show Image',
							'help'  => 'If checked the image will be shown on gallery items'
						),

					)
				)

			)
		),
	)
);

/** Theme Options
  *
  * Define the theme options you would like to use. This array is
  * set up in much the same way as the custom fields array, except
  * it accomodates for the large groups as well (controled via the
  * sidebar in the admin).
  *
  * The initial members of this array must be arrays themselves. The
  * key must be an identifier for each group. Each array must contain
  * the following members: title, items. The title will be shown
  * in the group list, the items hold the tabs for the setting group.
  *
  * The members of the items array create the tabs in the theme
  * settings. Each tab must be an array with the following members:
  * guid, tab_title, items.
  *
  * The guid stores an identifier for the tab, the tab_title
  * is used to show the tab's title, while the items show
  * the relevant controls. See the controls section of the
  * documentation for more info.
  *
  **/
$eb_defaults['option'] = array(
	'groups' => array(
		'general' => array(
			'title' => 'General',
			'icon' =>  EB_ADMIN_THEME_URL . '/img/groups/general.png',
			'tabs' => array (
				'global' => array(
					'guid' => 'global',
					'tab_title' => 'Global Settings',
					'items' => array(
						'sidebar' => array(
							'guid' => 'sidebar',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array('framework', 'get_sidebars_array'),
								'search' => false,
								'default' => 'sidebar',
								'allow_empty' => false
							),
							'label' => 'Default Sidebar to Show',
							'help'  => 'Select which sidebar you would like to show on all pages, except where a different one is specified.'
						),
						'sidebar_position' => array(
							'guid' => 'sidebar_position',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Left' => 'left',
									'Right' => 'right',
								),
								'search' => false,
								'default' => $eb_defaults['sidebar_location'],
								'allow_empty' => false
							),
							'label' => 'Default Sidebar Position',
							'help'  => 'Select the default location of the sidebar'
						),
						'show_sidebar' => array(
							'guid' => 'show_sidebar',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the sidebar by default?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show the sidebar by default?',
							'help'  => 'Disable the sidebar, except on pages where otherwise specified '
						),
						'show_title' => array(
							'guid' => 'show_title',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the page title by default?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show the title by default?',
							'help'  => 'Each page has a title which can be enabled or disabled'
						),
						'show_content' => array(
							'guid' => 'show_content',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the page content by default?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show the content by default?',
							'help'  => 'Each page has its content which can be enabled or disabled. While this will work on single pages it doesn\'t make a lot of sense to disable it there. However on special pages like the gallery or postlist pages you may want to disable the content'
						),
						'show_thumbnail' => array(
							'guid' => 'show_thumbnail',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the featured image by default?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show the featured image by default?',
							'help'  => 'Select weather the featured image should be shown'
						),
						'show_breadcrumb' => array(
							'guid' => 'show_breadcrumb',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show the breadcrumb by default?' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no',
							),
							'label' => 'Show the breadcrumb by default?',
							'help'  => 'Select weather the breadcrumb should be shown'
						),
						'custom_sidebars' => array(
							'guid' => 'custom_sidebars',
							'control' => array(
								'type' => 'tagsinput',
								'default' => '',
								'allow_empty' => true,
							),
							'label' => 'Custom Sidebars',
							'help'  => 'Add a list of additional sidebars you would like to be available in the admin'
						),
						'pagination_type' => array(
							'guid' => 'pagination_type',
							'control' => array(
								'type' => 'radio',
								'boxes' => array(
									'Full pagination' => 'pagination',
									'Previous and next links only' => 'links',
								),
								'default' => 'pagination',
								'allow_empty' => false
							),
							'label' => 'Pagination Type',
							'help'  => 'Select between full pagination (previous and next links and page numbers), or only previous and next links'
						),
						'analytics' => array(
							'guid' => 'analytics',
							'control' => array(
								'type' => 'textarea',
								'default' => '',
								'allow_empty' => true,
							),
							'label' => 'Analytics Code',
							'help'  => 'Enter any analytics code you received from Google Analytics or other services'
						),
						'google_maps_api_key' => array(
							'guid' => 'google_maps_api_key',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'allow_empty' => true,
							),
							'label' => 'Google Maps API Key',
							'help'  => 'Enter your Google Maps API Key to make sure maps work'
						),


					)
				),
				'frontpage' => array(
					'guid' => 'frontpage',
					'tab_title' => 'Front Page',
					'items' => array(
						'frontpage_postlist' => array(
							'guid' => 'frontpage_postlist',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => 'tbs_get_postlist_array',
								'initial' => array(
									'-- Select a Post List (overrides WP settings) --' => 'default',
								),
								'search' => false,
								'default' => '',
								'allow_empty' => true,
							),
							'label' => 'Show a Postlist on the Front page',
							'help'  => 'Select a post list to show on the front page. Beware as this overrides the settings in settings->reading.'
						),

					)
				),
				'page_types' => array(
					'guid' => 'page_types',
					'tab_title' => 'Page Types',
					'items' => array(
						'page_settings' => array(
							'guid' => 'page_settings',
							'control' => array(
								'default' => array(
									'sidebar' => 'default',
									'sidebar_position' => 'default',
									'show_sidebar' => 'default',
									'show_title' => 'default',
									'show_thumbnail' => 'default',
									'show_breadcrumb' => 'default',
								),
								'type' => 'page_settings',
								'allow_empty' => array(
									'sidebar' => false,
									'sidebar_position' => false,
									'show_title' => false,
									'show_thumbnail' => false,
									'show_sidebar' => false,
									'show_breadcrumb' => true,
								),
							),
							'label' => 'Single Pages',
							'help'  => 'Select the settings for the page post type.'
						),
						'post_settings' => array(
							'guid' => 'post_settings',
							'control' => array(
								'default' => array(
									'sidebar' => 'default',
									'sidebar_position' => 'default',
									'show_sidebar' => 'default',
									'show_title' => 'default',
									'show_thumbnail' => 'default',
									'show_breadcrumb' => 'default',
								),
								'type' => 'page_settings',
								'allow_empty' => array(
									'sidebar' => false,
									'sidebar_position' => false,
									'show_title' => false,
									'show_thumbnail' => false,
									'show_sidebar' => false,
									'show_breadcrumb' => true,
								),
							),
							'label' => 'Single Posts',
							'help'  => 'Select the settings for the post post type.'
						),
						'eb_product_settings' => array(
							'guid' => 'eb_product_settings',
							'control' => array(
								'default' => array(
									'sidebar' => 'default',
									'sidebar_position' => 'default',
									'show_sidebar' => 'default',
									'show_title' => 'default',
									'show_thumbnail' => 'default',
									'show_breadcrumb' => 'default',
									'show_breadcrumb' => true,
								),
								'type' => 'page_settings',
								'allow_empty' => array(
									'sidebar' => false,
									'sidebar_position' => false,
									'show_title' => false,
									'show_thumbnail' => false,
									'show_sidebar' => false,
									'show_breadcrumb' => true,
								),
							),
							'label' => 'Product Posts',
							'help'  => 'Select the settings for the eb_product post type.'
						),
						'eb_product_list_settings' => array(
							'guid' => 'eb_product_list_settings',
							'control' => array(
								'default' => array(
									'show_title' => 'default',
									'show_thumbnail' => 'default',
									'show_breadcrumb' => 'default',
								),
								'type' => 'page_settings',
								'allow_empty' => array(
									'show_title' => false,
									'show_thumbnail' => false,
									'show_breadcrumb' => true,
								),
							),
							'label' => 'Product Lists',
							'help'  => 'Select the settings for the eb_product_list post type.'
						),
						'template-postlist_settings' => array(
							'guid' => 'template-postlist_settings',
							'control' => array(
								'default' => array(
									'sidebar' => 'default',
									'sidebar_position' => 'default',
									'show_sidebar' => 'default',
									'show_title' => 'default',
									'show_breadcrumb' => 'default',
								),
								'type' => 'page_settings',
								'allow_empty' => array(
									'sidebar' => false,
									'sidebar_position' => false,
									'show_title' => false,
									'show_thumbnail' => false,
									'show_content' => false,
									'show_sidebar' => false,
									'show_breadcrumb' => true,
								),
							),
							'label' => 'Post List Pages',
							'help'  => 'Select the settings for post list templates.'
						),
						'template-gallery_settings' => array(
							'guid' => 'template-gallery_settings',
							'control' => array(
								'default' => array(
									'sidebar' => 'default',
									'sidebar_position' => 'default',
									'show_sidebar' => 'default',
									'show_title' => 'default',
									'show_breadcrumb' => 'default',
								),
								'type' => 'page_settings',
								'allow_empty' => array(
									'sidebar' => false,
									'sidebar_position' => false,
									'show_title' => false,
									'show_thumbnail' => false,
									'show_content' => false,
									'show_sidebar' => false,
									'show_breadcrumb' => true,
								),
							),
							'label' => 'Gellery Pages',
							'help'  => 'Select the settings for gallery templates.'
						),
					)
				),
				'layouts' => array(
					'guid' => 'layouts',
					'tab_title' => 'Layouts',
					'items' => array(
						'post_layout' => array(
							'guid' => 'post_layout',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array('framework', 'get_layouts_array'),
								'function_args' => array( 'type' => 'post' ),
								'default' => 'layout-binder',
								'allow_empty' => false
							),
							'label' => 'Default Post Layout',
							'help'  => 'Select a layout to use for posts by default'
						),
						'gallery_layout' => array(
							'guid' => 'gallery_layout',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array('framework', 'get_layouts_array'),
								'function_args' => array( 'type' => 'gallery' ),
								'default' => 'layout-default',
								'allow_empty' => false
							),
							'label' => 'Default Gallery Layout',
							'help'  => 'Select a layout to use for galleries by default'
						),
						'productlist_layout' => array(
							'guid' => 'productlist_layout',
							'control' => array(
								'type' => 'select',
								'options' => 'function',
								'function' => array('framework', 'get_layouts_array'),
								'function_args' => array( 'type' => 'productlist' ),
								'default' => 'layout-default',
								'allow_empty' => false
							),
							'label' => 'Default Product List Layout',
							'help'  => 'Select a layout to use for product lists by default'
						),

					)
				),
				'currency_settings' => array(
					'guid' => 'currency_settings',
					'tab_title' => 'Currencies',
					'header' => array(
						'title' => '',
						'description' => '',
					),
					'items' => array(
						'currency' => array(
							'guid' => 'currency',
							'control' => array(
								'type' => 'text',
								'default' => '$',
								'allow_empty' => false
							),
							'label' => 'Default Currency',
							'help'  => 'Type the symbol or abbreviation of the currency you would like to use. This will be shown to users when they look at prices. Good Examples are EUR, USD, $ or similar'
						),
						'currency_position' => array(
							'guid' => 'currency_position',
							'id' => 'currency_position',
							'control' => array(
								'type' => 'radio',
								'boxes' => array(
									'Before the amount' => 'before',
									'After the amount' => 'after',
								),
								'default' => 'before',
								'allow_empty' => false
							),
							'label' => 'Default Currency Position',
							'help'  => 'Select weather you\'d like the currency displayed before or after the amount'
						),
					)
				),

			)
		),
		'products' => array(
			'title' => 'Products',
			'icon' =>  EB_ADMIN_THEME_URL . '/img/groups/products.png',
			'tabs' => array (
				'related_products' => array(
					'guid' => 'related_products',
					'tab_title' => 'Related Products',
					'items' => array(
						'related_products_show_related_products' => array(
							'guid' => 'related_products_show_related_products',
							'id' => 'related_products_show_related_products',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show Related Products' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Display Related Products?',
							'help'  => 'Select weather or not related products should be shown ion single product pages by default'
						),
						'related_products_columns' => array(
							'guid' => 'related_products_columns',
							'id' => 'related_products_columns',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'2' => '2',
									'3' => '3',
									'4' => '4',
								),
								'default' => '3',
								'allow_empty' => true
							),
							'label' => 'Columns',
							'help'  => 'The number of columns used in related product boxes by default'
						),
						'related_products_count' => array(
							'guid' => 'related_products_count',
							'id' => 'related_products_count',
							'control' => array(
								'type' => 'text',
								'default' => '3',
								'allow_empty' => false,
								'empty_value' => '3'
							),
							'label' => 'Products To Show',
							'help'  => 'Define the number of products shown'
						),
						'related_products_show_thumbnail' => array(
							'guid' => 'related_products_show_thumbnail',
							'id' => 'related_products_show_thumbnail',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show Thumbnail' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Display Thumbnail',
							'help'  => 'Control if the image is shown'
						),
						'related_products_show_thumbnail' => array(
							'guid' => 'related_products_show_thumbnail',
							'id' => 'related_products_show_thumbnail',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show Thumbnail' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Display Thumbnail',
							'help'  => 'Control if the image is shown'
						),
						'related_products_show_title' => array(
							'guid' => 'related_products_show_title',
							'id' => 'related_products_show_title',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show Title' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Display Title',
							'help'  => 'Control if the title is shown'
						),
						'related_products_show_price' => array(
							'guid' => 'related_products_show_price',
							'id' => 'related_products_show_price',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show Price' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Display Price',
							'help'  => 'Control if the price is shown'
						),
						'related_products_show_excerpt' => array(
							'guid' => 'related_products_show_excerpt',
							'id' => 'related_products_show_excerpt',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Show Excerpt' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Display Excerpt',
							'help'  => 'Control if the excerpt is shown'
						),
						'related_products_excerpt_length' => array(
							'guid' => 'related_products_excerpt_length',
							'id' => 'related_products_excerpt_length',
							'control' => array(
								'type' => 'text',
								'default' => '100',
								'allow_empty' => false,
								'empty_value' => '100'
							),
							'label' => 'Excerpt Length (chars)',
							'help'  => 'Define the excerpt length in characters'
						),

					)
				),
			)
		),

		'design' => array(
			'title' => 'Design',
			'icon' =>  EB_ADMIN_THEME_URL . '/img/groups/design.png',
			'tabs' => array (
				'colors' => array(
					'guid' => 'colors',
					'tab_title' => 'Colors',
					'items' => array(
						'primary_color' => array(
							'guid' => 'primary_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => $eb_defaults['colors']['primary'],
								'allow_empty' => false
							),
							'label' => 'Primary Color',
							'help'  => 'The primary color for this website. User for a number of elements.'
						),
						'site_content_background_color' => array(
							'guid' => 'site_content_background_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#fafafa',
								'allow_empty' => false
							),
							'label' => 'Background Color',
							'help'  => 'The background color of the page. You can also choose an image in the images tab'
						)

					)
				),
				'header' => array(
					'guid' => 'header',
					'tab_title' => 'Header',
					'items' => array(
						'site_header_logo_height' => array(
							'guid' => 'site_header_logo_height',
							'control' => array(
								'type' => 'text',
								'default' => '41',
								'allow_empty' => false
							),
							'label' => 'Header Image Height (px)',
							'help'  => 'If your Logo image is higher than the default one please add the correct height here. We use this height to correctly position the text vertically as well.'
						),
						'header_menu_change_width' => array(
							'guid' => 'header_menu_change_width',
							'control' => array(
								'type' => 'text',
								'default' => '600',
								'allow_empty' => false
							),
							'label' => 'Collapse Header Menu Into Button At This Width',
							'help'  => 'If you site is narrower than the specified amount (in px) the menu will collapse into a button'
						),
					)
				),
				'footer' => array(
					'guid' => 'footer',
					'tab_title' => 'Footer',
					'items' => array(
						'site_footer_background_color' => array(
							'guid' => 'site_footer_background_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#3d3d3d',
								'allow_empty' => false
							),
							'label' => 'Footer Background Color',
							'help'  => 'This color will be used as the background of the footer'
						),
						'site_footer_text_color' => array(
							'guid' => 'site_footer_text_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#aaaaaa',
								'allow_empty' => false
							),
							'label' => 'Footer Text Color',
							'help'  => 'This color will be used for the text in the footer'
						),
						'site_footer_link_color' => array(
							'guid' => 'site_footer_link_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#aaaaaa',
								'allow_empty' => false
							),
							'label' => 'Footer Link Color',
							'help'  => 'This color will be used for the links in the footer'
						),
						'site_footer_copyright_text' => array(
							'guid' => 'site_footer_copyright_text',
							'control' => array(
								'type' => 'text',
								'default' => 'Copyright &copy; ' . date( 'Y' ) . ' ' . get_bloginfo(),
								'allow_empty' => false
							),
							'label' => 'Copyright Text',
							'help'  => 'The copyright text to show in the footer'
						),
						'footer_facebook_icon' => array(
							'guid' => 'footer_facebook_icon',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/footer-facebook.png',
								'allow_empty' => true
							),
							'label' => 'Facebook icon',
							'help'  => 'The icon shown for your facebook link if added'
						),
						'footer_facebook_url' => array(
							'guid' => 'footer_facebook_url',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'allow_empty' => true
							),
							'label' => 'Facebook URL',
							'help'  => 'The link that the facebook icon should point to. Leave blank if you do not want the icon to show up'
						),
						'footer_twitter_icon' => array(
							'guid' => 'footer_twitter_icon',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/footer-twitter.png',
								'allow_empty' => true
							),
							'label' => 'Twitter icon',
							'help'  => 'The icon shown for your twitter link if added'
						),
						'footer_twitter_url' => array(
							'guid' => 'footer_twitter_url',
							'control' => array(
								'type' => 'text',
								'default' => '',
								'allow_empty' => true
							),
							'label' => 'Twitter URL',
							'help'  => 'The link that the twitter icon should point to. Leave blank if you do not want the icon to show up'
						),

						'footer_rss_icon' => array(
							'guid' => 'footer_rss_icon',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/footer-rss.png',
								'allow_empty' => true
							),
							'label' => 'RSS icon',
							'help'  => 'The icon shown for your rss link if added'
						),
						'footer_rss_url' => array(
							'guid' => 'footer_rss_url',
							'control' => array(
								'type' => 'text',
								'default' => get_bloginfo('rss2_url'),
								'allow_empty' => true
							),
							'label' => 'RSS URL',
							'help'  => 'The link that the rss icon should point to. Leave blank if you do not want the icon to show up'
						),
					)
				),
				'sidebar' => array(
					'guid' => 'sidebar',
					'tab_title' => 'Sidebar',
					'items' => array(
						'site_sidebar_text_color' => array(
							'guid' => 'site_sidebar_text_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#4C4841',
								'allow_empty' => false
							),
							'label' => 'Sidebar Text Color',
							'help'  => 'This color will be used for the text in the sidebar'
						),
						'site_sidebar_heading_color' => array(
							'guid' => 'site_sidebar_heading_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#4d4d4d',
								'allow_empty' => false
							),
							'label' => 'Sidebar Heading Color',
							'help'  => 'This color will be used for the headings in the sidebar'
						),
						'site_sidebar_background_color' => array(
							'guid' => 'site_sidebar_background_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#ffffff',
								'allow_empty' => false
							),
							'label' => 'Sidebar Background Color',
							'help'  => 'This color will be used for the background of the sidebar'
						),
						'site_sidebar_link_color' => array(
							'guid' => 'site_sidebar_link_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#4C4841',
								'allow_empty' => false
							),
							'label' => 'Sidebar Link Color',
							'help'  => 'This color will be used for some links in the sidebar. Note that due to the amount of link-lists found in the sidebar the "usual" color for the links will be the text color'
						),
							'site_sidebar_list_separator_color' => array(
							'guid' => 'site_sidebar_list_separator_color',
							'control' => array(
								'type' => 'colorpicker',
								'default' => '#e1e1e1',
								'allow_empty' => false
							),
							'label' => 'List Separator Color',
							'help'  => 'Adjust the color of the list separator line'
						),

					)
				),
				'images' => array(
					'guid' => 'images',
					'tab_title' => 'Images',
					'items' => array(
						'logo' => array(
							'guid' => 'logo',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/logo.png',
								'allow_empty' => true
							),
							'label' => 'Logo',
							'help'  => 'The logo for your site, used in the header'
						),
						'logo_alt_text' => array(
							'guid' => 'logo_alt_text',
							'control' => array(
								'type' => 'text',
								'default' => 'Site Logo',
								'allow_empty' => false
							),
							'label' => 'Logo Alt Text',
							'help'  => 'Alt text is used when an image can\'t be loaded for accessibility or server reasons.'
						),
						'resize_logo' => array(
							'guid' => 'resize_logo',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Resize Logo' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Resize Logo',
							'help'  => 'Your logo will be resized to try and make it fit as best as possible with the header'
						),
						'site_content_background_image' => array(
							'guid' => 'site_content_background_image',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/site_content_background_image.png',
								'allow_empty' => true
							),
							'label' => 'Background Image',
							'help'  => 'This image will be tiled and used as the background for your site'
						),
						'tile_background' => array(
							'guid' => 'tile_background',
							'control' => array(
								'type' => 'checkbox',
								'boxes' => array(
									'Tile Background' => 'yes',
								),
								'default' => 'yes',
								'allow_empty' => true,
								'empty_value' => 'no'
							),
							'label' => 'Tile Background',
							'help'  => 'If set to yes your background image will repeat. Otherwise it will be center aligned without repeating'
						),
						'background_attachment' => array(
							'guid' => 'background_attachment',
							'control' => array(
								'type' => 'radio',
								'boxes' => array(
									'Fixed Background' => 'fixed',
									'Scrolling Background' => 'scroll',
								),
								'default' => 'scroll',
								'allow_empty' => false,
								'empty_value' => 'scroll'
							),
							'label' => 'Background Attachment',
							'help'  => 'If set to fixed the background will not scroll with the page. This is ideal for large full page images'
						),
						'favicon' => array(
							'guid' => 'favicon',
							'control' => array(
								'type' => 'upload',
								'default' => '',
								'allow_empty' => true
							),
							'label' => 'Favicon',
							'help'  => 'This 16x16 .ico file will be shown in browser bars and bookmarks'
						),
						'apple_touch_icon' => array(
							'guid' => 'apple_touch_icon',
							'control' => array(
								'type' => 'upload',
								'default' => '',
								'allow_empty' => true
							),
							'label' => 'Apple Touch Icon',
							'help'  => 'This 144x144 .png file will be shown on apple devices on the home screen'
						),
						'website_image' => array(
							'guid' => 'website_image',
							'control' => array(
								'type' => 'upload',
								'default' => '',
								'allow_empty' => true,
							),
							'label' => 'Website Image',
							'help' => 'The Website Image is an image associated to with your website. Facebook uses this image when users share links. For your posts the featured image is used. The image specified here is used for all pages which don\'t have featured images specified.'
						),
						'hoverlink' => array(
							'guid' => 'hoverlink',
							'control' => array(
								'type' => 'upload',
								'default' => get_template_directory_uri() . '/img/defaults/link.png',
								'allow_empty' => true
							),
							'label' => 'Image Hover Link',
							'help'  => 'This image will show up when you hover over an image link'
						),
					)
				),
				'fonts' => array(
					'guid' => 'fonts',
					'tab_title' => 'Fonts',
					'items' => array(
						'heading_font' => array(
							'guid' => 'heading_font',
							'control' => array(
								'type' => 'font',
								'default' => array(
									'name' => 'Helvetica Neue',
									'type' => 'Sans-serif',
									'fallback' => 'Helvetica, Arial'
								),
								'allow_empty' => array(
									'name' => false,
									'type' => false,
									'fallback' => false
								)
							),
							'label' => 'Heading Fonts',
							'help'  => 'The font to use for all headings on the site'
						),
						'body_font' => array(
							'guid' => 'body_font',
							'control' => array(
								'type' => 'font',
								'default' => array(
									'name' => 'Helvetica Neue',
									'type' => 'Sans-serif',
									'fallback' => 'Helvetica, Arial'
								),
								'allow_empty' => array(
									'name' => false,
									'type' => false,
									'fallback' => false
								)
							),
							'label' => 'Body Fonts',
							'help'  => 'The font to use for all body text on the site'
						),

					)
				),

			)
		),
		'text' => array(
			'title' => 'Text',
			'icon' =>  EB_ADMIN_THEME_URL . '/img/groups/text.png',
			'tabs' => array (
				'messages' => array(
					'guid' => 'messages',
					'tab_title' => 'Messages',
					'items' => array(
						'404_title' => array(
							'guid' => '404_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Oh Noes!',
								'allow_empty' => false
							),
							'label' => '404 Error Title',
							'help'  => 'The title shown on the 404 error page'
						),
						'404_message' => array(
							'guid' => '404_message',
							'control' => array(
								'type' => 'textarea',
								'default' => 'Sorry, there seems to be no content on this page.',
								'allow_empty' => true
							),
							'label' => '404 Error Message',
							'help'  => 'The message shown on the 404 error page'
						),
						'no_posts_title' => array(
							'guid' => 'no_posts_title',
							'control' => array(
								'type' => 'text',
								'default' => 'There are no posts here',
								'allow_empty' => false
							),
							'label' => 'No Posts Title',
							'help'  => 'This is the title of the message shown when a page exists, but there are no posts on it. An example is a gallery page which contains a list of posts from the "News" category. If the "News" category doesn\'t have posts the gallery page still exists, but it has no posts to show.'
						),
						'no_posts_message' => array(
							'guid' => 'no_posts_message',
							'control' => array(
								'type' => 'text',
								'default' => 'You are in the right place, but it seems that there are no posts that we can show here :(',
								'allow_empty' => true
							),
							'label' => 'No Posts Message',
							'help'  => 'This is the message shown when a page exists, but there are no posts on it. An example is a gallery page which contains a list of posts from the "News" category. If the "News" category doesn\'t have posts the gallery page still exists, but it has no posts to show.'
						),
						'no_search_results_title' => array(
							'guid' => 'no_search_results_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Ooops',
								'allow_empty' => false
							),
							'label' => 'No Search Results Title',
							'help'  => 'The title shown on the page if there are no search results'
						),
						'no_search_results_message' => array(
							'guid' => 'no_search_results_message',
							'control' => array(
								'type' => 'textarea',
								'default' => 'There are no results for your search :(',
								'allow_empty' => true
							),
							'label' => 'No Search Results Message',
							'help'  => 'The message shown on the page if there are no search results'
						),
						'password_protected_title' => array(
							'guid' => 'password_protected_title',
							'control' => array(
								'type' => 'text',
								'default' => 'This post is password protected',
								'allow_empty' => false
							),
							'label' => 'Password Protected Post Title',
							'help'  => 'This is the title of the message shown when someone visits a post which is password protected.'
						),
						'password_protected_message' => array(
							'guid' => 'password_protected_message',
							'control' => array(
								'type' => 'textarea',
								'default' => 'This post can only be read by people who have the password. If you know it, please enter it into the form to unlock this post',
								'allow_empty' => true
							),
							'label' => 'Password Protected Post Message',
							'help'  => 'This is the message shown when someone visits a post which is password protected.'
						),
						'comments_closed_title' => array(
							'guid' => 'comments_closed_title',
							'control' => array(
								'type' => 'text',
								'default' => 'This comments for this post have been closed',
								'allow_empty' => false
							),
							'label' => 'Comments Closed Title',
							'help'  => 'This is the title of the message shown for posts which have closed comments.'
						),
						'comments_closed_message' => array(
							'guid' => 'comments_closed_message',
							'control' => array(
								'type' => 'textarea',
								'default' => 'This means the no further comments will be accepted',
								'allow_empty' => true
							),
							'label' => 'Comments Closed Message',
							'help'  => 'This is message shown for posts which have closed comments.'
						),

					)
				),
				'page_titles' => array(
					'guid' => 'page_titles',
					'tab_title' => 'Page Titles',
					'items' => array(
						'home_page_title' => array(
							'guid' => 'home_page_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Home',
								'allow_empty' => false
							),
							'label' => 'Home Page Title',
							'help'  => 'This title will be shown on the home page. If you don\'t want to show a title, leave it blank',
						),
						'post_titles' => array(
							'guid' => 'post_titles',
							'control' => array(
								'type' => 'text',
								'default' => 'Our Blog',
								'allow_empty' => false
							),
							'label' => 'Post Page Title',
							'help'  => 'This title will be the main title for all single blog post pages',
						),
						'product_titles' => array(
							'guid' => 'product_titles',
							'control' => array(
								'type' => 'text',
								'default' => 'Our Products',
								'allow_empty' => false
							),
							'label' => 'Product Page Title',
							'help'  => 'This title will be the main title for all single product posts',
						),
						'search_page_title' => array(
							'guid' => 'search_page_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Search: %s',
								'allow_empty' => false
							),
							'label' => 'Search Page Title',
							'help'  => 'This title will be shown on the search page. If you don\'t want to show a title, leave it blank. Use %s as a placeholder for the search terms entered.',
						),
						'category_page_title' => array(
							'guid' => 'category_page_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Categories: %s',
								'allow_empty' => false
							),
							'label' => 'Category Archive Title',
							'help'  => 'This title will be shown on the category archives page. If you don\'t want to show a title, leave it blank. Use %s as a placeholder for the actual category name',
						),
						'tag_page_title' => array(
							'guid' => 'tag_page_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Tags: %s',
								'allow_empty' => false
							),
							'label' => 'Tag Archive Title',
							'help'  => 'This title will be shown on the tag archives page. If you don\'t want to show a title, leave it blank. Use %s as a placeholder for the actual tag name',
						),
						'yearly_page_title' => array(
							'guid' => 'yearly_page_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Yearly Archives: %s',
								'allow_empty' => false
							),
							'label' => 'Yearly Archives Title',
							'help'  => 'This title will be shown on the yearly archives page. If you don\'t want to show a title, leave it blank. Use %s as a placeholder for the actual year',
						),
						'monthly_page_title' => array(
							'guid' => 'monthly_page_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Monthly Archives: %s',
								'allow_empty' => false
							),
							'label' => 'Monthly Archives Title',
							'help'  => 'This title will be shown on the monthly archives page. If you don\'t want to show a title, leave it blank. Use %s as a placeholder for the actual month',
						),
						'daily_page_title' => array(
							'guid' => 'daily_page_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Daily Archives: %s',
								'allow_empty' => false
							),
							'label' => 'Daily Archives Title',
							'help'  => 'This title will be shown on the daily archives page. If you don\'t want to show a title, leave it blank. Use %s as a placeholder for the actual day',
						),
						'author_page_title' => array(
							'guid' => 'author_page_title',
							'control' => array(
								'type' => 'text',
								'default' => 'Authors: %s',
								'allow_empty' => false
							),
							'label' => 'Authors Page Title',
							'help'  => 'This title will be shown on the author archives page. If you don\'t want to show a title, leave it blank. Use %s as a placeholder for the actual author',
						),
					)
				),
				'misc' => array(
					'guid' => 'misc',
					'tab_title' => 'Misc',
					'items' => array(
						'read_more' => array(
							'guid' => 'read_more',
							'control' => array(
								'type' => 'text',
								'default' => 'Read more',
								'allow_empty' => false
							),
							'label' => 'Read More Text',
							'help'  => 'This text will be shown wherever there is a read more link'
						),
					)
				),

			)
		),
		'documentation' => array(
			'title' => 'Documentation',
			'icon' =>  EB_ADMIN_THEME_URL . '/img/groups/documentation.png',
			'tabs' => array (
				'videos' => array(
					'guid' => 'videos',
					'tab_title' => 'Videos',
					'items' => array(
						'documentation_videos' => array(
							'guid' => 'documentation_videos',
							'nolabel' => true,
							'nohelp' => true,
							'control' => array(
								'type' => 'custom',
								'function' => 'tbs_docs',
								'default' => false,
								'allow_empty' => false
							),
						),
					)
				),
				'readme' => array(
					'guid' => 'readme',
					'tab_title' => 'Readme',
					'items' => array(
						'readme' => array(
							'guid' => 'readme',
							'nolabel' => true,
							'nohelp' => true,
							'control' => array(
								'type' => 'custom',
								'function' => 'tbs_readme',
								'default' => false,
								'allow_empty' => false
							),
						),
					)
				),

			)
		),

		'reset' => array(
			'title' => 'Factory Reset',
			'icon' =>  EB_ADMIN_THEME_URL . '/img/groups/reset.png',
			'tabs' => array (
				'Factory Reset' => array(
					'guid' => 'reset',
					'tab_title' => 'Factory Reset',
					'items' => array(
						'documentation' => array(
							'guid' => 'reset',
							'nolabel' => true,
							'nohelp' => true,
							'control' => array(
								'type' => 'reset',
								'default' => false,
								'allow_empty' => false
							),
						),
					)
				),
			)
		),
	)

);

?>
