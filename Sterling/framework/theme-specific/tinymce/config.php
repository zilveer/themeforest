<?php
/*---------------------------------------*/
/* Accordions
/*---------------------------------------*/
$tt_shortcodes['accordions'] = array(
	'params' => array(),
	'shortcode' => '[accordion_set] {{child_shortcode}}[/accordion_set]',
	'no_preview' => true,
	
	// can be cloned and re-arranged
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'type' => 'text',
				'label' => __('Accordion Title', 'tt_theme_framework'),
				'desc' => __('Add a title for this accordion section.', 'tt_theme_framework'),
				'std' => ''
			),
			
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Accordion Content', 'tt_theme_framework'),
				'desc' => __('Enter the content for this accordion section.', 'tt_theme_framework'),
			),
			
			'active' => array(
			'type' => 'select',
			'label' => __('Active Accordion?', 'tt_theme_framework'),
			'desc' => __('Should this accordion section be active by default?', 'tt_theme_framework'),
			'options' => array(
				'no' => 'No',
				'yes' => 'Yes',
			)),
		),
		'shortcode' => '[accordion title="{{title}}" active="{{active}}"] {{content}} [/accordion] ',
		'clone_button' => __('+ Add Another Accordion Slide', 'tt_theme_framework')
	)
);



/*---------------------------------------*/
/* Buttons
/*---------------------------------------*/
$tt_shortcodes['button'] = array(
	'params' => array(
		'size' => array(
			'type' => 'select',
			'label' => __('Button Size', 'tt_theme_framework'),
			'options' => array(
				'small' => 'Small',
				'large' => 'Large',
				'jumbo' => 'Jumbo'
			)
		),
		
		'color' => array(
			'type' => 'select',
			'label' => __('Button Color', 'tt_theme_framework'),
			'options' => array(
				'autumn' => 'Autumn',
				'black' => 'Black',
				'black-2' => 'Black 2',
				'blue' => 'Blue',
				'blue-grey' => 'Blue Grey',
				'cool-blue' => 'Cool Blue',
				'coffee' => 'Coffee',
				'fire' => 'Fire',
				'golden' => 'Golden',
				'green' => 'Green',
				'green-2' => 'Green 2',
				'grey' => 'Grey',
				'lime-green' => 'Lime Green',
				'navy' => 'Navy',
				'orange' => 'Orange',
				'periwinkle' => 'Periwinkle',
				'pink' => 'Pink',
				'purple' => 'Purple',
				'purple-2' => 'Purple 2',
				'red' => 'Red',
				'red-2' => 'Red 2',
				'royal-blue' => 'Royal Blue',
				'silver' => 'Silver',
				'sky-blue' => 'Sky Blue',
				'teal-grey' => 'Teal Grey',
				'teal' => 'Teal',
				'teal-2' => 'Teal 2',
				'white' => 'White',
			)
		),
		
		'content' => array(
			'std' => 'Button Label',
			'type' => 'text',
			'label' => __('Button Label', 'tt_theme_framework'),
	),
	
	'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'tt_theme_framework'),
			'desc' => __('Enter the URL for this button. <em>(ie. http://www.google.com)</em>', 'tt_theme_framework')
		),
		
		'target' => array(
			'type' => 'select',
			'label' => __('Button Target', 'tt_theme_framework'),
			'options' => array(
				'_self' => '_self',
				'_parent' => '_parent',
				'_blank' => '_blank',
				'_top' => '_top',
			)),
			
			'button_lightbox_content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Content', 'tt_theme_framework'),
			'desc' => __('Use this section to link this button to a Lightbox. Enter the full URL to the lightbox content. <a href="https://s3.amazonaws.com/Plugin-Vision/lightbox-samples.html" target="_blank">Lightbox content samples &rarr;</a><br /><em>(Simply ignore if you do not wish to open any content in a Lightbox)</em>', 'tt_theme_framework')
	),
	
	'button_lightbox_description' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Description', 'tt_theme_framework'),
			'desc' => __('This descriptive text is displayed within the Lightbox.', 'tt_theme_framework')
	),
),
		
	'shortcode' => '[button url="{{url}}" class="button" size="{{size}}" color="{{color}}" target="{{target}}" lightbox_content="{{button_lightbox_content}}" lightbox_description="{{button_lightbox_description}}"] {{content}} [/button]',
);


/*---------------------------------------*/
/* Blog Posts
/*---------------------------------------*/
$tt_shortcodes['blog-posts'] = array(
	'no_preview' => true,
	'params' => array(
		
		'count' => array(
			'type' => 'text',
			'std' => '3',
			'label' => __('Post Count', 'tt_theme_framework'),
			'desc' => __('Enter the amount of posts you would like to display.', 'tt_theme_framework'),
		),
		
		'charactercount' => array(
			'type' => 'text',
			'std' => '115',
			'label' => __('Character Count', 'tt_theme_framework'),
			'desc' => __('Enter the amount of characters you would like to display for each blog post preview.', 'tt_theme_framework'),
		),
		
		
		'postcategory' => array(
			'type' => 'text',
			'label' => __('Post Category(s)', 'tt_theme_framework'),
			'desc' => __('Enter the post category(s) that you would like to display', 'tt_theme_framework'),
		),
	),
		
	'shortcode' => '[blog_posts count ="{{count}}" character_count="{{charactercount}}" post_category="{{postcategory}}"]',
);


