desShortcodeMeta={
	attributes:[
		{
			label:"Content",
			id:"content",
			help: 'The content of your info box. Use a &lt;br /&gt; to start a new line.',
			isRequired:true
		},
		{
			label:"Type",
			id:"type",
			help:"Values: &lt;empty&gt;, Info, Alert, Check, Download, Note.", 
			controlType:"select-control", 
			selectValues:['', 'info', 'download', 'note', 'check', 'error'],
			defaultValue: '', 
			defaultText: 'none (Default)'
		},
		{
			label:"Size",
			id:"size",
			help:"Values: &lt;empty&gt;, medium, large.", 
			controlType:"select-control", 
			selectValues:['', 'large'],
			defaultValue: '', 
			defaultText: 'medium (Default)'
		},
		{
			label:"Style",
			id:"style",
			help:"Values: &lt;empty&gt; or rounded.", 
			controlType:"select-control", 
			selectValues:['', 'rounded'],
			defaultValue: '', 
			defaultText: 'none (Default)'
		},
		{
			label:"Border",
			id:"border",
			help:"Values: &lt;empty&gt;, none, full.", 
			controlType:"select-control", 
			selectValues:['', 'full'],
			defaultValue: '', 
			defaultText: 'top and bottom (Default)'
		},
		{
			label:"Icon",
			id:"icon",
			help:"Values: &lt;empty&gt;, none (for no icon), or full URL to a custom icon."
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
		
			var type = "normal";
			if(b.type)
				type = b.type;
				
			var content = "Text Example";
			if(b.content)
				content = b.content;
			
			var output = "[box type='"+type+"' size='"+b.size+"' style='"+b.style+"' border='"+b.border+"'";
			if (b.icon) output += " icon='"+b.icon+"'";
			output += "]"+content+"[/box]";
			
			return output;
		}

};
