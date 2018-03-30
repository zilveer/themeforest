<?php

/*-----------------------------------------------------------------------------------*/
/*	Accordions
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['accordions'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[accordions] {{child_shortcode}}  [/accordions]',
	'popup_title' => __('Insert Accordions Shortcode', 'TR'),

	'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Accordion Title',
                'type' => 'text',
                'label' => __('Title', 'TR'),
                'desc' => __('Title of the accordion.', 'TR')
            ),
			'active' => array(
				'type' => 'select',
				'label' => __('Active', 'TR'),
				'desc' => __('Select the status of the accordion.', 'TR'),
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No'
				)
			),
            'content' => array(
                'std' => 'Accordion Content',
                'type' => 'textarea',
                'label' => __('Accordion Content', 'TR'),
                'desc' => __('Add the accordions content', 'TR')
            )
        ),
        'shortcode' => '[accordion title="{{title}}" active="{{active}}"] {{content}} [/accordion]',
        'clone_button' => __('Add Accordion', 'TR')
    )
);



/*-----------------------------------------------------------------------------------*/
/*	Box
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['box'] = array(
	'no_preview' => true,
	'params' => array(
		 'style' => array(
			'type' => 'select',
			'label' => __('Style', 'TR'),
			'desc' => __('Select the style for the box.', 'TR'),
			'options' => array(
				'alert' => 'Alert',
				'error' => 'Error',
				'success' => 'Success'
			)
		 ),
		 'content' => array(
			'std' => 'This is the description text for the box.',
			'type' => 'textarea',
			'label' => __('Description', 'TR'),
			'desc' => __('Enter the description for box, you can add the text with html tags.', 'TR')
		 )
	),
	'shortcode' => '[box style="{{style}}"]{{content}}[/box]',
	'popup_title' => __('Insert Box Shortcode', 'TR')
);


/*-----------------------------------------------------------------------------------*/
/*	Button
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(
		 'color' => array(
			'type' => 'select',
			'label' => __('Color', 'TR'),
			'desc' => __('Select the color for the button.', 'TR'),
			'options' => array(
				'black' => 'Black',
				'blue' => 'Blue',
				'gray' => 'Gray',
				'green' => 'Green',
				'orange' => 'Orange',
				'pink' => 'Pink',
				'purple' => 'Purple',
				'yellow' => 'Yellow'
			)
		 ),
		 'text' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Button Text', 'TR'),
			'desc' => __('Text of the button.', 'TR')
		 ),
		  'link' => array(
			'std' => 'http://google.com',
			'type' => 'text',
			'label' => __('Link Url', 'TR'),
			'desc' => __('The url of link.', 'TR')
		 ),
		 'target' => array(
			'type' => 'select',
			'label' => __('Button Target', 'TR'),
			'desc' => __('self = open in same window. blank = open in new window', 'TR'),
			'options' => array(
				'_self' => 'Self',
				'_blank' => 'Blank'
			)
		)
	),
	'shortcode' => '[button color="{{color}}" text="{{text}}" link={{link}} target="{{target}}"]',
	'popup_title' => __('Insert Button Shortcode', 'TR')
);



/*-----------------------------------------------------------------------------------*/
/*	Br
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['br'] = array(
	'no_preview' => true,
	'params' => array(
		 'top' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __('Margin Top', 'TR'),
			'desc' => __('Set the number for margin top.', 'TR')
		 )
	),
	'shortcode' => '[br top="{{top}}"]',
	'popup_title' => __('Insert Br Shortcode', 'TR')
);



/*-----------------------------------------------------------------------------------*/
/*	Column
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['column'] = array(
	'params' => array(),
    'no_preview' => true,
    'shortcode' => '{{child_shortcode}}',
    'popup_title' => __('Insert Column Shortcode', 'TR'),

	'child_shortcode' => array(
        'params' => array(
            'col' => array(
                'type' => 'select',
				'label' => __('Column Type', 'textdomain'),
				'desc' => __('Select the type, ie width of the column.', 'textdomain'),
				'options' => array(
					'1/2' => 'One Half',
					'1/3' => 'One Third',
					'2/3' => 'Two Thirds',
					'1/4' => 'One Fourth',
					'3/4' => 'Three Fourth',
				)
            ),
			'last' => array(
                'type' => 'select',
				'label' => __('Last', 'TR'),
				'desc' => __('if this the last column, please select yes.', 'TR'),
				'options' => array(
					'no' => 'No',
					'yes' => 'Yes'
				)
            ),
            'content' => array(
                'std' => '',
                'type' => 'textarea',
				'label' => __('Column Content', 'TR'),
				'desc' => __('Add the column content.', 'TR'),
            )
        ),
        'shortcode' => '[column col="{{col}}" last="{{last}}"] {{content}} [/column]',
        'clone_button' => __('Add Column', 'TR')
    )
);



/*-----------------------------------------------------------------------------------*/
/*	Gallery
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['gallery'] = array(
	'no_preview' => true,
	'params' => array(
		 'columns' => array(
			'std' => '4',
			'type' => 'text',
			'label' => __('Columns', 'TR'),
			'desc' => __('Set the number for columns.', 'TR')
		 )
	),
	'shortcode' => '[gallery columns="{{columns}}"]',
	'popup_title' => __('Insert Gallery Shortcode', 'TR')
);



/*-----------------------------------------------------------------------------------*/
/*	Hr
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['hr'] = array(
	'no_preview' => true,
	'params' => array(
		 'top' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __('Margin Top', 'TR'),
			'desc' => __('Set the number for margin top.', 'TR')
		 ),
		 'bottom' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __('Margin Bottom', 'TR'),
			'desc' => __('Set the number for margin bottom.', 'TR')
		 )
	),
	'shortcode' => '[hr top="{{top}}" bottom="{{bottom}}"]',
	'popup_title' => __('Insert Hr Shortcode', 'TR')
);


/*-----------------------------------------------------------------------------------*/
/*	Icon box
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['icon_box'] = array(
	'no_preview' => true,
	'params' => array(
		 'title' => array(
			'std' => 'The Icon Title',
			'type' => 'text',
			'label' => __('Title', 'TR'),
			'desc' => __('Title of the icon box.', 'TR')
		 ),
		 'icon' => array(
			'type' => 'select',
			'label' => __('Icon', 'TR'),
			'desc' => __('Select the icon for the box.', 'TR'),
			'options' => array(
				'add_link.png' => 'Add link',
				'add_list.png' => 'Add list',
				'advertising.png' => 'Advertising',
				'attach.png' => 'Attach',
				'bar.png' => 'Bar',
				'bell.png' => 'Bell',
				'bg_color.png' => 'Bg color',
				'bill.png' => 'Bill',
				'billing.png' => 'Billing',
				'bug.png' => 'Bug',
				'cafe.png' => 'Cafe',
				'cards.png' => 'Cards',
				'carrot.png' => 'Carrot',
				'checkout.png' => 'Checkout',
				'cheese.png' => 'Cheese',
				'chip.png' => 'Chip',
				'cllipboard.png' => 'Cllipboard',
				'coins.png' => 'Coins',
				'compass.png' => 'Compass',
				'cooker_hood.png' => 'Cooker hood',
				'delete.png' => 'Delete',
				'delivery.png' => 'Delivery',
				'dossier.png' => 'Dossier',
				'drama.png' => 'Drama',
				'edit.png' => 'Edit',
				'electro_devices.png' => 'Electro Devices',
				'ethernet_on.png' => 'Ethernet On',
				'expensive.png' => 'Expensive',
				'fantasy.png' => 'Fantasy',
				'forrst.png' => 'Forrst'
			)
		 ),
		 'link' => array(
			'std' => 'http://google.com',
			'type' => 'text',
			'label' => __('Link', 'TR'),
			'desc' => __('Link of the icon box.', 'TR')
		 ),
		 'show_button' => array(
                'type' => 'select',
				'label' => __('Show Button', 'TR'),
				'desc' => __('if you want to show the button, please select yes.', 'TR'),
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No'
				)
		 ),
		 'button_text' => array(
			'std' => 'Read More',
			'type' => 'text',
			'label' => __('Button Text', 'TR'),
			'desc' => __('Button Text of the icon box.', 'TR')
		 ),
		 'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Column Content', 'TR'),
			'desc' => __('Add the column content.', 'TR'),
		)
	),
	'shortcode' => '[icon_box title="{{title}}" icon="{{icon}}" link="{{link}}" show_button="{{show_button}}" button_text="{{button_text}}"] {{content}} [/icon_box]',
	'popup_title' => __('Insert Icon Box Shortcode', 'TR')
);



/*-----------------------------------------------------------------------------------*/
/*	Map
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['map'] = array(
	'no_preview' => true,
	'params' => array(
		 'height' => array(
			'std' => '300',
			'type' => 'text',
			'label' => __('Height', 'TR'),
			'desc' => __('Height for the map.', 'TR')
		 ),
		 'zoom' => array(
			'std' => '8',
			'type' => 'text',
			'label' => __('Zoom', 'TR'),
			'desc' => __('Zoom for the map.', 'TR')
		 ),
		 'lat' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __('Lat', 'TR'),
			'desc' => __('Lat for the map.', 'TR')
		 ),
		 'Ing' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __('Lng', 'TR'),
			'desc' => __('Lng for the map.', 'TR')
		 ),
		 'address' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('address', 'TR'),
			'desc' => __('Address for the map.', 'TR')
		 )
	),
	'shortcode' => '[map height="{{height}}" zoom="{{zoom}}" lat="{{lat}}" Ing="{{Ing}}" address="{{address}}"]',
	'popup_title' => __('Insert Map Shortcode', 'TR')
);



/*-----------------------------------------------------------------------------------*/
/*	Portfolio
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['portfolio'] = array(
	'no_preview' => true,
	'params' => array(
		 'column' => array(
			'type' => 'select',
			'label' => __('Column', 'TR'),
			'desc' => __('Select the column for the ajax portfolio.', 'TR'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4'
			)
		 ),
		 'posts_per_page' => array(
			'std' => '8',
			'type' => 'text',
			'label' => __('Posts per page', 'TR'),
			'desc' => __('Set how many items do you want to display.', 'TR')
		 ),
		  'cat' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Cat', 'TR'),
			'desc' => __('Enter the cat ids that you want to display, separated by commas, leave it as blank to display all.', 'TR')
		 )
	),
	'shortcode' => '[portfolio column="{{column}}" posts_per_page="{{posts_per_page}}" cat="{{cat}}"]',
	'popup_title' => __('Insert Portfolio Shortcode', 'TR')
);




/*-----------------------------------------------------------------------------------*/
/*	Portfolio Slide
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['portfolio_slide'] = array(
	'no_preview' => true,
	'params' => array(
		 'title' => array(
			'std' => 'Recent Works',
			'type' => 'text',
			'label' => __('Title', 'TR'),
			'desc' => __('Title of the portfolio desc.', 'TR')
		 ),
		 'posts_per_page' => array(
			'std' => '8',
			'type' => 'text',
			'label' => __('Posts per page', 'TR'),
			'desc' => __('Set how many items do you want to display.', 'TR')
		 ),
		  'cat' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Cat', 'TR'),
			'desc' => __('Enter the cat ids that you want to display, separated by commas, leave it as blank to display all.', 'TR')
		 )
	),
	'shortcode' => '[portfolio_slide title="{{title}}" posts_per_page="{{posts_per_page}}" cat="{{cat}}"]',
	'popup_title' => __('Insert Portfolio Slide Shortcode', 'TR')
);



/*-----------------------------------------------------------------------------------*/
/*	Product Slide
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['product_slide'] = array(
	'no_preview' => true,
	'params' => array(
		 'title' => array(
			'std' => 'Recent Products',
			'type' => 'text',
			'label' => __('Title', 'TR'),
			'desc' => __('Title of the product desc.', 'TR')
		 ),
		 'posts_per_page' => array(
			'std' => '8',
			'type' => 'text',
			'label' => __('Posts per page', 'TR'),
			'desc' => __('Set how many items do you want to display.', 'TR')
		 ),
		  'cat' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Cat', 'TR'),
			'desc' => __('Enter the cat ids that you want to display, separated by commas, leave it as blank to display all.', 'TR')
		 )
	),
	'shortcode' => '[product_slide title="{{title}}" posts_per_page="{{posts_per_page}}" cat="{{cat}}"]',
	'popup_title' => __('Insert Product Slide Shortcode', 'TR')
);




/*-----------------------------------------------------------------------------------*/
/*	Blog Slide
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['blog_slide'] = array(
	'no_preview' => true,
	'params' => array(
		 'title' => array(
			'std' => 'Recent News',
			'type' => 'text',
			'label' => __('Title', 'TR'),
			'desc' => __('Title of the blog desc.', 'TR')
		 ),
		 'posts_per_page' => array(
			'std' => '8',
			'type' => 'text',
			'label' => __('Posts per page', 'TR'),
			'desc' => __('Set how many items do you want to display.', 'TR')
		 ),
		  'cat' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Cat', 'TR'),
			'desc' => __('Enter the cat ids that you want to display, separated by commas, leave it as blank to display all.', 'TR')
		 )
	),
	'shortcode' => '[blog_slide title="{{title}}" posts_per_page="{{posts_per_page}}" cat="{{cat}}"]',
	'popup_title' => __('Insert Blog Slide Shortcode', 'TR')
);




/*-----------------------------------------------------------------------------------*/
/*	Price Table
/*-----------------------------------------------------------------------------------*/
$zilla_shortcodes['price_tables'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[price_tables] {{child_shortcode}}  [/price_tables]',
	'popup_title' => __('Insert Price Tables Shortcode', 'TR'),

	'child_shortcode' => array(
        'params' => array(
            'title' => array(
				'type' => 'text',
				'label' => __('Title', 'TR'),
				'desc' => __('Add the title for the price item.', 'TR'),
				'std' => 'Your title'
			),
			'currency' => array(
				'type' => 'text',
				'label' => __('Currency', 'TR'),
				'desc' => __('Add the currency for price item', 'TR'),
				'std' => '$'
			),
			'price' => array(
				'type' => 'text',
				'label' => __('Price', 'TR'),
				'desc' => __('Add the price for price item', 'TR'),
				'std' => '50'
			),
			'time' => array(
				'type' => 'text',
				'label' => __('Time', 'TR'),
				'desc' => __('Add the time for price item', 'TR'),
				'std' => 'month'
			),
			'button' => array(
				'type' => 'text',
				'label' => __('Button Text', 'TR'),
				'desc' => __('Add the button text for price item', 'TR'),
				'std' => 'Button Text'
			),
			'button_url' => array(
				'type' => 'text',
				'label' => __('Button Url', 'TR'),
				'desc' => __('Add the button url for price item', 'TR'),
				'std' => 'http://google.com'
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Tab Content', 'TR'),
				'desc' => __('Add the tab content.', 'TR'),
			)
        ),
        'shortcode' => '[price_table title="{{title}}" currency="{{currency}}" price="{{price}}" time="{{time}}" button="{{button}}" button_url="{{button_url}}"] {{content}} [/price_table]',
        'clone_button' => __('Add Table', 'TR')
    )
);