/*---------------------------------------*/
/* Columns
/*---------------------------------------*/
$tt_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ',
	'no_preview' => true,
	
	
	// can be cloned and re-arrange
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'tt_theme_framework'),
				'desc' => '',
				'options' => array(
					'one_half' => 'One Half',
					'one_third' => 'One Third',
					'one_fourth' => 'One Fourth',
					'one_fifth' => 'One Fifth',				
					'two_thirds' => 'Two Thirds',
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', 'tt_theme_framework'),
				'desc' => '(you can also leave this field blank and insert the content later)',
			)
		),
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button' => __('+ Add Another Column', 'tt_theme_framework')
	)
);


/*---------------------------------------*/
/* Content Boxes
/*---------------------------------------*/
$tt_shortcodes['content-boxes'] = array(
	'params' => array(		
		'style' => array(
			'type' => 'select',
			'label' => __('Color', 'tt_theme_framework'),
			'options' => array(
				'autumn' => 'Autumn',
				'black' => 'Black',
				'black-2' => 'Black 2',
				'blue' => 'Blue',
				'blue-grey' => 'Blue Grey',
				'cool-blue' => 'Cool Blue',
				'coffee' => 'Coffee',
				'fire' => 'Fire',
				'golden' => 'Golden',
				'green' => 'Green',
				'green-2' => 'Green 2',
				'grey' => 'Grey',
				'lime-green' => 'Lime Green',
				'navy' => 'Navy',
				'orange' => 'Orange',
				'periwinkle' => 'Periwinkle',
				'pink' => 'Pink',
				'purple' => 'Purple',
				'purple-2' => 'Purple 2',
				'red' => 'Red',
				'red-2' => 'Red 2',
				'royal-blue' => 'Royal Blue',
				'silver' => 'Silver',
				'sky-blue' => 'Sky Blue',
				'teal-grey' => 'Teal Grey',
				'teal' => 'Teal',
				'teal-2' => 'Teal 2',
			)
		),
		
		
		'title' => array(
				'std' => __('Content box title', 'tt_theme_framework'),
				'type' => 'text',
				'label' => __('Title', 'tt_theme_framework'),
			),
		
		
		
		'content' => array(
				'std' => __('Awesome content goes here.', 'tt_theme_framework'),
				'type' => 'textarea',
				'label' => __('Content', 'tt_theme_framework'),
			)),
		
	'shortcode' => '[content_box style="{{style}}" title="{{title}}"] <p>{{content}}</p> [/content_box]',
);



/*---------------------------------------*/
/* Dividers
/*---------------------------------------*/
$tt_shortcodes['dividers'] = array(
	'params' => array(
		'divider_style' => array(
			'type' => 'select',
			'label' => __('Divider Style', 'tt_theme_framework'),
			'desc' => __('Select the divider style that you\'d like to insert.', 'tt_theme_framework'),
			'options' => array(
				'hr-dotted' => 'Dotted - Single line',
				'hr-dotted-double' => 'Dotted - Double line',
				'hr-solid' => 'Solid - Single line',
				'hr-solid-double' => 'Solid - Double line',
			)
		),
	),
		
	'shortcode' => '[divider style="{{divider_style}}"]',
);




/*---------------------------------------*/
/* Dropcaps
/*---------------------------------------*/
$tt_shortcodes['dropcaps'] = array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Style', 'tt_theme_framework'),
			'options' => array(
				'round' => 'Round',
				'square' => 'Square',
				'text' => 'Text',
			)
		),
		
		'color' => array(
			'type' => 'select',
			'label' => __('Color', 'tt_theme_framework'),
			'options' => array(
				'autumn' => 'Autumn',
				'black' => 'Black',
				'black-2' => 'Black 2',
				'blue' => 'Blue',
				'blue-grey' => 'Blue Grey',
				'cool-blue' => 'Cool Blue',
				'coffee' => 'Coffee',
				'fire' => 'Fire',
				'golden' => 'Golden',
				'green' => 'Green',
				'green-2' => 'Green 2',
				'grey' => 'Grey',
				'lime-green' => 'Lime Green',
				'navy' => 'Navy',
				'orange' => 'Orange',
				'periwinkle' => 'Periwinkle',
				'pink' => 'Pink',
				'purple' => 'Purple',
				'purple-2' => 'Purple 2',
				'red' => 'Red',
				'red-2' => 'Red 2',
				'royal-blue' => 'Royal Blue',
				'silver' => 'Silver',
				'sky-blue' => 'Sky Blue',
				'teal-grey' => 'Teal Grey',
				'teal' => 'Teal',
				'teal-2' => 'Teal 2',
			)
		),
		
	'content' => array(
				'std' => __('1', 'tt_theme_framework'),
				'type' => 'textarea',
				'label' => __('Content', 'tt_theme_framework'),
			)),
		
	'shortcode' => '[dropcap style="{{style}}" color="{{color}}"]{{content}}[/dropcap]',
);



/*---------------------------------------*/
/* Email Encoder
/*---------------------------------------*/
$tt_shortcodes['mailto'] = array(
	'no_preview' => true,
	'params' => array(
		
		'email' => array(
				'std' => 'you@yourdomain.com',
				'type' => 'text',
				'label' => __('Email Address', 'tt_theme_framework'),
				'desc' => __('Enter the email address to be encoded.', 'tt_theme_framework'),
			)),
		
	'shortcode' => '[mailto]{{email}}[/mailto]',
);

