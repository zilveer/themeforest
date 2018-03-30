desShortcodeMeta={
	attributes:[
		{
			label:"AddThis Code",
			id:"content",
			help:"Paste here the code generated on your AddThis account page.",
			controlType: "textarea-control"
		}
	],
	disablePreview: true,
	//defaultContent:"",
	//shortcode:"abbr", 
	customMakeShortcode: function(b){
		var a=b.data;
			
		var content = "";
		if(b.content)
			content = b.content;
		
		return "[addthis]<div class='addthiscode' style='display:none;'>"+encodeURIComponent(content)+"</div>[/addthis]";
		
	}
};