/*-----------------------------------------------------------------------------------*/
/*	Slogan
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['slogan'] = array(
	'no_preview' => true,
	'params' => array(
		 'dotted_line' => array(
			'type' => 'select',
			'label' => __('Dotted Line', 'TR'),
			'desc' => __('Select the dotted line for the slogan.', 'TR'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		 ),
		 'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Slogan Content', 'TR'),
			'desc' => __('Add the slogan content.', 'TR'),
		)
	),
	'shortcode' => '[slogan dotted_line="{{dotted_line}}"] {{content}} [/slogan]',
	'popup_title' => __('Insert Slogan Shortcode', 'TR')
);



/*-----------------------------------------------------------------------------------*/
/*	Tabs
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['tabs'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[tabs] {{child_shortcode}}  [/tabs]',
	'popup_title' => __('Insert Tabs Shortcode', 'TR'),

	'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Tab Title',
                'type' => 'text',
                'label' => __('Title', 'TR'),
                'desc' => __('Title of the tab.', 'TR')
            ),
            'content' => array(
                'std' => 'Tab Content',
                'type' => 'textarea',
                'label' => __('Tab Content', 'TR'),
                'desc' => __('Add the Tab content', 'TR')
            )
        ),
        'shortcode' => '[tab title="{{title}}"] {{content}} [/tab]',
        'clone_button' => __('Add Tab', 'TR')
    )
);



/*-----------------------------------------------------------------------------------*/
/*	Toggles
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['toggles'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[toggles] {{child_shortcode}}  [/toggles]',
	'popup_title' => __('Insert Toggles Shortcode', 'TR'),

	'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Toggle Title',
                'type' => 'text',
                'label' => __('Title', 'TR'),
                'desc' => __('Title of the toggle.', 'TR')
            ),
			'active' => array(
				'type' => 'select',
				'label' => __('Active', 'TR'),
				'desc' => __('Select the status of the toggle.', 'TR'),
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No'
				)
			),
            'content' => array(
                'std' => 'Toggle Content',
                'type' => 'textarea',
                'label' => __('Toggle Content', 'TR'),
                'desc' => __('Add the Toggle content', 'TR')
            )
        ),
        'shortcode' => '[toggle title="{{title}}" active="{{active}}"] {{content}} [/toggle]',
        'clone_button' => __('Add Tab', 'TR')
    )
);




/*-----------------------------------------------------------------------------------*/
/*	Video
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['video'] = array(
	'no_preview' => true,
	'params' => array(
		 'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width', 'TR'),
			'desc' => __('The video width.', 'TR')
		 ),
		 'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Height', 'TR'),
			'desc' => __('The video height (e.g. 380), if you leave it as blank, it will display the video with 16:9.', 'TR')
		 ),
		 'ogv' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Ogv', 'TR'),
			'desc' => __('The URL to the .ogv video file.', 'TR')
		 ),
		 'mp4' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Mp4', 'TR'),
			'desc' => __('The URL to the .mp4 video file.', 'TR')
		 ),
		 'webm' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Webm', 'TR'),
			'desc' => __('The URL to the .webm video file.', 'TR')
		 ),
		  'poster_image' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Poster Image', 'TR'),
			'desc' => __('The preivew image.', 'TR')
		 )
	),
	'shortcode' => '[video width="{{width}}" height="{{height}}" ogv="{{ogv}}" mp4="{{mp4}}" webm="{{webm}}" poster_image="{{poster_image}}"]',
	'popup_title' => __('Insert Video Shortcode', 'TR')
);



/*-----------------------------------------------------------------------------------*/
/*	Youtube
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' => array(
		 'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('ID', 'TR'),
			'desc' => __('The id of youtube.', 'TR')
		 ),
		 'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width', 'TR'),
			'desc' => __('The video width.', 'TR')
		 ),
		 'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Height', 'TR'),
			'desc' => __('The video height (e.g. 380), if you leave it as blank, it will display the video with 16:9.', 'TR')
		 )
	),
	'shortcode' => '[youtube id="{{id}}" width="{{width}}" height="{{height}}"]',
	'popup_title' => __('Insert Youtube Shortcode', 'TR')
);



/*-----------------------------------------------------------------------------------*/
/*	Vimeo
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' => array(
		 'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('ID', 'TR'),
			'desc' => __('The id of vimeo.', 'TR')
		 ),
		 'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width', 'TR'),
			'desc' => __('The video width.', 'TR')
		 ),
		 'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Height', 'TR'),
			'desc' => __('The video height (e.g. 380), if you leave it as blank, it will display the video with 16:9.', 'TR')
		 )
	),
	'shortcode' => '[vimeo id="{{id}}" width="{{width}}" height="{{height}}"]',
	'popup_title' => __('Insert Vimeo Shortcode', 'TR')
);
?>