/*---------------------------------------*/
/* Font Awesome - Vector Icons
/*---------------------------------------*/
$tt_shortcodes['vector-icons'] = array(
	'params' => array(
		
		'icon' => array(
			'std'   => 'fa-thumbs-up',
			'type'  => 'text',
			'label' => __('Icon', 'framework_localize'),
			'desc'  => __('Enter the name of the icon you\'d like to use.<br /><a href="http://fortawesome.github.io/Font-Awesome/icons" target="_blank">List of available icons &rarr;</a>', 'framework_localize')
		),


		'size' => array(
			'std'     => 'fa-3x',
			'type'    => 'select',
			'label'   => __('Size', 'framework_localize'),
			'options' => array(
				'fa-3x' => 'fa-3x',
				'fa-4x' => 'fa-4x',
				'fa-5x' => 'fa-5x',
			)),

		'border' => array(
			'std'     => 'false',
			'type'    => 'select',
			'label'   => __('Border', 'framework_localize'),
			'options' => array(
				'false' => 'false',
				'true'  => 'true',
			)),

		/* color breaks the live preview - maybe solution in the future
		'color' => array(
			'std'   => '',
			'type'  => 'text',
			'label' => __('Color', 'framework_localize'),
			'desc'  => __('Enter a custom color for this icon. Example: #999999', 'framework_localize')
		)
		*/

		'pull' => array(
			'std'   => '',
			'type'  => 'text',
			'label' => __('Pull', 'framework_localize'),
			'desc'  => __('pull-left or pull-right (or leave blank)', 'framework_localize')
		),

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Link URL', 'framework_localize'),
			'desc' => __('Enter a URL or leave blank to disable linking.<br />ie. http://www.yoursite.com/awesome-page', 'framework_localize')
		),
		
		'target' => array(
			'std' => '_self',
			'type' => 'select',
			'label' => __('Link Target', 'framework_localize'),
			'options' => array(
				'_self' => '_self',
				'_parent' => '_parent',
				'_blank' => '_blank',
				'_top' => '_top',
			)),

'icon_lightbox_content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Content', 'framework_localize'),
			'desc' => __('Enter content URL or leave blank to disable lightbox.<br /><a href="https://s3.amazonaws.com/Plugin-Vision/lightbox-samples.html" target="_blank">Lightbox content samples &rarr;</a>', 'framework_localize')
	),
	
	'icon_lightbox_description' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Text', 'framework_localize'),
			'desc' => __('Short description displayed within the lightbox.', 'framework_localize')
	),		
),
		
	'shortcode' => '[tt_vector icon="{{icon}}" size="{{size}}" border="{{border}}" color="" url="{{url}}" target="{{target}}" pull="{{pull}}" lightbox_content="{{icon_lightbox_content}}" lightbox_description="{{icon_lightbox_description}}"]',
);





/*---------------------------------------*/
/* Font Awesome - Vector Icon Boxes
/*---------------------------------------*/
$tt_shortcodes['vector-icon-boxes'] = array(
	'params' => array(
		
		'icon' => array(
			'std'   => 'fa-thumbs-up',
			'type'  => 'text',
			'label' => __('Icon', 'framework_localize'),
			'desc'  => __('Enter the name of the icon you\'d like to use.<br /><a href="http://fortawesome.github.io/Font-Awesome/icons" target="_blank">List of available icons &rarr;</a>', 'framework_localize')
		),

	'size' => array(
			'std'     => 'fa-4x',
			'type'    => 'select',
			'label'   => __('Size', 'framework_localize'),
			'options' => array(
				'fa-4x' => 'fa-4x',
				'fa-5x' => 'fa-5x',
			)),

	/*
	'content' => array(
				'std' => __('<h3>Heading goes here</h3> Content goes here.', 'framework_localize'),
				'type' => 'textarea',
				'label' => __('Content', 'framework_localize'),
		),
	*/

	'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Link URL', 'framework_localize'),
			'desc' => __('Enter a URL or leave blank to disable linking.<br />ie. http://www.yoursite.com/awesome-page', 'framework_localize')
		),
		
	'target' => array(
			'std' => '',
			'type' => 'select',
			'label' => __('Link Target', 'framework_localize'),
			'options' => array(
				'_self' => '_self',
				'_parent' => '_parent',
				'_blank' => '_blank',
				'_top' => '_top',
			)),

'icon_lightbox_content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Content', 'framework_localize'),
			'desc' => __('Enter content URL or leave blank to disable lightbox.<br /><a href="https://s3.amazonaws.com/Plugin-Vision/lightbox-samples.html" target="_blank">Lightbox content samples &rarr;</a>', 'framework_localize')
	),
	
	'icon_lightbox_description' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Text', 'framework_localize'),
			'desc' => __('Short description displayed within the lightbox.', 'framework_localize')
	)),
		
	'shortcode' => '[tt_vector_box icon="{{icon}}" size="{{size}}" color="" url="{{url}}" target="{{target}}" lightbox_content="{{icon_lightbox_content}}" lightbox_description="{{icon_lightbox_description}}"]....add H3 heading and Content after inserting shortcode.[/tt_vector_box]'
);


