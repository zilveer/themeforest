	desShortcodeMeta={
	attributes:[
		{
			label:"Title",
			id:"title"
		},
		{
			label:"Portfolio",
			id:"portfolio",
			controlType:"portfolio-control", 
			defaultValue: 'all', 
			defaultText: 'All Portfolios'
		},
		{
			label:"Total",
			id:"total",
			help:"If 0 will show all projects."
		},
		{
			label:"Scroller",
			id:"rpsTwoScroller",
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
			label:"Project per Row",
			id:"proj_per_row",
			controlType:"select-control", 
			selectValues:['4', '3', '2', '1'],
			defaultValue: '3', 
			defaultText: '3',
			help:"The maximum number of project thumbnails per row. <br/>"
		},
		{
			label: "Projects Categories",
			id:"projectsCategories",
			help:"Select which Categories to display."
		},
		{
			label:"Order By",
			id:"order_by",
			controlType:"select-control", 
			selectValues:['title', 'date'],
			defaultValue: 'title', 
			defaultText: 'title'
		},
		{
			label:"Order",
			id:"order",
			controlType:"select-control", 
			selectValues:['asc', 'desc'],
			defaultValue: 'asc', 
			defaultText: 'asc'
		},
		{
			label:"View More text",
			id:"view_more_text",
			help:"View More Text", 
		},
		{
			label:"Link to Projects",
			id:"link_to_projects",
			help:"Paste here the link to the portfolio page to display your projects. If null the button won\'t be displayed.", 
		},
		{
			label:"Title to Projects Link",
			id:"title_to_projects_link",
			help:"If the link is set, this text will appear in a tooltip on the link hovering.", 
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
						
			var g = '[rp_style2 title="' + b.title + '" portfolio="' + b.portfolio + '" total="' + b.total + '" scroller="'+b.rpsTwoScroller+'" proj_per_row="' + b.proj_per_row + '" categories="'+b.projectsCategories+'" orderby="' + b.order_by + '" order="' + b.order + '" view_more_text="'+b.view_more_text+'" ';
			
			if (b.link_to_projects != "") g += 'link_to_projects="'+b.link_to_projects+'" title_to_projects_link="'+b.title_to_projects_link+'"';
			
			g += ' autoplay="'+b.autoplay_enabled+'" autoplay_speed="'+b.autoplay_speed+'"]';
			
			return g;
			
		}
};
