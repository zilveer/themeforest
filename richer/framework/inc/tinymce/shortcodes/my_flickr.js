frameworkShortcodeAtts={
    attributes:[
            {
                label:"Flickr ID",
                id:"username",
                help:"Enter Flickr ID. Use <a href='http://idgettr.com/' target='_blank'>Get flickr id</a>"
            },
            {
                label:"Items count",
                id:"pics",
                help:"Enter flickr items amount."
            },
            {
                label:"Thumbnail size",
                id:"pic_size",
                controlType:"select-control",
                selectValues:['Square (75x75)', 'Thumbnail (100x75)', 'Large Square (150x150)', 'Small (240x180)', 'Medium (500x375)'],
                defaultValue: '1', 
                defaultText: 'Square (75x75)'
            }
    ],
    defaultContent:"",
    shortcode:"flickr",
    shortcodeType: "text-replace"
};