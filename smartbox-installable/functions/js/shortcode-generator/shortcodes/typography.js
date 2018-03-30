desShortcodeMeta={
	attributes:[
		{
			label:"Content",
			id:"content",
			help: 'The text to be styled. Use a &lt;br /&gt; to start a new line.',
			isRequired:true
		},
		{
			label:"Font",
			id:"font",
			help:"The font to be used. <br><b>NOTE:</b> You need to go to the Designare Panel and import the font.", 
			controlType:"font-control", 
			defaultValue: 'Cantarell', 
			defaultText: 'Cantarell (Default)'
		},
		{
			label:"Size",
			id:"size",
			help:"The text size.", 
			controlType:"range-control", 
			defaultValue: 24,
			rangeValues:[9, 70]
		},
		{
			label:"Size Format",
			id:"size_format",
			help:"The format of the size (px or em).", 
			controlType:"select-control", 
			selectValues:['px', 'em'],
			defaultValue: 'px', 
			defaultText: 'px (Default)'
		},
		{
			label:"Color",
			id:"color",
			help:"Values: &lt;empty&gt; for default or a color (e.g. red or #000000).", 
			controlType:"colourpicker-control"
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
				
			var content = "";
			if(b.content)
				content = b.content;
				
				var fontfam = b.font.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
				var fontfam = fontfam.replace(" ","+");
			  			
  			
  			
			//return "<span class='shortcode-typography' style='font-family: " + b.font + "; font-size: " + b.size + b.size_format + "; color: " + b.color + ";'>" + content + "</span><br>";
			return "[typography family='"+b.font+"' size='"+b.size+"' format='"+b.size_format+"' color='"+b.color+"']"+content+"[/typography]";
			
		}
		//defaultContent:"",
		//shortcode:"typography"
};
