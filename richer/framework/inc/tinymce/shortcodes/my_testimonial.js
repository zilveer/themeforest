frameworkShortcodeAtts={
	attributes:[
			{
				label:"Testimonial post slug",
				id:"testi_slug",
				help:"Enter your testimonial post slug."
			},
			{
				label:"The number of last(by date) testimonials items.",
				id:"num",
				help:"Enter your testimonials number. Option with testimonial slug leave blank."
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
	shortcodeType:"text-replace",
	shortcode:"testimonial"
};