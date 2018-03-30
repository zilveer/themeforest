frameworkShortcodeAtts={
    attributes:[
            {
                label:"Open",
                id:"open",
                help:"Enter number for open item"
            },
            {
                label:"Style",
                id:"style",
                controlType:"select-control",
                selectValues:['style1', 'style2', 'style3', 'style4'],
                defaultValue: 'style1', 
                defaultText: 'style1',
                help:"Select predefined style for your accordion"
            },
    ],
    defaultContent:'<br />[accordion_item title="First Tab Title" icon=""]Your Text[/accordion_item]<br />[accordion_item title="Second Tab Title" icon=""]Your Text[/accordion_item]<br />[accordion_item title="Third Tab Title" icon=""]Your Text[/accordion_item]<br />',
    shortcode:"accordion",
};