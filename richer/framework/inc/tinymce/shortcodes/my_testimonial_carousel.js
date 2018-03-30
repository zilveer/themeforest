frameworkShortcodeAtts={
	attributes:[
			{
				label:"Testimonial number posts",
				id:"num",
				help:"Enter your testimonial post count."
			},
			{
				label:"Do you want to show the author's image?",
				id:"thumb",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Enable or disable featured image."
			},
			{
				label:"Select testimonial item layout.",
				id:"type",
				controlType:"select-control", 
				selectValues:['thumb-side', 'thumb-bottom', 'without-thumb', 'bordered-with-thumb'],
				defaultValue: 'thumb-side', 
				defaultText: 'thumb-side'
			},
			{
				label:"The number of words in the excerpt",
				id:"excerpt_count",
				help:"How many words are displayed in the excerpt?"
			}
	],
	defaultContent:"",
	shortcodeType:"test-replace",
	shortcode:"testimonial_carousel"
};