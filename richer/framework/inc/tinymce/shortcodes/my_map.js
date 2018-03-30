frameworkShortcodeAtts={
	attributes:[
			{
				label:"Address",
				id:"address",
				help:"Enter your location address. You can use more than one addresses, separate them by '|'. Map will be centered by first address."
			},
			{
				label:"Select map type",
				id:"type",
				controlType:"select-control",
				selectValues:['roadmap', 'satellite', 'hybrid', 'terrain'],
				defaultValue: 'roadmap', 
				defaultText: 'roadmap',
				help:""
			},
			{
				label:"Width",
				id:"width",
				help:"Set width for your map in 'px' or '%'."
			},
			{
				label:"Height",
				id:"height",
				help:"Set height for your map in 'px' or '%'."
			},
			{
				label:"Zoom",
				id:"zoom",
				help:"Zoom value from 1 to 19 where 19 is the largest and 1 the smallest."
			},
			{
				label:"Scrollwheel",
				id:"scrollwheel",
				controlType:"select-control",
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"Set to false to disable zooming with your mouses scrollwheel"
			},
			{
				label:"Scale control",
				id:"scale",
				controlType:"select-control",
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Set to false to disable scale control on the map."
			},
			{
				label:"Navigation control",
				id:"zoom_pancontrol",
				controlType:"select-control",
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Set to false to disable panning navigation control."
			}
	],
	defaultContent:"",
	shortcode:"map"
};