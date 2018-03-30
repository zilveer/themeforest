frameworkShortcodeAtts={
    attributes:[
            {
                label:"List marker type",
                id:"icon",
                controlType:"select-control",
                selectValues:['check','check-2', 'minus', 'plus', 'star', 'angle', 'arrow', 'ordered'],
                defaultValue: 'check', 
                defaultText: 'check',
                help:""
            },
            {
                label:"Marker's color",
                id:"iconcolor",
                controlType:"color-control",
                help:"Color for marker inside. Leave blank if you need to use color as main text."
            }
    ],
    defaultContent:"<ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>",
    shortcode:"list"
};