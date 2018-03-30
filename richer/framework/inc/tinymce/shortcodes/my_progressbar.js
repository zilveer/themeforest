frameworkShortcodeAtts={
	attributes:[
			{
				label:"Percentage",
				id:"percentage",
				help:"Enter the value for bar (%)."
			},
			{
				label:"Type",
				id:"type",
				controlType:"select-control",
				selectValues:['title-inside', 'title-outside', 'slim-title-outside'],
				defaultValue: 'title_inside', 
				defaultText: 'title_inside',
				help:"Choose the type for bar."
			},
			{
				label:"Filled color",
				id:"filledcolor",
				controlType:"color-control",
				help:"Choose the color for filled bar."
			},
			{
				label:"Unfilled color",
				id:"unfilledcolor",
				controlType:"color-control",
				help:"Choose the color for unfilled bar."
			},
			{
				label:"Striped",
				id:"striped",
				controlType:"select-control",
				selectValues:['striped', 'non_striped'],
				defaultValue: 'non_striped', 
				defaultText: 'non_striped',
				help:"Striped progressbar?"
			},
			{
				label:"Animated",
				id:"animated",
				controlType:"select-control",
				selectValues:['no', 'yes'],
				defaultValue: 'no', 
				defaultText: 'no',
				help:"Animated progressbar?"
			}
	],
	defaultContent:"Web design",
	shortcode:"progressbar"
};