/*---------------------------------------*/
/* Highlight Text
/*---------------------------------------*/
$tt_shortcodes['highlight'] = array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Style', 'tt_theme_framework'),
			'options' => array(
				'style-1' => 'Style 1',
				'style-2' => 'Style 2',
			)
		),
		
		'color' => array(
			'type' => 'select',
			'label' => __('Color', 'tt_theme_framework'),
			'options' => array(
				'autumn' => 'Autumn',
				'black' => 'Black',
				'blue-grey' => 'Blue Grey',
				'cool-blue' => 'Cool Blue',
				'coffee' => 'Coffee',
				'fire' => 'Fire',
				'golden' => 'Golden',
				'green' => 'Green',
				'lime-green' => 'Lime Green',
				'periwinkle' => 'Periwinkle',
				'pink' => 'Pink',
				'purple' => 'Purple',
				'red' => 'Red',
				'royal-blue' => 'Royal Blue',
				'silver' => 'Silver',
				'sky-blue' => 'Sky Blue',
				'teal-grey' => 'Teal Grey',
				'teal' => 'Teal',
				
			)
		),
		
		'content' => array(
				'std' => __('This text is highlighted', 'tt_theme_framework'),
				'type' => 'textarea',
				'label' => __('Content', 'tt_theme_framework'),
			)),
		
	'shortcode' => '[highlight color="{{color}}" style="{{style}}"]{{content}}[/highlight]',
);



/*---------------------------------------*/
/* Icons
/*---------------------------------------*/
$tt_shortcodes['icons'] = array(
	'params' => array(
		
		'style' => array(
			'type' => 'select',
			'label' => __('Icon', 'tt_theme_framework'),
			'options' => array(
				'icon-alarm' => 'Alarm',
				'icon-arrow-down-a' => 'Arrow Down',
				'icon-arrow-down-b' => 'Arrown Down 2',
				'icon-arrow-up-a' => 'Arrow Up',
				'icon-arrow-up-b' => 'Arrown Up 2',
				'icon-calculator' => 'Calculator',
				'icon-calendar-day' => 'Calendar - Day',
				'icon-calendar-month' => 'Calendar - Month',
				'icon-camera' => 'Camera',
				'icon-cart-add' => 'Cart - Ecommerce',
				'icon-caution' => 'Caution',
				'icon-cellphone' => 'Cell Phone',
				'icon-chart' => 'Chart',
				'icon-chat' => 'Chat (speech bubble)',
				'icon-chat-2' => 'Chat 2 (speech bubble)',
				'icon-checklist' => 'Checklist',
				'icon-checkmark' => 'Checkmark',
				'icon-clipboard' => 'Clipboard',
				'icon-clock' => 'Clock',
				'icon-gear' => 'Cog (sprocket)',
				'icon-contacts' => 'Contacts',
				'icon-crate' => 'Crate (wooden box)',
				'icon-database' => 'Database',
				'icon-document-edit' => 'Document edit',			
				'icon-dvd' => 'DVD',
				'icon-email-send' => 'Email',
				'icon-flag' => 'Flag',
				'icon-games' => 'Games',
				'icon-globe' => 'Globe',
				'icon-globe-download' => 'Globe - download',
				'icon-globe-upload' => 'Globe - upload',
				'icon-drive' => 'Hard Drive (HDD)',
				'icon-hdtv' => 'HDTV',
				'icon-heart' => 'Heart',		
				'icon-history' => 'History',
				'icon-home' => 'Home',
				'icon-info' => 'Info',
				'icon-laptop' => 'Laptop',
				'icon-light-on' => 'Lightbulb',
				'icon-lock-closed' => 'Lock',
				'icon-magnify' => 'Magnifying Glass',
				'icon-megaphone' => 'Megaphone',
				'icon-money' => 'Money',
				'icon-movie' => 'Movie',
				'icon-mp3' => 'MP3 Player',
				'icon-ms-word' => 'MS Word Document',
				'icon-music' => 'Music',
				'icon-network' => 'Network',
				'icon-news' => 'News',
				'icon-notebook' => 'Notebook',
				'icon-pdf' => 'PDF Document',
				'icon-photos' => 'Photos',	
				'icon-notebook' => 'Notebook',
				'icon-refresh' => 'Refresh',
				'icon-rss' => 'RSS',
				'icon-shield-blue' => 'Shield (blue)',
				'icon-shield-green' => 'Shield (green)',
				'icon-smart-phone' => 'Smartphone',
				'icon-star' => 'Star',
				'icon-support' => 'Support',	
				'icon-tools' => 'Tools',
				'icon-user-group' => 'Users',
				'icon-vcard' => 'vCard',
				'icon-video-camera' => 'Video Camera',
				'icon-x' => 'X'
			)
		),
	
	'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Icon URL', 'tt_theme_framework'),
			'desc' => __('Enter a URL or leave blank to disable linking. <em>(ie. http://www.google.com)</em>', 'tt_theme_framework')
		),
		
		
		'target' => array(
			'std' => '_self',
			'type' => 'select',
			'label' => __('Link Target', 'tt_theme_framework'),
			'options' => array(
				'_self' => '_self',
				'_parent' => '_parent',
				'_blank' => '_blank',
				'_top' => '_top',
			)),
			

