desShortcodeMeta={
	attributes:[
		{
			label:"Title",
			id:"title"
		},
		{
			label: "Posts Categories",
			id:"postsCategories",
			help:"Select which Categories to display."
		},
		{
			label:"Total",
			id:"total",
			help:"If 0 will show all posts."
		},
		{
			label:"Scroller",
			id:"rpScroller",
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
			label:"Posts Per Row",
			id:"postsPerRow",
			help:"Set the number of Posts to be displayed in each row. <br/>", 
			controlType:"select-control", 
			selectValues:['2', '3', '4'],
			defaultValue: '3',
			defaultText: '3'
		},
		{
			label: "Maximum Characters",
			id: "maxChars",
			help: "If it isn\'t set, will display the excerpt defined by the more tag in the post."
		},
		{
			label:"Order By",
			id:"order_by",
			controlType:"select-control", 
			selectValues:['title', 'date', 'author', 'comment_count'],
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
			label:"Link to Blog",
			id:"link_to_blog",
			help:"Paste here the link to the blog page to display your posts. If null the button won\'t be displayed.", 
		},
		{
			label:"Title to Blog Link",
			id:"title_to_blog_link",
			help:"If the link is set, this text will appear in a tooltip on the link hovering.", 
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			
			if (b.maxChars != ""){
				return "[rposts title='" + b.title + "' categories='" + b.postsCategories + "' total='" + b.total + "' scroller='"+b.rpScroller+"' posts_per_row='"+b.postsPerRow+"' max_chars='"+b.maxChars+"' orderby='" + b.order_by + "' order='" + b.order + "' link_to_blog='"+b.link_to_blog+"' title_to_blog_link='"+b.title_to_blog_link+"' autoplay='"+b.autoplay_enabled+"' autoplay_speed='"+b.autoplay_speed+"']";
			} else {
				return "[rposts title='" + b.title + "' categories='" + b.postsCategories + "' total='" + b.total + "' scroller='"+b.rpScroller+"' posts_per_row='"+b.postsPerRow+"' orderby='" + b.order_by + "' order='" + b.order + "' link_to_blog='"+b.link_to_blog+"' title_to_blog_link='"+b.title_to_blog_link+"' autoplay='"+b.autoplay_enabled+"' autoplay_speed='"+b.autoplay_speed+"']";	
			}
			
		}
};
