desShortcodeMeta={
	attributes:[
		{
			label:"Background Type",
			id:"background_type",
			controlType:"select-control",
			selectValues:['Color', 'Pattern', 'Image'],
			defaultValue: 'Color', 
			defaultText: 'Color'
		},
		{
			label:"Color",
			id:"background_color",
			controlType:"colourpicker-control",
			help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
		},
		{
			label:"Pattern",
			id:"pattern_url",
			help:"The URL to the Pattern."
		},
		{
			label:"Image",
			id:"image_url",
			help:"The URL to the Image."
		},
		{
			label:"Border Color",
			id:"border_color",
			controlType:"colourpicker-control",
			help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
		},
		{
			label: "Parallax Section ?",
			id: "parallax",
			controlType:"select-control",
			selectValues:['No', 'Yes'],
			help: "Activating this option will add the parallax animation to this section."
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			
			g = "[fullwidth_section type='"+b.background_type+"'";
			if (b.background_type == "Color"){
				g += " color='"+b.background_color+"'";
			} 
			if (b.background_type == "Pattern"){
				g += " pattern='"+b.pattern_url+"'";
			}
			if (b.background_type == "Image"){
				g += " image='"+b.image_url+"'";
				if (b.parallax != "No"){
					g += " parallax='yes'";
				}
			}
			if (b.background_type == "Video"){
				g += " video='"+b.video_url+"'";
			}
			if (b.border_color != ""){
				g+= " border_color='"+b.border_color+"'";
			}
			g +="] Your content goes here. [/fullwidth_section]";
			return g;
		}
};
jQuery(document).ready(function(){
	setTimeout(function(){
		jQuery('#des-value-parallax').closest('tr').css('display','none');
		jQuery('#des-value-background_type').change(function(){
			if (jQuery(this).val() === "Image"){
				jQuery('#des-value-parallax').closest('tr').css('display','table-row');
			} else {
				jQuery('#des-value-parallax').closest('tr').css('display','none');			
			}
		});
	}, 100);
});