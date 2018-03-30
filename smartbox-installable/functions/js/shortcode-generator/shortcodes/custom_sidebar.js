desShortcodeMeta={
	attributes:[
		{
			label:"Custom Sidebar",
			id:"custom_sidebar",
			help:"The sidebar to be used. <br>To create a custom sidebar go to <b>Smartbox Options > General > Sidebars.</b>", 
			controlType:"sidebars-control", 
			defaultValue: 'Sidebar Widgets', 
			defaultText: 'Sidebar Widgets (Default)'
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			
			return "[custom_sidebar id='" + b.custom_sidebar + "']";
			
		}
};
