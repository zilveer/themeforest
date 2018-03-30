frameworkShortcodeAtts={
    attributes:[
            {
                label:"Icon name",
                id:"name",
                help:"Input icon name from the two icons list <a href='http://fontawesome.io/icons/' target='_blank'>Fontawesome icons</a> (e.g. 'fa-bell') and <a href='http://jaicab.github.io/Sosa-Icon-Font-CSS/' target='_blank'>Sosa font icons</a> (e.g. 'sosa-micro')."
            },
            {
                label:"Icon size",
                id:"size",
                controlType:"select-control",
                selectValues:['standard', 'mini', 'medium', 'large'],
                defaultValue: 'standard', 
                defaultText: 'standard',
                help:""
            },
            {
                label:"Icon style",
                id:"style",
                controlType:"select-control",
                selectValues:['simple', 'circle', 'square', 'rounded'],
                defaultValue: 'circle', 
                defaultText: 'circle',
                help:""
            },
            {
                label:"Icons color",
                id:"icon_color",
                controlType:"color-control",
                help:"Color for icon inside. Leave blank if you need to use color by default."
            },
            {
                label:"Icons background color",
                id:"icon_bg_color",
                controlType:"color-control",
                help:"Color for icons background. Leave blank if you need to use color by default."
            },
            {
                label:"Icons border color",
                id:"icon_bor_color",
                controlType:"color-control",
                help:"Color for icons border. Leave blank if you need to use color by default."
            }
    ],
    defaultContent:"",
    shortcodeType:"text-replace",
    shortcode:"icon"
};