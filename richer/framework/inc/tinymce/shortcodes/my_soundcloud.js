frameworkShortcodeAtts={
	attributes:[
			{
				label:"Url",
				id:"url",
				help:"Enter the urlof your track from soundcloud. (e.g. https://soundcloud.com/eranda-janku/alex-vargas-more-usher-cover)"
			},
			{
				label:"Width",
				id:"width",
				help:"Enter the width of your embed."
			},
			{
				label:"Height",
				id:"height",
				help:"Enter the height of your video. (The best height is 114px)"
			},
			{
				label:"Autoplay",
				id:"autoplay",
				controlType:"select-control",
				selectValues:['no', 'yes'],
				defaultValue: 'no', 
				defaultText: 'no'
			},
			{
				label:"Show comments?",
				id:"comments",
				controlType:"select-control",
				selectValues:['no', 'yes'],
				defaultValue: 'no', 
				defaultText: 'no'
			},
			{
				label:"Color",
				id:"color",
				controlType:"color-control"
			}
	],
	defaultContent:"",
	shortcodeType:"text-replace",
	shortcode:"soundcloud"
};