'icon_lightbox_content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Content', 'tt_theme_framework'),
			'desc' => __('Use this section to link this icon to a Lightbox. Enter the full URL to the lightbox content. <a href="https://s3.amazonaws.com/Plugin-Vision/lightbox-samples.html" target="_blank">Lightbox content samples &rarr;</a><br /><em>(Simply ignore if you do not wish to open any content in a Lightbox)</em>', 'tt_theme_framework')
	),
	
	'icon_lightbox_description' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Description', 'tt_theme_framework'),
			'desc' => __('This descriptive text is displayed within the Lightbox.', 'tt_theme_framework')
	),
),
		
	'shortcode' => '[icon style="{{style}}" url="{{url}}" target="{{target}}" lightbox_content="{{icon_lightbox_content}}" lightbox_description="{{icon_lightbox_description}}"]Lorem Ipsum Dolor nulla vitae elit libero, a pharetra augue.[/icon]',
);



/*---------------------------------------*/
/* Icons - Minimal
/*---------------------------------------*/
$tt_shortcodes['icons-mono'] = array(
	'params' => array(
		
		'style' => array(
			'type' => 'select',
			'label' => __('Icon', 'tt_theme_framework'),
			'options' => array(
				'address_book' => 'Address Book',
				'alert' => 'Alert',
				'announcement' => 'Announcement',
				'calendar' => 'Calendar',
				'cog' => 'Cog',
				'comments' => 'Comments',
				'download' => 'Download',
				'edit' => 'Edit',
				'email' => 'Email',
				'file' => 'File',
				'home' => 'Home',
				'info' => 'Info',
				'movie' => 'Movie',
				'page-layout' => 'Page Layout',
				'pencil' => 'Pencil',
				'pictures' => 'Pictures',
				'restart' => 'Restart',
				'settings' => 'Settings',
				'support' => 'Support',
				'tags' => 'Tags',
				'upload' => 'Upload',
				'users' => 'Users',
				'v-card' => 'vCard',
				'zoom' => 'Zoom',
				
			)
		),
		
	
	'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Icon URL', 'tt_theme_framework'),
			'desc' => __('Enter a URL or leave blank to disable linking. <em>(ie. http://www.google.com)</em>', 'tt_theme_framework')
		),
		
		
		'target' => array(
			'std' => '_self',
			'type' => 'select',
			'label' => __('Link Target', 'tt_theme_framework'),
			'options' => array(
				'_self' => '_self',
				'_parent' => '_parent',
				'_blank' => '_blank',
				'_top' => '_top',
			)),

'icon_lightbox_content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Content', 'tt_theme_framework'),
			'desc' => __('Use this section to link this icon to a Lightbox. Enter the full URL to the lightbox content. <a href="https://s3.amazonaws.com/Plugin-Vision/lightbox-samples.html" target="_blank">Lightbox content samples &rarr;</a><br /><em>(Simply ignore if you do not wish to open any content in a Lightbox)</em>', 'tt_theme_framework')
	),
	
	'icon_lightbox_description' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Description', 'tt_theme_framework'),
			'desc' => __('This descriptive text is displayed within the Lightbox.', 'tt_theme_framework')
	),		
),
		
	'shortcode' => '[minimal_icon style="{{style}}" url="{{url}}" target="{{target}}" lightbox_content="{{icon_lightbox_content}}" lightbox_description="{{icon_lightbox_description}}"]Lorem Ipsum Dolor nulla vitae elit libero, a pharetra augue.[/minimal_icon]',
);


/*---------------------------------------*/
/* Image Frames
/*---------------------------------------*/
$tt_shortcodes['image-frames'] = array(
	'params' => array(		
		'size' => array(
			'type' => 'select',
			'label' => __('Size', 'tt_theme_framework'),
			'options' => array(
				'full-banner' => 'Full Width - Banner Frame (940 x 161)',
				'full-half' => 'Full Width - [one_half] Frame (445 x 273)',
				'full-third' => 'Full Width - [one_third] Frame (280 x 179)',
				'full-third-short' => 'Full Width - [one_third] Short Frame (280 x 124)',
				'full-fourth' => 'Full Width - [one_fourth] Frame (197 x 133)',
				'null1' => '',
				'full-third-portrait' => 'Full Width - [one_third] Portrait Frame (280 x 354)',
				'full-fourth-portrait' => 'Full Width - [one_fourth] Portrait Frame (183 x 277)',
				'null2' => '',
				'small-banner' => 'Half Width - Banner Frame (620 x 161)',
				'small-half' => 'Half Width - [one_half] Frame (300 x 186)',
				'small-third' => 'Half Width - [one_third] Frame (183 x 120)',
				'small-fourth' => 'Half Width - [one_fourth] Frame (125 x 89)',			
			)
		),
		
		
		'path' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image Path', 'tt_theme_framework'),
			'desc' => __('Enter the full URL to the image you wish to display. (the image will be automatically re-sized)', 'tt_theme_framework')
	),
	
	
	'description' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image Description', 'tt_theme_framework'),
			'desc' => __('Add descriptive text to help boost your site\'s SEO. (this is converted to an image Alt tag)', 'tt_theme_framework')
	),
	
	'link_to_page' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Link this Image', 'tt_theme_framework'),
			'desc' => __('Enter the full URL of the page you\'d like to link to. (simply leave blank to disable linking)', 'tt_theme_framework')
	),
	
	'target' => array(
			'type' => 'select',
			'label' => __('Link Target', 'tt_theme_framework'),
			'desc' => __('Select where the link should open.', 'tt_theme_framework'),
			'options' => array(
				'_self' => '_self',
				'_parent' => '_parent',
				'_blank' => '_blank',
				'_top' => '_top',
			))
	
	
	),
		
	'shortcode' => '[image_frame size="{{size}}" image_path="{{path}}" description="{{description}}" link_to_page="{{link_to_page}}" target="{{target}}"]',
	'no_preview' => true,
);


