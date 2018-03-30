jQuery(document).ready(function(){
	<?php 
		global $all_font;

		$used_font = substr(get_option(THEME_SHORT_NAME.'_header_font'), 2);
		
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "jQuery('h1, h2, h3, h4, h5, h6, .gdl-title').not('.stunning-text-title').each(function(){";
				echo 	"if(jQuery(this).hasClass('gdl-page-title')){";	
				echo 		"var text_shadow = jQuery(this).css('text-shadow');";
				echo 		"Cufon.replace(jQuery(this), {fontFamily: '" . $used_font . "' , hover: true, textShadow: text_shadow});";							
				echo 	"}else{";
				echo 		"Cufon.replace(jQuery(this), {fontFamily: '" . $used_font . "' , hover: true});";
				echo 	"}";
				echo "});";			
			
				//echo "Cufon.replace(jQuery('h1, h2, h3, h4, h5, h6, .gdl-title'), {fontFamily: '" . $used_font . "' , hover: true});";
			}
		}
		
		$used_font = substr(get_option(THEME_SHORT_NAME.'_slider_font'), 2);	
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "jQuery('.gdl-slider-font').not('.nivo-caption').each(function(){";
				echo 	"if(jQuery(this).hasClass('custom-slider-caption-wrapper')){";	
				echo 		"var text_shadow = jQuery(this).find('.custom-slider-title').children().css('text-shadow');";
				echo 		"Cufon.replace(jQuery(this).find('.custom-slider-title'), {fontFamily: '" . $used_font . "' , hover: true, textShadow: text_shadow});";				
				echo 		"Cufon.replace(jQuery(this).find('.custom-slider-caption').children().children().not('.no-cufon'), {fontFamily: '" . $used_font . "' , hover: true});";				
				echo 	"}else{";
				echo 		"Cufon.replace(jQuery(this), {fontFamily: '" . $used_font . "' , hover: true});";
				echo 	"}";
				echo "});";
				
				//echo "Cufon.replace(jQuery('.gdl-slider-font').not('.nivo-caption'), {fontFamily: '" . $used_font . "' , hover: true});";
			}
		}		
		
		$used_font = substr(get_option(THEME_SHORT_NAME.'_stunning_text_font'), 2);
		
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace('.stunning-text-title', {fontFamily: '" . $used_font . "'});";
			}
		}
	?>
});