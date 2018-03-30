desShortcodeMeta={
	attributes:[
		{
			label:"Team Title",
			id:"teamTitle",
			help:"Set an optional main heading for the team.", 
			defaultText: ''
		},
		{
			label:"Scroller",
			id:"teamScroller",
			help:"If set to YES the members will be displayed horizontally with a scroller.", 
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'yes',
			defaultText: 'yes'
		},
		{
			label:"Autoplay ?",
			id:"autoplay_enabled",
			help:"The scroller will advance itself. <br/>", 
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'no',
			defaultText: 'no'
		},
		{
			label: "Autoplay Speed",
			id: "autoplay_speed",
			help: "Set the autoplay interval (in ms).",
			defaultValue: '3000'
		},
		{
			label: "Team Members Categories",
			id:"teamCategories",
			help:"Select which Categories to display."
		},
		{
			label:"Number of Team Members to show",
			id:"nshow",
			help:"If 0 will show all.", 
		},
		{
			label:"Team Member Per Row",
			id:"teamPerRow",
			help:"Set the number of Team Member to be displayed in each row. <br/>", 
			controlType:"select-control", 
			selectValues:['2', '3', '4'],
			defaultValue: '3',
			defaultText: '3'
		},
		{
			label:"CSS Class",
			id:"css",
			help:"Set an optional custom CSS class for the team.", 
			defaultText: ''
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			
			var g = ''; // The shortcode.
						
			g += '[team title="'+b.teamTitle+'" members_per_row="'+b.teamPerRow+'" scroller="'+b.teamScroller+'" categories="'+b.teamCategories+'" nshow="'+b.nshow+'" ';
			
			if (b.css) g+= ' css="'+b.css+'"';
			
			g += ' autoplay="'+b.autoplay_enabled+'" autoplay_speed="'+b.autoplay_speed+'"]';

			return g
		
		}
};