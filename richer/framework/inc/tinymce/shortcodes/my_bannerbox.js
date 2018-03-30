frameworkShortcodeAtts={
    attributes:[
			{
                label:"Background Image",
                id:"bg_image",
                controlType:"image-control",
                help:"Enter path to the banner image (e.g. http://yoursite.org/src/img/pic.png) or select image from media library."
            },
            {
                label:"Backround color",
                id:"bg_color",
                controlType:"color-control",
                help:""
            },
            {
				label:"Backround opacity",
				id:"bg_opacity",
				controlType:"select-control",
				selectValues:['0','0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1'],
				defaultValue: '0.8', 
				defaultText: '0.8',
				help:""
			},
            {
                label:"Border width",
                id:"border_width", 
                help:"Enter the border width. Leave blank if you need not to have border."
            },
            {
                label:"Border color",
                id:"border_color",
                controlType:"color-control",
                help:""
            },
            {
				label:"Border opacity",
				id:"border_opacity",
				controlType:"select-control",
				selectValues:['0','0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1'],
				defaultValue: '0.8', 
				defaultText: '0.8',
				help:""
			},
			{
				label:"Inner padding",
				id:"inner_padding",
				help:"Padding between border and block with text and background."
			},
			{
				label:"Outer padding",
				id:"outer_padding",
				help:"Padding between border and main block boundaries."
			},
			{
				label:"Minimum height",
				id:"min_height",
				help:"Enter the minimum height of the banner."
			},
			{
				label:"Text align",
				id:"text_align",
				controlType:"select-control",
				selectValues:['left', 'center', 'right'],
				defaultValue: 'center', 
				defaultText: 'center',
				help:""
			},
			{
				label:"Banner Link",
				id:"link",
				help:"Enter the link for banner. (e.g. http://yoursite.org). Leave blank if you need not to have link banner."
			},
			{
				label:"Target",
				id:"target_blank",
				controlType:"select-control",
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"If you select 'true', link opens in the new tab."
			}
    ],
    defaultContent:"Your banner text...",
    shortcode:"bannerbox"
};