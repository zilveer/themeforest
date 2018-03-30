frameworkShortcodeAtts={
	attributes:[
			{
				label:"Headline",
				id:"headline",
				controlType:"select-control",
				selectValues:['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
				defaultValue: 'h3', 
				defaultText: 'h3',
				help:"Select your title size (h1-h6)."
			},
			{
				label:"Title",
				id:"title",
				help:"Enter your title."
			},
			{
				label:"Style",
				id:"style",
				controlType:"select-control",
				selectValues:['left', 'right', 'center'],
				defaultValue: 'center', 
				defaultText: 'center',
				help:"Select separator style."
			},
			{
				label:"width style",
				id:"width_style",
				controlType:"select-control",
				selectValues:['short', 'fullwidth', 'simple_short'],
				defaultValue: 'short', 
				defaultText: 'short',
				help:"Select separator width style."
			},
			{
				label:"Separator margin",
				id:"margin",
				help:"Please, input separator margin in px. (e.g. 20)"
			}
	],
	defaultContent:"",
	shortcode:"separator"
};