desShortcodeMeta={
	attributes:[
		{
			label:"URL",
			id:"image_url",
			isRequired:true
		},
		{
			label:"Alternative Text",
			id:"alt_text",
		},
		{
			label:"Image Link",
			id:"image_href",
			help:"Optional. Will only be available if the Use PrettyPhoto option is set to NO.", 
		},
		{
			label:"Width",
			id:"image_width",
			help:"In pixels.", 
		},
		{
			label:"Height",
			id:"image_height",
			help:"In pixels.", 
		},
		{
			label:"Animation Effect",
			id:"a_fffect",
			controlType:"select-control", 
			selectValues:['','flip', 'flipInX', 'bounceIn', 'bounceInDown', 'bounceInUp', 'bounceInLeft', 'bounceInRight', 'fadeIn', 'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'fadeInUpBig', 'fadeInDownBig', 'fadeInLeftBig', 'fadeInRightBig', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'lightSpeedIn', 'lightSpeedOut', 'hinge', 'rollIn', 'rollOut'],
			defaultValue: '', 
			defaultText: ''
		},
		{
			label:"Animation Delay",
			id:"a_delay",
			help:"You can set a delay for the animation in <i>seconds</i>. Ex #1: <i>1s</i> | Ex #2: <i>0.3s</i>"
		},
		{
			label:"Auto Resize",
			id:"auto_resize",
			help: "Will resize the image to the size of container.",
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'no', 
			defaultText: 'no'
		},
		{
			label:"Use PrettyPhoto",
			id:"prettyphoto",
			help: "Will add a magnifier to display the image with prettyphoto plugin.",
			controlType:"select-control", 
			selectValues:['yes', 'no'],
			defaultValue: 'no', 
			defaultText: 'no'
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var ret = "";
			var ret1 = "";
			var style = "";
			var aClass = "";
			
			if(b.auto_resize == 'no'){
				style = "width: " + b.image_width + "px; height: " + b.image_height + "px;";
			} else {
				style = "width: 100%";
			}
			
			var divStyle = "";
			var divStylePP = "";
			var delay = b.a_delay;
			if (delay.length != 0){
				delay = delay.replace("\\s+","");
				if (delay.indexOf("s") < 0) delay += "s";
				divStyle = " style='-webkit-animation-delay: "+delay+";-moz-animation-delay: "+delay+";-ms-animation-delay: "+delay+";-o-animation-delay: "+delay+";'";
				divStylePP = "-webkit-animation-delay: "+delay+";-moz-animation-delay: "+delay+";-ms-animation-delay: "+delay+";-o-animation-delay: "+delay+";";
			}
			if (b.a_fffect.length != 0) b.a_fffect += " image-sh";
			ret1 = "<div class=\"" + b.a_fffect + "\""+divStyle+"><img src=\"" + b.image_url + "\" alt=\"" + b.alt_text + "\" style=\"" + style + "\"></div>";

			if (b.prettyphoto == "no"){
				if(b.image_href != ""){
					ret = "<a href=\""+b.image_href+"\" target=\"_blank\">" + ret1 + "</a>";
				} else {
					ret = ret1;
				}
				return ret;
			} else {
				return "<a style=\"font-size:0px;display:inline-block;line-height:0px;"+ divStylePP+"\" href=\""+b.image_url+"\" rel=\"prettyphoto\" class=\"shortcode-img prettyphoto "+b.a_fffect+"\"><img src=\"" + b.image_url + "\" alt=\"" + b.alt_text + "\" style=\"" + style +"\" ></a><br/>";
			}
		}
};
