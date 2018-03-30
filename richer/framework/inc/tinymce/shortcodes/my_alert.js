frameworkShortcodeAtts={
	attributes:[
			{
				label:"Style",
				id:"type",
				controlType:"select-control",
				selectValues:['notice', 'info', 'success', 'warning', 'error', 'custom'],
				defaultValue: 'info', 
				defaultText: 'info',
				help:"Alert type. Select 'custom' and use for style options below."
			},
			{
				label:"Close button",
				id:"close",
				controlType:"select-control",
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Show close button or not - true, false."
			},
			{
				label:"Icon",
				id:"icon",
				help:"Enter icon's name."
			},
			{
				label:"Color",
				id:"color",
				controlType:"color-control",
				help:"Select your text color."
			},
			{
				label:"Border style",
				id:"border_style",
				help:"Enter border style. (e.g. none, solid, dotted, dashed, double) "
			},
			{
				label:"Border size",
				id:"border_size",
				help:"Enter border size. (e.g. 2px)"
			},
			{
				label:"Border color",
				id:"border_color",
				controlType:"color-control"
			},
			{
				label:"Background color",
				id:"background_color",
				controlType:"color-control"
			}
	],
	defaultContent:"You can add any icon  you want, and chose any type of Alert Message.",
	shortcode:"alert"
};