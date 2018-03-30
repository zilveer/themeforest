<?php

//Used for __ function
require_once('../../../../../wp-config.php');

/* Row Shortcode*/

$pxScTemplate['rows'] = array(
	'flags' => 'duplicable',
	'shortcode' => '[rows]{content}[/rows]',
	'preview' => false,
	'title' => 'Row',
	
	'fields' => array(
		'content' => array(
			'type' => 'textarea',
			'label' => __('Row Content', 'textdomain'),
			'desc'  => __('Add the row content', 'textdomain')
		)
	)
);

/* Columns Shortcode */

$spans = array();

for($i=1; $i<=12;$i++)
	$spans['span'.$i] = 'Span ' . $i;

$offsets = array();

$offsets['no_offset'] = 'No Offset';

for($i=1; $i<=12;$i++)
	$offsets['offset'.$i] = 'Offset ' . $i;
	
$pxScTemplate['columns'] = array(
	'flags' => 'duplicable',
	'shortcode' => '[{column} {attributes}]{content}[/{column}]',
	'preview' => false,
	'title' => 'Column',
	
	'fields' => array(
		'content' => array(
			'type' => 'textarea',
			'label' => __('Column Content', 'textdomain'),
			'desc'  => __('Add the column content', 'textdomain')
		),
		'column' => array(
			'type' => 'select',
			'label' => __('Column Type', 'textdomain'),
			'desc' => __('Select the type, ie width of the column.', 'textdomain'),
			'options' => $spans
		),
		'offset' => array(
			'type' => 'select',
			'flags' => 'attr',//Use this field as an attribute
			'label' => __('Offset', 'textdomain'),
			'desc' => __('Select the type, ie width of the offset.', 'textdomain'),
			'options' => $offsets
		)
	)
);

/* Buttons Shortcode */

$pxScTemplate['button'] = array(
	'shortcode' => '[button {attributes}]{content}[/button]',
	'title' => 'Button',
	
	'fields' => array(
		'url' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Button Url',
			'desc' => __('Add the button\'s url (eg http://mysite.com)', 'textdomain')
		),
		'style' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Button Style',
			'desc' => __('Select the button\'s style', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'large_btn' => 'Large',
				'medium_btn' => 'medium',
				'small_btn' => 'small'
			)
		),
		'content' => array(
			'type' => 'textbox',
			'label' => 'Button Text',
			'desc' => __('Add the button\'s text', 'textdomain'),
		),
		'target' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Target',
			'desc' => __('Select the button link target', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'_blank' => 'New Page',
				'_self' => 'Same Page'
			)
		)
	)
);


/* Pie Chart Shortcode */

$pxScTemplate['piechart'] = array(
	'flags' => 'duplicable',
	'shortcode' => '[piechart {attributes}][/piechart]',
	'title' => 'Pie chart',
	'preview' => false,
	
	'fields' => array(
		'skilltitle' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Skill Title',
			'desc' => __('Enter the Skill name here.', 'textdomain')
		),
		'style' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Pie Chart Color',
			'desc' => __('Select the Pie chart\'s color', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'shortcode_chart' => 'Default',
				'shortcode_chart_skin' => 'Skin Color'
			)
		),
		'percent' => array(
			'type' => 'textbox',
			'flags' => 'attr',
			'label' => 'percent',
			'desc' => __('Enter Completion percent here.', 'textdomain'),
		)
	)
);

/* List Shortcode */

$pxScTemplate['lists'] = array(
	'shortcode' => '[list {attributes}][/list]',
	'title' => 'List',
	'preview' => false,
	
	'fields' => array(
		'type' => array(
			'type' => 'select',
			'flags' => 'attr',//Use this field as an attribute
			'label' => __('List Type', 'textdomain'),
			'desc' => __('Select the type, ie disk list', 'textdomain'),
			'options' => array(
				'disk_list' => 'Disk List',
				'arrow_list' => 'Arrow List 1',
				'arrow2_list' => 'Arrow List 2',
				'arrow3_list' => 'Arrow List 3',
				'check_list' => 'Check List',
				'plus_list' => 'Plus List'
			)
		)
	)
);

/* Messagebox Shortcode */

