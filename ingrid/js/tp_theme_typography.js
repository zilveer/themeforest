jQuery(document).ready(function() {

	//color picker
	jQuery('.colorpicker').css('display','none');	
	
	jQuery('#colorpicker1').farbtastic('#color1');
	jQuery('#colorpicker2').farbtastic('#color2');
	jQuery('#colorpicker3').farbtastic('#color3');	
	jQuery('#colorpicker4').farbtastic('#color4');
	jQuery('#colorpicker5').farbtastic('#color5');
	jQuery('#colorpicker6').farbtastic('#color6');
	jQuery('#colorpicker7').farbtastic('#color7');
	jQuery('#colorpicker8').farbtastic('#color8');
	jQuery('#colorpicker9').farbtastic('#color9');
	jQuery('#colorpicker10').farbtastic('#color10');
	jQuery('#colorpicker11').farbtastic('#color11');
	jQuery('#colorpicker12').farbtastic('#color12');
	jQuery('#colorpicker13').farbtastic('#color13');

	var show_cp1 = '0';
	
	
	jQuery('.button').click(
		function(){
			//hide all cp on page
			jQuery('.colorpicker').css('display','none');
			
			
			if(show_cp1 == '0'){
				jQuery(this).next().css('display','inline');		
				show_cp1 = '1';			
			}else{
				jQuery(this).next().css('display','none');		
				show_cp1 = '0';
			}			
		}
	)	
	

	
	jQuery('.colorwell').click(function(){
		//hide all cp on page
		jQuery('.colorpicker').css('display','none');
	
		jQuery(this).next().next().css('display','inline');	
		show_cp1 = '1';
	});
	
});