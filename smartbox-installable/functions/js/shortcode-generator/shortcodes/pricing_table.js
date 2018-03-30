desShortcodeMeta={
	attributes:[
		{
			label:"CSS3 Pricing Tables",
			id:"pricing_table",
			help:"The Pricing Table to be imported. <br>To create a new CSS3 Pricing Table go to <b>Settings > CSS3 Web Pricing Tables Grid.</b>.<br> You need to have this plugin installed and active.", 
			controlType:"pricing-tables-control"
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			
			return "[css3_grid id='" + b.pricing_table + "']";
			
		}
};
