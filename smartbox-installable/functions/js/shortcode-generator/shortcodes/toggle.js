desShortcodeMeta={
	attributes:[
			{
				label:"Default 'Open' Title Text",
				id:"title_open",
				help:"The text of the title when the toggle is set to 'open'.",
				defaultValue:"Close Me"
			}, 
			{
				label:"Default 'Closed' Title Text",
				id:"title_closed",
				help:"The text of the title when the toggle is set to 'closed'.", 
				defaultValue:"Open Me"
			}, 
			{
				label:"Content",
				id:"content",
				help:"The content to be toggled.", 
				controlType:"textarea-control", 
				isRequired:true
			}, 
			{
				label:"Hide On Start",
				id:"hide",
				help:"Optionally hide the content on start.", 
				controlType:"select-control", 
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes (Default)'
			}, 
			{
				label:"Include XHTML in content.",
				id:"include_excerpt_html",
				help:"Optionally include XHTML tags in the text", 
				controlType:"select-control", 
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes (Default)'
			}
			],
			
	defaultContent:"Content to be toggled.",
	shortcode:"toggle"
};