/*---------------------------------------*/
/* Lightbox Image Frames
/*---------------------------------------*/
$tt_shortcodes['lightbox-image-frames'] = array(
	'params' => array(		
		'size' => array(
			'type' => 'select',
			'label' => __('Size', 'tt_theme_framework'),
			'options' => array(
				'full-banner' => 'Full Width - Banner Frame (940 x 161)',
				'full-half' => 'Full Width - [one_half] Frame (445 x 273)',
				'full-third' => 'Full Width - [one_third] Frame (280 x 179)',
				'full-third-short' => 'Full Width - [one_third] Short Frame (280 x 124)',
				'full-fourth' => 'Full Width - [one_fourth] Frame (197 x 133)',
				'null1' => '',
				'full-third-portrait' => 'Full Width - [one_third] Portrait Frame (280 x 354)',
				'full-fourth-portrait' => 'Full Width - [one_fourth] Portrait Frame (183 x 277)',
				'null2' => '',
				'small-banner' => 'Half Width - Banner Frame (620 x 161)',
				'small-half' => 'Half Width - [one_half] Frame (300 x 186)',
				'small-third' => 'Half Width - [one_third] Frame (183 x 120)',
				'small-fourth' => 'Half Width - [one_fourth] Frame (125 x 89)',
			)
		),
		
		
		'path' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image Path', 'tt_theme_framework'),
			'desc' => __('Enter the full URL to the image you wish to display. (the image will be automatically re-sized)', 'tt_theme_framework')
	),
	
	'lightbox_content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Content', 'tt_theme_framework'),
			'desc' => __('Enter the full URL to the content you wish to display in a Lightbox.<br /><a href="http://s3.truethemes.net/plugin-assets/lightbox-samples.html" target="_blank">Lightbox content samples &rarr;</a>', 'tt_theme_framework')
	),
	
	'description' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Description', 'tt_theme_framework'),
			'desc' => __('Add descriptive text to help boost your site\'s SEO. (this is displayed within the lightbox and converted to an image Alt tag)', 'tt_theme_framework')
	),
	
	'group' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Lightbox Group', 'tt_theme_framework'),
			'desc' => __('Enter a group name if you wish to group this item with other Lightbox items. (ie. group_1). Simply leave blank if you do not wish to group this item.', 'tt_theme_framework')
	),
	
	
	),

	'shortcode' => '[lightbox_image size="{{size}}" image_path="{{path}}" lightbox_content="{{lightbox_content}}" group="{{group}}" description="{{description}}"]',
	'no_preview' => true,
);


/*---------------------------------------*/
/* Notification Boxes
/*---------------------------------------*/
$tt_shortcodes['notifications'] = array(
	'params' => array(		
		'style' => array(
			'type' => 'select',
			'label' => __('Style', 'tt_theme_framework'),
			'options' => array(
				'success' => 'Success',
				'error' => 'Error',
				'warning' => 'Warning',
				'tip' => 'Tip',
				'neutral' => 'Neutral',
			)
		),
		
		'size' => array(
			'std' => '12px',
			'type' => 'text',
			'label' => __('Font Size', 'tt_theme_framework'),
	),
	
	'closeable' => array(
			'type' => 'select',
			'label' => __('Closeable?', 'tt_theme_framework'),
			'desc' => __('Select True to make this box closeable on click.', 'tt_theme_framework'),
			'options' => array(
				'true' => 'True',
				'false' => 'False',
			)
		),
		
		'content' => array(
				'std' => 'Awesome content goes here.',
				'type' => 'textarea',
				'label' => __('Content', 'tt_theme_framework'),
			)),
		
	'shortcode' => '[notification style="{{style}}" font_size="{{size}}" closeable="{{closeable}}"] {{content}} [/notification]',
);



