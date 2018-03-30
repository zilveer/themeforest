frameworkShortcodeAtts={
	attributes:[
			{
				label:"Background color",
				id:"bg_color",
				controlType:"color-control",
				help:""
			},
			{
				label:"Border width",
				id:"border_width",
				help:"Enter border width in pixel, without dimensions. (e.g. 2)"
			},
			{
				label:"Border color",
				id:"border_color",
				controlType:"color-control",
				help:""
			},
			{
				label:"Show button?",
				id:"button",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:""
			},
			{
				label:"Button label",
				id:"buttonlabel",
				help:"Enter the label for button. (e.g. Learn more)"
			},
			{
				label:"Button Link",
				id:"link",
				help:"Enter the link for button. (e.g. http://www.google.com)"
			},
			{
				label:"Button Color",
				id:"buttoncolor",
				controlType:"select-control",
				selectValues:['default', 'white', 'lightgray', 'blue', 'lightgreen', 'green', 'pink', 'red', 'orange', 'yellow', 'ginger', 'brown', 'turquoise', 'gray', 'black'],
				defaultValue: 'default', 
				defaultText: 'default',
				help:"Choose button color. Default buttons color it is your main theme color."
			},
			{
				label:"Button Size",
				id:"buttonsize",
				controlType:"select-control",
				selectValues:['mini', 'small', 'medium', 'large'],
				defaultValue: 'medium', 
				defaultText: 'medium',
				help:"Choose button size."
			},
			{
				label:"Button Style",
				id:"buttonstyle",
				controlType:"select-control",
				selectValues:['simple', 'gradient', 'three_d', 'simple rounded', 'gradient rounded',],
				defaultValue: 'simple', 
				defaultText: 'simple',
				help:"Choose button style."
			},
			{
				label:"Button position",
				id:"button_position",
				controlType:"select-control",
				selectValues:['left', 'right', 'center', 'like_text'],
				defaultValue: 'right', 
				defaultText: 'right',
				help:"Choose button position."
			},
			{
				label:"Target blank?",
				id:"target_blank",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:"Select 'yes', if you want to open link in new window."
			},
			{
				label:"Text position",
				id:"text_position",
				controlType:"select-control",
				selectValues:['left', 'right', 'center'],
				defaultValue: 'right', 
				defaultText: 'right',
				help:"Choose text position."
			},
			{
				label:"Text color",
				id:"text_color",
				controlType:"color-control",
				help:""
			}
	],
	defaultContent:"The best choice in wordpress category",
	shortcode:"calltoaction"
};