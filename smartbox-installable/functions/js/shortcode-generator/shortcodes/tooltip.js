desShortcodeMeta={
	attributes:[
		{
			label:"Tooltip Style",
			id:"style",
			help:"Choose the Tooltip Style.", 
			controlType:"select-control", 
			selectValues:['Light', 'Dark'],
			defaultValue: 'Light', 
			defaultText: 'Light'
		},
		{
			label:"Text",
			id:"tooltip_content",
			controlType:"textarea-control"
		}
		],
		disablePreview: true,
		customMakeShortcode: function(b){
		
			g = "[tooltip tooltip_content='"+b.tooltip_content+"' style='"+b.style+"'] Tooltip text trigger goes here. [/tooltip]";
			
			return g;
			
		}
};