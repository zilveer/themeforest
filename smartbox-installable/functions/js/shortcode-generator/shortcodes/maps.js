desShortcodeMeta={
	attributes:[
		{
			label:"Latitude",
			id:"latitude",
			help: 'Ex: 38.706932',
			isRequired:true
		},
		{
			label:"Longitude",
			id:"longitude",
			help: 'Ex: -9.135632',
			isRequired:true
		},
		{
			label:"Map Width",
			id:"mapwidth",
			help: 'Default: 590 (pixels)'
		},
		{
			label:"Map Height",
			id:"mapheight",
			help: 'Default: 300 (pixels)'
		},
		{
			label:"Border",
			id:"border", 
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'yes', 
			defaultText: 'yes'
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			
			var width, height;
			
			if(b.mapwidth == "")
				width = 590;
			else
				width = b.mapwidth;
				
			if(b.mapheight == "")
				height = 300;
			else
				height = b.mapheight;
					
			return "[googlemaps lat='" + b.latitude + "' long='" + b.longitude + "' border='" + b.border + "' width='" + width + "' height='" + height + "']";
			
			
		}
};