/*---------------------------------------*/
/* Pricing Boxes
/*---------------------------------------*/
$tt_shortcodes['pricing_box'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ',
	'no_preview' => true,
	
	// can be cloned and re-arrange
	'child_shortcode' => array(
		'params' => array(
		
	
		'style' => array(
				'type' => 'select',
				'label' => __('Design Style', 'tt_theme_framework'),
				'desc' => 'Select a design style for this pricing box.<br /><a href="http://s3.truethemes.net/plugin-assets/vision-pricing-samples.png" target="_blank">View style samples here &rarr;</a>',
				'options' => array(
					'style-1' => 'Style 1',
					'style-2' => 'Style 2',
				)
			),
		
			'column' => array(
				'type' => 'select',
				'label' => __('Width', 'tt_theme_framework'),
				'desc' => 'Select a width for this pricing box.',
				'options' => array(
					'one_half' => 'One Half',
					'one_third' => 'One Third',
					'one_fourth' => 'One Fourth',
					'one_fifth' => 'One Fifth',
				)
			),
			
			
			
		'color' => array(
			'type' => 'select',
			'label' => __('Highlight Color', 'tt_theme_framework'),
			'desc' => __('Select a highlight color for this pricing box.', 'tt_theme_framework'),
			'options' => array(
				'autumn' => 'Autumn',
				'black' => 'Black',
				'black-2' => 'Black 2',
				'blue' => 'Blue',
				'blue-grey' => 'Blue Grey',
				'cool-blue' => 'Cool Blue',
				'coffee' => 'Coffee',
				'fire' => 'Fire',
				'golden' => 'Golden',
				'green' => 'Green',
				'green-2' => 'Green 2',
				'grey' => 'Grey',
				'lime-green' => 'Lime Green',
				'navy' => 'Navy',
				'orange' => 'Orange',
				'periwinkle' => 'Periwinkle',
				'pink' => 'Pink',
				'purple' => 'Purple',
				'purple-2' => 'Purple 2',
				'red' => 'Red',
				'red-2' => 'Red 2',
				'royal-blue' => 'Royal Blue',
				'silver' => 'Silver',
				'sky-blue' => 'Sky Blue',
				'teal-grey' => 'Teal Grey',
				'teal' => 'Teal',
				'teal-2' => 'Teal 2',
			)
		),
		
		
		'plan' => array(
			'std' => 'pro',
			'type' => 'text',
			'label' => __('Plan', 'tt_theme_framework'),
			'desc' => __('Enter the name of the plan. (ie. basic, pro, premium)', 'tt_theme_framework')
	),
	
	'currency' => array(
			'std' => '$',
			'type' => 'text',
			'label' => __('Currency Symbol', 'tt_theme_framework'),
			'desc' => __('Enter the currency symbol. (ie. $, &euro;)', 'tt_theme_framework')
	),
	
	'price' => array(
			'std' => '29',
			'type' => 'text',
			'label' => __('Price', 'tt_theme_framework'),
			'desc' => __('Enter the price. (ie. 29)', 'tt_theme_framework')
	),
	
	'term' => array(
			'std' => 'per month',
			'type' => 'text',
			'label' => __('Term', 'tt_theme_framework'),
			'desc' => __('Enter the term for this plan. (ie. per month, per year)', 'tt_theme_framework')
	),
	
	'button_label' => array(
			'std' => 'Sign up',
			'type' => 'text',
			'label' => __('Button Label', 'tt_theme_framework'),
			'desc' => __('Enter a label for the button. (ie. sign up, learn more)', 'tt_theme_framework')
	),
	
	'button_size' => array(
			'type' => 'select',
			'label' => __('Button Size', 'tt_theme_framework'),
			'desc' => __('Select a button size.', 'tt_theme_framework'),
			'options' => array(
				'small' => 'Small',
				'large' => 'Large',
				'jumbo' => 'Jumbo'
			)
		),
		
		'button_color' => array(
			'type' => 'select',
			'label' => __('Button Color', 'tt_theme_framework'),
			'desc' => __('Select a button color.', 'tt_theme_framework'),
			'options' => array(
				'autumn' => 'Autumn',
				'black' => 'Black',
				'black-2' => 'Black 2',
				'blue' => 'Blue',
				'blue-grey' => 'Blue Grey',
				'cool-blue' => 'Cool Blue',
				'coffee' => 'Coffee',
				'fire' => 'Fire',
				'golden' => 'Golden',
				'green' => 'Green',
				'green-2' => 'Green 2',
				'grey' => 'Grey',
				'lime-green' => 'Lime Green',
				'navy' => 'Navy',
				'orange' => 'Orange',
				'periwinkle' => 'Periwinkle',
				'pink' => 'Pink',
				'purple' => 'Purple',
				'purple-2' => 'Purple 2',
				'red' => 'Red',
				'red-2' => 'Red 2',
				'royal-blue' => 'Royal Blue',
				'silver' => 'Silver',
				'sky-blue' => 'Sky Blue',
				'teal-grey' => 'Teal Grey',
				'teal' => 'Teal',
				'teal-2' => 'Teal 2',
				'white' => 'White',	
			)
		),
	
	'button_url' => array(
			'std' => 'http://www.',
			'type' => 'text',
			'label' => __('Button URL', 'tt_theme_framework'),
			'desc' => __('Enter a URL for this button. ie: http://www.google.com', 'tt_theme_framework')
		),
		
		'button_target' => array(
			'type' => 'select',
			'label' => __('Button Target', 'tt_theme_framework'),
			'desc' => __('Select the target for this button. (ie. "_self" opens link in same window)', 'tt_theme_framework'),
			'options' => array(
				'_self' => '_self',
				'_parent' => '_parent',
				'_blank' => '_blank',
				'_top' => '_top',
			)),
			
			
			'description' => array(
			'std' => '<ul>
<li><strong>50 GB</strong> Sample item 1</li>
<li><strong>100 Emails</strong> Sample item 2</li>
</ul>',
			'type' => 'textarea',
			'label' => __('Description', 'tt_theme_framework'),
			'desc' => __('Enter the description for this pricing plan.', 'tt_theme_framework')
	),		
			
		),
		
		'shortcode' => '[{{column}}] [vision_pricing_box style="{{style}}" color="{{color}}" plan="{{plan}}" currency="{{currency}}" price="{{price}}" term="{{term}}" button_label="{{button_label}}" button_size="{{button_size}}" button_color="{{button_color}}" button_url="{{button_url}}" button_target="{{button_target}}"] {{description}} [/vision_pricing_box][/{{column}}]',
		'clone_button' => __('+ Add Another Pricing Box', 'tt_theme_framework')
	)
);


