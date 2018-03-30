frameworkShortcodeAtts={
	attributes:[
			{
				label:"Layout",
				id:"layout",
				controlType:"select-control",
				selectValues:['grid', 'carousel', 'list', 'list-with-date', 'grid-list-with-date'],
				defaultValue: 'grid', 
				defaultText: 'grid',
				help:"Select layout type."
			},
			{
				label:"Slideshow",
				id:"slideshow",
				controlType:"select-control",
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"Enable or Disable auto scroll when 'carousel' layout selected. Set 'true' to enable."
			},
			{
				label:"Colunms",
				id:"columns",
				controlType:"select-control",
				selectValues:['2', '3', '4'],
				defaultValue: '3', 
				defaultText: '3',
				help:"Select columns count."
			},
			{
				label:"How many posts to show?",
				id:"number_posts",
				help:"This is how many posts will be displayed."
			},
			{
				label:"Category slug",
				id:"cat_slug",
				help:"This help you to retrieve items from specific category."
			},
			{
				label:"Order posts by:",
				id:"orderby",
				controlType:"select-control",
				selectValues:['date', 'popular'],
				defaultValue: 'date', 
				defaultText: 'date',
				help:""
			},
			{
				label:"Excerpt words count",
				id:"excerpt_count",
				help:"Excerpt length (words)."
			},
			{
				label:"Show 'read more' link?",
				id:"show_readmore",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:""
			},
			{
				label:"link ('read more') text",
				id:"readmore_text",
				help:"Input link 'read more' text.",
				defaultText: 'Continue reading'
			},
			{
				label:"Show author info?",
				id:"show_author",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:""
			},
			{
				label:"Show thumbnail?",
				id:"show_thumb",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:""
			},
			{
				label:"Show pagination?",
				id:"pagination",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'no', 
				defaultText: 'no',
				help:"Enable or Disable pagination for posts. Only for grid view."
			},
	],
	defaultContent:"",
	shortcodeType: "text-replace",
	shortcode:"recentposts"
};