$pxScTemplate['messagebox'] = array(
	'shortcode' => '[messagebox {attributes}]{content}[/messagebox]',
	'title' => 'MessageBox',
	
	'fields' => array(
		'title' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Title',
			'desc' => __('Enter MessageBox Title', 'textdomain')
		),
		'content' => array(
			'type' => 'textbox',
			'label' => 'Text',
			'desc' => __('Enter Messagebox content', 'textdomain'),
		),
		'style' => array(
			'type' => 'select',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Style',
			'desc' => __('Select MessageBox Style', 'textdomain'),
			'options' => array(
				'messageBox1' => 'MessageBox 1',
				'messageBox2' => 'MessageBox 2',
				'messageBox3' => 'MessageBox 3'
			)
		),
		'button_title' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Button Title',
			'desc' => __('Enter MessageBox Button Title (optional)', 'textdomain')
		),
		'url' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Button Url',
			'desc' => __('Add the button\'s url (eg http://mysite.com, can be empty)', 'textdomain')
		),
		'btn_style' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Button Style',
			'desc' => __('Select the button\'s style (eg the buttons colour)', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'btn_default' => 'Normal',
				'button_tailed' => 'Tailed'
			)
		)
	)
);

/* Separator Shortcode */

$pxScTemplate['separator'] = array(
	'shortcode' => '[separator {attributes}][/separator]',
	'title' => 'Separator',
	
	'fields' => array(
		'style' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Separator Style',
			'desc' => __('Select the separator\'s style', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'separator' => 'Separator 1',
				'separator1' => 'Separator 2'
			)
		)
		
	)
);

/* Dropcap Shortcode */

$pxScTemplate['dropcap'] = array(
	'shortcode' => '[dropcap {attributes}]{content}[/dropcap]',
	'title' => 'Dropcap',
	
	'fields' => array(
		'style' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Style',
			'desc' => __('Select the dropcap\'s style', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'dropcap' => 'Dropcap 1',
				'dropcap2' => 'Dropcap 2',
				'dropcap3' => 'Dropcap 3'
			)
		),
		'content' => array(
			'type' => 'textbox',
			'label' => 'Content',
			'desc' => __('Enter Dropcap Text', 'textdomain')
		)
		
	)
);

/* Pullquote Shortcode */

$pxScTemplate['pullquote'] = array(
	'shortcode' => '[pullquote]{content}[/pullquote]',
	'title' => 'quote',
	'preview' => false,

	'fields' => array(
		'content' => array(
			'type' => 'textarea',
			'label' => 'Content',
			'desc' => __('Enter quote Text', 'textdomain')
		)
	)
);

/* Separator Shortcode */

$pxScTemplate['separator'] = array(
	'shortcode' => '[separator][/separator]',
	'title' => 'Separator',
	
	'fields' => array()
);

/* Highlight Shortcode */

$pxScTemplate['highlight'] = array(
	'shortcode' => '[highlight {attributes}]{content}[/highlight]',
	'title' => 'Highlight',
	
	'fields' => array(
		'style' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Style',
			'desc' => __('Select the highlight\'s style', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'highlight' => 'default',
				'gray_highlight' => 'Gray',
				'black_highlight' => 'Black'
			)
		),
		'content' => array(
			'type' => 'textbox',
			'label' => 'Content',
			'desc' => __('Enter highlight\'s Text', 'textdomain')
		)
		
	)
);

					
/* testimonial */ 
$pxScTemplate['testimonial'] = array(
	'flags' => 'duplicable',
	'shortcode' => '[testimonial {attributes}]{content}[/testimonial]',
	'title' => 'Testimonial ',
	
	'fields' => array(
		'testimonial_name' => array(
			'type' => 'textbox',
			'flags' => 'attr',
			'label' => 'Name',
			'desc' => __('Enter testimonial name', 'textdomain')
		),
		'testimonial_meta' => array(
			'type' => 'textbox',
			'flags' => 'attr',
			'label' => 'Meta',
			'desc' => __('Enter testimonial meta', 'textdomain')
		),
		'content' => array(
			'type' => 'textarea',
			'label' => 'Content',
			'desc' => __('Enter testimonial\'s Text', 'textdomain')
		)
	)
);

/* Toggle Shortcode */

$pxScTemplate['toggle'] = array(
	'shortcode' => '[toggle {attributes}]{content}[/toggle]',
	'title' => 'Toggle',
	
	'fields' => array(
		'Title' => array(
			'type' => 'textbox',
			'flags' => 'attr',
			'label' => 'Title',
			'desc' => __('Enter toggle\'s title', 'textdomain')
		),
		'status' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Open/Closed',
			'desc' => __('Select the toggle\'s style', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'toggle_open' => 'Open',
				'toggle_closed' => 'Closed'
			)
		),
			'content' => array(
			'type' => 'textarea',
			'label' => 'Content',
			'desc' => __('Enter Toggle Content', 'textdomain')
		)
		
	)
);

/* Alert Shortcode */