/*---------------------------------------*/
/* Tabs
/*---------------------------------------*/
$tt_shortcodes['tabs'] = array(
	'params' => array(
	'style' => array(
			'type' => 'select',
			'label' => __('Tab Style', 'tt_theme_framework'),
			'options' => array(
				'vertical' => 'Vertical',
				'horizontal' => 'Horizontal',
			))),
	'shortcode' => '[tabset style="{{style}}"] {{child_shortcode}}[/tabset]',
	'no_preview' => true,
	
	// can be cloned and re-arranged
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'type' => 'text',
				'label' => __('Tab Title', 'tt_theme_framework'),
				'std' => ''
			),
			
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Tab Content', 'tt_theme_framework'),
			),
			
			'active' => array(
			'type' => 'select',
			'label' => __('Active Tab?', 'tt_theme_framework'),
			'desc' => __('Should this tab be active by default?', 'tt_theme_framework'),
			'options' => array(
				'no' => 'No',
				'yes' => 'Yes',
			)),
		),
		'shortcode' => '[tab title="{{title}}" active="{{active}}"] {{content}} [/tab] ',
		'clone_button' => __('+ Add Another Tab', 'tt_theme_framework')
	)
);



/*---------------------------------------*/
/* Team Members
/*---------------------------------------*/
$tt_shortcodes['team'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ',
	'no_preview' => true,
	
	
	// can be cloned and re-arrange
	'child_shortcode' => array(
		'params' => array(
			
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Name', 'tt_theme_framework'),
			'desc' => __('Enter this team members name.', 'tt_theme_framework')
	),
	
	'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Title', 'tt_theme_framework'),
			'desc' => __('Enter this team members title <em>(ie. CEO)</em>.', 'tt_theme_framework')
	),
	
	'photo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Photo', 'tt_theme_framework'),
			'desc' => __('Enter the full URL to this team members Photo.', 'tt_theme_framework')
	),
	
	'phone' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Phone Number', 'tt_theme_framework'),
			'desc' => __('Enter this team members phone number.', 'tt_theme_framework')
	),
	
	'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Email', 'tt_theme_framework'),
			'desc' => __('Enter this team members email address.', 'tt_theme_framework')
	),
	
	'email_label' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Custom Email Label', 'tt_theme_framework'),
			'desc' => __('By default this team members email address will be displayed to the end user. Use this section to display a custom label instead. (ie. Email John)', 'tt_theme_framework')
	),
	
	'bio' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Biography', 'tt_theme_framework'),
				'desc' => 'Enter this team members biography.',
			),
	
	'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Twitter', 'tt_theme_framework'),
			'desc' => __('Enter this team members Twitter username <em>(note: only the username is required)</em>.', 'tt_theme_framework')
	),
	
	'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Facebook', 'tt_theme_framework'),
			'desc' => __('Enter the full URL to this team members Facebook page.', 'tt_theme_framework')
	),
	
	'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Google+', 'tt_theme_framework'),
			'desc' => __('Enter the full URL to this team members Google+ page.', 'tt_theme_framework')
	),
	
	'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Linkedin', 'tt_theme_framework'),
			'desc' => __('Enter the full URL to this team members Linkedin page.', 'tt_theme_framework')
	),
			
			
			
		),
		'shortcode' => '[team_member name="{{name}}" title="{{title}}" photo="{{photo}}" email="{{email}}" email_label="{{email_label}}" phone="{{phone}}" twitter="{{twitter}}" facebook="{{facebook}}" google="{{google}}" linkedin="{{linkedin}}"] {{bio}} [/team_member] ',
		'clone_button' => __('+ Add Another Team Member', 'tt_theme_framework')
	)
);


/*---------------------------------------*/
/* Testimonials
/*---------------------------------------*/
$tt_shortcodes['testimonials'] = array(
	'params' => array(),
	'shortcode' => '[testimonial_set] {{child_shortcode}} [/testimonial_set]',
	'no_preview' => true,
	
	
	// can be cloned and re-arrange
	'child_shortcode' => array(
		'params' => array(
			
		'client' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Customer/Client\'s Name', 'tt_theme_framework'),
	),
			
			
			'testimonialtext' => array(
				'type' => 'textarea',
				'label' => __('Testimonial', 'tt_theme_framework'),
			)
		),
		'shortcode' => '[testimonial client="{{client}}"]{{testimonialtext}}[/testimonial]',
		'clone_button' => __('+ Add Another Testimonial', 'tt_theme_framework')
	)
);


/*---------------------------------------*/
/* Text Styles
/*---------------------------------------*/
$tt_shortcodes['text-styles'] = array(
	'no_preview' => true,
	'params' => array(
		'text_style' => array(
			'type' => 'select',
			'label' => __('Text Style', 'tt_theme_framework'),
			'options' => array(
				'large-callout' => 'Large Callout Text',
			)
		),
		
		'content' => array(
				'type' => 'textarea',
				'label' => __('Content', 'tt_theme_framework'),
			),
	),
		
	'shortcode' => '[text style="{{text_style}}"] {{content}} [/text]',
);