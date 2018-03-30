desShortcodeMeta={
	attributes:[
		{
			label:"Custom Slider",
			id:"custom_slider",
			help:"The slider to be used. <br>To create a custom slider go to <b>Smartbox Options > Flex Slider.</b>", 
			controlType:"slider-control"
		},
		{
			label:"Height",
			id:"height",
			help:"The slider height in pixels. Set to <b>auto</b> to make the slider responsive."
		},
		{
			label:"Effect",
			id:"effect",
			controlType:"select-control",
			selectValues:['fade', 'slide'],
			defaultValue: 'fade', 
			defaultText: 'fade'
		},
		{
			label:"Show Navigation",
			id:"navigation",
			controlType:"select-control",
			selectValues:['false', 'true'],
			defaultValue: 'false', 
			defaultText: 'false'
		},
		{
			label:"Show Control Navigation",
			id:"controlNavigation",
			controlType:"select-control",
			selectValues:['false', 'true'],
			defaultValue: 'false', 
			defaultText: 'false'
		},
		{
			label:"Pause on Hover",
			id:"pauseOnHover",
			controlType:"select-control",
			selectValues:['false', 'true'],
			defaultValue: 'false', 
			defaultText: 'false'
		},
		{
			label:"Speed",
			id:"speed",
			help:"The slider speed in milliseconds (default: 3000)."
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			var s = b.speed;
			
			if(!s)
				s = 3000;
			
			return "[custom_slider id='" + b.custom_slider + "' height='"+b.height+"' effect='"+b.effect+"' navigation='"+b.navigation+"' control_navigation='"+b.controlNavigation+"' pause_on_hover='"+b.pauseOnHover+"' speed='"+s+"']";
			
		}
};
