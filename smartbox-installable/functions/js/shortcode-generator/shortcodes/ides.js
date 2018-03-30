desShortcodeMeta={
	attributes:[
		{
			label:"Designare Icon",
			id:"desicon",
			controlType:"select-control", 
			selectValues:['icon1','icon2','icon3','icon4','icon5','icon6','icon7','icon8','icon9','icon10','icon11','icon12','icon13','icon14','icon15','icon16','icon17','icon18','icon19','icon20','icon21','icon22','icon23','icon24','icon25','icon26','icon27','icon28','icon29','icon30','icon31','icon32','icon33','icon34','icon35','icon36','icon37','icon38','icon39','icon40','icon41','icon42','icon43','icon44','icon45','icon46','icon47', 'icon48'],
			defaultValue: 'icon1',
			defaultText: 'icon1'
		},
		{
			label:"Icons Size",
			id:"iconsSize",
			help:"Set the size of the Service Items icons.", 
			controlType:"select-control", 
			selectValues:['big', 'small'],
			defaultValue: 'big',
			defaultText: 'big'
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
			var a=b.data;
			var output = "[desicon icon='"+b.desicon+"' size='"+b.iconsSize+"'"; 
			if (b.css) output += " css='"+b.css+"'";
			output += "]";
			
			return output;
		}
};