$pxScTemplate['alert'] = array(
	'shortcode' => '[alert {attributes}]{content}[/alert]',
	'title' => 'Alert',
	
	'fields' => array(
		'style' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Style',
			'desc' => __('Select the alert\'s style', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'alert_info' => 'Information',
				'alert_danger' => 'Danger',
				'alert_success' => 'Success',
				'alert_warning' => 'Warning'
			)
		),
		'content' => array(
			'type' => 'textbox',
			'labe0l' => 'Content',
			'desc' => __('Enter alert Content', 'textdomain')
		)
		
	)
);

/* Tabs Shortcode */

$pxScTemplate['tabgroup'] = array(
	'shortcode' => '[tabgroup]{content}[/tabgroup]',
	'title' => 'Tab Group',
	'preview' => false,
	
	'fields' => array(
		'content' => array(
			'type' => 'textarea',
			'label' => 'Content',
			'desc' => __('Enter tab group Content', 'textdomain')
		)
	)
);

$pxScTemplate['tab'] = array(
	'flags' => 'duplicable',
	'shortcode' => '[tab {attributes}]{content}[/tab]',
	'title' => 'Tab',
	'preview' => false,
	
	'fields' => array(
		'title' => array(
			'type' => 'textbox',
			'flags' => 'attr',
			'label' => 'Title',
			'desc' => __('Enter tab title', 'textdomain')
		),
		'content' => array(
			'type' => 'textarea',
			'label' => 'Content',
			'desc' => __('Enter tab group Content', 'textdomain')
		),
		'selected' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Selected',
			'desc' => __('Is this default tab?', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'no' => 'No',
				'yes' => 'Yes'
			)
		)
	
	)
);


/* Social links Shortcode */

$pxScTemplate['socialgroup'] = array(
	'shortcode' => '[socialgroup]{content}[/socialgroup]',
	'title' => 'Social Links Group',
	'preview' => false,
	
	'fields' => array(
		'content' => array(
			'type' => 'textarea',
			'label' => 'Content',
			'desc' => __('Enter social links group content', 'textdomain')
		)
	)
);

$pxScTemplate['sociallinks'] = array(
	'flags' => 'duplicable',
	'shortcode' => '[sl {attributes}][/sl]',
	'title' => 'Social Link',
	'preview' => false,
	
	'fields' => array(
		'url' => array(
			'type' => 'textbox',
			'flags' => 'attr',
			'label' => 'Url',
			'desc' => __('Social Link Url', 'textdomain')
		),
		'type' => array(
			'type' => 'select',
			'flags' => 'attr',
			'label' => 'Selected',
			'desc' => __('Social link type', 'textdomain'),
			'default' => 0,//Default option (no need to add attribute for)
			'options' => array(
				'twitter' => 'Twitter',
				'instagram' => 'Instagram',
				'dribbble' => 'Dribbble',
				'vimeo' => 'Vimeo',
				'youtube' => 'YouTube',
				'facebook' => 'Facebook',
				'google' => 'Google+',
				'linkedin' => 'LinkedIn',
				'yahoo' => 'yahoo',
				'behance' => 'Behance',
				'RSS' => 'Rss',
				'deviantart' => 'Deviantart',
				'skype' => 'skype ',
				'flickr' => 'Flickr',
				'forrst' => 'Forrst',
				'digg' => 'Digg',
				'orkut' => 'Orkut',
				'reddit' => 'Reddit',
				'lastFM' => 'LastFM',
				'gowalla' => 'Gowalla',
				'zerply' => 'Zerply',
			)
		)
	
	)
);

/* vimeo Shortcode */

$pxScTemplate['vimeo'] = array(
	'shortcode' => '[vimeo {attributes}][/vimeo]',
	'title' => 'vimeo',
	'preview' => false,
	
	'fields' => array(
		'vimeo_id' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Vimo ID',
			'desc' => __('Enter vimo ID', 'textdomain')
		),	
			'vimeo_height' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Vimo Height',
			'desc' => __('Enter vimo Height', 'textdomain')
		),
			'vimeo_width' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Vimo Width',
			'desc' => __('Enter vimo Width', 'textdomain')
		)	
	)
);

/* Youtube Shortcode */

$pxScTemplate['youtube'] = array(
	'shortcode' => '[youtube {attributes}][/youtube]',
	'title' => 'youtube',
	'preview' => false,
	
	'fields' => array(
		'youtube_id' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Youtube ID',
			'desc' => __('Enter Youtube ID', 'textdomain')
		),
		'youtube_height' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Youtube Height',
			'desc' => __('Enter Youtube Height', 'textdomain')
		),
		'youtube_width' => array(
			'type' => 'textbox',
			'flags' => 'attr',//Use this field as an attribute
			'label' => 'Youtube Width',
			'desc' => __('Enter Youtube Width', 'textdomain')
		)			
	)
);

?>