desShortcodeMeta={
	attributes:[
		{
			label:"Quote",
			id:"content",
			controlType:"textarea-control", 
			isRequired:true
		}
		],
		customMakeShortcode: function(b){
			var a=b.data;
			var content = "I just want to say you this...";
			if(b.content)
				content = b.content;
			return "[quote]"+content+"[/quote]";
		}
};