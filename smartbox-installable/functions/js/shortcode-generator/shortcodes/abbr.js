desShortcodeMeta={
	attributes:[
			{
				label:"Abbreviation",
				id:"content",
				help:"The abbreviated text.",
				isRequired:true
			},
			{
				label:"Full Text",
				id:"title",
				help:"The full, unabbreviated, text.", 
				isRequired:true
			}
			],
	customMakeShortcode: function(b){
		var a=b.data;
		var content = "";
		if(b.content)
			content = b.content;
		return "[abbr abbreviation='"+b.content+"' fulltext='"+b.title+"']";
		
	}
};
