frameworkShortcodeAtts={
	attributes:[
			{
				label:"Button Link",
				id:"link",
				help:"Enter the link for button. (e.g. http://www.google.com)"
			},
			{
				label:"Button Color",
				id:"color",
				controlType:"select-control",
				selectValues:['default', 'white', 'lightgray', 'blue', 'lightgreen', 'green', 'pink', 'red', 'orange', 'yellow', 'ginger', 'brown', 'turquoise', 'gray', 'black'],
				defaultValue: 'default', 
				defaultText: 'default',
				help:"Choose button color. Default buttons color it is your main theme color."
			},
			{
				label:"Button Size",
				id:"size",
				controlType:"select-control",
				selectValues:['mini', 'small', 'medium', 'large'],
				defaultValue: 'medium', 
				defaultText: 'medium',
				help:"Choose button size."
			},
			{
				label:"Button Style",
				id:"style",
				controlType:"select-control",
				selectValues:['simple', 'gradient', 'three_d', 'simple rounded', 'gradient rounded',],
				defaultValue: 'simple', 
				defaultText: 'simple',
				help:"Choose button style."
			},
			{
				label:"Icon's name",
				id:"icon",
				help:"Enter the icon's name."
			},
			{
				label:"Icon's position",
				id:"icon_pos",
				controlType:"select-control",
				selectValues:['left', 'right'],
				defaultValue: 'left', 
				defaultText: 'left',
				help:"Choose icon position."
			},
			{
				label:"Target",
				id:"target",
				controlType:"select-control",
				selectValues:['_blank', '_self', '_parent', '_top'],
				defaultValue: '_self', 
				defaultText: '_self',
				help:"The target attribute specifies a window or a frame where the linked document is loaded. Learn about this <a href='http://www.w3schools.com/tags/att_a_target.asp' target='_blank'>more</a>"
			},
			{
				label:"Button's position",
				id:"align",
				controlType:"select-control",
				selectValues:['left', 'right', 'center', 'none'],
				defaultValue: 'none', 
				defaultText: 'none',
				help:"Choose button position."
			},
            {
                label:"Button lightbox",
                id:"lightbox",
				controlType:"select-control",
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"If you need button to show image or video in lightbox select 'true'. Also, your button must link to image or video (vimeo, youtube, etc.)"
            }
	],
	defaultContent:"Button",
	shortcode:"button"
};