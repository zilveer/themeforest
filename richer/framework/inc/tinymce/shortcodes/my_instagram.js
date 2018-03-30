frameworkShortcodeAtts={
    attributes:[
            {
                label:"User ID",
                id:"userid",
                help:'Enter User ID. Use <a target="_blank" href="http://jelled.com/instagram/lookup-user-id">http://jelled.com/instagram/lookup-user-id</a>'
            },
            {
                label:"Access Token",
                id:"access_token",
                help:'Enter access token key. Use <a target="_blank" href="http://jelled.com/instagram/access-token">http://jelled.com/instagram/access-token</a>'
            },
            {
                label:"Items count",
                id:"pics",
                help:"Enter instagram items amount."
            },
            {
                label:"Items per row",
                id:"pics_per_row",
                controlType:"select-control",
                selectValues:['3', '2', '4', '6'],
                defaultValue: '3', 
                defaultText: '3'
            }
    ],
    defaultContent:"",
    shortcode:"instagram",
    shortcodeType: "text-replace"
};