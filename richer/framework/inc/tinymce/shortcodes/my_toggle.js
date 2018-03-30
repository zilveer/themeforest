frameworkShortcodeAtts={
    attributes:[
            {
                label:"Title",
                id:"title",
                help:"Enter title"
            },
            {
                label:"Icon",
                id:"icon",
                help:"Enter icon's name"
            },
            {
                label:"Style",
                id:"style",
                controlType:"select-control",
                selectValues:['style1', 'style2', 'style3', 'style4'],
                defaultValue: 'style1', 
                defaultText: 'style1',
                help:"Select predefined style for your toggle"
            },
            {
                label:"Open",
                id:"open",
                controlType:"select-control",
                selectValues:['false', 'true'],
                defaultValue: 'false', 
                defaultText: 'false',
                help:"If you need to open this toggle by default - select true."
            }
    ],
    defaultContent:'Your Text ...',
    shortcode:"toggle",
};