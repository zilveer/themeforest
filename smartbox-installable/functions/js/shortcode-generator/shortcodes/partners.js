desShortcodeMeta={
	attributes:[
		{
			label:"Partners Title",
			id:"partnersTitle",
			help:"Set an optional main heading for the Partners Element.", 
			defaultText: ''
		},
		{
			label: "Partners Members Categories",
			id:"partnersCategories",
			help:"Select which Categories to display."
		},
		{
			label:"Scroller",
			id:"partnersScroller",
			help:"If set to YES the posts will be displayed horizontally with a scroller.", 
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
			label:"Partners Per Row",
			id:"partnersPerRow",
			help:"Set the number of partners to be displayed in each row.", 
			controlType:"select-control", 
			selectValues:['4', '3', '2','1'],
			defaultValue: '3', 
			defaultText: '3'
		},
		{
			label:"Number of Partners to show",
			id:"nshow",
			help:"If 0 will show all partners.", 
		},
		{
			label:"Display Effect",
			id:"effect",
			help:"Choose the effect to apply on the elements.", 
			controlType:"select-control", 
			selectValues:['opacity', 'grayscale'],
			defaultValue: 'opacity',
			defaultText: 'opacity'
		},
		{
			label:"CSS Class",
			id:"css",
			help:"Set an optional custom CSS class for the service.", 
			defaultText: ''
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
				
			var tabberCss = b.css;
			var tabberTitle = b.partnersTitle;
			var ppp = b.partnersPerRow;
			
			var g = ''; // The shortcode.
			
			g += '[partners scroller="'+b.partnersScroller+'" categories="'+b.partnersCategories+'" partners_per_row="'+ppp+'" effect="'+b.effect+'" nshow="'+b.nshow+'" ';
			
			if ( tabberTitle ) { g += ' title="' + tabberTitle + '"'; } // End IF Statement
			if ( tabberCss ) { g += ' css="' + tabberCss + '"'; } // End IF Statement
			
			g += ' autoplay="'+b.autoplay_enabled+'" autoplay_speed="'+b.autoplay_speed+'"]<br/><br/>';

			return g
		
		}
};