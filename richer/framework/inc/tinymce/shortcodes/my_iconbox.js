frameworkShortcodeAtts={
    attributes:[
            {
                label:"Title",
                id:"title",
                help:"Enter text for box title."
            },
            {
                label:"Icon name",
                id:"icon",
                help:"Enter icons name to display in iconbox."
            },
			{
				label:"Iconbox style",
				id:"style",
				controlType:"select-control",
				selectValues:['icon_with_title', 'mini_circle_icon_with_title', 'aside_rounded_icon', 'top_icon_circle', 'top_icon_circle_large', 'top_icon_standard', 'top_icon_large'],
				defaultValue: 'top_icon_circle', 
				defaultText: 'top_icon_circle',
				help:"Choose iconbox style. Iconbox style preview you can find <a href='#' target='_blank'>here</a>"
			},
            {
                label:"Icon color",
                id:"icon_color",
                controlType:"color-control",
                help:"Select icon's color."
            },
            {
                label:"Icon's background color",
                id:"icon_bg_color",
                controlType:"color-control",
                help:"Select icon's background color."
            },
            {
                label:"Icons border color",
                id:"icon_bor_color",
                controlType:"color-control",
                help:"Color for icons border."
            },
            {
                label:"Iconbox background color",
                id:"iconbox_bg_color",
                controlType:"color-control",
                help:"Background color for block."
            },
            {
                label:"Content text align",
                id:"text_align",
                controlType:"select-control",
				selectValues:['left', 'right', 'center'],
				defaultValue: 'left', 
				defaultText: 'left',
                help:""
            },
            {
                label:"Url",
                id:"url",
                help:"Leave blank if you need not to link your block with the page."
            },
            {
                label:"Frame for block",
                id:"frame",
                controlType:"select-control",
                selectValues:['framed', 'framed_when_hover', 'non_framed'],
                defaultValue: 'non_framed', 
                defaultText: 'non_framed',
                help:""
            }
    ],
    defaultContent:"Your content there...",
    shortcode:"iconbox"
};