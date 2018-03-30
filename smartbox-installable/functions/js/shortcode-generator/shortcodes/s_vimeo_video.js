desShortcodeMeta={
	attributes:[
		{
			label:"Vimeo Video ID",
			id:"video_id",
			help: "You can see the vimeo ID in their URL. Ex: 69445362",
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
		}/*
,
		{
			label:"Auto Resize",
			id:"auto_resize",
			help: "Will resize the video to the size of container.",
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'no', 
			defaultText: 'no'
		}
*/
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			

			return '[vvideo id="' + b.video_id + '" height="' + b.video_height + '"]';
			
			
		}
		
};
