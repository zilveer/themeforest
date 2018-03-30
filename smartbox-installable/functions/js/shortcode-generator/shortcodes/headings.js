desShortcodeMeta={
	attributes:[
		{
			label:"Heading",
			id:"heading",
			help:"Choose the heading type.", 
			controlType:"select-control", 
			selectValues:['Heading 1', 'Heading 2', 'Heading 3', 'Heading 4', 'Heading 5', 'Heading 6'],
			defaultValue: 'Heading 1', 
			defaultText: 'Heading 1'
		},
		{
			label:"Text",
			id:"content",
			isRequired:true
		},
		],
		customMakeShortcode: function(b){
		
			var ret = "";
				
			var content = "This is my heading...";
			if(b.content)
				content = b.content;
				
			switch(b.heading){
				case "Heading 1": ret = "<h1>" + content + "</h1><br>";
				break;
				case "Heading 2": ret = "<h2>" + content + "</h2><br>";
				break;
				case "Heading 3": ret = "<h3>" + content + "</h3><br>";
				break;
				case "Heading 4": ret = "<h4>" + content + "</h4><br>";
				break;
				case "Heading 5": ret = "<h5>" + content + "</h5><br>";
				break;
				case "Heading 6": ret = "<h6>" + content + "</h6><br>";
				break;
			}
			
			return ret;
			
		}
};