desShortcodeMeta={
	attributes:[
		{
			label:"Youtube Video ID",
			id:"video_id",
			help: "You can see the video ID in their URL. Ex: 3i9f9W5vzQU",
			isRequired:true
		},
		/*
{
			label:"Width",
			id:"video_width",
			help:"In pixels.", 
		},
*/
		{
			label:"Height",
			id:"video_height",
			help:"In pixels.", 
		}
,
		{
			label:"Show Related",
			id:"related",
			help: "Will display related content at the end of the video.",
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'no', 
			defaultText: 'no'
		}

		],
		disablePreview:true,
		customMakeShortcode: function(b){
			
		var related = "";
		if (b.related == "no")
			related = "related='no'";			

			return '[yvideo id="' + b.video_id + '" '+ related +' height="' + b.video_height + '"]';
			
			
		}
		
};
