frameworkShortcodeAtts={
	attributes:[
			{
				label:"Video type",
				id:"type",
				controlType:"select-control",
				selectValues:['vimeo', 'youtube', 'dailymotion'],
				defaultValue: 'vimeo', 
				defaultText: 'vimeo',
				help:"Choose your video type."
			},
			{
				label:"Video ID",
				id:"id",
				help:"Enter the ID of your video."
			},
			{
				label:"Width",
				id:"width",
				help:"Enter the width of your video. (e.g. 600)"
			},
			{
				label:"Height",
				id:"height",
				help:"Enter the height of your video. (e.g. 300)"
			},
			{
				label:"Autoplay",
				id:"autoplay",
				controlType:"select-control",
				selectValues:['no', 'yes'],
				defaultValue: 'no', 
				defaultText: 'no'
			}
	],
	defaultContent:"",
	shortcodeType:"text-replace",
	shortcode:"video_embed"
};