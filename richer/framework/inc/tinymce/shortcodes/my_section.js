frameworkShortcodeAtts={
	attributes:[
			{
                label:"Section background image",
                id:"bg_image",
                controlType:"image-control",
                help:"Select image from media library or enter url."
            },
            {
                label:"Background position",
                id:"bg_position",
                controlType:"select-control",
				selectValues:['top left', 'top right', 'center center', 'bottom center', 'right center', 'left center', 'left bottom', 'right bottom'],
				defaultValue: '', 
				defaultText: ''
            },
            {
                label:"Background image repeat",
                id:"bg_repeat",
                controlType:"select-control",
				selectValues:['repeat', 'no-repeat', 'repeat-x', 'repeat-y'],
				defaultValue: '', 
				defaultText: '',
				help:"Select background repeat option. <a href='http://www.w3schools.com/cssref/pr_background-repeat.asp'>Learn more</a>"
            },
            {
                label:"Background size",
                id:"bg_size",
                controlType:"select-control",
				selectValues:['auto', 'cover', 'contain'],
				defaultValue: 'auto', 
				defaultText: 'auto',
				help:""
            },
            {
				label:"Background color",
				id:"bg_color",
				controlType:"color-control"
			},
			{
				label:"Text color",
				id:"text_color",
				controlType:"color-control"
			},
			{
				label:"Border width",
				id:"border_width"
			},
			{
				label:"Border color",
				id:"border_color",
				controlType:"color-control"
			},
			{
				label:"Top padding",
				id:"padding_top",
				help:"The top padding clears an area top the content (inside the border) of an element."
			},
			{
				label:"Bottom padding",
				id:"padding_bottom",
				help:"The bottom padding clears an area bottom the content (inside the border) of an element."
			},
			{
				label:"Use container(width for content) inside section?",
				id:"use_container",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:""
			},
            {
				label:"Parallax",
				id:"parallax",
				controlType:"select-control",
				selectValues:['no', 'yes'],
				defaultValue: 'no', 
				defaultText: 'no'
			},
			{
                label:"Section divider",
                id:"section_divider",
                controlType:"select-control",
				selectValues:['none', 'top', 'bottom', 'both'],
				defaultValue: 'none', 
				defaultText: 'none',
				help:"This option allows you to have arrow after or before your section."
            },
            {
				label:"Section ID",
				id:"section_id",
				help:"This option help you to create one-page site structure. You need to use the same id in the menu anchor. Details in theme documentation. You can leave this blank if you use multi-pages."
			}
			
	],
	defaultContent:"section",
	shortcode:"section"
};