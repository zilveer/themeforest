frameworkShortcodeAtts={
	attributes:[
			{
				label:"Layout",
				id:"layout",
				controlType:"select-control",
				selectValues:['grid', 'grid-with-margins', 'grid-with-shadow', 'carousel', 'fullwidth-carousel', 'grid-with-excerpts', 'grid-masonry', 'grid-only-images'],
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
				selectValues:['2', '3', '4', '5', '6'],
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
				label:"Show filter",
				id:"filter",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'no', 
				defaultText: 'no',
				help:"Enable or Disable category filter for projects."
			},
			{
				label:"Filter position",
				id:"filter_pos",
				controlType:"select-control",
				selectValues:['left', 'right', 'center'],
				defaultValue: 'left', 
				defaultText: 'left',
				help:""
			},
			{
				label:"Excerpt words count",
				id:"excerpt_count",
				help:"Excerpt length (words)."
			},
			{
				label:"Show title?",
				id:"show_title",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:""
			},
			{
				label:"Show hover?",
				id:"show_hover",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:""
			},
			{
				label:"Show 'load more' button?",
				id:"loadmore_btn",
				controlType:"select-control",
				selectValues:['yes', 'no'],
				defaultValue: 'no', 
				defaultText: 'no',
				help:"Enable or Disable button for load more portfolio posts."
			},
			{
				label:"Button ('load more') text",
				id:"loadmore_btn_text",
				help:"Input button text."
			}
	],
	defaultContent:"",
	shortcode:"portfolio"
};